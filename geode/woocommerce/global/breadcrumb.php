<?php
/**
 * Breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query;

$shop_page_id = pix_is_woocommerce_active() ? woocommerce_get_page_id( 'shop' ) : '';
$shop_page = get_post( $shop_page_id );
$delimiter = ' / ';
$before = '';
$after = '';
$prepend = '';
$wrap_after = '';

if ( ( ! is_front_page() && ! ( pix_is_woocommerce_active() && is_post_type_archive() && get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) ) || is_paged() ) {

	echo '<nav id="breadcrumbs">';

	echo '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . __('Home', 'geode') .'</a>' . $delimiter;

	if ( is_home() ) {

		echo $before . single_post_title('', false) . $after;

	} elseif ( is_category() ) {

		$cat_obj = $wp_query->get_queried_object();
		$this_category = get_category( $cat_obj->term_id );

		if ( 0 != $this_category->parent ) {
			$parent_category = get_category( $this_category->parent );
			if ( ( $parents = get_category_parents( $parent_category, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
				echo $before . rtrim( $parents, $after . $delimiter . $before ) . $after . $delimiter;
			}
		}

		echo $before . single_cat_title( '', false ) . $after;

	} elseif ( is_tax( 'portfolio_category' ) ) { /*pixedelic*/

		$post_type = get_post_type_object( get_post_type() );
		echo '<a href="' . apply_filters('geode_portfolio_base', get_post_type_archive_link( get_post_type() )) . '">' . apply_filters('geode_portfolio_base_name', $post_type->labels->singular_name) . '</a>' . $delimiter;
		echo $prepend;

		$current_term = $wp_query->get_queried_object();

		$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'portfolio_category' ) );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'portfolio_category' );

			echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after . $delimiter;
		}

		echo $before . esc_html( $current_term->name ) . $after;

	} elseif ( is_tax( 'portfolio_tag' ) ) {

		$post_type = get_post_type_object( get_post_type() );
		echo '<a href="' . apply_filters('geode_portfolio_base', get_post_type_archive_link( get_post_type() )) . '">' . apply_filters('geode_portfolio_base_name', $post_type->labels->singular_name) . '</a>' . $delimiter;

		$queried_object = $wp_query->get_queried_object();
		echo $prepend . $before . $queried_object->name . $after;

	} elseif ( is_tax( 'product_cat' ) ) {

		echo $prepend;

		$current_term = $wp_query->get_queried_object();

		$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'product_cat' ) );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'product_cat' );

			echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after . $delimiter;
		}

		echo $before . esc_html( $current_term->name ) . $after;

	} elseif ( is_tax( 'product_tag' ) ) {

		$queried_object = $wp_query->get_queried_object();
		echo $prepend . $before . __( 'Products tagged &ldquo;', 'geode' ) . $queried_object->name . '&rdquo;' . $after;

	} elseif ( is_day() ) {

		echo $before . '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $after . $delimiter;
		echo $before . '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $after . $delimiter;
		echo $before . get_the_time( 'd' ) . $after;

	} elseif ( is_month() ) {

		echo $before . '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $after . $delimiter;
		echo $before . get_the_time( 'F' ) . $after;

	} elseif ( is_year() ) {

		echo $before . get_the_time( 'Y' ) . $after;

	} elseif ( is_post_type_archive( 'product' ) && get_option( 'page_on_front' ) !== $shop_page_id ) {

		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

		if ( ! $_name ) {
			$product_post_type = get_post_type_object( 'product' );
			$_name = $product_post_type->labels->singular_name;
		}

		if ( is_search() ) {

			echo $before . '<a href="' . get_post_type_archive_link( 'product' ) . '">' . $_name . '</a>' . $delimiter . __( 'Search results for &ldquo;', 'geode' ) . get_search_query() . '&rdquo;' . $after;

		} elseif ( is_paged() ) {

			echo $before . '<a href="' . get_post_type_archive_link( 'product' ) . '">' . $_name . '</a>' . $after;

		} else {

			echo $before . $_name . $after;

		}

	} elseif ( is_single() && ! is_attachment() ) {

		if ( get_post_type() == 'product' ) {

			echo $prepend;

			echo $before . '<a href="' . get_permalink( $shop_page_id ) . '">' . get_the_title( $shop_page_id ) . '</a>' . $after . $delimiter;

			if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
				$main_term = $terms[0];
				$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
				$ancestors = array_reverse( $ancestors );


				foreach ( $ancestors as $ancestor ) {
					$ancestor = get_term( $ancestor, 'product_cat' );

					if ( ! is_wp_error( $ancestor ) && $ancestor ) {
						echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after . $delimiter;
					}
				}

				echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after . $delimiter;

			}

			echo $before . get_the_title() . $after;

		} elseif ( get_post_type() == 'portfolio' ) {

			$post_type = get_post_type_object( get_post_type() );
			$slug = $post_type->rewrite;
				echo '<a href="' . apply_filters('geode_portfolio_base', get_post_type_archive_link( get_post_type() )) . '">' . apply_filters('geode_portfolio_base_name', $post_type->labels->singular_name) . '</a>' . $delimiter;
				echo get_the_term_list_breadcrumbs( $post->ID, 'portfolio_category', '', $delimiter, $delimiter, $delimiter );
			echo get_the_title();

		} elseif ( get_post_type() == 'team' ) {

			echo get_the_title();

		} elseif ( get_post_type() != 'post' && get_post_type() != 'portfolio' && get_post_type() != 'product' ) {

			$post_type = get_post_type_object( get_post_type() );
			$slug = $post_type->rewrite;
			echo $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
			echo $before . get_the_title() . $after;

		} else {

			$cat = current( get_the_category() );
			if ( ( $parents = get_category_parents( $cat, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
				echo $before . rtrim( $parents, $after . $delimiter . $before ) . $after . $delimiter;
			}
			echo $before . get_the_title() . $after;

		}

	} elseif ( is_404() ) {

		echo $before . __( 'Error 404', 'geode' ) . $after;

	} elseif ( is_attachment() ) {

		$parent = get_post( $post->post_parent );
		$cat = get_the_category( $parent->ID );
		$cat = $cat[0];
		if ( ( $parents = get_category_parents( $cat, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
			echo $before . rtrim( $parents, $after . $delimiter . $before ) . $after . $delimiter;
		}
		echo $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after . $delimiter;
		echo $before . get_the_title() . $after;

	} elseif ( is_page() && ! $post->post_parent ) {

		echo $before . get_the_title() . $after;

	} elseif ( is_page() && $post->post_parent ) {

		$parent_id  = $post->post_parent;
		$breadcrumbs = array();

		while ( $parent_id ) {
				$page = get_page( $parent_id );
				if ( get_option( 'page_on_front' ) != $page->ID )
					$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
		}

		$breadcrumbs = array_reverse( $breadcrumbs );

		foreach ( $breadcrumbs as $crumb ) {
			echo $before . $crumb . $after . $delimiter;
		}

		echo $before . get_the_title() . $after;

	} elseif ( is_search() ) {

		echo $before . __( 'Search results for &ldquo;', 'geode' ) . get_search_query() . '&rdquo;' . $after;

	} elseif ( is_tag() ) {

			echo $before . __( 'Posts tagged &ldquo;', 'geode' ) . single_tag_title( '', false ) . '&rdquo;' . $after;

	} elseif ( is_author() ) {

		$user_id = get_current_user_id();
		$userdata = get_userdata( $user_id );
		echo $before . __( 'Author:', 'geode' ) . ' ' . $userdata->display_name . $after;

	} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

		$post_type = get_post_type_object( get_post_type() );

		if ( $post_type ) {
			echo $before . $post_type->labels->singular_name . $after;
		}

	}

	if ( get_query_var( 'paged' ) ) {
		echo ' (' . __( 'Page', 'geode' ) . ' ' . get_query_var( 'paged' ) . ')';
	}

	echo $wrap_after;

	echo '</nav>';

}