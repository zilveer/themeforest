<?php
/**
 * General functions used to integrate retina display
 *
 * @package unicase
 */

if( ! function_exists( 'unicase_retina_support_attachment_meta' ) ) {
	/**
	 * Retina images
	 *
	 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
	 */
	function unicase_retina_support_attachment_meta( $metadata, $attachment_id ) {
	    foreach ( $metadata as $key => $value ) {
	        if ( is_array( $value ) ) {
	            foreach ( $value as $image => $attr ) {
	                if ( is_array( $attr ) )
	                    unicase_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
	            }
	        }
	    }
	 
	    return $metadata;
	}
}

if( ! function_exists( 'unicase_retina_support_create_images' ) ) {
	/**
	 * Create retina-ready images
	 *
	 * Referenced via unicase_retina_support_attachment_meta().
	 */
	function unicase_retina_support_create_images( $file, $width, $height, $crop = false ) {
	    if ( $width || $height ) {
	        $resized_file = wp_get_image_editor( $file );
	        if ( ! is_wp_error( $resized_file ) ) {
	            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
	 
	            $resized_file->resize( $width * 2, $height * 2, $crop );
	            $resized_file->save( $filename );
	 
	            $info = $resized_file->get_size();
	 
	            return array(
	                'file' => wp_basename( $filename ),
	                'width' => $info['width'],
	                'height' => $info['height'],
	            );
	        }
	    }
	    return false;
	}
}

if( ! function_exists( 'unicase_delete_retina_support_images' ) ) {
	/**
	 * Delete retina-ready images
	 *
	 * This function is attached to the 'delete_attachment' filter hook.
	 */
	function unicase_delete_retina_support_images( $attachment_id ) {
	    $meta = wp_get_attachment_metadata( $attachment_id );
	    $upload_dir = wp_upload_dir();
	    $path = pathinfo( $meta['file'] );
	    foreach ( $meta as $key => $value ) {
	        if ( 'sizes' === $key ) {
	            foreach ( $value as $sizes => $size ) {
	                $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
	                $retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
	                if ( file_exists( $retina_filename ) )
	                    unlink( $retina_filename );
	            }
	        }
	    }
	}
}

if( ! function_exists( 'unicase_add_retina_filters' ) ) {
	/**
	 * Adds retina filters
	 */
	function unicase_add_retina_filters() {

		if( apply_filters( 'unicase_enable_retina', false ) ) {		
			add_filter( 'wp_generate_attachment_metadata', 'unicase_retina_support_attachment_meta', 10, 2 );
			add_filter( 'delete_attachment', 'unicase_delete_retina_support_images' );
		}
	}
}