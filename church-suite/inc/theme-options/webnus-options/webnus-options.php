<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "webnus_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
	$theme_bg_dir = get_template_directory_uri() . '/images/bgs/bg-pattern/';

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
        'menu_title'           => esc_html__( 'Theme Options', 'webnus_framework' ),
        'page_title'           => esc_html__( 'Theme Options', 'webnus_framework' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
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
        'page_slug'            => 'webnus_theme_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

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

        //'compiler'             => true,

        'hide_expand'			=> true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
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

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

	$ext_path = get_template_directory() . '/inc/theme-options/extensions/';
	Redux::setExtensions( $opt_name, $ext_path );

	/*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    $keyses = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array(),
			),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);

	$webnus_socials = array (
		'dribbble'		=> 'dribbble',
		'facebook'		=> 'facebook',
		'flickr'		=> 'flickr',
		'foursquare'	=> 'foursquare',
		'github'		=> 'github',
		'google-plus'	=> 'google-plus',
		'instagram'		=> 'instagram',
		'lastfm'		=> 'lastfm',
		'linkedin'		=> 'linkedin',
		'pinterest'		=> 'pinterest',
		'reddit'		=> 'reddit',
		'soundcloud'	=> 'soundcloud',
		'spotify'		=> 'spotify',
		'tumblr'		=> 'tumblr',
		'twitter'		=> 'twitter',
		'vimeo'			=> 'vimeo',
		'vine'			=> 'vine',
		'yelp'			=> 'yelp',
		'yahoo'			=> 'yahoo',
		'youtube'		=> 'youtube',
		'wordpress'		=> 'wordpress',
		'dropbox'		=> 'dropbox',
		'evernote'		=> 'evernote',
		'envato'		=> 'envato',
		'skype'			=> 'skype',
		'feed'			=> 'feed',
	);

	// SSL VALUE
	$backend_protocol = ( is_ssl() ) ? 'https' : 'http' ;

	$fonts = array (
		'Open Sans,arial,helvatica' => 'Open Sans',
		'BebasRegular,arial,helvatica' => 'Bebas Regular',
		'LeagueGothicRegular,arial,helvatica' => 'League Gothic Regular',
		'Arial,helvetica,sans-serif' => 'Arial',
		'helvetica,sans-serif,arial' => 'Helvatica',
		'sans-serif,arial,helvatica' => 'Sans Serif',
		'verdana,san-serif,helvatica' => 'Verdana' ,
		'custom-font-1' => 'webnus_custom_font1',
		'Custom Font 2' => 'webnus_custom_font2',
		'Custom Font 3' => 'webnus_custom_font3',
		'typekit-font-1' => 'webnus_typekit_font1',
		'typekit-font-2' => 'webnus_typekit_font2',
		'typekit-font-3' => 'webnus_typekit_font3',
	);

    // -> START Layout Fields
    Redux::setSection( $opt_name, array(
        'title'		=> esc_html__( 'Layout', 'webnus_framework' ),
        'id'		=> 'layout_opts',
        'icon'		=> 'ti-layout',
        'fields'	=> array(
        	array(
				'title'		=> esc_html__( 'Template', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Select your desired template from the the list.', 'webnus_framework' ),
				'id'		=> 'webnus_template_select',
				'type'		=> 'image_select',
				'full_width'=> true,
				'default'	=> 'remittal',
				'options'	=> array(
					'remittal' => array(
						'alt' => esc_html__( 'Remittal', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/template1.jpg'
					),
					'pax' => array(
						'alt' => esc_html__( 'Pax', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/template2.jpg'
					),
					'solace' => array(
						'alt' => esc_html__( 'Solace', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/template3.jpg'
					),
					'trust' => array(
						'alt' => esc_html__( 'Trust', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/template4.jpg'
					),
				),
			),
			array(
				'title'		=> esc_html__( 'Responsive', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Disable this option in case you don\'t need a responsive website.', 'webnus_framework' ),
				'id'		=> 'webnus_enable_responsive',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'CSS Minifyer', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Enable this option to minify your styles. It\'ll decrease size of your style-sheet files to speed up your website.', 'webnus_framework' ),
				'id'		=> 'webnus_css_minifier',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Smooth Scroll', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'By enabling this option, your page will have smooth scrolling effect.','webnus_framework' ),
				'id'		=> 'webnus_enable_smoothscroll',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Scroll To Top', 'webnus_framework' ),
				'id'		=> 'webnus_scrollup',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Layout', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Select boxed or wide layout. in Boxed you can set background from "Styling Options > Background".','webnus_framework' ),
				'id'		=> 'webnus_background_layout',
				'type'		=> 'button_set',
				'default'	=> 'wide',
				'options'	=> array(
					'wide'		 => esc_html__( 'Wide', 'webnus_framework' ),
					'boxed-wrap' => esc_html__( 'Boxed', 'webnus_framework' ),
				),
			),
			array(
				'title'		=> esc_html__( 'Container max-width', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'You can define width of your website. ( Max width: 1170px )','webnus_framework' ),
				'id'		=> 'webnus_container_width',
				'type'		=> 'text',
			),
        ),
    ) );



	// -> START Header Options Fields
    Redux::setSection( $opt_name, array(
        'title'		=> esc_html__( 'Header Options', 'webnus_framework' ),
        'desc'		=> esc_html__( 'Everything about headers, Logo, Menus and contact information are here:', 'webnus_framework' ),
        'id'		=> 'header_opts',
        'icon'		=> 'ti-layout-tab-window',
	));

	Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Logo', 'webnus_framework' ),
	'id'               => 'header_general_opts',
	'subsection'       => true,
	'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Logo', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Choose an image file for your logo. For Retina displays please add Image in large size and set custom width.', 'webnus_framework' ),
				'id'		=> 'webnus_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Logo width', 'webnus_framework' ),
				'id'		=> 'webnus_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
			),
			array(
				'title'		=> esc_html__( 'Transparent logo', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Choose an image file for your Transparent header logo', 'webnus_framework' ),
				'id'		=> 'webnus_transparent_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Transparent logo width', 'webnus_framework' ),
				'id'		=> 'webnus_transparent_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
			),
			array(
				'title'		=> esc_html__( 'Header padding-top', 'webnus_framework' ),
				'id'		=> 'webnus_header_padding_top',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Header padding-bottom', 'webnus_framework' ),
				'id'		=> 'webnus_header_padding_bottom',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Text logo', 'webnus_framework' ),
				'id'		=> 'webnus_slogan',
				'subtitle'	=> esc_html__( 'If you do not set logo, this text appears instead of that.' ),
				'type'		=> 'text',
			),
        ),
    ) );

	Redux::setSection( $opt_name, array(
		'title'            => __( 'Header Layout', 'webnus_framework' ),
		'id'               => 'header_layout_opts',
		'subsection'       => true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Select Header Layout', 'webnus_framework' ),
				'id'		=> 'webnus_header_menu_type',
				'type'		=> 'image_select',
				'default'		=> '1',
				'options'	=> array(
					'0' => array(
						'alt' => 'Header Type 0',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu0.png'
					),
					'1' => array(
						'alt' => 'Header Type 1',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu1.png'
					),
					'2' => array(
						'alt' => 'Header Type 2',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu2.png'
					),
					'3' => array(
						'alt' => 'Header Type 3',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu3.png'
					),
					'4' => array(
						'alt' => 'Header Type 4',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu4.png'
					),
					'5' => array(
						'alt' => 'Header Type 5',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu5.png'
					),
					'6' => array(
						'alt' => 'Header Type 6',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu6.png'
					),
					'7' => array(
						'alt' => 'Header Type 7',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu7.png'
					),
					'8' => array(
						'alt' => 'Header Type 8',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu8.png'
					),
					'9' => array(
						'alt' => 'Header Type 9',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu9.png'
					),
					'10' => array(
						'alt' => 'Header Type 10',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu10.png'
					),
				),
				'full_width'	=> true,
			),
			array(
				'id'     => 'opt-notice-warning',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'warning',
				'title'  => __( 'Set Menus', 'webnus_framework' ),
				'desc'   => __( 'After saving your setting, please go to "Appearance > Menus" and create menus then set them to Duplex Menu Left and Right.', 'webnus_framework' ),
				'required'  => array( 'webnus_header_menu_type', '=', '8' ),
			),
			array(
				'title'		=> esc_html__( 'Submenu Style', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'For Header Menu and Topbar Menu' ),
				'id'		=> 'webnus_dark_submenu',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options' => array(
					'0' => 'Light',
					'1' => 'Dark',
				 ),
			),
			array(
				'title'		=> esc_html__( 'Header Background Image', 'webnus_framework' ),
				'id'		=> 'webnus_header_background',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'webnus_header_menu_type', '=', '6' ),
			),
			array(
				'id'		=> 'webnus_header_logo_alignment',
				'type'		=> 'button_set',
				'title'		=> __('Logo Alignment', 'webnus_framework'),
				'subtitle'	=> __('This option changes the position of the logo on top of the header.', 'webnus_framework'),
				'options'	=> array(
					'1'		=> 'Left',
					'2'		=> 'Center',
					'3'		=> 'Right'
				 ),
				'default'	=> '2',
				'required'  => array( 'webnus_header_menu_type', '=', array('2','3','4','5','9') ),
			),
			array(
				'id'		=> 'webnus_header_search_enable',
				'title'		=> __('Search in Header', 'webnus_framework'),
				'subtitle'	=> __('This option shows a search icon at the end of the header menu.', 'webnus_framework'),
				'type'		=> 'switch',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
				'default'	=> '1',
				'required'  => array( 'webnus_header_menu_type', '=', array('1') ),
			),
			array(
				'id'		=> 'webnus_header_logo_rightside',
				'title'		=> __('Header Next Side Space', 'webnus_framework'),
				'type'		=> 'button_set',
				'options'	=> array(
					'0'		=> 'None',
					'1'		=> 'Search Box',
					'2'		=> 'Contact Information',
					'3'		=> 'Header Sidebar'
				 ),
				'default'	=> '2',
				'required'  => array( 'webnus_header_menu_type', '=', array( '2', '3', '4', '5', '9' ) ),
			),
			array(
				'id'		=> 'webnus_header_phone',
				'title'		=> __('Header Phone Number', 'webnus_framework'),
				'type'		=> 'textarea',
				'default'	=> '+1 234 56789',
				'required'	=> array( 'webnus_header_logo_rightside', '=', array('2') ),
			),
			array(
				'id'		=> 'webnus_header_email',
				'title'		=> __('Header Email Address', 'webnus_framework'),
				'type'		=> 'textarea',
				'default'	=> 'info@yourdomain.com',
				'required'	=> array( 'webnus_header_logo_rightside', '=', array('2') ),
			),
			array(
				'title'		=> esc_html__( 'AJAX Live Search', 'webnus_framework' ),
				'id'		=> 'webnus_enable_livesearch',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enable', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disable', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Mobile Menu', 'webnus_framework' ),
				'subtitle'	=> 'Choose between two type of menu style for mobile and tablet sizes.',
				'id'		=> 'webnus_header_menu_icon',
				'type'		=> 'image_select',
				'options'	=> array(
					'sm-rgt-ms'      => array(
						'alt'  => 'Modern',
						'img'  => ReduxFramework::$_url . '../webnus-options/assets/img/menu-icon1.png'
					),
					''      => array(
						'alt'  => 'Classic',
						'img'  => ReduxFramework::$_url . '../webnus-options/assets/img/menu-icon2.png'
					),

				),
				'default'	=> 'sm-rgt-ms',
			),
		),
	));

	Redux::setSection( $opt_name, array(
	'title'            => __( 'Sticky Header', 'webnus_framework' ),
	'id'               => 'header_menu_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Sticky Header', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Sticky header is a fixed header when scrolling the page.By enabling this option when you are scrolling, the header menu will scroll too.', 'webnus_framework' ),
				'id'		=> 'webnus_header_sticky',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Sticky Header In Phone', 'webnus_framework' ),
				'id'		=> 'webnus_header_sticky_phone',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
				'required'	=> array( 'webnus_header_sticky', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Sticky header logo', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Use this option to upload a logo which will be used when header is on sticky state.', 'webnus_framework' ),
				'id'		=> 'webnus_sticky_logo',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'webnus_header_sticky', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Sticky header logo width', 'webnus_framework' ),
				'id'		=> 'webnus_sticky_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
				'required'  => array( 'webnus_header_sticky', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Scrolls value to sticky the header', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Fill your desired amount which by scrolling that amount, sticky menu will appear.', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_header_sticky_scrolls',
				'validate'	=> 'numeric',
				'default'	=> '380',
				'required'  => array( 'webnus_header_sticky', '=', '1' ),
			),
		),
    ) );


	Redux::setSection( $opt_name, array(
	'title'            => __( 'Topbar', 'webnus_framework' ),
	'id'               => 'topbar_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'TopBar', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Top bar is the topmost location in your website that you can place special elements in.', 'webnus_framework' ),
				'id'		=> 'webnus_header_topbar_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),

			array(
				'title'		=> esc_html__( 'Background Color', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'This option changes the background color of Topbar.', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_background_color',
				'type'		=> 'color',
				'output'	=> array(
					'background-color' => '#wrap .top-bar',
				),
			),

			array(
				'title'		=> esc_html__( 'Fixed TopBar', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_fixed',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Search Bar', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_search',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Login Modal', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_login',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Login Modal Link Text', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_login_text',
				'type'		=> 'text',
				'default'	=> 'Login / Register',
				'required'  => array( 'webnus_topbar_login', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Modal', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_contact',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Select Contact Form', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_form',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array( 'post_type' => 'wpcf7_contact_form', ),
				'required'	=> array( 'webnus_topbar_contact', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Information', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_info',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Contact Phone Number', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_topbar_phone',
				'default'	=> '+1 234 56789',
				'required'  => array( 'webnus_topbar_info', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Email Address', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_topbar_email',
				'default'	=> 'info@site.com',
				'required'  => array( 'webnus_topbar_info', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Topbar Menu', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_menu',
				'subtitle'	=> esc_html__( 'you should create Topbar Menu from apearance > menus.'),
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Language Bar', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Polylang / WPML'),
				'id'		=> 'webnus_topbar_language',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Custom Text', 'webnus_framework' ),
				'id'		=> 'webnus_topbar_custom',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Your Custom Text', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Insert any text'),
				'id'		=> 'webnus_topbar_text',
				'type'		=> 'text',
				'required'  => array( 'webnus_topbar_custom', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Social Icons', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Set in Social Networks Tab'),
				'id'		=> 'webnus_topbar_social',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				),
			),

			array(
				'title'		=> esc_html__( 'Facebook Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_facebook',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Twitter Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_twitter',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Dribbble Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_dribbble',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Pinterest Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_pinterest',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Vimeo Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_vimeo',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Youtube Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_youtube',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Google+ Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_google',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'LinkedIn Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_linkedin',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'RSS Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_rss',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Instagram Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_instagram',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Flickr Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_flickr',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Reddit Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_reddit',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Delicious Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_delicious',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'LastFM Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_lastfm',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Tumblr Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_tumblr',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),
			array(
				'title'		=> esc_html__( 'Skype Icon', 'webnus_framework' ),
				'id'		=> 'webnus_top_social_icons_skype',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
				'required'  => array( 'webnus_topbar_social', '=', array( 'left', 'right' ) ),
			),

		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'            => __( 'Toggle Top Area', 'webnus_framework' ),
	'id'               => 'toggle_top_area_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Toggle Top Area', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'It loads a small plus icon to the top right corner of your website.By clicking on it, it opens and shows your content that you set before.','webnus_framework' ),
				'id'		=> 'webnus_toggle_toparea_enable',
				'type'		=> 'switch',
				'default'	=> 0,
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'				=> esc_html__( 'Favicon and Apple Icons', 'webnus_framework' ),
	'id'				=> 'fav_icons_opts',
	'subsection'		=> true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Custom Favicon', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'An icon that will show in your browser tab near to your websites title, icon size is : (16 X 16)px','webnus_framework' ),
				'id'		=> 'webnus_favicon',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Apple iPhone Icon', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Icon for Apple iPhone (57px x 57px)', 'webnus_framework' ),
				'id'		=> 'webnus_apple_iphone_icon',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Apple iPad Icon', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Icon for Apple iPad (72px x 72px)', 'webnus_framework' ),
				'id'		=> 'webnus_apple_ipad_icon',
				'type'		=> 'media',
				'url'		=> true,
			),
		),
    ) );


	Redux::setSection( $opt_name, array(
	'title'            => __( 'Admin Login Logo', 'webnus_framework' ),
	'id'               => 'admin_logo_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Admin Login Logo', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'webnus_framework' ),
				'id'		=> 'webnus_admin_login_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'            => __( 'News Ticker', 'webnus_framework' ),
	'id'               => 'header_newsticker_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'News Ticker', 'webnus_framework' ),
				'id'		=> 'webnus_news_ticker',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),

			array(
				'title'		=> esc_html__( 'News Ticker Title', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_nt_title',
				'default'	=> 'Latest Posts',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Show in', 'webnus_framework' ),
				'id'		=> 'webnus_nt_show',
				'type'		=> 'button_set',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
				'type'		=> 'button_set',
				'default'	=> '0',
				'options' => array(
					'0' => 'Home',
					'1' => 'All Pages',
				 ),
			),

			array(
				'title'		=> esc_html__( 'Category', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Select specific category, leave blank to show all categories.' ),
				'id'		=> 'webnus_nt_cat',
				'type'		=> 'select',
				'data'		=> 'category',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Post Count', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_nt_count',
				'validate' => 'numeric',
				'default'	=> '5',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Animation Type', 'webnus_framework' ),
				'id'		=> 'webnus_nt_effect',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options' => array(
					'0' => 'Fade',
					'1' => 'Reveal',
				 ),
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Animation Speed	', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_nt_speed',
				'validate' => 'numeric',
				'default'	=> '1',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Pause On Items', 'webnus_framework' ),
				'type'		=> 'text',
				'id'		=> 'webnus_nt_pause',
				'validate' => 'numeric',
				'default'	=> '2',
				'required'  => array( 'webnus_news_ticker', '=', '1' ),
			),

		),
    ) );

	// -> START Footer Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Options', 'webnus_framework' ),
		'id'		=> 'start_footer_opts',
		'icon'		=> 'ti-layout-accordion-merged',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Top Area', 'webnus_framework' ),
		'id'		=> 'footer_top_area_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Footer Social Bar', 'webnus_framework'),
				'subtitle'	=> esc_html__('Set in Social Networks Tab.', 'webnus_framework'),
				'id'		=> 'webnus_footer_social_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Footer Instagram Bar', 'webnus_framework'),
				'id'		=> 'webnus_footer_instagram_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Instagram Username', 'webnus_framework'),
				'id'		=> 'webnus_footer_instagram_username',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_instagram_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Instagram Access Token', 'webnus_framework'),
				'subtitle'	=> wp_kses( __('Get the this information <a target="_blank" href="' . $backend_protocol . '://www.pinceladasdaweb.com.br/instagram/access-token/">here</a>.', 'webnus_framework'), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'id'		=> 'webnus_footer_instagram_access',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_instagram_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Subscribe Bar', 'webnus_framework'),
				'id'		=> 'webnus_footer_subscribe_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Footer Subscribe Text', 'webnus_framework'),
				'id'		=> 'webnus_footer_subscribe_text',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_subscribe_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Subscribe Service', 'webnus_framework'),
				'id'		=> 'webnus_footer_subscribe_type',
				'type'		=> 'button_set',
				'default'	=> 'FeedBurner',
				'options'	=> array(
					'FeedBurner'	=> esc_html__( 'FeedBurner', 'webnus_framework' ),
					'MailChimp'		=> esc_html__( 'MailChimp', 'webnus_framework' ),
				),
				'required'  => array( 'webnus_footer_subscribe_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Feedburner ID', 'webnus_framework'),
				'id'		=> 'webnus_footer_feedburner_id',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_subscribe_type', '=', 'FeedBurner' ),
			),
			array(
				'title'		=> esc_html__('Mailchimp URL', 'webnus_framework'),
				'sub_desc'	=> esc_html__('Mailchimp form action URL', 'webnus_framework'),
				'id'		=> 'webnus_footer_mailchimp_url',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_subscribe_type', '=', 'MailChimp' ),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer', 'webnus_framework' ),
		'id'		=> 'footer_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Footer Type', 'webnus_framework' ),
				'subtitle'	=> wp_kses( __( 'Choose among these structures (1column, 2column, 3column and 4column) for your footer section.<br>To filling these column sections you should go to appearance > widget. And put every widget that you want in these sections.','webnus_framework'), array( 'br' => array() ) ),
				'id'		=> 'webnus_footer_type',
				'type'		=> 'image_select',
				'full_width'=> true,
				'default'	=> '1',
				'options'  => array(
					'1' => array(
						'alt' => esc_html__( 'Footer Layout 1', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer1.png'
					),
					'2' => array(
						'alt' => esc_html__( 'Footer Layout 2', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer2.png'
					),
					'3' => array(
						'alt' => esc_html__( 'Footer Layout 3', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer3.png'
					),
					'4' => array(
						'alt' => esc_html__( 'Footer Layout 4', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer4.png'
					),
					'5' => array(
						'alt' => esc_html__( 'Footer Layout 5', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer5.png'
					),
					'6' => array(
						'alt' => esc_html__( 'Footer Layout 6', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer6.png'
					),
				),
			),
			array(
				'title'		=> esc_html__( 'Footer Background Color', 'webnus_framework'),
				'id'		=> 'webnus_footer_color',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options'	=> array(
					'1'		=> esc_html__( 'Dark', 'webnus_framework' ),
					'2'		=> esc_html__( 'Light', 'webnus_framework' ),
				),
			),
			array(
				'title'		=> esc_html__( 'Custom Footer background color', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Pick a background color', 'webnus_framework' ),
				'id'		=> 'webnus_footer_background_color',
				'type'		=> 'color',
				'output'	=> array(
					'background-color' => '#wrap #footer',
				),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Bottom Area', 'webnus_framework' ),
		'id'		=> 'footer_bottom_area_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Footer Bottom', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'This option shows a section below the footer that you can put copyright menu and logo in it.', 'webnus_framework' ),
				'id'		=> 'webnus_footer_bottom_enable',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Footer bottom background color', 'webnus_framework'),
				'subtitle'	=> esc_html__('Pick a background color', 'webnus_framework'),
				'id'		=> 'webnus_footer_bottom_background_color',
				'type'		=> 'color',
				'required'  => array( 'webnus_footer_bottom_enable', '=', '1' ),
				'output'	=> array(
					'background-color' => '#wrap #footer .footbot',
				),
			),
			array(
				'title'		=> esc_html__('Footer Bottom Left', 'webnus_framework'),
				'id'		=> 'webnus_footer_bottom_left',
				'type'		=> 'button_set',
				'default'	=> '3',
				'options'	=> array(
					'1' => esc_html__( 'Logo', 'webnus_framework' ),
					'2' => esc_html__( 'Menu', 'webnus_framework' ),
					'3' => esc_html__( 'Custom Text', 'webnus_framework' ),
					'4' => esc_html__( 'Social Icons', 'webnus_framework' ),
				),
				'required'  => array( 'webnus_footer_bottom_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Bottom Right', 'webnus_framework'),
				'id'		=> 'webnus_footer_bottom_right',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options'	=> array(
					'1' => esc_html__( 'Logo', 'webnus_framework' ),
					'2' => esc_html__( 'Menu', 'webnus_framework' ),
					'3' => esc_html__( 'Custom Text', 'webnus_framework' ),
					'4' => esc_html__( 'Social Icons', 'webnus_framework' ),
				),
				'required'  => array( 'webnus_footer_bottom_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Logo', 'webnus_framework'),
				'subtitle'	=> esc_html__('Please choose an image file for footer logo.', 'webnus_framework'),
				'id'		=> 'webnus_footer_logo',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'webnus_footer_bottom_enable', '=', '1' ),
			),
            array(
				'title'		=> esc_html__( 'Footer Logo width', 'webnus_framework' ),
				'id'		=> 'webnus_footer_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
                'default'	=> '65'
			),
			array(
				'title'		=> esc_html__('Footer Custom Text', 'webnus_framework'),
				'id'		=> 'webnus_footer_copyright',
				'type'		=> 'text',
				'required'  => array( 'webnus_footer_bottom_enable', '=', '1' ),
			),
		),
	) );


	// -> START Footer Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Church Options', 'webnus_framework' ),
		'id'		=> 'church_opts',
		'icon'		=> 'ti-book',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Booking', 'webnus_framework' ),
		'id'		=> 'booking_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Event Booking', 'webnus_framework' ),
				'id'		=> 'webnus_booking_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Event Booking Form', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Choose previously created contact form from the drop down list.', 'webnus_framework' ),
				'id'		=> 'webnus_booking_form',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array( 'post_type' => 'wpcf7_contact_form', ),
				'required'	=> array( 'webnus_booking_enable', '=', '1' ),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Sermon', 'webnus_framework' ),
		'id'		=> 'sermon_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Single Sermon Sidebar', 'webnus_framework' ),
				'id'		=> 'webnus_singlesermon_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'webnus_framework' ),
					'left'	=> esc_html__( 'Left', 'webnus_framework' ),
					'right'	=> esc_html__( 'Right', 'webnus_framework' ),
				 ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Speaker', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_speaker',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Date', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_date',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Category', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_category',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Comments', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_comments',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Views', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_views',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Featured Image on Sermon Post', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_featuredimage',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Social Share Links', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_social_share',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Show Sermon Speaker Box', 'webnus_framework' ),
				'id'		=> 'webnus_sermon_speakerbox',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Show Recent Sermons', 'webnus_framework' ),
				'id'		=> 'webnus_recent_sermons',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Cause', 'webnus_framework' ),
		'id'		=> 'cause_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Single Cause Sidebar', 'webnus_framework' ),
				'id'		=> 'webnus_singlecause_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'none',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'webnus_framework' ),
					'left'	=> esc_html__( 'Left', 'webnus_framework' ),
					'right'	=> esc_html__( 'Right', 'webnus_framework' ),
				 ),
			),
			array(
				'title'		=> esc_html__( 'Donate Form', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Choose previously created contact form from the drop down list.', 'webnus_framework' ),
				'id'		=> 'webnus_donate_form',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array( 'post_type' => 'wpcf7_contact_form', ),
				'required'	=> array( 'webnus_booking_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Currency', 'webnus_framework' ),
				'id'		=> 'webnus_cause_currency',
				'type'		=> 'text',
				'default'	=> '$',
			),
			array(
				'title'		=> esc_html__( 'Metadata Date', 'webnus_framework' ),
				'id'		=> 'webnus_cause_date',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Category', 'webnus_framework' ),
				'id'		=> 'webnus_cause_category',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Comments', 'webnus_framework' ),
				'id'		=> 'webnus_cause_comments',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Metadata Views', 'webnus_framework' ),
				'id'		=> 'webnus_cause_views',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Featured Image on Cause Post', 'webnus_framework' ),
				'id'		=> 'webnus_cause_featuredimage',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Social Share Links', 'webnus_framework' ),
				'id'		=> 'webnus_cause_social_share',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
		),
	) );

	// -> START Pages Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Pages', 'webnus_framework' ),
		'id'		=> 'pages_opts',
		'icon'		=> 'sl-docs',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( '404 Page', 'webnus_framework' ),
		'id'		=> '404_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Text To Display', 'webnus_framework' ),
				'id'		=> 'webnus_404_text',
				'type'		=> 'ace_editor',
				'theme'		=> 'chrome',
				'mode'		=> 'php',
				'default'	=> '<h3>We\'re sorry, but the page you were looking for doesn\'t exist.</h3>',
				'full_width'=> true,
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Breadcrumbs', 'webnus_framework' ),
		'id'		=> 'breadcrumbs_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Breadcrumbs', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'It allows users to keep track of their locations within pages.','webnus_framework' ),
				'id'		=> 'webnus_enable_breadcrumbs',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
		),
	) );

	// -> START Blog Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Blog Options', 'webnus_framework' ),
		'id'		=> 'blog-opts',
		'icon'		=> 'ti-pencil-alt',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Blog Page', 'webnus_framework' ),
		'id'		=> 'blog-page-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'BlogTemplate', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'For styling your blog page you can choose among these template layouts.', 'webnus_framework' ),
				'id'		=> 'webnus_blog_template',
				'type'		=> 'image_select',
				'full_width'=> true,
				'default'	=> '2',
				'options'	=> array(
					'1' => array(
						'alt' => esc_html__( 'Blog Type 1', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type1.png'
					),
					'2' => array(
						'alt' => esc_html__( 'Blog Type 2', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type2.png'
					),
					'3' => array(
						'alt' => esc_html__( 'Blog Type 3', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type3.png'
					),
					'4' => array(
						'alt' => esc_html__( 'Blog Type 4', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type4.png'
					),
					'5' => array(
						'alt' => esc_html__( 'Blog Type 5', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type5.png'
					),
					'6' => array(
						'alt' => esc_html__( 'Blog Type 6', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type6.png'
					),
					'7' => array(
						'alt' => esc_html__( 'Blog Type 7', 'webnus_framework' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type7.png'
					),
				),
			),
			array(
				'title'		=> esc_html__('Blog Sidebar Position', 'webnus_framework'),
				'id'		=> 'webnus_blog_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'webnus_framework' ),
					'left'	=> esc_html__( 'Left', 'webnus_framework' ),
					'right'	=> esc_html__( 'Right', 'webnus_framework' ),
					'both'	=> esc_html__( 'Both', 'webnus_framework' ),
				),
			),
			array(
				'title'		=> esc_html__('Excerpt Or Full Blog Content', 'webnus_framework'),
				'subtitle'	=> esc_html__('You can show all text of your posts in blog page or a fixed amount of characters to show for each post.','webnus_framework'),
				'id'		=> 'webnus_blog_excerptfull_enable',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Full', 'webnus_framework' ),
				'off'		=> esc_html__( 'Excerpt', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Excerpt Length for Large Posts', 'webnus_framework'),
				'subtitle'	=> esc_html__('Type the number of characters you want to show in the blog page for each post.','webnus_framework'),
				'id'		=> 'webnus_blog_excerpt_large',
				'type'		=> 'slider',
				'default'	=> 93,
				'min'		=> 1,
				'step'		=> 1,
				'max'		=> 400,
				'display_value'	=> 'text',
				'required'  => array( 'webnus_blog_excerptfull_enable', '=', '0' ),
			),
			array(
				'title'		=> esc_html__('Excerpt Length for List Posts', 'webnus_framework'),
				'subtitle'	=> esc_html__('Type the number of characters you want to show in the blog page for each post.','webnus_framework'),
				'id'		=> 'webnus_blog_excerpt_list',
				'type'		=> 'slider',
				'default'	=> 35,
				'min'		=> 1,
				'step'		=> 1,
				'max'		=> 400,
				'display_value'	=> 'text',
				'required'  => array( 'webnus_blog_excerptfull_enable', '=', '0' ),
			),
			array(
				'title'		=> esc_html__('Blog Page Title', 'webnus_framework'),
				'subtitle'	=> esc_html__('By hiding this option, blog Page title will be disappearing.','webnus_framework'),
				'id'		=> 'webnus_blog_page_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Blog Page Title Text', 'webnus_framework'),
				'id'		=> 'webnus_blog_page_title',
				'type'		=> 'text',
				'default'	=> 'Blog',
				'required'  => array( 'webnus_blog_page_title_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Read More Text', 'webnus_framework'),
				'subtitle'	=> esc_html__('You can set another name instead of read more link.','webnus_framework'),
				'id'		=> 'webnus_blog_readmore_text',
				'type'		=> 'text',
				'default'	=> esc_html__('Read More', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Featured Image on Blog', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'By disabling this option, all blog feature images will be disappearing.', 'webnus_framework' ),
				'id'		=> 'webnus_blog_featuredimage_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Default Blank Featured Image', 'webnus_framework'),
				'id'		=> 'webnus_no_image',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Custom Default Blank Featured Image', 'webnus_framework'),
				'id'		=> 'webnus_no_image_src',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'webnus_no_image', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Post Title on Blog', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'By disabling this option, all post title images will be disappearing.','webnus_framework' ),
				'id'		=> 'webnus_blog_posttitle_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Single Blog Page', 'webnus_framework' ),
		'id'		=> 'single-blog-page-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Single Post Sidebar Position', 'webnus_framework'),
				'id'		=> 'webnus_blog_singlepost_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'webnus_framework' ),
					'left'	=> esc_html__( 'Left', 'webnus_framework' ),
					'right'	=> esc_html__( 'Right', 'webnus_framework' ),
				),
			),
			array(
				'title'		=> esc_html__('Featured Image on Single Post', 'webnus_framework'),
				'id'		=> 'webnus_blog_sinlge_featuredimage_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Social Share Links', 'webnus_framework'),
				'subtitle'	=> esc_html__('By enabling this feature your visitors can share the post to social networks such as Facebook, Twitter and...','webnus_framework'),
				'id'		=> 'webnus_blog_social_share',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Single post Authorbox', 'webnus_framework'),
				'subtitle'	=> esc_html__('This feature shows a picture of post author and some info about author.','webnus_framework'),
				'id'		=> 'webnus_blog_single_authorbox_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Recommended Posts', 'webnus_framework'),
				'subtitle'	=> esc_html__('This feature recommends related post to visitors.','webnus_framework'),
				'id'		=> 'webnus_recommended_posts',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1',
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Post Metadatas', 'webnus_framework' ),
		'id'		=> 'post-meta-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Metadata Gravatar', 'webnus_framework'),
				'id'		=> 'webnus_blog_meta_gravatar_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
			array(
				'title'		=> esc_html__('Metadata Author', 'webnus_framework'),
				'id'		=> 'webnus_blog_meta_author_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
			array(
				'title'		=> esc_html__('Metadata Date', 'webnus_framework'),
				'id'		=> 'webnus_blog_meta_date_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'webnus_blog_meta_category_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Category', 'webnus_framework'),
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'webnus_blog_meta_comments_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Comments', 'webnus_framework'),
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'webnus_blog_meta_views_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Views', 'webnus_framework'),
				'on'		=> esc_html__( 'On', 'webnus_framework' ),
				'off'		=> esc_html__( 'Off', 'webnus_framework' ),
				'default'	=> '1'
			),
		),
	) );


	// -> START Styling Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Styling Options', 'webnus_framework' ),
		'id'		=> 'styling_opts',
		'icon'		=> 'ti-palette',
	));

	Redux::setSection( $opt_name, array(
		'title'			=> esc_html__( 'Background', 'webnus_framework' ),
		'id'			=> 'background_opts',
		'desc'			=> esc_html__('Background shows in Boxed layout. you can select layout in "Layout" tab.', 'webnus_framework'),
		'subsection'	=> true,
		'fields'		=> array(
			array(
				'title'		=> esc_html__( 'Body Background', 'webnus_framework' ),
				'id'		=> 'webnus_background',
				'type'		=> 'background',
				'output'	=> array( 'body' ),
			),
			array(
				'title'		=> esc_html__( 'Background Pattern', 'webnus_framework' ),
				'id'		=> 'webnus_background_pattern',
				'type'		=> 'image_select',
				'options'	=> array(
					'none'	=> array('alt' => 'None','img' => $theme_bg_dir.'none.jpg',),
					$theme_bg_dir.'bdbg1.png'				=> array('alt'  => 'Default BG', 'img'  	=> $theme_bg_dir.'bdbg1.png',),
					$theme_bg_dir.'gray-jean.png'			=> array('alt'  => 'Gray Jean', 'img'  		=> $theme_bg_dir.'gray-jean.png',),
					$theme_bg_dir.'light-wool.png'			=> array('alt'  => 'Light Wool', 'img'  	=> $theme_bg_dir.'light-wool.png',),
					$theme_bg_dir.'subtle_freckles.png'		=> array('alt'	=> 'Subtle Freckles','img'	=>$theme_bg_dir.'subtle_freckles.png',),
					$theme_bg_dir.'subtle_freckles2.png'	=> array('alt'	=> 'Subtle Freckles 2','img'	=>$theme_bg_dir.'subtle_freckles2.png',),
					$theme_bg_dir.'green-fibers.png'		=> array('alt'  => 'Green Fibers', 'img'  	=> $theme_bg_dir.'green-fibers.png',),
					$theme_bg_dir.'dust.png'  				=> array('alt'  => 'Dust', 'img'  			=> $theme_bg_dir.'dust.png',),
				),
				'height'	=> '64',
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__( 'Colors', 'webnus_framework' ),
		'id'               => 'colors_opts',
		'subsection'       => true,
		'fields'		   => array(
			array(
				'title'		=> esc_html__( 'Predefined Color Skin', 'webnus_framework' ),
				'id'		=> 'webnus_color_skin',
				'type'		=> 'palette',
				'class'		=> 'w-p-colorskin',
				'default'	=> '0',
				'palettes'	=> array(
					'0'		=> array( '#e3e3e3' ),
					'1'		=> array( '#1bbc9b' ),
					'2'		=> array( '#0093d0' ),
					'3'		=> array( '#e53f51' ),
					'4'		=> array( '#f1c40f' ),
					'5'		=> array( '#e64883' ),
					'6'		=> array( '#45ab48' ),
					'7'		=> array( '#9661ab' ),
					'8'		=> array( '#0aad80' ),
					'9'		=> array( '#03acdc' ),
					'10'	=> array( '#ff5a00' ),
					'11' 	=> array( '#c3512f' ),
					'12'	=> array( '#55606e' ),
					'13'	=> array( '#fe8178' ),
					'14'	=> array( '#7c6853' ),
					'15'	=> array( '#bed431' ),
					'16'	=> array( '#2d5c88' ),
					'17'	=> array( '#76dd56' ),
					'18'	=> array( '#2997ab' ),
					'19'	=> array( '#734854' ),
					'20'	=> array( '#a81010' ),
				),

	        ),
			array(
				'id'		=> 'webnus_custom_color_skin_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Custom Color Skin', 'webnus_framework'),
				'options'	=> array('1' => esc_html__('Enable','webnus_framework'), '0' => esc_html__('Disable','webnus_framework')),
				'default'	=> '0',
			),
			array(
				'id'			=> 'webnus_custom_color_skin',
				'type'			=> 'color',
				'title'			=> esc_html__('Choose Color ', 'webnus_framework'),
				'subtitle'		=> esc_html__('Choose your desire color scheme.', 'webnus_framework'),
				'transparent'	=> false,
				'required'		=> array( 'webnus_custom_color_skin_enable', '=', '1' ),
			),
			array(
				'id'		=> 'webnus_link_color',
				'type'		=> 'link_color',
				'title'		=> esc_html__('Links Color', 'webnus_framework'),
				'active'	=> false,
				'visited'	=> true,
				'output'	=> array( 'a' ),
			),
			array(
				'id'       => 'webnus_menu_link_color',
				'type'     => 'link_color',
				'title'    => esc_html__('Header Menu Link', 'webnus_framework'),
			),
			array(
				'id'			=> 'webnus_menu_selected_border_color',
				'type'			=> 'color',
				'title'			=> esc_html__('Header Menu Selected Border', 'webnus_framework'),
				'transparent'	=> false,
				'output'		=> array(
					'border-color' => '#wrap.remittal-t #nav > li.current > a:before, #wrap.pax-t #nav > li.current > a:before',
				),
			),
			array(
				'id'		=> 'webnus_scroll_to_top_hover_background_color',
				'type'		=> 'link_color',
				'title'		=> esc_html__('Scroll to top', 'webnus_framework'),
				'active'	=> false,
				'visited'	=> false,
			),
			array(
				'id'			=> 'webnus_iconbox_base_color',
				'type'			=> 'color',
				'title'			=> esc_html__('Iconboxes', 'webnus_framework'),
				'subtitle'		=> esc_html__( 'Iconboxes Base Color'),
				'transparent'	=> false,
				'output'		=> array('#wrap [class*="icon-box"] i'),
			),
			array(
				'id'			=> 'webnus_learnmore_link_color',
				'type'			=> 'color',
				'title'			=> esc_html__('Learn more link', 'webnus_framework'),
				'subtitle'		=> esc_html__( 'In IconBox'),
				'transparent'	=> false,
				'output'		=> array('#wrap a.magicmore'),
			),
			array(
				'id'			=> 'webnus_learnmore_hover_link_color',
				'type'			=> 'color',
				'title'			=> esc_html__('Learn more hover link color', 'webnus_framework'),
				'subtitle'		=> esc_html__( 'In IconBox'),
				'transparent'	=> false,
				'output'		=> array('#wrap [class*="icon-box"] a.magicmore:hover'),
			),
			array(
				'id'			=> 'webnus_resoponsive_menu_icon_color',
				'type'			=> 'color',
				'title'			=> esc_html__('Responsive Menu Icon', 'webnus_framework'),
				'subtitle'		=> esc_html__( 'Appears in mobile & tablet view'),
				'transparent'	=> false,
				'output'		=> array(
					'background-color' => '#wrap #header.sm-rgt-mn #menu-icon span.mn-ext1, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext2, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext3',
				),
			),
		),
	));

	// -> START Typography Fields
	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Typography', 'webnus_framework' ),
		'id'				=> 'typography_opts',
		'icon'				=> 'ti-smallcap',
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Body Typography', 'webnus_framework' ),
		'id'				=> 'body_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Body Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all body text.', 'webnus_framework' ),
				'id'			=> 'body-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( 'body' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Paragraph Typography', 'webnus_framework' ),
		'id'				=> 'p_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( '(P) Paragraph Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all (P) Paragraph.', 'webnus_framework' ),
				'id'			=> 'p-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap p' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Headings Typography', 'webnus_framework' ),
		'id'				=> 'h_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'All Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Headings.', 'webnus_framework' ),
				'id'			=> 'all-h-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h1,#wrap h2,#wrap h3,#wrap h4,#wrap h5,#wrap h6' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H1) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H1 Headings.', 'webnus_framework' ),
				'id'			=> 'h1-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h1' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H2) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H2 Headings.', 'webnus_framework' ),
				'id'			=> 'h2-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h2' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H3) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H3 Headings.', 'webnus_framework' ),
				'id'			=> 'h3-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h3' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H4) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H4 Headings.', 'webnus_framework' ),
				'id'			=> 'h4-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h4' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H5) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H5 Headings.', 'webnus_framework' ),
				'id'			=> 'h5-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h5' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H6) Headings Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H6 Headings.', 'webnus_framework' ),
				'id'			=> 'h6-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h6' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Menu Typography', 'webnus_framework' ),
		'id'				=> 'menu_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Menu Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Menus.', 'webnus_framework' ),
				'id'			=> 'menu-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'line-height'	=> false,
				'output'		=> array( '#wrap ul#nav *' ),
				'units'			=> 'px',
				'fonts'			=> $fonts,
			),
			array(
				'title'			=> esc_html__( 'Sub Menu Typography', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Sub Menus.', 'webnus_framework' ),
				'id'			=> 'sub-menu-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'line-height'	=> false,
				'output'		=> array( '#nav ul li a' ),
				'units'			=> 'px',
				'fonts'			=> $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Blog Typography', 'webnus_framework' ),
		'id'				=> 'blog_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Post Title Typography In Blog Page', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Post Title.', 'webnus_framework' ),
				'id'			=> 'post-title-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '.blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
			array(
				'title'			=> esc_html__( 'Post Title Typography in Single Blog Page', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Post Title.', 'webnus_framework' ),
				'id'			=> 'single-post-title-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '.blog-single-post h1' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Custom Fonts', 'webnus_framework' ),
		'id'				=> 'custom_fonts_opts',
		'desc'				=> esc_html__( 'After uploading your fonts, you should select font family (custom-font-1/custom-font-2/custom-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section.', 'webnus_framework' ),
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Custom Font1', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 1.', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font1',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .woff', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font1_woff',
				'type'		=> 'media',
				'mode'       => false,
                'preview'  => false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font1', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .ttf', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font1_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font1', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .eot', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font1_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font1', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Custom Font2', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 2', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font2',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .woff', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font2_woff',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font2', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .ttf', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font2_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font2', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .eot', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font2_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font2', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Custom Font3', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 3', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font3',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .woff', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font3_woff',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font3', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .ttf', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font3_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font3', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .eot', 'webnus_framework' ),
				'id'		=> 'webnus_custom_font3_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'webnus_custom_font3', '=', '1' ),
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Adobe Typekit', 'webnus_framework' ),
		'id'				=> 'adobe_typekit_opts',
		'desc'				=> esc_html__( 'After completing below settings, you should select font family (typekit-font-1/typekit-font-2/typekit-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section', 'webnus_framework' ),
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Adobe Typekit', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Adobe Typekit.', 'webnus_framework' ),
				'id'		=> 'webnus_adobe_typekit',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Typekit Kit ID', 'webnus_framework'),
				'id'		=> 'webnus_typekit_id',
				'type'		=> 'text',
				'required'  => array( 'webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 1', 'webnus_framework'),
				'id'		=> 'webnus_typekit_font1',
				'type'		=> 'text',
				'required'  => array( 'webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 2', 'webnus_framework'),
				'id'		=> 'webnus_typekit_font2',
				'type'		=> 'text',
				'required'  => array( 'webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 3', 'webnus_framework'),
				'id'		=> 'webnus_typekit_font3',
				'type'		=> 'text',
				'required'  => array( 'webnus_adobe_typekit', '=', '1' ),
			),

		),
	));


	// -> START Social Networks Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Social Networks', 'webnus_framework' ),
		'id'		=> 'social_opts',
		'icon'		=> 'sl-share',
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Twitter URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://twitter.com/mytwitterid', 'webnus_framework'),
				'id'		=> 'webnus_twitter_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('Facebook Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://facebook.com/myfacebook', 'webnus_framework'),
				'id'		=> 'webnus_facebook_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('Youtube Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://youtube.com/account', 'webnus_framework'),
				'id'		=> 'webnus_youtube_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('Linkedin Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://linkedin/linkedinid', 'webnus_framework'),
				'id'		=> 'webnus_linkedin_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('Dribbble Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://dribbble.com/dribbbleid', 'webnus_framework'),
				'id'		=> 'webnus_dribbble_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Pinterest Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://pinterest/pinterestid', 'webnus_framework'),
				'id'		=> 'webnus_pinterest_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Vimeo Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://vimeo.com/', 'webnus_framework'),
				'id'		=> 'webnus_vimeo_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Google+ Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://plus.google.com/', 'webnus_framework'),
				'id'		=> 'webnus_google_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('RSS Link', 'webnus_framework'),
				'subtitle'	=> esc_html__('Example: http://exaple.com/rss', 'webnus_framework'),
				'id'		=> 'webnus_rss_ID',
				'type'		=> 'text',
				'default'	=> '#',
			),
			array(
				'title'		=> esc_html__('Instagram URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Instagram Link URL', 'webnus_framework'),
				'id'		=> 'webnus_instagram_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Flickr URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Flickr Link URL', 'webnus_framework'),
				'id'		=> 'webnus_flickr_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Reddit URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Reddit Link URL', 'webnus_framework'),
				'id'		=> 'webnus_reddit_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Lastfm URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Lastfm Link URL', 'webnus_framework'),
				'id'		=> 'webnus_lastfm_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Delicious URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Delicious Link URL', 'webnus_framework'),
				'id'		=> 'webnus_delicious_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Tumblr URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Tumblr Link URL', 'webnus_framework'),
				'id'		=> 'webnus_tumblr_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
			array(
				'title'		=> esc_html__('Skype URL', 'webnus_framework'),
				'subtitle'	=> esc_html__('Skype Link URL', 'webnus_framework'),
				'id'		=> 'webnus_skype_ID',
				'type'		=> 'text',
				'default'	=> '',
			),
		),
	) );

	// -> START Contact Form Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Contact Form', 'webnus_framework' ),
		'id'		=> 'contact_form_opts',
		'icon'		=> 'ti-email',
		'fields'	=> array(
			array(
				'title'		=> esc_html__('reCaptcha Site key', 'webnus_framework'),
				'subtitle'	=> wp_kses( __('Register your website and get Secret Key.Very first thing you need to do is register your website on Google recaptcha to do that click <a href="https://www.google.com/recaptcha/admin#list" target="_blank">here</a>.', 'webnus_framework'), $keyses ),
				'id'		=> 'webnus_recaptcha_site_key',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__('reCaptcha Secret key', 'webnus_framework'),
				'id'		=> 'webnus_recaptcha_secret_key',
				'type'		=> 'text',
			),
		),
	) );

	// -> START Google Map Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Google Map', 'webnus_framework' ),
		'id'		=> 'google_map_opts',
		'icon'		=> 'ti-location-pin',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'API key', 'webnus_framework' ),
				'subtitle'	=> wp_kses( __('You should create an API for yourself and put code here. red below link to more info:  <a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,places_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">Here</a><br><br>', 'webnus_framework'), $keyses ),
				'id'		=> 'google_map_api',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Display Sign in button', 'webnus_framework' ),
				'subtitle'	=> wp_kses( __('You can see Sign In button <a href="https://developers.google.com/maps/documentation/javascript/examples/save-simple" target="_blank">Here</a><br/><br/>', 'webnus_framework'), $keyses ),
				'id'		=> 'google_map_api_sign_in',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
		),
	) );

	// -> START Shop Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Shop', 'webnus_framework' ),
		'id'		=> 'shop_opts',
		'icon'		=> 'ti-shopping-cart',
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Show/Hide Sidebar', 'webnus_framework'),
				'id'		=> 'webnus_woo_sidebar_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Shop title Show/Hide', 'webnus_framework'),
				'id'		=> 'webnus_woo_shop_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Shop page title', 'webnus_framework'),
				'id'		=> 'webnus_woo_shop_title',
				'type'		=> 'text',
				'default'	=> 'Shop',
				'required'  => array( 'webnus_woo_shop_title_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Product page title Show/Hide', 'webnus_framework'),
				'id'		=> 'webnus_woo_product_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'webnus_framework' ),
				'off'		=> esc_html__( 'Hide', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__('Product page title', 'webnus_framework'),
				'id'		=> 'webnus_woo_product_title',
				'type'		=> 'text',
				'default'	=> 'Product',
				'required'  => array( 'webnus_woo_product_title_enable', '=', '1' ),
			),
		),
	) );

	// -> START Maintenance Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Maintenance Mode', 'webnus_framework' ),
		'id'		=> 'coming_soon_opts',
		'desc'		=> esc_html__( 'After creating your page, you can select it from dropdown list.', 'webnus_framework' ),
		'icon'		=> 'sl-rocket',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Maintenance Mode', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'Status of Maintenance Mode', 'webnus_framework' ),
				'id'		=> 'webnus_maintenance_mode',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'webnus_framework' ),
				'off'		=> esc_html__( 'Disabled', 'webnus_framework' ),
			),
			array(
				'title'		=> esc_html__( 'Maintenance Page', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'Select Maintenance Page', 'webnus_framework' ),
				'id'		=> 'webnus_maintenance_page',
				'type'		=> 'select',
				'data'		=> 'page',
				'required'  => array( 'webnus_maintenance_mode', '=', '1' ),
			),
		),
	) );

	// -> START Custom Codes Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Custom Codes', 'webnus_framework' ),
		'id'		=> 'custom_codes',
		'icon'		=> 'fa-code',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Custom CSS', 'webnus_framework' ),
				'subtitle'	=> esc_html__( 'Any custom CSS from the user should go in this field, it will override the theme CSS.', 'webnus_framework' ),
				'id'		=> 'webnus_custom_css',
				'type'		=> 'ace_editor',
				'mode'		=> 'css',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
			array(
				'title'		=> esc_html__( 'Space Before &lt;/head&gt;', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'Add code before the &lt;/head&gt; tag.', 'webnus_framework' ),
				'id'		=> 'webnus_space_before_head',
				'type'		=> 'ace_editor',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
			array(
				'title'		=> esc_html__( 'Space Before &lt;/body&gt;', 'webnus_framework' ),
				'subtitle'		=> esc_html__( 'Add code before the &lt;/body&gt; tag.', 'webnus_framework' ),
				'id'		=> 'webnus_space_before_body',
				'type'		=> 'ace_editor',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
		),
	) );


	/*
	 * <--- END SECTIONS
	 */