<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_icon_with_text' ) ) {
	/**
	 * Icon with text Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_icon_with_text( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_icon_with_text', $atts );
		}

		extract( shortcode_atts( array(
			'icon_size'             		=> '',
			'use_custom_icon_size'  	=> '',
			'custom_icon_size'      		=> '',
			'custom_icon_size_inner'	=> '',
			'custom_icon_margin'    	=> '',
			'icon'                  		=> '',
			'icon_animation'        		=> '',
			'icon_animation_delay'  		=> '',
			'image'                 		=> '',
			'icon_type'             		=> 'normal',
			'icon_position'         		=> '',
			'custom_style'			=> 'no',
			'icon_margin'           		=> '',
			'box_type'              		=> '',
			'box_border_color'      		=> '',
			'box_background_color'  	=> '',
			'title'                 			=> '',
			'title_tag'             		=> 'h5',
			'title_color'           		=> '',
			'text'                  			=> '',
			'text_color'            		=> '',
			'icon_link'                  		=> '',
			'link_text'             		=> '',
			'link_color'            		=> '',
			'icon_link_target'                	=> '_self',
			'icon_link_title'			=> '',
			'hover_effect' 			=> 'none',
			'custom_style'			=> 'no',
			'bg_color' 			=> '',
			'icon_color' 			=> '',
			'border_color' 			=> '',
			'bg_color_hover' 		=> '',
			'icon_color_hover'		=> '',
			'border_color_hover' 		=> '',
			'animation'			=> '',
			'animation_delay' 		=> '',
			'inline_style' 			=> '',
			'class'				=> '',
		), $atts ) );

		$output = '';
		$icon_html = '';
		$title_html = '';
		$p_style = '';
		$title_style = '';
		$box_style = '';

		if ( $inline_style ) {
			$box_style .= $inline_style;
		}

		if ( $animation_delay && 'none' != $animation ) {
			$box_style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		$box_style = ( $box_style ) ? " style='$box_style'" : '';

		$style = '';
		$style .= ( $icon_animation_delay ) ? 'animation-delay:' . absint( $icon_animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $icon_animation_delay ) / 1000 . 's;' : '' ;

		$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$title_tag = ( in_array( $title_tag, $headings_array ) ) ? $title_tag : 'h3';

		switch ( $icon_size ) {
			case 'large': //smallest icon size
				$box_size = 'tiny';
				break;
			case 'fa-2x':
				$box_size = 'small';
				break;
			case 'fa-3x':
				$box_size = 'medium';
				break;
			case 'fa-4x':
				$box_size = 'large';
				break;
			case 'fa-5x':
				$box_size = 'very-large';
				break;
			default:
				$box_size = 'tiny';
		}

		$box_class = "$class icon-box clearfix icon-position-$icon_position icon-box-$box_size icon-type-$icon_type";

		if ( $animation )
			$box_class .= " wow $animation";

		$icon_class = $icon_size;

		if ( 'normal' != $icon_type )
			$icon_class = 'fa-stack ' . $icon_size;

		$data = '';
		if ( 'yes' == $custom_style ) {

			if ( $bg_color )
				$style .= "background-color:$bg_color;";

			if ( $icon_color )
				$style .= "color:$icon_color;";

			if ( $border_color )
				$style .= "border-color:$border_color;";

			// hover style
			if ( $bg_color_hover )
				$data .= " data-hover-bg-color='$bg_color_hover'";

			if ( $icon_color_hover )
				$data .= " data-hover-font-color='$icon_color_hover'";

			if ( $border_color_hover )
				$data .= " data-hover-border-color='$border_color_hover'";

			$p_style = ( $text_color ) ? "style='color:$text_color;'" : '';
			$title_style = ( $title_color ) ? "style='color:$title_color;'" : '';

		}

		if ( $icon_animation )
			$icon_class .= ' wow bounceIn';

		$icon_class .= " hover-$hover_effect";

		$icon_class .= ( 'yes' == $custom_style ) ? ' wolf-icon-custom-style' : ' wolf-icon-no-custom-style';

		$inline_style = ( $style ) ? "style='$style'" : '';

		$output .= "<div class='$box_class'$box_style>";

			$icon_html .= "<span class='$icon_class' $inline_style $data>";

			if ( $icon_link )
				$icon_html .= "<a class='icon-link' $inline_style href='$icon_link' target='$icon_link_target'>";

		if ( 'circle' == $icon_type ) {

			$icon_html .= "<i class='fa $icon fa-stack-1x'></i>";

		} elseif ( 'square' == $icon_type ) {

			$icon_html .= "<i class='fa $icon fa-stack-1x'></i>";


		} elseif ( 'ban' == $icon_type ) {

			$icon_html .= "<i class='fa $icon fa-stack-1x'></i>";
			$icon_html .= "<i class='fa fa-ban fa-stack-2x text-danger'></i>";

		} else {

			$icon_html .= "<i class='fa $icon'></i>";
		}

			if ( $icon_link )
				$icon_html .= '</a>';

			$icon_html .= '</span>'; // end icon container

			/**
			 *  Title tag
			 */
			$title_html .= "<$title_tag $title_style class='icon-title'>";

			if ( $icon_link_title )
				$title_html .= "<a href='$icon_link' target='$icon_link_target'>";

			$title_html .= $title;

			if ( $icon_link_title )
				$title_html .= '</a>';

			$title_html .= "</$title_tag>";



		/**
		 * Display the layout differently depending on the position option
		 */
		if ( 'left_from_title' == $icon_position ) {

			$output .= "<div class='icon-text-holder'>";
			$output .= "<div class='icon-text-inner'>";
			$output .= "<div class='icon-title-holder'>";
			$output .= "<div class='icon-holder'>";
			$output .= $icon_html;
			$output .= '</div>';
			if ( $title )
				$output .= $title_html;
			$output .= '</div>';
			if ( $text )
				$output .= "<p$p_style>$text</p>";
			$output .= '</div>';
			$output .= '</div>';

		} elseif ( 'right_from_title' == $icon_position ) {
			$output .= "<div class='icon-text-holder'>";
				$output .= "<div class='icon-text-inner'>";
				$output .= "<div class='icon-title-holder'>";
				if ( $title )
					$output .= $title_html;
				$output .= "<div class='icon-holder'>";
				$output .= $icon_html;
				$output .= '</div>';

				$output .= '</div>';
				if ( $text )
					$output .= "<p$p_style>$text</p>";
				$output .= '</div>';
			$output .= '</div>';

		} else {
			$output .= "<div class='icon-holder'>";
			$output .= $icon_html;
			$output .= '</div>';

			$output .= "<div class='icon-text-holder'>";
			$output .= "<div class='icon-text-inner'>";
			if ( $title )
				$output .= $title_html;
			if ( $text )
				$output .= "<p$p_style>$text</p>";
			$output .= '</div>';
			$output .= '</div>';
		}

		$output .= '</div><!-- .icon-box -->';

		return $output;
	}
	add_shortcode( 'wolf_icon_with_text', 'wolf_shortcode_icon_with_text' );
}