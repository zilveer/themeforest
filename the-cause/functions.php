<?php

define('TBI', get_template_directory() . '/includes/'); // includes folder
define('TBH', TBI . 'help/'); // help folder
define('TBS', get_template_directory() . '/styles/'); // styles
define('TBO', TBI . 'options/'); // theme options folder

/* THEME BLOSSOM */
include(TBI . 'const.php');
include(TBH . 'help.php');
include(TBI . 'themeblossom.php');

add_theme_support( 'automatic-feed-links' );
add_theme_support('custom-background');
add_theme_support('custom-header');

if (!isset( $content_width)) {$content_width = 940;}

add_editor_style();

add_theme_support( 'post-thumbnails');
add_image_size('homeSlider', 940, 350, true);
add_image_size('campaign', 658, 193, true);
add_image_size('gallerySlider', 920, 350, true);
add_image_size('video', 200, 135, true);
add_image_size('videoWide', 444, 237, true);
add_image_size('videoHome', 365, 197, true);
add_image_size('caption', 210, 145, true);
add_image_size('thumb280', 280, 172, true);
add_image_size('dfs', 147, 102, true);
add_image_size('dfw', 618, 193, true);
add_image_size('dfm', 202, 136, true);
add_image_size('dfl', 283, 237, true);

// Woo Commerce Plugin
define('WOOCOMMERCE_USE_CSS', false);
update_option('woocommerce_catalog_image_width', 150);
update_option('woocommerce_catalog_image_height', 150);
update_option('woocommerce_catalog_image_crop', 1);
update_option('woocommerce_single_image_width', 283);
update_option('woocommerce_single_image_height', 237);
update_option('woocommerce_single_image_crop', 1);
update_option('woocommerce_thumbnail_image_width', 90);
update_option('woocommerce_thumbnail_image_height', 90);
update_option('woocommerce_thumbnail_image_crop', 1);

add_theme_support( 'woocommerce' );

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
	$fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	$fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	$fields['billing']['billing_company']['placeholder'] = 'Company Name';
	$fields['billing']['billing_phone']['placeholder'] = 'Phone';

	return $fields;
}

/* THEME OPTIONS */
$tbOptions = array();
if ($handle = opendir(TBO)) {
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, 'php')) {
			$tbOptions[] = $file;
		}
	}

	closedir($handle);
}

sort($tbOptions); // important, because some servers don't use natural order of files
foreach ($tbOptions as $option) {
	include_once(TBO . $option);
}

/* POST TYPES */
if ($handle = opendir(TBI . 'posttypes/')) {
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, 'php')) {
			include_once(TBI . 'posttypes/' . $file);
		}
	}

	closedir($handle);
}

/* PLUGINS */

// META BOXES SCRIPT
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/includes/plugins/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( TBI . 'plugins/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
include(TBI . 'plugins/meta.php');

// Kriesi pagination
include(TBI . 'plugins/pagination.php');

/* SHORTCODES */
if ($handle = opendir(TBI . 'shortcodes/')) {
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, 'php')) {
			include_once(TBI . 'shortcodes/' . $file);
		}
	}

	closedir($handle);
}


/* WIDGET AREAS */
if (function_exists('register_sidebar')) {
	$args = array('name' => 'Home', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div class="widget box"><div>', 'after_widget' => '<div class="clear nodisplay"></div></div></div>');
	register_sidebar($args);
}

if (function_exists('register_sidebar')) {
	$args = array('name' => 'Highlights', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div>', 'after_widget' => '</div>');
	register_sidebar($args);
}

if (function_exists('register_sidebar')) {
	$args = array('name' => 'Events', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div class="widget box"><div>', 'after_widget' => '<div class="clear nodisplay"></div></div></div>');
	register_sidebar($args);
}

if (function_exists('register_sidebar')) {
	$args = array('name' => 'Sidebar', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div class="widget box"><div>', 'after_widget' => '<div class="clear nodisplay"></div></div></div>');
	register_sidebar($args);
}

if ( function_exists('register_sidebars') ) {
	$args = array('name' => 'Footer %d', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div class="widget">', 'after_widget' => '</div><div class="clear"></div>');
	register_sidebars(4, $args);
}

if (function_exists('register_sidebar')) {
	$args = array('name' => 'Shop', 'before_title' => '<h3>', 'after_title' => '</h3>', 'before_widget' => '<div class="widget box"><div>', 'after_widget' => '<div class="clear nodisplay"></div></div></div>');
	register_sidebar($args);
}

/* WIDGETS */
if ($handle = opendir(TBI . 'widgets/')) {
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, 'php')) {
			include_once(TBI . 'widgets/' . $file);
		}
	}

	closedir($handle);
}

/* MENUS */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'Navigation' => 'This menu will be used in main navigation area',
		  'Footer' => 'This menu will be used in footer area'
		)
	);
}

?>