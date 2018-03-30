<?php
/**
 * Product Quick view
 *
 * @author 		Transvelo
 * @package 	Unicase/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<?php
	$args = array(
		'post_type' => 'product',
		'post__in' 	=> array( $id ),
	);

	$products = new WP_Query( $args );
?>
<?php if ( $products->have_posts() ) : ?>
<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	<div class="primary-block product-single single-product">
		<div class="row product-item product">
			<div class="col-lg-6 col-sm-5 col-product-image">
				<?php woocommerce_show_product_images(); ?>
			</div>
			<div class="col-lg-6 col-sm-7 col-product-detail text-left summary flip">
				<h2 class="product-title product_title"><?php the_title(); ?></h2>
				<?php woocommerce_template_loop_price(); ?>
				<?php woocommerce_template_single_rating(); ?>
				<?php woocommerce_template_single_excerpt(); ?>
				<?php unicase_single_product_add_to_cart(); ?>
				<?php unicase_single_product_share_icons(); ?>
				<a href="<?php the_permalink(); ?>" class="see-full-detail"><?php echo esc_html__( 'See full details', 'unicase' ) ?><i class="fa fa-angle-right full-detail-icon"></i></a>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>