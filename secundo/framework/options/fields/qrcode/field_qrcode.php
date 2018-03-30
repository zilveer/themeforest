<?php

class NHP_Options_qrcode extends NHP_Options {

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

	}//function


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	 */
	function render() {
		$size = isset($this->field['size']) ? $this->field['size'] : 120;
		$align = isset($this->field['align']) ? $this->field['align'] : 'center';
		$class = (isset($this->field['class'])) ? ' ' . $this->field['class'] : '';

		$content = (isset($this->field['option'])) ? ct_get_option($this->field['option']) : '';

		$content = strtr(isset($this->field['option_template']) ? $this->field['option_template'] : '%option%', array('%option%' => $content));

		if ($content == '' && isset($this->field['desc'])) {
			$content = $this->field['desc'];
		}

		$imgUrl = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . urlencode($content);

		echo '</td></tr></table><div class="nhp-opts-info-field' . $class . '"' . ($align ? 'style="text-align:' . $align . '"' : '') . '>' .
				'<img src="' . esc_url($imgUrl) . '" alt="'.esc_html__('qrcode','ct_theme').'">'
				. '</div><table class="form-table no-border"><tbody><tr><th></th><td>';

	}
	//function

}

//class
?>