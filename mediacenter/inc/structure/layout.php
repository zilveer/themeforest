<?php
/**
 * Layout functions used in the theme
 *
 * @package mediacenter
 */

/**
 * Gets an array of arguments that can be used to determin a page layout
 *
 * @return array
 */
if( ! function_exists( 'mc_get_page_layout_args' ) ) {
	function mc_get_page_layout_args() {

		$filter_suffix 	= '';
		$args 			= array();

		if( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_tax( 'product_label' ) ) ) {

			$args = array(
				'layout'		=> 'left-sidebar',
				'layout_name'	=> 'wc-archive-products',
				'filter_suffix'	=> 'products-archive-page',
			);

		} elseif( is_woocommerce_activated() && is_product() ) {

			$args = array(
				'layout'		=> 'full-width',
				'layout_name'	=> 'wc-single-product',
				'filter_suffix'	=> 'single-product-page',
			);

		} elseif( is_woocommerce_activated() && is_cart() ) {

			$args = array(
				'hide_title'	=> true,
				'filter_suffix'	=> 'cart-page',
			);

		} elseif( is_woocommerce_activated() && is_account_page() ) {
			
			if( ! is_user_logged_in() ) {
				$args = array(
					'body_classes' => 'not-logged-in'
				);
			}

		} elseif( is_yith_wcwl_activated() && mc_is_wishlist_page() ) {

			$args = array(
				'hide_title'	=> true,
				'filter_suffix'	=> 'wishlist-page',	
			);

		}

		if( isset( $args[ 'filter_suffix' ] ) ) {
			$filter_suffix = $args[ 'filter_suffix' ];
		}

		return apply_filters( 'mc_layout_args_' . $filter_suffix, $args );
	}
}

/**
 * Applies additional classes to body element
 *
 * @return array
 */
if( ! function_exists( 'mc_apply_body_class' ) ) {
	function mc_apply_body_class( $body_classes ) {

		$layout_args = mc_get_page_layout_args();

		if( ! empty( $layout_args[ 'body_classes' ] ) ) {
			
			$body_classes_arr = explode( ' ', $layout_args[ 'body_classes' ] );
			foreach( $body_classes_arr as $body_class ) {
				$body_classes[] = $body_class;
			}
		}

		if( ! empty( $layout_args[ 'layout_name'] ) ) {
			$body_classes[] = $layout_args[ 'layout_name' ];
		}

		if( ! empty( $layout_args[ 'layout'] ) ) {
			$body_classes[] = $layout_args[ 'layout' ];
		}

		return $body_classes;
	}
}

/**
 * Determines whether a page should display header or not.
 *
 * @return bool
 */
if( ! function_exists( 'mc_should_hide_page_header' ) ) {
	function mc_should_hide_page_header( $should_hide ) {

		$layout_args = mc_get_page_layout_args();

		if( ! empty( $layout_args[ 'hide_title' ] ) ) {
			$should_hide = $layout_args[ 'hide_title' ];
		}

		return $should_hide;
	}
}