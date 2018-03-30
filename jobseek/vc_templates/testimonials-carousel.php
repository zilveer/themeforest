<?php

/* Testimonials
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('testimonials_carousel')) {
	function testimonials_carousel( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "show"       => "random",
	        "autoplay"   => "",
	        "posts"      => 4,
	        "posts_ids"  => "",
	        "el_class"   => ""
	    ), $atts ) );

	    wp_enqueue_script( 'owl-carousel' );

	    if( $show == 'selected' ) {
			$args = array(
				'post_type' => 'testimonial',
				'p'         => $posts_ids,
		    );
		} else {
			$args = array(
				'post_type'      => 'testimonial',
				'posts_per_page' => $posts,
		    );
		}

		if( empty( $autoplay ) ) {
			$autoplay = false;
		}

	    $output = '';

	    $testimonials_query = new WP_Query( $args );

		if( $testimonials_query->have_posts() ) {

			if( !empty($el_class) ) $el_class = ' ' . $el_class;

			$output .= '<div class="testimonials-carousel' . $el_class . '" data-autoplay="' . $autoplay . '">';

			while ( $testimonials_query->have_posts() ) {

				$testimonials_query->the_post();

				$output .= '<div class="testimonial-item">';

					ob_start();
					get_template_part('content-testimonial');
	                $output .= ob_get_contents();
	                ob_end_clean();

				$output .= '</div>';
				
			}

			$output .= '</div>';
		
		}

		wp_reset_postdata();

	    return $output;

	}

}

add_shortcode('testimonials-carousel', 'testimonials_carousel');