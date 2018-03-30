<?php
/**
 * Redux Functions for Shop options and other woocommerce pages
 *
 * @package mediacenter
 */

if( ! function_exists( 'rx_change_catalog_mode' ) ) {
	/**
	 *  Enables/Diables catalog mode
	 */
	function rx_change_catalog_mode() {
		global $media_center_theme_options;

		$enable_catalog_mode = false;

		if( ! empty( $media_center_theme_options[ 'catalog_mode' ] ) && '1' === $media_center_theme_options[ 'catalog_mode' ] ) {
			$enable_catalog_mode = true;
		}

		return $enable_catalog_mode;
	}
}

if( ! function_exists( 'rx_apply_product_comparison_page_id' ) ) {
	/**
	 * Applies Product Comparison page ID to mc_product_comparison_page_id filter
	 */
	function rx_apply_product_comparison_page_id( $product_comparison_page_id ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'product_comparison_page' ] ) ) {
			$product_comparison_page_id = $media_center_theme_options[ 'product_comparison_page' ];
		}

		return $product_comparison_page_id;
	}
}

if( ! function_exists( 'rx_change_default_view_switcher_view' ) ) {
	/**
	 * Applies the default view switcher view to mc_default_view_switcher_view filter
	 */
	function rx_change_default_view_switcher_view( $shop_view ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'shop_default_view' ] ) && $media_center_theme_options[ 'shop_default_view' ] == 'list-view' ) {
			$shop_view = 'list';
		}

		// Check for should remember user view
		if( ! empty( $media_center_theme_options[ 'remember_user_view' ] ) && $media_center_theme_options[ 'remember_user_view' ] === '1' && isset( $_COOKIE[ 'user_shop_view' ] ) ) {

			$user_shop_view = $_COOKIE[ 'user_shop_view' ];
			if( $user_shop_view == 'grid-view' ) {
				$shop_view = 'grid';
			} else {
				$shop_view = 'list';
			}
		}


		return $shop_view;
	}
}

if( ! function_exists( 'rx_add_remeber_user_view_to_localize_data' ) ) {
	/**
	 * Adds 'remember_user_view' to localize data
	 */
	function rx_add_remeber_user_view_to_localize_data( $data ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'remember_user_view' ] ) && $media_center_theme_options[ 'remember_user_view' ] === '1' ) {
			$data[ 'remember_user_view' ] = '1';
		} else {
			$data[ 'remember_user_view' ] = '0';
		}

		return $data;
	}
}

if( ! function_exists( 'rx_apply_product_loop_columns' ) ) {
	/**
	 * Applies number of columns for mc_loop_shop_columns filter
	 */
	function rx_apply_product_loop_columns( $columns ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'product_loop_columns' ] ) ) {
			$columns = $media_center_theme_options[ 'product_loop_columns' ];
		}

		return $columns;
	}
}

if( ! function_exists( 'rx_apply_products_per_page' ) ) {
	/**
	 * Applies number of products per page to mc_loop_shop_per_page filter
	 */
	function rx_apply_products_per_page( $products_per_page ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'products_per_page' ] ) ) {
			$products_per_page = absint( $media_center_theme_options[ 'products_per_page' ] );
		}

		return $products_per_page;
	}
}

if( ! function_exists( 'rx_toggle_product_animation') ) {
	/**
	 * Checks if product animations should be enabled or not
	 */
	function rx_toggle_product_animation( $enable_animation ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'products_animation' ] ) && 'none' === $media_center_theme_options[ 'products_animation'] ) {
			$enable_animation = false;
		}

		return $enable_animation;
	}
}

if( ! function_exists( 'rx_apply_product_animation' ) ) {
	/**
	 * Applies the selected product animation via mc_loop_product_animation filter
	 */
	function rx_apply_product_animation( $product_item_animation ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'products_animation' ] ) ) {
			$product_item_animation = $media_center_theme_options[ 'products_animation' ];
		}

		return $product_item_animation;
	}
}

if( ! function_exists( 'rx_apply_lazy_loading' ) ) {
	/**
	 * Overrides image attributes to make way for echo lazy loading if enabled
	 */
	function rx_apply_lazy_loading( $atts, $attachment ) {
		global $media_center_theme_options;

		if( ! is_admin() && (! empty( $media_center_theme_options[ 'lazy_loading' ] ) && '1' === $media_center_theme_options[ 'lazy_loading' ] ) ) {
			$blank_gif				= get_template_directory_uri() . '/assets/images/blank.gif';
		    $atts[ 'data-echo' ] 	= $atts[ 'src' ];
		    $atts[ 'src' ] 			= $blank_gif;
		    $atts[ 'class' ]		= $atts['class'] . ' echo-lazy-loading';
		}

	    return $atts;
	}
}

if( ! function_exists( 'rx_toggle_rating_in_title' ) ) {
	/**
	 * Enables/Disables star rating on grid
	 */
	function rx_toggle_rating_in_title( $show_rating ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'show_rating_in_grid' ] ) && '1' === $media_center_theme_options[ 'show_rating_in_grid' ] ) {
			$show_rating = true;
		}

		return $show_rating;
	}
}

if( ! function_exists( 'rx_apply_shop_page_layout' ) ) {
	/**
	 * Determines layout of Products archive page
	 */
	function rx_apply_shop_page_layout( $args ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'shop_page_layout' ] ) ) {
			switch( $media_center_theme_options[ 'shop_page_layout'] ) {
				case 'full-width':
					$args[ 'layout' ] = 'full-width';
				break;
				case 'sidebar-right':
					$args[ 'layout' ] = 'right-sidebar';
				break;
				case 'sidebar-left':
					$args[ 'layout' ] = 'left-sidebar';
				break;
				default:
					$args[ 'layout' ] = 'left-sidebar';
			}
		}

		return $args;
	}
}

if( ! function_exists( 'rx_apply_single_product_layout' ) ) {
	/**
	 * Determines layout of Single Product page
	 */
	function rx_apply_single_product_layout( $args ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options[ 'single_product_layout' ] ) ) {
			switch( $media_center_theme_options[ 'single_product_layout'] ) {
				case 'full-width':
					$args[ 'layout' ] = 'full-width';
				break;
				case 'sidebar-right':
					$args[ 'layout' ] = 'right-sidebar';
				break;
				case 'sidebar-left':
					$args[ 'layout' ] = 'left-sidebar';
				break;
				default:
					$args[ 'layout' ] = 'left-sidebar';
			}
		}

		return $args;
	}
}