<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Accordion');

class WPBakeryShortCode_dfd_accordion extends WPBakeryShortCode_VC_Tta_Accordion {

	public function getFileName() {
		return 'dfd_tta_global';
	}

}