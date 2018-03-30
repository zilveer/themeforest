<?php

if(!class_exists( 'woocommerce' )) return false;

extract(shortcode_atts(array(
    'number_per_page' => 12,
    'columns' => '4',
    'orderby' => 'name',
    'order' => 'ASC',
    'parent' => '',
    'hide_empty' => 1,
    'el_class' => ''
), $atts));

global $woocommerce_loop, $woocommerce, $mk_settings;

$output = $height = $width = "";

if ( isset( $atts[ 'ids' ] ) ) {
    $ids = explode( ',', $atts[ 'ids' ] );
    $ids = array_map( 'trim', $ids );
} else {
    $ids = array();
}
$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

$grid_width = $mk_settings['grid-width'];
$height = $mk_settings['woo-loop-thumb-height'];
$width = round($grid_width/$columns) - 38;

if($columns !== '1'){
    if( $height > $width){
        $width  = $mk_settings['woo-loop-thumb-height'];
    }else {
        $height = round($grid_width/$columns) - 38;
    }
}
 
// get terms and workaround WP bug with parents/pad counts
$args = array(
    'number'        => $number_per_page, 
    'orderby'       => $orderby,
    'order'         => $order,
    'hide_empty'    => $hide_empty,
    'include'       => $ids,
    'pad_counts'    => true,
    'child_of'      => $parent
);

$product_categories = get_terms( 'product_cat', $args );

if ( $parent !== "" )
$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

if ( $number_per_page )
$product_categories = array_slice( $product_categories, 0, $number_per_page );

$woocommerce_loop['columns'] = $columns;

// Reset loop/columns globals when starting a new loop
$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

/**
* Check if WooCommerce is active
**/
$output .= '<div class="mk-product-categories">';
$output .= '    <ul class="mk-product-categories-list columns-'.$columns.'">';
if ( $product_categories ) {
    foreach ( $product_categories as $category ) {
        $output .= '    <li class="product-item isotope-item">';
        $output .= '        <div class="item-holder">';
        $output .=              do_action( 'woocommerce_before_subcategory', $category );

        $small_thumbnail_size   = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
        $thumbnail_id           = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
        if ( $thumbnail_id ) {
            $image = wp_get_attachment_image_src( $thumbnail_id, 'full');
            $image = bfi_thumb( $image[ 0 ], array('width' => $width*2, 'height' => $height*2, 'crop' => false));    
        } else {
            $image = bfi_thumb(THEME_IMAGES . '/dark-empty-thumb.png', array('width' => $width*2, 'height' => $height*2, 'crop' => false));
        }

        $output .= '            <a href="'.get_term_link( $category->slug, 'product_cat' ).'">';
        if ($image){
            $output .= '            <img src="' . $image . '" alt="' . $category->name . '" width="'.($width*2).'" height="'.($height*2).'" class="category-img" />';
        }
        $output .= '                <h4>';
        $output .= '                    <span class="category-name">'.$category->name.'</span>';
        if ( $category->count > 0 ){
        $output .=                      apply_filters( 'woocommerce_subcategory_count_html', ' <span class="item-count">' . $category->count . ' '.__('Items', 'mk_framework').'</span>', $category );
        }
        $output .= '                </h4>';
        $output .=                  do_action( 'woocommerce_after_subcategory_title', $category );
        $output .= '            </a>';
        $output .=              do_action( 'woocommerce_after_subcategory', $category );
        $output .= '        </div>';
        $output .= '    </li>';
    }
}
woocommerce_reset_loop();    
$output .= '    </ul>';
$output .= '</div>';
 
echo $output;

