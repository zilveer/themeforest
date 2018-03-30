<?php

if( !function_exists( 'om_breadcrumbs' ) ) {
	function om_breadcrumbs($caption='', $before='<div class="breadcrumbs">', $after='</div>', $separator=' / ') {
		global $post, $wp_query;
		
		$show_last=(get_option(OM_THEME_PREFIX . 'breadcrumbs_show_current') == 'true');
		
		$out=array();
		
		if( is_home() ) {
			
			if(is_front_page()) {
				
				// do nothing
				return;
				
			} else {
				$blog_page_id=get_option('page_for_posts');
				if($blog_page_id) {
					$blog = get_post($blog_page_id);
					if($show_last)
						$out[]=$blog->post_title;
					om_breadcrumbs_add_parents($out,$blog);
				}
			}
			
		}	elseif ( is_attachment() ) {
			
			if($show_last)
				$out[]=$post->post_title;
			om_breadcrumbs_add_parents($out,$post);
			
		} elseif( is_page() ) {
	
			if($show_last)
				$out[]=$post->post_title;
			om_breadcrumbs_add_parents($out,$post);
	
		} elseif( is_single() ) {
	
			if( $post->post_type == 'portfolio' ) {
	
				if($show_last)
					$out[]=$post->post_title;
	
				$args = array(
					'post_type' => 'page',
					'posts_per_page' => 1,
					'meta_query' => array(
						array(
							'key' => '_wp_page_template',
							'value' => array('template-portfolio.php', 'template-portfolio-m.php'),
							'compare' => 'IN',
						)
					)
				);
				$terms=get_the_terms($post->ID, 'portfolio-type');
				if(!empty($terms)) {
					$term=reset($terms);
					if($term->parent) {
						$term=get_term($term->parent,'portfolio-type');
						while($term->parent)
							$term=get_term($term->parent,'portfolio-type');
						$args['meta_query'][]=array(
							'key' => OM_THEME_SHORT_PREFIX.'portfolio_categories',
							'value' => $term->term_id
						);
						
					} else {
						$args['meta_query'][]=array(
							'key' => OM_THEME_SHORT_PREFIX.'portfolio_categories',
							'value' => array('0','',$term->term_id),
							'compare' => 'IN',
						);
					}
				}
				$tmp_q = new WP_Query($args);
				if($tmp_q->post_count) {
					$portfolio_page=$tmp_q->posts[0];
				} else {
					wp_reset_postdata();
					unset($args['meta_query'][1]);
					$tmp_q = new WP_Query($args);
					if($tmp_q->post_count)
						$portfolio_page=$tmp_q->posts[0];
					else
						$portfolio_page=false;
				}
				wp_reset_postdata();
				
	
				if($portfolio_page) {
					$out[]='<a href="'. get_permalink($portfolio_page->ID) .'">'.$portfolio_page->post_title.'</a>';
					om_breadcrumbs_add_parents($out,$portfolio_page);
				}	
				
			} elseif( $post->post_type == 'testimonials' ) {
	
				if($show_last)
					$out[]=$post->post_title;
	
			} else {
				if($show_last)
					$out[]=$post->post_title;
		
				$blog_page_id=get_option('page_for_posts');
				if($blog_page_id) {
					$blog = get_post($blog_page_id);
					$out[]='<a href="'. get_permalink($blog->ID) .'">'.$blog->post_title.'</a>';
					om_breadcrumbs_add_parents($out,$blog);
				}
			}
	
		}	elseif( is_category() ||  is_tag() || is_day() || is_month() || is_year()) {
	
			if($show_last)
				$out[]=om_get_archive_page_title();
	
			$blog_page_id=get_option('page_for_posts');
			if($blog_page_id) {
				$blog = get_post($blog_page_id);
				$out[]='<a href="'. get_permalink($blog->ID) .'">'.$blog->post_title.'</a>';
				om_breadcrumbs_add_parents($out,$blog);
			}
			
		}	elseif( is_tax('portfolio-type') ) {
			
			if($show_last)
				$out[]=$wp_query->queried_object->name;
	
			$portfolio_root_cat=false;
			if($wp_query->queried_object->parent) {
				$tmp=get_term($wp_query->queried_object->parent,'portfolio-type');
				while($tmp->parent)
					$tmp=get_term($tmp->parent,'portfolio-type');
				$portfolio_root_cat=$tmp->term_id;
			}
	
			$args = array(
				'post_type' => 'page',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key' => '_wp_page_template',
						'value' => array('template-portfolio.php', 'template-portfolio-m.php'),
						'compare' => 'IN',
					)
				)
			);
			if($portfolio_root_cat) {
				$args['meta_query'][]=array(
					'key' => OM_THEME_SHORT_PREFIX.'portfolio_categories',
					'value' => $portfolio_root_cat
				);
			}
			$tmp_q = new WP_Query($args);
			if($tmp_q->post_count) {
				$portfolio_page=$tmp_q->posts[0];
			} else {
				$portfolio_page=false;
			}
			wp_reset_postdata();
			
			if($portfolio_page) {
				$out[]='<a href="'. get_permalink($portfolio_page->ID) .'">'.$portfolio_page->post_title.'</a>';
				om_breadcrumbs_add_parents($out,$portfolio_page);
			}		
		}
		
		//if(!empty($out)) {
			$out[]='<a href="'. home_url() .'">'.__('Home','om_theme').'</a>';
			echo $before . $caption . implode( $separator, array_reverse($out) ) . (!$show_last ? $separator.'' : '') . $after;
		//}
	}
}

function om_breadcrumbs_add_parents(&$out,$post) {

	if($post->post_parent) {
		$parent=$post->post_parent;
		while($parent) {
			$tmp=get_post($parent);
			if($tmp) {
				$out[]='<a href="'. get_permalink($tmp->ID) .'">'.$tmp->post_title.'</a>';
				$parent=$tmp->post_parent;
			} else {
				break;
			}
		}
	}

}