<?php

	/*
	*	Goodlayers Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item due to 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	if( $gdl_is_responsive ){
		$blog_div_size_num_class = array(
			"Widget Style" => array("index"=>"0" ,"class"=>"blog-widget-wrapper", "size"=>"55x55", "size2"=>"55x55", "size3"=>"55x55"),
			"1/1 Medium Thumbnail" => array("index"=>"1", "class"=>"sixteen columns", "size"=>"460x230", "size2"=>"400x319", "size3"=>"460x150"),
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"sixteen columns", "size"=>"940x360", "size2"=>"640x260", "size3"=>"460x150"));
	}else{
		$blog_div_size_num_class = array(
			"Widget Style" => array("index"=>"0" ,"class"=>"blog-widget-wrapper", "size"=>"55x55", "size2"=>"55x55", "size3"=>"55x55"),
			"1/1 Medium Thumbnail" => array("index"=>"1", "class"=>"sixteen columns", "size"=>"460x230", "size2"=>"280x230", "size3"=>"460x150"),
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"sixteen columns", "size"=>"940x360", "size2"=>"640x260", "size3"=>"460x150"));
	}	
	
	// Print blog item
	function print_blog_item($item_xml){

		wp_reset_query();
		global $paged;
		global $sidebar;
		global $blog_div_size_num_class;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_index = $blog_div_size_num_class[$item_type]['index'];
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else{
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		}
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}

		// print header
		if(!empty($header)){
			echo '<div class="header-title-wrapper wrapper-on">';
			
			$header_icon_id = find_xml_value($item_xml, 'header-icon');
			if( !empty( $header_icon_id ) ){
				$header_icon = wp_get_attachment_image_src( $header_icon_id , 'full' );
				echo '<div class="header-title-icon" style="background: url(\'' . $header_icon[0] . '\') 0 50% no-repeat;" ></div>';
			}
			echo '<h3 class="header-title title-color gdl-title">' . $header . '</h3>';
			echo '</div>';
			echo '<div class="clear"></div>';
		}
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		echo '<div id="blog-item-holder" class="blog-item-holder">';

		if( $item_type == '1/1 Full Thumbnail' ){	
			print_blog_full($item_class, $item_size, $item_index, $num_excerpt, $full_content);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_blog_medium($item_class, $item_size, $item_index, $num_excerpt, $full_content);
		}else{
			print_blog_widget($item_class, $item_size, $item_index, $num_excerpt);
		}
		
		echo '</div>';
		echo '<div class="clear"></div>';
		
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
	
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
	
		$thumbnail_types = get_post_meta( $post_id, 'post-option-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
		
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-thumbnail-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a></div>';
			}
		
		}else if( $thumbnail_types == "Video" ){
			
			$video_link = get_post_meta( $post_id, 'post-option-thumbnail-video', true); 
			echo '<div class="blog-thumbnail-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';
		
		}else if ( $thumbnail_types == "Slider" ){

			$slider_xml = get_post_meta( $post_id, 'post-option-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			
			echo '<div class="blog-thumbnail-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';			
		
		}	
		
	}
	
	// print blog widget type
	function print_blog_widget( $item_class, $item_size, $item_index, $num_excerpt ){

		while( have_posts() ){
			the_post();

			echo '<div class="blog-item' . $item_index . ' ' . $item_class . '">'; 

			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			echo '<h2 class="blog-thumbnail-title post-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			echo '<div class="blog-thumbnail-date post-info-color">' . get_the_time( GDL_WIDGET_DATE_FORMAT );
			comments_popup_link( __(', 0 Comment','gdl_front_end'),
				__(', 1 Comment','gdl_front_end'),
				__(', % Comments','gdl_front_end'), '',
				__(', Comments are off','gdl_front_end') );	
			echo '</div>';
			echo '</div>'; // blog-thumbnail-context
			echo '<div class="clear"></div>';
			echo '</div>'; // blog-item
		
		}
			
	}
	
	// print blog medium thumbnail type
	function print_blog_medium( $item_class, $item_size, $item_index, $num_excerpt, $full_content = "No" ){
	
		global $gdl_admin_translator, $more;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	
		if( $full_content == 'Yes' ){ $more = 0; }
		
		$is_first = true;

		while( have_posts() ){
			the_post();
			
			echo '<div class="blog-item' . $item_index . ' ' . $item_class . '">'; 

			if( !$is_first ) echo '<div class="divider"></div>';
			else $is_first = false;			
			
			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			echo '<h2 class="blog-thumbnail-title post-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			echo '<div class="blog-thumbnail-info post-info-color">';

			echo '<div class="blog-thumbnail-date">' . get_the_time( GDL_DATE_FORMAT ) . '</div>';
			
			echo '<div class="blog-thumbnail-author"> ' . __('by','gdl_front_end') . ' ' . get_the_author_link() . '</div>';	
			
			echo '<div class="blog-thumbnail-comment">';		
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comments are off','gdl_front_end') );
			echo '</div>';
			
			the_tags('<div class="blog-thumbnail-tag">', ', ', '</div>');	

			echo '<div class="clear"></div>';
			echo '</div>';
			if( $full_content == "No" ){
				echo '<div class="blog-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';	
				echo '<a class="gdl-button blog-button" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';			
			}else{
				echo '<div class="blog-thumbnail-content">';
				the_content();
				echo '</div>';	
			}			
			echo '</div>'; // blog-thumbnail-context
			
			echo '</div>'; // blog-item
			
			echo '<div class="clear"></div>';

		}
		
	}
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $item_index, $num_excerpt, $full_content = "No" ){
	
		global $gdl_admin_translator, $more;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	
		if( $full_content == 'Yes' ){ $more = 0; }
		
		$is_first = true;
		
		while( have_posts() ){
			the_post();

			echo '<div class="blog-item' . $item_index . ' ' . $item_class . '">'; 

			if( !$is_first ) echo '<div class="divider"></div>';
			else $is_first = false;
			
			echo '<h2 class="blog-thumbnail-title post-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			echo '<div class="blog-thumbnail-info post-info-color gdl-divider">';
			echo '<div class="blog-thumbnail-date">' . get_the_time( GDL_DATE_FORMAT ) . '</div>';
			
			echo '<div class="blog-thumbnail-author"> ' . __('by','gdl_front_end') . ' ' . get_the_author_link() . '</div>';	

			echo '<div class="blog-thumbnail-comment">';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comments are off','gdl_front_end') );
			echo '</div>';
			
			the_tags('<div class="single-thumbnail-tag">', ', ', '</div>');
			
			echo '<div class="clear"></div>';
			echo '</div>';

			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			
			if( $full_content == "No" ){
				echo '<div class="blog-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';
				echo '<a class="gdl-button blog-button" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';				
			}else{
				echo '<div class="blog-thumbnail-content">';
				the_content();
				echo '</div>';	
			}
			
			echo '</div>'; // blog-thumbnail-context
			
			echo '</div>'; // blog-item
		
		}		
			
	}
?>