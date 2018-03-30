<?php

	/*
	*	Goodlayers Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the function that can print blog item due to 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	$blog_list_img_size = '50x50';
	$blog_div_size_num_class = array(
		"1/4 Blog Grid Style" => array("index"=>"0" ,"class"=>"four columns", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x170"),
		"1/3 Blog Grid Style" => array("index"=>"1" ,"class"=>"one-third column", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x170"),
		"1/2 Blog Grid Style" => array("index"=>"2" ,"class"=>"eight columns", "size"=>"426x187", "size2"=>"386x170", "size3"=>"386x170"),
		"1/1 Blog Grid Style" => array("index"=>"3" ,"class"=>"sixteen columns", "size"=>"906x306", "size2"=>"606x204", "size3"=>"426x143"),
		"1/1 Blog Full Style" => array("index"=>"4", "class"=>"sixteen columns", "size"=>"386x308", "size2"=>"386x308", "size3"=>"386x308"),
		"1/4 Blog List Style" => array("index"=>"5", "class"=>"four columns", "size"=>"50x50", "size2"=>"50x50", "size3"=>"50x50"),
		"1/3 Blog List Style" => array("index"=>"6", "class"=>"one-third column", "size"=>"50x50", "size2"=>"50x50", "size3"=>"50x50"),
		"1/2 Blog List Style" => array("index"=>"7", "class"=>"eight columns", "size"=>"50x50", "size2"=>"50x50", "size3"=>"50x50"),
		"1/4 Blog Grid List Style" => array("index"=>"8", "class"=>"four columns", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x170"),
		"1/3 Blog Grid List Style" => array("index"=>"9", "class"=>"one-third column", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x170"),
		"1/2 Blog Grid List Style" => array("index"=>"10", "class"=>"eight columns", "size"=>"426x187", "size2"=>"386x170", "size3"=>"386x170"),
		"1/1 Blog Slide Show" => array("index"=>"11", "class"=>"sixteen columns", "size"=>"95x60", "size2"=>"95x60", "size3"=>"95x60"),
	);
	

	function print_blog_item($item_xml){

		wp_reset_query();

		global $blog_div_size_num_class, $sidebar;
		
		// Check the blog style
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_index = $blog_div_size_num_class[$item_type]['index'];	

		// Get the item class and size from array
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else if ( $sidebar == "both-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		} 
		
		// Check blog page
		global $paged;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}

		// Get the blog category	
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category = str_replace('&', '&amp;', $category);
			$category_term = get_term_by( 'name', $category , 'category' );
			$category = $category_term->slug;
		}		
		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch));

		// Print the header
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="blog-header-wrapper">';
			echo '<h3 class="blog-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';
		}
		
		// Print each blog style 
		if ( $item_index <= 3 ){
			print_blog_item_grid($item_xml, $item_class, $item_size);
		}else if( $item_index == 4){
			print_blog_item_full($item_xml, $item_class, $item_size);
		}else if( $item_index <= 7){
			print_blog_item_list($item_xml, $item_class, $item_size);
		}else if( $item_index <= 10){
			print_blog_item_grid_list($item_xml, $item_class, $item_size);
		}else{
			print_blog_item_slide_show($item_xml, $item_class, $item_size);
		}
		
		// Blog pagination
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" && $item_index <= 9 ){	
			pagination();
		}	

	}	
	
	// Print blog thumbnail
	function print_gdl_blog_thumbnail( $thumbnail_type, $item_size ){
	
			if( $thumbnail_type == "Image" || empty($thumbnail_type) ){
			
				$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				if( !empty($thumbnail) ){
					echo '<div class="blog-thumbnail-image">';
					echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a></div>';
				}
			
			}else if( $thumbnail_type == "Video" ){
				
				$video_link = get_post_meta( get_the_ID(), 'post-option-thumbnail-video', true); 
				echo '<div class="blog-thumbnail-video">';
				echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
				echo '</div>';
			
			}else if ( $thumbnail_type == "Slider" ){

				$slider_xml = get_post_meta( get_the_ID(), 'post-option-thumbnail-xml', true); 
				$slider_xml_dom = new DOMDocument();
				$slider_xml_dom->loadXML($slider_xml);
				
				echo '<div class="blog-thumbnail-slider">';
				echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
				echo '</div>';			
			
			}	
	
	}
	
	// Print blog grid
	function print_blog_item_grid($item_xml, $item_class, $item_size){
		
		// Get the translator text
		global $more;
		$more = 0;
		
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', '[...]');
		}else{
			$translator_continue_reading = __('[...]','gdl_front_end');
		}		

		// Get the item option
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		echo '<div class="blog-item-holder grid-style">';
		while( have_posts() ){
			
			the_post();

			echo '<div class="blog-item gdl-divider blog-item-grid ' . $item_class . '">'; 
			
			echo '<div class="bkp-frame-wrapper">';
			echo '<div class="position-relative">';
			echo '<div class="bkp-frame">';
			
			// Blog thumbnail media
			$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
			print_gdl_blog_thumbnail( $thumbnail_type, $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			
			// Blog thumbnail title
			echo '<div class="blog-thumbnail-title-wrapper">';
			echo '<h2 class="blog-thumbnail-title post-title-color gdl-title">';
			echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
			echo '</h2>';
			
			echo '<div class="blog-thumbnail-comment">';
			comments_popup_link( '0', '1', '%', '', '0' );
			echo '</div>';
			echo '</div>';
			
			// Blog thumbnail Content
			echo '<div class="blog-thumbnail-content">';
			if( find_xml_value( $item_xml, 'item-size' ) == '1/1 Blog Grid Style' && 
				find_xml_value( $item_xml, 'show-full-blog-post' ) == 'Yes' ){
				the_content($translator_continue_reading);
			}else{
				echo mb_substr( get_the_excerpt(), 0, $num_excerpt );
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
			}
			echo '</div>';	
		
			echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
			echo '<div class="blog-thumbnail-date">' . get_the_time('d M Y') . '</div>';
			$blog_tag_header = '<span class="blog-thumbnail-tag-title">' . __('Tag ','gdl_front_end') . '</span>';
			the_tags('<div class="blog-thumbnail-tag">' . $blog_tag_header, ', ' ,'</div>');
			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>'; // blog-thumbnail-context
			
			echo '</div>'; // bkp-item
			echo '</div>'; // position-relative
			echo '</div>'; // bkp-item-wrapper
			
			echo '</div>'; // blog-item
		
		}
		echo '</div>';
	
	}
	
	// Print blog full
	function print_blog_item_full($item_xml, $item_class, $item_size){
		
		// Get the translator text
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', '[...]');
		}else{
			$translator_continue_reading = __('[...]','gdl_front_end');
		}		

		// Get the item option
		global $wp_query;
		$post_num = sizeOf($wp_query->posts) - 1;
		$half_post = round( $post_num/2 ); 
		$current_post_num = 0;
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		
		echo '<div class="blog-item-holder">';
		echo '<div class="blog-item gdl-divider blog-item-full ' . $item_class . '">'; 
		
		echo '<div class="bkp-frame-wrapper">';
		echo '<div class="bkp-frame">';		
		
		if( !have_posts() ) { echo '</div>'; }
		
		while( have_posts() ){
			
			the_post();
			if( $current_post_num == 0 ){
				// Blog thumbnail media
				$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
				print_gdl_blog_thumbnail( $thumbnail_type, $item_size );
				
				echo '<div class="blog-thumbnail-context">';
				
				// Blog thumbnail title
				echo '<div class="blog-thumbnail-title-wrapper">';
				echo '<h2 class="blog-thumbnail-title post-title-color gdl-title">';
				echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				echo '</h2>';
				
				echo '<div class="blog-thumbnail-comment">';
				comments_popup_link( '0', '1', '%', '', '0' );
				echo '</div>';
				echo '</div>';
				
				// Blog thumbnail Content
				echo '<div class="blog-thumbnail-content">';
				echo mb_substr( get_the_excerpt(), 0, $num_excerpt );
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
				echo '</div>';	
			
				echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
				echo '<div class="blog-thumbnail-date">' . get_the_time('d M Y') . '</div>';
				$blog_tag_header = '<span class="blog-thumbnail-tag-title">' . __('Tag ','gdl_front_end') . '</span>';
				the_tags('<div class="blog-thumbnail-tag">' . $blog_tag_header, ', ' ,'</div>');
				echo '<div class="clear"></div>';
				echo '</div>';
				echo '</div>'; // blog-thumbnail-context
				
				echo '<div class="clear"></div>';
				echo '</div>'; // bkp-item
				
			// bottom post	
			}else{
				
				// starting bottom post
				if( $current_post_num == 1 ){
					echo '<div class="blog-small-list gdl-divider">';
					echo '<div class="blog-percent-column1-2">';
					echo "<ul>";
				}else if( $current_post_num == $half_post + 1  ){
					echo "</ul>";
					echo '</div>'; // eight columns
					echo '<div class="blog-percent-column1-2">';
					echo "<ul class='blog-small-list-right gdl-divider'>";
				}
				
				echo "<li><a href=" . get_permalink() . ">" . get_the_title() . "</a></li>";

				// ending bottom post
				if( $current_post_num == $post_num ){
					echo "</ul>";
					echo '</div>'; // eight column
					echo "</div>"; // blog small list
				}	
				
			}		
			$current_post_num++;
		}
		echo '<div class="clear"></div>';
		echo '</div>'; // bkp-item-wrapper
		echo '</div>'; // blog-item		
		
		echo '</div>'; // blog-item-holder
	
	}	
	
	// Print blog list
	function print_blog_item_list($item_xml, $item_class, $item_size){
		
		echo '<div class="blog-item-holder ' . $item_class . '">';

		echo '<div class="bkp-frame-wrapper">';
		echo '<div class="bkp-frame p0">';		
		
		echo '<div class="blog-item-list-wrapper">';
		while( have_posts() ){
			
			the_post();

			echo '<div class="blog-item gdl-divider blog-item-list">'; 
			
			// Blog thumbnail media
			$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
			print_gdl_blog_thumbnail( $thumbnail_type, $item_size );
			
			echo '<div class="blog-thumbnail-context">';
			
			// Blog thumbnail title
			echo '<div class="blog-thumbnail-title-wrapper">';
			echo '<h2 class="blog-thumbnail-title post-title-color no-cufon">';
			echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
			echo '</h2>';
			echo '</div>';
		
			echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
			echo '<span class="blog-thumbnail-date">' . get_the_time('d M Y') . '</span>';
			echo '<span class="blog-thumbnail-list-comment">';
			comments_popup_link( '0 Comment', '1 Comment', '% Comments', '', 'Comments are off' );
			echo '</span>';					
			echo '<div class="clear"></div>';
			echo '</div>';	
			echo '</div>'; // blog-thumbnail-context

			echo '</div>'; // blog-item		
		}
		echo '</div>'; // blog-item-list-wrapper
		
		echo '<div class="clear"></div>';
		echo '</div>'; // bkp-item
		echo '</div>'; // bkp-item-wrapper

		echo '</div>';
	
	}	
	
	// Print blog grid list
	function print_blog_item_grid_list($item_xml, $item_class, $item_size){
		
		// Get the translator text
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', '[...]');
		}else{
			$translator_continue_reading = __('[...]','gdl_front_end');
		}		

		// Get the item option
		global $wp_query;
		global $blog_list_img_size;
		$post_num = sizeOf($wp_query->posts) - 1;
		$current_post_num = 0;
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		
		echo '<div class="blog-item-holder ' . $item_class . '">';
		echo '<div class="bkp-frame-wrapper">';
		
		echo '<div class="bkp-frame">';		
		echo '<div class="blog-item gdl-divider blog-item-grid">'; 
		
		if( !have_posts() ){ echo "</div></div>"; }
		
		while( have_posts() ){
			
			the_post();
			if( $current_post_num == 0 ){
				// Blog thumbnail media
				$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
				print_gdl_blog_thumbnail( $thumbnail_type, $item_size );
				
				echo '<div class="blog-thumbnail-context">';
				
				// Blog thumbnail title
				echo '<div class="blog-thumbnail-title-wrapper">';
				echo '<h2 class="blog-thumbnail-title post-title-color gdl-title">';
				echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				echo '</h2>';
				
				echo '<div class="blog-thumbnail-comment">';
				comments_popup_link( '0', '1', '%', '', '0' );
				echo '</div>';
				echo '</div>';
				
				// Blog thumbnail Content
				echo '<div class="blog-thumbnail-content">';
				echo mb_substr( get_the_excerpt(), 0, $num_excerpt );
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
				echo '</div>';	
			
				echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
				echo '<div class="blog-thumbnail-date">' . get_the_time('d M Y') . '</div>';
				$blog_tag_header = '<span class="blog-thumbnail-tag-title">' . __('Tag ','gdl_front_end') . '</span>';
				the_tags('<div class="blog-thumbnail-tag">' . $blog_tag_header, ', ' ,'</div>');
				echo '<div class="clear"></div>';
				echo '</div>';
				echo '</div>'; // blog-thumbnail-context
				
				echo '<div class="clear"></div>';
				echo '</div>'; // blog-item		
				echo '</div>'; // bkp-item
				
			// bottom post	
			}else{
				
				// starting bottom post
				if( $current_post_num == 1 ){
					echo '<div class="bkp-frame p0">';	
					echo '<div class="blog-item-list-wrapper">';
				}
				
				echo '<div class="blog-item gdl-divider blog-item-list not-first-blog">'; 
				
				// Blog thumbnail media
				$thumbnail_type = get_post_meta( get_the_ID(), 'post-option-thumbnail-types', true);
				print_gdl_blog_thumbnail( $thumbnail_type, $blog_list_img_size );
				
				echo '<div class="blog-thumbnail-context">';
				
				// Blog thumbnail title
				echo '<div class="blog-thumbnail-title-wrapper">';
				echo '<h2 class="blog-thumbnail-title post-title-color no-cufon">';
				echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				echo '</h2>';
				echo '</div>';
			
				echo '<div class="blog-thumbnail-info post-info-color gdl-divider gdl-info">';
				echo '<span class="blog-thumbnail-date">' . get_the_time('d M Y') . '</span>';
				echo '<span class="blog-thumbnail-list-comment">';
				comments_popup_link( __('0 Comment', 'gdl-front-end'), 
					__('1 Comment', 'gdl-front-end'), __('% Comments', 'gdl-front-end'), 
					'', __('Comments are off', 'gdl-front-end') );
				echo '</span>';					
				echo '<div class="clear"></div>';
				echo '</div>';	
				echo '</div>'; // blog-thumbnail-context

				echo '</div>'; // blog-item		

				// ending bottom post
				if( $current_post_num == $post_num ){
					echo "</div>"; // list-wrapper
					echo "</div>"; // bkp-frame
				}	
				
			}		
			$current_post_num++;
		}
		echo '<div class="clear"></div>';
	
		echo '</div>'; // bkp-item-wrapper
		echo '</div>'; // blog-item-holder
	
	}		
	
	// Print blog slideshow
	function print_blog_item_slide_show($item_xml, $item_class, $item_size){
		
		echo '<div class="blog-item-holder ' . $item_class . '">';

		echo '<div class="bkp-frame-wrapper bkp-slideshow">';
		echo '<div class="bkp-frame p20">';		
		
		$slideshow_title = find_xml_value($item_xml, 'slideshow-title');
		$slideshow_type = find_xml_value($item_xml, 'slideshow-type');
		
		echo '<div class="blog-item-slideshow-wrapper">';
		
		echo '<div class="gallery-es-carousel">';
		echo '<div class="es-carousel">';
		echo '<ul>';		
		while( have_posts() ){
			
			the_post();
			
			$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);			

			$permalink = ' href="' . get_permalink() . '" ';
			if( $slideshow_type == "Lightbox" ){
				$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
				$permalink = ' href="' . $thumbnail_full[0] . '" data-rel="prettyPhoto[slideshow]" ';
			}
			
			echo '<li>';
			
			// slideshow thumbnail image
			echo '<a ' . $permalink . ' class="blog-thumbnail-image"><img src="' . $thumbnail[0] . '" alt="' . $alt_text . '" /></a>';
			
			// slideshow item title
			if( $slideshow_title == 'Yes' ){
				echo '<a href="' . get_permalink() . '" class="no-cufon post-title-color slideshow-title border-none"><span>';
				echo get_the_title() . '</span></a>';
			}
			
			echo '</li>';
		
		}
		echo '</ul>';
		echo '</div>'; // es-carousel
		
		echo '</div>'; // gallery-es-carousel
		
		echo '</div>'; // blog-item-gallery-wrapper
		
		echo '<div class="clear"></div>';
		echo '</div>'; // bkp-frame
		
		echo '<div class="blog-item-slideshow-nav">';
		echo '<div class="blog-item-slideshow-nav-left gdl-hover"></div>';		
		echo '<div class="blog-item-slideshow-nav-right gdl-hover"></div>';
		echo '</div>';
		
		echo '<div class="clear"></div>';
		echo '</div>'; // bkp-item-frame

		echo '</div>';
	
	}	
?>