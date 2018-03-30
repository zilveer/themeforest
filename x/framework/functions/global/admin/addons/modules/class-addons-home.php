<?php

class X_Addons_Home {

	public static $instance;
	public $script_data = array();

	public function __construct() {

		add_filter( '_x_addons_home_data', array( $this, 'script_data' ) );
	}

	public function script_data( $data ) {

		$modules = array();

		foreach ($this->script_data as $handle => $callback ) {

      if ( is_callable( $callback ) ) {
				$modules[$handle] = call_user_func( $callback );
			}

		}

		$data = array_merge( $data, array(
      'modules' => $modules,
      'notices' => $this->get_active_notices()
    ) );

		return $data;

	}

  public function get_active_notices() {

    if ( isset( $_REQUEST['notice'] ) ) {
      $notices = explode( '|', sanitize_text_field( $_REQUEST['notice'] ) );
      return $notices;
    }

    return array();

  }

	public static function add_script_data( $handle, $callback ) {
		self::$instance->script_data[$handle] = $callback;
	}

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

}