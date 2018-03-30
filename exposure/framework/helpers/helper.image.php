<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Image helpers.
 *
 * This file contains image management utility functions.
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
 * Replace the button text in Media Gallery upload thickboxes.
 *
 * @param string $translation The string to translate.
 * @param string $original The original string.
 * @return string
 */
if( !function_exists('thb_image_replace_button_text') ) {
	function thb_image_replace_button_text( $translation, $original ) {
		if ( isset( $_REQUEST['type'] ) ) { return $translation; }

		if( $original == 'Insert into Post' ) {
			$translation = __('Use this image', 'thb_text_domain');

			if ( isset( $_REQUEST['title'] ) && $_REQUEST['title'] != '' ) {
				$translation = sprintf( __('Use as %s', 'thb_text_domain'), esc_attr(strtolower($_REQUEST['title'])) );
			}
		}

		return $translation;
	}
}
add_filter( 'gettext', 'thb_image_replace_button_text', null, 2 );

/**
 * Get an attachment's ID from its URL.
 *
 * @param string $url The attachment's URL
 * @return int
 **/
if( !function_exists('thb_image_get_attachment_id') ) {
	function thb_image_get_attachment_id( $url ) {

		$dir = wp_upload_dir();
		$dir = trailingslashit($dir['baseurl']);

		if( false === strpos( $url, $dir ) )
			return false;

		$file = basename($url);

		$query = array(
			'post_type' => 'attachment',
			'fields' => 'ids',
			'meta_query' => array(
				array(
					'value' => $file,
					'compare' => 'LIKE',
				)
			)
		);

		$query['meta_query'][0]['key'] = '_wp_attached_file';
		$ids = get_posts( $query );

		foreach( $ids as $id )
			if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
				return $id;

		$query['meta_query'][0]['key'] = '_wp_attachment_metadata';
		$ids = get_posts( $query );

		foreach( $ids as $id ) {

			$meta = wp_get_attachment_metadata($id);

			foreach( $meta['sizes'] as $size => $values )
				if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
					return $id;
				}
		}

		return false;
	}
}

/**
 * Return the image size from its attachment ID.
 *
 * @param string $thumbnail_id The image's ID.
 * @param string $size The image size.
 * @return string
 **/
if( !function_exists('thb_image_get_size') ) {
	function thb_image_get_size( $thumbnail_id, $size='thumbnail_image' ) {
		$thumbnail_image = wp_get_attachment_image_src( $thumbnail_id, $size );

		return $thumbnail_image[0];
	}
}

/**
 * Echo the scaled version of an image in full size taken from the media
 * library.
 *
 * @return void
 */
if( !function_exists('thb_image_get_sizes') ) {
	function thb_image_get_sizes() {
		if( !empty($_POST) ) {
			$height = $_POST['height'];
			$width = $_POST['width'];
			$src = $_POST['src'];

			echo thb_image_get_size( $src, array($width, $height) );
		}

		die();
	}
}

/**
 * Get the post featured image URL.
 *
 * @param int $post_id The post ID.
 * @param string $size The image size.
 * @return string
 **/
if( !function_exists('thb_get_post_thumbnail_src') ) {
	function thb_get_post_thumbnail_src( $post_id=null, $size='full' ) {
		if( !$post_id ) {
			global $post;
			$post_id = $post->ID;
		}

		$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
		return $thumbnail[0];
	}
}

/**
 * Alias for thb_get_post_thumbnail_src.
 */
if( !function_exists('thb_get_featured_image') ) {
	function thb_get_featured_image( $post_id=null, $size='full' ) {
		return thb_get_post_thumbnail_src($post_id, $size);
	}
}

/**
 * Render a dinamically resized image.
 *
 * @param string $id The image attachment ID.
 * @param int $width The desired image width.
 * @param int $height The desired image height.
 * @param boolean $crop True if the image must be cropped.
 * @return void
 */
if( !function_exists('thb_render_image') ) {
	function thb_render_image( $id, $width, $height, $crop=true ) {
		if( !function_exists('wp_get_image_editor') ) {
			return;
		}

		$img = wp_get_attachment_image_src($id, 'full');

		if( is_array($img) && isset($img[0]) ) {
			$image = wp_get_image_editor($img[0]);
			if( !is_wp_error( $image ) ) {
				$image->resize($width, $height, $crop);
				$image->stream();
			}
			else {
				$res = thb_read_url($img[0]);

				if( !empty($res) ) {
					if( thb_text_endsWith($img[0], ".png") ) {
						header( 'Content-Type: image/png' );
					}
					elseif( thb_text_endsWith($img[0], ".gif") ) {
						header( 'Content-Type: image/gif' );
					}
					else {
						header( 'Content-Type: image/jpeg' );
					}

					echo $res;
				}
				else {
					header( 'Content-Type: image/jpeg' );
					echo '';
				}
			}
		}
	}
}

/**
 * Return the dinamically resized image URL.
 *
 * @param string $id The image upload ID.
 * @param int $width The desired image width.
 * @param int $height The desired image height.
 * @param boolean $crop True if the image must be cropped.
 * @return void
 */
if( !function_exists('thb_get_resized_image') ) {
	function thb_get_resized_image( $id, $width, $height, $crop=false ) {
		if( !$crop ) {
			$url = thb_custom_resource('frontend/getImageSize');
		}
		else {
			$url = thb_custom_resource('frontend/resizeImage');
		}

		$url .= '&id=' . $id;
		$url .= '&w=' . $width;
		$url .= '&h=' . $height;

		return $url;
	}
}

/**
 * Echo the dinamically resized image URL.
 *
 * @param string $id The image upload ID.
 * @param int $width The desired image width.
 * @param int $height The desired image height.
 * @param boolean $crop True if the image must be cropped.
 * @return void
 */
if( !function_exists('thb_resize_image') ) {
	function thb_resize_image( $id, $width, $height, $crop=true ) {
		echo thb_get_resized_image($id, $width, $height, $crop=true);
	}
}