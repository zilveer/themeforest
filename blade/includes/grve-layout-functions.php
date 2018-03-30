<?php

/*
*	Layout Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Function to fetch sidebar class
 */
function blade_grve_sidebar_class( $sidebar_view = '' ) {

	if( is_search() ) {
		return '';
	}
	$grve_sidebar_class = "";
	$grve_sidebar_extra_content = false;

	if ( 'shop' == $sidebar_view ) {
		if ( is_shop() ) {
			$grve_sidebar_id = blade_grve_post_meta_shop( 'grve_sidebar', blade_grve_option( 'page_sidebar' ) );
			$grve_sidebar_layout = blade_grve_post_meta_shop( 'grve_layout', blade_grve_option( 'page_layout', 'none' ) );
		} else if( is_product() ) {
			$grve_sidebar_id = blade_grve_post_meta( 'grve_sidebar', blade_grve_option( 'product_sidebar' ) );
			$grve_sidebar_layout = blade_grve_post_meta( 'grve_layout', blade_grve_option( 'product_layout', 'none' ) );
		} else {
			$grve_sidebar_id = blade_grve_option( 'product_tax_sidebar' );
			$grve_sidebar_layout = blade_grve_option( 'product_tax_layout', 'none' );
		}
	} else if ( is_singular() ) {
		if ( is_singular( 'post' ) ) {
			$grve_sidebar_id = blade_grve_post_meta( 'grve_sidebar', blade_grve_option( 'post_sidebar' ) );
			$grve_sidebar_layout = blade_grve_post_meta( 'grve_layout', blade_grve_option( 'post_layout', 'none' ) );
		} else if ( is_singular( 'portfolio' ) ) {
			$grve_sidebar_id = blade_grve_post_meta( 'grve_sidebar', blade_grve_option( 'portfolio_sidebar' ) );
			$grve_sidebar_layout = blade_grve_post_meta( 'grve_layout', blade_grve_option( 'portfolio_layout', 'none' ) );
			$grve_sidebar_extra_content = blade_grve_check_portfolio_details();
			if( $grve_sidebar_extra_content && 'none' == $grve_sidebar_layout ) {
				$grve_sidebar_layout = 'right';
			}
		} else {
			$grve_sidebar_id = blade_grve_post_meta( 'grve_sidebar', blade_grve_option( 'page_sidebar' ) );
			$grve_sidebar_layout = blade_grve_post_meta( 'grve_layout', blade_grve_option( 'page_layout', 'none' ) );
		}
	} else {
		$grve_sidebar_id = blade_grve_option( 'blog_sidebar' );
		$grve_sidebar_layout = blade_grve_option( 'blog_layout', 'none' );
	}

	if ( 'none' != $grve_sidebar_layout && ( is_active_sidebar( $grve_sidebar_id ) || $grve_sidebar_extra_content ) ) {

		if ( 'right' == $grve_sidebar_layout ) {
			$grve_sidebar_class = 'grve-right-sidebar';
		} else if ( 'left' == $grve_sidebar_layout ) {
			$grve_sidebar_class = 'grve-left-sidebar';
		}

	}

	return $grve_sidebar_class;

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
