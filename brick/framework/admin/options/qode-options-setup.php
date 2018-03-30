<?php

add_action('after_setup_theme', 'qode_admin_map_init', 0);
function qode_admin_map_init() {
	global $qode_options;
	global $qodeFramework;
	global $qode_options_fontstyle;
	global $qode_options_fontweight;
	global $qode_options_texttransform;
	global $qode_options_fontdecoration;
	global $qode_options_arrows_type;
	global $qode_options_double_arrows_type;
	global $qode_options_arrows_up_type;
	require_once("10.general/map.inc");
	require_once("20.logo/map.inc");
	require_once("30.header/map.inc");
	require_once("40.footer/map.inc");
	require_once("50.title/map.inc");
	require_once("60.fonts/map.inc");
	require_once("70.elements/map.inc");
	require_once("75.sidebar/map.inc");
	require_once("80.blog/map.inc");
	require_once("90.portfolio/map.inc");
	require_once("95.slider/map.inc");
    require_once("96.verticalsplitslider/map.inc");
	require_once("100.social/map.inc");
	require_once("110.error404/map.inc");
	require_once("130.parallax/map.inc");
	require_once("140.contentbottom/map.inc");
	if(qode_visual_composer_installed() && version_compare(qode_get_vc_version(), '4.4.2') >= 0) {
		require_once("144.visualcomposer/map.inc");
	} else {
		$qodeFramework->qodeOptions->addOption("enable_grid_elements","no");
	}
    if(qode_contact_form_7_installed()) {
        require_once("145.contactform7/map.inc");
    }
    require_once("146.maintenance/map.inc");
	if(function_exists("is_woocommerce")){
		require_once("150.woocommerce/map.inc");
	}
	require_once("160.reset/map.inc");
}