<?php

/* Recent Blog Posts
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('recent_blog_posts')) {
	function recent_blog_posts( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "posts"      => 4,
	        "categories" => "",
	        "el_class"   => ""
	    ), $atts ) );

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $posts,
			'cat'            => $categories
	    );

	    $output = '';

	    $blog_query = new WP_Query( $args );

		if( $blog_query->have_posts() ) {

			if( !empty($el_class) ) $el_class = ' ' . $el_class;

			$output .= '<div class="recent-blog-posts vc_row columns-' . $posts . $el_class . '">';

			switch ($posts) {
				case 2:
					$column_class = 'vc_col-sm-6';
					break;

				case 3:
					$column_class = 'vc_col-sm-4';
					break;
				
				default:
					$column_class = 'vc_col-sm-3';
					break;
			}

			while ( $blog_query->have_posts() ) {

				$blog_query->the_post();

				$output .= '<div class="' . $column_class . '">';

	            	if( has_post_thumbnail() ) {
	            		$output .= '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'blog', array('class' => 'img-responsive')) . '</a>';
	            	}

	            	$output .= '<div class="date">' . get_the_time( 'M d, Y' ) .'</div>';

	            	$output .= '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title(get_the_ID()) . '</a></h4>';

					$output .= '<p>' . get_the_excerpt() . '</p>';

					$output .= '<p><a href="' . esc_url( get_permalink() ) . '" class="btn btn-primary">' . __("Read more", "jobseek") . '</a></p>';

				$output .= '</div>';
				
			}

			$output .= '</div>';
		
		}

		wp_reset_postdata();

	    return $output;

	}

}

add_shortcode('recent-blog-posts', 'recent_blog_posts');