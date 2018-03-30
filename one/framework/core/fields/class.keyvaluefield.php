<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Key/value pair field class.
 *
 * This class is entitled to manage the key/value pair field types.
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
if( !class_exists('THB_KeyValueField') ) {
	class THB_KeyValueField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array( 'key', 'value' );

		/**
		 * Key field label.
		 *
		 * @var string
		 */
		public $keyLabel = '';

		/**
		 * Value field label.
		 *
		 * @var string
		 */
		public $valueLabel = '';

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'keyvalue', $context );

			$this->keyLabel = __( 'Label', 'thb_text_domain' );
			$this->valueLabel = __( 'Text', 'thb_text_domain' );
		}

	}
}