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
 * @param string $itemKey The item key.
 * @param array $data The item data.
 * @return array
 **/
if( !function_exists('thb_duplicable_add') ) {
	function thb_duplicable_add( $itemKey, $data = array() ) {
		if( isset($data['post_id']) ) {
			$post_id = $data['post_id'];
			unset($data['post_id']);
		}
		else {
			$post_id = 0;
		}

		if( $post_id == 0 ) {
			$duplicables = get_option(THB_DUPLICABLE_KEY);
		}
		else {
			$duplicables = get_post_meta($post_id, THB_DUPLICABLE_KEY, true);
		}

		if( ! isset($duplicables[$itemKey]) ) {
			$duplicables[$itemKey] = array();
		}

		$duplicables[$itemKey][] = $data;

		if( $post_id == 0 ) {
			update_option(THB_DUPLICABLE_KEY, $duplicables);
		}
		else {
			update_post_meta($post_id, THB_DUPLICABLE_KEY, $duplicables);
		}
	}
}

if( ! function_exists('thb_duplicable_sort_by_order') ) {
	/**
	 * Sort the duplicable entries by their order.
	 *
	 * @param array $itemA
	 * @param array $itemB
	 * @return boolean
	 */
	function thb_duplicable_sort_by_order( $itemA, $itemB ) {
		return $itemB['ord'] < $itemA['ord'];
	}
}

if( !function_exists('thb_duplicable_get') ) {
	/**
	 * Get items from the duplicable table.
	 *
	 * @param string $itemKey The item key.
	 * @param int $post_id The item post_id.
	 * @return array
	 **/
	function thb_duplicable_get( $itemKey, $post_id=0 ) {
		$items = array();

		if( $post_id == 0 ) {
			$items = (array) get_option(THB_DUPLICABLE_KEY);
		}
		else {
			$items = (array) get_post_meta($post_id, THB_DUPLICABLE_KEY, true);
		}

		if( isset($items[$itemKey]) ) {
			usort($items[$itemKey], 'thb_duplicable_sort_by_order');
			return $items[$itemKey];
		}

		return array();
	}
}

if( !function_exists('thb_duplicable_get_all') ) {
	/**
	 * Get all the global duplicable items.
	 *
	 * @return array
	 **/
	function thb_duplicable_get_all( $itemKey=null ) {
		$items = array();

		$items = (array) get_option(THB_DUPLICABLE_KEY);

		if( $itemKey && isset($items[$itemKey]) ) {
			return $items[$itemKey];
		}
		else {
			return $items;
		}
	}
}

/**
 * Remove all the global duplicable items.
 *
 * @return array
 **/
if( !function_exists('thb_duplicable_remove_all') ) {
	function thb_duplicable_remove_all() {
		update_option( THB_DUPLICABLE_KEY, array() );
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
		if( $post_id == 0 ) {
			$duplicables = (array) get_option(THB_DUPLICABLE_KEY);
		}
		else {
			$duplicables = (array) get_post_meta($post_id, THB_DUPLICABLE_KEY, true);
		}

		if( isset($duplicables[$itemKey]) ) {
			unset($duplicables[$itemKey]);
		}

		if( $post_id == 0 ) {
			update_option(THB_DUPLICABLE_KEY, $duplicables);
		}
		else {
			update_post_meta($post_id, THB_DUPLICABLE_KEY, $duplicables);
		}
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

					// $value = serialize($value);
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

				if( is_array($value) ) {
					foreach( $value as $k => $v ) {
						$value[$k] = thb_text_normalize($v);
					}
				}
				else {
					$value = thb_text_normalize($value);
				}

				thb_duplicable_add($fieldKey, array(
					'ord'       => $i,
					'value'     => $value,
					'meta'      => $meta,
					'post_id'	=> $post_id
				));
			}
		}

		return $uniqids;
	}
}