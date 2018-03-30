<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
	'el_class' => '',
	'row_type' => 'row',
	'use_as_box' => '',
	'type' => 'full_width',
	'anchor' => '',
	'in_content_menu'=>'',
	'content_menu_title' => '',
	'content_menu_icon' => '',
	'video' => '',
	'video_overlay' => '',
	'video_overlay_image' => '',
	'video_webm' => '',
	'video_mp4' => '',
	'video_ogv' => '',
	'video_image' => '',
	'background_color' => '',
	'section_height' => '',
	'background_image' => '',
	'border_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'padding' => '',
	'text_align' => 'left',
	'more_button_label' =>'More Facts',
	'less_button_label'=>'Less Facts',
	'button_position'=>'left',
	'color'=>'',
	'css_animation'=>'',
	'transition_delay'=>'',
    'css' => '',
    'bg_image',
    'margin_bottom',
    'bg_color',
    'bg_image_repeat',
    'bg_image',
    'font_color',
    'el_id' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row section ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if($type == "grid"){
	$css_class_type =  " grid_section";
} else {
	$css_class_type =  "";
}

if($type == "grid"){
	$css_class_type_inner =  " section_inner";
} else {
	$css_class_type_inner =  "";
}

$css_class_video =  "";
if($video == "show_video"){
	$css_class_video =  " video_section";
}

$css_class_in_content_menu =  "";
if($in_content_menu == "in_content_menu"){
	$css_class_in_content_menu =  " in_content_menu";
}

$_image ="";
if($background_image != '' || $background_image != ' ') { 
	$_image = wp_get_attachment_image_src( $background_image, 'full');
}

$overlay_image ="";
if($video_overlay_image != '' && $video_overlay_image != ' ') { 
	$overlay_image = wp_get_attachment_image_src( $video_overlay_image, 'full');
}

if($css_animation != ""){
	$clsss_css_animation =  "  " . $css_animation;
} else {
	$clsss_css_animation =  "";
}
$delay = "";
if($transition_delay != ""){
	$delay = " style='transition-delay:" . $transition_delay . "s'";
}
$anchor_id = "";
if($anchor != ""){
	$anchor_id = ' data-q_id="#'.$anchor.'"';
}

$menu_title = "";
if($content_menu_title != ""){
	$menu_title = ' data-q_title="'.$content_menu_title.'"';
}

$menu_icon = "";
if($content_menu_icon != ""){
	$menu_icon = ' data-q_icon="'.$content_menu_icon.'"';
}

$use_row_as_box_class="";
if($use_as_box == 'use_row_as_box'){
	$use_row_as_box_class = ' use_row_as_box';
}

$row_id = '';
if($el_id !== '') {
    $row_id = 'id="'.esc_attr($el_id).'"';
}

