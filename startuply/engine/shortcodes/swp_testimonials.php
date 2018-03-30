<?php

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Slider VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$testimonials_list = get_posts(array(
				'post_type' => 'testimonials',
				'posts_per_page' => -1,
				'post_status' => 'publish'
			));

			$testimonials_array = array();
			foreach ($testimonials_list as $testimonial_item) {
				$testimonials_array[$testimonial_item->post_title] = $testimonial_item->ID;
			}

			vc_map(array(
				"name" => __("Testimonials Slider", "vivaco"),
				"icon" => "icon-testimonials",
				"description" => "Customer feedback",
				"weight" => 15,
				"base" => "vsc-testimonials-slider",
				"class" => "testimonials_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Testimonials slider title", "vivaco"),
						"param_name" => "text",
						"value" => ""
					),
					array(
						"type" => "checkbox",
						"heading" => __("Testimonials from", "vivaco"),
						"param_name" => "ids",
						"admin_label" => true,
						"value" => $testimonials_array,
						"description" => __("Select which testimonials you want to display on a slider.", "vivaco")
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Testimonials Slider VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_testimonials_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		"text" => '',
		"ids" => ''
	), $atts));

	wp_enqueue_script('flexslider', array('jquery'), true);

	$controls_block = $content_block = '';

	$testimonial_ids = explode(",", $ids);

	$rnd_id = vsc_random_id(3);
	$token = wp_generate_password(5, false, false);

	$content_block  = '<section class="section light feedback">';
	$content_block .= '<div class="container">';
	$content_block .= '<div class="section-header"><h2>' . $text . '</h2></div>';
	$content_block .= '<div class="section-content">';
	$content_block .= '<div class="col-sm-10 col-sm-offset-1">';
	$content_block .= '<div class="testimonials-slider heading-font flexslider center" data-animation="fadeInTop">';
	$content_block .= '<ul class="slides">';

	foreach ($testimonial_ids as $tid) {
		$content_block .= '<li data-id="' . $tid . '"><div class="testimonial resp-center clearfix"><blockquote>' . do_shortcode("[vsc-testimonial id=" . $tid . " desc=true]") . "</blockquote></div></li>";
	}

	$content_block .= '</ul></div></div></div></div></section>';

	$controls_block  = '<div id="feedback-controls" class="section light">';
	$controls_block .= '<div class="container">';
	$controls_block .= '<div class="col-md-10 col-md-offset-1">';
	$controls_block .= '<div class="flex-manual">';

	foreach ($testimonial_ids as $tid) {
		$controls_block .= '<div data-href="' . $tid . '" class="col-xs-12 col-sm-4 wrap"><div class="switch">' . do_shortcode("[vsc-testimonial id=" . $tid . " photo=true who=true]") . "</div></div>";
	}

	$controls_block .= '</div></div></div></div>';

	$output = $content_block;
	$output .= $controls_block;

	return $output;
}

add_shortcode("vsc-testimonials-slider", "vsc_testimonials_slider");

/*-----------------------------------------------------------------------------------*/
/*	Testimonial Item
/*-----------------------------------------------------------------------------------*/

function vsc_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '',
		"photo" => '',
		"desc" => '',
		"who" => ''
	), $atts));

	$photo = ($photo === 'true');
	$desc = ($desc === 'true');
	$who = ($who === 'true');

	//print_r($atts);

	global $post;

	$args = array(
		'post_type' => 'testimonials',
		'posts_per_page' => 1,
		'p' => $id
	);
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()):
		while ($my_query->have_posts()):
			$my_query->the_post();

			$testimonial_desc = get_post_meta($post->ID, 'vsc_testimonial_desc', true);
			$testimonial_name = get_the_title($post->ID);
			$testimonial_details = get_post_meta($post->ID, 'vsc_testimonial_details', true);

			$testimonial_icon = get_post_meta($post->ID, 'vsc_testimonials_thumb_icon', true);
			$testimonial_icon = 'flat_image'; //temp hack

			$image = get_the_post_thumbnail($id, 'testimonials-thumb', array(
				'class' => 'testimonials-avatar sm-pic img-circle pull-left'
			));
			$url_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

			//$retour = '<div class="testimonial-item">';
			$retour = '';
			$photo_html = '';
			$desc_html = '';
			$who_html = '';

			if ($testimonial_icon != 'flat_image') {
				$photo_html .= '<a href="' . $url_image . '" data-pretty="prettyPhoto" title="' . get_the_title() . '">';
				$photo_html .= '<span class="item-on-hover"><span class="hover-image"><i class="fa fa-search"></i></span></span>';
				$photo_html .= $image;
				$photo_html .= '</a>';
			} else {
				$photo_html .= $image;
			}

			$desc_html .= '<p>' . wp_kses_post($testimonial_desc) . '</p>';

			$who_html .= '<p><span class="testimonial-name base_clr_txt">' . esc_html($testimonial_name) . '</span><span class="testimonial-position">' . esc_html($testimonial_details) . '</span></p>';

			if (!$photo && !$desc && !$who) {
				$retour .= $photo_html;
				$retour .= $desc_html;
				$retour .= $who_html;
			} else {
				if ($photo) {
					$retour .= $photo_html;
				}
				if ($desc) {
					$retour .= $desc_html;
				}
				if ($who) {
					$retour .= $who_html;
				}
			}
		//$retour .='</div>';
		endwhile;
	else:
		$retour = '';
		$retour .= "nothing found.";
	endif;

	//Reset Query
	wp_reset_query();

	return $retour;
}

add_shortcode("vsc-testimonial", "vsc_testimonials");
