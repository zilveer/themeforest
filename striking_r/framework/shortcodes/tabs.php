<?php
if(!function_exists('theme_shortcode_tabs')){
function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'history' => false,
		'initialtab' => 1,
		'class' => '',
	), $atts));
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		if($class){
			$class = ' '.$class;
		}

		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = theme_shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '<ul class="'.apply_filters( 'theme_css_class', $code ).'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			if($history=='true'){
				if(isset($matches[3][$i]['anchor'])){
					$href= '#'.rawurlencode(theme_unaccent($matches[3][$i]['anchor']));
				} else {
					$href= '#'.rawurlencode(theme_unaccent(str_replace(" ", "_", trim($matches[3][$i]['title']))));
				}
			}else{
				$href = '#';
			}
			if(isset($matches[3][$i]['icon'])){
				if(isset($matches[3][$i]['icon_color'])){
					$icon_color_style = ' style="color:'.$matches[3][$i]['icon_color'].'"';
				} else {
					$icon_color_style = '';
				}
				$icon = '<i class="icon-'.$matches[3][$i]['icon'].'"'.$icon_color_style.'></i>';
			} else {
				$icon = '';
			}
			$output .= '<li><a href="'.$href.'">' .$icon. $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="'.apply_filters( 'theme_css_class', 'panes' ).'">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="'.apply_filters( 'theme_css_class', 'pane' ).'">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		if($history=='true'){
			$data_history = ' data-history="true"';
		}else{
			$data_history = '';
		}
		if($initialtab!="1"){
			$initialIndex = $initialtab -1;
			$data_initialIndex = ' data-initialIndex="'.$initialIndex.'"';
		}else{
			$data_initialIndex = '';
		}
		
		return '<div class="'.$code.'_container'.$class.'"'.$data_history.$data_initialIndex.'>' . $output . '</div>';
	}
}
}
add_shortcode('tabs', 'theme_shortcode_tabs');
add_shortcode('mini_tabs', 'theme_shortcode_tabs');
add_shortcode('vertical_tabs', 'theme_shortcode_tabs');

if(!function_exists('theme_shortcode_accordions')){
function theme_shortcode_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'initialaccordion' => 1,
		'class' => ''
	), $atts));

		// compatible code
	if(isset($atts['initialtab']) && !isset($atts['initialaccordion'])){
		$initialaccordion = $atts['initialtab'];
	}
	// end compatible
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		if($class){
			$class = ' '.$class;
		}

		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = theme_shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			
			if(isset($matches[3][$i]['icon'])){
				if(isset($matches[3][$i]['icon_color'])){
					$icon_color_style = ' style="color:'.$matches[3][$i]['icon_color'].'"';
				} else {
					$icon_color_style = '';
				}
				$icon = '<i class="icon-'.$matches[3][$i]['icon'].'"'.$icon_color_style.'></i>';
			} else {
				$icon = '';
			}
			$output .= '<div class="'.apply_filters( 'theme_css_class', 'tab' ).'"><a href="#">' .$icon. $matches[3][$i]['title'] . '</a></div>';
			$output .= '<div class="'.apply_filters( 'theme_css_class', 'pane' ).'">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		if((int)$initialaccordion > 1){
			$initialIndex = $initialaccordion-1;
			$data_initialIndex = ' data-initialIndex="'.$initialIndex.'"';
		}elseif($initialaccordion == 0){
			$data_initialIndex = ' data-initialIndex="0"';
		}else{
			$data_initialIndex = '';
		}
		
		return '<div class="'.apply_filters( 'theme_css_class', 'accordion' ).$class.'"'.$data_initialIndex.'>' . $output . '</div>';
	}
}
}
add_shortcode('accordions', 'theme_shortcode_accordions');

if(!function_exists('theme_shortcode_toggle')){
function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false,
		'open' => false,
		'iconcolor' => '',
		'titlesize' => '',
		'iconsize' => '',
		'align' => '', // left, right,
		'class' => '',
	), $atts));

	if($open){
		$state = ' toggle_active';
		$display = ' style="display:block;"';
	}else{
		$state = '';
		$display = '';
	}
	$icon_styles = array();
	if($iconcolor){
		$icon_styles[] = 'opacity:1;color:'.$iconcolor;
	} 
	if($iconsize){
		$icon_styles[] = 'font-size:'.$iconsize.'px';
	}
	if(!empty($icon_styles)) {
		$icon_style = ' style="'.implode(';', $icon_styles).'"';
	} else {
		$icon_style = '';
	}
	if($titlesize){
		$title_size_style = ' style="font-size:'.$titlesize.'px"';
	}else{
		$title_size_style = '';
	}
	
	if($align){
		$align = ' toggle_'.$align;
	}
	if($class){
		$class = ' '.$class;
	}
	
	return '<div class="toggle'.$align.$state.$class.'"><h4 class="toggle_title"'.$title_size_style.'><i class="toggle_icon"'.$icon_style.'></i>' . $title . '</h4><div class="toggle_content"'.$display.'>' . do_shortcode(trim($content)) . '</div></div>';
}
}
add_shortcode('toggle', 'theme_shortcode_toggle');

if(!function_exists('theme_unaccent')){
function theme_unaccent($string) {
    if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false) {
        $string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
    }

    return $string;
}
}