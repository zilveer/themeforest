<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Frontend helpers.
 *
 * This file contains frontend-related utility functions.
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

/**
 * Hooks
 */
if( !function_exists('thb_before_doctype') ) { function thb_before_doctype() { do_action('thb_before_doctype'); } }

if( !function_exists('thb_head_meta') ) { function thb_head_meta() { do_action('thb_head_meta'); } }
if( !function_exists('thb_head') ) { function thb_head() { do_action('thb_head'); } }
add_action('wp_head', 'thb_head', 99999);

if( !function_exists('thb_body_start') ) { function thb_body_start() { do_action('thb_body_start'); } }
if( !function_exists('thb_body_end') ) { function thb_body_end() { do_action('thb_body_end'); } }

if( !function_exists('thb_header_before') ) { function thb_header_before() { do_action('thb_header_before'); } }
if( !function_exists('thb_header_after') ) { function thb_header_after() { do_action('thb_header_after'); } }
if( !function_exists('thb_header_start') ) { function thb_header_start() { do_action('thb_header_start'); } }
if( !function_exists('thb_header_end') ) { function thb_header_end() { do_action('thb_header_end'); } }

if( !function_exists('thb_nav_before') ) { function thb_nav_before() { do_action('thb_nav_before'); } }
if( !function_exists('thb_nav_after') ) { function thb_nav_after() { do_action('thb_nav_after'); } }
if( !function_exists('thb_nav_start') ) { function thb_nav_start() { do_action('thb_nav_start'); } }
if( !function_exists('thb_nav_end') ) { function thb_nav_end() { do_action('thb_nav_end'); } }

if( !function_exists('thb_footer_sidebar_before') ) { function thb_footer_sidebar_before() { do_action('thb_footer_sidebar_before'); } }
if( !function_exists('thb_footer_sidebar_after') ) { function thb_footer_sidebar_after() { do_action('thb_footer_sidebar_after'); } }
if( !function_exists('thb_footer_sidebar_start') ) { function thb_footer_sidebar_start() { do_action('thb_footer_sidebar_start'); } }
if( !function_exists('thb_footer_sidebar_end') ) { function thb_footer_sidebar_end() { do_action('thb_footer_sidebar_end'); } }

if( !function_exists('thb_page_footer_before') ) { function thb_page_footer_before() { do_action('thb_page_footer_before'); } }
if( !function_exists('thb_page_footer_after') ) { function thb_page_footer_after() { do_action('thb_page_footer_after'); } }
if( !function_exists('thb_page_footer_start') ) { function thb_page_footer_start() { do_action('thb_page_footer_start'); } }
if( !function_exists('thb_page_footer_end') ) { function thb_page_footer_end() { do_action('thb_page_footer_end'); } }

if( !function_exists('thb_footer') ) { function thb_footer() { do_action('thb_footer'); } }

if( !function_exists('thb_slideshow_before') ) { function thb_slideshow_before() { do_action('thb_slideshow_before'); } }
if( !function_exists('thb_slideshow_after') ) { function thb_slideshow_after() { do_action('thb_slideshow_after'); } }
if( !function_exists('thb_slideshow_start') ) { function thb_slideshow_start() { do_action('thb_slideshow_start'); } }
if( !function_exists('thb_slideshow_end') ) { function thb_slideshow_end() { do_action('thb_slideshow_end'); } }

if( !function_exists('thb_content_before') ) { function thb_content_before() { do_action('thb_content_before'); } }
if( !function_exists('thb_content_after') ) { function thb_content_after() { do_action('thb_content_after'); } }
if( !function_exists('thb_content_start') ) { function thb_content_start() { do_action('thb_content_start'); } }
if( !function_exists('thb_content_end') ) { function thb_content_end() { do_action('thb_content_end'); } }

if( !function_exists('thb_post_before') ) { function thb_post_before() { do_action('thb_post_before'); } }
if( !function_exists('thb_post_after') ) { function thb_post_after() { do_action('thb_post_after'); } }
if( !function_exists('thb_post_start') ) { function thb_post_start() { do_action('thb_post_start'); } }
if( !function_exists('thb_post_end') ) { function thb_post_end() { do_action('thb_post_end'); } }

if( !function_exists('thb_loop_post_before') ) { function thb_loop_post_before() { do_action('thb_loop_post_before'); } }
if( !function_exists('thb_loop_post_after') ) { function thb_loop_post_after() { do_action('thb_loop_post_after'); } }
if( !function_exists('thb_loop_post_start') ) { function thb_loop_post_start() { do_action('thb_loop_post_start'); } }
if( !function_exists('thb_loop_post_end') ) { function thb_loop_post_end() { do_action('thb_loop_post_end'); } }

if( !function_exists('thb_page_before') ) { function thb_page_before() { do_action('thb_page_before'); } }
if( !function_exists('thb_page_after') ) { function thb_page_after() { do_action('thb_page_after'); } }
if( !function_exists('thb_page_start') ) { function thb_page_start() { do_action('thb_page_start'); } }
if( !function_exists('thb_page_end') ) { function thb_page_end() { do_action('thb_page_end'); } }

