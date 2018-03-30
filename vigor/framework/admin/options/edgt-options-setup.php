<?php

add_action('after_setup_theme', 'edgt_admin_map_init', 0);
function edgt_admin_map_init() {
	global $edgt_options;
	global $edgtFramework;
	global $options_fontstyle;
	global $options_fontweight;
	global $options_texttransform;
	global $options_fontdecoration;
	global $options_arrows_type;
	global $options_double_arrows_type;
	require_once("10.general/map.inc");
	require_once("20.logo/map.inc");
	require_once("30.fonts/map.inc");
	require_once("40.header/map.inc");
	require_once("50.title/map.inc");
	require_once("60.content/map.inc");
	require_once("70.footer/map.inc");
	require_once("80.elements/map.inc");
	require_once("90.blog/map.inc");
	require_once("100.portfolio/map.inc");
	require_once("110.slider/map.inc");
	require_once("120.social/map.inc");
	require_once("130.error404/map.inc");
	if(edgt_visual_composer_installed() && version_compare(edgt_get_vc_version(), '4.4.2') >= 0) {
		require_once("140.visualcomposer/map.inc");
	} else {
		$edgtFramework->edgtOptions->addOption("enable_grid_elements","no");
	}
    if(edgt_contact_form_7_installed()) {
        require_once("150.contactform7/map.inc");
    }
	if(function_exists("is_woocommerce")){
		require_once("160.woocommerce/map.inc");
	}
	require_once("170.reset/map.inc");
}