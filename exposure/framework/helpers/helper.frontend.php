<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Frontend helpers.
 *
 * This file contains frontend-related utility functions.
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

if( !function_exists('thb_page_before') ) { function thb_page_before() { do_action('thb_page_before'); } }
if( !function_exists('thb_page_after') ) { function thb_page_after() { do_action('thb_page_after'); } }
if( !function_exists('thb_page_start') ) { function thb_page_start() { do_action('thb_page_start'); } }
if( !function_exists('thb_page_end') ) { function thb_page_end() { do_action('thb_page_end'); } }

if( !function_exists('thb_comments_before') ) { function thb_comments_before() { do_action('thb_comments_before'); } }
if( !function_exists('thb_comments_after') ) { function thb_comments_after() { do_action('thb_comments_after'); } }

if( !function_exists('thb_sidebar_before') ) { function thb_sidebar_before() { do_action('thb_sidebar_before'); } }
if( !function_exists('thb_sidebar_after') ) { function thb_sidebar_after() { do_action('thb_sidebar_after'); } }
if( !function_exists('thb_sidebar_start') ) { function thb_sidebar_start() { do_action('thb_sidebar_start'); } }
if( !function_exists('thb_sidebar_end') ) { function thb_sidebar_end() { do_action('thb_sidebar_end'); } }

/**
 * Theme default stylesheet
 */
if( !function_exists('thb_style') ) {
	function thb_style() {
		thb_theme()->getFrontend()->addStyle( get_stylesheet_uri() );
	}

	add_action( 'after_setup_theme', 'thb_style' );
}

if( !function_exists('thb_html_class') ) {
	/**
	 * Prints a series of classes in the HTML tag.
	 *
	 * @return void
	 */
	function thb_html_class() {
		$classes = apply_filters('thb_html_class', array());

		if( !empty($classes) ) {
			echo 'class="' . esc_attr(implode(' ', $classes)) . '"';
		}
	}
}

/**
 * Get a module path.
 *
 * @param string $name The module name.
 * @return string
 */
if( !function_exists('thb_get_module_path') ) {
	function thb_get_module_path( $name ) {
		return THB_THEME_MODULES . '/' . $name;
	}
}

/**
 * Get a module URL.
 *
 * @param string $name The module name.
 * @return string
 */
if( !function_exists('thb_get_module_url') ) {
	function thb_get_module_url( $name ) {
		return THB_THEME_MODULES_URL . '/' . $name;
	}
}

/**
 * Get the current page ID.
 *
 * @return int
 */
if( !function_exists('thb_get_page_ID') ) {
	function thb_get_page_ID() {
		if( defined( 'THB_THE_ID' ) ) {
			return THB_THE_ID;
		}

		return 0;
	}
}

/**
 * Get contents from a partial template. If we're in a child theme, the
 * function will attempt to look for the resource in the child theme directory
 * first.
 *
 * @param string $path The template path, relative to the theme root.
 * @param array $data The data array to be passed to the template.
 * @return void
 */
if( !function_exists('thb_get_template_part') ) {
	function thb_get_template_part( $path, $data=array() ) {
		$app_path = '/' . $path;

		if( is_child_theme() && file_exists(get_stylesheet_directory() . $app_path . '.' . THB_Template::$extension) ) {
			$path = get_stylesheet_directory() . $app_path;
		}
		else {
			$path = get_template_directory() . $app_path;
		}

		if( file_exists($path . '.' . THB_Template::$extension) ) {
			$template = new THB_Template($path, $data);
			$template->render();
		}
	}
}

if( !function_exists('thb_get_module_template_part') ) {
	function thb_get_module_template_part( $module, $path, $data=array() ) {
		echo thb_return_module_template_part($module, $path, $data);
	}
}

if( !function_exists('thb_return_module_template_part') ) {
	function thb_return_module_template_part( $module, $path, $data=array() ) {
		$regular_path = THB_THEME_MODULES . '/' . $module . '/templates/' . $path;
		$alt_path = THB_THEME_TEMPLATES_DIR . '/modules/' . $module . '/' . $path;

		if( file_exists($alt_path . '.' . THB_Template::$extension) ) {
			$template = new THB_Template($alt_path, $data);
		}
		else {
			$template = new THB_Template($regular_path, $data);
		}

		return $template->render(true);
	}
}

/**
 * Get the code from an embedded video.
 *
 * @param string $url The video url.
 * @return string
 */
