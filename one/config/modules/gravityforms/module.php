<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * GravityForms.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\GravityForms
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Custom Gravity Forms skin.
 */
function thb_gravityforms_skin() {
	if ( class_exists('GFForms') ) {

		if ( file_exists( THB_TEMPLATE_DIR . '/css/thb-gravityforms-skin.css' ) ) {

			thb_theme()->getFrontend()->addStyle( THB_TEMPLATE_URL . '/css/thb-gravityforms-skin.css', array(
				'deps' => array(),
				'name' => 'thb_gravityforms_skin'
			));

		}
	}
}

add_action( 'init', 'thb_gravityforms_skin' );
