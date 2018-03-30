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

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$count = 0;

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating product-ratings-container" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating product-ratings" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
            <?php for( $i = 0; $i <(int)$average; $i ++ ) {
                $count ++;
                echo '<span class="star active"></span>';
            }
            if( $average -(int)$average >= 0.5 ) {
                $count ++;
                echo '<span class="star active-half"></span>';
            }
            for( $i = $count; $i < 5; $i ++ ) {
                $count ++;
                echo '<span class="star"></span>';
            } ?>

		</div>
		<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link product-ratings-count" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'mango' ),$review_count ); ?></a><?php endif ?>
	</div>
<?php endif; ?>