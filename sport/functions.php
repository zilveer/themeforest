<?php

/**************************************
INDEX

PHP INCLUDES
WP ENQUEUE
SETUP THEME
	ADD ACTIONS
	ADD_THEME_SUPPORT CALLS
	IMAGE SIZES
	REGISTER MENUS
	LOCALIZATION INIT
	REGISTER THEME WIDGET AREAS
	REGISTER CUSTOM WIDGET AREAS
	MAKE SHORTCODES EXECUTE IN WIDGET TEXTS
MEDIA UPLOAD CUSTOMIZE
AJAX: TIMELINE LOAD MORE
REMOVE THEME SETTINGS FOR NON-ADMINS
UNREGISTER TIMETABLE WIDGETS
FILTER WORDPRESS MENUS
FILTER SEARCH QUERY
LEGACY TITLE TAG 
BUNDLED PLUGINS AUTOMATIC UPDATE CHECKER

***************************************/

/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions/functions_custom.php';
	include 'inc/functions/functions_tgm.php';
	include 'inc/functions/functions_font_awesome.php';
	include 'inc/functions/functions_google_webfonts.php';
	
	// framework
	include 'inc/framework/fw_index.php';

	// options
	include 'inc/options/options_general_control.php';
	include 'inc/options/options_frame_control.php';
	include 'inc/options/options_post_control.php';
	include 'inc/options/options_appearance_control.php';
	include 'inc/options/options_advanced_control.php';
	include 'inc/options/options_help_control.php';

	// // dynamic css
	include 'inc/templates/dynamic_css.php';


