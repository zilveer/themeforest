<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $yit_is_page, $yit_is_feature_tab;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Extra post classes
$classes = array();

// Increase loop count
$woocommerce_loop['loop']++;

// width of each product for the grid
$content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
if ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) $content_width -= 300;
$product_width = yit_shop_small_w() + 10 + 2;  // 10 = padding & 2 = border
$is_span = false;

if ( get_option( 'woocommerce_responsive_images' , 'yes' ) ) {
    $is_span = true;
    if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
        if ( $product_width >= 0   && $product_width < 120 ) { $classes[] = 'span1'; $woocommerce_loop['columns'] = 12; }
        elseif ( $product_width >= 120 && $product_width < 220 ) { $classes[] = 'span2'; $woocommerce_loop['columns'] = 6;  }
        elseif ( $product_width >= 220 && $product_width < 320 ) { $classes[] = 'span3'; $woocommerce_loop['columns'] = 4;  }
        elseif ( $product_width >= 320 && $product_width < 470 ) { $classes[] = 'span4'; $woocommerce_loop['columns'] = 3;  }
        elseif ( $product_width >= 470 && $product_width < 620 ) { $classes[] = 'span6'; $woocommerce_loop['columns'] = 2;  }
        else $is_span = false;

    } else {
        if ( $product_width >= 0   && $product_width < 150 ) { $classes[] = 'span1'; $woocommerce_loop['columns'] = 9; }
        elseif ( $product_width >= 150 && $product_width < 620 ) { $classes[] = 'span3'; $woocommerce_loop['columns'] = 3;  }
        else $is_span = false;

    }

} else {
    $grid = yit_get_span_from_width( $product_width );
    $classes[] = 'span' . $grid;
    $product_width = yit_width_of_span( $grid );
}
if ( $yit_is_feature_tab || ! $is_span ) $woocommerce_loop['columns'] = floor( ( $content_width + 30 ) / ( $product_width + 30 ) );

$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woocommerce_loop['columns'] );

if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $classes[] = 'last';
}

wp_enqueue_script( 'jquery-tipTip' );
if ( class_exists('WC_Compare_Hook_Filter') && method_exists('WC_Compare_Hook_Filter','woocp_print_scripts') ) { add_action('wp_footer', array('WC_Compare_Hook_Filter', 'woocp_print_scripts') ); }

// add product id
$classes[] = 'product-' . $product->id;

if ( !( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) )
    $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );

if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
    $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );

//product countdown compatibility
global $ywpc_loop;
if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
    $woocommerce_loop['view'] = 'grid';
}

// remove the shortcode from the short description, in list view
remove_filter( 'woocommerce_short_description', 'do_shortcode', 11 );
add_filter( 'woocommerce_short_description', 'strip_shortcodes' );

// li classes
$classes[] = 'product';
$classes[] = 'group';
$classes[] = $woocommerce_loop['view'];
$classes[] = $woocommerce_loop['layout'];
if ( yit_get_option('shop-view-show-border') ) {
    $classes[] = 'with-border';
}

// if css3
if ( yit_ie_version() == -1 || yit_ie_version() > 9 ) $classes[] = 'css3';

// configuration
if ( ! yit_get_option('shop-view-show-price') ) remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

// force open hover
if ( yit_get_option( 'shop-open-hover' ) ) $classes[] = 'force-open-hover';

// open the hover on mobile
if ( yit_get_option( 'responsive-open-hover' ) ) $classes[] = 'open-on-mobile';

// open the hover on mobile
if ( yit_get_option( 'responsive-force-classic' ) && $woocommerce_loop['layout'] == 'with-hover' ) $classes[] = 'force-classic-on-mobile';

/* fix yith catalog mode */
$ywctm_hide_cart_page = false;
global $YITH_WC_Catalog_Mode;
if ( isset( $YITH_WC_Catalog_Mode ) ) {
    $ywctm_hide_add_to_cart_loop = method_exists( $YITH_WC_Catalog_Mode, 'check_hide_add_cart_loop' ) && $YITH_WC_Catalog_Mode->check_hide_add_cart_loop();

    if($ywctm_hide_add_to_cart_loop && $product->product_type != 'variable') {
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 15 );
    }   else {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 15 );
    }
}

?>
<li <?php post_class( $classes ); ?>>

    <div class="product-thumbnail group">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <div class="thumbnail-wrapper">
            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </div>

        <?php if ( $woocommerce_loop['layout'] == 'classic' && yit_get_option('shop-view-show-shadow') ) : ?>
            <div class="product-shadow"></div>
        <?php endif; ?>

        <div class="product-meta" <?php if ($woocommerce_loop['view'] == 'list') echo 'style="width: ' . yit_shop_small_w() . 'px;"'; ?>>

            <?php

            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>

        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

    </div>

    <?php if ( yit_get_option('shop-view-show-description') ) : ?>
        <div class="description">
            <?php woocommerce_template_single_excerpt(); ?>
            <a href="<?php the_permalink() ?>" class="view-detail"><?php echo apply_filters('yit_details_button', __( 'Details', 'yit' )) ?></a>
            <?php do_action( 'yit_additional_info_on_list_view' ); ?>
        </div>
    <?php endif; ?>

</li>