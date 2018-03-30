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
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<?php 

wp_enqueue_style('vendor-magnific-popup');
wp_enqueue_script('vendor-magnific-popup');
wp_enqueue_script('vendor-carouFredSel');

$img_col = 'col-md-6';
$sum_col = 'col-md-6';
$header_style = dh_get_theme_option('header-style','classic');
if($header_style == 'sidebar'){
	$img_col = 'col-md-7';
	$sum_col = 'col-md-5';
}
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="<?php echo esc_attr($img_col)?> col-sm-6">
			<div class="single-product-images">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			</div>
		</div>
		<div class="<?php echo esc_attr($sum_col)?> col-sm-6">
			<div class="summary entry-summary">
				<?php 
					$product_prev = get_adjacent_post( false, '', true );
					$product_next = get_adjacent_post( false, '', false );
					?>
					<?php if($product_prev || $product_next){?>
					<div class="product-next-prev-nav">
						<?php if($product_prev):?>
						<a title="<?php echo esc_attr(get_the_title($product_prev))?>" href="<?php echo esc_attr(get_permalink($product_prev))?>"><i class="fa fa-angle-left"></i></a>
						<?php endif;?>
						<?php if($product_next):?>
						<a title="<?php echo esc_attr(get_the_title($product_next))?>" href="<?php echo esc_attr(get_permalink($product_next))?>"><i class="fa fa-angle-right"></i></a>
						<?php endif;?>
					</div>
				<?php }?>
		
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
		
			</div><!-- .summary -->
		</div>
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
