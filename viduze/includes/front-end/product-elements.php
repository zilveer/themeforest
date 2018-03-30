<?php

	/*
	*	CrunchPress Product Item Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Nasir Hayat
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print product related item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/

	
// Print products
	function print_product($item_xml){
		
		if( function_exists('woocommerce_get_template_part')) {
		wp_reset_query();
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;
		global $class_to_num;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$port_size = find_xml_value($item_xml, 'item-size');
		
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}
		
		$port_div_size_min_hight = array(
			"1/4" => array("class"=>"four columns", "size"=>"161", "size2"=>"90", "size3"=>"130"), 
			"1/3" => array("class"=>"one-third column", "size"=>"185", "size2"=>"120", "size3"=>"130"), 
			"1/2" => array("class"=>"eight columns", "size"=>"290", "size2"=>"195", "size3"=>"130"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"225", "size2"=>"x182", "size3"=>"292"));
		
		if( $sidebar == "no-sidebar" ){
			$min_size = $port_div_size_min_hight[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$min_size = $port_div_size_min_hight[$port_size]['size2'];
		}else{
			$min_size = $port_div_size_min_hight[$port_size]['size3'];
		}
		
		// get the portfolio meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category_val = ( $category == 'All' )? '': $category;
		
		$filterable = find_xml_value($item_xml, 'filterable');
		$filter_class = '';
		// portfolio header
		if(!empty($header)){
			echo '<div class="product-header-wrapper"><h3 class="product-header-title title-color cp-title">' . $header . '</h3></div>';
		} 
		
		$porduct_item_style = find_xml_value($item_xml,'product-style');
	
		// category list for filter
		if( $filterable == "Yes" && $porduct_item_style == "STYLE 1") {
			$category_lists = get_category_list('product_cat', $category_val);
			$is_first = 'active';
			echo'<div class="filter-nav">';
			$view_all_product = find_xml_value($item_xml, 'view-all-product');
			if($view_all_product != 'No'){
				$view_all_product_link = get_permalink( get_page_by_title( $view_all_product ) );
			echo '<a class="view-all" href="' . $view_all_product_link . '">' . __('View All','cp_front_end') . '</a>';
			}
			
			echo '<ul id="product-item-filter">';
			foreach($category_lists as $category_list){
				
				$category_term = get_term_by( 'name', $category_list , 'product_cat');
				if( !empty( $category_term ) ){
					$category_slug = $category_term->slug;
				}else{
					$category_slug = 'all';
				}
				echo '<li><a href="#" class="' . $is_first . '" data-value="' . $category_slug . '">' . $category_list . '</a>  </li>';
				
				$is_first  = '';
			}
		    echo "</ul>";
			echo'</div>';
		    echo '<div class="clearfix"></div>';
		}
		
		// start fetching database
		global $post, $wp_query;
		
		if( !empty($category_val) ){
			$category_term = get_term_by( 'name', $category_val , 'product_cat');
			$category_val = $category_term->slug;
		}
		
		$post_temp = query_posts(array('post_type'=>'product', 'paged'=>$paged, 
			'product_cat'=>$category_val, 'posts_per_page'=>$num_fetch));

		// get the portfolio size
		$port_wrapper_size = $class_to_num[find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		
		
							echo '<section id="product-item-holder" class="product-item-holder">';
							
							    $porduct_item_style = find_xml_value($item_xml,'product-style');
												
								while( have_posts() ){
								the_post();				
														
								// get the category for filter
								$item_categories = get_the_terms( $post->ID, 'product_cat' );
								$category_slug = " ";
								if( !empty($item_categories) ){
									foreach( $item_categories as $item_category ){
										$category_slug = $category_slug . $item_category->slug . ' ';
									}
												
								// start printing data
								 echo '<figure class="' . $item_class . $category_slug . ' product-item mt0">';  
										// start printing data
										$thumbnail_types = "Image";
										if( $thumbnail_types == "Image" ){
											$image_type = "Lightbox to Current Thumbnail";
											$image_type = empty($image_type)? "Link to Current Post": $image_type; 
											$thumbnail_id = get_post_thumbnail_id();
											$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size_new );
											$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
											$image_type ="Lightbox to Picture";
											if($image_type == "Lightbox to Picture" ){
												$hover_thumb = "hover-link";
												$permalink = get_permalink();	
												
											}		
										}
										$product_title= get_the_title();
										$title_length = get_option(THEME_NAME_S.'_products_page_title_length');					 
										$short_title = substr($product_title,0,$title_length);
										echo '<div class="product-thumbnail-context">';
										echo '<div class="product-item-container">';
										echo '<div class="product-thumbnail-image">';
												echo '<img  src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>'; 
												echo '<div class="product-item-context">';
												echo '<h2 class="product-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . $product_title. '</a></h2>';
												echo '<div class="product-price">';
												do_action( 'woocommerce_after_shop_loop_item_title' );
												echo '</div>';
												echo '</div>';
												echo '</div>'; //portfolio thumbnail image	
										
										echo '<div class="product-thumbnail-content">';	
												echo '<span class="product_cart">'. do_action( 'woocommerce_after_shop_loop_item' ).'</span>';
												echo '<span class="details-button"><a href="' . $permalink . '" ' . $pretty_photo . ' class="cp-button" title="' . get_the_title() . '">Item Details</a></span>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
									   woocommerce_show_product_loop_sale_flash();
										do_action( 'woocommerce_show_product_loop_sale_flash');
										do_action( 'woocommerce_before_shop_loop_item' );
										
								 echo '</figure>';
							  }
							}
		echo "</section>";
		
		echo '<div class="clearfix"></div>';
		if ($porduct_item_style == "STYLE 1") {
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination(); }
		}
		} else{ 
		       echo'<div class="message-box-wrapper red mr10">';
			   echo'<div class="message-box-title">Missing Woo Commerce Plugin</div>';
			   echo'<div class="message-box-content">Please install Woo Commerce Plugin</div>';
			   echo'</div>';
 	          } 
  	    }


	
