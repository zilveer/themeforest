<?php
add_shortcode( 'themeum_divider', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'divider'		=> 'border',
		'margin_top'	=> '40',
		'margin_bottom'	=> '40',
		'border_color'	=> '#eeeeee',
		'border_style'	=> 'none',
		'border_width'	=> '1',
		'divider_image'	=> '',
		'repeat'		=> 'repeat',
		'height'		=> '10',
		'class'			=> '',
		), $atts));

	$src_image   = wp_get_attachment_image_src($divider_image, 'full');

	//print_r($src_image[0]);

	$style = '';
	$style1 = '';
	$style2 = '';

	if($margin_top) $style .= 'margin-top:' . (int) $margin_top  . 'px;';

	if($margin_bottom) $style .= 'margin-bottom:' . (int) $margin_bottom  . 'px;';

	if($border_color) $style1 .= 'border-bottom-color:' . $border_color  . ';';

	if($border_style) $style1 .= 'border-bottom-style:' . $border_style  . ';';

	if($border_width) $style1 .= 'border-width:' . (int) $border_width  . 'px;';

	if($height) $style2 .= 'height:' . (int) $height  . 'px;';

	if($src_image) $style2 .= 'background-image: url(' . $src_image[0]  . ');background-repeat: '.$repeat.'; background-position: 50% 50%;';


    switch ($divider) {
        case 'border':
        	$output = '<div class="clearfix"></div>';
        	$output = '<div class="themeum-divider  themeum-'.$divider.'" style="'.$style.' '. $style1 .'"></div>';
            break;
        case 'div-image':
        	$output = '<div class="clearfix"></div>';
        	$output = '<div class="themeum-divider  themeum-'.$divider.'" style="'.$style.' '. $style2 .'"></div>';
            break;
        default:
        	$output = '<div class="clearfix"></div>';
            $output = '<div class="themeum-divider  themeum-'.$divider.'" style="'. $style .'"></div>';
            break;
    }

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Themeum Divider", "themeum"),
	"base" => "themeum_divider",
	'icon' => 'icon-thm-divider',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Divider", "themeum"),
			"param_name" => "divider",
			"value" => array('Border'=>'border','Image'=>'div-image'),
			),

		array(
			"type" => "attach_image",
			"heading" => __("Image Divider", "themeum"),
			"param_name" => "divider_image",
			"value" => "",
			),			

		array(
			"type" => "dropdown",
			"heading" => __("Image Repeat", "themeum"),
			"param_name" => "repeat",
			"value" => array('Repeat'=>'repeat','No-Repeat'=>'no-repeat'),
			),	

		array(
			"type" => "textfield",
			"heading" => __("Image Height", "themeum"),
			"param_name" => "height",
			"value" => ""
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Border Color", "themeum"),
			"param_name" => "border_color",
			"value" => "",
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Border Style", "themeum"),
			"param_name" => "border_style",
			"value" => array('None'=>'none','Solid'=>'solid','Dashed'=>'dashed','Dotted'=>'dotted'),
			),

		array(
			"type" => "textfield",
			"heading" => __("Border Width", "themeum"),
			"param_name" => "border_width",
			"value" => ""
			),										

		array(
			"type" => "textfield",
			"heading" => __("Margin Top", "themeum"),
			"param_name" => "margin_top",
			"value" => ""
			),			

		array(
			"type" => "textfield",
			"heading" => __("Margin Bottom", "themeum"),
			"param_name" => "margin_bottom",
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