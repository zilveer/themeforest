<?php

class Redux_Options_radio_color{

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value = '', $parent = '') {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';
        
        if(isset($this->field["name"]))
			$name = $this->field["name"];
		else	
        	$name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';
        	
        echo '<fieldset>';
        foreach($this->field['options'] as $k => $v) {
            $selected = (checked($this->value, $k, false) != '') ? ' redux-radio-img-selected' : '';
            echo '<label class="redux-radio-img' . $selected . ' redux-radio-img-' . $this->field['id'] . '" for="' . $this->field['id'] . '_' . array_search($k,array_keys($this->field['options'])) . '" >';
            echo '<input type="radio" id="' . $this->field['id'] . '_' . array_search($k,array_keys($this->field['options'])) . '" name="'.$name.'" ' . $class . ' value="' . $k . '" ' .checked($this->value, $k, false) . ' onclick="jQuery:redux_radio_img_select(\'' . $this->field['id'] . '_' . array_search($k,array_keys($this->field['options'])) . '\', \'' . $this->field['id'] . '\');" />';
            echo '<div style="width:60px; height:60px; border: 1px solid #eee; background-color: ' . $v['color'] . '" title="' . $v['title'] . '">&nbsp;</div>';
            echo '<br/><span>' . $v['title'] . '</span>';
            echo '</label>';
        }
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">' . $this->field['desc'] . '</span>' : '';
        echo '</fieldset>';
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
        wp_enqueue_script(
            'redux-opts-field-radio_color-js', 
            Redux_OPTIONS_URL . 'fields/radio_color/field_radio_color.js', 
            array('jquery'),
            time(),
            true
        );
    }
}
