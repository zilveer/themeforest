<?php
$output = $title = $title_align = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "qode"),
    'border_color' => '',
    'title_color' => '',
    'background_color' => '',
    'el_class' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_text_separator wpb_content_element full '.$title_align.$el_class, $this->settings['base']);
$output .= '<div class="'.esc_attr($css_class).'"><div class="separator_wrapper"';
	if($background_color != ""){
		$output .= " style='";
			if($background_color != ""){
				$output .= "background-color:".$background_color.";";
			}
		$output.="'";
	}
$output .= '>';
$output .= '<div class="separator_content"';
	if($background_color != "" || $border_color != "" || $title_color != ""){
		$output .= " style='";
			if($background_color != ""){
				$output .="background-color:".$background_color.";";
			}
			if($border_color != ""){
				$output .=" border-color:".$border_color.";";
			}
			if($title_color != ""){
				$output .=" color:".$title_color.";";
			}
		$output.="'";
	}
$output .= '>';

$output .= '<span>' . $title . '</span>';

$output .='</div></div><div class="separator_line"';
	if($border_color != ""){
		$output .= " style='";
			if($border_color != ""){
				$output .= "background-color:".$border_color.";";
			}
		$output.="'";
	}
$output .='></div></div>'.$this->endBlockComment('separator')."\n";

print $output;