<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


/*-----------------------------------------------------------------------------------*/
/* Remove banner wooframework */
/*-----------------------------------------------------------------------------------*/

remove_action('wooframework_container_inside', 'wooframework_add_woodojo_banner');
remove_action( 'wooframework_container_inside', 'wooframework_add_wooseosbm_banner' );


/*-----------------------------------------------------------------------------------*/
// Remove the banner warning about static home page
/*-----------------------------------------------------------------------------------*/
if ( is_admin() && current_user_can( 'manage_options' ) && ( 0 < intval( get_option( 'page_on_front' ) ) ) ) {
	remove_action( 'wooframework_container_inside', 'wooframework_add_static_front_page_banner' );
}

/*-----------------------------------------------------------------------------------*/
// After theme setup
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'woothemes_setup' );

if ( ! function_exists( 'woothemes_setup' ) ) {
	function woothemes_setup () {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// get the image
		add_theme_support( 'get-the-image' );
	
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
	} // End woothemes_setup()
}

/*-----------------------------------------------------------------------------------*/
/* Get Post image attachments */
/*-----------------------------------------------------------------------------------*/
/* 
Description:

This function will get all the attached post images that have been uploaded via the 
WP post image upload and return them in an array. 

*/
function woo_get_post_images($offset = 1) {
	
	// Arguments
	$repeat = 100; 				// Number of maximum attachments to get 
	$photo_size = 'large';		// The WP "size" to use for the large image

	global $post;

	$output = array();

	$id = get_the_id();
	$attachments = get_children( array(
	'post_parent' => $id,
	'numberposts' => $repeat,
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'ASC', 
	'orderby' => 'menu_order date' )
	);
	if ( !empty($attachments) ) :
		$output = array();
		$count = 0;
		foreach ( $attachments as $att_id => $attachment ) {
			$count++;  
			if ($count <= $offset) continue;
			$url = wp_get_attachment_image_src($att_id, $photo_size, true);	
				$output[] = array( 'url' => $url[0], 'caption' => $attachment->post_excerpt, 'id' => $att_id, 'alt' => get_post_meta( $att_id, '_wp_attachment_image_alt', true ) );
		}  
	endif; 
	return $output;
} // End woo_get_post_images()

/*-------------------------------------------------------------------------------------------*/
/* WooCommerce Check */
/*-------------------------------------------------------------------------------------------*/

if (!function_exists('is_woocommerce_activated')) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}


/*-----------------------------------------------------------------------------------*/
/* Is IE */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'is_ie' ) ) {
	function is_ie ( $version = '6.0' ) {
		$supported_versions = array( '6.0', '7.0', '8.0', '9.0' );
		$agent = substr( $_SERVER['HTTP_USER_AGENT'], 25, 4 );
		$current_version = substr( $_SERVER['HTTP_USER_AGENT'], 30, 3 );
		$response = false;
		if ( in_array( $version, $supported_versions ) && 'MSIE' == $agent && ( $version == $current_version ) ) {
			$response = true;
		}
	
		return $response;
	} // End is_ie()
}

/*-----------------------------------------------------------------------------------*/
/* Load responsive IE scripts */
/*-----------------------------------------------------------------------------------*/

add_action( 'wp_head', 'woo_load_responsive_IE_footer', 10 );

if ( ! function_exists( 'woo_load_responsive_IE_footer' ) ) {
	function woo_load_responsive_IE_footer () {
		$html = '';
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/includes/assets/js/respond-IE.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";

		echo $html;
	} // End ()
}


/*-----------------------------------------------------------------------------------*/
/*	thumbnail size
/*-----------------------------------------------------------------------------------*/	
	if( function_exists( 'add_theme_support' ) ) {
			set_post_thumbnail_size( 50, 50, true );  
			add_image_size( 'thumbnail-blog', 940,400, true);  
			add_image_size( 'recipe-listing', 300, 300, true);  
			add_image_size( 'list-thumb', 300,300, true);  
			add_image_size( 'full-size', '', '', false);
			add_image_size( 'sidebar-tabs', 63, 53, true);
			add_image_size( 'recipe-4column-thumb', 222, 144, true);
			add_image_size( 'single-carousel-thumb', 132, 104, true);
			add_image_size( 'recent-thumb', 60, 60, true);
			add_image_size( 'recent-sidebar-thumb', 85, 100, true);
			add_image_size( 'blog-grid-thumb-sc', 295, 172, true);
        	add_image_size( 'dahz-small-thumb', 80, 80, true);

	}

