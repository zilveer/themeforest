<?php
wp_enqueue_script('jquery-elastislider', get_template_directory_uri() .'/theme/assets/js/jquery.elastislide.js' );
global $wpdb, $woocommerce, $woocommerce_loop;

if ( isset( $latest ) && strcmp($latest, 'yes') == 0 ) {
    $orderby = 'date';
    $order = 'desc';
}

$args = array(
    'post_type'	=> array( 'product', 'product_variation' ),
    'post_status' => 'publish',
    'posts_per_page' => $per_page,
    'ignore_sticky_posts'	=> 1,
    'orderby' => $orderby,
    'order' => $order,
    'meta_query' => array(
        array(
            'key' 		=> '_visibility',
            'value' 	=> array('catalog', 'visible'),
            'compare' 	=> 'IN'
        )
    )
);

if(isset( $featured) && strcmp($featured, 'yes') == 0 ){
    $args['meta_query'][] = array(
        'key' 		=> '_featured',
        'value' 	=> 'yes'
    );
}

if(isset( $best_sellers) && strcmp($best_sellers, 'yes') == 0 ){
    $args['meta_key'] = 'total_sales';
    $args['orderby'] = 'meta_value';
    $args['order'] = 'desc';
}

if(isset( $on_sale) && strcmp($on_sale, 'yes') == 0 ){
    $args['meta_key'] = '_sale_price';
    $args['meta_compare'] = '>=';
    $args['meta_value'] = 0;
}

if(isset($atts['skus'])){
    $skus = explode(',', $atts['skus']);
    $skus = array_map('trim', $skus);
    $args['meta_query'][] = array(
        'key' 		=> '_sku',
        'value' 	=> $skus,
        'compare' 	=> 'IN'
    );
}

if(isset($atts['ids'])){
    $ids = explode(',', $atts['ids']);
    $ids = array_map('trim', $ids);
    $args['post__in'] = $ids;
}

if ( isset( $category ) && $category!= 'null' && $category != 'a:0:{}' && $category != '0' && $category!="0, ") {
    $args['product_cat'] = $category;
}

$woocommerce_loop['setLast'] = true;

//if ( empty( $style ) )
//$style = yit_get_option( 'shop_products_style', 'ribbon' );

//$style = yit_get_option( 'shop_products_style', 'ribbon' );
//$woocommerce_loop['style'] = $style;

//$products_per_page = apply_filters( 'loop_shop_columns', 4 );
$products = new WP_Query( $args );

//$woocommerce_loop['columns'] = $products_per_page;

$woocommerce_loop['view'] = 'grid';
if ( isset( $layout ) && $layout != 'default' ) $woocommerce_loop['layout'] = $layout;
$i = 0;
if ( $products->have_posts() ) :

    echo '<div class="es-carousel-wrapper products-slider-wrapper"><div class="products-slider es-carousel row">';
    if (isset($title) && $title != '')
        echo '<h4>'.$title.'</h4>';
    echo '<ul class="products">';
    while ( $products->have_posts() ) : $products->the_post();

        if ( function_exists( 'wc_get_template_part' ) ) {
            wc_get_template_part( 'content', 'product' );
        }
        else {
            woocommerce_get_template_part( 'content', 'product' );
        }

        $i++;
    endwhile; // end of the loop.
    echo '</ul></div></div><div class="es-carousel-clear"></div>';

endif;

wp_reset_query();

$woocommerce_loop['loop'] = 0;
unset( $woocommerce_loop['setLast'] );

?>