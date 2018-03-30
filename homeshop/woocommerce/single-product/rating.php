<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$count   = $product->get_rating_count();
$average = $product->get_average_rating();

if ( $count > 0 ) : ?>

	<div class="rating-box" style="float:none;" >
		<div class="rating readonly-rating" data-score="<?php echo $average; ?>"></div>
		<span><?php echo $count; ?> <?php _e( 'Review(s)', 'homeshop' ) ?></span>
	</div>



<?php endif; ?>