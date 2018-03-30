<?php
class Redux_Options_g1_image_size {

    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
        $this->default_value = isset($this->field['std']) ? $this->field['std'] : 0;
    }

    function render() {
        $class = !empty($this->field['class']) ? $this->field['class'] : '';
        $base_id = $this->field['id'];
        $base_name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';

        $inputs = array(
            'height'    =>  __('Height', Redux_TEXT_DOMAIN),
        );

        foreach ( $inputs as $name => $label ) {
            $value = !empty($this->value[$name]) ? $this->value[$name]: '';

            echo '<div class="g1-feed-row">';
            echo '<span class="g1-feed-label">'.$label.'</span>';
            echo '<input type="text" id="' . esc_attr($base_id.'_'.$name) . '" name="' . esc_attr($base_name.'['.$name.']') . '" value="' . esc_attr($value) . '" class="' . sanitize_html_class($class) . '" />';
            echo '</div>';
        }

        $crop_value = !empty($this->value['crop']) ? $this->value['crop'] : $this->default_value;
        $crop_value = $crop_value === true || $crop_value === 'standard'  ? 'standard' : 'none';

        $this->field['options'] = array(
            'standard'  => __('on', Redux_TEXT_DOMAIN),
            'none'      => __('off', Redux_TEXT_DOMAIN),
        );

        echo '<span class="g1-feed-label">'.__('Crop', Redux_TEXT_DOMAIN).'</span>';
        echo '<select id="' . $this->field['id'] . '_crop' . '" name="' . esc_attr($base_name.'[crop]') . '" "' . $class . ' >';

        foreach($this->field['options'] as $k => $v) {
            echo '<option value="' . esc_attr($k) . '" ' . selected($crop_value, $k, false) . '>' . esc_html($v) . '</option>';
        }

        echo '</select>';

        echo !empty($this->field['desc']) ? ' <span class="description">' . esc_html($this->field['desc']) . '</span>' : '';
    }
}
