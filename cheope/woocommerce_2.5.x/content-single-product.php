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
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?> >

    <div class="row">


	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );

		if(yit_get_sidebar_layout() != 'sidebar-no') :
			$span_class= "span".  (yit_get_option( 'shop-sidebar-width' )  != '2' ? 4 : 5);
		else :
			$span_class= "span7";
		endif
	?>

	<div class="summary entry-summary">

	    <h2 class="fn hide" itemprop="name"><?php the_title() ?></h2>

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

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
    </div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php
    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_output_up-sells - 1
     * @hooked woocommerce_output_related_products - 5
     */
    do_action( 'woocommerce_after_single_product' );
?>