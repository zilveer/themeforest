<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( class_exists('THB_Template') ) { return; }

/**
 * Template class.
 *
 * This class is entitled to load and render dynamic templates.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Lib
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class THB_Template {

	/**
	 * The file extension of template files.
	 *
	 * @var	string $extension
	 */
	public static $extension = 'php';

	/**
	 * The path of the file to load.
	 *
	 * @var string $_path
	 */
	private $_path;

	/**
	 * The array of data passed to the template file.
	 *
	 * @var array
	 */
	private $_data = array();

	/**
	 * The content of the template file.
	 *
	 * @var string
	 */
	private $_content = '';

	/**
	 * Constructor
	 *
	 * @param string $path The path of the file to load.
	 * @param array $data The array of data passed to the template file.
	 */
	public function __construct( $path, array $data=array() )
	{
		if( empty($path) ) {
			wp_die( 'Empty template path.' );
		}

		if( ! thb_text_endsWith($path, '.' . THB_Template::$extension) ) {
			$this->_path = $path . '.' . THB_Template::$extension;
		}
		else {
			$this->_path = $path;
		}

		if( !file_exists($this->_path) ) {
			wp_die( sprintf( 'Missing template file: %s.', $this->_path ) );
		}

		$this->setData($data);
	}

	/**
	 * Set a variable in the template file.
	 *
	 * @param string $key The variable name.
	 * @param string $value The variable value.
	 */
	public function set( $key, $value='' )
	{
		if( $key === '' ) {
			wp_die( 'Empty key name.' );
		}

		$this->_data[$key] = $value;
	}

	/**
	 * Pass a data array to the template file.
	 *
	 * @param array $data The array of data passed to the template file.
	 */
	public function setData( array $data )
	{
		if( !empty($data) ) {
			foreach( $data as $k => $v ) {
				$this->set($k, $v);
			}
		}
	}

	/**
	 * Render the template to screen or return its content.
	 *
	 * @param boolean $return Set to true to return the template file content.
	 * @return string
	 */
	public function render( $return=false )
	{
		if( !empty($this->_data) ) {
			extract($this->_data);
		}

		ob_start();
		include $this->_path;
		$this->_content = ob_get_contents();
		ob_end_clean();

		if( $return ) {
			return $this->_content;
		}
		else {
			echo $this->_content;
		}
	}

	/**
	 * __toString()
	 *
	 */
	public function __toString()
	{
		return $this->render(true);
	}

}