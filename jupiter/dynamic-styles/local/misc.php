<?php

// Add padding to header stretcher which is enabled when header becomes fixed. 
// Fills the gap that is created by taking element out of layout

global $mk_options;

// Flags. 
$is_sticky = !empty($mk_options['header_sticky_style']);
$has_header = is_header_show(); // don't like gramma here
$has_header_toolbar = (is_header_toolbar_show() === 'true'); // make bool
$is_style_2 = (get_header_style() === '2');

// Quit if no need to fill the gap
if(!$has_header || !$is_sticky || is_header_transparent()) return false;


$header_components_height = $mk_options['header_height'];
$header_components_height += 1; // border-bottom of mk-header-inner
if($has_header_toolbar) $header_components_height += 35;
if($is_style_2) $header_components_height += 50; // comes directly from css 



Mk_Static_Files::addLocalStyle("

	.header-style-1 .mk-header-padding-wrapper,
	.header-style-2 .mk-header-padding-wrapper,
	.header-style-3 .mk-header-padding-wrapper {
		padding-top:{$header_components_height}px;
	}

");