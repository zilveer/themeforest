<?php

class contact_fields_object extends runway_object {
	public $option_key, $contact_fields_options;

	function __construct($settings) {

		$this->option_key = $settings['option_key'];
		$this->contact_fields_options = get_option( $this->option_key );

	}

	// Get default by field
	// public function get_default($field){
	// 	return $this->contact_fields_options['defaults'][$field];
	// }
	
	// Get all default fields
	public function get_defaults() {

		return isset($this->contact_fields_options['defaults']) ? $this->contact_fields_options['defaults'] : false;
	}

	// Get all fields
	public function get_fields() {

		return isset($this->contact_fields_options['fields']) ? $this->contact_fields_options['fields'] : false;
	}

}

?>