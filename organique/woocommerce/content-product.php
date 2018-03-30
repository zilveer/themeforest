<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $organique_woocommerce_loop;

// Store loop count we're currently on
if ( empty( $organique_woocommerce_loop['loop'] ) ) {
	$organique_woocommerce_loop['loop'] = 0;
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$organique_woocommerce_loop['loop']++;

if ( 1 !== $organique_woocommerce_loop['loop'] &&  1 === $organique_woocommerce_loop['loop'] % 2 ) {
	echo '<div class="clearfix  visible-xs"></div>';
}
if ( 1 !== $organique_woocommerce_loop['loop'] &&  1 === $organique_woocommerce_loop['loop'] % 4 ) {
	echo '<div class="clearfix  hidden-xs"></div>';
}

?>

<div class="col-xs-6 col-sm-3">
	<div <?php post_class( 'products__single' ); ?>>
	<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
	?>

		<figure class="products__image">
			<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog', array( 'class' => 'product__image' ) ); ?></a>
			<div class="product-overlay">
				<a class="product-overlay__more" href="<?php the_permalink(); ?>">
					<span class="glyphicon glyphicon-search"></span>
				</a>
				<?php
					wc_get_template( 'loop/add-to-cart.php' );
				?>
				<div class="product-overlay__stock">
					<span class="<?php echo $product->is_in_stock() ? 'in' : 'out-of'; ?>-stock">&bull;</span> <span class="in-stock--text"><?php echo $product->is_in_stock() ? __( 'In stock', 'organique_wp' ) : __( 'Out of stock', 'organique_wp' ); ?></span>
				</div>
			</div>
		</figure>

		<div class="row">
			<div class="col-xs-12">
				<div class="products__price">
					<?php if ( $price_html = $product->get_price_html() ) : ?>
						<?php echo $price_html;?>
					<?php endif; ?>
				</div>
				<h5 class="products__title">
					<a class="products__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h5>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
