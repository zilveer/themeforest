<?php

class VP_Control_Field_Time extends VP_Control_Field {

	private $_min_time;
	private $_max_time;
	private $_format;

	public function __construct() {
		parent::__construct();
	}

	public static function withArray( $arr = array(), $class_name = null ) {
		if ( is_null( $class_name ) )
			$instance = new self();
		else
			$instance = new $class_name;
		$instance->_basic_make( $arr );
		$instance->set_min_time( isset( $arr['min_time'] ) ? $arr['min_time'] : ''  );
		$instance->set_max_time( isset( $arr['max_time'] ) ? $arr['max_time'] : ''  );
		$instance->set_format( isset( $arr['format'] ) ? $arr['format'] : 'h:i:s a'  );
		return $instance;
	}

	protected function _setup_data() {
		$opt = array(
			'minTime' => $this->get_min_time(),
			'maxTime' => $this->get_max_time(),
			'timeFormat' => $this->get_format(),
			'value' => $this->get_value()
		);
		$this->add_data( 'opt', VP_Util_Text::make_opt( $opt ) );
		parent::_setup_data();
	}

	public function render( $is_compact = false ) {

		// Setup Data
		$this->_setup_data();
		$this->add_data( 'is_compact', $is_compact );
		return VP_View::instance()->load( 'control/time', $this->get_data() );
	}

	/**
	 * Get Minimum time
	 *
	 * @return String Minimum time
	 */
	public function get_min_time() {
		return $this->_min_time;
	}

	/**
	 * Set Minimum time
	 *
	 * @param String $_min_time Minimum time
	 */
	public function set_min_time( $_min_time ) {
		$this->_min_time = $_min_time;
		return $this;
	}

	/**
	 * Get Maximum time
	 *
	 * @return String Maximum time
	 */
	public function get_max_time() {
		return $this->_max_time;
	}

	/**
	 * Set Maximum time
	 *
	 * @param String $_max_time Maximum time
	 */
	public function set_max_time( $_max_time ) {
		$this->_max_time = $_max_time;
		return $this;
	}

	/**
	 * Get time Format
	 *
	 * @return String time format
	 */
	public function get_format() {
		return $this->_format;
	}

	/**
	 * Set time Format
	 *
	 * @param String $_format time format
	 */
	public function set_format( $_format ) {
		$this->_format = $_format;
		return $this;
	}

}

/**
 * EOF
 */