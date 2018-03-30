<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core media widgets.
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
 * Video
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_Video_Widget') ) {
	class THB_Video_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_video_widget', // name
				__('Video', 'thb_text_domain'), // label
				__('Displays a video from YouTube or Vimeo', 'thb_text_domain'), // description
				'thb_video' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'url', __('Video URL', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'ratio', __('Ratio', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_Video_Widget' );