if( !function_exists('thb_get_video_code') ) {
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
				$req = wp_remote_get("http://vimeo.com/api/v2/video/{$code}.php");

				if( thb_response_is_ok($req) ) {
					$data = unserialize($req['body']);
					$thumbnail = $data[0][$key];
				}
			}
			elseif( $is_youtube ) {
				$thumbnail = "http://img.youtube.com/vi/{$code}/hqdefault.jpg";
			}
		}
		else {
			return '';
		}

		return $thumbnail;
	}
}

/**
 * Check if we're in a static Blog Index page.
 *
 * @return boolean
 */
if( !function_exists('thb_is_blog') ) {
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
		return is_archive() || is_search() || is_404();
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
 * Check if the current page/post has a non-zero ID.
 *
 * @return boolean
 */
if( !function_exists('thb_is_entry') ) {
	function thb_is_entry() {
		return is_single() && thb_get_page_ID() != 0;
	}
}

/**
 * Numeric pagination.
 * Kudos to Christian “Kriesi” Budschedl
 *
 * @see http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 * @param  string  $pages How many pages (in case of custom loop)
 * @param  integer $range How many links before and after the current page should be displayed
 * @return void
 */
if( !function_exists('thb_numeric_pagination') ) {
	function thb_numeric_pagination($pages = '', $range = 2) {
		$showitems = ($range * 2)+1;

		$paged = 1;
		if( isset($args['paged']) ) {
			$paged = $args['paged'];
		}
		else {
			if (get_query_var('paged'))
				$paged = get_query_var('paged');
			elseif (get_query_var('page'))
				$paged = get_query_var('page');
		}

		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if( !$pages ) {
				$pages = 1;
		 	}
		}

		if(1 != $pages) {
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		}
	}
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

/**
 * Add pagination to the current loop.
 *
 * @param string $class The pagination class name.
 * @return void
 */
if( !function_exists('thb_pagination') ) {
	function thb_pagination( $config=array() ) {
		$show_pagination = true;

		$base_config = array(
			'type'              => 'numbers',
			'class'             => '',
			'id'                => '',
			'previousText'      => is_single() ? '%link' : __( 'Previous', 'thb_text_domain' ),
			'nextText'          => is_single() ? '%link' : __( 'Next', 'thb_text_domain' ),
			'previousPostTitle' => '',
			'nextPostTitle'     => '',
			'arrowPreviousText' => '',
			'arrowNextText'     => '',
			'alwaysShowLinks'	=> false
		);

		$base_config = thb_array_asum($base_config, $config);

		$base_config['previousText'] = $base_config['arrowPreviousText'] . $base_config['previousText'];
		$base_config['nextText'] = $base_config['nextText'] . $base_config['arrowNextText'];

		if( $base_config['type'] == 'numbers' ) {
			global $wp_query;
			$show_pagination = $wp_query->max_num_pages > 1;
		}
		else {
			if( is_single() ) {
				$show_pagination = thb_post_has_previous() || thb_post_has_next();
			}
			else {
				$show_pagination = thb_page_has_previous() || thb_page_has_next();
			}
		}

		if( !$show_pagination ) {
			return;
		}

		$pagination_template = new THB_TemplateLoader('frontend/components/pagination', $base_config);
		$pagination_template->render();
	}
}

/**
 * Checks if the current post has a previous one.
 *
 * @return boolean
 **/
if( !function_exists('thb_post_has_previous') ) {
	function thb_post_has_previous() {
		global $post;

		$thb_content = '';
		ob_start();
		previous_post_link('%link');
		$thb_content = ob_get_contents();
		ob_end_clean();

		return !empty($thb_content);
	}
}

/**
 * Checks if the current post has a next one.
 *
 * @return boolean
 **/
if( !function_exists('thb_post_has_next') ) {
	function thb_post_has_next() {
		global $post;

		$thb_content = '';
		ob_start();
		next_post_link('%link');
		$thb_content = ob_get_contents();
		ob_end_clean();

		return !empty($thb_content);
	}
}

/**
 * Checks if the current page has a previous one.
 *
 * @return boolean
 **/
if( !function_exists('thb_page_has_previous') ) {
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

/**
 * Checks if the current page has a next one.
 *
 * @return boolean
 **/
if( !function_exists('thb_page_has_next') ) {
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

/**
 * Create a list of options from a multi-dimensioned array.
 *
 * @param array $options The options array.
 * @param string $value The selected value.
 * @return array
 */
if( !function_exists('thb_get_options_from_array') ) {
	function thb_get_options_from_array( $options, $value=null ) {
		$opts = "";
		foreach($options as $k => $v) {
			$selected = isset($value) && $value == $k ? "selected" : "";
			$opts .= "<option value='$k' $selected>$v</option>";
		}
		return $opts;
	}
}

/**
 * Create a structured list of options from a multi-dimensioned array.
 *
 * @param array $input The options array.
 * @param string $value The selected value.
 * @return array
 */
if( !function_exists('thb_get_structured_options_from_array') ) {
	function thb_get_structured_options_from_array( $input, $value ) {
		$opts = "";

		foreach( $input as $optgroup => $options ) {
			$opts .= "<optgroup label='$optgroup'>";
				$opts .= thb_get_options_from_array($options);
			$opts .= "</optgroup>";
		}

		return $opts;
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

/**
 * Get all of the available fonts.
 *
 * @param string $font The font to look for, to return its family data.
 * @return array
 */
if( !function_exists('thb_get_fonts') ) {
	function thb_get_fonts( $font=null ) {
		$google_fonts = thb_get_googlefonts();
		$custom_fonts = thb_get_customfonts();

		$fonts = $google_fonts;
		if( !empty($custom_fonts) ) {
			$fonts[__('Uploaded', 'thb_text_domain')] = $custom_fonts;
		}

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

/**
 * Return a list of available fonts from Google Webfonts.
 *
 * @return array
 */
if( !function_exists('thb_get_googlefonts') ) {
	function thb_get_googlefonts() {
		return include THB_RESOURCES_DIR . '/admin/googlefonts.php';
	}
}

/**
 * Return a list of custom uploaded fonts.
 *
 * @return array
 */
if( !function_exists('thb_get_customfonts') ) {
	function thb_get_customfonts() {
		$custom_fonts = array();

		$fonts = thb_duplicable_get('custom_font');
		if( !empty($fonts) ) {
			foreach( $fonts as $cfont ) {
				$custom_fonts[$cfont['value']['css']] = array(
					'family' => $cfont['value']['family'],
					'variants' => $cfont['value']['variants'],
					'type' => 'custom',
					'folder' => $cfont['value']['folder']
				);
			}
		}

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
		$ie_template = new THB_TemplateLoader('frontend/components/ie', array(
			'support' => $support
		));
		$ie_template->render();
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

if( !function_exists('thb_video_is_youtube') ) {
	/**
	 * Check if the video is a YouTube embed.
	 *
	 * @param string $url The video URL.
	 * @return boolean
	 */
	function thb_video_is_youtube( $url ) {
		return strpos($url, 'youtu') !== false;
	}
}

if( !function_exists('thb_video_is_vimeo') ) {
	/**
	 * Check if the video is a Vimeo embed.
	 *
	 * @param string $url The video URL.
	 * @return boolean
	 */
	function thb_video_is_vimeo( $url ) {
		return strpos($url, 'vimeo') !== false;
	}
}

if( !function_exists('thb_video_is_selfhosted') ) {
	/**
	 * Check if the video is self hosted.
	 *
	 * @param string $url The video URL.
	 * @return boolean
	 */
	function thb_video_is_selfhosted( $url ) {
		return !thb_video_is_youtube($url) && !thb_video_is_vimeo($url);
	}
}

/**
 * Upload a font face kit from Font Squirrel.
 *
 * @return void
 */
if( !function_exists('thb_upload_custom_fonts') ) {
	function thb_upload_custom_fonts() {
		$key = 'custom_font';
		$upload_dir = wp_upload_dir();
		$basedir = $upload_dir['basedir'];

		if( !empty($_POST) ) {
			thb_duplicable_remove( $key, 0 );
		}

		if( !empty($_FILES) && isset($_FILES[$key]) ) {
			add_filter( 'upload_mimes', 'thb_custom_font_upload_mimes' );

			$count = count($_FILES[$key]['name']);

			for( $i=0; $i<$count; $i++ ) {
				$uploaded_file = array(
					'name'     => $_FILES[$key]['name'][$i],
					'type'     => $_FILES[$key]['type'][$i],
					'tmp_name' => $_FILES[$key]['tmp_name'][$i],
					'error'    => $_FILES[$key]['error'][$i],
					'size'     => $_FILES[$key]['size'][$i]
				);

				if( $uploaded_file['name'] != '' ) {
					$file = thb_upload($uploaded_file);

					if( file_exists($file['file']['file']) ) {
						$archive_name = str_replace('-fontfacekit.zip', '', basename($uploaded_file['name']));

						// if( !file_exists($basedir . '/fonts/' . $archive_name . '/stylesheet.css') ) {
							thb_unzip($file['file']['file'], $basedir . '/fonts/' . $archive_name . '/');
							unlink($file['file']['file']);

							$stylesheet = @file_get_contents($basedir . '/fonts/' . $archive_name . '/stylesheet.css');
							preg_match_all( '|font-family:(.*)$|mi', $stylesheet, $families );
							preg_match_all( '|font-weight:(.*)$|mi', $stylesheet, $weights );
							preg_match_all( '|font-style:(.*)$|mi', $stylesheet, $styles );

							if( isset($families[1]) && !empty($families[1]) ) {
								$k=0;
								foreach( $families[1] as $family ) {
									$family = trim($family);
									$family = str_replace("'", "", $family);
									$family = str_replace(";", "", $family);

									// $_POST[$key]['css'][] = $family;
									// $_POST[$key]['folder'][] =$archive_name;

									$_POST[$key]['family'][] = $family;
									$_POST[$key]['css'][] = $family;
									$_POST[$key]['folder'][] = $archive_name;

									$var = array();
									if( isset($weights[1]) && !empty($weights[1]) && isset($styles[1]) && !empty($styles[1]) ) {
										// for( $j=0; $j<count($weights[1]); $j++ ) {
											$w = $weights[1][$k];
											$s = $styles[1][$k];

											$w = trim($w);
											$w = str_replace("'", "", $w);
											$w = str_replace(";", "", $w);

											$s = trim($s);
											$s = str_replace("'", "", $s);
											$s = str_replace(";", "", $s);

											$v = $w . $s;

											if( $v == 'normalnormal' ) {
												$v = 'normal';
											}

											$var[] = $v;
										// }
									}

									$_POST[$key]['variants'][] = $var;
									$k++;
								}
							}
						// }
					}
				}
			}
		}

		if( !empty($_POST) && isset($_POST[$key]) ) {

			$post_count = count($_POST[$key]['css']);
			$font = $_POST[$key];

			for( $i=0; $i<$post_count; $i++ ) {
				$meta = array(
					'subtemplate' => ''
				);

				if( !empty($_POST['uniqid'][$i]) ) {
					$meta['uniqid'] = $_POST['uniqid'][$i];
				}
				else {
					$meta['uniqid'] = md5(time() . $i);
				}

				$family = $_POST[$key]['family'][$i]; //$family_name . ': ' . implode(', ', $font['variants'][$i]);

				thb_duplicable_add($key, array(
					'ord'       => $i,
					'value'     => array('family' => $family, 'css' => $font['css'][$i], 'variants' => implode(',', $font['variants'][$i]), 'folder' => $font['folder'][$i]),
					'meta'      => $meta
				));
			}
		}

		if( !empty($_POST) ) {
			$result = thb_system_raise_success( __('All saved!', 'thb_text_domain') );
			thb_system_set_flashdata( $result );
		}
	}
}

if( !function_exists('thb_page_bodyclasses') ) {
	/**
	 * Assign a body class to a specific page.
	 *
	 * @param string $slug The page slug.
	 * @param array $classes_to_remove The classes to be removed in the page.
	 * @param array $classes_to_add The classes to be added in the page.
	 * @return array
	 */
	function thb_page_bodyclasses( $slug, $classes_to_remove, $classes_to_add ) {
		global $thb_child_theme_bodyclasses;
		$page = get_page_by_path($slug);

		if( ! $thb_child_theme_bodyclasses || empty($thb_child_theme_bodyclasses) ) {
			$thb_child_theme_bodyclasses = array();
		}

		$thb_child_theme_bodyclasses[] = array(
			'id' => $page->ID,
			'remove' => $classes_to_remove,
			'add' => $classes_to_add
		);
	}
}

if( !function_exists('thb_child_teme_bodyclasses_filter') ) {
	function thb_child_teme_bodyclasses_filter( $classes ) {
		global $thb_child_theme_bodyclasses;

		$id = thb_get_page_ID();

		if( $thb_child_theme_bodyclasses && !empty($thb_child_theme_bodyclasses) ) {
			foreach( $thb_child_theme_bodyclasses as $bc ) {
				if( $id == $bc['id'] ) {
					if( !empty($bc['remove']) ) {
						thb_array_remove($classes, $bc['remove']);
					}
					$classes[] = $bc['add'];
				}
				else {
					continue;
				}
			}
		}

		return $classes;
	}

	add_filter('body_class', 'thb_child_teme_bodyclasses_filter', 9999);
}