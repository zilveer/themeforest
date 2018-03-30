<?php if (!defined('ABSPATH')) die('No direct access allowed');

class TMM_Ext_Slider_Flex extends TMM_Ext_Sliders {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		//***
		self::$slider_options = array(
			'key' => "flex",
			'name' => "Flexslider",
			'fields' => array(
				'title' => array(
					'name' => __('Slide Title', 'cardealer'),
					'type' => 'textinput',
					'field_options' => array(
						'font_family' => __('Font family', 'cardealer'),
						'font_size' => __('Font size', 'cardealer'),
						'font_color' => __('Font color', 'cardealer')
					),
					'field_options_defaults' => array(
						'font_family' => 'Arial',
						'font_size' => 22,
						'font_color' => '#585757'
					)
				),
				'subtitle' => array(
					'name' => __('Slide Subtitle', 'cardealer'),
					'type' => 'textinput',
					'field_options' => array(
						'font_family' => __('Font family', 'cardealer'),
						'font_size' => __('Font size', 'cardealer'),
						'font_color' => __('Font color', 'cardealer')
					),
					'field_options_defaults' => array(
						'font_family' => 'Arial',
						'font_size' => 12,
						'font_color' => '#7d7d7d'
					)
				),
				'caption_default_styling' => array(
					'name' => __('Keep default title and subtitle styling', 'cardealer'),
					'type' => 'checkbox',
					'field_options' => array()
				),
				'show_button' => array(
					'name' => __('Show Button', 'cardealer'),
					'type' => 'checkbox',
					'field_options' => array()
				),
				'url' => array(
					'name' => __('Button\'s URL', 'cardealer'),
					'type' => 'textinput',
					'field_options' => array()
				),
			),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		//***
		self::$slider_js_options = array(
			'enable_caption' => array(
				'title' => __('Enable caption', 'cardealer'),
				'type' => 'checkbox',
				'description' => "",
				'default' => 1,
			),
			'animation_loop' => array(
				'title' => __('Animation loop', 'cardealer'),
				'type' => 'checkbox',
				'description' => __("Should the animation loop? If false, directionNav will received 'disable' classes at either end", 'cardealer'),
				'default' => 0,
			),
			'slideshow' => array(
				'title' => __('Slideshow', 'cardealer'),
				'type' => 'checkbox',
				'description' => __("Animate slider automatically", 'cardealer'),
				'default' => 1,
			),
			'init_delay' => array(
				'title' => __('initDelay', 'cardealer'),
				'type' => 'text',
				'show_title' => 1,
				'description' => __("Integer: Set an initialization delay, in milliseconds", 'cardealer'),
				'default' => 0,
				'max' => 500
			),
			'animation_speed' => array(
				'title' => __('Animation Speed', 'cardealer'),
				'type' => 'text',
				'show_title' => 1,
				'description' => __("Set the speed of animations, in milliseconds", 'cardealer'),
				'default' => 600,
				'max' => 2000
			),
			'slideshow_speed' => array(
				'title' => __('Slideshow Speed', 'cardealer'),
				'type' => 'text',
				'show_title' => 1,
				'description' => __("Set the speed of the slideshow cycling, in milliseconds", 'cardealer'),
				'default' => 7000,
				'max' => 20000
			),
			'animation' => array(
				'title' => __('Animation', 'cardealer'),
				'type' => 'select',
				'show_title' => 1,
				'values_list' => array(
					'fade' => __('Fade', 'cardealer'),
					'slide' => __('Slide', 'cardealer'),
				),
				'description' => __('Select your animation type, "fade" or "slide"', 'cardealer'),
				'default' => 'fade',
			),
			'randomize' => array(
				'title' => __('Randomize', 'cardealer'),
				'type' => 'checkbox',
				'description' => __("Randomize slide order", 'cardealer'),
				'default' => 1,
			),
			'reverse' => array(
				'title' => __('Reverse', 'cardealer'),
				'type' => 'checkbox',
				'description' => __("Reverse the animation direction", 'cardealer'),
				'default' => 1,
			),
		);
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}

