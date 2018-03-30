<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
	}
}
global $options_data;
if(isset($options_data['titlebar_alignment'])){
	if($options_data['titlebar_alignment'] == 'right'){
		$text_title ='text-align: right;';
		$text_crumbs ='text-align: left;';
	} else if($options_data['titlebar_alignment'] == 'center'){
		$text_title ='text-align: center;';
		$text_crumbs ='text-align: center;';
	} else {
		$text_title ='';
		$text_crumbs ='';
	}
}
header("Content-type: text/css; charset=utf-8");
ob_start("compress");
function compress( $minify ) 
{
/* remove comments */
	$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

    /* remove tabs, spaces, newlines, etc. */
	$minify = str_replace( array("\r\n", "\r", "\n", "\t", '; ', '  ', '    ', '    ',': ', ', ','{ '), array('','','','',';','','','',':',',','{'), $minify );
		
    return $minify;
}

if($options_data['custom_font_woff'] || $options_data['custom_font_ttf'] || $options_data['custom_font_svg'] || $options_data['custom_font_eot']):
$font_name = (isset($options_data['custom_font_name']) && $options_data['custom_font_name'] != '') ? $options_data['custom_font_name'] : 'custom font';
?>
@font-face {
	font-family: "<?php echo $font_name; ?>";
	src: url("<?php echo $options_data['custom_font_eot']; ?>");
	src:
		url("<?php echo $options_data['custom_font_eot']; ?>?#iefix") format('eot'),
		url("<?php echo $options_data['custom_font_woff']; ?>") format('woff'),
		url("<?php echo $options_data['custom_font_ttf']; ?>") format('truetype'),
		url("<?php echo $options_data['custom_font_svg']; ?>#<?php echo $font_name; ?>") format('svg');
    font-weight: 400;
    font-style: normal;
}
<?php endif; ?>
	body{ 
		font-family: <?php echo $options_data['font_body']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_body']['size']; ?>; line-height: <?php echo $options_data['font_body']['height']; ?>; font-weight: <?php echo $options_data['font_body']['style']; ?>; color: <?php echo $options_data['font_body']['color']; ?>; text-transform: <?php echo $options_data['font_body']['transform']; ?>;
		<?php 
			if($options_data['check_responsive'] == true) {
				echo "";
			}else{
				echo "min-width: 1194px;";
			}
		?>
	}
	h1{ font-family: <?php echo $options_data['font_h1']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h1']['size']; ?>; line-height: <?php echo $options_data['font_h1']['height']; ?>; text-transform: <?php echo $options_data['font_h1']['transform']; ?>; font-weight: <?php echo $options_data['font_h1']['style']; ?>; color: <?php echo $options_data['font_h1']['color']; ?>; }
	h2{ font-family: <?php echo $options_data['font_h2']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h2']['size']; ?>; line-height: <?php echo $options_data['font_h2']['height']; ?>; text-transform: <?php echo $options_data['font_h2']['transform']; ?>; font-weight: <?php echo $options_data['font_h2']['style']; ?>; color: <?php echo $options_data['font_h2']['color']; ?>; }
	h3{ font-family: <?php echo $options_data['font_h3']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h3']['size']; ?>; line-height: <?php echo $options_data['font_h3']['height']; ?>; text-transform: <?php echo $options_data['font_h3']['transform']; ?>; font-weight: <?php echo $options_data['font_h3']['style']; ?>; color: <?php echo $options_data['font_h3']['color']; ?>; }
	h4{ font-family: <?php echo $options_data['font_h4']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h4']['size']; ?>; line-height: <?php echo $options_data['font_h4']['height']; ?>; text-transform: <?php echo $options_data['font_h4']['transform']; ?>; font-weight: <?php echo $options_data['font_h4']['style']; ?>; color: <?php echo $options_data['font_h4']['color']; ?>; }
	h5{ font-family: <?php echo $options_data['font_h5']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h5']['size']; ?>; line-height: <?php echo $options_data['font_h5']['height']; ?>; text-transform: <?php echo $options_data['font_h5']['transform']; ?>; font-weight: <?php echo $options_data['font_h5']['style']; ?>; color: <?php echo $options_data['font_h5']['color']; ?>; }
	h6{ font-family: <?php echo $options_data['font_h6']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_h6']['size']; ?>; line-height: <?php echo $options_data['font_h6']['height']; ?>; text-transform: <?php echo $options_data['font_h6']['transform']; ?>; font-weight: <?php echo $options_data['font_h6']['style']; ?>; color: <?php echo $options_data['font_h6']['color']; ?>; }
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited  { font-weight: inherit; color: inherit; }
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
	a:hover h1, a:hover h2, a:hover h3, a:hover h4, a:hover h5, a:hover h6 { color: <?php echo $options_data['color_hover']; ?>; }
	
	#header .logo a img,
	#fixed_header .logo a img { max-width: <?php echo $options_data['style_logomaxwidth']; ?>px; }
	a, a:visited{ color: <?php echo $options_data['color_link']; ?>; }
	a:hover,  a:focus{ color: <?php echo $options_data['color_hover']; ?>;}
	
	/* Header ------------------------------------------------------------------------ */  
	#header:not(.fixed_header){ 
	background-color: rgba(<?php echo HexToRGB($options_data['color_headerbg']); ?>, <?php echo $options_data['header_bg_opacity']*0.01; ?>) !important; 
	background-image: url("<?php echo $options_data['header_media_bg']; ?>"); 
	background-repeat: <?php echo $options_data['header_bg_options']['repeat']; ?>;
		background-position: <?php echo $options_data['header_bg_options']['position-x'].' '.$options_data['header_bg_options']['position-y']; ?>;
		background-attachment: <?php echo $options_data['header_bg_options']['attachment']; ?>;
		<?php if($options_data['header_bg_size'] != 0 ) echo "background-size: cover;"; ?>
	?>
	color:<?php echo $options_data['color_headertext']; ?>; 
	}
	#header .logo,
	#fixed_header .logo,
	#header .logo .logo_text,
	#fixed_header .logo .logo_text {color:<?php echo $options_data['color_headertext']; ?>; }
	#header,
	#fixed_header { border-bottom: <?php echo $options_data['border_header']['width']; ?>px <?php echo $options_data['border_header']['style']; ?> rgba(<?php echo HexToRGB($options_data['border_header']['color']); ?>, <?php echo $options_data['header_bg_opacity']*0.01; ?>);}
	#top-bar{ background: <?php echo $options_data['color_topbar']; ?>; color: <?php echo $options_data['textcolor_topbar']; ?>; font-size: <?php echo $options_data['font_body']['size']-1; ?>px;}
	#top-bar .social-icons ul li a {color: <?php echo $options_data['textcolor_topbar']; ?>;}
	#top-bar .call-us a{ color: <?php echo $options_data['textcolor_topbar']; ?>;}	
	#header.header1 #navigation ul.menu > li.menu-item,
	#header.header5 #navigation ul.menu > li.menu-item {height: <?php echo $options_data['style_headerheight']; ?>px;}
	#header.header1 .my-table,
	#fixed_header.header1 .my-table,
	#header.header2 .my-table { height: <?php echo $options_data['style_headerheight']; ?>px;}
	#fixed_header.header-scrolled {background-color: rgba(<?php echo HexToRGB($options_data['color_headerbg']);?>,0.9); }
	/* Top sliding area  ------------------------------------------------------------------------ */
	.toparea-sliding-area { 
		background-color: rgba(<?php echo HexToRGB($options_data['bgcolor_toparea']);?>,<?php echo $options_data['bgopacity_toparea'];?>);  
		color: <?php echo $options_data['textcolor_toparea']; ?>;
		border-bottom: <?php echo $options_data['border_bottom_toparea']['width']; ?>px <?php echo $options_data['border_bottom_toparea']['style']; ?> <?php echo $options_data['border_bottom_toparea']['color']; ?>;
		border-top: <?php echo $options_data['border_top_toparea']['width']; ?>px <?php echo $options_data['border_top_toparea']['style']; ?> <?php echo $options_data['border_top_toparea']['color']; ?>;
	}
	.toparea-sliding-area a {color: <?php echo $options_data['color_link_toparea']; ?>;}
	.toparea-sliding-area a:hover {color: <?php echo $options_data['link_hover_color_toparea']; ?>;}		
	
	.toparea-sliding-area .widget h3 { font-family: <?php echo $options_data['font_headline_toparea']['face']; ?>, Arial, Helvetica, sans-serif; line-height: <?php echo $options_data['font_headline_toparea']['height']; ?>; font-size: <?php echo $options_data['font_headline_toparea']['size']; ?>; font-weight: <?php echo $options_data['font_headline_toparea']['style']; ?> !important; text-transform: <?php echo $options_data['font_headline_toparea']['transform']; ?>; color: <?php echo $options_data['font_headline_toparea']['color']; ?> !important; }
	.toparea-sliding-area .widget {color: <?php echo $options_data['textcolor_toparea']; ?>;}
	.toparea-sliding-area .widget .separator {
		height: 0px;
		border-bottom:<?php echo $options_data['border_headline_toparea']['width']; ?>px <?php echo $options_data['border_headline_toparea']['style']; ?> <?php echo $options_data['border_headline_toparea']['color']; ?>;
		<?php if($options_data['border_headline_toparea']['width'] == '0' || $options_data['border_headline_toparea']['style'] == 'none') {echo 'margin-bottom:0px; margin-top: 15px;';} ?>
	}
	.toparea-sliding-area .widget .separator .separator_line {height:<?php if($options_data['border_headline_toparea']['width'] != '0' && $options_data['border_headline_toparea']['style'] != 'none') {echo "".($options_data['border_headline_toparea']['width']+2)."px";} else {echo '0px';} ?>;}
	.toparea-sb {background-color: rgba(<?php echo HexToRGB($options_data['bgcolor_toparea']);?>,<?php echo $options_data['bgopacity_toparea'];?>);}
	/*Sidebar navigation ------------------------------------------------------------------*/
	body.side-navigation-enabled aside.side-navigation { 
	background-color: <?php echo $options_data['sidenav_bg_color']; ?>; 
	background-image: url("<?php echo $options_data['sidenav_media_bg']; ?>"); 
	background-repeat: <?php echo $options_data['sidenav_bg_options']['repeat']; ?>;
		background-position: <?php echo $options_data['sidenav_bg_options']['position-x'].' '.$options_data['sidenav_bg_options']['position-y']; ?>;
		background-attachment: <?php echo $options_data['sidenav_bg_options']['attachment']; ?>;
		<?php if($options_data['sidenav_bg_size'] != 0 ) echo "background-size: cover;"; ?>
	color:<?php echo $options_data['sidenav_text_color']; ?>; 
	}

	body.side-navigation-enabled aside.side-navigation .logo h1 a {color: <?php echo $options_data['sidenav_font_options']['color']; ?>}
	body.side-navigation-enabled aside.side-navigation .logo .site-description,
	body.side-navigation-enabled aside.side-navigation .social-icons ul li a {color:<?php echo $options_data['sidenav_text_color']; ?>;}
	body.side-navigation-enabled aside.side-navigation {text-align:<?php echo ($options_data['select_sidenav_textalign'] != 'default') ? $options_data['select_sidenav_textalign'] : "left"; ?>}
	ul#side-nav.sf-vertical li ul {background-color: <?php echo $options_data['sidenav_drop_bg_color']; ?>;}
	ul#side-nav > li > a,
	ul#side-nav-toggle > li > a { 
		font-family: <?php echo $options_data['sidenav_font_options']['face']; ?>, Arial, Helvetica, sans-serif;
		line-height: <?php echo $options_data['sidenav_font_options']['height']; ?>; 
		font-size: <?php echo $options_data['sidenav_font_options']['size']; ?>; 
		text-transform: <?php echo $options_data['sidenav_font_options']['transform']; ?>; 
		color: <?php echo $options_data['sidenav_font_options']['color']; ?>; 
		<?php echo font_style($options_data['sidenav_font_options']['style']); ?>
	}
	ul#side-nav-toggle li ul li a,
	ul#side-nav.sf-vertical li ul li a {
		font-family: <?php echo $options_data['sidenav_drop_font_options']['face']; ?>, Arial, Helvetica, sans-serif;
		font-size: <?php echo $options_data['sidenav_drop_font_options']['size']; ?>;
		line-height: <?php echo $options_data['sidenav_drop_font_options']['height']; ?>; 
		text-transform: <?php echo $options_data['sidenav_drop_font_options']['transform']; ?>;
		color: <?php echo $options_data['sidenav_drop_font_options']['color']; ?>;
		<?php echo font_style($options_data['sidenav_drop_font_options']['style']); ?>
	}
	aside.side-navigation.side-navigation-toggle .toggleMenu {color: <?php echo $options_data['sidenav_font_options']['color']; ?>;}

	ul#side-nav.show-indicator > li > a .sf-sub-indicator:before {color: <?php echo $options_data['sidenav_font_options']['color']; ?>;}
	ul#side-nav.show-indicator > li ul a .sf-sub-indicator:before {color: <?php echo $options_data['sidenav_drop_font_options']['color']; ?>;}
	ul#side-nav.show-indicator li.sfHover > a .sf-sub-indicator:before {color: <?php echo $options_data['sidenav_active_color']; ?>;}
	ul#side-nav.show-indicator ul li.sfHover > a .sf-sub-indicator:before {color: <?php echo $options_data['sidenav_drop_active_color']; ?>;}
	ul#side-nav li.current-menu-ancestor > a,
	ul#side-nav li.current-menu-item > a,
	ul#side-nav li.current_page_ancestor > a,
	ul#side-nav li > a:hover,
	ul#side-nav-toggle li.current-menu-ancestor > a,
	ul#side-nav-toggle li.current-menu-item > a,
	ul#side-nav-toggle li.current_page_ancestor > a,
	ul#side-nav-toggle li > a:hover {color: <?php echo $options_data['sidenav_active_color']; ?>;}
	ul#side-nav li.current-menu-ancestor > a .sf-sub-indicator:before,
	ul#side-nav li.current-menu-item > a .sf-sub-indicator:before,
	ul#side-nav li.current_page_ancestor > a .sf-sub-indicator:before,
	ul#side-nav li > a:hover {color: <?php echo $options_data['sidenav_active_color']; ?>;}

	ul#side-nav-toggle li ul li.current-menu-ancestor > a,
	ul#side-nav-toggle li ul li.current-menu-item > a,
	ul#side-nav-toggle li ul li.current_page_ancestor > a,
	ul#side-nav-toggle li ul li > a:hover,
	ul#side-nav li ul li.current-menu-ancestor > a,
	ul#side-nav li ul li.current-menu-item > a,
	ul#side-nav li ul li.current_page_ancestor > a,
	ul#side-nav li ul li > a:hover {color: <?php echo $options_data['sidenav_drop_active_color']; ?>;}
	ul#side-nav li ul li.current-menu-ancestor > a .sf-sub-indicator:before,
	ul#side-nav li ul li.current-menu-item > a .sf-sub-indicator:before,
	ul#side-nav li ul li.current_page_ancestor > a .sf-sub-indicator:before,
	ul#side-nav li ul li > a:hover {color: <?php echo $options_data['sidenav_drop_active_color']; ?>;}

	ul#side-nav li.sfHover > a {color: <?php echo $options_data['sidenav_active_color']; ?>;}
	ul#side-nav li ul li.sfHover > a {color: <?php echo $options_data['sidenav_drop_active_color']; ?>;}
	aside.side-navigation.side-navigation-toggle .navbar-menu,
	aside.side-navigation.side-navigation-toggle .toggleMenu {
		background-color: <?php echo $options_data['sidenav_drop_bg_color']; ?>;
	}
	/*---------------------------------*/
	/* Navigation ------------------------------------------------------------------------ */ 
	#navigation ul.menu > li.menu-item {margin:0 0 0 <?php echo $options_data['nav_link_width_between']; ?>px;}
	#header.header2 #navigation ul.menu > li,
	#header.header3 #navigation ul.menu > li,
	#header.header4 #navigation ul.menu > li {padding-right:<?php echo $options_data['nav_link_width_between']/2; ?>px; padding-left:<?php echo $options_data['nav_link_width_between']/2; ?>px;}
	#navigation ul.menu > li.menu-item > a { font-family: <?php echo $options_data['font_nav']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_nav']['size']; ?>; text-transform: <?php echo $options_data['font_nav']['transform']; ?>; color: <?php echo $options_data['font_nav']['color']; ?>; <?php echo font_style($options_data['font_nav']['style']); ?>}
	<?php 
		if($options_data['nav_link_type'] == 'button') {
			echo "#navigation ul.menu > li.menu-item > a {
				padding-top:".$options_data['nav_link_padding_inner']['top']."px;
				padding-right:".$options_data['nav_link_padding_inner']['right']."px;
				padding-bottom:".$options_data['nav_link_padding_inner']['bottom']."px;
				padding-left:".$options_data['nav_link_padding_inner']['left']."px; 
				background-color: ".$options_data['nav_link_bg'].";}";

			echo "#navigation ul.menu > li.sfHover > a,
				#navigation ul.menu > li.sfHover > a:hover,
				#navigation ul.menu > li.menu-item > a:hover{
					background-color: ".$options_data['color_navlinkhover'].";
				}
				#navigation ul.menu > li.current-menu-item > a:hover,
				#navigation ul.menu > li.current-menu-parent > a:hover,
				#navigation ul.menu > li.current-menu-item > a,
				#navigation ul.menu > li.current-menu-ancestor > a:hover,
				#navigation ul.menu > li.current-menu-ancestor > a,
				#navigation ul.menu > li.current-menu-parent > a{
					background-color: ".$options_data['color_navlinkactive'].";
				}";
		} else if($options_data['nav_link_type'] == 'button_hover') {
			echo "#navigation ul.menu > li.menu-item > a {
					padding-top:".$options_data['nav_link_padding_inner']['top']."px;
					padding-right:".$options_data['nav_link_padding_inner']['right']."px;
					padding-bottom:".$options_data['nav_link_padding_inner']['bottom']."px;
					padding-left:".$options_data['nav_link_padding_inner']['left']."px;}";
			echo "#navigation ul.menu > li.sfHover > a,
				#navigation ul.menu > li.sfHover > a:hover,
				#navigation ul.menu > li.menu-item > a:hover{
					border-color: ".$options_data['color_navlinkhover'].";
					color: ".$options_data['color_navlinkhover'].";}

				#navigation ul.menu > li.current-menu-item.sfHover > a,	
				#navigation ul.menu > li.current-menu-item > a:hover,
				#navigation ul.menu > li.current-menu-parent > a:hover,	
				#navigation ul.menu > li.current-menu-ancestor > a:hover,
				#navigation ul.menu > li.current-menu-ancestor > a,
				#navigation ul.menu > li.current-menu-item > a,
				#navigation ul.menu > li.current-menu-parent > a{
					background-color: ".$options_data['color_navlinkactive'].";
					color: #ffffff !important;
					border-color:transparent;
				}";
		} else {
			echo "#navigation ul.menu > li.sfHover > a,
			#navigation ul.menu > li.sfHover > a:hover,
			#navigation ul.menu li.menu-item a:hover { color: ".$options_data['color_navlinkhover']."; }
			#navigation ul.menu > li.current-menu-item > a:hover,
			#navigation ul.menu > li.current-menu-item > a,
			#navigation ul.menu > li.current-menu-ancestor > a:hover,
			#navigation ul.menu > li.current-menu-ancestor > a,
			#navigation ul.menu > li.current-menu-parent > a:hover,
			#navigation ul.menu > li.current-menu-parent > a { color: ".$options_data['color_navlinkactive']."; }";
		}
	?>


	#header.header3 #navigation {background-color: <?php echo $options_data['h3_bg_color']; ?>;}
	#header.header3 #navigation {border-color: <?php echo $options_data['h3_border_color']; ?>;}
	#header.header3 #navigation ul.menu > li {border-color: <?php echo $options_data['h3_nav_border_color']; ?>;}
	#header.header4 #navigation {background-color: <?php echo $options_data['h3_bg_color']; ?>;}
	#header.header4 #navigation {border-color: <?php echo $options_data['h3_border_color']; ?>;}
	#header.header4 #navigation ul.menu > li {border-color: <?php echo $options_data['h3_nav_border_color']; ?>;}

	#navigation .sub-menu{
		background: <?php echo $options_data['color_submenubg']; ?> !important; 
	}
	#navigation ul.menu > li > .sub-menu {
		border-top: <?php echo $options_data['color_submenuborder']['width']; ?>px <?php echo $options_data['color_submenuborder']['style']; ?> <?php echo $options_data['color_submenuborder']['color']; ?>; 
	}
	#navigation .sub-menu:before {border-bottom-color: <?php echo $options_data['color_submenuborder']['color']; ?>;}
	#navigation .sub-menu li a,
	html body #navigation .sub-menu li .sub-menu li a,
	html body #navigation .sub-menu li .sub-menu li .sub-menu li a { font-family: <?php echo $options_data['font_nav']['face']; ?>, Arial, Helvetica, sans-serif; color: <?php echo $options_data['color_submenulink']; ?>; }
	
	#navigation .sub-menu li,
	#navigation ul.menu > li.megamenu > ul > li,
	#navigation ul.menu > li.megamenu > ul > li > a { border-color: <?php echo $options_data['color_submenulinkborder']; ?>; }

	#navigation .sub-menu li a:hover,
	#navigation .sub-menu li.sfHover > a,
	#navigation .sub-menu li.current-menu-parent > a,
	#navigation .sub-menu li .sub-menu li a:hover,
	#navigation .sub-menu li.current-menu-item a,
	#navigation .sub-menu li.current-menu-item a:hover,
	#navigation .sub-menu li.current_page_item a,
	#navigation .sub-menu li.current_page_item a:hover { color: <?php echo $options_data['color_submenulinkhover']; ?> !important; background-color: <?php echo $options_data['bgcolor_submenulinkhover']; ?>; }
	#navigation .menu > li > .sub-menu:before { border-bottom-color:  <?php echo $options_data['color_submenuborder']['color']; ?>}
	#navigation .menu > li .sub-menu > li.sfHover:after {border-left-color:  <?php echo $options_data['color_submenuborder']['color']; ?>;}
	#navigation .menu > li .sub-menu > li.sfHover:before {background-color: <?php echo $options_data['color_submenuborder']['color']; ?>;}
	
	#navigation ul.menu > li.megamenu > ul > li > a:hover, #navigation ul.menu > li.megamenu > ul > li.sfHover > a, 
	#navigation ul.menu > li.megamenu > ul > li.current-menu-item > a, 
	#navigation ul.menu > li.megamenu > ul > li.current-menu-parent > a {
	    color: <?php echo $options_data['color_navlinkactive']; ?> !important;
	}
	#navigation .select-menu {border:1px solid; color: <?php echo $options_data['font_nav']['color']; ?>; background: <?php echo $options_data['color_headerbg']; ?>;}
	#header.header4 #navigation .select-menu {background-color: <?php echo $options_data['h3_bg_color']; ?>;}
	.search-area, .search-area:before,
	.cart-main .cart-content a, .cart-main .cart-contents:before, .cart-main .cart-contents, .cart-main .cart-checkout{ 
		background: <?php echo $options_data['color_submenubg']; ?> !important; 
		border-color: <?php echo $options_data['color_submenulinkborder']; ?>;
	}
	#title {
		background-image: url("<?php echo $options_data['media_titlebar'];?>");
		background-color: <?php echo $options_data['title_bg_color']; ?>;
		background-repeat: <?php echo $options_data['titlebar_background_options']['repeat']; ?>;
		background-position: <?php echo $options_data['titlebar_background_options']['position-x'].' '.$options_data['titlebar_background_options']['position-y']; ?>;
		background-attachment: <?php echo $options_data['titlebar_background_options']['attachment']; ?>;
		<?php if($options_data['titlebar_background_size'] != 0 ) echo "background-size: cover;"; ?>
	   	border-bottom: <?php echo $options_data['border_titlebottom']['width']; ?>px <?php echo $options_data['border_titlebottom']['style']; ?> <?php echo $options_data['border_titlebottom']['color']; ?>;
	    border-top: <?php echo $options_data['border_titletop']['width']; ?>px <?php echo $options_data['border_titletop']['style']; ?> <?php echo $options_data['border_titletop']['color']; ?>;
		padding: <?php echo $options_data['titlebar_padding_outer']['top']; ?>px <?php echo $options_data['titlebar_padding_outer']['right']; ?>px <?php echo $options_data['titlebar_padding_outer']['bottom']; ?>px <?php echo $options_data['titlebar_padding_outer']['left']; ?>px;
	}
	#alt-title {
	    background-image: url("<?php echo $options_data['media_titlebar'];?>");
	    border-bottom: <?php echo $options_data['border_titlebottom']['width']; ?>px <?php echo $options_data['border_titlebottom']['style']; ?> <?php echo $options_data['border_titlebottom']['color']; ?>;
	    border-top: <?php echo $options_data['border_titletop']['width']; ?>px <?php echo $options_data['border_titletop']['style']; ?> <?php echo $options_data['border_titletop']['color']; ?>;
		padding-top: <?php echo $options_data['titlebar_padding_outer']['top'];?>px;
		padding-bottom: <?php echo $options_data['titlebar_padding_outer']['bottom'];?>px;
	}
	#title h1, #alt-title h1 { font-family: <?php echo $options_data['font_titleh1']['face']; ?>, Arial, Helvetica, sans-serif; line-height: <?php echo $options_data['font_titleh1']['height']; ?>; text-transform: <?php echo $options_data['font_titleh1']['transform']; ?>; font-size: <?php echo $options_data['font_titleh1']['size']; ?>; <?php echo font_style($options_data['font_titleh1']['style']); ?> color: <?php echo $options_data['font_titleh1']['color']; ?>; }
	#title h2, #alt-title h2, 
	#title #breadcrumbs, #no-title #breadcrumbs, 
	#alt-title #breadcrumbs, #no-title { font-family: <?php echo $options_data['font_titleh2']['face']; ?>, Arial, Helvetica, sans-serif; line-height: <?php echo $options_data['font_titleh2']['height']; ?>; font-size: <?php echo $options_data['font_titleh2']['size']; ?>; font-weight: <?php echo $options_data['font_titleh2']['style']; ?>; color: <?php echo $options_data['font_titleh2']['color']; ?>; }
	#title #breadcrumbs, 
	#alt-title #breadcrumbs { color: <?php echo $options_data['color_titlebreadcrumb']; ?>; }
	#title #breadcrumbs a, 
	#alt-title #breadcrumbs a, 
	#no-title #breadcrumbs a { color: <?php echo $options_data['color_titlebreadcrumb']; ?>; }
	#title #breadcrumbs a:hover, 
	#alt-title #breadcrumbs a:hover, 
	#no-title #breadcrumbs a:hover { color: <?php echo $options_data['color_titlebreadcrumbhover']; ?>; }
	#title h1, #title h2 {<?php echo $text_title; ?>}
	#title #breadcrumbs {<?php echo $text_crumbs; ?>}
	#sidebar .widget h3 { font-style: <?php echo $options_data['font_sidebarwidget']['style']; ?>; font-size: <?php echo $options_data['font_sidebarwidget']['size']; ?>; line-height: <?php echo $options_data['font_sidebarwidget']['height']; ?>; font-family: <?php echo $options_data['font_sidebarwidget']['face']; ?>, Arial, Helvetica, sans-serif; color: <?php echo $options_data['font_sidebarwidget']['color']; ?>; text-transform: <?php echo $options_data['font_sidebarwidget']['transform']; ?>; font-weight: <?php echo $options_data['font_sidebarwidget']['style']; ?>;}
	
	#alt-title .grid, #title .inner {
		padding: <?php echo $options_data['titlebar_padding_inner']['top']; ?>px <?php echo $options_data['titlebar_padding_inner']['right']; ?>px <?php echo $options_data['titlebar_padding_inner']['bottom']; ?>px <?php echo $options_data['titlebar_padding_inner']['left']; ?>px;
        <?php if($options_data['titlebar_gridcolor'] != '') { echo "background-color: rgba(".HexToRGB($options_data['titlebar_gridcolor']).", ".$options_data['titlebar_gridopacity'].");";} else { echo "background:none;";}?>
    }
    #main.boxed {max-width : <?php echo $options_data['main_boxed_width'];?>px;}
    #main {
    	background: rgba(<?php echo HexToRGB($options_data['color_containerbackground']); ?>, <?php echo $options_data['text_containeropacity']*0.01; ?>);
    }
    .container {max-width : <?php echo $options_data['container_width'];?>px;}
    /* Top navigatio sub-menu -------------------------------------------------------- */
    #topnav.menu li a { 
    	font-family: <?php echo $options_data['font_top_navigation']['face']; ?>, Arial, Helvetica, sans-serif; 
    	font-size: <?php echo $options_data['font_top_navigation']['size']; ?>; 
    	text-transform: <?php echo $options_data['font_top_navigation']['transform']; ?>; 
    	color: <?php echo $options_data['font_top_navigation']['color']; ?>; <?php echo font_style($options_data['font_top_navigation']['style']); ?>
    }
    #topnav li a:hover,
	#topnav li.current-menu-item a:hover,
	#topnav li.current-page-ancestor a:hover,
	#topnav li.current-menu-ancestor a:hover,
	#topnav li.current-menu-parent a:hover,
	#topnav li.current_page_ancestor a:hover { color: <?php echo $options_data['topnav_color_navlinkhover']; ?>; }

    #topnav li.current-menu-item a,
	#topnav li.current-page-ancestor a,
	#topnav li.current-menu-ancestor a,
	#topnav li.current-menu-parent a,
	#topnav li.current_page_ancestor a { color: <?php echo $options_data['topnav_color_navlinkactive']; ?>; }

	#topnav .sub-menu, .cart .cart-content a, .cart .cart-content:before, .cart .cart-contents, .cart .cart-checkout { 
		background: <?php echo $options_data['topnav_color_submenubg']; ?> !important; 
		border-color: <?php echo $options_data['topnav_color_submenuborder']; ?>; 
	}
	#topnav .sub-menu li a,
	#topnav .sub-menu li .sub-menu li a,
	#topnav .sub-menu li .sub-menu li .sub-menu li a {color: <?php echo $options_data['topnav_color_submenulink']; ?>; }
	#topnav .sub-menu li{ border-color: <?php echo $options_data['topnav_color_submenulinkborder']; ?>; }
	#topnav .sub-menu li a:hover,
	#topnav .sub-menu li.sfHover > a,
	#topnav .sub-menu li.current-menu-parent > a,
	#topnav .sub-menu li .sub-menu li a:hover,
	#topnav .sub-menu li.current-menu-item a,
	#topnav .sub-menu li.current-menu-item a:hover,
	#topnav .sub-menu li.current_page_item a,
	#topnav .sub-menu li.current_page_item a:hover { color: <?php echo $options_data['topnav_color_submenulinkhover']; ?> !important; }

	/* Footer ------------------------------------------------------------------------ */  
 
	#footer{ 
	border-top: <?php echo $options_data['border_footertop']['width']; ?>px <?php echo $options_data['border_footertop']['style']; ?> <?php echo $options_data['border_footertop']['color']; ?>; 
	background-color: <?php echo $options_data['color_footerbg']; ?>; 
	background-image: url("<?php echo $options_data['footer_media_bg']; ?>"); 
	background-repeat: <?php echo $options_data['footer_bg_options']['repeat']; ?>;
		background-position: <?php echo $options_data['footer_bg_options']['position-x'].' '.$options_data['footer_bg_options']['position-y']; ?>;
		background-attachment: <?php echo $options_data['footer_bg_options']['attachment']; ?>;
		<?php if($options_data['footer_bg_size'] != 0 ) echo "background-size: cover;"; ?>
	?>

	color:<?php echo $options_data['color_footertext']; ?>; 
	}
	#footer a { color:<?php echo $options_data['color_footerlink']; ?>; }
	#footer a:hover{ color:<?php echo $options_data['color_footerlinkhover']; ?>; }
	#footer ul li a {color:<?php echo $options_data['color_footertext']; ?>}
	#footer .twitter-list a {color:<?php echo $options_data['color_footerlinkhover']; ?>;}
	#footer .widget h3 { font-family: <?php echo $options_data['font_footerheadline']['face']; ?>, Arial, Helvetica, sans-serif; line-height: <?php echo $options_data['font_footerheadline']['height']; ?>; font-size: <?php echo $options_data['font_footerheadline']['size']; ?>; font-weight: <?php echo $options_data['font_footerheadline']['style']; ?> !important; text-transform: <?php echo $options_data['font_footerheadline']['transform']; ?>; color: <?php echo $options_data['font_footerheadline']['color']; ?> !important; <?php echo $options_data['border_footerheadline']['color']; ?>; }
	#footer .widget {color: <?php echo $options_data['color_footertext']; ?>;}
	#footer .widget .separator {
		border-bottom:<?php echo $options_data['border_footerheadline']['width']; ?>px <?php echo $options_data['border_footerheadline']['style']; ?> <?php echo $options_data['border_footerheadline']['color']; ?>;
		margin-bottom:<?php if($options_data['border_footerheadline']['style'] == 'none') {echo '0px';} ?>;
	}
	#footer .widget .separator .separator_line {height:<?php if($options_data['border_footerheadline']['style'] != 'none') {echo "".($options_data['border_footerheadline']['width']+2)."px";} else {echo '0px';} ?>;}
	/* Copyright ------------------------------------------------------------------------ */  
	        
	#copyright { background: <?php echo $options_data['color_copyrightbg']; ?>; color: <?php echo $options_data['color_copyrighttext']; ?>; }
	#copyright a { color: <?php echo $options_data['color_copyrightlink']; ?>; }
	#copyright a:hover { color: <?php echo $options_data['color_copyrightlinkhover']; ?>; }
	#copyright .menu li a {
		font-family: <?php echo $options_data['font_copyright_menu']['face']; ?>, Arial, Helvetica, sans-serif; 
    	font-size: <?php echo $options_data['font_copyright_menu']['size']; ?>; 
    	text-transform: <?php echo $options_data['font_copyright_menu']['transform']; ?>; 
    	color: <?php echo $options_data['font_copyright_menu']['color']; ?>; <?php echo font_style($options_data['font_top_navigation']['style']); ?>
    }

    #copyright .menu li.current-menu-item a,
	#copyright .menu li.current-menu-item a:hover,
	#copyright .menu li.current-page-ancestor a,
	#copyright .menu li.current-page-ancestor a:hover,
	#copyright .menu li.current-menu-ancestor a,
	#copyright .menu li.current-menu-ancestor a:hover,
	#copyright .menu li.current-menu-parent a,
	#copyright .menu li.current-menu-parent a:hover,
	#copyright .menu li.current_page_ancestor a,
	#copyright .menu li.current_page_ancestor a:hover { color: <?php echo $options_data['copyright_hover_menu_color']; ?>;}
	    
	/* Forms ------------------------------------------------------------------------ */  
	    
	input, input[type="text"], input[type="url"], input[type="date"], input[type="password"], input[type="email"], textarea, select, button, input[type="submit"], input[type="reset"], input[type="button"] { font-family: <?php echo $options_data['font_body']['face']; ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $options_data['font_body']['size']; ?>; }
	    
	/* Accent Color ------------------------------------------------------------------------ */ 
	.social-icon a:hover, .social-icons a:hover{background-color: <?php echo $options_data['color_accent']; ?> !important;}
	.images.bordered div.item:hover,
	.images.without-border div.item:hover {border-color: <?php echo $options_data['color_accent']; ?>;}
	::selection { background: <?php echo $options_data['color_accent']; ?> !important; }
	::-moz-selection { background: <?php echo $options_data['color_accent']; ?> }
	.title a:hover, .post-meta span a:hover { color: <?php echo $options_data['color_accent']; ?> }
	.separator_line {background: <?php echo $options_data['color_accent']; ?>;}
	#filters ul li a.active, #filters ul li a:hover {border-color:<?php echo $options_data['color_accent']; ?>; color:<?php echo $options_data['color_accent']; ?>;}
	.projects-nav a:hover { background-color: <?php echo $options_data['color_accent']; ?> }
	blockquote, .pullquote.align-right, .pullquote.align-left {border-color:<?php echo $options_data['color_accent']; ?>;}
	.accordion.style1 .accordion-title.active i,
	.sidenav li a:hover, 
	.sidenav li.current_page_item > a, 
	.sidenav li.current_page_item > a:hover,
	.toggle.style1 .toggle-title.active i { color: <?php echo $options_data['color_accent']; ?> }
	.accordion.style2 .accordion-title.active .acc-icon, .accordion.style3 .accordion-title.active .acc-icon,
	.toggle.style2 .toggle-title.active .status-icon, .toggle.style3 .toggle-title.active .status-icon,
	.accordion.style4 .accordion-title.active, .toggle.style4 .toggle-title.active {background-color: <?php echo $options_data['color_accent']; ?>}
	.blog-item  .author .name { color: <?php echo $options_data['color_accent']; ?> }
	#back-to-top a:hover { background-color: <?php echo $options_data['color_accent']; ?> }
	.widget_tag_cloud a:hover { background: <?php echo $options_data['color_accent']; ?>; border-color: <?php echo $options_data['color_accent']; ?>; }
	.widget_portfolio .portfolio-widget-item .portfolio-pic:hover { background: <?php echo $options_data['color_accent']; ?>; border-color: <?php echo $options_data['color_accent']; ?>; }
	#footer .widget_tag_cloud a:hover,
	#footer .widget_flickr #flickr_tab a:hover,
	#footer .widget_portfolio .portfolio-widget-item .portfolio-pic:hover,
	.flex-direction-nav a:hover { background-color: <?php echo $options_data['color_accent']; ?> }
	.flex-control-nav li a:hover, .flex-control-nav li a.flex-active{ background: <?php echo $options_data['color_accent']; ?> }
	.gallery img:hover { background: <?php echo $options_data['color_accent']; ?>; border-color: <?php echo $options_data['color_accent']; ?> !important; }
	.skillbar .skill-percentage { background: <?php echo $options_data['color_accent']; ?> }
	.latest-blog .blog-item:hover h4 { color: <?php echo $options_data['color_accent']; ?> }
	.tp-caption.big_colorbg{ background: <?php echo $options_data['color_accent']; ?>; }
	.tp-caption.medium_colorbg{ background: <?php echo $options_data['color_accent']; ?>; }
	.tp-caption.small_colorbg { background: <?php echo $options_data['color_accent']; ?>; }
	.tp-caption.customfont_color{ color: <?php echo $options_data['color_accent']; ?>; }
	.tp-caption a { color: <?php echo $options_data['color_accent']; ?>; }
	ul.list-check-3 li:before {	background-color: <?php echo $options_data['color_accent']; ?>;}
	.widget_categories ul li a:hover, #related-posts ul li h5 a:hover { color: <?php echo $options_data['color_accent']; ?>; }
	.portfolio-item .portfolio-page-item .portfolio-title a:hover { color: <?php echo $options_data['color_accent']; ?>;}
	a.more,
	#sidebar .widget ul:not(.unstyled) li a:hover,
	#related-posts ul li:before {color: <?php echo $options_data['color_accent']; ?>;}
	.counter-value .value {color: <?php echo $options_data['color_accent']; ?>;}
	.callout, .description.style-2 {border-left-color:<?php echo $options_data['color_accent']; ?>;}
	.tabset .tab a.selected i, .tabset .tab a:hover i, .tabset .tab a.selected h6, .tabset .tab a:hover h6,
	#main .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a,
	#main .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a { color:<?php echo $options_data['color_accent']; ?>;}
	.shop_table .product-remove a:hover {color: <?php echo $options_data['color_accent']; ?>;}
	.testimonial-author .featured-thumbnail:after {border-left-color:<?php echo $options_data['color_accent']; ?>;}
	#header.header6 .logo_bg {background-color: <?php echo $options_data['color_accent']; ?>;}
	#pagination a:hover, #pagination span.current,
	#main .vc_tta-accordion.vc_tta-color-grey.vc_tta-style-modern .vc_tta-panel.vc_active .vc_tta-panel-heading {background-color: <?php echo $options_data['color_accent']; ?>;}
	.iconlist:hover .icon.circle {
		color: <?php echo $options_data['color_accent']; ?>;
		border-color: <?php echo $options_data['color_accent']; ?>;
	}
	.iconbox:hover .top_icon_circle .icon,
	.iconbox:hover .aside_rounded_icon .icon,
	.iconbox:hover .aside_circle_icon .icon {
		background-color: <?php echo $options_data['color_accent']; ?> !important;
		border-color: <?php echo $options_data['color_accent']; ?> !important;
		color:#fff !important;
	}
	.portfolio-item:hover .portfolio-title {
		background-color: <?php echo $options_data['color_accent']; ?> ;
	}
	.portfolio-item .portfolio-terms a {background-color: <?php echo $options_data['color_accent']; ?> ;}
	.cart-loading,
	.portfolio-item .portfolio-pic .portfolio-overlay .overlay-link,
	.portfolio-item-one .portfolio-pic .portfolio-overlay .overlay-link {
	    background-color: rgba(<?php echo HexToRGB($options_data['color_accent']); ?>,0.8);
	}
	.testimonial.thumb-side .testimonial-author .featured-thumbnail {
		border-color:<?php echo $options_data['color_accent']; ?>;
	}
	.testimonial.thumb-side .testimonial-author .featured-thumbnail:after {
		border-left-color:<?php echo $options_data['color_accent']; ?>;
	}
	.iconbox:hover .top_icon_standard .icon {
		color:<?php echo $options_data['color_accent']; ?> !important;
	}
	.sidenav .children li:hover a::after,
	.sidenav .children > li.current_page_item > a::after{background-color: <?php echo $options_data['color_accent']; ?>;}
	/**** buttons accent color *****/
	.button, .button.default, input.button, input[type=submit], .loadmore.default {
		font-family: <?php echo $options_data['font_button']['face']; ?>, Arial, Helvetica, sans-serif; 
		font-size: <?php echo $options_data['font_button']['size']; ?>; 
		font-weight: <?php echo $options_data['font_button']['style']; ?> !important; 
		text-transform: <?php echo $options_data['font_button']['transform']; ?>; 
		color: <?php echo $options_data['font_button']['color']; ?> !important;
		background-color: <?php echo $options_data['button_color']; ?>;
	}
	.button:hover, .button.gradient.default:hover, .button.default:hover, input.button:hover, .loadmore.default:hover, input[type=submit]:hover {background-color: <?php echo $options_data['button_color_hover']; ?> !important; color: #fff !important; ?>;}
	.add_to_cart_button.lightgray.button:hover {
		background-color: <?php echo $options_data['color_accent']; ?> !important;
	} 
	.ui-slider .ui-slider-range {background-color: <?php echo $options_data['color_accent']; ?> !important;}
	.products .product .product-wrap{
		background-color: <?php echo $options_data['shop_item_bg_color']; ?>;
	}
	#footer .widget ul li:before, #infobar .widget ul li:before {background-color: <?php echo $options_data['color_accent']; ?> !important;}
	.product .price,
	.product_list_widget li .amount,
	.product_list_widget li .amount,
	.product_list_widget li del {color:<?php echo $options_data['shop_color_price']; ?>}
	.onsale {background-color:<?php echo $options_data['shop_color_price']; ?>}
	.button.gradient.default {
		background-color: <?php echo $options_data['button_color']; ?>;
		background-image: linear-gradient(bottom, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>) 44%, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>) 90%);
		background-image: -o-linear-gradient(bottom, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>) 44%, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>) 90%);
		background-image: -moz-linear-gradient(bottom, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>) 44%, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>) 90%);
		background-image: -webkit-linear-gradient(bottom, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>) 44%, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>) 90%);
		background-image: -ms-linear-gradient(bottom, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>) 44%, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>) 90%);
		background-image: -webkit-gradient(
			linear,
			left bottom,
			left top,
			color-stop(0.44, rgb(<?php echo HexToRGB($options_data['button_color'],-15); ?>)),
			color-stop(0.9, rgb(<?php echo HexToRGB($options_data['button_color'],15); ?>))
		);
	}
	.widget ul:not(.unstyled) li:before {
		background-color: <?php echo $options_data['color_accent']; ?> !important;
	}
	.widget_shopping_cart_content .buttons a.button:hover {
		color: <?php echo $options_data['color_accent']; ?> !important;
	}
	<?php echo $options_data['textarea_csscode']; ?>

<?php ob_end_flush(); ?>