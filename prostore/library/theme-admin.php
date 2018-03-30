<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-admin.php
 * @file	 	1.2
 *
 *	1. Theme options
 *	2. Variable definition
 *  3. Customize login page
 *  4. Admin classes
 * 	4.1	General
 *	4.2 Reorder menu items
 *	4.3 Require/recommend plugins
 *	4.4	Theme updates
 *  5. Customize admin dashboard
 *	6. Customize post editing screen
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	Theme options
 * ------------------------------------------------------------------------
 */
	require_once( get_template_directory() . '/library/admin/index.php');
	require_once( get_template_directory() . '/library/admin/theme-customizer.php');

/**
 * ------------------------------------------------------------------------
 * 2.	Variable definition
 * ------------------------------------------------------------------------
 */
	 $prefix = 'prostore_';

/**
 * ------------------------------------------------------------------------
 * 3.	Custom login page
 * ------------------------------------------------------------------------
 */
 	if($data[$prefix."framework_login_screen"]=="1") {
	 	if ( !function_exists( 'prostore_login_logo' ) ) {
			function prostore_login_logo() {
				$options = get_option('prostore_options');
			  	$logo = $options['logo_image'];
			  	if ( $logo!="" ) {
				    echo '<style type = "text/css">
				        h1 a { background-image:url('.$logo.') !important; background-size: contain !important;margin-bottom:30px !important; }
				    </style>';
			    }
			}
		}
		add_action('login_head', 'prostore_login_logo');

		if ( !function_exists( 'prostore_login_url' ) ) {
			function prostore_login_url() {
				return home_url();
			}
		}
		add_filter('login_headerurl', 'prostore_login_url');

		if ( !function_exists( 'prostore_login_title' ) ) {
			function prostore_login_title() {
				return get_option('blogname');
			}
		}
		add_filter('login_headertitle', 'prostore_login_title');
	}

