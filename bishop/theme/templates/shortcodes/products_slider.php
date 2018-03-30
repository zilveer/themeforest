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

global $woocommerce_loop, $yit_products_layout;
$animate_data   = ( $animate != '' ) ? ' data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

if( isset( $layout ) ) {
    $yit_products_layout = $layout;
}

//force grid view
$woocommerce_loop['view'] = 'grid';

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

    case 'on_sale':
    case 'onsale' :
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
    $count = $products->post_count;
    echo '<div class="woocommerce ' . esc_attr( $animate . $vc_css ) .'" '. $animate_data .'>';
    if (isset($title) && $title != '') {
        echo '<h3 class="products-slider-title">'.$title.'</h3>';
    }
    echo '<div class="products-slider-wrapper" data-columns="%columns%"  data-autoplay="'.$autoplay.'"><div class="products-slider">';
    echo '<div class="row"><ul class="products yit_products_slider">';
    while ( $products->have_posts() ) : $products->the_post();
        wc_get_template_part( 'content', 'product' );
        $cols = $woocommerce_loop['columns']; //fix $woocommerce_loop['columns'] empty
    endwhile; // end of the loop.

    echo '</ul></div>';
    if ( $count > $cols ) :
        echo '<div class="es-nav">';
        echo '<div class="es-nav-prev"><span class="fa fa-chevron-left"></span></div>';
        echo '<div class="es-nav-next"><span class="fa fa-chevron-right"></span></div>';
        echo '</div>';

    endif;
    echo '</div></div><div class="es-carousel-clear"></div></div>';
endif;

echo do_shortcode('[clear]');

if( !isset($cols) ) $cols = 4;

$content = ob_get_clean();

echo str_replace( '%columns%', $cols, $content );

wp_reset_query();

?>