if( !function_exists('thb_page_content_start') ) { function thb_page_content_start() { do_action('thb_page_content_start'); } }

if( !function_exists('thb_single_content_start') ) { function thb_single_content_start() { do_action('thb_single_content_start'); } }

if( !function_exists('thb_comments_before') ) { function thb_comments_before() { do_action('thb_comments_before'); } }
if( !function_exists('thb_comments_after') ) { function thb_comments_after() { do_action('thb_comments_after'); } }

if( !function_exists('thb_sidebar_before') ) { function thb_sidebar_before() { do_action('thb_sidebar_before'); } }
if( !function_exists('thb_sidebar_after') ) { function thb_sidebar_after() { do_action('thb_sidebar_after'); } }
if( !function_exists('thb_sidebar_start') ) { function thb_sidebar_start() { do_action('thb_sidebar_start'); } }
if( !function_exists('thb_sidebar_end') ) { function thb_sidebar_end() { do_action('thb_sidebar_end'); } }

if ( ! function_exists( 'thb_check_action_hook_empty' ) ) {
	/**
	 * Check if an action hook as actions associated with it.
	 *
	 * @param string $hook
	 * @return boolean
	 */
	function thb_check_action_hook_empty( $hook ) {
		global $wp_filter;

		return empty( $wp_filter[ $hook ] );
	}
}

if( !function_exists('thb_style') ) {
	/**
	 * Theme default stylesheet
	 */
	function thb_style() {
		thb_theme()->getFrontend()->addStyle( get_stylesheet_uri() );
	}

	add_action( 'after_setup_theme', 'thb_style' );
}

if( !function_exists('thb_html_class') ) {
	/**
	 * Prints a series of classes in the HTML tag.
	 */
	function thb_html_class() {
		$classes = apply_filters('thb_html_class', array());

		if( !empty($classes) ) {
			echo 'class="' . esc_attr(implode(' ', $classes)) . '"';
		}
	}
}

if( !function_exists('thb_get_page_ID') ) {
	/**
	 * Get the current page ID.
	 *
	 * @return int
	 */
	function thb_get_page_ID() {
		$page_id = 0;

		if( defined( 'THB_THE_ID' ) ) {
			$page_id = THB_THE_ID;
		}

		$page_id = apply_filters( 'thb_get_page_ID', $page_id );

		return $page_id;
	}
}

if( !function_exists('thb_get_template_part') ) {
	/**
	 * Get contents from a partial template. If we're in a child theme, the
	 * function will attempt to look for the resource in the child theme directory
	 * first.
	 *
	 * @param string $file The template file.
	 * @param array $data The data array to be passed to the template.
	 * @param boolean $echo True to echo the template part.
	 * @return string
	 */
	function thb_get_template_part( $file, $data = array(), $echo = true ) {
		if( ! thb_text_endsWith( $file, '.' . THB_Template::$extension ) ) {
			$file .= '.' . THB_Template::$extension;
		}

		$path = locate_template( 'templates/' . $file );

		if ( empty( $path ) ) {
			$path = locate_template( $file );
		}

		if( ! empty( $path ) ) {
			$template = new THB_Template( $path, $data );
			$contents = $template->render( true );

			if ( $echo ) {
				echo $contents;
			}

			return $contents;
		}

		return '';
	}
}

if( ! function_exists( 'thb_get_framework_template_part' ) ) {
	/**
	 * Get contents from a partial template located in the framework.
	 *
	 * Looks for:
	 * - templates/framework/templates/admin/$file
	 * - framework/templates/admin/$file
	 *
	 * @param string $file The template file.
	 * @param array $data The data array to be passed to the template.
	 * @param boolean $echo True to echo the template part.
	 * @return string
	 */
	function thb_get_framework_template_part( $file, $data = array(), $echo = true ) {
		return thb_get_template_part( THB_FRAMEWORK_DIR_NAME . '/' . THB_TEMPLATES . '/' . $file, $data, $echo );
	}
}

if( ! function_exists( 'thb_get_module_url' ) ) {
	/**
	 * Get the base URL for a module.
	 *
	 * @param string $module The module name.
	 * @return string
	 */
	function thb_get_module_url( $module ) {
		return THB_THEME_MODULES_URL . '/' . $module;
	}
}

if( ! function_exists( 'thb_get_module_path' ) ) {
	/**
	 * Get the base path for a module.
	 *
	 * @param string $module The module name.
	 * @return string
	 */
	function thb_get_module_path( $module ) {
		return THB_THEME_MODULES . '/' . $module;
	}
}

if ( ! function_exists( 'thb_get_module_original_template_path' ) ) {
	/**
	 * Get a subtemplate path from a module.
	 *
	 * @param string $module The module name.
	 * @param string $name The template name.
	 * @return string
	 */
	function thb_get_module_original_template_path( $module, $name ) {
		$name .= '.php';
		$dir = trailingslashit( thb_get_module_path( $module ) );
		$module = trailingslashit( $module );

		$path = $dir . 'templates/' . $name;

		return $path;
	}
}