/**
 * ------------------------------------------------------------------------
 * 4.	Admin classes
 * ------------------------------------------------------------------------
 */
    /*-------------------------------------
    //  4.1	General
    ---------------------------------------*/
	if(function_exists('iwacontact_init')) {
		if ( ! function_exists( 'remove_ajax_contact_stylesheet' ) ) {
			function remove_ajax_contact_stylesheet() {
		    	wp_deregister_style('ajax-contact-css');
				wp_register_style( 'custom-ajax-contact-css', get_template_directory_uri() . '/css/ajax-contact.css' );
				wp_enqueue_style( 'custom-ajax-contact-css' );
			}
			add_action( 'init' , 'remove_ajax_contact_stylesheet' , 99);
		}
	}

    /*-------------------------------------
    //  4.2	Reorder menu items
    ---------------------------------------*/
    if(is_admin()) {
	if ( ! function_exists( 'custom_menu_order' ) ) {
		function custom_menu_order($menu_ord) {
			if (!$menu_ord) return true;
			return array(
				'index.php', // Dashboard
				'optionsframework', // Dashboard
				'woocommerce', // Dashboard
				'revslider',
				'edit.php?post_type=iwacontactform', // Dashboard
				'zilla-likes', // Dashboard
				'zilla-share', // Dashboard
				'zilla-social', // Dashboard
				'separator1', // First separator
				'edit.php', // Posts
				'edit.php?post_type=page', // Pages
				'edit.php?post_type=portfolio', // Posts
				'edit.php?post_type=product', // Pages
				'separator2', // First separator
				'upload.php', // Media
				'link-manager.php', // Links
				'edit-comments.php', // Comments
				'separator-last', // Second separator
				'themes.php', // Appearance
				'plugins.php', // Plugins
				'users.php', // Users
				'tools.php', // Tools
				'options-general.php', // Settings
			);
		}
		add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
		add_filter('menu_order', 'custom_menu_order');
	}
	}

	if(class_exists('IWAJAX_WPSet')) {
		if(!function_exists('adjust_the_wp_menu')) {
			add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
			function adjust_the_wp_menu() {
			 	remove_submenu_page( 'options-general.php', 'ajaxcontact' );
				$abc = new IWAJAX_WPSet(array(
					'prefix'        => 'ajaxcontact',
					'title'         => __( 'AJAX Contact Settings', 'iwacontact' ),
					'options_group' => 'ajaxcontact_options',
					'options_name'  => 'ajaxcontact'));
				$abc->addGroup( array(
					'name'          => 'general',
					'title'         => __( 'General', 'iwacontact' )) );
				$httphost = str_replace( 'www.', '', $_SERVER['HTTP_HOST'] );
				$abc->add( array(
					'group'         => 'general',
					'name'          => 'default_from',
					'title'         => __( 'Default From Address', 'iwacontact' ),
					'default'       => 'no-reply@' . $httphost) );
				$abc->add( array(
					'group'         => 'general',
					'name'          => 'default_to',
					'title'         => __( 'Default To Address', 'iwacontact' ),
					'default'       => 'webmaster@' . $httphost) );
				$abc->add( array(
					'group'         => 'general',
					'name'          => 'default_subject',
					'title'         => __( 'Default Subject', 'iwacontact' ),
					'default'       => __( 'New contact form submission!', 'iwacontact' )) );
				$abc->add( array(
					'group'         => 'general',
					'name'          => 'default_submit_value',
					'title'         => __( 'Default Submit Button Text', 'iwacontact' ),
					'default'       => __( 'Send Enquiry', 'iwacontact' )) );
				$abc->add( array(
					'group'         => 'general',
					'name'          => 'default_redirect',
					'title'         => __( 'Default URL redirect on submission', 'iwacontact' )) );
				$abc->addGroup( array(
					'name'          => 'captcha',
					'title'         => __( 'Spam Prevention', 'iwacontact' )) );
				$abc->add( array(
					'group'         => 'captcha',
					'name'          => 'captcha_type',
					'title'         => __( 'Default Anti-bot Validation', 'iwacontact' ),
					'type'          => 'selectbox',
					'options'       => array(
						'none'      => 'None',
						'honeypot'  => __( 'Honeypot', 'iwacontact' ),
						'recaptcha' => __( 'Google ReCAPTCHA', 'iwacontact' )
					),
					'default'       => 'honeypot') );
				$abc->add( array(
					'group'         => 'captcha',
					'name'          => 'use_captcha',
					'title'         => __( 'Enable by default', 'iwacontact' ),
					'type'          => 'checklist',
					'options'       => array(
						'yes'       => __( 'Yes, enable Anti-bot Validation by default on new forms', 'iwacontact' )
					),
					'default'       => 'yes') );
				$abc->add( array(
					'group'         => 'captcha',
					'name'          => 'recaptcha_api_pub_key',
					'title'         => __( 'ReCAPTCHA Public Key', 'iwacontact' ),
					'description'   => sprintf( __( 'Enter your ReCAPTCHA Public Key here.  If you don\'t already have one, <a href="%1$s" target="_blank">click here to get one</a>', 'iwacontact' ), 'http://www.google.com/recaptcha/whyrecaptcha' )) );
				$abc->add( array(
					'group'         => 'captcha',
					'name'          => 'recaptcha_api_priv_key',
					'title'         => __( 'ReCAPTCHA Private Key', 'iwacontact' ),
					'description'   => __( 'Enter your ReCAPTCHA Private Key here.', 'iwacontact' )
				) );

				add_submenu_page( 'edit.php?post_type=iwacontactform', __( 'AJAX Contact Settings', 'iwacontact' ), __( 'Settings', 'iwacontact' ), 'manage_options', 'ajaxcontact', array( $abc, 'printPageHtml' ) );

			}
		}
	}

    /*-------------------------------------
    //  4.3	Require/recommend plugins
    ---------------------------------------*/
	if($data[$prefix."framework_plugins_notify"]!="1" && is_admin()) {
		require_once( get_template_directory() . '/library/admin/class-tgm-plugin-activation.php');
		if ( ! function_exists( 'prostore_register_required_plugins' ) ) {
			add_action( 'tgmpa_register', 'prostore_register_required_plugins' );
			function prostore_register_required_plugins() {
				$plugins = array(
					array(
						'name'     				=> 'WooCommerce',
						'slug'     				=> 'woocommerce',
						'required' 				=> true,
						'version'				=> '1.6.5.2'
					),
					array(
						'name'     				=> 'Revolution slider',
						'slug'     				=> 'revslider',
						'required' 				=> false,
						'source' 				=>  get_stylesheet_directory() . '/library/plugins/revslider.zip'
					),
					array(
						'name'     				=> 'Zilla-Likes',
						'slug'     				=> 'zilla-likes',
						'required' 				=> false,
						'source' 				=>  get_stylesheet_directory() . '/library/plugins/zilla-likes-1.0.zip'
					),
					array(
						'name'     				=> 'Zilla-Share',
						'slug'     				=> 'zilla-share',
						'required' 				=> false,
						'source' 				=>  get_stylesheet_directory() . '/library/plugins/zilla-share-1.1.zip'
					),
					array(
						'name'     				=> 'Zilla-Social',
						'slug'     				=> 'zilla-social',
						'required' 				=> false,
						'source' 				=>  get_stylesheet_directory() . '/library/plugins/zilla-social-1.2.1.zip'
					),
					array(
						'name'     				=> 'Ajax Contact',
						'slug'     				=> 'ajax-contact',
						'required' 				=> false
					),
					array(
						'name'     				=> 'qTranslate',
						'slug'     				=> 'qtranslate',
						'required' 				=> false
					),

				);

				// Change this to your theme text domain, used for internationalising strings
				$theme_text_domain = 'prostore-theme';

				/**
				 * Array of configuration settings. Amend each line as needed.
				 * If you want the default strings to be available under your own theme domain,
				 * leave the strings uncommented.
				 * Some of the strings are added into a sprintf, so see the comments at the
				 * end of each line for what each argument will be.
				 */
				$config = array(
					'domain'       		=> 'prostore',         	// Text domain - likely want to be the same as your theme.
					'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
					'parent_menu_slug' 	=> 'optionsframework', 				// Default parent menu slug
					'parent_url_slug' 	=> 'admin.php', 				// Default parent URL slug
					'menu'         		=> 'install-required-plugins', 	// Menu slug
					'has_notices'      	=> true,                       	// Show admin notices or not
					'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
					'message' 			=> '',							// Message to output right before the plugins table
					'strings'      		=> array(
						'page_title'                       			=> __( 'Install Required Plugins', 'prostore-theme' ),
						'menu_title'                       			=> __( 'Install Plugins', 'prostore-theme' ),
						'installing'                       			=> __( 'Installing Plugin: %s', 'prostore-theme' ), // %1$s = plugin name
						'oops'                             			=> __( 'Something went wrong with the plugin API.', 'prostore-theme' ),
						'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
						'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
						'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
						'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
						'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
						'return'                           			=> __( 'Return to Required Plugins Installer', 'prostore-theme' ),
						'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'prostore-theme' ),
						'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'prostore-theme' ), // %1$s = dashboard link
						'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
					)
				);
				tgmpa( $plugins, $config );
			}
		}
	}

    /*-------------------------------------
    //  4.4	Theme updates
    ---------------------------------------*/
	if($data[$prefix."framework_udpate_notify"]!="1" && is_admin()) {
		require_once( get_template_directory() . '/library/admin/update-notifier.php');
	}

