<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action( 'woocommerce_before_single_product' );
require(get_template_directory().'/inc/cb-page-options.php');
?>

<div itemscope itemtype="http://schema.org/Product"
	id="product-<?php the_ID(); ?>" <?php post_class(); ?>>


	<h1 itemprop="name" class="product_title entry-title">
	<?php the_title(); ?>
		<span class="short_desc"><?php echo $prod_slogan; ?> </span>
	</h1>


	<?php
	/**
	 * woocommerce_show_product_images hook
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

	<?php global $woocommerce,$product;
	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
		$count = $product->get_rating_count();

		if ( $count > 0 ) {
			$average = $product->get_average_rating();
			echo '<div itemprop="aggregateRating" class="single_ratings" itemscope itemtype="http://schema.org/AggregateRating">';
			echo '<span class="rating_single">Rating</span> <div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
			echo '<span class="number_reviews">'.sprintf( _n('%s review', '%s reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>','').'</span>';
			echo '<div class="cl"></div></div><div class="cl"></div>';

		}
	}
	?>


	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'Product SKU:', 'woocommerce' ); ?>
			<span class="sku"><?php echo $product->get_sku(); ?></span></span>
			<?php endif; ?>

		<div class="product_short_desc">
		<?php echo $post->post_excerpt; ?>
		</div>

		<?php
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

	</div>
	<!-- .summary -->

	<?php
	/**
	 * woocommerce_after_single_product_summary hook
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

</div>
<!-- #product-<?php the_ID(); ?> -->

	<?php do_action( 'woocommerce_after_single_product' ); ?>