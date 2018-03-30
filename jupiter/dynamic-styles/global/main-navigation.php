<?php

global $mk_options;

$main_nav_sub_width = isset($mk_options['main_nav_sub_width']) ? $mk_options['main_nav_sub_width'] : 210;
$hover_style_3_height = $mk_options['header_height'] / 2;
$hover_style_3_height_sticky = $mk_options['header_scroll_height'] / 1.5;
$main_nav_sub_hover_bg_color = (!empty($mk_options['main_nav_sub_hover_bg_color'])) ? $mk_options['main_nav_sub_hover_bg_color'] : 'transparent';
$sub_level_box_border_color = isset($mk_options['sub_level_box_border_color']) ? $mk_options['sub_level_box_border_color'] : '#d3d3d3';
$nav_sub_shadow = isset($mk_options['nav_sub_shadow']) ? $mk_options['nav_sub_shadow'] : 'true';

Mk_Static_Files::addGlobalStyle("

.main-navigation-ul > li.menu-item > a.menu-item-link
{
	color: {$mk_options['main_nav_top_text_color']};
	font-size: {$mk_options['main_nav_top_size']}px;
	font-weight: {$mk_options['main_nav_top_weight']};
	padding-right:{$mk_options['main_nav_item_space']}px !important;
	padding-left:{$mk_options['main_nav_item_space']}px !important;
	text-transform:{$mk_options['main_menu_transform']};
	letter-spacing:{$mk_options['main_nav_top_letter_spacing']}px;
}


.mk-vm-menuwrapper ul li a {
	color: {$mk_options['main_nav_top_text_color']};
	font-size: {$mk_options['main_nav_top_size']}px;
	font-weight: {$mk_options['main_nav_top_weight']};
	text-transform:{$mk_options['main_menu_transform']};
}
.mk-vm-menuwrapper li > a:after,
.mk-vm-menuwrapper li.mk-vm-back:after {
	color: {$mk_options['main_nav_top_text_color']};
}

.mk-vm-menuwrapper .mk-svg-icon{
	fill: {$mk_options['main_nav_top_text_color']};
}

.main-navigation-ul > li.no-mega-menu ul.sub-menu li.menu-item a.menu-item-link 
{
	width:{$main_nav_sub_width}px;
}


.menu-hover-style-1 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
.menu-hover-style-1 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
.menu-hover-style-2 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
.menu-hover-style-2 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
.menu-hover-style-2 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
.menu-hover-style-2 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
.menu-hover-style-1.mk-vm-menuwrapper li.menu-item > a:hover,
.menu-hover-style-1.mk-vm-menuwrapper li.menu-item:hover > a,
.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a,
.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a,
.menu-hover-style-2.mk-vm-menuwrapper li.menu-item > a:hover,
.menu-hover-style-2.mk-vm-menuwrapper li.menu-item:hover > a,
.menu-hover-style-2.mk-vm-menuwrapper li.current-menu-item > a,
.menu-hover-style-2.mk-vm-menuwrapper li.current-menu-ancestor > a
{

	color: {$mk_options['main_nav_top_hover_skin']} !important;
}


.menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
.menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
.menu-hover-style-3.mk-vm-menuwrapper li > a:hover,
.menu-hover-style-3.mk-vm-menuwrapper li:hover > a,
.menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link
{
	border:2px solid {$mk_options['main_nav_top_hover_skin']};
}

.menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
.menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,
.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a{

	border:2px solid {$mk_options['main_nav_top_hover_skin']};
	background-color:{$mk_options['main_nav_top_hover_skin']};
	color:{$mk_options['main_nav_top_hover_txt_color']};

}

.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a:after {
	color:{$mk_options['main_nav_top_hover_txt_color']};
}

.menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
.menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
.menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,
.menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,
.menu-hover-style-4.mk-vm-menuwrapper li a:hover,
.menu-hover-style-4.mk-vm-menuwrapper li:hover > a,
.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a,
.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a,
.menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after
{
	background-color: {$mk_options['main_nav_top_hover_skin']};
	color:{$mk_options['main_nav_top_hover_txt_color']};
}

.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a:after,
.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a:after,
.menu-hover-style-4.mk-vm-menuwrapper li:hover > a:after,
.menu-hover-style-4.mk-vm-menuwrapper li a:hover::after 
{
	color:{$mk_options['main_nav_top_hover_txt_color']};
}

.menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,
.menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
.menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link 
{
	border-top-color:{$mk_options['main_nav_top_hover_skin']};
}

.menu-hover-style-1.mk-vm-menuwrapper li > a:hover,
.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a,
.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a
{
	border-left-color:{$mk_options['main_nav_top_hover_skin']};
}


.header-style-1 .menu-hover-style-3 .main-navigation-ul > li > a.menu-item-link {
	line-height:{$hover_style_3_height}px;
}

.header-style-1.a-sticky .menu-hover-style-3 .main-navigation-ul > li > a.menu-item-link {
	line-height:{$hover_style_3_height_sticky}px;
}

.header-style-1 .menu-hover-style-5 .main-navigation-ul > li > a.menu-item-link {
	line-height:20px;
	vertical-align:middle;
}

.mk-main-navigation li.no-mega-menu ul.sub-menu,
.mk-main-navigation li.has-mega-menu > ul.sub-menu,
.mk-shopping-cart-box
{
	background-color: {$mk_options['main_nav_sub_bg_color']};
}

.mk-main-navigation ul.sub-menu a.menu-item-link,
.mk-main-navigation ul .megamenu-title,
.megamenu-widgets-container a,
.mk-shopping-cart-box .product_list_widget li a,
.mk-shopping-cart-box .product_list_widget li.empty,
.mk-shopping-cart-box .product_list_widget li span,
.mk-shopping-cart-box .widget_shopping_cart .total
{
	color: {$mk_options['main_nav_sub_text_color']};
}
.mk-main-navigation ul.sub-menu .menu-sub-level-arrow svg {
	fill: {$mk_options['main_nav_sub_text_color']};
}
.mk-main-navigation ul.sub-menu li:hover .menu-sub-level-arrow svg {
	fill: {$mk_options['main_nav_sub_text_color_hover']};
}

.mk-shopping-cart-box .mk-button.cart-widget-btn {
	border-color:{$mk_options['main_nav_sub_text_color']};
	color:{$mk_options['main_nav_sub_text_color']};
}
.mk-shopping-cart-box .mk-button.cart-widget-btn:hover {
	background-color:{$mk_options['main_nav_sub_text_color']};
	color:{$mk_options['main_nav_sub_bg_color']};
}

.mk-main-navigation ul .megamenu-title
{
	color: {$mk_options['main_nav_mega_title_color']};
}
.mk-main-navigation ul .megamenu-title:after
{
	background-color: {$mk_options['main_nav_mega_title_color']};
}

.megamenu-widgets-container {
	color: {$mk_options['main_nav_sub_text_color']};
}

.megamenu-widgets-container .widgettitle
{
		text-transform: {$mk_options['sidebar_title_transform']};
		font-size: {$mk_options['sidebar_title_size']}px;
		font-weight: {$mk_options['sidebar_title_weight']};
}

.mk-main-navigation ul.sub-menu li.menu-item ul.sub-menu li.menu-item a.menu-item-link svg
{
	color: {$mk_options['main_nav_sub_icon_color']};
}

.mk-main-navigation ul.sub-menu a.menu-item-link:hover,
.main-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link,
.main-navigation-ul ul.sub-menu li.current-menu-parent > a.menu-item-link
{
	color: {$mk_options['main_nav_sub_text_color_hover']} !important;
}



.megamenu-widgets-container a:hover {
	color: {$mk_options['main_nav_sub_text_color_hover']};	
}

.main-navigation-ul ul.sub-menu li.menu-item a.menu-item-link:hover,
.main-navigation-ul ul.sub-menu li.menu-item:hover > a.menu-item-link,
.main-navigation-ul ul.sub-menu li.menu-item a.menu-item-link:hover,
.main-navigation-ul ul.sub-menu li.menu-item:hover > a.menu-item-link,
.main-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link,
.main-navigation-ul ul.sub-menu li.current-menu-parent > a.menu-item-link
{
	background-color:{$main_nav_sub_hover_bg_color} !important;
}

.mk-search-trigger:hover,
.mk-header-start-tour:hover
{
	color: {$mk_options['main_nav_top_hover_skin']};
}
.mk-search-trigger:hover .mk-svg-icon,
.mk-header-start-tour:hover .mk-svg-icon
{
	fill: {$mk_options['main_nav_top_hover_skin']};
}

.main-navigation-ul li.menu-item ul.sub-menu li.menu-item a.menu-item-link
{
	font-size: {$mk_options['main_nav_sub_size']}px;
	font-weight: {$mk_options['main_nav_sub_weight']};
	text-transform:{$mk_options['main_nav_sub_transform']};
	letter-spacing: {$mk_options['main_nav_sub_letter_spacing']}px;
}
.has-mega-menu .megamenu-title {
	letter-spacing: {$mk_options['main_nav_sub_letter_spacing']}px;
}

.mk-responsive-wrap
{
	background-color:{$mk_options['responsive_nav_color']};
}
	
");



/*
* Main Navigation > sub level top border color
*/    
if (!empty($mk_options['main_nav_sub_border_top_color'])) {
   	Mk_Static_Files::addGlobalStyle("
		.main-navigation-ul > li.no-mega-menu > ul.sub-menu:after,
		.main-navigation-ul > li.has-mega-menu > ul.sub-menu:after
		{
		  background-color:{$mk_options['main_nav_sub_border_top_color']};
		}
		.mk-shopping-cart-box {
			border-top:2px solid {$mk_options['main_nav_sub_border_top_color']};
		}
	");
}



if (!empty($sub_level_box_border_color)) {
        
	Mk_Static_Files::addGlobalStyle("
		.main-navigation-ul > li.no-mega-menu  ul,
		.main-navigation-ul > li.has-mega-menu > ul,
		.mk-shopping-cart-box {
			border:1px solid {$sub_level_box_border_color};
		}
	");
	
}

if ($nav_sub_shadow != 'false') {
	Mk_Static_Files::addGlobalStyle("
		.main-navigation-ul > li.no-mega-menu > ul,
		.main-navigation-ul > li.has-mega-menu > ul,
		.mk-shopping-cart-box {
			-webkit-box-shadow: 0 20px 50px 10px rgba(0, 0, 0, 0.15);
			-moz-box-shadow: 0 20px 50px 10px rgba(0, 0, 0, 0.15);
			box-shadow: 0 20px 50px 10px rgba(0, 0, 0, 0.15);
		}
	");
}

