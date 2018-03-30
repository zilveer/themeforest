<?php


    include 'config-metaboxes.php';

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

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
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
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

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    /*$args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );*/

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    /*$tabs = array(
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

    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );*/


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    


    //NICDARK REDUX
    /****************************************************START HEADER************************************************************/
    Redux::setSection( $opt_name, array(
        'title' => __( 'Header', 'redux-framework-demo' ),
        'id'    => 'nicdark_header_section',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-home'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header Settings', 'redux-framework-demo' ),
        'id'         => 'nicdark_headersettings_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(
            

            //start array
            array(
                'id'       => 'header_boxed',
                'type'     => 'switch',
                'title'    => __( 'Boxed Header', 'redux-framework-demo' ),
                'subtitle' => __( 'Disable Boxed Style For your Header', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_type_1_topspace',
                'type'     => 'select',
                'title'    => __( 'Top Space', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Top Space Height', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                ),
                'default'  => '20'
            ),
            array(
                'id'       => 'header_type_1_bottomspace',
                'type'     => 'select',
                'title'    => __( 'Bottom Space', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Bottom Space Height', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                ),
                'default'  => '20'
            ),
            array(
                'id'       => 'header_gradient',
                'type'     => 'switch',
                'title'    => __( 'Gradient', 'redux-framework-demo' ),
                'subtitle' => __( 'Disable Gradient Line On Your Header, set your color in color settings', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'btn_menu_responsive_color',
                'type'     => 'select',
                'title'    => __( 'BG Color (Btn Menu Responsive)', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Bg Color for your button menu responsive', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'reddark' => 'reddark',
                    'orange' => 'orange',
                    'orangedark' => 'orangedark',
                    'yellow' => 'yellow',
                    'yellowdark' => 'yellowdark',
                    'blue' => 'blue',
                    'bluedark' => 'bluedark',
                    'green' => 'green',
                    'greendark' => 'greendark',
                    'violet' => 'violet',
                    'violetdark' => 'violetdark'
                ),
                'default'  => 'orange'
            ),
            array(
                'id'       => 'header_navigation_type',
                'type'     => 'select',
                'title'    => __( 'Navigation Type', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Navigation Type', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'navigation-1' => 'navigation-1',
                    'navigation-2' => 'navigation-2',
                    'navigation-3' => 'navigation-3'
                ),
                'default'  => 'navigation-1'
            ),
            

            //options for navigation type 1
            array(
                'id'       => 'header_left_sidebar',
                'type'     => 'switch',
                'required' => array( 'header_navigation_type', '=', 'navigation-1' ),
                'title'    => __( 'Left Sidebar', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Left Sidebar On Header!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_icon_btn_left_sidebar',
                'type'     => 'select',
                'required' => array( 'header_left_sidebar', '=', '1' ),
                'data'     => 'elusive-icons',
                'title'    => __( 'Icon Retina (Left Sidebar)', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert your retina icon code.', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => 'icon-menu'
            ),
            array(
                'id'       => 'header_background_btn_left_sidebar',
                'type'     => 'select',
                'required' => array( 'header_left_sidebar', '=', '1' ),
                'title'    => __( 'Icon BG Color (Left Sidebar)', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Bg Color for your icon', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet'
                ),
                'default'  => 'orange'
            ),
            array(
                'id'       => 'header_right_sidebar',
                'type'     => 'switch',
                'required' => array( 'header_navigation_type', '=', 'navigation-1' ),
                'title'    => __( 'Right Sidebar', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Right Sidebar On Header!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_icon_btn_right_sidebar',
                'type'     => 'select',
                'required' => array( 'header_right_sidebar', '=', '1' ),
                'data'     => 'elusive-icons',
                'title'    => __( 'Icon Retina (Right Sidebar)', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert your retina icon code.', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => 'icon-basket'
            ),
            array(
                'id'       => 'header_background_btn_right_sidebar',
                'type'     => 'select',
                'required' => array( 'header_right_sidebar', '=', '1' ),
                'title'    => __( 'Icon BG Color (Right Sidebar)', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Bg Color for your icon', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet'
                ),
                'default'  => 'orange'
            ),


            //options for navigation type 2
            array(
                'id'       => 'header_navigation_type_2_bg',
                'type'     => 'select',
                'required' => array( 'header_navigation_type', '=', 'navigation-2' ),
                'title'    => __( 'BG Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Bg Color for your Navigation Section', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet'
                ),
                'default'  => 'green'
            ),
            array(
                'id'       => 'header_navigation_type_2_buttons',
                'type'     => 'switch',
                'required' => array( 'header_navigation_type', '=', 'navigation-2' ),
                'title'    => __( 'Enable Social Buttons', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Social Buttons on the right', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_navigation_type_2_button_1_icon',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __( 'Button Icon 1', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'header_navigation_type_2_button_1_link',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __('Button Link 1', 'redux-framework-demo'),
                'subtitle' => __('Insert the link of your  button 1, http://www.cleanthemes.net', 'redux-framework-demo'),
                'validate' => 'url',
                'msg'      => __('This is not a correct URL', 'redux-framework-demo'),
            ),
            array(
                'id'       => 'header_navigation_type_2_button_2_icon',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __( 'Button Icon 2', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'header_navigation_type_2_button_2_link',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __('Button Link 2', 'redux-framework-demo'),
                'subtitle' => __('Insert the link of your  button 2, http://www.cleanthemes.net', 'redux-framework-demo'),
                'validate' => 'url',
                'msg'      => __('This is not a correct URL', 'redux-framework-demo'),
            ),
            array(
                'id'       => 'header_navigation_type_2_button_3_icon',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __( 'Button Icon 3', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'header_navigation_type_2_button_3_link',
                'type'     => 'text',
                'required' => array( 'header_navigation_type_2_buttons', '=', '1' ),
                'title'    => __('Button Link 3', 'redux-framework-demo'),
                'subtitle' => __('Insert the link of your  button 3, http://www.cleanthemes.net', 'redux-framework-demo'),
                'validate' => 'url',
                'msg'      => __('This is not a correct URL', 'redux-framework-demo'),
            ),
            //end array


        )
    ) );
    

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Top Header', 'redux-framework-demo' ),
        'id'         => 'nicdark_topheader_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(
            

            //start array
            array(
                'id'       => 'topheader_display',
                'type'     => 'switch',
                'title'    => __( 'Disable Top Header Display', 'redux-framework-demo' ),
                'subtitle' => __( 'Disable Top Header Section!', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'topheader_bgcolor',
                'type'     => 'select',
                'required' => array( 'topheader_display', '=', '1' ),
                'title'    => __( 'Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Bg Color for the top header section', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet',
                    'grey' => 'grey',
                ),
                'default'  => 'greydark'
            ),
            array(
                'id'       => 'topheader_left_content',
                'type'     => 'textarea',
                'required' => array( 'topheader_display', '=', '1' ),
                'title'    => __( 'Left Content', 'redux-framework-demo' ),
                'rows'     => 12,
                'subtitle' => __( 'Insert Your Content, HTML / TEXT is allowed', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '<h6 class="white">
<i class="icon-mail"></i>  <a class="white title" href="#">info@wedding.com</a>
<span class="greydark2 nicdark_marginright10 nicdark_marginleft10">|</span>
<i class="icon-phone"></i>  <a class="white title" href="#">+44 5227653</a>
<span class="greydark2 nicdark_marginright10 nicdark_marginleft10">|</span>
<i class="icon-clock"></i>  9-13  to  14-18
</h6>'
            ),
            array(
                'id'       => 'topheader_right_content',
                'type'     => 'textarea',
                'required' => array( 'topheader_display', '=', '1' ),
                'rows'     => 12,
                'title'    => __( 'Right Content', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert Your Content, HTML / TEXT is allowed', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '<h6 class="white">
<i class="icon-globe"></i>  <a class="nicdark_outline white title" href="#">CHOOSE LANGUAGES</a>
<span class="greydark2 nicdark_marginright10 nicdark_marginleft10">|</span>
<i class="icon-key"></i>  <a class="white title" href="#">REGISTER</a>
<span class="greydark2 nicdark_marginright10 nicdark_marginleft10">|</span>
<i class="icon-lock"></i>  <a class="white title" href="#">LOG IN</a>
</h6>'
            ),
            array(
                'id'       => 'window_popup_display',
                'type'     => 'switch',
                'title'    => __( 'Enable Window Pop Up', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Window Pop Up ( Example for language selector ! )', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'window_popup_content',
                'type'     => 'textarea',
                'required' => array( 'window_popup_display', '=', '1' ),
                'rows'     => 12,
                'title'    => __( 'Window Pop Up Content', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert Your Content, HTML / TEXT are allowed. Use the class nicdark_mpopup_window and the link #nicdark_window_pop_up to your A tag for see it in action', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '<div class="nicdark_textevidence nicdark_bg_green ">
            <div class="nicdark_margin20">
                <h4 class="white">LANGUAGES</h4>
            </div>
        </div>

        <div class="nicdark_padding20 nicdark_display_inlineblock nicdark_width_percentage100 nicdark_sizing">
            
            <ul class="nicdark_list border">
            
                <li class="nicdark_border_greydark">
                    <p><a class="white" href="#">ENGLISH</a><a href="#" class="nicdark_btn right nicdark_opacity"><i class="white icon-angle-right"></i></a></p>
                    <div class="nicdark_space15"></div>
                </li>

                <li class="nicdark_border_greydark">
                    <div class="nicdark_space15"></div>
                    <p><a class="white" href="#">RUSSIAN</a><a href="#" class="nicdark_btn right nicdark_opacity"><i class="white icon-angle-right"></i></a></p>   
                    <div class="nicdark_space15"></div>
                </li>
                    
                <li class="nicdark_border_greydark">
                    <div class="nicdark_space15"></div>
                    <p><a class="white" href="#">ARABIC</a><a href="#" class="nicdark_btn right nicdark_opacity"><i class="white icon-angle-right"></i></a></p>   
                    <div class="nicdark_space15"></div>
                </li>

                <li class="nicdark_border_greydark">
                    <div class="nicdark_space15"></div>
                    <p><a class="white" href="#">ITALIAN</a><a href="#" class="nicdark_btn right nicdark_opacity"><i class="white icon-angle-right"></i></a></p>    
                </li>
                    
            </ul>

        </div>'
            ),
            //end array


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Middle Header', 'redux-framework-demo' ),
        'id'         => 'nicdark_middleheader_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(
            

            //start array
            array(
                'id'       => 'middleheader_display',
                'type'     => 'switch',
                'title'    => __( 'Disable Middle Header Display', 'redux-framework-demo' ),
                'subtitle' => __( 'Disable Middle Section!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),

            array(
                'id'       => 'middleheader_focus_1_icon',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __( 'Focus 1 icon', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_1_title',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 1 title', 'redux-framework-demo'),
                'subtitle' => __('Insert the title of your focus 1', 'redux-framework-demo'),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_1_subtitle',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 1 subtitle', 'redux-framework-demo'),
                'subtitle' => __('Insert the subtitle of your focus 1', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'middleheader_focus_2_icon',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __( 'Focus 2 icon', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_2_title',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 2 title', 'redux-framework-demo'),
                'subtitle' => __('Insert the title of your focus 2', 'redux-framework-demo'),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_2_subtitle',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 2 subtitle', 'redux-framework-demo'),
                'subtitle' => __('Insert the subtitle of your focus 2', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'middleheader_focus_3_icon',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __( 'Focus 3 icon', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert icon code e.g. icon-facebook <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons.php">Set 1</a> , <a target="_blank" href="http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/icons-2.php">Set 2</a>', 'redux-framework-demo' ),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_3_title',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 3 title', 'redux-framework-demo'),
                'subtitle' => __('Insert the title of your focus 3', 'redux-framework-demo'),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_focus_3_subtitle',
                'type'     => 'text',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __('Focus 3 subtitle', 'redux-framework-demo'),
                'subtitle' => __('Insert the subtitle of your focus 3', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'middleheader_button',
                'type'     => 'switch',
                'required' => array( 'middleheader_display', '=', '1' ),
                'title'    => __( 'Enable Button', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable button in the middle header!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'middleheader_button_text',
                'type'     => 'text',
                'required' => array( 'middleheader_button', '=', '1' ),
                'title'    => __('Button Text', 'redux-framework-demo'),
                'subtitle' => __('Insert your button text', 'redux-framework-demo'),
                'validate' => 'no_special_chars'
            ),
            array(
                'id'       => 'middleheader_button_link',
                'type'     => 'text',
                'required' => array( 'middleheader_button', '=', '1' ),
                'title'    => __('Button Link', 'redux-framework-demo'),
                'subtitle' => __('Insert the link of your  button, http://www.cleanthemes.net', 'redux-framework-demo'),
                'validate' => 'url',
                'msg'      => __('This is not a correct URL', 'redux-framework-demo'),
            ),
            array(
                'id'       => 'middleheader_button_color',
                'type'     => 'select',
                'required' => array( 'middleheader_button', '=', '1' ),
                'title'    => __( 'Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Bg Color for the button', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet'
                ),
                'default'  => 'orange'
            ),
            //end array


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Logo and Favicons', 'redux-framework-demo' ),
        'id'         => 'nicdark_logoandfavicons_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(

            //array
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => __( 'Logo', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your logo in high resolution', 'redux-framework-demo' ),
                'default'  => array(
                    'url'=>'http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/img/logo.png'
                ),
            ),
            array(
                'id'             => 'logo_settings',
                'type'           => 'dimensions',
                'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Logo Settings', 'redux-framework-demo' ),
                'subtitle'       => __( 'Insert your width and margin-top (+,-) for logo position.', 'redux-framework-demo' ),
                'desc'           => __( 'Width / Margin-top (positive or negative)', 'redux-framework-demo' ),
                'default'        => array(
                    'width'  => '300px',
                    'height' => '3px',
                )
            ),
            array(
                'id'       => 'logo_responsive',
                'type'     => 'media',
                'title'    => __( 'Logo Responsive', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your logo responsive in high resolution', 'redux-framework-demo' ),
                'default'  => array(
                    'url'=>'http://www.nicdarkthemes.com/themes/wedding-industry/wp/demo/img/logo.png'
                ),
            ),
            array(
                'id'             => 'logo_responsive_settings',
                'type'           => 'dimensions',
                'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Logo Responsive Settings', 'redux-framework-demo' ),
                'subtitle'       => __( 'Insert your width and margin-top (+,-) for logo responsive position.', 'redux-framework-demo' ),
                'desc'           => __( 'Width / Margin-top (positive or negative)', 'redux-framework-demo' ),
                'default'        => array(
                    'width'  => '300px',
                    'height' => '0px',
                )
            ),
            array(
                'id'       => 'favicon_custom',
                'type'     => 'switch',
                'title'    => __( 'Enable Custom Favicons', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Custom Favicons For Your Site!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Yes',
                'off'      => 'None',
            ),
            array(
                'id'       => 'favicon_ico',
                'type'     => 'media',
                'required' => array( 'favicon_custom', '=', '1' ),
                'title'    => __( 'Favicon ICO', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your Favicon 16px X 16px (.ico)', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'favicon_iphone',
                'type'     => 'media',
                'required' => array( 'favicon_custom', '=', '1' ),
                'title'    => __( 'Favicon IPHONE', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your Favicon 57px X 57px (.png)', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'favicon_ipad',
                'type'     => 'media',
                'required' => array( 'favicon_custom', '=', '1' ),
                'title'    => __( 'Favicon IPAD', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your Favicon 72px X 72px (.png)', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'favicon_retina',
                'type'     => 'media',
                'required' => array( 'favicon_custom', '=', '1' ),
                'title'    => __( 'Favicon RETINA', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your Favicon 114px X 114px (.png)', 'redux-framework-demo' ),
            ),
            //end array

        )
    ) );
    /****************************************************END HEADER************************************************************/







    ////////////////////////////////////////////////////START ARCHIVE SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title' => __( 'Archive', 'redux-framework-demo' ),
        'id'    => 'nicdark_archive_section',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-book'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Archive Settings', 'redux-framework-demo' ),
        'id'         => 'nicdark_archivesettings_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(

            //start array
            array(
                'id'       => 'archive_post_header_transparent_menu',
                'type'     => 'switch',
                'title'    => __( 'Enable Transparent Menu', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Transparent Menu In Archives Pages, works only for navigation layout 3', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),            
            array(
                'id'       => 'archive_post_header_img_display',
                'type'     => 'switch',
                'title'    => __( 'Enable Header Image Display', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Header Parallax Image Display!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'archive_post_header_img',
                'type'     => 'media',
                'required' => array( 'archive_post_header_img_display', '=', '1' ),
                'title'    => __( 'Image Parallax', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your parallax image', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'archive_post_header_filter',
                'type'     => 'select',
                'required' => array( 'archive_post_header_img_display', '=', '1' ),
                'title'    => __( 'Filter', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Color Filter Over Image', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    '' => 'none'
                ),
                'default'  => 'greydark'
            ),
            array(
                'id'       => 'archive_post_header_margintop',
                'type'     => 'select',
                'required' => array( 'archive_post_header_img_display', '=', '1' ),
                'title'    => __( 'Margin Top', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Title Margin Top', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                    '110' => '110',
                    '120' => '120',
                    '130' => '130',
                    '140' => '140',
                    '150' => '150',
                    '160' => '160',
                    '170' => '170',
                    '180' => '180',
                    '190' => '190',
                    '200' => '200',
                    '210' => '210',
                    '220' => '220',
                    '230' => '230',
                    '240' => '240',
                    '250' => '250',
                    '260' => '260',
                    '270' => '270',
                    '280' => '280',
                    '290' => '290',
                    '300' => '300'
                ),
                'default'  => '90'
            ),
            array(
                'id'       => 'archive_post_header_marginbottom',
                'type'     => 'select',
                'required' => array( 'archive_post_header_img_display', '=', '1' ),
                'title'    => __( 'Margin Bottom', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Title Margin Bottom', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '10' => '10',
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                    '110' => '110',
                    '120' => '120',
                    '130' => '130',
                    '140' => '140',
                    '150' => '150',
                    '160' => '160',
                    '170' => '170',
                    '180' => '180',
                    '190' => '190',
                    '200' => '200'
                ),
                'default'  => '90'
            ),
            array(
                'id'       => 'archive_post_style',
                'type'     => 'select',
                'title'    => __( 'Style', 'redux-framework-demo' ),
                'subtitle' => __( 'Select the style', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'standard' => 'Standard Layout',
                    'masonry' => 'Masonry Layout'
                ),
                'default'  => 'standard'
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END ARCHIVE SETTINGS///////////////////////////////////////////////////





    ////////////////////////////////////////////////////WOO COMMERCE SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Woo Commerce', 'redux-framework-demo' ),
        'id'     => 'nicdark_woocommerce_section',
        'icon'   => 'el el-shopping-cart',
        'fields' => array(

            //start array
            array(
                'id'       => 'archive_products_header_transparent_menu',
                'type'     => 'switch',
                'title'    => __( 'Enable Transparent Menu', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Transparent Menu In Archives Pages, works only for navigation layout 3', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),            
            array(
                'id'       => 'archive_woocommerce_header_img_display',
                'type'     => 'switch',
                'title'    => __( 'Enable Header Image Display', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Header Parallax Image Display!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'archive_woocommerce_header_title',
                'type'     => 'text',
                'required' => array( 'archive_woocommerce_header_img_display', '=', '1' ),
                'title'    => __( 'Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert the shop title over the image', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'archive_woocommerce_header_img',
                'type'     => 'media',
                'required' => array( 'archive_woocommerce_header_img_display', '=', '1' ),
                'title'    => __( 'Image Parallax', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload your parallax image', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'archive_woocommerce_header_filter',
                'type'     => 'select',
                'required' => array( 'archive_woocommerce_header_img_display', '=', '1' ),
                'title'    => __( 'Filter', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Color Filter Over Image', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'greydark' => 'greydark',
                    'red' => 'red',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                    'blue' => 'blue',
                    'green' => 'green',
                    'violet' => 'violet',
                    '' => 'none'
                ),
                'default'  => 'greydark'
            ),
            array(
                'id'       => 'archive_woocommerce_header_margintop',
                'type'     => 'select',
                'required' => array( 'archive_woocommerce_header_img_display', '=', '1' ),
                'title'    => __( 'Margin Top', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Title Margin Top', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                    '110' => '110',
                    '120' => '120',
                    '130' => '130',
                    '140' => '140',
                    '150' => '150',
                    '160' => '160',
                    '170' => '170',
                    '180' => '180',
                    '190' => '190',
                    '200' => '200',
                    '210' => '210',
                    '220' => '220',
                    '230' => '230',
                    '240' => '240',
                    '250' => '250',
                    '260' => '260',
                    '270' => '270',
                    '280' => '280',
                    '290' => '290',
                    '300' => '300'
                ),
                'default'  => '90'
            ),
            array(
                'id'       => 'archive_woocommerce_header_marginbottom',
                'type'     => 'select',
                'required' => array( 'archive_woocommerce_header_img_display', '=', '1' ),
                'title'    => __( 'Margin Bottom', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Title Margin Bottom', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '10' => '10',
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                    '110' => '110',
                    '120' => '120',
                    '130' => '130',
                    '140' => '140',
                    '150' => '150',
                    '160' => '160',
                    '170' => '170',
                    '180' => '180',
                    '190' => '190',
                    '200' => '200'
                ),
                'default'  => '90'
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END WOO COMMERCE SETTINGS///////////////////////////////////////////////////






    ////////////////////////////////////////////////////START WIDGETS SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Widgets', 'redux-framework-demo' ),
        'id'     => 'nicdark_widgets_section',
        'icon'   => 'el el-list',
        'fields' => array(

            //start array
            array(
                'id'       => 'widget_archives',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Archives', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_calendar',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Calendar', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_categories',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Categories', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_menus',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Menu', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_meta',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Meta', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_pages',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Pages', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_comments',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Comments', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_posts',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Posts', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_slider',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_rss',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Rss', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_search',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Search', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_tags',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Tags', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_text',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_events',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Events', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            array(
                'id'       => 'widget_woo',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Woo Commerce', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Title Bg Color', 'redux-framework-demo' ),
                'default'  => '#D19FAE',
                'validate' => 'color',
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END WIDGETS SETTINGS///////////////////////////////////////////////////


    ////////////////////////////////////////////////////START FOOTER SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title' => __( 'Footer', 'redux-framework-demo' ),
        'id'    => 'nicdark_footer_section',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-photo'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Copyright', 'redux-framework-demo' ),
        'id'         => 'nicdark_copyright_section',
        'subsection' => true,
        'desc'       => '',
        'fields'     => array(
            
            array(
                'id'       => 'copyright_content',
                'type'     => 'textarea',
                'rows'     => 12,
                'title'    => __( 'Content', 'redux-framework-demo' ),
                'subtitle' => __( 'Insert Your Content, HTML / SHORTCODES / TEXT is allowed', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '<h2 class="white">Christine <span class="nicdark_displaynone_iphoneland nicdark_displaynone_iphonepotr">Martin</span> <i class="nicdark_displaynone_iphonepotr red nicdark_pulse_infinite icon-heart nicdark_marginleft20 nicdark_marginright20"></i> Thomas <span class="nicdark_displaynone_iphoneland nicdark_displaynone_iphonepotr">Mcnroo</span></h2>
                        <div class="nicdark_space20"></div>
                        <h5 class="white">MADE WITH LOVE IN NEW YORK</h5>'
            ),
        )
    ) );
    ////////////////////////////////////////////////////END FOOTER SETTINGS///////////////////////////////////////////////////



    ////////////////////////////////////////////////////COLOR SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Colors', 'redux-framework-demo' ),
        'id'     => 'nicdark_colors_section',
        'icon'   => 'el el-pencil',
        'fields' => array(

            //start array
            array(
                'id'       => 'color_greydark',
                'type'     => 'color_gradient',
                'title'    => __( 'GREYDARK Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your greydark color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#585858',
                    'to'   => '#585858'
                )
            ),
            array(
                'id'       => 'color_red',
                'type'     => 'color_gradient',
                'title'    => __( 'RED Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your red color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#c38e9e',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_orange',
                'type'     => 'color_gradient',
                'title'    => __( 'ORANGE Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your orange color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#c792a2',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_yellow',
                'type'     => 'color_gradient',
                'title'    => __( 'YELLOW Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your yellow color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#cd98a8',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_blue',
                'type'     => 'color_gradient',
                'title'    => __( 'BLUE Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your blue color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#d19fae',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_green',
                'type'     => 'color_gradient',
                'title'    => __( 'GREEN Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your green color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#dda8b6',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_violet',
                'type'     => 'color_gradient',
                'title'    => __( 'VIOLET Normal/Dark', 'redux-framework-demo' ),
                'transparent'  => false,
                'subtitle' => __( 'Set your violet color (dark is used for shadows and borders)', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#edb4c3',
                    'to'   => '#b78693'
                )
            ),
            array(
                'id'       => 'color_gradient',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Gradient', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your gradient CSS code here, generate the code <a target="_blank" href="http://www.colorzilla.com/gradient-editor/">HERE</a> ', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => '',
                'default'  => "/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#585858+0,585858+50,d19fae+50,d19fae+100 */
background: #585858; /* Old browsers */
background: -moz-linear-gradient(left, #585858 0%, #585858 50%, #d19fae 50%, #d19fae 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#585858), color-stop(50%,#585858), color-stop(50%,#d19fae), color-stop(100%,#d19fae)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left, #585858 0%,#585858 50%,#d19fae 50%,#d19fae 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left, #585858 0%,#585858 50%,#d19fae 50%,#d19fae 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left, #585858 0%,#585858 50%,#d19fae 50%,#d19fae 100%); /* IE10+ */
background: linear-gradient(to right, #585858 0%,#585858 50%,#d19fae 50%,#d19fae 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#585858', endColorstr='#d19fae',GradientType=1 ); /* IE6-9 */"
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END COLOR SETTINGS///////////////////////////////////////////////////


    ////////////////////////////////////////////////////FONTS SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Fonts', 'redux-framework-demo' ),
        'id'     => 'nicdark_fonts_section',
        'icon'   => 'el el-font',
        'fields' => array(

            //start array,
            array(
                'id'       => 'first_font',
                'type'     => 'typography',
                'title'    => __( 'Main Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the main font.', 'redux-framework-demo' ),
                'google'   => true,
                'color'       => false,
                'text-align' => false,
                'font-weight' => true,
                'line-height' => false,
                'font-size' => false,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Cinzel',
                ),
            ),
            array(
                'id'       => 'second_font',
                'type'     => 'typography',
                'title'    => __( 'Second Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the second font.', 'redux-framework-demo' ),
                'google'   => true,
                'color'       => false,
                'text-align' => false,
                'font-weight' => true,
                'line-height' => false,
                'font-size' => false,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Halant',
                ),
            ),
            array(
                'id'       => 'third_font',
                'type'     => 'typography',
                'title'    => __( 'Third Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the third font. Only for "signature" class apply to heading tag', 'redux-framework-demo' ),
                'google'   => true,
                'color'       => false,
                'text-align' => false,
                'font-weight' => false,
                'line-height' => false,
                'font-size' => false,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Great Vibes',
                ),
            ),
            array(
                'id'       => 'font_color_p',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Color for Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Color for text', 'redux-framework-demo' ),
                'default'  => '#a7a6a6',
                'validate' => 'color',
            ),
            array(
                'id'       => 'font_color_headings',
                'type'     => 'color',
                'transparent'  => false,
                'title'    => __( 'Color for Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Color for headings', 'redux-framework-demo' ),
                'default'  => '#6c6975',
                'validate' => 'color',
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END FONTS SETTINGS///////////////////////////////////////////////////


    ////////////////////////////////////////////////////GENERAL SETTINGS///////////////////////////////////////////////////
    Redux::setSection( $opt_name, array(
        'title'  => __( 'General', 'redux-framework-demo' ),
        'id'     => 'nicdark_general_section',
        'icon'   => 'el el-cogs',
        'fields' => array(

            //start array
            array(
                'id'       => 'general_preloader',
                'type'     => 'switch',
                'title'    => __( 'Enable Site Preloader', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Site Preloader with custom icon!', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'general_preloader_icon',
                'type'     => 'select',
                'required' => array( 'general_preloader', '=', '1' ),
                'data'     => 'elusive-icons',
                'title'    => __( 'Icon', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose your icon for the preloader.', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => 'el el-heart'
            ),
            array(
                'id'       => 'general_preloader_color',
                'type'     => 'color',
                'transparent'  => false,
                'required' => array( 'general_preloader', '=', '1' ),
                'title'    => __( 'Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Your Color for the icon', 'redux-framework-demo' ),
                'default'  => '#d19fae',
                'validate' => 'color',
            ),
            array(
                'id'       => 'general_boxed',
                'type'     => 'switch',
                'title'    => __( 'Enable Boxed Layout', 'redux-framework-demo' ),
                'subtitle' => __( 'Enable Boxed Layout For Your Site!', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'general_background',
                'type'     => 'background',
                'transparent'  => false,
                'required' => array( 'general_boxed', '=', '1' ),
                'output'   => array( 'body' ),
                'title'    => __( 'Background Options', 'redux-framework-demo' ),
                'subtitle' => __( 'Body background with image, pattern and color', 'redux-framework-demo' ),
                //'default'   => '#FFFFFF',
            ),
            array(
                'id'       => 'general_css',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom CSS', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => '',
                'default'  => ""
            ),
            //end array

        ),
    ) );
    ////////////////////////////////////////////////////END GENERAL SETTINGS///////////////////////////////////////////////////
    //END NICDARK REDUX
    

    
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
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
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


