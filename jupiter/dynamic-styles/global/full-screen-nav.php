<?php

global $mk_options;


Mk_Static_Files::addGlobalStyle("

.mk-fullscreen-nav{
	background-color:{$mk_options['fullscreen_nav_bg_color']};
}

.mk-fullscreen-nav-logo {
	margin-bottom: {$mk_options['fullscreen_nav_logo_margin']}px;
}

.fullscreen-navigation-ul .menu-item a{
	color: {$mk_options['fullscreen_nav_link_color']};
	text-transform: {$mk_options['fullscreen_nav_menu_text_transform']};
	font-size: {$mk_options['fullscreen_nav_menu_font_size']}px;
	letter-spacing: {$mk_options['fullscreen_nav_menu_letter_spacing']};
	font-weight: {$mk_options['fullscreen_nav_menu_font_weight']};
	padding: {$mk_options['fullscreen_nav_menu_gutter']}px 0;
}
.fullscreen-navigation-ul .menu-item a:hover{
	background-color: {$mk_options['fullscreen_nav_link_hov_bg_color']};
	color: {$mk_options['fullscreen_nav_link_hov_color']};
}

");	