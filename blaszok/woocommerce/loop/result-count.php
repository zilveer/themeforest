<?php
/**
 * Result Count
 *
 * Shows text: Viewing x - x of x products
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
<p class="woocommerce-result-count">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	if ( 1 == $total ) {
		_e( 'Viewing the single result', 'mpcth' );
	} elseif ( $total <= $per_page || -1 == $per_page ) {
		printf( __( 'Viewing all %d products', 'mpcth' ), $total );
	} else {
		printf( _x( 'Viewing %1$d - %2$d of %3$d products', '%1$d = first, %2$d = last, %3$d = total', 'mpcth' ), $first, $last, $total );
	}
	?>
</p>