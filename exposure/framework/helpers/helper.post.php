<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Custom and regular post types helper.
 *
 * This file contains post type utility functions.
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
 * Check the page template.
 *
 * @param int $page_id The page ID.
 * @param string $template The page template to be checked against.
 * @return string
 */
if( !function_exists('thb_check_page_template') ) {
	function thb_check_page_template( $page_id, $template ) {
		$current_template = thb_get_page_template($page_id);

		if( !is_array($template) ) {
			return $current_template == $template;
		}
		else {
			return in_array($current_template, $template);
		}
	}
}

/**
 * Check if the current page is using a specific template.
 *
 * @param mixed $template The page template(s).
 * @param int $page_id The page ID.
 * @return boolean
 */
if( !function_exists('thb_is_page_template') ) {
	function thb_is_page_template( $template, $page_id=null ) {
		if( !$page_id ) {
			$page_id = thb_get_page_ID();
		}

		$page_template = thb_get_page_template($page_id);

		if( is_array($template) ) {
			return in_array($page_template, $template);
		}

		return $page_template == $template;
	}
}

/**
 * Get the page template.
 *
 * @param int $page_id The page ID.
 * @return string
 */
if( !function_exists('thb_get_page_template') ) {
	function thb_get_page_template( $page_id=null ) {
		if( $page_id == null ) {
			$page_id = thb_get_page_ID();
		}

		$template = '';

		if( $page_id === 0 ) {
			return $template;
		}

		$post_type = get_post_type($page_id);

		if( $post_type == 'page' ) {
			$template = get_post_meta( $page_id, '_wp_page_template', true );

			if( !$template ) {
				$template = 'default';
			}
		}
		else if( !empty($post_type) ) {
			if( $post_type == 'post' ) {
				return 'single.php';
			}
			else {
				return 'single-' . $post_type . '.php';
			}
		}

		return $template;
	}
}

/**
 * Return the page template.
 *
 * @return string
 */
if( !function_exists('thb_admin_template') ) {
	function thb_admin_template() {
		// $thb_page_id = isset($_GET['post']) ? $_GET['post'] : 0;

		// return thb_get_page_template($thb_page_id);

		return thb_get_admin_template();
	}
}

if( ! function_exists('thb_get_admin_template') ) {
	/**
	 * Get the admin page template.
	 *
	 * @return string
	 */
	function thb_get_admin_template() {
		$thb_page_id = 0;

		if( isset($_GET['post']) ) {
			$thb_page_id = (int) $_GET['post'];
		}
		elseif( defined('POLYLANG_VERSION') && isset($_GET['from_post']) ) { // Polylang compatibility fix
			$thb_page_id = (int) $_GET['from_post'];
		}

		if( ! $thb_page_id ) {
			if( isset($_GET['post_type']) ) {
				if( $_GET['post_type'] != 'page' ) {
					return 'single-' . $_GET['post_type'] . '.php';
				}
				else {
					return 'default';
				}
			}
			else {
				return 'single.php';
			}
		}
		else {
			return thb_get_page_template($thb_page_id);
		}
	}
}

if( !function_exists('thb_is_admin_template') ) {
	/**
	 * Check the page template.
	 *
	 * @param string $template The page template to be checked against.
	 * @return string
	 */
	function thb_is_admin_template( $template ) {
		if( is_string($template) ) {
			if( empty($_POST) && is_admin() ) {
				return $template == thb_get_admin_template();
			}

			return true;
		}
		elseif( is_array($template) ) {
			foreach( $template as $t ) {
				if( thb_is_admin_template($t) ) {
					return true;
				}
			}
		}

		return false;
	}
}

/**
 * Return the post type name from a specified page template filename.
 *
 * E.g. "template-contact.php" returns "page",
 * "single-works.php" returns "works".
 *
 * @param string $template The page template filename.
 * @return string
 */
if( !function_exists('thb_get_post_type_from_template') ) {
	function thb_get_post_type_from_template( $template ) {
		$post_type = 'page';

		if( $template == 'single.php' ) {
			$post_type = 'post';
		}
		elseif( thb_text_startsWith($template, 'single-') ) {
			$post_type = str_replace('single-', '', $template);
			$post_type = str_replace('.php', '', $post_type);
		}

		return $post_type;
	}
}

/**
 * Return the page templates associated to a specific post type.
 *
 * @param string $post_type The post type.
 * @return array
 */
if( !function_exists('thb_post_type_page_templates') ) {
	function thb_post_type_page_templates( $post_type='post' ) {
		$templates = array();

		return apply_filters('thb_' . $post_type . '_page_templates', $templates);
	}
}

/**
 * Get a post meta key.
 *
 * @param int $post_id The post ID.
 * @param string $key The post meta key.
 * @return string
 */
