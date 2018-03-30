<?php

global $mk_settings;


$nav_text_align = (!empty($mk_settings['nav-alignment'])) ? ('text-align:' . $mk_settings['nav-alignment'] . ';') : ('text-align:left;');
$main_nav_font_family = (!empty($mk_settings['main-nav-font']['font-family'])) ? ('font-family:' . $mk_settings['main-nav-font']['font-family'] . ';') : '';


if($mk_settings['header-structure'] == 'vertical'){
	$main_nav_top_level_space = (!empty($mk_settings['main-nav-item-space']) && !empty($mk_settings['vertical-nav-item-space'])) ? ('padding:'. $mk_settings['vertical-nav-item-space'] . 'px ' . $mk_settings['main-nav-item-space'] . 'px;') : ('padding: 9px 15px;');
	$plus_for_submenu = $mk_settings['main-nav-item-space'] + 10;

	$main_nav_top_level_space_lr = !empty($mk_settings['main-nav-item-space']) ? ('padding: 0 '.$plus_for_submenu .'px ;') : ('padding: 0 15px;');
	$main_nav_top_level_space_bt = !empty($mk_settings['vertical-nav-item-space']) ? ('padding:'. $mk_settings['vertical-nav-item-space'] . 'px 0;') : ('padding: 9px 0;');
}else{
	$main_nav_top_level_space = !empty($mk_settings['main-nav-item-space']) ? ('padding: 0 ' . $mk_settings['main-nav-item-space'] . 'px;') : ('padding: auto 17px;');
}

$main_nav_top_level_font_size = 'font-size:' . $mk_settings['main-nav-font']['font-size'] . ';';
$main_nav_top_level_font_transform = (!empty($mk_settings['main-nav-top-transform'])) ? ('text-transform: ' . $mk_settings['main-nav-top-transform'] . ';') : ('text-transform: uppercase;');
$main_nav_top_level_font_weight = 'font-weight:' . $mk_settings['main-nav-font']['font-weight'] . ';';
$main_nav_sub_level_font_size = (!empty($mk_settings['sub-nav-top-size'])) ? ('font-size:' . $mk_settings['sub-nav-top-size'] . 'px;') : ('font-size:' . $mk_settings['main-nav-font']['font-size'] . 'px;');
$main_nav_sub_level_font_transform = (!empty($mk_settings['sub-nav-top-transform'])) ? ('text-transform: ' . $mk_settings['sub-nav-top-transform'] . ';') : ('text-transform: uppercase;');
$main_nav_sub_level_font_weight = (!empty($mk_settings['sub-nav-top-weight'])) ? ('font-weight:' . $mk_settings['sub-nav-top-weight'] . ';') : ('font-weight:' . $mk_settings['main-nav-font']['font-weight'] . ';');


$logo_height = (!empty($mk_settings['logo']['height'])) ? $mk_settings['logo']['height'] : 50;
$header_height = $logo_height+($mk_settings['header-padding'] * 2);

if (isset($mk_settings['squeeze-sticky-header']) && ($mk_settings['squeeze-sticky-header'])) {

	$sticky_logo_height = round($logo_height / 1.5);
	$sticky_header_padding = round($mk_settings['header-padding'] / 2.8);
	$header_sticky_height = round($logo_height / 1.5+(($mk_settings['header-padding'] / 2.4) * 2));

} else {

	$sticky_logo_height = $logo_height;
	$sticky_header_padding = $mk_settings['header-padding'];
	$header_sticky_height = round($logo_height+(($mk_settings['header-padding']) * 2));

}

$header_vertical_width = (!empty($mk_settings['header-vertical-width'])) ? $mk_settings['header-vertical-width'] : ('280');
$header_vertical_padding = (!empty($mk_settings['header-padding-vertical'])) ? $mk_settings['header-padding-vertical'] : ('30'); 
$vertical_nav_width = $header_vertical_width - ($header_vertical_padding * 2);


$toolbar_border = ($mk_settings['toolbar-border-top'] == 1) ? '' : 'border:none;';

