<?php
$output = $el_class = $css = $el_id = '';;
extract(shortcode_atts(array(
	'el_class' => '',
	'row_type' => 'row',
	'use_as_box' => '',
	'use_row_as_full_screen_section' => '',
	'use_row_as_full_screen_section_slide' => '',
	'type' => 'full_width',
	'anchor' => '',
	'in_content_menu'=>'',
	'content_menu_title' => '',
	'icon_pack' => '',
	'content_menu_fa_icon' => '',
	'content_menu_fe_icon' => '',
	'video' => '',
	'video_overlay' => '',
	'video_overlay_image' => '',
	'video_webm' => '',
	'video_mp4' => '',
	'video_ogv' => '',
	'video_image' => '',
	'background_color' => '',
	'full_screen_section_height' => 'no',
	'vertically_align_content_in_middle' => 'no',
	'section_height' => '',
	'parallax_speed' => '1',
	'background_image' => '',
	'slide_background_image' => '',
	'pattern_background' => '',
	'border_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'side_padding' => '',
	'text_align' => 'left',
	'more_button_label' =>'More Facts',
	'less_button_label'=>'Less Facts',
	'button_position'=>'center',
	'color'=>'',
	'hover_color'=>'',
	'content_background_color' => '',
	'css_animation'=>'',
	'transition_delay'=>'',
	'css' => '',
	'el_id' => ''
), $atts));

//wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'section',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if($type == "grid"){
	$css_class_type =  " grid_section";
} else {
	$css_class_type =  "";
}

if($type == "grid"){
	$css_class_type_inner =  " section_inner";
} else {
	$css_class_type_inner =  " full_section_inner";
}

