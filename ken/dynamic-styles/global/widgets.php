<?php

global $mk_settings;

$widget_font_family = (isset($mk_settings['widget-title']['font-family']) && !empty($mk_settings['widget-title']['font-family'])) ? ('font-family:' . $mk_settings['widget-title']['font-family'] . ';') : '';
$widget_font_size = (isset($mk_settings['widget-title']['font-size']) && !empty($mk_settings['widget-title']['font-size'])) ? ('font-size:' . $mk_settings['widget-title']['font-size'] . ';') : '';
$widget_font_weight = (isset($mk_settings['widget-title']['font-weight']) && !empty($mk_settings['widget-title']['font-weight'])) ? ('font-weight:' . $mk_settings['widget-title']['font-weight'] . ';') : '';
$widget_title_divider = (isset($mk_settings['widget-title-divider']) && $mk_settings['widget-title-divider'] == 1) ? '' : 'display: none;'; 

Mk_Static_Files::addGlobalStyle("

	.widgettitle {
		{$widget_font_family}
		{$widget_font_size}
		{$widget_font_weight}
	}

	.widgettitle:after{
		{$widget_title_divider}
	}

	.mk-side-dashboard .widgettitle,
	.mk-side-dashboard .widgettitle a
	{
		color: {$mk_settings['dashboard-title-color']};
	}


	.mk-side-dashboard,
	.mk-side-dashboard p
	{
		color: {$mk_settings['dashboard-txt-color']};
	}

	.mk-side-dashboard a
	{
		color: {$mk_settings['dashboard-link-color']['regular']};
	}

	.mk-side-dashboard a:hover
	{
		color: {$mk_settings['dashboard-link-color']['hover']};
	}

	#mk-sidebar .widgettitle,
	#mk-sidebar .widgettitle  a
	{
		color: {$mk_settings['sidebar-title-color']};
	}


	#mk-sidebar,
	#mk-sidebar p
	{
		color: {$mk_settings['sidebar-txt-color']};
	}

	#mk-sidebar a
	{
		color: {$mk_settings['sidebar-link-color']['regular']};
	}

	#mk-sidebar a:hover
	{
		color: {$mk_settings['sidebar-link-color']['hover']};
	}


	#mk-footer .widgettitle,
	#mk-footer .widgettitle a
	{
		color: {$mk_settings['footer-title-color']};
	}

	#mk-footer,
	#mk-footer p
	{
		color: {$mk_settings['footer-txt-color']};
	}

	#mk-footer a
	{
		color: {$mk_settings['footer-link-color']['regular']};
	}

	#mk-footer a:hover
	{
		color: {$mk_settings['footer-link-color']['hover']};
	}

	.mk-footer-copyright,
	.mk-footer-copyright a {
		color: {$mk_settings['footer-socket-color']} !important;
	}

	.mk-footer-social a {
		color: {$mk_settings['footer-social-color']['regular']} !important;
	}

	.mk-footer-social a:hover {
		color: {$mk_settings['footer-social-color']['hover']}!important;
	}

");