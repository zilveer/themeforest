<?php
class Redux_Options_g1_border_radius {

    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    function render() {
        $class = !empty($this->field['class']) ? $this->field['class'] : '';
        $base_id = $this->field['id'];
        $base_name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';

        $inputs = array(
            'tl'    =>  __('Left-Top corner', Redux_TEXT_DOMAIN),
            'tr'    =>  __('Right-Top corner', Redux_TEXT_DOMAIN),
            'br'    =>  __('Right-Bottom corner', Redux_TEXT_DOMAIN),
            'bl'    =>  __('Left-Bottom corner', Redux_TEXT_DOMAIN),
        );

        $classes = array(
            $class,
            'g1-border-radius'
        );

        echo '<div class="'. sanitize_html_classes($classes) .'">';

            echo '<div class="g1-configurator" data-g1-classes="g1-type-square,g1-type-squircle,g1-type-circle">';
                echo '<div class="g1-border g1-tl" data-g1-corner="tl"></div>';
                echo '<div class="g1-border g1-tr" data-g1-corner="tr"></div>';
                echo '<div class="g1-border g1-bl" data-g1-corner="bl"></div>';
                echo '<div class="g1-border g1-br" data-g1-corner="br"></div>';
            echo '</div>';

        foreach ( $inputs as $name => $label ) {
            $value = !empty($this->value[$name]) ? $this->value[$name]: '';
            $class = 'g1-border-radius-value-'.$name;

            echo '<input type="hidden" id="' . esc_attr($base_id.'_'.$name) . '" name="' . esc_attr($base_name.'['.$name.']') . '" value="' . esc_attr($value) . '" class="' . sanitize_html_class($class) . '" />';
        }

        echo '</div>';

        echo !empty($this->field['desc']) ? ' <span class="description">' . esc_html($this->field['desc']) . '</span>' : '';
    }

    function enqueue() {
        wp_enqueue_script(
            'redux-opts-field-g1-border-radius-js',
            Redux_OPTIONS_URL . 'fields/g1_border_radius/field_g1_border_radius.js',
            array('jquery'),
            time(),
            true
        );

        wp_enqueue_style(
            'redux-opts-field-g1-border-radius-css',
            Redux_OPTIONS_URL . 'fields/g1_border_radius/field_g1_border_radius.css',
            array(),
            time(),
            false
        );
    }
}
