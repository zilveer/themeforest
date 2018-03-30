<?php
add_shortcode( 'themeum_pricing_table', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' => '',
		'price'	=> '$9',
		'duration'	=> 'Month',
		'details' => '',
		'url' => '#',
		'text' => 'Buy Now!',
		'featured' => ''
		), $atts));

	$output  = '<div class="pricing '. $featured .'">';
	$output .= '<div class="pricing-plan">';
	$output .= '<h3 class="plan-title">' . $title . '</h3>';
	$output .= '<span class="plan-price">' . $price . '<span class="duration">' . $duration . '</span></span>';
	$output .= '<div class="plan-details">' .$details . '</div>';
	$output .= '<div class="plan-action">';
	$output .= '<a href="' . $url . '" class="btn btn-primary btn-pricing">' . $text . '</a>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Pricing Table", "themeum"),
		"base" => "themeum_pricing_table",
		'icon' => 'icon-thm-pricing-table',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Title", "themeum"),
				"param_name" => "title",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Price", "themeum"),
				"param_name" => "price",
				"value" => "",
				"admin_label"=>true
				),			

			array(
				"type" => "textfield",
				"heading" => __("Price Duration", "themeum"),
				"param_name" => "duration",
				"value" => "",
				"admin_label"=>true
				),

			array(
				"type" => "textarea_html",
				"heading" => __("Pricing Details", "themeum"),
				"param_name" => "details",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => __("Button URL", "themeum"),
				"param_name" => "url",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => __("Button Text", "themeum"),
				"param_name" => "text",
				"value" => ""
				),

			array(
				"type" => "checkbox",
				"heading" => __("Featured", "themeum"),
				"param_name" => "featured",
				"value" => Array(__("Featured", "themeum") => "featured")
				),

			)
		));
}