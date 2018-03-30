<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. class BTP_Option_Holder
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



require_once( get_template_directory() .'/framework/lib/hierarchy.php' );
require_once( get_template_directory() .'/framework/lib/option-models.php' );



/**
* Option Holder
* 
* Organizes options (items to be exact) using a two-levels hierarchy ( subgroups inside groups )
* 
* @package 				BTP_Framework 
* @subpackage			BTP_Options
*/
abstract class BTP_Option_Holder extends BTP_Hierarchy {
	
	/**
	 * Constructor
	 */	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	/**
	 *	Returns option holder scope  
	 */
	abstract function get_scope();
	
	
	
	/**
	 * Gets the value of an option
	 * 
	 * @param 			integer $object_id
	 * @param 			string $option_id
	 */
	public function get_option_value( $object_id, $option_id ) {
		$option = $this->get_item( $option_id );
		
		$meta_value = null;
		
		if ( strlen( $option[ 'model' ] ) ) {
			$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
			$model = new $model_class( $this->get_scope(), $object_id );
			$meta_value = $model->select( $option );
		}
		
		return $meta_value;
	}
	
	
	
	/**
	 * Composes an array of appliable types 
	 * 
	 * @param 			string $group_id
	 * @return			array
	 */
	public function get_apply_set( $group_id ) {
		$result = array();
				
		foreach( $this->hierarchy[ $group_id ][ 'subgroups' ] as $subgroup_id => $subgroup_args ) {		
			foreach( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ] as $item_id => $item_args ) {				
				$result = array_merge( $result, $this->items[ $item_id ]->config['apply'] );
			}
		}

		/* Remove all entries of input equal to FALSE */
		$result = array_filter($result);
		
		return $result;
	}
}
?>