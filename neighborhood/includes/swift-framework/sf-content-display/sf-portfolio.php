<?php

	/*
	*
	*	Swift Page Builder - Portfolio Items Function Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	if ( ! function_exists( 'sf_portfolio_items' ) ) {
		function sf_portfolio_items($display_type, $columns, $show_title, $show_subtitle, $show_excerpt, $excerpt_length, $item_count, $category, $exclude_categories, $pagination, $sidebars) {
			
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
			
			
			/* ITEMS OUTPUT
			================================================== */				
			if ($columns == "1") { 
			$portfolio_items_output .= '<ul class="portfolio-items '.$display_type.'-portfolio single-column filterable-items row clearfix">'. "\n";
			} else {
			$portfolio_items_output .= '<ul class="portfolio-items '.$display_type.'-portfolio filterable-items row clearfix">'. "\n";
			} 
	
			
			while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();								
	
	
				/* META VARIABLES
				================================================== */
				$thumb_image = $thumb_gallery = $video = $item_class = $link_config = '';
				$thumb_width = 800;
				$thumb_height = 600;
				$video_height = 600;
	
				$thumb_type = sf_get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$thumb_video = sf_get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				if ($columns == "1") {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
				} else if ($columns == "2") {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-twocol' );
				} else {
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );				
				}
				$thumb_link_type = sf_get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
				$thumb_link_url = sf_get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
				$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
				$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
				$thumb_lightbox_video_url = sf_get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
				
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
								
				
				/* COLUMN VARIABLE CONFIG
				================================================== */
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
					$thumb_width = 800;
					$thumb_height = 600;
					$video_height = 600;
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
				
				
				/* DISPLAY TYPE CONFIG
				================================================== */
				if ($display_type == "standard") {
					$item_class .= "standard ";
				} else if ($display_type == "gallery") {
					$item_class .= "gallery ";
				}
				
				
				/* LINK TYPE CONFIG
				================================================== */
				if ($thumb_link_type == "link_to_url") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
					$item_icon = "link";
				} else if ($thumb_link_type == "link_to_url_nw") {
					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
					$item_icon = "link";
				} else if ($thumb_link_type == "lightbox_thumb") {
					$link_config = 'href="'.$thumb_img_url.'" class="lightbox" data-rel="ilightbox[portfolio]"';
					$item_icon = "search";
				} else if ($thumb_link_type == "lightbox_image") {
					$lightbox_image_url = '';
					foreach ($thumb_lightbox_image as $image) {
						$lightbox_image_url = $image['full_url'];
					}
					$link_config = 'href="'.$lightbox_image_url.'" class="lightbox" data-rel="ilightbox[portfolio]"';	
					$item_icon = "search";
				} else if ($thumb_link_type == "lightbox_video") {
					$link_config = 'href="'.$thumb_lightbox_video_url.'" class="lightbox" data-rel="ilightbox[portfolio]"';
					$item_icon = "facetime-video";				
				} else {
					$link_config = 'href="'.$permalink.'" class="link-to-post"';
					$item_icon = "chevron-right";
				}
				
				
				/* ITEM OUTPUT
				================================================== */
				$portfolio_items_output .= '<li itemscope itemtype="http://schema.org/CreativeWork	" data-id="id-'. $count .'" class="clearfix portfolio-item '.$item_class.' '. $term_slug .'">'. "\n";		
				
														
				/* THUMBNAIL CONFIG
				================================================== */
				if ($thumb_type != "none") {
				
					$portfolio_items_output .= '<figure>'. "\n";
					
					if ($thumb_type == "video") {
						
						$video = video_embed($thumb_video, $thumb_width, $video_height);
						$portfolio_items_output .= $video;
						
					} else if ($thumb_type == "slider") {
						
						$portfolio_items_output .= '<div class="flexslider thumb-slider"><ul class="slides">'. "\n";
									
						foreach ( $thumb_gallery as $image )
						{
						    $portfolio_items_output .= "<li>";
						    if ($thumb_link_type == "lightbox_thumb") {
						    	$portfolio_items_output .= '<a href="'.$image['url'].'" class="lightbox" data-rel="ilightbox[portfolio]">';
						    } else {	
						    	$portfolio_items_output .= "<a ".$link_config.">";
						    }
						    $portfolio_items_output .= "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a></li>". "\n";
						}
																		
						$portfolio_items_output .= '</ul></div>'. "\n";
						
					} else {
					
						$image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
						
						if($image) {
							$portfolio_items_output .= '<a '.$link_config.'>'. "\n";
							
							if ($columns != "1") {
							
							$portfolio_items_output .= '<div class="overlay"><div class="thumb-info">'. "\n";
							if ($display_type == "standard") {
							$portfolio_items_output .= '<i class="fa-'.$item_icon.'"></i>'. "\n";
							} else {
							$portfolio_items_output .= '<h4 itemprop="name headline">'.$item_title.'</h4>'. "\n";
							$portfolio_items_output .= '<i class="fa-'.$item_icon.' small-icon"></i>'. "\n";
							}
							$portfolio_items_output .= '</div></div>'. "\n";
							
							}
													
							$portfolio_items_output .= '<img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />'. "\n";
							
							$portfolio_items_output .= '</a>'. "\n";
						}
					}
					
					$portfolio_items_output .= '</figure>'. "\n";
				}
				
				if ($display_type == "standard") {
					
					$portfolio_items_output .= '<div class="portfolio-item-details">'. "\n";
					
					if ($show_title == "yes") {
						if ($thumb_link_type == "lightbox_thumb" || $thumb_link_type == "lightbox_image" || $thumb_link_type == "lightbox_video") {
							if ($columns == "1") {
								$portfolio_items_output .= '<h1 class="portfolio-item-title" itemprop="name headline">'. $item_title .'</h1>'. "\n";						
							} else {
								$portfolio_items_output .= '<h4 class="portfolio-item-title" itemprop="name headline">'. $item_title .'</h4>'. "\n";
							}
						} else {
							if ($columns == "1") {
								$portfolio_items_output .= '<h1 class="portfolio-item-title" itemprop="name headline"><a '.$link_config.'>'. $item_title .'</a></h1>'. "\n";						
							} else {
								$portfolio_items_output .= '<h4 class="portfolio-item-title" itemprop="name headline"><a '.$link_config.'>'. $item_title .'</a></h4>'. "\n";
							}
						}
					}
					
					if ($show_subtitle == "yes" && $item_subtitle) {
						if ($columns == "1") {
						$portfolio_items_output .= '<h3 class="portfolio-subtitle" itemprop="alternativeHeadline">'.$item_subtitle.'</h3>'. "\n";
						} else {
						$portfolio_items_output .= '<h5 class="portfolio-subtitle" itemprop="alternativeHeadline">'.$item_subtitle.'</h5>'. "\n";
						}
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
				$portfolio_items_output .= '<div class="pagination-wrap">'. "\n";	
				$portfolio_items_output .= pagenavi($portfolio_items);
				$portfolio_items_output .= '</div>'. "\n";
			}
			
			
			/* FUNCTION OUTPUT
			================================================== */
			return $portfolio_items_output;
		}
	}
	
	
	if ( !function_exists('sf_portfolio_filter') ) {
		function sf_portfolio_filter() {
			
			$filter_output = "";
					
		    $filter_output .= '<div class="filter-wrap row clearfix">'. "\n";
		    $filter_output .= '<a href="#" class="select"><i class="fa-align-justify"></i>'. __("Filter our work", "swiftframework") .'</a>'. "\n";
		    $filter_output .= '<div class="filter-slide-wrap">'. "\n";
		    $filter_output .= '<ul class="portfolio-filter filtering row clearfix">'. "\n";
		    $filter_output .= '<li class="all selected span2"><a data-filter="*" href="#"><span class="item-name">'. __("All", "swiftframework").'</span><span class="item-count">0</span></a></li>'. "\n";
		    			$tax_terms = get_category_list('portfolio-category', 1);
		    			foreach ($tax_terms as $tax_term) {
		    				$term_slug = strtolower(str_replace(' ', '-', $tax_term));
		    				$filter_output .= '<li class="span2"><a href="#" title="View all ' . $tax_term . ' items" class="' . $term_slug . '" data-filter=".' . $term_slug . '"><span class="item-name">' . $tax_term . '</span><span class="item-count">0</span></a></li>'. "\n";
		    			}
		    $filter_output .= '</ul></div></div>'. "\n";
			
			return $filter_output;	
		}
	}
?>