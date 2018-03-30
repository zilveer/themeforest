<?php

class WPBakeryShortCode_portfolio extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $filter_ouput = $output = $tax_terms = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'portfolio_type' => 'basic',
	        	'display_type' => 'standard',
	        	'columns'		=> '4',
	        	'show_title'	=> 'yes',
	        	'show_client'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"excerpt_length" => '20',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	'portfolio_filter'		=> 'yes',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        if ($portfolio_filter == "yes") {
		        $filter_ouput .= '<div class="filter-wrap clearfix">';
		        $filter_ouput .= '<span class="select">'. __("Filter", "swiftframework") .'</span>';
		        $filter_ouput .= '<ul class="portfolio-filter filtering clearfix">';
		        $filter_ouput .= '<li class="all selected"><a data-filter="*" href="#">'. __("All", "swiftframework").'</a></li>';
		        			$tax_terms = get_category_list('portfolio-category', 1);
		        			foreach ($tax_terms as $tax_term) {
		        				$term_slug = strtolower(str_replace(' ', '-', $tax_term));
		        				$filter_ouput .= '<li class=""><a href="#" title="View all ' . $tax_term . ' items" class="' . $term_slug . '" data-filter=".' . $term_slug . '">' . $tax_term . '</a></li>';
		        			}
		        $filter_ouput .= '</ul></div>';
	        }
	        
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    
		    // PORTFOLIO QUERY SETUP
    		
    		global $post, $wp_query;
    		
    		if ( get_query_var('paged') ) {
    		$paged = get_query_var('paged');
    		} elseif ( get_query_var('page') ) {
    		$paged = get_query_var('page');
    		} else {
    		$paged = 1;
    		}
    		    		
    		$portfolio_args=array(
	    		'post_type' => 'portfolio',
	    		'post_status' => 'publish',
	    		'paged' => $paged,
	    		'portfolio-category' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
       		    		
    		$portfolio_items = new WP_Query( $portfolio_args );
    		
    		$count = 0;
    		
    		
    		// LIST CLASS SETUP BASED ON SELECTED OPTIONS
    		    		
			$list_class = '';
			
			if (($display_type == "bordered") || ($display_type == "bordered_gallery")) {
			$list_class .= 'bordered-items ';
			} 
			
			if ($portfolio_type == "masonry") {
			$list_class .= 'masonry-items';
			}
			
			$items .= '<ul class="portfolio-items filterable-items '. $list_class .' clearfix">';
			
			
			// PORTFOLIO LOOP
			
			while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();								

				// META VARIABLES
				
				$thumb_image = $video = $item_class = $link_config = '';
				$thumb_width = 420;
				$thumb_height = 315;
				$video_height = 315;
				$bordered_thumb_width = 408;
				$bordered_thumb_height = 303;
				$bordered_video_height = 303;
				
				if ($portfolio_type == "masonry") {
				$thumb_height = NULL;
				$video_height = 315;
				$bordered_thumb_height = NULL;
				}
				
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
				
				$item_title = get_the_title();
				$item_client = get_post_meta($post->ID, 'sf_portfolio_client', true);
				$permalink = get_permalink();
				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
				} else {
				$post_excerpt = excerpt($excerpt_length);
				}
				
				$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
				
				$post_terms = get_the_terms( $post->ID, 'portfolio-category' );
				$term_slug = " ";
				
				if(!empty($post_terms)){
					foreach($post_terms as $post_term){
						$term_slug = $term_slug . strtolower(str_replace(' ', '-', $post_term->name)) . ' ';
					}
				}
								
				// COLUMN OPTION VARIABLES
				
				$item_class = $item_icon = "";
				    				    				
				if ($columns == "1") {
					$item_class = "one-col ";
					$excerpt = get_the_excerpt();
					$thumb_width = 940;
					$thumb_height = NULL;
					$video_height = 528;
					$bordered_thumb_width = 928;
					$bordered_thumb_height = NULL;
					$bordered_video_height = 522;
				} else if ($columns == "2") {
					$item_class = "eight ";
				} else if ($columns == "3") {
					$item_class = "thirds ";
				} else if ($columns == "4") {
					$item_class = "four ";
				}
				
				
				// DISPLAY TYPE VARIABLES
				
				if ($display_type == "standard") {
					$item_class .= "standard ";
				} else if ($display_type == "bordered") {
				    $item_class .= "bordered ";
				} else if ($display_type == "gallery") {
					$item_class .= "gallery ";
					} else if ($display_type == "bordered_gallery") {
					$item_class .= "gallery bordered ";
				}
				
				if ($thumb_type == "image") {
					$item_class .= "image-item";
				}
				
				
				// LINK TYPE VARIABLES
				
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
					$link_config = 'href="'.$thumb_lightbox_video_url.'" class="fancybox-media"';
					$item_icon = "facetime-video";				
				} else {
					$link_config = 'href="'.$permalink.'" class="link-to-post"';
					$item_icon = "file-alt";
				}
				
				    				
				$items .= '<li data-id="id-'. $count .'" class="clearfix portfolio-item '.$item_class.' columns'. $term_slug .'">';
				    				
				$items .= '<figure>';
														
				// THUMBNAIL MEDIA TYPE SETUP
				
				if ($thumb_type == "video") {
    				
    				if (($display_type == "bordered") || ($display_type == "bordered_gallery")) {
    					$video = video_embed($thumb_video, $bordered_thumb_width, $bordered_video_height);
    				} else {
    					$video = video_embed($thumb_video, $thumb_width, $video_height);
    				}
    				
    				$items .= $video;
    				
				} else if ($thumb_type == "slider") {
					
					$items .= '<div class="flexslider thumb-slider"><ul class="slides">';
								
					foreach ( $thumb_gallery as $image )
					{
					    $items .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
					}
																	
					$items .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>';
					
				} else {
				
					if (($display_type == "bordered") || ($display_type == "bordered_gallery")) {
						$image = aq_resize( $thumb_img_url, $bordered_thumb_width, $bordered_thumb_height, true, false);
					} else {
					    $image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
					}
					
					if($image) {
						$items .= '<a '.$link_config.'>';
						
						$items .= '<div class="overlay"><div class="thumb-info">';
						if (($display_type == "gallery") || ($display_type == "bordered_gallery")) {
						$items .= '<h4>'.$item_title.'</h4>';
						$items .= '<i class="icon-'.$item_icon.' small-icon"></i>';
						} else {
						$items .= '<i class="icon-'.$item_icon.'"></i>';
						}
						$items .= '</div></div>';
						
						$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />';
						
						$items .= '</a>';
					}
				}
				
				$items .= '</figure>';
				
				
				// ITEM INFO SETUP
				
				if (($display_type != "gallery") && ($display_type != "bordered_gallery")) {
				$items .= '<div class="portfolio-item-details">';
				if ($show_title == "yes") {
				$items .= '<h4 class="portfolio-item-title"><a '.$link_config.'>'. $item_title .'</a></h4>';
				}
				if ($show_client == "yes" && $item_client) {
				$items .= '<span class="portfolio-client-title">'.$item_client.'</span>';
				}
				if ($show_excerpt == "yes") {
				$items .= '<div class="portfolio-item-excerpt">'. $post_excerpt .'</div>';
				}
				$items .= '</div>';
				}
				$items .= '</li>';
				
				$count++;
			
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>';
			
			
			// PAGINATION
			
			if ($pagination == "yes") {
			
				$items .= '<div class="pagination-wrap">';
				
				$items .= pagenavi($portfolio_items);
									
				$items .= '</div>';
			
			}
						
			// PAGE BUILDER OUPUT
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_portfolio_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper portfolio-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h2 class="wpb_heading"><span>'.$title.'</span></h2></div>' : '';
            if ($portfolio_filter == "yes") {
            $output .= "\n\t\t\t\t".$filter_ouput;
            }
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_isotope;
            global $has_portfolio;
            $include_isotope = true;
            $has_portfolio = true;

            return $output;
		
    }
}

