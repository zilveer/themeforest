<?php
add_shortcode( 'themeum_list_item', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'list' => 'list-default',
		'color' => '#62A83D',
		'size' => '14',
		'input' => '',
		'desc' => '',
		'class' => '',
		), $atts));

	$style = '';

	$font_size = '';

	if($color) $style .= 'color:' . $color  . ';';

	if($size) $style .= 'font-size:' . (int) $size . 'px;';

	$output = '';

	$output .= '<div class="list '.$list.' " style="'.$style.'">';

	$output .= $input;
	
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum List Item", "themeum"),
		"base" => "themeum_list_item",
		'icon' => 'icon-thm-list-item',
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "dropdown",
				"heading" => __("List Item", "themeum"),
				"param_name" => "list",
				"value" => array('Default'=>'list-default','Number'=>'list-number','Square'=>'list-square','Number 2'=>'list-number-background','List Arrow'=>'list-arrow','List Circle'=>'list-circle','List Star'=>'list-star'),
				),				
				

			array(
				"type" => "colorpicker",
				"heading" => __("Font Color", "themeum"),
				"param_name" => "color",
				"value" => "",
				),	
				

			array(
				"type" => "textfield",
				"heading" => __("Font Size", "themeum"),
				"param_name" => "size",
				"value" => "",
				),		

			array(
				"type" => "textarea_html",
				"heading" => __("Input List", "themeum"),
				"param_name" => "input",
				"value" => "",
				),	


			array(
				"type" => "textfield",
				"heading" => __("Custom Class ", "themeum"),
				"param_name" => "class",
				"value" => "",
				)


			),
		));
}
?>