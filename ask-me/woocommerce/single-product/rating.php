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
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<?php global $post,$product;$cat_count = sizeof(get_the_terms($post->ID,'product_cat'));
		$posts_meta = vpanel_options("post_meta");
		$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
			echo $product->get_categories( ', ', '<h4 class="posted_in">' . _n( 'Category :', 'Categories :', $cat_count, 'woocommerce' ) . ' ', '.</h4>' );?>
			<h4><?php _e('Reviews :', 'vbegy'); ?>	</h4>
			<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
				<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
					<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'woocommerce' ), '<span itemprop="bestRating">', '</span>' ); ?>
					<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'woocommerce' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
				</span>
			</div>
			<!--
			<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $rating_count, 'woocommerce' ), '<span itemprop="reviewCount" class="count">' . $rating_count . '</span>' ); ?>)</a><?php endif ?>
			-->
		<?php }?>
	</div>

<?php endif; ?>
