<?php
	
class contact_fields_admin_object extends runway_admin_object {
	public $option_key, $contact_fields_options;

	public function __construct($settings){
		parent::__construct($settings);

		$this->option_key = $settings['option_key'];
		$this->contact_fields_options = get_option( $this->option_key );
	}

	/* ---- Default Options ---- */
	// Add or update default options
	public function update_defaults($options = array()){
		if(!empty($options)){
			$this->contact_fields_options['defaults'] = $options;
			update_option($this->option_key, $this->contact_fields_options);
			return true;
		}
		return false;	
	}

	// Get field by alias
	public function get_field($alias){
		return (isset($alias)) ? $this->contact_fields_options['fields'][$alias] : false;
	}

	/* ---- Field Options ---- */
	// Add or update fields
	public function update_field($options = array()){	
		if(!empty($options)){
			if (empty($options['alias'])) {
				$options['alias'] = sanitize_title( $options['label'] );
			}
			if (!empty($options['alias'])) {
				$options['alias'] = sanitize_title( $options['alias'] );
				$this->contact_fields_options['fields'][$options['alias']] = $options;
				update_option($this->option_key, $this->contact_fields_options);
				return true;
			}
		}
		return false;	
	}
	// Duplicate field
	public function duplicate_field($alias) {
		if($alias != '') {
			$options = $this->get_field($alias);
			$options['alias'] = $options['alias'] .'-copy';
			$options['label'] = $options['label'] .' copy';
			return $this->update_field($options);
		}
		return false;
	}

	// Delete field
	public function delete_field($alias) {
		if($alias != ''){
			unset($this->contact_fields_options['fields'][$alias]);
			update_option($this->option_key, $this->contact_fields_options);
			return true;
		}
		return false;
	}

	// Add hooks & crooks
	function add_actions() {
		// Init action
		add_action( 'init', array( $this, 'init' ) );		
		
	}

	function init() {		
		if ( isset( $_REQUEST['navigation'] ) && !empty( $_REQUEST['navigation'] ) ) {
			global $contact_fields_admin;
			$contact_fields_admin->navigation = $_REQUEST['navigation'];
		}
	}

	function after_settings_init() {
		/* nothing */
  	}

  	function load_objects() {
  		
  	}

}
?>