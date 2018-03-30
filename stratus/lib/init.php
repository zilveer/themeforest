<?php
/**
 * Initial setup and constants
 *
 * @author     @retlehs
 * @link 	   http://roots.io
 * @editor     Themovation <themovation@gmail.com>
 * @version    1.0
 */

//-----------------------------------------------------
// after_setup_theme
// Perform basic setup, registration, and init actions
// for this theme.
//-----------------------------------------------------


add_action('after_setup_theme', 'themo_setup');
 
function themo_setup() {
	// Make theme available for translation
	load_theme_textdomain('stratus', get_template_directory() . '/language');

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
	'primary_navigation' => esc_html__('Primary Navigation', 'stratus'),
	));

	// title tag support
	add_theme_support( 'title-tag' );

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);

	if ( function_exists( 'add_image_size' ) ) { 
		// Set Image Size for Logo
		if ( function_exists( 'ot_get_option' ) ) {
			$logo_height = ot_get_option( 'themo_logo_height', 100 );
			add_image_size('themo-logo', 9999, $logo_height); //  (unlimited width, user set height)	
		}else{
			add_image_size('themo-logo', 9999, 100); // (unlimited width, 100px high)	
		}	
		
		// Set our custom images sizes
		add_image_size('themo_full_width', 1140, 900); // General Full Width Images - 1140 wide
		add_image_size('themo_thumb_slider', 255, 170, array( 'center', 'center' )); // Thumbnail Slider - 255 wide, 170 high, cropped center by center.
		add_image_size('themo_thumb_slider_portrait', 255, 0); // Thumbnail Slider Portrait - 255 wide, unlimited height.
		add_image_size('themo_brands', 0, 80); // Brands - 80 high
		add_image_size('themo_mini_brands', 0, 40); // Brands - 80 high
		add_image_size('themo_testimonials', 60, 60, array( 'center', 'top' ) ); // Testimonial Headshot - 60 wide, 60 high, cropped center and top.
		add_image_size('themo_featured', 555, 290, array( 'center', 'center' ) ); // Featured image - 440 wide, 300 high, cropped center by center.
		add_image_size('themo_team', 480); // Meet the Team - 360 wide.
		add_image_size('themo_showcase', 500); // Showcase - 500 wide.
		add_image_size('themo_page_header', 1920); // Page Header / BG - 1920 wide.
		add_image_size('themo_blog_standard', 750); // Blog for Standard post with Sidebar - 750 wide.
		add_image_size('themo_blog_masonry', 360); // Blog for Masonry - 360 wide.
        add_image_size('themo_portfolio_standard', 380, 380, true); // Standard Portfolio Size - 380 x 380, hard crop
		
	}

	
  
	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

}

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
if (!defined('THEMEO_OT_DEFAULTS')) {
	define('THEMEO_OT_DEFAULTS', 'YTo2MTp7czoxNzoidGhlbW9fbG9nb19oZWlnaHQiO3M6MzoiMTAwIjtzOjEwOiJ0aGVtb19sb2dvIjtzOjA6IiI7czozNjoidGhlbW9fbG9nb190cmFuc3BhcmVudF9oZWFkZXJfZW5hYmxlIjtzOjI6Im9uIjtzOjI5OiJ0aGVtb19sb2dvX3RyYW5zcGFyZW50X2hlYWRlciI7czowOiIiO3M6MjA6InRoZW1vX25hdl90b3BfbWFyZ2luIjtzOjI6IjE1IjtzOjIzOiJ0aGVtb19oZWFkZXJfZGFya19zdHlsZSI7czoyOiJvbiI7czoxNjoidGhlbW9fY3VzdG9tX2NzcyI7czowOiIiO3M6NDk6InRoZW1vX21ldGFfYm94X2J1aWxkZXJfbWV0YV9ib3hfbWFudWFsX3NvcnRfb3JkZXIiO3M6Mzoib2ZmIjtzOjQ0OiJ0aGVtb19tZXRhX2JveF9idWlsZGVyX21ldGFfYm94X21heF9xdWFudGl0eSI7czoxOiI1IjtzOjI5OiJ0aGVtb19hdXRvbWF0aWNfcG9zdF9leGNlcnB0cyI7czoyOiJvbiI7czoxOToidGhlbW9fc21vb3RoX3Njcm9sbCI7czozOiJvZmYiO3M6MTU6InRoZW1vX3ByZWxvYWRlciI7czoyOiJvbiI7czoxOToidGhlbW9fY29sb3JfcHJpbWFyeSI7czowOiIiO3M6MTg6InRoZW1vX2NvbG9yX2FjY2VudCI7czowOiIiO3M6MTU6InRoZW1vX2JvZHlfZm9udCI7czowOiIiO3M6MTU6InRoZW1vX21lbnVfZm9udCI7czowOiIiO3M6MTk6InRoZW1vX2hlYWRpbmdzX2ZvbnQiO3M6MDoiIjtzOjI3OiJ0aGVtb19zb2NpYWxfbWVkaWFfYWNjb3VudHMiO2E6Mzp7aTowO2E6Mzp7czo1OiJ0aXRsZSI7czo4OiJGYWNlYm9vayI7czoyMjoidGhlbW9fc29jaWFsX2ZvbnRfaWNvbiI7czoxNToic29jaWFsLWZhY2Vib29rIjtzOjE2OiJ0aGVtb19zb2NpYWxfdXJsIjtzOjI0OiJodHRwczovL3d3dy5mYWNlYm9vay5jb20iO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjc6IlR3aXR0ZXIiO3M6MjI6InRoZW1vX3NvY2lhbF9mb250X2ljb24iO3M6MTQ6InNvY2lhbC10d2l0dGVyIjtzOjE2OiJ0aGVtb19zb2NpYWxfdXJsIjtzOjE4OiJodHRwOi8vdHdpdHRlci5jb20iO31pOjI7YTozOntzOjU6InRpdGxlIjtzOjk6Ikluc3RhZ3JhbSI7czoyMjoidGhlbW9fc29jaWFsX2ZvbnRfaWNvbiI7czoxNjoic29jaWFsLWluc3RhZ3JhbSI7czoxNjoidGhlbW9fc29jaWFsX3VybCI7czoxOiIjIjt9fXM6MjM6InRoZW1vX3BheW1lbnRzX2FjY2VwdGVkIjthOjQ6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6NDoiVmlzYSI7czoyODoidGhlbW9fcGF5bWVudHNfYWNjZXB0ZWRfbG9nbyI7czowOiIiO3M6MTc6InRoZW1vX3BheW1lbnRfdXJsIjtzOjA6IiI7fWk6MTthOjM6e3M6NToidGl0bGUiO3M6NjoiUGF5UGFsIjtzOjI4OiJ0aGVtb19wYXltZW50c19hY2NlcHRlZF9sb2dvIjtzOjA6IiI7czoxNzoidGhlbW9fcGF5bWVudF91cmwiO3M6MDoiIjt9aToyO2E6Mzp7czo1OiJ0aXRsZSI7czoxMDoiTWFzdGVyQ2FyZCI7czoyODoidGhlbW9fcGF5bWVudHNfYWNjZXB0ZWRfbG9nbyI7czowOiIiO3M6MTc6InRoZW1vX3BheW1lbnRfdXJsIjtzOjA6IiI7fWk6MzthOjM6e3M6NToidGl0bGUiO3M6NDoiQU1FWCI7czoyODoidGhlbW9fcGF5bWVudHNfYWNjZXB0ZWRfbG9nbyI7czowOiIiO3M6MTc6InRoZW1vX3BheW1lbnRfdXJsIjtzOjA6IiI7fX1zOjE5OiJ0aGVtb19jb250YWN0X2ljb25zIjthOjM6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6MTk6ImNvbnRhY3RAc3RyYXR1cy5jb20iO3M6MTg6InRoZW1vX2NvbnRhY3RfaWNvbiI7czoxOToiZ2x5cGhpY29ucy1lbnZlbG9wZSI7czoyMjoidGhlbW9fY29udGFjdF9pY29uX3VybCI7czoyNjoibWFpbHRvOmNvbnRhY3RAc3RyYXR1cy5jb20iO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjE0OiIxLTgwMC0yMjItNDU0NSI7czoxODoidGhlbW9fY29udGFjdF9pY29uIjtzOjE3OiJnbHlwaGljb25zLWlwaG9uZSI7czoyMjoidGhlbW9fY29udGFjdF9pY29uX3VybCI7czoxNjoidGVsOjgwMC0yMjItNDU0NSI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6ODoiTG9jYXRpb24iO3M6MTg6InRoZW1vX2NvbnRhY3RfaWNvbiI7czoyMjoiZ2x5cGhpY29ucy1nb29nbGUtbWFwcyI7czoyMjoidGhlbW9fY29udGFjdF9pY29uX3VybCI7czoxOiIjIjt9fXM6MTk6InRoZW1vX3N0aWNreV9oZWFkZXIiO3M6Mjoib24iO3M6MjQ6InRoZW1vX3RyYW5zcGFyZW50X2hlYWRlciI7czoyOiJvbiI7czoxNzoidGhlbW9fd2lkZV9sYXlvdXQiO3M6Mjoib24iO3M6Mjk6InRoZW1vX2JveGVkX2xheW91dF9iYWNrZ3JvdW5kIjtzOjA6IiI7czoxNzoidGhlbW9fYmFja3N0cmV0Y2giO3M6Mjoib24iO3M6MjA6InRoZW1vX3JldGluYV9zdXBwb3J0IjtzOjM6Im9mZiI7czoyMjoidGhlbW9fZm9vdGVyX2NvcHlyaWdodCI7czoxNzoiwqDCqSAyMDE1IFN0cmF0dXMiO3M6MTk6InRoZW1vX2Zvb3Rlcl9jcmVkaXQiO3M6NzQ6IlRoZW1lIGJ5IDxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vdGhlbW92YXRpb24uY29tLyI+VGhlbW92YXRpb248L2E+IjtzOjI2OiJ0aGVtb19mb290ZXJfd2lkZ2V0X3N3aXRjaCI7czoyOiJvbiI7czoyMDoidGhlbW9fZm9vdGVyX2NvbHVtbnMiO3M6MToiNCI7czoxNzoidGhlbW9fZm9vdGVyX2xvZ28iO3M6MDoiIjtzOjIxOiJ0aGVtb19mb290ZXJfbG9nb191cmwiO3M6MDoiIjtzOjIwOiJ0aGVtb19mbGV4X2FuaW1hdGlvbiI7czo0OiJmYWRlIjtzOjE3OiJ0aGVtb19mbGV4X2Vhc2luZyI7czo1OiJzd2luZyI7czoyNDoidGhlbW9fZmxleF9hbmltYXRpb25sb29wIjtzOjI6Im9uIjtzOjIzOiJ0aGVtb19mbGV4X3Ntb290aGhlaWdodCI7czoyOiJvbiI7czoyNToidGhlbW9fZmxleF9zbGlkZXNob3dzcGVlZCI7czo0OiI0MDAwIjtzOjI1OiJ0aGVtb19mbGV4X2FuaW1hdGlvbnNwZWVkIjtzOjM6IjU1MCI7czoyMDoidGhlbW9fZmxleF9yYW5kb21pemUiO3M6Mzoib2ZmIjtzOjIzOiJ0aGVtb19mbGV4X3BhdXNlb25ob3ZlciI7czoyOiJvbiI7czoxNjoidGhlbW9fZmxleF90b3VjaCI7czoyOiJvbiI7czoyMzoidGhlbW9fZmxleF9kaXJlY3Rpb25uYXYiO3M6Mjoib24iO3M6MjE6InRoZW1vX2ZsZXhfY29udHJvbE5hdiI7czoyOiJvbiI7czozNToidGhlbW9fYmxvZ19pbmRleF9sYXlvdXRfc2hvd19oZWFkZXIiO3M6Mjoib24iO3M6MzY6InRoZW1vX2Jsb2dfaW5kZXhfbGF5b3V0X2hlYWRlcl9mbG9hdCI7czo4OiJjZW50ZXJlZCI7czozMToidGhlbW9fYmxvZ19pbmRleF9sYXlvdXRfc2lkZWJhciI7czo1OiJyaWdodCI7czozNjoidGhlbW9fc2luZ2xlX3Bvc3RfbGF5b3V0X3Nob3dfaGVhZGVyIjtzOjI6Im9uIjtzOjM3OiJ0aGVtb19zaW5nbGVfcG9zdF9sYXlvdXRfaGVhZGVyX2Zsb2F0IjtzOjg6ImNlbnRlcmVkIjtzOjMyOiJ0aGVtb19zaW5nbGVfcG9zdF9sYXlvdXRfc2lkZWJhciI7czo1OiJyaWdodCI7czoyODoidGhlbW9fZGVmYXVsdF9sYXlvdXRfc2lkZWJhciI7czo1OiJyaWdodCI7czoyNToidGhlbW9fcG9ydGZvbGlvX2hvbWVfbGluayI7czowOiIiO3M6MzI6InRoZW1vX3BvcnRmb2xpb19ob21lX2xpbmtfYW5jaG9yIjtzOjA6IiI7czoyODoidGhlbW9fcG9ydGZvbGlvX3Jld3JpdGVfc2x1ZyI7czowOiIiO3M6MTk6InRoZW1vX3Byb2plY3RfaWNvbnMiO3M6Mjoib24iO3M6MTc6InRoZW1vX3Byb2plY3RfbmF2IjtzOjI6Im9uIjtzOjIwOiJ0aGVtb190b3BfbmF2X3N3aXRjaCI7czozOiJvZmYiO3M6MTg6InRoZW1vX3RvcF9uYXZfdGV4dCI7czowOiIiO3M6MjU6InRoZW1vX3RvcF9uYXZfaWNvbl9ibG9ja3MiO2E6NDp7aTowO2E6Mzp7czo1OiJ0aXRsZSI7czoxOToiY29udGFjdEBzdHJhdHVzLmNvbSI7czoxODoidGhlbW9fdG9wX25hdl9pY29uIjtzOjE5OiJnbHlwaGljb25zLWVudmVsb3BlIjtzOjIyOiJ0aGVtb190b3BfbmF2X2ljb25fdXJsIjtzOjI2OiJtYWlsdG86Y29udGFjdEBzdHJhdHVzLmNvbSI7fWk6MTthOjM6e3M6NToidGl0bGUiO3M6MTQ6IkhvdyB0byBGaW5kIFVzIjtzOjE4OiJ0aGVtb190b3BfbmF2X2ljb24iO3M6MjI6ImdseXBoaWNvbnMtZ29vZ2xlLW1hcHMiO3M6MjI6InRoZW1vX3RvcF9uYXZfaWNvbl91cmwiO3M6MToiIyI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6MTI6IjI1MC01NTUtNTU1NSI7czoxODoidGhlbW9fdG9wX25hdl9pY29uIjtzOjE3OiJnbHlwaGljb25zLWlwaG9uZSI7czoyMjoidGhlbW9fdG9wX25hdl9pY29uX3VybCI7czoxNjoidGVsOjI1MC01NTUtNTU1NSI7fWk6MzthOjQ6e3M6NToidGl0bGUiO3M6MDoiIjtzOjE4OiJ0aGVtb190b3BfbmF2X2ljb24iO3M6MTQ6InNvY2lhbC10d2l0dGVyIjtzOjIyOiJ0aGVtb190b3BfbmF2X2ljb25fdXJsIjtzOjE4OiJodHRwOi8vdHdpdHRlci5jb20iO3M6Mjk6InRoZW1vX3RvcF9uYXZfaWNvbl91cmxfdGFyZ2V0IjthOjE6e2k6MDtzOjY6Il9ibGFuayI7fX19czoyMToidGhlbW9fd29vX3Nob3dfaGVhZGVyIjtzOjI6Im9uIjtzOjIyOiJ0aGVtb193b29faGVhZGVyX2Zsb2F0IjtzOjQ6ImxlZnQiO3M6MTc6InRoZW1vX3dvb19zaWRlYmFyIjtzOjU6InJpZ2h0Ijt9');
	}
if (!defined('THEMO_COLOR_PRIMARY')) { define('THEMO_COLOR_PRIMARY', '#045089'); }
if (!defined('THEMO_COLOR_ACCENT')) { define('THEMO_COLOR_ACCENT', '#f96d64'); }
if (!defined('THEMO_MAP_API_KEY')) { define('THEMO_MAP_API_KEY', 'AIzaSyBCdeaxoEPIgvorqg2dkTOsZwbKiXDP6lY'); }