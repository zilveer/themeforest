<?php

/**
 * A data field class. Must be extended by a child class to implement the abstract
 * methods according to the type of the data field.
 *
 * @author  Pexeto
 */
abstract class PexetoDataFields {

	protected $fields = array();

	abstract public function get_value( $id );

	/**
	 * Returns the array containing all the options of the theme - not the saved ones,
	 * but the declared options that build the options page.
	 *
	 * @return an array containing the options
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * Sets the array containing all the fields - not the saved ones,
	 * but the declared fields that build the settings section.
	 *
	 * @param array   $fields an array containing the fields.
	 * Each field in the array should be in the following format:
	 *  array(
	 *  "name" => "Field name",
	 *  "id" => "field_id",
	 *  "type" => "field_type",
	 *  "std" => "default_value",
	 *  "desc" => "Description"
	 * )
	 */
	public function set_fields( $fields ) {
		$this->fields = $fields;
	}

	/**
	 * Returns the default value of a field.
	 *
	 * @param array   $field array containing the field data
	 * @return if the field has a "std" key set, it will return the value set to it.
	 * If it hasn't a "std" key set, it will return:
	 * - the fisrt option from the available options set for select and image radio fields
	 * - an empty array for multicheck and custom fields
	 * - an empty string in all other cases
	 */
	public function get_default_value( $field ) {
		if ( $field['type']!='multioption' ) {
			//this is a standard single field
			if ( isset( $field['std'] ) ) {
				//there is a default value set
				return $field['std'];
			}else {
				//there isn't a devault value, return an empty value
				if ( ( $field['type']=='select' || $field['type']=='imageradio' ) && !empty( $field['options'] ) ) {
					return $field['options'][0]['id'];
				}elseif ( $field['type']=='multicheck' || $field['type']=='custom' ) {
					return array();
				}elseif ( $field['type']=='checkbox' ) {
					return false;
				}else {
					return '';
				}
			}
		}else {
			$res = array();
			foreach ( $field['fields'] as $sub_field ) {
				$res[$sub_field['id']] = $this->get_default_value( $sub_field );
			}
			return $res;
		}
	}
}
