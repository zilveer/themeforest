<?php

//Global theme variables
define("THEME_URL", get_template_directory_uri());
define('THEME_METABOX', '_theme_');


////////////////////////////////////
///Add options framework to theme///
////////////////////////////////////


if ( !function_exists( 'optionsframework_init' ) ) {

	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		require_once (TEMPLATEPATH . '/functions/mobile_detect.php');
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		require_once (STYLESHEETPATH . '/functions/mobile_detect.php');
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}


$mdetect = new Mobile_Detect();
if ($mdetect->isMobile()) {
  	define('IS_MOBILE', 1);

} else {
	define('IS_MOBILE', 0);

}


//////////////////////////
///Localization support///
//////////////////////////

add_action('after_setup_theme', 'theme_language_switch');
function theme_language_switch(){
    load_theme_textdomain('alive', get_template_directory() . '/lang');
}



///////////////////////////////////
///Theme stylesheets and scripts///
///////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_stylesheets');
add_action('wp_enqueue_scripts', 'theme_scripts');

function theme_stylesheets() {
	if (!is_admin()) {  
		wp_enqueue_style('geosans', THEME_URL . '/fonts/geosans/stylesheet.css');
		wp_enqueue_style('base', THEME_URL . '/css/style.css');
		if (of_get_option("skin") == "light") {
			wp_enqueue_style('theme', THEME_URL . '/css/light.css');
		} else {
			wp_enqueue_style('theme', THEME_URL . '/css/dark.css');
		}
		wp_enqueue_style('supersized', THEME_URL . '/css/supersized.css');
		wp_enqueue_style('fancybox', THEME_URL . '/js/fancybox/jquery.fancybox-1.3.4.css');
		$mdetect = new Mobile_Detect();
		if ($mdetect->isMobile()) {
   			wp_enqueue_style('mobile', THEME_URL . '/css/mobile.css');
		}
	}
}

function theme_scripts() {
	if (!is_admin()) {  
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jqueryui', THEME_URL . '/js/jquery-ui-1.8.16.min.js',null,null,false);
		wp_deregister_script( 'historyjs');
		wp_enqueue_script( 'historyjs', THEME_URL . '/js/jquery.history.js');
		//wp_enqueue_script( 'animate-enhanced', THEME_URL . '/js/jquery.animate-enhanced.js' );
		wp_enqueue_script( 'supersized', THEME_URL . '/js/supersized.3.2.5.js' );
		wp_enqueue_script( 'fancybox', THEME_URL . '/js/jquery.fancybox-1.3.4.pack.js' );
		wp_enqueue_script( 'pajinate', THEME_URL . '/js/jquery.pajinate.js' );
		wp_enqueue_script( 'tweet', THEME_URL . '/js/jquery.tweet.js' );
		wp_enqueue_script( 'textfill', THEME_URL . '/js/jquery-textfill-0.1.js' );
		if(of_get_option("music_toggle") == 1) {
			wp_enqueue_script( 'jplayer', THEME_URL . '/js/jquery.jplayer.min.js' );
			wp_enqueue_script( 'jplaylist', THEME_URL . '/js/jplayer.playlist.min.js' );
		}
		wp_enqueue_script( 'custom', THEME_URL . '/js/custom.js' );
		
	}
}



///////////////////////////////////
///Load woocommerce environment ///
///////////////////////////////////


require_once ('functions/woocommerce.php');


////////////////////////////////////////////////////////
///Range of image sizes customized to pages and posts///
////////////////////////////////////////////////////////

	
if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200, true);
    add_image_size("gallery_thumb", 180, 180, true);
	add_image_size("gallery_thumb_two", 270, 270, true);
	add_image_size("gallery_thumb_one", 550, 550, true);
	add_image_size("blog_image_thumb", 540, 230, true);
}





//////////////////////////
///Add audio mime types///
//////////////////////////



add_filter('upload_mimes', 'add_custom_upload_mimes');
function add_custom_upload_mimes($existing_mimes){
     $existing_mimes['ogg'] = 'audio/ogg';
     $existing_mimes['mp3'] = 'audio/mp3';
     return $existing_mimes;
}




//////////////////////////////
///Register sidebar support///
//////////////////////////////


