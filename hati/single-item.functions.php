<?php

define( 'MEDIA_CONTENT_METAKEY', '_a-media-content' );

$a_content_if_empty = __('Place here an image gallery shortcode (Add Media > Create Gallery) or video-page URL starting with http://', A_DOMAIN);

/*--------------------------------------------------------------------------
  Add Second Editor
/*------------------------------------------------------------------------*/

function a_forbidden_for_this_post_type() {

  $allowed_for = array('item', 'post');
  global $post_type;
  return !in_array($post_type, $allowed_for);
}

function a_media_content_is_empty() {

  global $a_content_if_empty;
  $c = Acorn::getm(MEDIA_CONTENT_METAKEY);

  if (!$c)
    return true;
  else
    return $c == $a_content_if_empty;
}

function a_second_editor() {
  
  # is allowed for this post type?
  if ( a_forbidden_for_this_post_type() ) return;
  
  # check permissions (item is a post type)
  global $post_ID;
  if ( !current_user_can('edit_post', $post_ID) ) return;

  # ok, go next
  $help_script = "onclick=\"javascript:jQuery('#contextual-help-link, #tab-link-media-content>a').trigger('click');return false;\"";
  $tab_MC = __('Media Content', A_DOMAIN);
  $tab_Help = __('Help', A_DOMAIN);
  
  global $a_content_if_empty;
  $c = Acorn::getm(MEDIA_CONTENT_METAKEY, $a_content_if_empty);
  
  echo '<br>
  <div id="wp-a-second-editor-wrap" class="wp-core-ui wp-editor-wrap html-active">
    <div id="wp-a-second-editor-editor-tools" class="wp-editor-tools hide-if-no-js">
    <a id="content-tmce" class="wp-switch-editor switch-tmce" '. $help_script .'>'. $tab_Help .'</a>
    <a id="a-second-editor-html" class="wp-switch-editor switch-html">'. $tab_MC .'</a>
    <div id="wp-a-second-editor-media-buttons" class="wp-media-buttons"><a href="#" class="button insert-media add_media" data-editor="a-second-editor" title="'.esc_attr__( 'Add Media' ).'"><span class="wp-media-buttons-icon"></span> '.__( 'Add Media' ).'</a></div></div>
    <div id="wp-a-second-editor-editor-container" class="wp-editor-container"><textarea class="wp-editor-area" rows="3" cols="40" name="a-second-editor" id="a-second-editor">'. $c .'</textarea></div>
  </div><br>';
}

function a_second_editor_help() {

  # is allowed for this post type?
  if ( a_forbidden_for_this_post_type() ) return;
  
  # ok, now adding help
  global $post_type;
  get_current_screen()->add_help_tab( array(
  'id'		=> 'media-content',
  'title'		=> __('Media Content', A_DOMAIN),
  'content'	=>
    '<p>' . "Media Content area used to contain a media that should be placed separately from the main {$post_type} content. What media content can be added:" . '</p>' .
    '<ul>' .
    '<li>' . "<b>[gallery]</b> - Shortcode without options will fetch all images attached to the current {$post_type}." . '</li>' .
    '<li>' . '<b>[gallery &hellip; ]</b> - To create & control an image gallery, click the Add Media button, select (upload) the images and click the "Create a new gallery" button.' . '</li>' .
    // '<li>' . '<b>[gallery type=list &hellip; ]</b> - Render gallery as an image list instead of slides.' . '</li>' .
    '<li>' . '<b>http://<i>media-url</i></b> - You can embed media from many popular sources including YouTube, Vimeo, SoundCloud, Instagram and others by pasting normal URL. Please refer to the Codex to <a href="http://codex.wordpress.org/Embeds">learn more about embeds</a>' . '</li>' .
    '</ul>'
  ) );  
}

function a_save_second_editor_content($post_id) {
  
  # check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  
  # is allowed for this post type?
  if ( a_forbidden_for_this_post_type() ) return;

  # check permissions (item is a post type)
  if (!current_user_can('edit_post', $post_id)) return;
  
  # ok, go next: get content (a-second-editor = textarea's name)
  $c = isset($_POST['a-second-editor']) ? $_POST['a-second-editor'] : '';
  
  if ($c) {
    // $c = strip_tags($c, '<img><iframe>'); // strip all tags, but img & iframe
    update_post_meta($post_id, MEDIA_CONTENT_METAKEY, stripslashes($c));
  } else delete_post_meta($post_id, MEDIA_CONTENT_METAKEY);
}

function a_the_media_content( $c = false ) {
  
  if (!$c && a_media_content_is_empty()) return;
  
  if (!$c) $c = Acorn::getm(MEDIA_CONTENT_METAKEY);

  echo apply_filters('the_content', $c);
}

add_action ( 'admin_head-post.php', 'a_second_editor_help' );
add_action ( 'admin_head-post-new.php', 'a_second_editor_help' );
add_action ( 'edit_form_after_editor', 'a_second_editor' );
add_action ( 'save_post', 'a_save_second_editor_content' );


/*--------------------------------------------------------------------------
  Register Custom Shortcode Gallery
/*------------------------------------------------------------------------*/

class CustomGalleryShortcode extends AShortcode {
  
  static function init () {
    // if ( is_singular ( 'item' ) ) // now its public
    add_filter('post_gallery', 'CustomGalleryShortcode::gallery', 10, 2);   
  }

  static function gallery ( $content, $attr ) {

    $post = get_post(); // or 'global $post;'
    
    if ( ! empty( $attr['ids'] ) ) {
      // 'ids' is explicitly ordered, unless you specify otherwise.
      if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
      $attr['include'] = $attr['ids'];
    }
    
    extract(shortcode_atts(array(
      'order'      => 'ASC',
      'orderby'    => 'menu_order ID',
      'id'         => $post->ID,
      'itemtag'    => 'dl',
      'icontag'    => 'dt',
      'captiontag' => 'dd',
      'columns'    => 1,
      'size'       => 'thumbnail',
      'include'    => '',
      'exclude'    => '',
      'type'       => false,
      'slider'     => false,
      'maxwidth'   => 'auto',
      'maxheight'  => 'auto'
    ), $attr));
    
    $id = intval($id);
    if ( 'RAND' == $order )
      $orderby = 'none';
      
    if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }
    } elseif ( !empty($exclude) ) {
      $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
      $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    
    # special
    
    if (is_singular()) $slider = true;
    
    # ok, let's generate the content
    
    $output = $style = '';

    foreach ( $attachments as $id => $attachment ) {
      $img = "<img src='{$attachment->guid}' alt='{$attachment->post_title}'>";

      if ( $h3 = $attachment->post_excerpt ) $h3 = "<h3>{$h3}</h3>";
      if ( $h2 = $attachment->post_content )
        $h2 = do_shortcode("[autobr]<h2>{$h2}</h2>[/autobr]");
      
      $desc = ($h3 || $h2) ?
        "<div class='media-desc desc'>{$h3}{$h2}</div>" : '';

      $output .= "<li>{$img} {$desc}</li>";
      
      if (!$slider) break;
    }
    
    if ( $int = intval($maxheight) )
      $style = "style='max-height:{$int}px'";

    $tag = ($slider) ? 'ol' : 'ul';

    $speed = Acorn::getm('Slider Speed');
    $timeout = Acorn::getm('Slider Timeout');
    $options = "data-timeout='{$timeout}' data-speed='{$speed}'";

    if ($output)
      $output = "<{$tag} class='slides' {$style} {$options}> {$output} </{$tag}>";

    return $output;
  }
}

add_action ( 'the_post', 'CustomGalleryShortcode::init' );