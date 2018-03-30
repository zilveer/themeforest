<?php
require_once CT_THEME_OPT_FIELDS_DIR.'/select/field_select.php';

/**
 * Simple select with show/hide options
 */

class NHP_Options_select_show extends NHP_Options_select {
	function __construct($field = array(), $value = '', $parent) {
		if (!isset($field['options'])) {
			$field['options'] = array(1 => esc_html__("Show", 'ct_theme'), 0 => esc_html__("Hide", 'ct_theme'));
		}

		//no way - default values on plugin init do not allow this
		/*if(!isset($field['std'])){
			$field['std'] = 1;
		}*/

		parent::__construct($field, $value, $parent);
	}


}

//class
?>