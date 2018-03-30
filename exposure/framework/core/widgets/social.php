<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core social widgets.
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
 * Flickr
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_Flickr_Widget') ) {
	class THB_Flickr_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_flickr_widget', // name
				__('Flickr', 'thb_text_domain'), // label
				__('Display a Flickr feed', 'thb_text_domain'), // description
				'thb_flickr' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$idgettr = 'http://idgettr.com/';

			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'id', __('User ID', 'thb_text_domain'), '<a href="' . $idgettr . '" target="_blank">&rarr; idGettr</a>', $instance );
			$this->formInputNumber( 'num', __('How many photos?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_Flickr_Widget' );

/**
 * Twitter
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_Twitter_Widget') ) {
	class THB_Twitter_Widget extends THB_Widget {

		protected $_class = 'thb-widget-twitter';

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_twitter_widget', // name
				__('Twitter', 'thb_text_domain'), // label
				__('Display a Twitter feed', 'thb_text_domain'), // description
				'thb_twitter' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$consumer_key = thb_get_option('twitter_consumer_key');
			$consumer_secret = thb_get_option('twitter_consumer_secret');
			$oauth_token = thb_get_option('twitter_oauth_token');
			$oauth_token_secret = thb_get_option('twitter_oauth_token_secret');
			$config_note = '';

			if( $consumer_key == '' || $consumer_secret == '' || $oauth_token == '' || $oauth_token_secret == '' ) {
				$config_note = __('Make sure to fill the required Twitter API settings in the "Theme options > Social" tab.', 'thb_text_domain');
			}

			$this->formInputText( 'title', __('Title', 'thb_text_domain'), "<span style='color:red'>" . $config_note . "</span>", $instance );
			$this->formInputText( 'user', __('Screen name', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'num', __('How many tweets?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_Twitter_Widget' );