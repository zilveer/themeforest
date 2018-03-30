<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show the products
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

global $yit_products_layout, $woocommerce_loop;

if ( isset( $layout ) ) {
    $yit_products_layout = $layout;
}

if ( isset( $masonry ) && $masonry == 'yes' ){
    //force masonry view
    $woocommerce_loop['view'] = 'masonry_item';
    wp_enqueue_script( 'jquery-masonry' );
}
else {
    //force grid view
    $woocommerce_loop['view'] = 'grid';
}


$query_args = array(
    'posts_per_page' => $per_page,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'order'          => $order,
);

if ( ! isset( $filter_type ) ) {
    $filter_type = 'category';
}
//ids filter exclude others fields
if ( $filter_type == 'ids' && isset( $ids ) && $ids ) {

    $ids                          = explode( ',', $atts['ids'] );
    $ids                          = array_map( 'trim', $ids );
    $query_args['post__in']       = $ids;
    $query_args['posts_per_page'] = 0;

}else {

    if ( isset( $category ) && $category != 'null' && $category != "a:0:{}" ) {
        $query_args['product_cat'] = $category;
    }

    $query_args['meta_query'] = array();

    if ( isset( $show_hidden ) && $show_hidden == 'no' ) {
        $query_args['meta_query'][] = WC()->query->visibility_meta_query();
        $query_args['post_parent']  = 0;
    }

    if ( isset( $hide_free ) && $hide_free == 'yes' ) {
        $query_args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => 0,
            'compare' => '>',
            'type'    => 'DECIMAL',
        );
    }

    switch ( $show ) {

        case 'featured':
            $query_args['meta_query'][] = array(
                'key'   => '_featured',
                'value' => 'yes'
            );
            break;

        case 'on_sale' :
            $product_ids_on_sale    = wc_get_product_ids_on_sale();
            $product_ids_on_sale[]  = 0;
            $query_args['post__in'] = $product_ids_on_sale;
            break;

        default:
            break;
    }
}

switch ( $orderby ) {

    case 'rand':
        $query_args['orderby'] = 'rand';
        break;

    case 'date':
        $query_args['orderby'] = 'date';
        break;

    case 'price' :
        $query_args['meta_key'] = '_price';
        $query_args['orderby']  = 'meta_value_num';
        break;

    case 'sales' :
        $query_args['meta_key'] = 'total_sales';
        $query_args['orderby']  = 'meta_value_num';
        break;

    case 'title' :
        $query_args['orderby'] = 'title';
        break;

    case 'by_stock':

        if ( isset( $_GET['orderby'] ) && function_exists( 'wc_clean' ) ) {
            $orderby_value = wc_clean( $_GET['orderby'] );
        }
        else {
            $orderby_value = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        }

        $fallback       = apply_filters( 'wc_extra_sorting_options_fallback', 'title', $orderby_value );
        $fallback_order = apply_filters( 'wc_extra_sorting_options_fallback_order', 'ASC', $orderby_value );

        $query_args['orderby']  = array( 'meta_value_num' => 'DESC', $fallback => $fallback_order );
        $query_args['meta_key'] = '_stock';

        break;
}

$products = new WP_Query( $query_args );
$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

if ( $products->have_posts() ) : ?>
    <div class="woocommerce <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
        <div class="row">
            <ul class="products <?php echo ( isset( $masonry ) && $masonry == 'yes' ) ? 'masonry' : ''; ?>">

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            </ul>
        </div>
    </div>
    <div class="clear"></div>

<?php endif;

wp_reset_query();

$woocommerce_loop['loop'] = 0;

?>
