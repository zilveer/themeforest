<?php
class NHP_Options_select extends NHP_Options {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	 */
	function __construct($field = array(), $value = '', $parent) {

		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();

	}

	//function


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	 */
	function render() {

		$class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';

		echo '<select id="' . esc_attr($this->field['id']) . '" name="' . esc_attr($this->args['opt_name'] . '[' . $this->field['id'] . ']').'" ' . $class . 'rows="6" >';
		if (!isset($this->field['options']) && isset($this->field['callback'])) {
			$this->field['options'] = call_user_func($this->field['callback'], $this->field);
		}
		foreach ($this->field['options'] as $k => $v) {

			echo '<option value="' . esc_attr($k) . '" ' . selected($this->value, $k, false) . '>' . esc_html($v) . '</option>';

		}
		//foreach

		echo '</select>';
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';

	}
	//function

}

//class
?>