if ( ! function_exists( 'thb_get_module_template_path' ) ) {
	/**
	 * Get a subtemplate path from a module. Looks first in the theme templates
	 * folder, then in module template path.
	 *
	 * @param string $module The module name.
	 * @param string $name The template name.
	 * @return string
	 */
	function thb_get_module_template_path( $module, $name ) {
		$name .= '.php';
		$dir = trailingslashit( thb_get_module_path( $module ) );
		$module = trailingslashit( $module );

		// Attempt to load templates from parent/child theme
		$path = locate_template( 'templates/' . $module . $name );

		if( empty( $path ) ) {
			// Fallback on the template located in the module
			$path = $dir . 'templates/' . $name;
		}

		return $path;
	}
}

if ( ! function_exists( 'thb_get_module_template_part' ) ) {
	/**
	 * Get a subtemplate from a module. Looks first in the theme templates
	 * folder, then in module template path.
	 *
	 * @param string $module The module name.
	 * @param string $name The template name.
	 * @param array $data The template data.
	 * @param boolean $echo True to echo the template.
	 */
	function thb_get_module_template_part( $module, $name, $data = array(), $echo = true ) {
		$path = thb_get_module_template_path( $module, $name );

		$template = new THB_Template( $path, $data );
		$contents = $template->render( true );

		if ( $echo == false ) {
			return $contents;
		}
		else {
			echo $contents;
		}
	}
}

if( !function_exists('thb_get_subtemplate') ) {
	/**
	 * Get a subtemplate from a module/plugin. Looks first in the theme templates
	 * folder, then in module/plugin template path.
	 *
	 * @param string $key The module/plugin key.
	 * @param string $dir The module/plugin base directory.
	 * @param string $name The template name.
	 * @param  array  $data The template data.
	 */
	function thb_get_subtemplate( $key, $dir, $name, $data=array() ) {
		$name .= '.php';
		$key = trailingslashit($key);
		$dir = trailingslashit($dir);

		// Attempt to load templates from parent/child theme
		$path = locate_template( 'templates/' . $key . $name);

		if( empty($path) ) {
			// Fallback on the template located in the plugin
			$path = $dir . 'templates/' . $name;
		}

		if( file_exists($path) ) {
			extract($data);
			include $path;
		}
	}
}

if( !function_exists('thb_get_video_code') ) {
	/**
	 * Get the code from an embedded video.
	 *
	 * @param string $url The video url.
	 * @return string
	 */
	function thb_get_video_code( $url ) {
		$tokens = parse_url($url);
		$code = '';
		if(isset($tokens['query'])) {
			$params = thb_parse_querystring($tokens['query']);
			if(isset($params['v']))
				$code = $params['v'];
		} else {
			$code = trim($tokens['path'], "/");
		}

		return $code;
	}
}

/**
 * Get the thumbnail from an embedded video.
 *
 * @param string $url The video url.
 * @param string $key The key of the video's thumbnail.
 * @return string
 */
if( !function_exists('thb_get_video_thumbnail') ) {
	function thb_get_video_thumbnail( $url, $key='' ) {
		$thumbnail = '';
		$is_youtube = strpos($url, 'youtu') !== false;
		$is_vimeo = strpos($url, 'vimeo') !== false;

		if( $is_youtube || $is_vimeo ) {
			$code = thb_get_video_code($url);

			if( $is_vimeo ) {
				$response = wp_remote_get("http://vimeo.com/api/v2/video/{$code}.php");

				if( wp_remote_retrieve_response_code( $response ) == '200' ) {
					$data = unserialize( wp_remote_retrieve_body( $response ) );
					$thumbnail = $data[0][$key];
					$thumbnail = str_replace( 'http:', '', $thumbnail );
					$thumbnail = str_replace( 'https:', '', $thumbnail );
				}
			}
			elseif( $is_youtube ) {
				// $thumbnail = "//img.youtube.com/vi/{$code}/maxresdefault.jpg";
				$thumbnail = "//img.youtube.com/vi/{$code}/hqdefault.jpg";
			}
		}
		else {
			return '';
		}

		return $thumbnail;
	}
}

if( !function_exists('thb_is_blog') ) {
	/**
	 * Check if we're in a static Blog Index page.
	 *
	 * @return boolean
	 */
	function thb_is_blog() {
		global $post;
		$posttype = get_post_type($post);
		return ( is_archive() || is_home() ) && ( $posttype == 'post') ? true : false ;
	}
}

/**
 * Check if the current screen displays an archive page (archive, search or 404).
 *
 * @return boolean
 */
if( ! function_exists('thb_is_archive') ) {
	function thb_is_archive() {
		$results = is_archive() || is_search() || is_404();

		return apply_filters( 'thb_is_archive', $results );
	}
}

