<?php

/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'ancora_options_settings_theme_setup2' ) ) {
	add_action( 'ancora_action_after_init_theme', 'ancora_options_settings_theme_setup2', 1 );
	function ancora_options_settings_theme_setup2() {
		if (ancora_options_is_used()) {
			global $ANCORA_GLOBALS;
			// Replace arrays with actual parameters
			$lists = array();
			foreach ($ANCORA_GLOBALS['options'] as $k=>$v) {
				if (isset($v['options']) && is_array($v['options'])) {
					foreach ($v['options'] as $k1=>$v1) {
						if (ancora_substr($k1, 0, 8) == '$ancora_' || ancora_substr($v1, 0, 8) == '$ancora_') {
							$list_func = ancora_substr(ancora_substr($k1, 0, 8) == '$ancora_' ? $k1 : $v1, 1);
							unset($ANCORA_GLOBALS['options'][$k]['options'][$k1]);
							if (isset($lists[$list_func]))
								$ANCORA_GLOBALS['options'][$k]['options'] = ancora_array_merge($ANCORA_GLOBALS['options'][$k]['options'], $lists[$list_func]);
							else {
								if (function_exists($list_func)) {
									$ANCORA_GLOBALS['options'][$k]['options'] = $lists[$list_func] = ancora_array_merge($ANCORA_GLOBALS['options'][$k]['options'], $list_func == 'ancora_get_list_menus' ? $list_func(true) : $list_func());
							   	} else
							   		echo sprintf(__('Wrong function name %s in the theme options array', 'ancora'), $list_func);
							}
						}
					}
				}
			}
		}
	}
}

// Reset old Theme Options while theme first run
if ( !function_exists( 'ancora_options_reset' ) ) {
	function ancora_options_reset($clear=true) {
		$theme_data = wp_get_theme();
		$slug = str_replace(' ', '_', trim(ancora_strtolower((string) $theme_data->get('Name'))));
		$option_name = 'ancora_'.strip_tags($slug).'_options_reset';
		if ( get_option($option_name, false) === false ) {	// && (string) $theme_data->get('Version') == '1.0'
			if ($clear) {
				// Remove Theme Options from WP Options
				global $wpdb;
				$wpdb->query('delete from '.esc_sql($wpdb->options).' where option_name like "ancora_options%"');
				// Add Templates Options
				if (file_exists(ancora_get_file_dir('demo/templates_options.txt'))) {
					$theme_options_txt = ancora_fgc(ancora_get_file_dir('demo/templates_options.txt'));
					$data = unserialize( base64_decode( $theme_options_txt) );
					// Replace upload url in options
					foreach ($data as $k=>$v) {
						foreach ($v as $k1=>$v1) {
							$v[$k1] = ancora_replace_uploads_url(ancora_replace_uploads_url($v1, 'uploads'), 'imports');
						}
						add_option( $k, $v, '', 'yes' );
					}
				}
			}
			add_option($option_name, 1, '', 'yes');
		}
	}
}

