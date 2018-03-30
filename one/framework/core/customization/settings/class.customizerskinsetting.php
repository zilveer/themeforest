<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer skin select setting class.
 *
 * This class is entitled to manage the theme customizer skin settings.
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
if( ! class_exists('THB_CustomizerSkinSetting') ) {
	class THB_CustomizerSkinSetting extends THB_CustomizerSetting {

		/**
		 * Constructor.
		 */
		public function __construct( $key, $label, $default = '' )
		{
			parent::__construct( $key, $label, $default );

			add_action( 'wp_head', array( $this, 'enqueueSkin' ), 9998 );

			return $this;
		}

		/**
		 * Enqueue the skin CSS file.
		 */
		public function enqueueSkin()
		{
			$skin = get_theme_mod( $this->key );

			if ( empty( $skin ) ) {
				$skin = $this->default;
			}

			$skin = apply_filters( 'thb_customizer_' . $this->key, $skin );

			echo '<link id="thb-customizer-skin" rel="stylesheet" href="' . THB_THEME_CSS_URL . '/' . $skin . '.css">';
		}

		/**
		 * Create the setting control.
		 */
		protected function createControl( $index = 10 )
		{
			global $wp_customize;

			$this->control = array(
				'key' => $this->key,
				'data' => array(
					'settings' => $this->key,
					'section'  => $this->section,
					'label'    => $this->label,
					'type'     => 'select',
					'choices'  => $this->options,
					'priority' => $index
				)
			);
		}

	}
}