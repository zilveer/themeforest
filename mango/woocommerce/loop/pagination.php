<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $wp_query, $paged;
$range = 2;
if ( empty( $paged ) ) $paged = 1;
if ( $wp_query->max_num_pages <= 1 ) {
    return;
}
$pages = $wp_query->max_num_pages;
?>
<ul class="pagination">

    <?php

    if ( $paged > 1 + $range ) echo "<li><a href='" . get_pagenum_link ( 1 ) . "' aria-label='First'><span aria-hidden='true'><i class='fa fa-angle-double-left'></i></span></a></li>";

    $page_links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
        'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
        'format'       => '',
        'add_args'     => '',
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'total'        => $wp_query->max_num_pages,
        'prev_text'    => "<span aria-hidden='true'><i class='fa fa-angle-left'></i></span>",
        'next_text'    => "<span aria-hidden='true'><i class='fa fa-angle-right'></i></span>",
        'type'         => 'array',
        'end_size'     => 1,
        'mid_size'     => 1,
    ) ) );

    foreach($page_links as $link){
        if(preg_match("/^<span class='page-numbers current'>/", $link)){
            echo "<li class='active'>";
        }else{
            echo "<li>";
        }
            echo $link;
        echo "</li>";
    }

    if ( $paged < $pages-$range ) echo "<li><a href='" . get_pagenum_link ( $pages ) . "' aria-label='Last'><span aria-hidden='true'><i class='fa fa-angle-double-right'></i></span></a></li>";
    ?>
</ul>