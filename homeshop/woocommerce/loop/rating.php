<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $product;

if (get_option('woocommerce_enable_review_rating') == 'no')
    return;
$num_rating = (int) $product->get_average_rating();


if ($num_rating > 0) {
    ?>
	<div class="rating-box-cat">
	<div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
	<span><?php echo $product->get_rating_count(); ?> <?php _e( 'Review(s)', 'homeshop'); ?></span>
	</div>
    <?php
}


/*
  if ( $rating_html = $product->get_rating_html() ) : ?>
  <?php echo $rating_html; ?>
  <?php endif;
 * */
?>