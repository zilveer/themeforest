<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || !$product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 )
	return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type' => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows' => 1,
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'post__in' => $related,
	'post__not_in' => array( $product->id )
		) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;
$add_to_cart = '';
if ( $product->is_purchasable() && $product->is_in_stock() ) {
	if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
		$add_to_cart = 'add_to_cart_button ajax_add_to_cart';
	} else {
		$add_to_cart = 'add_to_cart_button';
	}
}
?>

<div class="shop-products">
	<h4 class="subtitle"><i class="fa fa-shopping-bag"></i> <?php esc_html_e( 'Related Products', 'crazyblog' ); ?></h4>
	<div class="row">
		<?php
		if ( $products->have_posts() ) :
			?>
			<div class="related products">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<div class="col-md-4">
						<div class="product-post">
							<div class="product-img">
								<?php the_post_thumbnail( 'crazyblog_470x540' ) ?>
								<span>
									<?php
									echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s"><i class="fa fa-shopping-cart"></i></a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $add_to_cart, esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )
											), $product );
									?>
								</span>
							</div>
							<h5><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h5>
							<?php echo $product->get_price_html() ?>
						</div>
					</div>
				<?php endwhile; // end of the loop.  ?>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>

