<?php
	/*	
	*	Goodlayers Blog Item Management File
	*	---------------------------------------------------------------------
	*	This file contains functions that help you get blog item
	*	---------------------------------------------------------------------
	*/
	
	if( !function_exists('gdlr_get_blog_item') ){
		function gdlr_get_blog_item( $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-blog-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['title-type'] = (empty($settings['title-type']))? 'none': $settings['title-type'];
			$settings['title'] = (empty($settings['title']))? '': $settings['title'];
			$settings['caption'] = (empty($settings['caption']))? '': $settings['caption'];
			$settings['icon'] = (empty($settings['icon']))? '': $settings['icon'];;		
			
			$right_text = ''; $right_text_class = '';
			$settings['right-text'] = (empty($settings['right-text']))? '': $settings['right-text'];		
			$settings['right-text-link'] = (empty($settings['right-text-link']))? '': $settings['right-text-link'];	
			if( !empty($settings['right-text-link']) ){
				$right_text_class = 'gdlr-right-text ';
				$right_text = '<a class="gdlr-right-text-link" href="' . $settings['right-text-link'] . '" >' . $settings['right-text'] . '</a>';
			}
			if( $settings['blog-layout'] == 'carousel' ){
				$carousel = true;
				$right_text_class .= 'gdlr-nav-container ';
			}
			
			$ret  = gdlr_get_item_title(array(
				'title' => $settings['title'],
				'caption' => $settings['caption'],
				'icon' => $settings['icon'],
				'type' => $settings['title-type'],
				'carousel' => $carousel,
				'additional_class' => $right_text_class,
				'additional_html' => $right_text
			));				
			$ret .= '<div class="blog-item-wrapper"  ' . $item_id . $margin_style . '>';
			
			// query post and sticky post
			$args = array('post_type' => 'post', 'suppress_filters' => false);
			if( !empty($settings['category']) || !empty($settings['tag']) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['category']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'category', 'field'=>'slug'));
				}
				if( !empty($settings['tag']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'post_tag', 'field'=>'slug'));
				}				
			}

			if( $settings['enable-sticky'] == 'enable' ){
				if( get_query_var('paged') <= 1 ){
					$sticky_args = $args;
					$sticky_args['post__in'] = get_option('sticky_posts');
					if( !empty($sticky_args['post__in']) ){
						$sticky_query = new WP_Query($sticky_args);	
					}
				}
				$args['post__not_in'] = get_option('sticky_posts', '');
			}else{
				$args['ignore_sticky_posts'] = 1;
			}
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
			$args['paged'] = empty($args['paged'])? 1: $args['paged'];
			$args['offset'] = (empty($settings['offset']))? "": $settings['offset'];			
			$query = new WP_Query( $args );

			// merge query
			if( !empty($sticky_query) ){
				$query->posts = array_merge($sticky_query->posts, $query->posts);
				$query->post_count = $sticky_query->post_count + $query->post_count;
			}

			// set the excerpt length
			if( !empty($settings['num-excerpt']) ){
				global $gdlr_excerpt_length; $gdlr_excerpt_length = $settings['num-excerpt'];
				add_filter('excerpt_length', 'gdlr_set_excerpt_length');
			} 
			
			// get blog by the blog style
			global $gdlr_post_settings, $gdlr_lightbox_id;
			$gdlr_lightbox_id++;
			$gdlr_post_settings['excerpt'] = intval($settings['num-excerpt']);
			$gdlr_post_settings['thumbnail-size'] = $settings['thumbnail-size'];			
			$gdlr_post_settings['blog-style'] = $settings['blog-style'];			
			
			$ret .= '<div class="blog-item-holder">';
			if($settings['blog-style'] == 'blog-full'){
				$gdlr_post_settings['blog-info'] = array('date', 'author', 'comment', 'category');
				$ret .= gdlr_get_blog_full($query);
			}else if($settings['blog-style'] == 'blog-medium'){
				$gdlr_post_settings['blog-info'] = array('date', 'author', 'comment', 'category');
				$ret .= gdlr_get_blog_medium($query);			
			}else if($settings['blog-style'] == 'blog-grid-list'){
				$gdlr_post_settings['blog-info'] = array('date', 'author');
				$ret .= gdlr_get_blog_grid_list($query, $blog_size, $settings['blog-layout']);	
			}else{
				$gdlr_post_settings['blog-info'] = array('date', 'author');
				
				$blog_size = str_replace('blog-1-', '', $settings['blog-style']);
				$ret .= gdlr_get_blog_grid($query, $blog_size, $settings['blog-layout']);
			}
			$ret .= '</div>';
			
			if( $settings['pagination'] == 'enable' ){
				$ret .= gdlr_get_pagination($query->max_num_pages, $args['paged']);
			}
			$ret .= '</div>'; // blog-item-wrapper
			
			remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
			return $ret;
		}
	}

	if( !function_exists('gdlr_get_blog_info') ){
		function gdlr_get_blog_info( $array = array(), $wrapper = true ){
			global $theme_option; $ret = '';
			$exclude_meta = empty($theme_option['post-meta-data'])? array(): $theme_option['post-meta-data'];
			
			foreach($array as $post_info){
				if( in_array($post_info, $exclude_meta) ) continue;
				
				switch( $post_info ){
					case 'date':
						$ret .= '<div class="blog-info blog-date"><i class="icon-time fa fa-clock-o"></i>';
						$ret .= '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '">';
						//$ret .= '<time date-time="' . get_the_time('Y-m-d') . '" pubdate>';
						$ret .= get_the_time($theme_option['date-format']);
						//$ret .= '</time>';
						$ret .= '</a>';
						$ret .= '</div>';
						break;
					case 'tag':
						$tag = get_the_term_list(get_the_ID(), 'post_tag', '', '<span class="sep">,</span> ' , '' );
						if(empty($tag)) break;					
					
						$ret .= '<div class="blog-info blog-tag"><i class="icon-tag fa fa-tag"></i>';
						$ret .= $tag;						
						$ret .= '</div>';						
						break;
					case 'category':
						$category = get_the_term_list(get_the_ID(), 'category', '', '<span class="sep">,</span> ' , '' );
						if(empty($category)) break;
						
						$ret .= '<div class="blog-info blog-category"><i class="icon-folder-close-alt fa fa-folder-o"></i>';
						$ret .= $category;					
						$ret .= '</div>';					
						break;
					case 'comment':
						$ret .= '<div class="blog-info blog-comment"><i class="icon-comments fa fa-comments"></i>';
						$ret .= '<a href="' . get_permalink() . '#respond" >' . get_comments_number() . '</a>';						
						$ret .= '</div>';						
						break;
					case 'author':
						ob_start();
						the_author_posts_link();
						$author = ob_get_contents();
						ob_end_clean();
						
						$ret .= '<div class="blog-info blog-author"><i class="icon-pencil fa fa-pencil"></i>';
						$ret .= $author;
						$ret .= '</div>';						
						break;						
				}
			}
			
			
			if($wrapper && !empty($ret)){
				return '<div class="gdlr-blog-info gdlr-info">' . $ret . '<div class="clear"></div></div>';
			}else if( !empty($ret) ){
				return $ret . '<div class="clear"></div>';
			}
			return '';
		}
	}
	
	if( !function_exists('gdlr_get_blog_grid') ){
		function gdlr_get_blog_grid($query, $size, $blog_layout = 'fitRows'){
			if($blog_layout == 'carousel'){ return gdlr_get_blog_grid_carousel($query, $size); }
		
			$ret = ''; $current_size = 0;
			
			$ret .= '<div class="gdlr-isotope" data-type="blog" data-layout="' . $blog_layout  . '" >';
			while($query->have_posts()){ $query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clear"></div>';
				}

				$ret .= '<div class="' . gdlr_get_column_class('1/' . $size) . '">';
				$ret .= '<div class="gdlr-item gdlr-blog-grid">';
				$ret .= '<div class="gdlr-ux gdlr-blog-grid-ux">';
				ob_start();
				
				get_template_part('single/content');
				$ret .= ob_get_contents();
				
				ob_end_clean();			
				$ret .= '</div>'; // gdlr-ux			
				$ret .= '</div>'; // gdlr-item			
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>'; // close the gdlr-isotope
			wp_reset_postdata();
			
			return $ret;
		}
	}	
	
	if( !function_exists('gdlr_get_blog_grid_list') ){
		function gdlr_get_blog_grid_list($query){
			$count = 0;
			
			$ret = '<div class="gdlr-blog-grid-list">';
			while($query->have_posts()){ $query->the_post();
				if( $count == 0 ){
					$ret .= '<div class="gdlr-item gdlr-blog-grid">';
					$ret .= '<div class="gdlr-ux gdlr-blog-grid-ux">';
					ob_start();
					
					get_template_part('single/content');
					$ret .= ob_get_contents();
					
					ob_end_clean();			
					$ret .= '</div>'; // gdlr-ux			
					$ret .= '</div>'; // gdlr-item
				}else{
					$ret .= '<div class="gdlr-ux gdlr-blog-list-ux">';
					$ret .= '<div class="gdlr-item gdlr-blog-list">';
					$ret .= '<a href="' . get_permalink() . '" ><i class="icon-angle-right fa fa-angle-right"></i>' . get_the_title() . '</a>';
					$ret .= '</div>';
					$ret .= '</div>';
				}
				$count ++;
			}
			$ret .= '</div>';
			wp_reset_postdata();
			
			return $ret;
		}
	}		
	
	if( !function_exists('gdlr_get_blog_grid_carousel') ){
		function gdlr_get_blog_grid_carousel($query, $size){
			$ret = ''; 
			
			$ret .= '<div class="gdlr-blog-carousel-item gdlr-item" >';
			$ret .= '<div class="flexslider" data-type="carousel" data-nav-container="blog-item-wrapper" data-columns="' . $size . '" >';	
			$ret .= '<ul class="slides" >';			
			while($query->have_posts()){ $query->the_post();
				$ret .= '<li class="gdlr-item gdlr-blog-grid">';
				$ret .= '<div class="gdlr-ux gdlr-blog-grid-ux">';
				ob_start();
				
				get_template_part('single/content');
				$ret .= ob_get_contents();
				
				ob_end_clean();			
				$ret .= '</div>'; // gdlr-ux			
				$ret .= '</li>'; // gdlr-item
			}
			$ret .= '</ul>';
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>'; // close the flexslider
			$ret .= '</div>'; // close the gdlr-item
			wp_reset_postdata();
			
			return $ret;
		}
	}		
	
	if( !function_exists('gdlr_get_blog_medium') ){
		function gdlr_get_blog_medium($query){
			$ret = '';

			while($query->have_posts()){ $query->the_post();
				$ret .= '<div class="gdlr-item gdlr-blog-medium">';
				$ret .= '<div class="gdlr-ux gdlr-blog-medium-ux">';
				ob_start();
				
				get_template_part('single/content');
				$ret .= ob_get_contents();
				
				ob_end_clean();			
				$ret .= '</div>'; // gdlr-ux			
				$ret .= '</div>'; // gdlr-item
			}
			wp_reset_postdata();
			
			return $ret;
		}
	}		
	
	if( !function_exists('gdlr_get_blog_full') ){
		function gdlr_get_blog_full($query){
			$ret = '';

			while($query->have_posts()){ $query->the_post();
				$ret .= '<div class="gdlr-item gdlr-blog-full">';
				$ret .= '<div class="gdlr-ux gdlr-blog-full-ux">';
				ob_start();
				
				get_template_part('single/content');
				$ret .= ob_get_contents();
				
				ob_end_clean();			
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item
			}
			wp_reset_postdata();
			
			return $ret;
		}
	}	

?>