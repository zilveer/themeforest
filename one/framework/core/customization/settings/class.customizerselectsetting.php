<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer select setting class.
 *
 * This class is entitled to manage the theme customizer select settings.
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
if( ! class_exists('THB_CustomizerSelectSetting') ) {
	class THB_CustomizerSelectSetting extends THB_CustomizerSetting {

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