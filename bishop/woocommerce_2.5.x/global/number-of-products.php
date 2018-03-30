<?php
/**
 * Number of products on shop page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( is_single() || ! have_posts() ) return;

$num_prod = ( isset( $_GET['products-per-page'] ) ) ? $_GET['products-per-page'] : yit_get_option( 'shop-products-per-page' );

$num_prod_x1 = yit_get_option( 'shop-products-per-page' );
$num_prod_x2 = $num_prod_x1 * 2;

$obj  = get_queried_object();
$link = '';

if ( isset( $obj->term_id ) ) {
    $link = get_term_link( $obj->term_id, 'product_cat' );

    if ( is_wp_error( $link ) ) {
        $link = get_term_link( $obj->term_id, 'product_tag' );
    }

} else {
    if ( get_option( 'permalink_structure' ) == "" ) {
        $link = get_post_type_archive_link('product');
    } else {
        $link = get_permalink( wc_get_page_id( 'shop' ) );
    }
}

/**
 * Filter query link for products number
 *
 * @since 1.2.7
 * @param The old query url
 */
$link = apply_filters( 'yit_num_products_link', $link );

if( ! empty( $_GET ) ) {
    foreach( $_GET as $key => $value ){
        $link = esc_url( add_query_arg( $key, $value, $link ) );
    }
}

?>

<p id="number-of-products">
    <span class="view-title"><?php _e( 'View:', 'yit' ) ?></span>
    <a class="view-12<?php if ( $num_prod == $num_prod_x1 ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'products-per-page', $num_prod_x1, $link ) ) ?>"><?php echo $num_prod_x1 ?></a> /
    <a class="view-24<?php if ( $num_prod == $num_prod_x2 ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'products-per-page', $num_prod_x2, $link ) ) ?>"><?php echo $num_prod_x2 ?></a> /
    <a class="view-all<?php if ( $num_prod == 'all' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'products-per-page', 'all', $link ) ) ?>"><?php _e( 'ALL', 'yit' ) ?></a>
</p>
