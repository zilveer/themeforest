<?php

class MY_builder extends VP_Control_Field {

	public $_fields = array();
	public $_alchemy;

	public function __construct() {

		parent::__construct();
	}

	public static function withArray( $arr = array(), $class_name = null ) {



		if ( is_null( $class_name ) )
			$instance = new self();
		else
			$instance = new $class_name;

		$instance->_basic_make( $arr );



		$instance->_fields = crazyblog_set( $arr, 'fields' );



		$instance->_alchemy = new VP_MetaBox_Alchemy1( array(
			'id' => $instance->get_name(),
			'template' => array(
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => $instance->get_name(),
					'title' => $instance->get_label(),
					'fields' => $instance->_fields
				)
			)
				)
		);



		return $instance;
	}

	public function render( $is_compact = true ) {



		$this->_setup_data();



		$this->add_data( 'is_compact', $is_compact );

		$this->add_data( 'header_data', $this->get_data() );



		$this->add_data( 'alchemy', $this->_alchemy );



		return VP_View::instance()->load( 'builder', $this->get_data() );
	}

	public function set_value( $_value ) {



		$this->_value = $_value;

		return $this;
	}

}