// Prepare default Theme Options
if ( !function_exists( 'ancora_options_settings_theme_setup' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_options_settings_theme_setup', 2 );	// Priority 1 for add ancora_filter handlers
	function ancora_options_settings_theme_setup() {
		global $ANCORA_GLOBALS;
		
		// Remove 'false' to clear all saved Theme Options on next run.
		// Attention! Use this way only on new theme installation, not in updates!
		ancora_options_reset();
		
		// Prepare arrays 
		$ANCORA_GLOBALS['options_params'] = array(
			'list_fonts'		=> array('$ancora_get_list_fonts' => ''),
			'list_fonts_styles'	=> array('$ancora_get_list_fonts_styles' => ''),
			'list_socials' 		=> array('$ancora_get_list_socials' => ''),
			'list_icons' 		=> array('$ancora_get_list_icons' => ''),
			'list_posts_types' 	=> array('$ancora_get_list_posts_types' => ''),
			'list_categories' 	=> array('$ancora_get_list_categories' => ''),
			'list_menus'		=> array('$ancora_get_list_menus' => ''),
			'list_sidebars'		=> array('$ancora_get_list_sidebars' => ''),
			'list_positions' 	=> array('$ancora_get_list_sidebars_positions' => ''),
			'list_tints'	 	=> array('$ancora_get_list_bg_tints' => ''),
			'list_sidebar_styles' => array('$ancora_get_list_sidebar_styles' => ''),
			'list_skins'		=> array('$ancora_get_list_skins' => ''),
			'list_color_schemes'=> array('$ancora_get_list_color_schemes' => ''),
			'list_body_styles'	=> array('$ancora_get_list_body_styles' => ''),
			'list_blog_styles'	=> array('$ancora_get_list_templates_blog' => ''),
			'list_single_styles'=> array('$ancora_get_list_templates_single' => ''),
			'list_article_styles'=> array('$ancora_get_list_article_styles' => ''),
			'list_animations_in' => array('$ancora_get_list_animations_in' => ''),
			'list_animations_out'=> array('$ancora_get_list_animations_out' => ''),
			'list_filters'		=> array('$ancora_get_list_portfolio_filters' => ''),
			'list_hovers'		=> array('$ancora_get_list_hovers' => ''),
			'list_hovers_dir'	=> array('$ancora_get_list_hovers_directions' => ''),
			'list_sliders' 		=> array('$ancora_get_list_sliders' => ''),
			'list_popups' 		=> array('$ancora_get_list_popup_engines' => ''),
			'list_gmap_styles' 	=> array('$ancora_get_list_googlemap_styles' => ''),
			'list_yes_no' 		=> array('$ancora_get_list_yesno' => ''),
			'list_on_off' 		=> array('$ancora_get_list_onoff' => ''),
			'list_show_hide' 	=> array('$ancora_get_list_showhide' => ''),
			'list_sorting' 		=> array('$ancora_get_list_sortings' => ''),
			'list_ordering' 	=> array('$ancora_get_list_orderings' => ''),
			'list_locations' 	=> array('$ancora_get_list_dedicated_locations' => '')
			);


		// Theme options array
		$ANCORA_GLOBALS['options'] = array(

		
		//###############################
		//#### Customization         #### 
		//###############################
		'partition_customization' => array(
					"title" => __('Customization', 'ancora'),
					"start" => "partitions",
					"override" => "category,courses_group,page,post",
					"icon" => "iconadmin-cog-alt",
					"type" => "partition"
					),


		// Customization -> General
		//-------------------------------------------------
		
		'customization_general' => array(
					"title" => __('General', 'ancora'),
					"override" => "category,courses_group,page,post",
					"icon" => 'iconadmin-cog',
					"start" => "customization_tabs",
					"type" => "tab"
					),

		'info_custom_1' => array(
					"title" => __('Theme customization general parameters', 'ancora'),
					"desc" => __('Select main theme skin, customize colors and enable responsive layouts for the small screens', 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"
					),

		'theme_skin' => array(
					"title" => __('Select theme skin', 'ancora'),
					"desc" => __('Select skin for the theme decoration', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "blessing",
					"options" => $ANCORA_GLOBALS['options_params']['list_skins'],
					"type" => "select"
					),

		"icon" => array(
					"title" => __('Select icon', 'ancora'),
					"desc" => __('Select icon for output before post/category name in some layouts', 'ancora'),
					"override" => "category,courses_group,post",
					"std" => "",
					"options" => $ANCORA_GLOBALS['options_params']['list_icons'],
					"style" => "select",
					"type" => "icons"
					),

		"color_scheme" => array(
					"title" => __('Color scheme', 'ancora'),
					"desc" => __('Select predefined color scheme. Or set separate colors in fields below', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "original",
					"dir" => "horizontal",
					"options" => $ANCORA_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),

		"link_color" => array(
					"title" => __('Links color', 'ancora'),
					"desc" => __('Links color. Also used as background color for the page header area and some other elements', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"link_dark" => array(
					"title" => __('Links dark color', 'ancora'),
					"desc" => __('Used as background color for the buttons, hover states and some other elements', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"menu_color" => array(
					"title" => __('Main menu color', 'ancora'),
					"desc" => __('Used as background color for the active menu item, calendar item, tabs and some other elements', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"menu_dark" => array(
					"title" => __('Main menu dark color', 'ancora'),
					"desc" => __('Used as text color for the menu items (in the Light style), as background color for the selected menu item, etc.', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"user_color" => array(
					"title" => __('User menu color', 'ancora'),
					"desc" => __('Used as background color for the user menu items and some other elements', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"user_dark" => array(
					"title" => __('User menu dark color', 'ancora'),
					"desc" => __('Used as background color for the selected user menu item, etc.', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),


		'show_theme_customizer' => array(
					"title" => __('Show Theme customizer', 'ancora'),
					"desc" => __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		"customizer_demo" => array(
					"title" => __('Theme customizer panel demo time', 'ancora'),
					"desc" => __('Timer for demo mode for the customizer panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'ancora'),
					"divider" => false,
					"std" => "0",
					"min" => 0,
					"max" => 10000,
					"step" => 500,
					"type" => "spinner"),
		
		'css_animation' => array(
					"title" => __('Extended CSS animations', 'ancora'),
					"desc" => __('Do you want use extended animations effects on your site?', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'remember_visitors_settings' => array(
					"title" => __('Remember visitor\'s settings', 'ancora'),
					"desc" => __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
					
		'responsive_layouts' => array(
					"title" => __('Responsive Layouts', 'ancora'),
					"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		'info_custom_2' => array(
					"title" => __('Additional CSS and HTML/JS code', 'ancora'),
					"desc" => __('Put here your custom CSS and JS code', 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"
					),
		
		'custom_css' => array(
					"title" => __('Your CSS code',  'ancora'),
					"desc" => __('Put here your css code to correct main theme styles',  'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		'custom_code' => array(
					"title" => __('Your HTML/JS code',  'ancora'),
					"desc" => __('Put here your invisible html/js code: Google analitics, counters, etc',  'ancora'),
					"override" => "category,courses_group,post,page",
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		
		// Customization -> Body Style
		//-------------------------------------------------
		
		'customization_body' => array(
					"title" => __('Body style', 'ancora'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-picture',
					"type" => "tab"
					),
		
		'info_custom_3' => array(
					"title" => __('Body parameters', 'ancora'),
					"desc" => __('Background color, pattern and image used only for fixed body style.', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),
					
		'body_style' => array(
					"title" => __('Body style', 'ancora'),
					"desc" => __('Select body style:<br><b>boxed</b> - if you want use background color and/or image,<br><b>wide</b> - page fill whole window with centered content,<br><b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings),<br><b>fullscreen</b> - page content fill whole window without any paddings', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "wide",
					"options" => $ANCORA_GLOBALS['options_params']['list_body_styles'],
					"dir" => "horizontal",
					"type" => "radio"
					),
		
		'body_filled' => array(
					"title" => __('Fill body', 'ancora'),
					"desc" => __('Fill the body background with the solid color (white or grey) or leave it transparend to show background image (or video)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		'load_bg_image' => array(
					"title" => __('Load background image', 'ancora'),
					"desc" => __('Always load background images or only for boxed body style', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "boxed",
					"size" => "medium",
					"options" => array(
						'boxed' => __('Boxed', 'ancora'),
						'always' => __('Always', 'ancora')
					),
					"type" => "switch"
					),
		
		'bg_color' => array(
					"title" => __('Background color',  'ancora'),
					"desc" => __('Body background color',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "#bfbfbf",
					"type" => "color"
					),
		
		'bg_pattern' => array(
					"title" => __('Background predefined pattern',  'ancora'),
					"desc" => __('Select theme background pattern (first case - without pattern)',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"options" => array(
						0 => ancora_get_file_url('/images/spacer.png'),
						1 => ancora_get_file_url('/images/bg/pattern_1.png'),
						2 => ancora_get_file_url('/images/bg/pattern_2.png'),
						3 => ancora_get_file_url('/images/bg/pattern_3.png'),
						4 => ancora_get_file_url('/images/bg/pattern_4.png'),
						5 => ancora_get_file_url('/images/bg/pattern_5.png'),
						6 => ancora_get_file_url('/images/bg/pattern_6.png'),
						7 => ancora_get_file_url('/images/bg/pattern_7.png'),
						8 => ancora_get_file_url('/images/bg/pattern_8.png'),
						9 => ancora_get_file_url('/images/bg/pattern_9.png')
					),
					"style" => "list",
					"type" => "images"
					),

		'bg_custom_pattern' => array(
					"title" => __('Background custom pattern',  'ancora'),
					"desc" => __('Select or upload background custom pattern. If selected - use it instead the theme predefined pattern (selected in the field above)',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),

		'bg_image' => array(
					"title" => __('Background predefined image',  'ancora'),
					"desc" => __('Select theme background image (first case - without image)',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"options" => array(
						0 => ancora_get_file_url('/images/spacer.png'),
						1 => ancora_get_file_url('/images/bg/image_1_thumb.jpg'),
						2 => ancora_get_file_url('/images/bg/image_2_thumb.jpg'),
						3 => ancora_get_file_url('/images/bg/image_3_thumb.jpg'),
						4 => ancora_get_file_url('/images/bg/image_4_thumb.jpg'),
						5 => ancora_get_file_url('/images/bg/image_5_thumb.jpg'),
						6 => ancora_get_file_url('/images/bg/image_6_thumb.jpg')
					),
					"style" => "list",
					"type" => "images"
					),

		'bg_custom_image' => array(
					"title" => __('Background custom image',  'ancora'),
					"desc" => __('Select or upload background custom image. If selected - use it instead the theme predefined image (selected in the field above)',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),

		'bg_custom_image_position' => array( 
					"title" => __('Background custom image position',  'ancora'),
					"desc" => __('Select custom image position',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "left_top",
					"options" => array(
						'left_top' => "Left Top",
						'center_top' => "Center Top",
						'right_top' => "Right Top",
						'left_center' => "Left Center",
						'center_center' => "Center Center",
						'right_center' => "Right Center",
						'left_bottom' => "Left Bottom",
						'center_bottom' => "Center Bottom",
						'right_bottom' => "Right Bottom",
					),
					"type" => "select"
					),

		'show_video_bg' => array(
					"title" => __('Show video background',  'ancora'),
					"desc" => __("Show video on the site background (only for Fullscreen body style)", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'video_bg_youtube_code' => array(
					"title" => __('Youtube code for video bg',  'ancora'),
					"desc" => __("Youtube code of video", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "text"
					),

		'video_bg_url' => array(
					"title" => __('Local video for video bg',  'ancora'),
					"desc" => __("URL to video-file (uploaded on your site)", 'ancora'),
					"readonly" =>false,
					"override" => "category,courses_group,post,page",
					"before" => array(	'title' => __('Choose video', 'ancora'),
										'action' => 'media_upload',
										'multiple' => false,
										'linked_field' => '',
										'type' => 'video',
										'captions' => array('choose' => __( 'Choose Video', 'ancora'),
															'update' => __( 'Select Video', 'ancora')
														)
								),
					"std" => "",
					"type" => "media"
					),

		'video_bg_overlay' => array(
					"title" => __('Use overlay for video bg', 'ancora'),
					"desc" => __('Use overlay texture for the video background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		
		
		// Customization -> Logo
		//-------------------------------------------------
		
		'customization_logo' => array(
					"title" => __('Logo', 'ancora'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-heart',
					"type" => "tab"
					),
		
		'info_custom_4' => array(
					"title" => __('Main logo', 'ancora'),
					"desc" => __('Select or upload logos for the site\'s header and select it position', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),

		'favicon' => array(
					"title" => __('Favicon', 'ancora'),
					"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_dark' => array(
					"title" => __('Logo image (dark header)', 'ancora'),
					"desc" => __('Main logo image for the dark header', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),

		'logo_light' => array(
					"title" => __('Logo image (light header)', 'ancora'),
					"desc" => __('Main logo image for the light header', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_fixed' => array(
					"title" => __('Logo image (fixed header)', 'ancora'),
					"desc" => __('Logo image for the header (if menu is fixed after the page is scrolled)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),
		
		'logo_from_skin' => array(
					"title" => __('Logo from skin',  'ancora'),
					"desc" => __("Use logo images from current skin folder if not filled out fields above", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'logo_text' => array(
					"title" => __('Logo text', 'ancora'),
					"desc" => __('Logo text - display it after logo image', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_slogan' => array(
					"title" => __('Logo slogan', 'ancora'),
					"desc" => __('Logo slogan - display it under logo image (instead the site slogan)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_height' => array(
					"title" => __('Logo height', 'ancora'),
					"desc" => __('Height for the logo in the header area', 'ancora'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),

		'logo_offset' => array(
					"title" => __('Logo top offset', 'ancora'),
					"desc" => __('Top offset for the logo in the header area', 'ancora'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 0,
					"max" => 99,
					"mask" => "?99",
					"type" => "spinner"
					),

//		'logo_align' => array(
//					"title" => __('Logo alignment', 'ancora'),
//					"desc" => __('Logo alignment (only if logo above menu)', 'ancora'),
//					"override" => "category,courses_group,post,page",
//					"std" => "left",
//					"options" =>  array("left"=>__("Left", 'ancora'), "center"=>__("Center", 'ancora'), "right"=>__("Right", 'ancora')),
//					"dir" => "horizontal",
//					"type" => "checklist"
//					),

		'iinfo_custom_5' => array(
					"title" => __('Logo for footer', 'ancora'),
					"desc" => __('Select or upload logos for the site\'s footer and set it height', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),

		'logo_footer' => array(
					"title" => __('Logo image for footer', 'ancora'),
					"desc" => __('Logo image for the footer', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),
		
		'logo_footer_height' => array(
					"title" => __('Logo height', 'ancora'),
					"desc" => __('Height for the logo in the footer area (in contacts)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => 30,
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),
		
		
		
		// Customization -> Menus
		//-------------------------------------------------
		
		"customization_menus" => array(
					"title" => __('Menus', 'ancora'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-menu',
					"type" => "tab"),
		
		"info_custom_6" => array(
					"title" => __('Top panel', 'ancora'),
					"desc" => __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"top_panel_position" => array( 
					"title" => __('Top panel position', 'ancora'),
					"desc" => __('Select position for the top panel with logo and main menu', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "above",
					"options" => array(
						'hide'  => __('Hide', 'ancora'),
						'above' => __('Above slider', 'ancora'),
						'below' => __('Below slider', 'ancora'),
						'over'  => __('Over slider', 'ancora')
					),
					"type" => "checklist"),
		
		"top_panel_style" => array( 
					"title" => __('Top panel style', 'ancora'),
					"desc" => __('Select background style for the top panel with logo and main menu', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "dark",
					"options" => array(
						'dark' => __('Dark', 'ancora'),
						'light' => __('Light', 'ancora')
					),
					"type" => "checklist"),
		
		"top_panel_opacity" => array( 
					"title" => __('Top panel opacity', 'ancora'),
					"desc" => __('Select background opacity for the top panel with logo and main menu', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "solid",
					"options" => array(
						'solid' => __('Solid', 'ancora'),
						'transparent' => __('Transparent', 'ancora')
					),
					"type" => "checklist"),
		
		'top_panel_bg_color' => array(
					"title" => __('Top panel bg color',  'ancora'),
					"desc" => __('Background color for the top panel',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"
					),
		
		"top_panel_bg_image" => array( 
					"title" => __('Top panel bg image', 'ancora'),
					"desc" => __('Upload top panel background image', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"),
		
		
		"info_custom_7" => array( 
					"title" => __('Main menu style and position', 'ancora'),
					"desc" => __('Select the Main menu style and position', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"menu_main" => array( 
					"title" => __('Select main menu',  'ancora'),
					"desc" => __('Select main menu for the current page',  'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "default",
					"options" => $ANCORA_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"menu_position" => array( 
					"title" => __('Main menu position', 'ancora'),
					"desc" => __('Attach main menu to top of window then page scroll down', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "fixed",
					"options" => array("fixed"=>__("Fix menu position", 'ancora'), "none"=>__("Don't fix menu position", 'ancora')),
					"dir" => "vertical",
					"type" => "radio"),
		
		"menu_align" => array( 
					"title" => __('Main menu alignment', 'ancora'),
					"desc" => __('Main menu alignment', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "center",
					"options" => array(
						//"left"   => __("Left (under logo)", 'ancora'),
						"center" => __("Center (under logo)", 'ancora'),
						//"right"	 => __("Right (at same line with logo)", 'ancora')
					),
					"dir" => "vertical",
					"type" => "radio"),

		"menu_slider" => array( 
					"title" => __('Main menu slider', 'ancora'),
					"desc" => __('Use slider background for main menu items', 'ancora'),
					"std" => "yes",
					"type" => "switch",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no']),

		"menu_animation_in" => array( 
					"title" => __('Submenu show animation', 'ancora'),
					"desc" => __('Select animation to show submenu ', 'ancora'),
					"std" => "bounceIn",
					"type" => "select",
					"options" => $ANCORA_GLOBALS['options_params']['list_animations_in']),

		"menu_animation_out" => array( 
					"title" => __('Submenu hide animation', 'ancora'),
					"desc" => __('Select animation to hide submenu ', 'ancora'),
					"std" => "fadeOutDown",
					"type" => "select",
					"options" => $ANCORA_GLOBALS['options_params']['list_animations_out']),
		
		"menu_relayout" => array( 
					"title" => __('Main menu relayout', 'ancora'),
					"desc" => __('Allow relayout main menu if window width less then this value', 'ancora'),
					"std" => 960,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_responsive" => array( 
					"title" => __('Main menu responsive', 'ancora'),
					"desc" => __('Allow responsive version for the main menu if window width less then this value', 'ancora'),
					"std" => 640,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_width" => array( 
					"title" => __('Submenu width', 'ancora'),
					"desc" => __('Width for dropdown menus in main menu', 'ancora'),
					"override" => "category,courses_group,post,page",
					"step" => 5,
					"std" => "",
					"min" => 180,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"),
		
		
		
		"info_custom_8" => array(
					"title" => __("User's menu area components", 'ancora'),
					"desc" => __("Select parts for the user's menu area", 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
//		"show_menu_user" => array(
//					"title" => __('Show user menu area', 'ancora'),
//					"desc" => __('Show user menu area on top of page', 'ancora'),
//					"divider" => false,
//					"override" => "category,courses_group,post,page",
//					"std" => "yes",
//					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
//					"type" => "switch"),

		"menu_user" => array(
					"title" => __('Select user menu',  'ancora'),
					"desc" => __('Select user menu for the current page',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "default",
					"options" => $ANCORA_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"show_contact_info" => array(
					"title" => __('Show contact info', 'ancora'),
					"desc" => __("Show the contact details for the owner of the site at the top left corner of the page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_languages" => array(
					"title" => __('Show language selector', 'ancora'),
					"desc" => __('Show language selector in the user menu (if WPML plugin installed and current page/post has multilanguage version)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_login" => array( 
					"title" => __('Show Login/Logout buttons', 'ancora'),
					"desc" => __('Show Login and Logout buttons in the user menu area', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_bookmarks" => array(
					"title" => __('Show bookmarks', 'ancora'),
					"desc" => __('Show bookmarks selector in the user menu', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		

		
		"info_custom_9" => array( 
					"title" => __("Table of Contents (TOC)", 'ancora'),
					"desc" => __("Table of Contents for the current page. Automatically created if the page contains objects with id starting with 'toc_'", 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"menu_toc" => array( 
					"title" => __('TOC position', 'ancora'),
					"desc" => __('Show TOC for the current page', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "float",
					"options" => array(
						'hide'  => __('Hide', 'ancora'),
						'fixed' => __('Fixed', 'ancora'),
						'float' => __('Float', 'ancora')
					),
					"type" => "checklist"),
		
		"menu_toc_home" => array(
					"title" => __('Add "Home" into TOC', 'ancora'),
					"desc" => __('Automatically add "Home" item into table of contents - return to home page of the site', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_toc_top" => array( 
					"title" => __('Add "To Top" into TOC', 'ancora'),
					"desc" => __('Automatically add "To Top" item into table of contents - scroll to top of the page', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		// Customization -> Sidebars
		//-------------------------------------------------
		
		"customization_sidebars" => array( 
					"title" => __('Sidebars', 'ancora'),
					"icon" => "iconadmin-indent-right",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		"info_custom_10" => array( 
					"title" => __('Custom sidebars', 'ancora'),
					"desc" => __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'ancora'),
					"type" => "info"),
		
		"custom_sidebars" => array(
					"title" => __('Custom sidebars',  'ancora'),
					"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'ancora'),
					"divider" => false,
					"std" => "",
					"cloneable" => true,
					"type" => "text"),
		
		"info_custom_11" => array(
					"title" => __('Sidebars settings', 'ancora'),
					"desc" => __('Show / Hide and Select sidebar in each location', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		'show_sidebar_main' => array( 
					"title" => __('Show main sidebar',  'ancora'),
					"desc" => __('Select style for the main sidebar or hide it',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "light",
					"options" => $ANCORA_GLOBALS['options_params']['list_sidebar_styles'],
					"dir" => "horizontal",
					"type" => "checklist"),
		
		'sidebar_main_position' => array( 
					"title" => __('Main sidebar position',  'ancora'),
					"desc" => __('Select main sidebar position on blog page',  'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "right",
					"options" => $ANCORA_GLOBALS['options_params']['list_positions'],
					"size" => "medium",
					"type" => "switch"),
		
		"sidebar_main" => array( 
					"title" => __('Select main sidebar',  'ancora'),
					"desc" => __('Select main sidebar for the blog page',  'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "sidebar_main",
					"options" => $ANCORA_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		"show_sidebar_footer" => array(
					"title" => __('Show footer sidebar', 'ancora'),
					"desc" => __('Select style for the footer sidebar or hide it', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "light",
					"options" => $ANCORA_GLOBALS['options_params']['list_sidebar_styles'],
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"sidebar_footer" => array( 
					"title" => __('Select footer sidebar',  'ancora'),
					"desc" => __('Select footer sidebar for the blog page',  'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "sidebar_footer",
					"options" => $ANCORA_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),


		"sidebar_footer_columns" => array( 
					"title" => __('Footer sidebar columns',  'ancora'),
					"desc" => __('Select columns number for the footer sidebar',  'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => 3,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),

            "show_sidebar_footer2" => array(
                "title" => __('Show additional footer sidebar', 'ancora'),
                "desc" => __('Select style for the additional footer sidebar or hide it', 'ancora'),
                "override" => "category,courses_group,post,page",
                "std" => "light",
                "options" => $ANCORA_GLOBALS['options_params']['list_sidebar_styles'],
                "dir" => "horizontal",
                "type" => "checklist"),

            "sidebar_footer2" => array(
                "title" => __('Select additional footer sidebar',  'ancora'),
                "desc" => __('Select additional footer sidebar for the blog page',  'ancora'),
                "override" => "category,courses_group,post,page",
                "divider" => false,
                "std" => "sidebar_footer2",
                "options" => $ANCORA_GLOBALS['options_params']['list_sidebars'],
                "type" => "select"),

            "sidebar_footer2_columns" => array(
                "title" => __('Footer additional sidebar columns',  'ancora'),
                "desc" => __('Select columns number for the additional footer sidebar',  'ancora'),
                "override" => "category,courses_group,post,page",
                "divider" => false,
                "std" => 3,
                "min" => 1,
                "max" => 6,
                "type" => "spinner"),
		
		
		
		
		// Customization -> Slider
		//-------------------------------------------------
		
		"customization_slider" => array( 
					"title" => __('Slider', 'ancora'),
					"icon" => "iconadmin-picture",
					"override" => "category,courses_group,page",
					"type" => "tab"),
		
		"info_custom_13" => array(
					"title" => __('Main slider parameters', 'ancora'),
					"desc" => __('Select parameters for main slider (you can override it in each category and page)', 'ancora'),
					"override" => "category,courses_group,page",
					"type" => "info"),
					
		"show_slider" => array(
					"title" => __('Show Slider', 'ancora'),
					"desc" => __('Do you want to show slider on each page (post)', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_display" => array(
					"title" => __('Slider display', 'ancora'),
					"desc" => __('How display slider: boxed (fixed width and height), fullwide (fixed height) or fullscreen', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "none",
					"options" => array(
						"boxed"=>__("Boxed", 'ancora'),
						"fullwide"=>__("Fullwide", 'ancora'),
						"fullscreen"=>__("Fullscreen", 'ancora')
					),
					"type" => "checklist"),
		
		"slider_height" => array(
					"title" => __("Height (in pixels)", 'ancora'),
					"desc" => __("Slider height (in pixels) - only if slider display with fixed height.", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => '',
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"slider_engine" => array(
					"title" => __('Slider engine', 'ancora'),
					"desc" => __('What engine use to show slider?', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "flex",
					"options" => $ANCORA_GLOBALS['options_params']['list_sliders'],
					"type" => "radio"),
		
		"slider_alias" => array(
					"title" => __('Layer Slider: Alias (for Revolution) or ID (for Royal)',  'ancora'),
					"desc" => __("Revolution Slider alias or Royal Slider ID (see in slider settings on plugin page)", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "",
					"type" => "text"),
		
		"slider_category" => array(
					"title" => __('Posts Slider: Category to show', 'ancora'),
					"desc" => __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "",
					"options" => ancora_array_merge(array(0 => __('- Select category -', 'ancora')), $ANCORA_GLOBALS['options_params']['list_categories']),
					"type" => "select",
					"multiple" => true,
					"style" => "list"),
		
		"slider_posts" => array(
					"title" => __('Posts Slider: Number posts or comma separated posts list',  'ancora'),
					"desc" => __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "5",
					"type" => "text"),
		"slider_orderby" => array(
					"title" => __("Posts Slider: Posts order by",  'ancora'),
					"desc" => __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $ANCORA_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"slider_order" => array(
					"title" => __("Posts Slider: Posts order", 'ancora'),
					"desc" => __('Select the desired ordering method for posts', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $ANCORA_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
					
		"slider_interval" => array(
					"title" => __("Posts Slider: Slide change interval", 'ancora'),
					"desc" => __("Interval (in ms) for slides change in slider", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => 7000,
					"min" => 100,
					"step" => 100,
					"type" => "spinner"),
		
		"slider_pagination" => array(
					"title" => __("Posts Slider: Pagination", 'ancora'),
					"desc" => __("Choose pagination style for the slider", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => array(
						'no'   => __('None', 'ancora'),
						'yes'  => __('Dots', 'ancora'),
						'over' => __('Titles', 'ancora')
					),
					"type" => "checklist"),
		
		"slider_infobox" => array(
					"title" => __("Posts Slider: Show infobox", 'ancora'),
					"desc" => __("Do you want to show post's title, reviews rating and description on slides in slider", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "slide",
					"options" => array(
						'no'    => __('None',  'ancora'),
						'slide' => __('Slide', 'ancora'),
						'fixed' => __('Fixed', 'ancora')
					),
					"type" => "checklist"),
					
		"slider_info_category" => array(
					"title" => __("Posts Slider: Show post's category", 'ancora'),
					"desc" => __("Do you want to show post's category on slides in slider", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_reviews" => array(
					"title" => __("Posts Slider: Show post's reviews rating", 'ancora'),
					"desc" => __("Do you want to show post's reviews rating on slides in slider", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_descriptions" => array(
					"title" => __("Posts Slider: Show post's descriptions", 'ancora'),
					"desc" => __("How many characters show in the post's description in slider. 0 - no descriptions", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => 0,
					"min" => 0,
					"step" => 10,
					"type" => "spinner"),
		
		
		
		
		// Customization -> Header & Footer
		//-------------------------------------------------
		
		'customization_header_footer' => array(
					"title" => __("Header &amp; Footer", 'ancora'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		
		"info_footer_1" => array(
					"title" => __("Header settings", 'ancora'),
					"desc" => __("Select components of the page header, set style and put the content for the user's header area", 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),

        "disclaimer" => array(
                    "title" => __('Disclaimer in top',  'ancora'),
                    "desc" => __("Enter disclaimer in top", 'ancora'),
                    "std" => "",
                    "type" => "text"),

        "show_flower_block" => array(
                    "title" => __("Show flower block", 'ancora'),
                    "desc" => __("Show flower block", 'ancora'),
                    "override" => "category,courses_group,page,post",
                    "std" => "yes",
                    "options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
                    "type" => "switch"),
        'flower_image' => array(
                    "title" => __('Image for flower block',  'ancora'),
                    "desc" => __('Select or upload image for flower block',  'ancora'),
                    "override" => "category,courses_group,post,page",
                    "std" => "",
                    "type" => "media"
                   ),
        "flower_title" => array(
                    "title" => __('Flower title',  'ancora'),
                    "desc" => __("Flower title text", 'ancora'),
                    "std" => "",
                    "divider" => false,
                    "type" => "text"),
        "text_under_flower_title" => array(
                    "title" => __('Text under flower title',  'ancora'),
                    "desc" => __("Text under flower title", 'ancora'),
                    "std" => "",
                    "divider" => false,
                    "type" => "text"),

        "show_number_block" => array(
                    "title" => __("Show phone block", 'ancora'),
                    "desc" => __("Show phone block", 'ancora'),
                    "override" => "category,courses_group,page,post",
                    "std" => "yes",
                    "options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
                    "type" => "switch"),
        'number_image' => array(
                    "title" => __('Image for phone block',  'ancora'),
                    "desc" => __('Select or upload image for phone block',  'ancora'),
                    "override" => "category,courses_group,post,page",
                    "std" => "",
                    "type" => "media"
                    ),
        "text_under_number_title" => array(
                    "title" => __('Text under number title',  'ancora'),
                    "desc" => __("Text under number title", 'ancora'),
                    "std" => "",
                    "divider" => false,
                    "type" => "text"),
    	"show_user_header" => array(
					"title" => __("Show user's header", 'ancora'),
					"desc" => __("Show custom user's header", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"user_header_content" => array(
					"title" => __("User's header content", 'ancora'),
					"desc" => __('Put header html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"rows" => "10",
					"type" => "editor"),
		
		"show_page_top" => array(
					"title" => __('Show Top of page section', 'ancora'),
					"desc" => __('Show top section with post/page/category title and breadcrumbs', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_page_title" => array(
					"title" => __('Show Page title', 'ancora'),
					"desc" => __('Show post/page/category title', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_breadcrumbs" => array(
					"title" => __('Show Breadcrumbs', 'ancora'),
					"desc" => __('Show path to current category (post, page)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"breadcrumbs_max_level" => array(
					"title" => __('Breadcrumbs max nesting', 'ancora'),
					"desc" => __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'ancora'),
					"std" => "0",
					"min" => 0,
					"max" => 100,
					"step" => 1,
					"type" => "spinner"),
		
		
		
		
		"info_footer_2" => array(
					"title" => __("Footer settings", 'ancora'),
					"desc" => __("Select components of the footer, set style and put the content for the user's footer area", 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"show_user_footer" => array(
					"title" => __("Show user's footer", 'ancora'),
					"desc" => __("Show custom user's footer", 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"user_footer_content" => array(
					"title" => __("User's footer content", 'ancora'),
					"desc" => __('Put footer html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"rows" => "10",
					"type" => "editor"),
		
		"show_contacts_in_footer" => array(
					"title" => __('Show Contacts in footer', 'ancora'),
					"desc" => __('Show contact information area in footer: site logo, contact info and large social icons', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "dark",
					"options" => array(
						'hide' 	=> __('Hide', 'ancora'),
						'light'	=> __('Light', 'ancora'),
						'dark'	=> __('Dark', 'ancora')
					),
					"dir" => "horizontal",
					"type" => "checklist"),

		"show_copyright_in_footer" => array(
					"title" => __('Show Copyright area in footer', 'ancora'),
					"desc" => __('Show area with copyright information and small social icons in footer', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"footer_copyright" => array(
					"title" => __('Footer copyright text',  'ancora'),
					"desc" => __("Copyright text to show in footer area (bottom of site)", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "Ancora &copy; 2014 All Rights Reserved ",
					"rows" => "10",
					"type" => "editor"),
		
		
		"info_footer_3" => array(
					"title" => __('Testimonials in Footer', 'ancora'),
					"desc" => __('Select parameters for Testimonials in the Footer (you can override it in each category and page)', 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),

		"show_testimonials_in_footer" => array(
					"title" => __('Show Testimonials in footer', 'ancora'),
					"desc" => __('Show Testimonials slider in footer. For correct operation of the slider (and shortcode testimonials) you must fill out Testimonials posts on the menu "Testimonials"', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "none",
					"options" => $ANCORA_GLOBALS['options_params']['list_tints'],
					"type" => "checklist"),

		"testimonials_count" => array( 
					"title" => __('Testimonials count', 'ancora'),
					"desc" => __('Number testimonials to show', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),

		"testimonials_bg_image" => array( 
					"title" => __('Testimonials bg image', 'ancora'),
					"desc" => __('Select image or put image URL from other site to use it as testimonials block background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"readonly" => false,
					"std" => "",
					"type" => "media"),

		"testimonials_bg_color" => array( 
					"title" => __('Testimonials bg color', 'ancora'),
					"desc" => __('Select color to use it as testimonials block background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"testimonials_bg_overlay" => array( 
					"title" => __('Testimonials bg overlay', 'ancora'),
					"desc" => __('Select background color opacity to create overlay effect on background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => 0,
					"step" => 0.1,
					"min" => 0,
					"max" => 1,
					"type" => "spinner"),
		
		
		"info_footer_4" => array(
					"title" => __('Twitter in Footer', 'ancora'),
					"desc" => __('Select parameters for Twitter stream in the Footer (you can override it in each category and page)', 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),

		"show_twitter_in_footer" => array(
					"title" => __('Show Twitter in footer', 'ancora'),
					"desc" => __('Show Twitter slider in footer. For correct operation of the slider (and shortcode twitter) you must fill out the Twitter API keys on the menu "Appearance - Theme Options - Socials"', 'ancora'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "none",
					"options" => $ANCORA_GLOBALS['options_params']['list_tints'],
					"type" => "checklist"),

		"twitter_count" => array( 
					"title" => __('Twitter count', 'ancora'),
					"desc" => __('Number twitter to show', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),

		"twitter_bg_image" => array( 
					"title" => __('Twitter bg image', 'ancora'),
					"desc" => __('Select image or put image URL from other site to use it as Twitter block background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"),

		"twitter_bg_color" => array( 
					"title" => __('Twitter bg color', 'ancora'),
					"desc" => __('Select color to use it as Twitter block background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"twitter_bg_overlay" => array( 
					"title" => __('Twitter bg overlay', 'ancora'),
					"desc" => __('Select background color opacity to create overlay effect on background', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => 0,
					"step" => 0.1,
					"min" => 0,
					"max" => 1,
					"type" => "spinner"),


		"info_footer_5" => array(
					"title" => __('Google map parameters', 'ancora'),
					"desc" => __('Select parameters for Google map (you can override it in each category and page)', 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
					
		"show_googlemap" => array(
					"title" => __('Show Google Map', 'ancora'),
					"desc" => __('Do you want to show Google map on each page (post)', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"googlemap_height" => array(
					"title" => __("Map height", 'ancora'),
					"desc" => __("Map height (default - in pixels, allows any CSS units of measure)", 'ancora'),
					"override" => "category,courses_group,page",
					"std" => 400,
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"googlemap_address" => array(
					"title" => __('Address to show on map',  'ancora'),
					"desc" => __("Enter address to show on map center", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"type" => "text"),
        "googlemap_description" => array(
                    "title" => __('Description to show on map',  'ancora'),
                    "desc" => __("Description to show on map", 'ancora'),
                    "override" => "category,courses_group,page,post",
                    "std" => "",
                    "type" => "text"),
		"googlemap_latlng" => array(
					"title" => __('Latitude and Longtitude to show on map',  'ancora'),
					"desc" => __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"type" => "text"),
		
		"googlemap_zoom" => array(
					"title" => __('Google map initial zoom',  'ancora'),
					"desc" => __("Enter desired initial zoom for Google map", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => 16,
					"min" => 1,
					"max" => 20,
					"step" => 1,
					"type" => "spinner"),
		
		"googlemap_style" => array(
					"title" => __('Google map style',  'ancora'),
					"desc" => __("Select style to show Google map", 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => 'style1',
					"options" => $ANCORA_GLOBALS['options_params']['list_gmap_styles'],
					"type" => "select"),
		
		"googlemap_marker" => array(
					"title" => __('Google map marker',  'ancora'),
					"desc" => __("Select or upload png-image with Google map marker", 'ancora'),
					"std" => '',
					"type" => "media"),
		
		
		
		
		// Customization -> Media
		//-------------------------------------------------
		
		'customization_media' => array(
					"title" => __('Media', 'ancora'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-picture',
					"type" => "tab"),
		
		"info_media_1" => array(
					"title" => __('Retina ready', 'ancora'),
					"desc" => __("Additional parameters for the Retina displays", 'ancora'),
					"type" => "info"),
					
		"retina_ready" => array(
					"title" => __('Image dimensions', 'ancora'),
					"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'ancora'),
					"divider" => false,
					"std" => "1",
					"size" => "medium",
					"options" => array("1"=>__("Original", 'ancora'), "2"=>__("Retina", 'ancora')),
					"type" => "switch"),
		
		"info_media_2" => array(
					"title" => __('Media Substitution parameters', 'ancora'),
					"desc" => __("Set up the media substitution parameters and slider's options", 'ancora'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"substitute_gallery" => array(
					"title" => __('Substitute standard Wordpress gallery', 'ancora'),
					"desc" => __('Substitute standard Wordpress gallery with our slider on the single pages', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"substitute_slider_engine" => array(
					"title" => __('Substitution Slider engine', 'ancora'),
					"desc" => __('What engine use to show slider instead standard gallery?', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "swiper",
					"options" => array(
						//"chop" => __("Chop slider", 'ancora'),
						"swiper" => __("Swiper slider", 'ancora')
					),
					"type" => "radio"),
		
		"gallery_instead_image" => array(
					"title" => __('Show gallery instead featured image', 'ancora'),
					"desc" => __('Show slider with gallery instead featured image on blog streampage and in the related posts section for the gallery posts', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gallery_max_slides" => array(
					"title" => __('Max images number in the slider', 'ancora'),
					"desc" => __('Maximum images number from gallery into slider', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "5",
					"min" => 2,
					"max" => 10,
					"type" => "spinner"),
		
		"popup_engine" => array(
					"title" => __('Gallery popup engine', 'ancora'),
					"desc" => __('Select engine to show popup windows with galleries', 'ancora'),
					"std" => "magnific",
					"options" => $ANCORA_GLOBALS['options_params']['list_popups'],
					"type" => "select"),
		
		"popup_gallery" => array(
					"title" => __('Enable Gallery mode in the popup', 'ancora'),
					"desc" => __('Enable Gallery mode in the popup or show only single image', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		"substitute_audio" => array(
					"title" => __('Substitute audio tags', 'ancora'),
					"desc" => __('Substitute audio tag with source from soundcloud to embed player', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"substitute_video" => array(
					"title" => __('Substitute video tags', 'ancora'),
					"desc" => __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_mediaelement" => array(
					"title" => __('Use Media Element script for audio and video tags', 'ancora'),
					"desc" => __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		// Customization -> Typography
		//-------------------------------------------------
		
		'customization_typography' => array(
					"title" => __("Typography", 'ancora'),
					"icon" => 'iconadmin-font',
					"type" => "tab"),
		
		"info_typo_1" => array(
					"title" => __('Typography settings', 'ancora'),
					"desc" => __('Select fonts, sizes and styles for the headings and paragraphs. You can use Google fonts and custom fonts.<br><br>How to install custom @font-face fonts into the theme?<br>All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!<br>Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.<br>Create your @font-face kit by using <a href="http://www.fontsquirrel.com/fontface/generator">Fontsquirrel @font-face Generator</a> and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install.', 'ancora'),
					"type" => "info"),
		
		"typography_custom" => array(
					"title" => __('Use custom typography', 'ancora'),
					"desc" => __('Use custom font settings or leave theme-styled fonts', 'ancora'),
					"divider" => false,
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"typography_h1_font" => array(
					"title" => __('Heading 1', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h1_size" => array(
					"title" => __('Size', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "48",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h1_lineheight" => array(
					"title" => __('Line height', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "60",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h1_weight" => array(
					"title" => __('Weight', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h1_style" => array(
					"title" => __('Style', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h1_color" => array(
					"title" => __('Color', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h2_font" => array(
					"title" => __('Heading 2', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h2_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "36",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h2_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "43",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h2_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h2_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h2_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h3_font" => array(
					"title" => __('Heading 3', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h3_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "24",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h3_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "28",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h3_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h3_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h3_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h4_font" => array(
					"title" => __('Heading 4', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h4_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "20",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h4_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "24",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h4_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h4_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h4_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h5_font" => array(
					"title" => __('Heading 5', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h5_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "18",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h5_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "20",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h5_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h5_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h5_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h6_font" => array(
					"title" => __('Heading 6', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h6_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "16",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h6_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "18",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h6_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h6_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h6_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_p_font" => array(
					"title" => __('Paragraph text', 'ancora'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Source Sans Pro",
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_p_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "14",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_p_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "21",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_p_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "300",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_p_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $ANCORA_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_p_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8 last",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		
		
		
		
		
		
		
		
		
		
		
		//###############################
		//#### Blog and Single pages #### 
		//###############################
		"partition_blog" => array(
					"title" => __('Blog &amp; Single', 'ancora'),
					"icon" => "iconadmin-docs",
					"override" => "category,courses_group,post,page",
					"type" => "partition"),
		
		
		
		// Blog -> Stream page
		//-------------------------------------------------
		
		'blog_tab_stream' => array(
					"title" => __('Stream page', 'ancora'),
					"start" => 'blog_tabs',
					"icon" => "iconadmin-docs",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		"info_blog_1" => array(
					"title" => __('Blog streampage parameters', 'ancora'),
					"desc" => __('Select desired blog streampage parameters (you can override it in each category)', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"blog_style" => array(
					"title" => __('Blog style', 'ancora'),
					"desc" => __('Select desired blog style', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,page",
					"std" => "excerpt",
					"options" => $ANCORA_GLOBALS['options_params']['list_blog_styles'],
					"type" => "select"),
		
		"article_style" => array(
					"title" => __('Article style', 'ancora'),
					"desc" => __('Select article display method: boxed or stretch', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "stretch",
					"options" => $ANCORA_GLOBALS['options_params']['list_article_styles'],
					"size" => "medium",
					"type" => "switch"),
		
		"hover_style" => array(
					"title" => __('Hover style', 'ancora'),
					"desc" => __('Select desired hover style (only for Blog style = Portfolio)', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "square effect_shift",
					"options" => $ANCORA_GLOBALS['options_params']['list_hovers'],
					"type" => "select"),
		
		"hover_dir" => array(
					"title" => __('Hover dir', 'ancora'),
					"desc" => __('Select hover direction (only for Blog style = Portfolio and Hover style = Circle or Square)', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "left_to_right",
					"options" => $ANCORA_GLOBALS['options_params']['list_hovers_dir'],
					"type" => "select"),
		
		"dedicated_location" => array(
					"title" => __('Dedicated location', 'ancora'),
					"desc" => __('Select location for the dedicated content or featured image in the "excerpt" blog style', 'ancora'),
					"override" => "category,courses_group,page,post",
					"std" => "default",
					"options" => $ANCORA_GLOBALS['options_params']['list_locations'],
					"type" => "select"),
		
		"show_filters" => array(
					"title" => __('Show filters', 'ancora'),
					"desc" => __('Show filter buttons (only for Blog style = Portfolio, Masonry, Classic)', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "hide",
					"options" => $ANCORA_GLOBALS['options_params']['list_filters'],
					"type" => "checklist"),
		
		"blog_sort" => array(
					"title" => __('Blog posts sorted by', 'ancora'),
					"desc" => __('Select the desired sorting method for posts', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $ANCORA_GLOBALS['options_params']['list_sorting'],
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_order" => array(
					"title" => __('Blog posts order', 'ancora'),
					"desc" => __('Select the desired ordering method for posts', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $ANCORA_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"posts_per_page" => array(
					"title" => __('Blog posts per page',  'ancora'),
					"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'ancora'),
					"override" => "category,courses_group,page",
					"std" => "12",
					"mask" => "?99",
					"type" => "text"),
		
		"post_excerpt_maxlength" => array(
					"title" => __('Excerpt(Obituaries) maxlength for streampage',  'ancora'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'ancora'),
					"override" => "category,courses_group,page",
					"std" => "250",
					"mask" => "?9999",
					"type" => "text"),
		
		"post_excerpt_maxlength_masonry" => array(
					"title" => __('Excerpt maxlength for classic and masonry',  'ancora'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'ancora'),
					"override" => "category,courses_group,page",
					"std" => "150",
					"mask" => "?9999",
					"type" => "text"),


            // Blog -> Single page
		//-------------------------------------------------
		
		'blog_tab_single' => array(
					"title" => __('Single page', 'ancora'),
					"icon" => "iconadmin-doc",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		
		"info_blog_2" => array(
					"title" => __('Single (detail) pages parameters', 'ancora'),
					"desc" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'ancora'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"single_style" => array(
					"title" => __('Single page style', 'ancora'),
					"desc" => __('Select desired style for single page', 'ancora'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "single-standard",
					"options" => $ANCORA_GLOBALS['options_params']['list_single_styles'],
					"dir" => "horizontal",
					"type" => "radio"),
		
		"allow_editor" => array(
					"title" => __('Frontend editor',  'ancora'),
					"desc" => __("Allow authors to edit their posts in frontend area)", 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_featured_image" => array(
					"title" => __('Show featured image before post',  'ancora'),
					"desc" => __("Show featured image (if selected) before post content on single pages", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title" => array(
					"title" => __('Show post title', 'ancora'),
					"desc" => __('Show area with post title on single pages', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title_on_quotes" => array(
					"title" => __('Show post title on links, chat, quote, status', 'ancora'),
					"desc" => __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_info" => array(
					"title" => __('Show post info', 'ancora'),
					"desc" => __('Show area with post info on single pages', 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_text_before_readmore" => array(
					"title" => __('Show text before "Read more" tag', 'ancora'),
					"desc" => __('Show text before "Read more" tag on single pages', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"show_post_author" => array(
					"title" => __('Show post author details',  'ancora'),
					"desc" => __("Show post author information block on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_tags" => array(
					"title" => __('Show post tags',  'ancora'),
					"desc" => __("Show tags block on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_counters" => array(
					"title" => __('Show post counters',  'ancora'),
					"desc" => __("Show counters block on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_related" => array(
					"title" => __('Show related posts',  'ancora'),
					"desc" => __("Show related posts block on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"post_related_count" => array(
					"title" => __('Related posts number',  'ancora'),
					"desc" => __("How many related posts showed on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "2",
					"step" => 1,
					"min" => 2,
					"max" => 8,
					"type" => "spinner"),

		"post_related_columns" => array(
					"title" => __('Related posts columns',  'ancora'),
					"desc" => __("How many columns used to show related posts on single post page. 1 - use scrolling to show all related posts", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "2",
					"step" => 1,
					"min" => 1,
					"max" => 4,
					"type" => "spinner"),
		
		"post_related_sort" => array(
					"title" => __('Related posts sorted by', 'ancora'),
					"desc" => __('Select the desired sorting method for related posts', 'ancora'),
		//			"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $ANCORA_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"post_related_order" => array(
					"title" => __('Related posts order', 'ancora'),
					"desc" => __('Select the desired ordering method for related posts', 'ancora'),
		//			"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $ANCORA_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"show_post_comments" => array(
					"title" => __('Show comments',  'ancora'),
					"desc" => __("Show comments block on single post page", 'ancora'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		// Blog -> Other parameters
		//-------------------------------------------------
		
		'blog_tab_general' => array(
					"title" => __('Other parameters', 'ancora'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,courses_group,page",
					"type" => "tab"),
		
		"info_blog_3" => array(
					"title" => __('Other Blog parameters', 'ancora'),
					"desc" => __('Select excluded categories, substitute parameters, etc.', 'ancora'),
					"type" => "info"),
		
		"exclude_cats" => array(
					"title" => __('Exclude categories', 'ancora'),
					"desc" => __('Select categories, which posts are exclude from blog page', 'ancora'),
					"divider" => false,
					"std" => "",
					"options" => $ANCORA_GLOBALS['options_params']['list_categories'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"blog_pagination" => array(
					"title" => __('Blog pagination', 'ancora'),
					"desc" => __('Select type of the pagination on blog streampages', 'ancora'),
					"std" => "pages",
					"override" => "category,courses_group,page",
					"options" => array(
						'pages'    => __('Standard page numbers', 'ancora')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_pagination_style" => array(
					"title" => __('Blog pagination style', 'ancora'),
					"desc" => __('Select pagination style for standard page numbers', 'ancora'),
					"std" => "pages",
					"override" => "category,courses_group,page",
					"options" => array(
						'pages'  => __('Page numbers list', 'ancora'),
						'slider' => __('Slider with page numbers', 'ancora')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_counters" => array(
					"title" => __('Blog counters', 'ancora'),
					"desc" => __('Select counters, displayed near the post title', 'ancora'),
					"std" => "views",
					"override" => "category,courses_group,page",
					"options" => array(
						'views' => __('Views', 'ancora'),
						'likes' => __('Likes', 'ancora'),
						'rating' => __('Rating', 'ancora'),
						'comments' => __('Comments', 'ancora')
					),
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),
		
		"close_category" => array(
					"title" => __("Post's category announce", 'ancora'),
					"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'ancora'),
					"std" => "parental",
					"override" => "category,courses_group,page",
					"options" => array(
						'parental' => __('Nearest parental category', 'ancora'),
						'original' => __("Original post's category", 'ancora')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"show_date_after" => array(
					"title" => __('Show post date after', 'ancora'),
					"desc" => __('Show post date after N days (before - show post age)', 'ancora'),
					"override" => "category,courses_group,page",
					"std" => "30",
					"mask" => "?99",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Reviews               #### 
		//###############################
		"partition_reviews" => array(
					"title" => __('Reviews', 'ancora'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,courses_group",
					"type" => "partition"),
		
		"info_reviews_1" => array(
					"title" => __('Reviews criterias', 'ancora'),
					"desc" => __('Set up list of reviews criterias. You can override it in any category.', 'ancora'),
					"override" => "category,courses_group",
					"type" => "info"),
		
		"show_reviews" => array(
					"title" => __('Show reviews block',  'ancora'),
					"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'ancora'),
					"divider" => false,
					"override" => "category,courses_group",
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"reviews_max_level" => array(
					"title" => __('Max reviews level',  'ancora'),
					"desc" => __("Maximum level for reviews marks", 'ancora'),
					"std" => "5",
					"options" => array(
						'5'=>__('5 stars', 'ancora'),
						'10'=>__('10 stars', 'ancora'),
						'100'=>__('100%', 'ancora')
					),
					"type" => "radio",
					),
		
		"reviews_style" => array(
					"title" => __('Show rating as',  'ancora'),
					"desc" => __("Show rating marks as text or as stars/progress bars.", 'ancora'),
					"std" => "stars",
					"options" => array(
						'text' => __('As text (for example: 7.5 / 10)', 'ancora'),
						'stars' => __('As stars or bars', 'ancora')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"reviews_criterias_levels" => array(
					"title" => __('Reviews Criterias Levels', 'ancora'),
					"desc" => __('Words to mark criterials levels. Just write the word and press "Enter". Also you can arrange words.', 'ancora'),
					"std" => __("bad,poor,normal,good,great", 'ancora'),
					"type" => "tags"),
		
		"reviews_first" => array(
					"title" => __('Show first reviews',  'ancora'),
					"desc" => __("What reviews will be displayed first: by author or by visitors. Also this type of reviews will display under post's title.", 'ancora'),
					"std" => "author",
					"options" => array(
						'author' => __('By author', 'ancora'),
						'users' => __('By visitors', 'ancora')
						),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_second" => array(
					"title" => __('Hide second reviews',  'ancora'),
					"desc" => __("Do you want hide second reviews tab in widgets and single posts?", 'ancora'),
					"std" => "show",
					"options" => $ANCORA_GLOBALS['options_params']['list_show_hide'],
					"size" => "medium",
					"type" => "switch"),
		
		"reviews_can_vote" => array(
					"title" => __('What visitors can vote',  'ancora'),
					"desc" => __("What visitors can vote: all or only registered", 'ancora'),
					"std" => "all",
					"options" => array(
						'all'=>__('All visitors', 'ancora'),
						'registered'=>__('Only registered', 'ancora')
					),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_criterias" => array(
					"title" => __('Reviews criterias',  'ancora'),
					"desc" => __('Add default reviews criterias.',  'ancora'),
					"override" => "category,courses_group",
					"std" => "",
					"cloneable" => true,
					"type" => "text"),

		"reviews_marks" => array(
					"std" => "",
					"type" => "hidden"),
		
		
		
		
		
		//###############################
		//#### Contact info          #### 
		//###############################
		"partition_contacts" => array(
					"title" => __('Contact info', 'ancora'),
					"icon" => "iconadmin-mail",
					"type" => "partition"),
		
		"info_contact_1" => array(
					"title" => __('Contact information', 'ancora'),
					"desc" => __('Company address, phones and e-mail', 'ancora'),
					"type" => "info"),
		
		"contact_email" => array(
					"title" => __('Contact form email', 'ancora'),
					"desc" => __('E-mail for send contact form and user registration data', 'ancora'),
					"divider" => false,
					"std" => "",
					"before" => array('icon'=>'iconadmin-mail'),
					"type" => "text"),
		
		"contact_address_1" => array(
					"title" => __('Company address (part 1)', 'ancora'),
					"desc" => __('Company country, post code and city', 'ancora'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_address_2" => array(
					"title" => __('Company address (part 2)', 'ancora'),
					"desc" => __('Street and house number', 'ancora'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_phone" => array(
					"title" => __('Phone', 'ancora'),
					"desc" => __('Phone number', 'ancora'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		
		"contact_fax" => array(
					"title" => __('Fax', 'ancora'),
					"desc" => __('Fax number', 'ancora'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		
		"contact_info" => array(
					"title" => __('Contacts in header', 'ancora'),
					"desc" => __('String with contact info in the site header', 'ancora'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"info_contact_2" => array(
					"title" => __('Contact and Comments form', 'ancora'),
					"desc" => __('Maximum length of the messages in the contact form shortcode and in the comments form', 'ancora'),
					"type" => "info"),
		
		"message_maxlength_contacts" => array(
					"title" => __('Contact form message', 'ancora'),
					"desc" => __("Message's maxlength in the contact form shortcode", 'ancora'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"message_maxlength_comments" => array(
					"title" => __('Comments form message', 'ancora'),
					"desc" => __("Message's maxlength in the comments form", 'ancora'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"info_contact_3" => array(
					"title" => __('Default mail function', 'ancora'),
					"desc" => __('What function you want to use for sending mail: the built-in Wordpress wp_mail() or standard PHP mail() function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'ancora'),
					"type" => "info"),
		
		"mail_function" => array(
					"title" => __("Mail function", 'ancora'),
					"desc" => __("What function you want to use for sending mail?", 'ancora'),
					"std" => "wp_mail",
					"size" => "medium",
					"options" => array(
						'wp_mail' => __('WP mail', 'ancora'),
						'mail' => __('PHP mail', 'ancora')
					),
					"type" => "switch"),
		
		
		
		
		//###############################
		//#### Socials               #### 
		//###############################
		"partition_socials" => array(
					"title" => __('Socials', 'ancora'),
					"icon" => "iconadmin-users",
					"override" => "category,courses_group,page",
					"type" => "partition"),
		
		"info_socials_1" => array(
					"title" => __('Social networks', 'ancora'),
					"desc" => __("Social networks list for site footer and Social widget", 'ancora'),
					"type" => "info"),
		
		"social_icons" => array(
					"title" => __('Social networks',  'ancora'),
					"desc" => __('Select icon and write URL to your profile in desired social networks.',  'ancora'),
					"divider" => false,
					"std" => array(array('url'=>'', 'icon'=>'')),
					//"options" => $ANCORA_GLOBALS['options_params']['list_socials'],
                    "options" => $ANCORA_GLOBALS['options_params']['list_icons'],
                    //"options" => array ('icon-facebook','icon-twitter','icon-gplus', 'icon-skype'),
					"cloneable" => true,
					"size" => "small",
					"style" => 'icons',
					"type" => "socials"),
		
		"info_socials_2" => array(
					"title" => __('Share buttons', 'ancora'),
					"override" => "category,courses_group,page",
					"desc" => __("Add button's code for each social share network.<br>
					In share url you can use next macro:<br>
					<b>{url}</b> - share post (page) URL,<br>
					<b>{title}</b> - post title,<br>
					<b>{image}</b> - post image,<br>
					<b>{descr}</b> - post description (if supported)<br>
					For example:<br>
					<b>Facebook</b> share string: <em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em><br>
					<b>Delicious</b> share string: <em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>", 'ancora'),
					"type" => "info"),
		
		"show_share" => array(
					"title" => __('Show social share buttons',  'ancora'),
					"override" => "category,courses_group,page",
					"desc" => __("Show social share buttons block", 'ancora'),
					"std" => "horizontal",
					"options" => array(
						'hide'		=> __('Hide', 'ancora'),
						'vertical'	=> __('Vertical', 'ancora'),
						'horizontal'=> __('Horizontal', 'ancora')
					),
					"type" => "checklist"),

		"show_share_counters" => array(
					"title" => __('Show share counters',  'ancora'),
					"override" => "category,courses_group,page",
					"desc" => __("Show share counters after social buttons", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"share_caption" => array(
					"title" => __('Share block caption',  'ancora'),
					"override" => "category,courses_group,page",
					"desc" => __('Caption for the block with social share buttons',  'ancora'),
					"std" => __('Share:', 'ancora'),
					"type" => "text"),
		
		"share_buttons" => array(
					"title" => __('Share buttons',  'ancora'),
					"desc" => __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'ancora'),
					"std" => array(array('url'=>'', 'icon'=>'')),
//					"options" => $ANCORA_GLOBALS['options_params']['list_socials'],
                    "options" => $ANCORA_GLOBALS['options_params']['list_icons'],
					"cloneable" => true,
					"size" => "small",
					"style" => 'icons',
					"type" => "socials"),
		
		
		"info_socials_3" => array(
					"title" => __('Twitter API keys', 'ancora'),
					"desc" => __("Put to this section Twitter API 1.1 keys.<br>
					You can take them after registration your application in <strong>https://apps.twitter.com/</strong>", 'ancora'),
					"type" => "info"),
		
		"twitter_username" => array(
					"title" => __('Twitter username',  'ancora'),
					"desc" => __('Your login (username) in Twitter',  'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_key" => array(
					"title" => __('Consumer Key',  'ancora'),
					"desc" => __('Twitter API Consumer key',  'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_secret" => array(
					"title" => __('Consumer Secret',  'ancora'),
					"desc" => __('Twitter API Consumer secret',  'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_key" => array(
					"title" => __('Token Key',  'ancora'),
					"desc" => __('Twitter API Token key',  'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_secret" => array(
					"title" => __('Token Secret',  'ancora'),
					"desc" => __('Twitter API Token secret',  'ancora'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		
		
		
		
		
		
		//###############################
		//#### Search parameters     #### 
		//###############################
		"partition_search" => array(
					"title" => __('Search', 'ancora'),
					"icon" => "iconadmin-search",
					"type" => "partition"),
		
		"info_search_1" => array(
					"title" => __('Search parameters', 'ancora'),
					"desc" => __('Enable/disable AJAX search and output settings for it', 'ancora'),
					"type" => "info"),
		
		"show_search" => array(
					"title" => __('Show search field', 'ancora'),
					"desc" => __('Show search field in the top area and side menus', 'ancora'),
					"divider" => false,
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_ajax_search" => array(
					"title" => __('Enable AJAX search', 'ancora'),
					"desc" => __('Use incremental AJAX search for the search field in top of page', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_min_length" => array(
					"title" => __('Min search string length',  'ancora'),
					"desc" => __('The minimum length of the search string',  'ancora'),
					"std" => 4,
					"min" => 3,
					"type" => "spinner"),
		
		"ajax_search_delay" => array(
					"title" => __('Delay before search (in ms)',  'ancora'),
					"desc" => __('How much time (in milliseconds, 1000 ms = 1 second) must pass after the last character before the start search',  'ancora'),
					"std" => 500,
					"min" => 300,
					"max" => 1000,
					"step" => 100,
					"type" => "spinner"),
		
		"ajax_search_types" => array(
					"title" => __('Search area', 'ancora'),
					"desc" => __('Select post types, what will be include in search results. If not selected - use all types.', 'ancora'),
					"std" => "",
					"options" => $ANCORA_GLOBALS['options_params']['list_posts_types'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"ajax_search_posts_count" => array(
					"title" => __('Posts number in output',  'ancora'),
					"desc" => __('Number of the posts to show in search results',  'ancora'),
					"std" => 5,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		"ajax_search_posts_image" => array(
					"title" => __("Show post's image", 'ancora'),
					"desc" => __("Show post's thumbnail in the search results", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_date" => array(
					"title" => __("Show post's date", 'ancora'),
					"desc" => __("Show post's publish date in the search results", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_author" => array(
					"title" => __("Show post's author", 'ancora'),
					"desc" => __("Show post's author in the search results", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_counters" => array(
					"title" => __("Show post's counters", 'ancora'),
					"desc" => __("Show post's counters (views, comments, likes) in the search results", 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		//###############################
		//#### Service               #### 
		//###############################
		
		"partition_service" => array(
					"title" => __('Service', 'ancora'),
					"icon" => "iconadmin-wrench",
					"type" => "partition"),
		
		"info_service_1" => array(
					"title" => __('Theme functionality', 'ancora'),
					"desc" => __('Basic theme functionality settings', 'ancora'),
					"type" => "info"),
		
		"notify_about_new_registration" => array(
					"title" => __('Notify about new registration', 'ancora'),
					"desc" => __('Send E-mail with new registration data to the contact email or to site admin e-mail (if contact email is empty)', 'ancora'),
					"divider" => false,
					"std" => "no",
					"options" => array(
						'no'    => __('No', 'ancora'),
						'both'  => __('Both', 'ancora'),
						'admin' => __('Admin', 'ancora'),
						'user'  => __('User', 'ancora')
					),
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"use_ajax_views_counter" => array(
					"title" => __('Use AJAX post views counter', 'ancora'),
					"desc" => __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_add_filters" => array(
					"title" => __('Additional filters in the admin panel', 'ancora'),
					"desc" => __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_taxonomies" => array(
					"title" => __('Show overriden options for taxonomies', 'ancora'),
					"desc" => __('Show extra column in categories list, where changed (overriden) theme options are displayed.', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_posts" => array(
					"title" => __('Show overriden options for posts and pages', 'ancora'),
					"desc" => __('Show extra column in posts and pages list, where changed (overriden) theme options are displayed.', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"admin_dummy_data" => array(
					"title" => __('Enable Dummy Data Installer', 'ancora'),
					"desc" => __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_dummy_timeout" => array(
					"title" => __('Dummy Data Installer Timeout',  'ancora'),
					"desc" => __('Web-servers set the time limit for the execution of php-scripts. By default, this is 30 sec. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically! The import process will try to increase this limit to the time, specified in this field.',  'ancora'),
					"std" => 1200,
					"min" => 30,
					"max" => 1800,
					"type" => "spinner"),
		
		"admin_update_notifier" => array(
					"title" => __('Enable Update Notifier', 'ancora'),
					"desc" => __('Show update notifier in admin panel. <b>Attention!</b> When this option is enabled, the theme periodically (every few hours) will communicate with our server, to check the current version. When the connection is slow, it may slow down Dashboard.', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"admin_emailer" => array(
					"title" => __('Enable Emailer in the admin panel', 'ancora'),
					"desc" => __('Allow to use Ancora Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Emailer"', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_po_composer" => array(
					"title" => __('Enable PO Composer in the admin panel', 'ancora'),
					"desc" => __('Allow to use "PO Composer" for edit language files in this theme (in the "Appearance - PO Composer")', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"clear_shortcodes" => array(
					"title" => __('Remove line breaks around shortcodes', 'ancora'),
					"desc" => __('Do you want remove spaces and line breaks around shortcodes? <b>Be attentive!</b> This option thoroughly tested on our theme, but may affect third party plugins.', 'ancora'),
					"std" => "yes",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"debug_mode" => array(
					"title" => __('Debug mode', 'ancora'),
					"desc" => __('In debug mode we are using unpacked scripts and styles, else - using minified scripts and styles (if present). <b>Attention!</b> If you have modified the source code in the js or css files, regardless of this option will be used latest (modified) version stylesheets and scripts. You can re-create minified versions of files using on-line services (for example <a href="http://yui.2clics.net/" target="_blank">http://yui.2clics.net/</a>) or utility <b>yuicompressor-x.y.z.jar</b>', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"packed_scripts" => array(
					"title" => __('Use packed css and js files', 'ancora'),
					"desc" => __('Do you want to use one packed css and one js file with most theme scripts and styles instead many separate files (for speed up page loading). This reduces the number of HTTP requests when loading pages.', 'ancora'),
					"std" => "no",
					"options" => $ANCORA_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gtm_code" => array(
					"title" => __('Google tags manager or Google analitics code',  'ancora'),
					"desc" => __('Put here Google Tags Manager (GTM) code from your account: Google analitics, remarketing, etc. This code will be placed after open body tag.',  'ancora'),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),
		
		"gtm_code2" => array(
					"title" => __('Google remarketing code',  'ancora'),
					"desc" => __('Put here Google Remarketing code from your account. This code will be placed before close body tag.',  'ancora'),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),

        "info_service_2" => array(
                "title" => esc_html__('API Keys', 'ancora'),
                "desc" => wp_kses_data( __('API Keys for some Web services', 'ancora') ),
                "type" => "info"),
        'api_google' => array(
                "title" => esc_html__('Google API Key', 'ancora'),
                "desc" => wp_kses_data( __("Insert Google API Key for browsers into the field above to generate Google Maps", 'ancora') ),
                "std" => "",
                "type" => "text"),
		
		"info_service_3" => array(
					"title" => __('Clear Wordpress cache', 'ancora'),
					"desc" => __('For example, it recommended after activating the WPML plugin - in the cache are incorrect data about the structure of categories and your site may display "white screen". After clearing the cache usually the performance of the site is restored.', 'ancora'),
					"type" => "info"),
		
		"clear_cache" => array(
					"title" => __('Clear cache', 'ancora'),
					"desc" => __('Clear Wordpress cache data', 'ancora'),
					"divider" => false,
					"icon" => "iconadmin-trash",
					"action" => "clear_cache",
					"type" => "button")
		);



		
		
		
		//###############################################
		//#### Hidden fields (for internal use only) #### 
		//###############################################
		/*
		$ANCORA_GLOBALS['options']["custom_stylesheet_file"] = array(
			"title" => __('Custom stylesheet file', 'ancora'),
			"desc" => __('Path to the custom stylesheet (stored in the uploads folder)', 'ancora'),
			"std" => "",
			"type" => "hidden");
		
		$ANCORA_GLOBALS['options']["custom_stylesheet_url"] = array(
			"title" => __('Custom stylesheet url', 'ancora'),
			"desc" => __('URL to the custom stylesheet (stored in the uploads folder)', 'ancora'),
			"std" => "",
			"type" => "hidden");
		*/

	}
}
?>