/**
 * Define the current page ID.
 *
 * @return void
 */
if( !function_exists('thb_header_define_page_ID') ) {
	function thb_header_define_page_ID() {
		global $post;

		$is_archive = thb_is_archive() || thb_is_blog();
		$is_dynamic_home = is_front_page() && get_option('show_on_front') == 'posts';

		if( $is_archive || $is_dynamic_home ) {
			$page_id = 0;
		}
		else {
			$page_id = get_the_ID();
		}

		thb_define( 'THB_THE_ID', $page_id );
	}

	add_action( 'template_redirect', 'thb_header_define_page_ID', 9999 );
}

/**
 * Check if pagination should be displayed for the current post type.
 *
 * @param string $post_type The post type.
 * @return boolean
 */
if( !function_exists('thb_show_pagination') ) {
	function thb_show_pagination( $post_type=null ) {
		if( !$post_type ) {
			global $post;
			$post_type = $post->post_type;
		}

		return thb_get_option($post_type . '_navigation') == 1;
	}
}

if( ! function_exists('thb_numeric_pagination') ) {
	/**
	 * Add numeric pagination to the current loop.
	 *
	 * @param array $config The pagination configuration array.
	 */
	function thb_numeric_pagination( $config=array() ) {
		global $wp_query;

		$args = wp_parse_args( $config, array(
			'range' => 2
		) );

		$showitems = ($args['range'] * 2) + 1;
		$paged = 1;

		// Getting pagination right
		if( isset($args['paged']) ) {
			$paged = $args['paged'];
		}
		else {
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			}
		}

		// Number of pages from the query
		$pages = $wp_query->max_num_pages ? $wp_query->max_num_pages : 1;

		// Link back to the first page
		$show_first = ($paged > 2) && ($paged > $args['range']+1) && ($showitems < $pages);

		// Link to the last page
		$show_last = ($paged < $pages-1) && ($paged+$args['range']-1) < $pages && ($showitems < $pages);

		// Link to the next page
		$show_next = ($paged > 1) && ($showitems < $pages);

		// Link to the previous page
		$show_prev = ($paged < $pages) && ($showitems < $pages);

		if ( $pages != 1 ) {
			thb_get_template_part( 'framework/templates/frontend/components/numeric_pagination', array(
				'show_first'    => $show_first,
				'show_next'     => $show_next,
				'show_prev'     => $show_prev,
				'show_last'     => $show_last,
				'pages'         => $pages,
				'range'         => $args['range'],
				'paged'         => $paged,
				'showitems'     => $showitems,
				'link'          => '<li><a href="%s">%s</a></li>',
				'current_link'  => '<li><span class="current">%s</span></li>',
				'inactive_link' => '<li><a href="%s" class="inactive">%s</a></li>'
			) );
		}
	}
}

if( ! function_exists('thb_pagination') ) {
	/**
	 * Add backward/forward pagination to the current loop.
	 *
	 * @param array $config The pagination configuration array.
	 */
	function thb_pagination( $config=array() ) {
		$args = wp_parse_args( $config, array(
			'single_prev'          => '%title',
			'single_next'          => '%title',
			'single_prev_template' => false,
			'single_next_template' => false,
			'in_same_cat'          => false,
			'single_format'        => '%link',
			'page_prev'            => __( 'Previous', 'thb_text_domain' ),
			'page_next'            => __( 'Next', 'thb_text_domain' ),
			'show_always'          => false,
			'excluded_cats'		   => ''
		) );

		$show_pagination = true;

		if ( is_single() ) {
			$show_pagination = thb_post_has_previous( $args['in_same_cat'], $args['excluded_cats'] ) || thb_post_has_next( $args['in_same_cat'], $args['excluded_cats'] );
		}
		else {
			$show_pagination = thb_page_has_previous() || thb_page_has_next();
		}

		if ( ! $show_pagination ) {
			return;
		}

		thb_get_template_part( 'framework/templates/frontend/components/pagination', $args );
	}
}

if( !function_exists('thb_post_has_previous') ) {
	/**
	 * Checks if the current post has a previous one.
	 *
	 * @param boolean $in_same_cat
	 * @param string $excluded_cats
	 * @return boolean
	 **/
	function thb_post_has_previous( $in_same_cat = false, $excluded_cats = '' ) {
		global $post;

		return get_previous_post( $in_same_cat, $excluded_cats ) != false;
	}
}

if( !function_exists('thb_post_has_next') ) {
	/**
	 * Checks if the current post has a next one.
	 *
	 * @param boolean $in_same_cat
	 * @param string $excluded_cats
	 * @return boolean
	 **/
	function thb_post_has_next( $in_same_cat = false, $excluded_cats = '' ) {
		global $post;

		return get_next_post( $in_same_cat, $excluded_cats ) != false;
	}
}

