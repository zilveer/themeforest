<?php

/**************************************
INDEX

PHP INCLUDES
JS & CSS INCLUDES
ADD_THEME_SUPPORT CALLS
IMAGE SIZES
REGISTER MAIN MENU
LOCALIZATION INIT
COMMENTS CALLBACK
REGISTER WIDGET AREAS
FACEBOOK LIKE BOX MECHANICS
MEDIA UPLOAD CUSTOMIZE
SETCOOKIE
LIKE BUTTON AJAX CALL

***************************************/

/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions_custom.php';
	include 'inc/functions_widgets.php';
	include 'inc/functions_google_webfonts.php';
	include 'inc/functions_cmb.php';
	include 'inc/functions_backend.php';
	include 'inc/functions_ajax_load_posts.php';
	include 'inc/shortcodes.php';

	//options
	include 'inc/options/general_options_control.php';
	include 'inc/options/homepage_options_control.php';
	include 'inc/options/post_options_control.php';
	include 'inc/options/appearance_options_control.php';
	include 'inc/options/hooks_options_control.php';


/**************************************
JS & CSS INCLUDES
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','inspire_load_to_front');
	function inspire_load_to_front() {
		//scripts (js)
		wp_enqueue_script('jquery', false, array(), false, true);
		if (mb_get_page_type() != 'single' && mb_get_page_type() != 'page') wp_enqueue_script('boost_masonry', get_template_directory_uri(). '/js/jquery.masonry.min.js', array(), false, true);
		wp_enqueue_script('flexslider', get_template_directory_uri(). '/js/jquery.flexslider.js', array(), false, true);
		wp_enqueue_script('jCarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', array(), false, true);
		wp_enqueue_script('inspire_global_functions', get_template_directory_uri(). '/js/inspire_global_functions.js', array(), false, true);
		wp_enqueue_script('inspire_scripts', get_template_directory_uri() . '/js/scripts.js', array(), false, true);

		wp_enqueue_script('fancybox_mousewheel', get_template_directory_uri() . '/inc/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox_core', get_template_directory_uri() . '/inc/plugins/fancybox/source/jquery.fancybox.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox_buttons', get_template_directory_uri() . '/inc/plugins/fancybox/source/helpers/jquery.fancybox-buttons.js', array('fancybox_core'), false, true);
		wp_enqueue_script('fancybox_media', get_template_directory_uri() . '/inc/plugins/fancybox/source/helpers/jquery.fancybox-media.js', array('fancybox_core'), false, true);
		wp_enqueue_script('fancybox_thumbs', get_template_directory_uri() . '/inc/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js', array('fancybox_core'), false, true);

		//support for threaded comments
		if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
		
		//styles (css)
		wp_enqueue_style('flexslider_style', get_template_directory_uri(). '/css/flexslider.css');
		wp_enqueue_style('jCarousel_style', get_template_directory_uri(). '/css/jCarousel_tango_skin/skin.css');
		
		wp_enqueue_style('fancybox_style', get_template_directory_uri(). '/inc/plugins/fancybox/source/jquery.fancybox.css');
		wp_enqueue_style('fancybox_buttons_style', get_template_directory_uri(). '/inc/plugins/fancybox/source/helpers/jquery.fancybox-buttons.css');
		wp_enqueue_style('fancybox_thumbs_style', get_template_directory_uri(). '/inc/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css');

		//fonts
		wp_enqueue_style('default_primary_font', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic');
		wp_enqueue_style('default_secondary_font', 'http://fonts.googleapis.com/css?family=Francois+One');

		//localize sripts
		$inspire_options = get_option('inspire_options');
		$inspire_options_post = get_option('inspire_options_post');
		$inspire_options_appearance = get_option('inspire_options_appearance');
		wp_localize_script('inspire_scripts','extDataLike', array('ajaxUrl' => admin_url('admin-ajax.php'), 'pageType' => mb_get_page_type()));        
		wp_localize_script('inspire_scripts','extData', array(
			'ajaxUrl' 					=> admin_url('admin-ajax.php'), 
			'pageType'					=> mb_get_page_type(), 
			'templateURI' 				=>  get_template_directory_uri(), 
			'inspireOptions' 			=> $inspire_options,
			'inspireOptionsPost' 		=> $inspire_options_post,
			'inspireOptionsAppearance' 	=> $inspire_options_appearance,
		)); 
		wp_localize_script('inspire_global_functions','extData', array(
			'inspireOptionsAppearance' 	=> $inspire_options_appearance,
		)); 
	}

	//back end includes
	add_action('admin_enqueue_scripts', 'inspire_load_to_back');  //this was changed to admin_enqueue_scripts from action hook admin_footer. Let's see if it makes a difference
	function inspire_load_to_back() {
		//scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, true);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('thickbox', false, array(), false, true);					
		wp_enqueue_script('media-upload', false, array(), false, true);
		wp_enqueue_script('inspire_colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('inspire_backend_scripts', get_template_directory_uri() . '/js/backend_scripts.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('inspire_backend_style', get_template_directory_uri(). '/css/backend.css');
		wp_enqueue_style('jquery-ui', get_template_directory_uri(). '/css/jquery-ui.css');
		wp_enqueue_style('thickbox');
		wp_enqueue_style('inspire_colorpicker_style', get_template_directory_uri(). '/css/colorpicker.css');

		//localize sripts
		$inspire_options = get_option('inspire_options');
		wp_localize_script('inspire_backend_scripts','extDataDel', array('ajaxUrl' => admin_url('admin-ajax.php'))); 
		if (get_current_screen()->id == 'inspire-settings_page_handle_inspire_options_appearance') wp_localize_script('inspire_backend_scripts','extDataFonts', array('fonts' => mb_get_google_webfonts()));        
		wp_localize_script('inspire_backend_scripts','extData', array(
			'templateURI' =>  get_template_directory_uri(), 
			'inspireOptions' => $inspire_options
		));        

	}


/**************************************
ADD_THEME_SUPPORT CALLS
***************************************/

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images
	add_theme_support( 'post-thumbnails' );


