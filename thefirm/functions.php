<?php
register_nav_menu( 'header_menu', 'Header Menu' );

function loadScripts() {
    if (!is_admin()) {
        $themedir = get_template_directory_uri()."/";
	$scriptdir = get_template_directory_uri()."/scripts/";

        wp_enqueue_script( 'jquery' );
	

        wp_register_script( 'prettyphoto', $scriptdir . 'jquery.prettyPhoto.js', false, '3.1.4');
        wp_enqueue_script( 'prettyphoto' );

	wp_register_style( 'prettyphoto',  $scriptdir . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'prettyphoto' );
	
     
        wp_register_script( 'thefirm-effects', $scriptdir . 'tf-effects.min.js', false, '1.0');
        wp_enqueue_script( 'thefirm-effects' );
	
	wp_register_script( 'thefirm-colorani', $scriptdir . 'jquery.animatecol.js', false, '1.0');
        wp_enqueue_script( 'thefirm-colorani' );
	
	wp_register_script( 'thefirm-load', $scriptdir . 'firmload.min.js', false, '1.0');
        wp_enqueue_script( 'thefirm-load' );
        wp_register_script( 'thefirm-scroll', $scriptdir . 'scroll.js', false, '1.0');
        wp_enqueue_script( 'thefirm-scroll' );
        wp_register_script( 'thefirm-mw', $scriptdir . 'jquery.mousewheel.js', false, '1.0');
        wp_enqueue_script( 'thefirm-mw' );
        wp_register_script( 'thefirm-ease', $scriptdir . 'jquery.easing.1.3.js', false, '1.0');
        wp_enqueue_script( 'thefirm-ease' );
    }
}



add_action('init', 'loadScripts');

add_action( 'add_meta_boxes', 'content_add_custom_box' );
add_action( 'add_meta_boxes', 'content_add_custom_box1' );
add_action( 'save_post', 'content_save_postdata' );

function content_add_custom_box() {
    add_meta_box( 
        'content_sectionidpage',
        __( 'Firm Theme Page Options', 'myplugin_textdomain' ),
        'content_custom_box',
        'page',
	'side',
	'core'
    );
};

function content_custom_box() {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  global $post;
     $custom = get_post_custom($post->ID);
     $pex = $custom["pex"][0];
     $title = $custom["title"][0];
  echo '<p>'.__('If you would like to display this page on homepage, enter the additional details here.', 'eet_textdomain').'</p>';
  echo '<label for="title">';
       _e("<p>Subtitle<br/></p>", 'eet_textdomain' );
  echo '</label> ';
?>
<input type="title" name="title" value="<?php echo $title; ?> " />
<?php
  echo '<label for="pex">';
       _e("<p>Description<br/></p>", 'eet_textdomain' );
  echo '</label> ';
?>
<textarea id="pex" name="pex" rows="4" cols="40"> <?php echo $pex; ?> </textarea>
<?php

}

function content_add_custom_box1() {
    add_meta_box( 
        'content_sectionidpageteam',
        __( 'Team Member Details', 'eet_textdomain' ),
        'content_custom_box1',
        'thefirm_team',
	'side',
	'core'
    );
};

function content_custom_box1() {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  global $post;
     $custom = get_post_custom($post->ID);
     $pex = $custom["pex"][0];
     $title = $custom["title"][0];
  echo '<p>'.__('Enter the additional info of this team member that will be displayed on team page.', 'eet_textdomain').'</p>';
  echo '<label for="title">';
       _e("<p>Position<br/></p>", 'eet_textdomain' );
  echo '</label> ';
?>
<input type="title" name="title" value="<?php echo $title; ?> " />
<?php
  echo '<label for="pex">';
       _e("<p>Description<br/></p>", 'eet_textdomain' );
  echo '</label> ';
?>
<textarea id="pex" name="pex" rows="4" cols="40"> <?php echo $pex; ?> </textarea>
<?php

}

function content_save_postdata( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
    if ( isset($_POST['post_type']) && (('page' == $_POST['post_type']) || ('thefirm_team' == $_POST['post_type'])) ) 
    {
      update_post_meta($post_id, "pex", $_POST["pex"]);
      update_post_meta($post_id, "title", $_POST["title"]);
    }
}

function elentech_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php if($depth > 1) {echo comment_class('comm_reply');}  else {echo comment_class();};  ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="commentWrap">
    
      <div class="com_author_namer">

        <?php echo get_avatar($comment,$size='64'); ?>
	<br/>
	<span class="authorFont"><?php printf(__('%s'), get_comment_author_link()) ?></span><?php if($depth > 1) {_e(' replied', 'eet_textdomain');} ?></div>
      
      
      <div class="com_wrap">
        <div class="comment-meta commentmetadata">
	    <span class="commentDate" ><a href="#comment-<?php comment_ID(); ?>"><?php comment_date('')?></a><?php edit_comment_link(__('(Edit)'),'  ','eet_textdomain') ?></span>
          

         <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'eet_textdomain') ?></em>
         <br />
	<?php endif; ?>
        <?php comment_text() ?>
	<br/>
	<?php $args['reply_text'] = 'REPLY'; ?>
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	<div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
  </div></div>
    <div class="clearfix"></div>

<?php
        };

add_theme_support( 'post-thumbnails' );

function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for crop = true but will also work for crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cached files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
                
               
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}


add_theme_support( 'automatic-feed-links' );if ( ! isset( $content_width ) ) $content_width = 900;
function elentech_pagination($next='Next', $prev='Previous',  $pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='white_space'></div><div id='paginationPG'>";
    

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                if ($paged == $i) {
		  echo "<span class='currentPG'>".$i."</span>";
		  }
		else {
		  echo "<a href='".get_pagenum_link($i)."' class='activePG' >".$i."</a>";
                }
             }
         }


         echo "</div>\n";
     }
}


add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'thefirm_team',
		array(
			'labels' => array(
				'name' => __( 'The Team', 'eet_textdomain' ),
				'singular_name' => __( 'The Team', 'eet_textdomain' ),
				'add_new_item' => __('Add New Team Member', 'eet_textdomain')
			),
                'rewrite' => array('slug' => __('teammember', 'bebel'), 'feed' => false),
		'public' => true,
		'has_archive' => false,
		'supports' => array( 'title', 'editor', 'thumbnail' )
		)
	);
}

/**************ADMIN PANEL*************/
//require only in admin!
if(is_admin()){	
	require_once('admin/eet-theme-settings-basic.php');
}

 /**
 * Collects our theme options
 *
 * @return array
 */
function eet_get_global_options(){
	
	$eet_option = array();

	$eet_option 	= get_option('eet_options');
	
return $eet_option;
}

 /**
 * Call the function and collect in variable
 *
 * Should be used in template files like this:
 * <?php echo $eet_option['eet_txt_input']; ?>
 *
 * Note: Should you notice that the variable ($eet_option) is empty when used in certain templates such as header.php, sidebar.php and footer.php
 * you will need to call the function (copy the line below and paste it) at the top of those documents (within php tags)!
 */ 
$eet_option = eet_get_global_options();

REQUIRE_ONCE(TEMPLATEPATH."/slider/slideinit.php");


load_theme_textdomain('eet_textdomain', get_template_directory() . '/lang' );