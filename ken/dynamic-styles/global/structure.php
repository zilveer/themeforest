<?php

global $mk_settings;

$sidebar_width = 100 - $mk_settings['content-width'];
$boxed_layout_width = $mk_settings['grid-width']+60;


Mk_Static_Files::addGlobalStyle("
	.mk-grid,
	.mk-inner-grid
	{
		max-width: {$mk_settings['grid-width']}px;
	}

	.theme-page-wrapper.right-layout .theme-content, .theme-page-wrapper.left-layout .theme-content
	{
		width: {$mk_settings['content-width']}%;
	}

	.theme-page-wrapper #mk-sidebar.mk-builtin
	{
		width: {$sidebar_width}%;
	}



	.mk-boxed-enabled,
	.mk-boxed-enabled #mk-header.sticky-header,
	.mk-boxed-enabled #mk-header.transparent-header-sticky,
	.mk-boxed-enabled .mk-secondary-header
	{
		max-width: {$boxed_layout_width}px;

	}

	@media handheld, only screen and (max-width: {$mk_settings['grid-width']}px){

		#sub-footer .item-holder{
			margin:0 20px;
		}

	}

");