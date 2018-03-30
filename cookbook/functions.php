<?php

/**************************************
INDEX

PHP INCLUDES
WP ENQUEUE
SETUP THEME
	ADD ACTIONS
	ADD FILTERS
	ADD_THEME_SUPPORT CALLS
	IMAGE SIZES
	REGISTER MENUS
	LOCALIZATION INIT
REGISTER WIDGET AREAS
	REGISTER THEME WIDGET AREAS
	REGISTER CUSTOM WIDGET AREAS
MEDIA UPLOAD CUSTOMIZE
REMOVE THEME SETTINGS FOR NON-ADMINS
FILTER WORDPRESS MENUS
FILTER SEARCH QUERY
SET THEME COOKIE
MAINTENANCE MODE REMINDER
LEGACY TITLE TAG 

***************************************/

/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions/functions_custom.php';
	include 'inc/functions/functions_tgm.php';
	include 'inc/functions/functions_ajax.php';
	include 'inc/functions/functions_font_awesome.php';
	include 'inc/functions/functions_google_webfonts.php';
	include 'inc/functions/functions_royalslider.php';
	
	// framework
	include 'inc/framework/fw_index.php';

	// options
	include 'inc/options/options_general_control.php';
	include 'inc/options/options_frame_control.php';
	include 'inc/options/options_post_control.php';
	include 'inc/options/options_appearance_control.php';
	include 'inc/options/options_advanced_control.php';
	include 'inc/options/options_help_control.php';

	// dynamic css
	include 'inc/templates/dynamic_css.php';


