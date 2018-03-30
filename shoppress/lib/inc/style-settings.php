<?php


/////////////////////////////////////// Custom Styling ///////////////////////////////////////


// Custom CSS

global $dirname;
$custom_css = "";


// Primary

if(get_option($dirname.'_body_text_color') OR get_option($dirname.'_body_font') OR get_option($dirname.'_body_size')) {
	$custom_css .=  'body, input, textarea, select {
	color: '.get_option($dirname.'_body_text_color').';	
	font-family: "'.get_option($dirname.'_body_font').'";
	font-size: '.get_option($dirname.'_body_size').'px;
	}';
}
	
if(get_option($dirname.'_body_link_color')) {
	$custom_css .=  'a {color: '.get_option($dirname.'_body_link_color').';}';
}

if(get_option($dirname.'_body_link_hover_color')) {
	$custom_css .=  'a:hover {color: '.get_option($dirname.'_body_link_hover_color').';}';
}

// Heading

if(get_option($dirname.'_heading_text_color') OR get_option($dirname.'_heading_font')) {
	$custom_css .=  'h1, h2, h3, h4, h5, h6, .widget .widget-title, {color: '.get_option($dirname.'_heading_text_color').'; font-family: "'.get_option($dirname.'_heading_font').'";}';
}	

if(get_option($dirname.'_heading1_size')) {
	$custom_css .=  'h1 {font-size: '.get_option($dirname.'_heading1_size').'px;}';
}	

if(get_option($dirname.'_heading2_size')) {
	$custom_css .=  'h2 {font-size: '.get_option($dirname.'_heading2_size').'px;}';
}
	
if(get_option($dirname.'_heading3_size')) {
	$custom_css .=  'h3 {font-size: '.get_option($dirname.'_heading3_size').'px;}';
}
	
if(get_option($dirname.'_heading_link_color')) {				
	$custom_css .=  'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: '.get_option($dirname.'_heading_link_color').';}';
}

if(get_option($dirname.'_heading_link_hover_color')) {
	$custom_css .=  'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, #sidebar .menu li a:hover {color: '.get_option($dirname.'_heading_link_hover_color').';}';
}	

// Header

if(get_option($dirname.'_header_left_bg_color') OR get_option($dirname.'_header_right_bg_color')) {
	$custom_css .=  '#header {background: '.get_option($dirname.'_header_right_bg_color').';
	background: -moz-linear-gradient(left, '.get_option($dirname.'_header_left_bg_color').' 0%, '.get_option($dirname.'_header_left_bg_color').' 50%, '.get_option($dirname.'_header_right_bg_color').' 50.1%, '.get_option($dirname.'_header_right_bg_color').' 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.get_option($dirname.'_header_left_bg_color').'), color-stop(50%,'.get_option($dirname.'_header_left_bg_color').'), color-stop(50.1%,'.get_option($dirname.'_header_right_bg_color').'), color-stop(100%,'.get_option($dirname.'_header_right_bg_color').'));
	background: -webkit-linear-gradient(left, '.get_option($dirname.'_header_left_bg_color').' 0%,'.get_option($dirname.'_header_left_bg_color').' 50%,'.get_option($dirname.'_header_right_bg_color').' 50.1%,'.get_option($dirname.'_header_right_bg_color').' 100%);
	background: -o-linear-gradient(left, '.get_option($dirname.'_header_left_bg_color').' 0%,'.get_option($dirname.'_header_left_bg_color').' 50%,'.get_option($dirname.'_header_right_bg_color').' 50.1%,'.get_option($dirname.'_header_right_bg_color').' 100%);
	background: -ms-linear-gradient(left, '.get_option($dirname.'_header_left_bg_color').' 0%,'.get_option($dirname.'_header_left_bg_color').' 50%,'.get_option($dirname.'_header_right_bg_color').' 50.1%,'.get_option($dirname.'_header_right_bg_color').' 100%);
	background: linear-gradient(to right, '.get_option($dirname.'_header_left_bg_color').' 0%,'.get_option($dirname.'_header_left_bg_color').' 50%,'.get_option($dirname.'_header_right_bg_color').' 50.1%,'.get_option($dirname.'_header_right_bg_color').' 100%);
	-pie-background: linear-gradient(left, '.get_option($dirname.'_header_left_bg_color').' 0%,'.get_option($dirname.'_header_left_bg_color').' 50%,'.get_option($dirname.'_header_right_bg_color').' 50.1%,'.get_option($dirname.'_header_right_bg_color').' 100%);}
	#header-right, .nav .sub-menu, .dropdowncart-contents {background: '.get_option($dirname.'_header_right_bg_color').' !important;}';
}	

if(get_option($dirname.'_header_text_color')) {
	$custom_css .=  '.cart-link, .dropdowncart, .dropdowncart-contents .cart_list li a {
	color: '.get_option($dirname.'_header_text_color').' !important;
	}';
}
	
if(get_option($dirname.'_header_link_color')) {
	$custom_css .=  '#header-nav .menu a {color: '.get_option($dirname.'_header_link_color').';}';
}

if(get_option($dirname.'_header_link_hover_color')) {
	$custom_css .=  '#header-nav .menu a:hover, #header .nav li span, .dropdowncart .amount, .dropdowncart:hover .amount {color: '.get_option($dirname.'_header_link_hover_color').';}
	#header .nav .sub-menu li::before {border-color: transparent '.get_option($dirname.'_header_link_hover_color').';}';
}