$style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );
if($row_type == 'row') {
	$output .= '<div '.$row_id.' '.$style.' '.$anchor_id.' '.$menu_title.' '.$menu_icon.' class="' . $css_class . $css_class_type . $css_class_in_content_menu . $css_class_video . $use_row_as_box_class . '"';
	if($background_color != "" || $border_color != "" || $padding_top != "" || $padding_bottom != "" || $text_align != "" || $_image != ""){
			$output .= " style='";
				if($background_color != ""){
					$output .="background-color:".$background_color.";";
				}
				if($_image != ""){
					$output .="background-image:url(".$_image[0].");";
				}
				if($border_color != ""){
					if($use_as_box == 'use_row_as_box') {
						$output .=" border: 1px solid ".$border_color.";";
					}else {
						$output .=" border-bottom: 1px solid ".$border_color.";";
					}
				}
				if($padding_top != ""){
					$output .=" padding-top:".$padding_top."px;";
				}
				if($padding_bottom != ""){
					$output .=" padding-bottom:".$padding_bottom."px;";
				}
				$output .= ' text-align:' . $text_align . ';';
				$output.="'";
		}
	$output.=">";
	if($video == "show_video"){
		$v_image = wp_get_attachment_url($video_image);
		$v_overlay_image = wp_get_attachment_url($video_overlay_image);
		
		$output .= '<div class="mobile-video-image" style="background-image: url('.$v_image.')"></div><div class="video-overlay';
								if($video_overlay == "show_video_overlay"){
									$output .= ' active';
								}
								$output .= '"';
								$output .= ($overlay_image !== '' && $overlay_image !== ' ') ? " style='background-image:url(" . $overlay_image[0] . ");'" : '';
								$output .= '></div><div class="video-wrap">
									
									<video class="video" width="1920" height="800" poster="'.$v_image.'" controls="controls" preload="auto" loop autoplay muted>';
											if(!empty($video_webm)) { $output .= '<source type="video/webm" src="'.$video_webm.'">'; }
											if(!empty($video_mp4)) { $output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
											if(!empty($video_ogv)) { $output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
										 $output .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
													<param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
													<param name="flashvars" value="controls=true&file='.$video_mp4.'" />
													<img src="'.$v_image.'" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
											</object>
									</video>		
							</div>';
	}
	$output .= '<div class="' . $css_class_type_inner . ' clearfix"';
	if($padding != ""){
			$output .= " style='padding: 0% ".$padding."%'";
		}
	$output .= '>';
	if($type == "grid"){
		$output .= "<div class='section_inner_margin clearfix'>";
	}
	if($row_type == "row" && $css_animation != ""){
		$output .= '<div class="'. $clsss_css_animation .'"><div'. $delay .'>';
	}
}else if($row_type == 'parallax'){
	$output .='<section '.$row_id.' '.$anchor_id.' '.$menu_title.' '.$menu_icon.' class="parallax_section_holder '.$css_class_in_content_menu.'" style = "';
	$output .= ($background_image !== '' || $background_image !== ' ') ? " background-image:url('" . $_image[0] . "');" : '';
	$output .= '"';
	$output .= ($section_height !='' || $section_height!=' ') ? ' data-height="' . $section_height . '"' : '';
	$output .= '>';
	$output .='<div class="parallax_content ' . $text_align . '">';
	$output .= "<div class='parallax_section_inner_margin clearfix'>";

}else if($row_type == 'expandable') {
	$output .= '<div '.$row_id.' '.$anchor_id.' '.$menu_title.' '.$menu_icon.' class="' . $css_class . $css_class_in_content_menu .'"';
	if($text_align != ""){
			$output .= " style='";
				$output .= ' text-align:' . $text_align . ';';
				$output.="'";
		}
	$output.=">";
	$output .= '<div class="more_facts_holder"><div class="more_facts_outer"><div class="more_facts_inner">';

} else if($row_type == 'content_menu'){
    $output .= '<nav '.$row_id.' class="content_menu"';
    if($background_color != ""){
        $output .= " style='background-color:".$background_color.";'";
    }
    $output .= '>';
    $output .= "<div class='nav_select_menu clearfix'><div class='nav_select_button'><i class='fa fa-bars'></i></div></div>";
}
if($row_type != 'content_menu'){
	$output .= wpb_js_remove_wpautop($content);
}
if($row_type == 'row') {
	if($css_animation != "") { 
		$output .= '</div></div>';
	}
	if($type == "grid"){
		$output .= "</div>";
	}
		$output .= '</div>';


	$output .= '</div>'.$this->endBlockComment('row');
}elseif($row_type == 'parallax'){
	$output .= '</div>';
	$output .= '</div></section>'.$this->endBlockComment('row');
	
}elseif($row_type == 'expandable'){
	$output .= '</div></div><div class="more_facts_button_holder ' . $button_position . '">';
	$output .= '<span class="qbutton more_facts_button" data-morefacts="'. $more_button_label .'" data-lessfacts="'. $less_button_label . '"';
	if($background_color != "" || $color != "" || $border_color != ""){
		$output .= " style='";
		if($background_color != ""){
			$output .= "background-color: ".$background_color.";";
		}
		if($color != ""){
			$output .= " color: ".$color.";";
		}
		if($border_color != ""){
			$output .= " border-color: ".$border_color.";";
		}
		$output .= "'";
	}
	
	$output .='>'. $more_button_label .'</span>';
	$output .= '</div></div>';
	$output .= '</div>'.$this->endBlockComment('row');
}else if($row_type == 'content_menu'){
	$output .= '</nav>';
}
echo $output;