<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product, $price;

if ( ! isset( $price ) ) {
    $price = $product->get_price_html();
}

if ( empty( $price ) ) {
    return;
}

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

     <?php if ( $product->get_price_html() != "" ) :

        $html = '<span class="price-label">' . __( 'Price', 'yit' ) . ':</span>' . $product->get_price_html();
        if ( strpos( $html, '<ins><span class="amount">' ) ) {
            $html = str_replace( '<ins><span class="amount">', '<ins><span class="amount" itemprop="price">', $html );
        }
        else {
            $html = str_replace( '<span class="amount">', '<span class="amount" itemprop="price">', $html );
        }

        ?>

        <p class="price">
            <?php echo $html; ?>
        </p>

        <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />

    <?php endif ?>

    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />


</div>