<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Theme Setup
*	--------------------------------------------------------------------- 
*/


/* Set content width */
if ( ! isset( $content_width ) ) $content_width = 940;

function mnky_theme_setup() {

	/* Register menu */
	register_nav_menus( array(
		'primary' => __( 'Main Navigation', 'care' )
	) );

	/* Menu fallback */
	function mnky_no_menu(){
		$url = admin_url( 'nav-menus.php');
		echo '<div class="menu-container"><ul class="menu"><li><a href="'. esc_url($url) .'">Click here to assign menu!</a></li></ul></div>';
	}   

	/* Thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Title tag */
	add_theme_support( 'title-tag' );

	/* Post formats */
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

	/* Feeds */
	add_theme_support( 'automatic-feed-links' );

	/* HTML5 */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );

	/* Languages */
	load_theme_textdomain( 'care', get_template_directory() . '/languages' );
	
}
add_action( 'after_setup_theme', 'mnky_theme_setup' );


/* Title tag fallback */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		echo '<title>', wp_title( '|', true, 'right' ) .'</title>';
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}

/* Allow shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Redirect to "Theme Options/Import Data" after activation */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	wp_redirect( admin_url( 'themes.php?page=ot-theme-options#section_import_data' ) );
}

/* Extend editor */
function mnky_more_buttons($buttons) {
  $buttons[] = 'fontsizeselect';
 
  return $buttons;
}
add_filter("mce_buttons_2", "mnky_more_buttons");