/*-----------------------------------------------------------------------------------*/
/* Add Google Analytics to Header. */
/*-----------------------------------------------------------------------------------*/

remove_action('wp_footer','woo_analytics' );
add_action( 'wp_footer','dahz_analytics' );
function dahz_analytics(){
	$output = get_option( 'woo_google_analytics' );
	if ( $output != '' )
		echo stripslashes( $output ) . "\n";
} // End woo_google_analytics()

/*-----------------------------------------------------------------------------------*/
/*	Word Trim
/*-----------------------------------------------------------------------------------*/	
	function woo_fnc_word_trim($string, $count, $ellipsis = FALSE){
		  $words = explode(' ', $string);
		  if (count($words) > $count){
			    array_splice($words, $count);
			    $string = implode(' ', $words);
			    
				if (is_string($ellipsis)){
						$string .= $ellipsis;
			    }
			    elseif ($ellipsis){
						$string .= '&hellip;';
			    }
		  }
		  return $string;
	}

/*-----------------------------------------------------------------------------------*/
/* Woo Get Users of the Site */
/*-----------------------------------------------------------------------------------*/

function woo_get_users($users_per_page = 10, $paged = 1, $role = '', $orderby = 'login', $order = 'ASC', $usersearch = '' ) {

	global $blog_id;
		
	$args = array(
			'number' => $users_per_page,
			'offset' => ( $paged-1 ) * $users_per_page,
			'role' => $role,
			'search' => $usersearch,
			'fields' => 'all_with_meta',
			'blog_id' => $blog_id,
			'orderby' => $orderby,
			'order' => $order
		);


	// Query the user IDs for this page
	$wp_user_search = new WP_User_Query( $args );

	$user_results = $wp_user_search->get_results();
	// $wp_user_search->get_total()
	
	return $user_results;
	
} // End Function

/*-----------------------------------------------------------------------------------*/
/* Activate shortcode compatibility in our new custom areas. */
/*-----------------------------------------------------------------------------------*/  
/**
 * Activate shortcode compatibility in our new custom areas.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 	$sections = array( 'woo_filter_post_meta', 'woo_post_inside_after_default', 'woo_post_more', 'woo_footer_left', 'woo_footer_right' );
 
 	foreach ( $sections as $s ) { add_filter( $s, 'do_shortcode', 20 ); }

add_action( 'wp_head', 'df_alt_custom_favicon', 10 );

if ( !function_exists( 'df_alt_custom_favicon' ) ) :
	function df_alt_custom_favicon(){
		$df_options 	= get_theme_mod( 'df_options' );
		$favicon_normal = isset( $df_options['custom_favicon'] ) ? $df_options['custom_favicon'] : NULL;
		$favicon_iphone = isset( $df_options['custom_favicon_iphone'] ) ? $df_options['custom_favicon_iphone'] : NULL;
		$iphone_retina  = isset( $df_options['custom_favicon_iphone_retina'] ) ? $df_options['custom_favicon_iphone_retina'] : NULL;
		$favicon_ipad 	= isset( $df_options['custom_favicon_ipad'] ) ? $df_options['custom_favicon_ipad'] : NULL;
		$ipad_retina 	= isset( $df_options['custom_favicon_ipad_retina'] ) ? $df_options['custom_favicon_ipad_retina'] : NULL;

		if( $favicon_normal != '' ) :
			echo '<!-- Custom Favicon --><link rel="shortcut icon" href="' .  esc_url( $favicon_normal )  . '"/>';
		endif;

		if( $favicon_iphone != '' || $iphone_retina != '' || $favicon_ipad != '' || $ipad_retina != '' ) :
			echo '<!-- Custom Retina Favicon -->';
		endif;

		if( $favicon_iphone != '' ) :
			echo '<link rel="apple-touch-icon" href="' . esc_url( $favicon_iphone ) . '">'; 
		endif;

		if( $iphone_retina != '' ) :
			echo '<link rel="apple-touch-icon" sizes="114x114" href="' .  esc_url( $iphone_retina ) . '">'; 
		endif;

		if( $favicon_ipad != '' ) :
			echo '<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url( $favicon_ipad ) . '">';
		endif; 

		if( $ipad_retina != '' ) : 
			echo'<link rel="apple-touch-icon" sizes="144x144" href="' . esc_url( $ipad_retina ) . '">'; 
		endif;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/* Load responsive <meta> tags in the <head> */
