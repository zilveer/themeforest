<?php
if(!function_exists('theme_section_portfolio_related_posts')){
/**
 * The default template for displaying portfolio related posts in the pages
 */
function theme_section_portfolio_related_posts(){
	global $post;
	$backup = $post;  
	$cats  =  wp_get_object_terms($post->ID, 'portfolio_category');
	$catSlugs = array();
	$related_post_found = false;
	$output = '';
	if ($cats) {
		$catcount = count($cats);
		for ($i = 0; $i < $catcount; $i++) {
			$catSlugs[$i] = $cats[$i]->slug;
		}
		$query = array(
			'post__not_in' => array($post->ID),
			'showposts'=>3,
			'ignore_sticky_posts'=>1,
			'post_type' => 'portfolio', 
		);
		global $wp_version;
		if(version_compare($wp_version, "3.1", '>=')){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => $catSlugs
				)
			);
		}else{
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = implode(',',$catSlugs);
		}
		$r = new WP_Query($query);
		if ($r->have_posts()){
			$related_post_found = true;
			$output .= '<h3>'.__('Related Portfolio','striking-r').'</h3>';
			$output .= '<section class="related_portfolio_wrap">';
			$output .= '<ul class="posts_list">';
			while ($r->have_posts()){
				$r->the_post();
				$output .= '<li>';
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				if( has_post_thumbnail() ){
					$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
				}elseif(theme_get_option('portfolio','display_default_thumbnail')){
					if($default_thumbnail_custom = theme_get_option('portfolio','default_thumbnail_custom')){
						$default_thumbnail_image = theme_get_image_src($default_thumbnail_custom);
					}else{
						$default_thumbnail_image = THEME_IMAGES.'/widget_posts_thumbnail.png';
					}
					$output .= '<img src="'.$default_thumbnail_image.'" width="65" height="65" title="'.get_the_title().'" alt="'. get_the_title().'"/>';
				}
				$output .= '</a>';
				$output .= '<div class="post_extra_info">';
				$output .= '<a class="post_title" href="'.get_permalink().'" title="'.get_the_title().'" rel="bookmark">'.get_the_title().'</a>';
				$output .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
				$output .= '</div>';
				$output .= '<div class="clearboth"></div>';
				$output .= '</li>';
			}
			$output .= '</ul>';
			$output .= '</section>';
		}
	}
	if(!$related_post_found){
		$r = new WP_Query(array(
			'showposts' => 3, 
			'nopaging' => 0, 
			'orderby'=> 'comment_count', 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => 1,
			'post_type' => 'portfolio', 
		));
		if ($r->have_posts()){
			$output .= '<h3>'.__('Popular Portfolio','striking-r').'</h3>';
			$output .= '<section class="popular_portfolio_wrap">';
			$output .= '<ul class="posts_list">';
			while ($r->have_posts()){
				$r->the_post();
				$output .= '<li>';
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				if( has_post_thumbnail() ){
					$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
				}elseif(theme_get_option('portfolio','display_default_thumbnail')){
					if($default_thumbnail_custom = theme_get_option('portfolio','default_thumbnail_custom')){
						$default_thumbnail_image = theme_get_image_src($default_thumbnail_custom);
					}else{
						$default_thumbnail_image = THEME_IMAGES.'/widget_posts_thumbnail.png';
					}
					$output .= '<img src="'.$default_thumbnail_image.'" width="65" height="65" title="'.get_the_title().'" alt="'. get_the_title().'"/>';
				}
				$output .= '</a>';
				$output .= '<div class="post_extra_info">';
				$output .= '<a class="post_title" href="'.get_permalink().'" title="'.get_the_title().'" rel="bookmark">'.get_the_title().'</a>';
				$output .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
				$output .= '</div>';
				$output .= '<div class="clearboth"></div>';
				$output .= '</li>';
			}
			$output .= '</ul>';
			$output .= '</section>';
		}
	}
	$post = $backup;
	wp_reset_postdata();

	return $output;
}
}