<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Upload field class.
 *
 * This class is entitled to manage the option/meta upload field types.
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
if( !class_exists('THB_UploadField') ) {
	class THB_UploadField extends THB_Field {

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'upload', $context );
		}

	}
}

if( ! function_exists( 'thb_partial_upload' ) ) {
	/**
	 * Render the partial for a media library upload control.
	 *
	 * @param array $data The template parameters.
	 */
	function thb_partial_upload( $data ) {
		$data = wp_parse_args( $data, array(
			'thumb'        => 'upload_field',
			'field_target' => ''
		) );

		$partial = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/partials/upload', $data);
		$partial->render();
	}
}