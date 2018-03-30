<?php
/**
 * Manage a source
 *
 * @since 1.5.0
 * @package Listify
 * @category Customizer
 */
class Listify_Customizer_Source {

	/**
	 * @var string
	 * @access public
	 */
	public $id;

	/**
	 * @var string
	 * @access public
	 */
	public $label;

	/**
	 * @var array
	 * @access public
	 */
	public $data;

	/**
	 * Assign properties
	 *
	 * @since 1.5.0
	 * @param string $id
	 * @param string $label
	 * @param array $data
	 */
	public function __construct( $id, $label, $data = array() ) {
		$this->id = $id;
		$this->label = $label;
		$this->data = (array) $data;
	}

	/**
	 * Getter for the $id property.
	 *
	 * @since 1.5.0
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Getter for the $label property.
	 *
	 * @since 1.5.0
	 * @return string
	 */
	public function get_label() {
		return $this->label;
	}

	/**
	 * Get the data for a particular font, or all of the source's font data.
	 *
	 * @since 1.5.0
	 * @param string|null $font
	 * @return array
	 */
	public function get_data( $item = null ) {
		if ( empty( $this->data ) ) {
			$this->load_data();
		}

		// Return data for a specific font.
		if ( ! is_null( $item ) ) {
			$data = array();

			if ( isset( $this->data[ $item ] ) ) {
				$data = $this->data[ $item ];
			}

			return $data;
		}

		return $this->data;
	}

	/**
	 * Get the data for a particular icon, or all of the source's font data.
	 *
	 * @since 1.5.0
	 * @param string|null $font
	 * @return array
	 */
	public function get_item_data( $item = null ) {
		if ( empty( $this->data ) ) {
			$this->load_data();
		}

		// Return data for a specific item
		if ( ! is_null( $item ) ) {
			$data = array();

			if ( isset( $this->data[ $item ] ) ) {
				$data = $this->data[ $item ];
			}

			return $data;
		}

		return $this->data;
	}

	/**
	 * Return a list of this source's items in an array format, as used for choice arrays.
	 *
	 * @since 1.5.0
	 * @return array
	 */
	public function get_choices() {
		$choices = array();

		foreach ( $this->get_item_data() as $key => $data ) {
			if ( isset( $data[ 'label' ] ) ) {
				$choices[ $key ] = $data[ 'label' ];
			}
		}

		return $choices;
	}

}
