<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Section field class.
 *
 * This class is entitled to manage the row/stripe field types.
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
if( ! class_exists( 'THB_SectionField' ) ) {
	class THB_SectionField extends THB_Field {

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param string $key The slides key.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $key = 'section', $context = null )
		{
			parent::__construct( $name, $key, $context );

			add_action( 'in_admin_header', array( $this, 'customTemplates' ) );
		}

		/**
		 * Imports the custom templates for row dynamic components.
		 */
		public function customTemplates()
		{
			thb_get_framework_template_part( '/admin/fields/partials/builder/row_create' );
			thb_get_framework_template_part( '/admin/fields/partials/builder/column_create' );
			thb_get_framework_template_part( '/admin/fields/partials/builder/block_create' );
		}

		/**
		 * Pre-process the field data before saving.
		 *
		 * @param mixed $data The field POST data.
		 * @return mixed
		 */
		public function preProcessData( $data )
		{
			return $data;
		}

	}
}