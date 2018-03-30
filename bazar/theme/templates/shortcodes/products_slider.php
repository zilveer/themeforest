<?php
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'touch-swipe' );
	wp_enqueue_script( 'mousewheel' );

  	global $wpdb, $woocommerce, $woocommerce_loop;

  	$args = array(
		'post_type'	=> array( 'product', 'product_variation' ),
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'ignore_sticky_posts'	=> 1,
		'meta_query' => '',
        'fields' => 'id=>parent'
	);

    if(isset( $featured) && $featured == 'yes' ){
        $args['meta_query'][] = array(
            'key' 		=> '_featured',
            'value' 	=> 'yes'
        );
    }

    if(isset( $best_sellers) && $best_sellers == 'yes' ){
        $args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'desc';
    }

    if(isset( $on_sale) && $on_sale == 'yes' ){
		$args['meta_key'] = '_sale_price';
		$args['meta_compare'] = '>=';
		$args['meta_value'] = 0;

        $sale_products = get_posts( $args );
        $product_ids 	= array_keys( $sale_products );
        $parent_ids		= array_values( $sale_products );

        // Check for scheduled sales which have not started
        foreach ( $product_ids as $key => $id ) {
            if ( get_post_meta( $id, '_sale_price_dates_from', true ) > current_time('timestamp') ) {
                unset( $product_ids[ $key ] );
            }
        }

        $product_ids_on_sale = array_unique( array_merge( $product_ids, $parent_ids ) );

        set_transient( 'wc_products_onsale', $product_ids_on_sale );
  	}

    $disable_unlimited = apply_filters('yit_product_slider_disable_unlimited', true);

    if( $disable_unlimited && $per_page < 0 ) {
        $per_page = 8;
    } elseif( $per_page == 0 ) {
        $per_page = -1;
    }

    $args['meta_query'][] = WC()->query->visibility_meta_query();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();

    $query_args = array(
        'posts_per_page' 	=> $per_page,
        'no_found_rows' => 1,
        'post_status' 	=> 'publish',
        'post_type' 	=> 'product',
        'order' 		=> $order,
        'meta_query' 	=> $args['meta_query'],
    );

	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
        $query_args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}

	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
        $query_args['post__in'] = $ids;
	}

    if ( isset( $category ) && $category!= 'null' && $category != 'a:0:{}' && $category != '0' && $category!="0, ") {
        $query_args['product_cat'] = $category;
    }

    if (strcmp($on_sale, 'yes') == 0  ) {
        if( empty( $product_ids_on_sale ) )
            { return; }

        $query_args['post__in'] = $product_ids_on_sale;
    }

    $woocommerce_loop['setLast'] = true;

    if ( isset( $latest ) && $latest == 'yes' ) {
        $orderby = 'date';
        $order = 'desc';
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
            break;
    }

	$products = new WP_Query( $query_args );

    ob_start();
	
	//$woocommerce_loop['columns'] = $products_per_page;
    if ( yit_get_option( 'shop-view-show-share' ) &&
        isset( $woocommerce->integrations->integrations['sharethis'] ) && $woocommerce->integrations->integrations['sharethis']->publisher_id
    ) {
        yit_add_sharethis_button_js( false );
    }
     
    $woocommerce_loop['view'] = 'grid';

	if ( isset( $layout ) && $layout != 'default' ) $woocommerce_loop['layout'] = $layout;
    $i = 0;
	if ( $products->have_posts() ) :
	    
		echo '<div class="products-slider-wrapper"><div class="products-slider">';
		if (isset($title) && $title != '')
			echo '<h4>'.$title.'</h4>';
		else
			echo '<h4>&nbsp;</h4>';
		echo '<ul class="products">';
        while ( $products->have_posts() ) : $products->the_post();
            if ( function_exists( 'woocommerce_get_template_part' ) ) {
                woocommerce_get_template_part( 'content', 'product' );
            }
            else if ( function_exists( 'wc_get_template_part' ) ) {
                wc_get_template_part( 'content', 'product' );
            }
            $i++;
		endwhile; // end of the loop.
		echo '</ul>';
		echo '<div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>';
		echo '</div></div><div class="es-carousel-clear"></div>';
		
	endif;

    echo str_replace( ' class="products-slider"', ' class="products-slider" data-items="'.yit_get_product_slider_items().'"', ob_get_clean() );
	wp_reset_query();
	                         
	$woocommerce_loop['loop'] = 0;        
	unset( $woocommerce_loop['setLast'] );
	
?>