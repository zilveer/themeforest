<?php

class shortcodeUtils
{

  public static function getButtonStylesList()
  {
    return array(
      'black' => 'Black',
      'blue' => 'Blue',
      'gray' => 'Gray',
      'green' => 'Green',
      'red' => 'Red',
      'violet' => 'Violet',

    );
  }

  public static function getListStylesList()
  {
    return array(
      'blue_arrow' => 'Blue Arrow',
      'gray_arrow' => 'Gray Arrow',
      'green_arrow' => 'Green Arrow',
      'pink_arrow' => 'Pink Arrow',
      'red_arrow' => 'Red Arrow',
      'check' => 'OK (Checklist)',
      'heart' => 'Heart',
      'info' => 'Info',
      'play' => 'Play',
      'star' => 'Star',
    );
  }

  public static function getGalleryStyleList()
  {
    return array(
      'image-list' => 'Simple',
      'bebel-gallery' => 'Big Image with small thumbnails',
    );
  }

  /**
   * Thanks to david (http://wordpress.org/extend/plugins/davids-ultra-quicktags/) for the inspiration
   *
   * @param <type> $text
   * @return <type>
   */
  public static function davidJsEscape($text) {
    $safe_text = addslashes($text);
    $safe_text = preg_replace('/&#(x)?0*(?(1)27|39);?/i', "'", stripslashes($safe_text));
    $safe_text = preg_replace("/\r?\n/", "\\n", addslashes($safe_text));
    $safe_text = str_replace('\\\n', '\n', $safe_text);
    return apply_filters('js_escape', $safe_text, $text);
  }
  
  public static function customGallery($output, $attr)
  {
      global $post, $wp_locale;

      static $instance = 0;
      $instance++;
      
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => ''
        ), $attr));
        
        // get url for post thumbnail
        
        $post_thumb = get_post_thumbnail_id($post->ID);
        
        
        
        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $include = preg_replace( '/[^0-9,]+/', '', $include );
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';
      
        
        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';
        
         $selector = "gallery-{$instance}";

        $output = apply_filters('gallery_style', "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;           }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
            <script>
            $('#$selector').colorbox({rel:'gallery_wp_instance_".$instance."', transition:'fade', photo: 'true', maxWidth: '200px', overlayClose: 'false', scrolling: 'true'});
            </script>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery galleryid-{$id}'>");

        $i=0;
        foreach ( $attachments as $id => $attachment ) 
        {
            if($post_thumb != $id)
            {
             $i++;   
            
            
            $link = wp_get_attachment_image_src($id, 'thumbnail');
            $link_full = wp_get_attachment_image_src($id, 'post-gallery-big');

            $output .= "<{$itemtag} class=\"gallery-item\">";
            $output .= "
                            <{$icontag} class=\"gallery-icon\">
                                <a href=\"".$link_full[0]."\" onClick=\"$.colorbox({href:'".$link_full[0]."', rel:'gallery_wp_instance_".$instance."', transition:'fade'}); return false;\" rel=\"gallery_wp_instance_".$instance."\">
                                    <img class=\"attachment-thumbnail\" src=\"".$link[0]."\" alt=\"$link[0]\">
                                </a>
                            </{$icontag}>";
            $output .= "</{$itemtag}>";
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both" />';
            
            }
        }

        $output .= "
                <br style=\"clear: both;\" />
            </div>\n";
        
        return $output;
      }
      
}