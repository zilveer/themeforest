<?php
  	if (!isset($show) || $show == '') $show = 'all';
  	if (!isset($per_page) || $per_page == '') $per_page = '-1';
	if (!isset($orderby) || $orderby == '') $orderby = 'menu_order';
	if (!isset($order) || $order == '') $order = 'desc';
	if (!isset($pagination) || $pagination == '') $pagination = 'no';
	
	$args = array(
		'post_type'	=> array( 'product', 'product_variation' ),
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'ignore_sticky_posts'	=> 1,
		'meta_query' => '',
        'fields' => 'id=>parent'
	);
	
	if ( $show == 'all' ) { // show all products
		
		$args['meta_query'][] = array(
      		'key' 		=> '_visibility',
      		'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
    	);
		
	}elseif ( $show == 'featured' ) { // show featured products
  		
  		$args['meta_query'][] = array(
      		'key' 		=> '_featured',
      		'value' 	=> 'yes'
    	);
		
	}elseif ( $show == 'best_sellers' ) { // show best sellers products
  		
  		$args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
		
	}elseif ( $show == 'onsale' ) { // show onsale products
  		
  		$args['meta_key'] = '_sale_price';
		$args['meta_compare'] = '>=';
		$args['meta_value'] = 0;

        $on_sale = get_posts( $args );
        $product_ids 	= array_keys( $on_sale );
        $parent_ids		= array_values( $on_sale );

        // Check for scheduled sales which have not started
        foreach ( $product_ids as $key => $id ) {
            if ( get_post_meta( $id, '_sale_price_dates_from', true ) > current_time('timestamp') ) {
                unset( $product_ids[ $key ] );
            }
        }

        $product_ids_on_sale = array_unique( array_merge( $product_ids, $parent_ids ) );

        set_transient( 'wc_products_onsale', $product_ids_on_sale );
	}


    $query_args = array(
        'posts_per_page' 	=> $per_page,
        //'no_found_rows'  => $pagination ? 0 : 1,
        'post_status' 	=> 'publish',
        'post_type' 	=> 'product',
        'orderby' 		=> $orderby,
        'order' 		=> $order,
        'meta_query' 	=> $args['meta_query'],
    );

    //Ordering by price
    if( $orderby == 'meta_value_num' ) {
        $query_args['meta_key'] = '_price';
    }

    if ( $show == 'onsale' ) {
        if( empty( $product_ids_on_sale ) )
            { return; }

        $query_args['post__in'] = $product_ids_on_sale;
    }

    if( $pagination == 'yes' ) {
        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
        $query_args['paged'] = $paged;
    }

    if(isset($skus)){
        $skus = explode(',', $skus);
        $skus = array_map('trim', $skus);
        $query_args['meta_query'][] = array(
            'key' 		=> '_sku',
            'value' 	=> $skus,
            'compare' 	=> 'IN'
        );
    }

    if(isset($ids)){
        $ids = explode(',', $ids);
        $ids = array_map('trim', $ids);
        $query_args['post__in'] = $ids;
    }

    if(!empty( $category )) {
        $tax = 'product_cat';
        $category = array_map( 'trim', explode( ',', $category ) );
        if ( count($category) == 1 ) $category = $category[0];
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

	if ( $show == 'best_sellers' ) { // show best sellers products
        $query_args['meta_key'] = 'total_sales';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'DESC';
    }
	
	$products = new WP_Query( $query_args );
	
	global $woocommerce_loop;
	$woocommerce_loop['loop'] = 0;
	if ( isset( $layout ) && $layout != 'default' ) $woocommerce_loop['layout'] = $layout;
	//$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>
		
		<ul class="products">
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
				<?php
                    if ( function_exists( 'woocommerce_get_template_part' ) ) {
                        woocommerce_get_template_part( 'content', 'product' );
                    }
                    else if ( function_exists( 'wc_get_template_part' ) ) {
                        wc_get_template_part( 'content', 'product' );
                    }
                ?>
	
			<?php endwhile; // end of the loop. ?>
				
		</ul>
        
        <div class="clear"></div>

		<?php
        if( $pagination == 'yes' ) {
			yit_pagination( $products->max_num_pages );
        }
		?> 
		
	<?php endif; 

	wp_reset_query();       
	                       
	$woocommerce_loop['loop'] = 0;
	
?>
