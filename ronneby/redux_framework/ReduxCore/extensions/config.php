<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
	if(!defined('DFD_THEME_SETTINGS_NAME')) {
		exit;
	}
	
    $opt_name = DFD_THEME_SETTINGS_NAME;

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */
	require_once locate_template('/redux_framework/option_values.php');

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
	$assets_folder = get_template_directory_uri() . '/assets/';
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'dfd' ),
        'page_title'           => __( 'Theme Options', 'dfd' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyAP7HLJmPCd44UnyeSwejW_G1Q9OLMFFMg',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'dfd_'.DFD_THEME_SETTINGS_NAME,
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        'allow_tracking'   => false,
        // Disable tracking

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	
	//Redux::setSection( $opt_name, array(
	Redux::setSection( $opt_name, array(
		'title' => __('Main Options', 'dfd'),
		//'desc' => __('<p class="description">Main options of site</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-crown',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'scroll_animation',
				'type' => 'button_set',
				'title' => __('Page scroll animation', 'dfd'),
				'desc' => __('Enable or disable page scroll animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on'
			),
			array(
				'id' => 'head_custom_js',
				'type' => 'textarea',
				'title' => __('JS code to be added inside HEAD tag', 'dfd'),
				'desc' => __('Place your custom metrix javascript code', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'custom_js',
				'type' => 'textarea',
				'title' => __('Custom JS', 'dfd'),
				'desc' => __('Place your custom javascript code if you need to customize anything using js', 'dfd'),
				'validate' => 'dfd_prebuilt_js',
				'default' => ''
			),
			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'dfd'),
				'desc' => __('You may add any other styles for your theme to this field.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'mobile_responsive',
				'type' => 'button_set',
				'title' => __('Mobile Responsive', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'enable_default_modules',
				'type' => 'button_set',
				'title' => __('Enable Default Modules for Visual Composer', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'enable_default_addons',
				'type' => 'button_set',
				'title' => __('Enable Default Modules of Ultimate Addons plugin', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'enable_envato_toolkit',
				'type' => 'button_set',
				'title' => __('Enable Envato Toolkit auto update tool', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'enable_styled_button',
				'type' => 'button_set',
				'title' => __('Enable Styled button', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'enable_wordpress_heartbeat',
				'type' => 'button_set',
				'title' => __('Enable Wordpress Heartbeat', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'dev_mode',
				'type' => 'button_set',
				'title' => __('Enable DEV mode', 'dfd'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'off'
			),
			array(
				'id' => 'disable_ult_addons',
				'type' => 'button_set',
				'title' => __('Disable Ultiate addons shortcodes enqueued from theme', 'dfd'),
				'desc' => '',
				'options' => array('disable' => 'On', 'enable' => 'Off'),
				'default' => 'enable'
			),
			/*
			*/
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Site preloader option', 'dfd'),
		'icon' => 'crdash-box',
		'fields' => array(
			array(
				'id' => 'site_preloader_enabled',
				'type' => 'button_set',
				'title' => __('Site Preloader', 'dfd'),
				'desc' => __('Enable or disable site preloader', 'dfd'),
				'options' => array('1' => 'On', '0' => 'Off'),
				'default' => '0'
			),
			array(
				'id' => 'preloader_percentage',
				'type' => 'button_set',
				'title' => __('Enable Preloader percentage', 'dfd'),
				'desc' => __('Enable or disable preloader percentage counter', 'dfd'),
				'options' => array('1' => 'On', '0' => 'Off'),
				'default' => '0',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
			),
			array(
				'id'          => 'preloader_percentage_typography',
				'type'        => 'typography',
				'title'       => __( 'Preloader Counter Typography', 'redux-framework-demo' ),
				//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
				'google'      => true,
				// Disable google fonts. Won't work if you haven't defined your google api key
				//'font-backup' => true,
				// Select a backup non-google font in addition to a google font
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => true, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				// Enable all Google Font style/weight variations to be added to the page
				//'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				//'compiler'    => array( 'h2.site-description-compiler' ),
				// An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px',
				// Defaults to px
				'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '',
					'font-family' => 'texgyreadventorregular',
					'google'      => true,
					'font-size'   => '45px',
					'line-height' => '55px',
					'text-transform'=> 'uppercase',
					//'word-spacing'  => '0px',
					'letter-spacing'=> '2px',
					'color'	=> '#ffffff',
				),
				'required' => array( 'preloader_percentage', "=", '1' ),
			),
			array(
				'id' => 'preloader_background',
				'type' => 'background',
				'title' => __('Preloader background', 'dfd'),
				'desc' => '',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
			),
			array(
				'id' => 'preloader_style',
				'type' => 'select',
				'title' => __('Preloader style', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('None', 'dfd'),
					'css_animation' => __('CSS animation', 'dfd'),
					'image' => __('Image', 'dfd'),
					'progress_bar' => __('Progress bar', 'dfd'),
				),
				'default' => '',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
			),
			array(
				'id' => 'css_animation_style',
				'type' => 'select',
				'title' => __('Animation style', 'dfd'),
				'desc' => '',
				'options' => dfd_preloader_animation_style(),
				'default' => '',
				'required' => array( 'preloader_style', "=", 'css_animation' ),
			),
			array(
				'id' => 'preoader_animation_color',
				'type' => 'color',
				'title' => __('Animation base color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'preloader_style', "=", 'css_animation' ),
			),
			array(
				'id' => 'preloader_image',
				'type' => 'media',
				'title' => __('Preloader image', 'dfd'),
				'desc' => __('Select an image from preloader', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
				'required' => array( 'preloader_style', "=", 'image' ),
			),
			array(
				'id' => 'preloader_bar_bg',
				'type' => 'color',
				'title' => __('Progress bar background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
			),
			array(
				'id' => 'preloader_bar_opacity',
				'type' => 'slider',
				'title' => __('Progress bar opacity ', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
			),
			array(
				'id' => 'preloader_bar_position',
				'type' => 'select',
				'title' => __('Progress bar position', 'dfd'),
				'desc' => '',
				'options' => array(
					'middle' => __('Middle', 'dfd'),
					'top' => __('Top', 'dfd'),
					'bottom' => __('Bottom', 'dfd'),
				),
				'default' => 'middle',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
			),
			array(
				'id' => 'preloader_bar_height',
				'type' => 'text',
				'title' => __('Preloader bar height (in px)', 'dfd'),
				'default' => __('Full screen by default', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Logos', 'dfd'),
		'icon' => 'crdash-photos',
		'fields' => array(
			array(
				'id' => 'custom_favicon',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_favicon_iphone',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_favicon_ipad',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 76px X 76px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_favicon_iphone_retina',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 120px X 120px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_favicon_ipad_retina',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 152px X 152px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_logo_image',
				'type' => 'media',
				'title' => __('Header Dark Logotype image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image',
				'type' => 'media',
				'title' => __('Header Dark Logotype image for retina', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_second',
				'type' => 'media',
				'title' => __('Header Light Logotype image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image_second',
				'type' => 'media',
				'title' => __('Header Light Logotype image for retina', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_side',
				'type' => 'media',
				'title' => __('Header 5 and 8 Logotype image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image_side',
				'type' => 'media',
				'title' => __('Header 5 and 8 Logotype image for retina', 'dfd'),
				//'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_third',
				'type' => 'media',
				'title' => __('Logotype for Logo-Widget', 'dfd'),
				'desc' => __('Select the logo that will be displayed in the Logo Widget.', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_fixed_header',
				'type' => 'media',
				'title' => __('Logo for fixed header', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a logotype for fixed header', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'mobile_logo_image',
				'type' => 'media',
				'title' => __('Logo for mobile devices', 'dfd'),
				'desc' => __('Select logo to be displayed on mobile devices.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),
			array(
				'id' => 'mobile_menu_logo_image',
				'type' => 'media',
				'title' => __('Logo for mobile menu', 'dfd'),
				'desc' => __('Select logo to be displayed at the top of mobile menu.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),
			array(
				'id' => 'small_logo_image',
				'type' => 'media',
				'title' => __('Small logo for header 8', 'dfd'),
				'desc' => __('Select 70x70 logo to be displayed at the top of Header 8 and 11 style side panel.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),
			/*array(
				'id' => 'preloader_logo_image',
				'type' => 'media',
				'title' => __('Logo for site preloader', 'dfd'),
				'desc' => __('Select the small logo to be displayed while your site is being loaded.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),*/
			array(
				'id' => 'side_area_title',
				'type' => 'media',
				'title' => __('Side Area logo', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			array(
				'id' => 'logo_footer',
				'type' => 'media',
				'title' => __('Logotype in footer', 'dfd'),
				'desc' => __('Will be displayed before footer widgets', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),
			/*array(
				'id' => 'logo_subfooter',
				'type' => 'media',
				'title' => __('Logotype in subfooter', 'dfd'),
				'desc' => __('Will be displayed in subfooter', 'dfd'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
			),*/
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Options', 'dfd'),
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'extra_header_options',
				'type' => 'button_set',
				'title' => __('Enable new header styles', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'top_panel_inner_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Top Panel Inner Page', 'dfd'),
				'desc' => __('Please select Top Panel Inner Page', 'dfd'),
			),
			array(
				'id' => 'top_panel_inner_style',
				'type' => 'select',
				'title' => __('Top inner page style', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Sliding up/down over header', 'dfd'),
					'dfd-panel-animated' => __('Full screen animated', 'dfd')
				),
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
				'default' => '',
			),
			array(
				'id' => 'top_panel_inner_background',
				'type' => 'color',
				'title' => __('Top inner page background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
			),
			array(
				'id' => 'top_panel_inner_background_opacity',
				'type' => 'slider',
				'title' => __('Top inner page background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '100',
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
			),
			array(
				'id' => 'top_adress_field',
				'type' => 'textarea',
				'title' => __('Top address panel', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'desc' => __('This is top adress info block.', 'dfd'),
				'validate' => 'html',
				'default' => '<i class="dfd-icon-phone"></i><span class="dfd-top-info-delim-blank"></span>+1234567890<span class="dfd-top-info-delim"></span><i class="dfd-icon-email_2"></i><span class="dfd-top-info-delim-blank"></span>info@yourmail.com',
			),
			array(
				'id' => 'show_header_cart',
				'type' => 'button_set',
				'title' => __('Show Woocommerce cart icon in header', 'dfd'),
				'desc' => __('Woocommerce plugin is required for this option.', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'required' => array( 'extra_header_options', "=", 'on' ),
				'default' => 'on'
			),
			array(
				'id' => 'header_cart_style',
				'type' => 'select',
				'title' => __('Header cart button style', 'dfd'),
				'options' => dfd_header_cart_style(),
				'required' => array( 'show_header_cart', "=", 'on' ),
				'default' => 'simple',
			),
			array(
				'id' => 'wpml_lang_show',
				'type' => 'button_set',
				'title' => __('WPML language switcher', 'dfd'),
				'desc' => __('WPML plugin must be installed. It is not packed with theme. You can find it here: http://wpml.org/', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'lang_shortcode',
				'type' => 'textarea',
				'title' => __('Language selection shortcode', 'dfd'),
				'desc' => __('You can type shortcode of language select tht your translating plugin provide', 'dfd'),
				'default'  => '<div class="lang-sel sel-dropdown"><a href="#"><span>En</span></a><ul><li><a href="#">En</a></li><li><a href="#">De</a></li><li><a href="#">Fr</a></li></ul></div>',
			),
			array(
				'id' => 'header_logo_width',
				'type' => 'slider',
				'title' => __('Header logo width', 'dfd'),
				'desc' => '',
				'min' => '30',
				'max' => '700',
				'step' => '1',
				'default' => '206',
			),
			array(
				'id' => 'header_logo_height',
				'type' => 'slider',
				'title' => __('Header logo height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '300',
				'step' => '1',
				'default' => '42',
			),
			array(
				'id' => 'top_menu_height',
				'type' => 'slider',
				'title' => __('Top menu height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '150',
				'step' => '2',
				'default' => '70',
			),
			array(
				'id' => 'enable_sticky_header',
				'type' => 'button_set',
				'title' => __('Enable sticky header', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'sticky_header_animation',
				'type' => 'select',
				'title' => __('Sticky header animation', 'dfd'),
				'options' => dfd_sticky_header_animations(),
				'required' => array( 'enable_sticky_header', "=", 'on' ),
				'default' => 'simple',
			),
			array(
				'id' => 'fixed_header_background_color',
				'type' => 'color',
				'title' => __('Sticky Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'sticky_header_logo_background_color',
				'type' => 'color',
				'title' => __('Sticky Header logo background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'fixed_header_background_opacity',
				'type' => 'slider',
				'title' => __('Sticky Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '100',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'fixed_header_text_color',
				'type' => 'color',
				'title' => __('Sticky header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'header_layout',
				'type' => 'button_set',
				'title' => __('Boxed Header Layout', 'dfd'),
				'options' => dfd_header_layouts(),
				'default' => 'fullwidth',
			),
			array(
				'id' => 'info_sth',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Stunning header options', 'dfd').'</h3>'
			),
			array(
				'id' => 'stunning_header_min_height',
				'type' => 'slider',
				'title' => __('Stunning header min height', 'dfd'),
				'desc' => '',
				'min' => '100',
				'step' => '5',
				'max' => '600',
				'default' => '400',
			),
			array(
				'id' => 'stan_header',
				'type' => 'button_set',
				'title' => __('Stunning header', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_color',
				'type' => 'color',
				'title' => __('Default background color', 'dfd'),
				'desc' => '#f7f7f7',
				'default' => '#ffffff',
			),
			array(
				'id' => 'stan_header_image',
				'type' => 'media',
				'title' => __('Default background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'stan_header_bg_img_position',
				'type' => 'select',
				'title' => __('Default background position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'stun_header_bg_size',
				'type' => 'select',
				'title' => __('Default background size', 'dfd'),
				'desc' => '',
				'default' => 'initial',
				'options' => dfd_get_bgsize(),
			),
			array(
				'id' => 'stan_header_fixed',
				'type' => 'button_set',
				'title' => __('Fixed background image position', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd'),),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_bgcheck',
				'type' => 'button_set',
				'title' => __('Please switch to on if dark background is used for stunning header', 'dfd'),
				'options' => array(
					'1' => __('On', 'dfd'),
					'0' => __('Off', 'dfd'),
				),
				'default' => '0',
			),
			array(
				'id' => 'stan_header_text_align',
				'type' => 'select',
				'title' => __('Stunning header text alignment', 'dfd'),
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => 'text-center',
			),
			array(
				'id' => 'enable_stun_header_title',
				'type' => 'button_set',
				'title' => __('Stunning header title', 'dfd'),
				'options' => array(
					'1' => __('On', 'dfd'),
					'0' => __('Off', 'dfd'),
				),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_breadcrumbs',
				'type' => 'button_set',
				'title' => __('Stunning header breadcrumbs', 'dfd'),
				'options' => array(
					'1' => __('On', 'dfd'),
					'off' => __('Off', 'dfd'),
				),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_breadcrumbs_style',
				'type' => 'select',
				'title' => __('Breadcrumbs style', 'dfd'),
				'options' => array(
					'simple' => __('Theme default', 'dfd'),
					'transparent-bg' => __('Transparent background', 'dfd'),
				),
				'default' => 'simple',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 1 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_first_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_first_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_first_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_first_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_first_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_first_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_first_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '26',
			),
			/*array(
				'id' => 'header_first_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_first_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_first_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_first_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_1',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_first_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_first_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_first_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 2 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_second_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_second_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_second_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_second_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_second_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_second_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_second_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_second_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '26',
			),
			array(
				'id' => 'header_second_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_second_top_panel_background_opacity',
				'type' => 'slider',
				'title' => __('Header top panel background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_second_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_second_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_2',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_second_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_second_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_second_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_second_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_2',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 3 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_third_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_third_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_third_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_third_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_third_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_third_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_third_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_third_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '26',
			),
			array(
				'id' => 'header_third_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_third_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_third_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_3',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_third_enable_buttons', "=", 1 ),
				'default' => '0'
			),
			array(
				'id' => 'header_third_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_third_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 4 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_fourth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_fourth_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_fourth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_fourth_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_fourth_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_fourth_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_fourth_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_fourth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '26',
			),
			array(
				'id' => 'header_fourth_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_fourth_top_panel_background_opacity',
				'type' => 'slider',
				'title' => __('Header top panel background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_fourth_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_fourth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_4',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_fourth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_fourth_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fourth_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_fourth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_4',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 5 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_fifth_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_fifth_alignment',
				'type' => 'select',
				'title' => __('Header Alignment', 'dfd'),
				'options' => array(
					'left' => __('Left','dfd'),
					'right' => __('Right','dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'header_fifth_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'fifth_header_logo_background_color',
				'type' => 'color',
				'title' => __('Header logo background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fifth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'head_fifth_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_fifth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			array(
				'id' => 'show_search_form_header_5',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'header_fifth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fifth_bg_image',
				'type' => 'media',
				'title' => __('Header background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'header_fifth_bg_img_position',
				'type' => 'select',
				'title' => __('Header background image position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'header_fifth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 6 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			/*
			*/
			array(
				'id' => 'header_sixth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'show_search_form_header_6',
				'type' => 'button_set',
				'title' => __('Show search form in header (for mobile devices only)', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_sixth_text_color',
				'type' => 'color',
				'title' => __('Header elements color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_6',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 7 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_seventh_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_seventh_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_seventh_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'header_seventh_appear_effect',
				'type' => 'select',
				'title' => __('Header Appear Effect', 'dfd'),
				'options' => dfd_header_seventh_appear_effects(),
				'default' => 'default',
			),
			array(
				'id' => 'header_seventh_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'head_seventh_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_seventh_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			array(
				'id' => 'show_search_form_header_7',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_seventh_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => '#000000',
				'validate' => 'color',
			),
			array(
				'id' => 'header_seventh_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '90',
			),
			array(
				'id' => 'header_seventh_text_color_active',
				'type' => 'color',
				'title' => __('Header Active text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'header_seventh_text_color',
				'type' => 'color',
				'title' => __('Menu button color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_7',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 8 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_eighth_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_eighth_alignment',
				'type' => 'select',
				'title' => __('Header Alignment', 'dfd'),
				'options' => array(
					'left' => __('Left','dfd'),
					'right' => __('Right','dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'header_eighth_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'eighth_header_logo_background_color',
				'type' => 'color',
				'title' => __('Header logo background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'head_eighth_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_eighth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			array(
				'id' => 'show_search_form_header_8',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'header_eighth_navbutton_color',
				'type' => 'color',
				'title' => __('Button color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_navbutton_bg',
				'type' => 'color',
				'title' => __('Button bar background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_bg_image',
				'type' => 'media',
				'title' => __('Header background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'header_eighth_bg_img_position',
				'type' => 'select',
				'title' => __('Header background image position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'header_eighth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 9 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_ninth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_ninth_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_ninth_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_ninth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_ninth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_ninth_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_ninth_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_ninth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_ninth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_ninth_top_panel', "=", 'on' ),
				'default' => '26',
			),
			array(
				'id' => 'header_ninth_logo_align',
				'type' => 'select',
				'title' => __('Logo alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'logo_left' => __('Left','dfd'),
					'logo_right' => __('Right','dfd'),
				),
			),
			array(
				'id' => 'header_ninth_middle_item',
				'type' => 'select',
				'title' => __('Header middle panel item', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => array(
					'banner' => __('Banner','dfd'),
					'menu' => __('Menu','dfd'),
				),
			),
			array(
				'id' => 'header_ninth_banner_image',
				'type' => 'media',
				'title' => __('Banner image', 'dfd'),
				'desc' => __('Upload your banner image', 'dfd'),
				'required' => array(
					array('header_ninth_middle_item', '=', 'banner'),
				),
				'default' => array(
					'url' => ''
				)
			),

			array(
				'id' => 'header_ninth_banner_url',
				'type' => 'text',
				'title' => __('Banner url', 'dfd'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('header_ninth_middle_item', '=', 'banner'),
				),
				'default' => ''
			),
			array(
				'id' => 'header_ninth_banner_height',
				'type' => 'slider',
				'title' => __('Banner height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '300',
				'step' => '1',
				'default' => '42',
				'required' => array(
					array('header_ninth_middle_item', '=', 'banner'),
				),
			),
			array(
				'id' => 'header_ninth_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_ninth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_ninth_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_ninth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_ninth_menu_align',
				'type' => 'select',
				'title' => __('Primary navigation alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'' => __('Inherit from menu options','dfd'),
					'menu_left' => __('Left','dfd'),
					'menu_right' => __('Right','dfd'),
					'menu_center' => __('Center','dfd'),
				),
			),
			array(
				'id' => 'head_ninth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_9',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_ninth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_ninth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_ninth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 10 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_tenth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_tenth_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_tenth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array(
					'header_tenth_top_panel', "=", 'on',
				),
				'default' => '1'
			),
			array(
				'id' => 'head_tenth_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_tenth_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_tenth_logo_align',
				'type' => 'select',
				'title' => __('Logo alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'logo_left' => __('Left','dfd'),
					'logo_right' => __('Right','dfd'),
				),
			),
			array(
				'id' => 'header_tenth_middle_item',
				'type' => 'select',
				'title' => __('Header middle panel item', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => array(
					'banner' => __('Banner','dfd'),
					'menu' => __('Menu','dfd'),
				),
			),
			array(
				'id' => 'header_tenth_banner_image',
				'type' => 'media',
				'title' => __('Banner image', 'dfd'),
				'desc' => __('Upload your banner image', 'dfd'),
				'required' => array(
					array('header_tenth_middle_item', '=', 'banner'),
				),
				'default' => array(
					'url' => ''
				)
			),

			array(
				'id' => 'header_tenth_banner_url',
				'type' => 'text',
				'title' => __('Banner url', 'dfd'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('header_tenth_middle_item', '=', 'banner'),
				),
				'default' => ''
			),
			array(
				'id' => 'header_tenth_banner_height',
				'type' => 'slider',
				'title' => __('Banner height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '300',
				'step' => '1',
				'default' => '42',
				'required' => array(
					array('header_tenth_middle_item', '=', 'banner'),
				),
			),
			array(
				'id' => 'header_tenth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
				'default' => '26',
			),
			array(
				'id' => 'header_tenth_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_tenth_top_panel_background_opacity',
				'type' => 'slider',
				'title' => __('Header top panel background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_tenth_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_tenth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_tenth_menu_align',
				'type' => 'select',
				'title' => __('Primary navigation alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'' => __('Inherit from menu options','dfd'),
					'menu_left' => __('Left','dfd'),
					'menu_right' => __('Right','dfd'),
					'menu_center' => __('Center','dfd'),
				),
			),
			array(
				'id' => 'head_tenth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_10',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_tenth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_tenth_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_tenth_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_tenth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_10',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 11 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_eleventh_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_eleventh_alignment',
				'type' => 'select',
				'title' => __('Header Alignment', 'dfd'),
				'options' => array(
					'left' => __('Left','dfd'),
					'right' => __('Right','dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'header_eleventh_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'head_eleventh_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_eleventh_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			array(
				'id' => 'show_search_form_header_11',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'header_eleventh_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eleventh_bg_image',
				'type' => 'media',
				'title' => __('Header background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'header_eleventh_bg_img_position',
				'type' => 'select',
				'title' => __('Header background image position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'header_eleventh_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 12 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_twelfth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_twelfth_menu_align',
				'type' => 'select',
				'title' => __('Primary navigation alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'' => __('Inherit from menu options','dfd'),
					'menu_left' => __('Left','dfd'),
					'menu_right' => __('Right','dfd'),
					'menu_center' => __('Center','dfd'),
				),
			),
			array(
				'id' => 'head_twelfth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_12',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_twelfth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_twelfth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_twelfth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 13 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_thirteenth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_thirteenth_menu_align',
				'type' => 'select',
				'title' => __('Primary navigation alignment', 'dfd'),
				'desc' => '',
				'default' => '',
				'options' => array(
					'' => __('Inherit from menu options','dfd'),
					'menu_left' => __('Left','dfd'),
					'menu_right' => __('Right','dfd'),
					'menu_center' => __('Center','dfd'),
				),
			),
			array(
				'id' => 'head_thirteenth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_13',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_thirteenth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_thirteenth_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_thirteenth_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_thirteenth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_13',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Header Style 14 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_fourteenth_sticky',
				'type' => 'button_set',
				'title' => __('Enable header animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'header_fourteenth_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_fourteenth_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'header_fourteenth_appear_effect',
				'type' => 'select',
				'title' => __('Header Appear Effect', 'dfd'),
				'options' => dfd_header_seventh_appear_effects(),
				'default' => 'default',
			),
			array(
				'id' => 'header_fourteenth_login',
				'type' => 'button_set',
				'title' => __('Enable Login form', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'head_fourteenth_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_fourteenth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			array(
				'id' => 'show_search_form_header_14',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_fourteenth_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => '#000000',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fourteenth_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '90',
			),
			array(
				'id' => 'header_fourteenth_text_color_active',
				'type' => 'color',
				'title' => __('Header Active text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fourteenth_text_color',
				'type' => 'color',
				'title' => __('Menu button color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'stun_header_title_align_header_14',
				'type' => 'button_set',
				'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
		),
	));
	/*
	*/
	$_menu_options_fields = array();
	$_menu_default_font_family = array(
		1 => 'texgyreadventorregular',//menu titles
		2 => 'Raleway',//menu dropdowns
		3 => 'Droid Serif',//menu dropdown subtitles
	);
	$_menu_default_font_size = array(
		1 => '11px',//menu titles
		2 => '13px',//menu dropdowns
		3 => '11px',//menu dropdown subtitles
	);
	$_menu_default_line_height_increment = array(
		1 => 1.6,//menu titles
		2 => 2,//menu dropdowns
		3 => 1,//menu dropdown subtitles
	);
	$_menu_default_font_weight = array(
		1 => '600',//menu titles
		2 => '600',//menu dropdowns
		3 => '400',//menu dropdown subtitles
	);
	$_menu_default_font_style = array(
		1 => 'normal',//menu titles
		2 => 'normal',//menu dropdowns
		3 => 'italic',//menu dropdown subtitles
	);
	$_menu_default_text_transform = array(
		1 => 'uppercase',//menu titles
		2 => 'none',//menu dropdowns
		3 => 'none',//menu dropdown subtitles
	);
	/*$_menu_default_word_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);*/
	$_menu_default_letter_spacing = array(
		1 => '2px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_menu_default_option_name = array(
		1 => 'menu_titles',//menu titles
		2 => 'menu_dropdowns',//menu dropdowns
		3 => 'menu_dropdown_subtitles',//menu dropdown subtitles
	);
	$_menu_default_color = array(
		1 => '#28262b',//menu titles
		2 => '#ffffff',//menu dropdowns
		3 => '#bbbbbb',//menu dropdown subtitles
	);
	$_menu_default_option_title = array(
		1 => 'Menu titles',//menu titles
		2 => 'Menu dropdowns',//menu dropdowns
		3 => 'Menu dropdown subtitles',//menu dropdown subtitles
	);

	for ($i=1; $i<=3; $i++) {
		$_menu_options_fields[] = array(
			'id'          => $_menu_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_menu_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => true, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => false,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_menu_default_font_style[$i],
				'font-weight'  => $_menu_default_font_weight[$i],
				'font-family' => $_menu_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_menu_default_font_size[$i],
				'line-height' => $_menu_default_font_size[$i] * $_menu_default_line_height_increment[$i].'px',
				'text-transform'=> $_menu_default_text_transform[$i],
				//'word-spacing'  => $_menu_default_word_spacing[$i],
				'letter-spacing'=> $_menu_default_letter_spacing[$i],
				'color'	=> $_menu_default_color[$i],
			),
		);
	}
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdowns_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown items text opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '60',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_color',
		'type' => 'color',
		'title' => __('Menu dropdown hover color', 'dfd'),
		'desc' => '',
		'default' => '#8a8f6a',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_background',
		'type' => 'color',
		'title' => __('Menu dropdown background color', 'dfd'),
		'desc' => '',
		'default' => '#1b1b1b',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_background_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown background opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '100',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_bg',
		'type' => 'color',
		'title' => __('Menu dropdown hover background color (available for header styles 1 - 4)', 'dfd'),
		'desc' => '',
		'default' => 'transparent',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_bg_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown hover background opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_alignment',
		'type' => 'select',
		'title' => __('Primary Navigation Alignment', 'dfd'),
		'options' => dfd_alignment_options(),
		'default' => 'text-right'
	);
	$_menu_options_fields[] = array(
		'id' => 'enable_menu_titles_delimiter',
		'type' => 'button_set',
		'title' => __('Enable menu titles delimiter', 'dfd'),
		'desc' => '',
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'required' => array( 'extra_header_options', "=", 'off' ),
		'default' => 'on'
	);
	$_menu_options_fields[] = array(
		'id' => 'enable_menu_line_animated',
		'type' => 'button_set',
		'title' => __('Enable menu line animated', 'dfd'),
		'desc' => '',
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'required' => array( 'extra_header_options', "=", 'off' ),
		'default' => 'on'
	);
	$_menu_options_fields[] = array(
		'id' => 'highlight_has_submenu',
		'type' => 'button_set',
		'title' => __('Highlight menu item title if it has submenu', 'dfd'),
		'desc' => '',
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'required' => array( 'extra_header_options', "=", 'on' ),
		'default' => 'off'
	);
	Redux::setSection( $opt_name, array(
		'title' => __('Menu options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-indent',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $_menu_options_fields,
	));
	$_mobile_header_options_fields = array();
	$_mobile_header_options_fields[] = array(
		'id' => 'header_responsive_breakpoint',
		'type' => 'slider',
		'title' => __('Header responsive breakpoint', 'dfd'),
		'desc' => '',
		'min' => '768',
		'max' => '1280',
		'step' => '1',
		'default' => '1101',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'mobile_header_bg',
		'type' => 'color',
		'title' => __('Mobile header background color', 'dfd'),
		'desc' => '',
		'default' => '',
		'validate' => 'color',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'mobile_header_color',
		'type' => 'color',
		'title' => __('Mobile header elements color', 'dfd'),
		'desc' => '',
		'default' => '',
		'validate' => 'color',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'mobile_menu_bg',
		'type' => 'color',
		'title' => __('Mobile menu background color', 'dfd'),
		'desc' => '',
		'default' => '',
		'validate' => 'color',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'mobile_menu_color',
		'type' => 'color',
		'title' => __('Mobile menu color', 'dfd'),
		'desc' => '',
		'default' => '',
		'validate' => 'color',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'mobile_menu_color_opacity',
		'type' => 'slider',
		'title' => __('Mobile menu links opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '50',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'search_form_mobile_header',
		'type' => 'button_set',
		'title' => __('Enable search form in mobile header', 'dfd'),
		'desc' => '',
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1',
	);
	$_mobile_header_options_fields[] = array(
		'id' => 'text_mobile_header',
		'type' => 'textarea',
		'title' => __('Text in mobile header', 'dfd'),
		'desc' => 'Place enter your text here',
		'validate' => 'html',
		'default' => '',
	);
	Redux::setSection( $opt_name, array(
		'title' => __('Mobile header options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-ipad',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $_mobile_header_options_fields,
	));
	$_side_area_options_fields = array();
	/*$_side_area_default_font_family = array(
		1 => 'texgyreadventorregular',//menu titles
		2 => 'Raleway',//menu dropdowns
		3 => 'Droid Serif',//menu dropdown subtitles
	);
	$_side_area_default_font_size = array(
		1 => '11px',//menu titles
		2 => '12px',//menu dropdowns
		3 => '11px',//menu dropdown subtitles
	);
	$_side_area_default_line_height_increment = array(
		1 => 1.6,//menu titles
		2 => 1.57,//menu dropdowns
		3 => 1,//menu dropdown subtitles
	);
	$_side_area_default_font_weight = array(
		1 => '600',//menu titles
		2 => '400',//menu dropdowns
		3 => '400',//menu dropdown subtitles
	);
	$_side_area_default_font_style = array(
		1 => 'normal',//menu titles
		2 => 'normal',//menu dropdowns
		3 => 'italic',//menu dropdown subtitles
	);
	$_side_area_default_text_transform = array(
		1 => 'uppercase',//menu titles
		2 => 'none',//menu dropdowns
		3 => 'none',//menu dropdown subtitles
	);
	$_side_area_default_word_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_side_area_default_letter_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_side_area_default_option_name = array(
		1 => 'side_area_menu_titles',//menu titles
		2 => 'side_area_menu_dropdowns',//menu dropdowns
		3 => 'side_area_menu_dropdown_subtitles',//menu dropdown subtitles
	);
	$_side_area_default_color = array(
		1 => '',//menu titles
		2 => '',//menu dropdowns
		3 => '',//menu dropdown subtitles
	);
	$_side_area_default_option_title = array(
		1 => 'Side Area Menu titles',//menu titles
		2 => 'Side Area Menu dropdowns',//menu dropdowns
		3 => 'Side Area Menu dropdown subtitles',//menu dropdown subtitles
	);

	for ($i=1; $i<=3; $i++) {
		$_side_area_options_fields[] = array(
			'id'          => $_side_area_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_side_area_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => true, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => false,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_side_area_default_font_style[$i],
				'font-weight'  => $_side_area_default_font_weight[$i],
				'font-family' => $_side_area_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_side_area_default_font_size[$i],
				'line-height' => $_side_area_default_font_size[$i] * $_side_area_default_line_height_increment[$i].'px',
				'text-transform'=> $_side_area_default_text_transform[$i],
				//'word-spacing'  => $_side_area_default_word_spacing[$i],
				'letter-spacing'=> $_side_area_default_letter_spacing[$i],
				'color'	=> $_side_area_default_color[$i],
			),
		);
	}*/
	/*
	$_side_area_options_fields[] = array(
		'id' => 'side_area_search',
		'type' => 'button_set',
		'title' => __('Enable Side Area Search', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_cart',
		'type' => 'button_set',
		'title' => __('Enable Side Area Cart', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'
	);
	 */
	$_side_area_options_fields[] = array(
		'id' => 'side_area_enable',
		'type' => 'button_set',
		'title' => __('Enable Side Area by default', 'dfd'),
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'default' => 'on'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_widget',
		'type' => 'button_set',
		'title' => __('Widgetised Side Area', 'dfd'),
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'default' => 'off'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_alignment',
		'type' => 'select',
		'title' => __('Side Area Elements Alignment', 'dfd'),
		'options' => dfd_alignment_options(),
		'required' => array( 'side_area_widget', "=", 'off' ),
		'default' => 'text-left'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_soc_icons',
		'type' => 'button_set',
		'title' => __('Enable Side Area Soc icons', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'required' => array( 'side_area_widget', "=", 'off' ),
		'default' => '1'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_soc_icons_hover_style',
		'type' => 'select',
		'title' => __('Social icons hover style', 'dfd'),
		'options' => dfd_soc_icons_hover_style(),
		'required' => array( 'side_area_widget', "=", 'off' ),
		'default' => '4',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_copyright',
		'type' => 'textarea',
		'title' => __('Side Area Copyright', 'dfd'),
		'desc' => __('Place side area copyright text here', 'dfd'),
		'validate' => 'html',
		'default' => '<a href="dfd.name" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
		'required' => array( 'side_area_widget', "=", 'off' ),
	);
	/*
	$_side_area_options_fields[] = array(
		'id' => 'side_area_width',
		'type' => 'slider',
		'title' => __('Side area width', 'dfd'),
		'desc' => '',
		'min' => '10',
		'max' => '100',
		'step' => '1',
		'default' => '50',
	);
	*/
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_color',
		'type' => 'color',
		'title' => __('Side Area Background Color', 'dfd'),
		'desc' => __('Color of buttons, tabs, links, etc.  For example: #36cfe8', 'dfd'),
		'default' => '#ffffff',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_image',
		'type' => 'media',
		'title' => __('Side area background image', 'dfd'),
		'desc' => '',
		'default' => array(
			'url' => '',
		),
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_position',
		'type' => 'select',
		'title' => __('Side area background position', 'dfd'),
		'desc' => '',
		'options' => dfd_get_bgposition(),
		'default' => '',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_repeat',
		'type' => 'select',
		'title' => __('Side area background repeat', 'dfd'),
		'desc' => '',
		'options' => array('no-repeat' => 'no-repeat', 'repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'repeat' => 'both vertically and horizontally',),
		'default' => 'no-repeat'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_dark',
		'type' => 'button_set',
		'title' => __('Please set to Yes if the dark color was chosen as a side background color', 'dfd'),
		'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
		'default' => '0'
	);
	Redux::setSection( $opt_name, array(
		'title' => __('Side Area Options', 'dfd'),
		//'desc' => __('<p class="description">Side area and fixed left and right aligned headers options</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-layout_alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $_side_area_options_fields
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Footer section options', 'dfd'),
		//'desc' => __('<p class="description">Footer section options</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-panel_close',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'footer_variant',
				'type' => 'select',
				'title' => __('Footer variants', 'dfd'),
				'options' => dfd_footer_values(),
				'default' => '1'
			),
			array(
				'id' => 'enable_footer_logo',
				'type' => 'button_set',
				'title' => __('Enable footer logo', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'enable_footer_soc_icons',
				'type' => 'button_set',
				'title' => __('Enable footer social icons', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'footer_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Footer Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
				'required' => array( 'enable_footer_soc_icons', "=", 1 ),
			),
			array(
				'id' => 'enable_footer_menu',
				'type' => 'button_set',
				'title' => __('Enable footer menu', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '0'// 1 = on | 0 = off
			),
			array(
				'id' => 'enable_subfooter',
				'type' => 'button_set',
				'title' => __('Enable subfooter', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'footer_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Footer Section Page', 'dfd'),
				'desc' => __('Please select Footer Section Page', 'dfd'),
				'required' => array( 'footer_variant', "=", 3 ),
			),
			array(
				'id' => 'copyright_footer',
				'type' => 'textarea',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Fill in the copyright text.', 'dfd'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks- Elite ThemeForest Author.'
			),
			array(
				'id' => 'footer_copyright_position',
				'type' => 'select',
				'title' => __('Copyright message position', 'dfd'),
				'options' => array(
					'footer' => __('In Footer', 'dfd'),
					'subfooter' => __('In Subfooter', 'dfd'),
				),
				'default' => 'subfooter',
			),
			array(
				'id' => 'info_foot',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Footer styling options', 'dfd').'</h3>'
			),
			array(
				'id' => 'footer_bg_color',
				'type' => 'color',
				'title' => __('Footer background color', 'dfd'),
				'desc' => __('Select footer background color. ', 'dfd'),
				'default' => '#323232'
			),
			array(
				'id' => 'footer_bg_dark',
				'type' => 'button_set',
				'title' => __('Please set to Yes if the dark color was chosen as a footer background color', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'footer_bg_image',
				'type' => 'media',
				'title' => __('Custom footer background image', 'dfd'),
				'desc' => __('Upload your own footer background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'footer_custom_repeat',
				'type' => 'select',
				'title' => __('Footer background image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => ''
			),
			array(
				'id' => 'info_sub_foot',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Sub footer styling options', 'dfd').'</h3>'
			),

			array(
				'id' => 'sub_footer_bg_color',
				'type' => 'color',
				'title' => __('Sub footer background color', 'dfd'),
				'desc' => __('Select sub footer background color. ', 'dfd'),
				'default' => '#323232',
			),
			array(
				'id' => 'sub_footer_bg_dark',
				'type' => 'button_set',
				'title' => __('Please set to Yes if the dark color was chosen as a subfooter background color', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'sub_footer_bg_image',
				'type' => 'media',
				'title' => __('Custom sub footer background image', 'dfd'),
				'desc' => __('Upload your own footer background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'sub_footer_custom_repeat',
				'type' => 'select',
				'title' => __('Sub footer background image repeat', 'dfd'),

				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat' => 'both vertically and horizontally', 'repeat-y' => 'vertically','repeat-x' => 'horizontally','no-repeat' => 'no-repeat', ),//Must provide key => value pairs for select options
				'default' => 'repeat'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Social accounts', 'dfd'),
		//'desc' => __('<p class="description">Type links for social accounts</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Default Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '26',
			),
			/*
			array(
				'id' => 'author_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Author Box Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			*/
			array(
				'id' => 'de_link',
				'type' => 'text',
				'title' => __('Deviantart link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'dg_link',
				'type' => 'text',
				'title' => __('Digg link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'dr_link',
				'type' => 'text',
				'title' => __('Dribbble link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://dribbble.com'
			),
			array(
				'id' => 'db_link',
				'type' => 'text',
				'title' => __('Dropbox link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'en_link',
				'type' => 'text',
				'title' => __('Evernote link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'fb_link',
				'type' => 'text',
				'title' => __('Facebook link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://facebook.com'
			),
			array(
				'id' => 'flk_link',
				'type' => 'text',
				'title' => __('Flickr link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'fs_link',
				'type' => 'text',
				'title' => __('Foursquare link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'gp_link',
				'type' => 'text',
				'title' => __('Google + link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'in_link',
				'type' => 'text',
				'title' => __('Instagram link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'lf_link',
				'type' => 'text',
				'title' => __('Last FM link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'li_link',
				'type' => 'text',
				'title' => __('LinkedIN link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'lj_link',
				'type' => 'text',
				'title' => __('Livejournal link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'pi_link',
				'type' => 'text',
				'title' => __('Picasa link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'pt_link',
				'type' => 'text',
				'title' => __('Pinterest link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'rss_link',
				'type' => 'text',
				'title' => __('RSS', 'dfd'),
				'desc' => __('Paste alternative link to Rss', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'tu_link',
				'type' => 'text',
				'title' => __('Tumblr link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'tw_link',
				'type' => 'text',
				'title' => __('Twitter link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://twitter.com'
			),
			array(
				'id' => 'vi_link',
				'type' => 'text',
				'title' => __('Vimeo link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'https://vimeo.com/'
			),
			array(
				'id' => 'wp_link',
				'type' => 'text',
				'title' => __('Wordpress link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'yt_link',
				'type' => 'text',
				'title' => __('YouTube link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => '500px_link',
				'type' => 'text',
				'title' => __('500px link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'ml_link',
				'type' => 'text',
				'title' => __('Mail link', 'dfd'),
				'desc' => __('Type your email in a form, e.g.: mailto:youremail@mail.com', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'vb_link',
				'type' => 'text',
				'title' => __('ViewBug link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'vk2_link',
				'type' => 'text',
				'title' => __('VKontacte 2 link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'xn_link',
				'type' => 'text',
				'title' => __('Xing link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'sp_link',
				'type' => 'text',
				'title' => __('Spotify link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'hz_link',
				'type' => 'text',
				'title' => __('Houzz link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'sk_link',
				'type' => 'text',
				'title' => __('Skype link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'ss_link',
				'type' => 'text',
				'title' => __('Slideshare link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'bd_link',
				'type' => 'text',
				'title' => __('Bandcamp link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'sd_link',
				'type' => 'text',
				'title' => __('Soundcloud link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'mk_link',
				'type' => 'text',
				'title' => __('Meerkat link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'ps_link',
				'type' => 'text',
				'title' => __('Periscope link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'sc_link',
				'type' => 'text',
				'title' => __('Snapchat link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'tc_link',
				'type' => 'text',
				'title' => __('The City link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'bh_link',
				'type' => 'text',
				'title' => __('Behance link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'pp_link',
				'type' => 'text',
				'title' => __('Microsoft Pinpoint link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'vd_link',
				'type' => 'text',
				'title' => __('Viadeo link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'ta_link',
				'type' => 'text',
				'title' => __('TripAdvisor link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Blog options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-thumbnail_list',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Inner post page options', 'dfd').'</h3>'
			),
			array(
				'id' => 'blog_top_link_src',
				'type' => 'select',
				'title' => __('Blog top link source', 'dfd'),
				'desc' => '',
				'options' => array(
					'page' => __('Page', 'dfd'),
					'url' => __('Custom url', 'dfd'),
				),
				'default' => 'chaffle',
			),
			array(
				'id' => 'blog_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Blog page select', 'dfd'),
				'desc' => __('Please select main blog page', 'dfd'),
				'required' => array(
					array('blog_top_link_src', '=', 'page'),
				),
			),
			array(
				'id' => 'blog_top_page_url',
				'type' => 'text',
				'title' => __('Blog page url', 'dfd'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('blog_top_link_src', '=', 'url'),
				),
				'default' => ''
			),
			array(
				'id' => 'post_share_button',
				'type' => 'button_set',
				'title' => __('Social share buttons', 'dfd'),
				'desc' => __('With this option you may activate or deactivate social share buttons. and date on inner post page', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'custom_share_code',
				'type' => 'textarea',
				'title' => __('Custom share code', 'dfd'),
				'desc' => __('You may add any other social share buttons to this field.', 'dfd'),
				'default' => ''
			),/*
			array(
				'id' => 'autor_box_disp',
				'type' => 'button_set',
				'title' => __('Author Info', 'dfd'),
				'desc' => __('This option enables you to insert information about the author of the post.', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1', // 1 = on | 0 = off
			),
			array(
				'id' => 'thumb_inner_disp',
				'type' => 'button_set', //the field type
				'title' => __('Thumbnail on inner page', 'dfd'),
				'desc' => __('Display featured image on single post', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0', //this should be the key as defined above
			),*/
			array(
				'id' => 'blog_items_disp',
				'type' => 'button_set', //the field type
				'title' => __('Display block under single blog item', 'dfd'),
				'sub_desc' => __('Block with recent news', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'//this should be the key as defined above
			),
			array(
				'id' => 'block_single_blog_item',
				'type' => 'textarea',
				'title' => __('Block shortcode', 'dfd'),
				'desc' => '',
				//'sub_desc' => __('', 'dfd'),
				'default' => '',
				'required' => array(
					array('blog_items_disp', '=', '1'),
				),
			),
			array(
				'id' => 'style_hover_read_more',
				'type' => 'select',
				'title' => __('Hover effect style for "MORE INFO" button', 'dfd'),
				'desc' => __('Hover effect that will be applied to "MORE INFO" button on single post and blog post page templates.', 'dfd'),
				'options' => array(
					'chaffle' => __('Shuffle', 'dfd'),
					'slide-up' => __('Slide up', 'dfd'),
				),
				'default' => 'chaffle',
			),
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Archive page options</h3>', 'dfd')
			),
			array(
				'id' => 'thumb_image_crop',
				'type' => 'button_set',
				'title' => __('Crop thumbnails', 'dfd'),
				'desc' => __('Post thumbnails image crop', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1',
			),
			array(
				'id' => 'post_thumbnails_width',
				'type' => 'text',
				'title' => __('Post thumbnail width (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '900',
			),
			array(
				'id' => 'post_thumbnails_height',
				'type' => 'text',
				'title' => __('Post  thumbnail height (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '600',
			),
			array(
				'id' => 'post_title_bottom_offset',
				'type' => 'text',
				'title' => __('Post title bottom offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
			),
			array(
				'id' => 'post_header',
				'type' => 'button_set',
				'title' => __('Post info', 'dfd'),
				'desc' => __('It is information about the post (time and date of creation, author, comments on the post).', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1', //this should be the key as defined above
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Single post options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-thumbnail_list',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'blog_single_style',
				'type' => 'select',
				'title' => __('Single post style', 'dfd'),
				'desc' => '',
				'options' => array(
					'base' => __('Simple', 'dfd'),
					'advanced' => __('Advanced', 'dfd'),
				),
				'default' => 'base',
			),
			array(
				'id' => 'blog_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'blog_single_stun_header_cat',
				'type' => 'button_set', //the field type
				'title' => __('Enable post category in stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('blog_single_stun_header', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_single_stun_header_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable post meta in stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('blog_single_stun_header', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_single_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_single_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single post settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_single_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'blog_single_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('blog_single_style', '=', 'advanced'),
				),
			),
			array(
				'id' => 'blog_single_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable comments counter, tags, likes and Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
				'required' => array(
					array('blog_single_style', '=', 'advanced'),
				),
			),
			array(
				'id' => 'blog_single_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('blog_single_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable Fixed Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
				'required' => array(
					array('blog_single_style', '=', 'advanced'),
				),
			),
			array(
				'id' => 'blog_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => __('Enable inside pagination', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'blog_single_pagination_style',
				'type' => 'select',
				'title' => __('Pagination position', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Fixed', 'dfd'),
					'top' => __('Top', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('blog_single_enable_pagination', '=', 'on'),
				),
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Blog page options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-thumbnail_list',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'blog_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'blog_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'blog_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					false => __('Standard', 'dfd'),
					'right-image' => __('Left image', 'dfd'),
					'left-image' => __('Right image', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_smart_grid',
				'type' => 'button_set',
				'title' => __('Smart grid mode', 'dfd'),
				'desc' => '',
				'options' => array(
					'on' => __('Enable', 'dfd'),
					'off' => __('Disable', 'dfd'),
				),
				'default' => 'off',
				'required' => array(
					array('blog_layout_style', '!=', false),
					array('blog_layout_style', '!=', 'masonry'),
					array('blog_layout_style', '!=', 'right-image'),
					array('blog_layout_style', '!=', 'left-image'),
				),
			),
			array(
				'id' => 'blog_smart_hover_text_color',
				'type' => 'color',
				'title' => __('Post hover text color for Smart grid style', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'blog_smart_hover_mask_style',
				'type' => 'select',
				'title' => __('Hover mask background style for Smart grid style', 'dfd'),
				'desc' => '',
				'options' => array(
					'simple' => __('Simple color','dfd'),
					'gradient' => __('Gradient','dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'blog_smart_hover_bg',
				'type' => 'color',
				'title' => __('Post hover background color for Smart grid style', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'blog_smart_hover_mask_style', "=", 'simple'
				),
			),
			array(
				'id' => 'blog_smart_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => __('Hover mask background gradient for Smart grid style', 'dfd'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'blog_smart_hover_mask_style', "=", 'gradient'
				),
			),
			array(
				'id' => 'blog_smart_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Post hover background opacity for Smart grid style', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),
			array(
				'id' => 'blog_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('blog_layout_style', 'contains', 'o'),
				),
			),
			array(
				'id' => 'blog_sort_panel',
				'type' => 'button_set', //the field type
				'title' => __('Enable sort panel', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'required' => array(
					array('blog_layout_style', 'contains', 'o'),
				),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'blog_sort_panel_align',
				'type' => 'select', //the field type
				'title' => __('Enable sort panel alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
					'text-center' => __('Center', 'dfd'),
				),
				'required' => array(
					array('blog_layout_style', 'contains', 'o'),
				),
				'default' => 'text-left'//this should be the key as defined above
			),
			array(
				'id' => 'blog_items_offset',
				'type' => 'text',
				'title' => __('Blog items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('blog_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'blog_show_comments',
				'type' => 'button_set', //the field type
				'title' => __('Enable comments', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'blog_show_likes',
				'type' => 'button_set', //the field type
				'title' => __('Enable likes', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'blog_comments_likes_style',
				'type' => 'select', //the field type
				'title' => __('Comments and like style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					' ' => __('Always show', 'dfd'),
					'comments-like-hover' => __('Show on hover', 'dfd'),
				),
				'default' => 'on',
			),
			array(
				'id' => 'blog_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'blog_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'blog_heading_position',
				'type' => 'select', //the field type
				'title' => __('Heading position', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => __('Under media', 'dfd'),
					'top' => __('Over media', 'dfd'),
				),
				'default' => 'bottom',
				'required' => array(
					array('blog_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_show_description',
				'type' => 'button_set', //the field type
				'title' => __('Enable description', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => ''
			),
			array(
				'id' => 'blog_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('blog_show_description', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => ''
			),
			array(
				'id' => 'blog_read_more_style',
				'type' => 'select', //the field type
				'title' => __('Read more style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'simple' => __('Simple', 'dfd'),
					'chaffle' => __('Shuffle', 'dfd'),
					'slide-up' => __('Slide up', 'dfd'),
				),
				'default' => 'simple',
				'required' => array(
					array('blog_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('blog_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'blog_vc_content_position',
				'type' => 'select',
				'title' => __('Content position', 'dfd'),
				'desc' => '',
				'options' => array(
					'top' => __('Before projects', 'dfd'),
					'bottom' => __('After projects', 'dfd'),
				),
				'default' => 'top',
			),
			array(
				'id' => 'blog_item_appear_effect',
				'type' => 'select',
				'title' => __('Items appear effect', 'dfd'),
				'desc' => '',
				'options' => dfd_module_animation_styles('options'),
				'default' => '',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Archive page options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-thumbnail_list',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'archive_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'archive_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'archive_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					'standard' => __('Standard', 'dfd'),
					'right-image' => __('Left image', 'dfd'),
					'left-image' => __('Right image', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => 'standard',
			),
			array(
				'id' => 'archive_layout_width',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'archive_items_offset',
				'type' => 'text',
				'title' => __('Archive items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('archive_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'archive_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'archive_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'archive_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'archive_heading_position',
				'type' => 'select', //the field type
				'title' => __('Heading position', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => __('Under media', 'dfd'),
					'top' => __('Over media', 'dfd'),
				),
				'default' => 'bottom',
				'required' => array(
					array('archive_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_show_description',
				'type' => 'button_set', //the field type
				'title' => __('Enable description', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'archive_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('archive_show_description', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'archive_read_more_style',
				'type' => 'select', //the field type
				'title' => __('Read more style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'simple' => __('Simple', 'dfd'),
					'chaffle' => __('Shuffle', 'dfd'),
					'slide-up' => __('Slide up', 'dfd'),
				),
				'default' => 'simple',
				'required' => array(
					array('archive_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('archive_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('archive_layout_style', 'contains', 'o'),
				),
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Portfolio Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'portfolio_url_slug',
				'type' => 'text',
				'title' => __('Portfolio URL slug', 'dfd'),
				'desc' => __('Please do not forget to save permalinks in Settings -> Permalinks section after changing this option', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'portfolio_inner_description_title',
				'type' => 'text',
				'title' => __('Portfolio Inner Page Description Title', 'dfd'),
				'default' => __('Description', 'dfd')
			),
			array(
				'id' => 'folio_sorting',
				'type' => 'button_set', //the field type
				'title' => __('Panel for items sorting ', 'dfd'),
				'sub_desc' => __('Display panel for portfolio isotope items sorting by category', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'entry_meta_display',
				'type' => 'button_set', //the field type
				'title' => __('Display single item meta', 'dfd'),
				'sub_desc' => __('Author info, date, comments, tags', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'recent_items_disp',
				'type' => 'button_set', //the field type
				'title' => __('Display block under single item', 'dfd'),
				'sub_desc' => __('Block with recent items', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'block_single_folio_item',
				'type' => 'textarea',
				'title' => __('Block shortcode', 'dfd'),
				'desc' => '',
				//'sub_desc' => __('', 'dfd'),
				'required' => array( 'recent_items_disp', "=", '1' ),
				'default' => ''
			),
			array(
				'id' => 'folio_top_link_src',
				'type' => 'select',
				'title' => __('Portfolio top link source', 'dfd'),
				'desc' => '',
				'options' => array(
					'page' => __('Page', 'dfd'),
					'url' => __('Custom url', 'dfd'),
				),
				'default' => 'chaffle',
			),
			array(
				'id' => 'folio_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Portfolio page select', 'dfd'),
				'desc' => __('Please select main blog page', 'dfd'),
				'required' => array(
					array('folio_top_link_src', '=', 'page'),
				),
			),
			array(
				'id' => 'folio_top_page_url',
				'type' => 'text',
				'title' => __('Portfolio page url', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'validate' => 'url',
				'required' => array(
					array('folio_top_link_src', '=', 'url'),
				),
				'default' => ''
			),
			/*array(
				'id' => 'folio_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Portfolio page select', 'dfd'),
				'desc' => __('Please select main portfolio page', 'dfd'),
			),*/
			array(
				'id' => 'folio_top_page_title',
				'type' => 'text',
				'title' => esc_html__('Portfolio page title', 'dfd'),
				'default' => esc_html__('Portfolio', 'dfd')
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Portfolio page options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'folio_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'folio_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'folio_sort_panel',
				'type' => 'button_set', //the field type
				'title' => __('Enable sort panel', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'folio_sort_panel_align',
				'type' => 'select', //the field type
				'title' => __('Enable sort panel alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
					'text-center' => __('Center', 'dfd'),
				),
				'default' => 'text-left'//this should be the key as defined above
			),
			array(
				'id' => 'folio_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					false => __('Standard', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'folio_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'folio_items_offset',
				'type' => 'text',
				'title' => __('Gallery items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('folio_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'folio_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'folio_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'folio_title_position',
				'type' => 'select',
				'title' => __('Title position', 'dfd'),
				'desc' => '',
				'options' => array(
					'under' => __('Under the image', 'dfd'),
					'front' => __('In front of the image', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_title_decoration',
				'type' => 'select',
				'title' => __('Title decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'none' => __('None', 'dfd'),
					'background' => __('Background', 'dfd'),
					'line' => __('Line', 'dfd'),
					'shadow' => __('Shadow', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_title_color',
				'type' => 'color',
				'title' => __('Title decoration color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => __('Enable subtitles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'folio_title_deco_bg',
				'type' => 'color',
				'title' => __('Title decoration background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('folio_title_decoration', '=', 'background'),
				),
			),
			array(
				'id' => 'folio_title_deco_line_bg',
				'type' => 'color',
				'title' => __('Title decoration line background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('folio_title_decoration', '=', 'line'),
				),
			),
			array(
				'id' => 'folio_title_deco_shadow',
				'type' => 'color',
				'title' => __('Title decoration shadow color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('folio_title_decoration', '=', 'shadow'),
				),
			),
			array(
				'id' => 'folio_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'folio_show_comments',
				'type' => 'button_set', //the field type
				'title' => __('Enable comments', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'folio_show_likes',
				'type' => 'button_set', //the field type
				'title' => __('Enable likes', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'folio_comments_likes_style',
				'type' => 'select', //the field type
				'title' => __('Comments and like style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					' ' => __('Always show', 'dfd'),
					'comments-like-hover' => __('Show on hover', 'dfd'),
				),
				'default' => 'on',
			),
			array(
				'id' => 'folio_show_description',
				'type' => 'button_set', //the field type
				'title' => __('Enable description', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => ''
			),
			array(
				'id' => 'folio_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => ''
			),
			array(
				'id' => 'folio_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'folio_read_more_style',
				'type' => 'select', //the field type
				'title' => __('Read more style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'simple' => __('Simple', 'dfd'),
					'chaffle' => __('Shuffle', 'dfd'),
					'slide-up' => __('Slide up', 'dfd'),
				),
				'default' => 'simple',
				'required' => array(
					array('folio_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => 'animated',
				'required' => array(
					array('folio_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('folio_layout_style', '!=', false),
				),
			),
			array(
				'id' => 'folio_vc_content_position',
				'type' => 'select',
				'title' => __('Content position', 'dfd'),
				'desc' => '',
				'options' => array(
					'top' => __('Before projects', 'dfd'),
					'bottom' => __('After projects', 'dfd'),
				),
				'default' => 'top',
			),
			array(
				'id' => 'folio_item_appear_effect',
				'type' => 'select',
				'title' => __('Items appear effect', 'dfd'),
				'desc' => '',
				'options' => dfd_module_animation_styles('options'),
				'default' => '',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Single Portfolio item options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'folio_single_style',
				'type' => 'select',
				'title' => __('Single portfolio style', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('Simple', 'dfd'),
					'2' => __('Advanced', 'dfd'),
				),
				'default' => '1',
			),
			array(
				'id' => 'folio_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'folio_single_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'folio_inside_template',
				'type' => 'select',
				'title' => __('Portfolio template', 'dfd'),
				'desc' => '',
				'options' => array(
					'folio_inside_1' => __('Portfolio inside 1 variant', 'dfd'),
					'folio_inside_2' => __('Portfolio inside 2 variant', 'dfd'),
				),
				'default' => 'folio_inside_1',
			),
			array(
				'id' => 'folio_gallery_type',
				'type' => 'select',
				'title' => __('Portfolio gallery type', 'dfd'),
				'desc' => '',
				'options' => array(
					'default' => __('Default', 'dfd'),
					'big_images_list' => __('Big images', 'dfd'),
					'middle_image_list' => __('Middle image list', 'dfd'),
					'small_images_list' => __('Small image list', 'dfd'),
					'advanced_gallery' => __('Advanced Gallery', 'dfd'),
				),
				'default' => 'default',
			),
			array(
				'id' => 'folio_layout_type',
				'type' => 'select',
				'title' => __('Content type', 'dfd'),
				'desc' => '',
				'options' => array(
					'default' => __('Default', 'dfd'),
					'page_builder_only' => __('Page builder only', 'dfd'),
				),
				'default' => 'default',
			),
			array(
				'id' => 'folio_description_position',
				'type' => 'select',
				'title' => __('Description position', 'dfd'),
				'desc' => '',
				'options' => array(
					'left' => __('Left', 'dfd'),
					'right' => __('Right', 'dfd'),
					//'top' => __('Top', 'dfd'),
					'bottom' => __('Bottom', 'dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'folio_single_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'folio_single_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => __('Enable subtitle', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			/*array(
				'id' => 'folio_single_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), '' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_single_style', '=', 'advanced'),
				),
			),*/
			array(
				'id' => 'folio_single_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
				'required' => array(
					array('folio_single_style', '=', '2'),
				),
			),
			array(
				'id' => 'folio_single_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_single_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'folio_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable Fixed Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
				'required' => array(
					array('folio_single_style', '=', '2'),
				),
			),
			array(
				'id' => 'folio_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => __('Enable inside pagination', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'folio_single_pagination_style',
				'type' => 'select',
				'title' => __('Pagination position', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Fixed', 'dfd'),
					'top' => __('Top', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_single_enable_pagination', '=', 'on'),
				),
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Portfolio archive page options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'archive_folio_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'archive_folio_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'archive_folio_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					false => __('Standard', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'archive_folio_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'archive_folio_items_offset',
				'type' => 'text',
				'title' => __('Gallery items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('archive_folio_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'archive_folio_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'archive_folio_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'archive_folio_title_position',
				'type' => 'select',
				'title' => __('Title position', 'dfd'),
				'desc' => '',
				'options' => array(
					'under' => __('Under the image', 'dfd'),
					'front' => __('In front of the image', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('archive_folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_folio_title_decoration',
				'type' => 'select',
				'title' => __('Title decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'none' => __('None', 'dfd'),
					'background' => __('Background', 'dfd'),
					'line' => __('Line', 'dfd'),
					'shadow' => __('Shadow', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('archive_folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_folio_title_color',
				'type' => 'color',
				'title' => __('Title decoration color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('archive_folio_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_folio_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => __('Enable subtitles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'archive_folio_title_deco_bg',
				'type' => 'color',
				'title' => __('Title decoration background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('archive_folio_title_decoration', '=', 'background'),
				),
			),
			array(
				'id' => 'archive_folio_title_deco_line_bg',
				'type' => 'color',
				'title' => __('Title decoration line background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('archive_folio_title_decoration', '=', 'line'),
				),
			),
			array(
				'id' => 'archive_folio_title_deco_shadow',
				'type' => 'color',
				'title' => __('Title decoration shadow color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('archive_folio_title_decoration', '=', 'shadow'),
				),
			),
			array(
				'id' => 'archive_folio_show_meta',
				'type' => 'button_set', //the field type
				'title' => __('Enable meta', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => ''
			),
			array(
				'id' => 'archive_folio_show_comments',
				'type' => 'button_set', //the field type
				'title' => __('Enable comments', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'archive_folio_show_likes',
				'type' => 'button_set', //the field type
				'title' => __('Enable likes', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'archive_folio_show_description',
				'type' => 'button_set', //the field type
				'title' => __('Enable description', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => ''
			),
			array(
				'id' => 'archive_folio_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => ''
			),
			array(
				'id' => 'archive_folio_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'archive_folio_read_more_style',
				'type' => 'select', //the field type
				'title' => __('Read more style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'simple' => __('Simple', 'dfd'),
					'chaffle' => __('Shuffle', 'dfd'),
					'slide-up' => __('Slide up', 'dfd'),
				),
				'default' => 'simple',
				'required' => array(
					array('archive_folio_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_folio_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => 'animated',
				'required' => array(
					array('archive_folio_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'archive_folio_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('archive_folio_layout_style', '!=', false),
				),
			),
			array(
				'id' => 'archive_folio_item_appear_effect',
				'type' => 'select',
				'title' => __('Items appear effect', 'dfd'),
				'desc' => '',
				'options' => dfd_module_animation_styles('options'),
				'default' => '',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Portfolio hover options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'folio_hover_style_group',
				'type' => 'select',
				'title' => __('Hover style group', 'dfd'),
				'desc' => '',
				'options' => array(
					'custom' => __('Advanced customizable hover', 'dfd'),
					'entry' => __('Pre-built hovers &#40old version&#41', 'dfd')
				),
				'default' => 'custom',
			),
			array(
				'id' => 'folio_hover_appear_effect',
				'type' => 'select',
				'title' => __('Mask appear effect', 'dfd'),
				'desc' => '',
				'options' => array(
					'dfd-fade-out' => __('Fade out', 'dfd'),
					'dfd-fade-offset' => __('Fade out with offset', 'dfd'),
					'dfd-left-to-right' => __('From left to right', 'dfd'),
					'dfd-right-to-left' => __('From right to left', 'dfd'),
					'dfd-top-to-bottom' => __('From top to bottom', 'dfd'),
					'dfd-bottom-to-top' => __('From bottom to top', 'dfd'),
					'dfd-left-to-right-shift' => __('From left to right shift image', 'dfd'),
					'dfd-right-to-left-shift' => __('From right to left shift image', 'dfd'),
					'dfd-top-to-bottom-shift' => __('From top to bottom shift image', 'dfd'),
					'dfd-bottom-to-top-shift' => __('From bottom to top shift image', 'dfd'),
					'portfolio-hover-style-1' => __('Following the mouse', 'dfd'),
					'dfd-rotate-content-up' => __('Rotate content up', 'dfd'),
					'dfd-rotate-content-down' => __('Rotate content down', 'dfd'),
					'dfd-rotate-left' => __('Rotate left', 'dfd'),
					'dfd-rotate-right' => __('Rotate right', 'dfd'),
					'dfd-rotate-top' => __('Rotate top', 'dfd'),
					'dfd-rotate-bottom' => __('Rotate bottom', 'dfd'),
				),
				'default' => 'dfd-fade-out',
				'required' => array(
					array('folio_hover_style_group', '=', 'custom'),
				),
			),
			array(
				'id' => 'folio_hover_image_effect',
				'type' => 'select',
				'title' => __('Image effect', 'dfd'),
				'desc' => '',
				'options' => array(
					'panr' => __('Image parallax', 'dfd'),
					'dfd-image-scale' => __('Grow', 'dfd'),
					'dfd-image-scale-rotate' => __('Grow with rotation', 'dfd'),
					'dfd-image-shift-left' => __('Shift left', 'dfd'),
					'dfd-image-shift-right' => __('Shift right', 'dfd'),
					'dfd-image-shift-top' => __('Shift top', 'dfd'),
					'dfd-image-shift-bottom' => __('Shift bottom', 'dfd'),
					'dfd-image-blur' => __('Blur', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
					array('folio_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
					array('folio_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
					array('folio_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
					array('folio_hover_appear_effect', '!=', 'dfd-rotate-left'),
					array('folio_hover_appear_effect', '!=', 'dfd-rotate-right'),
					array('folio_hover_appear_effect', '!=', 'dfd-rotate-top'),
					array('folio_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
				),
			),
			array(
				'id' => 'folio_hover_main_dedcoration',
				'type' => 'select',
				'title' => __('Main decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'none' => __('None', 'dfd'),
					'heading' => __('Heading', 'dfd'),
					'plus' => __('Plus', 'dfd'),
					'lines' => __('Lines', 'dfd'),
					'dots' => __('Dots', 'dfd'),
				),
				'default' => 'custom',
				'required' => array(
					array('folio_hover_style_group', '=', 'custom'),
				),
			),
			array(
				'id' => 'folio_hover_title_dedcoration',
				'type' => 'select',
				'title' => __('Heading decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'title-deco-none' => __('None', 'dfd'),
					'diagonal-line' => __('Diagonal line', 'dfd'),
					'title-underline' => __('Title underline', 'dfd'),
					'square-behind-heading' => __('Square behind heading', 'dfd'),
				),
				'default' => 'custom',
				'required' => array(
					array('folio_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'folio_hover_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'folio_hover_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => __('Enable subtitle', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'folio_hover_plus_position',
				'type' => 'select',
				'title' => __('Plus position', 'dfd'),
				'desc' => '',
				'options' => array(
					'dfd-middle' => __('Middle of the project', 'dfd'),
					'dfd-top-right' => __('Top right corner', 'dfd'),
					'dfd-top-left' => __('Top left corner', 'dfd'),
					'dfd-bottom-right' => __('Bottom right corner', 'dfd'),
					'dfd-bottom-left' => __('Bottom left corner', 'dfd'),
				),
				'default' => 'custom',
				'required' => array(
					array('folio_hover_main_dedcoration', '=', 'plus'),
				),
			),
			array(
				'id' => 'folio_hover_plus_bg',
				'type' => 'color',
				'title' => __('Plus background', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('folio_hover_plus_position', 'not_empty_and', 'dfd-middle'),
				),
			),
			array(
				'id' => 'folio_hover_show_ext_link',
				'type' => 'button_set', //the field type
				'title' => __('Enable external link', 'dfd'),
				'sub_desc' => __('This field requirest Button URL options to be specified for portfolio items to show subtitle correctly','dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_hover_style_group', '=', 'custom'),
				),
			),
			array(
				'id' => 'folio_hover_show_quick_view',
				'type' => 'button_set', //the field type
				'title' => __('Enable Quick view', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_hover_style_group', '=', 'custom'),
				),
			),
			array(
				'id' => 'folio_hover_show_lightbox',
				'type' => 'button_set', //the field type
				'title' => __('Enable Lightbox', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('folio_hover_style_group', '=', 'custom'),
				),
			),
			array(
				'id' => 'hover_subtitle_text',
				'type' => 'select',
				'title' => __('Hover subtitle text', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Categories', 'dfd'),
					'1' => __('Single item subtitle', 'dfd')
				),
				'default' => '',
				'required' => array(
					array('folio_hover_style_group', '=', 'entry'),
				),
			),
			array(
				'id' => 'folio_hover_style',
				'type' => 'select',
				'title' => __('Hover style', 'dfd'),
				'desc' => '',
				'options' => array(
					'portfolio-hover-style-1' => __('Style 1', 'dfd'),
					'portfolio-hover-style-2' => __('Style 2', 'dfd'),
					'portfolio-hover-style-3' => __('Style 3', 'dfd'),
					'portfolio-hover-style-4' => __('Style 4', 'dfd'),
					'portfolio-hover-style-5' => __('Style 5', 'dfd'),
					'portfolio-hover-style-6' => __('Style 6', 'dfd'),
					'portfolio-hover-style-7' => __('Style 7', 'dfd'),
					'portfolio-hover-style-8' => __('Style 8', 'dfd'),
					'portfolio-hover-style-9' => __('Style 9', 'dfd'),
					'portfolio-hover-style-10' => __('Style 10', 'dfd'),
					'portfolio-hover-style-11' => __('Style 11', 'dfd'),
					'portfolio-hover-style-12' => __('Style 12', 'dfd'),
					'portfolio-hover-style-13' => __('Style 13', 'dfd'),
					'portfolio-hover-style-14' => __('Style 14', 'dfd'),
					'portfolio-hover-style-15' => __('Style 15', 'dfd'),
					'portfolio-hover-style-16' => __('Style 16', 'dfd'),
					'portfolio-hover-style-17' => __('Style 17', 'dfd'),
					'portfolio-hover-style-18' => __('Style 18', 'dfd'),
					'portfolio-hover-style-19' => __('Style 19', 'dfd'),
					'portfolio-hover-style-20' => __('Style 20', 'dfd'),
					'portfolio-hover-style-21' => __('Style 21', 'dfd'),
					'portfolio-hover-style-22' => __('Style 22', 'dfd'),
					'portfolio-hover-style-23' => __('Style 23', 'dfd'),
					'portfolio-hover-style-24' => __('Style 24', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('folio_hover_style_group', '=', 'entry'),
				),
			),
			array(
				'id' => 'folio_hover_text_color',
				'type' => 'color',
				'title' => __('Portfolio hover text color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'folio_hover_mask_style',
				'type' => 'select',
				'title' => __('Hover mask background style', 'dfd'),
				'desc' => '',
				'options' => array(
					'simple' => __('Simple color','dfd'),
					'gradient' => __('Gradient','dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'folio_hover_bg',
				'type' => 'color',
				'title' => __('Portfolio hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'folio_hover_mask_style', "=", 'simple'
				),
			),
			array(
				'id' => 'folio_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => __('Hover mask background gradient', 'dfd'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'folio_hover_mask_style', "=", 'gradient'
				),
			),
			array(
				'id' => 'folio_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Portfolio hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Gallery Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-photos_alt',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Gallery page settings</h3>', 'dfd')
			),
			array(
				'id' => 'dfd_gallery_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'dfd_gallery_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'boxed' => __('Boxed', 'dfd'),
					'full-width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					false => __('Standard', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('dfd_gallery_layout_style', '!=', false),
				),
			),
			array(
				'id' => 'dfd_gallery_items_offset',
				'type' => 'text',
				'title' => __('Gallery items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'dfd_gallery_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => ''
			),
			array(
				'id' => 'dfd_gallery_show_title',
				'type' => 'button_set',
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'dfd_gallery_show_subtitle',
				'type' => 'button_set',
				'title' => __('Enable subtitles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'dfd_gallery_title_position',
				'type' => 'select',
				'title' => __('Heading position', 'dfd'),
				'desc' => '',
				'options' => array(
					'top' => __('Over the image', 'dfd'),
					'bottom' => __('Under the image', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('dfd_gallery_show_title', '=', 'on'),
				),
			),
			array(
				'id' => 'dfd_gallery_show_comments',
				'type' => 'button_set', //the field type
				'title' => __('Enable comments', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'dfd_gallery_show_likes',
				'type' => 'button_set', //the field type
				'title' => __('Enable likes', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
			),
			array(
				'id' => 'dfd_gallery_item_appear_effect',
				'type' => 'select',
				'title' => __('Items appear effect', 'dfd'),
				'desc' => '',
				'options' => dfd_module_animation_styles('options'),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'dfd_gallery_top_link_src',
				'type' => 'select',
				'title' => __('Gallery top link source', 'dfd'),
				'desc' => '',
				'options' => array(
					'page' => __('Page', 'dfd'),
					'url' => __('Custom url', 'dfd'),
				),
				'default' => 'chaffle',
			),
			array(
				'id' => 'dfd_gallery_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Gallery page select', 'dfd'),
				'desc' => __('Please select main blog page', 'dfd'),
				'required' => array(
					array('dfd_gallery_top_link_src', '=', 'page'),
				),
			),
			array(
				'id' => 'dfd_gallery_top_page_url',
				'type' => 'text',
				'title' => __('Gallery page url', 'dfd'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('dfd_gallery_top_link_src', '=', 'url'),
				),
				'default' => ''
			),
			/*array(
				'id' => 'dfd_gallery_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Gallery page select', 'dfd'),
				'desc' => __('Please select main gallery page', 'dfd'),
			),*/
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Single gallery item options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-photos_alt',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Single gallery item settings</h3>', 'dfd')
			),
			array(
				'id' => 'dfd_gallery_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'dfd_gallery_single_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full-width' => __('Full width', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_single_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_single_show_title',
				'type' => 'button_set',
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'dfd_gallery_single_show_meta',
				'type' => 'button_set',
				'title' => __('Enable subtitle', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'dfd_gallery_single_type',
				'type' => 'select',
				'title' => __('Gallery style', 'dfd'),
				'desc' => '',
				'options' => array(
					'carousel' => __('Carousel', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
					'advanced-gallery' => __('Advanced gallery', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_single_items_offset',
				'type' => 'text',
				'title' => __('Gallery items offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
				/*'required' => array(
					array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
				),*/
			),
			array(
				'id' => 'dfd_gallery_single_autoplay',
				'type' => 'button_set', //the field type
				'title' => __('Enable autoslideshow', 'dfd'),
				'sub_desc' => '',
				'options' => array('true' => __('On', 'dfd'), 'false' => __('Off', 'dfd')),
				'default' => 'true',//this should be the key as defined above
				'required' => array(
					array('dfd_gallery_single_type', "=", 'carousel'),
				),
			),
			array(
				'id'       => 'dfd_gallery_single_slideshow_speed',
				'type'     => 'text',
				'title'    => __( 'Slideshow speed', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '3000',
				'required' => array(
					array('dfd_gallery_single_type', "=", 'carousel'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					'1' => __('One', 'dfd'),
					'2' => __('Two', 'dfd'),
					'3' => __('Three', 'dfd'),
					'4' => __('Four', 'dfd'),
					'5' => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'default' => '1',
				'required' => array(
					array('dfd_gallery_single_type', 'not_empty_and', 'carousel'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_image_width',
				'type' => 'text',
				'title' => __('Gallery image width (px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '900',
				'required' => array(
					array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_image_height',
				'type' => 'text',
				'title' => __('Gallery image height (px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '600',
				'required' => array(
					array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => __('Enable inside pagination', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on'
			),
			array(
				'id' => 'dfd_gallery_single_pagination_style',
				'type' => 'select',
				'title' => __('Pagination position', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Fixed', 'dfd'),
					'top' => __('Top', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('dfd_gallery_single_enable_pagination', '=', 'on'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_show_read_more_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable read more and Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
			),
			array(
				'id' => 'dfd_gallery_single_share_style',
				'type' => 'select', //the field type
				'title' => __('Share style', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'animated' => __('Animated on hover', 'dfd'),
					'simple' => __('Simple', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('dfd_gallery_single_show_read_more_share', '=', 'on'),
				),
			),
			array(
				'id' => 'dfd_gallery_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => __('Enable Fixed Share', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'default' => 'on',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Gallery hover style options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'crdash-photos_alt',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'dfd_gallery_hover_appear_effect',
				'type' => 'select',
				'title' => __('Mask appear effect', 'dfd'),
				'desc' => '',
				'options' => array(
					'dfd-fade-out' => __('Fade out', 'dfd'),
					'dfd-fade-offset' => __('Fade out with offset', 'dfd'),
					'dfd-left-to-right' => __('From left to right', 'dfd'),
					'dfd-right-to-left' => __('From right to left', 'dfd'),
					'dfd-top-to-bottom' => __('From top to bottom', 'dfd'),
					'dfd-bottom-to-top' => __('From bottom to top', 'dfd'),
					'dfd-left-to-right-shift' => __('From left to right shift image', 'dfd'),
					'dfd-right-to-left-shift' => __('From right to left shift image', 'dfd'),
					'dfd-top-to-bottom-shift' => __('From top to bottom shift image', 'dfd'),
					'dfd-bottom-to-top-shift' => __('From bottom to top shift image', 'dfd'),
					'portfolio-hover-style-1' => __('Following the mouse', 'dfd'),
					'dfd-rotate-content-up' => __('Rotate content up', 'dfd'),
					'dfd-rotate-content-down' => __('Rotate content down', 'dfd'),
					'dfd-rotate-left' => __('Rotate left', 'dfd'),
					'dfd-rotate-right' => __('Rotate right', 'dfd'),
					'dfd-rotate-top' => __('Rotate top', 'dfd'),
					'dfd-rotate-bottom' => __('Rotate bottom', 'dfd'),
				),
				'default' => 'dfd-fade-out',
			),
			array(
				'id' => 'dfd_gallery_hover_image_effect',
				'type' => 'select',
				'title' => __('Image effect', 'dfd'),
				'desc' => '',
				'options' => array(
					'panr' => __('Image parallax', 'dfd'),
					'dfd-image-scale' => __('Grow', 'dfd'),
					'dfd-image-scale-rotate' => __('Grow with rotation', 'dfd'),
					'dfd-image-shift-left' => __('Shift left', 'dfd'),
					'dfd-image-shift-right' => __('Shift right', 'dfd'),
					'dfd-image-shift-top' => __('Shift top', 'dfd'),
					'dfd-image-shift-bottom' => __('Shift bottom', 'dfd'),
					'dfd-image-blur' => __('Blur', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-left'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-right'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-top'),
					array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_main_dedcoration',
				'type' => 'select',
				'title' => __('Main decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'none' => __('None', 'dfd'),
					'heading' => __('Heading', 'dfd'),
					'plus' => __('Plus', 'dfd'),
					'lines' => __('Lines', 'dfd'),
					'dots' => __('Dots', 'dfd'),
				),
				'default' => 'custom',
			),
			array(
				'id' => 'dfd_gallery_hover_link',
				'type' => 'select',
				'title' => __('Hover link', 'dfd'),
				'desc' => '',
				'options' => array(
					'lightbox' => __('Open Gallery in lightbox', 'dfd'),
					'link' => __('Go to Gallery single item', 'dfd'),
				),
				'default' => 'custom',
			),
			array(
				'id' => 'dfd_gallery_hover_title_dedcoration',
				'type' => 'select',
				'title' => __('Heading decoration', 'dfd'),
				'desc' => '',
				'options' => array(
					'title-deco-none' => __('None', 'dfd'),
					'diagonal-line' => __('Diagonal line', 'dfd'),
					'title-underline' => __('Title underline', 'dfd'),
					'square-behind-heading' => __('Square behind heading', 'dfd'),
				),
				'default' => 'custom',
				'required' => array(
					array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_show_title',
				'type' => 'button_set', //the field type
				'title' => __('Enable titles', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => __('Enable subtitle', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on',
				'required' => array(
					array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_plus_position',
				'type' => 'select',
				'title' => __('Plus position', 'dfd'),
				'desc' => '',
				'options' => array(
					'dfd-middle' => __('Middle of the project', 'dfd'),
					'dfd-top-right' => __('Top right corner', 'dfd'),
					'dfd-top-left' => __('Top left corner', 'dfd'),
					'dfd-bottom-right' => __('Bottom right corner', 'dfd'),
					'dfd-bottom-left' => __('Bottom left corner', 'dfd'),
				),
				'default' => 'custom',
				'required' => array(
					array('dfd_gallery_hover_main_dedcoration', '=', 'plus'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_plus_bg',
				'type' => 'color',
				'title' => __('Plus background', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('dfd_gallery_hover_plus_position', 'not_empty_and', 'dfd-middle'),
				),
			),
			array(
				'id' => 'dfd_gallery_hover_text_color',
				'type' => 'color',
				'title' => __('Gallery hover text color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'dfd_gallery_hover_mask_style',
				'type' => 'select',
				'title' => __('Hover mask background style', 'dfd'),
				'desc' => '',
				'options' => array(
					'simple' => __('Simple color','dfd'),
					'gradient' => __('Gradient','dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'dfd_gallery_hover_bg',
				'type' => 'color',
				'title' => __('Gallery hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'dfd_gallery_hover_mask_style', "=", 'simple'
				),
			),
			array(
				'id' => 'dfd_gallery_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => __('Hover mask background gradient', 'dfd'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'dfd_gallery_hover_mask_style', "=", 'gradient'
				),
			),
			array(
				'id' => 'dfd_gallery_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Gallery hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),

		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Single items share options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'single_enable_facebook',
				'type' => 'button_set', //the field type
				'title' => __('Enable Facebook share button', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'single_enable_twitter',
				'type' => 'button_set', //the field type
				'title' => __('Enable Twitter share button', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'single_enable_google_plus',
				'type' => 'button_set', //the field type
				'title' => __('Enable Google Plus share button', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'single_enable_linkedin',
				'type' => 'button_set', //the field type
				'title' => __('Enable LinkedIN share button', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'single_enable_pinterest',
				'type' => 'button_set', //the field type
				'title' => __('Enable Pinterest share button', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Woocommerce Main Options', 'dfd'),
		'icon' => 'crdash-credit_card',
		'fields' => array(
			array(
				'id' => 'shop_title',
				'type' => 'text',
				'title' => esc_html__('Shop Title', 'dfd'),
				'default' => esc_html__('Best offers','dfd')
			),
			array(
				'id' => 'woo_top_link_src',
				'type' => 'select',
				'title' => __('Shop top link source', 'dfd'),
				'desc' => '',
				'options' => array(
					'page' => __('Page', 'dfd'),
					'url' => __('Custom url', 'dfd'),
				),
				'default' => 'chaffle',
			),
			array(
				'id' => 'woo_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Shop page select', 'dfd'),
				'desc' => __('Please select main blog page', 'dfd'),
				'required' => array(
					array('woo_top_link_src', '=', 'page'),
				),
			),
			array(
				'id' => 'woo_top_page_url',
				'type' => 'text',
				'title' => __('Shop page url', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'validate' => 'url',
				'required' => array(
					array('woo_top_link_src', '=', 'url'),
				),
				'default' => ''
			),
			/*array(
				'id' => 'woo_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Shop page select', 'dfd'),
				'desc' => __('Please select main shop page', 'dfd'),
			),*/
			array(
				'id' => 'woocommerce_catalogue_mode',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Enable catalogue mode', 'dfd'),
				'desc' => esc_html__('The products in shop category will be displayed without prices in this mode', 'dfd'),
				'options' => array('1' => esc_html__('On', 'dfd'), '0' => esc_html__('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'dfd_woocommerce_templates_path',
				'type' => 'select',
				'title' => esc_html__('Woocommerce style', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => esc_html__('Advanced','dfd'),
					'_old' => esc_html__('Old styles','dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'woo_products_loop_style',
				'type' => 'select',
				'title' => esc_html__('Product style', 'dfd'),
				'desc' => '',
				'options' => array(
					'style-1' => esc_html__('Standard','dfd'),
					'style-2' => esc_html__('Price and hover mask','dfd'),
					'style-3' => esc_html__('Hover mask','dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'style-1',
			),
			array(
				'id' => 'woo_products_buttons_color_scheme',
				'type' => 'select',
				'title' => esc_html__('Buttons style', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => esc_html__('Dark','dfd'),
					'dfd-buttons-light' => esc_html__('Light','dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'dfd-buttons-light',
			),
			array(
				'id' => 'woo_star_rating_color',
				'type' => 'color',
				'title' => esc_html__('Star rating color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id'       => 'woocommerce_archive_slideshow_speed',
				'type'     => 'text',
				'title'    => esc_html__( 'Product preview slideshow speed', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '2000',
			),
			array(
				'id' => 'woo_products_hover_mask_style',
				'type' => 'select',
				'title' => esc_html__('Hover mask background style', 'dfd'),
				'desc' => '',
				'options' => array(
					'simple' => esc_html__('Simple color','dfd'),
					'gradient' => esc_html__('Gradient','dfd'),
				),
				'required' => array(
					'woo_products_loop_style', "not_empty_and", 'style-1'
				),
				'default' => '',
			),
			array(
				'id' => 'woo_products_hover_bg',
				'type' => 'color',
				'title' => esc_html__('Products hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'woo_products_hover_mask_style', "=", 'simple'
				),
			),
			array(
				'id' => 'woo_products_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => esc_html__('Hover mask background gradient', 'dfd'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'woo_products_hover_mask_style', "=", 'gradient'
				),
			),
			array(
				'id' => 'woo_products_hover_bg_opacity',
				'type' => 'slider',
				'title' => esc_html__('Products hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Woocommerce Category Options', 'dfd'),
		'icon' => 'crdash-credit_card',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'woo_category_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'woo_category_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full_width' => __('Full width', 'dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => '',
			),
			array(
				'id' => 'woo_category_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Inherit from single layout settings', 'dfd'),
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => '',
			),
			array(
				'id' => 'woo_category_cat_tag',
				'type' => 'button_set', //the field type
				'title' => __('Enable categories, tags and author sorter', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'on'//this should be the key as defined above
			),
			/*array(
				'id' => 'woo_category_layout_style',
				'type' => 'select',
				'title' => __('Layout style', 'dfd'),
				'desc' => '',
				'options' => array(
					false => __('Woocommerce default', 'dfd'),
					'right-image' => __('Left image', 'dfd'),
					'left-image' => __('Right image', 'dfd'),
					'masonry' => __('Masonry', 'dfd'),
					'fitRows' => __('Grid', 'dfd'),
				),
				'default' => '',
			),
			array(
				'id' => 'woo_category_items_offset',
				'type' => 'text',
				'title' => __('Products offset (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '',
			),*/
			array(
				'id' => 'woo_category_columns',
				'type' => 'select',
				'title' => __('Number of columns', 'dfd'),
				'desc' => '',
				'options' => array(
					1 => __('One', 'dfd'),
					2 => __('Two', 'dfd'),
					3 => __('Three', 'dfd'),
					4 => __('Four', 'dfd'),
					//5 => __('Five', 'dfd'),
					//'6' => __('Six', 'dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 3,
			),
			array(
				'id'       => 'woo_category_products_number',
				'type'     => 'text',
				'title'    => __( 'Number of products per page to display', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '10',
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
			),
			array(
				'id' => 'woo_category_content_alignment',
				'type' => 'select', //the field type
				'title' => __('Content alignment', 'dfd'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => 'text-center',
				'required' => array(
					array('woo_category_show_description', '=', 'on'),
				),
			),
			array(
				'id' => 'woo_category_item_appear_effect',
				'type' => 'select',
				'title' => __('Items appear effect', 'dfd'),
				'desc' => '',
				'options' => dfd_module_animation_styles('options'),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => '',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Woocommerce Single Options', 'dfd'),
		'icon' => 'crdash-credit_card',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'woo_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => __('Enable stunning header', 'dfd'),
				'sub_desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'on'//this should be the key as defined above
			),
			array(
				'id' => 'woo_single_layout',
				'type' => 'select',
				'title' => __('Layout width', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Boxed', 'dfd'),
					'full-width' => __('Full width', 'dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => '',
			),
			array(
				'id' => 'woo_single_sidebars',
				'type' => 'select',
				'title' => __('Sidebars configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					'1col-fixed' => __('No sidebars', 'dfd'),
					'2c-l-fixed' => __('Left sidebar', 'dfd'),
					'2c-r-fixed' => __('Right sidebar', 'dfd'),
					'3c-fixed' => __('Both left and right sidebars', 'dfd'),
					'' => __('Inherit from single post settings', 'dfd'),
				),
				'default' => '1col-fixed',
			),
			array(
				'id' => 'woocommerce_hide_single_thumb',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Hide thumbnails on single product page', 'dfd'),
				'desc' => '',
				'options' => array('1' => esc_html__('On', 'dfd'), '0' => esc_html__('Off', 'dfd')),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => '0'
			),
			array(
				'id' => 'woo_single_columns_config',
				'type' => 'select',
				'title' => esc_html__('Image and description width configuration', 'dfd'),
				'desc' => '',
				'options' => array(
					2 => esc_html__('1/5 to 4/5', 'dfd'),
					3 => esc_html__('1/4 to 3/4', 'dfd'),
					4 => esc_html__('1/3 to 2/3', 'dfd'),
					5 => esc_html__('5/12 to 7/12', 'dfd'),
					6 => esc_html__('1/2 to 1/2', 'dfd'),
					7 => esc_html__('7/12 to 5/12', 'dfd'),
					8 => esc_html__('2/3 to 1/3', 'dfd'),
					9 => esc_html__('3/4 to 1/4', 'dfd'),
					10 => esc_html__('4/5 to 1/5', 'dfd'),
				),
				'default' => 7,
			),
			array(
				'id' => 'woo_single_thumb_position',
				'type' => 'select',
				'title' => esc_html__('Thumbnails position', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => esc_html__('Under image', 'dfd'),
					'thumbs-left' => esc_html__('To the left from image', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('woocommerce_hide_single_thumb', '=', '0'),
				),
			),
			array(
				'id' => 'woo_single_thumb_number',
				'type' => 'select',
				'title' => esc_html__('Number of thumbnails to show', 'dfd'),
				'desc' => '',
				'options' => array(
					1 => esc_html__('One', 'dfd'),
					2 => esc_html__('Two', 'dfd'),
					3 => esc_html__('Three', 'dfd'),
					4 => esc_html__('Four', 'dfd'),
					5 => esc_html__('Five', 'dfd'),
					6 => esc_html__('Six', 'dfd'),
					7 => esc_html__('Seven', 'dfd'),
					8 => esc_html__('Eight', 'dfd'),
				),
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 4,
			),
			array(
				'id' => 'woo_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => __('Enable inside pagination', 'dfd'),
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'sub_desc' => '',
				'required' => array(
					'dfd_woocommerce_templates_path', '!=', '_old'
				),
				'default' => 'on'
			),
			array(
				'id' => 'woo_single_pagination_style',
				'type' => 'select',
				'title' => __('Pagination position', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Fixed', 'dfd'),
					'top' => __('Top', 'dfd'),
				),
				'default' => '',
				'required' => array(
					array('woo_single_enable_pagination', '=', 'on'),
				),
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Default Button Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-coverflow',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id'          => 'default_button_typography_option',
				'type'        => 'typography',
				'title'       => __( 'Default Button Typography', 'redux-framework-demo' ),
				//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
				'google'      => true,
				// Disable google fonts. Won't work if you haven't defined your google api key
				//'font-backup' => true,
				// Select a backup non-google font in addition to a google font
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => true, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				// Enable all Google Font style/weight variations to be added to the page
				//'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				//'compiler'    => array( 'h2.site-description-compiler' ),
				// An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px',
				// Defaults to px
				'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '',
					'font-family' => 'texgyreadventorregular',
					'google'      => true,
					'font-size'   => '12px',
					'line-height' => '45px',
					'text-transform'=> 'uppercase',
					//'word-spacing'  => '0px',
					'letter-spacing'=> '2px',
					'color'	=> '#ffffff',
				),
			),
			array(
				'id' => 'default_button_hover_color',
				'type' => 'color',
				'title' => __('Default button hover text color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_background',
				'type' => 'color',
				'title' => __('Default button background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_background_opacity',
				'type' => 'slider',
				'title' => __('Default button background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_hover_bg',
				'type' => 'color',
				'title' => __('Default button hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Default button hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_border',
				'type' => 'color',
				'title' => __('Default button border color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_border_opacity',
				'type' => 'slider',
				'title' => __('Default button border opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_hover_border',
				'type' => 'color',
				'title' => __('Default button border color on hover', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_hover_border_opacity',
				'type' => 'slider',
				'title' => __('Default button border opacity on hover', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id'       => 'default_button_border_width',
				'type'     => 'text',
				'title'    => __( 'Default button border width', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '0',
			),
			array(
				'id' => 'default_button_border_style',
				'type' => 'select',
				'title' => __('Default button border style', 'dfd'),
				'options' => array(
					'solid' => __('Solid', 'dfd'),
					'dashed' => __('Dashed', 'dfd'),
					'dotted' => __('Dotted', 'dfd'),
				),
				'default' => 'solid',
			),
			array(
				'id'       => 'default_button_border_radius',
				'type'     => 'text',
				'title'    => __( 'Default button border radius', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 0,
			),
			array(
				'id'       => 'default_button_padding_left',
				'type'     => 'text',
				'title'    => __( 'Default button left padding', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 80,
			),
			array(
				'id'       => 'default_button_padding_right',
				'type'     => 'text',
				'title'    => __( 'Default button right padding', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 40,
			),
			array(
				'id'       => 'to_top_button_font_size',
				'type'     => 'text',
				'title'    => __( 'To Top button font size', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 14,
			),
			array(
				'id'       => 'to_top_button_size',
				'type'     => 'text',
				'title'    => __( 'To Top button size', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 45,
			),
			array(
				'id' => 'to_top_button_color',
				'type' => 'color',
				'title' => __('To Top button icon color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_hover_color',
				'type' => 'color',
				'title' => __('To Top button icon hover color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_background',
				'type' => 'color',
				'title' => __('To Top button background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_background_opacity',
				'type' => 'slider',
				'title' => __('To Top button background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'to_top_button_hover_bg',
				'type' => 'color',
				'title' => __('To Top button hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('To Top button hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'to_top_button_border',
				'type' => 'color',
				'title' => __('To Top button border color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_border_opacity',
				'type' => 'slider',
				'title' => __('To Top button border opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'to_top_button_hover_border',
				'type' => 'color',
				'title' => __('To Top button border color on hover', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'to_top_button_hover_border_opacity',
				'type' => 'slider',
				'title' => __('To Top button border opacity on hover', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id'       => 'to_top_button_border_width',
				'type'     => 'text',
				'title'    => __( 'To Top button border width', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '0',
			),
			array(
				'id' => 'to_top_button_border_style',
				'type' => 'select',
				'title' => __('To Top button border style', 'dfd'),
				'options' => array(
					'solid' => __('Solid', 'dfd'),
					'dashed' => __('Dashed', 'dfd'),
					'dotted' => __('Dotted', 'dfd'),
				),
				'default' => 'solid',
			),
			array(
				'id'       => 'to_top_button_border_radius',
				'type'     => 'text',
				'title'    => __( 'To Top button border radius', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 3,
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Styling Options', 'dfd'),
		//'desc' => __('<p class="description">Style parameters of body and footer</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-paintbrush',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Main site colors setup', 'dfd').'</h3>'
			),
			array(
				'id' => 'main_site_color',
				'type' => 'color',
				'title' => __('Main site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'secondary_site_color',
				'type' => 'color',
				'title' => __('Second site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'third_site_color',
				'type' => 'color',
				'title' => __('Third site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			/*array(
				'id' => 'fourth_site_color',
				'type' => 'color',
				'title' => __('Fourth site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),*/
			array(
				'id' => 'title_color',
				'type' => 'color',
				'title' => __('Default title color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'subtitle_color',
				'type' => 'color',
				'title' => __('Default subtitle color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'border_color',
				'type' => 'color',
				'title' => __('Border color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'background_gray',
				'type' => 'color',
				'title' => __('Light background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'info_sth',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Body styling options', 'dfd').'</h3>',
			),
			array(
				'id' => 'site_boxed',
				'type' => 'button_set',
				'title' => __('Boxed Body Layout', 'dfd'),
				'options' => array('1' => __('On','dfd'), '0' => __('Off','dfd')),
				'default' => '0',
			),
			//Body wrapper
			array(
				'id' => 'wrapper_bg_color',
				'type' => 'color',
				'title' => __('Content background color', 'dfd'),
				'desc' => __('Select background color.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'wrapper_bg_image',
				'type' => 'media',
				'title' => __('Content background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'wrapper_custom_repeat',
				'type' => 'select',
				'title' => __('Content bg image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => 'repeat'
			),
			array(
				'id' => 'info_bxd',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Boxed site options', 'dfd').'</h3>'
			),
			array(
				'id' => 'body_bg_color',
				'type' => 'color',
				'title' => __('Body background color', 'dfd'),
				'desc' => __('Select background color.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'body_bg_image',
				'type' => 'media',
				'title' => __('Custom background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'body_custom_repeat',
				'type' => 'select',
				'title' => __('Background image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => ''
			),
			array(
				'id' => 'body_bg_fixed',
				'type' => 'button_set',
				'title' => __('Fixed body background', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
			array(
				'id' => 'dfd_pagination_style',
				'type' => 'select',
				'title' => __('Pagination style', 'dfd'),
				'desc' => __('', 'dfd'),
				'options' => array(
					'1' => __('Style 1','dfd'),
					'2' => __('Style 2','dfd'),
					'3' => __('Style 3','dfd'),
					'4' => __('Style 4','dfd'),
					'5' => __('Style 5','dfd'),
				),
				'default' => ''
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Lightbox styling options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-photo',
		'fields' => array(
			array(
				'id' => 'enable_deep_links',
				'type' => 'button_set',
				'title' => __('Enable lightbox deep links', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'off'
			),
			array(
				'id' => 'enable_lightbox_counter',
				'type' => 'button_set',
				'title' => __('Enable lightbox slides navigation', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'lightbox_overlay_style',
				'type' => 'select',
				'title' => __('Background overlay style', 'dfd'),
				'desc' => '',
				'options' => array(
					'simple' => __('Simple color','dfd'),
					'gradient' => __('Gradient','dfd'),
				),
				'default' => 'simple'
			),
			array(
				'id' => 'lightbox_overley_bg_color',
				'type' => 'color',
				'title' => __('Lightbox overlay background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'lightbox_overlay_style', "=", 'simple' ),
			),
			array(
				'id' => 'lightbox_overley_color_gradient',
				'type' => 'color_gradient',
				'title' => __('Lightbox overlay background color', 'dfd'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array( 'lightbox_overlay_style', "=", 'gradient' ),
			),
			array(
				'id' => 'lightbox_overley_bg_opacity',
				'type' => 'slider',
				'title' => __('Lightbox overlay background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),
			array(
				'id' => 'lightbox_elements_color',
				'type' => 'color',
				'title' => __('Lightbox elements color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'enable_lightbox_share',
				'type' => 'button_set',
				'title' => __('Enable lightbox share', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'enable_lightbox_arrows',
				'type' => 'button_set',
				'title' => __('Enable lightbox navigation arrows', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'enable_zoom_button',
				'type' => 'button_set',
				'title' => __('Enable lightbox zoom button', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Link Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-thumb_tac',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id'          => 'link_typography_option',
				'type'        => 'typography',
				'title'       => __( 'Link Typography', 'redux-framework-demo' ),
				//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
				'google'      => true,
				// Disable google fonts. Won't work if you haven't defined your google api key
				//'font-backup' => true,
				// Select a backup non-google font in addition to a google font
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => true, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				// Enable all Google Font style/weight variations to be added to the page
				//'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				//'compiler'    => array( 'h2.site-description-compiler' ),
				// An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px',
				// Defaults to px
				'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '',
					'font-family' => 'Lora',
					'google'      => true,
					'font-size'   => '14px',
					'line-height' => '24px',
					'text-transform'=> 'none',
					//'word-spacing'  => '0px',
					'letter-spacing'=> '0px',
					'color'	=> '#242424',
				),
			),
			array(
				'id' => 'link_hover_color',
				'type' => 'color',
				'title' => __('Link hover color', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'link_decoration',
				'type' => 'select',
				'title' => __('Link decoration', 'dfd'),
				'desc' => __('', 'dfd'),
				'options' => array(
					'none' => __('None','dfd'),
					'solid' => __('Underline solid','dfd'),
					'dotted' => __('Underline dotted','dfd'),
					'dashed' => __('Underline dashed','dfd'),
				),
				'default' => ''
			),
			array(
				'id' => 'link_decoration_color',
				'type' => 'color',
				'title' => __('Link decoration color', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Inside pagination links general settings', 'dfd').'</h3>'
			),
			array(
				'id' => 'inside_pagination_arrow',
				'type' => 'select',
				'title' => __('Fixed pagination style', 'dfd'),
				'desc' => __('', 'dfd'),
				'options' => array(
					'text' => __('With text','dfd'),
					'arrows' => __('With arrows','dfd'),
				),
				'default' => 'text'
			),
			array(
				'id' => 'inside_pagination_hover',
				'type' => 'button_set',
				'title' => __('Enable hover animation', 'dfd'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on'
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Login page options', 'dfd'),
		//'desc' => __('<p class="description">More information about api keys and how to get it you can find in that tutorial <a href="http://dfd.name/twitter-settings">http://dfd.name/twitter-settings/</a></p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-paintbrush',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'custom_login_page',
				'type' => 'button_set',
				'title' => __('Add custom styles for login page', 'dfd'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'off'
			),
			array(
				'id' => 'custom_login_page_logo',
				'type' => 'button_set',
				'title' => __('Enable logo', 'dfd'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'required' => array( 'custom_login_page', "=", 'on' ),
				'default' => 'on'
			),
			array(
				'id' => 'login_page_bg_color',
				'type' => 'color',
				'title' => __('Login page background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'custom_login_page', "=", 'on' ),
			),
			array(
				'id' => 'login_page_bg_image',
				'type' => 'media',
				'title' => __('Login page background image', 'dfd'),
				'desc' => '',
				'default' => array(
					'url' => $assets_folder . 'img/login_bg.jpg'
				),
				'required' => array( 'custom_login_page', "=", 'on' ),
			),
			array(
				'id' => 'login_page_bg_image_size',
				'type' => 'select',
				'title' => __('Background size', 'dfd'),
				'options' => array(
					'initial' => __('Initial', 'dfd'),
					'cover' => __('Cover', 'dfd'),
					'contain' => __('Contain', 'dfd'),
				),
				'required' => array( 'login_page_bg_image', "!=", '' ),
				'default' => 'initial',
			),
			array(
				'id' => 'login_page_color_scheme',
				'type' => 'select',
				'title' => __('Color scheme', 'dfd'),
				'options' => array(
					'light' => __('Light', 'dfd'),
					'dark' => __('Dark', 'dfd'),
				),
				'required' => array( 'custom_login_page', "=", 'on' ),
				'default' => 'dark',
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => __('Responsive Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-paintbrush',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'x_large_responsive_breakpoint',
				'type' => 'slider',
				'title' => __('Large screen min-width', 'dfd'),
				'desc' => '',
				'min' => '1280',
				'max' => '1920',
				'step' => '1',
				'default' => '1280',
			),
			array(
				'id' => 'large_responsive_breakpoint',
				'type' => 'slider',
				'title' => __('Normal screen min-width', 'dfd'),
				'desc' => '',
				'min' => '1024',
				'max' => '1280',
				'step' => '1',
				'default' => '1024',
			),
			array(
				'id' => 'medium_responsive_breakpoint',
				'type' => 'slider',
				'title' => __('Medium screen min-width', 'dfd'),
				'desc' => '',
				'min' => '768',
				'max' => '1024',
				'step' => '1',
				'default' => '800',
			),
			array(
				'id' => 'small_responsive_breakpoint',
				'type' => 'slider',
				'title' => __('Small screen min-width', 'dfd'),
				'desc' => '',
				'min' => '480',
				'max' => '768',
				'step' => '1',
				'default' => '480',
			),
		),
	));
	$_title_typography_fields = array();

	$_default_font_family = array(
		1 => 'texgyreadventorregular',//h1 title
		2 => 'texgyreadventorregular',//h2 title
		3 => 'texgyreadventorregular',//h3 title
		4 => 'texgyreadventorregular',//h4 title
		5 => 'texgyreadventorregular',//h5 title
		6 => 'texgyreadventorregular',//h6 title
		7 => 'Droid Serif',//h1 subtitle
		8 => 'Droid Serif',//h2 subtitle
		9 => 'Droid Serif',//h3 subtitle
		10 => 'Droid Serif',//h4 subtitle
		11 => 'Droid Serif',//h5 subtitle
		12 => 'Droid Serif',//h6 subtitle
		13 => 'texgyreadventorregular',//stunning header title
		14 => 'texgyreadventorregular',//standard blog title
		15 => 'texgyreadventorregular',//widget title
		16 => 'texgyreadventorregular',//block title
		17 => 'texgyreadventorregular',//feature title
		18 => 'texgyreadventorregular',//box name
		19 => 'Droid Serif',//subtitle
		20 => 'Raleway',//text
		21 => 'Droid Serif',//entry-meta
	);
	$_default_font_size = array(
		1 => '55px',//h1 title
		2 => '45px',//h2 title
		3 => '35px',//h3 title
		4 => '30px',//h4 title
		5 => '22px',//h5 title
		6 => '18px',//h6 title
		7 => '18px',//h1 subtitle
		8 => '16px',//h2 subtitle
		9 => '14px',//h3 subtitle
		10 => '13px',//h4 subtitle
		11 => '13px',//h5 subtitle
		12 => '12px',//h6 subtitle
		13 => '35px',//stunning header title
		14 => '18px',//standard blog title
		15 => '13px',//widget title
		16 => '15px',//block title
		17 => '15px',//feature title
		18 => '14px',//box name
		19 => '13px',//subtitle
		20 => '14px',//text
		21 => '13px',//entry-meta
	);
	$_default_line_height_increment = array(
		1 => 1.2,//h1 title
		2 => 1.2,//h2 title
		3 => 1.2,//h3 title
		4 => 1.2,//h4 title
		5 => 1.2,//h5 title
		6 => 1.2,//h6 title
		7 => 2,//h1 subtitle
		8 => 1.875,//h2 subtitle
		9 => 1.43,//h3 subtitle
		10 => 1.38,//h4 subtitle
		11 => 1.38,//h5 subtitle
		12 => 1.25,//h6 subtitle
		13 => 1.6,//stunning header title
		14 => 1.6,//standard blog title
		15 => 1.6,//widget title
		16 => 1.92,//block title
		17 => 1.71,//feature title
		18 => 1.37,//box name
		19 => 1.72,//subtitle
		20 => 1.785,//text
		21 => 1.6,//entry-meta
	);
	$_default_font_weight = array(
		1 => '600',//h1 title
		2 => '600',//h2 title
		3 => '600',//h3 title
		4 => '600',//h4 title
		5 => '600',//h5 title
		6 => '600',//h6 title
		7 => '400',//h1 subtitle
		8 => '400',//h2 subtitle
		9 => '400',//h3 subtitle
		10 => '400',//h4 subtitle
		11 => '400',//h5 subtitle
		12 => '400',//h6 subtitle
		13 => '600',//stunning header title
		14 => '600',//standard blog title
		15 => '600',//widget title
		16 => '600',//block title
		17 => '600',//feature title
		18 => '600',//box name
		19 => '400',//subtitle
		20 => '400',//text
		21 => '300',//entry-meta
	);
	$_default_font_style = array(
		1 => 'normal',//h1 title
		2 => 'normal',//h2 title
		3 => 'normal',//h3 title
		4 => 'normal',//h4 title
		5 => 'normal',//h5 title
		6 => 'normal',//h6 title
		7 => 'italic',//h1 subtitle
		8 => 'italic',//h2 subtitle
		9 => 'italic',//h3 subtitle
		10 => 'italic',//h4 subtitle
		11 => 'italic',//h5 subtitle
		12 => 'italic',//h6 subtitle
		13 => 'normal',//stunning header title
		14 => 'normal',//standard blog title
		15 => 'normal',//widget title
		16 => 'normal',//block title
		17 => 'normal',//feature title
		18 => 'normal',//box name
		19 => 'italic',//subtitle
		20 => 'normal',//text
		21 => 'italic',//entry-meta
	);
	$_default_text_transform = array(
		1 => 'none',//h1 title
		2 => 'none',//h2 title
		3 => 'none',//h3 title
		4 => 'none',//h4 title
		5 => 'uppercase',//h5 title
		6 => 'none',//h6 title
		7 => 'none',//h1 subtitle
		8 => 'none',//h2 subtitle
		9 => 'none',//h3 subtitle
		10 => 'none',//h4 subtitle
		11 => 'none',//h5 subtitle
		12 => 'none',//h6 subtitle
		13 => 'none',//stunning header title
		14 => 'none',//standard blog title
		15 => 'uppercase',//widget title
		16 => 'none',//block title
		17 => 'none',//feature title
		18 => 'none',//box name
		19 => 'none',//subtitle
		20 => 'none',//text
		21 => 'none',//entry-meta
	);
	$_default_word_spacing = array(
		1 => '0px',//h1 title
		2 => '0px',//h2 title
		3 => '0px',//h3 title
		4 => '0px',//h4 title
		5 => '0px',//h5 title
		6 => '0px',//h6 title
		7 => '0px',//h1 subtitle
		8 => '0px',//h2 subtitle
		9 => '0px',//h3 subtitle
		10 => '0px',//h4 subtitle
		11 => '0px',//h5 subtitle
		12 => '0px',//h6 subtitle
		13 => '0px',//stunning header title
		14 => '0px',//standard blog title
		15 => '0px',//widget title
		16 => '0px',//block title
		17 => '0px',//feature title
		18 => '0px',//box name
		19 => '0px',//subtitle
		20 => '0px',//text
		21 => '0px',//entry-meta
	);
	$_default_letter_spacing = array(
		1 => '0px',//h1 title
		2 => '4px',//h2 title
		3 => '5px',//h3 title
		4 => '5px',//h4 title
		5 => '5px',//h5 title
		6 => '4px',//h6 title
		7 => '0px',//h1 subtitle
		8 => '0px',//h2 subtitle
		9 => '0px',//h3 subtitle
		10 => '0px',//h4 subtitle
		11 => '0px',//h5 subtitle
		12 => '0px',//h6 subtitle
		13 => '0px',//stunning header title
		14 => '0px',//standard blog title
		15 => '4px',//widget title
		16 => '0px',//block title
		17 => '0px',//feature title
		18 => '0px',//box name
		19 => '0px',//subtitle
		20 => '0px',//text
		21 => '0px',//entry-meta
	);
	$_default_option_name = array(
		1 => 'title_h1',//h1 title
		2 => 'title_h2',//h2 title
		3 => 'title_h3',//h3 title
		4 => 'title_h4',//h4 title
		5 => 'title_h5',//h5 title
		6 => 'title_h6',//h6 title
		7 => 'subtitle_h1',//h1 subtitle
		8 => 'subtitle_h2',//h2 subtitle
		9 => 'subtitle_h3',//h3 subtitle
		10 => 'subtitle_h4',//h4 subtitle
		11 => 'subtitle_h5',//h5 subtitle
		12 => 'subtitle_h6',//h6 subtitle
		13 => 'stunning_header_title',//standard blog title
		14 => 'blog_title',//standard blog title
		15 => 'widget_title',//widget title
		16 => 'block_title',//block title
		17 => 'feature_title',//feature title
		18 => 'box_name',//box name
		19 => 'subtitle',//subtitle
		20 => 'text',//text
		21 => 'entry_meta',//entry-meta
	);
	$_default_color = array(
		1 => '',//h1 title
		2 => '',//h2 title
		3 => '',//h3 title
		4 => '',//h4 title
		5 => '',//h5 title
		6 => '',//h6 title
		7 => '',//h1 subtitle
		8 => '',//h2 subtitle
		9 => '',//h3 subtitle
		10 => '',//h4 subtitle
		11 => '',//h5 subtitle
		12 => '',//h6 subtitle
		13 => '',//stunning header title
		14 => '',//standard blog title
		15 => '',//widget title
		16 => '',//block title
		17 => '',//feature title
		18 => '',//box name
		19 => '',//subtitle
		20 => '',//text
		21 => '',//entry-meta
	);
	$_default_option_title = array(
		1 => 'H1 Title',//h1 title
		2 => 'H2 Title',//h2 title
		3 => 'H3 Title',//h3 title
		4 => 'H4 Title',//h4 title
		5 => 'H5 Title',//h5 title
		6 => 'H6 Title',//h6 title
		7 => 'H1 Subtitle',//h1 subtitle
		8 => 'H2 Subtitle',//h2 subtitle
		9 => 'H3 Subtitle',//h3 subtitle
		10 => 'H4 Subtitle',//h4 subtitle
		11 => 'H5 Subtitle',//h5 subtitle
		12 => 'H6 Subtitle',//h6 subtitle
		13 => 'Stunning header title',//stunning header title
		14 => 'Blog heading',//standard blog title
		15 => 'Widget title',//widget title
		16 => 'Block Title',//block title
		17 => 'Features Title',//feature title
		18 => 'Box Name',//box name
		19 => 'Subtitle',//subtitle
		20 => 'Text',//text
		21 => 'Entry meta',//entry-meta
	);
	for ($i=1; $i<=21; $i++) {
		$_title_typography_fields[] = array(
			'id'          => $_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => true, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => false,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_default_font_style[$i],
				'font-weight'  => $_default_font_weight[$i],
				'font-family' => $_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_default_font_size[$i],
				'line-height' => $_default_font_size[$i] * $_default_line_height_increment[$i].'px',
				'text-transform'=> $_default_text_transform[$i],
				//'word-spacing'  => $_default_word_spacing[$i],
				'letter-spacing'=> $_default_letter_spacing[$i],
				'color'	=> $_default_color[$i],
			),
		);
	}

	$_title_typography_fields[] = array(
		'id' => 'disable_typography_responsive',
		'type' => 'button_set',
		'title' => __('Disable responsive mode for Heading module typography elements', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'// 1 = on | 0 = off
	);

	Redux::setSection( $opt_name, array(
			'title' => __('Custom typography', 'dfd'),
	//		'desc' => __('<p class="description"></p>', 'dfd'),
			'icon' => 'crdash-keyboard',
			'fields' => $_title_typography_fields,
	));

	Redux::setSection( $opt_name, array(
		'title' => __('Layouts Settings', 'dfd'),
		//'desc' => __('<p class="description">Configure layouts of different pages</p>', 'dfd'),
		'icon' => 'crdash-web_layout',
		'fields' => array(
			array(
				'id' => 'lazy_load_pagination_image',
				'type' => 'media',
				'title' => __('Lazy Load Pagination image', 'dfd'),
				'desc' => '',
				'default' => array(
						'url' => $assets_folder . 'img/lazy_load.gif'
					),
			),
			array(
				'id' => 'pages_layout',
				'type' => 'image_select',
				'title' => __('Single pages layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for single pages', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => 'pages_head_type',
				'type' => 'select',
				'title' => __('Single pages header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'archive_layout',
				'type' => 'image_select',
				'title' => __('Archive Pages Layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for archive pages', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '2c-r-fixed'
			),
			array(
				'id' => 'archive_head_type',
				'type' => 'select',
				'title' => __('Archive Pages header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'single_layout',
				'type' => 'image_select',
				'title' => __('Single posts layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for single posts', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '2c-r-fixed'
			),
			array(
				'id' => 'single_head_type',
				'type' => 'select',
				'title' => __('Single posts header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'search_layout',
				'type' => 'image_select',
				'title' => __('Search results layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for search results', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => 'search_head_type',
				'type' => 'select',
				'title' => __('Search results header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => '404_layout',
				'type' => 'image_select',
				'title' => __('404 Page Layout', 'dfd'),
				'sub_desc' => __('Select one of layouts for 404 page', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => '404_head_type',
				'type' => 'select',
				'title' => __('404 Page header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'layout_whitespace_size',
				'type' => 'slider',
				'title' => __('Layout whitespace size', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '50',
				'step' => '1',
				'default' => '30',
			),
			array(
				'id' => 'layout_whitespace_color',
				'type' => 'color',
				'title' => __('Layout whitespace color', 'dfd'),
				'default' => '#ffffff'
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title' => __('Twitter section options', 'dfd'),
		//'desc' => __('<p class="description">More information about api keys and how to get it you can find in that tutorial <a href="http://dfd.name/twitter-settings">http://dfd.name/twitter-settings/</a></p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			/*
			array(
				'id' => 't_panel_padding',
				'type' => 'button_set',
				'title' => __('Section padding', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
			array(
				'id' => 't_panel_bg_color',
				'type' => 'color',
				'title' => __('Background color for twitter panel', 'dfd'),
				'default' => '#f7f7f7'
			),
			array(
				'id' => 't_panel_bg_image',
				'type' => 'media',
				'title' => __('Background image for twitter panel', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'footer_tw_disp',
				'type' => 'button_set',
				'title' => __('Display twitter statuses before footer', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
			*/
			array(
				'id' => 'cachetime',
				'type' => 'text',
				'title' => __('Cache Tweets in every:', 'dfd'),
				'sub_desc' => __('In minutes', 'dfd'),
				'default' => '1'
			),
			array(
				'id' => 'numb_lat_tw',
				'type' => 'text',
				'title' => __('Number of latest tweets display:', 'dfd'),
				'default' => '10'
			),
			array(
				'id' => 'username',
				'type' => 'text',
				'title' => __('Username:', 'dfd'),
				'default' => 'Envato'
			),
			array(
				'id' => 'twiiter_consumer',
				'type' => 'text',
				'title' => __('Consumer key:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_con_s',
				'type' => 'text',
				'title' => __('Consumer secret:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_acc_t',
				'type' => 'text',
				'title' => __('Access token:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_acc_t_s',
				'type' => 'text',
				'title' => __('Access token secret:', 'dfd'),
				'default' => '',
			),
		),
	));
	Redux::setSection( $opt_name, array (
		'title' => __('Custom fonts', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array (
//							array (
//									'id' => 'opt-media',
//									'type' => 'media',
//									'url' => true,
//									'title' => __('Media w/ URL', 'redux-framework-demo'),
//									'desc' => __('Basic media uploader with disabled URL input field.', 'redux-framework-demo'),
//									'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
//									'library_filter'=>array("zip","jpeg"),
//									'default' => array (
//											'url' => 'http://s.wordpress.org/style/images/codeispoetry.png'
//									),
//							),
				array (
						'type' => 'custom_font',
						'id' => 'custom_font',
						'validate'=>'font_load',
						'title' => __('Font-face list:', 'redux-framework-demo'),
						'subtitle' => __('Upload .zip archive with font-face files.<br>(<a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Create you font-face package</a>)', 'redux-framework-demo'),
						'desc' => __('<span style="color:#F09191">Note:</span> You have to download the font-face.zip archive. <br>Pay your attention, that the archive has to contain the font-face files itself, and not the subfolders<br> (E.g.: font-face.zip/your-font-face.ttf, font-face.zip/your-font-face.eot, font-face.zip/your-font-face.woff etc. ).<br> They\'ll be extracted and assigned automatically.', 'redux-framework-demo'),
						'placeholder' => array (
								'title' => __('This is a title', 'redux-framework-demo'),
								'description' => __('Description Here', 'redux-framework-demo'),
								'url' => __('Give us a link!', 'redux-framework-demo'),
						),
//									'default_values'=>array(
//											"def_123", //font id
//									),
				),

		)
	));
	Redux::setSection( $opt_name, array (
		'title' => __('System Check', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-layout_alt2',
		'class' => 'system_check',

		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array (
				array (
						'type' => 'sysinfo',
						'id' => 'sysifo',
						'title' => __('System Check:', 'redux-framework-demo'),
						'subtitle' => __('Press run test to show you configuration', 'redux-framework-demo'),
				),

		)
	));

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

