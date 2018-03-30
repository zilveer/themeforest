<?php
/**
 * Single Product tabs
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $tabs ) ) : ?>
	<?php
	$i = 1;
	foreach ( $tabs as $key => $tab ) :
		if ( $i != 1 ) {
			echo '<div class="container">';
		}
		call_user_func( $tab['callback'], $key, $tab );
 		if ( $i != 1 ) {
			echo '</div>';
		}
	$i ++;
	endforeach; ?>
<?php
endif; ?>
