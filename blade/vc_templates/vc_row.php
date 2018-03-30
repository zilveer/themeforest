<?php

	$output = $out_pattern = $out_overlay = $out_image_bg = $out_video_bg = '';

	extract(
		shortcode_atts(
			array(
				'section_id'      => '',
				'font_color'      => '',
				'heading_color' => '',
				'section_type'      => 'fullwidth-background',
				'section_full_height' => 'no',
				'equal_column_height' => 'none',
				'desktop_visibility' => '',
				'tablet_visibility' => '',
				'tablet_sm_visibility' => '',
				'mobile_visibility' => '',
				'bg_color'        => '',
				'bg_type'        => '',
				'bg_image'        => '',
				'bg_image_type' => 'none',
				'bg_image_vertical_position' => 'top',
				'parallax_sensor' => '250',
				'pattern_overlay' => '',
				'color_overlay' => '',
				'color_overlay_custom' => '#ffffff',
				'opacity_overlay' => '',
				'bg_video_webm' => '',
				'bg_video_mp4' => '',
				'bg_video_ogv' => '',
				'bg_video_loop' => 'yes',
				'bg_video_muted' => 'yes',
				'padding_top' => '',
				'padding_bottom' => '',
				'margin_bottom' => '',
				'header_feature' => '',
				'footer_feature' => '',
				'el_class'        => '',
				'el_id'        => '',
				'css' => '',
				'scroll_section_title' => '',
				'scroll_header_style' => 'dark',
			),
			$atts
		)
	);

	if ( 'image' == $bg_type || 'hosted_video' == $bg_type ) {

		if ( !empty ( $color_overlay ) && 'custom' != $color_overlay ) {

			//Overlay Classes
			$overlay_classes = array();
			$overlay_classes[] = 'grve-bg-overlay grve-bg-' . $color_overlay;
			if ( !empty ( $opacity_overlay ) ) {
				$overlay_classes[] = 'grve-opacity-' . $opacity_overlay;
			}
			$overlay_string = implode( ' ', $overlay_classes );
			$out_overlay .= '  <div class="' . esc_attr( $overlay_string ) .'"></div>';
		}

		if ( 'custom' == $color_overlay ) {
			$out_overlay .= '  <div class="grve-bg-overlay" style="background-color:' . esc_attr( $color_overlay_custom ) . '"></div>';
		}
	}

	// Pattern Overlay
	if ( !empty ( $pattern_overlay ) ) {
		$out_pattern .= '  <div class="grve-pattern"></div>';
	}

	//Background Image Classses
	$bg_image_classes = array( 'grve-bg-image' );

	if( 'horizontal-parallax-lr' == $bg_image_type || 'horizontal-parallax-rl' == $bg_image_type ){
		$bg_image_classes[] = 'grve-bg-center-' . $bg_image_vertical_position;
	}

	$bg_image_string = implode( ' ', $bg_image_classes );

	//Background Image
	$img_style = blade_grve_build_shortcode_img_style( $bg_image ,$bg_image_type );

	if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' !== $bg_image_type ) ) {
		$out_image_bg .= '  <div class="' . esc_attr( $bg_image_string ) . '"  ' . $img_style . '></div>';
	}

	if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' == $bg_image_type ) ) {
		$out_image_bg .= '  <div class="' . esc_attr( $bg_image_string ) . '" ' . $img_style . '></div>';
	}

	//Background Video
	if ( 'hosted_video' == $bg_type && ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) ) {

		$video_settings = array(
			'preload' => 'auto',
			'autoplay' => 'yes',
			'loop' => $bg_video_loop,
			'muted' => $bg_video_muted,
		);

		$out_video_bg .= '<div class="grve-bg-video">';
		$out_video_bg .=  '<video ' . blade_grve_print_media_video_settings( $video_settings ) . '>';
		if ( !empty ( $bg_video_webm ) ) {
			$out_video_bg .=  '<source src="' . esc_url( $bg_video_webm ) . '" type="video/webm">';
		}
		if ( !empty ( $bg_video_mp4 ) ) {
			$out_video_bg .=  '<source src="' . esc_url( $bg_video_mp4 ) . '" type="video/mp4">';
		}
		if ( !empty ( $bg_video_ogv ) ) {
			$out_video_bg .=  '<source src="' . esc_url( $bg_video_ogv ) . '" type="video/ogg">';
		}
		$out_video_bg .=  '</video>';
		$out_video_bg .= '</div>';
	}

	//Section Classses
	$section_classes = array( 'grve-section' );

	$section_classes[] = 'grve-' . $section_type ;

	if( 'horizontal-parallax-lr' == $bg_image_type || 'horizontal-parallax-rl' == $bg_image_type ){
		$section_classes[] = 'grve-' . $bg_image_type;
		$section_classes[] = 'grve-bg-parallax';
	} else {
		$section_classes[] = 'grve-bg-' . $bg_image_type;
	}

	if ( !empty ( $heading_color ) ) {
		$section_classes[] = 'grve-headings-' . $heading_color;
	}
	if ( !empty ( $header_feature ) ) {
		$section_classes[] = 'grve-feature-header';
	}
	if ( !empty ( $footer_feature ) ) {
		$section_classes[] = 'grve-feature-footer';
	}
	if( 'none' != $equal_column_height ) {
		$section_classes[] = 'grve-' . $equal_column_height;
	}
	if( 'no' != $section_full_height ) {
		$section_classes[] = 'grve-' . $section_full_height;
	}
	if ( !empty ( $el_class ) ) {
		$section_classes[] = $el_class;
	}

	if( vc_settings()->get( 'not_responsive_css' ) != '1') {
		if ( !empty( $desktop_visibility ) ) {
			$section_classes[] = 'grve-desktop-row-hide';
		}
		if ( !empty( $tablet_visibility ) ) {
			$section_classes[] = 'grve-tablet-row-hide';
		}
		if ( !empty( $tablet_sm_visibility ) ) {
			$section_classes[] = 'grve-tablet-sm-row-hide';
		}
		if ( !empty( $mobile_visibility ) ) {
			$section_classes[] = 'grve-mobile-row-hide';
		}
	}

	$section_string = implode( ' ', $section_classes );

	$wrapper_attributes = array();

	if ( !empty ( $section_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $section_id ) . '"';
	}

	$wrapper_attributes[] = 'class="' . esc_attr( $section_string ) . '"';

	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		$section_uniqid = uniqid('grve-scrolling-section-');
		$wrapper_attributes[] = 'data-anchor="' . esc_attr( $section_uniqid ) . '"';
		$wrapper_attributes[] = 'data-anchor-tooltip="' . esc_attr( $scroll_section_title ) . '"';
		$wrapper_attributes[] = 'data-header-color="' . esc_attr( $scroll_header_style ) . '"';
	}

	if( 'parallax' == $bg_image_type || 'horizontal-parallax-lr' == $bg_image_type || 'horizontal-parallax-rl' == $bg_image_type ){
		$wrapper_attributes[] = 'data-parallax-sensor="' . esc_attr( $parallax_sensor ) . '"';
	}

	$style = blade_grve_build_shortcode_style( $bg_color, $font_color, $padding_top, $padding_bottom, $margin_bottom );
	if( !empty( $style ) ) {
		$wrapper_attributes[] = $style;
	}

	//Section Output
	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= '  <div class="grve-container">';
	$output	.= '    <div class="grve-row grve-bookmark">';
	$output	.= do_shortcode( $content );
	$output	.= '    </div>';
	$output	.= '  </div>';
	$output .= '  <div class="grve-background-wrapper">';
	$output .= $out_pattern;
	$output .= $out_overlay;
	$output .= $out_image_bg;
	$output .= $out_video_bg;
	$output	.= '  </div>';

	$output	.= '</div>';

	print $output;

//Omit closing PHP tag to avoid accidental whitespace output errors.
