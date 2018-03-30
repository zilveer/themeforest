<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slide field class.
 *
 * This class is entitled to manage the option/meta slide field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_SlideField') ) {
	/**
	 * Slides key definition.
	 */
	thb_define( 'THB_SLIDES', 'slide' );
	
	class THB_SlideField extends THB_Field {

		/**
		 * True if the slide has caption associated.
		 *
		 * @var boolean
		 */
		protected $_caption = true;

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array('id', 'url', 'caption', 'autoplay', 'loop', 'poster');

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, 'slide');
		}

		/**
		 * Get the field subkeys.
		 * 
		 * @return array
		 */
		public function getSubkeys()
		{
			return $this->_subKeys;
		}

		/**
		 * Check if there's support for captions in the slide.
		 * 
		 * @return boolean
		 */
		public function supportCaptions()
		{
			return $this->_caption;
		}

		/**
		 * Disable support for captions in the slide.
		 * 
		 * @return void
		 */
		public function disableCaptions()
		{
			$this->_caption = false;
		}

	}
}