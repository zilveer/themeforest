<?php

class PGL_Widget {
	static function init() {
		self::register_widget( 'categories' );
		self::register_widget( 'estate_search' );
		self::register_widget( 'estate_recent' );
		self::register_widget( 'agent_form' );
	}

	static function register_widget( $name ) {
		$name = 'Widget_' . $name;
		PGL_Loader::find_class( $name, _PREFIX_, 'widgets/' );
		register_widget( _PREFIX_ . $name );
	}
}