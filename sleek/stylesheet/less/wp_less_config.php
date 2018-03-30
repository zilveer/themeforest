<?php

function sleek_wp_less_config(){
$theme_settings = sleek_theme_settings();



$header_width      = $theme_settings->layout['header_width'];
$sidebar_width     = $theme_settings->layout['sidebar_width'];
$sidebar_width_big = $theme_settings->layout['sidebar_width_big'];

$color_primary      = $theme_settings->style['color']['color_primary'];
$color_white        = $theme_settings->style['color']['color_white'];
$color_grey_pale    = $theme_settings->style['color']['color_grey_pale'];
$color_grey_light   = $theme_settings->style['color']['color_grey_light'];
$color_grey_sidebar = $theme_settings->style['color']['color_grey_sidebar'];
$color_grey         = $theme_settings->style['color']['color_grey'];
$color_black        = $theme_settings->style['color']['color_black'];

$bg_header       = sleek_split_bg_setting($theme_settings->style['bg']['bg_header'],'bg');
$bg_header_size  = sleek_split_bg_setting($theme_settings->style['bg']['bg_header'],'bg_size');
$bg_content      = sleek_split_bg_setting($theme_settings->style['bg']['bg_content'],'bg');
$bg_content_size = sleek_split_bg_setting($theme_settings->style['bg']['bg_content'],'bg_size');
$bg_sidebar      = sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg');
$bg_sidebar_size = sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg_size');
$bg_masonry      = sleek_split_bg_setting($theme_settings->style['bg']['bg_masonry'],'bg');
$bg_masonry_size = sleek_split_bg_setting($theme_settings->style['bg']['bg_masonry'],'bg_size');

$typo_body_font   = $theme_settings->typo['body'][0];
$typo_body_weight = sleek_split_font_style($theme_settings->typo['body'][1],'weight');
$typo_body_style  = sleek_split_font_style($theme_settings->typo['body'][1],'style');
$typo_body_size   = $theme_settings->typo['body'][2];
$typo_body_line   = $theme_settings->typo['body'][3];

$typo_navigation_font   = $theme_settings->typo['navigation'][0];
$typo_navigation_weight = sleek_split_font_style($theme_settings->typo['navigation'][1],'weight');
$typo_navigation_style  = sleek_split_font_style($theme_settings->typo['navigation'][1],'style');
$typo_navigation_size   = $theme_settings->typo['navigation'][2];
$typo_navigation_line   = $theme_settings->typo['navigation'][3];

$typo_custom_heading_font   = $theme_settings->typo['custom_heading'][0];
$typo_custom_heading_weight = sleek_split_font_style($theme_settings->typo['custom_heading'][1],'weight');
$typo_custom_heading_style  = sleek_split_font_style($theme_settings->typo['custom_heading'][1],'style');
$typo_custom_heading_size   = $theme_settings->typo['custom_heading'][2];
$typo_custom_heading_line   = $theme_settings->typo['custom_heading'][3];

$typo_h1_font   = $theme_settings->typo['h1'][0];
$typo_h1_weight = sleek_split_font_style($theme_settings->typo['h1'][1],'weight');
$typo_h1_style  = sleek_split_font_style($theme_settings->typo['h1'][1],'style');
$typo_h1_size   = $theme_settings->typo['h1'][2];
$typo_h1_line   = $theme_settings->typo['h1'][3];

$typo_h2_font   = $theme_settings->typo['h2'][0];
$typo_h2_weight = sleek_split_font_style($theme_settings->typo['h2'][1],'weight');
$typo_h2_style  = sleek_split_font_style($theme_settings->typo['h2'][1],'style');
$typo_h2_size   = $theme_settings->typo['h2'][2];
$typo_h2_line   = $theme_settings->typo['h2'][3];

$typo_h3_font   = $theme_settings->typo['h3'][0];
$typo_h3_weight = sleek_split_font_style($theme_settings->typo['h3'][1],'weight');
$typo_h3_style  = sleek_split_font_style($theme_settings->typo['h3'][1],'style');
$typo_h3_size   = $theme_settings->typo['h3'][2];
$typo_h3_line   = $theme_settings->typo['h3'][3];

$typo_h4_font   = $theme_settings->typo['h4'][0];
$typo_h4_weight = sleek_split_font_style($theme_settings->typo['h4'][1],'weight');
$typo_h4_style  = sleek_split_font_style($theme_settings->typo['h4'][1],'style');
$typo_h4_size   = $theme_settings->typo['h4'][2];
$typo_h4_line   = $theme_settings->typo['h4'][3];

$typo_h5_font   = $theme_settings->typo['h5'][0];
$typo_h5_weight = sleek_split_font_style($theme_settings->typo['h5'][1],'weight');
$typo_h5_style  = sleek_split_font_style($theme_settings->typo['h5'][1],'style');
$typo_h5_size   = $theme_settings->typo['h5'][2];
$typo_h5_line   = $theme_settings->typo['h5'][3];

$typo_h6_font   = $theme_settings->typo['h6'][0];
$typo_h6_weight = sleek_split_font_style($theme_settings->typo['h6'][1],'weight');
$typo_h6_style  = sleek_split_font_style($theme_settings->typo['h6'][1],'style');
$typo_h6_size   = $theme_settings->typo['h6'][2];
$typo_h6_line   = $theme_settings->typo['h6'][3];



$config = array(
	'header_width'      => $header_width.'px',
	'sidebar_width'     => $sidebar_width.'px',
	'sidebar_width_big' => $sidebar_width_big.'px',

	'color_primary'      => $color_primary,
	'color_white'        => $color_white,
	'color_grey_pale'    => $color_grey_pale,
	'color_grey_light'   => $color_grey_light,
	'color_grey_sidebar' => $color_grey_sidebar,
	'color_grey'         => $color_grey,
	'color_black'        => $color_black,

	'bg_header'       => $bg_header,
	'bg_header_size'  => $bg_header_size,
	'bg_content'      => $bg_content,
	'bg_content_size' => $bg_content_size,
	'bg_sidebar'      => $bg_sidebar,
	'bg_sidebar_size' => $bg_sidebar_size,
	'bg_masonry'      => $bg_masonry,
	'bg_masonry_size' => $bg_masonry_size,

	'typo_body_font'   => '"'.$typo_body_font.'",sans-serif',
	'typo_body_weight' => $typo_body_weight,
	'typo_body_style'  => $typo_body_style,
	'typo_body_size'   => $typo_body_size.'px',
	'typo_body_line'   => $typo_body_line.'em',

	'typo_navigation_font'   => '"'.$typo_navigation_font.'",sans-serif',
	'typo_navigation_weight' => $typo_navigation_weight,
	'typo_navigation_style'  => $typo_navigation_style,
	'typo_navigation_size'   => $typo_navigation_size.'px',
	'typo_navigation_line'   => $typo_navigation_line.'em',


	'typo_custom_heading_font'   => '"'.$typo_custom_heading_font.'",sans-serif',
	'typo_custom_heading_weight' => $typo_custom_heading_weight,
	'typo_custom_heading_style'  => $typo_custom_heading_style,
	'typo_custom_heading_size'   => $typo_custom_heading_size.'px',
	'typo_custom_heading_line'   => $typo_custom_heading_line.'em',


	'typo_h1_font'   => '"'.$typo_h1_font.'",sans-serif',
	'typo_h1_weight' => $typo_h1_weight,
	'typo_h1_style'  => $typo_h1_style,
	'typo_h1_size'   => $typo_h1_size.'px',
	'typo_h1_line'   => $typo_h1_line.'em',


	'typo_h2_font'   => '"'.$typo_h2_font.'",sans-serif',
	'typo_h2_weight' => $typo_h2_weight,
	'typo_h2_style'  => $typo_h2_style,
	'typo_h2_size'   => $typo_h2_size.'px',
	'typo_h2_line'   => $typo_h2_line.'em',


	'typo_h3_font'   => '"'.$typo_h3_font.'",sans-serif',
	'typo_h3_weight' => $typo_h3_weight,
	'typo_h3_style'  => $typo_h3_style,
	'typo_h3_size'   => $typo_h3_size.'px',
	'typo_h3_line'   => $typo_h3_line.'em',


	'typo_h4_font'   => '"'.$typo_h4_font.'",sans-serif',
	'typo_h4_weight' => $typo_h4_weight,
	'typo_h4_style'  => $typo_h4_style,
	'typo_h4_size'   => $typo_h4_size.'px',
	'typo_h4_line'   => $typo_h4_line.'em',


	'typo_h5_font'   => '"'.$typo_h5_font.'",sans-serif',
	'typo_h5_weight' => $typo_h5_weight,
	'typo_h5_style'  => $typo_h5_style,
	'typo_h5_size'   => $typo_h5_size.'px',
	'typo_h5_line'   => $typo_h5_line.'em',


	'typo_h6_font'   => '"'.$typo_h6_font.'",sans-serif',
	'typo_h6_weight' => $typo_h6_weight,
	'typo_h6_style'  => $typo_h6_style,
	'typo_h6_size'   => $typo_h6_size.'px',
	'typo_h6_line'   => $typo_h6_line.'em',

);
return $config;

}