if( !function_exists('thb_page_has_previous') ) {
	/**
	 * Checks if the current page has a previous one.
	 *
	 * @return boolean
	 **/
	function thb_page_has_previous() {
		global $wp_query;
		global $paged;
		$paged = $wp_query->query_vars['paged'];

		$thb_content = '';
		ob_start();
		previous_posts_link('%link');
		$thb_content = ob_get_contents();
		ob_end_clean();

		return !empty($thb_content);
	}
}

if( !function_exists('thb_page_has_next') ) {
	/**
	 * Checks if the current page has a next one.
	 *
	 * @return boolean
	 **/
	function thb_page_has_next() {
		global $wp_query;
		global $paged;
		$paged = $wp_query->query_vars['paged'];

		$thb_content = '';
		ob_start();
		next_posts_link('%link');
		$thb_content = ob_get_contents();
		ob_end_clean();

		return !empty($thb_content);
	}
}

if( !function_exists('thb_get_googlefont') ) {
	function thb_get_googlefont( $font ) {
		$fontArray = thb_get_googlefonts();
		foreach( $fontArray as $style => $fonts ) {
			foreach( $fonts as $css => $family ) {
				if( $css == $font ) {
					return $family;
				}
			}
		}

		return array();
	}
}

if( ! function_exists( 'thb_input_select_fonts' ) ) {
	/**
	 * Display a select element with the available fonts.
	 *
	 * @param string $name The select name.
	 * @param string $value The select value.
	 * @param array $attrs The select attributes.
	 */
	function thb_input_select_fonts( $name, $value = '', $attrs = array() ) {
		$fonts = array();

		foreach ( thb_get_fonts() as $type => $fn ) {
			$fonts[$type] = wp_list_pluck( $fn, 'family' );
		}

		thb_input_select( $name, $fonts, $value, $attrs );
	}
}

if( ! function_exists('thb_get_fonts') ) {
	/**
	 * Get all of the available fonts.
	 *
	 * @param string $font The font to look for, to return its family data.
	 * @return array
	 */
	function thb_get_fonts( $font = null ) {
		$google_fonts = thb_get_googlefonts();
		$custom_fonts = thb_get_customfonts();

		$fonts = $google_fonts;
		if( !empty($custom_fonts) ) {
			$fonts['Custom'] = $custom_fonts;
		}

		if ( class_exists( 'Typekit' ) ) {
			// Typekit
			if ( ( $typekit_id = thb_get_option('typekit_id') ) != '' ) {
				$typekit_fonts = thb_cache_get( 'typekit' );

				if ( $typekit_fonts === false ) {
					$typekit = new Typekit();
					$typekit_fonts = thb_cache_set( 'typekit', $typekit->get( $typekit_id ) );
				}

				$fonts['Typekit'] = array();

				if ( isset( $typekit_fonts['kit'] ) ) {
					if ( isset( $typekit_fonts['kit']['families'] ) ) {
						foreach ( $typekit_fonts['kit']['families'] as $family ) {
							$fonts['Typekit'][$family['css_names'][0]] = array(
								'family' => $family['name'],
								'css' => $family['css_names'][0],
								'variants' => '',
								'type' => 'typekit',
								'folder' => ''
							);
						}
					}
				}
			}
		}

		$fonts[__( 'Other', 'thb_text_domain' )] = array();

		foreach ( thb_duplicable_get( 'googlefont' ) as $gf ) {
			$gfa = thb_parse_googlefont_import_string( $gf['value'] );

			foreach ( $gfa as $gfa_s ) {
				$fonts[__( 'Other', 'thb_text_domain' )][$gfa_s['css']] = array(
					'family'   => $gfa_s['family'],
					'variants' => $gfa_s['variants'],
					'type'     => $gfa_s['type'],
					'subsets'  => $gfa_s['subsets']
				);
			}
		}

		$fonts[__( 'Other', 'thb_text_domain' )]['external'] = array(
			'family'   => __( 'External service', 'thb_text_domain' ),
			'variants' => '',
			'type'     => 'external',
			'folder'   => ''
		);

		if( $font ) {
			foreach( $fonts as $style => $families ) {
				foreach( $families as $css => $data ) {
					if( $css == $font ) {
						return $data;
					}
				}
			}

			return '';
		}
		else {
			return $fonts;
		}
	}
}

if( ! function_exists( 'thb_parse_googlefont_import_string' ) ) {
	/**
	 * Parse a Google Font import string.
	 *
	 * @param string $string
	 * @return array
	 */
	function thb_parse_googlefont_import_string( $string ) {
		$return = array();

		$string = str_replace( '@import url(https://fonts.googleapis.com/css?', '', $string );
		$string = str_replace( '@import url(http://fonts.googleapis.com/css?', '', $string );
		$string = str_replace( ');', '', $string );

		parse_str( $string, $font_data );

		$families = explode( '|', $font_data['family'] );
		$family_subsets = isset( $font_data['subset'] ) ? $font_data['subset'] : 'latin';

		foreach ( $families as $family ) {
			$family = explode( ':', $family );
			$family_css_name = str_replace( ' ', '+', $family[0]);
			$family_nice_name = $family[0];
			$family_variants = isset( $family[1] ) ? $family[1] : 'regular';
			$family_variants = str_replace( '400', 'regular', $family_variants );

			$return[] = array(
				'css'      => $family_css_name,
				'family'   => $family_nice_name,
				'variants' => $family_variants,
				'type'     => 'google',
				'subsets'  => $family_subsets,
			);
		}

		return $return;
	}
}

