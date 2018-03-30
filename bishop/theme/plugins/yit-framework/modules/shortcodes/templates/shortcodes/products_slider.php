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
 * Template file for add a products slider
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

wp_enqueue_script( 'owl-carousel' );

global $wpdb, $woocommerce, $woocommerce_loop, $yit_products_is_slider, $yit_products_layout;

$yit_products_is_slider = true;

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

if ( isset( $layout ) ) {
    $yit_products_layout = $layout;
}

$query_args = array(
    'posts_per_page' => $per_page,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'no_found_rows'  => 1,
    'order'          => $order,
);

if ( isset( $category ) && $category != 'null' ) {
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

switch ( $product_type ) {

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
}

$products = new WP_Query( $query_args );

$i = 0;

ob_start();

if ( $products->have_posts() ) :
    echo '<div class="woocommerce ' . esc_attr( $animate . $vc_css )  .'" '. $animate_data .'>';
    if ( isset( $title ) && $title != '' ) {
        echo '<h4>' . $title . '</h4>';
    }

    echo '<div class="products-slider-wrapper" data-columns="%columns%"  data-autoplay="' . $autoplay . '"><div class="products-slider">';

    $style = '';
    if(isset($z_index) && $z_index){
        $style = 'style="z-index:'.$z_index.'"';
    }

    echo '<div class="row"><ul class="products yit_products_slider" '.$style.'>';
    while ( $products->have_posts() ) : $products->the_post();
        wc_get_template_part( 'content', 'product' );
        $i ++;
    endwhile; // end of the loop.
    echo '</ul></div>';
    echo '<div class="es-nav">';
    echo '<div class="es-nav-prev"><span class="fa fa-chevron-left"></span></div>';
    echo '<div class="es-nav-next"><span class="fa fa-chevron-right"></span></div>';
    echo '</div></div></div><div class="es-carousel-clear"></div>';
    echo '</div>';
endif;

echo do_shortcode( '[clear]' );

$content = ob_get_clean();

echo str_replace( '%columns%', $woocommerce_loop['columns'], $content );

wp_reset_query();

$yit_products_is_slider = false;
?>