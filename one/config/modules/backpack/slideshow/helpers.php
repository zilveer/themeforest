<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_get_showcase_item_slides' ) ) {
	/**
	 * Get the Showcase page slides.
	 *
	 * @param integer $id The id.
	 * @return array
	 */
	function thb_get_showcase_item_slides( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_entry_slides( 'showcase_slides', $id );
	}
}

if( !function_exists('thb_slideshow_has_slides') ) {
	/**
	 * Check if the page Showcase has slides.
	 *
	 * @param integer $id The id.
	 * @return boolean
	 */
	function thb_slideshow_has_slides( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		$slides = thb_get_showcase_item_slides( $id );
		return count( $slides ) > 0;
	}
}

if( ! function_exists( 'thb_is_slideshow_autoplay' ) ) {
	/**
	 * Check if the page slideshow must fit the viewport size.
	 *
	 * @return boolean
	 */
	function thb_is_slideshow_autoplay() {
		$autoplay = thb_get_post_meta( thb_get_page_ID(), 'slideshow_autoplay' ) == '1';

		return apply_filters( 'thb_is_slideshow_autoplay', $autoplay );
	}
}

if( ! function_exists( 'thb_get_slideshow_speed' ) ) {
	/**
	 * Get the page slideshow speed.
	 *
	 * @return integer
	 */
	function thb_get_slideshow_speed() {
		$speed = (int) thb_get_post_meta( thb_get_page_ID(), 'slideshow_speed' ) * 1000;

		if ( empty( $speed ) ) {
			$speed = 3000;
		}

		return apply_filters( 'thb_get_slideshow_speed', $speed );
	}
}

if( ! function_exists( 'thb_get_slideshow_effect' ) ) {
	/**
	 * Get the page slideshow effect.
	 *
	 * @return string
	 */
	function thb_get_slideshow_effect() {
		$effect = thb_get_post_meta( thb_get_page_ID(), 'slideshow_effect' );

		if ( empty( $effect ) ) {
			$effect = 'move';
		}

		return apply_filters( 'thb_get_slideshow_effect', $effect );
	}
}