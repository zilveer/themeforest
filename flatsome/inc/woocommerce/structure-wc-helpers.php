<?php
// Get Product Lists
function ux_list_products($args) {
              global $post, $woocommerce, $product;

              if(isset($args)){
                  $options = $args;

                  $number = '8';
                  if(isset($options['products'])) $number = $options['products'];

                  $show = ''; //featured, onsale
                  if(isset($options['show'])) $show = $options['show'];

                  $orderby = 'date';
                  $order = 'desc';

                  if(isset($options['orderby'])) $orderby = $options['orderby'];
                  if(isset($options['order'])) $order = $options['order'];

                  if($orderby == 'menu_order'){
                    $order = 'asc';
                  }

                  // Get Category
                  $cat = '';
                  if(isset($options['cat'])){
                    if(is_numeric($options['cat']) && get_term($options['cat'])){
                      $cat = get_term($options['cat'])->slug;
                    } else{
                      $cat = $options['cat'];
                    }
                  }


                  $tags = '';
                  if(isset($options['tags'])) $tags = $options['tags'];

                  $show_hidden = 0;
                  $hide_free = 0;

                  $offset = '';
                  if(isset($options['offset'])) $offset = $options['offset'];
                  
              }  else{
                  return false;
              }

              $query_args = array(
                'posts_per_page' => $number,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'no_found_rows'  => 1,
                'ignore_sticky_posts'   => 1,
                'order'          => $order,
                'product_tag' => $tags,
                'offset' => $offset,
                'product_cat' => $cat,
                'meta_query'     => array()
              );

              if ( empty( $show_hidden ) ) {
                $query_args['meta_query'][] = WC()->query->visibility_meta_query();
                $query_args['post_parent']  = 0;
              }

              if ( ! empty( $hide_free ) ) {
                $query_args['meta_query'][] = array(
                  'key'     => '_price',
                  'value'   => 0,
                  'compare' => '>',
                  'type'    => 'DECIMAL',
                );
              }

              $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
              $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

              switch ( $show ) {
                case 'featured' :
                  $query_args['meta_query'][] = array(
                    'key'   => '_featured',
                    'value' => 'yes'
                  );
                  break;
                case 'onsale' :
                  $product_ids_on_sale    = wc_get_product_ids_on_sale();
                  $product_ids_on_sale[]  = 0;
                  $query_args['post__in'] = $product_ids_on_sale;
                  break;
              }

              switch ( $orderby ) {
                case 'menu_order' :
                  $query_args['orderby'] = 'menu_order';
                   break;
                case 'title' :
                  $query_args['orderby'] = 'name';
                   break;
                case 'date' :
                  $query_args['orderby'] = 'date';
                   break;
                case 'price' :
                  $query_args['meta_key'] = '_price';
                  $query_args['orderby']  = 'meta_value_num';
                  break;
                case 'rand' :
                  $query_args['orderby']  = 'rand';
                  break;
                case 'sales' :
                  $query_args['meta_key'] = 'total_sales';
                  $query_args['orderby']  = 'meta_value_num';
                  break;
                default :
                  $query_args['orderby']  = 'date';
              }

               $results = new WP_Query( $query_args );

               return $results;            
} // List products


/* Set Default WooCommerce Image sizes */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
  function flatsome_woocommerce_image_dimensions() {
      $catalog = array(
      'width'   => '247', // px
      'height'  => '300', // px
      'crop'    => 1    // true
    );

    $single = array(
      'width'   => '510', // px
      'height'  => '600', // px
      'crop'    => 1    // true
    );

    $thumbnail = array(
      'width'   => '114', // px
      'height'  => '130', // px
      'crop'    => 1    // false
    );


  // Catalog Image sizes
    update_option( 'shop_catalog_image_size', $catalog );     // Product category thumbs
    update_option( 'shop_single_image_size', $single );     // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
  }
  add_action( 'init', 'flatsome_woocommerce_image_dimensions', 1 );
}