<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Custom and regular post types helper.
 *
 * This file contains post type utility functions.
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

if ( ! function_exists( 'thb_get_post_meta' ) ) {
	/**
	 * Get a post meta key.
	 *
	 * @param int $post_id The post ID.
	 * @param string $key The post meta key.
	 * @return string
	 */
	function thb_get_post_meta( $post_id, $key = null ) {
		if( $key ) {
			return get_post_meta( $post_id, THB_META_KEY . $key, true );
		}

		return thb_get_post_meta_all( $post_id );
	}
}

if( ! function_exists( 'thb_update_post_meta' ) ) {
	/**
	 * Update a post meta key.
	 *
	 * @param int $post_id The post ID.
	 * @param string $key The post meta key.
	 * @param string $value The post meta value.
	 */
	function thb_update_post_meta( $post_id, $key, $value = '' ) {
		update_post_meta( $post_id, THB_META_KEY . $key, $value );
	}
}

if ( ! function_exists( 'thb_get_post_meta_all' ) ) {
	/**
	 * Get all the post meta keys.
	 *
	 * @param int $post_id The post ID.
	 * @return array
	 */
	function thb_get_post_meta_all( $post_id ) {
		$metas=array();

		if( $post_id == 0 ) {
			return $metas;
		}

		$thb_theme = thb_theme();
		$postType = $thb_theme->getPostType( get_post_type($post_id) );

		if( !$postType ) {
			return $metas;
		}

		$metaboxes = $postType->getMetaboxes();

		foreach( $metaboxes as $metabox ) {
			foreach( $metabox->getContainers() as $container ) {
				if( !$container->isDuplicable() ) {
					foreach( $container->getFields() as $field ) {
						if( $field->isComplex() ) {
							$value = array();
							foreach( $field->getSubkeys() as $subKey ) {
								$value[$subKey] = thb_get_post_meta($post_id, $field->getName() . '_' . $subKey);
							}
						}
						else {
							$value = thb_get_post_meta($post_id, $field->getName());
						}

						$metas[$field->getName()] = $value;
					}
				}
			}
		}

		return $metas;
	}
}

if( ! function_exists('thb_get_featured_image_id') ) {
	/**
	 * Get the current post's featured image attachment ID.
	 *
	 * @param  int $post_id The post ID.
	 * @return integer The attachment ID.
	 */
	function thb_get_featured_image_id( $post_id = null ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = get_the_ID();
		}

		return get_post_thumbnail_id( $post_id );
	}
}

if( ! function_exists('thb_get_featured_image') ) {
	/**
	 * Get the current post's featured image URL.
	 *
	 * @param  string $size The image size.
	 * @param  int $post_id The post ID.
	 * @return string
	 */
	function thb_get_featured_image( $size = 'full', $post_id = null ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = get_the_ID();
		}

		return thb_image_get_size( get_post_thumbnail_id( $post_id ), $size );
	}
}

if( ! function_exists('thb_featured_image') ) {
	/**
	 * Display the current post's featured image URL.
	 *
	 * @param  string $size The image size.
	 * @param  array  $config Configuration options.
	 * @param  int $post_id The post ID.
	 */
	function thb_featured_image( $size = 'full', $config = array(), $post_id = null ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = get_the_ID();
		}

		$config = wp_parse_args( $config, array(
			'link'       => true,
			'link_class' => 'item-thumb',
			'overlay'    => true
		) );

		thb_image( get_post_thumbnail_id( $post_id ), $size, $config );
	}
}

if( ! function_exists('thb_get_post_format') ) {
	/**
	 * Return the post format.
	 *
	 * @param int $post_id The post ID.
	 * @return string
	 */
	function thb_get_post_format( $post_id = null ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = get_the_ID();
		}

		$format = get_post_format( $post_id );

		return $format == '' ? 'standard' : $format;
	}
}

if( ! function_exists('thb_post_format') ) {
	/**
	 * Display the post format.
	 *
	 * @param int $post_id The post ID.
	 */
	function thb_post_format( $post_id = null ) {
		echo thb_get_post_format( $post_id );
	}
}

if( ! function_exists('thb_the_excerpt') ) {
	/**
	 * Display the excerpt of the current post in the loop.
	 *
	 * @param stdObject $post The post object.
	 * @param int $truncate_at=null How many chars to display.
	 * @param string $truncate_char='&hellip;' The truncating char.
	 * @return void
	 */
	function thb_the_excerpt( $post, $truncate_at=null, $truncate_char='&hellip;' ) {
		echo apply_filters( 'the_excerpt', thb_get_the_excerpt( $post, $truncate_at, $truncate_char ) );
	}
}

