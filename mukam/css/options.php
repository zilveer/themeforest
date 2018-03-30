<?php
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
  $theme_options = get_option('option_tree');
}

$all_css = $parallax_back = $keys = "";

$parallax_back = get_option_tree('parallaxback',$theme_options);
if( $parallax_back !="" ) {
	$all_css = $all_css . ".parallax-homepage {background: url({$parallax_back}); position: relative; background-repeat: no-repeat; background-attachment: fixed; width: 100%; display: table;}";
}

if ( !empty ($theme_options['h_tags'])) {
	$keys=$theme_options['h_tags'];
	if(!empty($keys['font-family'])) {
		$all_css = $all_css . "@import url(http://fonts.googleapis.com/css?family={$keys['font-family']}:normal);";
		$all_css = $all_css . "h1, h2, h3, h4, h5, h6 {
				font-family:'{$keys['font-family']}';}";
		}
	}
if ( !empty ($theme_options['main_font'])) {
		$keys=$theme_options['main_font'];
		if(!empty($keys['font-family'])) {
          $all_css = $all_css . "@import url(http://fonts.googleapis.com/css?family={$keys['font-family']}:normal);";
          $all_css = $all_css . "body {
            font-family:'{$keys['font-family']}';}";
        }
    }

if ( !empty ($theme_options['header_menu'])) {
		$keys=$theme_options['header_menu'];
		$fontfamily = $fontweight = $fontsize = $fontstyle = $textdecoration  = $fontsize = $texttransform = "";
		
		if(!empty($keys['font-weight'])) {
			$fontweight="font-weight:{$keys['font-weight']};";
		}
		if(!empty($keys['font-variant'])) {

			$fontvariant="font-variant:{$keys['font-variant']};";
		}
		if(!empty($keys['font-size'])) {
			
			$fontsize="font-size:{$keys['font-size']};";
		}
		if(!empty($keys['font-style'])) {
			
			$fontstyle="font-style:{$keys['font-style']};";
		}
		if(!empty($keys['text-decoration'])) {
			
			$textdecoration="text-decoration:{$keys['text-decoration']};";
		}
		if(!empty($keys['text-transform'])) {
			
			$texttransform="text-transform:{$keys['text-transform']};";
		}
		if(!empty($keys['font-family'])) {
			$all_css = $all_css . "@import url(http://fonts.googleapis.com/css?family={$keys['font-family']}:normal);";
			$all_css = $all_css . ".mukam-header-small, .mukam-header-large {
				font-family:'{$keys['font-family']}'; {$fontweight} {$fontsize} {$fontstyle} {$textdecoration} {$fontvariant} {$texttransform} }";
		}		
	
}

