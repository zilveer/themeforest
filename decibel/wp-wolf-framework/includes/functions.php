<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wolf_get_theme_slug' ) ) {
	/**
	 * Get the theme slug
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_theme_slug() {

		return sanitize_title( get_template() );
	}
}

if ( ! function_exists( 'wolf_add_version_meta' ) ) {
	/**
	 * Add metatags with Theme and Framework Versions
	 * Usefull for support
	 *
	 * @return string
	 */
	function wolf_add_version_meta() {

		echo '<meta name="generator" content="' . WOLF_THEME_NAME . ' ' . WOLF_THEME_VERSION .'" />' . "\n";
		echo '<meta name="generator" content="Wolf Framework ' .WOLF_FRAMEWORK_VERSION . '" />' . "\n";

	}
	add_action( 'wolf_meta_head', 'wolf_add_version_meta' );
}

if ( ! function_exists( 'wolf_get_post_thumbnail_url' ) ) {
	/**
	 * Get any thumbnail URL
	 * @param string $format
	 * @param int $post_id
	 * @return string
	 */
	function wolf_get_post_thumbnail_url( $format = 'medium', $post_id = null ) {
		global $post;

		if ( is_object( $post ) && isset( $post->ID ) && null == $post_id )
			$ID = $post->ID;
		else
			$ID = $post_id;

		if ( $ID && has_post_thumbnail( $ID ) ) {

			$attachment_id = get_post_thumbnail_id( $ID );
			if ( $attachment_id ) {
				$img_src = wp_get_attachment_image_src( $attachment_id, $format );

				if ( $img_src && isset( $img_src[0] ) )
					return esc_url( $img_src[0] );
			}
		}
	}
}

if ( ! function_exists( 'wolf_get_theme_uri' ) ) {
	/**
	 * Check if a file exists in a child theme
	 * else returns the URL of the parent theme file
	 * Mainly uses for images
	 * @param string $file
	 * @return string
	 */
	function wolf_get_theme_uri( $file = null ) {

		if ( is_file( get_stylesheet_directory() . $file ) ) {

			return esc_url( get_stylesheet_directory_uri() . $file );

		} else {

			return esc_url( get_template_directory_uri() . $file );
		}
	}
}

if ( ! function_exists( 'wolf_get_theme_option' ) ) {
	/**
	 * Get theme option from "wolf_theme_options_template" array
	 *
	 * @param string $o
	 * @param string $default
	 * @return string
	 */
	function wolf_get_theme_option( $o, $default = '' ) {

		global $options;

		$wolf_theme_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );

		if ( isset( $wolf_theme_options[ $o ] ) ) {

			$option = $wolf_theme_options[ $o ];

			if ( function_exists( 'icl_t' ) ) {

				$option = icl_t( wolf_get_theme_slug(), $o, $option ); // WPML
			}

			return $option;

		} elseif ( $default ) {

			return $default;
		}
	}
}

if ( ! function_exists( 'wolf_get_category_meta' ) ) {
	/**
	 * Get category meta data if any
	 *
	 * @param
	 * @return
	 */
	function wolf_get_category_meta( $o ) {

		if ( is_category() ) {

			$cat_id = get_query_var( 'cat' );
			$cat_meta = get_option( "_wolf_post_category_meta_$cat_id" );
			if ( $cat_meta ) {
				if ( isset( $cat_meta[$o] ) && isset( $cat_meta[$o] ) ) {
					return $cat_meta[$o];
				}
			}
		}
	}
}

if ( ! function_exists( 'wolf_update_theme_option' ) ) {
	/**
	 * Inject/update an option in the theme options array
	 *
	 * @param string $key
	 * @param string $value
	 */
	function wolf_update_theme_option( $key, $value ) {

		$wolf_theme_options = ( get_option( 'wolf_theme_options_' . wolf_get_theme_slug() ) ) ? get_option( 'wolf_theme_options_' . wolf_get_theme_slug() ) : array();
		$wolf_theme_options[ $key ] = $value;
		update_option( 'wolf_theme_options_' . wolf_get_theme_slug(), $wolf_theme_options );
	}
}

if ( ! function_exists( 'wolf_get_url_from_attachment_id' ) ) {
	/**
	 * Get the URL of an attachment from its id
	 *
	 * @param int $id
	 * @return string $url
	 */
	function wolf_get_url_from_attachment_id( $id, $size = 'thumbnail' ) {

		if ( is_numeric( $id ) ) {
			$src = wp_get_attachment_image_src( absint( $id ), $size );
			if ( isset( $src[0] ) ) {
				return esc_url( $src[0] );
			}
		} else {
			return esc_url( $id );
		}
	}
}

