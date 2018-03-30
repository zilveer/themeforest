<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. class BTP_Option_Model
 * 2. class BTP_Option_Model_Single
 * 3. class BTP_Option_Model_Array
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> ABSTRACT MODEL CLASS <<<----------------------------------- */
/* ------------------------------------------------------------------------- */



/**
* abstract Option Model
*
* @author 				bringthepixel <bringthepixel@gmail.com>  
* @package 				BTP_Framework 
* @subpackage			BTP_Options
*/
abstract class BTP_Option_Model {
	
	/**
	 * Scope of the model 
	 * @var 	string
	 */
	public $scope;
	
	/**
	 * Object identifier
	 * @var 	integer
	 */
	public $object_id;
	
	
	
	/**
	 * Constructor
	 * 
	 * @param 		string $scope
	 * @param 		integer $object_id
	 */
	public function __construct( $scope, $object_id ) {
		$this->scope = $scope;
		$this->object_id = $object_id;
	}	
	
	abstract public function update( $option );
	abstract public function after_updates();
	
    abstract public function select( $option );
	abstract public function after_selects();
    
	//public function install( $option_id, $option_config ) { }

}



/* ------------------------------------------------------------------------- */
/* ---------->>> SINGLE MODEL <<<------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
* Single ( Option Model )
* 
* Single Model stores each option in a single database field
*
* @author 				bringthepixel <bringthepixel@gmail.com>  
* @package 				BTP_Framework 
* @subpackage			BTP_Options
*/
class BTP_Option_Model_Single extends BTP_Option_Model { 	
	
	
	/**
	 * Installs option value
	 * 
	 * @param 			string $id option id
	 * @param 			array $config option configuration
	 */
	public function install( $id, $config ) {

		$value = null;		
		if ( isset( $config[ 'default' ] ) ) { 
			$value =  $config[ 'default' ];
		}	
			
		$meta_key = !empty( $config[ 'meta_key' ] ) ? $config[ 'meta_key' ] : $id;	
		
		switch( $this->option_type ) {
			case 'global':
			case 'theme':	
				add_option(				
					$config[ 'prefix' ] . '_' . $meta_key, 		// option_name
					$value										// newvalue	
				);
				break;
			default:
				break;	
		}	
	}
	
	
	/**
	 * Updates option value
	 * 
	 * @param 			string $id option id
	 * @param 			array $config option configuration
	 */
	public function update( $option ) {
		$meta_value = null;
		
		$id = $option->id;
		$prefix = $option[ 'prefix' ];		
		$meta_key = !empty( $option[ 'meta_key' ] ) ? $option[ 'meta_key' ] : $id;
				
		if ( isset( $_POST[ $prefix][ $id ] ) ) { 
			$meta_value =  stripslashes_deep( $_POST[ $prefix ][ $id ] );
		}	
		
		switch( $this->scope ) {
			case 'global':
			case 'theme':	
				update_option(				
					$prefix . '_' . $meta_key, 						// meta key
					$meta_value										// meta value	
				);
				break;				

			case 'post':
			case 'entry':	
				update_post_meta( 
					$this->object_id, 								// post id
					$prefix . '_' . $meta_key, 						// meta key
					$meta_value										// meta value 
				);				
				break;
				
			case 'taxonomy':
			case 'term':	
				update_option(
					$prefix . '_tt_' . $meta_key . '_' . $this->object_id , 	// meta key
					$meta_value													// meta value
				);	
				break;	

			default:
				break;	
		}	
	}
	
	
	
	/**
	 * Ends the update process
	 */
	public function after_updates() {
		
	}
	
	
	
	/**
	 * Selects option value
	 * 
	 * @param 			string $id option id
	 * @param 			string $config option configuration
	 * @return			mixed $meta_value
	 */
	public function select( $option ) {
		$meta_value = null;
		
		$prefix = $option[ 'prefix' ];		
		$meta_key = !empty( $option[ 'meta_key' ] ) ? $option[ 'meta_key' ] : $option->id;
			
		
		switch ( $this->scope ) {
			case 'global':
			case 'theme':		
				$meta_value = get_option( $prefix . '_' . $meta_key );
				break;
				
			case 'post':
			case 'entry':	
				$meta_value = get_post_meta( $this->object_id, $prefix . '_' . $meta_key, true );
				break;		
				
			case 'taxonomy':
			case 'term':	
				$result = get_option( $prefix . '_tt_' . $meta_key . '_' . $this->object_id );
				break;		
		}
		
		
//		if ( isset ( $config[ 'children' ] ) && is_array( $config[ 'children' ] ) ) {					
//			$default = isset ( $config[ 'default' ] ) && is_array( $config[ 'default' ] ) ? $config[ 'default' ] : array();
//			$value = is_array( $result ) ? $result : array();
//			$result = array_merge( $default, $value );
//		} 		
		
		return $meta_value;
	}
	
	
	
	/**
	 * Ends the select process
	 */
	public function after_selects() {
		
	}
}



/* ------------------------------------------------------------------------- */
/* ---------->>> ARRAY MODEL <<<-------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
* Array ( Option Model )
* 
* Array Model stores many options as an array in a single database field
*
* @author 				bringthepixel <bringthepixel@gmail.com>  
* @package 				BTP_Framework 
* @subpackage			BTP_Options
*/
class BTP_Option_Model_Array extends BTP_Option_Model {
	
