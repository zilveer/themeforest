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
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"sixteen columns", "size"=>"940x350", "size2"=>"640x240", "size3"=>"460x170"));

	}else{
		$blog_div_size_num_class = array(
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"sixteen columns", "size"=>"940x350", "size2"=>"640x240", "size3"=>"460x170"));
	}	
	
	//Global Var
	$num_fetch;
	
	// Print blog item
	function print_blog_item($item_xml){

		wp_reset_query();
		global $paged;
		global $sidebar;
		global $blog_div_size_num_class;
		global $num_fetch;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$item_type = "1/1 Full Thumbnail";
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_index = $blog_div_size_num_class[$item_type]['index'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else{
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		}
				
		// get the blog meta value		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category = str_replace('&', '&amp;', $category);
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		echo '<div id="blog-item-holder" class="blog-item-holder">';

		if( $item_type == '1/1 Full Thumbnail' ){	
			print_blog_full($item_class, $item_size, $item_index, $num_excerpt);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_blog_medium($item_class, $item_size, $item_index, $num_excerpt);
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
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $item_index, $num_excerpt ){
	
		global $gdl_admin_translator;
		global $sidebar;
		global $num_fetch;
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_date = get_option(THEME_SHORT_NAME.'_translator_blog_date', 'Date: ');
			$translator_by = get_option(THEME_SHORT_NAME.'_translator_blog_by', 'By: ');
			$translator_tag = get_option(THEME_SHORT_NAME.'_translator_blog_tag', 'Tags: ');
			$translator_comment = get_option(THEME_SHORT_NAME.'_translator_blog_comment', 'Comments: ');
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_date = __('Date: ','gdl_front_end');
			$translator_by = __('By: ','gdl_front_end');
			$translator_tag = __('Tags: ','gdl_front_end');
			$translator_comment = __('Comments: ','gdl_front_end');
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	
		
		$i=1;
		while( have_posts() ){
			the_post();
			
			if($i == $num_fetch && $sidebar == 'both-sidebar' ) {
			echo '<div class="blog-item' . $item_index . ' gdl-divider ' . $item_class . ' mb30">'; 
			}elseif($i == $num_fetch) {
			echo '<div class="blog-item' . $item_index . ' gdl-divider ' . $item_class . ' mb20">'; 
			}else{
			echo '<div class="blog-item' . $item_index . ' gdl-divider ' .$item_class . ' mb50">'; 
			}
			$i++;
			
			print_blog_thumbnail( get_the_ID(), $item_size );
			
			if( $sidebar == 'both-sidebar' ){ 
				echo '<h2 class="blog-thumbnail-title post-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}		
			
			echo '<div class="blog-thumbnail-info post-info-color">';

			echo '<div class="blog-info-inner-wrapper blog-date-wrapper">';
			echo '<span class="blog-info-header">' . $translator_date . '</span>';
			echo '<span class="blog-info-content">' . get_the_time('d M Y') . '</span>';
			echo '</div>';
			
			echo '<div class="blog-info-inner-wrapper blog-comment-wrapper">';
			echo '<span class="blog-info-header">' . $translator_comment . '</span>';
			echo '<span class="blog-info-content">';
			comments_popup_link( __('0','gdl_front_end'), __('1','gdl_front_end'), __('%','gdl_front_end'), '', __('Comments are off','gdl_front_end') );
			echo '</span>'; // blog-thumbnial-comment
			echo '</div>';
				
			
			$tag_string = '<div class="blog-info-inner-wrapper blog-tag-wrapper">';
			$tag_string = $tag_string . '<span class="blog-info-header">' . $translator_tag . '</span>';
			if( get_post_type() == 'portfolio' ){
				echo get_the_term_list( get_the_ID(), 'portfolio-tag', $tag_string . '<span class="blog-info-content">', ', ' ,'</span></div>');			
			}else{
				the_tags( $tag_string . '<span class="blog-info-content">', ', ', '</span></div>');
			}			
			
			
			echo '<div class="clear"></div>';
			echo '</div>'; // blog-thumbnail-info
			
			echo '<div class="blog-thumbnail-context">';
			if( $sidebar != 'both-sidebar' ){ 
				echo '<h2 class="blog-thumbnail-title post-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}			
			echo '<div class="blog-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';	
			echo '<a class="blog-continue-reading" href="' . get_permalink() . '"><em>' . $translator_continue_reading . '</em></a>';
			echo '</div>'; // blog-thumbnail-context
			
			echo '</div>'; // blog-item
		
		}		
			
	}
?>