$toolbar_font = (isset($mk_settings['toolbar-font']['font-family']) && !empty($mk_settings['toolbar-font']['font-family'])) ? ('font-family:' . $mk_settings['toolbar-font']['font-family'] . ';') : '';
$toolbar_font .= (isset($mk_settings['toolbar-font']['font-weight']) && !empty($mk_settings['toolbar-font']['font-weight'])) ? ('font-weight:' . $mk_settings['toolbar-font']['font-weight'] . ';') : '';
$toolbar_font .= (isset($mk_settings['toolbar-font']['font-size']) && !empty($mk_settings['toolbar-font']['font-size'])) ? ('font-size:' . $mk_settings['toolbar-font']['font-size'] . ';') : '';



Mk_Static_Files::addGlobalStyle("

	.mk-header-toolbar{
		{$toolbar_font};
	}

	.header-searchform-input input[type=text]{
		background-color:{$mk_settings['header-bg']['color']};
	}

	.bottom-header-padding.none-sticky-header {
		padding-top:{$header_height}px;	
	}

	.bottom-header-padding.none-sticky-header {
		padding-top:{$header_height}px;	
	}

	.bottom-header-padding.sticky-header {
		padding-top:{$header_sticky_height}px;	
	}


	#mk-header:not(.header-structure-vertical) #mk-main-navigation > ul > li.menu-item,
	#mk-header:not(.header-structure-vertical) #mk-main-navigation > ul > li.menu-item > a,
	#mk-header:not(.header-structure-vertical) .mk-header-search,
	#mk-header:not(.header-structure-vertical) .mk-header-search a,
	#mk-header:not(.header-structure-vertical) .mk-header-wpml-ls,
	#mk-header:not(.header-structure-vertical) .mk-header-wpml-ls > a,
	#mk-header:not(.header-structure-vertical) .mk-cart-link,
	#mk-header:not(.header-structure-vertical) .mk-responsive-cart-link,
	#mk-header:not(.header-structure-vertical) .dashboard-trigger,
	#mk-header:not(.header-structure-vertical) .responsive-nav-link,
	#mk-header:not(.header-structure-vertical) .mk-header-social a,
	#mk-header:not(.header-structure-vertical) .mk-margin-header-burger
	{
		height:{$header_height}px;
		line-height:{$header_height}px;
	}

	@media handheld, only screen and (max-width: {$mk_settings['res-nav-width']}px){
		#mk-header .responsive-nav-link,
		#mk-header .mk-responsive-shopping-cart {
			height:{$header_height}px;
			line-height:{$header_height}px;
		}
	}

	#mk-header:not(.header-structure-vertical).sticky-trigger-header #mk-main-navigation > ul > li.menu-item,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header #mk-main-navigation > ul > li.menu-item > a,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-search,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-search a,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-cart-link,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-responsive-cart-link,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .dashboard-trigger,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .responsive-nav-link,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-social a,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-margin-header-burger,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-wpml-ls,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-wpml-ls > a
	{
		height:{$header_sticky_height}px;
		line-height:{$header_sticky_height}px;
	}
");



if (isset($mk_settings['squeeze-sticky-header']) && ($mk_settings['squeeze-sticky-header'])) {
	Mk_Static_Files::addGlobalStyle("
		#mk-header:not(.header-structure-vertical).sticky-trigger-header #mk-main-navigation > ul > li.menu-item > a {
			padding-left:15px;
			padding-right:15px;
		}
	");
}

