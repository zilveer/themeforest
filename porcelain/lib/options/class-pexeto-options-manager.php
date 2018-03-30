<?php

/**
 * Contains all the main functionality for initializing and managing the options functionality.
 */
class PexetoOptionsManager{

	protected $options_key = 'pexeto_options';
	protected $theme_name = '';
	protected $images_url = '';
	protected $version = '';
	protected $options_obj = null;

	/**
	 * Default constructor.
	 * @param string $options_key  the ID (key) to which all the options will be saved. All the
	 * theme options are saved as one option in an array.
	 * @param string $theme_name   the name of the theme
	 * @param string $images_url   the URL of the folder containing the images used in the options page
	 * @param string $version      the version of the theme
	 */
	function __construct( $options_key, $theme_name, $images_url, $version ) {
		$this->options_key = $options_key;
		$this->theme_name = $theme_name;
		$this->images_url = $images_url;
		$this->version = $version;

		$this->init();
	}

	/**
	 * Inits the main functionality.
	 */
	public function init() {

		$this->options_object = new PexetoOptions($this->options_key);

		//add the actions
		add_action( "wp_ajax_pexeto_save_options_data", array( $this, "do_on_ajax_save" ) );
	}

	/**
	 * Retrieves the option data object.
	 * @return PexetoOptions object
	 */		
	public function get_options_obj(){
		return $this->options_object;
	}

	/**
	 * Calls a method to save the data in an AJAX save request.
	 */
	public function do_on_ajax_save() {
		$res = $this->options_object->save_data();
		echo json_encode( $res );
		exit();
	}

	/**
	 * Initializes the options bulder class to print the options page.
	 */
	public function print_options_page() {

		$options_builder=new PexetoOptionsBuilder( $this->theme_name, $this->images_url, $this->version, $this->options_object );

		$options_builder->print_heading();
		$options_builder->print_options();
		$options_builder->print_footer();
	}

}