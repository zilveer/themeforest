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
$details = sprintf('<a href="%s" rel="nofollow" title="%s" class="details">%s</a>', get_permalink( $product->id ), __( 'Details', 'yit' ), __( 'Details', 'yit' ));
if ( ! yit_get_option('shop-view-show-details') )
    { $details = ''; } 

if ( ! is_shop_enabled() || ! yit_get_option('shop-view-show-add-to-cart') || ! $product->is_purchasable() ) :
    $add_to_cart = ''; 

$out_of_stock = '';
?>

<?php elseif ( ! $product->is_in_stock() ) : $add_to_cart = ''; $label = apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'yit' ) ); ?>

	<?php $out_of_stock = sprintf( '<a class="button out-of-stock" title="%s">%s</a>', $label, $label ); ?>

<?php else : ?>

	<?php

    $add_to_cart = '';

    $link =  $product->add_to_cart_url();
    $label = $product->add_to_cart_text();

    if ( $product->product_type == 'variable' ){

        $link 	= apply_filters( 'variable_add_to_cart_url', $link );
        $label 	= apply_filters( 'variable_add_to_cart_text', $label );
        $class .= ' view-options';

    }

    $add_to_cart = apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
            esc_url( $link ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr(  isset( $class ) ? $class : 'button' ),
            esc_html( $label )
        ),
        $product );
        
	?>

<?php endif; ?>
<?php
$request_a_quote = yit_ywraq_print_button();
?>
<?php if ( ! empty( $add_to_cart ) || ! empty( $details ) || !empty( $request_a_quote ) ) : ?>
<div class="product-actions">    
    <?php echo $details; ?>
    <?php echo $add_to_cart; ?>
    <?php echo $request_a_quote; ?>
    <?php if (isset($out_of_stock) && $out_of_stock != '') : echo $out_of_stock; endif ?>
</div>
<?php endif; ?>