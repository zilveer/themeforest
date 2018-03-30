<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Custom styles from back-end
*	--------------------------------------------------------------------- 
*/

function mnky_custom_css() {
	$custom_css = '';
	
	// Accent color (background-color)
	$custom_css .= '
		.themecolor_bg, .wpb_button.wpb_btn_themecolor, .wpb_button.wpb_btn_themecolor:hover, input[type=\'submit\'], #wp-calendar #today, .vc_progress_bar .vc_single_bar.bar_themecolor .vc_bar, #site-navigation .header_cart_button .cart_product_count, .woocommerce a.added_to_cart,.woocommerce-page a.added_to_cart, .header-search .search-input, .pricing-box .plan-badge, article.format-quote .quoute-text, article.format-link .link-text, article.format-status .status-text {background-color:'. ot_get_option('accent_color', '#3498db') .';}
	';
	
	$custom_css .= '::selection{background-color:'. ot_get_option('accent_color', '#3498db') .';}::-moz-selection{background-color:'. ot_get_option('accent_color', '#3498db') .';}';

	
	// Accent color (color)
	$custom_css .= '
		dt,.wpb_button.wpb_btn_themecolor.wpb_btn-minimal, .themecolor_txt, #site-header #site-navigation ul li a:hover, #site-header #site-navigation .search_button:hover, #site-header #site-navigation .header_cart_button:hover, #site-header #site-navigation ul li ul li.current-menu-item > a, #site-header #site-navigation ul li ul li.current-menu-item > a:hover, .single-post #site-header #site-navigation ul li ul li.current_page_parent > a, #site-header #site-navigation ul li ul li.current-menu-ancestor > a, #site-navigation ul li.menu-item-has-children:hover:after, #site-header #site-navigation ul li.megamenu ul li a:hover, #site-header #site-navigation ul li.current-menu-item > a,.single-post #site-header #site-navigation ul li.current_page_parent > a, #site-header #site-navigation ul li.current-menu-ancestor > a, #site-header #site-navigation ul li.current-menu-ancestor.menu-item-has-children:after, a:hover, #site-header #site-navigation ul li.megamenu ul li.current-menu-item > a,.single-post #site-header #site-navigation ul li.megamenu ul li.current_page_parent > a,#site-header #site-navigation ul li.megamenu ul li.current-menu-ancestor > a, .widget a, span.required, #comments .comment-reply-link:hover,#comments .comment-meta a:hover, .vc_toggle_default .vc_toggle_title .vc_toggle_icon:after, .post-entry-header .entry-meta a:hover, #comments p.comment-notes:before, p.logged-in-as:before, p.must-log-in:before, article.sticky .post-preview:after, .separator_w_icon i, blockquote:after, article.format-chat p:nth-child(odd):before, .entry-meta-footer a:hover, .footer-sidebar a:hover, .team_member_position, .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a, .woocommerce-MyAccount-navigation ul li.is-active a{color:'. ot_get_option('accent_color', '#3498db') .';}		
	';


	// Accent color (border-color)
	$custom_css .= '
		.wpb_button.wpb_btn_themecolor, .wpb_button.wpb_btn_themecolor:hover, input[type=\'submit\'], th, #comments .comment-reply-link:hover, #site-navigation, #site-navigation ul li ul, .woocommerce-MyAccount-navigation ul li.is-active {border-color:'. ot_get_option('accent_color', '#3498db') .';}
	';
	
	
	// Accent color (misc)
	$custom_css .= '
		.widget-area .widget .tagcloud a:hover, .post-navigation a:hover {background-color:'. ot_get_option('accent_color', '#3498db') .';}
		article.format-image .post-preview a:after{background-color:'. ot_get_option('accent_color', '#3498db') .'; background-color:rgba('. mnky_hex2rgb(ot_get_option('accent_color', '#3498db')) .', 0.75);}
		article.format-image .post-preview a:hover:after, article.format-image .post-preview a.touch-hover:after {background-color:'. ot_get_option('accent_color', '#3498db') .'; background-color:rgba('. mnky_hex2rgb(ot_get_option('accent_color', '#3498db')) .', 1);}
		.header-search.header-search-active .searchform-wrapper:before {border-bottom-color:'. ot_get_option('accent_color', '#3498db') .';}
	';
	
	
	// Accent color WooCommerce
	if (class_exists( 'WooCommerce' )){
		$custom_css .= '
			.woocommerce div.product span.price,.woocommerce div.product p.price,.woocommerce #content div.product span.price,.woocommerce #content div.product p.price,.woocommerce-page div.product span.price,.woocommerce-page div.product p.price,.woocommerce-page #content div.product span.price,.woocommerce-page #content div.product p.price, .woocommerce ul.products li.product .price,.woocommerce-page ul.products li.product .price, #site-header #site-navigation .header_cart_widget .woocommerce ul li a:hover, #site-navigation .header_cart_widget .woocommerce .buttons a:hover, .woocommerce ul li.product-category:hover h3,.woocommerce ul li.product-category:hover h3 mark {color:'. ot_get_option('accent_color', '#3498db') .';}		
		';
		
		$custom_css .= '
			.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit,.woocommerce #content input.button,.woocommerce-page a.button,.woocommerce-page button.button,.woocommerce-page input.button,.woocommerce-page #respond input#submit,.woocommerce-page #content input.button, .woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt,.woocommerce #content input.button.alt,.woocommerce-page a.button.alt,.woocommerce-page button.button.alt,.woocommerce-page input.button.alt,.woocommerce-page #respond input#submit.alt,.woocommerce-page #content input.button.alt, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {background-color:'. ot_get_option('accent_color', '#3498db') .';}		
		';
				
		$custom_css .= '
			.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce #content nav.woocommerce-pagination ul li span.current,.woocommerce #content nav.woocommerce-pagination ul li a:hover,.woocommerce #content nav.woocommerce-pagination ul li a:focus,.woocommerce-page nav.woocommerce-pagination ul li span.current,.woocommerce-page nav.woocommerce-pagination ul li a:hover,.woocommerce-page nav.woocommerce-pagination ul li a:focus,.woocommerce-page #content nav.woocommerce-pagination ul li span.current,.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,.woocommerce-page #content nav.woocommerce-pagination ul li a:focus {background-color:'. ot_get_option('accent_color', '#3498db') .';}		
		';
	}
	
	
	// Layout & Content width
	if( ot_get_option('layout_style') == 'boxed' ){
		$layout_width = ot_get_option('content_width', '1100') + 90;	
		$custom_css .= '#wrapper{max-width:'. $layout_width .'px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); -moz-box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);}';
		$custom_css .= '#site-logo {left:45px;} #site-navigation {margin-right:45px;} #top-bar-wrapper{padding:0 45px;}';
		$custom_css .= '#header-wrapper{max-width:'. $layout_width .'px;}';
	}
	
	if( ot_get_option('layout_style') != 'boxed' && ot_get_option('header_style') == 'fixed-width'){
		$custom_css .= '#top-bar-wrapper{padding:0px;}';
		$custom_css .= '#site-header #header-container, #top-bar{max-width:'. ot_get_option('content_width', '1100') .'px; }';
		$custom_css .= '#topleft-widget-area{padding-left:0px;} #topright-widget-area{padding-right:0px;}';
	}	
	
	$row_width = ot_get_option('content_width', '1100') + 30;
	$custom_css .= '.row-inner{max-width:'. $row_width .'px;}';
	
	$custom_css .= '#container.no-sidebar.no-vc, #container.row-inner, .site-info .row-inner, .page-header .row-inner{max-width:'. ot_get_option('content_width', '1100') .'px;}';
	
	$custom_css .= '.tt_event_theme_page{width:'. ot_get_option('content_width', '1100') .'px; }';
	$single_event_width = ot_get_option('content_width', '1100') - 310;
	$custom_css .= '.tt_event_page_left{width:'. $single_event_width .'px; }';
		
	// Body typo
	$body_font = ot_get_option('body_font');
	
	$body_font_styles = array(
		( ! empty( $body_font['font-family'] ) ) ? 'font-family:'. str_replace("+", " ", $body_font['font-family']) : 'font-family:Open Sans',
		( ! empty( $body_font['font-weight'] ) ) ? 'font-weight:'. $body_font['font-weight'] : null,
		( ! empty( $body_font['font-style'] ) ) ? 'font-style:'. $body_font['font-style'] : null,
		( ! empty( $body_font['line-height'] ) ) ? 'line-height:'. $body_font['line-height'] : null,
		( ! empty( $body_font['letter-spacing'] ) ) ? 'letter-spacing:'. $body_font['letter-spacing'] : null,
		( ! empty( $body_font['text-transform'] ) ) ? 'text-transform:'. $body_font['text-transform'] : null,
		'color:'. ot_get_option('body_text_color', '#575757'),	
		'font-size:'. ot_get_option('body_size', '14px')		
	);
	
	$body_font_style = implode('; ', array_filter($body_font_styles));	
	$custom_css .= 'body, .tt_event_theme_page p{'.$body_font_style.'}';

	$custom_css .= ( ! empty( $body_font['font-family'] ) ) ? 'select, input, textarea, .wpb_button{font-family:'. str_replace("+", " ", $body_font['font-family']) .'}' : 'select, input, textarea, .wpb_button{font-family:Open Sans}';
		
	// Menu typo
	$menu_font = ot_get_option('menu_font');
	
	$menu_font_styles = array(
		( ! empty( $menu_font['font-family'] ) ) ? 'font-family:'. str_replace("+", " ", $menu_font['font-family']) : 'font-family:Open Sans',
		( ! empty( $menu_font['font-weight'] ) ) ? 'font-weight:'. $menu_font['font-weight'] : null,
		( ! empty( $menu_font['font-style'] ) ) ? 'font-style:'. $menu_font['font-style'] : null,
		( ! empty( $menu_font['letter-spacing'] ) ) ? 'letter-spacing:'. $menu_font['letter-spacing'] : null,
		( ! empty( $menu_font['text-transform'] ) ) ? 'text-transform:'. $menu_font['text-transform'] : null,
				
	);

	$menu_font_style = implode('; ', array_filter($menu_font_styles));	
	$custom_css .= '#site-navigation ul li{'.$menu_font_style.'}';
		
	
	// Heading typo
	$heading_font = ot_get_option('heading_font');

	$heading_font_styles = array(
		( ! empty( $heading_font['font-family'] ) ) ? 'font-family:'. str_replace("+", " ", $heading_font['font-family']) : 'font-family:Open Sans',
		( ! empty( $heading_font['font-weight'] ) ) ? 'font-weight:'. $heading_font['font-weight'] : null,
		( ! empty( $heading_font['font-style'] ) ) ? 'font-style:'. $heading_font['font-style'] : null,
		( ! empty( $heading_font['line-height'] ) ) ? 'line-height:'. $heading_font['line-height'] : null,
		( ! empty( $heading_font['letter-spacing'] ) ) ? 'letter-spacing:'. $heading_font['letter-spacing'] : null,
		( ! empty( $heading_font['text-transform'] ) ) ? 'text-transform:'. $heading_font['text-transform'] : null,
				
	);

	$heading_font_style = implode('; ', array_filter($heading_font_styles));	
	$custom_css .= 'h1, h2, h3, h4, h5, h6{'.$heading_font_style.'}';
	
	
	// Visual Composer heading typo
	$vc_heading_font = ot_get_option('vc_heading_font');

	$vc_heading_font_styles = array(
		( ! empty( $vc_heading_font['font-family'] ) ) ? 'font-family:'. str_replace("+", " ", $vc_heading_font['font-family']) : 'font-family:Open Sans',
		( ! empty( $vc_heading_font['letter-spacing'] ) ) ? 'letter-spacing:'. $vc_heading_font['letter-spacing'] : null,
		( ! empty( $vc_heading_font['text-transform'] ) ) ? 'text-transform:'. $vc_heading_font['text-transform'] : null,
				
	);

	$vc_heading_font_style = implode('; ', array_filter($vc_heading_font_styles));	
	$custom_css .= '.heading_wrapper h2, .heading_wrapper .heading_subtitle{'.$vc_heading_font_style.'}';
			
	
	
	// Widget typo
	$widget_font = ot_get_option('widget_font');
	
	$widget_font_styles = array(
		( ! empty( $widget_font['font-family'] ) ) ? 'font-family:'. str_replace("+", " ", $widget_font['font-family']) : 'font-family:Open Sans',
		( ! empty( $widget_font['font-weight'] ) ) ? 'font-weight:'. $widget_font['font-weight'] : null,
		( ! empty( $widget_font['font-style'] ) ) ? 'font-style:'. $widget_font['font-style'] : null,
		( ! empty( $widget_font['line-height'] ) ) ? 'line-height:'. $widget_font['line-height'] : null,
		( ! empty( $widget_font['letter-spacing'] ) ) ? 'letter-spacing:'. $widget_font['letter-spacing'] : null,
		( ! empty( $widget_font['text-transform'] ) ) ? 'text-transform:'. $widget_font['text-transform'] : null,
		
	);

	$widget_font_style = implode('; ', array_filter($widget_font_styles));	
	$custom_css .= '.widget .widget-title{'.$widget_font_style.'}';
		
	
	
	// Header style
	(ot_get_option('header_bg') != '') ? $custom_css .= '#site-header #header-wrapper, #site-navigation ul li ul{background-color:'. ot_get_option('header_bg') .';}' : '';
	
	// Header height
	(ot_get_option('header_height') != '') ? $custom_css .= '#site-header, #site-header #header-container{height:'. ot_get_option('header_height') .';} #site-navigation ul li a, #site-navigation .search_button, #site-navigation .header_cart_link, #site-logo .site-title{line-height:'. ot_get_option('header_height') .';} #site-logo img {max-height:'. ot_get_option('header_height') .';}' : '';
	
	
	// Top bar style
	(ot_get_option('top_bar_bg') != '') ? $custom_css .= '#top-bar-wrapper{background:'. ot_get_option('top_bar_bg') .'}' : '';
	(ot_get_option('top_bar_border') != '') ? $custom_css .= '#top-bar-wrapper{border-bottom:1px solid '. ot_get_option('top_bar_border') .'}' : '';
	(ot_get_option('top_bar_text_color') != '') ? $custom_css .= '#top-bar-wrapper, #top-bar-wrapper a, #top-bar ul li ul li a:after{color:'. ot_get_option('top_bar_text_color') .'}' : '';
	(ot_get_option('top_bar_link_hover') != '') ? $custom_css .= '#top-bar-wrapper a:hover{color:'. ot_get_option('top_bar_link_hover') .'}' : '';
	
	// Menu style
	(ot_get_option('default_menu_link') != '') ? $custom_css .= '#site-logo h1.site-title a, #site-header #site-navigation ul li a, #site-header #site-navigation .search_button, #site-header #site-navigation .header_cart_button, .toggle-mobile-menu i {color:'. ot_get_option('default_menu_link') .'}' : '';
	(ot_get_option('default_menu_link_h') != '') ? $custom_css .= '#site-header #site-navigation ul li a:hover, #site-header #site-navigation ul li.megamenu ul li a:hover, #site-header #site-navigation ul li.megamenu ul li.current-menu-item > a,.single-post #site-header #site-navigation ul li.megamenu ul li.current_page_parent > a,#site-header #site-navigation ul li.megamenu ul li.current-menu-ancestor > a, #site-header #site-navigation .search_button:hover, #site-header #site-navigation .header_cart_button:hover, #site-header #site-navigation ul li.current-menu-item > a,.single-post #site-header #site-navigation ul li.current_page_parent > a, #site-header #site-navigation ul li.current-menu-ancestor > a {color:'. ot_get_option('default_menu_link_h') .'}' : '';
	(ot_get_option('menu_hover_bg') != '') ? $custom_css .= '#site-header #site-navigation ul li:hover > a {background-color:'. ot_get_option('menu_hover_bg'). '}' : '';
	(ot_get_option('menu_bottom_border') != '') ? $custom_css .= '#site-header #header-wrapper {border-bottom:1px solid '. ot_get_option('menu_bottom_border'). '}' : '';
	(ot_get_option('submenu_background') != '') ? $custom_css .= '#site-navigation ul li ul {background-color:'. ot_get_option('submenu_background'). '}' : '';
	(ot_get_option('submenu_hover_bg') != '') ? $custom_css .= '#site-navigation ul li ul li a:hover {background:'. ot_get_option('submenu_hover_bg'). '}' : '';
	(ot_get_option('current_submenu_bg') != '') ? $custom_css .= '#site-navigation ul li ul li.current-menu-item > a,.single-post #site-navigation ul li ul li.current_page_parent > a, #site-navigation ul li ul li.current-menu-ancestor > a {background-color:'. ot_get_option('current_submenu_bg'). '}' : '';
	(ot_get_option('submenu_link_color') != '') ? $custom_css .= '#site-header #site-navigation ul li ul li a, #site-header #site-navigation ul li ul li a:hover, #site-header #site-navigation ul li ul li.current-menu-item > a, #site-header #site-navigation ul li ul li.current-menu-item > a:hover, .single-post #site-header #site-navigation ul li ul li.current_page_parent > a, #site-header #site-navigation ul li ul li.current-menu-ancestor > a, #site-navigation ul li ul li.menu-item-has-children:hover:after {color:'. ot_get_option('submenu_link_color'). '}' : '';
	(ot_get_option('submenu_link_hover_color') != '') ? $custom_css .= '#site-header #site-navigation ul li ul li a:hover, #site-header #site-navigation ul li ul li.current-menu-item > a, #site-header #site-navigation ul li ul li.current-menu-item > a:hover, .single-post #site-header #site-navigation ul li ul li.current_page_parent > a, #site-header #site-navigation ul li ul li.current-menu-ancestor > a, #site-header #site-navigation ul li.megamenu ul li a:hover, #site-header #site-navigation ul li.megamenu ul li.current-menu-item > a, .single-post #site-header #site-navigation ul li.megamenu ul li.current_page_parent > a,#site-header #site-navigation ul li.megamenu ul li.current-menu-ancestor > a, #site-navigation ul li ul li.menu-item-has-children:hover:after {color:'. ot_get_option('submenu_link_hover_color'). '}' : '';
	(ot_get_option('megamenu_title_color') != '') ? $custom_css .= '#site-header #site-navigation ul li.megamenu > ul > li > a, #site-header #site-navigation ul li.megamenu > ul > li:hover > a,  #site-header #site-navigation ul li.megamenu ul li.current-menu-ancestor > a {color:'. ot_get_option('megamenu_title_color'). '}' : '';
	(ot_get_option('megamenu_separator_color') != '') ? $custom_css .= '#site-navigation ul li ul li, #site-navigation ul > li.megamenu > ul > li {border-color:'. ot_get_option('megamenu_separator_color'). '}' : '';
	
	// Logo
	(ot_get_option('logo_top') != '') ? $custom_css .= '#site-logo {margin-top:'. ot_get_option('logo_top') .'}' : '';
	(ot_get_option('logo_left') != '') ? $custom_css .= '#site-logo {margin-left:'. ot_get_option('logo_left') .'}' : '';
	(ot_get_option('logo_retina') != '') ? $custom_css .= '#site-logo img.retina-logo{width:'. ot_get_option('retina_logo_width') .'; height:'. ot_get_option('retina_logo_height') .';}' : '';
	
	// Menu position
	(ot_get_option('menu_right') != '') ? $custom_css .= '#site-navigation{margin-right:'. ot_get_option('menu_right') .'}' : '';
	
	
	// Headings
	$custom_css .= 'h1{font-size:'. ot_get_option('h1', '30px') .'}';
	$custom_css .= 'h2{font-size:'. ot_get_option('h2', '24px') .'}';
	$custom_css .= 'h3{font-size:'. ot_get_option('h3', '20px') .'}';
	$custom_css .= 'h4{font-size:'. ot_get_option('h4', '18px') .'}';
	$custom_css .= 'h5{font-size:'. ot_get_option('h5', '16px') .'}';
	$custom_css .= 'h6{font-size:'. ot_get_option('h6', '13px') .'}';
	(ot_get_option('headings_color') != '') ? $custom_css .= 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .woocommerce-page.woocommerce-cart .cart-empty, #site-navigation .header_cart_widget .woocommerce .buttons a, #site-navigation .header_cart_widget .woocommerce .total, .tt_event_theme_page h2, .tt_event_theme_page h3, .tt_event_theme_page h4, .tt_event_theme_page h5, #sidebar .widget_nav_menu ul li.current-menu-item a, #sidebar .widget_nav_menu ul li a:hover {color:'. ot_get_option('headings_color') .'}' : '';
	
	// Content style
	(ot_get_option('link_color') != '') ? $custom_css .= 'a {color:'. ot_get_option('link_color') .'}' : '';
	(ot_get_option('link_hover_color') != '') ? $custom_css .= 'a:hover, .widget a:hover, .footer-sidebar a:hover {color:'. ot_get_option('link_hover_color') .'}' : '';
	(ot_get_option('meta_color') != '') ? $custom_css .= '.post-entry-header .entry-meta, .post-entry-header .entry-meta a,.entry-meta-footer ,.entry-meta-footer a{color:'. ot_get_option('meta_color') .'}' : '';
	(ot_get_option('sidebar_text_color') != '') ? $custom_css .= '.page-sidebar .widget{color:'. ot_get_option('sidebar_text_color') .'}' : '';
	(ot_get_option('sidebar_link_color') != '') ? $custom_css .= '.page-sidebar a{color:'. ot_get_option('sidebar_link_color') .'}' : '';
	(ot_get_option('sidebar_link_hover_color') != '') ? $custom_css .= '.page-sidebar a:hover{color:'. ot_get_option('sidebar_link_hover_color') .'}' : '';
	(ot_get_option('sidebar_title_color') != '') ? $custom_css .= '.page-sidebar .widget .widget-title{color:'. ot_get_option('sidebar_title_color') .'}' : '';
	(ot_get_option('sidebar_divider_color') != '') ? $custom_css .= '.page-sidebar .widget ul li,.page-sidebar .widget ul ul{border-color:'. ot_get_option('sidebar_divider_color') .'}' : '';

	// Body background
	$body_bg = ot_get_option('body_background');
	if ( ot_get_option('layout_style') != 'full-width' && ot_get_option('use_pattern') != 'off' ) {
		if ( ! empty( $body_bg ) ){
			$body_styles = array(
				($body_bg['background-color'] != '') ? 'background-color:'. $body_bg['background-color'] : null,
				($body_bg['background-position'] != '') ? 'background-position:'. $body_bg['background-position'] : 'background-position:center',
				($body_bg['background-attachment'] != '') ? 'background-attachment:'. $body_bg['background-attachment'] : null,				
			);
		
			$body_styles = implode('; ', array_filter($body_styles));	
			$custom_css .= 'body{'.$body_styles.'}';
		}

		$custom_css .= 'body{background-image: url('. MNKY_URI .'/images/patterns/'. ot_get_option('background_pattern', 'pattern_1') .'.png);}';
	} else {
		if ( ! empty( $body_bg ) ){
			$body_styles = array(
				($body_bg['background-color'] != '') ? 'background-color:'. $body_bg['background-color'] : null,
				($body_bg['background-image'] != '') ? 'background-image: url('. $body_bg['background-image'] .')' : null,
				($body_bg['background-repeat'] != '') ? 'background-repeat:'. $body_bg['background-repeat'] : null,
				($body_bg['background-position'] != '') ? 'background-position:'. $body_bg['background-position'] : null,
				($body_bg['background-attachment'] != '') ? 'background-attachment:'. $body_bg['background-attachment'] : null,
				($body_bg['background-size'] != '') ? 'background-size:'. $body_bg['background-size'] : null,
				
			);
		
			$body_styles = implode('; ', array_filter($body_styles));	
			$custom_css .= 'body{'.$body_styles.'}';
		}
	}	
	
	// Pre-content style
	if( is_page() || is_single() ){
		$pre_header_bg = get_post_meta( get_the_ID(), 'pre_content_bg', true);
		if ( ! empty( $pre_header_bg ) ){
			$pre_header_styles = array(
				($pre_header_bg['background-color'] != '') ? 'background-color:'. $pre_header_bg['background-color'] : null,
				($pre_header_bg['background-image'] != '') ? 'background-image: url('. $pre_header_bg['background-image'] .')' : null,
				($pre_header_bg['background-repeat'] != '') ? 'background-repeat:'. $pre_header_bg['background-repeat'] : null,
				($pre_header_bg['background-position'] != '') ? 'background-position:'. $pre_header_bg['background-position'] : null,
				($pre_header_bg['background-attachment'] != '') ? 'background-attachment:'. $pre_header_bg['background-attachment'] : null,
				($pre_header_bg['background-size'] != '') ? 'background-size:'. $pre_header_bg['background-size'] : null,
				
			);
		
			$pre_header_styles = implode('; ', array_filter($pre_header_styles));	
			$custom_css .= '.pre-content{'.$pre_header_styles.'}';
		}
	}
	
	
	// Title background
	$title_bg = ot_get_option('title_bg');
	if ( ! empty( $title_bg ) ){
		$title_styles = array(
			($title_bg['background-color'] != '') ? 'background-color:'. $title_bg['background-color'] : null,
			($title_bg['background-image'] != '') ? 'background-image: url('. $title_bg['background-image'] .')' : null,
			($title_bg['background-repeat'] != '') ? 'background-repeat:'. $title_bg['background-repeat'] : null,
			($title_bg['background-position'] != '') ? 'background-position:'. $title_bg['background-position'] : null,
			($title_bg['background-attachment'] != '') ? 'background-attachment:'. $title_bg['background-attachment'] : null,
			($title_bg['background-size'] != '') ? 'background-size:'. $title_bg['background-size'] : null,
			
		);
	
		$title_styles = implode('; ', array_filter($title_styles));	
		$custom_css .= '.page-header{'.$title_styles.'}';
	}
	
	// Title style
	(ot_get_option('title_border') != '') ? $custom_css .= '.page-header{ border-top:1px solid '. ot_get_option('title_border') .'; border-bottom:1px solid '. ot_get_option('title_border') .'}' : '';
	(ot_get_option('title_color') != '') ? $custom_css .= '.page-header h1.page-title{color:'. ot_get_option('title_color') .';}' : '';
	(ot_get_option('breadcrumbs_color') != '') ? $custom_css .= '.breadcrumbs-trail,.breadcrumbs-trail a, .breadcrumbs-separator{color:'. ot_get_option('breadcrumbs_color') .';}' : '';
	(ot_get_option('breadcrumbs_hover_color') != '') ? $custom_css .= '.breadcrumbs-trail a:hover{color:'. ot_get_option('breadcrumbs_hover_color') .';}' : '';
	
	// Footer background
	$footer_bg = ot_get_option('footer_bg');
	if ( ! empty( $footer_bg ) ){
		$footer_styles = array(
			($footer_bg['background-color'] != '') ? 'background-color:'. $footer_bg['background-color'] : null,
			($footer_bg['background-image'] != '') ? 'background-image: url('. $footer_bg['background-image'] .')' : null,
			($footer_bg['background-repeat'] != '') ? 'background-repeat:'. $footer_bg['background-repeat'] : null,
			($footer_bg['background-position'] != '') ? 'background-position:'. $footer_bg['background-position'] : null,
			($footer_bg['background-attachment'] != '') ? 'background-attachment:'. $footer_bg['background-attachment'] : null,
			($footer_bg['background-size'] != '') ? 'background-size:'. $footer_bg['background-size'] : null,
			
		);
	
		$footer_styles = implode('; ', array_filter($footer_styles));	
		$custom_css .= '.footer-sidebar{'.$footer_styles.'}';
	}
	// Footer style
	(ot_get_option('footer_text_color') != '') ? $custom_css .= '.footer-sidebar .widget{color:'. ot_get_option('footer_text_color') .'}' : '';
	(ot_get_option('footer_link') != '') ? $custom_css .= '.footer-sidebar a{color:'. ot_get_option('footer_link') .'}' : '';
	(ot_get_option('footer_link_hover') != '') ? $custom_css .= '.footer-sidebar a:hover{color:'. ot_get_option('footer_link_hover') .'}' : '';
	(ot_get_option('footer_widget_title') != '') ? $custom_css .= '.footer-sidebar .widget .widget-title{color:'. ot_get_option('footer_widget_title') .'}' : '';
	
	
	// Copyright background
	$copyright_bg = ot_get_option('copyright_bg');
	if ( ! empty( $copyright_bg ) ){
		$copyright_styles = array(
			($copyright_bg['background-color'] != '') ? 'background-color:'. $copyright_bg['background-color'] : null,
			($copyright_bg['background-image'] != '') ? 'background-image: url('. $copyright_bg['background-image'] .')' : null,
			($copyright_bg['background-repeat'] != '') ? 'background-repeat:'. $copyright_bg['background-repeat'] : null,
			($copyright_bg['background-position'] != '') ? 'background-position:'. $copyright_bg['background-position'] : null,
			($copyright_bg['background-attachment'] != '') ? 'background-attachment:'. $copyright_bg['background-attachment'] : null,
			($copyright_bg['background-size'] != '') ? 'background-size:'. $copyright_bg['background-size'] : null,
			
		);
	
		$copyright_styles = implode('; ', array_filter($copyright_styles));	
		$custom_css .= '.site-info{'.$copyright_styles.'}';
	}
	
	// Copyright style
	(ot_get_option('copyright_text_color') != '') ? $custom_css .= '.site-info .widget{color:'. ot_get_option('copyright_text_color') .'}' : '';
	(ot_get_option('copyright_link') != '') ? $custom_css .= '.site-info a{color:'. ot_get_option('copyright_link') .'}' : '';
	(ot_get_option('copyright_link_hover') != '') ? $custom_css .= '.site-info a:hover{color:'. ot_get_option('copyright_link_hover') .'}' : '';
	(ot_get_option('copyright_widget_title') != '') ? $custom_css .= '.site-info .widget .widget-title{color:'. ot_get_option('copyright_widget_title') .'}' : '';
	
	// Blog
	(ot_get_option('blog_post_text_align') != '') ? $custom_css .= '.blog article.post-entry {text-align:'. ot_get_option('blog_post_text_align') .'}' : '';
	(ot_get_option('single_post_text_align') != '') ? $custom_css .= '.single-post article.post-entry {text-align:'. ot_get_option('single_post_text_align') .'}' : '';
	
	// Misc element colors
	(ot_get_option('body_text_color') != '') ? $custom_css .= '#content h4.wpb_toggle{color:'. ot_get_option('body_text_color') .'}' : '';
	
	// Mobile style
	if ( class_exists('Mobile_Detect') ){
		$detect = new Mobile_Detect;
		if ( $detect->isMobile() ) {
			$custom_css .= '@media only screen and (max-width : 1024px){
				.wpb_row, .pre-content {background-attachment:scroll !important;}
			}';
		}
	}

	
	// Custom CSS from option panel
	$custom_css .=  ot_get_option('custom_css');
	
	wp_add_inline_style( 'main', $custom_css );
}

add_action('wp_enqueue_scripts', 'mnky_custom_css');
?>