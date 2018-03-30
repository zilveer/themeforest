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

global $wp_query, $sf_options;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$pagination = "standard";
if ( isset( $sf_options['product_display_pagination'] ) ) {
    $pagination = $sf_options['product_display_pagination'];
}
?>

<?php if ( $pagination == "infinite-scroll" ) { ?>
<nav class="woocommerce-pagination pagination-wrap hidden infinite-scroll-enabled">
<?php } else if ( $pagination == "load-more" ) { ?>
<a href="#" class="load-more-btn"><?php _e( 'Load More', 'swiftframework' ); ?></a>
<nav class="woocommerce-pagination pagination-wrap load-more hidden infinite-scroll-enabled">
<?php } else { ?>
<nav class="woocommerce-pagination pagination-wrap">
<?php } ?>
	<?php
		$pagination = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => apply_filters( 'sf_pagination_prev_text', __( '&larr;', 'swift-framework' ) ),
			'next_text'    => apply_filters( 'sf_pagination_next_text', __( '&rarr;', 'swift-framework' ) ),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
		$pagination = str_replace( "<ul class='page-numbers'>", '<ul class="bar-styling pagenavi">', $pagination );
		echo $pagination;
	?>
</nav>
