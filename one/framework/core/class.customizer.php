<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customization class.
 *
 * This class is entitled to manage the theme customizations.
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
if( !class_exists('THB_Customizer') ) {
	class THB_Customizer {

		/**
		 * The theme customizer panels.
		 *
		 * @var array
		 */
		private $panels = array();

		/**
		 * The theme customizer sections.
		 *
		 * @var array
		 */
		private $sections = array();

		/**
		 * The theme customizer settings counter.
		 *
		 * @var integer
		 */
		public $settings_counter = 0;

		/**
		 * Constructor.
		 */
		public function __construct()
		{
			add_action( 'customize_register', array( $this, 'register' ) );
			add_action( 'customize_save_after', array( $this, 'saveOptions' ) );
			add_action( 'init', 'thb_customizer' );
		}

		/**
		 * Add a section to the theme customizer.
		 *
		 * @param string $key The section key.
		 * @param string $title The section title.
		 * @return THB_CustomizerSection
		 */
		public function addSection( $key, $title )
		{
			$section = new THB_CustomizerSection( $key, $title, $this, count( $this->sections ) );
			$this->sections[] = $section;

			return $section;
		}

		/**
		 * Add a panel to the theme customizer.
		 *
		 * @param string $key The panel key.
		 * @param string $title The panel title.
		 * @return THB_CustomizerPanel
		 */
		public function addPanel( $key, $title )
		{
			if ( thb_system_is_version( '4.0' ) ) {
				$panel = new THB_CustomizerPanel( $key, $title, $this, count( $this->panels ) );
				$this->panels[] = $panel;

				return $panel;
			}

			return $this;
		}

		/**
		 * Get the theme customizer sections.
		 *
		 * @return array
		 */
		public function getSections()
		{
			$sections = $this->sections;

			foreach ( $this->getPanels() as $panel ) {
				foreach ( $panel->getSections() as $section ) {
					$sections[] = $section;
				}
			}

			return $sections;
		}

		/**
		 * Get the theme customizer panels.
		 *
		 * @return array
		 */
		public function getPanels()
		{
			return $this->panels;
		}

		/**
		 * Register the theme customizer structure.
		 */
		public function register()
		{
			foreach ( $this->panels as $panel ) {
				$panel->register();
			}

			foreach ( $this->sections as $section ) {
				$section->register();
			}
		}

		/**
		 * Save the Font Family options when the Customizer is saved.
		 */
		public function saveOptions() {
			$thb_customizer = thb_theme()->getCustomizer();

			foreach ( $thb_customizer->getSections() as $section ) {
				foreach ( $section->getSettings() as $setting ) {
					foreach ( $setting->getRules() as $rule ) {
						foreach ( $rule['properties'] as $property ) {
							if ( $property === 'font-family' ) {
								$key = $setting->getKey();
								$font_key = get_theme_mod( $key );

								if ( $font_key ) {
									$font = thb_get_fonts( $font_key );
								}
								else {
									$font = thb_get_fonts( $setting->getDefault() );
								}

								if ( ! isset( $font['subsets'] ) ) {
									$font['subsets'] = '';
								}

								$option = thb_get_option( 'customizer_' . $key );
								$option_variants = thb_array_explode( $option['variants'] );
								$option_subsets = thb_array_explode( $option['subsets'] );

								/**
								 * Variants.
								 */
								$default_variants = $setting->getDefaultVariants();
								$font_variants = thb_array_explode( $font['variants'] );
								$variants_intersection = array_intersect( $default_variants, $font_variants );

								if ( ! empty( $option_variants ) ) {
									$variants_options_intersection = array_intersect( $font_variants, $option_variants );

									if ( ! empty( $variants_options_intersection ) ) {
										$variants_intersection = $variants_options_intersection;
									}
								}

								if ( empty( $variants_intersection ) ) {
									$variants_intersection = array( 'regular' );
								}

								/**
								 * Subsets.
								 */
								$default_subsets = $setting->getDefaultSubsets();
								$font_subsets = thb_array_explode( $font['subsets'] );
								$subsets_intersection = array_intersect( $default_subsets, $font_subsets );

								if ( ! empty( $option_subsets ) ) {
									$subsets_options_intersection = array_intersect( $font_subsets, $option_subsets );

									if ( ! empty( $subsets_options_intersection ) ) {
										$subsets_intersection = $subsets_options_intersection;
									}
								}

								thb_save_option( 'customizer_' . $key, array(
									'variants' => implode( ',', $variants_intersection ),
									'subsets'  => implode( ',', $subsets_intersection ),
								) );
							}
						}
					}
				}
			}
		}

	}
}