if ( function_exists('register_sidebar') ) {

	// Sidebar
	register_sidebar(array(
		'name'=>'Sidebar',
		'before_widget' => '<div class="">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		'name'=>'Shop',
		'before_widget' => '<div class="">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}







/////////////////////////
///Register feed links///
/////////////////////////


add_theme_support('automatic-feed-links');





/////////////////////////////////
///Add custom widgets to theme///
/////////////////////////////////

require_once ('functions/widgets.php');



/////////////////////////
///Register theme menu///
/////////////////////////


add_theme_support( 'menus' );

add_action( 'init', 'register_menus' );

function register_menus(){
	if ( function_exists( 'register_nav_menus' )) {
		register_nav_menus(
			array(
				  'main-menu' => 'Main Menu'
				)
		);
	}
}






/////////////////////////////////
///Set parent menu items count///
/////////////////////////////////

function count_menu_items() {
$menu_name = 'main-menu';
$menu_count = 0;
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu_object = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu_object->term_id);
	foreach ( (array) $menu_items as $key => $menu_item ) {
		if($menu_item->menu_item_parent == 0) {
			$menu_count++;
		} 	
	}
}
 return $menu_count;
}



/////////////////////////////////////////////////////
///Add custom menu function to functions for tiles///
/////////////////////////////////////////////////////

function theme_menu_output($menu_name = 'main-menu') {
$menu_count = 0;
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu_object = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu_object->term_id);
	$menu_output = array();
	$menu_submenu = false;
	$o = '';
	foreach ( (array) $menu_items as $key => $menu_item ) {
		if($menu_item->menu_item_parent == 0) {
			$menu_count++;
			$menu_submenu = false;
			$menu_output[$menu_count-1]["main"] = '
					<a href="'.$menu_item->url.'">
						<h2 class="tileHeading"><span>'.$menu_item->title.'</span></h2>
						<img src="'.of_get_option('nav_tile_'.$menu_count.'_image').'" alt="'.$menu_item->title.'"/>
					</a>';

		} else {
			if(!isset($menu_output[$menu_count-1]["submenu"])) {
				$menu_output[$menu_count-1]["submenu"] = '
					<a href="'.$menu_item->url.'">'.$menu_item->title.'</a>'."\n";
			} else {
				$menu_output[$menu_count-1]["submenu"] .= '
					<a href="'.$menu_item->url.'">'.$menu_item->title.'</a>'."\n";
			}
		}
	}	
	
	
	foreach($menu_output as $tile) {
		$o .= '
		<div class="tile">
			<div class="tileContent">
				<div class="main">
				'. $tile['main'] .'
				</div>';
		if(isset($tile['submenu'])) {
			$o .= '
				<div class="submenu">
					'. $tile['submenu'] .'
				</div>';
		}
		$o .= '
			</div>
		</div>';
		
			
	}
	
	
	return $o;
}
return '';
}







//////////////////////////
///HTML5 shim to header///
//////////////////////////


// add ie conditional html5 shim to header
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');







////////////////////////////////////////////////////////
///Add TinyMCE Button to visual editor for shortcodes///
////////////////////////////////////////////////////////

function themeplugin_addbuttons() {

   // Don't bother doing this stuff if the current user lacks permissions
   if (! current_user_can('edit_posts') && ! current_user_can('edit_pages'))
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_themeplugin_tinymce_plugin");
     add_filter('mce_buttons', 'register_themeplugin_button');
   }
}
 
