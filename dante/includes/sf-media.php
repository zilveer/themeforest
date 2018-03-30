<?php
	
	/*
	*
	*	Swift Framework Media Functions
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_return_slider()
	*	sf_video_embed()
	*	sf_video_youtube()
	*	sf_video_vimeo()
	*	sf_get_embed_src()
	*	sf_featured_img_title()
	*	sf_swift_slider()
	*
	*/

	
	/* REVSLIDER RETURN FUNCTION
	================================================== */
	function sf_return_slider($revslider_shortcode) {
	    ob_start();
	    putRevSlider($revslider_shortcode);
	    return ob_get_clean();
	}


	/* VIDEO EMBED FUNCTIONS
	================================================== */
	if (!function_exists('sf_video_embed')) {
		function sf_video_embed($url, $width = 640, $height = 480) {
			if (strpos($url,'youtube') || strpos($url,'youtu.be')){
				return sf_video_youtube($url, $width, $height);
			} else {
				return sf_video_vimeo($url, $width, $height);
			}
		}
	}
	
	if (!function_exists('sf_video_youtube')) {
		function sf_video_youtube($url, $width = 640, $height = 480) {
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id);
			if ( is_ssl() ) {
				return '<div class="sf-video-wrap"><iframe itemprop="video" src="https://www.youtube.com/embed/'. $video_id[1] .'?wmode=transparent" width="'. $width .'" height="'. $height .'" allowfullscreen></iframe></div>';
			} else {
				return '<div class="sf-video-wrap"><iframe itemprop="video" src="http://www.youtube.com/embed/'. $video_id[1] .'?wmode=transparent" width="'. $width .'" height="'. $height .'" allowfullscreen></iframe></div>';
			}
		}
	}
	
	if (!function_exists('sf_video_vimeo')) {
		function sf_video_vimeo($url, $width = 640, $height = 480) {
			preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $video_id);	
			if ( is_ssl() ) {
				return '<div class="sf-video-wrap"><iframe itemprop="video" src="https://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0?wmode=transparent" width="'. $width .'" height="'. $height .'"></iframe></div>';
			} else {	
				return '<div class="sf-video-wrap"><iframe itemprop="video" src="http://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0?wmode=transparent" width="'. $width .'" height="'. $height .'"></iframe></div>';
			}
		}
	}
	
	if (!function_exists('sf_get_embed_src')) {
		function sf_get_embed_src($url) {
			if (strpos($url,'youtube')){
				preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id);
				if (isset($video_id[1])) {
					if ( is_ssl() ) {
						return 'https://www.youtube.com/embed/'. $video_id[1] .'?autoplay=1&amp;wmode=transparent';
					} else {
						return 'http://www.youtube.com/embed/'. $video_id[1] .'?autoplay=1&amp;wmode=transparent';					
					}
				}
			} else {
				preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $video_id);
				if (isset($video_id[1])) {
					if ( is_ssl() ) {
						return 'https://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;wmode=transparent';
					} else {
						return 'http://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;wmode=transparent';
					}
				}
			}
		}
	}	
		
	/* FEATURED IMAGE TITLE
	================================================== */
	function sf_featured_img_title() {
		global $post;
		$sf_thumbnail_id = get_post_thumbnail_id($post->ID);
		$sf_thumbnail_image = get_posts(array('p' => $sf_thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any'));
		if ($sf_thumbnail_image && isset($sf_thumbnail_image[0])) {
			return $sf_thumbnail_image[0]->post_title;
		}
	}
	
	
	/* SWIFT SLIDER
	================================================== */
	if (!function_exists('sf_swift_slider')) {
		function sf_swift_slider() {
			
			global $post, $wp_query;
			
			$output = '';
			
			$options = get_option('sf_dante_options');
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
					$post_excerpt = sf_custom_excerpt($custom_excerpt, 20);
					} else {
					$post_excerpt = sf_excerpt(20);
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
					
					$image = sf_aq_resize( $media_image_url, 1920, NULL, true, false);
							  
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
							$output .= '<div class="comment-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_color.'"><span>0</span><i class="ss-chat"></i></div>'. "\n";
						}
						if (function_exists( 'lip_get_love_count' )) {
						$output .= '<div class="loveit-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="ss-heart"></i></div>'. "\n";
						}
						$output .= '</div>'. "\n";
						$output .= '</div>'. "\n";
						$output .= '<div class="flex-caption-headline clearfix">'. "\n";
						$output .= '<h4><a href="'.$post_permalink.'"><span>'. $post_title .'</span><i class="ss-navigateright"></i></a></h4>'. "\n";
						$output .= '</div></div></div>'. "\n";
						$output .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$post_title.'" />'. "\n";
					} else {
						$output .= '<div class="flex-caption-large clearfix">'. "\n";
						$output .= '<h1><a href="'.$post_permalink.'">'. $post_title .'</a></h1>'. "\n";
						$output .= '<div class="excerpt">'. $post_excerpt .'</div>'. "\n";
						$output .= '<div class="cl-charts">'. "\n";
						if ( comments_open() ) {
							$output .= '<div class="comment-chart fw-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_alt_color.'"><span>0</span><i class="ss-chat"></i></div>'. "\n";
						}
						if (function_exists( 'lip_get_love_count' )) {
						$output .= '<div class="loveit-chart fw-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="ss-heart"></i></div>'. "\n";
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
	}
	

	/* GET ATTACHMENT META
	================================================== */
	if ( ! function_exists( 'sf_get_attachment_meta' ) ) {
	    function sf_get_attachment_meta( $attachment_id ) {
	
			$attachment = get_post( $attachment_id );
	
			if ( isset( $attachment ) ) {
				return array(
					'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
					'caption' => $attachment->post_excerpt,
					'description' => $attachment->post_content,
					'href' => get_permalink( $attachment->ID ),
					'src' => $attachment->guid,
					'title' => $attachment->post_title
				);
			}
		}
	}
		
?>