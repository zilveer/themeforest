<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Tabs');

class WPBakeryShortCode_dfd_tta_tabs extends WPBakeryShortCode_VC_Tta_Tabs {

	public function getFileName() {
		return 'dfd_tta_global';
	}
//	public function getParamGap( $atts, $content ) {
//		
//		return null;
//	}
}