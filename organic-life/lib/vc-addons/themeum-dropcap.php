<?php
add_shortcode( 'themeum_dropcap', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'text'	=> '',
		'class'	=> '',
		), $atts));


	if($text) $output = '<div class="drop-cap '.$class.'">' . $text . '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Themeum Dropcap", "themeum"),
	"base" => "themeum_dropcap",
	'icon' => 'icon-thm-dropcap',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(
			

		array(
			"type" => "textarea",
			"heading" => __("Dropcap Text", "themeum"),
			"param_name" => "text",
			"value" => ""
			),		

		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),

		)
	));
}