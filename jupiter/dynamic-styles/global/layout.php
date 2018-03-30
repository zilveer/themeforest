<?php

global $mk_options;

$boxed_layout_width = $mk_options['grid_width'] + 60;
$sidebar_width = 100 - $mk_options['content_width'];

Mk_Static_Files::addGlobalStyle("

.mk-grid
{
	max-width: {$mk_options['grid_width']}px;
}

.mk-header-nav-container, .mk-classic-menu-wrapper
{
	width: {$mk_options['grid_width']}px;
}


.theme-page-wrapper #mk-sidebar.mk-builtin
{
	width: {$sidebar_width}%;
}

.theme-page-wrapper.right-layout .theme-content,
.theme-page-wrapper.left-layout .theme-content
{
	width: {$mk_options['content_width']}%;
}


.mk-boxed-enabled #mk-boxed-layout,
.mk-boxed-enabled #mk-boxed-layout .header-style-1 .mk-header-holder,
.mk-boxed-enabled #mk-boxed-layout .header-style-3 .mk-header-holder
{
	max-width: {$boxed_layout_width}px;

}

.mk-boxed-enabled #mk-boxed-layout .header-style-2.a-sticky .mk-header-nav-container {
	width: {$boxed_layout_width}px !important;
	left:auto !important;	
}


");