<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div id="woocommerce_product_tabs" class="woocommerce-tabs pix_tabs simple exsimple" data-opts='{"active":0,"type":"tabs","minwidth":<?php echo apply_filters('geode_woo_tabs_width','558'); ?>,"easing":"easeOutSine","speed":250,"fx":"zoomin"}'>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<a href="#tab-<?php echo $key ?>" class='tab header-<?php echo $key ?>'><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
			<div id='tab-<?php echo $key ?>'><?php call_user_func( $tab['callback'], $key, $tab ) ?></div>

		<?php endforeach; ?>
	</div>

<?php endif; ?>