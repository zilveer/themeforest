<?php
/**
 * Conditonal functions.
 * These functions load before anything else in the main theme class so they can be used
 * early on in pretty much any hook.
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

/*-------------------------------------------------------------------------------*/
/* [ Table of contents ]
/*-------------------------------------------------------------------------------*

	# Core
	# Header
	# Blog
	# Social Sharing
	# Post Series
	# Taxonomies
	# Terms
	# WooCommerce
	# Authors
	# Visual Composer

/*-------------------------------------------------------------------------------*/
/* [ Core ]
/*-------------------------------------------------------------------------------*/

/**
 * Check if the post edit links should display on the page
 *
 * @since 2.0.0
 */
function wpex_is_retina_enabled() {
	if ( wpex_get_mod( 'image_resizing', true ) && wpex_get_mod( 'retina' ) ) {
		return true;
	}
}

/**
 * Check if the post edit links should display on the page
 *
 * @since 2.0.0
 */
function wpex_has_post_edit() {

	// Display by default
	$return = true;

	// If not singular we can bail completely
	if ( ! is_singular() ) {
		return false;
	}

	// Don't show on front-end composer
	if ( wpex_is_front_end_composer() ) {
		return;
	}

	// Not needed for these pages
	if ( function_exists( 'is_cart' ) && is_cart() ) {
		return;
	}
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		return;
	}

	// Apply filters and return
	return apply_filters( 'wpex_has_post_edit', $return );

}

/**
 * Check if the next/previous links should display
 *
 * @since 2.0.0
 */
function wpex_has_next_prev() {

	// Display by default
	$return = true;

	// Not needed here
	if ( ! is_singular() || is_page() || is_singular( 'attachment' ) ) {
		return false;
	}

	// Check if it should be enabled on standard posts
	if ( is_singular( 'post' ) && ! wpex_get_mod( 'blog_next_prev', true ) ) {
		$return = false;
	}

	// Apply filters
	$return = apply_filters( 'wpex_has_next_prev', $return );

	// Return bool
	return $return;

}

/**
 * Check if the readmore button should display
 *
 * @since 2.1.2
 */
function wpex_has_readmore() {

	// Display by default
	$bool = true;

	// Disable if posts are set to display full content
	if ( 'post' == get_post_type()
		&& ! strpos( get_the_content(), 'more-link' )
		&& ! wpex_get_mod( 'blog_exceprt', true ) ) {
		$bool = false;
	}

	// Don't show for password protected posts
	if ( post_password_required() ) {
		$bool = false;
	}

	// Apply filters
	$bool = apply_filters( 'wpex_has_readmore', $bool );

	// Return bool
	return $bool;

}

/*-------------------------------------------------------------------------------*/
/* [ Header ]
/*-------------------------------------------------------------------------------*/

/**
 * Check if the header supports aside content
 *
 * @since 3.0.0
 */
function wpex_header_supports_aside( $header_style = '' ) {

	// False by default
	$bool = false;

	// Get header style
	$header_style = $header_style ? $header_style : wpex_global_obj( 'header_style' );

	// Validate
	if ( 'two' == $header_style || 'three' == $header_style || 'four' == $header_style ) {
		$bool = true;
	}

	// Apply filters and return
	return apply_filters( 'wpex_header_supports_aside', $bool );

}

/*-------------------------------------------------------------------------------*/
/* [ Blog ]
/*-------------------------------------------------------------------------------*/

/**
 * Returns true if the current Query is a query related to standard blog posts.
 *
 * @since 1.6.0
 */
function wpex_is_blog_query() {

	// False by default
	$bool = false;

	// Return true for blog archives
	if ( is_search() ) {
		$bool = false; // Fixes wp bug
	} elseif (
		is_home()
		|| is_category()
		|| is_tag()
		|| is_date()
		|| is_author()
		|| is_page_template( 'templates/blog.php' )
		|| ( is_tax( 'post_format' ) && 'post' == get_post_type() )
	) {
		$bool = true;
	}

	// Apply filters and return
	return apply_filters( 'wpex_is_blog_query', $bool );

}

/*-------------------------------------------------------------------------------*/
/* [ Social Sharing ]
/*-------------------------------------------------------------------------------*/

/**
 * Checks if there are any social sharing sites enabled
 *
 * @since 1.0.0
 */
function wpex_has_social_share_sites() {
	if ( wpex_social_share_sites() ) {
		return true;
	}
}

/**
 * Checks if the social sharing style supports a custom heading
 *
 * @since 1.0.0
 */
function wpex_social_sharing_supports_heading() {
	$bool = false;
	if ( wpex_social_share_sites() && 'horizontal' == wpex_social_share_position() ) {
		$bool = true;
	}
	$bool = apply_filters( 'wpex_social_sharing_supports_heading', $bool );
	return $bool;
}

/*-------------------------------------------------------------------------------*/
/* [ Post Series ]
/*-------------------------------------------------------------------------------*/

/**
 * Checks if the current post is part of a post series.
 *
 * @since 2.0.0
 */
function wpex_is_post_in_series() {
	if ( ! taxonomy_exists( 'post_series' ) ) {
		return false;
	}
	$terms = get_the_terms( get_the_id(), 'post_series' );
	if ( $terms ) {
		return true;
	} else {
		return false;
	}

}