if ( ! function_exists( 'wolf_sample' ) ) {
	/**
	 * Create a formated sample of any text
	 * @param string $text
	 * @param int $nbword
	 * @param string $after
	 * @return string
	 */
	function wolf_sample( $text, $nbword = 140, $after = '...' ) {
		$text = strip_tags( $text );

		if ( strlen( $text ) > $nbword ) {

			preg_match( '!.{0,'.$nbword.'}\s!si', $text, $match );
			if ( isset( $match[0] ) ) {
				$str = trim( $match[0] ) . $after;
			} else {
				$str = $text;
			}
		} else {
			$str = $text;
		}

		$str = preg_replace( '/\s\s+/', '', $str );
		$str = preg_replace(  '|\[(.+?)\](.+?\[/\\1\])?|s', '', $str );

		return $str;
	}
}

if ( ! function_exists( 'wolf_pagination' ) ) {
	/**
	 * Display WP pagination
	 *
	 * @param object $loop
	 * @return string
	 */
	function wolf_pagination( $loop = null ) {

		if ( ! $loop ) {
			global $wp_query;
			$max = $wp_query->max_num_pages;
		} else {
			$max = $loop->max_num_pages;
		}

		$big  = 999999999; // need an unlikely integer
		$args = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'		=> 'list',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $max,
		);

		if ( 1 < $max ) {
			echo '<div class="pagination">';
			echo paginate_links( $args ) . '<div style="clear:both"></div>';
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'wolf_compact_css' ) ) {
	/**
	 * Remove spaces in inline CSS
	 *
	 * @param string $css
	 * @return string
	 */
	function wolf_compact_css( $css, $hard = true ) {

		return preg_replace( '/\s+/', ' ', $css );
	}
}

/**
 * Sanitize html style attribute
 *
 * @param string $style
 * @return string
 */
function wolf_sanitize_style_attr( $style ) {

	return esc_attr( trim( wolf_compact_css( $style ) ) );
}

if ( ! function_exists( 'wolf_sanitize_html_classes' ) && function_exists( 'sanitize_html_class' ) ) {
	/**
	 * sanitize_html_class works just fine for a single class
	 * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
	 * to validate both blue and hedgehog,
	 * Because sanitize_html_class doesn't allow spaces.
	 *
	 * @uses   sanitize_html_class
	 * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
	 * @param  (mixed) $fallback Anything you want returned in case of a failure
	 * @return (mixed: string / $fallback )
	 */
	function wolf_sanitize_html_classes( $class, $fallback = null ) {

		// Explode it, if it's a string
		if ( is_string( $class ) ) {
			$class = explode(" ", $class);
		}

		if ( is_array( $class ) && count( $class ) > 0 ) {
			$class = array_map( 'sanitize_html_class', $class );
			return implode( " ", $class );
		}
		else {
			return sanitize_html_class( $class, $fallback );
		}
	}
}

if ( ! function_exists( 'wolf_hex_to_rgb' ) ) {
	/**
	 * Convert hex color to rgb
	 *
	 * @param string $hex
	 * @return string
	 */
	function wolf_hex_to_rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex,0,1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex,1,1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex,2,1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return implode( ',', $rgb ); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}

if ( ! function_exists( 'wolf_color_brightness' ) ) {
	/**
	 * Brightness color function simiar to sass lighten and darken
	 *
	 * @param string $hex
	 * @param int $percent
	 * @return string
	 */
	function wolf_color_brightness( $hex, $percent ) {

		$steps = ( ceil( ( $percent * 200 ) / 100 ) ) * 2;

		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( -255, min( 255, $steps ) );

		// Format the hex color string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex,1,1 ), 2 ).str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Get decimal values
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );

		// Adjust number of steps and keep it inside 0 to 255
		$r = max( 0, min( 255, $r + $steps ) );
		$g = max( 0, min( 255, $g + $steps ) );
		$b = max( 0, min( 255, $b + $steps ) );

		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}
}

if ( ! function_exists( 'wolf_is_ie' ) ) {
	/**
	 * Check if IE
	 *
	 * @return bool
	 */
	function wolf_is_ie() {

		global $is_IE;

		if ( $is_IE )
			return true; // make the computer explode
	}
}

if ( ! function_exists( 'wolf_is_ie8' ) ) {
	/**
	 * Check if IE8
	 *
	 * @return bool
	 */
	function wolf_is_ie8() {

		global $is_IE;
		if ( preg_match( '#MSIE 8#', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
			if ( $browser_version[0] )
				return true; // make the computer explode
		}
	}
}

if ( ! function_exists( 'debug' ) ) {
	/**
	 *  Debug function for developpment
	 *  Display less infos than a var_dump
	 *
	 * @param string $var
	 *
	 * @return string
	 */
	function debug( $var ) {
		echo '<br><pre style="border: 1px solid #ccc; padding:5px; width:98%">';
		print_r( $var );
		echo '</pre>';
	}
}
