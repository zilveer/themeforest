<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Taxonomy class.
 *
 * This class is entitled to manage a taxonomy.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_Taxonomy') ) {
	class THB_Taxonomy {

		/**
		 * The taxonomy arguments.
		 *
		 * @var array
		 */
		private $_args;

		/**
		 * The taxonomy post type.
		 *
		 * @var string
		 */
		private $_postType;

		/**
		 * The taxonomy type.
		 *
		 * @var string
		 */
		private $_type;

		/**
		 * Constructor
		 *
		 * @param string $type The taxonomy type.
		 * @param
		 */
		public function __construct( $type, $args=array() )
		{
			if( empty($type) ) {
				wp_die( 'Empty taxonomy type.' );
			}

			if( empty($args) ) {
				wp_die( 'Empty taxonomy arguments.' );
			}

			$this->_type = $type;
			$this->_args = $args;
		}

		/**
		 * Get the taxonomy type.
		 *
		 * @return string
		 */
		public function getType()
		{
			return $this->_type;
		}

		/**
		 * Set the taxonomy post type.
		 *
		 * @param string $postType The post type.
		 * @return void
		 */
		public function setPostType( $postType )
		{
			if( empty($postType) ) {
				wp_die( 'Empty taxonomy post type.' );
			}

			$this->_postType = $postType;
		}

	}
}