/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	function canon_load_to_front() {


		// get options
		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_post = get_option('canon_options_post');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

		// browser detection
		$user_agent_string = $_SERVER['HTTP_USER_AGENT'];
		$msie8 = (strpos($user_agent_string, 'MSIE 8.') !== false) ? true : false;

		// dev mode options
		if ($canon_options['dev_mode'] == "checked") {
			if (isset($_GET['use_boxed_design'])) { $canon_options['use_boxed_design'] = wp_filter_nohtml_kses($_GET['use_boxed_design']); }
			if (isset($_GET['anim_menus'])) { $canon_options_appearance['anim_menus'] = wp_filter_nohtml_kses($_GET['anim_menus']); }
		}

		//wp scripts
		wp_enqueue_script('jquery', false, array(), false, true);

		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-autocomplete', false, array(), false, true);

		//external scripts
		if (is_page()) wp_enqueue_script('isotope', get_template_directory_uri(). '/js/jquery.isotope.js', array(), false, true);
		wp_enqueue_script('flexslider', get_template_directory_uri(). '/js/jquery.flexslider-min.js', array(), false, true);
		wp_enqueue_script('fitvids', get_template_directory_uri(). '/js/jquery.fitvids.js', array(), false, true);
		wp_enqueue_script('placeholder', get_template_directory_uri(). '/js/placeholder.js', array(), false, true);
		wp_enqueue_script('mosaic', get_template_directory_uri(). '/js/mosaic.1.0.1.min.js', array(), false, true);

		wp_enqueue_script('fancybox_mousewheel', get_template_directory_uri() . '/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox_core', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox_buttons', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-buttons.js', array('fancybox_core'), false, true);
		wp_enqueue_script('fancybox_media', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-media.js', array('fancybox_core'), false, true);
		wp_enqueue_script('fancybox_thumbs', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-thumbs.js', array('fancybox_core'), false, true);

		wp_enqueue_script('canon-sidr', get_template_directory_uri(). '/js/jquery.sidr.js', array(), false, true);
		wp_enqueue_script('canon_cleantabs', get_template_directory_uri(). '/js/cleantabs.jquery.js', array(), false, true);
		wp_enqueue_script('scrollup', get_template_directory_uri(). '/js/jquery.scrollUp.min.js', array(), false, true);
		wp_enqueue_script('selectivizr', get_template_directory_uri(). '/js/selectivizr-min.js', array(), false, true);
		wp_enqueue_script('fittext', get_template_directory_uri(). '/js/fittext.js', array(), false, true);
		wp_enqueue_script('canon_countdown', get_template_directory_uri(). '/js/jquery.countdown.js', array(), false, true);
		wp_enqueue_script('owl_carousel', get_template_directory_uri(). '/js/owl-carousel/owl.carousel.min.js', array(), false, true);
		if ($msie8 === false) { wp_enqueue_script('stellar', get_template_directory_uri(). '/js/jquery.stellar.min.js', array(), false, true); }
		if ($msie8 === false) { wp_enqueue_script('canon_scrollreveal', get_template_directory_uri(). '/js/scrollReveal.js', array(), false, true); }

		//canon scripts
		wp_enqueue_script('canon_global_functions', get_template_directory_uri(). '/js/global_functions.js', array(), false, true);
		wp_enqueue_script('canon-custom-scripts', get_template_directory_uri(). '/js/custom-scripts.js', array(), false, true);
		wp_enqueue_script('canon_scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','flexslider'), false, true);


		//support for threaded comments
		if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
		
		//styles (css)
		wp_enqueue_style('normalize', get_template_directory_uri(). '/css/normalize.min.css');
		wp_enqueue_style('style', get_stylesheet_uri());
		wp_enqueue_style('canon-sidr-style', get_template_directory_uri(). '/css/jquery.sidr.light.css');
		wp_enqueue_style('isotope_style', get_template_directory_uri(). '/css/isotope.css');
		wp_enqueue_style('flexslider_style', get_template_directory_uri(). '/css/flexslider.css');
		wp_enqueue_style('font_awesome_style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('countdown_style', get_template_directory_uri(). '/css/jquery.countdown.css');
		wp_enqueue_style('owl_carousel_style', get_template_directory_uri(). '/js/owl-carousel/owl.carousel.css');
		wp_enqueue_style('owl_carousel_theme_style', get_template_directory_uri(). '/js/owl-carousel/owl.theme.css');
		
		
		if (class_exists('Woocommerce')) { wp_enqueue_style('woo_shop_style', get_template_directory_uri(). '/css/woo-shop.css'); }	// enqueue theme woocommerce style
		if (function_exists('bp_is_active')) { wp_enqueue_style('budypress_style', get_template_directory_uri(). '/css/budypress-style.css'); }
		if (class_exists('bbPress')) { wp_enqueue_style('bbpress_style', get_template_directory_uri(). '/css/bbpress-style.css'); }
		
		if (isset($canon_options['use_responsive_design'])) { if ($canon_options['use_responsive_design'] == "checked") { wp_enqueue_style('responsive_style', get_template_directory_uri(). '/css/responsive.css'); } }
		if (isset($canon_options['use_boxed_design'])) { if ($canon_options['use_boxed_design'] == "checked") { wp_enqueue_style('boxed_style', get_template_directory_uri(). '/css/boxed.css'); } else { wp_enqueue_style('fullwidth_style', get_template_directory_uri(). '/css/full.css'); } }

		wp_enqueue_style('fancybox_style', get_template_directory_uri(). '/js/fancybox/source/jquery.fancybox.css');
		wp_enqueue_style('fancybox_buttons_style', get_template_directory_uri(). '/js/fancybox/source/helpers/jquery.fancybox-buttons.css');
		// wp_enqueue_style('fancybox_thumbs_style', get_template_directory_uri(). '/js/fancybox/source/helpers/jquery.fancybox-thumbs.css');
		
		// dynamic_css printout
		add_action('wp_print_scripts','canon_dynamic_css');

		//localize sripts
		wp_localize_script('canon_scripts','extData', array(
			'ajaxUrl' 					=> admin_url('admin-ajax.php'), 
			'pageType'					=> mb_get_page_type(), 
			'templateURI' 				=>  get_template_directory_uri(), 
			'canonOptions' 				=> $canon_options,
			'canonOptionsFrame' 		=> $canon_options_frame,
			'canonOptionsPost' 			=> $canon_options_post,
			'canonOptionsAppearance' 	=> $canon_options_appearance,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		)); 
	}

	//back end includes
	function canon_load_to_back() {
		//get options
		$canon_options = get_option('canon_options');
		$canon_options_advanced = get_option('canon_options_advanced');

		//wp scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('thickbox', false, array(), false, true);					
		wp_enqueue_script('media-upload', false, array(), false, true);

		//external scripts
		wp_enqueue_script('fitvids', get_template_directory_uri(). '/js/jquery.fitvids.js', array(), false, true);
		wp_enqueue_script('canon_colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('canon_backend_scripts', get_template_directory_uri() . '/js/backend_scripts.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('thickbox');
		wp_enqueue_style('canon_backend_style', get_template_directory_uri(). '/css/backend.css');
		wp_enqueue_style('font_awesome_backend_style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('canon_colorpicker_style', get_template_directory_uri(). '/css/colorpicker.css');

		//localize sripts
		wp_localize_script('canon_backend_scripts','extData', array(
			'templateURI'				=> get_template_directory_uri(), 
			'ajaxURL'					=> admin_url('admin-ajax.php'),
			'canonOptions'				=> $canon_options,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		));        

		if ( strpos(get_current_screen()->id, 'canon_options_appearance') !== false ) wp_localize_script('canon_backend_scripts','extDataFonts', array('fonts' => mb_get_google_webfonts()));        
	}



/**************************************
SETUP THEME
***************************************/
	
	add_action( 'after_setup_theme', 'canon_setup_theme' );

	function canon_setup_theme() {


	/**************************************
	ADD ACTIONS
	***************************************/

		// front end includes
		add_action('wp_enqueue_scripts','canon_load_to_front');

		// back end includes
		add_action('admin_enqueue_scripts', 'canon_load_to_back');  

		// add post views counter to all posts
		add_action('wp_head', 'mb_update_post_views_single_check' );

		// media upload customize
		add_action( 'admin_init', 'check_upload_page' );

		// hide theme settings from non-admins
		add_action( 'admin_menu', 'hide_theme_settings_from_non_admins' );

		// unregister timetable widgets
		add_action( 'widgets_init', 'unregister_timetable_widgets' );

		// bundled plugins automatic update checker
		add_action('init', 'init_canon_auc');


	/**************************************
	ADD FILTERS
	***************************************/

		// disable woocommerce default styles
		if (class_exists('Woocommerce')) { add_filter( 'woocommerce_enqueue_styles', '__return_false' ); }

		// make shortcodes execute in widget texts
		add_filter('widget_text', 'do_shortcode');

		// adjust the WordPress menus
		add_filter( 'wp_nav_menu_items', 'canon_filter_wp_menus', 10, 2);

		// filter search query
		add_filter('pre_get_posts','canon_filter_search_query');


	/**************************************
	ADD_THEME_SUPPORT CALLS
	***************************************/

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images
		add_theme_support( 'post-thumbnails' );

		//post formats
		add_theme_support('post-formats', array('quote','gallery','video','audio'));

		// woocommerce
		add_theme_support( 'woocommerce' );

		// title tag
		add_theme_support( 'title-tag' );


	/**************************************
	IMAGE SIZES
	***************************************/

		add_image_size( 'gallery_isotope_x2', 900, 600, true);
		add_image_size( 'featured_posts_thumb_x2', 1048, 582, true);
		add_image_size( 'timeline_gallery_thumb_x2', 212, 140, true);
		add_image_size( 'posts_graph_thumb_x2', 200, 200, true);
		add_image_size( 'menu_item_thumb_x2', 1086, 722, true);

		//set general content width
		if (!isset($content_width)) $content_width = 1120;

	/**************************************
	REGISTER MENUS
	***************************************/

		//register primary menu
		register_nav_menus(array(
				'primary_menu' => 'Primary Menu'
		)); 

		//register secondary menu
		register_nav_menus(array(
				'secondary_menu' => 'Secondary Menu'
		)); 

	/**************************************
	LOCALIZATION INIT
	***************************************/

		$lang_dir = get_template_directory() . '/lang';    
		load_theme_textdomain('loc_canon', $lang_dir);


	/**************************************
	REGISTER THEME WIDGET AREAS
	***************************************/

		// SIDEBARS
		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_archive_sidebar_widget_area",
				'name' => 'Post/Archive Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_page_sidebar_widget_area",
				'name' => 'Page Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_404_sidebar_widget_area",
				'name' => '404 Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_search_sidebar_widget_area",
				'name' => 'Search Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_contact_sidebar_widget_area",
				'name' => 'Contact Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		// FOOTER WIDGET AREAS
		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_footer_widget_area_1",
				'name' => 'Footer: Widget Area 1',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_footer_widget_area_2",
				'name' => 'Footer: Widget Area 2',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_footer_widget_area_3",
				'name' => 'Footer: Widget Area 3',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_footer_widget_area_4",
				'name' => 'Footer: Widget Area 4',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_footer_widget_area_5",
				'name' => 'Footer: Widget Area 5',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		// PLUGIN SIDEBARS
		if (function_exists('register_sidebar') && class_exists('Woocommerce')) {
			register_sidebar(array(  
				'id' => "canon_woocommerce_widget_area",
				'name' => 'WooCommerce Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar') && function_exists('bp_is_active')) {
			register_sidebar(array(  
				'id' => "canon_buddypress_widget_area",
				'name' => 'BuddyPress Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar') && class_exists('bbPress')) {
			register_sidebar(array(  
				'id' => "canon_bbpress_widget_area",
				'name' => 'bbPress Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar') && class_exists('Tribe__Events__Main')) {
			register_sidebar(array(  
				'id' => "canon_events_widget_area",
				'name' => 'Events Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div><hr class="dots"/>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

	/**************************************
	REGISTER CUSTOM WIDGET AREAS
	***************************************/

		$canon_options_advanced = get_option('canon_options_advanced'); 

		if (isset($canon_options_advanced['custom_widget_areas'])) {
			for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  

				if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) {
					
					$cwa_name = $canon_options_advanced['custom_widget_areas'][$i]['name'];
					$cwa_slug = mb_create_slug($cwa_name);

					if (function_exists('register_sidebar') && !empty($cwa_name)) {
						register_sidebar(array(  
							'id' => 'canon_cwa_' . $cwa_slug,
							'name' => $cwa_name,  
							'before_widget' => '<div id="%1$s" class="widget %2$s">',  
							'after_widget' => '</div>',  
							'before_title' => '<h1 class="widget-title">',  
							'after_title' => '</h1>'
						)); 
					 }
						
				}

			}	
		}


	}	// end canon_setup_theme






/**************************************
MEDIA UPLOAD CUSTOMIZE
***************************************/

	function check_upload_page() {
		global $pagenow;
		if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
			// Now we'll replace the 'Insert into Post Button' inside Thickbox
			add_filter( 'gettext', 'replace_thickbox_text', 1, 3 );
		}
	}

	function replace_thickbox_text($translated_text, $text, $domain) {
		if ('Insert into Post' == $text) {
			$referer_strpos = strpos( wp_get_referer(), 'referer=boost_' );
			if ( $referer_strpos != '' ) {

				//now get the referer
				$referer_str = wp_get_referer();
				$explode_arr = explode('referer=', $referer_str);
				$explode_arr = explode('&type=', $explode_arr[1]);
				$referer = $explode_arr[0];

				//define button text for each referer
				if ($referer == "boost_logo") return "Use as logo";
				if ($referer == "boost_favicon") return "Use as favicon";
				if ($referer == "boost_bg") return "Use as background";
				if ($referer == "boost_media") return "Use this media file";
				if ($referer == "boost_default") return "Use this image";

				//default
				return $referer;
			}
		}
		return $translated_text;
	}




/**************************************
AJAX: TIMELINE LOAD MORE
***************************************/

	//AJAX CALL
	add_action('wp_ajax_timeline_load_more', 'timeline_load_more');
	add_action('wp_ajax_nopriv_timeline_load_more', 'timeline_load_more');

	function timeline_load_more() {
		if (!wp_verify_nonce($_REQUEST['nonce'], 'timeline_load_more')) {
			exit('NONCE INCORRECT!');
		}

	/**************************************
	GET VARS
	***************************************/

		//get options first
		$inspire_options = get_option('inspire_options');
		$inspire_options_hp = get_option('inspire_options_hp');

		//build vars
		$timeline_offset = $_REQUEST['offset'];
		$cmb_timeline_posts_per_page = $_REQUEST['posts_per_page'];
		$cmb_timeline_cat = $_REQUEST['category'];
		$cmb_timeline_order = $_REQUEST['order'];
		$exclude_string = $_REQUEST['exclude_string'];
		$default_excerpt_length = $_REQUEST['default_excerpt_length'];

		$cmb_timeline_link_through =  $_REQUEST['link_through'];
		$cmb_timeline_display_content =  $_REQUEST['display_content'];

		//calculate new offset
		$timeline_offset = $timeline_offset + $cmb_timeline_posts_per_page;


	/**************************************
	DATABASE QUERY
	***************************************/

		//basic args
		$query_args = array();
		$query_args = array_merge($query_args, array(
			'post_type'         => 'post',
			'post_status'       => array('publish','future'),
			'suppress_filters'  => true,
			'numberposts'       => $cmb_timeline_posts_per_page+1,
			'offset'            => $timeline_offset,
			'category_name'     => $cmb_timeline_cat,
			'orderby'           => 'post_date',
			'order'             => $cmb_timeline_order,
			'exclude'           => $exclude_string,
		));


		//final query
		$results_query = get_posts($query_args);


	/**************************************
	OUTPUT
	***************************************/

		//check if this is an ajax call and if so output
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			  
			//copy/paste from page-timeline.php
			for ($i = 0; $i < count($results_query); $i++) { 

				$this_post = $results_query[$i];
			
				$post_format = get_post_format($this_post->ID);
				$cmb_excerpt = get_post_meta($this_post->ID, 'cmb_excerpt', true);
				$cmb_feature = get_post_meta($this_post->ID, 'cmb_feature', true);
				$cmb_media_link = get_post_meta($this_post->ID, 'cmb_media_link', true);
				$cmb_quote_is_tweet = get_post_meta($this_post->ID, 'cmb_quote_is_tweet', true);
				$cmb_byline = get_post_meta($this_post->ID, 'cmb_byline', true);
				$has_feature = mb_has_feature($this_post->ID);

				//STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST
				if ( ($post_format === false) || ($post_format === "video") || ($post_format === "audio") ) {
				?>
					<li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
						<!-- featured image -->
						<?php 
						
							if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
								echo $cmb_media_link;
							} elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id($this_post->ID)) ) {
								echo '<div class="mosaic-block fade">';
								$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
								$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
								printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
								printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
								echo '</div>';
							} elseif (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
								echo '<div class="mosaic-block fade">';
								$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
								$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
								$img_post = get_post(get_post_thumbnail_id($this_post->ID));
								printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
								printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
								echo '</div>';
							}

						?>

						<div class="milestone-container">

							<!-- datetime -->
							<h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>
							
							<!-- title -->
							<?php 
								if ($cmb_timeline_link_through == "checked") {
									  printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
								} else {
									  printf('<h3>%s</h3>',esc_attr($this_post->post_title));
								}
							?>

							<!-- excerpt/content -->
							<?php 

								if ($cmb_timeline_display_content == "checked") {
									echo do_shortcode($this_post->post_content);
								} else {
									if (empty($cmb_excerpt)) { 
										echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); 
									} else {
										echo do_shortcode($cmb_excerpt);
									}  
								}
								if ($cmb_timeline_link_through == "checked") { printf('&#8230;<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
							?>


						</div>  
					</li>
					
				<?php
				}
				//END STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST



				//QUOTE POST
				if ( ($post_format == "quote") ) {
				?>
					<li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
						<div class="milestone-container">
							<!-- datetime -->
							<h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>

							<!-- title -->
							<?php 
								if ($cmb_timeline_link_through == "checked") {
									  printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
								} else {
									  printf('<h3>%s</h3>',esc_attr($this_post->post_title));
								}
							?>

							<!-- excerpt/content -->
							<?php 

								if ($cmb_timeline_display_content == "checked") {
									if(!empty($this_post->post_content)) { echo do_shortcode($this_post->post_content); }
								} else {
								?>
									<blockquote>
										<!-- excerpt -->
										<?php if (empty($cmb_excerpt)) { echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>
										<?php if (!empty($cmb_byline)) { printf('<cite>- %s</cite>', esc_attr($cmb_byline)); } ?>
									</blockquote>
								<?php
								}
								if ($cmb_timeline_link_through == "checked") { printf('<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
							?>
							
						</div>
					</li>
				<?php
				}
				//END QUOTE POST


				//GALLERY POST
				if ( ($post_format == "gallery") ) {

					// HANDLE POST SLIDER
					$consolidated_slider_array = array();

					$cmb_post_slider_source = get_post_meta( $this_post->ID, 'cmb_post_slider_source', true);
					$post_slider_array = mb_strip_wp_galleries_to_array($cmb_post_slider_source);
					$consolidated_slider_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);

					$gallery_class_array = array('fourth', 'fourth last-fold', 'fourth', 'fourth last');
					$times_to_repeat = 4;

				?>
					<li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
						<div class="milestone-container">
							
							<!-- datetime -->
							<h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>

							<!-- title -->
							<?php 
								if ($cmb_timeline_link_through == "checked") {
									  printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
								} else {
									  printf('<h3>%s</h3>',esc_attr($this_post->post_title));
								}
							?>

							<div class="clearfix gallery">
								<?php 

									if (empty($consolidated_slider_array)) {
										
										if ($has_feature) {

											// same as standard feature
											if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
												echo $cmb_media_link;
											} elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id($this_post->ID)) ) {
												echo '<div class="mosaic-block fade">';
												$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
												$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
												printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
												printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
												echo '</div>';
											} elseif (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
												echo '<div class="mosaic-block fade">';
												$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
												$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
												$img_post = get_post(get_post_thumbnail_id($this_post->ID));
												printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
												printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
												echo '</div>';
											}
										}
											
									} else {
											
										for ($n = 0; $n < $times_to_repeat; $n++) { 
											if (isset($consolidated_slider_array[$n])) {
												$post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$n]['id'],'timeline_gallery_thumb_x2');
												$img_alt = get_post_meta($consolidated_slider_array[$n]['id'], '_wp_attachment_image_alt', true);
												$img_post = get_post($consolidated_slider_array[$n]['id']);

												printf('<span class="%s"><img src="%s" alt="%s" /></span>', esc_attr($gallery_class_array[$n]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
											} 
										}

										
									}

								?>

							</div>  

							<!-- excerpt/content -->
							<?php 

								if ($cmb_timeline_display_content == "checked") {
									echo do_shortcode($this_post->post_content);
								} else {
									if (empty($cmb_excerpt)) { 
										echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); 
									} else {
										echo do_shortcode($cmb_excerpt);
									}  
								}
								if ($cmb_timeline_link_through == "checked") { printf('&#8230;<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
							?>
						</div>
					</li>
					
				<?php
				}
		   }
		   //copy/paste end



		}

		die();
	}



/**************************************
REMOVE THEME SETTINGS FOR NON-ADMINS
***************************************/


	function hide_theme_settings_from_non_admins(){

		if (!current_user_can('switch_themes')) {
			remove_menu_page('handle_canon_options');
		}
	  
	}


/**************************************
UNREGISTER TIMETABLE WIDGETS
***************************************/

	function unregister_timetable_widgets() {
		unregister_widget('upcoming_events_widget');
	}


/**************************************
FILTER WORDPRESS MENUS
***************************************/


	function canon_filter_wp_menus( $items, $args ) {

		// GET OPTIONS
		$canon_options_frame = get_option('canon_options_frame');

		// var_dump($args);
		// var_dump($items);

		if ($canon_options_frame['add_search_btn_to_primary'] == "checked") {
			if ($args->theme_location == "primary_menu") {
				$items .= '<li class="menu-item menu-item-type-canon toolbar-search-btn"><a href="#"><i class="fa fa-search"></i></a></li>';
			}	
		}

		if ($canon_options_frame['add_search_btn_to_secondary'] == "checked") {
			if ($args->theme_location == "secondary_menu") {
				$items .= '<li class="menu-item menu-item-type-canon toolbar-search-btn"><a href="#"><i class="fa fa-search"></i></a></li>';
			}	
		}

		return $items;
	}


/**************************************
FILTER SEARCH QUERY
***************************************/

	function canon_filter_search_query($query) {
	
		if ($query->is_search && !is_admin()) {

        	// BBPRESS BOUNCER
        	if (class_exists('bbPress')) { if (is_bbpress()) return; }

			// GET OPTIONS
			$canon_options_post = get_option('canon_options_post');

			// DEFAULTS
			if (!isset($canon_options_post['search_posts'])) { $canon_options_post['search_posts'] = "checked"; }
			if (!isset($canon_options_post['search_pages'])) { $canon_options_post['search_pages'] = "unchecked"; }
			if (!isset($canon_options_post['search_cpt'])) { $canon_options_post['search_cpt'] = "unchecked"; }

			// BOUNCE IF SPECIFIC SEARCH IS NOT WANTED
			if ($canon_options_post['search_posts'] == "unchecked" && $canon_options_post['search_pages'] == "unchecked" && $canon_options_post['search_cpt'] == "unchecked") return;

			$post_type_array = array();

			if ($canon_options_post['search_posts'] == "checked") { array_push($post_type_array, 'post'); }
			if ($canon_options_post['search_pages'] == "checked") { array_push($post_type_array, 'page'); }
			
			if ($canon_options_post['search_cpt'] == "checked") { 
				$search_cpt_source_array = explode(',', $canon_options_post['search_cpt_source']);
				foreach ($search_cpt_source_array as $key => $slug) {
					$slug = trim($slug);
					if (!empty($slug)) {
						array_push($post_type_array, $slug); 
					}
				}
			}

			$query->set('post_type', $post_type_array);

		}

		return $query;
	}


/**************************************
LEGACY TITLE TAG 
***************************************/


	if (!function_exists('_wp_render_title_tag')) {

		// render legacy title
		add_action( 'wp_head', 'canon_render_legacy_title' );

		// filter wp_title
		add_filter( 'wp_title', 'canon_filter_wp_title', 10, 2 );


		/**************************************
		RENDER LEGACY TITLE
		***************************************/

			if (!function_exists("canon_render_legacy_title")) { function canon_render_legacy_title() {	
			
				?><title><?php wp_title( '|', true, 'right' ); ?></title><?php

			}}
		

		/**************************************
				***************************************/


			if (!function_exists("canon_filter_wp_title")) { function canon_filter_wp_title( $title, $sep ) {	
				if ( is_feed() ) {
					return $title;
				}
				
				global $page, $paged;

				// Add the blog name
				$title .= get_bloginfo( 'name', 'display' );

				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) ) {
					$title .= " $sep $site_description";
				}

				// Add a page number if necessary:
				if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
					$title .= " $sep " . sprintf('%s %s', esc_html__("Page", "loc_canon_profiles"), esc_attr(max( $paged, $page )) );
				}

				return $title;

			}}

	}


/**************************************
BUNDLED PLUGINS AUTOMATIC UPDATE CHECKER
***************************************/

	if (!function_exists("init_canon_auc")) { function init_canon_auc() {	
	    new canon_auc();
	}}

	class canon_auc {

		// CONSTRUCT
		function __construct() {
			add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_updates'));	
			add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
		}


		public function check_updates($transient) {

			$tgm_plugins = canon_get_tgm_plugins_array();
			$all_plugins = get_plugins();

			// first check if plugin auc is set to true
			foreach ($tgm_plugins as $key => $tgm_plugin) {
				if (isset($tgm_plugin['canon_auc'])) { if ($tgm_plugin['canon_auc']) {

					// skip if tgm plugin is not currently installed
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					if (!isset($all_plugins[$tgm_plugin_file])) { continue; }

					// get current plugin version
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					$tgm_plugin_current_version = $all_plugins[$tgm_plugin_file]['Version'];

					// get latest version
					$tgm_plugin_latest_version = $tgm_plugin['version'];

					// compare and add to transient if newer version is found			
					if (version_compare($tgm_plugin_current_version, $tgm_plugin_latest_version, "<")) {

						$tgm_plugin_slug = $tgm_plugin['slug'];
						$tgm_plugin_source = $tgm_plugin['source'];

				        $obj = new stdClass();
				        $obj->slug = $tgm_plugin_slug;
				        $obj->plugin = $tgm_plugin_file;
				        $obj->new_version = $tgm_plugin_latest_version;
				        $obj->url = $tgm_plugin_source;
				        $obj->package = $tgm_plugin_source;
				        $transient->response[$tgm_plugin_file] = $obj;

					}

				}}

			}	

			// var_dump($transient);
	        return $transient;

		}	


		public function check_info($false, $action, $arg) {
			
			$tgm_plugins = canon_get_tgm_plugins_array();
			$all_plugins = get_plugins();


			foreach ($tgm_plugins as $key => $tgm_plugin) {
				if (isset($tgm_plugin['canon_auc'])) { if ($tgm_plugin['canon_auc']) {

					// skip if tgm plugin is not currently installed
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					if (!isset($all_plugins[$tgm_plugin_file])) { continue; }

					// if match then edit info
					$tgm_plugin_slug = $tgm_plugin['slug'];

				    if (isset($arg->slug)) { if ($arg->slug === $tgm_plugin_slug) {

						// build new info
						$obj = new stdClass();
						$obj->name = (isset($tgm_plugin['canon_auc_info']['name'])) ? $tgm_plugin['canon_auc_info']['name'] : $tgm_plugin['name'];
						$obj->slug = (isset($tgm_plugin['canon_auc_info']['slug'])) ? $tgm_plugin['canon_auc_info']['slug'] : $tgm_plugin['slug'];
						$obj->requires = (isset($tgm_plugin['canon_auc_info']['requires'])) ? $tgm_plugin['canon_auc_info']['requires'] : "3.0";
						$obj->tested = (isset($tgm_plugin['canon_auc_info']['tested'])) ? $tgm_plugin['canon_auc_info']['tested'] : "4.2";
						$obj->last_updated = (isset($tgm_plugin['canon_auc_info']['last_updated'])) ? $tgm_plugin['canon_auc_info']['last_updated'] : "";
						$obj->sections = (isset($tgm_plugin['canon_auc_info']['sections'])) ? $tgm_plugin['canon_auc_info']['sections'] : array('description' => 'Bundled plugin.');
						$obj->download_link = 'http://localhost/update.php';
						$obj->version = (isset($tgm_plugin['canon_auc_info']['version'])) ? $tgm_plugin['canon_auc_info']['version'] : $tgm_plugin['version'];
						$obj->author = (isset($tgm_plugin['canon_auc_info']['author'])) ? $tgm_plugin['canon_auc_info']['author'] : "";
						// $obj->plugin_name = $tgm_plugin['name'];
						// $obj->downloaded = 12540;

				        $information = $obj;
				        return $information;
				    }}

				}}
			}

		    return false;

		}	

	}	// end class