function register_themeplugin_button($buttons) {
   array_push($buttons, "separator", "themeplugin");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_themeplugin_tinymce_plugin($plugin_array) {
   $plugin_array['themeplugin'] = THEME_URL . '/js/tinymce/editor_plugin.js';
   return $plugin_array;
}

include_once("functions/shortcodes.php");

// init process for button control
add_action('init', 'themeplugin_addbuttons');






//////////////////////////////////////
///Add metaboxes to posts and pages///
//////////////////////////////////////



$gallery_array = array();

$args = array( 'post_type' => 'gallery', 'numberposts' => -1); 

$gallery_posts = get_posts( $args );
$gallery_array[] = array('name' => '', 'value' => '');
if ($gallery_posts) {
	foreach ( $gallery_posts as $gallery) {
		$gallery_array[] = array('name' => get_the_title($gallery->ID), 'value' => $gallery->ID);
	}
}

 // start with an underscore to hide fields from custom fields list
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );
function be_sample_metaboxes( $meta_boxes ) {
	
	global $gallery_array;
	$meta_boxes[] = array(
		'id' => 'title_settings',
		'title' => 'Title Settings',
		'pages' => array('page', 'post', 'product'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Large Heading Text',
				'desc' => 'custom heading text (defaults to page / post title)',
				'id' => THEME_METABOX . 'heading_text',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Large Heading Size',
				'desc' => 'font size of large heading in pixels (default: 80)',
				'id' => THEME_METABOX . 'heading_size',
				'type' => 'text_small'
			)
			
		)
	);
	
	

	$meta_boxes[] = array(
		'id' => 'gallery_settings',
		'title' => 'Gallery Settings',
		'pages' => array('page', 'post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => '',
				'desc' => 'Include a gallery to the current post / page.',
				'type' => 'title',
				'id' => THEME_METABOX . 'gallery_notice'
			),
			array(
				'name' => 'Gallery to include',
				'desc' => 'select all the galleries you want to include on this page',
				'id' => THEME_METABOX . 'gallery_id',
				'type' => 'select',
				'options' => $gallery_array
			),			
			array(
				'name' => 'Number of columns',
				'desc' => 'number of columns to show on page',
				'id' => THEME_METABOX . 'gallery_columns',
				'type' => 'select',
				'options' => array(
					array('name' => '3', 'value' => '3'),
					array('name' => '2', 'value' => '2'),
					array('name' => '1', 'value' => '1')				
				)
			),
			
			array(
				'name' => 'Number of items per page',
				'desc' => 'how many items to display for pagination (only for gallery page template)',
				'id' => THEME_METABOX . 'gallery_items',
				'type' => 'text_small'
			)
			
		)
	);
	
	
	$meta_boxes[] = array(
		'id' => 'gallery_settings',
		'title' => 'Gallery Settings',
		'pages' => array('gallery'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Background Slideshow',
				'desc' => 'check this box to set this gallery as the background slideshow (only select one gallery)',
				'id' => THEME_METABOX . 'homepage_gallery',
				'type' => 'checkbox'
			)
		)
	);
	
			
	return $meta_boxes;
}


// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'functions/metabox/init.php' );
	}
}






/////////////////////////////////////////
///Remove post gallery default styling///
/////////////////////////////////////////

add_filter( 'use_default_gallery_style', '__return_false' );






/////////////////////////////////////////
///Add custom fields for gallery items///
/////////////////////////////////////////

function gallery_attachment_fields_edit($fields, $post) 
{

	$string_item_type = '
	<select class="custom_dropdown" name="attachments[' . $post->ID . '][theme_item_type]" id="attachments[' . $post->ID . '][theme_item_type]"> 
	    <option value="image" '; 
	    if (get_post_meta($post->ID, 'theme_item_type', true) == "" || get_post_meta($post->ID, 'theme_item_type', true) == "image") $string_item_type .= "selected";
	    
	    $string_item_type .= '>Image</option> 
	    <option value="youtube" '; 
	    if (get_post_meta($post->ID, 'theme_item_type', true) == "youtube") $string_item_type .= "selected";
	    
	    $string_item_type .= '>Youtube</option> 
		<option value="vimeo" '; 
	    if (get_post_meta($post->ID, 'theme_item_type', true) == "vimeo") $string_item_type .= "selected";
	    
	    $string_item_type .= '>Vimeo</option> 
	</select>';		
	
	$fields["theme_item_type"]["label"] = __("Gallery Item Type (For gallery use only)", "alive");  
	$fields["theme_item_type"]["input"] = "html";  
	$fields["theme_item_type"]["html"] = $string_item_type;
	$fields['theme_video_link']['label'] = __( 'Youtube / Vimeo Video ID (For gallery use only)', "alive" );
	$fields['theme_video_link']['value'] = get_post_meta($post->ID, 'theme_video_link', true);
	$fields['theme_video_link']['helps'] = __( 'Enter the video ID for the Youtube or Vimeo video (not the url).', "alive" );
	
		
	return $fields;
}

// save custom field to post_meta
function gallery_attachment_fields_save($post, $attachment) 
{

	if ( isset($attachment['theme_item_type']) )
		update_post_meta($post['ID'], 'theme_item_type', $attachment['theme_item_type']);
	if ( isset($attachment['theme_video_link']) )
		update_post_meta($post['ID'], 'theme_video_link', $attachment['theme_video_link']);

	return $post;

}


add_filter('attachment_fields_to_edit', 'gallery_attachment_fields_edit', 10, 2);
add_filter('attachment_fields_to_save', 'gallery_attachment_fields_save', 10, 2);






///////////////////////////////////////
///Define custom post type 'gallery'///
///////////////////////////////////////

