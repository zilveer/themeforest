<?php
/**
* This class will be extended by all pagebuilder elements
*
* @category   Pagebuilder
* @package    ZnFramework
* @author     Balasa Sorin Stefan ( Zauan )
* @copyright  Copyright (c) Balasa Sorin Stefan
* @link       http://themeforest.net/user/zauan
*/

class ZnElements {

/** 
* Will contain all the element data ( 'width' , 'content' , 'options' , 'uid' )
*/
	var $data = array();

	function __construct( $args = array() ) {

		// SET UID IF NOT PROVIDED
		if ( empty( $args['uid'] ) ) { $args['uid'] = zn_uid('eluid'); }
		$this->data = $args;

	}

	function set($args = array()){
		$this->data = $args;
	}

/**
 * Description
 * @param string|bool $key
 * @param string|bool $default
 * @return mixed
 */
	function opt( $key = false, $default = false ){

		$return = false;

		if ( isset( $this->data['options'][$key] ) ) {
			$return = $this->data['options'][$key];
		}

		if ( $return == '' ) {
			return $default;
		}
		elseif( is_array( $return ) ){
			return $return;
		}
		else{
			return $return;
		}

	}

	function options() {
		return array();
	}


	function element() {
		die('Houston we have a problem');
	}

	function js(){
		
	}

	function css(){
		
	}

}