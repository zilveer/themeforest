<?php
	/*
	*
	*	Template Parts
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	
 	/* BREADCRUMBS
 	================================================== */ 
	function sf_breadcrumbs() {
		$breadcrumb_output = "";
		
		if ( function_exists('bcn_display') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= bcn_display(true);
			$breadcrumb_output .= '</div>'. "\n";
		} else if ( function_exists('yoast_breadcrumb') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= yoast_breadcrumb("","",false);
			$breadcrumb_output .= '</div>'. "\n";
		}
		
		return $breadcrumb_output;
	}
	
	
	/* SWIFT SLIDER
	================================================== */
	function sf_swift_slider() {
		
		global $post, $wp_query;
		
		$output = '';
		
		$options = get_option('sf_neighborhood_options');
		$posts_slider_type = sf_get_post_meta($post->ID, 'sf_posts_slider_type', true);
		$posts_category = sf_get_post_meta($post->ID, 'sf_posts_slider_category', true);
		$portfolio_category = sf_get_post_meta($post->ID, 'sf_posts_slider_portfolio_category', true);
		$count = sf_get_post_meta($post->ID, 'sf_posts_slider_count', true);
		
		$args = array();
		
		if ($posts_slider_type == "post") {
			$slider_category = $posts_category;
			if ($slider_category == "All") {$slider_category = "all";}
			if ($slider_category == "all") {$slider_category = '';}
			$category_slug = str_replace('_', '-', $slider_category);
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => $category_slug,
				'posts_per_page' => $count
				);
		} else if ($posts_slider_type == "hybrid") {
			$args = array(
				'post_type' => array( 'post', 'portfolio'),
				'post_status' => 'publish',
				'posts_per_page' => $count
				);		
		} else {
			$slider_category = $portfolio_category;
			if ($slider_category == "All") {$slider_category = "all";}
			if ($slider_category == "all") {$slider_category = '';}
			$category_slug = str_replace('_', '-', $slider_category);
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'portfolio-category' => $category_slug,
				'posts_per_page' => $count,
				'no_found_rows' => 1,
				);
		}
			
		$slider_items = new WP_Query( $args );
				
		if( $slider_items->have_posts() ) {
			
			$output .= '<!--// SWIFT SLIDER //-->'. "\n";
			$output .= '<div id="swift-slider" class="flexslider">'. "\n";
			$output .= '<div class="swift-slider-loading"></div>'. "\n";
			$output .= '<ul class="slides">'. "\n";
					
			while ( $slider_items->have_posts() ) : $slider_items->the_post();
				
					$post_title = get_the_title();
				$post_permalink = get_permalink();
				$post_author = get_the_author_link();
				$post_date = get_the_date();
				$post_client = sf_get_post_meta($post->ID, 'sf_portfolio_client', true);
				$post_categories = get_the_category_list(', ');
				if ($posts_slider_type == "portfolio") {
				$post_categories = get_the_term_list($post->ID, 'portfolio-category', '', ', ');
				}
				$post_comments = get_comments_number();
				$custom_excerpt = sf_get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, 20);
				} else {
				$post_excerpt = excerpt(20);
				}
				$posts_slider_image = rwmb_meta('sf_posts_slider_image', 'type=image&size=full');
				$caption_position = sf_get_post_meta($post->ID, 'sf_caption_position', true);
				
				$accent_color = get_option('accent_color', '#fb3c2d');
				$secondary_accent_color = get_option('secondary_accent_color', '#2e2e36');
				$secondary_accent_alt_color = get_option('secondary_accent_alt_color', '#ffffff');
				
				$media_image_url = "";
				
				foreach ($posts_slider_image as $detail_image) {
					$media_image_url = $detail_image['url'];
					break;
				}
												
				if (!$posts_slider_image) {
					$posts_slider_image = get_post_thumbnail_id();
					$media_image_url = wp_get_attachment_url( $posts_slider_image, 'full' );
				}
				
				
				if (!$caption_position) { $caption_position = "caption-right"; }
				
				$image = aq_resize( $media_image_url, 1920, NULL, true, false);
						  
				$output .= '<li>'. "\n";
				$output .= '<div class="slide-caption-container">'. "\n";
				if ($image) {
					$output .= '<div class="flex-caption '.$caption_position.'">'. "\n";
					$output .= '<div class="flex-caption-details">'. "\n";
					$output .= '<div class="caption-details-inner">'. "\n";
					$output .= '<div class="details clearfix">'. "\n";
					$output .= '<span class="date">'.$post_date.'</span>'. "\n";
					if ($post_client != "") {
					$output .= '<span class="item-client">'.__("Client: ", "swiftframework").$post_client.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					} else {
					$output .= '<span class="item-author">'.__("Posted by ", "swiftframework").$post_author.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					}
					$output .= '</div>';
					if ( comments_open() ) {
						$output .= '<div class="comment-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_color.'"><span>0</span><i class="fa-comments"></i></div>'. "\n";
					}
					if (function_exists( 'lip_get_love_count' )) {
					$output .= '<div class="loveit-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="fa-heart"></i></div>'. "\n";
					}
					$output .= '</div>'. "\n";
					$output .= '</div>'. "\n";
					$output .= '<div class="flex-caption-headline clearfix">'. "\n";
					$output .= '<h4><a href="'.$post_permalink.'"><span>'. $post_title .'</span><i class="fa-angle-right"></i></a></h4>'. "\n";
					$output .= '</div></div></div>'. "\n";
					$output .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$post_title.'" />'. "\n";
				} else {
					$output .= '<div class="flex-caption-large clearfix">'. "\n";
					$output .= '<h1><a href="'.$post_permalink.'">'. $post_title .'</a></h1>'. "\n";
					$output .= '<div class="excerpt">'. $post_excerpt .'</div>'. "\n";
					$output .= '<div class="cl-charts">'. "\n";
					if ( comments_open() ) {
						$output .= '<div class="comment-chart fw-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_alt_color.'"><span>0</span><i class="fa-comments"></i></div>'. "\n";
					}
					if (function_exists( 'lip_get_love_count' )) {
					$output .= '<div class="loveit-chart fw-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="fa-heart"></i></div>'. "\n";
					}	
					$output .= '</div>'. "\n";
					$output .= '<div class="details clearfix">'. "\n";
					$output .= '<span class="date">'.$post_date.'</span>'. "\n";
					if ($post_client != "") {
					$output .= '<span class="item-client">'.__("Client: ", "swiftframework").$post_client.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					} else {
					$output .= '<span class="item-author">'.__("Posted by ", "swiftframework").$post_author.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					}
					$output .= '</div></div></div>'. "\n";
				}
				$output .= '</li>'. "\n";
								    						
			endwhile;
			
			wp_reset_postdata();
					
			$output .= '</ul></div>'. "\n";
		}
		
		echo $output;
	}
	
?>