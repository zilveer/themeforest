<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer font setting class.
 *
 * This class is entitled to manage the theme customizer font settings.
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
if( ! class_exists('THB_CustomizerFontSetting') ) {
	class THB_CustomizerFontSetting extends THB_CustomizerSetting {

		/**
		 * The setting default variants.
		 *
		 * @var array
		 */
		protected $defaultVariants = array();

		/**
		 * The setting default subsets.
		 *
		 * @var array
		 */
		protected $defaultSubsets = array();

		/**
		 * Constructor.
		 *
		 * @param string $key The setting key.
		 * @param string $label The setting label.
		 * @param string $default The setting default.
		 * @return THB_CustomizerFontSetting
		 */
		public function __construct( $key, $label, $default = '' )
		{
			parent::__construct( $key, $label, $default );

			add_action( 'init', array( $this, 'createOptions' ) );

			return $this;
		}

		/**
		 * Set the font default variants.
		 *
		 * @param string $variants
		 * @return THB_CustomizerSetting
		 */
		public function setDefaultVariants( $variants )
		{
			$this->defaultVariants = $variants;

			return $this;
		}

		/**
		 * Set the font default subsets.
		 *
		 * @param string $subsets
		 * @return THB_CustomizerSetting
		 */
		public function setDefaultSubsets( $subsets )
		{
			$this->defaultSubsets = $subsets;

			return $this;
		}

		/**
		 * Get the font default variants.
		 *
		 * @return array
		 */
		public function getDefaultVariants()
		{
			return $this->defaultVariants;
		}

		/**
		 * Get the font default subsets.
		 *
		 * @return array
		 */
		public function getDefaultSubsets()
		{
			return $this->defaultSubsets;
		}

		/**
		 * Create an option in the Appearance tab to manage variants and subsets.
		 */
		public function createOptions()
		{
			$mod = get_theme_mod( $this->key );

			if ( empty( $mod ) ) {
				$mod = $this->default;
			}

			$font = thb_get_fonts( $mod );

			if ( empty( $font ) ) {
				$font = thb_get_fonts( $this->default );
			}

			$thb_page = thb_theme()->getAdmin()->getAppearancePage();
			$thb_tab = $thb_page->getTab('fonts_in_use');

			$thb_container = $thb_tab->getContainer( 'customizer_font' );

			$selector = '';
			foreach ( $this->rules as $rule ) {
				$selector .= $rule['selector'] . ',';
			}
			$selector = trim( $selector, ',' );

			$thb_field = new THB_FontVariantsField( 'customizer_' . $this->key );
				$thb_field->setFieldValue( 'variants', isset( $font['variants'] ) ? $font['variants'] : '' );
				$thb_field->setFieldValue( 'subsets', isset( $font['subsets'] ) ? $font['subsets'] : '' );
				$thb_field->setFieldValue( 'default_variants', $this->getDefaultVariants() );
				$thb_field->setFieldValue( 'default_subsets', $this->getDefaultSubsets() );
				$thb_field->setFieldValue( 'selector', $selector );
				$thb_field->setLabel( $font['family'] );
				$thb_field->setHelp( $this->label );
			$thb_container->addField($thb_field);
		}

		/**
		 * Create the setting control.
		 */
		protected function createControl( $index = 10 )
		{
			global $wp_customize;

			$this->control = new THB_CustomizeFontControl( $wp_customize, $this->key, array(
				'section'  => $this->section,
				'label'    => $this->label,
				'settings' => $this->key,
				'priority' => $index
			) );
		}

	}
}