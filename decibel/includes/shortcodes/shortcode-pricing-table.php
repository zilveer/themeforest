<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_pricing_tables' ) ) {
	/**
	 * Pricing Tables Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_pricing_tables( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_pricing_tables', $atts );
		}

		extract( shortcode_atts( array(
			'columns' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "pricing-tables clearfix pricing-tables-$columns-cols";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<section class='$class' $style>";

		$output .= do_shortcode( $content );

		$output .= '</section>';

		return $output;
	}
	add_shortcode( 'wolf_pricing_tables', 'wolf_shortcode_pricing_tables' );
}

if ( ! function_exists( 'wolf_shortcode_pricing_table' ) ) {
	/**
	 * Pricing Table Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_pricing_table( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_pricing_table', $atts );
		}

		extract( shortcode_atts(  array(
			'title' => '',
			'title_tag' => 'h3',
			'tagline' => '',
			'price' => '',
			'currency' => '',
			'display_currency' => 'before',
			'offer' => '',
			'offer_price' => '',
			'price_period' => '',
			'show_button' => '',
			'button_text' => __( 'Buy Now', 'wolf' ),
			'link' => '',
			'target' => '_self',
			'active' => '',
			'active_text' => __( 'Best Choice', 'wolf' ),
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'pricing-table-inner';
		$style = '';

		$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$title_tag = ( in_array( $title_tag, $headings_array ) ) ? $title_tag : 'h3';

		if ( 'yes' == $active ) {
			$class .= ' pricing-table-active';
		}

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class'$style>";

		$output .= '<ul>';

		// debug( $active_text );

		if ( $title ) {

			$output .= '<li class="pricing-table-title-cell">';

			if ( 'yes' == $active )
				$output .= "<span class='pricing-table-featured'><span>$active_text</span></span>";

			$output .= "<$title_tag class='pricing-table-title'>$title</$title_tag>";

			if ( $tagline )
				$output .= "<span class='pricing-table-tagline'>$tagline</span>";

			$output .= '</li>';
		}

		if ( $price ) {

			$output .= '<li class="pricing-table-main-content">';

			if ( 'yes' == $offer && $offer_price ) {

				$output .= '<span class="pricing-table-price-strike">';

				if ( $currency && 'before' == $display_currency )
					$output .= "<span class='pricing-table-currency-strike'>$currency</span>";

				$output .= $price;

				if ( $currency && 'after' == $display_currency )
					$output .= "<span class='pricing-table-currency-strike'>$currency</span>";

				$output .= '</span>';

				if ( $currency && 'before' == $display_currency )
					$output .= "<span class='pricing-table-currency'>$currency</span>";

				$output .= "<span class='pricing-table-price'>$offer_price</span>";

				if ( $currency && 'after' == $display_currency )
					$output .= "<span class='pricing-table-currency'>$currency</span>";
			} else {

				if ( $currency && 'before' == $display_currency )
					$output .= "<span class='pricing-table-currency'>$currency</span>";

				$output .= "<span class='pricing-table-price'>$price</span>";

				if ( $currency && 'after' == $display_currency )
					$output .= "<span class='pricing-table-currency'>$currency</span>";

			}

			if ( $price_period )
				$output .= "<span class='pricing-table-price-period'>$price_period</span>";

			$output .= '</li>';
		}

		$content = wp_kses( $content, array( 'ul' => array(), 'li' => array() ) );
		$output .= do_shortcode( $content );

		if ( 'yes' == $show_button ) {
			$output .= '<li class="pricing-table-button">';
			$output .= "<a href='$link' target='$target'>$button_text</a>";
			$output .= '</li>';
		}

		$output .= '</ul>';

		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'wolf_pricing_table', 'wolf_shortcode_pricing_table' );
}