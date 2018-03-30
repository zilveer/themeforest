<?php
class Redux_Options_g1_range {

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

        $this->min  = isset( $this->field['min'] ) ? $this->field['min'] : 0;
        $this->max  = isset( $this->field['max'] ) ? $this->field['max'] : 10;
        $this->step = isset( $this->field['step'] ) ? $this->field['step'] : 1;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = !empty($this->field['class']) ? $this->field['class'] : '';
        $name = $this->args['opt_name'] . '[' . $this->field['id'] . ']" ';

        if ( empty($this->value) ) {
            $this->value = 0;
        }

        echo '<input type="range" min="'. esc_attr($this->min) .'" max="'. esc_attr($this->max) .'" step="'. esc_attr($this->step) .'" id="' . esc_attr($this->field['id']) . '" name="' . esc_attr($name) . '" value="' . esc_attr($this->value) . '" class="' . sanitize_html_class($class) . '" />';

        echo !empty($this->field['desc']) ? ' <span class="description">' . esc_html($this->field['desc']) . '</span>' : '';
    }
}
