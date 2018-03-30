<?php
if ( ! function_exists( 'ishyoboy_framework_init' ) ) {
    function ishyoboy_framework_init() {

    global $pagenow;

    if ( is_admin() && isset($_GET['activated'] ) && "themes.php" == $pagenow ){
        flush_rewrite_rules();
        header( 'Location: ' . home_url() . '/wp-admin/themes.php?page=optionsframework' );
    }

}
}
add_action( 'init', 'ishyoboy_framework_init', 2 );


/***********************************************************************************************************************
 * Add the theme options page to the menu
 */
/*
function ishyoboy_framework_menu() {

    $icon_url = IYB_FRAMEWORK_URI . '/images/icon.png';
    $my_theme = wp_get_theme();

    add_object_page(
        $my_theme->Name . ' ' . __('Options', 'ishyoboy'),	// The value used to populate the browser's title bar when the menu page is active
        $my_theme->Name . ' ' . __('Options', 'ishyoboy'),	// The text of the menu in the administrator's sidebar
        'administrator',					            // What roles are able to access the menu
        'ishyoboy_framework',			            	// The ID used to bind submenu items to this menu
        'ishyoboy_framework_display',				    // The callback function used to render this menu
        $icon_url                                       // The Icon displayed in the menu
    );

    add_submenu_page(
        'ishyoboy_framework',				            // The ID of the top-level menu page to which this submenu item belongs
        __('Display Options', 'ishyoboy'),				// The value used to populate the browser's title bar when the menu page is active
        __('Display Options', 'ishyoboy'),				// The label of this submenu item displayed in the menu
        'administrator',					            // What roles are able to access this submenu item
        'ishyoboy_framework',           // The ID used to represent this submenu item
        'ishyoboy_framework_display'			    	// The callback function used to render the options for this submenu item
    );

    add_submenu_page(
        'ishyoboy_framework',
        __('Social Options', 'ishyoboy'),
        __('Social Options', 'ishyoboy'),
        'administrator',
        'ishyoboy_framework_social_options',
        create_function( null, 'ishyoboy_framework_display( "social_options" );' )
    );

} // end ishyoboy_framework_menu
add_action( 'admin_menu', 'ishyoboy_framework_menu' );
/**/

/**
 * Renders a simple page to display for the theme menu defined above.
 */
/*
function ishyoboy_framework_display( $active_tab = '' ) {
    $my_theme = wp_get_theme();
    ?>
<div class="wrap">

<div id="icon-themes" class="icon32"></div>
<h2><?php echo  $my_theme->Name . ' ' . __('Theme Options', 'ishyoboy')?></h2>
<?php settings_errors(); ?>

<?php if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} else if ( $active_tab == 'social_options' ) {
    $active_tab = 'social_options';
} else if ( $active_tab == 'theme_updates' ) {
    $active_tab = 'theme_updates';
} else {
    $active_tab = 'display_options';
}// end if/else ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=ishyoboy_framework&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Display Options', 'ishyoboy'); ?></a>
        <a href="?page=ishyoboy_framework&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Social Options', 'ishyoboy'); ?></a>
        <a href="?page=ishyoboy_framework&tab=theme_updates" class="nav-tab <?php echo $active_tab == 'theme_updates' ? 'nav-tab-active' : ''; ?>"><?php _e('Theme Updates', 'ishyoboy'); ?></a>
        </h2>


    <form method="post" action="options.php" enctype="multipart/form-data">
        <div class="ishyoboy_framework_settings">
            <?php

            if( $active_tab == 'display_options' ) {
                settings_fields( 'ishyoboy_framework_display_options' );
                do_settings_sections( 'ishyoboy_framework_display_options' );

                submit_button();
            } elseif( $active_tab == 'social_options' ) {

                settings_fields( 'ishyoboy_framework_social_options' );
                do_settings_sections( 'ishyoboy_framework_social_options' );

                submit_button();
            } elseif( $active_tab == 'theme_updates' ) {

                echo '<h3>' . __( 'Theme Updates', 'ishyoboy' ) . '</h3>';

                $xml = ishyoboy_get_updates();

                if ( isset($xml->latest) && version_compare( $my_theme->Version, $xml->latest ) == -1 ){
                    echo '<p>' . __('There is a new update available!', 'ishyoboy') . '<br />' . __('Please go to your Themeforest account and download the latest theme version.', 'ishyoboy') . '</p>';
                    echo '<a href="http://themeforest.net/user/IshYoBoy/portfolio?ref=IshYoBoy" class="button button-primary" target="_blank">' . __('Download from Themeforest', 'ishyoboy') . '</a><br /><br /><br />';
                }
                else{
                    echo '<p><strong>' . __('You have the latest theme version! Well done!', 'ishyoboy') . '</strong></p><br /><br />';
                }

                if ( isset($xml->changelog) && '' != $xml->changelog){
                    echo '<h3>' . __( 'Changelog:', 'ishyoboy' ) . '</h3>';
                    echo $xml->changelog;
                }

            }

            ?>
        </div>
    </form>

</div><!-- /.wrap -->
<?php
} // end ishyoboy_framework_display
/**/

