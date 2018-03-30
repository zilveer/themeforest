<?php
if(!function_exists('theme_shortcode_column')){
function theme_shortcode_column($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
}
if(!function_exists('theme_shortcode_column_last')){
function theme_shortcode_column_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clearboth"></div>';
}
}

add_shortcode('one_half', 'theme_shortcode_column');
add_shortcode('one_third', 'theme_shortcode_column');
add_shortcode('one_fourth', 'theme_shortcode_column');
add_shortcode('one_fifth', 'theme_shortcode_column');
add_shortcode('one_sixth', 'theme_shortcode_column');

add_shortcode('two_third', 'theme_shortcode_column');
add_shortcode('three_fourth', 'theme_shortcode_column');
add_shortcode('two_fifth', 'theme_shortcode_column');
add_shortcode('three_fifth', 'theme_shortcode_column');
add_shortcode('four_fifth', 'theme_shortcode_column');
add_shortcode('five_sixth', 'theme_shortcode_column');

add_shortcode('one_half_last', 'theme_shortcode_column_last');
add_shortcode('one_third_last', 'theme_shortcode_column_last');
add_shortcode('one_fourth_last', 'theme_shortcode_column_last');
add_shortcode('one_fifth_last', 'theme_shortcode_column_last');
add_shortcode('one_sixth_last', 'theme_shortcode_column_last');

add_shortcode('two_third_last', 'theme_shortcode_column_last');
add_shortcode('three_fourth_last', 'theme_shortcode_column_last');
add_shortcode('two_fifth_last', 'theme_shortcode_column_last');
add_shortcode('three_fifth_last', 'theme_shortcode_column_last');
add_shortcode('four_fifth_last', 'theme_shortcode_column_last');
add_shortcode('five_sixth_last', 'theme_shortcode_column_last');