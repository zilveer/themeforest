<?php

global $mk_settings;

$grid_width_100 = $mk_settings['grid-width']+100;
$header_height = get_header_height();

Mk_Static_Files::addGlobalStyle("

	@media handheld, only screen and (max-width: {$grid_width_100}px){

		.dashboard-trigger.res-mode {
			display:block !important;
		}

		.dashboard-trigger.desktop-mode {
			display:none !important;
		}

	}


	@media handheld, only screen and (max-width: {$mk_settings['res-nav-width']}px){

	#mk-header.sticky-header,
	.mk-secondary-header,
	.transparent-header-sticky {
		position: relative !important;
		left:auto !important;
	    right:auto!important;
	    top:auto !important;
	}

	.add-corner-margin #mk-header.sticky-header, .add-corner-margin #mk-header.transparent-header-sticky {
	  left: 20px;
	  right: 20px;
	  // Width auto was creating glitch in safari - if it is needed work it out somehow differently and watch out for safari!
	  // width: auto !important;
	}

	#mk-header:not(.header-structure-vertical).put-header-bottom,
	#mk-header:not(.header-structure-vertical).put-header-bottom.sticky-trigger-header,
	#mk-header:not(.header-structure-vertical).put-header-bottom.header-offset-passed,
	.admin-bar #mk-header:not(.header-structure-vertical).put-header-bottom.sticky-trigger-header {
		position:relative;
		bottom:auto;
	}

	.mk-margin-header-burger {
		display:none;
	}

	.main-navigation-ul li.menu-item,
	.mk-vertical-menu li.menu-item,
	.main-navigation-ul li.sub-menu,
	.sticky-header-padding,
	.secondary-header-space
	{
		display:none !important;
	}

	.vertical-expanded-state #mk-header.header-structure-vertical, .vertical-condensed-state #mk-header.header-structure-vertical{
		width: 100% !important;
		height: auto !important;
	}
	.vertical-condensed-state  #mk-header.header-structure-vertical:hover {
		width: 100% !important;
	}
	.header-structure-vertical .mk-vertical-menu{
		position:relative;
		padding:0;
		width: 100%;
	}
	.header-structure-vertical .mk-header-social.inside-grid{
		position:relative;
		padding:0;
		width: auto;
		bottom: inherit !important;
		height:{$header_height}px;
		line-height:{$header_height}px;
		float:right !important;
		top: 0 !important;
	}

	.vertical-condensed-state .header-structure-vertical .mk-vertical-menu>li.mk-header-logo {
		-webkit-transform: translate(0,0);
		-moz-transform: translate(0,0);
		-ms-transform: translate(0,0);
		-o-transform: translate(0,0);
		opacity: 1!important;
		position: relative!important;
		left: 0!important;
	}
	.vertical-condensed-state .header-structure-vertical .mk-vertical-header-burger{
		display:none !important;
	}


	.mk-header-logo {
		padding:0 !important;
	}

	.mk-vertical-menu .responsive-nav-link{
		float:left !important;
	}
	.mk-vertical-menu .responsive-nav-link i{
		height:{$header_height}px;
		line-height:{$header_height}px;
	}
	.mk-vertical-menu .mk-header-logo {
		float:left !important
	}


	.header-search-icon i,
	.mk-cart-link i,
	.mk-responsive-cart-link i
	{
		padding:0 !important;
		margin:0 !important;
		border:none !important;
	}

	.header-search-icon,
	.mk-cart-link,
	.mk-responsive-cart-link
	{
		margin:0 8px !important;
		padding:0 !important;
	}


	.mk-header-logo
	{

		margin-left:20px !important;
		display:inline-block !important;
	}


	.main-navigation-ul
	{
		text-align:center !important;
	}

	.responsive-nav-link {
		display:inline-block !important;
	}

	.mk-shopping-box {
		display:none !important;
	}
	.mk-shopping-cart{
		display:none !important;
	}
	.mk-responsive-shopping-cart{
		display: inline-block !important;
	}

	}


	.theme-main-wrapper:not(.vertical-header) #mk-header.transparent-header {
	  position: absolute;
	  left: 0;
	}

	.mk-boxed-enabled #mk-header.transparent-header {
	  left: inherit;
	}

	.add-corner-margin .mk-boxed-enabled #mk-header.transparent-header {
	  left: 0;
	}

	.transparent-header {
	  transition: all 0.3s ease-in-out;
	  -webkit-transition: all 0.3s ease-in-out;
	  -moz-transition: all 0.3s ease-in-out;
	  -ms-transition: all 0.3s ease-in-out;
	  -o-transition: all 0.3s ease-in-out;
	}

	.transparent-header.transparent-header-sticky {
	  opacity: 1;
	  left: auto !important;
	}
	.transparent-header #mk-main-navigation ul li .sub {
	  border-top: none;
	}
	.transparent-header .mk-cart-link:hover,
	.transparent-header .mk-responsive-cart-link:hover,
	.transparent-header .dashboard-trigger:hover,
	.transparent-header .res-nav-active:hover,
	.transparent-header .header-search-icon:hover {
	  opacity: 0.7;
	}
	.transparent-header .header-searchform-input input[type=text] {
	  background-color: transparent;
	}
	.transparent-header.light-header-skin .dashboard-trigger,
	.transparent-header.light-header-skin .dashboard-trigger:hover,
	.transparent-header.light-header-skin .res-nav-active,
	.transparent-header.light-header-skin #mk-main-navigation > ul > li.menu-item > a,
	.transparent-header.light-header-skin #mk-main-navigation > ul > li.current-menu-item > a,
	.transparent-header.light-header-skin #mk-main-navigation > ul > li.current-menu-ancestor > a,
	.transparent-header.light-header-skin #mk-main-navigation > ul > li.menu-item:hover > a,
	.transparent-header.light-header-skin #mk-main-navigation > ul > li.menu-item > a:hover,
	.transparent-header.light-header-skin .res-nav-active:hover,
	.transparent-header.light-header-skin .header-searchform-input input[type=text],
	.transparent-header.light-header-skin .header-search-icon,
	.transparent-header.light-header-skin .header-search-close,
	.transparent-header.light-header-skin .header-search-icon:hover,
	.transparent-header.light-header-skin .mk-cart-link,
	.transparent-header.light-header-skin .mk-responsive-cart-link,
	.transparent-header.light-header-skin .mk-header-social a,
	.transparent-header.light-header-skin .mk-header-wpml-ls > a{
	  color: #fff !important;
	}
	.transparent-header.light-header-skin .mk-burger-icon div {
	  background-color: #fff;
	}
	.transparent-header.light-header-skin .mk-light-logo {
	  display: inline-block !important;
	}
	.transparent-header.light-header-skin .mk-dark-logo {
	  display: none !important;
	}
	.transparent-header.light-header-skin.transparent-header-sticky .mk-light-logo {
	  display: none !important;
	}
	.transparent-header.light-header-skin.transparent-header-sticky .mk-dark-logo {
	  display: inline-block !important;
	}
	.transparent-header.dark-header-skin .dashboard-trigger,
	.transparent-header.dark-header-skin .dashboard-trigger:hover,
	.transparent-header.dark-header-skin .res-nav-active,
	.transparent-header.dark-header-skin #mk-main-navigation > ul > li.menu-item > a,
	.transparent-header.dark-header-skin #mk-main-navigation > ul > li.current-menu-item > a,
	.transparent-header.dark-header-skin #mk-main-navigation > ul > li.current-menu-ancestor > a,
	.transparent-header.dark-header-skin #mk-main-navigation > ul > li.menu-item:hover > a,
	.transparent-header.dark-header-skin #mk-main-navigation > ul > li.menu-item > a:hover,
	.transparent-header.dark-header-skin .res-nav-active:hover,
	.transparent-header.dark-header-skin .header-searchform-input input[type=text],
	.transparent-header.dark-header-skin .header-search-icon,
	.transparent-header.dark-header-skin .header-search-close,
	.transparent-header.dark-header-skin .header-search-icon:hover,
	.transparent-header.dark-header-skin .mk-cart-link,
	.transparent-header.dark-header-skin .mk-responsive-cart-link,
	.transparent-header.dark-header-skin .mk-header-social a,
	.transparent-header.dark-header-skin .mk-header-wpml-ls > a {
	  color: #444 !important;
	}
	.transparent-header.dark-header-skin .mk-burger-icon div {
	  background-color: #444;
	}
");
