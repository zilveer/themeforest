<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
	
?>
	<?php 
	$num_rating = (int) $product->get_average_rating();
	?>


	<div class="shop-rating read-only" data-score="<?php echo $num_rating; ?>"></div>
