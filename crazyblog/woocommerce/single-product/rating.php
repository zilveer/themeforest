<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();

if ( $rating_count > 0 ) :
	?>
	<div class="product-reviews">
		<div class="star">
			<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'crazyblog' ), $average ); ?>">
					<span style="width:<?php echo esc_attr( ( ( $average / 5 ) * 100 ) ); ?>%">
						<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'crazyblog' ), '<span itemprop="bestRating">', '</span>' ); ?>
						<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'crazyblog' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
					</span>
				</div>
			</div>
		</div>
		<?php if ( comments_open() ) : ?>
			<div class="add-review">
				<span><?php printf( _n( 'Review (%d)', 'Reviews (%d)', $review_count, 'crazyblog' ), $review_count ) ?></span>
				<a href="#reviews" rel="nofollow" title=""><?php esc_html_e( 'Add Your Review', 'crazyblog' ) ?></a>
			</div>
		<?php endif ?>

	</div>

<?php endif; ?>
