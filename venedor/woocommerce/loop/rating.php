<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $venedor_woo_version;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
    
$rating = $product->get_average_rating();
$rating_html = $product->get_rating_html();
$review_count = version_compare($venedor_woo_version, '2.3', '<') ? $product->get_rating_count() : $product->get_review_count();
$count = 0;
if ( $rating_html = $product->get_rating_html() ) : ?>
<div class="ratings">
    <span class="star" data-value="<?php echo $rating ?>" data-toggle="tooltip" data-title="<?php echo $rating ?>">
        <?php 
        for ($i = 0; $i < (int)$rating; $i++) {
            $count++;
            echo '<i class="fa fa-star"></i>';
        }
        if ($rating - (int)$rating >= 0.5) {
            $count++;
            echo '<i class="fa fa-star-half-full"></i>';
        }
        for ($i = $count; $i < 5; $i++) {
            $count++;
            echo '<i class="fa fa-star-o"></i>';
        } ?>
    </span>
    <span class="amount">
        <?php //echo $rating_html; ?>
        <a href="<?php echo get_permalink($product->id) ?>#reviews" id="goto-reviews"><?php echo $review_count . ' ' . __('Reviews', 'venedor'); ?></a><span class="gap">|</span><a href="<?php echo get_permalink($product->id) ?>#review-form" id="goto-review-form"><?php echo __('Add Your Review', 'venedor') ?></a>
    </span>
</div>
<?php endif; ?>
