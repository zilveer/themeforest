<?php
if(!function_exists('theme_shortcode_dropcaps')){
function theme_shortcode_dropcaps($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
	), $atts));

	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '">' . do_shortcode($content) . '</span>';
}
}
add_shortcode('dropcap1', 'theme_shortcode_dropcaps');
add_shortcode('dropcap2', 'theme_shortcode_dropcaps');
add_shortcode('dropcap3', 'theme_shortcode_dropcaps');
add_shortcode('dropcap4', 'theme_shortcode_dropcaps');


if(!function_exists('theme_shortcode_dropcap')){
function theme_shortcode_dropcap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
		'style' => 'dropcap1',
	), $atts));

	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $style.$color . '">' . do_shortcode($content) . '</span>';
}
}
add_shortcode('dropcap', 'theme_shortcode_dropcap');

if(!function_exists('theme_shortcode_blockquote')){
function theme_shortcode_blockquote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
		'cite' => false,
		'class' => '',
	), $atts));

	if($class){
		$class = $class.' ';
	}
	if($align){
		$class .= 'align'.$align;
	}

	return '<blockquote class="' .$class. '">' . do_shortcode($content) . ($cite ? '<p><cite>- ' . $cite . '</cite></p>' : '') . '</blockquote>';
}
}
add_shortcode('blockquote', 'theme_shortcode_blockquote');

if(!function_exists('theme_shortcode_highlight')){
function theme_shortcode_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => false,
	), $atts));

	return '<span class="highlight'.(($type)?' '.$type:'').'">'.do_shortcode($content).'</span>';
}
}
add_shortcode('highlight', 'theme_shortcode_highlight');

if(!function_exists('theme_shortcode_progress')){
function theme_shortcode_progress($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => '', //default, radius, round
		'size' => '',// default, small, large
		'barcolor' => '',
		'trackcolor' => '',
		'textcolor' => '',
		'percent' => '0',
		'text' => 'true',
		'class' => '',
	), $atts));

	if($type){
		$type = ' progress_'.$type;
	}
	if($size){
		$size = ' progress_'.$size;
	}
	if($barcolor){
		$barcolor = 'background-color:'.$barcolor.';';
	}
	if($textcolor){
		$textcolor = 'color:'.$textcolor;
	}
	if($trackcolor){
		$trackcolor = ' style="background-color:'.$trackcolor.'"';
	}
	if($text === 'true'){
		$text = $percent.'%';
	}else{
		$text = '';
	}
	if($class){
		$class = ' '.$class;
	}
	
	return '<div class="progress'.$type.$size.$class.'" data-meter="'.$percent.'"'.$trackcolor.'><span class="progress-meter" style="'.$barcolor.$textcolor.'">'.$text.'</span></div>';
}
}
add_shortcode('progress', 'theme_shortcode_progress');

if(!function_exists('theme_shortcode_pie_progress')){
function theme_shortcode_pie_progress($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'size' => '',// default, small, large
		'percent' => '0',
		'label' => 'percent', // percent, text, icon
		'text' => '',
		'icon' => '',
		'labelcolor' => '',
		'trackcolor' => '',
		'barcolor' => '',
		'class' => '',
	), $atts));

	if($size){
		$size = ' pie_progress_'.$size;
	}

	if($labelcolor){
		$labelcolor = ' style="color:'.$labelcolor.'"';
	}

	switch ($label) {
		case 'icon':
			$label_html = '<i class="pie_progress_icon icon-'.$icon.'"'.$labelcolor.'></i>';
			break;
		case 'text':
			$label_html = '<div class="pie_progress_text"'.$labelcolor.'>'.$text.'</div>';
			break;
		case 'percent':
			$label_html = '<span'.$labelcolor.'>'.$percent.'%'.'</span>';
			break;
		default:
			$label_html = '';
	}

	if($trackcolor) {
		$trackcolor = ' data-trackcolor="'.$trackcolor.'"';
	}
	if($barcolor) {
		$barcolor = ' data-barcolor="'.$barcolor.'"';
	}
	if($class){
		$class = ' '.$class;
	}

	return '<div class="pie_progress_wrap'.$size.$class.'"'.$trackcolor.$barcolor.'><div class="pie_progress" data-percent="'.$percent.'">'.$label_html.'</div></div>';
}
}
add_shortcode('pie_progress', 'theme_shortcode_pie_progress');

