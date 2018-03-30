<?php
/**
 * Manage a source
 *
 * @since 1.5.0
 * @package Listify
 * @category Customizer
 */
class 
	Listify_Customizer_Icon_Source 
extends
	Listify_Customizer_Source {

	/**
	 * Assign properties
	 *
	 * @since 1.5.0
	 * @param string $id
	 * @param string $label
	 * @param array $data
	 */
	public function __construct( $id, $label, $data = array() ) {
		parent::__construct( $id, $label, $data );
	}

	/**
	 * Load the fonts and set the data property
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function load_data() {
		if ( isset( $this->data ) && ! empty( $this->data ) ) {
			return $this->data;
		}

		return $this->data = include_once( get_template_directory() . '/inc/customizer/definitions/icons/' . $this->get_id() . '.php' );
	}

}
