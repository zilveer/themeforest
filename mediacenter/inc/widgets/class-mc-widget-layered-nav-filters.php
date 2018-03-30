<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MC Layered Navigation Filters Widget.
 *
 * @author   Transvelo
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget_Layered_Nav_Filters
 */
class MC_Widget_Layered_Nav_Filters extends WC_Widget_Layered_Nav_Filters {

	public function __construct() {
		$this->widget_name        = __( 'MC WooCommerce Layered Nav Filters', 'mediacenter' );
		parent::__construct();
	}

	public function widget( $args, $instance ) {
		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$min_price          = isset( $_GET['min_price'] ) ? wc_clean( $_GET['min_price'] )   : 0;
		$max_price          = isset( $_GET['max_price'] ) ? wc_clean( $_GET['max_price'] )   : 0;
		$min_rating         = isset( $_GET['min_rating'] ) ? absint( $_GET['min_rating'] ) : 0;
		$_chosen_brands     = mc_get_chosen_brands();

		if ( 0 < count( $_chosen_attributes ) || 0 < $min_price || 0 < $max_price || 0 < $min_rating || 0 < count( $_chosen_brands ) ) {

			$this->widget_start( $args, $instance );

			echo '<ul>';

			// Attributes
			if ( ! empty( $_chosen_attributes ) ) {
				foreach ( $_chosen_attributes as $taxonomy => $data ) {
					foreach ( $data['terms'] as $term_slug ) {
						if ( ! $term = get_term_by( 'slug', $term_slug, $taxonomy ) ) {
							continue;
						}

						$filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
						$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
						$current_filter = array_map( 'sanitize_title', $current_filter );
						$new_filter      = array_diff( $current_filter, array( $term_slug ) );

						$link = remove_query_arg( array( 'add-to-cart', $filter_name ) );

						if ( sizeof( $new_filter ) > 0 ) {
							$link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
						}

						echo '<li class="chosen"><a title="' . esc_attr__( 'Remove filter', 'mediacenter' ) . '" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a></li>';
					}
				}
			}

			// Brands
			if ( ! empty( $_chosen_brands ) ) {
				foreach ( $_chosen_brands as $taxonomy => $data ) {
					foreach ( $data['terms'] as $term_slug ) {
						if ( ! $term = get_term_by( 'slug', $term_slug, $taxonomy ) ) {
							continue;
						}

						$filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
						$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
						$current_filter = array_map( 'sanitize_title', $current_filter );
						$new_filter      = array_diff( $current_filter, array( $term_slug ) );

						$link = remove_query_arg( array( 'add-to-cart', $filter_name ) );

						if ( sizeof( $new_filter ) > 0 ) {
							$link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
						}

						echo '<li class="chosen"><a title="' . esc_attr__( 'Remove filter', 'mediacenter' ) . '" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a></li>';
					}
				}
			}

			if ( $min_price ) {
				$link = remove_query_arg( 'min_price' );
				echo '<li class="chosen"><a title="' . esc_attr__( 'Remove filter', 'mediacenter' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'mediacenter' ) . ' ' . wc_price( $min_price ) . '</a></li>';
			}

			if ( $max_price ) {
				$link = remove_query_arg( 'max_price' );
				echo '<li class="chosen"><a title="' . esc_attr__( 'Remove filter', 'mediacenter' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'mediacenter' ) . ' ' . wc_price( $max_price ) . '</a></li>';
			}

			if ( $min_rating ) {
				$link = remove_query_arg( 'min_rating' );
				echo '<li class="chosen"><a title="' . esc_attr__( 'Remove filter', 'mediacenter' ) . '" href="' . esc_url( $link ) . '">' . sprintf( __( 'Rated %s and above', 'mediacenter' ), $min_rating ) . '</a></li>';
			}

			echo '</ul>';

			$this->widget_end( $args );
		}
	}
}
