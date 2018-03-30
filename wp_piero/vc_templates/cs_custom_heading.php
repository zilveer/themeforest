<?php

$output = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = '';
extract( $this->getAttributes( $atts ) );
$atts['style'] = isset($atts['style'])?$atts['style']:'style-none';
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets  = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
$line_height ='';
if($font_container_data['values']['line_height'] =='') { $line_height = 'line-height:'.$font_container_data['values']['font_size'].';';}

$output .= '<div class="cs-heading-wrap clearfix">';
$output .= '<div class="'.$atts['style'].' '.$font_container_data['values']['text_align'].' custom-heading-wrap" >';
	$output .= '<div class="' . $css_class . '" >';
	$output .= '<' . $font_container_data['values']['tag'] . ' class="cs-heading-tag '.$el_class.'" style="' .$line_height.' '. implode( ';', $styles ) . '">';
	if(!empty($atts['title_icon'])){
		$output.="<i class='".$atts['title_icon']."'></i> ";
	}
	$output .= '<span>'.$text.'</span>';
	$output .= '</' . $font_container_data['values']['tag'] . '>';
	$output .= '</div>';
	if($atts['style']=='title-bottom-line'){
		$output.='<div class="title-bottom-line-wrap">';
		$style_inline="";
		if(isset($atts['title_bottom_line_width'])){
			$style_inline.="width:".$atts['title_bottom_line_width'].";";
		}
		if(isset($atts['title_bottom_line_height'])){
			$style_inline.="height:".$atts['title_bottom_line_height'].";";
		}
		if(isset($atts['title_bottom_line_color'])){
			$style_inline.="background:".$atts['title_bottom_line_color'].";";
		}
		if(isset($atts['title_bottom_line_margin_bottom'])){
			$style_inline.="margin-bottom:".$atts['title_bottom_line_margin_bottom'].";";
		}
		$output.='<div class="title-bottom-line-inner" style="'.$style_inline.'"></div>';
		$output.="</div>";
	}
	if($atts['style']=='title-bottom-dotted'){
		$output.='<div class="title-bottom-dotted-wrap">';
		$style_inline="";
	
		if(isset($atts['title_bottom_line_width'])){
			$style_inline.="width:".$atts['title_bottom_line_width'].";";
		}
		if(isset($atts['title_bottom_line_height'])){
			$style_inline.="border-bottom:".$atts['title_bottom_line_height']." dotted;";
		}else{
			$style_inline.="border-bottom:6px dotted;";
		}
		if(isset($atts['title_bottom_line_color'])){
			$style_inline.="border-color:".$atts['title_bottom_line_color'].";";
		}
		if(isset($atts['title_bottom_line_margin_bottom'])){
			$style_inline.="margin-bottom:".$atts['title_bottom_line_margin_bottom'].";";
		}
		
		$output.='<div class="title-bottom-dotted-inner" style="'.$style_inline.'"></div>';
		$output.="</div>";
	}
$output .= '</div>';
$output .= '</div>';

echo $output;