<?php

class WPBakeryShortCode_portfolio_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $title = $category = $item_class = $width = $el_class = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"item_count"	=> '12',
	        	"category"		=> 'all',
	        	'alt_background'	=> 'none',
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
    		
    		$portfolio_args=array(
    			'post_type' => 'portfolio',
    			'post_status' => 'publish',
    			'portfolio-category' => $category_slug,
    			'posts_per_page' => $item_count
    			);
    			    		
    		$portfolio_items = new WP_Query( $portfolio_args );
    		
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
    		    		
			$items .= '<ul id="carousel-'.$carouselID.'" class="portfolio-items carousel-items clearfix" data-columns="'.$columns.'">';
	
			while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();
								
				$item_title = get_the_title();
				
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
				$permalink = get_permalink();
								
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
					$link_config = 'href="'.$permalink.'" class="link-to-post"';
					$item_icon = "chevron-right";
				}
				    					   	
				$items .= '<li data-id="id-'. $count .'" class="clearfix carousel-item portfolio-item '.$item_class.'">';
				
				$items .= '<figure>';
						
				// THUMBNAIL MEDIA TYPE SETUP
				
				if ($thumb_type == "video") {
					
						$video = video_embed($thumb_video, 420, 315);
					
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
					    					  					
					if($image) {
						$items .= '<a '.$link_config.'>';
						
						$items .= '<div class="overlay"><div class="thumb-info">';
						$items .= '<i class="icon-'.$item_icon.'"></i>';
						$items .= '</div></div>';
						
						$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />';
						    						    						
						$items .= '</a>';
					}
				}
				
				$items .= '</figure>';
				
				$items .= '<div class="item-details clearfix">';
				$items .= '<h4 class="portfolio-item-title"><a '.$link_config.'"><span>'. $item_title .'</span><i class="icon-angle-right"></i></a></h4>';
				$items .= '</div>';

				$items .= '</li>';
				$count++;
			
			endwhile;
			
			wp_reset_query();
			
			$items .= '</ul>';
    		
    		$items .= '<a href="#" class="prev"><i class="icon-chevron-left"></i></a><a href="#" class="next"><i class="icon-chevron-right"></i></a>';
        	
        	$width = wpb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
                 
            if ($alt_background == "none" || $sidebar_config != "no-sidebars" || $width != "span12") {
            $output .= "\n\t".'<div class="wpb_portfolio_carousel_widget wpb_content_element '.$width.$el_class.'">';
            } else {
            $output .= "\n\t".'<div class="wpb_portfolio_carousel_widget wpb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';            
            }
            
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

WPBMap::map( 'portfolio_carousel', array(
    "name"		=> __("Portfolio Carousel", "js_composer"),
    "base"		=> "portfolio_carousel",
    "class"		=> "wpb_portfolio_carousel wpb_carousel",
    "icon"      => "icon-wpb-portfolio-carousel",
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
            "description" => __("The number of portfolio items to show in the carousel.", "js_composer")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Portfolio category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('portfolio-category'),
            "description" => __("Choose the category for the portfolio items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "js_composer"),
            "param_name" => "alt_background",
            "value" => array(__("None", "js_composer") => "none", __("Alt 1", "js_composer") => "alt-one", __("Alt 2", "js_composer") => "alt-two", __("Alt 3", "js_composer") => "alt-three", __("Alt 4", "js_composer") => "alt-four", __("Alt 5", "js_composer") => "alt-five", __("Alt 6", "js_composer") => "alt-six", __("Alt 7", "js_composer") => "alt-seven", __("Alt 8", "js_composer") => "alt-eight", __("Alt 9", "js_composer") => "alt-nine", __("Alt 10", "js_composer") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Flexform Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "js_composer")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "js_composer"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "js_composer")
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