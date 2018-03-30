<?php

	/*
	*
	*	Swift Page Builder - Portfolio Items Function Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_portfolio_items()
	*	sf_portfolio_filter()
	*
	*/
	
	/* PORTFOLIO ITEMS
	================================================== */
	if (!function_exists('sf_portfolio_items')) { 
		function sf_portfolio_items($display_type, $columns, $show_title, $show_subtitle, $show_excerpt, $hover_show_excerpt, $excerpt_length, $item_count, $category, $exclude_categories, $pagination, $sidebars) {
			
			/* OUTPUT VARIABLE
			================================================== */ 
			$portfolio_items_output = "";
			$count = 0;
			
	        /* CATEGORY SLUG MODIFICATION
	        ================================================== */ 
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    
		    /* PORTFOLIO QUERY SETUP
		    ================================================== */ 
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
	    		'posts_per_page' => $item_count,
	    		'tax_query' => array(
	    				array(
	    					'taxonomy' => 'portfolio-category',
	    					'field' => 'id',
	    					'terms' => array( $exclude_categories ),
	    					'operator' => 'NOT IN'
	    				)
	    			)
	   		);
	   		    		
			$portfolio_items = new WP_Query( $portfolio_args );
			
			
			/* LIST CLASS CONFIG
			================================================== */ 
			$list_class = '';
			if ($display_type == "masonry" || $display_type == "masonry-gallery") {
			$list_class .= 'masonry-items filterable-items col-'.$columns.' row clearfix';
			} else if ($display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
			$list_class .= 'masonry-items masonry-fw filterable-items col-'.$columns.' row clearfix';
			} else if ($display_type == "gallery") {
			$list_class .= 'gallery-portfolio filterable-items col-'.$columns.' row clearfix';
			} else {
			$list_class .= 'standard-portfolio filterable-items col-'.$columns.' row clearfix';
			}
			
			
			/* ITEMS OUTPUT
			================================================== */
			$options = get_option('sf_dante_options');
			$enable_portfolio_gallery = false;
			if ( isset($options['enable_portfolio_gallery']) ) {
			$enable_portfolio_gallery = $options['enable_portfolio_gallery'];
			}
			
			$portfolio_items_output .= '<ul class="portfolio-items '.$list_class.'">'. "\n";
			
			while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();								
	
	
				/* META VARIABLES
				================================================== */
				$thumb_image = $thumb_gallery = $video = $item_class = $link_config = '';
				$thumb_width = 420;
				$thumb_height = 315;
				$video_height = 315;
	
				$thumb_type = sf_get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$thumb_video = sf_get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				if ($columns == "2") {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-twocol' );
				} else {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );				
				}
				$thumb_link_type = sf_get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
				$thumb_link_url = sf_get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
				$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
				$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
				$thumb_lightbox_video_url = sf_get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
				$thumb_lightbox_video_url = sf_get_embed_src($thumb_lightbox_video_url);
				
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
				$item_subtitle = sf_get_post_meta($post->ID, 'sf_portfolio_subtitle', true);
				$permalink = get_permalink();
				$custom_excerpt = sf_get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = sf_custom_excerpt($custom_excerpt, $excerpt_length);
				} else {
				$post_excerpt = sf_excerpt($excerpt_length);
				}
				
				$post_terms = get_the_terms( $post->ID, 'portfolio-category' );
				$term_slug = " ";
				
				if(!empty($post_terms)){
					foreach($post_terms as $post_term){
						$filter = preg_replace( "/[^A-Za-z0-9-]/i", "", ( strtolower( str_replace( ' ', '-', $post_term->slug ) ) ) );
						$term_slug = $term_slug . $filter . ' ';
					}
				}
								
				
				/* COLUMN VARIABLE CONFIG
				================================================== */
				$item_class = $item_icon = "";
				    				    				
				if ($columns == "2") {
					if ($sidebars == "both-sidebars") {
					$item_class = "col-sm-6 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "col-sm-6 ";
					} else {
					$item_class = "col-sm-6 ";
					$thumb_width = 800;
					$thumb_height = 600;
					$video_height = 600;
					}
				} else if ($columns == "3") {
					if ($sidebars == "both-sidebars") {
					$item_class = "col-sm-4 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "col-sm-4 ";
					} else {
					$item_class = "col-sm-4 ";
					$thumb_width = 600;
					$thumb_height = 450;
					$video_height = 450;
					}
				} else if ($columns == "4") {
					if ($sidebars == "both-sidebars") {
					$item_class = "col-sm-3 ";
					} else if ($sidebars == "one-sidebar") {
					$item_class = "col-sm-3 ";
					} else {
					$item_class = "col-sm-3 ";
					}
				}
								
				if ($display_type == "masonry" || $display_type == "masonry-gallery" || $display_type == "masonry=fw" || $display_type == "masonry-gallery-fw") {
					$thumb_height = NULL;
				}
				
				
				/* DISPLAY TYPE CONFIG
				================================================== */
				if ($display_type == "masonry" || $display_type == "masonry-gallery" || $display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
					$item_class .= "masonry-item masonry-gallery-item";
				} else if ($display_type == "gallery") {
					$item_class .= "gallery-item ";
				} else {
					$item_class .= "standard ";
				}
				
				
				/* LINK TYPE CONFIG
				================================================== */
				if ($thumb_link_type == "link_to_url") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
					$item_icon = "ss-link";
				} else if ($thumb_link_type == "link_to_url_nw") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
					$item_icon = "ss-link";
				} else if ($thumb_link_type == "lightbox_thumb") {
					if ($enable_portfolio_gallery) {
					$link_config = 'href="'.$thumb_img_url.'" class="lightbox" data-rel="ilightbox[portfolio]"';
					} else {
					$link_config = 'href="'.$thumb_img_url.'" class="lightbox" data-rel="ilightbox['.$post->ID.']"';
					}					
					$item_icon = "ss-view";
				} else if ($thumb_link_type == "lightbox_image") {
					$lightbox_image_url = '';
					foreach ($thumb_lightbox_image as $image) {
						$lightbox_image_url = $image['full_url'];
					}
					if ($enable_portfolio_gallery) {
					$link_config = 'href="'.$lightbox_image_url.'" class="lightbox" data-rel="ilightbox[portfolio]"';
					} else {
					$link_config = 'href="'.$lightbox_image_url.'" class="lightbox" data-rel="ilightbox['.$post->ID.']"';
					}			
					$item_icon = "ss-view";
				} else if ($thumb_link_type == "lightbox_video") {
					$link_config = 'data-video="'.$thumb_lightbox_video_url.'" href="#" class="fw-video-link"';
					$item_icon = "ss-video";				
				} else {
					$link_config = 'href="'.$permalink.'" class="link-to-post"';
					$item_icon = "ss-navigateright";
				}
				
				
				/* ITEM OUTPUT
				================================================== */
				$portfolio_items_output .= '<li itemscope itemtype="http://schema.org/CreativeWork" data-id="id-'. $count .'" class="clearfix portfolio-item '.$item_class.' '. $term_slug .'">'. "\n";		
				
														
				/* THUMBNAIL CONFIG
				================================================== */
				if ($thumb_type != "none") {
					
					if ($display_type == "gallery" || $display_type == "masonry-gallery" || $display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
					$portfolio_items_output .= '<figure class="animated-overlay">'. "\n";
					} else {
					$portfolio_items_output .= '<figure class="animated-overlay overlay-alt">'. "\n";				
					}
					
					if ($thumb_type == "video") {
						
						$video = sf_video_embed($thumb_video, $thumb_width, $video_height);
						$portfolio_items_output .= $video;
						
					} else if ($thumb_type == "slider") {
						
						$portfolio_items_output .= '<div class="flexslider thumb-slider"><ul class="slides">'. "\n";
									
						foreach ( $thumb_gallery as $image )
						{
						    $portfolio_items_output .= "<li><a ".$link_config."><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a></li>". "\n";
						}
																		
						$portfolio_items_output .= '</ul></div>'. "\n";
						
					} else {
						
						if ($thumb_type == "image" && $thumb_img_url == "") {
							$thumb_img_url = "default";
						}
					
						$image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
						
						if($image) {
																		
							$portfolio_items_output .= '<img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />'. "\n";
							
							$portfolio_items_output .= '<a '.$link_config.'></a>';
							if ($item_subtitle != "" && $hover_show_excerpt == "no" && ($display_type == "gallery" || $display_type == "masonry-gallery" || $display_type == "masonry-gallery-fw")) {
							$portfolio_items_output .= '<figcaption><div class="thumb-info thumb-info-extended">';
							} else if ($display_type == "standard" || $display_type == "masonry" || $display_type == "masonry-fw") {
							$portfolio_items_output .= '<figcaption><div class="thumb-info thumb-info-alt">';						
							} else if ($hover_show_excerpt == "yes" && ($display_type == "gallery" || $display_type == "masonry-gallery" || $display_type == "masonry-gallery-fw")) {
							$portfolio_items_output .= '<figcaption><div class="thumb-info thumb-info-excerpt">';						
							} else {
							$portfolio_items_output .= '<figcaption><div class="thumb-info">';
							}
							if ($display_type == "gallery" || $display_type == "masonry-gallery" || $display_type == "masonry-gallery-fw") {
								if ($hover_show_excerpt == "yes") {
								$portfolio_items_output .= '<h4 itemprop="name headline">'.$item_title.'</h4>';
								$portfolio_items_output .= '<div itemprop="description">'.$post_excerpt.'</div>';
								} else {
								$portfolio_items_output .= '<h4 itemprop="name headline">'.$item_title.'</h4>';
								$portfolio_items_output .= '<h5 itemprop="name alternative">'.$item_subtitle.'</h5>';
								}
							}
							$portfolio_items_output .= '<i class="'.$item_icon.'"></i>';
							$portfolio_items_output .= '</div></figcaption>';
						}
					}
					
					$portfolio_items_output .= '</figure>'. "\n";
				}
				
				if ($display_type != "gallery" && $display_type != "masonry-gallery" && $display_type != "masonry-gallery-fw") {
					
					$portfolio_items_output .= '<div class="portfolio-item-details">'. "\n";
					
					$portfolio_items_output .= '<div class="comments-likes">';
					if (function_exists( 'lip_love_it_link' )) {
						$portfolio_items_output .= lip_love_it_link(get_the_ID(), '<i class="ss-heart"></i>', '<i class="ss-heart"></i>', false);
					}
					$portfolio_items_output .= '</div>';
					
					
					if ($show_title == "yes") {
						if ($enable_portfolio_gallery) {
							$portfolio_items_output .= '<h3 class="portfolio-item-title" itemprop="name headline"><a href="'.$permalink.'" class="link-to-post">'. $item_title .'</a></h3>'. "\n";
						} else {
							$portfolio_items_output .= '<h3 class="portfolio-item-title" itemprop="name headline"><a href="'.$permalink.'" class="link-to-post">'. $item_title .'</a></h3>'. "\n";
						}
					}
					if ($show_subtitle == "yes" && $item_subtitle) {
						$portfolio_items_output .= '<h5 class="portfolio-subtitle" itemprop="alternativeHeadline">'.$item_subtitle.'</h5>'. "\n";
					}
					if ($show_excerpt == "yes") {
						$portfolio_items_output .= '<div class="portfolio-item-excerpt" itemprop="description">'. $post_excerpt .'</div>'. "\n";
					}
					
					$portfolio_items_output .= '</div>'. "\n";
					
				}
				
				$portfolio_items_output .= '</li>'. "\n";
				
				$count++;
			
			endwhile;
			
			wp_reset_postdata();
					
			$portfolio_items_output .= '</ul>'. "\n";
			
			
			/* PAGINATION OUTPUT
			================================================== */
			if ($pagination == "yes") {
				if ($display_type == "masonry" || $display_type == "masonry-gallery"  || $display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
				$portfolio_items_output .= '<div class="pagination-wrap masonry-pagination">';
				} else {
				$portfolio_items_output .= '<div class="pagination-wrap">';
				}
				$portfolio_items_output .= pagenavi($portfolio_items);									
				$portfolio_items_output .= '</div>';
			}
			
			
			/* FUNCTION OUTPUT
			================================================== */
			return $portfolio_items_output;
		}
	}	
	
	
	/* PORTFOLIO FILTER
	================================================== */
	if (!function_exists('sf_portfolio_filter')) { 
		function sf_portfolio_filter($style = "basic", $parent_category = "") {
						
			$filter_output = $tax_terms = "";
			
			$options = get_option('sf_dante_options');
			$filter_wrap_bg = $options['filter_wrap_bg'];
			
			if ($parent_category == "" || $parent_category == "all") {
				$tax_terms = sf_get_category_list('portfolio-category', 1);
			} else {
				$tax_terms = sf_get_category_list('portfolio-category', 1, $parent_category);
			}
			
			if ($style == "slide-out") {
			
		    $filter_output .= '<div class="filter-wrap slideout-filter row clearfix">'. "\n";
		    $filter_output .= '<a href="#" class="select"><i class="fa-justify"></i>'. __("Filter our work", "swiftframework") .'</a>'. "\n";
		    $filter_output .= '<div class="filter-slide-wrap col-sm-12 asset-bg '.$filter_wrap_bg.'">'. "\n";
		    $filter_output .= '<ul class="portfolio-filter filtering row clearfix">'. "\n";
		    $filter_output .= '<li class="all selected col-sm-2"><a data-filter="*" href="#"><span class="item-name">'. __("All", "swiftframework").'</span><span class="item-count">0</span></a></li>'. "\n";
			foreach ($tax_terms as $tax_term) {
				$term = get_term_by('name', $tax_term, 'portfolio-category');				
				if ($term) {
				$filter = preg_replace( "/[^A-Za-z0-9-]/i", "", ( strtolower( $term->slug ) ) );
				$filter_output .= '<li class="col-sm-2"><a href="#" title="View all ' . $term->name . ' items" class="' . $filter . '" data-filter=".' . $filter . '"><span class="item-name">' . $term->name . '</span><span class="item-count">0</span></a></li>'. "\n";
				} else {
   				$filter = preg_replace( "/[^A-Za-z0-9-]/i", "", ( strtolower( $tax_term ) ) );
				$filter_output .= '<li class="col-sm-2"><a href="#" title="View all ' . $tax_term . ' items" class="' . $filter . '" data-filter=".' . $filter . '"><span class="item-name">' . $tax_term . '</span><span class="item-count">0</span></a></li>'. "\n";
				}
			}
		    $filter_output .= '</ul></div></div>'. "\n";
		    
		    } else {
		    
			    if ($style == "full-width") {
			    	$filter_output .= '<div class="container">';
			    }
			    
			    $filter_output .= '<div class="filter-wrap row clearfix">'. "\n";
			    $filter_output .= '<ul class="portfolio-filter-tabs bar-styling filtering col-sm-12 clearfix">'. "\n";
			    $filter_output .= '<li class="all selected"><a data-filter="*" href="#"><span class="item-name">'. __("All", "swiftframework").'</span><span class="item-count">0</span></a></li>'. "\n";
    			foreach ($tax_terms as $tax_term) {
    				$term = get_term_by('slug', $tax_term, 'portfolio-category');
    				if ($term) {
    				$filter = preg_replace( "/[^A-Za-z0-9-]/i", "", ( strtolower( $term->slug ) ) );
    				$filter_output .= '<li><a href="#" title="View all ' . $term->name . ' items" class="' . $filter . '" data-filter=".' . $filter . '"><span class="item-name">' . $term->name . '</span><span class="item-count">0</span></a></li>'. "\n";
    				} else {
    				$filter = preg_replace( "/[^A-Za-z0-9-]/i", "", ( strtolower( $tax_term ) ) );
    				$filter_output .= '<li><a href="#" title="View all ' . $tax_term . ' items" class="' . $filter . '" data-filter=".' . $filter . '"><span class="item-name">' . $tax_term . '</span><span class="item-count">0</span></a></li>'. "\n";
    				}
    			}
			    $filter_output .= '</ul></div>'. "\n";
			    
			    if ($style == "full-width") {
			    	$filter_output .= '</div>';
			    }
		    
		    }
			
			return $filter_output;	
		}
	}
?>