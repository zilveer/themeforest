<?php
/**
 * Ancora Framework: templates and thumbs management
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('ancora_templates_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_templates_theme_setup' );
	function ancora_templates_theme_setup() {

		// Add custom thumb sizes into media manager
		add_filter( 'image_size_names_choose', 'ancora_show_thumb_sizes');
	}
}



/* Templates
-------------------------------------------------------------------------------- */

// Add template (layout name)
// $tpl = array( 
//		'layout' => 'layout_name',
//		'template' => 'template_file_name',		// If empty - use 'layout' name
//		'body_style' => 'required_body_style',	// If not empty - use instead current body_style
//		'need_content' => true|false,			// true - for single posts or if template need prepared full content of the posts, else - false
//		'need_terms' => true|false,				// true - for single posts or if template need prepared terms list (categories, tags, product_cat, etc.), else - false
//		'need_columns' => true|false,			// true - if template need columns wrapper for horizontal direction, else - false
//		'need_isotope' => true|false,			// true - if template need isotope wrapper, else - false
//		'container' => '',						// Additional elements container (if need) for single post and blog streampage. For example: <div class="addit_wrap">%s</div>
//		'container_classes' => '',				// or additional classes for existing elements container
//		'mode'   => 'blog|single|widgets|blogger|internal',
//		'title'  => 'Layout title',
//		'thumb_title'  => 'Thumb title',		// If empty - don't show in the thumbs list (and not add image size)
//		'w'      => width,
//		'h'      => height (null if no crop, but only scale),
//		'h_crop' => cropped height (optional),
//		);
// $tpl = array('layout' => 'excerpt', 'mode' => 'blog', 'title'=>'Excerpt', 'thumb_title'=>'Medium image size', 'w' => 720, 'h' => 460, 'h_crop' => 460);
// $tpl = array('layout' => 'fullpost', 'mode' => 'blog,single', 'title'=>'Fullwidth post', 'thumb_title'=>'Large image', 'w' => 1150, 'h' => null, 'h_crop' => 720);
// $tpl = array('layout' => 'accordion', 'mode' => 'blogger', 'title'=>'Accordion');
if (!function_exists('ancora_add_template')) {
	function ancora_add_template($tpl) {
		global $ANCORA_GLOBALS;
		if (empty($tpl['mode']))						$tpl['mode'] = 'blog';
		if (empty($tpl['template']))					$tpl['template'] = $tpl['layout'];
		if (empty($tpl['need_content']))				$tpl['need_content'] = false;
		if (empty($tpl['need_terms']))					$tpl['need_terms'] = false;
		if (empty($tpl['need_columns']))				$tpl['need_columns'] = false;
		if (empty($tpl['need_isotope']))				$tpl['need_isotope'] = false;
		if (!isset($tpl['h_crop']) && isset($tpl['h']))	$tpl['h_crop'] = $tpl['h'];
		if (!isset($ANCORA_GLOBALS['registered_templates'])) $ANCORA_GLOBALS['registered_templates'] = array();
		$ANCORA_GLOBALS['registered_templates'][$tpl['layout']] = $tpl;
		if (!empty($tpl['thumb_title']))
			ancora_add_thumb_sizes( $tpl );
		else 
			$tpl['thumb_title'] = '';
	}
}

// Return template file name
if (!function_exists('ancora_get_template_name')) {
	function ancora_get_template_name($layout_name) {
		global $ANCORA_GLOBALS;
		return $ANCORA_GLOBALS['registered_templates'][$layout_name]['template'];
	}
}

// Return true, if template required content
if (!function_exists('ancora_get_template_property')) {
	function ancora_get_template_property($layout_name, $what) {
		global $ANCORA_GLOBALS;
		return !empty($ANCORA_GLOBALS['registered_templates'][$layout_name][$what]) ? $ANCORA_GLOBALS['registered_templates'][$layout_name][$what] : '';
	}
}

// Return template output function name
if (!function_exists('ancora_get_template_function_name')) {
	function ancora_get_template_function_name($layout_name) {
		global $ANCORA_GLOBALS;
		return 'ancora_template_'.str_replace(array('-', '.'), '_', $ANCORA_GLOBALS['registered_templates'][$layout_name]['template']).'_output';
	}
}


