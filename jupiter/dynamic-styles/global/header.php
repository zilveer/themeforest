<?php

global $mk_options;

$small_position = (($mk_options['header_height'] - 34) / 2);
$medium_position = (($mk_options['header_height']) - 50) / 2;
$large_position = (($mk_options['header_height'] - 66) / 2);
$sticky_position = (($mk_options['header_scroll_height'] - 34) / 2);
$vertical_header_logo_padding = !empty($mk_options['vertical_header_logo_padding']) ? $mk_options['vertical_header_logo_padding'] : 0;    
$responsive_icon_text_color = (!empty($mk_options['responsive_icon_text_color'])) ? $mk_options['responsive_icon_text_color'] : $mk_options['main_nav_top_text_color'];
$burger_icon_color = (isset($mk_options['header_burger_color']) && !empty($mk_options['header_burger_color'])) ? $mk_options['header_burger_color'] : $responsive_icon_text_color;


/*
* Header Layout
*/
Mk_Static_Files::addGlobalStyle("

.add-header-height,
.header-style-1 .mk-header-inner .mk-header-search,
.header-style-1 .menu-hover-style-1 .main-navigation-ul > li > a,
.header-style-1 .menu-hover-style-2 .main-navigation-ul > li > a,
.header-style-1 .menu-hover-style-4 .main-navigation-ul > li > a,
.header-style-1 .menu-hover-style-5 .main-navigation-ul > li,
.header-style-1 .menu-hover-style-3 .main-navigation-ul > li,
.header-style-1 .menu-hover-style-5 .main-navigation-ul > li

{
	height: {$mk_options['header_height']}px;
	line-height:{$mk_options['header_height']}px;
}


.header-style-1.a-sticky .menu-hover-style-1 .main-navigation-ul > li > a,
.header-style-3.a-sticky .menu-hover-style-1 .main-navigation-ul > li > a,
.header-style-1.a-sticky .menu-hover-style-5 .main-navigation-ul > li,
.header-style-1.a-sticky .menu-hover-style-2 .main-navigation-ul > li > a,
.header-style-3.a-sticky .menu-hover-style-2 .main-navigation-ul > li > a,
.header-style-1.a-sticky .menu-hover-style-4 .main-navigation-ul > li > a,
.header-style-3.a-sticky .menu-hover-style-4 .main-navigation-ul > li > a,
.header-style-1.a-sticky .menu-hover-style-3 .main-navigation-ul > li,
.header-style-3.a-sticky .mk-header-holder .mk-header-search,
.a-sticky:not(.header-style-4) .add-header-height
{
	height:{$mk_options['header_scroll_height']}px !important;
	line-height:{$mk_options['header_scroll_height']}px !important;

}

");	



/*
* Header Theme
*/
$header_toolbar_search_input_bg = "";

if( isset($mk_options['header_toolbar_search_input_bg']) and strlen($mk_options['header_toolbar_search_input_bg']) )
$header_toolbar_search_input_bg = "background-color:{$mk_options['header_toolbar_search_input_bg']} !important;";
$main_nav_bg_color = "";

if( isset($mk_options['main_nav_bg_color']) and strlen($mk_options['main_nav_bg_color']) )
$main_nav_bg_color = "background-color: {$mk_options['main_nav_bg_color']};";

Mk_Static_Files::addGlobalStyle("


.mk-header-bg
{
  -webkit-opacity: {$mk_options['header_opacity']};
  -moz-opacity: {$mk_options['header_opacity']};
  -o-opacity: {$mk_options['header_opacity']};
  opacity: {$mk_options['header_opacity']};
}

.a-sticky .mk-header-bg
{
  -webkit-opacity: {$mk_options['header_sticky_opacity']};
  -moz-opacity: {$mk_options['header_sticky_opacity']};
  -o-opacity: {$mk_options['header_sticky_opacity']};
  opacity: {$mk_options['header_sticky_opacity']};
}

.header-style-4 .header-logo {
	margin:{$vertical_header_logo_padding}px 0;
}


.header-style-2 .mk-header-inner
{
	line-height:{$mk_options['header_height']}px;
}

.mk-header-nav-container
{
	{$main_nav_bg_color}
}


.mk-header-start-tour
{
	font-size: {$mk_options['start_tour_size']}px;
	color: {$mk_options['start_tour_color']};
}


.mk-header-start-tour:hover
{
	color: {$mk_options['start_tour_color']};
}

.mk-search-trigger,
.mk-header .mk-header-cart-count
{
	color: {$mk_options['main_nav_top_text_color']};
}

.mk-toolbar-resposnive-icon svg,
.mk-header .mk-shoping-cart-link svg{
	fill: {$mk_options['main_nav_top_text_color']};	
}

.mk-css-icon-close div,
.mk-css-icon-menu div {
	background-color: {$burger_icon_color};
}


.mk-header-searchform .text-input
{
    {$header_toolbar_search_input_bg} 
	color: {$mk_options['header_toolbar_search_input_txt']};
}

.mk-header-searchform span i
{
	color: {$mk_options['header_toolbar_search_input_txt']};
}

.mk-header-searchform .text-input::-webkit-input-placeholder
{
	color: {$mk_options['header_toolbar_search_input_txt']};
}

.mk-header-searchform .text-input:-ms-input-placeholder
{
	color: {$mk_options['header_toolbar_search_input_txt']};
}

.mk-header-searchform .text-input:-moz-placeholder
{
	color: {$mk_options['header_toolbar_search_input_txt']};
}

.mk-header-social.header-section a.small {
	margin-top: {$small_position}px;
}
.mk-header-social.header-section a.medium {
	margin-top: {$medium_position}px;
}
.mk-header-social.header-section a.large {
	margin-top: {$large_position}px;
}

.a-sticky .mk-header-social.header-section a.small,
.a-sticky .mk-header-social.header-section a.medium,
.a-sticky .mk-header-social.header-section a.large {
	margin-top: {$sticky_position}px;
	line-height: 16px !important;
	height: 16px !important;
	width: 16px !important;
	padding: 8px !important;
}
.a-sticky .mk-header-social.header-section a.small svg,
.a-sticky .mk-header-social.header-section a.medium svg,
.a-sticky .mk-header-social.header-section a.large svg {
	line-height: 16px !important;
	height: 16px !important;
}

.header-section.mk-header-social svg
{
	fill: {$mk_options['header_social_color']};
}
.header-section.mk-header-social a:hover svg 
{
	fill: {$mk_options['header_social_hover_color']};
}

.header-style-4 
{
	text-align : {$mk_options['vertical_header_align']}
}

");



/* 
* Header social network icons skin for some conditional styles
*/
if(in_array($mk_options['header_social_networks_style'], array('square-pointed', 'square-rounded', 'simple-rounded'))) {
    
   Mk_Static_Files::addGlobalStyle("
		.header-section.mk-header-social ul li a {
			border-color: {$mk_options['header_social_border_color']};
			background-color: {$mk_options['header_social_bg_main_color']} !important;
		}
		.header-section.mk-header-social ul li a:hover {
			border-color: {$mk_options['header_social_bg_color']};
			background-color: {$mk_options['header_social_bg_color']} !important;
		}
	");

}




    
if (!empty($mk_options['header_border_color'])) {
    
    Mk_Static_Files::addGlobalStyle("
		.mk-header-inner,
		.a-sticky .mk-header-inner,
		.header-style-2.a-sticky .mk-classic-nav-bg
		{
			border-bottom:{$mk_options['header_btn_border_thickness']}px solid {$mk_options['header_border_color']};
		}

		.header-style-4.header-align-left .mk-header-inner,
		.header-style-4.header-align-center .mk-header-inner
		{
			border-bottom:none;
			border-right:{$mk_options['header_btn_border_thickness']}px solid {$mk_options['header_border_color']};
		}

		.header-style-4.header-align-right .mk-header-inner {
			border-bottom:none;
			border-left:{$mk_options['header_btn_border_thickness']}px solid {$mk_options['header_border_color']};
		}

		.header-style-2 .mk-header-nav-container {
			border-top:{$mk_options['header_btn_border_thickness']}px solid {$mk_options['header_border_color']};
		}
	");

}

if (!empty($mk_options['sticky_header_border_color'])) {
    
    Mk_Static_Files::addGlobalStyle("
		.a-sticky .mk-header-inner,
		.header-style-2.a-sticky .mk-classic-nav-bg
		{
			border-bottom:{$mk_options['header_btn_border_thickness']}px solid {$mk_options['sticky_header_border_color']};
		}
	");

}


if (!empty($mk_options['mega_menu_divider_color'])) {
        
    Mk_Static_Files::addGlobalStyle("
        .has-mega-menu > ul.sub-menu > li.menu-item 
        {
	       border-left: 1px solid {$mk_options['mega_menu_divider_color']};
        }
    ");
}


if (!empty($mk_options['header_toolbar_border_color'])) {
    
    Mk_Static_Files::addGlobalStyle("
		.mk-header-toolbar
		{
			border-bottom:1px solid {$mk_options['header_toolbar_border_color']};
		}
	");

}





if ($mk_options['vertical_header_align'] != 'center') {
    Mk_Static_Files::addGlobalStyle("
        .mk-vm-menuwrapper li > a 
        {
            padding-right: 45px;
        }
    ");
}


Mk_Static_Files::addGlobalStyle("
    .header-style-4 .mk-header-right 
    {
        text-align: {$mk_options['vertical_header_align']} !important;
    }
");

$mk_burger_floating_width = $mk_options['responsive_nav_width'] + 600;
Mk_Static_Files::addGlobalStyle(" 
	@media handheld, only screen and (max-width: {$mk_burger_floating_width}px) and (min-width: {$mk_options['responsive_nav_width']}px){
		
		.dashboard-opened .mk-dashboard-trigger {
			transform: translateX(-300px) translateZ(0);
			transition: all 300ms ease-in-out !important;
		}
	}
");