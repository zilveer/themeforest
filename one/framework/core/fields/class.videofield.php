<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Video field class.
 *
 * This class is entitled to manage the option/meta video field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_VideoField') ) {
	class THB_VideoField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array( 'mp4', 'ogv', 'mov', 'embed', 'autoplay', 'loop', 'fit' );

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'video', $context );
			$this->_data['controls'] = false;
		}

		/**
		 * Add the controls for autoplay and loop.
		 */
		public function addControls()
		{
			$this->_data['controls'] = true;
		}

	}
}