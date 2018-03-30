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

global $product;

if ( $product->get_price() === '' && $product->product_type !== 'external' ) {
    return;
}

// remove button class -----------------------------
if( isset( $class ) ) {

    $class = explode( ' ' , $class );

    $class[] = 'add-to-cart';
    for( $i=0 ; $i < count( $class ) ; $i++ ) {

        if( $class[$i] == 'button' ) {
            unset ( $class[$i] );
        }

    }

    $class = implode( ' ' , $class );

}
//--------------------------------------------------

$link = $product->add_to_cart_url();
$label = $product->add_to_cart_text();
?>

<?php if ( ! $product->is_in_stock() ) : ?>

    <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', esc_url( $link ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'yiw' ) ); ?></a>
<?php
else :

    switch ( $product->product_type ) :
        case "variable" :
            $link  = apply_filters( 'variable_add_to_cart_url', $link );
            $label = apply_filters( 'variable_add_to_cart_text', $label );
            break;
        case "grouped" :
            $link  = apply_filters( 'grouped_add_to_cart_url', $link );
            $label = apply_filters( 'grouped_add_to_cart_text', $label );
            break;
        case "external" :
            $link  = apply_filters( 'external_add_to_cart_url', $link );
            $label = apply_filters( 'external_add_to_cart_text', $label );
            break;
        default :
            $link  = apply_filters( 'add_to_cart_url', $link );
            $label = apply_filters( 'add_to_cart_text', yiw_get_option( 'shop_button_addtocart_label', __( 'Add to cart', 'yiw' ) ) );
            break;
    endswitch; ?>

    <div class="buttons">
    <a href="<?php the_permalink(); ?>" class="details"><?php echo yiw_get_option( 'shop_button_details_label' ) ?></a>
    <?php
        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
                esc_url( $link ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->id ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'add-to-cart add_to_cart_button' ),
                esc_html( $label )
            ),
            $product );

    ?>
    </div>
<?php endif; ?>