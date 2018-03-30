<?php

global $mk_options;

Mk_Static_Files::addGlobalStyle("


@media handheld, only screen and (max-width: {$mk_options['grid_width']}px){
	
	.mk-grid,
	.mk-header-nav-container, 
	.mk-classic-menu-wrapper {
		width: 100%;
	}

	.mk-go-top,
	.mk-quick-contact-wrapper
	{
		bottom:20px !important;
	}

	.mk-padding-wrapper {
		padding: 0 20px;
	}
	.header-grid.mk-grid .header-logo.left-logo
	{
		left: 15px !important;
	}
	.header-grid.mk-grid .header-logo.right-logo, .mk-header-right {
		right: 15px !important;
	}

	.mk-photo-album {
	    margin-left: 0 !important;
	    margin-right: 0 !important;
	    width: 100% !important;
	 }
	 .mk-edge-slider .mk-grid {
	    padding: 0 20px;
	  }
}



@media handheld, only screen and (max-width: {$mk_options['content_responsive']}px){

	.theme-page-wrapper .theme-content
	{
		width: 100% !important;
		float: none !important;
	}


	.theme-page-wrapper
	{
		padding-right:15px !important;
		padding-left: 15px !important;
	}


	.theme-page-wrapper .theme-content:not(.no-padding)
	{
		padding:25px 0 !important;
	}


	.theme-page-wrapper #mk-sidebar
	{
		width: 100% !important;
		float: none !important;
		padding: 0 !important;

	}


	.theme-page-wrapper #mk-sidebar .sidebar-wrapper
	{
		padding:20px 0 !important;
	}

}

@media handheld, only screen and (max-width: {$mk_options['responsive_nav_width']}px){

	/* Logo should get responsive state when the whole navigation does */
	.logo-is-responsive .mk-desktop-logo,
	.logo-is-responsive .mk-sticky-logo {
		display: none !important;
	}
	.logo-is-responsive .mk-resposnive-logo {
		display: block !important;
	}

	.add-header-height,
	.header-style-1 .mk-header-inner,
	.header-style-3 .mk-header-inner,
	.header-style-3 .header-logo,
	.header-style-1 .header-logo,
	.header-style-1 .shopping-cart-header,
	.header-style-3 .shopping-cart-header{
		height: {$mk_options['res_header_height']}px!important;
		line-height: {$mk_options['res_header_height']}px;
	}

	.mk-header:not(.header-style-4) .mk-header-holder {
		position:relative !important;
		top:0 !important;
	}

	.mk-header-padding-wrapper {
		display:none !important;
	}

	.mk-header-nav-container
	{
		width: auto !important;
		display:none !important;
	}

	.header-style-1 .mk-header-right,
	.header-style-2 .mk-header-right,
	.header-style-3 .mk-header-right {
		right:55px !important;
	}

	.header-style-1 .mk-header-inner .mk-header-search,
	.header-style-2 .mk-header-inner .mk-header-search,
	.header-style-3 .mk-header-inner .mk-header-search
	{
		display:none !important;
	}

	.mk-fullscreen-search-overlay {
		display:none;
	}

	.mk-header-search
	{
		padding-bottom: 10px !important;
	}

	.mk-header-searchform span .text-input
	{
		width: 100% !important;
	}

	.header-style-2 .header-logo .center-logo
	{
	    text-align: right !important;
	}

	.header-style-2 .header-logo .center-logo a
	{
	    margin: 0 !important;
	}

	.header-logo,
	.header-style-4 .header-logo
	{
	    height: 90px !important;
	}

	.header-style-4 .shopping-cart-header {
		display:none;
	}

	.mk-header-inner
	{
		padding-top:0 !important;
	}

	.header-style-1 .header-logo,
	.header-style-2 .header-logo,
	.header-style-4 .header-logo
	{
		position:relative !important;
		right:auto !important;
		left:auto !important;
	}


	.shopping-cart-header
	{
		margin:0 20px 0 0 !important;
	}


	.mk-responsive-nav li ul li .megamenu-title:hover,
	.mk-responsive-nav li ul li .megamenu-title,
	.mk-responsive-nav li a, .mk-responsive-nav li ul li a:hover,
	.mk-responsive-nav .mk-nav-arrow
	{
  			color:{$mk_options['responsive_nav_txt_color']} !important;
	}

	.mk-mega-icon
	{
		display:none !important;
	}

	.mk-header-bg
	{
		zoom:1 !important;
		filter:alpha(opacity=100) !important;
		opacity:1 !important;
	}

	.header-style-1 .mk-nav-responsive-link,
	.header-style-2 .mk-nav-responsive-link,
	.logo-in-middle .header-logo
	{
		display:block !important;
	}
	.header-grid.mk-grid {
		position:initial !important;
	}

	.mk-header-nav-container
	{
		height:100%;
		z-index:200;
	}

	.mk-main-navigation
	{
		position:relative;
		z-index:2;
	}



	.header-style-4 .mk-header-inner {
		width: auto !important;
		position: relative !important;
		overflow: visible;
		padding-bottom: 0;
	}

	.admin-bar .header-style-4 .mk-header-inner {
		top:0 !important;
	}

	.header-style-4 .mk-header-right {
		display: none;
	}

	.header-style-4 .mk-nav-responsive-link {
		display: block !important;
	}

	.header-style-4 .mk-vm-menuwrapper,
	.header-style-4 .mk-header-search {
		display: none;
	}

	.header-style-4 .header-logo {
		width:auto !important;
		display: inline-block !important;
		text-align:left !important;
		margin:0 !important;
	}

	.vertical-header-enabled .header-style-4 .header-logo img {
			max-width: 100% !important;
			left: 20px!important;
			top:50%!important;
			-webkit-transform: translate(0, -50%)!important;
			-moz-transform: translate(0, -50%)!important;
			-ms-transform: translate(0, -50%)!important;
			-o-transform: translate(0, -50%)!important;
			transform: translate(0, -50%)!important;
			position:relative !important;
	}

	.vertical-header-enabled.vertical-header-left #theme-page > .mk-main-wrapper-holder,
	.vertical-header-enabled.vertical-header-center #theme-page > .mk-main-wrapper-holder,
	.vertical-header-enabled.vertical-header-left #theme-page > .mk-page-section-wrapper .mk-page-section,
	.vertical-header-enabled.vertical-header-center #theme-page > .mk-page-section-wrapper .mk-page-section,
	.vertical-header-enabled.vertical-header-left #theme-page > .wpb_row,
	.vertical-header-enabled.vertical-header-center #theme-page > .wpb_row,
	.vertical-header-enabled.vertical-header-left #mk-theme-container:not(.trans-header), 
	.vertical-header-enabled.vertical-header-center #mk-footer,
	.vertical-header-enabled.vertical-header-left #mk-footer,
	.vertical-header-enabled.vertical-header-center #mk-theme-container:not(.trans-header) {
	  padding-left: 0 !important;
	}

	.vertical-header-enabled.vertical-header-right #theme-page > .mk-main-wrapper-holder,
	.vertical-header-enabled.vertical-header-right #theme-page > .mk-page-section-wrapper .mk-page-section,
	.vertical-header-enabled.vertical-header-right #theme-page > .wpb_row,
	.vertical-header-enabled.vertical-header-right #mk-footer,
	.vertical-header-enabled.vertical-header-right #mk-theme-container:not(.trans-header) {
	  padding-right: 0 !important;
	}

	.header-style-1 .mk-dashboard-trigger,
	.header-style-2 .mk-dashboard-trigger {
		display:none;
	}

	.header-style-4 .mk-header-bg {
		height: 100% !important;
	}

}