WPBMap::map( 'portfolio', array(
    "name"		=> __("Portfolio", "js_composer"),
    "base"		=> "portfolio",
    "class"		=> "wpb_portfolio",
    "icon"      => "icon-wpb-portfolio",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Portfolio type", "js_composer"),
            "param_name" => "portfolio_type",
            "value" => array(__('Default', "js_composer") => "default", __('Masonry', "js_composer") => "masonry"),
            "description" => __("Select the type of portfolio you'd like to show.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Display type", "js_composer"),
            "param_name" => "display_type",
            "value" => array(__('Standard', "js_composer") => "standard", __('Bordered', "js_composer") => "bordered", __('Gallery', "js_composer") => "gallery", __('Bordered gallery', "js_composer") => "bordered_gallery"),
            "description" => __("Select the type of portfolio you'd like to show.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Column count", "js_composer"),
            "param_name" => "columns",
            "value" => array("4", "3", "2", "1"),
            "description" => __("How many portfolio columns to display.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "js_composer"),
            "param_name" => "show_title",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show the item title text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show client text", "js_composer"),
            "param_name" => "show_client",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show the item client text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "js_composer"),
            "param_name" => "show_excerpt",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show the item excerpt text.", "js_composer")
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
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of portfolio items to show per page. Leave blank to show ALL portfolio items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Portfolio category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('portfolio-category'),
            "description" => __("Choose the category from which you'd like to show the portfolio items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Filter", "js_composer"),
            "param_name" => "portfolio_filter",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show the portfolio category filter above the items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "js_composer"),
            "param_name" => "pagination",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show portfolio pagination.", "js_composer")
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