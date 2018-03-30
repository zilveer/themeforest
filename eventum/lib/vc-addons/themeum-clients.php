<?php
add_shortcode( 'themeum_client_testimonial', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'client_image'					=> '',
		'client_text'					=> '',
		'client_name'					=> '',
		'class'						=> '',
		), $atts));

$src_image   = wp_get_attachment_image_src($client_image, 'full');


    $output = '<div class="themeum-clients '.$class.'">';
    	
    	$output .= '<div class="client-image">';
    		$output .= '<img src="'.$src_image[0].'" />';
    	$output .= '</div>';

    	$output .= '<div class="client-comments">';
    		$output .= $client_text;
    	$output .= '</div>';

    	$output .= '<div class="client-name">';
    		$output .= $client_name;
    	$output .= '</div>';

	$output .= '</div>';


	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Client Testimonial", 'eventum'),
	"base" => "themeum_client_testimonial",
	'icon' => 'icon-thm-client-testimonial',
	"class" => "",
	"description" => esc_html__("Client Testimonial", 'eventum'),
	"category" => esc_html__('Themeum', 'eventum'),
	"params" => array(


		array(
			"type" => "attach_image",
			"heading" => esc_html__("Client Image", 'eventum'),
			"param_name" => "client_image",
			"value" => "",
			),	

		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Client Name", 'eventum'),
			"param_name" => "client_name",
			"value" => "",
			),

		array(
			"type" => "textarea",
			"heading" => esc_html__("Client Comments", 'eventum'),
			"param_name" => "client_text",
			"value" => "",
			),


		array(
			"type" => "textfield",
			"heading" => esc_html__("Add Extra CSS Class", 'eventum'),
			"param_name" => "class",
			"value" => "",
			),


		)
	));
}