<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Template loader class.
 *
 * This class is entitled to idenfity loading paths for specific THB_Templates to load.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Lib
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( ! class_exists('THB_TemplateLoader') ) {
	class THB_TemplateLoader {

		/**
		 * An ordered list of paths where to look for a specific template file.
		 *
		 * @var array
		 */
		public static $queue = array();

		/**
		 * The THB_Template object that's being loaded.
		 *
		 * @var THB_Template
		 */
		private $_template;

		/**
		 * Constructor
		 *
		 * @param string $path The path of the file to load.
		 * @param array $data The array of data passed to the template file.
		 * @return THB_TemplateLoader
		 */
		public function __construct( $path, array $data=array() )
		{
			$this->_template = new THB_Template( $this->_resolvePath($path), $data );
			return $this;
		}

		/**
		 * Get the loaded THB_Template object.
		 *
		 * @return THB_Template
		 */
		public function getTemplate()
		{
			return $this->_template;
		}

		/**
		 * Verify the existence of the supplied $path against an ordered list of possible paths.
		 *
		 * @param string $path The path of the file to load.
		 * @return string
		 */
		private function _resolvePath( $path )
		{
			if( empty(self::$queue) ) {
				wp_die( 'Empty template path queue.' );
			}

			foreach( self::$queue as $basePath ) {
				$tempPath = $basePath . '/' . $path . '.' . THB_Template::$extension;
				if( file_exists($tempPath) ) {
					return $basePath . '/' . $path;
				}
			}

			wp_die( sprintf( 'Missing template file: %s.', $path ) );
		}

		/**
		 * Render the template to screen or return its content.
		 *
		 * @param boolean $return Set to true to return the template file content.
		 * @return string
		 */
		public function render( $return=false )
		{
			if( $return ) {
				return $this->_template->render(true);
			}
			else {
				$this->_template->render(false);
			}
		}

		/**
		 * __toString()
		 *
		 */
		public function __toString()
		{
			return $this->_template->render(true);
		}

	}
}