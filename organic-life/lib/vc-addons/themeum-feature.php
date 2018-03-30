<?php
add_shortcode( 'themeum_feature', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 			=> '',
		'image'				=> '',
		'desc' 				=> '',
		'btn_link' 			=> '',
		'btn_name'		 	=> '',
		'target'		 	=> '_blank',
		'duration' 			=> '600',
		'delay' 			=> '100',
		'class' 			=> '',
		), $atts));

	$image = wp_get_attachment_image_src( $image, 'full' );

	$dur = '';
	$img_del = '';
	$title_del = '';
	$text_del = '';

	if ($duration) $dur .= (int) $duration .'ms'; 
	if ($delay) $img_del .= (int) $delay .'ms'; 
	$title_del = $img_del+200;
	$text_del = $img_del+400;


	$output  = '<div class="themeum-feature-shortcode '.$class.'">';

	$output .= '<div class="item-feature" style="text-align:center;">';

	$output .= '<div class="feature-img-wrapper wow scaleUp" data-wow-duration="'.$dur.'" data-wow-delay="'.$img_del.'">';
	$output .= '<img  src=" ' . $image[0] . '" alt="' . $title . '">';
	$output .= '</div>';

	$output .= '<h3 class="wow scaleUp" data-wow-duration="'.$dur.'" data-wow-delay="'.$title_del.'ms">' . $title . '</h3>';
	$output .= '<p class="wow fadeInUp" data-wow-duration="'.$dur.'" data-wow-delay="'.$text_del.'ms">' . $desc . '</p>';

    if ($btn_link)
    {
	$output .=  '<a class="btn-common-transparent" href="'.$btn_link.'" target="'.$target.'">'.$btn_name.'</a>';
    }

	$output .= '</div>';

	$output .= '</div>';


	return $output;

});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Feature", "themeum"),
		"base" => "themeum_feature",
		"description" => __("Themeum Feature", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Title", "themeum"),
				"param_name" => "title",
				"value" => "",
				),

			array(
				"type" => "attach_image",
				"heading" => __("Image", "themeum"),
				"param_name" => "image"
				),			

			array(
				"type" => "textarea_html",
				"heading" => __("Description", "themeum"),
				"param_name" => "desc"
				),

			array(
				"type" => "textfield",
				"heading" => __("Link URL", "themeum"),
				"param_name" => "btn_link",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Button Name", "themeum"),
				"param_name" => "btn_name",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Target Link", "themeum"),
				"param_name" => "target",
				"value" => array('Self'=>'_self','Blank'=>'_blank','Parent'=>'_parent'),
				),				

			array(
				"type" => "textfield",
				"heading" => __("Animation Duration", "themeum"),
				"param_name" => "duration",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Animation Delay", "themeum"),
				"param_name" => "delay",
				"value" => "",
				),								

			array(
				"type" => "textfield",
				"heading" => __("Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),			

			)
		));
}