Mk_Static_Files::addGlobalStyle("
	.mk-header-logo,
	.mk-header-logo a{
		height:{$logo_height}px;
		line-height:{$logo_height}px;
	}

	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-logo,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-logo a{
		height:{$sticky_logo_height}px;
		line-height:{$sticky_logo_height}px;
	}

	.vertical-expanded-state #mk-header.header-structure-vertical,
	.vertical-condensed-state  #mk-header.header-structure-vertical:hover{
		width: {$header_vertical_width}px !important;
	}

	#mk-header.header-structure-vertical{
		padding-left: {$header_vertical_padding}px !important;
		padding-right: {$header_vertical_padding}px !important;
	}

	.vertical-condensed-state .mk-vertical-menu {
	  width:{$vertical_nav_width}px;
	}



	.vertical-header-align-left.vertical-expanded-state #theme-page > .mk-main-wrapper-holder,
	.vertical-header-align-left.vertical-expanded-state #theme-page > .mk-page-section,
	.vertical-header-align-left.vertical-expanded-state #theme-page > .wpb_row,
	.vertical-header-align-left.vertical-expanded-state #mk-page-title,
	.vertical-header-align-left.vertical-expanded-state #mk-footer {
		padding-left: {$header_vertical_width}px;
	}
	.vertical-header-align-right.vertical-expanded-state #theme-page > .mk-main-wrapper-holder,
	.vertical-header-align-right.vertical-expanded-state #theme-page > .mk-page-section,
	.vertical-header-align-right.vertical-expanded-state #theme-page > .wpb_row,
	.vertical-header-align-right.vertical-expanded-state #mk-page-title,
	.vertical-header-align-right.vertical-expanded-state #mk-footer {
		padding-right: {$header_vertical_width}px;
	}

	@media handheld, only screen and (max-width:{$mk_settings['res-nav-width']}px) {
		.theme-main-wrapper.vertical-expanded-state #theme-page > .mk-main-wrapper-holder,
		.theme-main-wrapper.vertical-expanded-state #theme-page > .mk-page-section,
		.theme-main-wrapper.vertical-expanded-state #theme-page > .wpb_row,
		.theme-main-wrapper.vertical-expanded-state #mk-page-title,
		.theme-main-wrapper.vertical-expanded-state #mk-footer,
		.theme-main-wrapper.vertical-condensed-state #theme-page > .mk-main-wrapper-holder,
		.theme-main-wrapper.vertical-condensed-state #theme-page > .mk-page-section,
		.theme-main-wrapper.vertical-condensed-state #theme-page > .wpb_row,
		.theme-main-wrapper.vertical-condensed-state #mk-page-title,
		.theme-main-wrapper.vertical-condensed-state #mk-footer {
			padding-left:0;
			padding-right:0;
		}
	}

	.theme-main-wrapper.vertical-header #mk-page-title,
	.theme-main-wrapper.vertical-header #mk-footer,
	.theme-main-wrapper.vertical-header #mk-header,
	.theme-main-wrapper.vertical-header #mk-header.header-structure-vertical .mk-vertical-menu{
		box-sizing: border-box;
	}


	.mk-header-logo,
	.mk-header-logo a
	 {
		margin-top: {$mk_settings['header-padding']}px;
		margin-bottom: {$mk_settings['header-padding']}px;
	}


	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-logo,
	#mk-header:not(.header-structure-vertical).sticky-trigger-header .mk-header-logo a
	{
		margin-top:{$sticky_header_padding}px;
		margin-bottom: {$sticky_header_padding}px;
	}


	#mk-main-navigation > ul > li.menu-item > a {
		{$main_nav_top_level_space}
		{$main_nav_font_family}
		{$main_nav_top_level_font_size}
		{$main_nav_top_level_font_transform}
		{$main_nav_top_level_font_weight}
	}

	.mk-header-logo.mk-header-logo-center {
		{$main_nav_top_level_space}
	}

	.mk-vertical-menu > li.menu-item > a {
		{$main_nav_top_level_space}
		{$main_nav_font_family}
		{$main_nav_top_level_font_size}
		{$main_nav_top_level_font_transform}
		{$main_nav_top_level_font_weight}
	}
");









