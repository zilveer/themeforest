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

global $product, $woocommerce_loop, $yith_wcwl;
$wishlist_active = a13_is_wishlist_active();

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ){
	if(defined('A13_FULL_WIDTH')){
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
    }
    else{
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
    }
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<li <?php post_class( $classes ); ?>>

	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

    //thumbnail
    echo '
    <div class="thumb-space">
        <a class="thumb" href="'.get_permalink().'">';
            //main thumb
            $img_size = 'shop_catalog';

            echo woocommerce_get_product_thumbnail($img_size);

            //second thumb
            $attachment_ids = $product->get_gallery_attachment_ids();
            if ( $attachment_ids ) {
                $image = wp_get_attachment_image( $attachment_ids[0], $img_size );
                if ( strlen( $image )){
                    echo '<span class="sec-img">'.$image.'</span>';
                }
            }

            //labels
            //in stock
            if(!$product->is_in_stock()){
                echo '<span class="ribbon out-of-stock"><em>'.__( 'Out of stock', 'woocommerce' ).'</em></span>';
            }
            else{
                //sale
                if($product->is_on_sale()){
                    echo '<span class="ribbon sale"><em>'.__( 'Sale!', 'woocommerce' ).'</em></span>';
                }
                //new
                if(a13_is_product_new()){
                    echo '<span class="ribbon new"><em>'.__( 'New!', 'fame' ).'</em></span>';
                }
            }
        echo '</a>';

        //wishlist button
        if($wishlist_active){
            $is_on_wl = $yith_wcwl->is_product_in_wishlist( $product->id );
            $label = apply_filters( 'yith_wcwl_button_label', get_option( 'yith_wcwl_add_to_wishlist_text' ) );
            echo '<span class="yith-wcwl-add-to-wishlist">'
                    .'<span class="wl_button yith-wcwl-wishlistaddedbrowse'.($is_on_wl?  ' show"' : ' hide" style="display:none;"').' title="'.esc_attr(__( 'The product is already in the wishlist!', 'yit' )).'"><i class="fa fa-star"></i></span>'
                    .'<a class="wl_button add_to_wishlist yith-wcwl-add-button'.($is_on_wl? ' hide" style="display:none;"' : ' show"').' href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product->id . '" data-product-type="' . $product->product_type . '" title="'.esc_attr($label).'"><i class="fa fa-star"></i></a>'
                 .'</span>';
        }

        //add to cart
        echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s" title="%s"><i class="fa fa-shopping-cart"></i></a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            'add_to_cart_button',
            esc_attr( $product->product_type ),
            esc_html( $product->add_to_cart_text() )
        );

    echo '</div>';

    echo '<div class="product-meta">';
        echo '<div class="name_cat">';
            //product name
            echo '<a class="product_name" href="'.get_permalink().'">'.get_the_title().'</a>';

            //categories
            $cat_count = sizeof( get_the_terms( $product->id, 'product_cat' ) );
            echo $product->get_categories( ', ', '<span class="posted_in">', '.</span>' );
        echo '</div>';

        //price
        echo '<a class="product_price" href="'.get_permalink().'">';
        woocommerce_template_loop_price();
        echo '</a>';
    echo '</div>';


	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
    ?>

</li>