if(!function_exists('theme_shortcode_list')){
function theme_shortcode_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => '',
		'color' => '',
		'icon'  => '',
		'position' => 'inside',
		'class' => '',
	), $atts));

	if($icon){
		$style = '';
		$icon = 'list_'.$icon;
	}
	if($color){
		$color = ' list_color_'.$color;
	}
	if($position === 'outside'){
		$position = ' list_outside';
	} else {
		$position = '';
	}
	if($class){
		$class = ' '.$class;
	}

	return str_replace('<ul>', '<ul class="'.$style.$icon.$color.$position.$class.'">', do_shortcode(trim($content)));
}
}
add_shortcode('list', 'theme_shortcode_list');

if(!function_exists('theme_shortcode_icon')){
function theme_shortcode_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => false,
		'color' => '',
		'class' => '',
	), $atts));
	
	if($color){
		$color = ' '.$color;
	}
	if($class){
		$class = ' '.$class;
	}

	return '<span class="icon_text icon_'.$style.$color.$class.'">'.do_shortcode($content).'</span>';
}
}
add_shortcode('icon', 'theme_shortcode_icon');

if(!function_exists('theme_shortcode_icon_link')){
function theme_shortcode_icon_link($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => false,
		'href' => '#',
		'color' => '',
		'target' => false,
		'class' => '',
	), $atts));
	
	if($color){
		$color = ' '.$color;
	}
	$target = $target?' target="'.$target.'"':'';
	
	if(preg_match("|^mailto:\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$|i", $href)){
		$href = str_replace('@','*',$href);
		$content = str_replace('@','*',$content);
	}
	
	if($class){
		$class = ' '.$class;
	}

	return '<a class="icon_text icon_'.$style.$color.$class.'" href="'.$href.'"'.$target.'>'.do_shortcode($content).'</a>';
}
}
add_shortcode('icon_link', 'theme_shortcode_icon_link');

