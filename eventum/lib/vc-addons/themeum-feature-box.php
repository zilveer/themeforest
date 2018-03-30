<?php
add_shortcode( 'themeum_feature_box', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'name' 				=> '',
		'box_type' 			=> 'box_image',
		'image' 			=> '',
		'color'		 		=> '',
		'title_color'		=> '',
		'size' 				=> '',
		'title_size' 		=> '',
		'layout' 			=> 'icon_title',
		'position' 			=> 'center',
		'title' 			=> '',
		'title_margin' 		=> '',
		'text_transform' 	=> 'capitalize',
		'title_weight' 		=> '700',
		'letter_spacing' 	=> '',
		'desc' 				=> '',
		'border_color' 		=> '',
		'border_style' 		=> 'none',
		'border_width' 		=> '',
		'border_radius' 	=> '',
		'background' 		=> '',
		'width' 			=> '',
		'height' 			=> '',
		'link' 				=> '',
		'btn' 				=> '',
		'target' 			=> '_blank',
		'class' 			=> '',
		), $atts));

	$style = 'text-align:center;';
	$style2 = '';
	$font_size = '';
	$titlemargin='';
	$align = '';

	$src_image   = wp_get_attachment_image_src($image, 'full');

	if($width) $style .= 'width:' . (int) esc_attr($width)  . 'px;';
	if($height) $style .= 'height:' . (int) esc_attr($height)  . 'px;';
	if($height) $style .= 'line-height:' . (int) esc_attr($height)  . 'px;';
	if($color) $style .= 'color:' . esc_attr($color)  . ';';
	if($border_style) $style .= 'border-style:' . esc_attr($border_style)  . ';';
	if($background) $style .= 'background-color:' . esc_attr($background)  . ';';
	if($border_color) $style .= 'border-color:' . esc_attr($border_color)  . ';';
	if($border_width) $style .= 'border-width:' . (int) esc_attr($border_width) . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) esc_attr($border_radius)  . 'px;';

	if($size) $font_size .= 'font-size:' . (int) esc_attr($size) . 'px;line-height:'. (int) esc_attr($height)  .'px;';

	if($width) $style2 .= 'width:' . (int) esc_attr($width)  . 'px;';
	if($height) $style2 .= 'height:' . (int) esc_attr($height)  . 'px;';
	if($border_radius) $style2 .= 'border-radius:' . (int) esc_attr($border_radius)  . 'px;';
	if($border_color) $style2 .= 'border-color:' . esc_attr($border_color)  . ';';
	if($border_width) $style2 .= 'border-width:' . (int) esc_attr($border_width ) . 'px;';
	if($border_style) $style2 .= 'border-style:' . esc_attr($border_style ) . ';';

	if($title_margin) $titlemargin .= 'margin:' . esc_attr($title_margin)  . ';';

	if($title_size) $titlemargin .= 'font-size:' . (int) esc_attr($title_size) . 'px;line-height:'. (int) esc_attr($title_size ) .'px;';

	if($text_transform) $titlemargin .= 'text-transform:'. esc_attr($text_transform) .';';

	if($title_weight) $titlemargin .= 'font-weight:'. esc_attr($title_weight) .';';

	if($letter_spacing) $titlemargin .= 'letter-spacing:'. esc_attr($letter_spacing) .';';
	if($title_color) $titlemargin .= 'color:' . esc_attr($title_color)  . ';';

	if($position) $align .= 'text-align:'. esc_attr($position) .';';


	$output = '';


    switch ($layout) {
        case 'icon_title':
				$output   .= '<div class="themeum-feature-box title-icon ' . esc_attr($class) . '" style="'. $align .'">';
				if($box_type == 'icon_box'){
					$output  .= '<div class="icon" style="' . $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="icon">';
					$output  	.= '<img style="'.$style2.'" src="' . esc_url($src_image[0]). '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="icon" style="' . $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}
				$output  .= '</div>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. esc_attr($title) .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' . esc_attr($btn) .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;

        case 'icon_left':
				$output   .= '<div class="themeum-feature-box icon-left media ' . esc_attr($class) . '" style="'. $align .'">';
				if($box_type == 'icon_box'){
					$output  .= '<div class="pull-left icon" style="display:inline-block;' . $style . ';">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="pull-left icon">';
					$output  	.= '<img style="'.$style2.'" src="' . esc_url($src_image[0]). '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="pull-left icon" style="display:inline-block;' . $style . ';">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}	
				$output  .= '</div>';			
				$output  .= '<div class="media-body">';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. esc_attr($title) .'</h3>';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' . esc_attr($btn) .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;   

        case 'icon_top':
				$output   .= '<div class="themeum-feature-box top-icon ' . esc_attr($class) . '" style="'. $align .'">';

				if($box_type == 'icon_box'){
					$output  .= '<span class="icon" style="display: inline-block; ' . $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<span class="icon" style="display: inline-block;">';
					$output  	.= '<img style="'.$style2.'" src="' . esc_url($src_image[0]). '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<span class="icon" style="display: inline-block; ' . $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}
				$output  .= '</span>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. esc_attr($title) .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' . esc_attr($btn) .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;             

        case 'icon_top2':
				$output   .= '<div class="themeum-feature-box top-icon2 ' . esc_attr($class) . '" style="'. $align .'">';

				if($box_type == 'icon_box'){
					$output  .= '<div style="display:inline-block"><div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px; '. $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px;">';
					$output  	.= '<img style="'.$style2.'" src="' . esc_url($src_image[0]). '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px; '. $style . '">';
					$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				}
				
				$output  .= '</div></div>';
				
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. esc_attr($title) .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' . esc_attr($btn) .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;

        default:
				$output   .= '<div class="themeum-feature-box ' . esc_attr($class) . '" style="'. $align .'">';
				$output  .= '<span style="display:inline-block;' . $style . ';">';
				$output  .= '<i class="fa ' . esc_attr($name) . '" style="' . $font_size . ';"></i>';
				$output  .= '</span>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. esc_attr($title) .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' . esc_attr($btn) .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;
    }	

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => esc_html__("Themeum Feature Box", 'eventum'),
		"base" => "themeum_feature_box",
		'icon' => 'icon-thm-feature-box',
		"category" => esc_html__('Themeum', 'eventum'),
		"params" => array(

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Design Layout", 'eventum'),
				"param_name" => "layout",
				"value" => array('Title With Icon'=>'icon_title','Icon Left'=>'icon_left','Icon Top'=>'icon_top','Icon Top 2'=>'icon_top2'),
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Position", 'eventum'),
				"param_name" => "position",
				"value" => array('Left'=>'left','Center'=>'center','Right'=>'right'),
				),								

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Icon Name ", 'eventum'),
				"param_name" => "name",
				"value" => getIconsList(),
				"admin_label"=>true,
				),				
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image Box", 'eventum'),
				"param_name" => "image",
				"value" => ""
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Box Type ", 'eventum'),
				"param_name" => "box_type",
				"value" => array('Icon'=>'icon_box','Image'=>'box_image'),
				"admin_label"=>true,
				),	

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Icon Color", 'eventum'),
				"param_name" => "color",
				"value" => "",
				),	
				
			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Background", 'eventum'),
				"param_name" => "background",
				"value" => "",
				),				


			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Size", 'eventum'),
				"param_name" => "size",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => esc_html__("Width ", 'eventum'),
				"param_name" => "width",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Height ", 'eventum'),
				"param_name" => "height",
				"value" => "36",
				),	

			array(
				"type" => "textfield",
				"heading" => esc_html__("Border Radius", 'eventum'),
				"param_name" => "border_radius",
				"value" => "100",
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Border Width", 'eventum'),
				"param_name" => "border_width",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Border Style", 'eventum'),
				"param_name" => "border_style",
				"value" => array('Solid'=>'solid','Dashed'=>'dashed','Dotted'=>'dotted','None'=>'none'),
				),			

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Border Color", 'eventum'),
				"param_name" => "border_color",
				"value" => "rgba(255, 255, 255, 0)",
				),					

			array(
				"type" => "textfield",
				"heading" => esc_html__("Feature Title ", 'eventum'),
				"param_name" => "title",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Title Font Color", 'eventum'),
				"param_name" => "title_color",
				"value" => "#333",
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Title Font Size", 'eventum'),
				"param_name" => "title_size",
				"value" => "18",
				),

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Title Text Transform", 'eventum'),
				"param_name" => "text_transform",
				"value" => array('Capitalize'=>'capitalize','Uppercase'=>'uppercase','Lowercase'=>'lowercase','None'=>'none'),
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Title Font Wight", 'eventum'),
				"param_name" => "title_weight",
				"value" => array('400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Title Font Letter Spacing Ex. 1px", 'eventum'),
				"param_name" => "letter_spacing",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Title Margin Ex. 5px 0 5px 0", 'eventum'),
				"param_name" => "title_margin",
				"value" => "",
				),	


			array(
				"type" => "textarea",
				"heading" => esc_html__("Feature Description ", 'eventum'),
				"param_name" => "desc",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Link URL", 'eventum'),
				"param_name" => "link",
				"value" => ""
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Name", 'eventum'),
				"param_name" => "btn",
				"value" => ""
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Target Link", 'eventum'),
				"param_name" => "target",
				"value" => array('Blank'=>'_blank','Parent'=>'_parent','Self'=>'_self'),
				),	

			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Class ", 'eventum'),
				"param_name" => "class",
				"value" => "",
				)
			),
		));
}