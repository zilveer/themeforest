<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

    <?php if ( $product->get_price_html() != "" ) :

        $html = $product->get_price_html();
        if ( strpos( $html, '<ins><span class="amount">' ) ) {
            $html = str_replace( '<ins><span class="amount">', '<ins><span class="amount" >', $html );
        }
        else {
            $html = str_replace( '<span class="amount">', '<span class="amount" >', $html );
        }

        ?>

        <p class="price">
            <?php echo $html; ?>
        </p>

        <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
        <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />

    <?php endif ?>

    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>