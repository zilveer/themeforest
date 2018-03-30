<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Duplicable table helper.
 *
 * This file contains duplicable table-related utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists( 'thb_duplicable_add' ) ) {
	/**
	 * Add items to the duplicable table
	 *
	 * @param string $itemKey The item key.
	 * @param array $data The item data.
	 * @return array
	 **/
	function thb_duplicable_add( $itemKey, $data ) {
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

		// foreach ( $duplicables as $key => $items ) {
		// 	if ( ! empty( $items ) ) {
		// 		foreach ( $items as $item_index => $item ) {
		// 			$duplicables[$key][$item_index]['value'] = wp_slash( $duplicables[$key][$item_index]['value'] );
		// 		}
		// 	}
		// }

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

if( ! function_exists( 'thb_duplicable_get' ) ) {
	/**
	 * Get items from the duplicable table.
	 *
	 * @param string $itemKey The item key.
	 * @param int $post_id The item post_id.
	 * @return array
	 **/
	function thb_duplicable_get( $itemKey, $post_id = 0 ) {
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

if( ! function_exists( 'thb_duplicable_get_all' ) ) {
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

if( ! function_exists( 'thb_duplicable_remove_all' ) ) {
	/**
	 * Remove all the global duplicable items.
	 *
	 * @return array
	 **/
	function thb_duplicable_remove_all() {
		update_option( THB_DUPLICABLE_KEY, array() );
	}
}

if( ! function_exists( 'thb_duplicable_remove' ) ) {
	/**
	 * Remove items from the duplicable table
	 *
	 * @param string $itemKey The item key.
	 * @param int $post_id The item post_id.
	 * @return array
	 **/
	function thb_duplicable_remove( $itemKey, $post_id = 0 ) {
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

if( ! function_exists( 'thb_duplicable_fields_save' ) ) {
	/**
	 * Save the duplicable fields.
	 *
	 * @param THB_Field $field The duplicable field model.
	 * @param integer $post_id The optional post_id.
	 */
	function thb_duplicable_fields_save( THB_Field $field, $post_id = 0 ) {
		$fieldKey = $field->getName();
		$uniqids = $meta = array();

		thb_duplicable_remove( $fieldKey, $post_id );

		$count = 0;
		if( isset( $_POST[$fieldKey] ) ) {
			$count = count( $_POST[$fieldKey] );
		}

		if( $count > 0 ) {
			$i = 0;
			foreach ( $_POST[$fieldKey] as $submitted_field ) {
				if( $field->isComplex() ) {
					$value = array();
					foreach( $field->getSubkeys() as $subKey ) {
						if ( isset( $submitted_field[$subKey] ) ) {
							$value[$subKey] = $field->preProcessData( $submitted_field[$subKey] );
						}
					}
				}
				else {
					$value = '';
					if ( isset( $submitted_field['value'] ) ) {
						$value = $field->preProcessData( $submitted_field['value'] );
					}
				}

				$meta['subtemplate'] = $submitted_field['subtemplate'];

				if( ! empty( $submitted_field['uniqid'] ) ) {
					$meta['uniqid'] = $submitted_field['uniqid'];
				}
				else {
					$meta['uniqid'] = md5( time() . $i );
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

				thb_duplicable_add( $fieldKey, array(
					'ord'     => $i,
					'value'   => $value,
					'meta'    => $meta,
					'post_id' => $post_id
				) );

				$i++;
			}
		}

		return $uniqids;
	}
}