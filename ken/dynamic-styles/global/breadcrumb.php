<?php
global $mk_settings;
$breadcrumb_skin = (!empty($mk_settings['breadcrumb-skin']) && $mk_settings['breadcrumb-skin'] == 'custom' ) ? 1 : 0;
$breadcrumb_custom_color_regular = (!empty($mk_settings['breadcrumb-skin-custom']['regular']) ) ? $mk_settings['breadcrumb-skin-custom']['regular'] : $custom_breadcrumb_color;
$breadcrumb_custom_color_hover = (!empty($mk_settings['breadcrumb-skin-custom']['hover']) ) ? $mk_settings['breadcrumb-skin-custom']['hover'] : $custom_breadcrumb_hover_color;

if($breadcrumb_skin == 1){
	if($custom_breadcrumb_page == 1){
		Mk_Static_Files::addGlobalStyle("
			#mk-breadcrumbs .custom-skin{
				color: {$breadcrumb_custom_color_regular} !important;
			}
			#mk-breadcrumbs .custom-skin a{
				color: {$breadcrumb_custom_color_regular} !important;
			}
			#mk-breadcrumbs .custom-skin a:hover{
				color: {$breadcrumb_custom_color_hover} !important;
			}
		");
	}
}