/**************************************
IMAGE SIZES
***************************************/

	add_image_size( 'slider_img', 990, 420, true);
	add_image_size( 'sidebar_list_thumb', 80, 60, true);
	add_image_size( 'sidebar_grid_thumb', 148, 148, true); 
	add_image_size( 'slider_order', 70, 50, true); 
	add_image_size( 'archive_classic_img', 560, 310, true); 
	add_image_size( 'footer_thumb', 195, 150, true); 
	//add_image_size( 'featured_compact_img', 650, 9999, true); 
	//add_image_size( 'featured_full_img', 990, 9999, true); 

	//set general content width
	if (!isset($content_width)) $content_width = 650;


/**************************************
REGISTER MAIN MENU
***************************************/

	//register main menu
	register_nav_menus(array(
			'main_navigation_menu' => 'Main Navigation Menu'
	)); 

/**************************************
LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'inspire_localization_setup');
	function inspire_localization_setup() {
		$lang_dir = get_template_directory() . '/lang';    
		load_theme_textdomain('loc_inspire', $lang_dir);
	} 


/**************************************
COMMENTS CALLBACK
***************************************/

	function inspire_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

			<div class="comment">
				
				<div class="avatar">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="comment-content">
				
					<div class="comment-meta">
						<span class="author"><?php comment_author_link(); ?></span>
						<span class="date"><?php echo mb_localize_datetime(get_comment_date(get_option('date_format') . ' \- ' . get_option('time_format'))); ?></span>
						<span class="reply">
							<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'loc_inspire'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
							<?php edit_comment_link(__('Edit', 'loc_inspire')); ?>
						</span>
					</div>
					
					<div class="comment-text">
						
						<?php if ($comment->comment_approved == '0') : ?>
							<em><?php _e('Comment awaiting approval', 'loc_inspire'); ?></em>
							<br />
						<?php endif; ?>

						<?php comment_text(); ?>
						
					</div>
				
				</div>
				
			</div>
		</li>

		<?php 
	}