/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	if (!function_exists("canon_load_to_front")) { function canon_load_to_front() {	

		// get options
		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_post = get_option('canon_options_post');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

		// dev mode options
		if ($canon_options['dev_mode'] == "checked") {
			if (isset($_GET['use_boxed_design'])) { $canon_options['use_boxed_design'] = wp_filter_nohtml_kses($_GET['use_boxed_design']); }
			if (isset($_GET['anim_menus'])) { $canon_options_appearance['anim_menus'] = wp_filter_nohtml_kses($_GET['anim_menus']); }
		}

		// wp scripts
		wp_enqueue_script('jquery', false, array(), false, true);
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui', false, array(), false, true);
		wp_enqueue_script('jquery-ui-autocomplete', false, array(), false, true);

		// external scripts
		wp_enqueue_script('canon-fancybox-core', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), false, true);
		wp_enqueue_script('canon-fancybox-mousewheel', get_template_directory_uri() . '/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'), false, true);
		wp_enqueue_script('canon-fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.js', array('canon-fancybox-core'), false, true);
		wp_enqueue_script('canon-fancybox-media', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-media.js', array('canon-fancybox-core'), false, true);
		
		wp_enqueue_script('canon-isotope', get_template_directory_uri(). '/js/isotope.pkgd.min.js', array(), false, true);
		wp_enqueue_script('canon-imagesloaded', get_template_directory_uri(). '/js/imagesloaded.pkgd.min.js', array(), false, true);
		wp_enqueue_script('canon-flexslider', get_template_directory_uri(). '/js/jquery.flexslider-min.js', array(), false, true);
		wp_enqueue_script('canon-fitvids', get_template_directory_uri(). '/js/fitvids.min.js', array(), false, true);
		wp_enqueue_script('canon-sidr', get_template_directory_uri(). '/js/jquery.sidr.js', array(), false, true);
		wp_enqueue_script('canon-placeholder', get_template_directory_uri(). '/js/placeholder.js', array(), false, true);
		wp_enqueue_script('canon-mosaic', get_template_directory_uri(). '/js/mosaic.1.0.1.min.js', array(), false, true);
		wp_enqueue_script('canon-cleantabs', get_template_directory_uri(). '/js/cleantabs.jquery.js', array(), false, true);
		wp_enqueue_script('canon-stellar', get_template_directory_uri(). '/js/jquery.stellar.min.js', array(), false, true);
		wp_enqueue_script('canon-scrollup', get_template_directory_uri(). '/js/jquery.scrollUp.min.js', array(), false, true);
		wp_enqueue_script('canon-selectivizr', get_template_directory_uri(). '/js/selectivizr-min.js', array(), false, true);
		wp_enqueue_script('canon-countdown', get_template_directory_uri(). '/js/jquery.countdown.min.js', array(), false, true);
		wp_enqueue_script('canon-fittext', get_template_directory_uri(). '/js/fittext.js', array(), false, true);
		wp_enqueue_script('canon-owl-carousel', get_template_directory_uri(). '/js/owl-carousel/canon.owl.carousel.js', array(), false, true);
		wp_enqueue_script('canon-scrollreveal', get_template_directory_uri(). '/js/scrollReveal.js', array(), false, true);

		// canon scripts
		wp_enqueue_script('canon-global-functions', get_template_directory_uri(). '/js/global_functions.js', array(), false, true);
		wp_enqueue_script('canon-custom-scripts', get_template_directory_uri(). '/js/custom-scripts.js', array(), false, true);
		wp_enqueue_script('canon-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true);


		// support for threaded comments
		if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
		
		// styles (css)
		wp_enqueue_style('canon-normalize', get_template_directory_uri(). '/css/normalize.min.css');

		wp_enqueue_style('canon-flexslider-style', get_template_directory_uri(). '/css/flexslider.css');
		wp_enqueue_style('canon-font-awesome-style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('canon-owl-carousel-style', get_template_directory_uri(). '/js/owl-carousel/owl.carousel.css');
		wp_enqueue_style('canon-mosaic-style', get_template_directory_uri(). '/css/mosaic.css');
		wp_enqueue_style('canon-sidr-style', get_template_directory_uri(). '/css/jquery.sidr.light.css');
		wp_enqueue_style('canon-fancybox-style', get_template_directory_uri(). '/js/fancybox/jquery.fancybox.css');
		wp_enqueue_style('canon-fancybox-buttons-style', get_template_directory_uri(). '/js/fancybox/helpers/jquery.fancybox-buttons.css');
		
		if (class_exists('Woocommerce')) { wp_enqueue_style('canon-woo-shop-style', get_template_directory_uri(). '/css/woo-shop.css'); }	// enqueue theme woocommerce style
		if (function_exists('bp_is_active')) { wp_enqueue_style('canon-budypress-style', get_template_directory_uri(). '/css/budypress-style.css'); }
		if (class_exists('bbPress')) { wp_enqueue_style('canon-bbpress-style', get_template_directory_uri(). '/css/bbpress-style.css'); }
		
		wp_enqueue_style('canon-composer-theme-style', get_template_directory_uri(). '/css/composer-theme-style.css', array('js_composer_front'));
		wp_enqueue_style('js_composer_custom_css', false, array('canon-composer-theme-style'));


		// core theme styles
		wp_enqueue_style('style', get_stylesheet_uri());
		if (isset($canon_options['use_responsive_design'])) { if ($canon_options['use_responsive_design'] == "checked") { wp_enqueue_style('responsive_style', get_template_directory_uri(). '/css/responsive.css'); } }
		if (isset($canon_options['use_boxed_design'])) { if ($canon_options['use_boxed_design'] == "checked") { wp_enqueue_style('boxed_style', get_template_directory_uri(). '/css/boxed.css'); } else { wp_enqueue_style('fullwidth_style', get_template_directory_uri(). '/css/full.css'); } }

		// dynamic_css printout
		add_action('wp_print_scripts','canon_dynamic_css');

		// localize sripts
		wp_localize_script('canon-scripts','extData', array(
			'ajaxUrl' 					=> admin_url('admin-ajax.php'), 
			'pageType'					=> mb_get_page_type(), 
			'templateURI' 				=>  get_template_directory_uri(), 
			'canonOptions' 				=> $canon_options,
			'canonOptionsFrame' 		=> $canon_options_frame,
			'canonOptionsPost' 			=> $canon_options_post,
			'canonOptionsAppearance' 	=> $canon_options_appearance,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		)); 
	
	}}

	//back end includes
	if (!function_exists("canon_load_to_back")) { function canon_load_to_back() {	

		// get options
		$canon_options = get_option('canon_options');
		$canon_options_advanced = get_option('canon_options_advanced');

		// wp scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('thickbox', false, array(), false, true);					
		wp_enqueue_script('media-upload', false, array(), false, true);

		// external scripts
		wp_enqueue_script('canon-admin-colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('canon-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array(), false, true);

		// style (css)	
		wp_enqueue_style('thickbox');
		wp_enqueue_style('canon-admin-style', get_template_directory_uri(). '/css/admin-style.css');
		wp_enqueue_style('canon-admin-font-awesome-style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('canon-admin-colorpicker-style', get_template_directory_uri(). '/css/colorpicker.css');

		// localize sripts
		wp_localize_script('canon-admin-scripts','extData', array(
			'templateURI'				=> get_template_directory_uri(), 
			'ajaxURL'					=> admin_url('admin-ajax.php'),
			'canonOptions'				=> $canon_options,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		));        

		if ( strpos(get_current_screen()->id, 'canon_options_appearance') !== false ) wp_localize_script('canon-admin-scripts','extDataFonts', array('fonts' => mb_get_google_webfonts()));        
	}}



/**************************************
SETUP THEME
***************************************/
	
	add_action( 'after_setup_theme', 'canon_setup_theme' );

	if (!function_exists("canon_setup_theme")) { function canon_setup_theme() {	

	/**************************************
	GET OPTIONS
	***************************************/

		$canon_options = get_option('canon_options'); 
		$canon_options_advanced = get_option('canon_options_advanced'); 


	/**************************************
	ADD ACTIONS
	***************************************/

		// front end includes
		add_action('wp_enqueue_scripts','canon_load_to_front');

		// back end includes
		add_action('admin_enqueue_scripts', 'canon_load_to_back');  

		// register widget areas
		add_action('widgets_init', 'canon_register_widget_areas');  

		// add post views counter to all posts
		add_action('wp_head', 'mb_update_post_views_single_check' );

		// media upload customize
		add_action('admin_init', 'canon_check_upload_page');

		// hide theme settings from non-admins
		add_action('admin_menu', 'hide_theme_settings_from_non_admins');

		// maintenance mode reminder
		if ($canon_options['use_maintenance_mode'] == "checked") { add_action('admin_notices','canon_maintenance_mode_reminder'); }


	/**************************************
	ADD FILTERS
	***************************************/

		// disable woocommerce default styles
		if (class_exists('Woocommerce')) { add_filter( 'woocommerce_enqueue_styles', '__return_false' ); }

		// make shortcodes execute in widget texts
		add_filter('widget_text', 'do_shortcode');

		// filter wordpress menus
		add_filter( 'wp_nav_menu_items', 'canon_filter_wp_menus', 10, 2);

		// filter search query
		add_filter('pre_get_posts','canon_filter_search_query');

	/**************************************
	ADD_THEME_SUPPORT CALLS
	***************************************/

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support('automatic-feed-links');

		// This theme uses Featured Images
		add_theme_support('post-thumbnails');

		//post formats
		add_theme_support('post-formats', array('quote','gallery','video','audio'));

		// woocommerce
		add_theme_support('woocommerce');

		// visual composer set as theme and disable updater
		if (function_exists('vc_set_as_theme')) { vc_set_as_theme($disable_updater = true); }

		// visual composer disable front end
		// if (function_exists('vc_disable_frontend')) { vc_disable_frontend(); }

		// title tag
		add_theme_support('title-tag');

	/**************************************
	IMAGE SIZES
	***************************************/

		add_image_size( 'small_square_thumb', 130, 130, true);

		//set general content width
		if (!isset($content_width)) $content_width = 1080;

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


	}}	// end canon_setup_theme


/**************************************
REGISTER WIDGET AREAS
***************************************/

	if (!function_exists("canon_register_widget_areas")) { function canon_register_widget_areas() {	

	/**************************************
	REGISTER THEME WIDGET AREAS
	***************************************/

		// SIDEBARS
		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_archive_sidebar_widget_area",
				'name' => 'Post/Archive Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_page_sidebar_widget_area",
				'name' => 'Page Sidebar Widget Area',  
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
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


	/**************************************
	REGISTER CUSTOM WIDGET AREAS
	***************************************/

		$canon_options_advanced = get_option('canon_options_advanced'); 

		if (isset($canon_options_advanced['custom_widget_areas'])) {
			for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  

				if (isset($canon_options_advanced['custom_widget_areas'][$i])) {
					
					$cwa_name = $canon_options_advanced['custom_widget_areas'][$i];
					$cwa_slug = mb_create_slug($cwa_name);

					if (function_exists('register_sidebar') && !empty($cwa_name)) {
						register_sidebar(array(  
							'id' => 'canon_cwa_' . $cwa_slug,
							'name' => $cwa_name,  
							'before_widget' => '<div id="%1$s" class="widget %2$s">',  
							'after_widget' => '</div>',  
							'before_title' => '<h3 class="widget-title">',  
							'after_title' => '</h3>'
						)); 
					 }
						
				}

			}	
		}


	}}	// end function canon_register_widget_areas




/**************************************
MEDIA UPLOAD CUSTOMIZE
***************************************/

	if (!function_exists("canon_check_upload_page")) { function canon_check_upload_page() {	
		global $pagenow;
		if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
			// Now we'll replace the 'Insert into Post Button' inside Thickbox
			add_filter( 'gettext', 'canon_replace_thickbox_text', 1, 3 );
		}
    }}

	if (!function_exists("canon_replace_thickbox_text")) { function canon_replace_thickbox_text($translated_text, $text, $domain) {	
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
    }}


