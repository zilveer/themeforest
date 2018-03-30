<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $mpcth_options, $shop_style;

$shop_style = 'default';
if (isset($mpcth_options['mpcth_shop_style']) && $mpcth_options['mpcth_shop_style'])
	$shop_style = $mpcth_options['mpcth_shop_style'];
?>
<section class="products <?php echo 'mpcth-shop-style-' . $shop_style; ?>">