/**
 * Setting Registration
 *
 * Initializes the theme's display options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
/*
function ishyoboy_initialize_framework_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'ishyoboy_framework_display_options' ) ) {
        add_option( 'ishyoboy_framework_display_options' );
    } // end if

    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'general_settings_section',			    // ID used to identify this section and with which to register options
        __('Display Options', 'ishyoboy'),		// Title to be displayed on the administration page
        'ishyoboy_general_options_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );

    // Next, we'll introduce the fields for toggling the visibility of content elements.
    add_settings_field(
        'logo_text',						        // ID used to identify the field throughout the theme
        __('Site logo', 'ishyoboy'),			    // The label to the left of the option interface element
        'ishyoboy_toggle_logo_text_callback',	    // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'general_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __('Use the Site Title and Tagline (if not empty) instead of an image logo.', 'ishyoboy')
        )
    );



    add_settings_field(
        'logo_image',						        // ID used to identify the field throughout the theme
        __('Logo image', 'ishyoboy'),			    // The label to the left of the option interface element
        'ishyoboy_toggle_logo_image_callback',	    // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'general_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __('Select an image for the Site Logo.', 'ishyoboy')
        )
    );

    add_settings_field(
        'boxed_layout',                              // ID used to identify the field throughout the theme
        __('Boxed/Unboxed Layout', 'ishyoboy'),			    // The label to the left of the option interface element
        'ishyoboy_boxed_layout_callback',	    // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'general_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __('Default layout of the theme. Either boxed with a background image or unboxed (full-width).', 'ishyoboy')
        )
    );

    /*
    add_settings_field(
        'top_tagline',                              // ID used to identify the field throughout the theme
        __('Top Tagline', 'ishyoboy'),			    // The label to the left of the option interface element
        'ishyoboy_toggle_top_tagline_callback',	    // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'general_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __('Text to be displayed in the top Tagline of every page. Use &lt;span&gt; tags to highlight words.', 'ishyoboy')
        )
    );

    add_settings_field(
        'bottom_tagline',                           // ID used to identify the field throughout the theme
        __('Bottom Tagline', 'ishyoboy'),			// The label to the left of the option interface element
        'ishyoboy_toggle_bottom_tagline_callback',	// The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'general_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __('Text to be displayed in the bottom Tagline of every page. Use &lt;span&gt; tags to highlight words.', 'ishyoboy')
        )
    );

    add_settings_field(
        'page_for_portfolio_posts',                 // ID used to identify the field throughout the theme
        __('Portfolio page', 'ishyoboy'),	        // The label to the left of the option interface element
        'ishyoboy_page_for_portfolio_posts_callback',                  // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'portfolio_settings_section',			        // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'id' => 'page_for_portfolio_posts',
            'name' => __( 'Name', 'ishyoboy' ),
            'description' => __( 'Description', 'ishyoboy' )
        )
    );

    add_settings_field(
        'portfolio_posts_per_page',                 // ID used to identify the field throughout the theme
        __('Portfolio items per page', 'ishyoboy'),	// The label to the left of the option interface element
        'ishyoboy_portfolio_posts_per_page_callback',// The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'portfolio_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __( 'Maximum number of portfolio items displayed on the portfolio main page.', 'ishyoboy' )
        )
    );

    add_settings_field(
        'portfolio_posts_per_page',                 // ID used to identify the field throughout the theme
        __('Portfolio items per page', 'ishyoboy'),	// The label to the left of the option interface element
        'ishyoboy_portfolio_posts_per_page_callback',// The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'portfolio_settings_section',			        // The name of the section to which this field belongs
        array(								        // The array of arguments to pass to the callback. In this case, just a description.
            __( 'Maximum number of portfolio items displayed on the portfolio main page.', 'ishyoboy' )
        )
    );

    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'portfolio_settings_section',           // ID used to identify this section and with which to register options
        __('Portfolio Options', 'ishyoboy'),    // Title to be displayed on the administration page
        'ishyoboy_portfolio_options_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );


    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'styling_settings_section',			    // ID used to identify this section and with which to register options
        __('Styling Options', 'ishyoboy'),		// Title to be displayed on the administration page
        'ishyoboy_general_options_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );

    add_settings_field(
        'use_custom_colors',                     // ID used to identify the field throughout the theme
        __('Color scheme', 'ishyoboy'),	    // The label to the left of the option interface element
        'ishyoboy_use_custom_colors_callback',   // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'use_custom_colors',
            'name' => 'Use custom colors',
            'description' => __( 'Use custom colors. (Uncheck to choose one of the pre-defined color themes).', 'ishyoboy' )
        )
    );

    add_settings_field(
        'selected_theme',                         // ID used to identify the field throughout the theme
        __('Theme', 'ishyoboy'),	                // The label to the left of the option interface element
        'ishyoboy_selected_theme_callback',        // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'selected_theme',
            'name' => 'Theme'
        )
    );

    add_settings_field(
        'color1',                                   // ID used to identify the field throughout the theme
        __('Color 1', 'ishyoboy'),	                // The label to the left of the option interface element
        'ishyoboy_portfolio_color_callback',        // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'color1',
            'name' => 'Color 1'
        )
    );

    add_settings_field(
        'color2',                                   // ID used to identify the field throughout the theme
        __('Color 2', 'ishyoboy'),	                // The label to the left of the option interface element
        'ishyoboy_portfolio_color_callback',        // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'color2',
            'name' => 'Color 2'
        )
    );

    add_settings_field(
        'color3',                                   // ID used to identify the field throughout the theme
        __('Color 3', 'ishyoboy'),	                // The label to the left of the option interface element
        'ishyoboy_portfolio_color_callback',        // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'color3',
            'name' => 'Color 3'
        )
    );

    add_settings_field(
        'color3',                                   // ID used to identify the field throughout the theme
        __('Color 3', 'ishyoboy'),	                // The label to the left of the option interface element
        'ishyoboy_portfolio_color_callback',        // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array (
            'id' => 'color3',
            'name' => 'Color 3'
        )
    );

    add_settings_field(
        'custom_css',                               // ID used to identify the field throughout the theme
        __('Custom CSS styles', 'ishyoboy'),	    // The label to the left of the option interface element
        'ishyoboy_custom_css_callback',             // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'description' => __( 'Here you can add any custom styles to your site.', 'ishyoboy' )
        )
    );

    add_settings_field(
        'font1',                                    // ID used to identify the field throughout the theme
        __('Headlines Font', 'ishyoboy'),	            // The label to the left of the option interface element
        'ishyoboy_fonts_callback',             // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'styling_settings_section',			        // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'id' => 'font1',
            'name' => 'Headlines Font',
            'description' => __( 'FONT1', 'ishyoboy' )
        )
    );

    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'tracking_settings_section',			// ID used to identify this section and with which to register options
        __('Tracking Options', 'ishyoboy'),		// Title to be displayed on the administration page
        'ishyoboy_general_options_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );

    // Finally, we register the fields with WordPress
    register_setting(
        'ishyoboy_framework_display_options',
        'ishyoboy_framework_display_options',
        'ishyoboy_framework_validate_display_options'
    );

    add_settings_field(
        'tracking_script_embed',                            // ID used to identify the field throughout the theme
        __('Tracking script', 'ishyoboy'),	        // The label to the left of the option interface element
        'ishyoboy_tracking_script_embed_callback',          // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'tracking_settings_section',			    // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'description' => __( 'Here you can add any custom tracking script. It will be embedded right before the closing body tag. ', 'ishyoboy' )
        )
    );

    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'rss_settings_section',			        // ID used to identify this section and with which to register options
        __('RSS Settings', 'ishyoboy'),		    // Title to be displayed on the administration page
        'ishyoboy_general_options_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );

    add_settings_field(
        'rss_links',                            // ID used to identify the field throughout the theme
        __('RSS Links', 'ishyoboy'),	        // The label to the left of the option interface element
        'ishyoboy_rss_links_callback',          // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'rss_settings_section',			    // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'description' => __( 'A list of all RSS urls.', 'ishyoboy' )
        )
    );

    // First, we register a section. This is necessary since all future options must belong to a
    add_settings_section(
        'rate_theme_section',			        // ID used to identify this section and with which to register options
        __('Say Thanks!', 'ishyoboy'),		    // Title to be displayed on the administration page
        'ishyoboy_rate_theme_section_callback',	// Callback used to render the description of the section
        'ishyoboy_framework_display_options'	// Page on which to add this section of options
    );


    add_settings_field(
        'rate_theme',                            // ID used to identify the field throughout the theme
        '', //__('', 'ishyoboy'),	        // The label to the left of the option interface element
        'ishyoboy_rate_theme_callback',          // The name of the function responsible for rendering the option interface
        'ishyoboy_framework_display_options',       // The page on which this option will be displayed
        'rate_theme_section',			    // The name of the section to which this field belongs
        Array(								        // The array of arguments to pass to the callback. In this case, just a description.
            'description' => __( '★★★★★', 'ishyoboy' )
        )
    );

    // Replace image uploader button text
    global $pagenow;
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        // Now we'll replace the 'Insert into Post Button' inside Thickbox
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
    }

} // end ishyoboy_initialize_framework_options
add_action( 'admin_init', 'ishyoboy_initialize_framework_options' );
/**/

