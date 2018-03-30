<?php
/**
 * Ancora Framework: less manipulations
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Theme init
if (!function_exists('ancora_less_theme_setup')) {
	//add_action( 'ancora_action_before_init_theme', 'ancora_less_theme_setup' );
	function ancora_less_theme_setup() {
		// Recompile LESS and save CSS
		add_filter("ancora_filter_save_options", 'ancora_less_save_stylesheet', 10, 3);
	}
}

if (!function_exists('ancora_less_theme_setup2')) {
	//add_action( 'ancora_action_after_init_theme', 'ancora_less_theme_setup2' );
	function ancora_less_theme_setup2() {
		// Theme first run - compile and save css
		$theme_data = wp_get_theme();
		$slug = str_replace(' ', '_', trim(ancora_strtolower((string) $theme_data->get('Name'))));
		$option_name = 'ancora_'.strip_tags($slug).'_less_compiled';
		if ( get_option($option_name, false) === false ) {
			add_option($option_name, 1, '', 'yes');
			ancora_less_save_stylesheet(ancora_options_get_all_values(), 'general');
		} else if ( !is_admin() && ancora_get_theme_option('debug_mode')=='yes' ) {
			//ancora_less_save_stylesheet(ancora_options_get_all_values(), 'general');
		}
	}
}



/* LESS
-------------------------------------------------------------------------------- */

// Save custom stylesheet when save theme options
if ( !function_exists( 'ancora_less_save_stylesheet' ) ) {
	//add_filter("ancora_filter_save_options", 'ancora_less_save_stylesheet', 10, 3);
	function ancora_less_save_stylesheet($options, $override, $slug) {
		if ($override == 'general') {
			// Compile CSS from LESS files
			ancora_compile_less($options);
		}
		return $options;
	}
}


// Register LESS Parser
if (!function_exists('ancora_compile_less')) {
	function ancora_compile_less($options) {
	
		// Load and create LESS Parser
		require_once( ancora_get_file_dir('lib/less/Less.php') );
		$parser = new Less_Parser( array( 
			'compress' => ancora_get_theme_option('debug_mode')=='no'
		) );
	
		list($less_vars, $main_styles) = ancora_prepare_less($options);
		
		// Collect .less files in parent and child themes
		$theme_dir = get_template_directory();
		$list = ancora_collect_files($theme_dir, 'less');
		$child_dir = get_stylesheet_directory();
		if ($theme_dir != $child_dir) $list = array_merge($list, ancora_collect_files($child_dir, 'less'));
		
		// Prepare separate array with less utils (not compile it alone - only with main files)
		$utils = array();
		$utils_time = 0;
		if (count($list) > 0) {
			foreach($list as $k=>$file) {
				$fname = basename($file);
				if ($fname[0]=='_') {
					$utils[] = $file;
					$list[$k] = '';
					$tmp = filemtime($file);
					if ($utils_time < $tmp) $utils_time = $tmp;
				}
			}
		}
		
		
		// Complile all .less files
		if (count($list) > 0) {
			foreach($list as $file) {
				if (empty($file)) continue;
				// Check if time of .css file after .less - skip current .less
				$file_css = substr_replace($file , 'css', strrpos($file , '.') + 1);
				$css_time = filemtime($file_css);
				if (file_exists($file_css) && $css_time >= filemtime($file) && ($utils_time==0 || $css_time > $utils_time)) continue;
				// Compile current .less file
				try {
					// Parse main file
					$parser->parseFile( $file, '');
					// Parse less utils
					if (count($utils) > 0) {
						foreach($utils as $utility) {
							$parser->parseFile( $utility, '');
						}
					}
					// Parse less vars (from Theme Options)
					$parser->parse($less_vars);
					// Add styles to the theme stylesheet
					if ($file == $theme_dir . '/style.less') {
						$parser->parse($main_styles);
					}
					$css = $parser->getCss();
					$parser->Reset();
					// If it main theme style - append CSS after header comments
					if ($file == $theme_dir . '/style.less') {
						// Append to the main Theme Style CSS
						$theme_css = ancora_fgc( get_template_directory() . '/style.css' );
						$css = ancora_substr($theme_css, 0, ancora_strpos($theme_css, '*/')+2) . "\n\n" . $css;
					}
					// Save compiled CSS
					ancora_fpc( substr_replace($file , 'css', strrpos($file , '.') + 1), $css);
				} catch (Exception $e) {
					if (ancora_get_theme_option('debug_mode')=='yes') dfl($e->getMessage());
				}
			}
		}
	}
}


