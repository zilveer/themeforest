<?php

include_once(Redux_OPTIONS_DIR.'fields/select/field_select.php');

class Redux_Options_select_easing extends Redux_Options_select {

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
		
		$this->field['options'] = array(
			'def' => 'default',
			'jswing' => 'jswing',
			'easeInQuad' => 'easeInQuad',
			'easeOutQuad' => 'easeOutQuad',
			'easeInOutQuad' => 'easeInOutQuad',
			'easeInCubic' => 'easeInCubic',
			'easeOutCubic' => 'easeOutCubic',
			'easeInOutCubic' => 'easeInOutCubic',
			'easeInQuart' => 'easeInQuart',
			'easeOutQuart' => 'easeOutQuart',
			'easeInOutQuart' => 'easeInOutQuart',
			'easeInSine' => 'easeInSine',
			'easeOutSine' => 'easeOutSine',
			'easeInOutSine' => 'easeInOutSine',
			'easeInExpo' => 'easeInExpo',
			'easeOutExpo' => 'easeOutExpo',
			'easeInOutExpo' => 'easeInOutExpo',
			'easeInQuint' => 'easeInQuint',
			'easeOutQuint' => 'easeOutQuint',
			'easeInOutQuint' => 'easeInOutQuint',
			'easeInCirc' => 'easeInCirc',
			'easeOutCirc' => 'easeOutCirc',
			'easeInOutCirc' => 'easeInOutCirc',
			'easeInElastic' => 'easeInElastic',
			'easeOutElastic' => 'easeOutElastic',
			'easeInOutElastic' => 'easeInOutElastic',
			'easeInBack' => 'easeInBack',
			'easeOutBack' => 'easeOutBack',
			'easeInOutBack' => 'easeInOutBack',
			'easeInBounce' => 'easeInBounce',
			'easeOutBounce' => 'easeOutBounce',
			'easeInOutBounce' => 'easeInOutBounce'
		);
    }
}
