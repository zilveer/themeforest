<?php

/**
 * Post formats frontend utility functions.
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

if( ! function_exists('thb_post_format_audio') ) {
	/**
	 * Print the Audio post format markup.
	 */
	function thb_post_format_audio() {
		if ( get_post_format() != 'audio' ) {
			return;
		}

		$audio_url_mp3 = thb_get_post_meta( get_the_ID(), 'audio_url_mp3' );
		$audio_url_ogg = thb_get_post_meta( get_the_ID(), 'audio_url_ogg' );
		$audio_url_wav = thb_get_post_meta( get_the_ID(), 'audio_url_wav' );
		$audio_url_embed = thb_get_post_meta( get_the_ID(), 'audio_url_embed' );

		if( empty($audio_url_mp3) && empty($audio_url_ogg) && empty($audio_url_wav) ) {
			// Embed
			if ( ! empty($audio_url_embed) ) {
				global $wp_embed;
				echo $wp_embed->run_shortcode('[embed]' . trim($audio_url_embed) . '[/embed]');
			}
		}
		else {
			$atts = array();

			if( ! empty($audio_url_mp3) ) {
				$atts['mp3'] = $audio_url_mp3;
			}

			if( ! empty($audio_url_ogg) ) {
				$atts['ogg'] = $audio_url_ogg;
			}

			if( ! empty($audio_url_wav) ) {
				$atts['wav'] = $audio_url_wav;
			}

			echo do_shortcode('[audio ' . thb_get_attributes($atts) . ']');
		}
	}
}

if( ! function_exists('thb_post_format_gallery') ) {
	/**
	 * Output the markup for a Gallery post format.
	 *
	 * @param string $size The image size for the gallery.
	 * @param string $size_big The image size for the gallery linked file.
	 * @param string $class
	 * @param array $args
	 */
	function thb_post_format_gallery( $size, $size_big='full', $class='', $args = array() ) {
		if ( get_post_format() != 'gallery' ) {
			return;
		}

		$id = get_the_ID();
		$class = 'thb-gallery ' . $class;
		$gallery_field = thb_get_post_meta( $id, 'gallery_field' );

		// Attachment IDs
		preg_match_all('/ids="([^\"]+)"/i', $gallery_field, $matches, PREG_OFFSET_CAPTURE);

		if( isset($matches[1]) && !empty($matches[1]) ) {
			$attachments_ids = explode(',', $matches[1][0][0]);
			array_walk($attachments_ids, 'trim');
		}
		else {
			return '';
		}

		if ( isset( $args['template'] ) ) {
			$path = locate_template( $args['template'] );
		}
		else {
			$path = locate_template('templates/gallery.php');
		}

		if ( empty($path) ) {
			$path = dirname(__FILE__) . '/templates/gallery.php';
		}

		$template = new THB_Template($path, array(
			'attachments' => $attachments_ids,
			'class'       => $class,
			'size' 		  => $size,
			'size_big'    => $size_big
		));

		$template->render();
	}
}

if( ! function_exists('thb_get_post_format_image_id') ) {
	/**
	 * Get the post format image attachment ID.
	 *
	 * @return integer The attachment ID
	 */
	function thb_get_post_format_image_id() {
		return thb_get_featured_image_id();
	}
}

if( ! function_exists('thb_get_post_format_image_src') ) {
	/**
	 * Get the post format image URL.
	 *
	 * @param String $size The image size
	 * @return array An array with two keys 'full' and 'scaled'.
	 */
	function thb_get_post_format_image_src( $size = 'large' ) {
		$id = thb_get_post_format_image_id();

		$src = array(
			'full'   => thb_image_get_size( $id ),
			'scaled' => thb_image_get_size( $id,  $size )
		);

		return $src;
	}
}

if( ! function_exists( 'thb_post_format_image' ) ) {
	/**
	 * Print the Image post format markup.
	 *
	 * @param string $size The size of the featured image (scaled).
	 * @param array $config
	 */
	function thb_post_format_image( $size, $config = array() ) {
		if ( get_post_format() != 'image' ) {
			return;
		}

		$config = wp_parse_args( $config, array(
			'link' 			=> true,
			'link_class'    => 'item-thumb',
			'overlay'       => true,
			'overlay_class' => 'thb-overlay',
			'overlay_icon'  => '',
			'image_class'   => ''
		) );

		thb_image( thb_get_post_format_image_id(), $size, $config );
	}
}

if( ! function_exists( 'thb_get_post_format_link_url' ) ) {
	/**
	 * Get the Link post format URL.
	 *
	 * @return string
	 */
	function thb_get_post_format_link_url() {
		return esc_url( thb_get_post_meta( get_the_ID(), 'link_url' ) );
	}
}

if( ! function_exists( 'thb_get_post_format_quote_text' ) ) {
	/**
	 * Get the Quote post format text.
	 *
	 * @return string
	 */
	function thb_get_post_format_quote_text() {
		return thb_get_post_meta( get_the_ID(), 'quote' );
	}
}

if( ! function_exists( 'thb_get_post_format_quote_url' ) ) {
	/**
	 * Get the Quote post format URL.
	 *
	 * @return string
	 */
	function thb_get_post_format_quote_url() {
		return esc_url( thb_get_post_meta( get_the_ID(), 'quote_url' ) );
	}
}

if( ! function_exists( 'thb_get_post_format_quote_author' ) ) {
	/**
	 * Get the Quote post format author name.
	 *
	 * @return string
	 */
	function thb_get_post_format_quote_author() {
		return thb_get_post_meta( get_the_ID(), 'quote_author' );
	}
}

if( ! function_exists('thb_post_format_video') ) {
	/**
	 * Print the Video post format markup.
	 */
	function thb_post_format_video() {
		if ( get_post_format() != 'video' ) {
			return;
		}

		thb_page_video( get_the_ID() );
	}
}