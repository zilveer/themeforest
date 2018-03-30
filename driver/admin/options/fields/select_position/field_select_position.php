<?php

include_once(Redux_OPTIONS_DIR.'fields/select/field_select.php');

class Redux_Options_select_position extends Redux_Options_select {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
		
		$this->field['options'] = array(
			'left top' => 'left top',
			'left center' => 'left center',
			'left bottom' => 'left bottom',
			'right top' => 'right top',
			'right center' => 'right center',
			'right bottom' => 'right bottom',
			'center top' => 'center top',
			'center center' => 'center center',
			'center bottom' => 'center bottom'
		);
    }
}