if( ! function_exists('thb_get_the_excerpt') ) {
	/**
	 * Get the excerpt of the current post in the loop.
	 *
	 * @param WP_Post $post The post object.
	 * @param int $truncate_at=null How many chars to display.
	 * @param string $truncate_char='&hellip;' The truncating char.
	 * @return string
	 */
	function thb_get_the_excerpt( $post, $truncate_at = null, $truncate_char = '&hellip;' ) {
		$excerpt = $post->post_excerpt;
		if( $excerpt == '' ) {
			$excerpt = $post->post_content;
		}

		// $excerpt = strip_shortcodes($excerpt);
		$excerpt = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $excerpt);

		if( $truncate_at != null ) {
			$excerpt = thb_text_truncate($excerpt, $truncate_at, $truncate_char);
		}
		else {
			$excerpt_length = apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', ' ' . $truncate_char);
			$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
		}

		return $excerpt;
	}
}

if( ! function_exists('thb_show_related') ) {
	/**
	 * Check if a list of related posts must be displayed.
	 *
	 * @param string $post_type The post type.
	 * @return boolean
	 */
	function thb_show_related( $post_type = null ) {
		if( ! $post_type ) {
			global $post;
			$post_type = $post->post_type;
		}

		$id = thb_get_page_ID();

		$show = thb_get_post_meta( $id, $post_type . '_related' );
		return $show == '1';
	}
}

if( ! function_exists('thb_get_post_type_taxonomies') ) {
	/**
	 * Return a list of the public hierarchical taxonomies defined for a given
	 * post type.
	 *
	 * @param string $post_type The post type name.
	 * @return array
	 */
	function thb_get_post_type_taxonomies( $post_type ) {
		$taxonomies = get_object_taxonomies( $post_type, 'objects' );
		$taxonomies = wp_list_filter( $taxonomies, array(
			'public'  => true,
			'show_ui' => true
		) );

		return $taxonomies;
	}
}

if( ! function_exists('thb_related_posts_query') ) {
	/**
	 * Return a set of loop parameter that pick up entries related to the one
	 * currently displayed.
	 *
	 * @return array
	 */
	function thb_related_posts_query() {
		$post_id = thb_get_page_ID();

		$post = get_post($post_id);
		$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );
		$taxonomies = wp_list_filter( $taxonomies, array(
			'public'  => true,
			'show_ui' => true
		) );

		// $taxonomies = get_taxonomies(
		// 	array(
		// 		'object_type' => array($post->post_type)
		// 	)
		// );

		$args['post__not_in'] = array($post_id);
		$args['post_type'] = $post->post_type;

		$tax_query = array();
		$tax_query['relation'] = 'OR';
		foreach($taxonomies as $taxonomy) {
			$key = $taxonomy->name;
			$terms = wp_get_post_terms($post_id, $key, array('fields' => 'ids'));
			if(!empty($terms)) {
				$tax_query[] = array(
					'taxonomy' => $key,
					'field'    => 'id',
					'terms'    => $terms,
					'operator' => 'IN'
				);
			}
		}

		$args['tax_query'] = $tax_query;

		return $args;
	}
}

if( ! function_exists('thb_page_video') ) {
	/**
	 * Print the page Video markup.
	 *
	 * @param integer $id The page/post ID.
	 */
	function thb_page_video( $id = false ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$video_url_mp4 = thb_get_post_meta( $id, 'video_url_mp4' );
		$video_url_ogv = thb_get_post_meta( $id, 'video_url_ogv' );
		$video_url_mov = thb_get_post_meta( $id, 'video_url_mov' );
		$video_url_embed = thb_get_post_meta( $id, 'video_url_embed' );

		if( empty( $video_url_mp4 ) && empty( $video_url_ogv ) && empty( $video_url_mov ) ) {
			// Embed
			if ( ! empty( $video_url_embed ) ) {
				thb_video( $video_url_embed, array(
					'autoplay' => thb_is_page_video_autoplay(),
					'loop'     => thb_is_page_video_loop(),
					'holder'   => false,
					'fill'     => (int) ! thb_is_page_video_fit()
				) );
				// global $wp_embed;
				// echo $wp_embed->run_shortcode('[embed]' . trim($video_url_embed) . '[/embed]');
			}
		}
		else {
			$atts = array();

			if( ! empty($video_url_mp4) ) {
				$atts['mp4'] = $video_url_mp4;
			}

			if( ! empty($video_url_ogv) ) {
				$atts['ogv'] = $video_url_ogv;
			}

			if( ! empty($video_url_mov) ) {
				$atts['mov'] = $video_url_mov;
			}

			echo do_shortcode('[video ' . thb_get_attributes($atts) . ']');
		}
	}
}