if( !function_exists('thb_get_post_meta') ) {
	function thb_get_post_meta( $post_id, $key=null ) {
		if( $key ) {
			return get_post_meta($post_id, THB_META_KEY . $key, true);
		}

		return thb_get_post_meta_all($post_id);
	}
}

/**
 * Get all the post meta keys.
 *
 * @param int $post_id The post ID.
 * @return array
 */
if( !function_exists('thb_get_post_meta_all') ) {
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

/**
 * Return the post format.
 *
 * @param int $post_id The post ID.
 * @return string
 */
if( !function_exists('thb_get_post_format') ) {
	function thb_get_post_format( $post_id=null ) {
		global $post;
		return get_post_format($post_id) == '' ? 'standard' : get_post_format($post_id);
	}
}

/**
 * Return the post icon code.
 *
 * @param int $post_id The post ID.
 * @param boolean $return True if the value has to be returned.
 * @return void
 */
if( !function_exists('thb_get_post_icon') ) {
	function thb_get_post_icon( $post_id, $return=false ) {
		global $post;
		$is_sticky = is_sticky($post_id);

		if( $is_sticky ) {
			$code = '*';
		}
		else {
			$code = thb_get_post_format_icon($post_id, true);
		}

		if( $return ) {
			return $code;
		}
		else {
			echo $code;
		}
	}
}

/**
 * Return the post format icon code.
 *
 * @param int $post_id The post ID.
 * @param boolean $return True if the value has to be returned.
 * @return void
 */
if( !function_exists('thb_get_post_format_icon') ) {
	function thb_get_post_format_icon( $post_id, $return=false ) {
		global $post;
		$format = thb_get_post_format($post_id);

		switch( $format ) {
			case 'gallery':
				$code = 'b';
				break;
			case 'quote':
				$code = 'c';
				break;
			case 'video':
				$code = 'd';
				break;
			case 'image':
				$code = 'e';
				break;
			case 'aside':
				$code = 'f';
				break;
			case 'audio':
				$code = 'g';
				break;
			case 'link':
				$code = 'h';
				break;
			case 'standard':
			default:
				$code = 'a';
				break;
		}

		if( $return ) {
			return $code;
		}
		else {
			echo $code;
		}
	}
}

/**
 * Prints the excerpt of the current post in the loop.
 *
 * @param stdObject $post The post object.
 * @param int $truncate_at=null How many chars to display.
 * @param string $truncate_char='&hellip;' The truncating char.
 * @return void
 */
if( ! function_exists( 'thb_the_excerpt' ) ) {
	function thb_the_excerpt( $post, $truncate_at=null, $truncate_char='&hellip;' ) {
		echo apply_filters('the_excerpt', thb_get_the_excerpt($post, $truncate_at, $truncate_char));
	}
}

/**
 * Gets the excerpt of the current post in the loop.
 *
 * @param WP_Post $post The post object.
 * @param int $truncate_at=null How many chars to display.
 * @param string $truncate_char='&hellip;' The truncating char.
 * @return string
 */
if( ! function_exists( 'thb_get_the_excerpt' ) ) {
	function thb_get_the_excerpt( $post, $truncate_at=null, $truncate_char='&hellip;' ) {
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

/**
 * Get the theme defined post types, in a selectable format.
 *
 * @return array
 */
if( !function_exists('thb_get_post_types_for_select') ) {
	function thb_get_post_types_for_select() {
		$thb_theme = thb_theme();

		$post_types = array();
		foreach( $thb_theme->getPostTypes() as $post_type ) {
			$post_types[$post_type->getType()] = $post_type->getName();
		}

		return $post_types;
	}
}

/**
 * Check if a list of related posts must be displayed.
 *
 * @param string $post_type The (optional) post type.
 * @return boolean
 */
if( !function_exists('thb_show_related') ) {
	function thb_show_related( $post_type=null ) {
		if( !$post_type ) {
			global $post;
			$post_type = $post->post_type;
		}

		$id = thb_get_page_ID();

		$show = thb_get_post_meta($id, $post_type . '_related');
		return $show == '1';
	}
}

/**
 * Display a list of posts related to the current one.
 *
 * @param string $post_type The (optional) post type.
 * @return void
 */
if( !function_exists('thb_related') ) {
	function thb_related( $post_type=null ) {
		$id = thb_get_page_ID();

		if( !$post_type ) {
			global $post;
			$post_type = $post->post_type;
		}

		$show = thb_get_post_meta($id, $post_type . '_related');
		if( $show != '1' ) {
			return;
		}

		$shortcode_id = $post_type;
		if( $post_type == 'post' ) {
			$shortcode_id .= 's';
		}

		$shortcode = '[thb_related_' . $shortcode_id . ' title=""';

		$num = thb_get_post_meta($id, $post_type . '_related_number');
		$thumb = thb_get_post_meta($id, $post_type . '_related_thumb');

		if( $num != '' ) {
			$shortcode .= ' num="' . $num . '"';
		}

		if( $thumb != '' ) {
			$shortcode .= ' thumb="' . $thumb . '"';
		}

		$shortcode .= ']';

		echo thb_do_shortcode( $shortcode );
	}
}

/**
 * Get posts from a specific post type, in a selectable format.
 *
 * @param string $post_type The post type.
 * @return array
 */
if( !function_exists('thb_get_posts_for_select') ) {
	function thb_get_posts_for_select( $post_type='post' ) {
		$items = get_posts(array(
			'paged' => 1,
			'posts_per_page' => -1,
			'post_type' => $post_type
		));

		$options = array();
		$options[0] = '--';

		if( count($items > 0) ) {
			foreach( $items as $item ) {
				$options[$item->ID] = apply_filters( 'the_title', $item->post_title );
			}
		}

		return $options;
	}
}

/**
 * Return a list of the public hierarchical taxonomies defined for a given
 * post type.
 *
 * @param string $post_type The post type name.
 * @return array
 */
if( !function_exists('thb_get_post_type_taxonomies') ) {
	function thb_get_post_type_taxonomies( $post_type ) {
		$taxonomies = get_taxonomies(array(
			'object_type' => array($post_type),
			'public' => 1,
			'hierarchical' => 1
		), 'objects');

		return array_keys($taxonomies);
	}
}

/**
 * Return a set of loop parameter that pick up entries related to the one
 * currently displayed.
 *
 * @return array
 */
if( !function_exists('thb_related_posts_query') ) {
	function thb_related_posts_query() {
		$post_id = thb_get_page_ID();

		$post = get_post($post_id);
		$taxonomies = get_taxonomies(
			array(
				'object_type' => array($post->post_type)
			)
		);

		$args['post__not_in'] = array($post_id);
		$args['post_type'] = $post->post_type;

		$tax_query = array();
		$tax_query['relation'] = 'OR';
		foreach($taxonomies as $key => $name) {
			$terms = wp_get_post_terms($post_id, $key, array('fields' => 'ids'));
			if(!empty($terms)) {
				$tax_query[] = array(
					'taxonomy' => $key,
					'field' => 'id',
					'terms' => $terms,
					'operator' => 'IN'
				);
			}
		}

		$args['tax_query'] = $tax_query;

		return $args;
	}
}

/**
 * Post formats
 * -----------------------------------------------------------------------------
 */

/**
 * Image
 */

if( !function_exists('thb_get_post_format_image_src') ) {
	/**
	 * Get the post format image source code or image URL.
	 *
	 * @param String $size The image size
	 * @return Mixed An array with two keys 'full' and 'scaled', or an HTML string.
	 */
	function thb_get_post_format_image_src( $size='large' ) {
		$post_id = get_the_ID();

		$image = '';
		$src = array(
			'full' => '',
			'scaled' => ''
		);


		// if( thb_is_wordpress_version_before(3.6) ) {
			// Legacy

			$src['full'] = thb_get_featured_image($post_id, 'full');
			$src['scaled'] = thb_get_featured_image($post_id, $size);
		// }
		// else {
		// 	// WP 3.6+

		// 	$image = get_post_meta($post_id, '_format_image', true);

		// 	if( thb_text_startsWith($image, 'http') ) {
		// 		// URL
		// 		$attachment_id = thb_image_get_attachment_id($image);

		// 		if( $attachment_id ) {
		// 			// Image from media library
		// 			$src['full'] = $image;
		// 			$src['scaled'] = thb_image_get_size($attachment_id, $size);
		// 		}
		// 		else {
		// 			// Image from somewhere else
		// 			$src['full'] = $image;
		// 			$src['scaled'] = $image;
		// 		}
		// 	}
		// 	else {
		// 		return $image;
		// 	}
		// }

		return $src;
	}
}

if( !function_exists('thb_post_format_image_markup') ) {
	function thb_post_format_image_markup( $image, $config=array() ) {
		$config = thb_array_asum(array(
			'link' 			=> true,
			'link_class'    => 'item-thumb',
			'overlay'       => true,
			'overlay_class' => 'thb-overlay',
			'overlay_icon'  => '',
			'image_class'   => ''
		), $config);

		if( $image['full'] == '' ) {
			return;
		}

		extract($config);

		if( $link ) {
			$link_url = $image['full'];
			// if( get_post_meta(get_the_ID(), '_format_url', true) != '' ) {
			// 	$link_url = get_post_meta(get_the_ID(), '_format_url', true);
			// }

			echo sprintf( '<a href="%s" class="%s">', esc_url($link_url), $link_class );
		}

			if( $overlay ) {
				echo sprintf( '<span class="%s" %s></span>', $overlay_class, $overlay_icon != '' ? 'data-icon="' . $overlay_icon . '"' : '' );
			}

			echo sprintf( '<img src="%s" class="%s" alt="" />', esc_url($image['scaled']), $image_class );

		if( $link ) {
			echo "</a>";
		}
	}
}

if( !function_exists('thb_post_format_image') ) {
	function thb_post_format_image( $config=array() ) {
		$config = thb_array_asum(array(
			'size' => 'large'
		), $config);

		$image = thb_get_post_format_image_src($config['size']);

		// if( is_array($image) ) {
			if( ! empty($image['scaled']) ) {
				thb_post_format_image_markup($image, $config);
			}
		// }
		// else {
		// 	$pattern = '/<img src="([^\"]+)"(.*)class="wp-image-(.*)/i';
		// 	preg_match_all($pattern, $image, $matches, PREG_OFFSET_CAPTURE);

		// 	if( isset($matches[1]) && !empty($matches[1]) ) {
		// 		$parsed_img = $matches[1][0][0];
		// 		$attachment_id = thb_image_get_attachment_id($parsed_img);

		// 		thb_post_format_image_markup(array(
		// 			'full' => $parsed_img,
		// 			'scaled' => thb_image_get_size($attachment_id, $config['size'])
		// 		), $config);
		// 	}
		// 	else {
		// 		echo do_shortcode($image);
		// 	}
		// }
	}
}

/**
 * Gallery
 */

if( !function_exists('thb_post_format_gallery') ) {
	function thb_post_format_gallery( $config=array() ) {
		$config = thb_array_asum(array(
			'size' => 'large',
			'id'   => 'gallery-stream',
			'link' => 'file'
		), $config);

		echo do_shortcode( sprintf('[thb_gallery %s]', thb_get_attributes($config)) );
	}
}

/**
 * Link
 */

if( !function_exists('thb_get_post_format_link_url') ) {
	function thb_get_post_format_link_url() {
		// if( thb_is_wordpress_version_before(3.6) ) {
			$link_url = thb_get_post_meta( get_the_ID(), 'link_url' );
		// }
		// else {
			// $link_url = get_post_meta( get_the_ID(), '_format_link_url', true );
		// }

		return $link_url;
	}
}

/**
 * Quote
 */

if( !function_exists('thb_get_post_format_quote_text') ) {
	function thb_get_post_format_quote_text(  ) {
		// if( thb_is_wordpress_version_before(3.6) ) {
			return thb_get_post_meta( get_the_ID(), 'quote' );
		// }
		// else {
			// return get_the_content();
		// }
	}
}

if( !function_exists('thb_get_post_format_quote_url') ) {
	function thb_get_post_format_quote_url() {
		// if( thb_is_wordpress_version_before(3.6) ) {
			return thb_get_post_meta( get_the_ID(), 'quote_url' );
		// }
		// else {
			// return get_post_meta( get_the_ID(), '_format_quote_source_url', true );
		// }
	}
}

if( !function_exists('thb_get_post_format_quote_author') ) {
	function thb_get_post_format_quote_author() {
		// if( thb_is_wordpress_version_before(3.6) ) {
			return thb_get_post_meta( get_the_ID(), 'quote_author' );
		// }
		// else {
			// return get_post_meta( get_the_ID(), '_format_quote_source_name', true );
		// }
	}
}

/**
 * Audio
 */

if( !function_exists('thb_get_post_format_audio_url') ) {
	function thb_get_post_format_audio_url() {
		return thb_get_post_meta( get_the_ID(), 'audio_url' );
	}
}

if( !function_exists('thb_post_format_audio') ) {
	function thb_post_format_audio( $config=array() ) {
		$config = thb_array_asum(array(

		), $config);

		$audio_url = thb_get_post_format_audio_url();

		if( !empty($audio_url) ) {
			echo do_shortcode('[thb_audio src="'. $audio_url .'"]');
		}
	}
}

/**
 * Video
 */

if( !function_exists('thb_get_post_format_video_url') ) {
	function thb_get_post_format_video_url() {
		return thb_get_post_meta( get_the_ID(), 'video_url' );
	}
}

if( !function_exists('thb_post_format_video') ) {
	function thb_post_format_video( $config=array() ) {
		$config = thb_array_asum(array(

		), $config);

		$video_url = thb_get_post_format_video_url();

		if( !empty($video_url) ) {
			echo do_shortcode('[thb_video url="'. $video_url .'"]');
		}
	}
}