/* Thumbs
-------------------------------------------------------------------------------- */

// Add image dimensions with layout name
// $sizes = array( 
//		'layout' => 'layout_name',
//		'thumb_title'  => 'Thumb title',
//		'w'      => width,
//		'h'      => height (null if no crop, but only scale),
//		'h_crop' => cropped height,
//		);
// $sizes = array('layout' => 'excerpt',  'thumb'=>'Medium image', 'w' => 720, 'h' => 460, 'h_crop' => 460);
// $sizes = array('layout' => 'fullpost', 'thumb'=>'Large image', 'w' => 1150, 'h' => null, 'h_crop' => 720);
if (!function_exists('ancora_add_thumb_sizes')) {
	function ancora_add_thumb_sizes($sizes) {
		global $ANCORA_GLOBALS;
		if (!isset($sizes['h_crop']))		$sizes['h_crop'] =  isset($sizes['h']) ? $sizes['h'] : null;
		//if (empty($sizes['mode']))			$sizes['mode'] = 'blog';
		if (empty($sizes['thumb_title']))	$sizes['thumb_title'] = ancora_strtoproper($sizes['layout']);
		$thumb_slug = ancora_get_slug($sizes['thumb_title']);
		if (empty($ANCORA_GLOBALS['thumb_sizes'][$thumb_slug])) {
			if (empty($ANCORA_GLOBALS['thumb_sizes'])) $ANCORA_GLOBALS['thumb_sizes'] = array();
			$ANCORA_GLOBALS['thumb_sizes'][$thumb_slug] = $sizes;
			add_image_size( $thumb_slug, $sizes['w'], $sizes['h'], $sizes['h']!=null );
			if ($sizes['h']!=$sizes['h_crop']) {
				// Uncomment this lines, if you want create separate entry for the cropped sizes (optional)
				//$sizes['h']=$sizes['h_crop'];
				//$sizes['title'] .= __(' (cropped)', 'ancora');
				//$ANCORA_GLOBALS['thumb_sizes'][$sizes['layout'].'_crop'] = $sizes;
				add_image_size( $thumb_slug.'_crop', $sizes['w'], $sizes['h_crop'], true );
			}
		}
	}
}

// Return image dimensions
if (!function_exists('ancora_get_thumb_sizes')) {
	function ancora_get_thumb_sizes($opt) {
		$opt = array_merge(array(
			'layout' => 'excerpt'
		), $opt);
		global $ANCORA_GLOBALS;
		$thumb_slug = empty($ANCORA_GLOBALS['registered_templates'][$opt['layout']]['thumb_title']) ? '' : ancora_get_slug($ANCORA_GLOBALS['registered_templates'][$opt['layout']]['thumb_title']);
		$rez = $thumb_slug ? $ANCORA_GLOBALS['thumb_sizes'][$thumb_slug] : array('w'=>null, 'h'=>null, 'h_crop'=>null);
		return $rez;
	}
}

// Show custom thumb sizes into media manager sizes list
if (!function_exists('ancora_show_thumb_sizes')) {
	function ancora_show_thumb_sizes( $sizes ) {
		global $ANCORA_GLOBALS;
		$thumb_sizes = $ANCORA_GLOBALS['thumb_sizes'];
		if (count($thumb_sizes) > 0) {
			$rez = array();
			foreach ($thumb_sizes as $k=>$v)
				$rez[$k] = !empty($v['thumb_title']) ? $v['thumb_title'] : $k;
			$sizes = array_merge( $sizes, $rez);
		}
		return $sizes;
	}
}

// AJAX callback: Get attachment url
if ( !function_exists( 'ancora_callback_get_attachment_url' ) ) {
	function ancora_callback_get_attachment_url() {
		global $_REQUEST;
		
		if ( !wp_verify_nonce( $_REQUEST['nonce'], 'ajax_nonce' ) )
			die();
	
		$response = array('error'=>'');
		
		$id = (int) $_REQUEST['attachment_id'];
		
		$response['data'] = wp_get_attachment_url($id);
		
		echo json_encode($response);
		die();
	}
}
?>