if ( ! function_exists( 'ishyoboy_options_enqueue_scripts' ) ) {
    function ishyoboy_options_enqueue_scripts() {

    wp_register_style( 'ishyoboy_iconic_font', IYB_FRAMEWORK_URI .'/libs/css/fontello.css' );
    wp_register_style( 'ishyoboy_framework_styles', IYB_FRAMEWORK_URI .'/libs/css/framework-styles.css' );

    wp_register_script( 'ishyoboy-upload', IYB_FRAMEWORK_URI .'/libs/js/upload.js', array('jquery','media-upload','thickbox') );
    //wp_register_script( 'ishyoboy_colorpicker', IYB_FRAMEWORK_URI .'/libs/js/colorpicker.js' );
    //wp_register_style( 'ishyoboy_colorpicker_styles', IYB_FRAMEWORK_URI .'/libs/css/colorpicker.css' );

    wp_enqueue_script('jquery');


    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
    wp_enqueue_script('media-upload');

    wp_enqueue_style('ishyoboy_iconic_font');
    wp_enqueue_style('ishyoboy_framework_styles');
    wp_enqueue_script('ishyoboy-upload');

    if ( isset($_GET['page']) && isset($_GET['view']) && 'revslider' == $_GET['page'] && 'slide' == $_GET['view']) {
        include( IYB_FRAMEWORK_DIR . '/libs/css/revolution-styles.php' );
    }

}
}
add_action('admin_enqueue_scripts', 'ishyoboy_options_enqueue_scripts');

