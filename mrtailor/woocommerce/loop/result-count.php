<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<div class="medium-8 columns">
	<div class="filter_products_container">
	
		<a id="button_offcanvas_sidebar_left" class="filters_button"><?php _e( 'Filter', 'woocommerce' )?></a>
		
		<span class="woocommerce-result-count">
			<?php
			$paged    = max( 1, $wp_query->get( 'paged' ) );
			$per_page = $wp_query->get( 'posts_per_page' );
			$total    = $wp_query->found_posts;
			$first    = ( $per_page * $paged ) - $per_page + 1;
			$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
		
			if ( 1 == $total ) {
				_e( 'Showing the single result', 'woocommerce' );
			} elseif ( $total <= $per_page || -1 == $per_page ) {
				printf( _n( 'Showing the single result', 'Showing all %d results', $total, 'woocommerce' ), $total );
			} else {
				printf( _nx( 'Showing the single result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
			}
			?>
		</span>
	
	</div><!-- .filter_products_container-->
</div><!-- .columns-->