<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( yit_get_option('shop-single-product-nav') == 'no' ) {
    return;
}
$excluted_terms = '';
$in_category = false;
if( yit_get_option( 'shop-nav-in-category' ) == 'yes' ) {
    $in_category = true;
}

$prev = get_previous_post_link( '<div class="prev">%link</div>', '<span class="fa fa-chevron-left"></span>' . __('Prev', 'yit'), $in_category, $excluted_terms, 'product_cat' );
$next = get_next_post_link( '<div class="next">%link</div>', __('Next', 'yit') . '<span class="fa fa-chevron-right"></span>', $in_category, $excluted_terms, 'product_cat' );

?>

<div class="product-nav">
    <?php echo $prev; ?>
        <?php if( $prev != '' && $next != '' ) echo ' / '; ?>
    <?php echo $next; ?>
</div>
