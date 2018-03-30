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


    do_action( 'woocommerce_before_single_product' );
    $product_layout = etheme_get_option('product_layout');
?>

<div class="clear"></div>
<div itemscope="" itemtype="http://schema.org/Product" id="product-page" class="product_layout_<?php echo $product_layout; ?> product ">

	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
    <div class="product-shop productcol summary">
		<?php do_action( 'woocommerce_single_product_summary' ); ?>

	</div><!-- .summary -->
    <div class="product-sidebar">
		<?php if (etheme_get_option('right_banners') && etheme_get_option('right_banners') != '' ) : ?>
			<?php etheme_option('right_banners'); ?>
        <?php else: ?>
            <?php dynamic_sidebar( 'product-single-widget-area' ); ?>
            <?php wp_reset_query(); ?>
		<?php endif; ?>	
          
    </div>
    <div class="clear"></div> 
    <?php woocommerce_get_template( 'single-product/tabs.php' ); ?>
    <div class="clear" style="height: 20px;"></div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
				
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>