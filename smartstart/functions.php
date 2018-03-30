<?php

/* ---------------------------------------------------------------------- */
/*	Basic Theme Settings
/* ---------------------------------------------------------------------- */

define( 'SS_BASE_DIR', TEMPLATEPATH . '/' );
define( 'SS_BASE_URL', get_template_directory_uri() . '/' );

if( !isset( $content_width ) )
	$content_width = 680;

if( !function_exists('ss_framework_setup') ) {

	function ss_framework_setup() {

		// Editor style
		add_editor_style('css/editor-style.css');

		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		// Post thumbnails
		add_theme_support('post-thumbnails');

		add_image_size( 'blog-post', 680, null, true );
		add_image_size( 'blog-post-thumb', 300, null, true );
		add_image_size( 'portfolio-one-half', 460, 292, true );
		add_image_size( 'portfolio-one-third', 300, 190, true );
		add_image_size( 'portfolio-one-fourth', 220, 140, true );
		add_image_size( 'fullwidth', 940, null, true );

		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');

		// Make theme available for translation
		load_theme_textdomain( 'ss_framework', SS_BASE_DIR . 'languages' );

		$locale = get_locale();
		$locale_file = SS_BASE_DIR . "languages/$locale.php";

		if( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary_nav' => __( 'Primary Navigation', 'ss_framework' ),
			'foofer_nav'  => __( 'Footer Navigation', 'ss_framework' )
		) );

	}
}
add_action('after_setup_theme', 'ss_framework_setup');

/* ---------------------------------------------------------------------- */
/*	Load Parts
/* ---------------------------------------------------------------------- */

// Add theme options
include( SS_BASE_DIR . 'functions/admin.php' );

// Add meta boxes
include( SS_BASE_DIR . 'functions/meta-box/class.php' );
include( SS_BASE_DIR . 'functions/meta-boxes.php' );

// Add widgets
include( SS_BASE_DIR . 'functions/widgets.php' );

// Add shortcodes
include( SS_BASE_DIR . 'functions/shortcodes.php' );

// Add custom functions
include( SS_BASE_DIR . 'functions/custom-functions.php' );

// Add custom post types
include( SS_BASE_DIR . 'functions/custom-post-types.php' );

// Automatic plugin activation
include( SS_BASE_DIR . 'functions/plugin-activation.php' );

// Theme updates notifier
include( SS_BASE_DIR . 'functions/update-notifier.php' );

