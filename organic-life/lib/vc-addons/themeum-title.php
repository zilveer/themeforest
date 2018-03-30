<?php
add_shortcode( 'themeum_title', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 			=> '',
		'color'				=> '#333',
		'position'			=> 'left',
		'size'				=> 'size',
		'title_margin'		=> '20px 0 20px 0',
		'title_padding'		=> '20px 0 20px 0',
		'style'				=> 'style1',
		'class'				=> ''
		), $atts));

	$align = '';
	$inline1 ='';


	if($title_margin) $inline1 .= 'margin:' . $title_margin .';';
	if($title_padding) $inline1 .= 'padding:' . $title_padding .';';
	if($position) $align .= 'text-align:'. $position .';';

	if($size) $inline1 .= 'font-size:' . (int) $size . 'px;line-height: normal;';

	if($color) $inline1 .= 'color:' . $color  . ';';

	$output = '';

    switch ($style) {
        case 'style1':
        	$output .= '<div class="themeum-title  '.$class.'" style="'. $align .'">';
			$output .= '<h3 class="style-title1" style="'.$inline1.'"><span class="span-title1">' . $title . '</span></h3>';
			$output .= '</div>';
            break;
        case 'style2':
			$output .= '<div class="themeum-title  '.$class.'" style="'. $align .'">';
			$output .= '<h3 class="style-title2" style="'.$inline1.'"><span class="span-title2" style="padding:'.$title_padding.';">' . $title . '</span></h3>';
			$output .= '</div>';
            break;
        default:
        	$output .= '<div class="themeum-title  '.$class.'" style="'. $align .'">';
			$output .= '<h2 class="style-title1" style="'.$inline1.'">' . $title . '</h2>';
			$output .= '</div>';
            break;
    }

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Themeum Title", "themeum"),
	"base" => "themeum_title",
	'icon' => 'icon-thm-title',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Style", "themeum"),
			"param_name" => "style",
			"value" => array('Style1'=>'style1','Style2'=>'style2'),
			),	

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
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Font Size", "themeum"),
			"param_name" => "size",
			"value" => "",
			),					

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "color",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Title Margin", "themeum"),
			"param_name" => "title_margin",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title Padding", "themeum"),
			"param_name" => "title_padding",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Custom Class ", "themeum"),
			"param_name" => "class",
			"value" => "",
			),

		)
	));
}