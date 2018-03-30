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

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$page_links  =  paginate_links( apply_filters( 'woocommerce_pagination_args', array(
    'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
    'format'       => '',
    'add_args'     => '',
    'current'      => max( 1, get_query_var( 'paged' ) ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="fa fa-angle-double-left"></i>',
    'next_text'    => '<i class="fa fa-angle-double-right"></i>',
    'type'         => 'array',
    'end_size'     => 3,
    'mid_size'     => 3
) ) );

if (count($page_links) == 0) return;
$links = "<ul class='pagination'>\n\t<li>";
$links .= join("</li>\n\t<li>", $page_links);
$links .= "</li>\n</ul>\n";
?>
<nav role="woocommerce-pagination" class="text-center">
    <?php  echo wp_kses_post($links) ;?>
</nav>




