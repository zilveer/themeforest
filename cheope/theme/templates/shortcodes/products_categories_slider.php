<?php
wp_enqueue_script('jquery-elastislider', get_template_directory_uri() .'/theme/assets/js/jquery.elastislide.js' );

global $woocommerce_loop;

$ids = '';
if ( isset( $category ) && $category != '' ) {
    $ids = explode( ',', $category );
    $ids = array_map( 'trim', $ids );
    if (in_array('0', $ids)) $ids = '';
}

$woocommerce_loop['setLast'] = true;
if ($per_page == -1) $per_page = 0;
//$woocommerce_loop['style'] = $style;
$hide_empty = ( $hide_empty == true || strcmp($hide_empty, 'yes') == 0 ) ? 1 : 0;

$args = array(
    'number'     => $per_page,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
    'hierarchical' => 1,
    'taxonomy'		=> 'product_cat',
);

if ( $orderby == 'menu_order') {
    unset( $args ['orderby'], $args['order'] );
    $args ['menu_order'] = $order;
}
$terms =  get_categories( $args );

$woocommerce_loop['view'] = 'grid';
if ( isset( $layout ) && $layout != 'default' ) $woocommerce_loop['layout'] = $layout;
//$products_per_page = apply_filters( 'loop_shop_columns', 4 );
//$woocommerce_loop['columns'] = $columns;
$style = '';
if ( $terms ) {
    $html = $html_mobile = '';

    $i = 0;
    echo '<div class="es-carousel-wrapper products-slider-wrapper">';

    echo '<div class="products-slider es-carousel row categories '.$style.'">';
    if (isset($title) && $title != '')
        echo '<h4>'.$title.'</h4>';
    echo '<ul class="products '.$style.'">';
    foreach ( $terms as $category ) {

        if ( function_exists( 'wc_get_template' ) ) {
            wc_get_template( 'content-product_cat.php', array(
                'category' => $category
            ) );
        }
        else {
            woocommerce_get_template( 'content-product_cat.php', array(
                'category' => $category
            ) );
        }

    }
    echo '</ul></div></div><div class="es-carousel-clear"></div>';

}

wp_reset_query();

$woocommerce_loop['loop'] = 0;
unset( $woocommerce_loop['setLast'] );

?>