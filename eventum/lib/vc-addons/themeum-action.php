<?php
add_shortcode( 'themeum_call_to_action', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 					=> '',
		'cta_image'					=> '',
		'padding'					=> '',
		'title_weight' 				=> '400',
		'title_size' 				=> '',
		'title_color' 				=> '',
		'title_margin' 				=> '',
		'btn_text'					=> '',
		'btn_url'					=> '',
		'btn_margin'				=> '',
		'subtitle'					=> '',
		'subtitle_size'				=> '',
		'subtitle_color'			=> '',
		'position'					=> 'right',
		'class'						=> '',
		), $atts));


	$font_size = '';
	$font_size2 = '';
	$btnmargin = '';
	$bg_image = '';
	$style = '';
	$src_image   = wp_get_attachment_image_src($cta_image, 'full');

	if($src_image) $style .= 'background-image: url(' . $src_image[0]  . ');';
	if($padding)   $style .= 'padding:'.$padding.';';


	if($title_size) $font_size .= 'font-size:' . (int) $title_size . 'px;line-height:' . (int) $title_size . 'px;';
	if($title_color) $font_size .= 'color:' .  $title_color . ';';
	if($title_margin) $font_size .= 'margin:' .  $title_margin . ';';
	if($title_weight) $font_size .= 'font-weight:'. $title_weight .';';

	if($btn_margin) $btnmargin .= 'margin:' .  $btn_margin . ';display:inline-block;';

	if($subtitle_size) $font_size2 .= 'font-size:' . (int) $subtitle_size . 'px;';
	if($subtitle_color) $font_size2 .= 'color:' .  $subtitle_color . ';';

	switch ($position) {

        case 'right':
        	    $output = '<div class="themeum-action-shortcode '.$class.'" style="'. $style .'">';
				$output .= '<div class="row">';

				$output .= '<div class="col-sm-8">';
				if ($title)
    			{
					$output .= '<h3 class="themeum-action-title" style="' . $font_size . '">' . $title . '</h3>';
				}
				if ($subtitle)
    			{
					$output .= '<span class="themeum-action-subtitle" style="' . $font_size2 . '">' . $subtitle . '</span>';
				}
				$output .= '</div>';

				$output .= '<div class="col-sm-4">';
				$output .= '<div class="text-right">';
				if ($btn_url)
				{
					$output .= '<a class="acton-btn" href="' . $btn_url . '">' . $btn_text . '</a>';
				}
				$output .= '</div>';
				$output .= '</div>';				

				$output .= '</div>';
				$output .= '</div>';
            break; 

        case 'center':
        	    $output = '<div class="themeum-action-shortcode '.$class.'" style="'. $bg_image .'text-align:center;">';
				$output .= '<div class="themeum-action-center">';	
				if ($title)
    			{
					$output .= '<h3 class="themeum-action-title" style="' . $font_size . '">' . $title . '</h3>';
				}
				if ($subtitle)
    			{
					$output .= '<p class="themeum-action-subtitle" style="' . $font_size2 . '">' . $subtitle . '</p>';
				}
				if ($btn_url)
				{
					$output .= '<a class="acton-btn" style="'.$btnmargin.'" href="' . $btn_url . '">' . $btn_text . '</a>';
				}
				$output .= '</div>';
				$output .= '</div>';
            break;
         
        default:
        	     $output = '<div class="themeum-action-shortcode '.$class.'" style="'. $bg_image .'">';
				$output .= '<div class="row">';

				$output .= '<div class="col-sm-8">';
				if ($title)
    			{
					$output .= '<h3 class="themeum-action-title" style="' . $font_size . '">' . $title . '</h3>';
				}
				if ($subtitle)
    			{
					$output .= '<span class="themeum-action-subtitle" style="' . $font_size2 . '">' . $subtitle . '</span>';
				}
				$output .= '</div>';

				$output .= '<div class="col-sm-4">';
				$output .= '<div class="text-right">';
				if ($btn_url)
				{
					$output .= '<a class="acton-btn" href="' . $btn_url . '">' . $btn_text . '</a>';
				}
				$output .= '</div>';
				$output .= '</div>';				

				$output .= '</div>';
				$output .= '</div>';
            break;
    }

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Call to action", 'eventum'),
	"base" => "themeum_call_to_action",
	'icon' => 'icon-thm-call-to-action',
	"class" => "",
	"description" => esc_html__("Call to action shortcode.", 'eventum'),
	"category" => esc_html__('Themeum', 'eventum'),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button Position", 'eventum'),
			"param_name" => "position",
			"value" => array('Right'=>'right','Center'=>'center'),
			),	

		array(
			"type" => "attach_image",
			"heading" => esc_html__("Background Image", 'eventum'),
			"param_name" => "cta_image",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => esc_html__("Content Padding Ex. 30px 30px 30px 30px", 'eventum'),
			"param_name" => "padding",
			"value" => "30px 30px 30px 30px",
			),			

		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'eventum'),
			"param_name" => "title",
			"value" => "",
			"admin_label"=>true,
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Title Font Size", 'eventum'),
			"param_name" => "title_size",
			"value" => "24",
			),	
		
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Title Font Wight", 'eventum'),
			"param_name" => "title_weight",
			"value" => array('400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
			),	

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Title Color", 'eventum'),
			"param_name" => "title_color",
			"value" => "#333333",
			),			

		array(
			"type" => "textfield",
			"heading" => esc_html__("Title Margin Ex. 10px 0 5px 0", 'eventum'),
			"param_name" => "title_margin",
			"value" => "10px 0px 5px 0px",
			),			

		array(
			"type" => "textarea",
			"heading" => esc_html__("Sub Title", 'eventum'),
			"param_name" => "subtitle",
			"value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dignissim"
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Sub Title Font Size", 'eventum'),
			"param_name" => "subtitle_size",
			"value" => "16",
			),	

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Sub Title Color", 'eventum'),
			"param_name" => "subtitle_color",
			"value" => "#999999",
			),	

		array(
			"type" => "textfield",
			"heading" => esc_html__("Button Text", 'eventum'),
			"param_name" => "btn_text",
			"value" => "Button"
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Button Url", 'eventum'),
			"param_name" => "btn_url",
			"value" => ""
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Button Margin Ex. 10px 0 5px 0", 'eventum'),
			"param_name" => "btn_margin",
			"value" => "10px 0px 5px 0px",
			),


		array(
			"type" => "textfield",
			"heading" => esc_html__("Class", 'eventum'),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}