if(!function_exists('theme_shortcode_icon_font')){
function theme_shortcode_icon_font($atts){
	extract(shortcode_atts(array(
		'type' => false,
		'link' => '',
		'linktarget' => '',
		'size' => false,// large, 2x, 3x, 4x
		'color' => '',
		'pull' => false,//left,right
		'borderradius'=> 'rounded',// square, circle, rounded
		'border' => false,
		'padding' => '',
		'bgcolor' => '',
		'bordercolor'=> '',
		'hovercolor' => '',
		'hoverbgcolor' => '',
		'hoverbordercolor'=> '',
		'spin'  => false,
		'rotate' => false, // 90, 180, 270, horizontal, vertical,
		'class' => '',
	), $atts));

	$classes = array();

	$styles = array();
	if($color){
		$styles[] = 'color:'.$color;
	}
	if($bgcolor){
		$styles[] = 'background-color:'.$bgcolor;
	}
	if($border && $bordercolor){
		$styles[] = 'border-color:'.$bordercolor;
	}
	if($padding){
		$styles[] = 'padding:'.$padding.'em';
	}
	if($type){
		$classes[] = 'icon-'.$type;
	}
	if($size){
		$classes[] = 'icon-'.$size;
	}
	if($pull){
		$classes[] = 'pull-'.$pull;
	}
	if($border == 'true'){
		$classes[] = 'icon-border';
		$classes[] = 'icon-border-'.$borderradius;
	}
	if($spin == 'true'){
		$classes[] = 'icon-spin';
	}
	if($spin == 'pulse'){
		$classes[] = 'icon-pulse';
	}	
	if($rotate){
		if(is_numeric($rotate)){
			$classes[] = 'icon-rotate-'.$rotate;
		} else {
			$classes[] = 'icon-flip-'.$rotate;
		}
	}
	if($class){
		$classes[] = $class;
	}

	if(!empty($styles)){
		$icon_styles = ' style="'.implode(';', $styles).'"';
	} else {
		$icon_styles = "";
	}
	$link = $link?' href="'.$link.'"':'';
	$linktarget = $linktarget?' target="'.$linktarget.'"':'';

	if($hovercolor || $hoverbgcolor || $hoverbordercolor) {
		$id = rand(10, 1000);
		$hover_styles = array();
		if($hovercolor){
			$hover_styles[] = 'color:'.$hovercolor.' !important;';
		}
		if($hoverbgcolor){
			$hover_styles[] = 'background-color:'.$hoverbgcolor.' !important;';
		}
		if($border && $hoverbordercolor){
			$hover_styles[] = 'border-color:'.$hoverbordercolor.' !important;';
		}
		if(!empty($hover_styles)){
			$icon_hover_styles = implode(' ', $hover_styles);
		} else {
			$icon_hover_styles = "";
		}
		if($link) {
			$return_html = '<a id="iconfont_'.$id.'" class="iconfont '.implode(' ', $classes).'"'.$icon_styles.$link.$linktarget.'></a>';
		} else {
			$return_html = '<i id="iconfont_'.$id.'" class="iconfont '.implode(' ', $classes).'"'.$icon_styles.'></i>';
		}

		return <<<HTML
{$return_html}
<style>
#iconfont_{$id}:hover {
	{$icon_hover_styles}	
}
</style>
HTML;
	} else {
		if($link) {
			return '<a class="iconfont '.implode(' ', $classes).'"'.$icon_styles.$link.$linktarget.'></a>';
		} else {
			return '<i class="iconfont '.implode(' ', $classes).'"'.$icon_styles.'></i>';
		}
	}
}
}
add_shortcode('icon_font', 'theme_shortcode_icon_font');

global $theme_code_token;
$theme_code_token = md5(uniqid(rand()));
$theme_code_matches = array();
if(!function_exists('theme_code_before_filter')){
function theme_code_before_filter($content) {
	return preg_replace_callback("/\[(pre|code)\b(.*?)(?:(\/))?\](?:(.*?)\[\/\\1\])?/s", "theme_code_before_filter_callback", $content);
}
}

if(!function_exists('theme_code_before_filter_callback')){
function theme_code_before_filter_callback(&$match) {
	global $theme_code_token, $theme_code_matches;
	$i = count($theme_code_matches);
	
	$theme_code_matches[$i] = $match;
	return "\n\n<p>" . $theme_code_token . sprintf("%03d", $i) . "</p>\n\n";
}
}

if(!function_exists('theme_code_after_filter')){
function theme_code_after_filter($content) {
	global $theme_code_token;
	
	$content = preg_replace_callback("/<p>\s*" . $theme_code_token . "(\d{3})\s*<\/p>/si", "theme_code_after_filter_callback", $content);
	
	return $content;
}
}

if(!function_exists('theme_code_after_filter_callback')){
function theme_code_after_filter_callback($match) {
	global $theme_code_matches;
	$i = intval($match[1]);
	$content = $theme_code_matches[$i];
	$content[4]=trim($content[4]);
	
	if (version_compare(PHP_VERSION, '5.2.3') >= 0) {
		$output = htmlspecialchars($content[4], ENT_NOQUOTES, get_bloginfo('charset'), false);
	} else {
		$specialChars = array('&' => '&amp;', '<' => '&lt;', '>' => '&gt;');
		
		$output = strtr(htmlspecialchars_decode($content[4]), $specialChars);
	}
	return '<' . $content[1] . ' class="'. apply_filters( 'theme_css_class', $content[1] ) .'">' . $output . '</' . $content[1] . '>';
}
}

