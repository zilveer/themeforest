<?php

class WPBakeryShortCode_portfolio extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $filter_output = $output = $tax_terms = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'display_type' => 'standard',
	        	'columns'		=> '4',
	        	'show_title'	=> 'yes',
	        	'show_subtitle'	=> 'yes',
	        	'show_excerpt'	=> 'no',
	        	"excerpt_length" => '20',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	'portfolio_filter'		=> 'yes',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	          
	        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
	        
	        $sidebars = '';
	        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
	        $sidebars = 'one-sidebar';
	        } else if ($sidebar_config == "both-sidebars") {
	        $sidebars = 'both-sidebars';
	        } else {
	        $sidebars = 'no-sidebars';
	        }
	        
	        $options = get_option('sf_flexform_options');
	        $filter_wrap_bg = $options['filter_wrap_bg'];
	        
	        if ($portfolio_filter == "yes" && $sidebars == "no-sidebars") {
	        	$tax_terms = "";
	        	
	        	if ( $category == "" || $category == "All" ) {
	        	    $tax_terms = $tax_terms = get_category_list('portfolio-category', 1, "");
	        	} else {
	        	    $tax_terms = $tax_terms = get_category_list('portfolio-category', 1, $category);
	        	}
	        	
		        $filter_output .= '<div class="filter-wrap row clearfix">'. "\n";
		        $filter_output .= '<a href="#" class="select"><i class="icon-align-justify"></i>'. __("Filter our work", "swiftframework") .'</a>'. "\n";
		        $filter_output .= '<div class="filter-slide-wrap span12 alt-bg '.$filter_wrap_bg.'">'. "\n";
		        $filter_output .= '<ul class="portfolio-filter filtering row clearfix">'. "\n";
		        $filter_output .= '<li class="all selected span2"><a data-filter="*" href="#"><span class="item-name">'. __("All", "swiftframework").'</span><span class="item-count">0</span></a></li>'. "\n";
    			foreach ($tax_terms as $tax_term) {
    				$term_slug = strtolower(str_replace(' ', '-', $tax_term));
    				$filter_output .= '<li class="span2"><a href="#" title="View all ' . $tax_term . ' items" class="' . $term_slug . '" data-filter=".' . $term_slug . '"><span class="item-name">' . $tax_term . '</span><span class="item-count">0</span></a></li>'. "\n";
    			}
		        $filter_output .= '</ul></div></div>'. "\n";
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
    		
    		if ($columns == "1") { 
    		$items .= '<ul class="portfolio-items '.$display_type.'-portfolio single-column filterable-items row clearfix">'. "\n";
			} else {
    		$items .= '<ul class="portfolio-items '.$display_type.'-portfolio filterable-items row clearfix">'. "\n";
			}
			
			// PORTFOLIO LOOP
			
			while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();								

				// META VARIABLES
				
				$thumb_image = $thumb_gallery = $video = $item_class = $link_config = '';
				$thumb_width = 420;
				$thumb_height = 315;
				$video_height = 315;

				$thumb_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$thumb_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				if ($columns == "1") {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
				} else if ($columns == "2") {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-twocol' );
				} else {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );				
				}
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
				$item_subtitle = get_post_meta($post->ID, 'sf_portfolio_subtitle', true);
				$permalink = get_permalink();
				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
				} else {
				$post_excerpt = excerpt($excerpt_length);
				}
								
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
					if ($sidebars == "both-sidebars") {
					$item_class = "span6 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "span8 ";
					} else {
					$item_class = "span10 offset1 ";
					}
					$excerpt = get_the_excerpt();
					$thumb_width = 970;
					$thumb_height = NULL;
					$video_height = 545;
				} else if ($columns == "2") {
					if ($sidebars == "both-sidebars") {
					$item_class = "span3 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "span4 ";
					} else {
					$item_class = "span6 ";
					$thumb_width = 600;
					$thumb_height = 450;
					$video_height = 450;
					}
				} else if ($columns == "3") {
					if ($sidebars == "both-sidebars") {
					$item_class = "span2 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "span-third ";
					} else {
					$item_class = "span4 ";
					}
				} else if ($columns == "4") {
					if ($sidebars == "both-sidebars") {
					$item_class = "span3 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "span2 ";
					} else {
					$item_class = "span3 ";
					}
				}
				
				
				// DISPLAY TYPE VARIABLES
				
				if ($display_type == "standard") {
					$item_class .= "standard ";
				} else if ($display_type == "gallery") {
					$item_class .= "gallery ";
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
					$link_config = 'href="'.$thumb_lightbox_video_url.'" rel="prettyPhoto"';
					$item_icon = "facetime-video";				
				} else {
					$link_config = 'href="'.$permalink.'" class="link-to-post"';
					$item_icon = "chevron-right";
				}
				
				$items .= '<li data-id="id-'. $count .'" class="clearfix portfolio-item '.$item_class.' '. $term_slug .'">'. "\n";
				
				if ($thumb_type != "none") {
				
				$items .= '<figure>'. "\n";
														
					// THUMBNAIL MEDIA TYPE SETUP
					
					if ($thumb_type == "video") {
	    				
	    				$video = video_embed($thumb_video, $thumb_width, $video_height);
	    				$items .= $video;
	    				
					} else if ($thumb_type == "slider") {
						
						$items .= '<div class="flexslider thumb-slider"><ul class="slides">'. "\n";
									
						foreach ( $thumb_gallery as $image )
						{
						    $items .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>". "\n";
						}
																		
						$items .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>'. "\n";
						
					} else {
					
						$image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
						
						if($image) {
							$items .= '<a '.$link_config.'>'. "\n";
							
							if ($columns != "1") {
							
							$items .= '<div class="overlay"><div class="thumb-info">'. "\n";
							if ($display_type == "standard") {
							$items .= '<i class="icon-'.$item_icon.'"></i>'. "\n";
							} else {
							$items .= '<h4>'.$item_title.'</h4>'. "\n";
							$items .= '<i class="icon-'.$item_icon.' small-icon"></i>'. "\n";
							}
							$items .= '</div></div>'. "\n";
							
							}
													
							$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />'. "\n";
							
							$items .= '</a>'. "\n";
						}
					}
					
					$items .= '</figure>'. "\n";
				
				}
				
				// MASONRY ITEM
				if ($display_type == "standard") {
					
					$items .= '<div class="portfolio-item-details">'. "\n";
					
					if ($show_title == "yes") {
						if ($columns == "1") {
						$items .= '<h1 class="portfolio-item-title"><a '.$link_config.'>'. $item_title .'</a></h1>'. "\n";						
						} else {
						$items .= '<h4 class="portfolio-item-title"><a '.$link_config.'>'. $item_title .'</a></h4>'. "\n";
						}
					}
					if ($show_subtitle == "yes" && $item_subtitle) {
						if ($columns == "1") {
						$items .= '<h3 class="portfolio-subtitle">'.$item_subtitle.'</h3>'. "\n";
						} else {
						$items .= '<h5 class="portfolio-subtitle">'.$item_subtitle.'</h5>'. "\n";
						}
					}
					if ($show_excerpt == "yes") {
						$items .= '<div class="portfolio-item-excerpt">'. $post_excerpt .'</div>'. "\n";
					}
					
					$items .= '</div>'. "\n";
					
				}
				
				$items .= '</li>'. "\n";
				
				$count++;
			
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>'. "\n";
			
			
			// PAGINATION
			
			if ($pagination == "yes") {
			
				$items .= '<div class="pagination-wrap">'. "\n";
				
				$items .= pagenavi($portfolio_items);
									
				$items .= '</div>'. "\n";
			
			}
						
			// PAGE BUILDER OUPUT
    		$width = wpb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="wpb_portfolio_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper portfolio-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading">'.$title.'</h3></div>' : '';
            if ($portfolio_filter == "yes") {
            $output .= "\n\t\t\t".$filter_output;
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
            "heading" => __("Display type", "js_composer"),
            "param_name" => "display_type",
            "value" => array(__('Standard', "js_composer") => "standard", __('Gallery', "js_composer") => "gallery"),
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
            "heading" => __("Show subtitle text", "js_composer"),
            "param_name" => "show_subtitle",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Show the item subtitle text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "js_composer"),
            "param_name" => "show_excerpt",
            "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
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
            "type" => "select-multiple",
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
            "description" => __("Show the portfolio category filter above the items. NOTE: This is only available on a page with the no sidebar setup.", "js_composer")
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