/*
function replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {
        $referer = strpos( wp_get_referer(), 'ishyoboy_framework' );
        if ( $referer != '' ) {
            return __('Use image!', 'ishyoboy' );
        }
    }
    return $translated_text;
}
/**/


/**
 * Initializes the theme's social options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
/*
function ishyoboy_rss_links_callback($args){

    //echo '<span class="description">&nbsp;'  . $args['description'] . '</span>';

    echo '<h3>Blog feeds:</h3>';

    $url = home_url() . '/feed/rss/';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rss2/';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rdf/';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/atom/';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';


    echo '<h3>Microblog feeds:</h3>';

    $url = home_url() . '/feed/rss/' . '?post_type=microblog-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rss2/' . '?post_type=microblog-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rdf/' . '?post_type=microblog-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/atom/' . '?post_type=microblog-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';

    echo '<h3>Portfolio feeds:</h3>';

    $url = home_url() . '/feed/rss/' . '?post_type=portfolio-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rss2/' . '?post_type=portfolio-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/rdf/' . '?post_type=portfolio-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';
    $url = home_url() . '/feed/atom/' . '?post_type=portfolio-post';
    echo '<a href="' . esc_attr($url) . '" target="_blank">' . $url . '</a><br />';

}



function ishyoboy_rate_theme_callback($args){

    $my_theme = wp_get_theme();



    echo '<h3>Say Thanks (<span style="color: #fcbf23;">★★★★★</span>):</h3>';



}
/**/
/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function provides a simple description for the General Options page.
 *
 * It's called from the 'ishyoboy_initialize_framework_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
