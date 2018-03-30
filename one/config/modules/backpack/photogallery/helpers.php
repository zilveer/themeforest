<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists('thb_photogallery_get_slides_per_page') ) {
	/**
	 * Return how many slides to load per page/AJAX request.
	 *
	 * @return integer
	 */
	function thb_photogallery_get_slides_per_page() {
		return (int) thb_get_post_meta( thb_get_page_ID(), 'slides_per_page' );
	}
}

if( ! function_exists('thb_photogallery_is_ajax') ) {
	/**
	 * Check if the photogallery is running on AJAX.
	 *
	 * @return boolean
	 */
	function thb_photogallery_is_ajax() {
		return thb_photogallery_get_slides_per_page() > 0;
	}
}

if( ! function_exists('thb_photogallery_get_offset') ) {
	/**
	 * Get the photogallery current offset.
	 *
	 * @return integer
	 */
	function thb_photogallery_get_offset() {
		return thb_input_get( 'offset', 'absint', 0 );
	}
}

if( ! function_exists('thb_photogallery_ajax_dataurl') ) {
	/**
	 * Get the data URL to invoke for the next batch of images to be loaded.
	 *
	 * @return string
	 */
	function thb_photogallery_ajax_dataurl() {
		$offset = thb_photogallery_get_offset();

		return esc_url( add_query_arg( 'offset', $offset + 1, get_permalink() ) );
	}
}

if( ! function_exists('thb_photogallery_get_slides') ) {
	/**
	 * Get the photogallery slides, optionally filtered by the page offset.
	 *
	 * @param boolean $load_all Force the component to load all the available slides ignoring the offset parameter.
	 * @return array
	 */
	function thb_photogallery_get_slides( $load_all = false ) {
		$slides_manager = new THB_SlidesManager( 'photogallery_slide' );
		$slides = $slides_manager->getSlides();

		if ( ! $load_all && thb_photogallery_is_ajax() ) {
			$slides_per_page = thb_photogallery_get_slides_per_page();
			$offset = thb_photogallery_get_offset();

			$slides = array_slice( $slides, $offset * $slides_per_page, $slides_per_page );
		}

		return $slides;
	}
}

if( ! function_exists('thb_photogallery_show_load_more') ) {
	/**
	 * Check if the load more control should be displayed.
	 *
	 * @return boolean
	 */
	function thb_photogallery_show_load_more() {
		if ( thb_photogallery_is_ajax() ) {
			$total_slides = count( thb_photogallery_get_slides( true ) );
			$slides_per_page = thb_photogallery_get_slides_per_page();
			$offset = thb_photogallery_get_offset();

			if ( ( $offset + 1 ) * $slides_per_page < $total_slides ) {
				return true;
			}
		}

		return false;
	}
}