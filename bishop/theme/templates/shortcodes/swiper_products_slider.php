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
 * Template file for add a swiper products slider
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

global $wpdb, $woocommerce, $woocommerce_loop;

$sidebar = yit_get_sidebars();
$layout_sidebar = $sidebar['layout'];

if($layout_sidebar == 'sidebar-no' && yit_get_option( 'general-layout-type' ) != 'boxed' ){
    $overflow = 'visible';
    $have_sidebar = 'sidebar-no';
}else{
    $overflow = 'hidden';
    $have_sidebar = 'sidebar-yes';
}

if( isset( $layout ) ) {
    $yit_products_layout = $layout;
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

if( ! isset( $button ) ){
    $button = 'btn-flat';
}

if(!isset($height) || $height == '' || $height < 0){
    $height = 0;
}

if(isset($autoplay) && ($autoplay == 'off' || $autoplay == '' || $autoplay == 'no')){
    $play_speed = 0;
}

if($play_speed == ''){
    $play_speed = 0;
}

$woocommerce_loop['setLast'] = true;

$products = new WP_Query( $query_args );

$i = 0;

$num_items = count($products->posts);

//Set the Number of Columns
if(!isset($columns)) {
    $columns = 2;
}elseif($columns < 1){
    $columns = 1;
}elseif($columns > 4){
    $columns = 4;
}

/*
 * The real numbers of items to display is the min value between
 * the numbers of columns and the numbers of items that the query returns,
*/
$num_items_to_display = min($num_items, $columns);

//Set the Image Width
if($num_items_to_display == 1) {
    $class_slide = 'col-sm-12';
    $width = 1154;
}elseif($num_items_to_display == 2){
    $class_slide = 'col-sm-6';
    $width = 575;
}elseif($num_items_to_display == 3){
    $class_slide = 'col-sm-4';
    $width = 370;
}elseif($num_items_to_display == 4){
    $class_slide = 'col-sm-3';
    $width = 270;
}

if ( $products->have_posts() ) : ?>

    <div class="woocommerce swiper products-slider <?php echo esc_attr( $vc_css ); ?>">

        <?php if (isset($title) && $title != '') : ?>
            <?php echo '<h4>'.$title.'</h4>'; ?>
        <?php endif; ?>

        <div class="row">
            <div class="swiper_container <?php echo $layout_sidebar ?>">
                <div class="swiper-wrapper swiper-products" data-items="<?php echo $num_items_to_display ?>" data-overflow="<?php echo $overflow ?>"  data-autoplay="<?php echo $play_speed ?>">


                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <?php
                        $__func = function_exists( 'get_product' ) ? 'get_product' : 'wc_get_product';
                        $product = $__func( $products->post->ID ); ?>
                        <?php $post_image_id = get_post_thumbnail_id( $products->post->ID ); ?>
                        <?php


                      //  $attachment_image_info = yit_image( array('id'=>$post_image_id, 'width'=>$width, 'height'=>$height, 'crop'=>1, 'output'=>'array') );

                        ?>

                        <div class="slide swiper-slide <?php echo $class_slide?>">
                            <div class="swiper-slide-image">
                                <div class="swiper-slide-wrapper">
                                    <?php yit_image( array( 'id'=>$post_image_id, 'width'=>$width, 'height'=>$height, 'crop'=>1, 'class'=>'img-responsive') ); ?>
                                    <div class="opacity">
                                        <div class="swiper-product-informations item-<?php echo $num_items_to_display ?> <?php echo $have_sidebar ?>">

                                                <span class="product-title">
                                                    <a href="<?php the_permalink() ?>">
                                                        <?php echo $product->post->post_title; ?>
                                                    </a>
                                                </span>

                                                <span class="product-price">
                                                    <?php echo $product->get_price_html() ?>
                                                </span>

                                            <?php if ( yit_get_option( 'shop-enable' ) == 'no' || yit_get_option( 'shop-add-to-cart' ) == 'no' ) { ?>
                                                <span class="product-view-details">
                                                    <a href="<?php echo get_permalink( $product->id ); ?>" class="btn <?php echo $button ?>"><?php _e( 'View Details', 'yit' ); ?></a>
                                                </span>
                                            <?php } else { ?>
                                                <span class="product-add-to-cart">
                                                    <?php

                                                    $add_to_cart_loop_args = array( 'in_swiper_slider' => true, 'button_class' => $button );

                                                    if( function_exists('woocommerce_template_loop_add_to_cart') ) {
                                                        woocommerce_template_loop_add_to_cart( $add_to_cart_loop_args );
                                                    } else {
                                                        wc_get_template( 'loop/add-to-cart.php', $add_to_cart_loop_args );
                                                    }

                                                    ?>
                                                </span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php echo do_shortcode('[clear]');

wp_reset_query();

$woocommerce_loop['loop'] = 0;
unset( $woocommerce_loop['setLast'] );

