<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;

$order_by = (isset($wp_query->query['orderby'])) ? $wp_query->query['orderby'] : '';
?>

<div class="product-ordering">
	
	<div class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="title">
			<?php 
				switch ($order_by) {
					case 'popularity':
						_e( 'Sort by popularity', 'dfd' );
						break;
					case 'date':
						_e( 'Sort by newness', 'dfd' );
						break;
					case 'price':
						_e( 'Sort by price: low to high', 'dfd' );
						break;
					case 'price-desc':
						_e( 'Sort by price: high to low', 'dfd' );
						break;
					default:
						_e( 'Default sorting', 'dfd' );
						break;
				}
			?>
		</span><span class="arrows"></span></a>

		<ul class="dropdown-menu pull-right" role="menu">
			<?php if ( isset($wp_query->query['orderby']) ) : ?>
			<li>
				<a href="<?php echo remove_query_arg('orderby') ?>"><?php echo __( 'Default sorting', 'dfd' ) ?></a>
			</li>
			<?php endif; ?>
			<li>
				<a href="<?php echo add_query_arg(array('orderby' => 'popularity')) ?>"><?php echo __( 'Sort by popularity', 'dfd' ) ?></a>
			</li>
			<li>
				<a href="<?php echo add_query_arg(array('orderby' => 'date')) ?>"><?php echo __( 'Sort by newness', 'dfd' ) ?></a>
			</li>
			<li>
				<a href="<?php echo add_query_arg(array('orderby' => 'price')) ?>"><?php echo __( 'Sort by price: low to high', 'dfd' ) ?></a>
			</li>
			<li>
				<a href="<?php echo add_query_arg(array('orderby' => 'price-desc')) ?>"><?php echo __( 'Sort by price: high to low', 'dfd' ) ?></a>
			</li>
		</ul>
	</div>

</div>

<div class="clear"></div>

