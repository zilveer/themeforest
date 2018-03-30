<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "cththemes_options";

    // This line is only for altering the demo. Can be easily removed.
    //$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

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
        'menu_title'           => esc_html__( 'Gather Options', 'gather' ),
        'page_title'           => esc_html__( 'Gather Options', 'gather' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBAycicE1b8x_pLv31OaST3vhIiCxW61kY',
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
        'title' => esc_html__( 'Documentation', 'gather' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'gather' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'gather' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => esc_html__('Visit us on GitHub', 'gather' ),
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => esc_html__('Like us on Facebook', 'gather' ),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => esc_html__('Follow us on Twitter', 'gather' ),
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => esc_html__('Find us on LinkedIn', 'gather' ),
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = __( '<p>Gather is a Responsive Event, Meetup and Conference Landing Page Wordpress Theme with Working Paypal Integration, Eventbrite Integration and Mailchimp Integration. You can make a complete event related website and go live faster. This theme includes all features for an Event Website. Its carefully crafted to suit any kind of events. With its Award Winning design and Conversion principles, It becomes the no-brainer theme for events.</p>', 'gather' );
    } else {
        $args['intro_text'] = __( '<p>A "Gather – Responsive Restaurant / Pub / Cafe Wordpress Theme" is perfect if you like a clean and modern design. Gather is a clean and professional wordpress theme, perfect for Restaurant, Bakery, any food business and personal chef web sites. More features with 6 Homepages (Video , Carousel , Slideshow) – one and multi page version for versions for each option.', 'gather' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>Thanks all of you who stay with us, your co-operation is our inspiration. <a href="http://themeforest.net/user/cththemes/portfolio/" target="_blank">CTHthemes</a></p>', 'gather' );

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
            'title'   => esc_html__( 'Theme Information 1', 'gather' ),
            'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'gather' ),array('p'=>array('class'=>array())) )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'gather' ),
            'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'gather' ),array('p'=>array('class'=>array())) )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses(__( '<p>This is the sidebar content, HTML is allowed.</p>', 'gather' ),array('p'=>array('class'=>array())) );
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

    // -> START Basic Fields

    Redux::setSection( $opt_name, array(
        'title' => __('Import Demo Data', 'gather'),
        'id'         => 'import-demo-data',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-download',
        'fields' => array(
                array(
                    'id'       => 'im-demo-data',
                    'type'     => 'demo_data',
                    'title'    => __('Click button to import demo data', 'gather'),
                    // 'subtitle' => __('', 'gather'),
                    // 'desc'     => __('', 'gather'),
                    //'validate' => 'email',
                    //'msg'      => 'custom error message',
                    //'default'  => 'test@test.com'
                ),
            ),
    ));

    Redux::setSection( $opt_name, array(
        'title' => __('General', 'gather'),
        'id'         => 'general-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-cogs',
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Favicon.', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.ico'),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => __('Your Logo', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo.', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/logo-dark.png'),
            ),
            // array(
            //     'id' => 'logo2',
            //     'type' => 'media',
            //     'url' => true,
            //     'title' => __('Secondary Logo', 'gather'),
            //     //'compiler' => 'true',
            //     //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            //     'desc' => __('Upload your secondary logo.', 'gather'),
            //     'subtitle' => __('', 'gather'),
            //     'default' => array('url' => get_template_directory_uri().'/images/logo2.png'),
            // ),
            array(
                'id' => 'logo_size_width',
                'type' => 'text',
                'title' => __('Logo Size Width (in pixel)', 'gather'),
                // 'subtitle' => __('', 'gather'),
                // 'desc' => __('', 'gather'),
                'default' => '108'
            ),
            array(
                'id' => 'logo_size_height',
                'type' => 'text',
                'title' => __('Logo Size Height (in pixel)', 'gather'),
                // 'subtitle' => __('', 'gather'),
                // 'desc' => __('', 'gather'),
                'default' => '36'
            ),
            // array(
            //     'id' => 'header_height',
            //     'type' => 'text',
            //     'title' => __('Header Height (in pixel)', 'gather'),
            //     // 'subtitle' => __('', 'gather'),
            //     // 'desc' => __('', 'gather'),
            //     'default' => '50'
            // ),
            array(
                'id' => 'logo_text',
                'type' => 'text',
                'title' => __('Logo Text', 'gather'),
                // 'subtitle' => __('', 'gather'),
                // 'desc' => __('', 'gather'),
                'default' => ''
            ),
            array(
                'id' => 'slogan',
                'type' => 'text',
                'title' => __('Slogan (Sub Logo Text)', 'gather'),
                // 'subtitle' => __('', 'gather'),
                // 'desc' => __('', 'gather'),
                'default' => ''
            ),
            array(
                'id' => 'header_top_bg',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Top Background Image', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc' => __('Upload your logo.', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/header_graphic_1.png'),
            ),
            array(
                'id' => 'header_bottom_bg',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Bottom Background Image', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc' => __('Upload your logo.', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/header_graphic_2.png'),
            ),

            array(
                'id' => 'footer_light_bg',
                'type' => 'media',
                'url' => true,
                'title' => __('Bottom Section Background Image', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc' => __('Upload your logo.', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/footer_bg_light.png'),
            ),

            array(
                'id' => 'navigation_type',
                'type' => 'select',
                'title' => __('Navigation Type', 'gather'),
                'subtitle' => __('Set the navigation menu type for your blog, this option will be override by the option from page meta data.', 'gather'),
                // 'desc' => '',
                'options' => array('sticky' => 'Sticky', 'reveal' => 'Reveal', 'static' => 'Static'), //Must provide key => value pairs for select options
                'default' => 'sticky'
            ),
            array(
                'id' => 'disable_animation',
                'type' => 'switch',
                'title' => __('Disable Animation', 'gather'),
                'subtitle' => __('Set this to On to disable css animation on your page.', 'gather'),
                // 'desc' => '',
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => false
            ),
            array(
                'id' => 'show_loader',
                'type' => 'switch',
                'title' => __('Show animation loadder', 'gather'),
                'subtitle' => __('Show animation loader', 'gather'),
                // 'desc' => '',
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => true
            ),
            array(
                'id' => 'to_top_icon',
                'type' => 'media',
                'url' => true,
                'title' => __('Back Top Icon', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'desc' => __('Upload your back to top image icon.', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/back_to_top.png'),
            ),
            array(
                'id' => 'show_style_switcher',
                'type' => 'switch',
                'title' => __('Show Style Switcher', 'gather'),
                'subtitle' => __('Show Style Switcher (for demo only)', 'gather'),
                // 'desc' => '',
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => false
            ),

            array(
                'id' => 'gmap_api_key',
                'type' => 'text',
                // 'url' => true,
                'title' => esc_html__('Google Map API Key', 'gather'),
                // 'subtitle' => esc_html__('', 'gather'),
                'desc' => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get a key</a>.',
                // 'default' => '',
            ),
            
           
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Footer', 'gather'),
        'id'         => 'footer-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-pencil',
        'fields' => array(
            array(
                'id' => 'footer_info',
                'type' => 'ace_editor',
                //'url' => true,
                'title' => __('Footer Socials', 'gather'),
                //'compiler' => 'true',
                'mode'=>'html',
                'full_width'=>true,
                'desc' => __('Footer Socials', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => '
<div class="social-icons">
    <a href="#" target="_blank" class="wow zoomIn"> <i class="fa fa-twitter"></i> </a>
    <a href="#" target="_blank" class="wow zoomIn" data-wow-delay="0.2s"> <i class="fa fa-facebook"></i> </a>
    <a href="#" target="_blank" class="wow zoomIn" data-wow-delay="0.4s"> <i class="fa fa-linkedin"></i> </a>
</div>',
            ),
            array(
                'id' => 'footer_copyright',
                'type' => 'ace_editor',
                //'url' => true,
                'title' => __('Footer Copyright', 'gather'),
                //'compiler' => 'true',
                'mode'=>'html',
                'full_width' => true,
                'desc' => __('Footer Copyright', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => '<p><small class="text-muted">Copyright © 2015. All rights reserved.</small></p>',
            ),

            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Media', 'gather'),
        'id'         => 'thumbnail_images',
        'subsection' => false,
        'desc'       => __( 'These settings affect the display and dimensions of images in your pages.<br> - Enter 9999 as Width value and uncheck Hard Crop to make your thumbnail dynamic width. <br> - Enter 9999 as Width and Height values to use full size image.<br> After changing these settings you may need to ', 'gather' ) . '<a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">regenerate your thumbnails</a>.',
        'icon'       => 'el-icon-picture',
        'fields' => array(
            array(
                'id' => 'enable_custom_sizes',
                'type' => 'switch',
                'on' => 'Yes',
                'off' => 'No',
                'title' => esc_html__('Enable Custom Image Sizes', 'gather'),
                'default' => false
            ), 
            
            array(
                'id'       => 'headerimg_thumb',
                'type'     => 'thumbnail_size',
                // 'units'    => array('em','px','%'),
                'title' => esc_html__('Header Image Size', 'gather'),
                'subtitle' => esc_html__('For Home Slideshow and video background.', 'gather'),
                // 'desc'     => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.', 'gather'),
                'default'  => array(
                    'width'   => '1366', 
                    'height'  => '717',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'galone_thumb',
                'type'     => 'thumbnail_size',
                // 'units'    => array('em','px','%'),
                'title' => esc_html__('Gallery Size One Thumbnail', 'gather'),
                // 'subtitle' => esc_html__('Allow your to choose width, height, and crop thumbnail.', 'gather'),
                // 'desc'     => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.', 'gather'),
                'default'  => array(
                    'width'   => '263', 
                    'height'  => '175',
                    'hard_crop'  => 1
                ),
            ),
            array(
                'id'       => 'galtwo_thumb',
                'type'     => 'thumbnail_size',
                // 'units'    => array('em','px','%'),
                'title' => esc_html__('Gallery Size Two Thumbnail', 'gather'),
                // 'subtitle' => esc_html__('Allow your to choose width, height, and crop thumbnail.', 'gather'),
                // 'desc'     => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.', 'gather'),
                'default'  => array(
                    'width'   => '555', 
                    'height'  => '387',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'testi_thumb',
                'type'     => 'thumbnail_size',
                // 'units'    => array('em','px','%'),
                'title' => esc_html__('Testimonial Thumbnail', 'gather'),
                // 'subtitle' => esc_html__('Allow your to choose width, height, and crop thumbnail.', 'gather'),
                // 'desc'     => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.', 'gather'),
                'default'  => array(
                    'width'   => '67', 
                    'height'  => '67',
                    'hard_crop'  => 1
                ),
            ),
            

            array(
                'id'       => 'blog_image_thumb',
                'type'     => 'thumbnail_size',
                // 'units'    => array('em','px','%'),
                'title' => esc_html__('Blog Post Thumbnail', 'gather'),
                // 'subtitle' => esc_html__('Allow your to choose width, height, and crop thumbnail.', 'gather'),
                // 'desc'     => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.', 'gather'),
                'default'  => array(
                    'width'   => '360', 
                    'height'  => '240',
                    'hard_crop'  => 1
                ),
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('MailChimp Subscribe', 'gather'),
        'id'         => 'mailchimp-subscribe',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-pencil',
        'fields' => array(
            array(
                'id' => 'mailchimp_api',
                'type' => 'text',
                'title' => __('Mailchimp API key', 'gather'),
                'desc' => __('<a href="http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key" target="_blank">Find your API key</a>', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => '',
            ),
            array(
                'id' => 'mailchimp_list_id',
                'type' => 'text',
                'title' => __('Mailchimp List ID', 'gather'),
                'desc' => __('<a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">Find your list ID</a>', 'gather'),
                // 'subtitle' => __('', 'gather'),
                'default' => '',
            ),

            
        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __('Colors', 'gather'),
        'id'         => 'styling-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-magic',
        'fields' => array(
           
            array(
                'id'       => 'color-preset',
                'type'     => 'image_select',
                'title'    => __( 'Theme Color', 'gather' ),
                'subtitle' => __( 'Select your theme color', 'gather' ),
                'desc'     => __( 'Select your theme color', 'gather' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'default' => array(
                        'alt' => 'Default Green',
                        'img' => get_template_directory_uri(). '/functions/assets/default.png'
                    ),
                    'purple' => array(
                        'alt' => 'Purple',
                        'img' => get_template_directory_uri(). '/functions/assets/skin1.png'
                    ),
                    'red' => array(
                        'alt' => 'Red',
                        'img' => get_template_directory_uri(). '/functions/assets/skin2.png'
                    ),
                    'yellow' => array(
                        'alt' => 'Yellow',
                        'img' => get_template_directory_uri(). '/functions/assets/skin3.png'
                    ),
                    'mint' => array(
                        'alt' => 'Mint',
                        'img' => get_template_directory_uri(). '/functions/assets/skin4.png'
                    ),
                    'blue' => array(
                        'alt' => 'Blue',
                        'img' => get_template_directory_uri(). '/functions/assets/skin5.png'
                    ),
                    'black' => array(
                        'alt' => 'Black',
                        'img' => get_template_directory_uri(). '/functions/assets/skin6.png'
                    ),
                    
                    
                ),
                'default'  => 'default'
            ),
            array(
                'id' => 'override-preset',
                'type' => 'switch',
                'title' => __('Use Your Own', 'gather'),
                'subtitle' => __('Set this to <b>Yes</b> if you want to use color variants bellow.', 'gather'),
                // 'desc' => '',
                'default' => false
            ),
            array(
                'id' => 'theme-skin-color',
                'type' => 'color',
                'title' => __('Theme Skin Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Pick the primary color for the theme (default: #4eae49).', 'gather'),
                'default' => '#4eae49',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'main-bg-color',
                'type' => 'color',
                'title' => __('Main Page Background Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Main Page Background Color (default: #ffffff).', 'gather'),
                'default' => '#ffffff',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'navigation-bg-color',
                'type' => 'color',
                'title' => __('Navigation Background Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Navigation Background Color (default: #ffffff).', 'gather'),
                'default' => '#ffffff',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'footer-bg-color',
                'type' => 'color',
                'title' => __('Footer Background Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Footer Background Color (default: #ffffff).', 'gather'),
                'default' => '#ffffff',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'main-text-color',
                'type' => 'color',
                'title' => __('Main Text Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Main Text Color (default: #5c5c5c).', 'gather'),
                'default' => '#5c5c5c',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'navigation-menu-color',
                'type' => 'color',
                'title' => __('Navigation Menu Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Navigation Menu Color (default: #818181).', 'gather'),
                'default' => '#818181',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'navigation-menu-hover-color',
                'type' => 'color',
                'title' => __('Navigation Menu Hover Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Navigation Menu Hover Color (default: #333333).', 'gather'),
                'default' => '#333333',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            array(
                'id' => 'navigation-menu-active-color',
                'type' => 'color',
                'title' => __('Navigation Menu Active Color', 'gather'),
                //'compiler'      => true,
                //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
                'subtitle' => __('Navigation Menu Active Color (default: #ffffff).', 'gather'),
                'default' => '#ffffff',
                'validate' => 'color',
                //'mode'=>'background-color',
            ),
            
            
            
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Fonts', 'gather'),
        'id'         => 'font-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-fontsize',
        'fields' => array(
            array(
                'id' => 'body-font',
                'type' => 'typography',
                'output' => array('body'),
                'title' => __('Body Font', 'gather'),
                'subtitle' => __('Specify the body font properties.</br> Default</br>font-family: Open Sans</br>font-size: 16px</br>line-height: 27px</br>font-weight: 300</br>color: #5c5c5c', 'gather'),
                'google' => true,
                // 'default' => array(
                //     'color' => '#444444',
                //     'font-size' => '14px',
                //     'line-height' => '24px',
                //     'font-family' => "Open Sans",
                //     'font-weight' => '400',
                // ),
            ),
            array(
                'id' => 'hyperlink-font',
                'type' => 'typography',
                'output' => array('a'),
                'title' => esc_html__('Hyperlink Font', 'gather'),
                'subtitle' => __('Hyperlink font properties.</br> Default</br>font-family: Open Sans</br>font-size: 16px</br>line-height: 23px</br>font-weight: 300</br>color: #4EAE49', 'gather'),
                'google' => true,
            ),
            array(
                'id' => 'hyperlink-hover-font',
                'type' => 'typography',
                'output' => array('a:hover'),
                'title' => esc_html__('Hyperlink Hover Font', 'gather'),
                'subtitle' => __('Hyperlink hover font properties.</br> Default</br>font-family: Open Sans</br>font-size: 16px</br>line-height: 23px</br>font-weight: 300</br>color: #4EAE49', 'gather'),
                'google' => true,
            ),
            array(
                'id' => 'paragraph-font',
                'type' => 'typography',
                'output' => array('p'),
                'title' => __('Paragraph Font', 'gather'),
                'subtitle' => __('Specify paragraph font properties. Default</br>font-family: Open Sans</br>font-size: 16px</br>line-height: 27px</br>font-weight: 400</br>color: #5c5c5c', 'gather'),
                'google' => true,
                // 'default' => array(
                //     'font-size' => '14px',
                //     'line-height' => '18px',
                //     'font-family' => "Open Sans",
                // ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'output' => array('h1, h2, h3, h4, h5, h6'),
                'title' => __('Title-Header Font', 'gather'),
                'subtitle' => __('Specify the title and heading font properties.</br> Default</br>font-family: Montserrat</br>font-weight: 700</br>color: #5c5c5c', 'gather'),
                'google' => true,
                // 'default' => array(
                //     'color' => '#222222',
                //     'font-family' => "Open Sans",
                //     'font-weight' => '700',
                // ),
            ),

            array(
                'id' => 'gather-navigation-font',
                'type' => 'typography',
                'output' => array('.navbar-default .navbar-nav > li > a'),
                'title' => esc_html__('Theme Navigation Font', 'gather'),
                'subtitle' => __('Theme navigation font.<br> Default</br>font-family: Open Sans</br>font-size: 13px</br>line-height: 20px</br>font-weight: 600</br>color: #818181', 'gather'),
                'google' => true,
            ),
            
            
            
        ),
    ) );
    /*
    Redux::setSection( $opt_name, array(
        'title' => __('Shop Settings', 'gather'),
        'id'         => 'shop-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-shopping-cart',
        'fields' => array(
            array(
                'id' => 'shopbg',
                'type' => 'media',
                'url' => true,
                'title' => __('Shop Header Background', 'gather'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Shop Header Background.', 'gather'),
                'subtitle' => __('', 'gather'),
                'default' => array('url' => get_template_directory_uri().'/images/bg/21.jpg'),
            ),

            // array(
            //     'id'       => 'shop_show_page_title',
            //     'type'     => 'switch',
            //     'title'    => __( 'Show Shop Page Title', 'gather' ),
            //     'subtitle' => __( 'Set this to On to show shop page title', 'gather' ),
            //     'default'  => true,
            // ),

            array(
                'id' => 'shop_page_intro',
                'type' => 'ace_editor',
                'title' => __('Shop Introtext', 'gather'),
                'subtitle' => __('', 'gather'),
                'mode' => 'html',
                //'compiler'=>array('body'),
                'full_width'=>true,
                'theme' => 'monokai',
                'desc' => 'This introtext will display in shop header page.',
                'default' => '
<div class="section-title">
    <h4>Shop Information</h4>
</div>
<div class="inner">
    <p> Numerous commentators have also referred to the supposed restaurant owner\'s eccentric habit of touting for custom outside his establishment, dressed in aristocratic fashion and brandishing a sword</p>
</div>
<div class="bold-separator">
    <span></span>
</div>'
            ),

            

            array(
                'id' => 'shop_columns',
                'type' => 'select',
                'title' => __('Shop Archive Columns Grid', 'gather'),
                'subtitle' => __('', 'gather'),
                'desc' => '',
                'options' => array('12' => 'One Column', '6' => 'Two Columns','4' => 'Three Columns', '3' => 'Four Columns', '2' => 'Six Columns'), //Must provide key => value pairs for select options
                'default' => '4'
            ),

            array(
                'id' => 'shop_smcolumns',
                'type' => 'select',
                'title' => __('Shop Archive Columns Grid (for mobile)', 'gather'),
                'subtitle' => __('', 'gather'),
                'desc' => '',
                'options' => array('12' => 'One Column', '6' => 'Two Columns','4' => 'Three Columns', '3' => 'Four Columns', '2' => 'Six Columns'), //Must provide key => value pairs for select options
                'default' => '6'
            ),

            array(
                'id'       => 'shop_sidebar',
                'type'     => 'select',
                'title'    => __( 'Shop Sidebar', 'gather' ),
                'subtitle' => __( '', 'gather' ),
                'desc' => '',
                'options' => array('right' => 'Right Sidebar', 'left' => 'Left Sidebar','none' => 'No Sidebar'), //Must provide key => value pairs for select options
                'default' => 'right'
            ),

            array(
                'id' => 'related_products_count',
                'type' => 'text',
                'title' => __('Related Products Count', 'gather'),
                'subtitle' => '',
                'desc' => 'Set number of related products to show.',
                
                'default' => '3'
            ),

            array(
                'id'       => 'shop_breadcrumbs',
                'type'     => 'switch',
                'title'    => __( 'Show Shop Breadcrumbs', 'gather' ),
                'subtitle' => __( 'Set this to On to show shop page breadcrumbs.', 'gather' ),
                'default'  => true,
            ),
        ),
    ) );
    */
    Redux::setSection( $opt_name, array(
        'title' => __('Blog', 'gather'),
        'id'         => 'blog-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-website',
        'fields' => array(
            array(
                    'id' => 'blog_home_text',
                    'type' => 'text',
                    'title' => __('Blog Heading Text', 'gather'),
                    // 'subtitle' => __('', 'gather'),
                    // 'desc' => __('', 'gather'),
                    'default' => 'Our Blog'
                ),
            array(
                    'id' => 'blog_home_text_intro',
                    'type' => 'textarea',
                    'title' => __('Blog Intro Text', 'gather'),
                    // 'subtitle' => __('', 'gather'),
                    // 'desc' => __('', 'gather'),
                    'default' => "Stay up to date with our latest blogs."
                ),
            // array(
            //     'id' => 'blog_header_image',
            //     'type' => 'media',
            //     'url' => true,
            //     'title' => __('Blog Header Image', 'gather'),
            //     //'compiler' => 'true',
            //     //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            //     'desc' => __('Upload your blog header image', 'gather'),
            //     'subtitle' => __('', 'gather'),
            //     'default' => array('url' => get_template_directory_uri().'/images/bg/18.jpg'),
            // ),
            array(
                    'id'       => 'blog_layout',
                    'type'     => 'image_select',
                    //'compiler' => true,
                    'title'    => __( 'Blog Layout', 'gather' ),
                    'subtitle' => __( 'Select main content and sidebar layout. The option 4 is default layout with right parallax image for Domik theme.', 'gather' ),
                    'options'  => array(
                        'fullwidth' => array(
                            'alt' => 'Fullwidth',
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'left_sidebar' => array(
                            'alt' => 'Left Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                        'right_sidebar' => array(
                            'alt' => 'Right Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        // 'gather' => array(
                        //     'alt' => 'Right Sidebar',
                        //     'img' => get_template_directory_uri() . '/functions/assets/gather.png'
                        // ),
                        
                    ),
                    'default'  => 'right_sidebar'
                ),

            // array(
            //     'id'       => 'blog_breadcrumbs',
            //     'type'     => 'switch',
            //     'title'    => __( 'Blog Breadcrumbs', 'gather' ),
            //     'subtitle' => __( 'Set this to On to show blog page breadcrumbs.', 'gather' ),
            //     'default'  => false,
            // ),
            // array(
            //     'id' => 'blog_single_meta_pos',
            //     'type' => 'select',
            //     'title' => __('Meta Post Position', 'gather'),
            //     'subtitle' => __('Choose where post meta data should display on single post page', 'gather'),
            //     'desc' => '',
            //     'options' => array('default' => 'Main Page', 'header' => 'Header'), //Must provide key => value pairs for select options
            //     'default' => 'default'
            // ),
            array(
                'id'       => 'blog_author',
                'type'     => 'switch',
                'title'    => __( 'Show Author', 'gather' ),
                // 'subtitle' => __( '', 'gather' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_date',
                'type'     => 'switch',
                'title'    => __( 'Show Date', 'gather' ),
                // 'subtitle' => __( '', 'gather' ),
                'default'  => true,
            ),
            // array(
            //     'id'       => 'blog_like_post',
            //     'type'     => 'switch',
            //     'title'    => __( 'Show Like Post', 'gather' ),
            //     'subtitle' => __( '', 'gather' ),
            //     'default'  => false,
            // ),
            array(
                'id'       => 'blog_cats',
                'type'     => 'switch',
                'title'    => __( 'Show Categories', 'gather' ),
                // 'subtitle' => __( '', 'gather' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_tags',
                'type'     => 'switch',
                'title'    => __( 'Show Tags', 'gather' ),
                // 'subtitle' => __( '', 'gather' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_comments',
                'type'     => 'switch',
                'title'    => __( 'Show Comments', 'gather' ),
                // 'subtitle' => __( '', 'gather' ),
                'default'  => true,
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('404 Page', 'gather'),
        'id'         => '404-intro-text-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-file-edit',
        'fields' => array(
            // array(
            //     'id' => '404_bg',
            //     'type' => 'media',
            //     'url' => true,
            //     'title' => __('404 Background', 'gather'),
            //     //'compiler' => 'true',
            //     //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            //     'desc' => __('This image will be used for background image in 404 page.', 'gather'),
            //     'subtitle' => __('', 'gather'),
            //     'default' => array('url' => get_template_directory_uri().'/images/bg/1.jpg'),
            // ),
            array(
                'id' => '404_intro',
                'type' => 'editor',
                'title' => __('404 Page Message', 'gather'),
                // 'subtitle' => '',
                // 'desc' => '',
                
                'default' => 'Sorry, but the page you are looking for has not been found.'
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Custom Code', 'gather'),
        'id'         => 'custom-code',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'gather' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-file-new',
        'fields' => array(
            array(
                'id' => 'custom-css',
                'type' => 'ace_editor',
                'title' => __('CSS Code', 'gather'),
                'subtitle' => __('Paste your CSS code here.', 'gather'),
                'mode' => 'css',
                //'compiler'=>array('body'),
                'full_width'=>true,
                'theme' => 'monokai',
                'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                'default' => ""
            ),
            
        ),
    ) );


    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'gather' ),
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

    add_filter( "redux/" . $opt_name . "/field/class/demo_data", "overload_demo_data_field_path" ); // Adds the local field

    function overload_demo_data_field_path($field) {

        return get_template_directory().'/includes/demo_data_field/field_demo_data.php';
    }

    add_filter( "redux/" . $opt_name . "/field/class/thumbnail_size", "overload_thumbnail_size_field_path" ); // Adds the local field

    function overload_thumbnail_size_field_path($field) {

        return get_template_directory().'/includes/redux_add_fields/field_thumbnail_size.php';
    }

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
                'title'  => esc_html__( 'Section via hook', 'gather' ),
                'desc'   => wp_kses(__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'gather' ),array('p'=>array('class'=>array())) ),
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
