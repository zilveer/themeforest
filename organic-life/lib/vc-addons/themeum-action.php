<?php
add_shortcode( 'themeum_call_to_action', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 					=> '',
		'title_size' 				=> '24',
		'title_color' 				=> '#333333',
		'title_margin' 				=> '10px 0px 5px 0px',
		'subtitle'					=> '',
		'subtitle_size'				=> '16',
		'subtitle_color'			=> '#999999',
		'position'					=> 'left',
		'class'						=> '',
		), $atts));

	$align = '';
	$font_size = '';
	$font_size2 = '';

	if($position) $align .= 'text-align:'. $position .';';
	if($title_size) $font_size .= 'font-size:' . (int) $title_size . 'px;line-height:' . (int) $title_size . 'px;';
	if($title_color) $font_size .= 'color:' .  $title_color . ';';
	if($title_margin) $font_size .= 'margin:' .  $title_margin . ';';

	if($subtitle_size) $font_size2 .= 'font-size:' . (int) $subtitle_size . 'px;line-height:' . (int) $subtitle_size . 'px;';
	if($subtitle_color) $font_size2 .= 'color:' .  $subtitle_color . ';';

	$output = '<div class="themeum-action-shortcode '.$class.'" style="'. $align .'">';
	$output .= '<h3 class="themeum-action-title" style="' . $font_size . '">' . $title . '</h3>';
	$output .= '<span class="themeum-action-subtitle" style="' . $font_size2 . '">' . $subtitle . '</span>';
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Themeum Call to action", "themeum"),
	"base" => "themeum_call_to_action",
	'icon' => 'icon-thm-call-to-action',
	"class" => "",
	"description" => __("Call to action shortcode.", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Position", "themeum"),
			"param_name" => "position",
			"value" => array('Left'=>'left','Center'=>'center','Right'=>'right'),
			),			

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => "Call to action title",
			"admin_label"=>true,
			),

		array(
			"type" => "textfield",
			"heading" => __("Title Font Size", "themeum"),
			"param_name" => "title_size",
			"value" => "",
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "title_color",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Margin Ex. 10px 0 5px 0", "themeum"),
			"param_name" => "title_margin",
			"value" => "",
			),			

		array(
			"type" => "textarea",
			"heading" => __("Sub Title", "themeum"),
			"param_name" => "subtitle",
			"value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dignissim"
			),

		array(
			"type" => "textfield",
			"heading" => __("Sub Title Font Size", "themeum"),
			"param_name" => "subtitle_size",
			"value" => "",
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Sub Title Color", "themeum"),
			"param_name" => "subtitle_color",
			"value" => "",
			),						

		array(
			"type" => "textfield",
			"heading" => __("Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}