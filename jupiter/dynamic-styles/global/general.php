<?php

global $mk_options;

$body_line_height = isset($mk_options['body_line_height']) ? $mk_options['body_line_height'] : 1.66;
$p_line_height = isset($mk_options['p_line_height']) ? $mk_options['p_line_height'] : 1.66;

Mk_Static_Files::addGlobalStyle("

body
{
	font-size: {$mk_options['body_font_size']}px;
	color: {$mk_options['body_text_color']};
	font-weight: {$mk_options['body_weight']};
	line-height: {$body_line_height}em;
}

p {
	font-size: {$mk_options['p_size']}px; 
	color: {$mk_options['p_color']};
	line-height: {$p_line_height}em;
}

a {
	color: {$mk_options['a_color']};
}

a:hover {
	color: {$mk_options['a_color_hover']};
}

.master-holder strong {
	color: {$mk_options['strong_color']};
}

.master-holder h1
{
	font-size: {$mk_options['h1_size']}px;
	color: {$mk_options['h1_color']};
	font-weight: {$mk_options['h1_weight']};
	text-transform: {$mk_options['h1_transform']};
}

.master-holder h2
{
	font-size: {$mk_options['h2_size']}px;
	color: {$mk_options['h2_color']};
	font-weight: {$mk_options['h2_weight']};
	text-transform: {$mk_options['h2_transform']};
}


.master-holder h3
{
	font-size: {$mk_options['h3_size']}px;
	color: {$mk_options['h3_color']};
	font-weight: {$mk_options['h3_weight']};
	text-transform: {$mk_options['h3_transform']};
}

.master-holder h4
{
	font-size: {$mk_options['h4_size']}px;
	color: {$mk_options['h4_color']};
	font-weight: {$mk_options['h4_weight']};
	text-transform: {$mk_options['h4_transform']};
}


.master-holder h5
{
	font-size: {$mk_options['h5_size']}px;
	color: {$mk_options['h5_color']};
	font-weight: {$mk_options['h5_weight']};
	text-transform: {$mk_options['h5_transform']};
}


.master-holder h6
{
	font-size: {$mk_options['h6_size']}px;
	color: {$mk_options['h6_color']};
	font-weight: {$mk_options['h6_weight']};
	text-transform: {$mk_options['h6_transform']};
}


.mk-section-preloader {
	background-color:{$mk_options['section_preloader_color']} !important;
}

");