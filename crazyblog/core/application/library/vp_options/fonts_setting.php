<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_fonts_setting_menu {

	public $title = 'Fonts Settings';
	public $icon = 'fa-text-height';

	public function crazyblog_menu() {

		$return = array(
		);

		return apply_filters( 'crazyblog_vp_opt_fonts_', $return );
	}

}