// Prepare LESS variables after save/change options
if (!function_exists('ancora_prepare_less')) {
	function ancora_prepare_less($options) {
		$vars = $styles = '';
		/*
		$fonts_list = array( 
			'content', 
			'link', 
			'nav_title', 
			'nav_dropdown', 
			'h1', 
			'h2', 
			'h3', 
			'h4', 
			'h5', 
			'h6', 
			'button', 
			'small', 
			'input', 
			'quote' 
		);
		
		
		$scheme_colors = cmsms_color_schemes_defaults();
		
		$cmsms_color_schemes = cmsms_all_color_schemes_list();
		
		
		$out = '';
		
		
		$out .= "@header_top_height: " . $cmsms_option[CMSMS_SHORTNAME . '_header_top_height'] . "px;
	@header_mid_height: " . $cmsms_option[CMSMS_SHORTNAME . '_header_mid_height'] . "px;
	@header_bot_height: " . $cmsms_option[CMSMS_SHORTNAME . '_header_bot_height'] . "px;
	
	";
		
		
		foreach ($fonts_list as $font) {
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_system_font'])) {
				$out .= "@{$font}_ff: " . (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_google_font']) ? cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_google_font']) : '') . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_system_font'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_size'])) {
				$out .= "@{$font}_fz: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_size'] . "px;\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_line_height'])) {
				$out .= "@{$font}_lh: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_line_height'] . "px;\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_weight'])) {
				$out .= "@{$font}_fw: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_weight'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_style'])) {
				$out .= "@{$font}_fs: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_style'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_transform'])) {
				$out .= "@{$font}_tt: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_transform'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_decoration'])) {
				$out .= "@{$font}_td: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_decoration'] . ";\n";
			}
			
			if ($font == 'link' && isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_hover_decoration'])) {
				$out .= "\n" . 
				"@{$font}_hover_td: " . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_hover_decoration'] . ";\n";
			}
			
			
			$out .= "\n";
		}
		
		
		$out .= "\n";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			foreach ($scheme_colors[$scheme] as $key => $value) {
				if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_' . $key])) {
					$out .= "@{$key}" . (($scheme != 'default') ? '_' . $scheme : '') . ': ' . $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_' . $key] . ";\n";
				}
			}
			
			
			$out .= "\n";
		}
		
		
		$out .= "\n";
		
		
		// Fonts
		foreach ($fonts_list as $font) {
			$out .= ".font_{$font} () {\n";
			
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_system_font'])) {
				$out .= "\tfont-family:" . (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_google_font']) ? cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_google_font']) : '') . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_system_font'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_size'])) {
				$out .= "\tfont-size:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_size'] . "px;\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_line_height'])) {
				$out .= "\tline-height:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_line_height'] . "px;\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_weight'])) {
				$out .= "\tfont-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_weight'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_style'])) {
				$out .= "\tfont-style:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_font_style'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_transform'])) {
				$out .= "\ttext-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_transform'] . ";\n";
			}
			
			if (isset($cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_decoration'])) {
				$out .= "\ttext-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_' . $font . '_font_text_decoration'] . ";\n";
			}
			
			
			$out .= "}\n\n";
		}
		
		
		$out .= "\n";
		
		
		unset($cmsms_color_schemes['header']);
		
		unset($cmsms_color_schemes['header_top']);
		
		unset($cmsms_color_schemes['header_bottom']);
		
		
		// Header Color
		$out .= "
	.color_header(@header_color_name) {
		.header_mid & {
			@header_color: '@{header_color_name}_header';
			color: @@header_color;
		}
		
		.header_top & {
			@header_top_color: '@{header_color_name}_header_top';
			color: @@header_top_color;
		}
		
		.header_bot & {
			@header_bot_color: '@{header_color_name}_header_bottom';
			color: @@header_bot_color;
		}
	}
	
	";
		
		
		// Header Background Color
		$out .= "
	.color_bg_header(@header_bg_color_name) {
		.header_mid & {
			@header_bg_color: '@{header_bg_color_name}_header';
			background-color: @@header_bg_color;
		}
		
		.header_top & {
			@header_top_bg_color: '@{header_bg_color_name}_header_top';
			background-color: @@header_top_bg_color;
		}
		
		.header_bot & {
			@header_bot_bg_color: '@{header_bg_color_name}_header_bottom';
			background-color: @@header_bot_bg_color;
		}
	}
	
	";
		
		
		// Header Border Color
		$out .= "
	.color_bd_header(@header_bd_color_name) {
		.header_mid & {
			@header_bd_color: '@{header_bd_color_name}_header';
			border-color: @@header_bd_color;
		}
		
		.header_top & {
			@header_top_bd_color: '@{header_bd_color_name}_header_top';
			border-color: @@header_top_bd_color;
		}
		
		.header_bot & {
			@header_bot_bd_color: '@{header_bd_color_name}_header_bottom';
			border-color: @@header_bot_bd_color;
		}
	}
	
	";
		
		
		// Color
		$out .= "
	.color(@color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		color: @@color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@{$scheme}_color: '@{color_name}_{$scheme}';
			color: @@{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Background Color
		$out .= "
	.color_bg(@bg_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		background-color: @@bg_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bg_{$scheme}_color: '@{bg_color_name}_{$scheme}';
			background-color: @@bg_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Border Color
		$out .= "
	.color_bd(@bd_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		border-color: @@bd_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bd_{$scheme}_color: '@{bd_color_name}_{$scheme}';
			border-color: @@bd_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Border Top Color
		$out .= "
	.color_bdt(@bdt_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		border-top-color: @@bdt_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bdt_{$scheme}_color: '@{bdt_color_name}_{$scheme}';
			border-top-color: @@bdt_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Border Bottom Color
		$out .= "
	.color_bdb(@bdb_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		border-bottom-color: @@bdb_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bdb_{$scheme}_color: '@{bdb_color_name}_{$scheme}';
			border-bottom-color: @@bdb_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Border Left Color
		$out .= "
	.color_bdl(@bdl_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		border-left-color: @@bdl_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bdl_{$scheme}_color: '@{bdl_color_name}_{$scheme}';
			border-left-color: @@bdl_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Border Right Color
		$out .= "
	.color_bdr(@bdr_color_name) {";
		
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme == 'default') {
				$out .= "
		border-right-color: @@bdr_color_name;
	";
			} else {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@bdr_{$scheme}_color: '@{bdr_color_name}_{$scheme}';
			border-right-color: @@bdr_{$scheme}_color;
		}
	";
			}
		}
		
		
		$out .= "}
	
	";
		
		
		// Scheme Color
		$out .= "
	.scheme_color(@scheme_color_name) {";
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme != 'default') {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@scheme_{$scheme}_color: '@{scheme_color_name}_{$scheme}';
			color: @@scheme_{$scheme}_color;
		}
	";
			}
		}
		
		$out .= "}
	
	";
		
		
		// Scheme Background Color
		$out .= "
	.scheme_color_bg(@scheme_bg_color_name) {";
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme != 'default') {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@scheme_bg_{$scheme}_color: '@{scheme_bg_color_name}_{$scheme}';
			background-color: @@scheme_bg_{$scheme}_color;
		}
	";
			}
		}
		
		$out .= "}
	
	";
		
		
		// Scheme Border Color
		$out .= "
	.scheme_color_bd(@scheme_bd_color_name) {";
		
		foreach ($cmsms_color_schemes as $scheme => $name) {
			if ($scheme != 'default') {
				$out .= "	
		html .cmsms_color_scheme_{$scheme} & {
			@scheme_bd_{$scheme}_color: '@{scheme_bd_color_name}_{$scheme}';
			border-color: @@scheme_bd_{$scheme}_color;
		}
	";
			}
		}
		
		$out .= "}
	
	";
	*/
		$styles = 'html.csstransforms body { background-color: #ff0000; }';
		
		return array($vars, $styles);
	}
}


// Write compiled CSS into file in the folder 'uploads'
/*
if (!function_exists('ancora_save_css')) {
	function ancora_save_css($styles, $filename = '') {



		$upload_dir = wp_upload_dir();
		
		
		$style_dir = str_replace('\\', '/', $upload_dir['basedir'] . '/cmsms_styles');
		
		
		$is_dir = cmsms_create_folder($style_dir);
		
		
		if ($is_dir === false) {
			update_option('cmsms_style_dir_writable_' . CMSMS_SHORTNAME, 'false');
			
			update_option('cmsms_style_exists_' . CMSMS_SHORTNAME, 'false');
			
			
			return;
		}
		
		
		$file = trailingslashit($style_dir) . (($filename != '') ? $filename : CMSMS_SHORTNAME) . '.css';
		
		
		$created = cmsms_create_file($file, $styles);
		
		
		if ($created === true) {
			update_option('cmsms_style_dir_writable_' . CMSMS_SHORTNAME, 'true');
			
			update_option('cmsms_style_exists_' . CMSMS_SHORTNAME, 'true');
		}
	}
}
*/
?>