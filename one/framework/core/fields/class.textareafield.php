<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Textarea field class.
 *
 * This class is entitled to manage the option/meta textarea field types.
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
if( !class_exists('THB_TextareaField') ) {
	class THB_TextareaField extends THB_Field {

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'textarea', $context );
			$this->setCodeLanguage();
		}

		/**
		 * Set the textarea to be used for code usage.
		 *
		 */
		public function setAllowCode()
		{
			$this->setFieldValue( 'allow_code', 1 );
		}

		/**
		 * Set the textarea to be used for a specific code language.
		 *
		 * @param string $language The language code.
		 */
		public function setCodeLanguage( $language = 'css' )
		{
			$this->setFieldValue( 'code_language', $language );
		}

	}
}