/**************************************
REMOVE THEME SETTINGS FOR NON-ADMINS
***************************************/


	if (!function_exists("hide_theme_settings_from_non_admins")) { function hide_theme_settings_from_non_admins() {	

		if (!current_user_can('switch_themes')) {
			remove_menu_page('handle_canon_options');
		}
	  
    }}


/**************************************
FILTER WORDPRESS MENUS
***************************************/


	if (!function_exists("canon_filter_wp_menus")) { function canon_filter_wp_menus( $items, $args ) {	

		// GET OPTIONS
		$canon_options_frame = get_option('canon_options_frame');

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

	}}


/**************************************
FILTER SEARCH QUERY
***************************************/

	if (!function_exists("canon_filter_search_query")) { function canon_filter_search_query($query) {	

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
        
    }}


/**************************************
SET THEME COOKIE
***************************************/

    add_action('init','set_cookbook_cookie'); 

	if (!function_exists("set_cookbook_cookie")) { function set_cookbook_cookie() {	
    	if (!isset($_COOKIE['cookbook_cookie'])) {
            setcookie('cookbook_cookie', "user-ratings=", time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);    
        }
    }}


/**************************************
MAINTENANCE MODE REMINDER
***************************************/

	if (!function_exists("canon_maintenance_mode_reminder")) { function canon_maintenance_mode_reminder() {	
		printf('<div class="error"><p>%s</p></div>', __('Maintenance mode is on - remember that only logged-in users will be able to see your site pages. Go to <i>Settings > General > Maintenance Mode</i> to disable.','loc_canon'));
    }}
	
	
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
		FILTER WORDPRESS TITLE
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
					$title .= " $sep " . sprintf('%s %s', __("Page", "loc_canon"), esc_attr(max( $paged, $page )) );
				}

				return $title;

			}}

	}


