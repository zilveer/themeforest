<?php
class Redux_Options_g1_feed {

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
            'label'     =>  __('Label', Redux_TEXT_DOMAIN),
            'caption'   =>  __('Caption', Redux_TEXT_DOMAIN),
            'link'      =>  __('Link', Redux_TEXT_DOMAIN)
        );

        foreach ( $inputs as $name => $label ) {
            $value = !empty($this->value[$name]) ? $this->value[$name]: '';

            echo '<div class="g1-feed-row">';
            echo '<span class="g1-feed-label">'.$label.'</span>';
            echo '<input type="text" id="' . esc_attr($base_id.'_'.$name) . '" name="' . esc_attr($base_name.'['.$name.']') . '" value="' . esc_attr($value) . '" class="' . sanitize_html_class($class) . '" />';
            echo '</div>';
        }

        $linking_value = !empty($this->value['linking']) ? $this->value['linking'] : '';

        echo '<div class="g1-feed-row">';
        echo '<span class="g1-feed-label">'.__('Linking', Redux_TEXT_DOMAIN).'</span>';
        echo '<select name="'.esc_attr($base_name.'[linking]').'">';
            echo '<option value="standard" '.selected($linking_value, 'standard', false).'>'.__('Open in the same window', Redux_TEXT_DOMAIN).'</option>';
            echo '<option value="new-window" '.selected($linking_value, 'new-window', false).'>'.__('Open in the new window', Redux_TEXT_DOMAIN).'</option>';
        echo '</select>';
        echo '</div>';

        echo !empty($this->field['desc']) ? ' <span class="description">' . esc_html($this->field['desc']) . '</span>' : '';
    }
}
