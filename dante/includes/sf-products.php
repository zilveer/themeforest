<?php

	/*
	*
	*	Swift Page Builder - Products Function Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*	
	*	sf_mini_product_items()
	*	sf_product_items()
	*
	*/
	
	/* MINI PRODUCTS
	================================================== */
	if (!function_exists('sf_mini_product_items')) { 
		function sf_mini_product_items($asset_type, $category, $item_count, $sidebar_config, $width) {
			
			global $woocommerce, $sf_catalog_mode;
					
			$product_list_output = $image = "";
			$args = array();
			
			// ARRAY ARGUMENTS
			if ($asset_type == "latest-products") {
				
				$args = array(
						'post_type' => 'product',
						'post_status' => 'publish',
						'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $item_count,
					);	    
				
				$args['meta_query'] = array();
				$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'][] = $woocommerce->query->visibility_meta_query();		
				
			} else if ($asset_type == "featured-products") {			
				$args = array(
					    'post_type' => 'product',
					    'post_status' => 'publish',
					    'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
					    'meta_key' => '_featured',
					    'meta_value' => 'yes',
					    'posts_per_page' => $item_count
					);
			} else if ($asset_type == "top-rated") {
				add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
						
				$args = array(
					    'post_type' => 'product',
					    'post_status' => 'publish',
					    'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
					    'posts_per_page' => $item_count
					);
				$args['meta_query'] = $woocommerce->query->get_meta_query();
			
			} else if ($asset_type == "recently-viewed") {			
	
				// Get recently viewed product cookies data
				$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
				$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
			
				// If no data, quit
				if ( empty( $viewed_products ) )
					return '<p class="no-products">'.__( "You haven't viewed any products yet.", "swiftframework").'</p>';
			
				// Create query arguments array
			    $args = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
	    				'posts_per_page' => $item_count, 
	    				'no_found_rows'  => 1, 
	    				'post__in'       => $viewed_products, 
	    				'orderby'        => 'rand'
	    			);
			
				// Add meta_query to query args
				//$args['meta_query'] = array();
			
			    // Check products stock status
			    //$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	
			} else if ($asset_type == "sale-products") {
				// Get products on sale
				$product_ids_on_sale = wc_get_product_ids_on_sale();
		
				$meta_query   = array();
				$meta_query[] = WC()->query->visibility_meta_query();
				$meta_query[] = WC()->query->stock_status_meta_query();
				$meta_query   = array_filter( $meta_query );
		
				$args = array(
					'product_cat' => $category,
					'posts_per_page' => $item_count,
					'no_found_rows' 	=> 1,
					'post_status' 		=> 'publish',
					'post_type' 		=> 'product',
					'meta_query' 		=> $meta_query,
					'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )
				);
			} else {
				$args = array(
					'posts_per_page' => $item_count,
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'no_found_rows'  => 1,
					'product_cat' => $category
				);
				
				$args['meta_query'] = array();
				$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'][] = $woocommerce->query->visibility_meta_query();			
			}
			
			// OUTPUT PRODUCTS    
		    $products = new WP_Query( $args );
		    
		    if ( $products->have_posts() ) {
		        
		       $product_list_output .= '<ul class="mini-list mini-'.$asset_type.'">';
		       
		       while ( $products->have_posts() ) : $products->the_post();
		    
		            $product_output = $rating_output = "";
		            
		            global $product, $post, $wpdb, $woocommerce_loop; 
		    
		            // Ensure visibility
		            if ( ! $product->is_visible() )
		            	return;
		            
		            if ( has_post_thumbnail() ) {
		    			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		    			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
		    			
		    			if ($image_link == "") {
		    				$image_link = "default";
		    			}
		    			
		    			$image = sf_aq_resize( $image_link, 70, 70, true, false);
		    			
		    			if ($image) {
		    				$image_html = '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_title.'" />';   			
		    			}            			
		           	}
		           	
		           	if ( comments_open() ) {
		           	
		           		$count = $wpdb->get_var("
		           		    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		           		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		           		    WHERE meta_key = 'rating'
		           		    AND comment_post_ID = $post->ID
		           		    AND comment_approved = '1'
		           		    AND meta_value > 0
		           		");
		           	
		           		$rating = $wpdb->get_var("
		           	        SELECT SUM(meta_value) FROM $wpdb->commentmeta
		           	        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		           	        WHERE meta_key = 'rating'
		           	        AND comment_post_ID = $post->ID
		           	        AND comment_approved = '1'
		           	    ");
		           	
		           	    if ( $count > 0 ) {
		           	
		           	        $average = number_format($rating / $count, 2);	           			
		           	        $rating_output = '<div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'swiftframework'), $average).'"><span style="width:'.($average*16).'px"><span class="rating">'.$average.'</span> '.__('out of 5', 'swiftframework').'</span></div>';
		           	
		           	    }
		           	}
		            
		            $product_output .= '<li class="clearfix">';
		            
		           	if ($image) {
			            $product_output .= '<figure>';
			            $product_output .= '<a href="'.get_permalink($post->ID).'">';
			            $product_output .= $image_html;	
			            $product_output .= '</a>';
			            $product_output .= '</figure>';
		            }
		            $product_output .= '<div class="product-details">';
		            $product_output .= '<h5><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h5>';
		       		
		       		if ($asset_type == "top-rated") {
		       		
		       			$product_output .= $rating_output;
		       		
		       		} else {
		            
	            		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	            		$product_output .= $product->get_categories( ', ', '<span class="product-cats">' . _n( '', '', $size, 'swiftframework' ) . ' ', '</span>' );
	            	
	            	}
	            	if (!$sf_catalog_mode) {
		            $product_output .= '<span class="price">'.$product->get_price_html().'</span>';
		            }
		            $product_output .= '</div>';
		            $product_output .= '</li>';
		            
		            $product_list_output .= $product_output;
		
		       endwhile;
		       
		       wp_reset_query();
		       wp_reset_postdata();
		       remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		       
		       $product_list_output .= '</ul>';
		       
		       return $product_list_output;
		    }	    
			
		}
	}
	
	
	/* STANDARD PRODUCTS
	================================================== */
	if (!function_exists('sf_product_items')) { 		
		function sf_product_items($asset_type, $category, $carousel, $product_size, $item_count, $width) {
			
			global $woocommerce, $woocommerce_loop;
			
			$args = array();
			
			// ARRAY ARGUMENTS
			if ($asset_type == "latest-products") {
				$args = array(
						'post_type' => 'product',
						'post_status' => 'publish',
						'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $item_count
					);
				
				$args['meta_query'] = array();
				$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'][] = $woocommerce->query->visibility_meta_query();	
				
			} else if ($asset_type == "featured-products") {			
				$args = array(
					    'post_type' => 'product',
					    'post_status' => 'publish',
					    'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
					    'meta_key' => '_featured',
					    'meta_value' => 'yes',
					    'posts_per_page' => $item_count
					);
			} else if ($asset_type == "top-rated") {
				add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
						
				$args = array(
					    'post_type' => 'product',
					    'post_status' => 'publish',
					    'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
					    'posts_per_page' => $item_count
					);
				$args['meta_query'] = $woocommerce->query->get_meta_query();
			
			} else if ($asset_type == "recently-viewed") {			
	
				// Get recently viewed product cookies data
				$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
				$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
			
				// If no data, quit
				if ( empty( $viewed_products ) )
					return '<p class="no-products">'.__( "You haven't viewed any products yet.", "swiftframework").'</p>';
			
				// Create query arguments array
			    $args = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'product_cat' => $category,
						'ignore_sticky_posts'   => 1,
	    				'posts_per_page' => $item_count, 
	    				'no_found_rows'  => 1, 
	    				'post__in'       => $viewed_products, 
	    				'orderby'        => 'rand'
	    			);
			
				// Add meta_query to query args
				//$args['meta_query'] = array();
			
			    // Check products stock status
			    //$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	
			} else if ($asset_type == "sale-products") {
				// Get products on sale
				$product_ids_on_sale = wc_get_product_ids_on_sale();
		
				$meta_query   = array();
				$meta_query[] = WC()->query->visibility_meta_query();
				$meta_query[] = WC()->query->stock_status_meta_query();
				$meta_query   = array_filter( $meta_query );
		
				$args = array(
					'product_cat' => $category,
					'posts_per_page' => $item_count,
					'no_found_rows' 	=> 1,
					'post_status' 		=> 'publish',
					'post_type' 		=> 'product',
					'meta_query' 		=> $meta_query,
					'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )
				);
			} else {				
				$args = array(
					'posts_per_page' => $item_count,
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'no_found_rows'  => 1,
					'product_cat' => $category
				);
				
				$args['meta_query'] = array();
				$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'][] = $woocommerce->query->visibility_meta_query();	
			}
			
			ob_start();
					
			// OUTPUT PRODUCTS    
		    $products = new WP_Query( $args );
		    
		    global $sf_sidebar_config, $sf_carouselID;
		    
		    if ($sf_carouselID == "") {
		    $sf_carouselID = 1;
		    } else {
		    $sf_carouselID++;
		    }
		    
		    if (is_singular('portfolio')) {
		    	$sf_sidebar_config = "no-sidebars";
		    }
		    
		    $columns = 4;
		    if ($sf_sidebar_config == "no-sidebars") {
		   	    if ($width == "3/4") {
			   	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
			   	    $columns = 3;	   	    
		   	    } else if ($width == "1/2") {
			   	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
			   	    $columns = 2;	
			   	} else if ($width == "1/4") {
			   	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
			   	    $columns = 1;   	    
		   	    } else {
		   	    	if ($product_size == "mini") {
		   	    		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 6 );
		   	    		$columns = 6;
		   	    	} else {
		   	    		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
		   	    	}
		   	    }
		    } else if ($sf_sidebar_config == "one-sidebar") {
		    	if ($width == "3/4") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
		    	    $columns = 3;	   	    
		    	} else if ($width == "1/2") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
		    	    $columns = 2;	
		    	} else if ($width == "1/4") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
		    	    $columns = 1;   	    
		    	} else {
		    		if ($product_size == "mini") {
						$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
					} else {
						$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
						$columns = 3;
					}
		    	}
		    } else {
		    	if ($width == "3/4") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
		    	    $columns = 2;	   	    
		    	} else if ($width == "1/2") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
		    	    $columns = 1;	
		    	} else if ($width == "1/4") {
		    	    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
		    	    $columns = 1;   	    
		    	} else {
		    		if ($product_size == "mini") {
		    			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
		    			$columns = 3;
		    		} else {
						$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
						$columns = 2;
		    		}
		    	}
		    }
		    	    
			if ( $products->have_posts() ) { ?>
			   
				<?php if ($carousel == "yes") { ?>
					
					<div class="product-carousel carousel-wrap">
										
						<ul class="products list-<?php echo $asset_type; ?> carousel-items"
						     id="carousel-<?php echo $sf_carouselID; ?>" data-columns="<?php echo $columns; ?>">
						
							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						
								<?php woocommerce_get_template_part( 'content', 'product' ); ?>
						
							<?php endwhile; // end of the loop. ?>
						 
						</ul>
						
						<a href="#" class="carousel-prev"><i class="ss-navigateleft"></i></a><a href="#" class="carousel-next"><i class="ss-navigateright"></i></a>
						
					</div>
					
				<?php } else {  ?> 
				
				<ul class="products list-<?php echo $asset_type; ?>">
				
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				
					<?php endwhile; // end of the loop. ?>
				 
				</ul>
				
				<?php } ?>
			   
			<?php }
		       
	       $product_list_output = ob_get_contents();
	       ob_end_clean();
	       
	       wp_reset_query();
	       wp_reset_postdata();
	       remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	       
	       return $product_list_output;
		
		}	    	
	}	
?>