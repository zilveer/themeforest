<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Duplicable table helper.
 *
 * This file contains duplicable table-related utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Add items to the duplicable table
 *
 * @param array $data The item data.
 * @return array
 **/
if( !function_exists('thb_duplicable_add') ) {
	function thb_duplicable_add( $data ) {
		global $wpdb;

		$wpdb->insert( 
			$wpdb->prefix . THB_DUPLICABLE_TABLE, 
			$data
		);
	}
}

/**
 * Update an item in the duplicable table
 *
 * @param int $id The item id.
 * @param array $data The item data.
 * @return array
 **/
if( !function_exists('thb_duplicable_update') ) {
	function thb_duplicable_update( $id, $data=array() ) {
		if( empty($data) ) {
			return;
		}

		global $wpdb;

		$wpdb->update( 
			$wpdb->prefix . THB_DUPLICABLE_TABLE, 
			$data,
			array('id' => $id)
		);
	}
}

/**
 * Get items from the duplicable table
 *
 * @param string $itemKey The item key.
 * @param int $post_id The item post_id.
 * @return array
 **/
if( !function_exists('thb_duplicable_get') ) {
	function thb_duplicable_get( $itemKey, $post_id=0 ) {
		global $wpdb;

		// Building the query
		$query = "select * from " . $wpdb->prefix . THB_DUPLICABLE_TABLE . " where field_key='{$itemKey}'";
		$query .= " and post_id={$post_id}";
		$query .= " order by ord asc";

		$items = $wpdb->get_results($query, ARRAY_A);

		for($i=0; $i<count($items); $i++) {
			$items[$i]['meta'] = unserialize($items[$i]['meta']);

			$unserializedValue = @unserialize($items[$i]['value']);
			if( $unserializedValue !== false || $items[$i]['value'] === 'b:0;' ) {
				$items[$i]['value'] = $unserializedValue;
			}
		}

		return $items;
	}
}

/**
 * Get all the items from the duplicable table
 *
 * @return array
 **/
if( !function_exists('thb_duplicable_get_all') ) {
	function thb_duplicable_get_all( $itemKey=null ) {
		global $wpdb;

		// Building the query
		$query = "select * from " . $wpdb->prefix . THB_DUPLICABLE_TABLE . " where 1=1";

		if( !empty($itemKey) ) {
			$query .= " and field_key = '$itemKey'";
		}

		$query .= " order by ord asc";

		$items = $wpdb->get_results($query, ARRAY_A);

		for($i=0; $i<count($items); $i++) {
			$items[$i]['meta'] = unserialize($items[$i]['meta']);

			$unserializedValue = @unserialize($items[$i]['value']);
			if( $unserializedValue !== false || $items[$i]['value'] === 'b:0;' ) {
				$items[$i]['value'] = $unserializedValue;
			}
		}

		return $items;
	}
}

/**
 * Remove items from the duplicable table
 *
 * @param string $itemKey The item key.
 * @param int $post_id The item post_id.
 * @return array
 **/
if( !function_exists('thb_duplicable_remove') ) {
	function thb_duplicable_remove( $itemKey, $post_id=0 ) {
		global $wpdb;

		$query = "delete from " . $wpdb->prefix . THB_DUPLICABLE_TABLE . " where field_key = '{$itemKey}' and post_id = {$post_id}";
		$wpdb->query($query);
	}
}

/**
 * Remove all the items from the duplicable table
 *
 * @return array
 **/
if( !function_exists('thb_duplicable_remove_all') ) {
	function thb_duplicable_remove_all() {
		global $wpdb;

		$query = "delete from " . $wpdb->prefix . THB_DUPLICABLE_TABLE . " where 1=1";
		$wpdb->query($query);
	}
}

/**
 * Save the duplicable fields.
 * 
 * @param THB_Field $field The duplicable field model.
 * @param integer $post_id The optional post_id.
 * @return void
 */
if( !function_exists('thb_duplicable_fields_save') ) {
	function thb_duplicable_fields_save( THB_Field $field, $post_id=0 ) {
		$fieldKey = $field->getName();
		$uniqids = array();

		thb_duplicable_remove( $fieldKey, $post_id );

		$count = 0;
		if( isset($_POST[$fieldKey]) ) {
			if( $field->isComplex() ) {
				$subKeys = $field->getSubkeys();
				$count = count($_POST[$fieldKey][$subKeys[0]]);
			}
			else {
				$count = count($_POST[$fieldKey]);
			}
		}

		if( $count > 0 ) {
			for( $i=0; $i<$count; $i++ ) {
				if( $field->isComplex() ) {
					$value = array();
					foreach( $field->getSubkeys() as $subKey ) {
						if( isset($_POST[$fieldKey][$subKey][$i]) ) {
							$value[$subKey] = thb_text_toDB( $_POST[$fieldKey][$subKey][$i] );
						}
					}

					$value = serialize($value);
				}
				else {
					if( isset($_POST[$fieldKey][$i]) ) {
						$value = thb_text_toDB( $_POST[$fieldKey][$i] );
					}
				}

				$meta['subtemplate'] = $_POST['subtemplate'][$fieldKey][$i];

				if( !empty($_POST['uniqid'][$fieldKey][$i]) ) {
					$meta['uniqid'] = $_POST['uniqid'][$fieldKey][$i];
				}
				else {
					$meta['uniqid'] = md5(time() . $i);
				}

				$uniqids[] = $meta['uniqid'];

				thb_duplicable_add(array(
					'ord'       => $i,
					'field_key' => $fieldKey,
					'value'     => $value,
					'meta'      => serialize($meta),
					'post_id'   => $post_id
				));
			}
		}

		return $uniqids;
	}
}