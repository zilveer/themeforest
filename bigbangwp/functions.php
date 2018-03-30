<?php
$curr_theme = wp_get_theme(); 
$theme_version = trim($curr_theme->Version);
if(!$theme_version) $theme_version = "1.0";

//Define constants:
define('BRANKIC_INCLUDES', TEMPLATEPATH . '/includes/');
define('BRANKIC_THEME', 'BigBang WP Template');
define('BRANKIC_THEME_SHORT', 'BigBangWP');
define('BRANKIC_ROOT', get_template_directory_uri());
define('BRANKIC_VAR_PREFIX', 'bigbangwp_'); 

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}
function of_get_default( $option ) {
     $defaults = optionsframework_options();
     if ( isset( $defaults[$option]['std'] ) ) {
          return $defaults[$option]['std'];
     }
     return false; // default if no std is set
}





require_once (BRANKIC_INCLUDES . 'bra_theme_functions.php');
require_once (BRANKIC_INCLUDES . 'bra_shortcodes.php'); 
require_once (BRANKIC_INCLUDES . 'bra_pagenavi.php'); 
require_once (BRANKIC_INCLUDES . 'ambrosite-post-link-plus.php');
require_once (BRANKIC_INCLUDES . '../options.php');

//Load admin specific files:
if (is_admin()) :
require_once (BRANKIC_INCLUDES . 'bra_admin_functions.php');
require_once (BRANKIC_INCLUDES . 'bra_custom_fields.php'); 
require_once (BRANKIC_INCLUDES . 'bra_admin_1.php');
require_once (BRANKIC_INCLUDES . 'bra_admin_2.php'); 
require_once (BRANKIC_INCLUDES . 'bra_admin_3.php');
endif;


// check for version of multiple post thumbnails plugin

//$plugin_info = get_plugin_data( __FILE__ ); //get_plugin_data(plugin_dir_url( __FILE__ ) . "multiple-post-thumbnails");
//print_r($plugin_info);

function remove_old_version_of_multiple_thumbnail() {
		$multiple_url = dirname( __FILE__ ) . "/../plugins/multiple-post-thumbnails/multi-post-thumbnails.php";
		
		$all_plugins = get_plugins();
		$multiple_version = $all_plugins["multiple-post-thumbnails/multi-post-thumbnails.php"]["Version"];
		if ( $multiple_version < 9 && $multiple_version != "") {
			deactivate_plugins("multiple-post-thumbnails/multi-post-thumbnails.php");
			add_action('admin_notices', 'my_admin_notice');
		}
}
add_action( 'admin_init', 'remove_old_version_of_multiple_thumbnail' ); // Hook plugin admin initialization

function my_admin_notice(){
    echo '<div class="updated">
       <p>You\'re using unsupported version of Multiple Post Thumbnails. Please delete the plugin (all files) and after that click on "Begin installing plugin" from the top notification window. </p>
    </div>';
}



include_once( TEMPLATEPATH . '/includes/inc2.0/classes.php' );



add_theme_support('post-thumbnails');

add_theme_support( 'menus' );

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'status', 'video', 'audio', 'chat' ) );

    
load_theme_textdomain( BRANKIC_THEME_SHORT, TEMPLATEPATH . '/languages' );

// Load external file to add support for MultiPostThumbnails. Allows you to set more than one "feature image" per post.
//require_once('includes/multi-post-thumbnails.php');

// Define additional "post thumbnails". Relies on MultiPostThumbnails to work

/*if (class_exists('MultiPostThumbnails')) 
{ 
    $extra_images_no = of_get_option(BRANKIC_VAR_PREFIX."extra_images_no");
    if ($extra_images_no == "") $extra_images_no = 20;    
    for ($i = 1 ; $i <= $extra_images_no ; $i++) 
    {
        new MultiPostThumbnails(array( 'label' => "Extra Image $i", 'id' => "extra-image-$i", 'post_type' => 'page' ) );
        new MultiPostThumbnails(array( 'label' => "Extra Image $i", 'id' => "extra-image-$i", 'post_type' => 'post' ) );
        new MultiPostThumbnails(array( 'label' => "Extra Image $i", 'id' => "extra-image-$i", 'post_type' => 'portfolio_item' ) );
    }
}*/

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */


?>