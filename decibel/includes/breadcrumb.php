<?php
/**
 * Breadcrumb
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_breadcrumb' ) ) {
	/**
	* Breadcrumb function
	*/
	function wolf_breadcrumb() {

		global $post, $wp_query;

		if ( ! is_front_page() ) {

			$delimiter = ' / ';
			$before = '';
			$after = '';

			echo '<a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			_e( 'Home', 'wolf' );
			echo "</a> / ";

			if ( 'post' == get_post_type() && ! wolf_is_blog_index() ) {

				echo '<a href="' . get_permalink( wolf_get_blog_id() ) . '">' . get_the_title( wolf_get_blog_id() ) . '</a>';
					echo sanitize_text_field( $delimiter );
			}

			if ( wolf_is_woocommerce() && is_shop() ) {
				echo get_the_title( wolf_get_woocommerce_shop_page_id() );
			}

			if ( wolf_is_woocommerce() && is_product_category() ) {

				$shop_page_id = wc_get_page_id( 'shop' );
				echo '<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . get_the_title( $shop_page_id ) . '</a>' . $delimiter;

				$current_term = $wp_query->get_queried_object();
				$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'product_cat' ) );

				foreach ( $ancestors as $ancestor ) {
					$ancestor = get_term( $ancestor, 'product_cat' );

					echo '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a>' . $delimiter;
				}

				echo $before . esc_html( $current_term->name ) . $after;
			}

			if ( wolf_is_woocommerce() && is_product_tag() ) {

				$shop_page_id = wc_get_page_id( 'shop' );
				echo '<a href="' . get_permalink( $shop_page_id ) . '">' . get_the_title( $shop_page_id ) . '</a>' . $delimiter;
				$queried_object = $wp_query->get_queried_object();
				echo$before . __( 'Products tagged &ldquo;', 'wolf' ) . $queried_object->name . '&rdquo;' . $after;
			}

			if ( is_category() ) {

				$cat_obj = $wp_query->get_queried_object();
				$this_category = get_category( $cat_obj->term_id );

				if ( 0 != $this_category->parent ) {
					$parent_category = get_category( $this_category->parent );
					if ( ( $parents = get_category_parents( $parent_category, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
						echo $before . rtrim( $parents, $after . $delimiter . $before ) . $after . $delimiter;
					}
				}

				echo $before . single_cat_title( '', false ) . $after;

			} elseif ( is_tag() ) {

				echo get_the_tag_list( '', $delimiter);

			} elseif ( is_author() ) {
				echo get_the_author();

			} elseif ( is_day() ) {
				echo get_the_date();

			} elseif ( is_month() ) {
				echo get_the_date( 'F Y' );

			} elseif ( is_year() ) {
				echo get_the_date( 'Y' );

			} elseif( is_tax( 'work_type' ) ) {

				$portfolio_page_id = wolf_portfolio_get_page_id();
				echo '<a href="' . get_permalink( $portfolio_page_id ) . '">' . get_the_title( $portfolio_page_id ) . '</a>' . $delimiter;

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;
				}

			} elseif( is_tax( 'gallery_type' ) ) {

				$albums_page_id = wolf_albums_get_page_id();
				echo '<a href="' . get_permalink( $albums_page_id ) . '">' . get_the_title( $albums_page_id ) . '</a>' . $delimiter;

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;
				}

			} elseif( is_tax( 'video_type' ) ) {

				$videos_page_id = wolf_videos_get_page_id();
				echo '<a href="' . get_permalink( $videos_page_id ) . '">' . get_the_title( $videos_page_id ) . '</a>' . $delimiter;

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;
				}

			} elseif( is_tax( 'plugin_cat' ) ) {

				$plugins_page_id = wolf_plugins_get_page_id();
				echo '<a href="' . get_permalink( $plugins_page_id ) . '">' . get_the_title( $plugins_page_id ) . '</a>' . $delimiter;

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;

				}

			} elseif( is_tax( 'theme_cat' ) ) {

				$themes_page_id = wolf_themes_get_page_id();
				echo '<a href="' . get_permalink( $themes_page_id ) . '">' . get_the_title( $themes_page_id ) . '</a>' . $delimiter;

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;

				}

			} elseif ( is_tax() && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) ) {

				$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

					echo $wp_query->queried_object->name;

				}

			} elseif ( is_search() )  {
				_e( 'Search', 'wolf' );
			}

			if ( is_attachment() ) {

				_e( 'Attachment', 'wolf' );
				echo sanitize_text_field( $delimiter );
				echo empty( $post->post_parent ) ? get_the_title() : '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a> / ' . get_the_title();

			} elseif ( is_page() ) {

				echo empty( $post->post_parent ) ? get_the_title() : '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a> / ' . get_the_title();
			}

			if ( is_single() ) {

				if ( is_singular( 'work' ) ) {

					echo '<a href="' . get_permalink( wolf_portfolio_get_page_id() ) . '">' . get_the_title( wolf_portfolio_get_page_id() ) . '</a>';
					echo sanitize_text_field( $delimiter );

					echo get_the_term_list( $post->ID, 'work_type', '', $delimiter, '');

					if ( has_term( '', 'work_type' ) )
						echo sanitize_text_field( $delimiter );

				} elseif ( is_singular( 'video' ) ) {

					echo '<a href="' . get_permalink( wolf_videos_get_page_id() ) . '">' . get_the_title( wolf_videos_get_page_id() ) . '</a>';
					echo sanitize_text_field( $delimiter );

					echo get_the_term_list( $post->ID, 'video_type', '', $delimiter, '');

					if ( has_term( '', 'video_type' ) )
						echo sanitize_text_field( $delimiter );

				} elseif ( is_singular( 'gallery' ) ) {

					echo '<a href="' . get_permalink( wolf_albums_get_page_id() ) . '">' . get_the_title( wolf_albums_get_page_id() ) . '</a>';
					echo sanitize_text_field( $delimiter );

					echo get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '');

					if ( has_term( '', 'gallery_type' ) )
						echo sanitize_text_field( $delimiter );

				} elseif ( is_singular( 'plugin' ) ) {

					echo '<a href="' . get_permalink( wolf_plugins_get_page_id() ) . '">' . get_the_title( wolf_plugins_get_page_id() ) . '</a>';
					echo sanitize_text_field( $delimiter );

					echo get_the_term_list( $post->ID, 'plugin_cat', '', $delimiter, '');

					if ( has_term( '', 'plugin_cat' ) )
						echo sanitize_text_field( $delimiter );

				} elseif ( is_singular( 'product' ) ) {

					echo '<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . get_the_title( wc_get_page_id( 'shop' ) ) . '</a>';
					echo sanitize_text_field( $delimiter );

					if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
						$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
						$ancestors = array_reverse( $ancestors );

						foreach ( $ancestors as $ancestor ) {
							$ancestor = get_term( $ancestor, 'product_cat' );

							if ( ! is_wp_error( $ancestor ) && $ancestor ) {
								echo '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $delimiter;
							}
						}

						echo '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a> / ';
					}

				} elseif ( is_singular( 'show' ) ) {

					// echo '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title( get_the_ID() ) . '</a>';
					// echo sanitize_text_field( $delimiter );

					// echo get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '');

					// if ( has_term( '', 'gallery_type' ) )
					// 	echo sanitize_text_field( $delimiter );

				} else {
					the_category($delimiter);
					echo sanitize_text_field( $delimiter );
				}

				the_title();

			} elseif (
				$wp_query && isset($wp_query->queried_object->ID)
				&& $wp_query->queried_object->ID == get_option( 'page_for_posts' )
			) {

				echo $wp_query->queried_object->post_title;

			}
		}
	}
}
