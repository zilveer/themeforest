<?php
if(!function_exists('theme_section_blog_related_posts')){
/**
 * The default template for displaying blog related posts in the pages
 */
function theme_section_blog_related_posts(){
	global $post;
	$backup = $post;  
	$exclude_cats = theme_get_option('blog','exclude_categorys');
	$related_base_on = theme_get_option('blog','related_base_on');


	$related_post_found = false;
	$output = '';

	if($related_base_on == 'tags'){
		$tags = wp_get_post_tags($post->ID);
		$tagIDs = array();

		if ($tags) {
			$tagcount = count($tags);
			for ($i = 0; $i < $tagcount; $i++) {
				$tagIDs[$i] = $tags[$i]->term_id;
			}
			$r = new WP_Query(array(
				'category__not_in' => $exclude_cats,
				'tag__in' => $tagIDs,
				'post__not_in' => array($post->ID),
				'showposts'=>3,
				'ignore_sticky_posts'=>1
			));
		}
	}elseif($related_base_on == 'categories'){
		$categories = wp_get_post_categories($post->ID);
		$categoryIDs = array();

		if ($categories) {
			$categorycount = count($categories);
			for ($i = 0; $i < $categorycount; $i++) {
				$categoryIDs[$i] = $categories[$i];
			}
			$r = new WP_Query(array(
				'category__not_in' => $exclude_cats,
				'category__in' => $categoryIDs,
				'post__not_in' => array($post->ID),
				'showposts'=>3,
				'ignore_sticky_posts'=>1
			));
		}
	}
	if (isset($r) && $r->have_posts()){
		$related_post_found = true;
		$output .= '<h3>'.__('Related Posts','striking-r').'</h3>';
		$output .= '<section class="related_posts_wrap">';
		$output .= '<ul class="posts_list">';
		while ($r->have_posts()){
			$r->the_post();
			$output .= '<li>';
			$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
			if( has_post_thumbnail() ){
				$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
			}elseif(theme_get_option('blog','display_default_thumbnail')){
				if($default_thumbnail_custom = theme_get_option('blog','default_thumbnail_custom')){
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


	if(!$related_post_found){
		$r = new WP_Query(array(
			'category__not_in' => $exclude_cats,
			'showposts' => 3, 
			'nopaging' => 0, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => 1
		));
		if ($r->have_posts()){
			$output .= '<h3>'.__('Recent Posts','striking-r').'</h3>';
			$output .= '<section class="recent_posts_wrap">';
			$output .= '<ul class="posts_list">';
			while ($r->have_posts()){
				$r->the_post();
				$output .= '<li>';
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				if( has_post_thumbnail() ){
					$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
				}elseif(theme_get_option('blog','display_default_thumbnail')){
					if($default_thumbnail_custom = theme_get_option('blog','default_thumbnail_custom')){
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