<?php

/*
 *	CSS For Custom Background Image at top in the page_for_posts
 * 	For  Pages and Portfolio
 */
function sama_custom_background () {
	global $majesty_options;
	$css_output = '';
	if( $majesty_options['theme_layout'] == 'boxed' ) {
		if( $majesty_options['boxed_type'] == 'boxedbgrepeat' && ! empty( $majesty_options['boxed_bg_img'] ) ) {
			$css_output .= 'body.boxed { background-image: url('. esc_url($majesty_options['boxed_bg_img']) .');}';
		} elseif( $majesty_options['boxed_type'] == 'boxedbgnorepeat' && ! empty( $majesty_options['boxed_bg_img'] ) ) {
			$css_output .= 'body.boxed-image { background-image: url('. esc_url($majesty_options['boxed_bg_img']) .');}';
		} elseif( $majesty_options['boxed_type'] == 'boxedbgcolor' && ! empty( $majesty_options['boxed_bg_color'] ) ) {
			$css_output .= 'body.boxed-color { background-color: '. esc_attr($majesty_options['boxed_bg_color']) .';}';
		}
	}
	// for team memeber realted posts
	if( is_singular('team-member') ) {
		global $majesty_options;
		$bg				= $majesty_options['related_member_bg'];
		$bg_url			= $majesty_options['related_bg_url'];
		if( $bg == 'background' && ! empty( $bg_url ) ) {
			$css_output .= '.related-bg { background-image: url('. esc_url($bg_url) .');}';
		}
	}
	
	// top-slider
	if( is_page_template( 'page-templates/page-builder.php') || is_page_template( 'page-templates/page-blank.php' ) ) {
		$page_id = sama_get_current_page_id();
		$slider_type = get_post_meta( $page_id, '_sama_slider_type', true );
		if( empty( $slider_type ) ) {
			return;
		}
		if( $slider_type == 'fullscreenbg' ) {
			$fullbg		= get_post_meta( $page_id, '_sama_fullscreenbg_settings', true );
			$fullbg 	= $fullbg[0];
			if( empty ( $fullbg['image'] ) ) {
				return;
			}
			$css_output .= '.full-screen-bg { background-image: url('. esc_url( $fullbg['image'] ) .');}';
		} elseif( $slider_type == 'movementbg' ) {
			$movebg		= get_post_meta( $page_id, '_sama_movementbg_settings', true );
			$movebg 	= $movebg[0];
			if( empty ( $movebg['image'] ) ) {
				return;
			}
			$css_output .= '.move-bg { background-image: url('. esc_url( $movebg['image'] ) .');}';
		}
		elseif( $slider_type == 'parallaxbg' ) {
			$parallaxbg		= get_post_meta( $page_id, '_sama_parallaxbg_settings', true );
			$parallaxbg 	= $parallaxbg[0];
			if( empty ( $parallaxbg['image'] ) ) {
				return;
			}
			$css_output .= '#bg-parallax-top .parallax-bg { background-image: url('. esc_url( $parallaxbg['image'] ) .');}';
		}
	}
	
	/*
	 * Background Image Css
	 */
	$page_heade_bg = sama_get_custom_header_background_img();
	if( ! empty( $page_heade_bg ) ) {
		$css_output .= '.page-with-custom-background { background-image: url('. esc_url( $page_heade_bg ) .');}';
	}
	
	if( ! empty( $css_output ) ) {
		echo '<style type="text/css">'. trim( $css_output ) .'</style>';
	}
}
add_action( 'wp_head', 'sama_custom_background', 100 );