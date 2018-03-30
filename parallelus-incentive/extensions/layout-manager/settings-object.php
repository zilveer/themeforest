<?php

class Layout_Manager_Admin_Object extends Runway_Admin_Object {

	public $data, $elements, $builder_page;	

	// Add hooks & crooks
	function add_actions() {
		$this->dynamic = true;
		// Init action
		add_action( 'init', array( $this, 'init' ) );		
		
	}

	function init() {
		// global $sidebar_settings;
		if ( isset( $_REQUEST['navigation'] ) && !empty( $_REQUEST['navigation'] ) ) {
			$this->navigation = $_REQUEST['navigation'];
		}


	}

	function after_settings_init() {
		/* nothing */
  	}

  	function load_objects(){
  		
  	}

}
?>