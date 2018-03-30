<?php
/**
 * COnfiguration of the theme 
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */                         
 
define( 'YIW_MAIN_WIDTH', 960 );
define( 'YIW_CONTENT_WIDTH', 700 );
define( 'YIW_SIDEBAR_WIDTH', 220 );
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = YIW_CONTENT_WIDTH;        

define( 'YIW_THEME_NAME', 'Maya' ); // The theme name
define( 'YIW_THEME_FOLDER_NAME', 'Maya' ); // The theme folder name
define( 'NOTIFIER_XML_FILE', 'http://update.yithemes.com/maya.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'YIT_MARKETPLACE', 'tf' ); // ( tf | yit | free )
// minimum version compatible with the theme
define( 'YIW_MINIMUM_WP_VERSION', '3.0' );

// default layout page
define( 'YIW_DEFAULT_LAYOUT_PAGE', 'sidebar-right' );   
define( 'YIW_DEFAULT_LAYOUT_PAGE_SHOP', 'sidebar-right' ); 

$yiw_skins = array(
    'Default' => 'Default',
    'BlackWhite' => 'BlackWhite',
    'Corporate' => 'Corporate',
    'Dark' => 'Dark',
    'Minimal' => 'Minimal',
    'Sketch' => 'Sketch',
    'Vintage' => 'Vintage'
);    


/**
 * The items of Theme Options. The ID of each item, must be the same with the name of own file options (except -options.php), 
 * into the "inc/options" folder.
 */ 
$yiw_theme_options_items = array( 
    'general' => __( 'General', 'yiw' ), 
    'colors' => __( 'Colors', 'yiw' ),           
    'typography' => __( 'Typography', 'yiw' ),
    'features-tab' => __( 'Features tab', 'yiw' ),  
    'sliders' => __( 'Sliders', 'yiw' ),
    'flashsettings' => __( 'Flash Slider' ), 
    'sidebars' => __( 'Sidebars', 'yiw' ), 
    'contact' => __( 'Contact Forms', 'yiw' )
);        

$yiw_sliders = array(
    'none'        => __( 'None', 'yiw' ),
    'fixed-image' => __( 'Fixed Image', 'yiw' ),    
    'layers'      => __( 'Layers Slider' , 'yiw' ), 
    'unoslider'   => __( 'UnoSlider' , 'yiw' ),
    'elegant'     => __( 'Elegant Slider', 'yiw' ),
    'cycle'       => __( 'Cycle Slider' , 'yiw' ),
    'elastic'     => __( 'Elastic Slider' , 'yiw' ),
    'nivo'        => __( 'Nivo Slider', 'yiw' ),
    'thumbnails'  => __( 'With Thumbnails', 'yiw' ),
    'flash'       => __( 'Slider Flash', 'yiw' ),
    'minilayers'  => __( 'Mini Layers', 'yiw' )
);

add_filter('yit_plugins', 'yit_add_plugins');
function yit_add_plugins( $plugins ) {
    $new = array(

        array(
            'name' 		=> 'WooCommerce',
            'slug' 		=> 'woocommerce',
            'required' 	=> false,
            'version'=> '2.0.0',
        ),

        array(
            'name'         => 'YITH Essential Kit for WooCommerce #1',
            'slug'         => 'yith-essential-kit-for-woocommerce-1',
            'required'     => false,
            'version'      => '1.0.9',
        ),

        array(
            'name' 		=> 'YITH Maintenance Mode',
            'slug' 		=> 'yith-maintenance-mode',
            'required' 	=> false,
            'version'=> '1.0.0',
        ),
        array(
            'name' 		=> 'YITH Custom Login',
            'slug' 		=> 'yith-custom-login',
            'required' 	=> false,
            'version'=> '0.9.0',
        ),

        file_exists( get_template_directory() . "/inc/LayerSlider" )? false : array(
            'name'               => 'LayerSlider',
            'slug'               => 'LayerSlider',
            'source'             => YIW_THEME_PLUGINS_DIR.'/LayerSlider.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'version'            => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),

        defined( 'YITH_YWSL_PREMIUM' ) ? array() : array(
            'name'         => 'YITH WooCommerce Social Login',
            'slug'         => 'yith-woocommerce-social-login',
            'required'     => false,
            'version'      => '1.0.0',
        ),
    );

    if ( is_admin() ) {

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        // remove wishlist activation if it's already activated
        if ( is_plugin_active( 'yith_magnifier/init.php' ) ) {
            unset( $new[1] );
        }

    }

    return array_merge( $plugins, $new );
}

/**
 * Add recommended jetpack modules
 */
function yit_recommended_jetpack_modules( $modules ){

    $modules= array();

    $modules[]= 'yith-live-chat';
    $modules[]= 'yith-woocommerce-compare';
    $modules[]= 'yith-woocommerce-wishlist';
    $modules[]= 'yith-woocommerce-ajax-search';
    $modules[]= 'yith-woocommerce-zoom-magnifier';
    $modules[]= 'yith-woocommerce-ajax-navigation';
    $modules[]= 'yith-woocommerce-advanced-reviews';
    $modules[]= 'yith-woocommerce-quick-view';
    $modules[]= 'yith-woocommerce-order-tracking';
    $modules[]= 'yith-woocommerce-colors-labels-variations';

    return $modules;
}
add_filter( 'yith_jetpack_recommended_list', 'yit_recommended_jetpack_modules' );

$yiw_portfolio_type = array(
    '3cols'      => __('3 Columns', 'yiw'), 
    'slider'     => __('With Slider', 'yiw'),
    'big_image'  => __('Big Image', 'yiw'), 
    'full_desc'  => __('Full Description', 'yiw'), 
    'filterable' => __('Filterable', 'yiw'), 
);

$yiw_unoslider_animations = array(
    'chess' => 'chess',
    'flash' => 'flash',
    'spiral_reversed' => 'spiral_reversed',
    'spiral' => 'spiral',
    'sq_appear' => 'sq_appear',
    'sq_flyoff' => 'sq_flyoff',
    'sq_drop' => 'sq_drop',
    'sq_squeeze' => 'sq_squeeze',
    'sq_random' => 'sq_random',
    'sq_diagonal_rev' => 'sq_diagonal_rev',
    'sq_diagonal' => 'sq_diagonal',
    'sq_fade_random' => 'sq_fade_random',
    'sq_fade_diagonal_rev' => 'sq_fade_diagonal_rev',
    'sq_fade_diagonal' => 'sq_fade_diagonal',
    'explode' => 'explode',
    'implode' => 'implode',
    'fountain' => 'fountain',
    'blind_bottom' => 'blind_bottom',
    'blind_top' => 'blind_top',
    'blind_right' => 'blind_right',
    'blind_left' => 'blind_left',
    'shot_right' => 'shot_right',
    'shot_left' => 'shot_left',
    'alternate_vertical' => 'alternate_vertical',
    'alternate_horizontal' => 'alternate_horizontal',
    'zipper_right' => 'zipper_right',
    'zipper_left' => 'zipper_left',
    'bar_slide_random' => 'bar_slide_random',
    'bar_slide_bottomright' => 'bar_slide_bottomright',
    'bar_slide_bottomright' => 'bar_slide_bottomright',
    'bar_slide_topright' => 'bar_slide_topright',
    'bar_slide_topleft' => 'bar_slide_topleft',
    'bar_fade_bottom' => 'bar_fade_bottom',
    'bar_fade_top' => 'bar_fade_top',
    'bar_fade_right' => 'bar_fade_right',
    'bar_fade_left' => 'bar_fade_left',
    'bar_fade_random' => 'bar_fade_random',
    'v_slide_top' => 'v_slide_top',
    'h_slide_right' => 'h_slide_right',
    'v_slide_bottom' => 'v_slide_bottom',
    'h_slide_left' => 'h_slide_left',
    'stretch' => 'stretch',
    'squeez' => 'squeez',
    'fade' => 'fade'
);

// default contact form
$yiw_default_contact_form = array(
    array (
        'title' => 'Name',
        'data_name' => 'name',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Enter the name',
        'required' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Email',
        'data_name' => 'email',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Enter a valid email',
        'required' => 'yes',
        'email_validate' => 'yes',
        'reply_to' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Phone',
        'data_name' => 'phone',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => '', 
        'class' => '',
    ),

    array (
        'title' => 'Web site',
        'data_name' => 'website',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => '',
        'class' => '',
    ),

    array (
        'title' => 'Message',
        'data_name' => 'message',
        'description' => '',
        'type' => 'textarea',
        'label_checkbox' => '',
        'msg_error' => 'Enter a message',
        'required' => 'yes',
        'class' => '',
    )
);

define( 'YIW_DEFAULT_CONTACT_FORM', serialize( $yiw_default_contact_form ) );


// define the links to rss url for dashboard
define( 'YIW_RSS_FORUM_URL', 'http://yithemes.com/feed/?post_type=product' );
define( 'YIW_RSS_URL', 'http://yithemes.com/feed/' );
?>