if ($mk_settings['header-structure'] == 'vertical') {
	Mk_Static_Files::addGlobalStyle("
		.header-structure-vertical .mk-vertical-menu > .menu-item > .sub-menu {
			{$main_nav_top_level_space_lr}
		}
	");
}








Mk_Static_Files::addGlobalStyle("

	.mk-vertical-menu li.menu-item > a,
	.mk-vertical-menu .mk-header-logo {
		{$nav_text_align} 
	}

	.main-navigation-ul > li ul.sub-menu li.menu-item a.menu-item-link{
		{$main_nav_sub_level_font_size}
		{$main_nav_sub_level_font_transform}
		{$main_nav_sub_level_font_weight}
	}

	.mk-vertical-menu > li ul.sub-menu li.menu-item a{
		{$main_nav_sub_level_font_size}
		{$main_nav_sub_level_font_transform}
		{$main_nav_sub_level_font_weight}
	}

	#mk-main-navigation > ul > li.menu-item > a,
	.mk-vertical-menu li.menu-item > a
	{
		color:{$mk_settings['main-nav-top-color']['regular']};
		background-color:{$mk_settings['main-nav-top-color']['bg']};
	}

	#mk-main-navigation > ul > li.current-menu-item > a,
	#mk-main-navigation > ul > li.current-menu-ancestor > a,
	#mk-main-navigation > ul > li.menu-item:hover > a
	{
		color:{$mk_settings['main-nav-top-color']['hover']};
		background-color:{$mk_settings['main-nav-top-color']['bg-hover']};
	}

	.mk-vertical-menu > li.current-menu-item > a,
	.mk-vertical-menu > li.current-menu-ancestor > a,
	.mk-vertical-menu > li.menu-item:hover > a,
	.mk-vertical-menu ul li.menu-item:hover > a {
		color:{$mk_settings['main-nav-top-color']['hover']};
	}

	#mk-main-navigation > ul > li.menu-item > a:hover
	{
		color:{$mk_settings['main-nav-top-color']['hover']};
		background-color:{$mk_settings['main-nav-top-color']['bg-hover']};
	}

	.dashboard-trigger,
	.res-nav-active,
	.mk-header-social a,
	.mk-responsive-cart-link {
		color:{$mk_settings['main-nav-top-color']['regular']};
	}

	.dashboard-trigger:hover,
	.res-nav-active:hover {
		color:{$mk_settings['main-nav-top-color']['hover']};
	}
");







if ($mk_settings['navigation-border-top'] == 1) {
		Mk_Static_Files::addGlobalStyle("
			#mk-main-navigation ul li.no-mega-menu > ul,
			#mk-main-navigation ul li.has-mega-menu > ul,
			#mk-main-navigation ul li.mk-header-wpml-ls > ul{
				border-top:1px solid {$mk_settings['accent-color']};
			}
		");
}








Mk_Static_Files::addGlobalStyle("
	#mk-main-navigation ul li.no-mega-menu ul,
	#mk-main-navigation > ul > li.has-mega-menu > ul,
	.header-searchform-input .ui-autocomplete,
	.mk-shopping-box,
	.shopping-box-header > span,
	#mk-main-navigation ul li.mk-header-wpml-ls > ul {
		background-color:{$mk_settings['main-nav-sub-bg']};
	}

	#mk-main-navigation ul ul.sub-menu a.menu-item-link,
	#mk-main-navigation ul li.mk-header-wpml-ls > ul li a
	{
		color:{$mk_settings['main-nav-sub-color']['regular']};
	}

	#mk-main-navigation ul ul li.current-menu-item > a.menu-item-link,
	#mk-main-navigation ul ul li.current-menu-ancestor > a.menu-item-link {
		color:{$mk_settings['main-nav-sub-color']['hover']};
		background-color:{$mk_settings['main-nav-sub-color']['bg-hover']} !important;
	}


	.header-searchform-input .ui-autocomplete .search-title,
	.header-searchform-input .ui-autocomplete .search-date,
	.header-searchform-input .ui-autocomplete i
	{
		color:{$mk_settings['main-nav-sub-color']['regular']};
	}
	.header-searchform-input .ui-autocomplete i,
	.header-searchform-input .ui-autocomplete img
	{
		border-color:{$mk_settings['main-nav-sub-color']['regular']};
	}

	.header-searchform-input .ui-autocomplete li:hover  i,
	.header-searchform-input .ui-autocomplete li:hover img
	{
		border-color:{$mk_settings['main-nav-sub-color']['hover']};
	}


	#mk-main-navigation .megamenu-title,
	.mk-mega-icon,
	.mk-shopping-box .mini-cart-title,
	.mk-shopping-box .mini-cart-button {
		color:{$mk_settings['main-nav-sub-color']['regular']};
	}

	#mk-main-navigation ul ul.sub-menu a.menu-item-link:hover,
	.header-searchform-input .ui-autocomplete li:hover,
	#mk-main-navigation ul li.mk-header-wpml-ls > ul li a:hover
	{
		color:{$mk_settings['main-nav-sub-color']['hover']};
		background-color:{$mk_settings['main-nav-sub-color']['bg-hover']} !important;
	}

	.header-searchform-input .ui-autocomplete li:hover .search-title,
	.header-searchform-input .ui-autocomplete li:hover .search-date,
	.header-searchform-input .ui-autocomplete li:hover i,
	#mk-main-navigation ul ul.sub-menu a.menu-item-link:hover i
	{
		color:{$mk_settings['main-nav-sub-color']['hover']};
	}


	.header-searchform-input input[type=text],
	.dashboard-trigger,
	.header-search-icon,
	.header-search-close,
	.header-wpml-icon
	{
		color:{$mk_settings['main-nav-top-color']['regular']};
	}
");









$header_search_icon_color = (!empty($mk_settings['header-search-icon-color'])) ? $mk_settings['header-search-icon-color'] : $mk_settings['main-nav-top-color']['regular'];

Mk_Static_Files::addGlobalStyle("
	.header-search-icon {
		color:{$header_search_icon_color};	
	}

	.mk-burger-icon div {
	      background-color:{$mk_settings['main-nav-top-color']['regular']};
	 }



	.header-search-icon:hover
	{
		color: {$mk_settings['main-nav-top-color']['regular']};
	}


	.responsive-nav-container, .responsive-shopping-box
	{
		background-color:{$mk_settings['main-nav-sub-bg']};
	}

	.mk-responsive-nav a,
	.mk-responsive-nav .has-mega-menu .megamenu-title
	{
		color:{$mk_settings['main-nav-sub-color']['regular']};
		background-color:{$mk_settings['main-nav-sub-color']['bg']};
	}

	.mk-responsive-nav li a:hover
	{
		color:{$mk_settings['main-nav-sub-color']['hover']};
		background-color:{$mk_settings['main-nav-sub-color']['bg-hover']};
	}
");






$header_border_bottom_color = (!empty($mk_settings['toolbar-border-bottom-color'])) ? $mk_settings['toolbar-border-bottom-color'] : 'transparent';
$header_phone_email_icon_color = (!empty($mk_settings['toolbar-phone-email-icon-color'])) ? $mk_settings['toolbar-phone-email-icon-color'] : $mk_settings['toolbar-text-color'];

Mk_Static_Files::addGlobalStyle("
	.mk-header-toolbar {
		{$toolbar_border}	
		
		border-color:{$header_border_bottom_color};
	}
	.mk-header-toolbar span {
		color:{$mk_settings['toolbar-text-color']};	
	}

	.mk-header-toolbar span i {
		color:{$header_phone_email_icon_color};	
	}

	.mk-header-toolbar a{
		color:{$mk_settings['toolbar-link-color']['regular']};	
	}
	.mk-header-toolbar a:hover{
		color:{$mk_settings['toolbar-link-color']['hover']};	
	}

	.mk-header-toolbar a{
		color:{$mk_settings['toolbar-link-color']['regular']};	
	}
	.mk-header-toolbar .mk-header-toolbar-social li a{
		color:{$mk_settings['toolbar-social-link-color']['regular']};	
	}
	.mk-header-toolbar .mk-header-toolbar-social li a:hover{
		color:{$mk_settings['toolbar-social-link-color']['hover']};	
	}
");