if ( !empty ($theme_options['custom_asset_color']) ) {
		$all_css = $all_css . " 
	@media (max-width: 767px) {
	.navbar-default .navbar-nav .open .dropdown-menu>li>a:hover, .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus {
	color: #fff;
	background-color: {$theme_options['custom_asset_color']};
	}
}
.asset-bg {background: {$theme_options['custom_asset_color']};}
.asset-bg .call-to-action a{color: {$theme_options['custom_asset_color']};}

.blog-wrapper .blog-categories ul li a:hover {
color: {$theme_options['custom_asset_color']};
}

.menu-widget h4, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {background-color: {$theme_options['custom_asset_color']};}
.menu-widget .active{}
.menu-widget ul li:hover {border-left: 3px solid {$theme_options['custom_asset_color']};color: {$theme_options['custom_asset_color']};}
.menu-widget .active {color: {$theme_options['custom_asset_color']} !important;border-left: 3px solid {$theme_options['custom_asset_color']} !important;}
.overthumb {background: {$theme_options['custom_asset_color']};}
a, a:hover {color: {$theme_options['custom_asset_color']};}
span {color: {$theme_options['custom_asset_color']};}

.header-5 .search-widget .social-box { background: {$theme_options['custom_asset_color']};} 
.menu-widget ul li:hover  {border-left: 3px solid {$theme_options['custom_asset_color']};color: {$theme_options['custom_asset_color']};}
.menu-widget .active  {color: {$theme_options['custom_asset_color']} !important;border-left: 3px solid {$theme_options['custom_asset_color']} !important;}
.list-none i { color:{$theme_options['custom_asset_color']};}
.tour-section .nav-tabs>li {border-right: 8px solid {$theme_options['custom_asset_color']};}
.tour-section .nav-tabs>li.active>a, .tour-section .nav-tabs>li.active>a:hover, .tour-section  .nav-tabs>li.active>a:focus {background: {$theme_options['custom_asset_color']};}
.tour-section .nav-tabs>li>a:hover, .tour-section .nav>li>a:focus { background:{$theme_options['custom_asset_color']};}
.tour-section-2 .nav-tabs>li.active>a, .tour-section-2 .nav-tabs>li.active>a:hover, .tour-section-2  .nav-tabs>li.active>a:focus, .tour-section-2 .nav-tabs>li>a:hover, .tour-section-2 .nav>li>a:focus  {color: {$theme_options['custom_asset_color']};}
.tabs-featured .nav-tabs>li.active>a, .tabs-featured .nav-tabs>li.active>a:hover, .tabs-featured  .nav-tabs>li.active>a:focus {color: {$theme_options['custom_asset_color']};}
.tabs-classic .nav-tabs>li.active>a, .tabs-classic .nav-tabs>li.active>a:hover, .tabs-classic .nav-tabs>li.active>a:focus, .tabs-classic .nav-tabs>li>a:hover {color: {$theme_options['custom_asset_color']};}
.tabs-featured .nav-tabs>li>a:hover { color: {$theme_options['custom_asset_color']};}
.accordion .panel-default>.panel-heading:hover {background: {$theme_options['custom_asset_color']};}
.accordion .panel-default>.panel-heading i{color:{$theme_options['custom_asset_color']};}
.hex .inner{color: {$theme_options['custom_asset_color']};}
.hex a {border-left: 2px solid {$theme_options['custom_asset_color']};border-right: 2px solid {$theme_options['custom_asset_color']};}
.hex .corner-1, .hex .corner-2 {border-left: 2px solid {$theme_options['custom_asset_color']};border-right: 2px solid {$theme_options['custom_asset_color']};}
.progressicon .progress-bar{background-color: {$theme_options['custom_asset_color']};}
.toggle {
	background:url(../img/toggleplus.png) no-repeat 12px 15px, -moz-linear-gradient(left, {$theme_options['custom_asset_color']} , {$theme_options['custom_asset_color']} 37px, #434343 37px);
	background:url(../img/toggleplus.png) no-repeat 12px 15px, -webkit-linear-gradient(left, {$theme_options['custom_asset_color']} , {$theme_options['custom_asset_color']} 37px, #434343 37px);
	background:url(../img/toggleplus.png) no-repeat 12px 15px, -o-linear-gradient(left, {$theme_options['custom_asset_color']} , {$theme_options['custom_asset_color']} 37px, #434343 37px);
	background:url(../img/toggleplus.png) no-repeat 12px 15px, linear-gradient(left, {$theme_options['custom_asset_color']} , {$theme_options['custom_asset_color']} 37px, #434343 37px);
}
.toggle.title-active {
	background:url(../img/toggleminus.png) no-repeat 12px 15px, -moz-linear-gradient(left, #434343 , #434343 37px, {$theme_options['custom_asset_color']} 37px);
	background:url(../img/toggleminus.png) no-repeat 12px 15px, -webkit-linear-gradient(left, #434343 , #434343 37px, {$theme_options['custom_asset_color']} 37px);
	background:url(../img/toggleminus.png) no-repeat 12px 15px, -o-linear-gradient(left, #434343 , #434343 37px, {$theme_options['custom_asset_color']} 37px);
	background:url(../img/toggleminus.png) no-repeat 12px 15px, linear-gradient(left, #434343 , #434343 37px, {$theme_options['custom_asset_color']} 37px);
}
.services-1:hover {background: {$theme_options['custom_asset_color']};}
.services-1:hover .holder {color: {$theme_options['custom_asset_color']};}
.services-2:hover .holder {background: {$theme_options['custom_asset_color']};}
.services-3:hover h4 { color: {$theme_options['custom_asset_color']}; }
.services-3:hover .holder { background: {$theme_options['custom_asset_color']}; }
.services-3:hover .caret { border-top: 12px solid {$theme_options['custom_asset_color']}; }
.services-3:hover .b_inherit { background: {$theme_options['custom_asset_color']};}
.services-4 .holder{background: {$theme_options['custom_asset_color']};}
.services-5:hover .holder {color: {$theme_options['custom_asset_color']};border: 6px double {$theme_options['custom_asset_color']};}
.mukam-team .team-social a:hover .team-holder {color: {$theme_options['custom_asset_color']}; border-color: {$theme_options['custom_asset_color']};}
.mukam-table .back-inherit { background: {$theme_options['custom_asset_color']}; }
.mukam-table .b_inherit { background: {$theme_options['custom_asset_color']};}
.carousel-container li:hover .latest-item  {-webkit-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};-moz-box-shadow:    0px 7px 0px {$theme_options['custom_asset_color']};box-shadow:         0px 7px 0px {$theme_options['custom_asset_color']};}
.happyclients-2-inner {background: {$theme_options['custom_asset_color']};}
.subscribe-widget .button {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-title a:hover { color: {$theme_options['custom_asset_color']}; }
.blog-wrapper .blog-type-logo {border-bottom: 5px solid {$theme_options['custom_asset_color']};}
.blog-wrapper .half-round {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .b_inherit {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .social-widget a:hover .socialbox {background: {$theme_options['custom_asset_color']};}
.sidebar-widget h3 { color: {$theme_options['custom_asset_color']};}
.sidebar-widget .popular-post h6 a:hover {color: {$theme_options['custom_asset_color']};}
.sidebar-widget .popular-post .popular-author a:hover { color: {$theme_options['custom_asset_color']}; }
.sidebar-widget ul li a:hover i {color: {$theme_options['custom_asset_color']};}
.sidebar-widget ul li a:hover { color: {$theme_options['custom_asset_color']}; }
.sidebar-widget .mukam-tag-cloud ul li:hover a { border: 1px solid {$theme_options['custom_asset_color']}; color: {$theme_options['custom_asset_color']}; }
.sidebar-widget .subscribe-mini .b_inherit {background: {$theme_options['custom_asset_color']};}
.portfolio-style-1-filter ul li.active { color:{$theme_options['custom_asset_color']};}
.portfolio-style-1-filter ul li:hover { color: {$theme_options['custom_asset_color']};}
.portfolio-style-1 .portfolio-content {border-bottom: 4px solid {$theme_options['custom_asset_color']};}
.portfolio-style-1 .portfolio-meta:hover .holder { background: {$theme_options['custom_asset_color']}; }
.portfolio-style-1 .portfolio-meta:hover .project-meta, .project-meta a:hover { color: {$theme_options['custom_asset_color']}; }
.portfolio-style-3 .portfolio-item-3:hover {-webkit-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};-moz-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};}
.footer-widget .mukam-tag-cloud ul li:hover a { background: {$theme_options['custom_asset_color']};}
.footer-widget .social-widget a:hover .socialbox{border-color:{$theme_options['custom_asset_color']};}
.footer-widget .social-widget a:hover .socialbox i{color: {$theme_options['custom_asset_color']};}
.facts{background: {$theme_options['custom_asset_color']};}
.timer-icon {color:{$theme_options['custom_asset_color']};}
.b_asset{background: {$theme_options['custom_asset_color']};}
.ourclients .flex-control-paging li a.flex-active {background: {$theme_options['custom_asset_color']};}
.bottom-section {background: {$theme_options['custom_asset_color']};}

.menu1-c:hover,.menu1-c:active{color: {$theme_options['custom_asset_color']};}
.menu1-c:hover:after,
.menu1-c:active:after {border-bottom: 4px solid {$theme_options['custom_asset_color']};}

.header-1 .top-section {background: {$theme_options['custom_asset_color']};}
.header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-1 .navbar-default .navbar-nav>.open>a, .header-1 .navbar-default .navbar-nav>.open>a:hover, .header-1 .navbar-default .navbar-nav>.open>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-1 .navbar-default .navbar-nav>li>a:hover, .header-1 .navbar-default .navbar-nav>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-1 .dropdown-menu>li>a:hover, .header-1 .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-1 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-1 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}


.header-4 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-4 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a {color: {$theme_options['custom_asset_color']};}
.header-4 .navbar-nav>li.firstitem.current-menu-item, .header-4 .navbar-nav>li.firstitem.current-menu-parent {color: {$theme_options['custom_asset_color']}; border-bottom: 4px solid {$theme_options['custom_asset_color']}; }
.header-4 .navbar-nav>li.firstitem.current-menu-item:hover, .header-4 .navbar-nav>li.firstitem.current-menu-parent:hover  {color: {$theme_options['custom_asset_color']};}
.header-4 .navbar-default .navbar-nav>.open>a:hover, .header-4 .navbar-default .navbar-nav>li>a:hover, .header-4 .navbar-default .navbar-nav>.open>a {color:{$theme_options['custom_asset_color']};  }
.header-4 .dropdown-menu>li>a:hover,.header-4 .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-4 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-4 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}
.menu1-c:hover,
.menu1-c:active{
  color: {$theme_options['custom_asset_color']};
}
.menu1-c:hover:after,
.menu1-c:active:after {
  border-bottom: 4px solid {$theme_options['custom_asset_color']};
}


.header-3 .navbar-default .navbar-nav>.firstitem.current-menu-item>a { color: {$theme_options['custom_asset_color']};}
.header-3 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a { color: {$theme_options['custom_asset_color']};}
.header-3 .navbar-default .navbar-nav>li>a:hover, .header-3 .navbar-default .navbar-nav>.open>a:hover, .header-3 .navbar-default .navbar-nav>.open>a   {color: {$theme_options['custom_asset_color']}; }
.header-3 .dropdown-menu>li>a:hover, .header-3 .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-3 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-3 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}


.header-2 .top-section {background: {$theme_options['custom_asset_color']};border-bottom: none;display:inherit;}
.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.open>a:hover {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>li>a:hover {background-color: {$theme_options['custom_asset_color']};}
.header-2 .dropdown-menu>li>a:hover {background-color: {$theme_options['custom_asset_color']};}
.header-2 .dropdown-menu{border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-2 .multimenu-green ul li:hover {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.open>a{background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}


.header-5 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-5  .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-5 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-5 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-5  .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-5 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-5 .navbar-default .navbar-nav>.open>a, .header-5  .navbar-default .navbar-nav>.open>a:hover, .header-5  .navbar-default .navbar-nav>.open>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-5 .navbar-default .navbar-nav>li>a:hover, .header-5 .navbar-default .navbar-nav>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-5 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-5 .dropdown-menu>li>a:hover, .header-5 .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-5 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}
.header-5 .top-section {background: {$theme_options['custom_asset_color']};}
.header-5 .social a:hover .social-box {color:{$theme_options['custom_asset_color']};}

header.header-6 {background:{$theme_options['custom_asset_color']};}
.header-6 .navbar-default {background-color:{$theme_options['custom_asset_color']};}
.header-6 span {color: {$theme_options['custom_asset_color']};}
.header-6 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-6 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-6 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-6 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-6 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-6 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-6 .navbar-default .navbar-nav>.open>a, .header-6 .navbar-default .navbar-nav>.open>a:hover, .header-6 .navbar-default .navbar-nav>.open>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-6 .dropdown-menu>li>a:hover,.header-6  .dropdown-menu>li>a:focus {color:#fff;background-color: {$theme_options['custom_asset_color']};}
.header-6 .navbar-default .navbar-nav>li>a:hover, .header-6 .navbar-default .navbar-nav>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-6 .navbar .shopping-cart {background: {$theme_options['custom_asset_color']};}
.header-6 .navbar a:hover .shopping-cart {color: {$theme_options['custom_asset_color']};}
.header-6 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-6 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}


.header-7 .top-section {background: {$theme_options['custom_asset_color']};}
.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-item>a,.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover,.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {color: {$theme_options['custom_asset_color']};}
.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a,.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover,.header-7 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {color: {$theme_options['custom_asset_color']};}
.header-7 .navbar-default .navbar-nav>.open>a,.header-7 .navbar-default .navbar-nav>.open>a:hover,.header-7 .navbar-default .navbar-nav>.open>a:focus {color: {$theme_options['custom_asset_color']};}
.header-7 .dropdown-menu>li>a:hover, .header-7 .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-7 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-7 .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}
.header-7 .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {color:{$theme_options['custom_asset_color']};}
.header-7 .social a:hover .social-box {color: {$theme_options['custom_asset_color']};}
.header-7 a:hover i{color:{$theme_options['custom_asset_color']};}
.header-7 .navbar-default a:hover .entypo-dot, .header-7 .navbar-default .navbar-nav>.firstitem.current-menu-item>a .entypo-dot, .header-7 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a .entypo-dot{color:{$theme_options['custom_asset_color']};}

.shopheader .shopnav a:hover{ color: {$theme_options['custom_asset_color']}; }
.shopheader .shopping-cart {background: {$theme_options['custom_asset_color']};}
.shopheader .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .shopheader .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .shopheader .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.shopheader .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .shopheader .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .shopheader .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}
.shopheader .navbar-default .navbar-nav>.open>a, .shopheader .navbar-default .navbar-nav>.open>a:hover, .shopheader .navbar-default .navbar-nav>.open>a:focus {background-color: {$theme_options['custom_asset_color']};}
.shopheader .navbar-default .navbar-nav>li>a:hover, .shopheader .navbar-default .navbar-nav>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.shopheader .dropdown-menu>li>a:hover,.shopheader .dropdown-menu>li>a:focus {background-color: {$theme_options['custom_asset_color']};}
.shopheader .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.shopheader .multimenu-green ul li:hover {background: {$theme_options['custom_asset_color']};}
.top-section-container .showhide {
border-top: 7px solid #6c9841;
background: url(".get_template_directory_uri()."/img/showhide-3.png) no-repeat top right;
}

.blog-wrapper .blog-title a:hover { color: {$theme_options['custom_asset_color']}; }
.blog-wrapper .half-round {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-type-logo {border-bottom: 5px solid {$theme_options['custom_asset_color']};}
.blog-wrapper .b_inherit {background: {$theme_options['custom_asset_color']};}

.tabs-featured-slider .nav-tabs>li.active>a, .tabs-featured-slider .nav-tabs>li.active>a:hover, .tabs-featured-slider .nav-tabs>li.active>a:focus {border-top: 5px solid {$theme_options['custom_asset_color']};}
.tabs-featured-slider .nav-tabs>li>a:hover {border-top: 5px solid {$theme_options['custom_asset_color']};}
.tabs-featured-slider .nav-tabs>li.active .slide-number  { background: {$theme_options['custom_asset_color']}; }
.html_carousel div.slide .blog-date {background: {$theme_options['custom_asset_color']};}
.html_carousel .nextprev .slidebox:hover {background: {$theme_options['custom_asset_color']};}

.latestproduct-item .product-price p {color:{$theme_options['custom_asset_color']};}
.featuredproduct-item .product-price p {color:{$theme_options['custom_asset_color']};}
.product-single-content .b_inherit {background: {$theme_options['custom_asset_color']};}
.cart-shipping .b_inherit {background: {$theme_options['custom_asset_color']};}
.b_inherit {background: {$theme_options['custom_asset_color']};}
.parallax-homepage .flex-control-paging li a.flex-active {
background: {$theme_options['custom_asset_color']};
}

.pagination>.active>a,
.pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {
  background: {$theme_options['custom_asset_color']};
  border-color: {$theme_options['custom_asset_color']};
}

#wp-calendar tbody td a{color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #next { color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #prev { color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #next a{color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #prev a{color: {$theme_options['custom_asset_color']};}

.widget_nav_menu h2, .menu-widget h4 {
	background-color: {$theme_options['custom_asset_color']};
}

.widget_nav_menu ul li:hover, .menu-widget ul li:hover {
    color: {$theme_options['custom_asset_color']};
    border-left: 3px solid {$theme_options['custom_asset_color']};
}

.widget_nav_menu .current-menu-item, .menu-widget .active {
  color: {$theme_options['custom_asset_color']} !important;
  border-left: 3px solid {$theme_options['custom_asset_color']} !important;
}

.custom-categories ul li.active a { color: {$theme_options['custom_asset_color']}; border-bottom:0; }
.custom-categories ul li a:hover { color: {$theme_options['custom_asset_color']}; border-bottom: 0; }

.woocommerce-message {
border-top: 3px solid {$theme_options['custom_asset_color']} !important;
}

.woocommerce-message:before {
background-color: {$theme_options['custom_asset_color']} !important;
}

.woocommerce-message a.button { 
background: {$theme_options['custom_asset_color']} !important;
}

.wpb_accordion_section i {
color: {$theme_options['custom_asset_color']};
}

/* Toogle */
.wpb_toggle, #content h4.wpb_toggle {
	cursor: pointer; font-size: 14px; font-family: 'Source Sans Pro'; font-weight: 400; clear: both; color: #fff; line-height: 42px; padding-left: 51px; margin-bottom: 0px;
	background: {$theme_options['custom_asset_color']}; /* Old browsers */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, -moz-linear-gradient(left,  {$theme_options['custom_asset_color']} 0%, {$theme_options['custom_asset_color']} 34px, #434343 34px); /* FF3.6+ */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, -webkit-gradient(linear, left top, right top, color-stop(0%,{$theme_options['custom_asset_color']}), color-stop(34px,{$theme_options['custom_asset_color']}), color-stop(34px,#434343)); /* Chrome,Safari4+ */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, -webkit-linear-gradient(left,  {$theme_options['custom_asset_color']} 0%,{$theme_options['custom_asset_color']} 34px,#434343 34px); /* Chrome10+,Safari5.1+ */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, -o-linear-gradient(left,  {$theme_options['custom_asset_color']} 0%,{$theme_options['custom_asset_color']} 34px,#434343 34px); /* Opera 11.10+ */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, -ms-linear-gradient(left,  {$theme_options['custom_asset_color']} 0%,{$theme_options['custom_asset_color']} 34px,#434343 34px); /* IE10+ */
    background: url(".get_template_directory_uri()."/img/toggleplus.png) no-repeat 12px 15px, linear-gradient(to right,  {$theme_options['custom_asset_color']} 0%,{$theme_options['custom_asset_color']} 34px,#434343 34px); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$theme_options['custom_asset_color']}', endColorstr='#434343',GradientType=1 ); /* IE6-9 */
	-webkit-transition: all 0.4s ease-out;
	-moz-transition: all 0.4s ease-out;
	-ms-transition: all 0.4s ease-out;
	-o-transition: all 0.4s ease-out;
	transition: all 0.4s ease-out;
	margin-top: 10px;	
}

.wpb_toggle_title_active, #content h4.wpb_toggle_title_active {
	background: #434343; /* Old browsers */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, -moz-linear-gradient(left,  #434343 0%, #434343 34px, {$theme_options['custom_asset_color']} 34px); /* FF3.6+ */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, -webkit-gradient(linear, left top, right top, color-stop(0%,#434343), color-stop(34px,#434343), color-stop(34px,{$theme_options['custom_asset_color']})); /* Chrome,Safari4+ */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, -webkit-linear-gradient(left,  #434343 0%,#434343 34px,{$theme_options['custom_asset_color']} 34px); /* Chrome10+,Safari5.1+ */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, -o-linear-gradient(left,  #434343 0%,#434343 34px,{$theme_options['custom_asset_color']} 34px); /* Opera 11.10+ */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, -ms-linear-gradient(left,  #434343 0%,#434343 34px,{$theme_options['custom_asset_color']} 34px); /* IE10+ */
    background: url(".get_template_directory_uri()."/img/toggleminus.png) no-repeat 12px 15px, linear-gradient(to right,  #434343 0%,#434343 34px,{$theme_options['custom_asset_color']} 34px); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#434343', endColorstr='{$theme_options['custom_asset_color']}',GradientType=1 ); /* IE6-9 */
}

.teaser_grid_container li:hover .latest-item  { 
	-webkit-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};
	-moz-box-shadow:    0px 7px 0px {$theme_options['custom_asset_color']};
	box-shadow:         0px 7px 0px {$theme_options['custom_asset_color']};
}

.page-numbers .current, .page-numbers .current:hover {background: {$theme_options['custom_asset_color']}; border-color: {$theme_options['custom_asset_color']};}";
}
if ( !empty ($theme_options['custom_css'])) {
		$all_css = $all_css . "{$theme_options['custom_css']}";
}
define('mukam_custom', $all_css);
?>