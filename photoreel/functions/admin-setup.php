<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'THEME_FRAMEWORK', 'themnificthemes' );

if ( ! function_exists( 'themnific_themeoptions_redirect' ) ) {
	
function themnific_themeoptions_redirect () {
	header( 'Location: ' . admin_url( 'admin.php?page=themnificthemes&activated=true' ) );
} // End themnific_themeoptions_redirect()
}

add_action( 'themnific_theme_activate', 'themnific_themeoptions_redirect', 10 );

if ( ! function_exists( 'themnific_flush_rewriterules' ) ) {
/**
 * Flush the WordPress rewrite rules to refresh permalinks with updated rewrite rules.
 * @since  4.0.0
 * @return void
 */
function themnific_flush_rewriterules () {
	flush_rewrite_rules();
} // End themnific_flush_rewriterules()
}

/**
 * Add default options and show Options Panel after activate
 * @since  4.0.0
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	// Call action that sets.
	add_action( 'admin_head','themnific_option_setup' );
	// Flush rewrite rules.
	add_action( 'admin_head', 'themnific_flush_rewriterules', 9 );
	// Custom action for theme-setup (redirect is at priority 10).
	do_action( 'themnific_theme_activate' );
	update_option('themnific_options',$themnific_array);
}

if ( ! function_exists( 'themnific_option_setup' ) ) {
/**
 * Update theme options in database with options as stored in theme.
 * @since  1.0.0
 * @return void
 */
function themnific_option_setup () {
	//Update EMPTY options
	$themnific_array = array();
	add_option( 'themnific_options', $themnific_array );

	$template = get_option( 'themnific_template' );
	$saved_options = get_option( 'themnific_options' );

	foreach ( (array) $template as $option ) {
		if ( $option['type'] != 'heading' ) {
			$id = isset( $option['id'] ) ? $option['id'] : NULL;
			$std = isset( $option['std'] ) ? $option['std'] : NULL;
			$db_option = get_option( $id );
			if ( empty( $db_option ) ) {
				if ( is_array( $option['type'] ) ) {
					foreach ( $option['type'] as $child ) {
						if ( ! isset( $child['id'] ) ) continue; // Make sure we have an ID value.

						$c_id = $child['id'];
						$c_std = isset( $child['std'] ) ? $child['std'] : '';
						$db_option = get_option( $c_id );
						if ( ! empty( $db_option ) ) {
							update_option( $c_id, $db_option );
							$themnific_array[$id] = $db_option;
						} else {
							$themnific_array[$c_id] = $c_std;
						}
					}
				} else {
					update_option( $id, $std );
					$themnific_array[$id] = $std;
				}
			} else { //So just store the old values over again.
				$themnific_array[$id] = $db_option;
			}
		}
	}
	
	// Allow child themes/plugins to filter here.
	$themnific_array = apply_filters( 'themnific_options_array', $themnific_array );
	update_option( 'themnific_options', $themnific_array );
} // End themnific_option_setup()
}


if ( ! function_exists( 'themnificthemes_admin_head' ) ) {
/**
 * Optionally add markup in the header of the WordPress admin.
 * @since  4.0.0
 * @return void
 */
function themnificthemes_admin_head() {} // End themnificthemes_admin_head()
}
add_action( 'admin_head', 'themnificthemes_admin_head', 10 );


if ( ! function_exists( 'themnific_head_css' ) ) {
/**
 * Output CSS from standardized theme options.
 * @since  2.0.0
 * @return void
 */
function themnific_head_css () {
	$output = '';
	$text_title = get_option( 'themnific_texttitle' );
	$tagline = get_option( 'themnific_tagline' );
    $custom_css = get_option( 'themnific_custom_css' );

	$template = get_option( 'themnific_template' );
	if ( is_array( $template ) ) {
		foreach( $template as $option ) {
			if( isset( $option['id'] ) ) {
				if( $option['id'] == 'themnific_texttitle' ) {
					// Add CSS to output
					if ( $text_title == 'true' ) {
						$output .= '#logo img { display:none; } .site-title { display:block !important; }' . "\n";
						if ( $tagline == 'false' )
							$output .= '.site-description { display:none !important; }' . "\n";
						else
							$output .= '.site-description { display:block !important; }' . "\n";
					}
				}
			}
		}
	}

	if ( $custom_css != '' ) {
		$output .= $custom_css . "\n";
	}

	// Output styles
	if ( $output != '' ) {
		$output = strip_tags($output);
		echo '<!-- Options Panel Custom CSS -->' . "\n";
		$output = "<style type=\"text/css\">\n" . $output . "</style>\n\n";
		echo stripslashes( $output );
	}
} // End themnific_head_css()
}


?>