if( !function_exists('thb_get_googlefonts') ) {
	/**
	 * Return a list of available fonts from Google Webfonts.
	 *
	 * @return array
	 */
	function thb_get_googlefonts() {
		return include THB_RESOURCES_DIR . '/admin/googlefonts.php';
	}
}

if( !function_exists('thb_get_customfonts') ) {
	/**
	 * Return a list of custom uploaded fonts.
	 *
	 * @return array
	 */
	function thb_get_customfonts() {
		$custom_fonts = array();

		$fonts = thb_duplicable_get('custom_font');
		if( !empty($fonts) ) {
			foreach( $fonts as $cfont ) {
				$custom_fonts[$cfont['value']['css']] = array(
					'family'   => $cfont['value']['family'],
					'variants' => $cfont['value']['variants'],
					'type'     => 'custom',
					'folder'   => $cfont['value']['folder'],
					'bundle'   => false
				);
			}
		}

		$custom_fonts = apply_filters( 'thb_get_customfonts', $custom_fonts );

		return $custom_fonts;
	}
}

/**
 * Add support for Internet Explorer.
 *
 * @return void
 */
if( !function_exists('thb_ie') ) {
	function thb_ie( $support=array() ) {
		thb_get_framework_template_part( 'frontend/components/ie', array(
			'support' => $support
		) );
	}
}

/**
 * Output the website title.
 *
 * @param string $sep The separator between the page title and the website name.
 * @param boolean $echo True to echo the title, false to return it.
 * @return string
 */
if( !function_exists('thb_title') ) {
	function thb_title( $sep=' | ', $echo=true ) {
		$title = '';
		$name = get_bloginfo('name');

		if( is_front_page() ) {
			$title = $name;
		}
		elseif( thb_is_blog() ) {
			$title = __('Blog', 'thb_text_domain') . $sep . $name;
		}
		else {
			$title = wp_title('', false) . $sep . $name;
		}

		$title = trim($title);

		if( $echo ) {
			echo $title;
		}
		else {
			return $title;
		}
	}
}

if( ! function_exists( 'thb_audio' ) ) {
	/**
	 * Display a selfhosted or embedded audio.
	 *
	 * @param string $url The audio URL.
	 */
	function thb_audio( $url ) {
		$is_mp3 = thb_text_endsWith( $url, '.mp3' );
		$is_ogg = thb_text_endsWith( $url, '.ogg' );
		$is_wav = thb_text_endsWith( $url, '.wav' );
		$is_self_hosted = $is_mp3 || $is_ogg || $is_wav;

		if ( $is_self_hosted ) {
			$atts = array(
				'src' => $url
			);

			echo do_shortcode('[audio ' . thb_get_attributes($atts) . ']');
		}
		else {
			global $wp_embed;
			echo $wp_embed->run_shortcode('[embed]' . trim($url) . '[/embed]');
		}
	}
}