// Outer Body

if(get_option($dirname.'_outer_body_text_color')) {
	$custom_css .=  '#body-nav.nav .nav-text, #footer {
	color: '.get_option($dirname.'_outer_body_text_color').';
	}';
}
	
if(get_option($dirname.'_outer_body_link_color')) {
	$custom_css .=  '#body-nav.nav li a, #footer a:hover, #footer li a, #footer .tagcloud a {color: '.get_option($dirname.'_outer_body_link_color').';}
	#body-nav.nav li a {border-color: transparent '.get_option($dirname.'_outer_body_link_hover_color').';}';
}

if(get_option($dirname.'_outer_body_link_hover_color')) {
	$custom_css .=  '#body-nav.nav li a:hover, #body-nav .menu > li:hover > a, #body-nav.nav li span, #footer .widget-title, #footer a, #footer li a:hover, #footer .tagcloud a:hover {color: '.get_option($dirname.'_outer_body_link_hover_color').' !important;}
	#body-nav.nav li a, #body-nav.nav .sub-menu li::before {border-color: transparent '.get_option($dirname.'_outer_body_link_hover_color').';}';
}	
	
// Content
	
if(get_option($dirname.'_content_bg_color_1')) {
	$custom_css .=  '#content-wrapper, #content {background: '.get_option($dirname.'_content_bg_color_1').';}';
}	


if(get_option($dirname.'_content_bg_color_2')) {
	$custom_css .=  '.widget, .post-thumbnail, input, textarea, input[type="password"] {background: '.get_option($dirname.'_content_bg_color_2').';}';
}	

if(get_option($dirname.'_content_border_color')) {
	$custom_css .=  '#content-wrapper, .nav .sub-menu, .sc-divider, .gp-table, .gp-table td, .text-box, div.product .woocommerce_tabs ul.tabs, div.product .woocommerce-tabs ul.tabs, div.product .products h2, .dropdowncart-contents {border-color:'.get_option($dirname.'_content_border_color').' !important;}
	.post-thumbnail:hover, ul.products .product img:hover, div.product div.images img:hover, #content div.product div.images img:hover {background: '.get_option($dirname.'_content_border_color').';}';
}

if(get_option($dirname.'_content_border_alt_color')) {
	$custom_css .=  '.post-thumbnail, ul.products .product img, div.product div.images img, #content div.product div.images img {background: '.get_option($dirname.'_content_border_alt_color').';}';
}	

// Buttons

if(get_option($dirname.'_button_text_color')) {
	$custom_css .=  'input[type="button"], input[type="submit"], input[type="reset"], button, .button, ul.products li.product .button, ul.products li.product .view_product_button, .product .price .amount, .product .price ins .amount, span.onsale, div.product .woocommerce_tabs ul.tabs li.active a, div.product .woocommerce-tabs ul.tabs li.active a, div.product .products h2, #content-widgets .widgettitle, .caption-title, .caption a, .quantity .plus, .quantity .minus, .dropdownbutton {color: '.get_option($dirname.'_button_text_color').';}';
}	

if(get_option($dirname.'_button_text_hover_color')) {
	$custom_css .=  'input[type="button"]:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover, .button:hover, ul.products li.product .button:hover, ul.products li.product .view_product_button:hover, .products .price .amount:hover, .products .price ins .amount:hover, .caption a:hover, .quantity .plus:hover, .quantity .minus:hover, .dropdownbutton:hover {color: '.get_option($dirname.'_button_text_hover_color').';}';
}	
			
if(get_option($dirname.'_button_bg_color')) {		
	$custom_css .=  'input[type="button"], input[type="submit"], input[type="reset"], button, .button, #searchsubmit:hover, #footer input[type="submit"]:hover, #footer input[type="button"]:hover, #footer input[type="submit"]:hover, #footer input[type="reset"]:hover, #footer button:hover, #footer .button:hover, ul.products li.product .button, ul.products li.product .view_product_button, .product .price .amount, .product .price ins .amount, span.onsale, div.product .woocommerce_tabs ul.tabs, div.product .woocommerce-tabs ul.tabs, div.product .products h2, #content-widgets .widgettitle, .caption, .text-box, .quantity .plus, .quantity .minus, .dropdownbutton {background-color: '.get_option($dirname.'_button_bg_color').';}';
}	

if(get_option($dirname.'_button_bg_hover_color')) {
	$custom_css .=  'input[type="button"]:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover, .button:hover, #searchsubmit, #footer input[type="submit"], #footer input[type="button"], #footer input[type="submit"], #footer input[type="reset"], #footer button, #footer .button, ul.products li.product .button:hover, ul.products li.product .view_product_button:hover, .products .price .amount:hover, .products .price ins .amount:hover, .quantity .plus:hover, .quantity .minus:hover, .dropdownbutton:hover {background-color: '.get_option($dirname.'_button_bg_hover_color').';}';
}
	

// Custom Styling

if(get_option($dirname.'_custom_css')) {
	$custom_css .= stripslashes(get_option($dirname.'_custom_css'));
}

if(!empty($custom_css)) { echo '<style>'.$custom_css.'</style>'; }

?>