@media handheld, only screen and (min-width: {$mk_options['responsive_nav_width']}px) {
		  
	  .trans-header .sticky-style-slide .mk-header-holder {
	    position: absolute;
	  }
	  .trans-header .bg-true:not(.a-sticky) .mk-header-bg {
	    opacity: 0;
	  }
	  .trans-header .bg-true.mk-header:not(.a-sticky) .mk-header-inner {
	    border: 0;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-desktop-logo.light-logo {
	    display: block !important;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-desktop-logo.dark-logo {
	    display: none !important;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .main-navigation-ul > li.menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-search-trigger,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-cart-count,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-start-tour,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li a,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li > a:after, 
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li.mk-vm-back:after {
	    color: #fff !important;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-social.header-section a svg,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .main-navigation-ul li.menu-item a.menu-item-link .mk-svg-icon,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-search-trigger .mk-svg-icon,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-shoping-cart-link .mk-svg-icon { 
	  	fill: #fff !important; 
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .mk-css-icon-menu div {
	    background-color: #fff !important;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link {
	    border-top-color: #fff;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a {
	    border: 2px solid #fff;
	    background-color: #fff;
	    color: #222 !important;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a {
	    border: 2px solid #fff;
	  }
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after {
	    background-color: #fff;
	    color: #222 !important;
	  }


	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-desktop-logo.dark-logo {
	    display: block !important;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-desktop-logo.light-logo {
	    display: none !important;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .main-navigation-ul > li.menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-search-trigger,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-cart-count,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-start-tour,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li a,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li > a:after, 
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li.mk-vm-back:after {
	    color: #222 !important;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-social.header-section a svg,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .main-navigation-ul li.menu-item a.menu-item-link .mk-svg-icon,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-search-trigger .mk-svg-icon,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-shoping-cart-link .mk-svg-icon { 
	  	fill: #222 !important; 
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link {
	    border-top-color: #222;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-css-icon-menu div {
	    background-color: #222 !important;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a {
	    border: 2px solid #222;
	    background-color: #222;
	    color: #fff !important;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a {
	    border: 2px solid #222;
	  }
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,
	  .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after {
	    background-color: #222;
	    color: #fff !important;
	  }
}

");