add_filter('the_content', 'theme_code_before_filter', 0);
add_filter('the_content', 'theme_code_after_filter', 999);
add_filter('widget_text', 'theme_code_before_filter', 0);
add_filter('widget_text', 'theme_code_after_filter', 999);

if(!function_exists('theme_shortcode_responsive_text')){
function theme_shortcode_responsive_text($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'compression' => '10',
		'max' => '',
		'min' => '',
		'lineheight' => '1',
		'fontsize' => '',
		'class' => '',
	), $atts));

	$data_compression = '';
	if(is_numeric($compression)){
		$data_compression = ' data-compression="'.$compression.'"';
	}

	$data_max = '';
	if(!empty($max) && is_numeric($max)){
		$data_max = ' data-max="'.$max.'"';
	}

	$data_min = '';
	if(!empty($min) && is_numeric($min)){
		$data_min = ' data-min="'.$min.'"';
	}
	$styles = array();
	if(!empty($lineheight) && is_numeric($lineheight)){
		$styles[] = 'line-height:'.$lineheight.'em';
	}
	if(!empty($fontsize) && is_numeric($fontsize)){
		$styles[] = 'font-size:'.$fontsize.'px';
	}

	if($class){
		$class = ' '.$class;
	}

	return '<p class="responsive_text'.$class.'"'.$data_compression.$data_max.$data_min.' style="'.implode(';', $styles).'">'.do_shortcode($content).'</p>';
}
}
add_shortcode('responsive_text', 'theme_shortcode_responsive_text');

if(!function_exists('theme_shortcode_milestone')){
function theme_shortcode_milestone($atts) {
	extract(shortcode_atts(array(
		'numberfrom' => '0',
		'number' => '',
		'subject' => '',
		'icon' => false,
		'subjectcolor'=> false,
		'iconcolor' => false,
		'numbercolor' => '',
		'speed' => '1500',
		'size' => '', // default, small, large,
		'class' => '',
		'separator' => '',
		'decimals' => '0',
	), $atts));

	if($class){
		$class = ' '.$class;
	}

	if($icon) {
		if($iconcolor){
			$icon_color_style = ' style="color:'.$iconcolor.'"';
		} else {
			$icon_color_style = '';
		}
		$icon = '<i class="icon-'.$icon.'"'.$icon_color_style.'></i>';
		$icon_class = ' milestone_icon';
	}else {
		$icon = '';
		$icon_class = '';
	}
	if($numbercolor){
		$number_color_style = ' style="color:'.$numbercolor.'"';
	} else {
		$number_color_style = '';
	}
	if($subjectcolor){
		$subject_color_style = ' style="color:'.$subjectcolor.'"';
	} else {
		$subject_color_style = '';
	}
	if($size){
		$size_class = ' milestone_'.$size;
	} else {
		$size_class = '';
	}
	if(!is_numeric($speed)){
		$speed = '1500';
	}
	
	return '<div class="milestone'.$icon_class.$size_class.$class.'">'.$icon.'<div class="milestone_number"'.$number_color_style.' data-separator="'.$separator.'" data-decimals="'.$decimals.'" data-speed="'.$speed.'" data-from="'.$numberfrom.'" data-to="'.$number.'">'.$numberfrom.'</div><div class="milestone_subject"'.$subject_color_style.'>'.$subject.'</div></div>';
}
}
add_shortcode('milestone', 'theme_shortcode_milestone');

if(!function_exists('theme_shortcode_serverinfo')){
function theme_shortcode_serverinfo($atts, $content=null){
	ob_start();
	phpinfo();
	$serverinfo = ob_get_clean();
	return $serverinfo;
}
}
add_shortcode('serverinfo', 'theme_shortcode_serverinfo');