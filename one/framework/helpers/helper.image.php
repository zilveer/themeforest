<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Image helpers.
 *
 * This file contains image management utility functions.
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

if ( ! function_exists( 'thb_images_upload_get_sizes' ) ) {
	/**
	 * Output the images size from their attachment IDs for AJAX operations.
	 **/
	function thb_images_upload_get_sizes() {
		header('Content-type: application/json');

		$ids = thb_input_get( 'id', false, array() );
		$size = thb_input_get( 'size', 'string' );

		if ( ! empty( $ids ) && $size !== false ) {
			$sizes = array();

			foreach ( $ids as $id ) {
				$sizes[] = array(
					'id' => thb_sanitize( $id, 'absint' ),
					'image' => thb_image_get_size( $id, $size )
				);
			}

			die( json_encode( $sizes ) );
		}

		die();
	}
}

if( ! function_exists('thb_image_upload_get_size') ) {
	/**
	 * Output the image size from its attachment ID for AJAX operations.
	 **/
	function thb_image_upload_get_size() {
		$id = thb_input_get( 'id', 'string', 0 );
		$size = thb_input_get( 'size', 'string' );

		if( is_numeric( $id ) && $id > 0 ) {
			die( thb_image_get_size( $id, $size ) );
		}
		else {
			die( esc_url( thb_get_video_thumbnail( $id, 'thumbnail_small' ) ) );
		}

		die();
	}
}

if( ! function_exists('thb_image_get_size') ) {
	/**
	 * Return the image size from its attachment ID.
	 *
	 * @param int|string $id The attachment ID or embed URL.
	 * @param string $size The image size.
	 * @return string
	 **/
	function thb_image_get_size( $id, $size = 'full' ) {
		if( ! empty( $id ) && is_array( $image = wp_get_attachment_image_src( $id, $size ) ) ) {
			return esc_url( current( $image ) );
		}

		return '';
	}
}

if( ! function_exists('thb_get_image') ) {
	/**
	 * Return an image.
	 *
	 * @param  int $id The attachment ID.
	 * @param  string $size The image size.
	 * @param  array  $config Configuration options.
	 * @return string
	 */
	function thb_get_image( $id, $size = 'full', $config = array() ) {
		$config = wp_parse_args( $config, array(
			'link'          => false,
			'link_class'    => '',
			'link_size'		=> 'full',
			'link_title'    => '',
			'link_href'		=> '',
			'link_target'	=> false,
			'overlay'       => false,
			'overlay_class' => 'thb-overlay',
			'attr'          => array(),
			'lazy'			=> false
		) );

		$full = thb_image_get_size( $id, $config['link_size'] );

		if ( $full ) {
			$image = '';
			$title = esc_attr( $config['link_title'] );

			if ( $config['link'] ) {
				$target = '';
				$href = ! empty( $config['link_href'] ) ? $config['link_href'] : $full;
				$href = esc_url( $href );

				if ( $config['link_target'] !== false ) {
					$target = 'target="' . esc_attr( $config['link_target'] ) . '"';
				}

				$config['link_class'] = apply_filters( 'thb_image_link_class', $config['link_class'] );
				$image .= sprintf( '<a href="%s" class="%s" %s>', $href, esc_attr( $config['link_class'] ), $target );
			}

				$image_src = thb_image_get_size( $id, $size );

				if ( $config['overlay'] ) { $image .= sprintf( '<span class="%s"></span>', $config['overlay_class'] ); }

				if( $config['lazy'] ) {
					$image_src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
					// $config['attr']['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
					$config['attr']['data-src'] = thb_image_get_size( $id, $size );
				}

				$config['attr']['alt'] = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );

				$image_classes = array(
					"attachment-$size"
				);

				if ( isset( $config['attr'] ) && isset( $config['attr']['class'] ) ) {
					$image_classes = wp_parse_args( (array) $config['attr']['class'], $image_classes );
					unset( $config['attr']['class'] );
				}

				$attachment_metadata = wp_get_attachment_metadata( $id );
				$width = false;
				$height = false;

				if ( $attachment_metadata ) {
					if ( isset( $attachment_metadata['sizes'] ) && isset( $attachment_metadata['sizes'][$size] ) ) {
						$width = $attachment_metadata['sizes'][$size]['width'];
						$height = $attachment_metadata['sizes'][$size]['height'];
					}
					else {
						$width = $attachment_metadata['width'];
						$height = $attachment_metadata['height'];
					}
				}

				if ( $width && $height ) {
					$config['attr']['width'] = absint( $width );
					$config['attr']['height'] = absint( $height );
				}

				$image .= sprintf( '<img src="%s" class="%s" %s>', $image_src, thb_get_classes( $image_classes ), thb_get_attributes( $config['attr'] ) );
				// $image .= wp_get_attachment_image( $id, $size, false, $config['attr'] );

			if ( $config['link'] ) {
				$image .= '</a>';

				if ( $title != '' ) {
					$image .= sprintf( '<div class="wp-caption-text">%s</div>', $title );
				}
			}

			return $image;
		}

		return '';
	}
}

if( ! function_exists('thb_image') ) {
	/**
	 * Display an image.
	 *
	 * @param  int $id The attachment ID.
	 * @param  string $size The image size.
	 * @param  array  $config Configuration options.
	 */
	function thb_image( $id, $size = 'full', $config = array() ) {
		echo thb_get_image( $id, $size, $config );
	}
}