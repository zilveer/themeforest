<?php

/**
 * Contains the functionality for building the meta fields section of a post/page.
 *
 * @author Pexeto
 */
class PexetoMetaBuilder extends PexetoWidgetsBuilder{

	protected $meta_boxes;
	protected $nonce_id;

	/**
	 * Default constructor.
	 *
	 * @param PexetoDataFields $meta_obj   a meta object extending the PexetoDataFields class
	 * @param array   $meta_boxes an array containing the fields that will be printed
	 * @param string  $nonce_id   the nonce ID that will be used to verify the post
	 */
	function __construct( $meta_obj, $meta_boxes, $nonce_id ) {
		parent::__construct( $meta_obj );
		$this->meta_boxes = $meta_boxes;
		$this->nonce_id = $nonce_id;
	}

	/**
	 * Prints the boxes. For all common fields uses the parent PexetoWidgetsBuilder class methods
	 * to build the field structure.
	 */
	public function print_meta_boxes() {
		$this->print_nonce_field();

		echo '<div class="pexeto-meta-boxes">';

		foreach ( $this->meta_boxes as $meta_field ) {
			$saved_val = '';
			switch ( $meta_field['type'] ) {
			case 'heading':
				$this->print_heading( $meta_field );
				break;
			default :
				parent::print_field( $meta_field );
			}
		}

		echo '</div>';
	}

	/**
	 * Prints a heading of a set of fields.
	 *
	 * @param array   $meta_field the field that contains all the heading information.
	 */
	protected function print_heading( $meta_field ) {
		$data = "";
		//add data attribute if it is set
		if ( isset( $meta_field["data"] ) ) {
			foreach ( $meta_field["data"] as $key=>$value ) {
				$data.=' data-'.$key.'="'.$value.'"';
			}
		}
		echo'<div class="option-heading"'.$data.'><h4>'.$meta_field["title"].'</h4></div>';
	}

	/**
	 * Prints a nonce field to the meta set.
	 */
	protected function print_nonce_field() {
		$nonce = wp_create_nonce( $this->nonce_id );
		echo '<input type="hidden" name="pexeto-meta-nonce" value="'.$nonce.'" />';
	}
}