/*-------------------------------------------------------------------------------*/
/* [ Taxonomies ]
/*-------------------------------------------------------------------------------*/

/**
 * Checks if on a theme portfolio category page.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'wpex_is_portfolio_tax' ) ) {
	function wpex_is_portfolio_tax() {
		if ( ! is_search() && ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme staff category page.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'wpex_is_staff_tax' ) ) {
	function wpex_is_staff_tax() {
		if ( ! is_search() && ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme testimonials category page.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'wpex_is_testimonials_tax' ) ) {
	function wpex_is_testimonials_tax() {
		if ( ! is_search() && ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Terms ]
/*-------------------------------------------------------------------------------*/

/**
 * Check if a post has terms/categories
 *
 * This function is used for the next and previous posts so if a post is in a category it
 * will display next and previous posts from the same category.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_post_has_terms' ) ) {
	function wpex_post_has_terms( $post_id = '', $post_type = '' ) {

		// Default false
		$bool = false;

		// Post data
		$post_id    = $post_id ? $post_id : get_the_ID();
		$post_type  = $post_type ? $post_type : get_post_type( $post_id );

		// Standard Posts
		if ( $post_type == 'post' ) {
			$terms = get_the_terms( $post_id, 'category' );
			if ( $terms ) {
				$bool =  true;
			}
		}

		// Portfolio
		elseif ( 'portfolio' == $post_type ) {
			$terms = get_the_terms( $post_id, 'portfolio_category' );
			if ( $terms ) {
				$bool =  true;
			}
		}

		// Staff
		elseif ( 'staff' == $post_type ) {
			$terms = get_the_terms( $post_id, 'staff_category' );
			if ( $terms ) {
				$bool =  true;
			}
		}

		// Testimonials
		elseif ( 'testimonials' == $post_type ) {
			$terms = get_the_terms( $post_id, 'testimonials_category' );
			if ( $terms ) {
				$bool =  true;
			}
		}

		// Product
		elseif ( WPEX_WOOCOMMERCE_ACTIVE && 'product' == $post_type ) {
			$terms = get_the_terms( $post_id, 'product_category' );
			if ( $terms ) {
				$bool = true;
			}
		}

		return apply_filters( 'wpex_post_has_terms', $bool );

	}
}

/**
 * Check if term description should display above the loop.
 *
 * By default the term description displays in the subheading in the page header,
 * however, there are some built-in settings to enable the term description above the loop.
 * This function returns true if the term description should display above the loop and not in the header.
 *
 * @since 2.0.0
 */
function wpex_has_term_description_above_loop( $return = false ) {

	// Return true for tags and categories only
	if (  'above_loop' == wpex_get_mod( 'category_description_position' )
		&& ( is_category() || is_tag() )
	) {
		$return = true;
	}

	// Apply filters
	$return = apply_filters( 'wpex_has_term_description_above_loop', $return );

	// Return
	return $return;

}

/*-------------------------------------------------------------------------------*/
/* [ WooCommerce ]
/*-------------------------------------------------------------------------------*/

/**
 * Checks if on the WooCommerce shop page.
 *
 * @since 1.6.0
 */
function wpex_is_woo_shop() {
	if ( ! WPEX_WOOCOMMERCE_ACTIVE ) {
		return false;
	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		return true;
	}
}

/**
 * Checks if on a WooCommerce tax.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'wpex_is_woo_tax' ) ) {
	function wpex_is_woo_tax() {
		if ( ! WPEX_WOOCOMMERCE_ACTIVE ) {
			return false;
		} elseif ( ! is_tax() ) {
			return false;
		} elseif ( function_exists( 'is_product_category' ) && function_exists( 'is_product_tag' ) ) {
			if ( is_product_category() || is_product_tag() ) {
				return true;
			}
		}
	}
}

/**
 * Checks if on singular WooCommerce product post.
 *
 * @since 1.6.0
 */
function wpex_is_woo_single() {
	if ( ! WPEX_WOOCOMMERCE_ACTIVE ) {
		return false;
	} elseif ( is_woocommerce() && is_singular( 'product' ) ) {
		return true;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Authors ]
/*-------------------------------------------------------------------------------*/

/**
 * Check if current user has social profiles defined.
 *
 * @since 1.0.0
 */
function wpex_author_has_social() {

	// Get global post object
	global $post;

	// Get post author
	$post_author = ! empty( $post->post_author ) ? $post->post_author : '';

	// Return if there isn't any post author
	if ( ! $post_author ) {
		return;
	}

	if ( get_the_author_meta( 'wpex_twitter', $post_author ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_facebook', $post_author ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_googleplus', $post_author ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_linkedin', $post_author ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_pinterest', $post_author ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_instagram', $post_author ) ) {
		return true;
	} else {
		return false;
	}

}

/*-------------------------------------------------------------------------------*/
/* [ Visual Composer ]
/*-------------------------------------------------------------------------------*/

function wpex_vc_is_inline() {
	if ( function_exists( 'vc_is_inline' ) ) {
		return vc_is_inline();
	}
}