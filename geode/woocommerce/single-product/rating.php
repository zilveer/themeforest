<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes (Pixedelic)
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();

if ( $count > 0 ) : ?>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'geode' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'geode' ); ?>
			</span>
		</div>
		<?php if ( comments_open() ) : ?><a href="#woocommerce_product_tabs" class="woocommerce-review-link pixscroll" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'geode' ), '<span itemprop="ratingCount" class="count">' . $review_count . '</span>' ); ?></a></a><?php endif ?>
	</div>

<?php endif; ?>