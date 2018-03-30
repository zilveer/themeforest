<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */
global $product, $woocommerce_loop, $cg_options;
$cg_product_flip = '';
$cg_product_flip = $cg_options['cg_product_thumb_flip'];
$cg_attachment_ids = $product->get_gallery_attachment_ids();
$cg_product_quick_view = '';

if ( isset( $cg_options['cg_product_quick_view'] ) ) {
    $cg_product_quick_view = $cg_options['cg_product_quick_view'];
}

$cg_product_loop_type    = '';

if ( isset( $cg_options['cg_product_loop_type'] ) ) {
    $cg_product_loop_type = $cg_options['cg_product_loop_type'];
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
    return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $classes[] = 'last';
}


$grid_count = $cg_options['product_grid_count'];

if ( isset( $_GET['looptype'] ) ) {
    $cg_product_loop_type = $_GET['looptype'];
}

if ( $cg_product_loop_type == 'adrenalin' ) {

?>

<li <?php post_class( 'product cg-product-wrap' ); ?>>	

    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="cg-product-img">
        <a href="<?php the_permalink(); ?>">	
            <div class="first-flip"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ) ?></div>        
            <?php
            if ( ( $cg_attachment_ids ) && ( $cg_product_flip == 'enabled' ) ) {

                $loop = 0;

                foreach ( $cg_attachment_ids as $cg_attachment_id ) {

                    $imgsrc = wp_get_attachment_url( $cg_attachment_id );

                    if ( !$imgsrc )
                        continue;

                    $loop++;

                    printf( '<div class="back-flip back">%s</div>', wp_get_attachment_image( $cg_attachment_id, 'shop_catalog' ) );

                    if ( $loop == 1 )
                        break;
                }
            } else {
                ?>

                <div class="back-flip"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ) ?></div>

                <?php
            }
            ?>
        </a>
        <?php if ( $cg_product_quick_view == 'enabled' ) { ?>
            <div class="cg-quick-view-wrap">
                <a href="#" class="cg-quick-view" data-id="<?php echo $post->ID; ?>"><?php _e( 'Quick View', 'commercegurus' ); ?></a>
            </div>
        <?php } ?>
    </div>
    <div class="cg-product-meta-wrap">
        <div class="cg-product-info">
            <a href="<?php the_permalink(); ?>">
                <?php $product_cats = strip_tags( $product->get_categories( '|', '', '' ) ); ?>
                <?php if ( $cg_options['cg_hide_categories'] == 'no' ) { ?>
                    <span class="category"><?php
                        list($firstpart) = explode( '|', $product_cats );
                        echo $firstpart;
                        ?></span>
                <?php }
                ?>

                <span class="name"><?php the_title(); ?></span>
            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            </a>
            <?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
<?php } ?>
        </div>

        <div class="cg-product-excerpt">
<?php woocommerce_template_single_excerpt(); ?>
        </div>
    </div>
<?php wc_get_template( 'loop/sale-flash.php' ); ?>

    <div class="cg-product-cta"><!-- start after shop loop item -->
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?><!-- end after shop loop item -->
    </div>

</li>

<?php
} else {
    $classes[] = 'defaultloop';
?>

<li <?php post_class( $classes ); ?>>

    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <a href="<?php the_permalink(); ?>">

        <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * woocommerce_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>

    </a>

    <?php

        /**
         * woocommerce_after_shop_loop_item hook
         *
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action( 'woocommerce_after_shop_loop_item' );

    ?>

</li>

<?php
}