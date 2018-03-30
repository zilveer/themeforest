<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core utility widgets.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Widgets
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Map
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_Map_Widget') ) {
	class THB_Map_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_map_widget', // name
				__('Google Map', 'thb_text_domain'), // label
				__('Display a Google Map', 'thb_text_domain'), // description
				'thb_map' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$types = array(
				'ROADMAP'   => __('Roadmap', 'thb_text_domain'),
				'SATELLITE' => __('Satellite', 'thb_text_domain'),
				'TERRAIN'   => __('Terrain', 'thb_text_domain'),
				'HYBRID'    => __('Hybrid', 'thb_text_domain')
			);

			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'width', __('Width', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'height', __('Height', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'latlong', __('Latitude and longitude', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'zoom', __('Zoom', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'marker', __('Marker', 'thb_text_domain'), '', $instance );
			$this->formInputSelect( 'type', __('Visualization type', 'thb_text_domain'), $types, '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_Map_Widget' );