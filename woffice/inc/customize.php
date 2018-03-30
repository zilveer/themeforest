<?php 
/**
 * We get all the style options from the Theme Settings and we inject CSS in the page's header
 *
 * @return string
 */
function woffice_get_custom_css()
{

	/*---------------------------------------------------------
	**
	** MAIN FONTS SETTINGS
	**
	----------------------------------------------------------*/
	$font_main_typography = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('font_main_typography') : '';
	$font_headline_typography = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('font_headline_typography') : '';
	$font_headline_bold = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('font_headline_bold') : '';
	$font_headline_uppercase = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('font_headline_uppercase') : '';
	$dashboard_headline_uppercase = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('dashboard_headline_uppercase') : '';
	$menu_headline_uppercase = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_headline_uppercase') : '';

	require_once 'css_arrays/font_main.php';
	$font_main_ready = implode(", ", $font_main);

	$css = $font_main_ready . '{';
	$css .= 'font-family: ' . $font_main_typography['family'] . ',helvetica, arial, sans-serif; ';
	$css .= 'font-size: ' . $font_main_typography['size'] . 'px;';
	$css .= '}';
	$css .= 'h1, h2, h3, h4, h5, h6, #content-container .infobox-head{';
	$css .= 'font-family: ' . $font_headline_typography['family'] . ',helvetica, arial, sans-serif; ';
	$css .= '}';
	$css .= 'h1, h2, h3, h4, h5, h6{';
	if ($font_headline_uppercase == "yep"):
		$css .= 'text-transform: uppercase;';
	endif;
	if ($font_headline_bold == "yep"):
		$css .= 'font-weight: bold;';
	endif;
	$css .= '}';
	$css .= '#content-container .intern-box.box-title h3{';
	if ($dashboard_headline_uppercase == "yep"):
		$css .= 'text-transform: uppercase;';
	else:
		$css .= 'text-transform: none;';
	endif;
	$css .= '}';
	if ($menu_headline_uppercase == "yep"):
		$css .= '.main-menu li > a{';
		$css .= 'text-transform: uppercase;';
		$css .= '}';
	endif;
	/*---------------------------------------------------------
	**
	** MAIN COLORS SETTINGS
	**
	----------------------------------------------------------*/
	$color_colored = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_colored') : '';
	$color_text = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_text') : '';
	$color_main_bg = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_main_bg') : '';
	$headline_color = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_headline') : '';
	$color_light1 = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_light1') : '';
	$color_light2 = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_light2') : '';
	$color_light3 = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_light3') : '';
	$color_notifications = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_notifications') : '';
	$color_notifications_green = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('color_notifications_green') : '';

	require_once 'css_arrays/colored_color.php';
	$colored_color_ready = implode(", ", $colored_color);
	$css .= $colored_color_ready . '{';
	$css .= 'color: ' . esc_html($color_colored) . ';';
	$css .= '}';
	require_once 'css_arrays/colored_color_important.php';
	$colored_color_important_ready = implode(", ", $colored_color_important);
	$css .= $colored_color_important_ready . '{';
	$css .= 'color: ' . esc_html($color_colored) . ' !important;';
	$css .= '}';
	require_once 'css_arrays/colored_color_background.php';
	$colored_color_background_ready = implode(", ", $colored_color_background);
	$css .= $colored_color_background_ready . '{';
	$css .= 'background-color: ' . esc_html($color_colored) . ';';
	$css .= '}';
	$css .= '.gantt::-webkit-scrollbar{';
	$css .= 'background-color: ' . esc_html($color_colored) . ' !important;';
	$css .= '}';

	/*FIREFOX FIX*/
	require_once 'css_arrays/colored_background_important.php';
	$colored_background_important_ready = implode(", ", $colored_background_important);
	$css .= $colored_background_important_ready . '{';
	//$css .= 'background-color: '.esc_html($color_colored).' !important;';
	$css .= 'background-color: ' . esc_html($color_colored) . ' !important;';
	$css .= '}';

	require_once 'css_arrays/colored_border_important.php';
	$colored_border_important_ready = implode(", ", $colored_border_important);
	$css .= $colored_border_important_ready . '{';
	$css .= 'border-color: ' . esc_html($color_colored) . ' !important';
	$css .= '}';
	require_once 'css_arrays/color_text_color.php';
	$color_text_color_ready = implode(", ", $color_text_color);
	$css .= '.woocommerce #content-container div.product p.price .amount:after, .it-exchange-product-price ins:after{border-right-color:' . esc_html($color_colored) . '}';
	$css .= $color_text_color_ready . '{';
	$css .= 'color: ' . esc_html($color_text) . ';';
	$css .= '}';
	$css .= '#buddypress div#message,#bp-uploader-warning{';
	$css .= 'background-color: ' . esc_html($color_text) . ';';
	$css .= '}';
	$css .= '#left-content, #user-sidebar, #main-content{';
	$css .= 'background: ' . esc_html($color_main_bg) . ';';
	$css .= '}';
	$css .= '.box .intern-padding h1,.box .intern-padding h2,.box .intern-padding h3,.box .intern-padding h4,.box .intern-padding h5,.box .intern-padding h6{';
	$css .= 'color: ' . $headline_color . ';';
	$css .= '}';
	require_once 'css_arrays/color_light1_color.php';
	$color_light1_color_ready = implode(", ", $color_light1_color);
	$css .= $color_light1_color_ready . '{';
	$css .= 'background: ' . esc_html($color_light1) . ';';
	$css .= '}';

	require_once 'css_arrays/color_light1_border.php';
	$color_light1_border_ready = implode(", ", $color_light1_border);
	$css .= $color_light1_border_ready . '{';
	$css .= 'border-color: ' . esc_html($color_light1) . ';';
	$css .= '}';
	$css .= '.it-exchange-super-widget .it-exchange-sw-product, .it-exchange-super-widget .it-exchange-sw-processing, .it-exchange-product-price, .it-exchange-super-widget .cart-items-wrapper .cart-item, .it-exchange-super-widget .payment-methods-wrapper, .it-exchange-account .it-exchange-customer-menu, #it-exchange-purchases .it-exchange-purchase, #it-exchange-downloads .it-exchange-download-wrapper {';
	$css .= 'border-color: ' . esc_html($color_light1) . ' !important;';
	$css .= '}';


	$css .= '#content-container .bp_members #buddypress #item-nav.intern-box div.item-list-tabs ul li a,#content-container .bp_group #buddypress #item-nav.intern-box div.item-list-tabs ul li a{border-top-color: ' . esc_html($color_light1) . ';border-right-color: ' . esc_html($color_light1) . ';border-bottom-color: ' . esc_html($color_light1) . ';}';
	$css .= '#buddypress .rtm-like-comments-info:after{border-bottom-color: ' . esc_html($color_light1) . ';}';

	$css .= '.wcContainer .wcMessage .wcMessageContent:before{color: ' . esc_html($color_light1) . ';}';

	require_once 'css_arrays/color_light2_background.php';
	$color_light2_background_ready = implode(", ", $color_light2_background);
	$css .= $color_light2_background_ready . '{';
	$css .= 'background: ' . esc_html($color_light2) . ';';
	$css .= '}';
	$css .= '#buddypress .activity-list .activity-content::before{';
	$css .= 'color: ' . $color_light2 . ';';
	$css .= '}';

	require_once 'css_arrays/color_light3_color.php';
	$color_light3_array_ready = implode(", ", $color_light3_array);
	$css .= $color_light3_array_ready . '{';
	$css .= 'color: ' . esc_html($color_light3) . ';';
	$css .= '}';
	require_once 'css_arrays/color_light3_color_important.php';
	$color_light3_array_important_ready = implode(", ", $color_light3_color_important);
	$css .= $color_light3_array_important_ready . '{';
	$css .= 'color: ' . esc_html($color_light3) . ' !important;';
	$css .= '}';
	require_once 'css_arrays/color_light3_border.php';
	$color_light3_border_ready = implode(", ", $color_light3_border);
	$css .= $color_light3_border_ready . '{';
	$css .= 'border-color: ' . esc_html($color_light3) . ';';
	$css .= '}';
	require_once 'css_arrays/color_notification.php';
	$color_notifications_array_ready = implode(", ", $color_notifications_array);
	$css .= $color_notifications_array_ready . '{background: ' . esc_html($color_notifications) . ' !important;}';
	require_once 'css_arrays/color_notification_green.php';
	$color_notifications_array_green_ready = implode(", ", $color_notifications_array_green);
	$css .= $color_notifications_array_green_ready . '{background: ' . esc_html($color_notifications_green) . ' !important;}';
	$css .= '.assigned-tasks-empty i.fa,.woffice-poll-ajax-reply.sent i.fa{color: ' . esc_html($color_notifications_green) . ' !important;}';


	/*---------------------------------------------------------
	**
	** MENU SETTINGS
	**
	----------------------------------------------------------*/
	$menu_background = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_background') : '';
	$menu_width = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_width') : '';
	$menu_color2 = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_color2') : '';
	$menu_hover = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_hover') : '';
	$menu_width = esc_html($menu_width);
	$menu_background = esc_html($menu_background);
	$css .= '#navigation{width: ' . $menu_width . 'px;background: ' . $menu_background . ';}';
	$css .= '.main-menu ul.sub-menu li a, .main-menu ul.sub-menu li.current-menu-item a{background: ' . $menu_background . '}';
	$css .= 'body.menu-is-vertical #navigation.navigation-hidden{left: -' . $menu_width . 'px;}';
	$css .= 'body.rtl #navigation.navigation-hidden{left: auto; right: -' . $menu_width . 'px;}';
	$css .= '.main-menu{max-width: ' . $menu_width . 'px;}';
	$css .= '.main-menu ul.sub-menu{left: -' . (2 * $menu_width) . 'px;}';
	$css .= '.main-menu ul.sub-menu.display-submenu,.main-menu .mega-menu.open{left: ' . $menu_width . 'px;}';
	$css .= '.main-menu ul.sub-menu li a{width: ' . (2 * $menu_width) . 'px;}';
	/*THIRD LEVEL SUPPORT*/
	$css .= '.main-menu ul.sub-menu.display-submenu ul.sub-menu.display-submenu{left: ' . (2 * $menu_width) . 'px;}';
	$css .= '@media only screen and (min-width: 993px) {';
	$css .= '.main-menu ul.sub-menu li:hover > .sub-menu {left: ' . (2 * $menu_width) . 'px !important;}';
	$css .= 'body.rtl.menu-is-vertical .main-menu ul.sub-menu li:hover > .sub-menu {left: auto; right: ' . (2 * $menu_width) . 'px !important;}';
	$css .= 'body.rtl .main-menu ul.sub-menu{left auto; right: ' . ($menu_width) . 'px !important;}';
	$css .= 'body.rtl.menu-is-vertical .main-menu ul.sub-menu{left: auto; right: ' . ($menu_width) . 'px !important;}';
	$css .= '}';


	$css .= '.main-menu ul.sub-menu li a:hover,.main-menu li > a:hover, .main-menu li.current-menu-item a, .main-menu li.current_page_item a{ background: ' . $menu_hover . ';}.main-menu li > a{ border-color: ' . esc_html($menu_color2) . ';}';

	// LAYOUT
	$css .= '#main-header #navbar.navigation-fixed{left: ' . $menu_width . 'px; padding-right: ' . $menu_width . 'px;}';
	$css .= 'body.rtl.menu-is-vertical #navbar.navigation-fixed{left: 0; right: ' . $menu_width . 'px;}';
	$css .= '#main-content:not(.navigation-hidden), #main-header:not(.navigation-hidden), #main-footer:not(.navigation-hidden){padding-left: ' . $menu_width . 'px;}';
	$css .= 'body.rtl.menu-is-vertical #main-content:not(.navigation-hidden), body.rtl.menu-is-vertical #main-header:not(.navigation-hidden), body.rtl.menu-is-vertical #main-footer:not(.navigation-hidden){padding-left: 0; padding-right: ' . $menu_width . 'px;}';

	//MOBILE CHANGES SINCE 1.4.3
	$css .= '@media only screen and (max-width: 992px) {';
	$css .= '#navbar.navigation-fixed{left: ' . (2 * $menu_width) . 'px;}';
	$css .= '#navigation{width: ' . (2 * $menu_width) . 'px;}';
	$css .= '.main-menu{max-width: ' . (2 * $menu_width) . 'px;}';
	$css .= '#main-content:not(.navigation-hidden), #main-header:not(.navigation-hidden), #main-footer:not(.navigation-hidden){padding-left: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.menu-is-vertical #navigation.navigation-hidden{left: -' . (2 * $menu_width) . 'px;}';
	$css .= 'body.rtl #navigation.navigation-hidden{left: auto; right: -' . (2 * $menu_width) . 'px;}';
	$css .= '#main-content, #main-header, #main-footer{padding-left: ' . (2 * $menu_width) . 'px;}';
	$css .= '#main-header:not(.navigation-hidden) #navbar.navigation-fixed a#nav-trigger{left: ' . $menu_width . 'px;}';
	$css .= '}';
	$css .= 'body.force-responsive #navbar.navigation-fixed{left: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.force-responsive #navigation{width: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.force-responsive .main-menu{max-width: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.force-responsive #main-header:not(.navigation-hidden){padding-left: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.rtl.force-responsive #main-header:not(.navigation-hidden){padding-right: ' . (2 * $menu_width) . 'px;}';
	$css .= 'body.menu-is-vertical.force-responsive #navigation.navigation-hidden{left: -' . (2 * $menu_width) . 'px;}';
	$css .= 'body.rtl.force-responsive #navigation.navigation-hidden{left: auto; right: -' . (2 * $menu_width) . 'px;}';

	/*---------------------------------------------------------
	**
	** HEADER SETTINGS
	**
	----------------------------------------------------------*/
	$header_height = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_height') : '';
	$header_logo_bg = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_logo_bg') : '';
	$header_width = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_width') : '';
	$header_color = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_color') : '';
	$header_link = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_link') : '';
	$header_background = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_background') : '';
	$header_link_hover = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_link_hover') : '';
	$header_bold = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_bold') : '';
	$header_user = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('header_user') : '';
	$css .= '#nav-logo{width: ' . esc_html($header_width) . 'px;}';
	/*Horizontal Menu*/
	$menu_layout = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_layout') : '';
	if ($menu_layout == "horizontal") {
		$css .= 'body.menu-is-horizontal #navigation{top: ' . ($header_height + 2) . 'px ;}';
		$css .= 'body.menu-is-horizontal.admin-bar #navigation{top: ' . ($header_height + 32) . 'px;}';

		$css .= '@media only screen and (max-width: 783px) {';
		$css .= 'body.menu-is-horizontal.admin-bar #navigation{top: ' . ($header_height + 46) . 'px;}';
		$css .= '}';
	}
	/*End*/
	$css .= '#navbar{';
	$css .= 'height: ' . esc_html($header_height) . 'px;';
	$css .= '-webkit-box-shadow: 0 0 10px 1px rgba(0,0,0,.2);';
	$css .= '-moz-box-shadow: 0 0 10px 1px rgba(0,0,0,.2);';
	$css .= '-ms-box-shadow: 0 0 10px 1px rgba(0,0,0,.2);';
	$css .= '-o-box-shadow: 0 0 10px 1px rgba(0,0,0,.2);';
	$css .= 'box-shadow: 0 0 10px 1px rgba(0,0,0,.2);';
	$css .= '}';
	$css .= '#navbar.navigation-fixed{height: ' . esc_html($header_height) . 'px;}';
	$css .= '#navbar{';
	$css .= 'line-height: ' . esc_html($header_height) . 'px;';
	$css .= 'background-color: ' . esc_html($header_background) . ';';
	$css .= '}';
	$css .= '#navbar #nav-user a#user-thumb {';
	$css .= 'color: ' . esc_html($header_color) . ';';
	$css .= '}';
	$css .= '#nav-left{height: ' . esc_html($header_height) . 'px;}';
	$css .= 'a#nav-trigger, #nav-buttons a{color: ' . esc_html($header_link) . ';}';
	$css .= 'a#nav-trigger:hover,#nav-buttons a:hover {color: ' . esc_html($header_link) . ';}';
	/*Fix for the searchform on mobile - Added in 1.4.2 */
	$css .= '@media only screen and (max-width: 992px) {#main-search .container{padding-top: ' . esc_html($header_height) . 'px;}}';
	$css .= '@media only screen and (max-width: 450px) {#navigation{top: ' . esc_html($header_height) . 'px;}.logged-in.admin-bar #navigation{top: ' . ($header_height + 45) . 'px;}}';

	/*WE PICK THE COLOR FROM THE MENU (not fair)*/
	$css .= '#nav-user{';
	$css .= 'color: ' . esc_html($menu_background) . ';';
	$css .= '}';
	$css .= '#main-search{';
	$css .= 'background-color: ' . esc_html($menu_background) . ';';
	$css .= '}';
	/*---------------------------------------------------------
	**
	** PAGE TITLE SETTINGS
	**
	----------------------------------------------------------*/
	$main_featured_image = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_image') : '';
	$main_featured_height = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_height') : '';
	$main_featured_font_size = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_font_size') : '';
	$main_featured_uppercase = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_uppercase') : '';
	$main_featured_color = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_color') : '';
	$main_featured_opacity = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_opacity') : '';
	$main_featured_bg = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_bg') : '';
	$main_featured_border = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_border') : '';
	$main_featured_border_color = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_border_color') : '';
	$main_featured_alignment = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_alignment') : '';
	$main_featured_bold = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('main_featured_bold') : '';
	$main_featured_height = esc_html($main_featured_height);
	if ($main_featured_border == "yep") :
		$css .= '#featuredbox{';
		$css .= 'border-color: ' . esc_html($main_featured_border_color) . ' !important;';
		$css .= 'border-bottom: 6px solid;';
		$css .= '}';
	endif;
	$css .= '#featuredbox .pagetitle, #featuredbox .pagetitle h1{';
	$css .= 'color: ' . $main_featured_color . ';';
	$css .= '}';
	$css .= '#featuredbox.centered .pagetitle > h1{';
	if ($main_featured_uppercase == true) :
		$css .= 'text-transform: uppercase;';
	else:
		$css .= 'text-transform: none;';
	endif;
	$css .= ($main_featured_bold == true) ? 'font-weight: bold;' : 'font-weight: 200;';
	$css .= (!empty($main_featured_font_size)) ? 'font-size: ' . $main_featured_font_size . 'px;' : 'font-size: 4em;';
	$css .= '}';
	$css .= '#featuredbox .pagetitle{';
	$css .= 'height: ' . ($main_featured_height - 44) . 'px;';
	$css .= '}';
	$css .= '#featuredbox.has-search .featured-background,#featuredbox.has-search .pagetitle{';
	$css .= 'height: ' . ($main_featured_height + 50) . 'px;';
	$css .= '}';
	$css .= '#featuredbox .featured-background{';
	$css .= 'height: ' . $main_featured_height . 'px;';
	$css .= '}';
	$css .= '.featured-layer{';
	$css .= 'background-color: ' . $main_featured_bg . ';';
	$css .= 'opacity: ' . esc_html($main_featured_opacity) . ';';
	$css .= '}';
	$css .= '#featuredbox .featured-background{';
	$css .= 'background-position: ' . $main_featured_alignment . ' center;';
	$css .= '}';
	if (!empty($main_featured_font_size)) {
		$css .= '@media only screen and (max-width: 600px) {';
		$css .= '#featuredbox .pagetitle > h1, #featuredbox.has-search.is-404 .pagetitle > h1, #featuredbox.has-search.search-buddypress .pagetitle > h1 {';
		$css .= 'font-size: ' . round($main_featured_font_size / 2) . 'px !important;';
		$css .= '}';
		$css .= '}';
	}
	/*---------------------------------------------------------
	**
	** WOFFICE 2.0 changes
	**
	----------------------------------------------------------*/
	$design_update = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('design_update') : '';
	if ($design_update == "2.X") {
		$css .= 'body.woffice-2-x .featured-layer{';
		$css .= 'background: ' . $main_featured_bg . ';';
		$css .= 'background: -webkit-linear-gradient(-30deg, ' . woffice_get_adjust_brightness($main_featured_bg, -80) . ' , ' . woffice_get_adjust_brightness($main_featured_bg, 20) . ');';
		$css .= 'background: linear-gradient(-30deg, ' . woffice_get_adjust_brightness($main_featured_bg, -80) . ' , ' . woffice_get_adjust_brightness($main_featured_bg, 20) . ');';
		$css .= '}';
		$css .= 'body.woffice-2-x .progress-bar,
		 body.woffice-2-x .btn.btn-default{';
		$css .= 'background: ' . $color_colored . ';';
		$css .= 'background: -webkit-linear-gradient(-30deg, ' . woffice_get_adjust_brightness($color_colored, -10) . ' , ' . woffice_get_adjust_brightness($color_colored, 10) . ');';
		$css .= 'background: linear-gradient(-30deg, ' . woffice_get_adjust_brightness($color_colored, -10) . ' , ' . woffice_get_adjust_brightness($color_colored, 10) . ') !important;';
		$css .= '}';
        $css .= 'body.woffice-2-x .main-menu ul.sub-menu li > a:hover,body.woffice-2-x .main-menu li > a:hover,
		 body.woffice-2-x .main-menu li.current-menu-item > a, .main-menu li.current_page_item > a{';
        $css .= 'background: ' . $menu_hover . ';';
        $css .= 'background: -webkit-linear-gradient(-30deg, ' . woffice_get_adjust_brightness($menu_hover, -10) . ' , ' . woffice_get_adjust_brightness($menu_hover, 10) . ');';
        $css .= 'background: linear-gradient(-30deg, ' . woffice_get_adjust_brightness($menu_hover, -10) . ' , ' . woffice_get_adjust_brightness($menu_hover, 10) . ') !important;';
        $css .= '}';
	}
	/*---------------------------------------------------------
	**
	** FOOTER & EXTRA FOOTER SETTINGS
	**
	----------------------------------------------------------*/
	$footer_color 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_color') : '';
	$footer_link 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_link') : '';
	$footer_background 			= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_background') : '';
	$footer_copyright_background= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_copyright_background') : '';
	$footer_border_color		= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_border_color') : '';
	$extrafooter_border_color   = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('extrafooter_border_color') : '';
	$footer_copyright_uppercase   = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_copyright_uppercase') : '';

	$css .= '#widgets{';
		$css .= 'background-color: '.esc_html($footer_background).';';
		$css .= 'color: '.esc_html($footer_color).';';
	$css .= '}';
	$css .= '#copyright{';
		$css .= 'background-color: '.esc_html($footer_copyright_background).';';
		$css .= 'border-color: '.esc_html($footer_border_color).';';
	$css .= '}';
	$css .= '#copyright p, #widgets p{';
		$css .= 'color: '.esc_html($footer_color).';';
	$css .= '}';
	if (!empty($footer_copyright_uppercase)){
		$css .= '#copyright p{';
			$css .= 'text-transform: uppercase;';
		$css .= '}';
	}
	$css .= '#widgets .widget{';
		$css .= 'border-color: '.esc_html($color_text).';';
	$css .= '}';
	$css .= '#widgets h3:after, #widgets .widget.widget_search button{';
		$css .= 'background-color: '.esc_html($footer_link).';';
	$css .= '}';
	$css .= '#copyright a, #widgets a, #extrafooter-layer h1 span{';
		$css .= 'color: '.esc_html($footer_link).';';
	$css .= '}';
	$css .= '#extrafooter{';
		$css .= 'border-color: '.esc_html($extrafooter_border_color).';';
	$css .= '}';
	/* /!\ NEED CHANGE */
	$css .= '#widgets .widget{';
		$css .= 'border-color: '.esc_html($color_text).';';
	$css .= '}';
	$css .= '#extrafooter-layer{';
		$css .= 'background: rgba(0,0,0,.5);';
	$css .= '}';

	/*---------------------------------------------------------
	**
	** SIDEBAR SETTINGS
	**
	----------------------------------------------------------*/
	$sidebar_mobile 			= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('sidebar_mobile') : '';
	$sidebar_min 	     		= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('sidebar_min') : '';
	//$css .= '#right-sidebar{ min-height: '.esc_html($sidebar_min).'px;}';
	$css .= ' @media only screen and (max-width: 992px) {';
		$css .= '#nav-sidebar-trigger {';
			if( $sidebar_mobile == "yep" )
				$css .= "display: table-cell !important;";
			else
				$css .= "display: none !important;";
		$css .= '}}';



	/*---------------------------------------------------------
	**
	** DASHBOARD SETTINGS
	**
	----------------------------------------------------------*/
	$dashboard_columns = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('dashboard_columns') : '';
	$css .= '#dashboard .widget{';
		if (!empty($dashboard_columns)){
			if ($dashboard_columns == '1'){
				$css .= 'width: 98%;';
			}
			elseif ($dashboard_columns == '2'){
				$css .= 'width: 48%;';
			}
			else{
				$css .= 'width: 31.2%;';
			}
		}
		else {
			$css .= 'width: 31.2%;';
		}
	$css .= '}';

	/*---------------------------------------------------------
	**
	** BLOG MASONRY SETTINGS
	**
	----------------------------------------------------------*/
	$masonry_columns = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('masonry_columns') : '';
	$css .= '#content-container .masonry-layout .box{';
	if (!empty($masonry_columns)){
		if ($masonry_columns == '1'){
			$css .= 'width: 98%;';
		}
		elseif ($masonry_columns == '2'){
			$css .= 'width: 48%;';
		}
		else{
			$css .= 'width: 31.2%;';
		}
	}
	else {
		$css .= 'width: 31.2%;';
	}
	$css .= '}';

	/*---------------------------------------------------------
	**
	** LOGIN PAGE SETTINGS
	**
	----------------------------------------------------------*/
	$login_custom 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_custom') : '';
	$login_background_color 	= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_background_color') : '';
	$login_background_image 	= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_background_image') : '';
	$login_background_opacity 	= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_background_opacity') : '';
	//$login_logo_image 			= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_logo_image') : '';
	$login_logo_image_width 	= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_logo_image_width') : '';
	//$login_logo_image_height 	= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_logo_image_height') : '';

	if ($login_custom != "nope") :
		$css .= '#woffice-login{';
			$css .= 'background-color: '.esc_html($login_background_color).';';
		$css .= '}';

		$css .= '#woffice-login-left{';
			if (!empty($login_background_image)):
				$css .= "background-image: url(".esc_url($login_background_image["url"]).");";
			else :
				$css .= "background-image: url(".get_template_directory_uri() ."/images/1.jpg);";
			endif;
			$css .= "background-repeat: no-repeat;";
			$css .= "
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;";
			$css .= "background-position: center top;";
			$css .= "opacity: ".esc_html($login_background_opacity).";";
			$css .= '}';

		/*if (!empty($login_logo_image)):
			echo "#login-logo{";
				echo "background-image: url(".esc_url($login_logo_image["url"]).");";
				echo "background-size: ".$login_logo_image_width."px ".$login_logo_image_height."px;";
				echo "width: ".esc_html($login_logo_image_width)."px;";
				echo "height: ".esc_html($login_logo_image_height)."px;";
			echo "}";
		endif;*/

		if (!empty($login_logo_image_width)) {
			$css .= '#login-logo img {';
			$css .= '  width: '.intval($login_logo_image_width).'px;';
			$css .= '}';
		}


	endif;

	/*---------------------------------------------------------
	**
	** PAGE LOADING OPTION
	**
	----------------------------------------------------------*/
	$page_loading 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('page_loading') : '';
	if ($page_loading == "no") :
		$css .= ".pace {display: none !important;}";
	endif;

	/*---------------------------------------------------------
	**
	** REMOVE BORDER RADIUS OPTION
	**
	----------------------------------------------------------*/
	$remove_radius 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('remove_radius') : '';
	if ($remove_radius == true) :
		require_once 'css_arrays/border_radius.php';
		$border_radius_ready = implode (", ", $border_radius);
		$css .= $border_radius_ready."{border-radius:0!important}";
	endif;

	/*---------------------------------------------------------
	**
	** CUSTOM CSS
	**
	----------------------------------------------------------*/
	$custom_css 				= ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('custom_css') : '';
	$css .= $custom_css;


	return $css;


}

function woffice_save_custom_css() {

	update_option('woffice_custom_css', woffice_get_custom_css());

}
add_action('fw_settings_form_saved', 'woffice_save_custom_css');

function woffice_custom_css_header() {
	echo '<!-- Custom CSS from Woffice -->';
	echo '<style type="text/css">';
		$custom_css = get_option('woffice_custom_css');
		if(!empty($custom_css)) {
			echo '/*FROM : Database options*/';
			echo $custom_css;
		} else {
			echo '/*FROM : Dynamical load*/';
			echo woffice_get_custom_css();
		}
	echo '</style>';
}
add_action( 'wp_head', 'woffice_custom_css_header' );

/**
* We output the Custom JS set in the theme setiings in the footer
*
*/
function woffice_custom_js() {
    $custom_js = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('custom_js') : ''; 
    if (!empty($custom_js)){ 
	    echo '<script type="text/javascript">';
	    	echo'jQuery(document).ready(function() {';
				echo $custom_js;
	    	echo'});';
	    echo '</script>';
    }
}
add_action( 'wp_footer', 'woffice_custom_js' );

/**
* Revolution Slider Fix on button trigger. We re-create the RevSlider whenever a button is clicked
*
* @return string
*/
function woffice_revSlider_fix() {
	if (class_exists('RevSliderSlider')) {
	    echo '<script type="text/javascript">';
	    	echo 'if (jQuery(".rev_slider").length > 0) {
				jQuery("#nav-trigger, #nav-sidebar-trigger").on("click",function(){
					setTimeout(function () {
						jQuery(".rev_slider_wrapper").revredraw();
			        }, 600);
				});
			}';
	    echo '</script>';
    }
}
add_action( 'wp_footer', 'woffice_revSlider_fix' );

/**
* Register Fonts.
*
* @return string
*/
function woffice_fonts_url() {
    $fonts_url = '';

    //GET FONTS USED IN THE THEME
	$font_main_typography = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('font_main_typography') : ''; 
	$font_headline_typography = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('font_headline_typography') : ''; 
	$font_extentedlatin = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('font_extentedlatin') : '';

	if($font_extentedlatin == "yep"){
		$subset = "&subset=latin,latin-ext";
	}
	else{
		$subset = "";
	}

	if (!empty($font_main_typography)) {
    	$query_args = "family=".$font_main_typography['family'].":100,200,300,400,400italic,600,700italic,800,900|".$font_headline_typography['family'].":100,200,300,400,400italic,600,700italic,800,900".$subset;

		$fonts_url =  '//fonts.googleapis.com/css?'.preg_replace("/ /","+",$query_args);
 
		return $fonts_url;
	}
}