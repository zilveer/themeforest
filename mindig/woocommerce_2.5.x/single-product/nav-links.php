<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( yit_get_option('shop-single-product-nav') == 'no' || ! is_product() ) {
    return;
}
$excluted_terms = '';
$in_category = false;
if( yit_get_option( 'shop-nav-in-category' ) == 'yes' ) {
    $in_category = true;
}

$prev_post = get_previous_post( $in_category, $excluted_terms, 'product_cat' );
$next_post = get_next_post( $in_category, $excluted_terms, 'product_cat' );

$prev_post_content = ( $prev_post != '' ) ? '<div class="prev-product"><h5>' . $prev_post->post_title . '</h5>' . get_the_post_thumbnail( $prev_post->ID, 'shop_thumbnail' ) . '</div>' : '';
$next_post_content = ( $next_post != '' ) ? '<div class="next-product"><h5>' . $next_post->post_title . '</h5>' . get_the_post_thumbnail( $next_post->ID, 'shop_thumbnail' ) . '</div>' : '';

$prev = get_previous_post_link( '%link', '<span class="glyphicon glyphicon-chevron-left"></span>' . $prev_post_content, $in_category, $excluted_terms, 'product_cat' );
$next = get_next_post_link( '%link', '<span class="glyphicon glyphicon-chevron-right"></span>' . $next_post_content , $in_category, $excluted_terms, 'product_cat' );

?>

<div id="product-nav" class="clearfix">

        <?php if ( $prev != '' ) :
                echo $prev;
                echo '<span class="prev-label">' . __( 'Prev', 'yit' ) . '</span>';
        endif; ?>

        <?php if ( $next != '' ) :
                echo $next;
                echo '<span class="next-label">' . __( 'Next', 'yit' ) . '</span>';
        endif; ?>
</div>
