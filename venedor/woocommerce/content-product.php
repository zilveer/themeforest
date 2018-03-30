<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $venedor_product_slider, $venedor_layout, $venedor_sidebar, $venedor_woo_version;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

$classes = array();
if (!$venedor_product_slider) {
    if ((isset($_POST['action']) && $_POST['action'] == 'prdctfltr_respond') || (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar))
        $classes[] = 'col-md-4 col-sm-6';
    else
        $classes[] = 'col-md-3 col-sm-4';
}
if ($venedor_product_slider) : ?>
<div <?php post_class( $classes ); ?>>
<?php else : ?>
<li <?php post_class( $classes ); ?>>
<?php endif; ?>    
    <div class="inner clearfix">
    
	    <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10 : removed
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>

	    <a href="<?php the_permalink(); ?>">

		    <?php
			    /**
			     * woocommerce_before_shop_loop_item_title hook
			     *
			     * @hooked woocommerce_show_product_loop_sale_flash - 10
			     * @hooked woocommerce_template_loop_product_thumbnail - 10
			     */
			    do_action( 'woocommerce_before_shop_loop_item_title' );
		    ?>

		    <?php
			    /**
			     * woocommerce_after_shop_loop_item_title hook
			     *
			     * @hooked woocommerce_template_loop_price - 10
			     */
			    do_action( 'woocommerce_after_shop_loop_item_title' );
		    ?>

	    </a>
        
        <?php woocommerce_template_loop_rating() ?>
        
        <div class="product-details">

            <?php if (version_compare($venedor_woo_version, '2.4', '<')) : ?>
                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
            <?php else : ?>
                <?php
                /**
                 * woocommerce_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );
                ?>
            <?php endif; ?>
            
	        <?php

                /**
                 * woocommerce_after_shop_loop_item hook
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5 : removed
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' ); 

            ?>
            
        </div>
        
    </div>

<?php if ($venedor_product_slider) : ?>
</div>
<?php else : ?>
</li>
<?php endif; ?>