<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_prefix";


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
        'menu_title'           => __( 'Avantgarde Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Avantgarde Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyC_DvFJA7SljYfSGUwT-N5VQWhz2iMK-RQ',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => '',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
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
        'menu_icon'            => IMAGES.'/redux-framework.png',
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
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

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



    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
  
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/2035Themes',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/2035Themes',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );



    // Add content after the form.
  
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */




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



    
    Redux::setSection( $opt_name, array(
        'title' => __( 'General', 'redux-framework-demo' ),
        'id'    => 'general',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-home',
        'fields'     => array(   
            array(
                'id'       => 'main-color',
                'type'     => 'color',
                'title'    => __( 'Main Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a main color for the theme (default: #e4c425).', 'redux-framework-demo' ),
                'default'  => '#e4c425',
            ),
            array(
                'id'       => 'site-background',
                'type'     => 'background',
                'output'   => array( 'body' ),
                'title'    => __( 'Body Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'redux-framework-demo' ),
                'default'   => '#f9f9f9',
            ),
            array(
                'id'       => 'header-background',
                'type'     => 'background',
                'title'    => __( 'Header Background', 'redux-framework-demo' ),
                'subtitle' => __( 'You can style Header Background', 'redux-framework-demo' ),
                'default'  => array(
                    'background-color'=> "#FFF"
                ),
            ),   
            array(
                'id' => 'sidebar-type',
                'type' => 'select',  
                'title' => __('Sidebar Position', 'redux-framework-demo'),
                'subtitle' => __('Sidebar Position Layout', 'redux-framework-demo'),
                'options' => array( 'right' => 'Right Sidebar', 'left' => 'Left Sidebar', 'none' => 'No Sidebar'),
                'default' => 'right',
            ),
            array(
                'id' => 'blog_sidebar',
                'type' => 'select',
                'required' => array('sidebar-type', 'not', 'none'),
                'title' => __('Home Blog Sidebar', 'Theme2035Framework'),
                'subtitle' => __('Select your blog sidebar', 'redux-framework-demo'),
                'desc' => __('', 'Theme2035Framework'),
                'data'      => 'sidebars',
                'default' => 'sidebar-1',
            ),

        ),
       ) );


    
    Redux::setSection( $opt_name, array(
        'title' => __( 'Slider', 'redux-framework-demo' ),
        'id'    => 'slider',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-photo',
        'fields'     => array(
            array(
                'id'       => 'slider-visibility',
                'type'     => 'switch',
                'title'    => __( 'Slider Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Slider Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            array(
                'id' => 'slider-title',
                'type' => 'text',
                'title' => __('Slider Title', 'redux-framework-demo'),
                'desc' => __('Slider Title', 'redux-framework-demo'),
                'subtitle' => __('Slider Title', 'redux-framework-demo'),
                'default' => 'SPECIAL POSTS'
            ),
            array(
                'id'       => 'slider-count',
                'type'     => 'select',
                'title'    => __( 'Slider Type', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Type', 'redux-framework-demo' ),
                'desc'     => __( 'Select Slider Type', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '3' => '3 Columns',
                    '1' => '1 Column',
                    'sidebar' => '1 Column / Sidebar',
                ),
                'default'  => 'sidebar'
            ),
             array(
                'id'            => 'slider-post-item',
                'type'          => 'spinner',
                'title'         => __( 'Slider Post Count', 'redux-framework-demo' ),
                'desc'          => __( 'Please write post limit. (Default : 8)', 'redux-framework-demo' ),
                'default'       => 8,
                'min'           => 1,
                'step'          => 1,
                'max'           => 500,
                'display_value' => 'label'
            ),
        ),
    ));


    
    Redux::setSection( $opt_name, array(
        'title' => __( 'Post Settings', 'redux-framework-demo' ),
        'id'    => 'post-settings',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-edit',
        'fields'     => array(
            array(
                'id'       => 'link-color',
                'type'     => 'color',
                'title'    => __( 'Link Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a main Link for posts area (default: #000).', 'redux-framework-demo' ),
                'default'  => '#000',
            ),               
            array(
                'id'       => 'link-style',
                'type'     => 'select',
                'title'    => __( 'Link Style', 'redux-framework-demo' ),
                'options'  => array(
                    'bold' => 'Bold',
                    'regular' => 'Regular',
                ),
                'default'  => 'regular'
            ),         
            array(
                'id'       => 'share-visibility',
                'type'     => 'switch',
                'title'    => __( 'Share Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Share Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related-post-visibility',
                'type'     => 'switch',
                'title'    => __( 'Related Post Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Related Post Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            array(
                'id'       => 'featured-position',
                'type'     => 'select',
                'title'    => __( 'Featured Image Position', 'redux-framework-demo' ),
                'desc'     => __( 'Featured Image Position (Default : Before Title)', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'before' => 'Before Title',
                    'after' => 'After Title',
                ),
                'default'  => 'before'
            ),

            array(
                'id'             => 'featured-spacing',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => __('Featured Image Spacing', 'redux-framework-demo'),
                'desc'          => __('You can add some space from here. Default : 0px', 'redux-framework-demo'),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-right'   => '0px', 
                    'padding-bottom'  => '0px', 
                    'padding-left'    => '0px',
                )
            ),

        ),
    ));


    
    Redux::setSection( $opt_name, array(
        'title' => __( 'Header', 'redux-framework-demo' ),
        'id'    => 'header',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'section-social',
                'type'     => 'section',
                'title'    => __( 'Main Nav', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),      
            array(
                'id'       => 'image-position',
                'type'     => 'select',
                'title'    => __( 'Nav Image Position', 'redux-framework-demo' ),
                'options'  => array(
                    'left' => 'Left',
                    'top' => 'Top',
                ),
                'default'  => 'top'
            ),          
            array(
                'id'       => 'pre-header-visibility',
                'type'     => 'switch',
                'title'    => __( 'Pre-Header Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Pre-Header Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            array(
                'id'       => 'pre-header-style',
                'type'     => 'select',
                'title'    => __( 'Pre Header Style', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'dark' => 'Dark Background',
                    'white' => 'White Background',
                ),
                'default'  => 'dark'
            ),
            array(
                'id'       => 'section-social',
                'type'     => 'section',
                'title'    => __( 'Social Media', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'header-search',
                'type'     => 'switch',
                'title'    => __( 'Header Search Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Header Search Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            array(
                'id'       => 'header-social-media',
                'type'     => 'switch',
                'title'    => __( 'Social Media Visibility', 'redux-framework-demo' ),
                'subtitle' => __( 'Social Media Visibility (Default : Show)', 'redux-framework-demo' ),
                'default'  => true,
            ),
            ),
       ) );




    
    Redux::setSection( $opt_name, array(
        'title' => __( 'Social Media', 'redux-framework-demo' ),
        'id'    => 'social-media',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-twitter',
        'fields'     => array(
            array(
                'id' => 'behance-header',
                'type' => 'text',
                'title' => __('Behance', 'redux-framework-demo'),
                'desc' => __('Behance URL', 'redux-framework-demo'),
                'subtitle' => __('Behance URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'deviantart-header',
                'type' => 'text',
                'title' => __('Deviantart', 'redux-framework-demo'),
                'desc' => __('Deviantart URL', 'redux-framework-demo'),
                'subtitle' => __('Deviantart URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'dribbble-header',
                'type' => 'text',
                'title' => __('Dribbble', 'redux-framework-demo'),
                'desc' => __('Dribbble URL', 'redux-framework-demo'),
                'subtitle' => __('Dribbble URL', 'redux-framework-demo'),
                'default' => ''
            ), 
            array(
                'id' => 'facebook-header',
                'type' => 'text',
                'title' => __('Facebook', 'redux-framework-demo'),
                'desc' => __('Facebook URL', 'redux-framework-demo'),
                'subtitle' => __('Facebook URL', 'redux-framework-demo'),
                'default' => 'https://facebook.com/2035themes'
            ),                                         
            array(
                'id' => 'flickr-header',
                'type' => 'text',
                'title' => __('Flickr', 'redux-framework-demo'),
                'desc' => __('Flickr URL', 'redux-framework-demo'),
                'subtitle' => __('Flickr URL', 'redux-framework-demo'),
                'default' => ''
            ),                                          
            array(
                'id' => 'foursquare-header',
                'type' => 'text',
                'title' => __('Foursquare', 'redux-framework-demo'),
                'desc' => __('Foursquare URL', 'redux-framework-demo'),
                'subtitle' => __('Foursquare URL', 'redux-framework-demo'),
                'default' => ''
            ),  
            array(
                'id' => 'github-header',
                'type' => 'text',
                'title' => __('Github URL', 'redux-framework-demo'),
                'desc' => __('Github URL', 'redux-framework-demo'),
                'subtitle' => __('Github URL', 'redux-framework-demo'),
                'default' => ''
            ), 
            array(
                'id' => 'google-plus-header',
                'type' => 'text',
                'title' => __('Google + URL', 'redux-framework-demo'),
                'desc' => __('Google + URL', 'redux-framework-demo'),
                'subtitle' => __('Google + URL', 'redux-framework-demo'),
                'default' => ''
            ),                                        
            array(
                'id' => 'instagram-header',
                'type' => 'text',
                'title' => __('instagram', 'redux-framework-demo'),
                'desc' => __('instagram URL', 'redux-framework-demo'),
                'subtitle' => __('instagram URL', 'redux-framework-demo'),
                'default' => ''
            ),                                         
            array(
                'id' => 'linkedin-header',
                'type' => 'text',
                'title' => __('Linkedin', 'redux-framework-demo'),
                'desc' => __('Linkedin URL', 'redux-framework-demo'),
                'subtitle' => __('Linkedin URL', 'redux-framework-demo'),
                'default' => ''
            ),                                        
            array(
                'id' => 'medium-header',
                'type' => 'text',
                'title' => __('Medium', 'redux-framework-demo'),
                'desc' => __('Medium URL', 'redux-framework-demo'),
                'subtitle' => __('Medium URL', 'redux-framework-demo'),
                'default' => ''
            ),                                         
            array(
                'id' => 'pinterest-header',
                'type' => 'text',
                'title' => __('Pinterest', 'redux-framework-demo'),
                'desc' => __('Pinterest URL', 'redux-framework-demo'),
                'subtitle' => __('Pinterest URL', 'redux-framework-demo'),
                'default' => ''
            ),                                        
            array(
                'id' => 'reddit-header',
                'type' => 'text',
                'title' => __('Reddit', 'redux-framework-demo'),
                'desc' => __('Reddit URL', 'redux-framework-demo'),
                'subtitle' => __('Reddit URL', 'redux-framework-demo'),
                'default' => ''
            ),                                        
            array(
                'id' => 'stumbleupon-header',
                'type' => 'text',
                'title' => __('Stumbleupon', 'redux-framework-demo'),
                'desc' => __('Stumbleupon URL', 'redux-framework-demo'),
                'subtitle' => __('Stumbleupon URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'tumblr-header',
                'type' => 'text',
                'title' => __('Tumblr', 'redux-framework-demo'),
                'desc' => __('Tumblr URL', 'redux-framework-demo'),
                'subtitle' => __('Tumblr URL', 'redux-framework-demo'),
                'default' => 'https://tumblr.com/2035themes'
            ),
            array(
                'id' => 'twitter-header',
                'type' => 'text',
                'title' => __('Twitter', 'redux-framework-demo'),
                'desc' => __('Twitter URL', 'redux-framework-demo'),
                'subtitle' => __('Twitter URL', 'redux-framework-demo'),
                'default' => 'https://twitter.com/2035themes'
            ),

            array(
                'id' => 'vimeo-header',
                'type' => 'text',
                'title' => __('Vimeo', 'redux-framework-demo'),
                'desc' => __('Vimeo URL', 'redux-framework-demo'),
                'subtitle' => __('Vimeo URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'vine-header',
                'type' => 'text',
                'title' => __('vine', 'redux-framework-demo'),
                'desc' => __('vine URL', 'redux-framework-demo'),
                'subtitle' => __('vine URL', 'redux-framework-demo'),
                'default' => 'http://vine.com/2035themes'
            ),
            array(
                'id' => 'vk-header',
                'type' => 'text',
                'title' => __('Vk', 'redux-framework-demo'),
                'desc' => __('Vk URL', 'redux-framework-demo'),
                'subtitle' => __('Vk URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'whatsapp-header',
                'type' => 'text',
                'title' => __('Whatsapp', 'redux-framework-demo'),
                'desc' => __('Whatsapp URL', 'redux-framework-demo'),
                'subtitle' => __('Whatsapp URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'wordpress-header',
                'type' => 'text',
                'title' => __('Wordpress', 'redux-framework-demo'),
                'desc' => __('Wordpress URL', 'redux-framework-demo'),
                'subtitle' => __('Wordpress URL', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'youtube-header',
                'type' => 'text',
                'title' => __('Youtube', 'redux-framework-demo'),
                'desc' => __('Youtube Username', 'redux-framework-demo'),
                'subtitle' => __('Youtube Username', 'redux-framework-demo'),
                'default' => ''
            ),
            array(
                'id' => 'custom-social-site-1',
                'type' => 'section',
                'title' => __('Custom Social Site 1', 'redux-framework-demo'),
                'subtitle' => __('Custom Social Site 1', 'redux-framework-demo'),
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),      
            array(
                'id' => 'custom-site-name-1',
                'type' => 'text',
                'title' => __('Custom Site Name - 1', 'redux-framework-demo'),
                'desc' => __('Custom Site Name', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site Name (Example : Foursquare, hotels.com)', 'redux-framework-demo'),
                'default' => ''
            ),       
            array(
                'id' => 'custom-site-url-1',
                'type' => 'text',
                'title' => __('Custom Site URL - 1', 'redux-framework-demo'),
                'desc' => __('Custom Site URL', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site URL', 'redux-framework-demo'),
                'default' => ''
            ),  
            array(
                'id' => 'custom-site-logo-1',
                'type' => 'media',
                'title' => __('Custom Site Logo - 1', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload Logo (20px x 20px)', 'redux-framework-demo'),
            ),    

            array(
                'id' => 'custom-social-site-2',
                'type' => 'section',
                'title' => __('Custom Social Site 2', 'redux-framework-demo'),
                'subtitle' => __('Custom Social Site 2', 'redux-framework-demo'),
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),    
            array(
                'id' => 'custom-site-name-2',
                'type' => 'text',
                'title' => __('Custom Site Name - 2', 'redux-framework-demo'),
                'desc' => __('Custom Site Name', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site Name (Example : Foursquare, hotels.com)', 'redux-framework-demo'),
                'default' => ''
            ),       
            array(
                'id' => 'custom-site-url-2',
                'type' => 'text',
                'title' => __('Custom Site URL - 2', 'redux-framework-demo'),
                'desc' => __('Custom Site URL', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site URL', 'redux-framework-demo'),
                'default' => ''
            ),  
            array(
                'id' => 'custom-site-logo-2',
                'type' => 'media',
                'title' => __('Custom Site Logo - 2', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload Logo (20px x 20px)', 'redux-framework-demo'),
            ),  
            array(
                'id' => 'custom-social-site-3',
                'type' => 'section',
                'title' => __('Custom Social Site 3', 'redux-framework-demo'),
                'subtitle' => __('Custom Social Site 3', 'redux-framework-demo'),
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),      
            array(
                'id' => 'custom-site-name-3',
                'type' => 'text',
                'title' => __('Custom Site Name - 3', 'redux-framework-demo'),
                'desc' => __('Custom Site Name', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site Name (Example : Foursquare, hotels.com)', 'redux-framework-demo'),
                'default' => ''
            ),       
            array(
                'id' => 'custom-site-url-3',
                'type' => 'text',
                'title' => __('Custom Site URL - 3', 'redux-framework-demo'),
                'desc' => __('Custom Site URL', 'redux-framework-demo'),
                'subtitle' => __('Write Custom Site URL', 'redux-framework-demo'),
                'default' => ''
            ),  
            array(
                'id' => 'custom-site-logo-3',
                'type' => 'media',
                'title' => __('Custom Site Logo - 3', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload Logo (20px x 20px)', 'redux-framework-demo'),
            ),    
        ),
    ) 
    );




    Redux::setSection( $opt_name, array(
        'title'      => __( 'Logo & Favicon', 'redux-framework-demo' ),
        'id'         => 'logo-favicon',
        'icon'  => 'el el-upload',
        'subsection' => false,
        'fields'     => array(
            array(
                'id'       => 'logo-type',
                'type'     => 'select',
                'title'    => __( 'Logo Type', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Image or Text', 'redux-framework-demo' ),
                'desc'     => __( 'Image : You Can Upload Logo Image . Text : Your Wordpress Title show up text', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'image' => 'Image',
                    'text' => 'Text',
                ),
                'default'  => 'image'
            ),
            array(
                'id' => 'logo',
                'required'    => array('logo-type', 'equals', 'image'),
                'type' => 'media',
                'title' => __('Logo', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload Header Logo', 'redux-framework-demo'),
            ), 
            array(
                'id'             => 'logo-padding',
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                'all'            => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                //'display_units' => 'false',   // Set to false to hide the units if the units are specified
                'title'          => __( 'Padding/Margin Option', 'redux-framework-demo' ),
                'desc'           => __( 'You can increase or decrease logo padding.', 'redux-framework-demo' ),
                'default'        => array(
                    'padding-top'    => '90px',
                    'padding-bottom' => '90px',
                )
            ),
            array(
                'id' => 'favicon',
                'type' => 'media',
                'title' => __('Favicon', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('<a target="_blank" href="http://en.wikipedia.org/wiki/Favicon">What is Favicon?</a>', 'redux-framework-demo'),
                'subtitle' => __('Upload Favicon', 'redux-framework-demo'),
            ), 
             array(
                'id' => 'ipad_retina_icon',
                'type' => 'media',
                'title' => __('Ipad Retina Icon (144x144)', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Ipad Retina Icon (144x144)', 'redux-framework-demo'),
                'subtitle' => __('Upload Ipad Retina Icon', 'redux-framework-demo'),
            ),   
             array(
                'id' => 'iphone_icon_retina',
                'type' => 'media',
                'title' => __('Iphone Retina Icon (114x114)', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Iphone Retina Icon (114x114)', 'redux-framework-demo'),
                'subtitle' => __('Upload Iphone Retina Icon', 'redux-framework-demo'),
            ), 
              array(
                'id' => 'ipad_icon',
                'type' => 'media',
                'title' => __('Ipad Icon (72x72)', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Ipad Icon (72x72)', 'redux-framework-demo'),
                'subtitle' => __('Upload Ipad Icon', 'redux-framework-demo'),
            ), 
              array(
                'id' => 'iphone_icon',
                'type' => 'media',
                'title' => __('Iphone Icon (57x57)', 'redux-framework-demo'),
                'compiler' => 'true',
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Iphone Icon (57x57)', 'redux-framework-demo'),
                'subtitle' => __('Upload Iphone Icon', 'redux-framework-demo'),
            ),     
    
        ),
        ) );

        Redux::setSection( $opt_name, array(
            'title'  => __( 'Typography', 'redux-framework-demo' ),
            'id'     => 'typography',
            'icon'   => 'el el-font',
            'fields' => array(
                array(
                    'id'       => 'body-font',
                    'type'     => 'typography',
                    'title'    => __( 'Body Typography', 'redux-framework-demo' ),
                    'output'      => array('body'),
                    'text-align'      => false,
                    'subtitle' => __( 'Body Font Properties', 'redux-framework-demo' ),
                    'google'   => true,
                    'default'  => array(
                        'color'       => '#333',
                        'font-size'   => '15px',
                        'line-height'   => '28px',
                        'font-family' => 'Droid Serif',
                        'font-weight' => 'Normal',
                    ),
                    ),
                    array(
                        'id'          => 'second-font',
                        'type'        => 'typography',
                        'title'       => __( 'Second Font (Heading Font)', 'redux-framework-demo' ),
                        'font-backup' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'line-height'   => false,
                        'color'   => false,
                        'letter-spacing'=> false,  // Defaults to false
                        'all_styles'  => true,
                        'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
                        'default'     => array(
                            'color'       => '#333',
                            'font-family' => 'Lato',
                            'google'      => true,
                        ),
                    ),
                    array(
                        'id'          => 'third-font',
                        'type'        => 'typography',
                        'title'       => __( 'Third Font', 'redux-framework-demo' ),
                        'font-backup' => false,
                        'font-size' => false,
                        'text-align' => false,
                        'line-height'   => false,
                        'text-transform' => true,
                        'color'   => false,
                        'letter-spacing'=> false,  // Defaults to false
                        'all_styles'  => true,
                        'output'      => array( '.third-font' ),
                        'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
                        'default'     => array(
                            'font-weight'  => '400',
                            'font-style'  => 'italic',
                            'font-family' => 'Libre Baskerville',
                            'google'      => true,
                            'letter-spacing' => '0.9'
                        ),
                    ),
                    array(
                        'id'          => 'title-font',
                        'type'        => 'typography',
                        'title'       => __( 'Post Title', 'redux-framework-demo' ),
                        'font-backup' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'line-height'   => false,
                        'color'   => false,
                        'letter-spacing'=> false,  // Defaults to false
                        'all_styles'  => true,
                        'subtitle'    => __( 'Post Title Font', 'redux-framework-demo' ),
                        'default'     => array(
                            'color'       => '#333',
                            'font-family' => 'Lato',
                            'google'      => true,
                            'text-transform'      => "uppercase",
                        ),
                    ),
                    array(
                        'id'          => 'main-menu-font',
                        'type'        => 'typography',
                        'title'       => __( 'Main Menu Typography', 'redux-framework-demo' ),
                        'font-backup' => false,
                        'text-align' => false,
                        'line-height'   => false,
                        'letter-spacing'=> true,  // Defaults to false
                        'all_styles'  => true,
                        'output'      => array( 'nav#main-menu ul li a' ),
                        'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
                        'default'     => array(
                            'color'       => '#333',
                            'font-style'  => '700',
                            'font-family' => 'Lato',
                            'google'      => true,
                            'font-size'   => '11px',
                            'letter-spacing' => '0.9'
                        ),
                    ),
                )
            ));






        Redux::setSection( $opt_name, array(
            'title'  => __( 'Event', 'redux-framework-demo' ),
            'id'     => 'event',
            'icon'   => 'el el-calendar',
            'fields' => array(
                array(
                    'id'       => 'event-visibility',
                    'type'     => 'switch',
                    'title'    => __( 'Event', 'redux-framework-demo' ),
                    'subtitle' => __( 'Event Visibility in Header (Default : Show)', 'redux-framework-demo' ),
                    'default'  => true,
                ),
                 array(
                    'id'          => 'event-text',
                    'type'        => 'text',
                    'title'       => __( 'Event Text', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Text', 'redux-framework-demo' ),
                    'default'     => "Next Event",
                ),
                 array(
                    'id'          => 'event-title',
                    'type'        => 'text',
                    'title'       => __( 'Event Title', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Title', 'redux-framework-demo' ),
                    'default'     => "Liliam Fashion Week in London",
                ),
                 array(
                    'id'          => 'event-date',
                    'type'        => 'text',
                    'title'       => __( 'Event Date', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Date', 'redux-framework-demo' ),
                    'default'     => "20 March 2015",
                ),
                 array(
                    'id'          => 'event-period',
                    'type'        => 'text',
                    'title'       => __( 'Event Period', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Period', 'redux-framework-demo' ),
                    'default'     => "09.00 - 16.00 (Monday Free)",
                ),
                 array(
                    'id'          => 'event-address',
                    'type'        => 'text',
                    'title'       => __( 'Event Address', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Address', 'redux-framework-demo' ),
                    'default'     => "21 King Street, Melbourne  Victoria 3000 Australia",
                ),
                 array(
                    'id'          => 'event-location',
                    'type'        => 'text',
                    'title'       => __( 'Event Location Link', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Location Link', 'redux-framework-demo' ),
                    'default'     => "https://www.google.com/maps/d/viewer?msa=0&mid=z_gdBE8F4CM4.kd855LF8lFPo",
                ),
                 array(
                    'id'          => 'event-desc',
                    'type'        => 'textarea',
                    'title'       => __( 'Event Description', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Event Description', 'redux-framework-demo' ),
                    'default'     => "Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Duis mollis, est non co.",
                ),
                 array(
                    'id'          => 'event-link',
                    'type'        => 'text',
                    'title'       => __( 'Event Read Link', 'redux-framework-demo' ),
                    'desc'        => __( 'Please Write Read Link', 'redux-framework-demo' ),
                    'default'     => "http://2035themes.com/avantgarde",
                ),
                 array(
                'id'       => 'event-background',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Event Background', 'redux-framework-demo' ),
                'compiler' => 'true',
                'subtitle' => __( 'Upload Event Background Image', 'redux-framework-demo' ),
                
            ),
                )
            ));


        Redux::setSection( $opt_name, array(
            'title'  => __( 'Custom Css', 'redux-framework-demo' ),
            'id'     => 'custom-css',
            'icon'   => 'el-icon-css',
                'fields' => array(
                    array(
                        'id' => 'custom-css-area',
                        'type' => 'textarea',
                        'title' => __('Custom CSS', 'redux-framework-demo'),
                        'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
                        'desc' => __('', 'redux-framework-demo'),
                        'validate' => 'css',
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
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
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

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
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






    $tracking = get_option( 'redux-framework-tracking' );
if ( $tracking && ( ! is_array( $tracking ) || empty( $tracking['allow-tracking'] ) ) ) {
    $tracking                   = array();
    $tracking['dev_mode']       = false;
    $tracking['allow_tracking'] = 'no';
    $tracking['tour']           = 0;
    update_option( 'redux-framework-tracking', $tracking );
}