if ( ! function_exists( 'ishyoboy_general_options_callback' ) ) {
    function ishyoboy_general_options_callback() {
        echo '<p>' . __('General setting for the theme.', 'ishyoboy') . '</p><hr />';
    } // end ishyoboy_general_options_callback
}

if ( ! function_exists( 'ishyoboy_portfolio_options_callback' ) ) {
    function ishyoboy_portfolio_options_callback() {
        echo '<p>' . __('Portfolio section settings for the theme.', 'ishyoboy') . '</p><hr />';
    }
}

if ( ! function_exists( 'ishyoboy_rate_theme_section_callback' ) ) {
    function ishyoboy_rate_theme_section_callback() {
        //echo '<p>' . __('General setting for the theme.', 'ishyoboy') . '</p><hr />';
        echo '<hr />';
    }
}

/**
 * This function provides a simple description for the Social Options page.
 *
 * It's called from the 'ishyoboy_framework_intialize_social_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
if ( ! function_exists( 'ishyoboy_social_options_callback' ) ) {
    function ishyoboy_social_options_callback() {
        echo '<p>' . __("These settings are mainly used in the social widget.<br />
        The social widget uses the URL as a link and the Username as link title.<br />
        Other widgets such as Twitter, Dribble and Flickr make use of the username field when being added for the first time.", 'ishyoboy') . '</p>';
    } // end ishyoboy_general_options_callback
}
/**
 * Detects active SEO plugins
 *
 * @return bool
 */
if ( ! function_exists( 'ishyoboy_seo_plugin_active' ) ) {
    function ishyoboy_seo_plugin_active()
    {
        include_once( ABSPATH .'wp-admin/includes/plugin.php' );
        if( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) return true;
        if( is_plugin_active( 'headspace2/headspace.php' ) ) return true;
        if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) return true;
        return false;
    }
}

if( is_admin() )
{
    add_action('admin_print_scripts', 'ishyoboy_set_javascritp_paths');
}

/**
 * Hooks
 */
if ( ! function_exists( 'ishyoboy_meta_head' ) ) {
    function ishyoboy_meta_head() { do_action('ishyoboy_meta_head'); }
}

?>