/**
 * ------------------------------------------------------------------------
 * 5.	Customize admin
 * ------------------------------------------------------------------------
 */
	/*
	This file handles the admin area and functions.
	You can use this file to make changes to the
	dashboard. Updates to this page are coming soon.
	It's turned off by default, but you can call it
	via the functions file.

	Developed by: Eddie Machado
	URL: http://themble.com/bones/

	Special Thanks for code & inspiration to:
	@jackmcconnell - http://www.voltronik.co.uk/
	Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

	*/

	// disable default dashboard widgets
	if ( ! function_exists( 'disable_default_dashboard_widgets' ) && is_admin()) {
		function disable_default_dashboard_widgets() {
			remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
			remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
			remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget
			remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
			remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
			remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
			remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
		}
		add_action('admin_menu', 'disable_default_dashboard_widgets');
	}

/**
 * ------------------------------------------------------------------------
 * 6.	Customize post editing screen
 * ------------------------------------------------------------------------
 */
 	if ( ! function_exists( 'change_default_hidden_page' ) && is_admin()) {
		add_filter( 'default_hidden_meta_boxes', 'change_default_hidden_page', 10, 2 );
		function change_default_hidden_page( $hidden, $screen ) {
		    if ( 'page' == $screen->id ) {
		        $hidden[] = 'postcustom';
		        $hidden[] = 'commentstatusdiv';
		        $hidden[] = 'pageparentdiv';
		        $hidden[] = 'slugdiv';
		        $hidden[] = 'authordiv';
		        $hidden[] = 'pageparentdiv';
		    }
		    return $hidden;
		}
	}
 	if ( ! function_exists( 'change_default_hidden_post' ) && is_admin()) {
		add_filter( 'default_hidden_meta_boxes', 'change_default_hidden_post', 10, 2 );
		function change_default_hidden_post( $hidden, $screen ) {
		    if ( 'post' == $screen->id ) {
		        $hidden[] = 'postexcerpt';
		        $hidden[] = 'trackbacksdiv';
		        $hidden[] = 'postcustom';
		        $hidden[] = 'commentstatusdiv';
		        $hidden[] = 'slugdiv';
		        $hidden[] = 'authordiv';
		    }
		    return $hidden;
		}
	}
 	if ( ! function_exists( 'change_default_hidden_portfolio' ) && is_admin()) {
		add_filter( 'default_hidden_meta_boxes', 'change_default_hidden_portfolio', 10, 2 );
		function change_default_hidden_portfolio( $hidden, $screen ) {
		    if ( 'portfolio' == $screen->id ) {
		        $hidden[] = 'commentstatusdiv';
		        $hidden[] = 'slugdiv';
		    }
		    return $hidden;
		}
	}
 	if ( ! function_exists( 'change_default_hidden_product' ) && is_admin()) {
		add_filter( 'default_hidden_meta_boxes', 'change_default_hidden_product', 10, 2 );
		function change_default_hidden_product( $hidden, $screen ) {
		    if ( 'product' == $screen->id ) {
		        $hidden[] = 'postcustom';
		        $hidden[] = 'slugdiv';
		    }
		    return $hidden;
		}
	}