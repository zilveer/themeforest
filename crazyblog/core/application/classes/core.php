<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Core {

	private static $_instance = null;
	public $view = null;

	private function __construct() {
		$this->view = new crazyblog_View();
	}

	static public function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	protected function __clone() {
		
	}

}
