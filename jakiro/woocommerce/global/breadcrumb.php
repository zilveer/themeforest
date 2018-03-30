<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query;

$prepend      = '';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );

// If permalinks contain the shop page in the URI prepend the breadcrumb with shop
if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) !== $shop_page_id ) {
	$prepend = dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_permalink( $shop_page ) . '" property="v:title" rel="v:url"><span>' . $shop_page->post_title . '</span></a></span> ' . dh_print_string($after) . $delimiter;
}

if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) ) || is_paged() ) {

	echo dh_print_string($wrap_before);

	if ( ! empty( $home ) ) {
		echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '" property="v:title" rel="v:url"><span>' . $home . '</span></a></span>' . dh_print_string($after) . $delimiter;
	}

	if ( is_category() ) {

		$cat_obj = $wp_query->get_queried_object();
		$this_category = get_category( $cat_obj->term_id );

		if ( $this_category->parent != 0 ) {
			$parent_category = get_category( $this_category->parent );
			echo get_category_parents($parent_category, TRUE, $delimiter );
		}

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. single_cat_title( '', false ) .'</span>'. dh_print_string($after);

	} elseif ( is_tax( 'product_cat' ) ) {

		echo dh_print_string($prepend);

		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

			echo dh_print_string($before) .  '<span typeof="v:Breadcrumb"><a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '" property="v:title" rel="v:url"><span>' . esc_html( $ancestor->name ) . '</span></a></span>' . dh_print_string($after) . $delimiter;
		}

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html( $current_term->name ) .'</span>'. dh_print_string($after);
	} elseif ( is_tax( 'product_brand' ) ) {
	
		$queried_object = $wp_query->get_queried_object();
		echo dh_print_string($prepend) . dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Products brands &ldquo;', 'jakiro' ) . $queried_object->name . '&rdquo;' .'</span>'. dh_print_string($after);
	
	} elseif ( is_tax( 'product_tag' ) ) {

		$queried_object = $wp_query->get_queried_object();
		echo dh_print_string($prepend) . dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Products tagged &ldquo;', 'jakiro' ) . $queried_object->name . '&rdquo;' .'</span>'. dh_print_string($after);

	} elseif ( is_day() ) {

		echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '" property="v:title" rel="v:url"><span>' . get_the_time( 'Y' ) . '</span></a></span>' . dh_print_string($after) . $delimiter;
		echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" property="v:title" rel="v:url"><span>' . get_the_time( 'F' ) . '</span></a></span>' . dh_print_string($after) . $delimiter;
		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_time( 'd' ) .'</span>'. dh_print_string($after);

	} elseif ( is_month() ) {

		echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '" property="v:title" rel="v:url"><span>' . get_the_time( 'Y' ) . '</span></a></span>' . dh_print_string($after) . $delimiter;
		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_time( 'F' ) .'</span>'. dh_print_string($after);

	} elseif ( is_year() ) {

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_time( 'Y' ) .'</span>'. dh_print_string($after);

	} elseif ( is_post_type_archive( 'product' ) && get_option( 'page_on_front' ) !== $shop_page_id ) {

		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

		if ( ! $_name ) {
			$product_post_type = get_post_type_object( 'product' );
			$_name = $product_post_type->labels->singular_name;
		}

		if ( is_search() ) {

			//echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( 'product' ) . '" property="v:title" rel="v:url"><span>' . $_name . '</span></a></span>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'jakiro' ) . get_search_query() . '&rdquo;' . dh_print_string($after);
			echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( 'product' ) . '" property="v:title" rel="v:url"><span>' . $_name . '</span></a></span>' . dh_print_string($after);
			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Search results for &ldquo;','jakiro' ) . get_search_query() . '&rdquo;'  .'</span>'. dh_print_string($after);
			
		} elseif ( is_paged() ) {

			echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( 'product' ) . '" property="v:title" rel="v:url"><span>' . $_name . '</span></a></span>' . dh_print_string($after);

		} else {

			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. $_name .'</span>'. dh_print_string($after);

		}

	} elseif ( is_single() && ! is_attachment() ) {

		if ( get_post_type() == 'product' ) {

			echo dh_print_string($prepend);

			if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {

				$main_term = $terms[0];

				$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );

				$ancestors = array_reverse( $ancestors );

				foreach ( $ancestors as $ancestor ) {
					$ancestor = get_term( $ancestor, 'product_cat' );

					if ( ! is_wp_error( $ancestor ) && $ancestor )
						echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_term_link( $ancestor->slug, 'product_cat' ) . '" property="v:title" rel="v:url"><span>' . $ancestor->name . '</span></a></span>' . dh_print_string($after) . $delimiter;
				}

				echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_term_link( $main_term->slug, 'product_cat' ) . '" property="v:title" rel="v:url"><span>' . $main_term->name . '</span></a></span>' . dh_print_string($after) . $delimiter;

			}

			echo dh_print_string($before).'<span typeof="v:Breadcrumb" property="v:title">' . get_the_title() .'</span>'. dh_print_string($after);

		} elseif ( get_post_type() != 'post' ) {

			$post_type = get_post_type_object( get_post_type() );
			$slug = $post_type->rewrite;
				echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( get_post_type() ) . '" property="v:title" rel="v:url"><span>' . $post_type->labels->singular_name . '</span></a></span>' . dh_print_string($after) . $delimiter;
			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_title() .'</span>'. dh_print_string($after);

		} else {

			$cat = current( get_the_category() );
			echo get_category_parents( $cat, true, $delimiter );
			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_title() .'</span>'. dh_print_string($after);

		}

	} elseif ( is_404() ) {

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Error 404', 'jakiro' ) .'</span>'. dh_print_string($after);

	} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

		$post_type = get_post_type_object( get_post_type() );

		if ( $post_type )
			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. $post_type->labels->singular_name .'</span>'. dh_print_string($after);

	} elseif ( is_attachment() ) {

		$parent = get_post( $post->post_parent );
		$cat = get_the_category( $parent->ID );
		$cat = $cat[0];
		echo get_category_parents( $cat, true, '' . $delimiter );
		echo dh_print_string($before) . '<span typeof="v:Breadcrumb"><a href="' . get_permalink( $parent ) . '" property="v:title" rel="v:url"><span>' . $parent->post_title . '</span></a></span>' . dh_print_string($after) . $delimiter;
		echo dh_print_string($before) . get_the_title() . dh_print_string($after);

	} elseif ( is_page() && !$post->post_parent ) {

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. get_the_title() .'</span>'. dh_print_string($after);

	} elseif ( is_page() && $post->post_parent ) {

		$parent_id  = $post->post_parent;
		$breadcrumbs = array();

		while ( $parent_id ) {
			$page = get_page( $parent_id );
			$breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="' . get_permalink($page->ID) . '" property="v:title" rel="v:url"><span>' . get_the_title( $page->ID ) . '</span></a></span>';
			$parent_id  = $page->post_parent;
		}

		$breadcrumbs = array_reverse( $breadcrumbs );

		foreach ( $breadcrumbs as $crumb )
			echo dh_print_string($crumb) . '' . $delimiter;

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">' . get_the_title() .'</span>'. dh_print_string($after);

	} elseif ( is_search() ) {

		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Search results for &ldquo;', 'jakiro' ) . get_search_query() . '&rdquo;'.'</span>'. dh_print_string($after);

	} elseif ( is_tag() ) {

			echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Posts tagged &ldquo;', 'jakiro' ) . single_tag_title('', false) . '&rdquo;' .'</span>'. dh_print_string($after);

	} elseif ( is_author() ) {

		$userdata = get_userdata($author);
		echo dh_print_string($before) .'<span typeof="v:Breadcrumb" property="v:title">'. esc_html__( 'Author:', 'jakiro' ) . ' ' . $userdata->display_name .'</span>'. dh_print_string($after);

	}

// 	if ( get_query_var( 'paged' ) )
// 		echo '<span typeof="v:Breadcrumb" property="v:title">'. ' (' . esc_html__( 'Page', 'jakiro' ) . ' ' . get_query_var( 'paged' ) . ')'.'</span>';

	echo dh_print_string($wrap_after);

}