if( ! function_exists( 'thb_video' ) ) {
	/**
	 * Display a selfhosted or embedded video.
	 *
	 * @param string $url The video URL.
	 */
	function thb_video( $url, $options = array() ) {
		$is_mp4 = thb_text_endsWith( $url, '.mp4' );
		$is_ogv = thb_text_endsWith( $url, '.ogv' );
		$is_mov = thb_text_endsWith( $url, '.mov' );
		$is_webm = thb_text_endsWith( $url, '.webm' );
		$is_self_hosted = $is_mp4 || $is_ogv || $is_mov || $is_webm;

		$options = wp_parse_args( $options, array(
			'ratio_x'     => 16,
			'ratio_y'     => 9,
			'autoplay'    => false,
			'loop'        => false,
			'fill'        => false,
			'y_alignment' => 'middle',
			'holder'      => true
		) );

		extract( $options );

		$holder_data = array(
			'y-alignment' => $y_alignment,
			'fill'        => $fill,
			'ratio-x'     => $ratio_x,
			'ratio-y'     => $ratio_y,
			'autoplay'    => (int) $autoplay,
		);

		if ( $holder ) {
			printf( '<div class="thb-video-holder" %s>', thb_get_data_attributes( $holder_data ) );
		}
			if ( $is_self_hosted ) {
				$atts = array();

				if ( thb_text_contains( ',', $url ) ) {
					$urls = explode( ',', $url );
					array_walk( $urls, 'trim' );

					foreach ( $urls as $url ) {
						$att = '';

						if ( thb_text_endsWith( $url, '.mp4' ) ) {
							$att = 'mp4';
						}
						elseif ( thb_text_endsWith( $url, '.ogv' ) ) {
							$att = 'ogv';
						}
						elseif ( thb_text_endsWith( $url, '.mov' ) ) {
							$att = 'mov';
						}
						elseif ( thb_text_endsWith( $url, '.webm' ) ) {
							$att = 'webm';
						}

						if ( ! empty( $att ) ) {
							$atts[$att] = $url;
						}
					}
				}
				else {
					$atts['src'] = $url;
				}

				if ( $loop ) {
					$atts['loop'] = '1';
				}

				if ( $autoplay ) {
					$atts['autoplay'] = 'On';
				}

				echo do_shortcode('[video ' . thb_get_attributes( $atts ) . ']');
			}
			else {
				$is_youtube = strpos( $url, 'youtu' ) !== false;
				$is_vimeo = strpos( $url, 'vimeo' ) !== false;
				$code = thb_get_video_code( $url );
				$params = '';
				$id = 'player-';

				if ( $is_youtube ) {
					if ( $loop ) {
						$params .= '&loop=1&playlist=' . $code;
					}

					printf( '<iframe allowfullscreen class="thb-video-api thb-video-youtube" id="%s" src="//www.youtube.com/embed/%s?enablejsapi=1&amp;modestbranding&amp;showinfo=0&amp;rel=0%s"></iframe>', $id, $code, $params );
				}
				elseif( $is_vimeo ) {
					if ( $loop ) {
						$params .= '&amp;loop=1';
					}

					printf( '<iframe class="thb-video-api thb-video-vimeo" id="%s" src="//player.vimeo.com/video/%s?player_id=%s&amp;badge=0&amp;byline=0&amp;title=0&amp;color=fff%s"></iframe>', $id, $code, $id, $params );
				}
				else {
					global $wp_embed;
					echo $wp_embed->run_shortcode('[embed]' . trim( $url ) . '[/embed]');
				}
			}
		if ( $holder ) {
			echo '</div>';
		}
	}
}

if( ! function_exists( 'thb_post_meta_body_class' ) ) {
	/**
	 * Return the name for a body class to be added to the <body> tag only when
	 * the corrisponding meta value is not empty, and page template requirements
	 * are met.
	 *
	 * @param string $class
	 * @param string $key
	 * @param array $templates
	 * @return string
	 */
	function thb_post_meta_body_class( $class, $key, $templates = array() ) {
		$value = thb_get_post_meta( thb_get_page_ID(), $key );

		if ( ! empty( $value ) && thb_is_page_template( $templates ) ) {
			return str_replace( '%s', $value, $class );
		}

		return '';
	}
}

if( ! function_exists( 'thb_overlay' ) ) {
	/**
	 * Print an overlay element.
	 *
	 * @param string $overlay_color The overlay color.
	 * @param string $overlay_opacity The overlay opacity.
	 * @param string $overlay_class The overlay class attribute.
	 */
	function thb_overlay( $overlay_color = '', $overlay_opacity = '', $overlay_class = 'thb-overlay' ) {
		$overlay_style = array();

		if ( ! empty( $overlay_color ) ) {
			$overlay_style[] = 'background-color:' . $overlay_color . ';';
		}

		if ( ! empty( $overlay_opacity ) ) {
			$overlay_style[] = '-khtml-opacity:' . $overlay_opacity . ';';
			$overlay_style[] = '-moz-opacity:' . $overlay_opacity . ';';
			$overlay_style[] = 'opacity:' . $overlay_opacity . ';';
		}

		printf( '<span class="%s" style="%s"></span>', $overlay_class, implode( '', $overlay_style ) );
	}
}

if ( ! function_exists( 'thb_icon' ) ) {
	/**
	 * Print an icon element.
	 *
	 * @param string $icon The icon name.
	 * @param string $color
	 */
	function thb_icon( $icon, $color = false ) {
		if ( empty( $icon ) ) {
			return;
		}

		$attrs = array(
			'style' => '',
			'class' => 'thb-icon'
		);

		$attrs['class'] .= ' ' . $icon;

		if ( $color ) {
			$attrs['style'] .= 'color: ' . $color;
		}

		printf( '<i %s></i>', thb_get_attributes( $attrs ) );
	}
}

if ( ! function_exists( 'thb_carousel_nav_arrows' ) ) {
	/**
	 * Display the carousel nav arrows.
	 */
	function thb_carousel_nav_arrows() {
		echo '<div class="owl-buttons"><div class="owl-prev"></div><div class="owl-next"></div></div>';
	}
}

