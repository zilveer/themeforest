<?php

$output = $title = $interval = $el_class = $style = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'style' => 'horizontal',
    'tab_type_default' => 'default',
	'tab_type_icons' => 'default',
	'border_type_default' => 'border_arround_element',
	'border_type_icons' => 'border_arround_element',
	'tab_border_radius' => '',
	'margin_between_tabs' => 'enable_margin',
	'icons_margin_between_tabs' => 'enable_margin',
    'space_between_tab_and_content' => ''
                ), $atts));

wp_enqueue_script('jquery-ui-tabs');


$title = esc_html($title);
$el_class = esc_attr($el_class);
$space_between_tab_and_content = esc_attr($space_between_tab_and_content);

$el_class = $this->getExtraClass($el_class);

$data_attr = '';

if($tab_border_radius != ""){
	$data_attr .= "data-tab-border-radius='" . $tab_border_radius. "'";
}

$element = 'wpb_tabs';
if ('vc_tour' == $this->shortcode)
    $element = 'wpb_tour';

// Extract tab titles
preg_match_all('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\")/i', $content, $matches, PREG_OFFSET_CAPTURE);
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if (isset($matches[0])) {
    $tab_titles = $matches[0];
}
$tabs_nav = '';
$tabs_nav .= '<ul class="tabs-nav">';

if (strpos($style, 'icons') !== false) {
    /* if($tab_type == 'boxed'){
      $tabs_nav .= "\n\t\t".'<div class="q_tabs_icon_horizontal_border"></div>';
      } */

    foreach ($tab_titles as $tab) {
        preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\")/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);

        $tabs_nav .= '<li><a href="#tab-' . (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title($tab_matches[1][0])) . '"><span class="icon_frame"></span></a></li>';
    }
} else {
    foreach ($tab_titles as $tab) {
        preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\")/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
        if (isset($tab_matches[1][0])) {
            $tabs_nav .= '<li><a href="#tab-' . (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title($tab_matches[1][0]) ) . '">' . $tab_matches[1][0] . '</a></li>';
        }
    }
}


$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element . 'tabs_holder clearfix ' . $el_class), $this->settings['base']);

switch ($style) {
	case 'horizontal':
        $style_class = 'horizontal tab_with_text center';
        break;
	case 'horizontal_with_icons':
        $style_class = 'horizontal tab_with_icon center';
        break;
	case 'horizontal_left':
        $style_class = 'horizontal tab_with_text left';
        break;
	case 'horizontal_left_with_icons':
        $style_class = 'horizontal tab_with_icon left';
        break;
	case 'horizontal_right':
        $style_class = 'horizontal tab_with_text right';
        break;
	case 'horizontal_right_with_icons':
        $style_class = 'horizontal tab_with_icon right';
        break;
    case 'vertical_left':
        $style_class = 'vertical tab_with_text left ';
        break;
	case 'vertical_left_with_icons':
        $style_class = 'vertical left tab_with_icon';
        break; 
    case 'vertical_right':
        $style_class = 'vertical tab_with_text right';
        break;
	case 'vertical_right_with_icons':
        $style_class = 'vertical right tab_with_icon';
        break; 
}

if($style == 'horizontal' || $style == 'horizontal_left' || $style == 'horizontal_right' || $style == 'vertical_left' || $style == 'vertical_right' ){	
	if($tab_type_default == "with_borders"){
		$style_class .= ' with_borders';
		
		if($border_type_default == "border_arround_element"){
			$style_class .= " border_arround_element";
			
			if($margin_between_tabs == "enable_margin"){
				$style_class .= " enable_margin";
			}

			if($margin_between_tabs == "disable_margin"){
				$style_class .= " disable_margin";
			}
		}		
		if($border_type_default == "border_arround_active_tab"){
			$style_class .= " border_arround_active_tab";
		}
	}else{
		$style_class .= ' default';
	}	
}

if($style == 'horizontal_with_icons' || $style == 'horizontal_left_with_icons' || $style == 'horizontal_right_with_icons' || $style == 'vertical_left_with_icons' || $style == 'vertical_right_with_icons' ){
	switch($tab_type_icons){
		case 'with_borders' :
			$style_class .= " with_borders";
		break;
		case 'with_lines' :
			$style_class .= " with_lines";
		break;
		default:
			$style_class .= " default";
	}
	
	if($tab_type_icons == "with_borders"){
		if($border_type_icons == "border_arround_element"){
			$style_class .= " border_arround_element";
			
			if($icons_margin_between_tabs == "enable_margin"){
				$style_class .= " enable_margin";
			}

			if($icons_margin_between_tabs == "disable_margin"){
				$style_class .= " disable_margin";
			}
		}
		if($border_type_icons == "border_arround_active_tab"){
			$style_class .= " border_arround_active_tab";
		}
	}
}

$tabs_container_style = '';
if($space_between_tab_and_content != '' && (strpos($style, 'vertical') == false)){
    $space_between_tab_and_content = (strstr($space_between_tab_and_content, 'px', true)) ? $space_between_tab_and_content : $space_between_tab_and_content . "px";
    $tabs_container_style = 'style ="padding-top: '.$space_between_tab_and_content.';"';
}

$output .= "\n\t" . '<div class="' . $css_class . '" data-interval="' . $interval . '">';
$output .= "\n\t\t" . '<div class="q_tabs ' . $style_class . '" '.$data_attr.'>';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element . '_heading'));
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "<div class='tabs-container' $tabs_container_style>";
$output .= "\n\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "</div>";
if ('vc_tour' == $this->shortcode) {
    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __('Previous slide', 'js_composer') . '">' . __('Previous slide', 'js_composer') . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __('Next slide', 'js_composer') . '">' . __('Next slide', 'js_composer') . '</a></span></div>';
}
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t" . '</div> ' . $this->endBlockComment($element);

print $output;
