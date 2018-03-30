<?php
add_shortcode( 'themeum_icons', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'name' => '',
		'position' => 'left',
		'color' => '#62A83D',
		'size' => '36',
		'border_color' => 'rgba(255, 255, 255, 0)',
		'border_width' => '4',
		'border_radius' => '100',
		'background' => '#ffffff',
		'margin_top' => '',
		'margin_bottom' => '',
		'padding' => '20',
		'class' => '',
		), $atts));

	$style = 'text-align:center;';
	$font_size = '';
	$align = '';

	if($position) $align .= 'text-align:'. $position .';';

	if($margin_top) $style .= 'margin-top:' . (int) $margin_top . 'px;';
	if($margin_bottom) $style .= 'margin-bottom:' . (int) $margin_bottom . 'px;';
	if($padding) $style .= 'padding:' . (int) $padding  . 'px;';
	if($color) $style .= 'color:' . $color  . ';';
	if($background) $style .= 'background-color:' . $background  . ';';
	if($border_color) $style .= 'border-style:solid;border-color:' . $border_color  . ';';
	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';

	if($size) $font_size .= 'font-size:' . (int) $size . 'px;width:' . (int) $size . 'px;height:' . (int) $size . 'px;line-height:' . (int) $size . 'px;';

	$output   = '<div class="themeum-icon ' . $class . '" style="'. $align .'">';
	$output  .= '<span style="display:inline-block;' . $style . ';">';
	$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
	$output  .= '</span>';
	$output  .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Icons", "themeum"),
		"base" => "themeum_icons",
		'icon' => 'icon-thm-icons',
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "dropdown",
				"heading" => __("Icon Name ", "themeum"),
				"param_name" => "name",
				"value" => getIconsList(),
				"admin_label"=>true,
				),					

			array(
				"type" => "textfield",
				"heading" => __("Custom Size", "themeum"),
				"param_name" => "size",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "themeum"),
				"param_name" => "color",
				"value" => "",
				),	
				
			array(
				"type" => "colorpicker",
				"heading" => __("Background", "themeum"),
				"param_name" => "background",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Position", "themeum"),
				"param_name" => "position",
				"value" => array('Left'=>'left','Center'=>'center','Right'=>'right'),
				),				

			array(
				"type" => "textfield",
				"heading" => __("Border Radius", "themeum"),
				"param_name" => "border_radius",
				"value" => "",
				),	


			array(
				"type" => "textfield",
				"heading" => __("Border Width", "themeum"),
				"param_name" => "border_width",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Border Color", "themeum"),
				"param_name" => "border_color",
				"value" => "",
				),			
		

			array(
				"type" => "textfield",
				"heading" => __("Margin Top", "themeum"),
				"param_name" => "margin_top",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Margin Bottom", "themeum"),
				"param_name" => "margin_bottom",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Padding ", "themeum"),
				"param_name" => "padding",
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