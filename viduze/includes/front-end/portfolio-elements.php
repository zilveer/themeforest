<?php

	/*
	*	CrunchPress Portfolio Item Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Nasir Hayat
	* 	@link		http://crunchpress.com
	*   @Package    Book Store
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print product related item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/


					
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"span3 columns ", "size"=>"390x300", "size2"=>"390x300", "size3"=>"390x300"), 
			"1/3" => array("class"=>"span4 columns", "size"=>"390x300", "size2"=>"390x300", "size3"=>"390x300"), 
			"1/2" => array("class"=>"span6 columns", "size"=>"450x290", "size2"=>"390x247", "size3"=>"390x247"), 
			"1/1" => array("class"=>"span12 columns ", "size"=>"620x225", "size2"=>"390x182", "size3"=>"390x292"));	
			
	$class_to_num = array(
		"element1-4" => 0.25,
		"1/4"=>0.25,
		"element1-3" => 0.33,
		"1/3"=>0.33,
		"element1-2" => 0.5,
		"1/2"=>0.5,
		"element2-3" => 0.66,
		"2/3"=>0.66,
		"element3-4" => 0.75,
		"3/4"=>0.75,
		"element1-1" => 1,
		"1/1" => 1	
	);
	
	 /////////Print Best Seller Products//////////
	 
	function print_portfolio($item_xml){
		
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
		
		// get the portfolio meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category_val = ( $category == 'All' )? '': $category;
		
		$filterable = find_xml_value($item_xml, 'filterable');
		$filter_class = '';
		// portfolio header
		/*if(!empty($header)){
			echo '<div class="portfolio-header-wrapper columns"><h3 class="portfolio-header-title title-color cp-title">' . $header . '</h3></div>';
		}else{
                        echo '<div class="portfolio-header-wrapper"><h3 class="portfolio-header-title title-color cp-title">Portfolio Items</h3></div>';
                }*/  
 		
		// category list for filter
		if( $filterable == "Yes" ){
			$category_lists = get_category_list('portfolio-category', $category_val);
			$is_first = 'active';
			echo '<div class="filter-nav columns">';
			$view_all_portfolio = find_xml_value($item_xml, 'view-all-portfolio');
			if($view_all_portfolio != 'No'){
				$view_all_portfolio_link = get_permalink( get_page_by_title( $view_all_portfolio ) );
				echo '<a class="view-all" href="' . $view_all_portfolio_link . '">' . __('View All','cp_front_end') . '</a>';
			}
			echo '<ul id="portfolio-item-filter">';
			foreach($category_lists as $category_list){
				
				$category_term = get_term_by( 'name', $category_list , 'portfolio-category');
				if( !empty( $category_term ) ){
					$category_slug = $category_term->slug;
				}else{
					$category_slug = 'all';
				}
				echo '<li><a href="#" class="' . $is_first . '" data-value="' . $category_slug . '">' . $category_list . '</a> </li>';
				
				$is_first  = '';
			}
			echo "</ul>";
			echo '</div>';
			echo '<div class="clearfix"></div>';
		}
		
		
		
		// start fetching database
		global $post, $wp_query;
		
		if( !empty($category_val) ){
			$category_term = get_term_by( 'name', $category_val , 'portfolio-category');
			$category_val = $category_term->slug;
		}
		
		$post_temp = query_posts(array('post_type'=>'portfolio', 'paged'=>$paged, 
			'portfolio-category'=>$category_val, 'posts_per_page'=>$num_fetch));

		// get the portfolio size
		$port_wrapper_size = $class_to_num[find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		$port_size =  $class_to_num[$port_size];
		
		$port_num_have_bottom = sizeof($post_temp) % (int)($port_wrapper_size/$port_size);
		$port_num_have_bottom = ( $port_num_have_bottom == 0 )? (int)($port_wrapper_size/$port_size): $port_num_have_bottom;
		$port_num_have_bottom = sizeof($post_temp) - $port_num_have_bottom;
			
			
		echo '<section id="portfolio-item-holder" class="portfolio-item-holder features-books">';
		$counter_product = 0;
							while( have_posts() ){
							global $post;
							the_post();	
							
							
			// get the category for filter
			$item_categories = get_the_terms( $post->ID, 'portfolio-category' );
			$category_slug = " ";
			if( !empty($item_categories) ){
				foreach( $item_categories as $item_category ){
					$category_slug = $category_slug . $item_category->slug . ' ';
				}
			}
 			$port_size = find_xml_value($item_xml, 'item-size');
			
			if ($port_size == '1/1') { $wrapper = ' wrapper'; }
			// start printing data
			echo '<div class="'. $item_class  .$wrapper. $category_slug . ' portfolio-item first slide">'; 
                  
				////////////////////////////////////////////////////

		
			$thumbnail_types = get_post_meta( $post->ID, 'post-option-thumbnail-types', true);
			
			if( $thumbnail_types == "Image" ){
				
				$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
				$image_type = empty($image_type)? "Link to Current Post": $image_type; 
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				
				if( $image_type == "Link to Current Post" ){
					$hover_thumb = "hover-link";
					$pretty_photo = "";
					$permalink = get_permalink();
				}else if( $image_type == "Link to URL"){
					$hover_thumb = "hover-link";
					$pretty_photo = "";
					$permalink = sprintf(__('%s','crunchpress'), get_post_meta( $post->ID, 'post-option-featured-image-url', true ) );
				}else if( $image_type == "Lightbox to Current Thumbnail" ){	
					$hover_thumb = "hover-zoom";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					$permalink = $permalink[0];
				}else if( $image_type == "Lightbox to Picture" ){
					$hover_thumb = "hover-zoom";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = sprintf(__('%s','crunchpress'), get_post_meta( $post->ID, 'post-option-featured-image-url', true ) );	
					$permalink = $permalink;
				}else{
					$hover_thumb = "hover-video";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = sprintf(__('%s','crunchpress'), get_post_meta( $post->ID, 'post-option-featured-image-url', true ) );	
					$permalink = $permalink;				
				}
				
				if( !empty($thumbnail[0]) ){
					echo '<div class="portfolio-thumbnail-image">';
					echo '<a href="' . $permalink . '" ' . $pretty_photo . ' title="' . get_the_title() . '">';
					echo '<div class="portfolio-thumbnail-image-hover">';
					echo '<span class="' . $hover_thumb . '"></span>';
					echo '</div>';
					echo '</a>';
					echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
					/*echo '<div class="port-shadow"><img src="'.CP_THEME_PATH_URL.'/images/port-shadow.png" alt="'. $alt_text .'"/></div>';*/
					
					echo '</div>'; //portfolio thumbnail image						
				}
				
			
			}else if( $thumbnail_types == "Video" ){
				
			$port_size = find_xml_value($item_xml, 'item-size');
		
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"210x121", "size2"=>"135x85", "size3"=>"210x135"), 
			"1/3" => array("class"=>"one-third column", "size"=>"290x180", "size2"=>"190x116", "size3"=>"210x135"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"300x190", "size3"=>"210x135"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"320x150", "size3"=>"180x135"));
			
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}	
				
				
				$video_link = get_post_meta( $post->ID, 'post-option-thumbnail-video', true); 
				echo '<div class="portfolio-thumbnail-video">';
				echo get_video($video_link, cp_get_width($item_size), cp_get_height($item_size));
				echo '</div>';
		      /*  echo '<div class="port-shadow"><img src="'.CP_THEME_PATH_URL.'/images/port-shadow.png" alt="'. $alt_text .'"/></div>';	*/
			}else if ( $thumbnail_types == "Slider" ){

				$slider_xml = get_post_meta( $post->ID, 'post-option-thumbnail-xml', true); 
				$slider_xml_dom = new DOMDocument();
				$slider_xml_dom->loadXML($slider_xml);
				
				echo '<div class="portfolio-thumbnail-slider">';
				echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
				echo '</div>';			
			    /* echo '<div class="port-shadow"><img src="'.CP_THEME_PATH_URL.'/images/port-shadow.png" alt="'. $alt_text .'"/></div>';*/
			}
			
			echo '<div class="portfolio-thumbnail-context">';
			// portfolio title
			if( find_xml_value($item_xml, "show-title") == "Yes" ){
				$product_title= get_the_title();
				$short_title = substr($product_title,0,20);
				echo '<h2 class="portfolio-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . $short_title . '</a></h2>';
			}
			
			// portfolio excerpt
			if( find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content"><p>' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</p></div>';
			}
			
			// read more button
			if( find_xml_value($item_xml, "read-more") == "Yes" ){
				echo '<a href="' . get_permalink() . '" class="cp-button">' . __('+ More','cp_front_end') . '</a>';
			}
			
			// visit website
			if( find_xml_value($item_xml, "visit-website") == "Yes" ){
				$website = get_post_meta( $post->ID, 'post-option-website-url', true); 
				if( !empty( $website ) ){
					echo '<a href="' . $website . '" class="portfolio-visit-website">' . __('Visit Website','cp_front_end') . '</a>';
				}
			}
			
			echo '</div>';
			
			// print space if not last line
			if($port_current_size < $port_num_have_bottom){
				if( find_xml_value($item_xml, "show-title") == 'Yes' ||
					find_xml_value($item_xml, "show-excerpt") == "Yes" ||
					find_xml_value($item_xml, "read-more") == "Yes" ||
					find_xml_value($item_xml, "visit-website") == "Yes"){
					echo '<div class="portfolio-bottom"></div>';
				}
				$port_current_size++;
			}
		
		
		
		////////////////////////////////////////////////////
			
			echo '</div>';
			
		      }
			
		echo "</section>";
		echo '<div class="clearfix"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
		    echo '<div class="mr10">';
			pagination();
			echo '</div>';
		}
		
	}

