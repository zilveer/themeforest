<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Slider_Flex extends TMM_Slider {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		//***
		self::$slider_options = array(
			'key' => "sequence",
			'name' => "Slider",
			'fields' => array(
				'description' => array(
					'name' => __('Slide Description', 'diplomat'),
					'type' => 'textarea',
					'field_options' => array(
						'font_family' => __('Font family', 'diplomat'),
						'font_size' => __('Font size', 'diplomat'),
						'font_color' => __('Font color', 'diplomat')
					),
					'field_options_defaults' => array(
						'font_family' => '',
						'font_size' => '',
						'font_color' => ''
					)
				),
				'url' => array(
					'name' => __('Slide URL', 'diplomat'),
					'type' => 'textinput',
					'field_options' => array()
				),
			),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		//***
		self::$slider_js_options = array(
			'slide_image_alias' => array(
				'title' => __('Slide size', 'diplomat'),
				'type' => 'text',
				'description' => __('Slide size. width*height, for example 500*300. Empty field means full size!', 'diplomat'),
				'default' => '',
			),
			'enable_caption' => array(
				'title' => __('Enable caption', 'diplomat'),
				'type' => 'checkbox',
				'description' => "",
				'default' => 1,
			),
			'slideshow' => array(
				'title' => __('Slideshow', 'diplomat'),
				'type' => 'checkbox',
				'description' => __("Animate slider automatically", 'diplomat'),
				'default' => 1,
			),
			'init_delay' => array(
				'title' => __('initDelay', 'diplomat'),
				'type' => 'slider',
				'description' => __("Integer: Set an initialization delay, in milliseconds", 'diplomat'),
				'default' => 0,
				'max' => 500
			),
			'animation_speed' => array(
				'title' => __('Animation Speed', 'diplomat'),
				'type' => 'slider',
				'description' => __("Set the speed of animations, in milliseconds", 'diplomat'),
				'default' => 600,
				'max' => 2000
			),
			'slideshow_speed' => array(
				'title' => __('Slideshow Speed', 'diplomat'),
				'type' => 'slider',
				'description' => __("Set the speed of the slideshow cycling, in milliseconds", 'diplomat'),
				'default' => 7000,
				'max' => 20000
			),
			'animation' => array(
				'title' => __('Animation', 'diplomat'),
				'type' => 'select',
				'values' => array(
					'fade' => __('Fade', 'diplomat'),
					'slide' => __('Slide', 'diplomat'),
				),
				'description' => __('Select your animation type, "fade" or "slide"', 'diplomat'),
				'default' => 'slide',
			),
			'directionNav' => array(
				'title' => __('Direction Nav', 'diplomat'),
				'type' => 'checkbox',
				'description' => __("Direction Navigation", 'diplomat'),
				'default' => 1,
			),
			'controlnav' => array(
				'title' => __('Control Navigation', 'diplomat'),
				'type' => 'checkbox',
				'description' => __("Control Navigation", 'diplomat'),
				'default' => 1,
			),
			'direction' => array(
				'title' => __('Direction', 'diplomat'),
				'type' => 'select',
				'values' => array(
					'horizontal' => __('Horizontal', 'diplomat'),
					'vertical' => __('Vertical', 'diplomat'),
				),
				'description' => "",
				'default' => 'horizontal',
			)
		);
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}
