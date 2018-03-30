<?php

class WPBakeryShortCode_posts_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
    
    		$options = get_option('sf_flexform_options');

		    $title = $category = $item_class = $excerpt_length = $width = $el_class = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	'show_title'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"excerpt_length" => '20',
	        	"item_count"	=> '12',
	        	"show_details"	    => 'yes',
	        	"category"		=> 'all',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		global $post, $wp_query, $carouselID;
    		
    		if ($carouselID == "") {
    		$carouselID = 1;
    		} else {
    		$carouselID++;
    		}
    		
    		$blog_args = array(
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'category_name' => $category_slug,
    			'posts_per_page' => $item_count
    			);
    			    		
    		$blog_items = new WP_Query( $blog_args );
    		
    		$count = $columns = 0;
    		    		
    		$sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
    		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
    		$item_class = 'span2';
    		} else if ($sidebar_config == "both-sidebars") {
    		$item_class = 'span-bs-quarter';
    		} else {
    		$item_class = 'span3';
    		}
    		
    		if ($width == "1/4") {
    		$columns = 1;
    		} else if ($width == "1/2") {
    		$columns = 2;
    		} else if ($width == "3/4") {
    		$columns = 3;
    		} else {
    		$columns = 4;
    		}
    				
			$items .= '<ul id="carousel-'.$carouselID.'" class="blog-items carousel-items clearfix" data-columns="'.$columns.'">';
	
			while ( $blog_items->have_posts() ) : $blog_items->the_post();
								
				$item_title = get_the_title();
				$post_author = get_the_author_link();
				$post_date = get_the_date();
				$post_comments = get_comments_number();
				$post_categories = get_the_category_list(', ');
				
				$thumb_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$thumb_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );
				$thumb_link_type = get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
				$thumb_link_url = get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
				$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
				$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
				$thumb_lightbox_video_url = get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
				
				foreach ($thumb_image as $detail_image) {
					$thumb_img_url = $detail_image['url'];
					break;
				}
												
				if (!$thumb_image) {
					$thumb_image = get_post_thumbnail_id();
					$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
				}
					
				$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
				
				$item_title = get_the_title();
				$post_permalink = get_permalink();
				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
				} else {
				$post_excerpt = excerpt($excerpt_length);
				}
				
				if ($thumb_link_type == "link_to_url") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
					$item_icon = "link";
				} else if ($thumb_link_type == "link_to_url_nw") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
					$item_icon = "link";
				} else if ($thumb_link_type == "lightbox_thumb") {
					$link_config = 'href="'.$thumb_img_url.'" class="view"';
					$item_icon = "search";
				} else if ($thumb_link_type == "lightbox_image") {
					$lightbox_image_url = '';
					foreach ($thumb_lightbox_image as $image) {
						$lightbox_image_url = $image['full_url'];
					}
					$link_config = 'href="'.$lightbox_image_url.'" class="view"';	
					$item_icon = "search";
				} else if ($thumb_link_type == "lightbox_video") {
					$link_config = 'href="'.$thumb_lightbox_video_url.'" rel="prettyPhoto"';
					$item_icon = "facetime-video";				
				} else {
					$link_config = 'href="'.$post_permalink.'" class="link-to-post"';
					$item_icon = "file-alt";
				}
				 				   	
				$items .= '<li data-id="id-'. $count .'" class="clearfix carousel-item recent-post '.$item_class.'">';
				
				$items .= '<figure>';
						
				// THUMBNAIL MEDIA TYPE SETUP
				
				if ($thumb_type == "video") {
					
						$video = video_embed($thumb_video, 270, 202);
					
					$items .= $video;
					
				} else if ($thumb_type == "slider") {
					
					$items .= '<div class="flexslider thumb-slider"><ul class="slides">';
								
					foreach ( $thumb_gallery as $image )
					{
						$alt = $image['alt'];
						if (!$alt) {
						$alt = $image['title'];
						}
					    $items .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$alt}' /></li>";
					}
																	
					$items .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>';
					
				} else {
				
					$image = aq_resize( $thumb_img_url, 420, 315, true, false);
					    					  					
					$items .= '<a '.$link_config.'>';
					    					  											
					if ($image) {
					
					$items .= '<div class="overlay"><div class="thumb-info">';
					$items .= '<i class="icon-'.$item_icon.'"></i>';
					$items .= '</div></div>';
					
					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />';
					}
					
					$items .= '</a>';
				}
				
				$items .= '</figure>';
				
				$items .= '<div class="details-wrap">';
				
				// POST TITLE
				if ($show_title == "yes") {
					$items .= '<h4><a href="'.$post_permalink.'">'.$item_title.'</a></h4>'; 
				}			
				
				// POST EXCERPT
				if ($excerpt_length != "0" && $show_excerpt == "yes") {
					$items .= '<div class="excerpt">'. $post_excerpt .'</div>';
				}
				
				$items .= '</div>';
				
				// POST DETAILS 
				if ($show_details == "yes") {
    				$items .= '<div class="post-item-details clearfix">';
    				$items .= '<span class="post-date">'.$post_date.'</span>';
    				$items .= '<div class="comments-likes">';
    				if ( comments_open() ) {
    				$items .= '<a href="'.$post_permalink.'#comment-area"><i class="icon-comments"></i><span>'. $post_comments .'</span></a> ';
    				}
    				if (function_exists( 'lip_love_it_link' )) {
    				$items .= lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
    				}
    				$items .= '</div>';				
    				$items .= '</div>';
				}
				
				$items .= '</li>';
				
				$count++;
			
			endwhile;
			
			wp_reset_query();
					
			$items .= '</ul>';
			
			$items .= '<a href="#" class="prev"><i class="icon-chevron-left"></i></a><a href="#" class="next"><i class="icon-chevron-right"></i></a>';
    		
			$width = wpb_translateColumnWidthToSpan($width);
			$el_class = $this->getExtraClass($el_class);
    		
    		$output .= "\n\t".'<div class="wpb_posts_carousel_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper carousel-wrap">';
            if ($title != '') {
            $output .= "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading">'.$title.'</h3></div>';
            } else {
            $output .= "\n\t\t\t".'<div class="heading-wrap"></div>';
           	}
           	
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_carousel, $include_isotope;
            $include_carousel = true;
            $include_isotope = true;
            
            return $output;
		
    }
}

WPBMap::map( 'posts_carousel', array(
    "name"		=> __("Posts Carousel", "js_composer"),
    "base"		=> "posts_carousel",
    "class"		=> "wpb_posts_carousel wpb_carousel",
    "icon"      => "icon-wpb-posts-carousel",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "js_composer"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
	    ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of blog items to show in the carousel.", "js_composer")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Posts category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('category'),
            "description" => __("Choose the category for the blog items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "js_composer"),
            "param_name" => "show_title",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item title text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "js_composer"),
            "param_name" => "show_excerpt",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item excerpt text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item details", "js_composer"),
            "param_name" => "show_details",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item details.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "js_composer"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>