/* ---------------------------------------------------------------------- */
/*	Required/recommended plugins
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_register_required_plugins') ) {

	function ss_framework_register_required_plugins() {

		$plugins = array(

			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false
			),
			array(
				'name'     => 'Google Maps made Simple',
				'slug'     => 'wp-gmappity-easy-google-maps',
				'required' => false
			)


		);

		$config = array(
			'domain'       		=> 'ss_framework',         		// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       	=> __( 'Install Required Plugins', 'ss_framework' ),
				'menu_title'                       	=> __( 'Install Plugins', 'ss_framework' ),
				'installing'                       	=> __( 'Installing Plugin: %s', 'ss_framework' ), // %1$s = plugin name
				'oops'                             	=> __( 'Something went wrong with the plugin API.', 'ss_framework' ),
				'notice_can_install_required'     	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  			=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 				=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 				=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  	=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  	=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           	=> __( 'Return to Required Plugins Installer', 'ss_framework' ),
				'plugin_activated'                 	=> __( 'Plugin activated successfully.', 'ss_framework' ),
				'complete' 							=> __( 'All plugins installed and activated successfully. %s', 'ss_framework' ), // %1$s = dashboard link
				'nag_type'							=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );

	}
	add_action('tgmpa_register', 'ss_framework_register_required_plugins');
	
}

/* ---------------------------------------------------------------------- */
/*	Theme styles
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_register_styles') ) {

	function ss_framework_register_styles() {

		if( !is_admin() ) {
			wp_register_style( 'ss-theme-styles', get_stylesheet_directory_uri() . '/style.css', null, false );

			if( of_get_option('ss_main_heading_font') )
				wp_register_style( 'ss-main-heading-font',       'http://fonts.googleapis.com/css?family=' . of_get_option('ss_main_heading_font'), null, false );

			if( of_get_option('ss_blockquote_heading_font') )
				wp_register_style( 'ss-blockquote-heading-font', 'http://fonts.googleapis.com/css?family=' . of_get_option('ss_blockquote_heading_font'), null, false );

			wp_register_style( 'fancybox',      SS_BASE_URL . 'css/jquery.fancybox.min.css', null, false );
			wp_register_style( 'video-js',      SS_BASE_URL . 'css/video-js.min.css',        null, false );
			wp_register_style( 'audioplayerv1', SS_BASE_URL . 'css/audioplayerv1.min.css',   null, false );
		}

	}
	add_action('init', 'ss_framework_register_styles');
	
}

if ( !function_exists('ss_framework_enqueue_styles') ) {

	function ss_framework_enqueue_styles() {

		if( !is_admin() ) {
			wp_enqueue_style('ss-theme-styles');

			if( of_get_option('ss_main_heading_font') )
				wp_enqueue_style('ss-main-heading-font');

			if( of_get_option('ss_blockquote_heading_font') )
				wp_enqueue_style('ss-blockquote-heading-font');

			wp_enqueue_style('fancybox');
			wp_enqueue_style('video-js');
			wp_enqueue_style('audioplayerv1');

			// Remove contact form 7 default styles
			wp_deregister_style('contact-form-7');
		}

	}
	add_action('wp_print_styles', 'ss_framework_enqueue_styles');

}

/* ---------------------------------------------------------------------- */
/*	Theme scripts
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_register_scripts') ) {

	function ss_framework_register_scripts() {

		if( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script( 'jquery',   'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), '1.7.2', false );

			wp_register_script( 'modernizr_custom',  SS_BASE_URL . 'js/modernizr.custom.js',                    array(), false, false );
			wp_register_script( 'video-js',          SS_BASE_URL . 'js/video-js.min.js',                        array(), false, false );
			wp_register_script( 'selectivizr',       SS_BASE_URL . 'js/selectivizr-and-extra-selectors.min.js', array('jquery'), false, true );
			wp_register_script( 'respond',           SS_BASE_URL . 'js/respond.min.js',                         array('jquery'), false, true );
			wp_register_script( 'easing',            SS_BASE_URL . 'js/jquery.easing-1.3.min.js',               array('jquery'), false, true );
			wp_register_script( 'fancybox',          SS_BASE_URL . 'js/jquery.fancybox.pack.js',                array('jquery'), false, true );
			wp_register_script( 'cycle',             SS_BASE_URL . 'js/jquery.cycle.all.min.js',                array('jquery'), false, true );
			wp_register_script( 'smartstart-slider', SS_BASE_URL . 'js/jquery.smartStartSlider.min.js',         array('jquery'), false, true );
			wp_register_script( 'isotope',           SS_BASE_URL . 'js/jquery.isotope.min.js',                  array('jquery'), false, true );
			wp_register_script( 'jcarousel',         SS_BASE_URL . 'js/jquery.jcarousel.min.js',                array('jquery'), false, true );
			wp_register_script( 'audioplayerv1',     SS_BASE_URL . 'js/audioplayerv1.min.js',                   array('jquery'), false, true );
			wp_register_script( 'touch_swipe',       SS_BASE_URL . 'js/jquery.touchSwipe.min.js',               array('jquery'), false, true );
			wp_register_script( 'custom_scripts',    SS_BASE_URL . 'js/custom.js',                              array('jquery'), false, true );
		}

	}
	add_action('init', 'ss_framework_register_scripts');
	
}

if ( !function_exists('ss_framework_enqueue_scripts') ) {

	function ss_framework_enqueue_scripts() {

		global $pagenow, $is_IE;

		if( !is_admin() && $pagenow !== 'wp-login.php' ) {

			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('modernizr_custom');
			wp_enqueue_script('video-js');

			// For Internet Explorer
			if( $is_IE )
				wp_enqueue_script('selectivizr');

			wp_enqueue_script('respond');
			wp_enqueue_script('easing');
			wp_enqueue_script('fancybox');
			wp_enqueue_script('cycle');
			wp_enqueue_script('smartstart-slider');
			wp_enqueue_script('isotope');
			wp_enqueue_script('jcarousel');
			wp_enqueue_script('audioplayerv1');
			wp_enqueue_script('touch_swipe');
			wp_enqueue_script('custom_scripts');

			if ( is_singular() && get_option('thread_comments') && comments_open() )
				wp_enqueue_script('comment-reply'); 
		}

	}
	add_action('wp_print_scripts', 'ss_framework_enqueue_scripts');
	
}

if ( !function_exists('ss_framework_contact_form_loader') ) {

	// Change Contact Form 7 ajax loader
	function ss_framework_contact_form_loader() {

		return SS_BASE_URL . 'images/loader.gif';

	}
	add_filter('wpcf7_ajax_loader', 'ss_framework_contact_form_loader');
	
}

if ( !function_exists('ss_framework_admin_scripts') ) {

	// Backend Scripts
	function ss_framework_admin_scripts( $hook ) {

		if( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_register_script( 'tinymce_scripts', SS_BASE_URL . 'functions/tinymce/js/scripts.js', array('jquery'), false, true );
			wp_enqueue_script('tinymce_scripts');
		}

	}
	add_action('admin_enqueue_scripts', 'ss_framework_admin_scripts');
	
}

/* ---------------------------------------------------------------------- */
/*	Filter Hooks
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_filter_wp_title') ) {

	// Makes some changes to the <title> tag, by filtering the output of wp_title()
	function ss_framework_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;

		global $paged, $page;

		if ( is_search() ) {
			$title = sprintf(__('Search results for %s', 'ss_framework'), '"' . get_search_query() . '"');

			if ( $paged >= 2 )
				$title .= " $separator " . sprintf(__('Page %s', 'ss_framework'), $paged);

			$title .= " $separator " . get_bloginfo('name', 'display');

			return $title;
		}

		$title .= get_bloginfo('name', 'display');
		$site_description = get_bloginfo('description', 'display');

		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $separator " . $site_description;

		if ( $paged >= 2 || $page >= 2)
			$title .= " $separator " . sprintf(__('Page %s', 'ss_framework'), max($paged, $page) );

		return $title;

	}
	add_filter('wp_title', 'ss_framework_filter_wp_title', 10, 2);
	
}

if ( !function_exists('ss_framework_comments_form_defaults') ) {

	// Modify comments form fields
	function ss_framework_comments_form_defaults( $defaults ) {

		$commenter = wp_get_current_commenter();

		$req = get_option( 'require_name_email' );

		$aria_req = ( $req ? " aria-required='true' required" : '' );

		$defaults['fields']['author'] = '<p class="comment-form-author input-block"><label for="author"><strong>' . __( 'Name', 'ss_framework' ) . '</strong>' . ( $req ? ' (' . __( 'required', 'ss_framework' ) . ')' : '' ) . '</label>' .
						 '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

		$defaults['fields']['email'] = '<p class="comment-form-email input-block"><label for="email"><strong>' . __( 'Email', 'ss_framework' ) . '</strong>' . ( $req ? ' (' . __( 'required', 'ss_framework' ) . ')' : '' ) . '</label>' .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

		$defaults['fields']['url'] = '<p class="comment-form-url input-block"><label for="url"><strong>' . __( 'Website', 'ss_framework' ) . '</strong></label>' .
					  '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

		$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment"><strong>' . __( 'Your Comment', 'ss_framework' ) . '</strong></label>' .
									 '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

		$defaults['comment_notes_before'] = '';

		$defaults['cancel_reply_link'] = ' - ' . __( 'Cancel reply', 'ss_framework' );

		$defaults['title_reply'] = __( 'Leave a Comment', 'ss_framework' );

		return $defaults;

	}
	add_filter('comment_form_defaults', 'ss_framework_comments_form_defaults');
	
}

if ( !function_exists('ss_framework_page_menu_args') ) {

	// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
	function ss_framework_page_menu_args( $args ) {

		$args['show_home'] = true;

		return $args;

	}
	add_filter('wp_page_menu_args', 'ss_framework_page_menu_args');
	
}

if ( !function_exists('ss_framework_excerpt_length') ) {

	// Sets the post excerpt length to 40 words (or 20 words if post carousel)
	function ss_framework_excerpt_length( $length ) {

		if( isset( $GLOBALS['post-carousel'] ) )
			return 20;

		return 40;

	}
	add_filter('excerpt_length', 'ss_framework_excerpt_length');
	
}

if ( !function_exists('ss_framework_auto_excerpt_more') ) {

	// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis
	function ss_framework_auto_excerpt_more( $more ) {

		return '&hellip;';

	}
	add_filter('excerpt_more', 'ss_framework_auto_excerpt_more');
	
}

if ( !function_exists('ss_framework_remove_gallery_css') ) {

	// Remove inline styles printed when the gallery shortcode is used
	function ss_framework_remove_gallery_css($css) {

		return preg_replace('#<style type="text/css">(.*?)</style>#s', '', $css);

	}
	add_filter('gallery_style', 'ss_framework_remove_gallery_css');
	
}

if ( !function_exists('ss_custom_password_form') ) {

	// Styles for password protected page
	function ss_custom_password_form() {

		global $post, $wp_version;

		$password_ID = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		
		$action_url = esc_url( site_url('wp-login.php?action=postpass', 'login_post') );
		
		// Fix URL for older WP versions
		if( $wp_version < '3.4' )
			$action_url = get_option('siteurl') . '/wp-pass.php';

		return '<form class="entry-form" action="' . $action_url . '" method="post">
					<label for="' . $password_ID . '">' . __('This post is password protected. To view it please enter your password below:', 'ss_framework') . '</label>
					<p><input name="post_password" id="' . $password_ID . '" type="password" type="text"></p>
					<p><input name="Submit" value="' . __('Submit', 'ss_framework') . '" type="submit"></p>
				</form>';

	}
	add_filter('the_password_form', 'ss_custom_password_form');
	
}

if ( !function_exists('ss_framework_sllow_slider_img_insertion') ) {

	// Enable 'Send to Editor' button in all cases
	function ss_framework_sllow_slider_img_insertion( $vars ) {

		$vars['send'] = true;

		return( $vars );

	}
	add_filter('get_media_item_args', 'ss_framework_sllow_slider_img_insertion');
	
}

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

if ( !function_exists('ss_framework_display_menu_description_field') ) {

	// Force display of description field in WordPress menus
	function ss_framework_display_menu_description_field( $result ) {

		if ( in_array( 'description', $result ) )
			unset( $result[ array_search( 'description', $result ) ] );

		return $result;

	}
	add_filter('get_user_option_managenav-menuscolumnshidden', 'ss_framework_display_menu_description_field');
	
}