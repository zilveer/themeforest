<?php

/**
 * This class contains all the options management functionality - initializes the options page builder object, saving options, retrieving options, etc.
 *
 * @author Pexeto
 */
class PexetoOptions extends PexetoDataFields {

	protected $options_key = 'pexeto_options';
	protected $options_to_update = array();
	protected $saved_options = array();
	public $empty_post_error = "Error: POST array is empty";
	public $invalid_nonce_error = "Error: nonce field did not verify";
	public $user_cap_error = "Error: you are not allowed to edit the theme options";

	function __construct( $options_key ) {
		$this->options_key = $options_key;

		$this->init();
	}

	/**
	 * Inits the main functionality.
	 */
	public function init() {
		$this->load_options();
	}

	/**
	 * Loads the saved options into a property.
	 */
	public function load_options() {
		$this->saved_options = get_option( $this->options_key );
	}

	public function get_saved_options() {
		if ( empty( $this->saved_options ) ) {
			$this->load_options();
		}
		return $this->saved_options;
	}

	/**
	 * Adds an option set to the default theme options array.
	 *
	 * @param unknown $options_arr an array containing arrays of options. Each option in the array should be in the following format:
	 *  array(
	 *  "name" => "Option name",
	 *  "id" => "option_id",
	 *  "type" => "option_type",
	 *  "std" => "default_value",
	 *  "desc" => "Description"
	 * )
	 */
	public function add_option_set( $options_arr ) {
		foreach ( $options_arr as $option ) {
			$this->fields[]=$option;
		}
	}

	/**
	 * Called to update the options - verifies the nonce and if it is valid, calls a function to update the options and redirects to the options page.
	 */
	public function save_data() {
		$res = array();

		//verify the nonce
		if ( empty( $_POST ) ) {
			$res["success"] = false;
			$res["message"] = $this->empty_post_error;
		}elseif ( !wp_verify_nonce( $_POST['pexeto-theme-options'], 'pexeto-theme-update-options' ) ) {
			$res["success"] = false;
			$res["message"] = $this->invalid_nonce_error;
		}elseif ( !current_user_can( 'edit_theme_options' ) ) {
			$res["success"] = false;
			$res["message"] = $this->user_cap_error;
		}else {
			$this->save_options();
			$res["success"] = true;
		}
		return $res;
	}

	/**
	 * Saves all the opstions from a POST request.
	 */
	protected function save_options() {
		foreach ( $this->fields as $option ) {
			if ( isset( $option['id'] ) ) {
				if ( isset( $_POST[ $option['id'] ] ) ) {
					//update a single option
					$val = $_POST[$option['id']];
					if($option['type']=='checkbox'){
						$val = $val == 'false'?false:true;
					}
					$this->options_to_update[$option['id']] = $val;
				}elseif ( $option["type"]=="multioption" ) {
					//update a multi option (option that contains multiple options)
					$opt_arr = array();
					foreach ( $option["fields"] as $field ) {
						if ( isset( $_POST[ $option['id'].'_'.$field['id']] ) ) {
							$val = $_POST[ $option['id'].'_'.$field['id']];
							if($field['type']=='checkbox'){
								$val = $val == 'false'?false:true;
							}
							$opt_arr[$field['id']] = $val;
						}elseif($field['type']=='multicheck'){
							//the option is a multioption but no value is set in the
							//POST array - then it should be an empty array
							$opt_arr[$field['id']] = array();
						}
					}
					$this->options_to_update[$option['id']] = $opt_arr;
				}elseif ($option['type']=='multicheck' || $option['type']=='custom'){
					//the option is a multioption but no value is set in the
					//POST array - then it should be an empty array
					$this->options_to_update[$option['id']] = array();
				}
			}
		}

		update_option( $this->options_key, $this->options_to_update );
	}

	/**
	 * Gets an option value.
	 *
	 * @param unknown $id - the ID of the option to be retrieved
	 * @return the poption value - if the option has a custom value saved, it returns the saved value. 
	 * Otherwise it would return the default value set or if it is not set, it would return an empty string.
	 */
	public function get_value( $id ) {
		if ( isset( $this->saved_options[$id] ) ) {
			$val = $this->saved_options[$id];
			if(is_string($val)){
				$val = stripslashes($val);
			}
			return $val;
		}else {
			foreach ( $this->fields as $option ) {

				if ( isset( $option['id'] ) && $option['id']==$id ) {
					return parent::get_default_value( $option );
				}
			}
		}
		return '';
	}

	/**
	 * Retrieves the saved value of a field only if it has been modified from
	 * its default value.
	 * @param unknown $id - the ID of the option to be retrieved
	 * @return the saved value
	 */
	public function get_saved_value( $id ){
		if ( isset( $this->saved_options[$id] ) ) {
			$val = $this->saved_options[$id];
			if(is_string($val)){
				$val = stripslashes($val);
			}

			foreach ( $this->fields as $option ) {
				if ( isset( $option['id'] ) && $option['id']==$id ) {
					$def_val = parent::get_default_value( $option );
					break;
				}
			}

			if($def_val != $val){
				return $val;
			}
		}
		return null;
	}

}
