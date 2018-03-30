<?php

/* KowloonBay Testimonials: shortcodes */
add_shortcode('testimonials', 'kowloonbay_testimonials_shortcode');

function kowloonbay_testimonials_shortcode()
{
	global $kowloonbay_redux_opts;
	$profile_pic_style = $kowloonbay_redux_opts['misc_testimonials_profile_pic_img_style'];

	$kowloonbay_testimonials_query = array(
		'posts_per_page'	=> '-1',
		'post_type'			=> 'kowloonbay_tmnl',
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order date',
		'paged'				=> '1',
	);
	$kowloonbay_testimonials = new WP_Query( $kowloonbay_testimonials_query );

	$html = '';

	if ($kowloonbay_testimonials->have_posts()):
		while($kowloonbay_testimonials->have_posts()):
			$kowloonbay_testimonials->the_post();
			$kowloonbay_testimonial_name = get_the_title();
			$kowloonbay_testimonial_position = rwmb_meta( 'kowloonbay_testimonial_position');
			if (!empty($kowloonbay_testimonial_position)){
				$kowloonbay_testimonial_position = ', ' . $kowloonbay_testimonial_position;
			}
			$kowloonbay_testimonial_profile_pic = rwmb_meta( 'kowloonbay_testimonial_profile_pic',array('type'=>'image_advanced') );
			$kowloonbay_testimonial_profile_pic = reset($kowloonbay_testimonial_profile_pic);
			$permalink = get_permalink(get_the_id());

			$html .= '<div class="testimonial no-page-padding page-padding-h-sm '. esc_attr($kowloonbay_testimonials->current_post % 2 === 1 ? 'light-primary-bg-1': '') .'">';
				$html .= '<div class="row padding-v-2x page-padding-h">';
					$html .= '<div class="col-md-2 wow zoomIn" data-wow-duration="0.3s" data-wow-offset="200">';
						$html .= '<p class="text-center padding-b-1x padding-b-none-md"><img src="'. esc_url($kowloonbay_testimonial_profile_pic['full_url']) .'" alt="'. esc_attr($kowloonbay_testimonial_name) .'" class="'.esc_attr($profile_pic_style).'"></p>';
					$html .= '</div>';
					$html .= '<div class="col-md-10">';
						$html .= '<blockquote class="padding-h-none padding-v-none padding-l-2x-md margin-b-none">';
							$html .= get_the_content();
							$html .= '<footer><span class="title-style">'.esc_html($kowloonbay_testimonial_name).'</span>'. esc_html($kowloonbay_testimonial_position) .'</footer>';
						$html .= '</blockquote>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			
		endwhile;
	endif;

	wp_reset_postdata();

	return $html;
}