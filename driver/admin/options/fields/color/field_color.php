<?php
class Redux_Options_color {

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
		$this->args = isset($parent->args) ? $parent->args : array();
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? $this->field['class'] : '';

		if(isset($this->field["name"]))
			$name = $this->field["name"];
		else
			$name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';


        echo '<input type="text" id="' . $this->field['id'] . '" name="' . $name . '" value="' . $this->value . '" class="' . $class . ' spectrum" style="width: 70px;" data-default="' . ( isset($this->field['std']) ? esc_attr($this->field['std']) : '' ) . '"/>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
        
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {

		wp_enqueue_style(
            'spectrum-css',
            Redux_OPTIONS_URL . 'fields/color/spectrum.css',
            false,
            '',
            'all'
        );
        wp_enqueue_script(
            'spectrum-js',
            Redux_OPTIONS_URL . 'fields/color/spectrum.js',
            array('jquery'),
            time(),
            true
        );
        wp_enqueue_script(
            'redux-opts-field-color-js',
            Redux_OPTIONS_URL . 'fields/color/field_color.js',
            array('jquery', 'spectrum-js'),
            time(),
            true
        );
        
    }
}
