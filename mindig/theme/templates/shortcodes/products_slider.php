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
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

wp_enqueue_script('owl-carousel');

global $woocommerce_loop;

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

$title = ( isset( $title ) && $title != '' ) ? $title : '&nbsp;';

$cols = '';

if ( ! isset( $product_in_a_row ) ) {
    $product_in_a_row = 4;
}

if( isset( $layout ) && $layout != 'default' ) {
    $woocommerce_loop['products_layout'] = $layout;
}
else {
    $woocommerce_loop['products_layout'] = yit_get_option( 'shop-layout-type' );
}
//force grid view
$woocommerce_loop['view'] = 'grid';

$is_mobile = class_exists( 'YIT_Mobile' ) ? YIT_Mobile()->isMobile() : wp_is_mobile();

//force flip layout in masonry
if( $is_mobile ) {
    $woocommerce_loop['products_layout'] = 'flip';
}

$query_args = array(
    'posts_per_page' => $per_page,
    'post_status' 	 => 'publish',
    'post_type' 	 => 'product',
    'no_found_rows'  => 1,
    'order'          => $order,
);

if ( isset( $category ) && $category!= 'null' && $category != 'a:0:{}' ) {
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

switch( $product_type ) {

    case 'featured':
        $query_args['meta_query'][] = array(
            'key' 		=> '_featured',
            'value' 	=> 'yes'
        );
        break;

    case 'on_sale' :
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $product_ids_on_sale[] = 0;
        $query_args['post__in'] = $product_ids_on_sale;
        break;

    default: break;
}

switch( $orderby ) {

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

ob_start();

if ( $products->have_posts() ) :

    echo '<div class="woocommerce slider-product ' . esc_attr( $animate . $vc_css ) .'" '. $animate_data .'>';

    echo '<div class="products-slider-wrapper" data-columns="'.$product_in_a_row.'"  data-autoplay="'.$autoplay.'">';


    echo '<h3 class="products-slider-title">'.$title.'</h3>';

    echo '<div class="products-slider ' . $woocommerce_loop['products_layout'] . '">';

    $style = '';
    if(isset($z_index) && $z_index){
        $style = 'style="z-index:'.$z_index.'"';
    }

    echo '<div class="row"><ul class="products yit_products_slider" '.$style.'>';
    while ( $products->have_posts() ) : $products->the_post();
        wc_get_template( 'content-product.php',  array('product_in_a_row' => $product_in_a_row ) );
        $cols = ( isset($woocommerce_loop['columns']) ) ? $woocommerce_loop['columns'] : 4;
    endwhile; // end of the loop.

    echo '</ul></div></div>';

    //navigation
    echo '<div class="es-nav">';
    echo '<div class="es-nav-prev"><span class="fa fa-chevron-left"></span></div>';
    echo '<div class="es-nav-next"><span class="fa fa-chevron-right"></span></div>';
    echo '</div>';

    echo '</div><div class="es-carousel-clear"></div></div>';
endif;

echo do_shortcode('[clear]');


$content = ob_get_clean();

echo str_replace( '%columns%', $cols, $content );

wp_reset_query();

?>