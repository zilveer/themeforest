<?php

	/*
	*
	*	Swift Page Builder - Blog Items Function Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_blog_items()
	*	sf_blog_aux()
	*
	*/
	
	/* BLOG ITEMS
	================================================== */ 
	if (!function_exists('sf_blog_items')) {
		function sf_blog_items($blog_type, $masonry_effect_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more, $item_count, $category, $exclude_categories, $pagination, $sidebar_config, $width, $offset, $posts_order) {
		
			$blog_items_output = "";
			
			$options = get_option('sf_dante_options');
			$filter_wrap_bg = $options['filter_wrap_bg'];
			
			global $sf_sidebar_config;
			$sf_sidebar_config = $sidebar_config;
			
			/* CATEGORY SLUG MODIFICATION
			================================================== */ 
			if ($category == "All") {$category = "all";}
			if ($category == "all") {$category = '';}
			$category_slug = str_replace('_', '-', $category);
			
			
			/* BLOG QUERY SETUP
			================================================== */ 
			global $post, $wp_query;
			
			if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
			$offset = $offset + ($item_count * ($paged - 1));
			} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
			$offset = $offset + ($item_count * ($paged - 1));
			} else {
			$paged = 1;
			}

			$blog_args = array();
			$category_array = explode(",", $category_slug);
			if (isset($category_array) && $category_array[0] != "") {
				$blog_args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page' => $item_count,
					'offset' => $offset,
					'order' => $posts_order,
					'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => $category_array
								)
							)
					
				);
			} else {
				$blog_args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page' => $item_count,
					'offset' => $offset,
					'order' => $posts_order,	
				);
			}
				    		
			$blog_items = new WP_Query( $blog_args );
			
			
			/* LIST CLASS CONFIG
			================================================== */ 
			$list_class = $wrap_class = '';
			if ($blog_type == "masonry" || $blog_type == "masonry-fw") {
			$list_class .= 'masonry-items first-load grid '.$masonry_effect_type;
			} else if ($blog_type == "mini") {
			$list_class .= 'mini-items';
			} else {
			$list_class .= 'standard-items';
			if ($sidebar_config == "no-sidebars") {
				$wrap_class .= 'col-sm-8 col-sm-offset-2';
			}
			}
			
			
			/* BLOG ITEMS OUTPUT
			================================================== */ 
			$blog_items_output .= '<div class="blog-items-wrap blog-'.$blog_type.' '.$wrap_class.'">';
			if ($blog_type == "standard") {
				$blog_items_output .= '<div class="timeline"></div>';
			}
			if ($blog_type == "masonry" || $blog_type == "masonry-fw") {
			$blog_items_output .= '<ul class="blog-items row '. $list_class .' clearfix" id="blogGrid">';
			} else {
			$blog_items_output .= '<ul class="blog-items row '. $list_class .' clearfix">';		
			}
			
			while ( $blog_items->have_posts() ) : $blog_items->the_post();
				    				
				$post_format = get_post_format($post->ID);
				if ( $post_format == "" ) {
					$post_format = 'standard';
				} 
				
				if ($blog_type == "mini") {
					$item_class = "col-sm-12";
				} else if ($blog_type == "masonry") {
					if ($sidebar_config == "both-sidebars") {
					$item_class = "col-sm-3";
					} else {
					$item_class = "col-sm-4";
					}
				} else if ($blog_type == "masonry-fw") { 
					$item_class = "col-sm-3";
				} else {
					$item_class = $width;
				}
				
				
				/* BLOG ITEM OUTPUT
				================================================== */ 
				$blog_items_output .= '<li itemscope itemtype="http://schema.org/BlogPosting" class="blog-item '.$item_class.' '.implode(' ',get_post_class()).'" id="'.get_the_ID().'">';
				$blog_items_output .= sf_get_post_item($post->ID, $blog_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more);
				$blog_items_output .= '</li>';
				
				
			endwhile;
			
			wp_reset_postdata();
			
			$blog_items_output .= '</ul>';
			
				
			/* PAGINATION OUTPUT
			================================================== */ 
			if ($pagination == "infinite-scroll") {
				
				global $sf_include_infscroll;
				$sf_include_infscroll = true;	
				
				$blog_items_output .= '<div class="pagination-wrap inf-scroll-pagination hidden">';
				$blog_items_output .= pagenavi($blog_items);									
				$blog_items_output .= '</div>';
				
			} else if ($pagination == "load-more") {
				
				global $sf_include_infscroll;
				$sf_include_infscroll = true;	
				
				$blog_items_output .= '<a href="#" class="load-more-btn">'.__('Load More', 'swiftframework').'</a>';
				
				$blog_items_output .= '<div class="pagination-wrap load-more hidden">';
				$blog_items_output .= pagenavi($blog_items);									
				$blog_items_output .= '</div>';
				
			} else if ($pagination == "standard") {
				if ($blog_type == "masonry" || $blog_type == "masonry-fw") {
				$blog_items_output .= '<div class="pagination-wrap masonry-pagination">';
				} else {
				$blog_items_output .= '<div class="pagination-wrap">';
				}
				$blog_items_output .= pagenavi($blog_items);									
				$blog_items_output .= '</div>';
			}
			
			
			$blog_items_output .= '</div>';
			
			
			/* FUNCTION OUTPUT
			================================================== */
			return $blog_items_output;
			
		}
	}
	
	
	/* BLOG AUX
	================================================== */ 
	if (!function_exists('sf_blog_aux')) {
		function sf_blog_aux($width) {
			
			$blog_aux_output = "";
			$options = get_option('sf_dante_options');
			$filter_wrap_bg = $options['filter_wrap_bg'];
			$rss_feed_url = $options['rss_feed_url'];
			
			 		
			$category_list = wp_list_categories('sort_column=name&title_li=&depth=-1&number=60&echo=0&show_count=1');
			$archive_list =  wp_get_archives('type=monthly&limit=12&echo=0');
			$tags_list = wp_tag_cloud('smallest=12&largest=12&unit=px&format=list&number=60&orderby=name&echo=0');
			
			$blog_aux_output .= '<div class="blog-aux-wrap row">'; // open .blog-aux-wrap
			$blog_aux_output .= '<ul class="blog-aux-options bar-styling '.$width.'">'; // open .blog-aux-options
			
			// CATEGORIES
			$blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="categories"><i class="ss-index"></i>'.__("Categories", "swiftframework").'</a>';
			
			// TAGS
			$blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="tags"><i class="ss-tag"></i>'.__("Tags", "swiftframework").'</a>';
			
			// SEARCH FORM
			$blog_aux_output .= '<li class="search"><form method="get" class="search-form" action="'. home_url().'/">';
			$blog_aux_output .= '<input type="text" placeholder="'. __("Search", "swiftframework") .'" name="s" />';
			$blog_aux_output .= '</form></li>';
			
			// ARCHIVES
			$blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="archives"><i class="ss-storagebox"></i>'.__("Archives", "swiftframework").'</a>';
			
			// RSS LINK
			if ($rss_feed_url != "") {
			$blog_aux_output .= '<li><a href="'.$rss_feed_url.'" class="rss-link" target="_blank"><i class="fa-rss"></i>'.__("RSS", "swiftframework").'</a>';
			}
			
			$blog_aux_output .= '</ul>'; // close .blog-aux-options
			$blog_aux_output .= '</div>'; // close .blog-aux-wrap
			
			$blog_aux_output .= '<div class="filter-wrap slideout-filter blog-filter-wrap row clearfix">'; // open .blog-filter-wrap
			$blog_aux_output .= '<div class="container">';
			$blog_aux_output .= '<div class="filter-slide-wrap col-sm-12 asset-bg '.$filter_wrap_bg.'">';
			
			if ($category_list != '') {  
			    $blog_aux_output .= '<ul class="aux-list aux-categories row clearfix">'.$category_list.'</ul>';  
			}
			if ($tags_list != '') {  
			    $blog_aux_output .= '<ul class="aux-list aux-tags row clearfix">'.$tags_list.'</ul>';  
			}	
			if ($archive_list != '') {  
			    $blog_aux_output .= '<ul class="aux-list aux-archives row clearfix">'.$archive_list.'</ul>';  
			}
			$blog_aux_output .= '</div>';
			
			$blog_aux_output .='</div></div>'; // close .blog-filter-wrap
			
			
			/* AUX BUTTONS OUTPUT
			================================================== */
			return $blog_aux_output;	
		
		}
	}	
?>