/*-----------------------------------------------------------------------------------*/

add_action( 'wp_head', 'woo_load_responsive_meta_tags', 10 );

if ( ! function_exists( 'woo_load_responsive_meta_tags' ) ) {
	function woo_load_responsive_meta_tags () {
		$html = '';
		
		$html .= "\n" . '<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->' . "\n";
		$html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge" />' . "\n";
		
		/* Remove this if not responsive design */
		$html .= "\n" . '<!--  Mobile viewport scale -->' . "\n";
		$html .= '<meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>' . "\n";

		echo $html;
	} // End woo_load_responsive_meta_tags()
}
/*-----------------------------------------------------------------------------------*/
/* Homepage hook */
/*-----------------------------------------------------------------------------------*/

function freschi_homepage_content() {
 	do_action('freschi_homepage_content');
}

function freschi_theme_boxed() {
    do_action('freschi_theme_boxed');
}

function freschi_twitter_content() {
    do_action('freschi_twitter_content');
}

/*-----------------------------------------------------------------------------------*/
// Plugins activation
/*-----------------------------------------------------------------------------------*/

add_action('tgmpa_register', 'fnc_register_required_plugins');
function fnc_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/admin/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),	
			array(
			'name'     				=> 'Sidebar Generator', // The plugin name
			'slug'     				=> 'sidebar-generator', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/admin/plugins/sidebar-generator.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),	
			array(
			'name'     				=> 'Categories Images', // The plugin name 
			'slug'     				=> 'categories-images', // The plugin slug (typically the folder name)
			'required' 				=> false // If false, the plugin is only 'recommended' instead of required
		),
			array(
			'name'     				=> 'Print Friendly and PDF Button', // The plugin name 
			'slug'     				=> 'printfriendly', // The plugin slug (typically the folder name)
			'required' 				=> false // If false, the plugin is only 'recommended' instead of required
		),
		   array(
			'name'     				=> 'WooCommerce', // The plugin name 
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> false // If false, the plugin is only 'recommended' instead of required
		),
			array(
			'name'     				=> 'Yith WooCommerce Wishlist', // The plugin name
			'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'required' 				=> false // If false, the plugin is only 'recommended' instead of required
		),
			array(
			'name'     				=> 'Nextend Facebook Connect', // The plugin name
			'slug'     				=> 'nextend-facebook-connect', // The plugin slug (typically the folder name)
			'required' 				=> false // If false, the plugin is only 'recommended' instead of required
		)
 
 
	);

/*
* Array of configuration settings. Amend each line as needed.
*
* TGMPA will start providing localized text strings soon. If you already have translations of our standard
* strings available, please help us make TGMPA even better by giving us access to these translations or by
* sending in a pull-request with .po file(s) with the translations.
*
* Only uncomment the strings in the config array if you want to customize the strings.
*/
$config = array(
	'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
	'default_path' => '',                      // Default absolute path to bundled plugins.
	'menu'         => 'tgmpa-install-plugins', // Menu slug.
	'parent_slug'  => 'themes.php',            // Parent menu slug.
	'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
	'has_notices'  => true,                    // Show admin notices or not.
	'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	'is_automatic' => false,                   // Automatically activate plugins after installation or not.
	'message'      => '',                      // Message to output right before the plugins table.
	/*
	'strings'      => array(
	'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
	'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
	// <snip>...</snip>
	'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	)
	*/
);
 
 	tgmpa( $plugins, $config );
}


/**
 * Create wp-admin menu bar for theme options
 *
 * @since 2.6.3
 * @author N. Ramadani
 *
 */
add_action( 'admin_bar_menu', 'fc_theme_options', 999 );

function fc_theme_options( $wp_admin_bar ) {
	$args = array(
		'id'    => 'woo_theme_opt',
		'title' => esc_html( 'Theme Options', 'woothemes' ),
		'href'  => admin_url( 'admin.php?page=woothemes' ),
		'meta'  => array( 'class' => 'my-toolbar-page' )
	);
	$wp_admin_bar->add_node( $args );
}


/**
 * Remove password strength meter for a while, until find best solution
 *
 * @since 2.6.5
 * @author N. Ramadani
 *
 */
function wc_ninja_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );