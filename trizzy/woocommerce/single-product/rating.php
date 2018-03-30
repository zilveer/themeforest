<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$count   = $product->get_rating_count();
$average = $product->get_average_rating();
$avclass = trizzy_get_rating_class($average);

if ( $count > 0 ) : ?>

	<div class="woocommerce-product-rating reviews-counter" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating rating <?php echo $avclass; ?>" title="<?php printf( __( 'Rated %s out of 5', 'trizzy' ), $average ); ?>">
            <div class="star-rating"></div>
            <div class="star-bg"></div>
		</div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $count, 'trizzy' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?></a>
	</div>

<?php endif; ?>