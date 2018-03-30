<?php

/**
 * Returns the translated object ID(post_type or term) or original if missing
 *
 * @param $object_id integer|string|array The ID/s of the objects to check and return
 * @param $type the object type: post, page, {custom post type name}, nav_menu, nav_menu_item, category, tag etc.
 * @return string or array of object ids
 */
function presscore_translate_object_id( $object_id, $type ) {
	if ( !did_action( 'wpml_loaded' ) ) {
		return $object_id;
	}

	// if array
	if( is_array( $object_id ) ){
		$translated_object_ids = array();
		foreach ( $object_id as $id ) {
			$translated_object_ids[] = apply_filters( 'wpml_object_id', $id, $type, true );
		}
		return $translated_object_ids;
	}
	// if int
	else {
		return apply_filters( 'wpml_object_id', $object_id, $type, true );
	}
}