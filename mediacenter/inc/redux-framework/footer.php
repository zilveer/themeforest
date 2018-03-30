<?php
/**
 * Functions for implementing Footer options
 *
 * @package mediacenter
 */

if( ! function_exists( 'rx_footer_contact_info_text' ) ) {
	/**
	 * Footer Contact Text
	 */
	function rx_footer_contact_info_text( $text ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['footer_contact_info_text'] ) && ! empty( $media_center_theme_options['footer_contact_info_text'] ) ) {
			$text = $media_center_theme_options['footer_contact_info_text'];
		}

		return $text;
	}
}

if( ! function_exists( 'rx_footer_contact_info_address' ) ) {
	/**
	 * Footer Contact Address
	 */
	function rx_footer_contact_info_address( $address ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['footer_contact_info_address'] ) && ! empty( $media_center_theme_options['footer_contact_info_address'] ) ) {
			$address = $media_center_theme_options['footer_contact_info_address'];
		}

		return $address;
	}
}

if( ! function_exists( 'rx_footer_copyright_text' ) ) {
	/**
	 * Footer Copyright Text
	 */
	function rx_footer_copyright_text( $text ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['footer_copyright_text'] ) && ! empty( $media_center_theme_options['footer_copyright_text'] ) ) {
			$text = $media_center_theme_options['footer_copyright_text'];
		}

		return $text;
	}
}

if( ! function_exists( 'rx_credit_card_icons_gallery' ) ) {
	/**
	 * Footer Gallery Images
	 */
	function rx_credit_card_icons_gallery( $images ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['credit_card_icons_gallery'] ) && ! empty( $media_center_theme_options['credit_card_icons_gallery'] ) ) {
			$images = $media_center_theme_options['credit_card_icons_gallery'];
		}

		return $images;
	}
}