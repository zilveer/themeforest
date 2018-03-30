<?php
if(!function_exists('theme_section_blog_popular_posts')){
/**
 * The default template for displaying blog popular posts in the pages
 */
function theme_section_blog_popular_posts(){
	$r = new WP_Query(array(
		'category__not_in' => theme_get_option('blog','exclude_categorys'),
		'showposts' => 3, 
		'nopaging' => 0, 
		'orderby'=> 'comment_count', 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1
	));
	$output = '';
	if ($r->have_posts()){
		$output .= '<h3>'.__('Popular Posts','striking-r').'</h3>';
		$output .= '<section class="popular_posts_wrap">';
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

	wp_reset_postdata();
	return $output;
}
}