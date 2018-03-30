<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Tour');

class WPBakeryShortCode_dfd_tta_tour extends WPBakeryShortCode_VC_Tta_Tour {

	public function getFileName() {
		return 'dfd_tta_global';
	}

}