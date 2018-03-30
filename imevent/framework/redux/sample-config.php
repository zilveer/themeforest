<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_option";


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
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

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

    // -> START Basic Fields

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-cog',
        'title'     => __('General Settings', TEXT_DOMAIN),                
        'fields'    => array(                    
            array(
                'id'        => 'logo_option',
                'type'      => 'select',
                'title'     => __('Logo Option', TEXT_DOMAIN),
                'subtitle'  => __('Display logo text or image', TEXT_DOMAIN),
                'options'   => array('text'=>'Text','image'=>'Image'),
                'default'   => 'text'
            ),
            array(
                'id'        => 'logo_text',
                'type'      => 'text',
                'url'       => true,
                'title'     => __('Logo Text', TEXT_DOMAIN),
                'subtitle'  => __('Insert logo text', TEXT_DOMAIN),
                'default'   => __('im Event', TEXT_DOMAIN)
            ),
            array(
                'id'        => 'logo_icon_text',
                'type'      => 'text',
                'url'       => true,
                'title'     => __('Icon beside logo text', TEXT_DOMAIN),
                'subtitle'  => __('Insert FontAwesome', TEXT_DOMAIN),
                'default'   => __('fa-map-marker', TEXT_DOMAIN)
            ),
            array(
                'id'        => 'logo_image',
                'type'      => 'media',
                'url'       => true,
                'title'     => __('Logo Image', TEXT_DOMAIN),
                'subtitle'  => __('Upload a logo image. The best logo 185x61px', TEXT_DOMAIN),
                'default'   => array('url' => get_template_directory_uri().'/assets/img/logo-imevent.png')
            ),                    
            array(
                'id'        => 'favicon',
                'type'      => 'media',
                'url'       => true,
                'title'     => __('Custom Favicon', TEXT_DOMAIN),
                'subtitle'  => __('Upload your Favicon. The best size is 32x32 px', TEXT_DOMAIN),
                'default'   => array('url' => get_template_directory_uri().'/assets/ico/favicon.ico')
            ),
            array(
                'id'        => 'app_icon',
                'type'      => 'media',
                'url'       => true,
                'title'     => __('Apple touch icon', TEXT_DOMAIN),
                'subtitle'  => __('Upload your Apple touch icon. The best size is 144x144 px', TEXT_DOMAIN),
                'default'   => array('url' => get_template_directory_uri().'/assets/ico/apple-touch-icon-144-precomposed.png')
            ),                    

            array(
                'id'        => 'google_analytics',
                'type'      => 'textarea',                        
                'title'     => __('Google Analytics Javascript', TEXT_DOMAIN),
                'subtitle'  => __('Insert javascript of Google Analytics. You dont insert &lt;script&gt;&lt;/script&gt;', TEXT_DOMAIN)                        
            ),

            array(
                'id'        => 'seo_des',
                'type'      => 'textarea',                        
                'title'     => __('SEO Description', TEXT_DOMAIN),
                'subtitle'  => __('Paste your SEO Description. This will be added into the meta tag description in header', TEXT_DOMAIN),
                'default'   => __('This is seo description', TEXT_DOMAIN)
            ),
            array(
                'id'        => 'seo_keywords',
                'type'      => 'textarea',                        
                'title'     => __('SEO Keywords', TEXT_DOMAIN),
                'subtitle'  => __('Paste your SEO Keywords. This will be added into the meta tag keywords in header', TEXT_DOMAIN),
                'default'   => __('Seo Keywords', TEXT_DOMAIN)
            ),                   


        ),
    ));

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-cogs',
        'title'     => __('Style Settings', TEXT_DOMAIN),                
        'fields'    => array(
            array(
                'id'        => 'display_reload',
                'type'      => 'select',                        
                'title'     => __('Reload Spin', TEXT_DOMAIN),
                'subtitle'  => __('Choose default or image or no reload', TEXT_DOMAIN),
                'options'   => array('1'=>'Default','2'=>'Image','0'=>'No Reload'),
                'default'   => '1'
            ),
            array(
                'id'        => 'reload_image',
                'type'      => 'media',
                'url'       => true,                        
                'title'     => __('Reload Image', TEXT_DOMAIN),
                'subtitle'  => __('', TEXT_DOMAIN),
                'desc'      => __('You can insert an image.', TEXT_DOMAIN),
                'default'   => array('url' => get_template_directory_uri().'/assets/img/preloader.gif')
            ),
            array(
                'id'       => 'page_version',
                'type'     => 'select',
                'title'    => __('Select light or dark version', TEXT_DOMAIN),
                'subtitle' => __('', TEXT_DOMAIN),
                'desc'     => __('', TEXT_DOMAIN),
                'options'  => array("body-light" => "Light","body-dark" => "Dark"),
                'default'  => 'body-light'
            ),                    
            array(
                'id'       => 'page_layout',
                'type'     => 'select',
                'title'    => __('Select layout for page', TEXT_DOMAIN),
                'subtitle' => __('', TEXT_DOMAIN),
                'desc'     => __('', TEXT_DOMAIN),
                'options'  => array("wide" => "Wide","boxed" => "Boxed"),
                'default'  => 'wide'
            ),
            array(
                'id'       => 'page_boxed_pattern',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Select pattern for boxed layout', TEXT_DOMAIN),
                'subtitle' => __('', TEXT_DOMAIN),
                'desc'     => __('You should upload an image', TEXT_DOMAIN),                        
                'default'  => array('url' => get_template_directory_uri().'/assets/img/bg_pattern.png'),

            ),                    
            array(
                'id' => 'body-font',
                'type' => 'typography',
                'output' => array('body'),
                'title' => __('Body Font', TEXT_DOMAIN),
                'subtitle' => __('Select a primary font for site', TEXT_DOMAIN),                        
                'google' => true,                        
                'text-align'    => false,
                'subsets'       => false,
                'line-height' => false,                        
                'font-style'    => true,
                'default' => array(
                    'color' => '#6d7a83',
                    'font-size' => '18px',                            
                    'font-family' => "Raleway",
                    "font-weight"   =>"normal"                            
                ),
            ),
             array(
                'id' => 'heading-font',
                'type' => 'typography',
                'output' => array('.countdown-period, .schedule-wrapper .nav > li > a, .timeline .post-meta, #main-slider .caption-title'),
                'title' => __('Font for some section', TEXT_DOMAIN),                        
                'desc'  => __('Select a google font heading: Countdown caption-title, Schedule Wrapper ',TEXT_DOMAIN),
                'google' => true,                        
                'color' => false,
                'font-size' => false,                        
                'line-height' => false,
                'font-weight'   => false,
                'text-align'    => false,
                'subsets'       => false,                        
                'font-style'    => false,
                'default' => array(                            
                    'font-family' => "Roboto",

                ),
            ),
            array(
                'id' => 'slide-font',
                'type' => 'typography',
                'output' => array('#main-slider .caption-subtitle,#main-slider .countdown-amount'),
                'title' => __('Slideshow font', TEXT_DOMAIN),
                'subtitle' => __('Select a primary font for subtitle, countdown of slideshow', TEXT_DOMAIN),                        
                'google' => true,                        
                'text-align'    => false,
                'subsets'       => false,
                'line-height' => false,                        
                'font-style'    => true,                        
                'default' => array(
                    'font-family' => "Raleway",
                    "font-weight"   => "900"
                ),
            ),
            array(
                'id'        => 'theme_color',
                'type'      => 'color',                        
                'title'     => __('Select theme color', TEXT_DOMAIN),
                'subtitle'  => __('', TEXT_DOMAIN),
                'desc'      => __('', TEXT_DOMAIN),
                'default'   => '#dc143c',
            ),
            array(
                'id'        => 'menu_font_color',
                'type'      => 'color',                        
                'title'     => __('Select menu font color', TEXT_DOMAIN),
                'default'   => '#ffffff',
            ),
            array(
                'id'        => 'menu_font_color_hover',
                'type'      => 'color',                        
                'title'     => __('Select menu font color when hover', TEXT_DOMAIN),
                'default'   => '#ffffff',
            ),
            array(
                'id'        => 'background_menu_hover',
                'type'      => 'color_rgba',                        
                'title'     => __('Background menu then page scroll', TEXT_DOMAIN),
                'default'   => '#cccccc'
            ),
            array(
                'id'        => 'menu_font_color_scroll',
                'type'      => 'color',                        
                'title'     => __('Select menu font color then page scroll', TEXT_DOMAIN),
                'default'   => '#ffffff',
            ),
            array(
                'id'        => 'menu_font_color_hover_scroll',
                'type'      => 'color',                        
                'title'     => __('Select menu font color hover then page scroll', TEXT_DOMAIN),
                'default'   => '#ffffff',
            ),
            array(
                'id'        => 'background_submenu',
                'type'      => 'color',                        
                'title'     => __('Background Submenu', TEXT_DOMAIN),
                'default'   => '#ccc',
            ),
            array(
                'id'        => 'background_multi_page',
                'type'      => 'color',                        
                'title'     => __('Background menu muti page', TEXT_DOMAIN),
                'default'   => '#ccc',
            ),
            array(
                'id'        => 'custom_css',
                'type'      => 'textarea',
                'title'     => __('Insert Your custom css', TEXT_DOMAIN)
            ),

        ),
    ));

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-book',
        'title'     => __('Footer Settings', TEXT_DOMAIN),                
        'fields'    => array( 
            array(
                    'id'       => 'footer_style',
                    'type'     => 'radio',
                    'title'    => __('Footer Style', TEXT_DOMAIN),
                    'options'  => array(
                            '0' => 'Hexagon style',
                            '1' => 'Cricle style',
                            '2' => 'Square style',
                        ),
                    'default' => '0'
            ),
            array(
                'id'        => 'footer',
                'type'      => 'textarea',
                'url'       => true,
                'required' => array( 'footer_style', '=', '0' ),
                'title'     => __('Insert Footer', TEXT_DOMAIN),
                'subtitle'  => __('', TEXT_DOMAIN),
                'desc'      => __('', TEXT_DOMAIN),
                'default'   => __('<div class="clearfix">
                            <ul class="social-line list-inline">
                            <li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="200"><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="400"><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="500"><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="600"><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="700"><a href="#" class="skype"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            </div>                
                            <span class="copyright" data-animation="fadeInUp" data-animation-delay="100">@ 2014 im Event - An One Page Event Manager Theme made with passion by jThemes Studio</span>
                    '),
            ),
            array(
                'id'        => 'footer_cricle',
                'type'      => 'textarea',
                'url'       => true,
                'required' => array( 'footer_style', '=', '1' ),
                'title'     => __('Insert footer for cricle style', TEXT_DOMAIN),
                'default'   => __(' <div class="clearfix">
                            <ul class="social-line social-circle list-inline">
                            <li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="200"><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="400"><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="500"><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="600"><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="700"><a href="#" class="skype"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            </div>                
                            <span class="copyright" data-animation="fadeInUp" data-animation-delay="100">@ 2014 im Event - An One Page Event Manager Theme made with passion by jThemes Studio</span>
                    '),
            ),
            array(
                'id'        => 'footer_square',
                'type'      => 'textarea',
                'url'       => true,
                'required' => array( 'footer_style', '=', '2' ),
                'title'     => __('Insert footer for square style', TEXT_DOMAIN),
                'default'   => __(' <div class="clearfix">
                            <ul class="social-line social-wohex list-inline">
                            <li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="200"><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="400"><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="500"><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="600"><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li data-animation="flipInY" data-animation-delay="700"><a href="#" class="skype"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            </div>                
                            <span class="copyright" data-animation="fadeInUp" data-animation-delay="100">@ 2014 im Event - An One Page Event Manager Theme made with passion by jThemes Studio</span>
                    '),
            ),
            array(
                'id'       => 'go_top',
                'type'     => 'select',
                'title'    => __('Display back to top icon', TEXT_DOMAIN),
                'subtitle' => __('', TEXT_DOMAIN),
                'desc'     => __('', TEXT_DOMAIN),
                'options'  => array("1" => "Yes","0" => "No"),
                'default'  => '1'
            ),   
        ),
    )); 

    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-photo',
        'title'     => __('Slideshow Settings', TEXT_DOMAIN),                
        'fields'    => array(

            array(
                'id'        => 'slideshow_order_by',
                'type'      => 'select',
                'title'     => __('Slideshow Order By', TEXT_DOMAIN),
                'subtitle'  => __('Display Slideshow Post Order By', TEXT_DOMAIN),
                'options'   => array(
                    'id'=>'ID',
                    'author'=>'Author',
                    'title'=>'title',
                    'name'=>'Slug',
                    'date'=>'Order by date',
                    'modified'=>'Order by last modified date',
                    'parent'=>'Order by post/page parent id.',
                    'rand'=>'Random order',
                    'comment_count'=>'Order by number of comments',
                ),
                'default'   => 'id'
            ),                    
            array(
                'id'        => 'slideshow_order',
                'type'      => 'select',
                'title'     => __('Slideshow Order', TEXT_DOMAIN),
                'subtitle'  => __('Display Slideshow Post Order', TEXT_DOMAIN),
                'options'   => array(
                    'ASC'=>'ASC',
                    'DESC'=>'DESC'                            
                ),
                'default'   => 'ASC'
            ),                    
            array(
                'id'        => 'slideshow_item_count',
                'type'      => 'text',                        
                'title'     => __('Slide Count', TEXT_DOMAIN),
                'subtitle'  => __('', TEXT_DOMAIN),                        
                'default'   => '10'
            )

        ),
    ));
    
    Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-time',
        'title'     => __('Countdown Settings', TEXT_DOMAIN),
        'fields'    => array(
            array(
                'id'        => 'slideshow_timezone',
                'type'      => 'text',
                'title'     => __('Insert Timezone Countdown', TEXT_DOMAIN),
                'desc'  => __('The timezone (hours or minutes from GMT) for the target times. <br/> For instance:<br/> If Timezone is UTC-9:00 you have to insert -9 <br/>If Timezone is UTC-9:30, you have to insert -9*60+30=-570. <br/>Read about UTC Time:  <a href="http://en.wikipedia.org/wiki/List_of_UTC_time_offsets" target="_blank"> http://en.wikipedia.org/wiki/List_of_UTC_time_offsets</a>', TEXT_DOMAIN),                        
                'default'   => '0'
            ),
            array(
                'id'        => 'display_format',
                'type'      => 'text',
                'title'     => __('Display Time Format for countdown', TEXT_DOMAIN),
                'desc'  => __('Display Format: dHMS. <br/> d: Day <br/> H: Hour <br/> M: Month <br/> S: Second. <br/>You can insert HMS or dHM or dH. default dHMS', TEXT_DOMAIN),                        
                'default'   => 'dHMS'
            ),                       
            array(
                'id'        => 'years',
                'type'      => 'text',
                'title'     => __('Define label for years', TEXT_DOMAIN),
                'default'   => __('years',TEXT_DOMAIN)
            ),
            array(
                'id'        => 'months',
                'type'      => 'text',
                'title'     => __('Define label for months', TEXT_DOMAIN),
                'default'   => __('months',TEXT_DOMAIN)
            ),
            array(
                'id'        => 'weeks',
                'type'      => 'text',
                'title'     => __('Define label for weeks', TEXT_DOMAIN),
                'default'   => __('weeks',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'days',
                'type'      => 'text',
                'title'     => __('Define label for days', TEXT_DOMAIN),
                'default'   => __('days',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'hours',
                'type'      => 'text',
                'title'     => __('Define label for hours', TEXT_DOMAIN),
                'default'   => __('hours',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'minutes',
                'type'      => 'text',
                'title'     => __('Define label for minutes', TEXT_DOMAIN),
                'default'   => __('minutes',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'seconds',
                'type'      => 'text',
                'title'     => __('Define label for seconds', TEXT_DOMAIN),
                'default'   => __('seconds',TEXT_DOMAIN)
            ), 

            array(
                'id'        => 'year',
                'type'      => 'text',
                'title'     => __('Define label for year', TEXT_DOMAIN),
                'default'   => __('year',TEXT_DOMAIN)
            ),
            array(
                'id'        => 'month',
                'type'      => 'text',
                'title'     => __('Define label for month', TEXT_DOMAIN),
                'default'   => __('month',TEXT_DOMAIN)
            ),
            array(
                'id'        => 'week',
                'type'      => 'text',
                'title'     => __('Define label for week', TEXT_DOMAIN),
                'default'   => __('week',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'day',
                'type'      => 'text',
                'title'     => __('Define label for day', TEXT_DOMAIN),
                'default'   => __('day',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'hour',
                'type'      => 'text',
                'title'     => __('Define label for hour', TEXT_DOMAIN),
                'default'   => __('hour',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'minute',
                'type'      => 'text',
                'title'     => __('Define label for minute', TEXT_DOMAIN),
                'default'   => __('minute',TEXT_DOMAIN)
            ), 
            array(
                'id'        => 'second',
                'type'      => 'text',
                'title'     => __('Define label for second', TEXT_DOMAIN),
                'default'   => __('second',TEXT_DOMAIN)
            )
        ),
    ));

    Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-credit-card',
                'title'     => __('Register Form Settings', TEXT_DOMAIN),
                'fields'    => array(
                    array(
                            'id'       => 'paypal_active',
                            'type'     => 'radio',
                            'title'    => __('Register Option', TEXT_DOMAIN),                            
                            'options'  => array(
                                    '0' => 'Register Free no paypal',
                                    '1' => 'Register with Paypal'
                                ),
                            'default' => '1'
                    ),
                    array(
                        'id'        => 'json_register_fields',
                        'type'      => 'textarea',
                        'title'     => __('Define Fields for Register Form', TEXT_DOMAIN),
                        'subtitle'  => __('This is json to define field. You can read more in documentation: add extra field', TEXT_DOMAIN),                        
'default'   => '{
    "name":{
        "type":"textfield",
        "label":"Name and Surname",
        "value":"",
        "require":"true",
        "class":"col-sm-6 col-md-3"
    },  
    "email":{
        "type": "email",
        "label":"Your Email Here",
        "value":"",
        "require":"true",
        "class":"col-sm-6 col-md-3"
    },  
    "number":{
        "type":"number",
        "label":"Your Phone Number",
        "value":"",
        "require":"true",
        "class":"col-sm-6 col-md-3"
    },  
    "price":{
        "type":"dropdown",
        "label":"Select Your Price", 
        "value":{
            "$100": "100",
            "$200": "200",
            "$300": "300"
        },
        "require":"true",
        "class":"col-sm-6 col-md-3"
    }
}'
                    ),
                    array(
                        'id'        => 'register_price_paypal',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Price Field for paypal', TEXT_DOMAIN),
                        'subtitle'  => __('This field uses to pay in paypal. This is requirement. For example: price', TEXT_DOMAIN),                        
                        'default'   => 'price'
                    ),
                    array(
                        'id'        => 'register_emailclient',
                        'type'      => 'text',
                        'title'     => __('Email. It is require', TEXT_DOMAIN),
                        'subtitle'  => __('This field uses to send orders infomation to client when registration success', TEXT_DOMAIN),                        
                        'default'   => 'email'
                    ),
                    array(
                        'id'        => 'register_environment',
                        'type'      => 'select',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Environment', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('0'=>'Sandbox Test','1'=>'Paypal'),
                        'default'   => '0'
                    ),
                    array(
                        'id'        => 'register_currency_code_paypal',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Currency code', TEXT_DOMAIN),
                        'subtitle'  => __('Use currency code to pay. For instance: USD', TEXT_DOMAIN),                        
                        'default'   => 'USD'
                    ),
                    array(
                        'id'        => 'register_email_paypal',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Business Email Paypal', TEXT_DOMAIN),
                        'subtitle'  => __('This is email that you register with paypal', TEXT_DOMAIN),
                        'default'   => 'contact@ovatheme.com'
                    ),
                    array(
                        'id'        => 'register_title_paypal',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Event Title store in Paypal', TEXT_DOMAIN),
                        'subtitle'  => __('You can read in document', TEXT_DOMAIN),
                        'default'   => 'Register Event'
                    ),                   
                     array(
                        'id'        => 'register_thanks_page',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Thanks Page', TEXT_DOMAIN),
                        'subtitle'  => __('Paypal will redirect about this page after successful transactions.', TEXT_DOMAIN),                        
                        'default'   => home_url()
                    ),
                    array(
                        'id'        => 'register_cancel_page',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Cancel Page', TEXT_DOMAIN),
                        'subtitle'  => __('Paypal will redirect about this page if client cancel transaction', TEXT_DOMAIN),                        
                        'default'   => home_url()
                    ),
                     array(
                        'id'        => 'register_success_msg',
                        'type'      => 'textarea',
                        'required' => array( 'paypal_active', '=', '0' ),
                        'title'     => __('Success Message', TEXT_DOMAIN),
                        'subtitle'  => __('This message will display when register success', TEXT_DOMAIN),                        
                        'default'   => '<strong>Registration Form Submitted!</strong> We will be in touch soon.'
                    ),
                     array(
                        'id'        => 'register_email_free',
                        'type'      => 'text',
                        'required' => array( 'paypal_active', '=', '0' ),
                        'title'     => __('Email to received notice when client register', TEXT_DOMAIN),                        
                        'subtitle'  => __('You can empty if dont want receive',TEXT_DOMAIN),
                        'default'   => 'example@gmail.com'
                    ),
                    array(
                        'id'        => 'register_per_page',
                        'type'      => 'text',
                        'title'     => __('Limit Pagination', TEXT_DOMAIN),
                        'subtitle'  => __('Insert number to display limit payment on each page of payment list', TEXT_DOMAIN),                        
                        'default'   => '20'
                    ),
                    array(
                        'id'        => 'register_patter_template_free_name',
                        'type'      => 'text',
                        'title'     => __('Name of email  when register successfull', TEXT_DOMAIN),
                        'default'   => __('Register event successfull', TEXT_DOMAIN)
                    ),
                    array(
                        'id'        => 'register_patter_template_free_subject',
                        'type'      => 'text',
                        'title'     => __('Subject of email  when register successfull', TEXT_DOMAIN),
                        'subtitle'  => __('Display in title of email', TEXT_DOMAIN),                        
                        'default'   => __('Register New Event', TEXT_DOMAIN)
                    ),
                    array(
                        'id'        => 'register_patter_template_free',
                        'type'      => 'textarea',
                        'required' => array( 'paypal_active', '=', '0' ),
                        'title'     => __('Patter Template Free Email when register successfull', TEXT_DOMAIN),
                        'subtitle'  => __('You can insert html here. Note cant change [orderid] or [userinfo] ', TEXT_DOMAIN),                        
                        'default'   => '<html><body>
<h3>New Free Register<h3>
<h4>This is information</h4>
<strong>Order ID</strong>[orderid]<br/>
<strong>Buyer Information</strong><br/>[userinfo]
</body></html>'
                    ),
                     array(
                        'id'        => 'register_patter_template_paypal',
                        'type'      => 'textarea',
                        'required' => array( 'paypal_active', '=', '1' ),
                        'title'     => __('Patter Template Paypal Email  when register successfull', TEXT_DOMAIN),
                        'subtitle'  => __('You can insert html here. Note cant change [orderid] or [userinfo] ', TEXT_DOMAIN),                        
                        'default'   => '<html><body>
<h3>Thanks for your order<h3>
<h4>This is your order information:</h4>
<strong>Order ID: </strong>[orderid]<br/>
<strong>Transaction ID: </strong>[transaction_id]<br/>
<strong>Price: </strong>[price] [currency]<br/>
<strong>Status: </strong>[status]<br/>
<strong>Date: </strong>[date]<br/>
<strong>Buyer Information: </strong><br/>[userinfo]
</body></html>'
                    ),
                    array(
                        'id'        => 'animate_form',
                        'type'      => 'select',                        
                        'title'     => __('Show animation for input of form', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),

                ),    
            ));

            Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-calendar',
                'title'     => __('Schedule Settings', TEXT_DOMAIN),                
                'fields'    => array(
                    array(
                        'id'        => 'schedule_order_by',
                        'type'      => 'select',
                        'title'     => __('Schedule Order By', TEXT_DOMAIN),
                        'subtitle'  => __('Display Schedule Post Order By', TEXT_DOMAIN),
                        'options'   => array(
                            'id'=>'ID',
                            'author'=>'Author',
                            'title'=>'title',
                            'name'=>'Slug',
                            'date'=>'Order by date',
                            'modified'=>'Order by last modified date',
                            'parent'=>'Order by post/page parent id.',
                            'rand'=>'Random order',
                            'comment_count'=>'Order by number of comments',
                        ),
                        'default'   => 'id'
                    ),
                    array(
                        'id'        => 'schedule_order',
                        'type'      => 'select',
                        'title'     => __('Schedule Order', TEXT_DOMAIN),
                        'subtitle'  => __('Display Schedule Post Order', TEXT_DOMAIN),
                        'options'   => array(
                            'ASC'=>'ASC',
                            'DESC'=>'DESC'                            
                        ),
                        'default'   => 'ASC'
                    ),
                    array(
                        'id'        => 'schedule_count',
                        'type'      => 'text',                        
                        'title'     => __('Item count display in each tab', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => '100'
                    ),                      
                    array(
                        'id'        => 'schedule_display_time',
                        'type'      => 'select',                        
                        'title'     => __('Display Time', TEXT_DOMAIN),
                        'subtitle'  => __('Display Time', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ), 
                    array(
                        'id'        => 'schedule_display_thumbnail',
                        'type'      => 'select',                        
                        'title'     => __('Display Speaker', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),   
                    array(
                        'id'        => 'schedule_display_thumbnail_border_gray',
                        'type'      => 'select',                        
                        'title'     => __('Display border gray with speaker', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),                   
                    array(
                        'id'        => 'schedule_display_button_cricle',
                        'type'      => 'select',                        
                        'title'     => __('Display Cricle Button', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'schedule_display_author',
                        'type'      => 'select',                        
                        'title'     => __('Display Author', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'schedule_display_author_job',
                        'type'      => 'select',                        
                        'title'     => __('Display Author Job', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                     array(
                        'id'        => 'schedule_display_desc',
                        'type'      => 'select',                        
                        'title'     => __('Display Intro Description', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                     array(
                        'id'        => 'schedule_display_link_title',
                        'type'      => 'select',                        
                        'title'     => __('Display Link title', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'schedule_count_word',
                        'type'      => 'text',                        
                        'title'     => __('Word Count dipplay in intro description', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => '30'
                    ),
                    array(
                        'id'        => 'schedule_icon_time',
                        'type'      => 'text', 
                        'title'     => __('fontawesome for Icon time', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => 'fa-clock-o'
                    ),
                    array(
                        'id'        => 'schedule_icon_microphone',
                        'type'      => 'text', 
                        'title'     => __('fontawesome for Icon speaker', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => 'fa-microphone'
                    )
                                         
                ),
            ));

            Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-volume-up',
                'title'     => __('Speakers Settings', TEXT_DOMAIN),                
                'fields'    => array(
                    array(
                        'id'        => 'speaker_order_by',
                        'type'      => 'select',
                        'title'     => __('Speaker Order By', TEXT_DOMAIN),
                        'subtitle'  => __('Display Speaker Post Order By', TEXT_DOMAIN),
                        'options'   => array(
                            'id'=>'ID',
                            'author'=>'Author',
                            'title'=>'title',
                            'name'=>'Slug',
                            'date'=>'Order by date',
                            'modified'=>'Order by last modified date',
                            'parent'=>'Order by post/page parent id.',
                            'rand'=>'Random order',
                            'comment_count'=>'Order by number of comments',
                        ),
                        'default'   => 'id'
                    ),
                    array(
                        'id'        => 'speaker_order',
                        'type'      => 'select',
                        'title'     => __('Speaker Order', TEXT_DOMAIN),
                        'subtitle'  => __('Display Speaker Post Order', TEXT_DOMAIN),
                        'options'   => array(
                            'ASC'=>'ASC',
                            'DESC'=>'DESC'                            
                        ),
                        'default'   => 'DESC'
                    ),
                    array(
                        'id'        => 'speakers_speaker_link',
                        'type'      => 'select',                        
                        'title'     => __('Display Link to detail Speaker', TEXT_DOMAIN),
                        'subtitle'  => __('Remove link in Title and Thumbnail', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'speakers_remove_zoom_thumbnail',
                        'type'      => 'select',                        
                        'title'     => __('Remove zoom in thumbnail when hover', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'speakers_remove_background_thumbnail',
                        'type'      => 'select',                        
                        'title'     => __('Remove background-color thumbnail when hover', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'speakers_display_job',
                        'type'      => 'select',                        
                        'title'     => __('Display job', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'speakers_display_intro_description',
                        'type'      => 'select',                        
                        'title'     => __('Display intro description', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),
                        'options'   => array('1'=>'Yes','0'=>'No'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'speakers_desc_count',
                        'type'      => 'text',                        
                        'title'     => __('Word count display in description', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => '12'
                    ),
                    array(
                        'id'        => 'speakers_item_count',
                        'type'      => 'text',                        
                        'title'     => __('Item Count display', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => '100'
                    ),
                    array(
                        'id'        => 'speakers_layout',
                        'type'      => 'select',
                        'title'     => __('Select layout. Item Count in row', TEXT_DOMAIN),
                        'subtitle'  => __('This value will override in config of Speaker Element Visual Composer', TEXT_DOMAIN),
                        'options'   => array(
                            'col-md-12 col-sm-12'=>'1 item in row',
                            'col-md-6 col-sm-6'=>'2 items in row',
                            'col-md-4 col-sm-4'=>'3 items in row',
                            'col-md-3 col-sm-6'=>'4 items in row',
                            'col-md-2 col-sm-6 col-5'=>'5 items in row',
                            'col-md-2 col-sm-6'=>'6 items in row',
                        ),
                        'default'   => 'col-md-3 col-sm-6'
                    ),
                ),
            ));  

            Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-question',
                'title'     => __('Faq Settings', TEXT_DOMAIN),                
                'fields'    => array(
                    array(
                        'id'        => 'faq_order_by',
                        'type'      => 'select',
                        'title'     => __('Faq Order By', TEXT_DOMAIN),
                        'subtitle'  => __('Display Faq Post Order By', TEXT_DOMAIN),
                        'options'   => array(
                            'id'=>'ID',
                            'author'=>'Author',
                            'title'=>'title',
                            'name'=>'Slug',
                            'date'=>'Order by date',
                            'modified'=>'Order by last modified date',
                            'parent'=>'Order by post/page parent id.',
                            'rand'=>'Random order',
                            'comment_count'=>'Order by number of comments',
                        ),
                        'default'   => 'id'
                    ),
                    array(
                        'id'        => 'faq_order',
                        'type'      => 'select',
                        'title'     => __('Faq Order', TEXT_DOMAIN),
                        'subtitle'  => __('Display Faq Post Order', TEXT_DOMAIN),
                        'options'   => array(
                            'ASC'=>'ASC',
                            'DESC'=>'DESC'                            
                        ),
                        'default'   => 'DESC'
                    ),
                    array(
                        'id'        => 'faq_item_count',
                        'type'      => 'text',                        
                        'title'     => __('Display Item Count', TEXT_DOMAIN),
                        'subtitle'  => __('', TEXT_DOMAIN),                        
                        'default'   => '20'
                    ),
                ),
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
