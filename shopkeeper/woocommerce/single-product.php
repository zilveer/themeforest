<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

//woocommerce_after_main_content
//nothing changed

//woocommerce_after_single_product_summary
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary_upsell_display', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_related_products', 'woocommerce_output_related_products', 20 );

get_header('shop');

?>

<?php do_action('woocommerce_before_main_content'); ?>

<div id="primary" class="content-area">
        
    <div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

            <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

        <?php endwhile; // end of the loop. ?>
    
    </div><!-- #content -->           

</div><!-- #primary -->

<div class="single_product_summary_upsell">
    <div class="row">
		<div class="large-9 large-centered columns">
			<?php do_action( 'woocommerce_after_single_product_summary_upsell_display' ); ?>
		</div><!--.large-9-->
    </div><!-- .row -->         
</div><!-- .single_product_summary_upsell -->

<div class="single_product_summary_related">
    <div class="row">
		<div class="xlarge-9 xlarge-centered columns">
			<?php do_action( 'woocommerce_after_single_product_summary_related_products' ); ?>
		</div><!--.large-9-->
    </div><!-- .row -->
</div><!-- .single_product_summary_related -->

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer('shop'); ?>