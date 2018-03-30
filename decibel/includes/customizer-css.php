<?php
/**
 * Customizer CSS
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Inline CSS with the customizer options
 */
function wolf_customizer_css() {

	$css = wolf_get_customizer_bg_options( 'body_bg', 'body' );
	$css .= wolf_get_customizer_bg_options( 'site_footer_bg', '.site-footer' );

	if ( 'boxed-layout' == get_theme_mod( 'layout' ) && ( get_theme_mod( 'body_bg_color' ) || get_theme_mod( 'body_bg_img' ) ) )
		$css .= '#page{background:none;}';

	if ( WOLF_DEBUG ) {
		return $css;
	} else {
		return wolf_compact_css( $css );
	}
} // end function

if ( ! function_exists( 'wolf_output_customizer_options' ) ) {
	/**
	 * Output the custom CSS
	 */
	function wolf_output_customizer_options() {
		echo '<style>';
		echo '/* Customizer */' . "\n";
	    	echo wolf_customizer_css();
	    	echo '</style>';
	}
	//add_action( 'wp_head', 'wolf_output_customizer_options' );
}

function wolf_get_customizer_bg_options( $id, $selector ) {

	$css = '';

	$img = '';
	$color = get_theme_mod( $id . '_color' );
	$repeat = get_theme_mod( $id . '_repeat' );
	$position = get_theme_mod( $id . '_position' );
	$attachment = get_theme_mod( $id . '_attachment' );
	$size = get_theme_mod( $id . '_size' );
	$none = get_theme_mod( $id . '_none' );
	$parallax = get_theme_mod( $id . '_parallax' );
	$opacity = intval(get_theme_mod( $id . '_opacity', 100 )) / 100;
	$color_rgba = 'rgba(' . wolf_hex_to_rgb( $color ) . ', ' . $opacity .')';


	/* Backgrounds
	---------------------------------*/
	if ( '' == $none ) {

		if ( get_theme_mod( $id . '_img' ) )
			$img = 'url("'. get_theme_mod( $id . '_img' ) .'")';

		if ( $color || $img ) {

			if ( ! $img ) {
				$css .= "$selector {background-color:$color;background-color:$color_rgba;}";
			}

			if ( $img )  {

				if ( $parallax ) {

					$css .= "$selector {background : $color $img $repeat fixed}";
					$css .= "$selector {background-position : 50% 0}";

				} else {
					$css .= "$selector {background : $color $img $position $repeat $attachment}";
				}

				if ( 'cover' == $size ) {

					$css .= "$selector {
						-webkit-background-size: 100%;
						-o-background-size: 100%;
						-moz-background-size: 100%;
						background-size: 100%;
						-webkit-background-size: cover;
						-o-background-size: cover;
						background-size: cover;
					}";
				}

				if ( 'resize' == $size ) {

					$css .= "$selector {
						-webkit-background-size: 100%;
						-o-background-size: 100%;
						-moz-background-size: 100%;
						background-size: 100%;
					}";
				}
			}
		}
	} else {
		$css .= "$selector {background:none;}";
	}

	return $css;
}