if( ! function_exists( 'thb_page_has_video' ) ) {
	/**
	 * Check if the page or post is using a video.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_page_has_video( $id = false, $key = 'video_url' ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		if ( get_post_type( $id ) == 'post' && get_post_format( $id ) != 'video' ) {
			return false;
		}

		$video_url_mp4 = thb_get_post_meta( $id, $key . '_mp4' );
		$video_url_ogv = thb_get_post_meta( $id, $key . '_ogv' );
		$video_url_mov = thb_get_post_meta( $id, $key . '_mov' );
		$video_url_embed = thb_get_post_meta( $id, $key . '_embed' );

		if( empty( $video_url_mp4 ) && empty( $video_url_ogv ) && empty( $video_url_mov ) && empty( $video_url_embed ) ) {
			return false;
		}

		return true;
	}
}

if( ! function_exists( 'thb_is_page_video_selfhosted' ) ) {
	/**
	 * Check if the page or post is using a self hosted video.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_is_page_video_selfhosted( $id = false, $key = 'video_url' ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$video_url_mp4 = thb_get_post_meta( $id, $key . '_mp4' );
		$video_url_ogv = thb_get_post_meta( $id, $key . '_ogv' );
		$video_url_mov = thb_get_post_meta( $id, $key . '_mov' );
		$video_url_embed = thb_get_post_meta( $id, $key . '_embed' );

		if( empty( $video_url_mp4 ) && empty( $video_url_ogv ) && empty( $video_url_mov ) && ! empty( $video_url_embed ) ) {
			return false;
		}

		return true;
	}
}

if( ! function_exists( 'thb_is_page_video_embed' ) ) {
	/**
	 * Check if the page or post is using an embedded video.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_is_page_video_embed( $id = false, $key = 'video_url' ) {
		return ! thb_is_page_video_selfhosted( $id, $key );
	}
}

if( ! function_exists( 'thb_is_page_video_autoplay' ) ) {
	/**
	 * Check if the page or post is using a video which must be autoplayed.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_is_page_video_autoplay( $id = false, $key = 'video_url' ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$video_url_autoplay = thb_get_post_meta( $id, $key . '_autoplay' );

		return ! empty( $video_url_autoplay );
	}
}

if( ! function_exists( 'thb_is_page_video_loop' ) ) {
	/**
	 * Check if the page or post is using a video which must be looped.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_is_page_video_loop( $id = false, $key = 'video_url' ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$video_url_loop = thb_get_post_meta( $id, $key . '_loop' );

		return ! empty( $video_url_loop );
	}
}

if( ! function_exists( 'thb_is_page_video_fit' ) ) {
	/**
	 * Check if the page or post is using a video which must be fitted.
	 *
	 * @param integer $id The page/post ID.
	 * @param string $key The video field key.
	 * @return boolean
	 */
	function thb_is_page_video_fit( $id = false, $key = 'video_url' ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		$video_url_fit = thb_get_post_meta( $id, $key . '_fit' );

		return ! empty( $video_url_fit );
	}
}

if( ! function_exists('thb_page_has_audio') ) {
	/**
	 * Check if the page or post is using an audio.
	 * @param integer $id The page/post ID.
	 * @return boolean
	 */
	function thb_page_has_audio( $id = false ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		if ( get_post_type( $id ) == 'post' && get_post_format( $id ) != 'audio' ) {
			return false;
		}

		$audio_url_mp3 = thb_get_post_meta( $id, 'audio_url_mp3' );
		$audio_url_ogg = thb_get_post_meta( $id, 'audio_url_ogg' );
		$audio_url_wav = thb_get_post_meta( $id, 'audio_url_wav' );
		$audio_url_embed = thb_get_post_meta( $id, 'audio_url_embed' );

		if( empty($audio_url_mp3) && empty($audio_url_ogg) && empty($audio_url_wav) && empty($audio_url_embed) ) {
			return false;
		}

		return true;
	}
}