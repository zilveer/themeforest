<?php
/**
 * Meta Box Helper Functions
 *
 * Meta boxes / custom fields for certain post types are defined in slider.php, multimedia.php, gallery.php, events.php, etc.
 */

/**
 * Meta Box Nonce Parameters
 * Forms uniform action and nonce field parameters for form and saving
 */
 
if ( ! function_exists( 'risen_meta_box_nonce_keys' ) ) {
	 
	function risen_meta_box_nonce_params( $meta_box_id ) {

		$nonce_params = array();
	
		$nonce_params['action'] = $meta_box_id . '_save';
		$nonce_params['key'] = $meta_box_id . '_nonce';

		return $nonce_params;
		
	}
	
}

/**
 * Save Meta Box Values
 */

if ( ! function_exists( 'risen_meta_box_save' ) ) {
	 
	function risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post ) {

		// Is a POST occurring?
		if ( empty( $_POST ) ) {
			return false;
		}

		// Not an auto-save (meta values not submitted)
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}
	
		// Verify the nonce
		$nonce_params = risen_meta_box_nonce_params( $meta_box_id );
		if ( empty( $_POST[$nonce_params['key']] ) || ! wp_verify_nonce( $_POST[$nonce_params['key']], $nonce_params['action'] ) ) {
			return false;
		}
		
		// Make sure user has permission to edit
		$post_type = get_post_type_object( $post->post_type );
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return false;
		}
		
		// Loop fields
		foreach( $meta_keys as $meta_key ) {

			// Meta value, prepared
			$meta_value = isset( $_POST[$meta_key] ) ? trim( $_POST[$meta_key] ) : '';

			// Add value if it key does not exist
			// Or upate value it key does exist
			// Note: see old code below which deleted key if epty value
			// This is no longer done because it causes posts with empty values to disappear when sorted on that key!
			update_post_meta( $post_id, $meta_key, $meta_value );
				
			/* Old way causes sorting problems (see note above)
				
			// Update value or add if key does not exist
			if ( ! empty( $meta_value ) ) {
				update_post_meta( $post_id, $meta_key, $meta_value );
			}
			
			// Delete key if value is empty and key exists in database
			else if ( get_post_meta( $post_id, $meta_key, true ) ) {
				delete_post_meta( $post_id, $meta_key );
			}
			
			*/
			
		}

	}
	
}
