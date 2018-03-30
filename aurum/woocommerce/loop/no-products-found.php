<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$class = 'col-sm-12';

if(SHOP_SIDEBAR)
{
	$class = 'col-md-9 col-sm-8';

	if(get_data('shop_sidebar') == 'left')
		$class .= ' pull-right-md';
}
?>
<div class="<?php echo $class; ?>">

	<p class="woocommerce-info"><?php _e( 'No products were found matching your selection.', 'aurum' ); ?></p>
</div>