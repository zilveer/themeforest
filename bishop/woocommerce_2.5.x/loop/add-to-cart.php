<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $yit_products_layout;

$shop_enabled = get_post_meta( $product->id, '_shop-enable', true );

if ( yit_get_option( 'shop-enable' ) == 'no' || yit_get_option( 'shop-add-to-cart' ) == 'no' || $shop_enabled != 'default' && $shop_enabled == 'no' ) {
    return;
}

if( ! isset( $yit_products_layout ) || $yit_products_layout == 'default' ) { $yit_products_layout = yit_get_option( 'shop-layout-type' ) ; }

?>

<?php if ( ! $product->is_in_stock() ) {
    if ( $yit_products_layout == 'slideup' && ( ! ( isset( $_REQUEST['action'] ) && ( $_REQUEST['action'] == 'yith-woocompare-view-table' || $_REQUEST['action'] == 'yith-woocompare-add-product' || $_REQUEST['action'] == 'yith-woocompare-remove-product' ) ) ) && ! ( isset( $in_swiper_slider ) && $in_swiper_slider ) ) {
        $img = ( yit_get_option( 'shop-slide-out-stock-icon' ) != '' ) ? yit_get_option( 'shop-slide-out-stock-icon' ) : get_template_directory_uri() . '/images/ico-outofstock.png'; ?>
        <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', $product->add_to_cart_url() ); ?>" class="out-of-stock"><img src="<?php echo $img ?>" alt="cart" class="ico-cart" /></a>
    <?php }
    else { ?>
        <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', $product->add_to_cart_url() ); ?>" class="out-of-stock btn btn-alternative"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out Of Stock', 'yit' ) ); ?></a>
    <?php
    }
}
else {

    $link = array(
        'url'      => $product->add_to_cart_url(),
        'label'    => $product->add_to_cart_text(),
        'class'    => isset( $class ) ? $class : 'button',
        'quantity' => isset( $quantity ) ? $quantity : 1
    );

    $handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

    switch ( $handler ) {
        case "variable" :
            $link['url']   = apply_filters( 'variable_add_to_cart_url', $link['url'] );
            $link['label'] = apply_filters( 'variable_add_to_cart_text', $link['label'] );
            $link['class']    = apply_filters( 'add_to_cart_class', $link['class'] );
            break;
        case "grouped" :
            $link['url']   = apply_filters( 'grouped_add_to_cart_url', $link['url'] );
            $link['label'] = apply_filters( 'grouped_add_to_cart_text',$link['label'] );
            break;
        case "external" :
            $link['url']   = apply_filters( 'external_add_to_cart_url', $link['url'] );
            $link['label'] = apply_filters( 'external_add_to_cart_text', $link['label'] );
            break;
        default :
            if ( $product->is_purchasable() ) {
                $link['url']      = apply_filters( 'add_to_cart_url', $link['url'] );
                $link['label']    = apply_filters( 'add_to_cart_text', $link['label'] );
                $link['class']    = apply_filters( 'add_to_cart_class', $link['class'] );
                $link['quantity'] = apply_filters( 'add_to_cart_quantity', $link['quantity'] );
            }
            else {
                $link['url']   = apply_filters( 'not_purchasable_url', $link['url'] );
                $link['label'] = apply_filters( 'not_purchasable_text', $link['label'] );
            }
            break;
    }

    if ( $yit_products_layout == 'slideup' && ( ! ( isset( $_REQUEST['action'] ) && ( $_REQUEST['action'] == 'yith-woocompare-view-table' || $_REQUEST['action'] == 'yith-woocompare-add-product' || $_REQUEST['action'] == 'yith-woocompare-remove-product' ) ) ) && ! ( isset( $in_swiper_slider ) && $in_swiper_slider ) ) {

        if ( ! $product->is_in_stock() ) {
            $img = ( yit_get_option( 'shop-slide-out-stock-icon' ) != '' ) ? yit_get_option( 'shop-slide-out-stock-icon' ) : get_template_directory_uri() . '/images/ico-outofstock.png';
        }
        elseif ( $handler == 'simple' || $handler == 'bundle' || $handler == 'yith_bundle' ) {
            $img = ( yit_get_option( 'shop-slide-add-cart-icon' ) != '' ) ? yit_get_option( 'shop-slide-add-cart-icon' ) : get_template_directory_uri() . '/images/ico-cart.png';
        }
        elseif ( $handler == 'variable' || $handler == 'grouped' || $handler == 'external' ) {
            $img = ( yit_get_option( 'shop-slide-set-option-icon' ) != '' ) ? yit_get_option( 'shop-slide-set-option-icon' ) : get_template_directory_uri() . '/images/ico-view.png';
        }

        $image_size = yit_getimagesize( $img );

        $link['label'] = '<img src="' . $img . '" alt="ico-cart" class="ico-cart" height="'. $image_size[1] . '" width="'. $image_size[0] . '"/>';

        //$link['class'] = str_replace( 'button', '', $link['class'] );

    }
    else {

        $link['class'].=' '.(isset( $in_swiper_slider ) && $in_swiper_slider  ? $button_class : 'btn-alternative' );

        $link['label'] = esc_html( $link['label'] );
    }

    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="btn %s">%s</a>',
            esc_url( $link['url'] ),
            esc_attr( $link['quantity'] ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( $link['class'] ),
            $link['label']
        ),
        $product );
}



