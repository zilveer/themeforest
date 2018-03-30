<?php
add_shortcode( 'themeum_feature_box', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'name' 				=> '',
		'box_type' 			=> 'icon_box',
		'image' 			=> '',
		'color'		 		=> '#62A83D',
		'title_color'		=> '#333',
		'size' 				=> '14',
		'title_size' 		=> '18',
		'layout' 			=> 'icon_title',
		'position' 			=> 'left',
		'title' 			=> '',
		'title_margin' 		=> '5px 0 5px 0',
		'text_transform' 	=> 'capitalize',
		'title_weight' 		=> '400',
		'letter_spacing' 	=> '0px',
		'desc' 				=> '',
		'border_color' 		=> 'rgba(255, 255, 255, 0)',
		'border_style' 		=> 'solid',
		'border_width' 		=> '4',
		'border_radius' 	=> '100',
		'background' 		=> 'rgba(255,255,255,0)',
		'width' 			=> '36',
		'height' 			=> '36',
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

	if($width) $style .= 'width:' . (int) $width  . 'px;';
	if($height) $style .= 'height:' . (int) $height  . 'px;';
	if($height) $style .= 'line-height:' . (int) $height  . 'px;';
	if($color) $style .= 'color:' . $color  . ';';
	if($border_style) $style .= 'border-style:' . $border_style  . ';';
	if($background) $style .= 'background-color:' . $background  . ';';
	if($border_color) $style .= 'border-color:' . $border_color  . ';';
	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';

	if($size) $font_size .= 'font-size:' . (int) $size . 'px;line-height:'. (int) $height  .'px;';

	if($width) $style2 .= 'width:' . (int) $width  . 'px;';
	if($height) $style2 .= 'height:' . (int) $height  . 'px;';
	if($border_radius) $style2 .= 'border-radius:' . (int) $border_radius  . 'px;';
	if($border_color) $style2 .= 'border-color:' . $border_color  . ';';
	if($border_width) $style2 .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_style) $style2 .= 'border-style:' . $border_style  . ';';

	if($title_margin) $titlemargin .= 'margin:' . $title_margin  . ';';

	if($title_size) $titlemargin .= 'font-size:' . (int) $title_size . 'px;line-height:'. (int) $title_size  .'px;';

	if($text_transform) $titlemargin .= 'text-transform:'. $text_transform .';';

	if($title_weight) $titlemargin .= 'font-weight:'. $title_weight .';';

	if($letter_spacing) $titlemargin .= 'letter-spacing:'. $letter_spacing .';';
	if($title_color) $titlemargin .= 'color:' . $title_color  . ';';

	if($position) $align .= 'text-align:'. $position .';';


	$output = '';


    switch ($layout) {
        case 'icon_title':
				$output   = '<div class="themeum-feature-box title-icon ' . $class . '" style="'. $align .'">';
				if($box_type == 'icon_box'){
					$output  .= '<div class="icon" style="' . $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="icon">';
					$output  	.= '<img style="'.$style2.'" src="' . $src_image[0]. '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="icon" style="' . $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}
				$output  .= '</div>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. $title .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. $link .'" target="'. $target .'">' . $btn .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;

        case 'icon_left':
				$output   = '<div class="themeum-feature-box icon-left media ' . $class . '" style="'. $align .'">';
				if($box_type == 'icon_box'){
					$output  .= '<div class="pull-left icon" style="display:inline-block;' . $style . ';">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="pull-left icon">';
					$output  	.= '<img style="'.$style2.'" src="' . $src_image[0]. '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="pull-left icon" style="display:inline-block;' . $style . ';">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}	
				$output  .= '</div>';			
				$output  .= '<div class="media-body">';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. $title .'</h3>';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. $link .'" target="'. $target .'">' . $btn .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;   

        case 'icon_top':
				$output   = '<div class="themeum-feature-box top-icon ' . $class . '" style="'. $align .'">';

				if($box_type == 'icon_box'){
					$output  .= '<span class="icon" style="display: inline-block; ' . $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<span class="icon" style="display: inline-block;">';
					$output  	.= '<img style="'.$style2.'" src="' . $src_image[0]. '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<span class="icon" style="display: inline-block; ' . $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}
				$output  .= '</span>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. $title .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. $link .'" target="'. $target .'">' . $btn .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;             

        case 'icon_top2':
				$output   = '<div class="themeum-feature-box top-icon2 ' . $class . '" style="'. $align .'">';

				if($box_type == 'icon_box'){
					$output  .= '<div style="display:inline-block"><div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px; '. $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}elseif($box_type == 'box_image'){
					$output  .= '<div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px;">';
					$output  	.= '<img style="'.$style2.'" src="' . $src_image[0]. '" class="img-responsive" alt="photo">';
				}else{
					$output  .= '<div class="icon" style="display: inline-block;margin-top:-' . (int) $height/2 . 'px; margin-left:-' . (int) $width/2 . 'px; '. $style . '">';
					$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				}
				
				$output  .= '</div></div>';
				
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. $title .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. $link .'" target="'. $target .'">' . $btn .'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
            break;

        default:
				$output   = '<div class="themeum-feature-box ' . $class . '" style="'. $align .'">';
				$output  .= '<span style="display:inline-block;' . $style . ';">';
				$output  .= '<i class="fa ' . $name . '" style="' . $font_size . ';"></i>';
				$output  .= '</span>';
				$output  .= '<h3 class="box-title" style="'.$titlemargin.'">'. $title .'</h3>';
				$output  .= '<div class="box-content">';
				$output  .= '<p>'. $desc .'</p>';
				if($link){
					$output  .= '<a class="box-btn" href="'. $link .'" target="'. $target .'">' . $btn .'</a>';
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
		"name" => __("Themeum Feature Box", "themeum"),
		"base" => "themeum_feature_box",
		'icon' => 'icon-thm-feature-box',
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "dropdown",
				"heading" => __("Design Layout", "themeum"),
				"param_name" => "layout",
				"value" => array('Title With Icon'=>'icon_title','Icon Left'=>'icon_left','Icon Top'=>'icon_top','Icon Top 2'=>'icon_top2'),
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Position", "themeum"),
				"param_name" => "position",
				"value" => array('Left'=>'left','Center'=>'center','Right'=>'right'),
				),								

			array(
				"type" => "dropdown",
				"heading" => __("Icon Name ", "themeum"),
				"param_name" => "name",
				"value" => getIconsList(),
				"admin_label"=>true,
				),				
			array(
				"type" => "attach_image",
				"heading" => __("Image Box", "themeum"),
				"param_name" => "image",
				"value" => ""
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Box Type ", "themeum"),
				"param_name" => "box_type",
				"value" => array('Icon'=>'icon_box','Image'=>'box_image'),
				"admin_label"=>true,
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
				"type" => "textfield",
				"heading" => __("Custom Size", "themeum"),
				"param_name" => "size",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Width ", "themeum"),
				"param_name" => "width",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Height ", "themeum"),
				"param_name" => "height",
				"value" => "",
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
				"type" => "dropdown",
				"heading" => __("Border Style", "themeum"),
				"param_name" => "border_style",
				"value" => array('Solid'=>'solid','Dashed'=>'dashed','Dotted'=>'dotted','None'=>'none'),
				),			

			array(
				"type" => "colorpicker",
				"heading" => __("Border Color", "themeum"),
				"param_name" => "border_color",
				"value" => "",
				),					

			array(
				"type" => "textfield",
				"heading" => __("Feature Title ", "themeum"),
				"param_name" => "title",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Title Font Color", "themeum"),
				"param_name" => "title_color",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Title Font Size", "themeum"),
				"param_name" => "title_size",
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Title Text Transform", "themeum"),
				"param_name" => "text_transform",
				"value" => array('Capitalize'=>'capitalize','Uppercase'=>'uppercase','Lowercase'=>'lowercase','None'=>'none'),
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Title Font Wight", "themeum"),
				"param_name" => "title_weight",
				"value" => array('400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
				),				

			array(
				"type" => "textfield",
				"heading" => __("Title Font Letter Spacing Ex. 1px", "themeum"),
				"param_name" => "letter_spacing",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Title Margin Ex. 5px 0 5px 0", "themeum"),
				"param_name" => "title_margin",
				"value" => "",
				),	


			array(
				"type" => "textarea",
				"heading" => __("Feature Description ", "themeum"),
				"param_name" => "desc",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Link URL", "themeum"),
				"param_name" => "link",
				"value" => ""
				),				

			array(
				"type" => "textfield",
				"heading" => __("Button Name", "themeum"),
				"param_name" => "btn",
				"value" => ""
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Target Link", "themeum"),
				"param_name" => "target",
				"value" => array('Blank'=>'_blank','Parent'=>'_parent','Self'=>'_self'),
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