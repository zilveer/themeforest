<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_select_featured_post_area_category;

?>

<div class="featured-posts-container">
	<div class="container">

		<div class="featured-post-wrapper">

			<h3><span><?php _e("Featured Posts", 'alison'); ?></span></h3>
			<div class="featured-posts side-item">
				<?php
					
					if(!empty($gorilla_select_featured_post_area_category)){
						$gorilla_select_featured_post_area_category = explode(",",$gorilla_select_featured_post_area_category);
					}

					// retrieve posts information from database
					$query = array(
					  'posts_per_page' => 4,
					  'nopaging' => 0,
					  'post_status' => 'publish',
					  'ignore_sticky_posts' => 1,
					  'category__in'     => $gorilla_select_featured_post_area_category,
					  'tax_query' => array(
					    array(
					      'taxonomy' => 'post_format',
					      'field' => 'slug',
					      'terms' => array('post-format-link', 'post-format-quote' ),
					      'operator' => 'NOT IN'
					    )
					  )
					);
			 		$posts = new WP_Query($query);

				   	$out = '<ul class="clearfix">';

				   	global $post;

				  	while ($posts->have_posts()) : $posts->the_post();


						$latest_posts_categories = get_the_category();
						$latest_posts_separator = ', ';
						$latest_posts_output = '';
						if($latest_posts_categories){
							foreach($latest_posts_categories as $latest_posts_category) {
								$latest_posts_output .= $latest_posts_category->cat_name.$latest_posts_separator;
							}
						}
						$post_id = $post->id;

					  	if(has_post_thumbnail()) {
					  		$thumb = '<div class="featured-thumb"><a href="'.get_permalink().'">'. get_the_post_thumbnail($posts->ID, 'thumbnail-grid-2') . '</a>';
					  		if(!get_theme_mod('gorilla_featured_post_area_cat_hide')){
					  			$thumb .= '<span class="side-item-category"><span class="side-item-category-inner">'. trim($latest_posts_output, $latest_posts_separator).'</span></span>';
					  		}
					  		$thumb .= '</div>' ;
					  	}
					  	else { 
					  		$thumb = '<div class="featured-thumb"><a href="'.get_permalink().'"><img src="'. get_template_directory_uri() .'/assets/img/thumb-placeholder-2.png"/></a>';
					  		if(!get_theme_mod('gorilla_featured_post_area_cat_hide')){
					  			$thumb .= '<span class="side-item-category"><span class="side-item-category-inner">'. trim($latest_posts_output, $latest_posts_separator).'</span></span>';
					  		}
					  		$thumb .= '</div>' ;
					  	}

						$out .= '<li class="side-image"><div class="clearfix">'. $thumb . '<div class="recent_post_text"><h4><a href="'.get_permalink().'" class="recent_post_widget_header">'.get_the_title().'</a></h4>';
						if(!get_theme_mod('gorilla_featured_post_area_date_hide')){
							$out .= '<span class="post-date">'.get_the_date().'</span>';
						}
						$out .= '</div></div></li>';

						//$out .='<div class="like-comment-buttons-wrapper clearfix"><div class="like-comment-buttons">'. getPostLikeLink( $post->ID ) . gorilla_comment_button( $post->ID ) .'</div></div><li>';

				  endwhile;
				  $out .= '</ul>';
				  echo wp_kses($out, wp_kses_allowed_html( 'post' ));
				?>
			</div>
		</div>
	</div>
</div>