if ( ! function_exists( 'thb_carousel_options' ) ) {
	/**
	 * Add carousel options to a field container.
	 *
	 * @param THB_FieldContainer $container
	 * @param array $hidelist
	 */
	function thb_carousel_options( $container, $hidelist = array() ) {
		if ( ! in_array( 'carousel', $hidelist ) ) {
			$thb_field = new THB_CheckboxField( 'carousel' );
			$thb_field->setLabel( __( 'Show as carousel', 'thb_text_domain' ) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_module', $hidelist ) ) {
			$thb_field = new THB_SelectField( 'carousel_module' );
			$thb_field->setLabel( __( 'Carousel module', 'thb_text_domain' ) );
			$thb_field->setHelp( __( 'Select how many items to show at once.', 'thb_text_domain' ) );
			$thb_field->setOptions( array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_show_nav_arrows', $hidelist ) ) {
			$thb_field = new THB_CheckboxField( 'carousel_show_nav_arrows' );
			$thb_field->setLabel( __( 'Show navigation arrows', 'thb_text_domain' ) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_nav_arrows_position', $hidelist ) ) {
			$thb_field = new THB_SelectField( 'carousel_nav_arrows_position' );
			$thb_field->setLabel( __( 'Navigation arrows position', 'thb_text_domain' ) );
			$thb_field->setOptions( array(
				'bottom' => __( 'Bottom', 'thb_text_domain' ),
				'top' => __( 'Top', 'thb_text_domain' ),
			) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_show_pagination', $hidelist ) ) {
			$thb_field = new THB_CheckboxField( 'carousel_show_pagination' );
			$thb_field->setLabel( __( 'Show pagination', 'thb_text_domain' ) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_show_pagination', $hidelist ) ) {
			$thb_field = new THB_CheckboxField( 'carousel_autoplay' );
			$thb_field->setLabel( __( 'Carousel autoplay', 'thb_text_domain' ) );
			$container->addField( $thb_field );
		}

		if ( ! in_array( 'carousel_show_pagination', $hidelist ) ) {
			$thb_field = new THB_NumberField( 'carousel_transition_time' );
			$thb_field->setLabel( __( 'Carousel transition time', 'thb_text_domain' ) );
			$thb_field->setHelp( __( 'Time between slides when the carousel is in autoplay. Expressed in seconds.', 'thb_text_domain' ) );
			$thb_field->setMin( 0 );
			$thb_field->setStep( 0.5 );
			$container->addField( $thb_field );
		}
	}
}

if ( ! function_exists( 'thb_get_carousel_attributes' ) ) {
	/**
	 * Get the carousel data attributes.
	 *
	 * @param array $values
	 * @return array
	 */
	function thb_get_carousel_attributes( $values ) {
		$values = wp_parse_args( $values, array(
			'carousel_module'              => '1',
			'carousel_show_nav_arrows'     => 0,
			'carousel_nav_arrows_position' => 'bottom',
			'carousel_show_pagination'     => 0,
			'carousel_autoplay'            => 0,
			'carousel_transition_time'     => 3,
		) );

		$attributes = array();
		$attributes['data-carousel-module'] = (int) $values['carousel_module'];
		$attributes['data-carousel-nav-arrows'] = (int) $values['carousel_show_nav_arrows'];
		$attributes['data-carousel-nav-arrows-position'] = $values['carousel_nav_arrows_position'];
		$attributes['data-carousel-pagination'] = (int) $values['carousel_show_pagination'];

		if ( $values['carousel_autoplay'] == '1' ) {
			$attributes['data-carousel-autoplay'] = (int) $values['carousel_transition_time'] * 1000;
		}

		return $attributes;
	}
}

if( ! function_exists('thb_js_start') ) {
	/**
	 * Open a script tag.
	 *
	 * @param string $id The script id tag.
	 */
	function thb_js_start( $id='' ) {
		$id = esc_attr( $id );

		echo '<script type="text/javascript"';
		echo !empty($id) ? ' id="' . $id . '">' : '>';
	}
}

if( ! function_exists('thb_js_end') ) {
	/**
	 * Close a script tag.
	 */
	function thb_js_end() {
		echo '</script>';
	}
}

if( !function_exists('thb_is_menu_empty') ) {
	/**
	 * Check if a given menu location is empty.
	 *
	 * @param string $location
	 * @return boolean
	 */
	function thb_is_menu_empty( $location = false ) {
		$args = array(
			'echo' => false,
			'fallback_cb' => '__return_false'
		);

		if ( $location !== false ) {
			$args['theme_location'] = $location;
		}

		return wp_nav_menu( $args ) === false;
	}
}

if( !function_exists('thb_page_title') ) {
	/**
	 * Print the page title
	 *
	 * @param  string $text the page title
	 * @param  string $class the page title class
	 * @param  string $id the page title id
	 */
	function thb_page_title( $text, $class = 'page-title', $id = '' ) {
		$title_tag = 'h1';
		if ( is_home() || is_front_page() ) {
			$title_tag = 'p';
		}
		$text = esc_html( $text );

		if ( ! empty( $id ) ) {
			$id = "id='" . $id . "'";
		}

		$class = apply_filters( 'thb_page_title_class', $class );

		printf( "<%s class='%s' %s>%s</%s>", $title_tag, esc_attr( $class ), $id, esc_html( $text ), $title_tag );
	}
}