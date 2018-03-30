<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

abstract class crazyblog_VC_ShortCode {

	public static function _options( $method ) {

		$called_class = get_called_class();

		return $called_class::$method( 'crazyblog_Shortcodes_Map' );
	}

}
