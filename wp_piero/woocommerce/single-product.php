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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_after_single_product_summary_no_tabs', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );

get_header( 'shop' ); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">        
        		<?php while ( have_posts() ) : the_post(); ?>
        
        			<?php wc_get_template_part( 'content', 'single-product' ); ?>
        
        		<?php endwhile; // end of the loop. ?>
        
        	<?php
        		/**
        		 * woocommerce_after_main_content hook
        		 *
        		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        		 */
        		do_action( 'woocommerce_after_main_content' );
        	?>
        </div>
    </div>
</div>
<?php get_footer( 'shop' ); ?>