$css_class_pattern =  "";
if($pattern_background == "pattern_background"){
	$css_class_pattern = " pattern_background";
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

$_slide_image = "";
if($slide_background_image != '' || $slide_background_image != ' ') {
	$_slide_image = wp_get_attachment_image_src( $slide_background_image, 'full');
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
	$delay = " style='transition-delay:" . $transition_delay . "ms; -webkit-animation-delay:" . $transition_delay . "ms; animation-delay:" . $transition_delay . "ms;'";
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
if($icon_pack == 'font_awesome' && $content_menu_fa_icon != ""){
	$menu_icon = ' data-q_icon="fa '.$content_menu_fa_icon.'"';
}

if($icon_pack == 'font_elegant' && $content_menu_fe_icon != ""){
	$menu_icon = ' data-q_icon="'.$content_menu_fe_icon.'"';
}

if($icon_pack == 'linear_icoons' && $content_menu_linear_icon != ""){
	$menu_icon = ' data-q_icon="lnr '.$content_menu_linear_icon.'"';
}


$use_row_as_box_class="";
if($use_as_box == 'use_row_as_box'){
	$use_row_as_box_class = ' use_row_as_box';
}

$full_screen_section_class = "";
if($use_row_as_full_screen_section == "yes"){
	$full_screen_section_class = " full_screen_section";
}

$row_id = '';
if($el_id !== '') {
	$row_id = 'id="'.esc_attr($el_id).'"';
}

if($row_type == 'row') {
	$output .= '<div '.$row_id.' '.$anchor_id.' '.$menu_title.' '.$menu_icon.' class="' . $css_class . $css_class_type . $css_class_in_content_menu . $css_class_video . $use_row_as_box_class . $css_class_pattern . $full_screen_section_class .'"';
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

		if($use_row_as_full_screen_section == "yes"){
			$output .= '<div class="video-overlay';
			if($video_overlay == "show_video_overlay"){
				$output .= ' active';
			}
			$output .= '"';
			$output .= ($overlay_image !== '' && $overlay_image !== ' ') ? " style='background-image:url(" . $overlay_image[0] . ");'" : '';
			$output .= '></div>';
			$output .= '<video class="full_screen_sections_video" width="1920" height="800" poster="'.$v_image.'" controls="controls" preload="auto" loop autoplay muted>';
			if(!empty($video_webm)) { $output .= '<source type="video/webm" src="'.$video_webm.'">'; }
			if(!empty($video_mp4)) { $output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
			if(!empty($video_ogv)) { $output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
			$output .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
										<param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
										<param name="flashvars" value="controls=true&file='.$video_mp4.'" />
										<img src="'.$v_image.'" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
								</object>
						</video>';
		} else {
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
	}
	$output .= '<div class="' . $css_class_type_inner . ' clearfix"';

	if($side_padding != ""){
		$side_padding_styles = array();

		$side_padding_styles[] = 'padding-left: '.$side_padding.'px';
		$side_padding_styles[] = 'padding-right: '.$side_padding.'px';
		$output .= " style='".implode(';', $side_padding_styles)."'";
	}
	$output .= '>';
	if($type == "grid"){
		$output .= "<div class='section_inner_margin clearfix'>";
	}
	if($row_type == "row" && $css_animation != ""){
		$output .= '<div class="'. $clsss_css_animation .'"><div'. $delay .'>';
	}
	if($use_row_as_full_screen_section_slide == "yes"){
		$output .= '<div class="full_screen_section_slide"';

		if($slide_background_image != "" || $background_color != ""){
			$output .= ' style="';
			if($background_color != ""){
				$output .= 'background-color:'.$background_color.';';
			}
			if($_slide_image != ""){
				$output .= "background-image:url('".$_slide_image[0]."');";
			}
			$output .= '"';
		}

		$output .= '><div class="full_screen_section_slide_intro">';
	}

}else if($row_type == 'parallax'){
	$full_screen_section_height_class = '';
	$vertically_align_content_in_middle_class = '';
	if($full_screen_section_height == 'yes'){
		$full_screen_section_height_class = 'full_screen_height_parallax';

		if($vertically_align_content_in_middle == 'yes'){
			$vertically_align_content_in_middle_class = 'vertical_middle_align';
		}
	}
	$output .='<section '.$row_id.' '.$anchor_id.' '.$menu_title.' '.$menu_icon.' data-speed="'. $parallax_speed .'" class="parallax_section_holder '.$css_class_in_content_menu.' '.$full_screen_section_height_class.' '.$vertically_align_content_in_middle_class.'" style = "';
	if($full_screen_section_height !== 'yes' ) {
		$output .= ($section_height != '' || $section_height != ' ') ? ' height:' . $section_height . 'px;' : '';
	}
	$output .= ($background_image !== '' || $background_image !== ' ') ? " background-image:url('" . $_image[0] . "');" : "";
	$output .= '"';
	$output .= '>';
	if($full_screen_section_height == 'yes' ) {
		$output .='<div class="parallax_content_outer">';
	}
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
	$output .= '<div class="more_facts_holder"';
	if($background_color != ""){
		$output .= " style='";
		if($background_color != ""){
			$output .= "background-color: ".$background_color.";";
		}
		$output .= "'";
	}
	$output .= '>';
	$output .= '<div class="more_facts_button_holder ' . esc_attr($button_position) . '">';
	$output .= '<span class="more_facts_button" data-color="'. esc_attr($color) . '" data-hovercolor="'. esc_attr($hover_color) . '" data-morefacts="'. esc_attr($more_button_label) .'" data-lessfacts="'. esc_attr($less_button_label) . '"';
	if($color != ""){
		$output .= " style='";
		if($color != ""){
			$output .= " color: ".$color.";";
		}
		$output .= "'";
	}
	$output .='><span class="more_facts_button_text">'. esc_html($more_button_label) .'</span><span class="more_facts_button_arrow"><i class="fa fa-angle-down"></i> </span></span>';
	$output .= '</div>';

	$output .= '<div class="more_facts_outer">';
	$output .= '<div class="more_facts_inner_holder"';
	$output .= '><div class="more_facts_inner">';

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
	if($use_row_as_full_screen_section_slide == "yes"){
		$output .= '</div></div>';
	}
	if($css_animation != "") {
		$output .= '</div></div>';
	}
	if($type == "grid"){
		$output .= "</div>";
	}
	$output .= '</div>';

	$output .= '</div>'.$this->endBlockComment('row');
}elseif($row_type == 'parallax'){
	$output .= "</div>";
	$output .= '</div>';
	if($full_screen_section_height == 'yes' ) {
		$output .= "</div>";
	}
	$output .= '</section>'.$this->endBlockComment('row');

}elseif($row_type == 'expandable'){
	$output .= '</div></div></div></div></div>'.$this->endBlockComment('row');
}else if($row_type == 'content_menu'){
	$output .= '</nav>';
}
print $output;