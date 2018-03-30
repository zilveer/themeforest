<?php
	if (!function_exists('register_field_group')) {
	    include_once get_template_directory().'/inc/modules/advanced-custom-fields/acf.php';
	}

	if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
	
	include_once locate_template('/inc/activation.php');            // Activations functions
	include_once locate_template('/inc/config.php');          // Configuration and constants
	include_once locate_template('/inc/cleanup.php');         // Cleanup
	include_once locate_template('/inc/helper.php');  	// Various functions
	include_once locate_template('/inc/modules/vt_resize.php');
	include_once locate_template('/inc/widgets.php');         // Sidebars and widgets
	include_once locate_template('/inc/modules/sweet-custom-menu/sweet-custom-menu.php');  	// Shortcodes

	if(!class_exists('ReduxFramework')){
	    include_once('inc/modules/ReduxCore/framework.php');
	}
	include_once('inc/modules/ReduxCore/theme/options.php');
	
	add_action('wp_enqueue_scripts', 'astro_scripts', 100);
	add_action('admin_print_scripts', 'astro_admin_scripts');
	add_action('after_setup_theme', 'astro_setup');
	add_action('wp_footer','jquery_sender');

	//ENABLE SHORTCODES ON SIDEBARS
	add_filter('widget_text', 'do_shortcode');

	//SEND EMAIL FUNCTION
	add_action('wp_ajax_mail_before_submit', 'prk_mail_before_submit');
	add_action('wp_ajax_nopriv_mail_before_submit', 'prk_mail_before_submit');

	//WOOCOMMERCE STUFF
    if (PRK_WOO=="true") {
        add_theme_support( 'woocommerce' );
    }

    //FACEBOOK EXTRA INFO
    if (!defined('WPSEO_VERSION')) {
		function prk_facebook() {
	        global $post;
	        if (!is_singular()) {
	            return;
	        }
	        echo '<meta property="og:title" content="'.get_the_title().'" />';
	        echo '<meta property="og:type" content="article"/>';
	        echo '<meta property="og:url" content="'.get_permalink().'" />';
	        echo '<meta property="og:site_name" content="'.get_bloginfo('name').'" />';
	        //CHECK FOR A CUSTOM EXCERPT
            if($excerpt = $post->post_excerpt) {
                $excerpt = strip_tags($post->post_excerpt);
                $excerpt = str_replace("", "'", $excerpt);
            } else {
                $excerpt = get_bloginfo('description');
            }
            echo '<meta property="og:description" content="'.$excerpt.'" />';
	        if(has_post_thumbnail( $post->ID )) {
	            $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'full');
	            echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '" />';
	        }
	    }
	    add_action('wp_head', 'prk_facebook', 5);
	}

	//JETPACK RETINA SCRIPT REMOVE
	function dequeue_devicepx() {
	    wp_dequeue_script( 'devicepx' );
	}
	add_action('wp_enqueue_scripts', 'dequeue_devicepx', 20);

    //BETTER QTRANSLATE SUPPORT
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('qtranslate/qtranslate.php')) {
        function qtranslate_edit_taxonomies(){
           $args=array(
              'public' => true ,
              '_builtin' => false
           );
           $output = 'object'; // or objects
           $operator = 'and'; // 'and' or 'or'

           $taxonomies = get_taxonomies($args,$output,$operator); 

           if  ($taxonomies) {
             foreach ($taxonomies  as $taxonomy ) {
                 add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
                 add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');        

             }
           }
        }
        add_action('admin_init', 'qtranslate_edit_taxonomies');
    }

    //VISUAL COMPOSER STUFF
    if (PRK_ASTRO_COMPOSER) {
    	function prk_vc_disable_update() {
            if (function_exists('vc_license') && function_exists('vc_updater') && ! vc_license()->isActivated()) {
                remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10);
                remove_filter( 'pre_set_site_transient_update_plugins', array(
                    vc_updater()->updateManager(),
                    'check_update'
                ) );
            }
        }
    	add_action( 'admin_init', 'prk_vc_disable_update', 9 );

        add_filter('wpb_widget_title', 'override_widget_title', 10, 2);
        function override_widget_title($output = '', $params = array('')) {
          $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
		  return '<div class="prk_shortcode-title"><div class="header_font sizer_small bd_headings_text_shadow zero_color '.$extraclass.'">'.$params['title'].'</div></div>';
		}
        function astro_vcSetAsTheme() {
            if (function_exists('vc_set_as_theme')) {
                vc_set_as_theme(true);
                if (function_exists('vc_editor_set_post_types')) {
                    vc_editor_set_post_types(array('page','post','pirenko_team_member','pirenko_slides','pirenko_portfolios'));
                }
            }
        }
        add_action('init','astro_vcSetAsTheme');

        //ENQUEUE THE THEME TWEAKED JS AND CSS FILES
        function astro_vc_scripts() {
            global $prk_astro_options;
            if ( defined('WPB_VC_VERSION')) {
                wp_deregister_style('js_composer_custom_css');
                wp_deregister_style('js_composer_front');
                wp_deregister_style('flexslider');
                wp_deregister_style('prettyphoto');
                wp_deregister_script('nivo-slider');
                wp_deregister_script('isotope');
                wp_deregister_script('waypoints');
                wp_deregister_script('vc_accordion_script');
                wp_deregister_script('vc_tabs_script');
                wp_deregister_script('vc_tta_autoplay_script');
                wp_deregister_script('wpb_composer_front_js');
                wp_deregister_script('jquery_ui_tabs_rotate');
                
                wp_register_script('wpb_composer_front_js',get_template_directory_uri().'/js/js_composer_front-min.js', array('jquery'), WPB_VC_VERSION, true );
                wp_enqueue_script('wpb_composer_front_js');

                add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
                function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
                  /*if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
                    $class_string = str_replace( 'vc_row-fluid', 'my_row-fluid', $class_string ); // This will replace "vc_row-fluid" with "my_row-fluid"
                  }*/
                  if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
                    $class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'vc_span$1', $class_string ); // This will replace "vc_col-sm-%" with "my_col-sm-%"
                  }
                  return $class_string; // Important: you should always return modified or original $class_string
                }
            }
        }
        add_action('wp_enqueue_scripts', 'astro_vc_scripts', 10);//WAS 100
        if (!function_exists('astro_integrateWithVC')) {
            function astro_integrateWithVC() {
                return;
            }
        }
        add_action( 'vc_before_init', 'astro_integrateWithVC' ); 
        function vc_remove_wp_admin_bar_button() {
            remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );
        }
        add_action( 'vc_after_init', 'vc_remove_wp_admin_bar_button' );
    }

	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once dirname( __FILE__ ) . '/inc/modules/tgm-plugin-activation/class-tgm-plugin-activation.php';

	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
	/* Register the required plugins for this theme. */
	function my_theme_register_required_plugins() {

		$plugins = array(
			array(
				'name'     				=> 'Astro Framework',
				'slug'     				=> 'astro_framework',
				'source'   				=> get_template_directory_uri() . '/external_plugins/astro_framework.zip', 
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
			    'name'                  => 'WPBakery Visual Composer',
			    'slug'                  => 'js_composer',
			    'source'                => get_template_directory_uri() . '/external_plugins/js_composer.zip', 
			    'required'              => true, // If false, the plugin is only 'recommended' instead of required
			    'version'               => '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			    'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Envato toolkit - Useful to keep the theme updated',
				'slug'     				=> 'envato-wordpress-toolkit',
				'source'   				=> get_template_directory_uri() . '/external_plugins/envato-wordpress-toolkit.zip', 
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
		);
		$config = array(
			'domain'       		=> 'astro',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> 'Hello',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'astro' ),
				'menu_title'                       			=> __( 'Install Plugins', 'astro' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'astro' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'astro' ),
				'notice_can_install_required'     			=> _n_noop( 'IMPORTANT NOTE FOR UPDATES FROM THEME VERSIONS UNDER 4.0:<br>Before installing the new plugin "WPBakery Visual Composer" you must update the following plugin: Astro Framework<br><br>This theme requires the following plugin (self-hosted): %1$s.', 'IMPORTANT NOTE FOR UPDATES FROM THEME VERSIONS UNDER 4.0:<br>Before installing the new plugin "WPBakery Visual Composer" you must update the following plugin: Astro Framework<br><br>This theme requires the following plugins (self-hosted): %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin (self-hosted): %1$s.', 'This theme recommends the following plugins (self-hosted): %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.<br>The update is located on the theme root folder inside the external_plugins folder.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.<br>The updates are located on the theme root folder inside the external_plugins folder.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'astro' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'astro' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'astro' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa( $plugins, $config );
	}
?>