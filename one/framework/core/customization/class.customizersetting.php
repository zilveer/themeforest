<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer setting class.
 *
 * This class is entitled to manage the theme customizer settings.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_CustomizerSetting') ) {
	class THB_CustomizerSetting {

		/**
		 * The setting key.
		 *
		 * @var string
		 */
		protected $key = '';

		/**
		 * The setting label.
		 *
		 * @var string
		 */
		protected $label = '';

		/**
		 * The setting default.
		 *
		 * @var string
		 */
		protected $default = '';

		/**
		 * The setting priority index.
		 *
		 * @var integer
		 */
		protected $index = 0;

		/**
		 * The setting options.
		 *
		 * @var array
		 */
		protected $options = array();

		/**
		 * The setting CSS rules.
		 *
		 * @var array
		 */
		protected $rules = array();

		/**
		 * The setting CSS mixins.
		 *
		 * @var array
		 */
		protected $mixins = array();

		/**
		 * The setting control.
		 *
		 * @var WP_Customize_Control
		 */
		protected $control = null;

		/**
		 * The setting section.
		 *
		 * @var string
		 */
		protected $section = '';

		/**
		 * Constructor.
		 *
		 * @param string $key The setting key.
		 * @param string $label The setting label.
		 * @param string $default The setting default.
		 * @return THB_CustomizerSetting
		 */
		public function __construct( $key, $label, $default = '' )
		{
			$this->key = $key;
			$this->label = $label;
			$this->default = $default;

			return $this;
		}

		/**
		 * Add a CSS rule to the setting.
		 *
		 * @param string|array $properties
		 * @param string $selector
		 * @param array $modifiers
		 * @return THB_CustomizerSetting
		 */
		public function addRule( $properties, $selector, $modifiers = array() )
		{
			$this->rules[] = array(
				'properties' => (array) $properties,
				'selector'   => $selector,
				'modifiers'  => $modifiers,
			);

			return $this;
		}

		/**
		 * Add a CSS mixin to the setting.
		 *
		 * @param string $mixin
		 * @param string $selector
		 * @return THB_CustomizerSetting
		 */
		public function addMixin( $mixin, $selector )
		{
			$this->mixins[] = array(
				'mixin'    => $mixin,
				'selector' => $selector
			);

			return $this;
		}

		/**
		 * Get the setting rules.
		 *
		 * @return array
		 */
		public function getRules()
		{
			return $this->rules;
		}

		/**
		 * Get the setting mixins.
		 *
		 * @return array
		 */
		public function getMixins()
		{
			return $this->mixins;
		}

		/**
		 * Get the setting key.
		 *
		 * @return string
		 */
		public function getKey()
		{
			return $this->key;
		}

		/**
		 * Get the setting default.
		 *
		 * @return string
		 */
		public function getDefault()
		{
			return $this->default;
		}

		/**
		 * Set the setting priority index.
		 *
		 * @param string $index
		 * @return THB_CustomizerSetting
		 */
		public function setIndex( $index )
		{
			$this->index = $index + 11;

			return $this;
		}

		/**
		 * Set the setting default.
		 *
		 * @param string $default
		 * @return THB_CustomizerSetting
		 */
		public function setDefault( $default )
		{
			$this->default = $default;

			return $this;
		}

		/**
		 * Set the options for the setting control.
		 *
		 * @param array $options
		 */
		public function setOptions( $options )
		{
			$this->options = $options;

			return $this;
		}

		/**
		 * Set the section the setting belongs to.
		 *
		 * @param string $section
		 */
		public function setSection( $section )
		{
			$this->section = $section;
		}

		/**
		 * Register the setting.
		 */
		public function register()
		{
			global $wp_customize;

			$wp_customize->add_setting( $this->key, array(
				'default' => $this->default,
				'priority' => $this->index,
				'sanitize_callback' => null
			) );

			$this->createControl( $this->index );

			if ( $this->control instanceof WP_Customize_Control ) {
				$wp_customize->add_control( $this->control );
			}
			else {
				$wp_customize->add_control( $this->control['key'], $this->control['data'] );
			}
		}

	}
}