<?php

class NHP_Options_upload extends NHP_Options {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	 */
	function __construct($field = array(), $value = '', $parent = '') {

		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;

	}//function


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	 */
	function render() {
		$class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';

		echo '<input type="hidden" id="' . esc_attr($this->field['id']) . '" name="' . esc_attr($this->args['opt_name'] . '[' . $this->field['id'] . ']').'" value="' . esc_attr($this->value) . '" class="' . $class . '" />';
		//add dimensions - either with style or hidden

		//if($this->value != ''){
		echo '<img class="nhp-opts-screenshot" id="nhp-to-upload nhp-opts-screenshot-' . esc_attr($this->field['id']) . '" src="' . esc_url($this->value) . '" />';
		//}

		if ($this->value == '') {
			$remove = ' style="display:none;"';
			$upload = '';
		} else {
			$remove = '';
			$upload = ' style="display:none;"';
		}
		echo ' <a href="javascript:void(0);" class="nhp-to-upload nhp-opts-upload button-secondary"' . $upload . ' rel-id="' . $this->field['id'] . '">' . esc_html__('Browse', 'ct_theme') . '</a>';

		if (isset($this->field['show_dimensions']) && $this->field['show_dimensions']) {
			$style = $this->value != '' ? '' : ' style="display:none"';
			echo '<br/><label' . $style . ' class="dimensions nhp-uploaded">' . esc_html__("Width:", 'ct_theme') . ' <input type="text" id="' . $this->field['id'] . '_width" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '_width]" value="' . esc_attr(ct_get_option($this->field['id'] . '_width')) . '" class="short ' . $class . '" /></label>';
			echo ' <label' . $style . ' class="dimensions nhp-uploaded">' . esc_html__("Height:", 'ct_theme') . ' <input type="text" id="' . $this->field['id'] . '_height" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '_height]" value="' . esc_attr(ct_get_option($this->field['id'] . '_height')) . '" class="short ' . $class . '" /></label>';
		} else {

			echo '<input type="hidden" id="' . $this->field['id'] . '_width" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '_width]" value="' . esc_attr(ct_get_option($this->field['id'] . '_width')) . '" class="' . $class . '" />';
			echo '<input type="hidden" id="' . $this->field['id'] . '_height" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '_height]" value="' . esc_attr(ct_get_option($this->field['id'] . '_height')) . '" class="' . $class . '" />';
		}
        echo '<input type="hidden" id="' . $this->field['id'] . '_alt_attr" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '_alt_attr]" value="' . esc_attr(ct_get_option($this->field['id'] . '_alt_attr')) . '" class="' . $class . '" />';

        echo ' <a href="javascript:void(0);" class="nhp-opts-upload-remove nhp-uploaded"' . $remove . ' rel-id="' . esc_attr($this->field['id']) . '">' . esc_html__('Remove Upload', 'ct_theme') . '</a>';
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><br/><span class="description">' . $this->field['desc'] . '</span>' : '';

	}//function


	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0
	 */
	function enqueue() {

		wp_enqueue_script(
				'nhp-opts-field-upload-js',
				NHP_OPTIONS_URL . 'fields/upload/field_upload.js',
				array('jquery', 'thickbox', 'media-upload'),
				time(),
				true
		);

		wp_enqueue_style('thickbox'); // thanks to https://github.com/rzepak

		wp_localize_script('nhp-opts-field-upload-js', 'nhp_upload', array('url' => $this->url . 'fields/upload/blank.png'));

	}
	//function

}

//class
?>