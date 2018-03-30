<?php
/**
 * Load After Framework's functions.php
 *
 * Called by the hook: do_action( 'functions_after' );
 *
 * Child theme's load the functions.php file before the parent (framework) functions.php file. 
 * There may be times you need to load functions directly at the beginning or end of the main
 * framework functions.php file. For these situations the hooks "functions_before" and 
 * "functions_after" were created. The famework will also include the files "functions-before.php"
 * and "functions-after.php" into these hooks by default. 
 * 
 * These files are completely optional in the framework child themes. If you are not using them
 * they can safely be deleted. 
 * 
 */


#=================================================================
# Core Shortcodes
#=================================================================
/**
*
* These will likely be integrated into the framework as core shortcodes. They are mostly helpers 
* to improve WP features or extend WP functions. The core should have minimal use of shortcodes.
* 
**/

#-----------------------------------------------------------------
# Enable shortdoces in Text Widget
#-----------------------------------------------------------------

add_filter('widget_text', 'do_shortcode');


#-----------------------------------------------------------------
# Members Only
#-----------------------------------------------------------------

// Members content only (hide from public)
//................................................................

function shortcode_members_only( $atts, $content = null ) {
	
	if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return do_shortcode($content);
	
	return '';
	
}
add_shortcode('members_only', 'shortcode_members_only');


// Public users content only (hide after login)
//................................................................

function shortcode_public_only( $atts, $content = null ) {
	
	if ( !is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return do_shortcode($content);
	
	return '';
	
}
add_shortcode('public_only', 'shortcode_public_only');



#=================================================================
# Theme Specific Shortcodes
#=================================================================
/**
*
* Shortcodes unique to the theme only can be added here.
* 
**/