/**************************************
REGISTER WIDGET AREAS
***************************************/

	if (function_exists('register_sidebar')) {
	    register_sidebar(array(  
	    	'id' => "sidebar_widget_area",
		    'name' => 'Sidebar Widget Area',  
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',  
		    'after_widget' => '</div>',  
		    'before_title' => '<h2 class="widget-title">',  
		    'after_title' => '</h2>' 
		)); 
	 }

	if (function_exists('register_sidebar')) {
		register_sidebar(array(  
			'id' => "boost_footer_widget_area_1",
			'name' => 'Footer: Widget Area 1',  
			'before_widget' => '<div id="%1$s" class="widget %2$s">',  
			'after_widget' => '</div>',  
			'before_title' => '<h2 class="widget-title">',  
			'after_title' => '</h2>'
		)); 
	 }

	if (function_exists('register_sidebar')) {
		register_sidebar(array(  
			'id' => "boost_footer_widget_area_2",
			'name' => 'Footer: Widget Area 2',  
			'before_widget' => '<div id="%1$s" class="widget %2$s">',  
			'after_widget' => '</div>',  
			'before_title' => '<h2 class="widget-title">',  
			'after_title' => '</h2>'
		)); 
	 }

	if (function_exists('register_sidebar')) {
		register_sidebar(array(  
			'id' => "boost_footer_widget_area_3",
			'name' => 'Footer: Widget Area 3',  
			'before_widget' => '<div id="%1$s" class="widget %2$s">',  
			'after_widget' => '</div>',  
			'before_title' => '<h2 class="widget-title">',  
			'after_title' => '</h2>'
		)); 
	 }


/**************************************
FACEBOOK LIKE BOX MECHANICS
***************************************/

	add_action('wp_footer', 'add_facebook_js');  
	function add_facebook_js () {
	?>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		</script>
	<?php
	}


/**************************************
MEDIA UPLOAD CUSTOMIZE
***************************************/

	add_action( 'admin_init', 'check_upload_page' );
	function check_upload_page() {
		global $pagenow;
		if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
			// Now we'll replace the 'Insert into Post Button' inside Thickbox
			add_filter( 'gettext', 'replace_thickbox_text', 1, 3 );
		}
	}

	function replace_thickbox_text($translated_text, $text, $domain) {
		if ('Insert into Post' == $text) {
			//wp_get_referer() will get a string like this: http://localhost/dev_inspire/wp_in_v0m1r1/wp-admin/media-upload.php?referer=inspire_logo&type=image&
			//checks if the referer has something with referer=inspire_ in its name (strpos)
			$referer_strpos = strpos( wp_get_referer(), 'referer=inspire_' );
			if ( $referer_strpos != '' ) {

				//now get the referer
				$referer_str = wp_get_referer();
				$explode_arr = explode('referer=', $referer_str);
				$explode_arr = explode('&type=', $explode_arr[1]);
				$referer = $explode_arr[0];

				//define button text for each referer
				if ($referer == "inspire_logo") return "Use as logo";
				if ($referer == "inspire_favicon") return "Use as favicon";
				if ($referer == "inspire_bg") return "Use as background";

				//default
				return $referer;
			}
		}
		return $translated_text;
	}

/**************************************
SETCOOKIE
***************************************/

    add_action('init','set_inspire_cookie'); 

	function set_inspire_cookie() {
    	if (!isset($_COOKIE['inspire_cookie'])) {
            setcookie('inspire_cookie', "likes=", time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);    
        }
    }

/**************************************
LIKE BUTTON AJAX CALL
***************************************/

	add_action('wp_ajax_like_post', 'like_post');
	add_action('wp_ajax_nopriv_like_post', 'like_post');

	function like_post() {
		//bounce
		if (!wp_verify_nonce($_REQUEST['nonce'], 'like_post')) {
			exit('NONCE INCORRECT!');
		}
		if (!isset($_COOKIE['inspire_cookie'])) die();


		//GET VARS
		$post_ID = $_REQUEST['post_ID'];
		$liked = $_REQUEST['liked'];

		//UPDATE POST LIKES
		if ($liked == "false") {
			$likes = get_post_meta($post_ID,'inspire_likes',true);
			$likes++;
			update_post_meta($post_ID,'inspire_likes',$likes);
		} else {
			$likes = get_post_meta($post_ID,'inspire_likes',true);
			$likes--;
			update_post_meta($post_ID,'inspire_likes',$likes);
		}


		//UPDATE USER LIKES
		$likes_string = mb_cookie_get_key_value ("inspire_cookie", "likes");
		if ($liked == "false") {
			$likes_string = "likes=" . mb_add_value_to_delim_string ($likes_string, $post_ID, ",", false);
		} else {
			$likes_string = "likes=" . mb_del_value_from_delim_string ($likes_string, $post_ID, ",");
		}
        setcookie('inspire_cookie', $likes_string, time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);    

		//OUTPUT
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo $likes;
		}

		die();

	}

