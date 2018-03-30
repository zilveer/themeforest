<?php
//home box container
function theme_home_box_container($atts, $content)
{
	return '<ul class="home_box_container clearfix">' . shortcode_unautop(do_shortcode($content)) . '</ul>';
}
add_shortcode("home_box_container", "theme_home_box_container");

//home box
function theme_home_box($atts, $content)
{
	extract(shortcode_atts(array(
		"color" => "white"
	), $atts));
	
	$output = '<li class="home_box ' . $color . '">' . shortcode_unautop(do_shortcode($content)) . '</li>';
	return $output;
}
add_shortcode("home_box", "theme_home_box");

//news
function theme_news($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "note"
	), $atts));
	
	$output = '<div class="news clearfix">';
	if($icon!="" && $icon!="none")
		$output .= '<span class="banner_icon ' . $icon . '"></span>';
	$output .= '<div class="text">' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode("news", "theme_news");
?>
