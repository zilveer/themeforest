<?php
$args = array(
    "title"         => "",
	"title_tag" => "h5",
    "text"          => "",
    "icon"   => "",
    "size" => "fa-2x",
    "icon_color" => "",
    "top_gradient_background_color" => "",
    "bottom_gradient_background_color" => "",
    "border_color" => "",
    "icon_color_hover" => "",
    "top_gradient_background_color_hover" => "",
    "bottom_gradient_background_color_hover" => "",
    "border_color_hover" => ""
);

extract(shortcode_atts($args, $atts));

$style = "";
$style_hover = "";
$html = "";

if($icon_color != "" || $top_gradient_background_color != "" || $bottom_gradient_background_color != "" || $border_color != ""){
	$style = ' style="';
	if($icon_color != "") {
		$style .='color:'.$icon_color.';';
	}
	if($top_gradient_background_color != "" && $bottom_gradient_background_color != "") {
		$style .= "background: {$bottom_gradient_background_color};";
        $style .= "background: {$top_gradient_background_color} -ms-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $style .= "background: {$top_gradient_background_color} -moz-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $style .= "background: {$top_gradient_background_color} -o-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $style .= "background: {$top_gradient_background_color} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$bottom_gradient_background_color}), color-stop(1, {$top_gradient_background_color}));";
        $style .= "background: {$top_gradient_background_color} -webkit-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $style .= "background: {$top_gradient_background_color} linear-gradient(to top, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
	}
	if($border_color != "") {
		$style .='border-color:'.$border_color.';';
	}
	$style .= '";';
}

if($icon_color_hover != "" || $top_gradient_background_color_hover != "" || $bottom_gradient_background_color_hover != "" || $border_color_hover != ""){

	$style_hover .= ' style="';
	if($icon_color_hover != "") {
		$style_hover .='color:'.$icon_color_hover.';';
	}
	if($top_gradient_background_color_hover != "" && $bottom_gradient_background_color_hover != "") {
		$style_hover .= "background: {$bottom_gradient_background_color_hover};";
        $style_hover .= "background: {$top_gradient_background_color_hover} -ms-linear-gradient(bottom, {$bottom_gradient_background_color_hover} 0%, {$top_gradient_background_color_hover} 100%);";
        $style_hover .= "background: {$top_gradient_background_color_hover} -moz-linear-gradient(bottom, {$bottom_gradient_background_color_hover} 0%, {$top_gradient_background_color_hover} 100%);";
        $style_hover .= "background: {$top_gradient_background_color_hover} -o-linear-gradient(bottom, {$bottom_gradient_background_color_hover} 0%, {$top_gradient_background_color_hover} 100%);";
        $style_hover .= "background: {$top_gradient_background_color_hover} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$bottom_gradient_background_color_hover}), color-stop(1, {$top_gradient_background_color_hover}));";
        $style_hover .= "background: {$top_gradient_background_color_hover} -webkit-linear-gradient(bottom, {$bottom_gradient_background_color_hover} 0%, {$top_gradient_background_color_hover} 100%);";
        $style_hover .= "background: {$top_gradient_background_color_hover} linear-gradient(to top, {$bottom_gradient_background_color_hover} 0%, {$top_gradient_background_color_hover} 100%);";
	}
	if($border_color_hover != "") {
		$style_hover .='border-color:'.$border_color_hover.';';
	}
	$style_hover .= '";';
}

    $html .= '<div class="animated_icon_with_text_holder">';
    $html .= '<div class="animated_icon_with_text_inner">';
		$html .= '<div class="animated_icon_holder">';
		$html .= '<div class="animated_icon">';
			$html .= '<div class="animated_icon_inner">';
				$html .= '<span class="animated_icon_front">';
					$html .= "<i class='fa " . $size . " ".$icon."'" . $style . "></i>";
				$html .= '</span>';
				$html .= '<span class="animated_icon_back">';
					$html .= "<i class='fa " . $size . " ".$icon."'" . $style_hover ."></i>";
				$html .= '</span>';
		
			$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="animated_text_holder"><a href="javascript:void(0)" target="_self">';
		$html .= '<div class="animated_text_holder_wrap">';
		$html .= '<div class="animated_text_holder_wrap_inner">';
		$html .= '<div class="animated_text_holder_inner">';
	
			$html .= '<div class="animated_title">';
				$html .= '<div class="animated_title_inner">';
					$html .= '<'.$title_tag.'>';
						$html .= $title;
					$html .= '</'.$title_tag.'>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="animated_text">';
				$html .= '<p><span>';
					$html .= $text;
				$html .= '</span></p>';
			$html .= '</div>';
		
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</a></div>';
    $html .= '</div>';
    $html .= '</div>';

echo $html;