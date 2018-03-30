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
	
	// Print blog item
	function print_blog_item($item_xml){
		print_item_header( find_xml_value($item_xml, 'header') );
	
		global $paged, $sidebar_type, $blog_div_size_num_class;
		
		if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
		
		// get the item class and size from array
		$item_type = '1/1 Full Thumbnail';
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_size = $blog_div_size_num_class[$item_type][$sidebar_type];
				
		// get the blog meta value		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		
		$category = find_xml_value($item_xml, 'category', false);
		$category = ( $category == 'All' )? '': $category;

		$order = find_xml_value($item_xml, 'order');
		$orderby = find_xml_value($item_xml, 'orderby');		
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged, 'order'=>$order, 'orderby'=>$orderby,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		// printing each blog function
		echo '<div class="blog-item-holder">';
		print_blog_full($item_class, $item_size, $num_excerpt, $full_content);
		echo '</div>';
		
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
		
		wp_reset_query();
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-thumbnail-video', true); 
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo '<div class="blog-media-inner-wrapper">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}	
	}
	
	// print the blog thumbnail
	function print_single_blog_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_meta( $post_id, 'post-option-inside-thumbnial-image', true);
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . $thumbnail_full[0] . '" data-rel="fancybox" title="' . get_the_title() . '">';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true);
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true);
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo '<div class="blog-media-inner-wrapper">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-inside-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}		
	}	
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $num_excerpt, $full_content = "No" ){
		global $gdl_admin_translator, $gdl_date_format, $more;
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'READ MORE');
		}else{
			$translator_continue_reading = __('READ MORE','gdl_front_end');
		}	

		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 
			
			echo '<div class="blog-content-wrapper">';
			
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// blog information
			echo '<div class="blog-info-wrapper">';

			echo '<div class="blog-date-wrapper">';
			echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
			echo get_the_time($gdl_date_format);
			echo '</a>';
			echo '</div>';			
			
			echo '<div class="blog-author">';
			echo the_author_posts_link();
			echo '</div>';	
			
			echo '<div class="blog-comment">';
			comments_popup_link( __('0','gdl_front_end'),
				__('1','gdl_front_end'),
				__('%','gdl_front_end'), '',
				__('Off','gdl_front_end') );
			echo '</div>';	

			$tags_opening = '<div class="blog-tag">';
			$tags_ending = '</div>';
			the_tags( $tags_opening, ', ', $tags_ending );
			
			echo '<div class="clear"></div>';
			echo '</div>'; // blog information
			
			// blog thumbnail
			print_blog_thumbnail( get_the_ID(), $item_size );			
			
			// blog content
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
				echo gdl_get_excerpt( $num_excerpt, '... ' );
				echo '<div class="clear"></div>';
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';				
			}else{
				the_content($translator_continue_reading);
			}
			echo '</div>';
			
			echo '</div>'; // blot content wrapper
			
			echo '</div>'; // blog item
		}		
			
	}
?>