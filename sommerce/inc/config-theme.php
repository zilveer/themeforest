<?php
/**
 * COnfiguration of the theme 
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */ 
 
define( 'YIW_MAIN_WIDTH', 960 );
define( 'YIW_CONTENT_WIDTH', 640 );
define( 'YIW_SIDEBAR_WIDTH', 280 );
define( 'YIW_SIDEBAR_SHOP_WIDTH', 170 );
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = YIW_CONTENT_WIDTH;   
	
define( 'YIW_THEME_NAME', 'Sommerce' ); // The theme name
define( 'YIW_THEME_FOLDER_NAME', 'sommerce' ); // The theme folder name
define( 'NOTIFIER_XML_FILE', 'http://update.yithemes.com/sommerce.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'YIT_MARKETPLACE', 'tf' ); // ( tf | yit | free )
// minimum version compatible with the theme
define( 'YIW_MINIMUM_WP_VERSION', '3.0' );

// default layout page
define( 'YIW_DEFAULT_LAYOUT_PAGE', 'sidebar-right' );  
define( 'YIW_DEFAULT_LAYOUT_PAGE_SHOP', 'sidebar-right' );    


/**
 * The items of Theme Options. The ID of each item, must be the same with the name of own file options (except -options.php), 
 * into the "inc/options" folder.
 */ 
$yiw_theme_options_items = array( 
	'general' => __( 'General', 'yiw' ), 
	'colors' => __( 'Colors', 'yiw' ),           
	'typography' => __( 'Typography', 'yiw' ),   
	'sliders' => __( 'Sliders', 'yiw' ),  
	'flashsettings' => __( 'Flash Slider', 'yiw' ), 
	'sidebars' => __( 'Sidebars', 'yiw' ), 
	'contact' => __( 'Contact Forms', 'yiw' )
);  

// default contact form
$yiw_default_contact_form = array(
	array (
        'title' => 'Name',
        'data_name' => 'name',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Insert the name',
        'required' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Email',
        'data_name' => 'email',
        'description' => '',
        'type' => 'text',
        'label_checkbox' => '',
        'msg_error' => 'Insert a valid email',
        'required' => 'yes',
        'email_validate' => 'yes',
        'reply_to' => 'yes',
        'class' => '',
    ),

    array (
        'title' => 'Message',
        'data_name' => 'message',
        'description' => '',
        'type' => 'textarea',
        'label_checkbox' => '',
        'msg_error' => 'Insert a message',
        'required' => 'yes',
        'class' => '',
    )
);

define( 'YIW_DEFAULT_CONTACT_FORM', serialize( $yiw_default_contact_form ) );


// define the links to rss url for dashboard
define( 'YIW_RSS_FORUM_URL', 'http://yithemes.com/feed/?post_type=product' );
define( 'YIW_RSS_URL', 'http://yithemes.com/feed/' );

/**
 * Recommended plugins
 */
add_filter('yit_plugins', 'yit_add_plugins');
function yit_add_plugins( $plugins ) {
    $new = array(

        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
            'version'=> '2.0.0',
        ),

        array(
            'name'         => 'YITH Essential Kit for WooCommerce #1',
            'slug'         => 'yith-essential-kit-for-woocommerce-1',
            'required'     => false,
            'version'      => '1.0.9',
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


add_filter( 'redirect_canonical' , 'yit_redirect_canonical' , 10 ,2) ;
if( ! function_exists('yit_redirect_canonical') ) {
    function yit_redirect_canonical( $redirect_url, $requested_url ) {
        if( is_front_page() && ( is_page_template( 'blog.php' ) || is_page_template( 'home.php' ) ) ) {
            return false;
        } else {
            return $redirect_url;
        }
    }
}