define('THEME_POST_TYPE', 'gallery');
define('THEME_POST_SLUG', 'gallery');

  function theme_register_post_type () {
   $args = array (
   'label' => 'Galleries',
   'supports' => array( 'title', 'excerpt' ),
   'register_meta_box_cb' => 'theme_meta_box_cb',
   'show_ui' => true,
   'query_var' => true
   );
   register_post_type( THEME_POST_TYPE , $args );
  }
  add_action( 'init', 'theme_register_post_type' );

  function theme_meta_box_cb () {
   add_meta_box( THEME_POST_TYPE . '_details' , 'Media Library', 'theme_meta_box_details', THEME_POST_TYPE, 'normal', 'high' );
  }

  function theme_meta_box_details () {
   global $post;
    $post_ID = $post->ID; 
   printf( "<iframe frameborder='0' src=' %s ' style='width: 100%%; height: 600px;'> </iframe>", get_upload_iframe_src('media') );
  }
  
  
  
  
  


///////////////////////////
///Custom comment output///
///////////////////////////


function custom_comments ($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; 
   $auth_link = get_comment_author_link();
   if($auth_link !=''){
   $start = strpos($auth_link, "'");
   $end = strpos($auth_link, "'", $start + 1 );
   $before_gravatar = '<a href="'.substr($auth_link, $start + 1, $end-$start-1).'">'; $after_gravatar = '</a>';
   }      
   ?>
   <li id="list-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      
      <?php if ($comment->comment_approved == '0') : ?>
         <p><?php _e('Your comment is awaiting moderation.', "alive") ?></p>
         <br />
      <?php endif; ?>
      
       <div class="avatar">
              <?php echo get_avatar( $comment, 50 ); ?> 
       </div>
       <div>
          	<div class="commentName"><strong><?php comment_author_link(); ?></strong></div>
            <div class="commentDate"><?php comment_date("d.m.Y"); ?></div>
            <div class="commentary">
              	<?php comment_text(); ?>
          	</div>
            <?php  comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));  ?>

       </div>
     
     </div>
     
     </li>
        
<?php } 







///////////////////////////////////////
///Custom comment reply button link ///
///////////////////////////////////////

function theme_replylink($c='',$post=null) {

  global $comment;

  // bypass

  if (!comments_open() || $comment->comment_type == "trackback" || $comment->comment_type == "pingback") return $c;

  // patch

  $id = $comment->comment_ID;

  $reply = 'Reply';

  $o = '<a class="external button small '. of_get_option('blog_button_color') . ' alignRight" id="reply-comment" href="'.get_permalink().'?replytocom='.$id.'#respond">'.$reply.'</a>';

  return $o;

}

add_filter('comment_reply_link', 'theme_replylink');







///////////////////////////////////////
///Custom cancel comment reply link ///
///////////////////////////////////////

function cancel_reply_link($html) {

	$html = str_replace('<a ', '<a class="external"', $html);

  	return $html;

}

add_filter('cancel_comment_reply_link', 'cancel_reply_link');







////////////////////////////////
///Custom user register link ///
////////////////////////////////

function user_register_link($html) {

	$html = str_replace('<a ', '<a class="external"', $html);

  	return $html;

}

add_filter('register', 'user_register_link');








//////////////////////////////////////////
///Add 'last' class to every 3rd widget///
//////////////////////////////////////////


function widget_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widgetBox '; // Add the widget box class for additional styling options

	
	if($my_widget_num[$this_id] % 3 == 0) { // If this is the last widget
		$class .= 'last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}

add_filter('dynamic_sidebar_params','widget_last_classes');









//////////////////////////////////////////////
///Add contact form to wordpress functions ///
//////////////////////////////////////////////



function theme_contact_form() {

	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
		die('Error: Missing variables');
	}

	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];

	$to= of_get_option("admin_email");;

	$headers = 'From: '.$email."\r\n" .
		'Reply-To: '.$email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$subject = $subject;
	$body='You have got a new message from the contact form on your website.'."\n\n";
	$body.='Name: '.$name."\n";
	$body.='Email: '.$email."\n";
	$body.='Subject: '.$subject."\n";
	$body.='Message: '."\n".$message."\n";
	
	if(mail($to, $subject, $body, $headers)) {
		die('Mail sent');
	} else {
		die('Error: Mail failed');
	}
}

add_action('wp_ajax_contact_form', 'theme_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'theme_contact_form');
?>