	/**
	 * An array of prefixes (each prefix represent a single database field)
	 * @var				array
	 */
	protected $prefixes = array();
	
	
	
	/**
	 * Installs option value
	 * 
	 * @param 			string $id option id
	 * @param 			array $config option configuration
	 */
	public function insert( $option ) {
		
		$id = $option->id;
		$prefix = $option[ 'prefix' ];		
		
		if( !isset( $this->prefixes[ $prefix ] ) ) {
			$this->prefixes[ $prefix ] = array();
		}			
						
		$meta_key = !empty( $option[ 'meta_key' ] ) ? $option[ 'meta_key' ] : $id;	
		
		$this->prefixes[ $prefix ][ $meta_key ] = null;
		
		if ( isset( $option[ 'default' ] ) ) {
			$this->prefixes[ $prefix ][ $meta_key ] = $option[ 'default' ];
		}
	}
	
	
	
	/**
	 * Ends insert process 
	 */
	public function after_inserts() {
		switch( $this->scope ) {
			case 'global':
			case 'theme':		
				foreach( $this->prefixes as $prefix => $array ) {
					add_option( $prefix, $array );
				}			
				
				break;
							
			default:
				break;	
		}	
	}
	
	

	/**
	 * Updates option value
	 * 
	 * @param 			string $id option id
	 * @param 			array $config option configuration
	 */
	public function update( $option ) {		
		$id = $option->id;
		$prefix = $option[ 'prefix' ];	
		if( !isset( $this->prefixes[ $prefix ] ) ) {
			$this->prefixes[ $prefix ] = array();
		}			
						
		$meta_key = !empty( $option[ 'meta_key' ] ) ? $option[ 'meta_key' ] : $option->id;	
		
		$this->prefixes[ $prefix ][ $meta_key ] = null;
		
		if ( $option->has_children() ) {
			$meta_value = array();
			foreach ( $option[ 'children' ] as $k => $v ) {
				if ( isset( $_POST[ $prefix ][ $id ][ $k ] ) ) {
					$meta_value[ $k ] = stripslashes_deep( $_POST[ $prefix ][ $id ][ $k ] );
				}	
			}			
			$this->prefixes[ $prefix][ $meta_key ] = $meta_value;			
		} elseif ( isset( $_POST[ $prefix ][ $id ] ) ) {		
			$this->prefixes[ $prefix ][ $meta_key ] = stripslashes_deep( $_POST[ $prefix ][ $id ] );
		}
	}

	

	/**
	 * Ends update process 
	 */
	public function after_updates() {
		switch( $this->scope ) {
			case 'global':
			case 'theme':	
				foreach( $this->prefixes as $prefix => $array ) {
					$options = get_option( $prefix );
			
					if ( empty( $options ) )
						$options = array();
				
					$options = array_merge( $options, $array );
					update_option( $prefix, $options);
				}			
				
				break;				

			case 'post':
			case 'entry':					
				foreach( $this->prefixes as $prefix => $array ) {
					$options = get_post_meta( $this->object_id, $prefix, true );

					if ( !is_array($options) || empty( $options ) ) {
                        $options = array();
                    }

					$options = array_merge( $options, $array );
					update_post_meta( $this->object_id, $prefix, $options);
				}
								
				break;
				
			case 'taxonomy':
			case 'term':	
				foreach( $this->prefixes as $prefix => $array ) {
					$options = get_option( $prefix . '_tt_' . $this->object_id );
			
					if ( empty( $options ) )
						$options = array();
				
					$options = array_merge( $options, $array );
					update_option( $prefix . '_tt_' . $this->object_id, $options);
				}	
				break;		

			default:
				break;	
		}				 
		
	}
	
	
	
	/**
	 * Selects option value
	 * 
	 * @param 			string $id option id
	 * @param 			array $config option configuration
	 * @return			mixed
	 */
	public function select( $option ) {		
		$meta_value = null;
		
		$prefix = $option[ 'prefix' ];	
		if( !isset( $this->prefixes[ $prefix ] ) ) {
			$this->prefixes[ $prefix ] = array();
		}		
		
		$meta_key = !empty( $option[ 'meta_key' ] ) ? $option[ 'meta_key' ] : $option->id;
		
		switch ( $this->scope ) {
			case 'global':
			case 'theme':	
				$meta_value = get_option( $prefix );				
				break;
				
			case 'post':
			case 'entry':	
				$meta_value = get_post_meta( $this->object_id, $prefix, true );
				break;	

			case 'taxonomy':
			case 'term':	
				$meta_value = get_option( $prefix . '_tt_' . $this->object_id );
				break;
		}
		
		
		
		
		$default = isset ( $option[ 'default' ] ) ? $option[ 'default' ] : null;
		
		if ( isset( $meta_value[ $meta_key ] ) ) {
			$meta_value = $meta_value[ $meta_key ];
		} else {
			$meta_value = null;
		}
		
		$this->prefixes[ $prefix ][ $meta_key ] = $meta_value;
		
		$meta_value = ( null === $meta_value ) ? $default : $meta_value;		
		
		if ( $option->has_children() ) {
			$default = (array) $default;
			$meta_value = (array) $meta_value;
			
			$meta_value = array_multimerge( $default, $meta_value );
		} 
		
		return $meta_value;
	}	
	
	
	public function after_selects() {
		return $this->prefixes;
	}
	
	
	
}
?>