<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $mango_settings;
//print_r($mango_settings);
//exit;
?>
  <?php if ( $mango_settings[ 'mango_show_price' ] ) {
 if ( $price_html = $product->get_price_html() ) : ?>
	<div class="price product-price-container"><?php echo $price_html; ?></div>
<?php endif; 
  }
?>