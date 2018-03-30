<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// remove the shortcode from the short description, in list view
remove_filter( 'woocommerce_short_description', 'do_shortcode', 11 );
add_filter( 'woocommerce_short_description', 'strip_shortcodes' );

?>
<li <?php wc_product_cat_class( '' , $category ); ?>>

    <div class="product-thumbnail group">

        <div class="thumbnail-wrapper">
            <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                <?php
                    /**
                     * woocommerce_before_subcategory_title hook
                     *
                     * @hooked woocommerce_subcategory_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_subcategory_title', $category );

                    /**
                     * woocommerce_shop_loop_subcategory_title hook.
                     *
                     * @hooked woocommerce_template_loop_category_title - 10
                     */
                    do_action( 'woocommerce_shop_loop_subcategory_title', $category );

                    /**
                     * woocommerce_after_subcategory_title hook.
                     */
                    do_action( 'woocommerce_after_subcategory_title', $category );
                ?>
            </a>

            <?php do_action( 'woocommerce_after_subcategory', $category ); ?>
        </div>
    </div>
</li>
