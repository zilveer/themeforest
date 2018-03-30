<?php

global $mk_options;

$header_mobile_bg = !empty($mk_options['header_mobile_bg']) ? 'background-color: '.$mk_options['header_mobile_bg'].' !important;' : '';
$header_mobile_search_input_bg = !empty($mk_options['header_mobile_search_input_bg']) ? 'background-color: '.$mk_options['header_mobile_search_input_bg'].' !important;' : '';
$header_mobile_search_input_color = !empty($mk_options['header_mobile_search_input_color']) ? 'color: '.$mk_options['header_mobile_search_input_color'].' !important;' : '';
$header_mobile_search_input_fill_color = !empty($mk_options['header_mobile_search_input_color']) ? 'fill: '.$mk_options['header_mobile_search_input_color'].' !important;' : '';
$header_mobile_toolbar_bg = !empty($mk_options['header_mobile_toolbar_bg']) ? 'background-color: '.$mk_options['header_mobile_toolbar_bg'].' !important;' : '';
$header_mobile_toolbar_color = !empty($mk_options['header_mobile_toolbar_color']) ? 'color: '.$mk_options['header_mobile_toolbar_color'].' !important;' : '';
$header_mobile_toolbar_link_color = !empty($mk_options['header_mobile_toolbar_link_color']) ? 'color: '.$mk_options['header_mobile_toolbar_link_color'].' !important;' : '';
$header_mobile_toolbar_social_fill_color = !empty($mk_options['header_mobile_toolbar_social_color']) ? 'fill: '.$mk_options['header_mobile_toolbar_social_color'].' !important;' : '';

Mk_Static_Files::addGlobalStyle("

@media handheld, only screen and (max-width: {$mk_options['responsive_nav_width']}px) {

	.mk-header-bg {
		{$header_mobile_bg}
	}
	.responsive-searchform .text-input
	{
	    {$header_mobile_search_input_bg}
		{$header_mobile_search_input_color}
	}

	.responsive-searchform span i
	{
		{$header_mobile_search_input_color}
	}

	.responsive-searchform i svg
	{
		{$header_mobile_search_input_fill_color}
	}

	.responsive-searchform .text-input::-webkit-input-placeholder
	{
		{$header_mobile_search_input_color}
	}

	.responsive-searchform .text-input:-ms-input-placeholder
	{
		{$header_mobile_search_input_color}
	}

	.responsive-searchform .text-input:-moz-placeholder
	{
		{$header_mobile_search_input_color}
	}

	.mk-header-toolbar
	{
		{$header_mobile_toolbar_bg}
	}	

	.mk-toolbar-navigation a,
	.mk-toolbar-navigation a:hover,
	.mk-language-nav > a,
	.mk-header-login .mk-login-link,
	.mk-subscribe-link,
	.mk-checkout-btn,
	.mk-header-tagline a,
	.header-toolbar-contact a,
	.mk-language-nav > a:hover,
	.mk-header-login .mk-login-link:hover,
	.mk-subscribe-link:hover,
	.mk-checkout-btn:hover,
	.mk-header-tagline a:hover
	{
		{$header_mobile_toolbar_link_color}
	}



	.mk-header-tagline,
	.header-toolbar-contact,
	.mk-header-date
	{
		{$header_mobile_toolbar_color}
	}


	.mk-header-toolbar .mk-header-social svg {
		{$header_mobile_toolbar_social_fill_color}
	}


}

");