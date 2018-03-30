<?php
/**
 * Skin file for the theme.
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('morning_records_action_skin_theme_setup')) {
	add_action( 'morning_records_action_init_theme', 'morning_records_action_skin_theme_setup', 1 );
	function morning_records_action_skin_theme_setup() {

		// Add skin fonts in the used fonts list
		add_filter('morning_records_filter_used_fonts',			'morning_records_filter_skin_used_fonts');
		// Add skin fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('morning_records_filter_list_fonts',			'morning_records_filter_skin_list_fonts');

		// Add skin stylesheets
		add_action('morning_records_action_add_styles',			'morning_records_action_skin_add_styles');
		// Add skin inline styles
		add_filter('morning_records_filter_add_styles_inline',		'morning_records_filter_skin_add_styles_inline');
		// Add skin responsive styles
		add_action('morning_records_action_add_responsive',		'morning_records_action_skin_add_responsive');
		// Add skin responsive inline styles
		add_filter('morning_records_filter_add_responsive_inline',	'morning_records_filter_skin_add_responsive_inline');

		// Add skin scripts
		add_action('morning_records_action_add_scripts',			'morning_records_action_skin_add_scripts');
		// Add skin scripts inline
		add_action('morning_records_action_add_scripts_inline',	'morning_records_action_skin_add_scripts_inline');

		// Add skin less files into list for compilation
		add_filter('morning_records_filter_compile_less',			'morning_records_filter_skin_compile_less');


		/* Color schemes
		
		// Accenterd colors
		accent1			- theme accented color 1
		accent1_hover	- theme accented color 1 (hover state)
		accent2			- theme accented color 2
		accent2_hover	- theme accented color 2 (hover state)		
		accent3			- theme accented color 3
		accent3_hover	- theme accented color 3 (hover state)		
		
		// Headers, text and links
		text			- main content
		text_light		- post info
		text_dark		- headers
		inverse_text	- text on accented background
		inverse_light	- post info on accented background
		inverse_dark	- headers on accented background
		inverse_link	- links on accented background
		inverse_hover	- hovered links on accented background
		
		// Block's border and background
		bd_color		- border for the entire block
		bg_color		- background color for the entire block
		bg_image, bg_image_position, bg_image_repeat, bg_image_attachment  - first background image for the entire block
		bg_image2,bg_image2_position,bg_image2_repeat,bg_image2_attachment - second background image for the entire block
		
		// Alternative colors - highlight blocks, form fields, etc.
		alter_text		- text on alternative background
		alter_light		- post info on alternative background
		alter_dark		- headers on alternative background
		alter_link		- links on alternative background
		alter_hover		- hovered links on alternative background
		alter_bd_color	- alternative border
		alter_bd_hover	- alternative border for hovered state or active field
		alter_bg_color	- alternative background
		alter_bg_hover	- alternative background for hovered state or active field 
		alter_bg_image, alter_bg_image_position, alter_bg_image_repeat, alter_bg_image_attachment - background image for the alternative block
		
		*/

		// Add color schemes
		morning_records_add_color_scheme('original', array(

			'title'					=> esc_html__('Original', 'morning-records'),

			// Accent colors
			'accent1'				=> '#00ade6',
			'accent1_hover'			=> '#00729a',
			
			// Headers, text and links colors
			'text'					=> '#1e2e47',
			'text_light'			=> '#000000',
			'text_dark'				=> '#1d2e47',
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#c8c9cc',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#283248',
			'inverse_hover'			=> '#ffffff',
			
			// Whole block border and background
			'bd_color'				=> '#e6e8ea',
			'bg_color'				=> '#ffffff',
			'bg_image'				=> '',
			'bg_image_position'		=> 'left top',
			'bg_image_repeat'		=> 'repeat',
			'bg_image_attachment'	=> 'scroll',
			'bg_image2'				=> '',
			'bg_image2_position'	=> 'left top',
			'bg_image2_repeat'		=> 'repeat',
			'bg_image2_attachment'	=> 'scroll',
		
			// Alternative blocks (submenu items, form's fields, etc.)
			'alter_text'			=> '#1e2e47',
			'alter_light'			=> '#1d2e47',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#ffffff',
			'alter_hover'			=> '#00ade6',
			'alter_bd_color'		=> '#b9babb',
			'alter_bd_hover'		=> '#7f7f7f',
			'alter_bg_color'		=> '#f4f6f8',
			'alter_bg_hover'		=> '#1d2434',
			'alter_bg_image'			=> '',
			'alter_bg_image_position'	=> 'center center',
			'alter_bg_image_repeat'		=> 'no-repeat',
			'alter_bg_image_attachment'	=> 'scroll',
			)
		);
		// Add color schemes
		morning_records_add_color_scheme('color_2', array(

			'title'					=> esc_html__('Color 2', 'morning-records'),

			// Accent colors
			'accent1'				=> '#ffd351',
			'accent1_hover'			=> '#00729a',

			// Headers, text and links colors
			'text'					=> '#1e2e47',
			'text_light'			=> '#000000',
			'text_dark'				=> '#1d2e47',
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#c8c9cc',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#283248',
			'inverse_hover'			=> '#ffffff',

			// Whole block border and background
			'bd_color'				=> '#e6e8ea',
			'bg_color'				=> '#ffffff',
			'bg_image'				=> '',
			'bg_image_position'		=> 'left top',
			'bg_image_repeat'		=> 'repeat',
			'bg_image_attachment'	=> 'scroll',
			'bg_image2'				=> '',
			'bg_image2_position'	=> 'left top',
			'bg_image2_repeat'		=> 'repeat',
			'bg_image2_attachment'	=> 'scroll',

			// Alternative blocks (submenu items, form's fields, etc.)
			'alter_text'			=> '#1e2e47',
			'alter_light'			=> '#1d2e47',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#ffffff',
			'alter_hover'			=> '#ffd351',
			'alter_bd_color'		=> '#b9babb',
			'alter_bd_hover'		=> '#7f7f7f',
			'alter_bg_color'		=> '#f4f6f8',
			'alter_bg_hover'		=> '#1d2434',
			'alter_bg_image'			=> '',
			'alter_bg_image_position'	=> 'center center',
			'alter_bg_image_repeat'		=> 'no-repeat',
			'alter_bg_image_attachment'	=> 'scroll',
			)
		);
		// Add color schemes
		morning_records_add_color_scheme('color_3', array(

			'title'					=> esc_html__('Cololr 3', 'morning-records'),

			// Accent colors
			'accent1'				=> '#a863d9',
			'accent1_hover'			=> '#00729a',

			// Headers, text and links colors
			'text'					=> '#1e2e47',
			'text_light'			=> '#000000',
			'text_dark'				=> '#1d2e47',
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#c8c9cc',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#283248',
			'inverse_hover'			=> '#ffffff',

			// Whole block border and background
			'bd_color'				=> '#e6e8ea',
			'bg_color'				=> '#ffffff',
			'bg_image'				=> '',
			'bg_image_position'		=> 'left top',
			'bg_image_repeat'		=> 'repeat',
			'bg_image_attachment'	=> 'scroll',
			'bg_image2'				=> '',
			'bg_image2_position'	=> 'left top',
			'bg_image2_repeat'		=> 'repeat',
			'bg_image2_attachment'	=> 'scroll',

			// Alternative blocks (submenu items, form's fields, etc.)
			'alter_text'			=> '#1e2e47',
			'alter_light'			=> '#1d2e47',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#ffffff',
			'alter_hover'			=> '#a863d9',
			'alter_bd_color'		=> '#b9babb',
			'alter_bd_hover'		=> '#7f7f7f',
			'alter_bg_color'		=> '#f4f6f8',
			'alter_bg_hover'		=> '#1d2434',
			'alter_bg_image'			=> '',
			'alter_bg_image_position'	=> 'center center',
			'alter_bg_image_repeat'		=> 'no-repeat',
			'alter_bg_image_attachment'	=> 'scroll',
			)
		);
		// Add color schemes
		morning_records_add_color_scheme('color_4', array(

			'title'					=> esc_html__('Color 4', 'morning-records'),

			// Accent colors
			'accent1'				=> '#d30104',
			'accent1_hover'			=> '#00729a',

			// Headers, text and links colors
			'text'					=> '#1e2e47',
			'text_light'			=> '#000000',
			'text_dark'				=> '#1d2e47',
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#c8c9cc',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#283248',
			'inverse_hover'			=> '#ffffff',

			// Whole block border and background
			'bd_color'				=> '#e6e8ea',
			'bg_color'				=> '#ffffff',
			'bg_image'				=> '',
			'bg_image_position'		=> 'left top',
			'bg_image_repeat'		=> 'repeat',
			'bg_image_attachment'	=> 'scroll',
			'bg_image2'				=> '',
			'bg_image2_position'	=> 'left top',
			'bg_image2_repeat'		=> 'repeat',
			'bg_image2_attachment'	=> 'scroll',

			// Alternative blocks (submenu items, form's fields, etc.)
			'alter_text'			=> '#1e2e47',
			'alter_light'			=> '#1d2e47',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#ffffff',
			'alter_hover'			=> '#d30104',
			'alter_bd_color'		=> '#b9babb',
			'alter_bd_hover'		=> '#7f7f7f',
			'alter_bg_color'		=> '#f4f6f8',
			'alter_bg_hover'		=> '#1d2434',
			'alter_bg_image'			=> '',
			'alter_bg_image_position'	=> 'center center',
			'alter_bg_image_repeat'		=> 'no-repeat',
			'alter_bg_image_attachment'	=> 'scroll',
			)
		);


		/* Font slugs:
		h1 ... h6	- headers
		p			- plain text
		link		- links
		info		- info blocks (Posted 15 May, 2015 by John Doe)
		menu		- main menu
		submenu		- dropdown menus
		logo		- logo text
		button		- button's caption
		input		- input fields
		*/

        // Add Custom fonts
        morning_records_add_custom_font('p', array(
                'title'			=> esc_html__('Text', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro',
                'font-size' 	=> '16px',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> '1em'
            )
        );
        morning_records_add_custom_font('h1', array(
                'title'			=> esc_html__('Heading 1', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Oswald',
                'font-size' 	=> '6.25rem',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('h2', array(
                'title'			=> esc_html__('Heading 2', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Oswald',
                'font-size' 	=> '4.688rem',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('h3', array(
                'title'			=> esc_html__('Heading 3', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Oswald',
                'font-size' 	=> '3.125rem',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('h4', array(
                'title'			=> esc_html__('Heading 4', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro',
                'font-size' 	=> '2.625rem',
                'font-weight'	=> '600',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('h5', array(
                'title'			=> esc_html__('Heading 5', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro',
                'font-size' 	=> '2.625rem',
                'font-weight'	=> '600',
                'font-style'	=> '',
                'line-height'	=> '1.3em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('h6', array(
                'title'			=> esc_html__('Heading 6', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro',
                'font-size' 	=> '1.625rem',
                'font-weight'	=> '600',
                'font-style'	=> '',
                'line-height'	=> '1.4em',
                'margin-top'	=> '',
                'margin-bottom'	=> ''
            )
        );
        morning_records_add_custom_font('logo', array(
                'title'			=> esc_html__('Logo', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Norican',
                'font-size' 	=> '1.875rem',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '0.8em'
            )
        );
        morning_records_add_custom_font('menu', array(
                'title'			=> esc_html__('Main menu items', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Oswald',
                'font-size' 	=> '4.563rem',
                'font-weight'	=> '400',
                'font-style'	=> '',
                'line-height'	=> '0.9em'
            )
        );
        morning_records_add_custom_font('submenu', array(
                'title'			=> esc_html__('Dropdown menu items', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro',
                'font-size' 	=> '0.875rem',
                'font-weight'	=> '700',
                'font-style'	=> '',
                'line-height'	=> '0.9em'
            )
        );
        morning_records_add_custom_font('link', array(
                'title'			=> esc_html__('Links', 'morning-records'),
                'description'	=> '',
                'font-family'	=> ''
            )
        );
        morning_records_add_custom_font('info', array(
                'title'			=> esc_html__('Post info', 'morning-records'),
                'description'	=> '',
                'font-family'	=> ''
            )
        );
        morning_records_add_custom_font('button', array(
                'title'			=> esc_html__('Buttons', 'morning-records'),
                'description'	=> '',
                'font-family'	=> 'Source Sans Pro'
            )
        );
        morning_records_add_custom_font('input', array(
                'title'			=> esc_html__('Input fields', 'morning-records'),
                'description'	=> '',
                'font-family'	=> ''
            )
        );

	}
}





//------------------------------------------------------------------------------
// Skin's fonts
//------------------------------------------------------------------------------

// Add skin fonts in the used fonts list
if (!function_exists('morning_records_filter_skin_used_fonts')) {
	//add_filter('morning_records_filter_used_fonts', 'morning_records_filter_skin_used_fonts');
	function morning_records_filter_skin_used_fonts($theme_fonts) {
        $theme_fonts['Oswald'] = 1;
        $theme_fonts['Norican'] = 1;
        $theme_fonts['Questrial'] = 1;
        $theme_fonts['Source Sans Pro'] = 1;
        return $theme_fonts;
	}
}

// Add skin fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
// How to install custom @font-face fonts into the theme?
// All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!
// Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.
// Create your @font-face kit by using Fontsquirrel @font-face Generator (http://www.fontsquirrel.com/fontface/generator)
// and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install
if (!function_exists('morning_records_filter_skin_list_fonts')) {
	//add_filter('morning_records_filter_list_fonts', 'morning_records_filter_skin_list_fonts');
	function morning_records_filter_skin_list_fonts($list) {
        if (!isset($list['Norican']))	        $list['Norican'] = array('family'=>'cursive', 'link'=>'Norican');
        if (!isset($list['Oswald']))	        $list['Oswald'] = array('family'=>'sans-serif', 'link'=>'Oswald');
        if (!isset($list['Questrial']))	        $list['Questrial'] = array('family'=>'sans-serif', 'link'=>'Questrial');
        if (!isset($list['Source Sans Pro']))	$list['Source Sans Pro'] = array('family'=>'sans-serif', 'link'=>'Source+Sans+Pro:400,600,700,300');
        return $list;
	}
}



//------------------------------------------------------------------------------
// Skin's stylesheets
//------------------------------------------------------------------------------
// Add skin stylesheets
if (!function_exists('morning_records_action_skin_add_styles')) {
	//add_action('morning_records_action_add_styles', 'morning_records_action_skin_add_styles');
	function morning_records_action_skin_add_styles() {
		// Add stylesheet files
		morning_records_enqueue_style( 'morning_records-skin-style', morning_records_get_file_url('skin.css'), array(), null );
		if (file_exists(morning_records_get_file_dir('skin.customizer.css')))
			morning_records_enqueue_style( 'morning_records-skin-customizer-style', morning_records_get_file_url('skin.customizer.css'), array(), null );
	}
}

// Add skin inline styles
if (!function_exists('morning_records_filter_skin_add_styles_inline')) {
	//add_filter('morning_records_filter_add_styles_inline', 'morning_records_filter_skin_add_styles_inline');
	function morning_records_filter_skin_add_styles_inline($custom_style) {
		// Todo: add skin specific styles in the $custom_style to override
		//       rules from style.css and shortcodes.css
		// Example:
		//		$scheme = morning_records_get_custom_option('body_scheme');
		//		if (empty($scheme)) $scheme = 'original';
		//		$clr = morning_records_get_scheme_color('accent1');
		//		if (!empty($clr)) {
		// 			$custom_style .= '
		//				a,
		//				.bg_tint_light a,
		//				.top_panel .content .search_wrap.search_style_regular .search_form_wrap .search_submit,
		//				.top_panel .content .search_wrap.search_style_regular .search_icon,
		//				.search_results .post_more,
		//				.search_results .search_results_close {
		//					color:'.esc_attr($clr).';
		//				}
		//			';
		//		}
		return $custom_style;	
	}
}

// Add skin responsive styles
if (!function_exists('morning_records_action_skin_add_responsive')) {
	//add_action('morning_records_action_add_responsive', 'morning_records_action_skin_add_responsive');
	function morning_records_action_skin_add_responsive() {
		$suffix = morning_records_param_is_off(morning_records_get_custom_option('show_sidebar_outer')) ? '' : '-outer';
		if (file_exists(morning_records_get_file_dir('skin.responsive'.($suffix).'.css'))) 
			morning_records_enqueue_style( 'theme-skin-responsive-style', morning_records_get_file_url('skin.responsive'.($suffix).'.css'), array(), null );
	}
}

// Add skin responsive inline styles
if (!function_exists('morning_records_filter_skin_add_responsive_inline')) {
	//add_filter('morning_records_filter_add_responsive_inline', 'morning_records_filter_skin_add_responsive_inline');
	function morning_records_filter_skin_add_responsive_inline($custom_style) {
		return $custom_style;	
	}
}

// Add skin.less into list files for compilation
if (!function_exists('morning_records_filter_skin_compile_less')) {
	//add_filter('morning_records_filter_compile_less', 'morning_records_filter_skin_compile_less');
	function morning_records_filter_skin_compile_less($files) {
		if (file_exists(morning_records_get_file_dir('skin.less'))) {
		 	$files[] = morning_records_get_file_dir('skin.less');
		}
		return $files;	
	}
}



//------------------------------------------------------------------------------
// Skin's scripts
//------------------------------------------------------------------------------

// Add skin scripts
if (!function_exists('morning_records_action_skin_add_scripts')) {
	//add_action('morning_records_action_add_scripts', 'morning_records_action_skin_add_scripts');
	function morning_records_action_skin_add_scripts() {
		if (file_exists(morning_records_get_file_dir('skin.js')))
			morning_records_enqueue_script( 'theme-skin-script', morning_records_get_file_url('skin.js'), array(), null );
		if (morning_records_get_theme_option('show_theme_customizer') == 'yes' && file_exists(morning_records_get_file_dir('skin.customizer.js')))
			morning_records_enqueue_script( 'theme-skin-customizer-script', morning_records_get_file_url('skin.customizer.js'), array(), null );
	}
}

// Add skin scripts inline
if (!function_exists('morning_records_action_skin_add_scripts_inline')) {
	//add_action('morning_records_action_add_scripts_inline', 'morning_records_action_skin_add_scripts_inline');
	function morning_records_action_skin_add_scripts_inline() {
		// Todo: add skin specific scripts
		// Example:
		// echo '<script type="text/javascript">'
		//	. 'jQuery(document).ready(function() {'
		//	. "if (MORNING_RECORDS_STORAGE['theme_font']=='') MORNING_RECORDS_STORAGE['theme_font'] = '" . morning_records_get_custom_font_settings('p', 'font-family') . "';"
		//	. "MORNING_RECORDS_STORAGE['theme_skin_color'] = '" . morning_records_get_scheme_color('accent1') . "';"
		//	. "});"
		//	. "< /script>";
	}
}
?>