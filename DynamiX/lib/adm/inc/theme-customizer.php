<?php
	
	function customizer_options($skin)
	{
		// Font List
		global $nv_font;
		
		$font_list[''] = 'Select Font Family';

		foreach( $nv_font as $font => $value )
		{
			$font_list[$value] = $font;
		}		
		
		if( of_get_option("nv_font_type") != "disable" && of_get_option("nv_font_type") != "enable" )
		{
			global $themeva_googlefont;
			
			$google_fonts['-'] = '----- Google Fonts -----';
			
			foreach( $themeva_googlefont as $font => $value )
			{
				$google_fonts[$font] = $font;
			}
			
			$font_list = $heading_font_list = array_merge( $font_list , $google_fonts );
			
		}
		elseif( of_get_option("nv_font_type") == "enable" )
		{
			global $themeva_cufonfont;

			$cufon_fonts['-'] = '----- Cufón Fonts -----';
			
			foreach( $themeva_cufonfont as $font => $value )
			{
				$cufon_fonts[$value] = $font;
			}
			
			$heading_font_list = array_merge( $font_list , $cufon_fonts );			
		}
		else
		{
			$heading_font_list = $font_list;
		}		

		// Get Admin Options
		$options = optionsframework_options();
		$priority = 0;
		
		$options_array = array(	
	
			/* ------------------------------------
			:: HEADER SECTION
			------------------------------------ */

			// Header Heading
			'global_header_heading'  => array(
				'name' 	  => 'global_header_heading',
				'label'   => __( 'Global Header Settings', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header_options',
				'priority' => $priority ++
			),	

			// Header Height
			'header_height' => array(
				'name'	  => 'themeva[header_height]',
				'label'   => __( 'Minimum Header Height', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '0',
				'section' => 'themeva_header_options',
				'css' 	  => '#header',
				'js'	  => 'css("min-height", to +"px")',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Branding Display
			'branding_disable'  => array(
				'name' 	  => 'themeva[branding_disable]',
				'label'   => __( 'Branding Display', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $options['branding_disable']['options'],
				'section' => 'themeva_header_options',
				'priority' => $priority ++
			),

			// Branding Alignment
			'branding_alignment'  => array(
				'name' 	  => 'themeva[branding_alignment]',
				'label'   => __( 'Branding Alignment', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $options['branding_alignment']['options'],
				'section' => 'themeva_header_options',
				'css' 	  => '#header-logo',
				'js'	  => 'removeClass("left right center").addClass( to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Branding Margin
			'branding_margin' => array(
				'name'	  => 'themeva[branding_margin]',
				'label'   => __( 'Branding Top Margin', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '-200',
				'default' => '',
				'section' => 'themeva_header_options',
				'css' 	  => '#primary-wrapper #header-logo',
				'js'	  => 'css("margin-top", to +"px")',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Menu Alignment
			'menu_alignment'  => array(
				'name' 	  => 'themeva[menu_alignment]',
				'label'   => __( 'Menu Alignment', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $options['menu_alignment']['options'],
				'section' => 'themeva_header_options',
				'css' 	  => '#nv-tabs',
				'js'	  => 'removeClass("left right center").addClass( to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Menu Margin
			'menu_margin' => array(
				'name'	  => 'themeva[menu_margin]',
				'label'   => __( 'Menu Top Margin', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '-200',
				'default' => '',
				'section' => 'themeva_header_options',
				'css' 	  => '#nv-tabs',
				'js'	  => 'css("margin-top", to +"px")',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	
		
		);
			
		$skin_options_array = array(		
			
			// Branding Version
			'branding_ver'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_branding_ver]',
				'label'   => __( 'Logo Version', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'primary' => 'Primary',
					'secondary' => 'Secondary',
				),
				'section' => 'themeva_background_1',
				'priority' => $priority ++
			),

			// Divider Shade Color
			'header_divider_shade'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_header_divider_shade]',
				'label'   => __( 'Divider Line Shade', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'light' => 'Light',
					'medium' => 'Medium',
					'dark' => 'Dark',
					'disabled' => 'No Line',
				),
				'section' => 'themeva_background_1',
				'live'	  => 'no',
				'priority' => $priority ++
			),	

			// Shadow
			'header_shadow'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_header_shadow]',
				'label'   => __( 'Shadow', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'enable' => 'Enable',
					'disable' => 'Disable',
				),
				'section' => 'themeva_background_1',
				'live'	  => 'no',
				'priority' => $priority ++
			),						

			// Header Heading
			'floatingheader_font_colors_heading'  => array(
				'name' 	  => 'floatingheader_font_colors_heading',
				'label'   => __( 'Transparent Header', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_colors',
				'priority' => '900'
			),			

			// Font Color
			'floatingheader_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_floatingheader_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.header_transparent .skinset-header.nv-skin,.header_transparent .skinset-header a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => '901'
			),	

			'floatingheader_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_floatingheader_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'priority' => '901'
			),				

			'floatingheader_branding_heading'  => array(
				'name' 	  => 'floatingheader_branding_heading',
				'label'   => __( 'Transparent Header Logo', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_background_1',
				'priority' => '900'
			),				

			// Branding Version
			'transparent_branding_ver'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_transparent_branding_ver]',
				'label'   => __( 'Transparent Logo', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Default',
					'primary' => 'Primary',
					'secondary' => 'Secondary',
				),
				'section' => 'themeva_background_1',
				'priority' => '902'
			),						
			

			/* ------------------------------------
			:: FOOTER SETTINGS
			------------------------------------ */

			// Divider Shade Color
			'footer_divider_shade'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_footer_divider_shade]',
				'label'   => __( 'Divider Line Shade', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'light' => 'Light',
					'medium' => 'Medium',
					'dark' => 'Dark',
					'disabled' => 'No Line',
				),
				'section' => 'themeva_background_2',
				'live'	  => 'no',
				'priority' => $priority ++
			),			

			// Shadow
			'footer_shadow'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_footer_shadow]',
				'label'   => __( 'Shadow', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'enable' => 'Enable',
					'disable' => 'Disable',
				),
				'section' => 'themeva_background_2',
				'live'	  => 'no',
				'priority' => $priority ++
			),				

			// Form Background Color
			'footer_form_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_form_color]',
				'label'   => __( 'Forms Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_2',
				'css' 	  => '.skinset-footer input[type=\"text\"],.skinset-footer input[type=\"password\"],.skinset-footer input[type=\"file\"],.skinset-footer textarea,.skinset-footer input',
				'js'	  => 'css("background-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Form Border
			'footer_form_border_color_tl' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_form_border_color_tl]',
				'label'   => __( 'Forms Border Color ( top + left )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_2',
				'css' 	  => '.skinset-footer input[type=\"text\"],.skinset-footer input[type=\"password\"],.skinset-footer input[type=\"file\"],.skinset-footer textarea,.skinset-footer input',
				'js'	  => 'css("border-top-color",to).css("border-left-color",to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Form Border
			'footer_form_border_color_br' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_form_border_color_br]',
				'label'   => __( 'Forms Border Color ( bottom + right )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_2',
				'css' 	  => '.skinset-footer input[type=\"text\"],.skinset-footer input[type=\"password\"],.skinset-footer input[type=\"file\"],.skinset-footer textarea,.skinset-footer input',
				'js'	  => 'css("border-bottom-color",to).css("border-right-color",to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),												


			// Submenu Background Color
			'submenu_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_panel_color]',
				'label'   => __( 'Sub-Menu Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'nav',
				'css' 	  => '#nv-tabs ul ul',
				'js'	  => 'css("background-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Submenu Border
			'submenu_border' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_panel_border_color]',
				'label'   => __( 'Sub-Menu Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'nav',
				'css' 	  => '#nv-tabs ul ul',
				'js'	  => 'css("border-color",to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			/* ------------------------------------
			
			:: FRAME SECTION
			
			------------------------------------ */			
	
			
			/* ------------------------------------
			:: MAIN SETTINGS
			------------------------------------ */
			
			// Frame Color
			'icon_color'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_icon_color]',
				'label'   => __( 'Body Skin', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'default' => 'Default',
					'light' => 'Light',
					'dark' => 'Dark',
				),
				'section' => 'themeva_background_5',
				'css' 	  => '#primary-wrapper',
				'js'	  => 'removeClass("nv-dark nv-light").addClass( "nv-"+to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),	
			
			// Main Background
			'frame_main'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_frame_main]',
				'label'   => __( 'Content Frame', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'enabled' => __( 'Enabled', 'options_framework_themeva' ),
					'disabled' => __( 'Disabled', 'options_framework_themeva' )
				),
				'section' => 'themeva_background_5',
				'css' 	  => '.skinset-main',
				//'js'	  => 'removeClass("enabled disabled color border").addClass( to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),			
			
		
			// main Background Primary Color
			'main_pri_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_pri_color]',
				'label'   => __( 'Content Frame Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_5',
				'css' 	  => '.skinset-main',
				'js'	  => 'attr("data-pri-color", to ).attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// main Background Primary Opacity
			'main_pri_opac' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_pri_opac]',
				'label'   => __( 'Content Frame Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_5',
				'css' 	  => '.skinset-main',
				'js'	  => 'attr("data-pri-opac", to ).attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// main Background Primary Color
			'main_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_border_color]',
				'label'   => __( 'Content Frame Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_5',
				'css' 	  => '.skinset-main',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Divider Shade Color
			'main_divider_shade'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_main_divider_shade]',
				'label'   => __( 'Divider Line Shade', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'light' => 'Light',
					'medium' => 'Medium',
					'dark' => 'Dark',
				),
				'section' => 'themeva_background_5',
				'live'	  => 'no',
				'priority' => $priority ++
			),			
								

			/* ------------------------------------
			:: FONT SETTINGS
			------------------------------------ */	

			// Font Family
			'background_font'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_font]',
				'label'   => __( 'Font Family', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $font_list,
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Font Size
			'background_font_size'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_font_size]',
				'label'   => __( 'Font Size ( px )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Heading Font Family
			'background_heading_font'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_heading_font]',
				'label'   => __( 'Headings Font Family', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $heading_font_list,
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Increase Heading Size
			'background_heading_size'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_heading_size]',
				'label'   => __( 'Increase Heading Size By ( px )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),


			// Menu Font Family
			'header_font'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_header_font]',
				'label'   => __( 'Menu Font Family', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $font_list,
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),	

			// Menu Font Size
			'header_font_size'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_header_font_size]',
				'label'   => __( 'Menu Font Size ( px )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),
			


			/* ------------------------------------
			
			:: FONT COLORS SECTION
			
			------------------------------------ */				

			/* ------------------------------------
			:: GENERAL FONT COLORS
			------------------------------------ */	

			// Header Heading
			'font_colors_heading'  => array(
				'name' 	  => 'font_colors_heading',
				'label'   => __( 'General Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_colors',
				'priority' => $priority ++
			),

			// Font Color
			'background_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background.nv-skin',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Link Color
			'background_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_link_color]',
				'label'   => __( 'Link Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background.nv-skin a',
				'js'	  => 'css("color", to ).parents(".skinset-background.nv-skin").find(".nv-skin.highlight,.header-infobar").css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Link Hover Color
			'background_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background.nv-skin a:hover',
				'js'	  => 'css("color", to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),				

			// Default H1 Color
			'background_h1_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_h1_color]',
				'label'   => __( 'H1 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background h1, .skinset-background h1 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default H2 Color
			'background_h2_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_h2_color]',
				'label'   => __( 'H2 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background h2, .skinset-background h2 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default h3 Color
			'background_h3_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_h3_color]',
				'label'   => __( 'h3 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background h3, .skinset-background h3 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Default h4 Color
			'background_h4_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_h4_color]',
				'label'   => __( 'h4, h5, h6 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-background h4, .skinset-background h4 a,.skinset-background h5, .skinset-background h5 a,.skinset-background h6, .skinset-background h6 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),				


			/* ------------------------------------
			:: HEADER FONT COLORS
			------------------------------------ */				
			
			// Header Heading
			'header_font_colors_heading'  => array(
				'name' 	  => 'header_font_colors_heading',
				'label'   => __( 'Header Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_colors',
				'priority' => $priority ++
			),			

			// Font Color
			'header_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header.nv-skin,.skinset-header.nv-skin span.menudesc',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),					

			// Link Color
			'header_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_link_color]',
				'label'   => __( 'Link Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header.nv-skin a',
				'js'	  => 'css("color", to ).parents(".skinset-header.nv-skin").find(".nv-skin.highlight").css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	
			
			// Link Hover Color
			'header_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header.nv-skin a:hover',
				'js'	  => 'css("color", to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),


			// Default H1 Color
			'header_h1_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_h1_color]',
				'label'   => __( 'H1 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header h1, .skinset-header h1 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default H2 Color
			'header_h2_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_h2_color]',
				'label'   => __( 'H2 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header h2, .skinset-header h2 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Default h3 Color
			'header_h3_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_h3_color]',
				'label'   => __( 'h3 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header h3, .skinset-header h3 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default h4 Color
			'header_h4_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_h4_color]',
				'label'   => __( 'h4, h5, h6 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-header h4, .skinset-header h4 a, .skinset-header h5, .skinset-header h5 a,.skinset-header h6, .skinset-header h6 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),
			

			/* ------------------------------------
			:: SUB-MENU FONT COLORS
			------------------------------------ */				
			
			// Sub Menu Heading
			'submenu_font_colors_heading'  => array(
				'name' 	  => 'submenu_font_colors_heading',
				'label'   => __( 'Sub-Menu Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_colors',
				'priority' => $priority ++
			),			

			// Font Color
			'submenu_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '#nv-tabs ul ul',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),					

			// Link Color
			'submenu_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_link_color]',
				'label'   => __( 'Link Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '#nv-tabs ul ul a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	
			
			// Link Hover Color
			'submenu_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'live'	  => 'no',
				'priority' => $priority ++
			),						

			/* ------------------------------------
			:: FOOTER FONT COLORS
			------------------------------------ */				

			// Footer Heading
			'footer_font_colors_heading'  => array(
				'name' 	  => 'footer_font_colors_heading',
				'label'   => __( 'Footer Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_colors',
				'priority' => $priority ++
			),							
		
			// Font Color
			'footer_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer.nv-skin',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Link Color
			'footer_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_link_color]',
				'label'   => __( 'Link Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer.nv-skin a',
				'js'	  => 'css("color", to ).parents(".skinset-footer.nv-skin").find(".nv-skin.highlight").css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Link Hover Color
			'footer_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer.nv-skin a:hover',
				'js'	  => 'css("color", to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),				

			// Footer H1 Color
			'footer_h1_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_h1_color]',
				'label'   => __( 'H1 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer h1, .skinset-footer h1 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Footer H2 Color
			'footer_h2_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_h2_color]',
				'label'   => __( 'H2 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer h2, .skinset-footer h2 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Footer h3 Color
			'footer_h3_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_h3_color]',
				'label'   => __( 'h3 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer h3, .skinset-footer h3 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),		
	
			// Footer h4 Color
			'footer_h4_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_h4_color]',
				'label'   => __( 'h4, h5, h6 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_font_colors',
				'css' 	  => '.skinset-footer h4, .skinset-footer h4 a,.skinset-footer h5, .skinset-footer h5 a,.skinset-footer h6, .skinset-footer h6 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	
		);

		// Add Skin Options if a Skin is selected
		if( !empty( $skin ) )
		{
			$options_array = array_merge( $options_array, $skin_options_array );	
		}

		/* ------------------------------------
		
		:: BACKGROUND LAYERS SECTION
		
		------------------------------------ */

		$patterns = array(
			"" => "Select Pattern",
			"pattern-a" => "pattern-a",
			"pattern-b" => "pattern-b",
			"pattern-c" => "pattern-c",
			"pattern-d" => "pattern-d",
			"pattern-e" => "pattern-e",
			"pattern-f" => "pattern-f",
			"pattern-g" => "pattern-g",
			"pattern-h" => "pattern-h",
			"pattern-i" => "pattern-i",
			"pattern-j" => "pattern-j",
			"pattern-k" => "pattern-k",
			"pattern-l" => "pattern-l",
			"pattern-m" => "pattern-m",
			"pattern-n" => "pattern-n",
			"pattern-o" => "pattern-o",
			"pattern-p" => "pattern-p",
			"pattern-q" => "pattern-q",
			"pattern-r" => "pattern-r",
			"pattern-s" => "pattern-s",
			"pattern-t" => "pattern-t",
			"pattern-u" => "pattern-u"
		);		

		for ( $i=1; $i <= 5; $i++ )
		{
			// Data Sources
			$data_sources = array(
				'nodatasource-'. $i => 'Select',
				'layer'. $i .'-data-4' => 'Slide Set',
				'layer'. $i .'-data-1' => 'Attached Media',
				'layer'. $i .'-data-6' => 'Portfolio Categories',
				'layer'. $i .'-data-2' => 'Post Categories',
				'layer'. $i .'-data-8' => 'Page / Post ID',
			);
			

			// Products
			if( class_exists('WPSC_Query') || class_exists('Woocommerce') )
			{
				$data_sources['layer'. $i .'-data-5'] = 'Product Category / Tags';
			}
			
			// Flickr
			if( of_get_option('flickr_userid') !='' )
			{
				$data_sources['layer'. $i .'-data-3'] = 'Flickr Set';
			}
			
			// Set Choices
			if( $i == 5 )
			{
				$choices = array(
					'' => 'Select Type',
					'layer'. $i .'_color' => 'Color',
					'layer'. $i .'_imagefull' => 'Image ( Full Screen )',
					'layer'. $i .'_image' => 'Image ( Positioned )',
					'layer'. $i .'_pattern' => 'Pattern',
					'layer'. $i .'_video' => 'Video / Flash',
					'layer'. $i .'_cycle' => 'Image / Video Cycle',
				);		
			}
			else
			{
				$choices = array(
					'' => 'Select Type',
					'layer'. $i .'_color' => 'Color',
					'layer'. $i .'_image' => 'Image ( Positioned )',
					'layer'. $i .'_pattern' => 'Pattern',
				);					
			}

			// Assign Sections
			if( $i == 1 || $i == 2 )
			{
				$section = 1;
			}
			elseif( $i == 3 || $i == 4 )
			{
				$section = 2;
			}			
			else
			{
				$section = $i;	
			}

			// Add Layer Headings
	
			// Assign layer numbers
			$layer = '';
				
			if( $i == 1 || $i == 3 )
			{
				$layer = 1;	
			}
			if( $i == 2 || $i == 4 )
			{
				$layer = 2;	
			}
			else
			{
				$layer = '';	
			}
			
			if( $i == 1 ) $priority = 2;
			if( $i == 2 ) $priority = 30;

			if( $i == 3 ) $priority = 3;
			if( $i == 4 ) $priority = 40;			
	
				
			// Header Heading
			$layers_array['layer'. $i .'_heading'] = array(
				'name' 	  => 'layer'. $i .'_heading',
				'label'   => __( 'Background Layer '. $layer, 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_background_'. $section ,
				'priority' => $priority. 0
			);
			

			// Selection
			$layers_array['layer'. $i .'_type'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_type]',
				'label'   => __( 'Select Background Type', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $choices,
				'section' => 'themeva_background_'. $section ,
				'live'	  => 'no',
				'priority' => $priority. 1
			);			
			
			// COLOR: Primary Color
			$layers_array['layer'. $i .'_color_opt_pri'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pri_color]',
				'label'   => __( 'Background Color (top)', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'attr("data-pri-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority. 2
			);		

			// COLOR: Primary Opacity
			$layers_array['layer'. $i .'_color_opt_pri_opac'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pri_opac]',
				'label'   => __( 'Background Opacity (top)', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'attr("data-pri-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority. 3
			);			

			// COLOR: Secondary Color
			$layers_array['layer'. $i .'_color_opt_sec'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_sec_color]',
				'label'   => __( 'Background Color (bottom)', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority. 4
			);				

			// COLOR: Secondary Opacity
			$layers_array['layer'. $i .'_color_opt_sec_opac'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_sec_opac]',
				'label'   => __( 'Background Opacity (bottom)', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority. 5
			);		

			// IMAGEPOSITIONED: Image
			$layers_array['layer'. $i .'_image_opt'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image]',
				'label'   => __( 'Image', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'image',
				'section' => 'themeva_background_'. $section ,
				'live'	  => 'no',
				'priority' => $priority. 10
			);				

			// IMAGEPOSITIONED: Color
			$layers_array['layer'. $i .'_image_opt_color'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority. 11
			);

			// IMAGEPOSITIONED: Opacity
			$layers_array['layer'. $i .'_image_opt_opac'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_opac]',
				'label'   => __( 'Background Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i,
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority. 12
			);

			// IMAGEPOSITIONED: Vertial Align
			$layers_array['layer'. $i .'_image_opt_valign'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_valign]',
				'label'   => __( 'Image Vertical Position', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'top' => 'Top',
					'bottom' => 'Bottom',
					'center' => 'Center',
				),
				'section' => 'themeva_background_'. $section ,
				'live'	  => 'no',
				'priority' => $priority. 13
			);	

			// IMAGEPOSITIONED: Horizontal Align
			$layers_array['layer'. $i .'_image_opt_halign'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_halign]',
				'label'   => __( 'Image Horizontal Position', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center',
				),
				'section' => 'themeva_background_'. $section ,
				'live'	  => 'no',
				'priority' => $priority. 14
			);

			// IMAGEPOSITIONED: Horizontal Align
			$layers_array['layer'. $i .'_image_opt_repeat'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_repeat]',
				'label'   => __( 'Image Repeat', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'repeat' => 'Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'no-repeat' => 'No Repeat',
				),
				'section' => 'themeva_background_'. $section ,
				'live'	  => 'no',
				'priority' => $priority. 15
			);

			// PATTERN: Pattern Type
			$layers_array['layer'. $i .'_pattern_opt'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pattern]',
				'label'   => __( 'Pattern Type', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $patterns,
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-image", "url('. get_template_directory_uri() .'/images/" + to +".png)" )',				
				'live'	  => 'yes',
				'priority' => $priority. 16
			);			

			// PATTERN: Color
			$layers_array['layer'. $i .'_pattern_opt_color'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pattern_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority. 17
			);

			// PATTERN: Opacity
			$layers_array['layer'. $i .'_pattern_opt_opac'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pattern_opac]',
				'label'   => __( 'Background Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_'. $section ,
				'css' 	  => '#custom-layer'. $i,
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority. 18
			);


			if( $i == '5' )
			{				
	
				// CYCLE: Opacity
				$layers_array['layer'. $i .'_cycle_opt_opac'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_opac]',
					'label'   => __( 'Opacity', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'range',
					'max'	  => '100',
					'min'	  => '0',
					'default' => '100',
					'section' => 'themeva_background_'. $section ,
					'css' 	  => '#custom-layer'. $i,
					'func'	  => 'background_opacity',
					'js'	  => 'attr("data-pri-opac", to )',
					'live'	  => 'yes',
					'priority' => $i. 23
				);
	
				// CYCLE: Color
				$layers_array['layer'. $i .'_cycle_opt_color'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_color]',
					'label'   => __( 'Background Color', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'color',
					'section' => 'themeva_background_'. $section ,
					'css' 	  => '#custom-layer'. $i ,
					'js'	  => 'css("background-color", to )',
					'live'	  => 'yes',
					'priority' => $i. 24
				);
	
				// CYCLE: Timeout
				$layers_array['layer'. $i .'_cycle_opt_timeout'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_timeout]',
					'label'   => __( 'Slide Timeout ( Seconds )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 25
				);
	
				// CYCLE: Datasource
				$layers_array['layer'. $i .'_cycle_opt_datasource'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_datasource]',
					'label'   => __( 'Data Source', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'select',
					'choices' => $data_sources,
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 26
				);
	
				// CYCLE: Attached Media
				$layers_array['layer'. $i .'-data-1'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_attached]',
					'label'   => __( 'Attached ID ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 27
				);			
				
				// CYCLE: Post Categories
				$layers_array['layer'. $i .'-data-2'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_cat]',
					'label'   => __( 'Post Categories ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 28
				);
	
				// CYCLE: Gallery Media
				$layers_array['layer'. $i .'-data-6'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_mediacat]',
					'label'   => __( 'Gallery Media ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 29
				);
	
				// CYCLE: Flickr
				$layers_array['layer'. $i .'-data-3'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_flickr]',
					'label'   => __( 'Flickr Set ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 30
				);
	
				// CYCLE: SlideSet
				$layers_array['layer'. $i .'-data-4'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_slideset]',
					'label'   => __( 'SlideSet Set ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 31
				);
	
				// CYCLE: Product Category
				$layers_array['layer'. $i .'-data-5'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_prodcat]',
					'label'   => __( 'Product Categories ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 32
				);
	
				// CYCLE: Product Tags
				$layers_array['layer'. $i .'-data-5'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_prodtag]',
					'label'   => __( 'Product Tags ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 33
				);

				// CYCLE: Page / Post ID
				$layers_array['layer'. $i .'-data-8'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_pagepost_id]',
					'label'   => __( 'Page / Post ID ( Comma Separate )', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'text',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 33
				);						

				// IMAGEFULL: Image
				$layers_array['layer'. $i .'_imagefull_opt'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefull]',
					'label'   => __( 'Image', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'image',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 34
				);				
	
				// IMAGEFULL: Color
				$layers_array['layer'. $i .'_imagefull_opt_color'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefull_color]',
					'label'   => __( 'Background Color', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'color',
					'section' => 'themeva_background_'. $section ,
					'css' 	  => '#custom-layer'. $i ,
					'js'	  => 'css("background-color", to )',
					'live'	  => 'yes',
					'priority' => $i. 35
				);
	
				// IMAGEFULL: Opacity
				$layers_array['layer'. $i .'_imagefull_opt_opac'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefull_opac]',
					'label'   => __( 'Background Opacity', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'range',
					'max'	  => '100',
					'min'	  => '0',
					'default' => '100',
					'section' => 'themeva_background_'. $section ,
					'css' 	  => '#custom-layer'. $i .' img',
					'func'	  => 'background_opacity',
					'js'	  => 'attr("data-pri-opac", to )',
					'live'	  => 'yes',
					'priority' => $i. 36
				);					
	
				// IMAGEFULL: Featured
				$layers_array['layer'. $i .'_imagefull_opt_imagefeatured'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefeatured]',
					'label'   => __( 'Use Page / Post Featured Image', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'checkbox',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 37
				);
				
				// VIDEO: File
				$layers_array['layer'. $i .'_video_opt'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_video]',
					'label'   => __( 'Media File', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'media',
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 38
				);
	
				// VIDEO: Opacity
				$layers_array['layer'. $i .'_video_opt_opac'] = array(
					'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_video_opac]',
					'label'   => __( 'Opacity', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'range',
					'max'	  => '100',
					'min'	  => '0',
					'default' => '100',
					'section' => 'themeva_background_'. $section ,
					'css' 	  => '#custom-layer'. $i,
					'func'	  => 'background_opacity',
					'js'	  => 'attr("data-pri-opac", to )',
					'live'	  => 'yes',
					'priority' => $i. 39
				);
	
				// VIDEO: Type
				$layers_array['layer'. $i .'_video_opt_type'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_video_type]',
					'label'   => __( 'Media Type', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'select',
					'choices' => array(
						'' => 'Select',
						'youtube' => 'YouTube',
						'vimeo' => 'Vimeo',
						'flash' => 'Flash',
						'jwplayer' => 'JW Player',
					),
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 40
				);
	
				// VIDEO: Loop
				$layers_array['layer'. $i .'_video_opt_loop'] = array(
					'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_video_loop]',
					'label'   => __( 'Video Loop', 'options_framework_themeva' ),
					'type'	  => 'option',
					'control' => 'select',
					'choices' => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'section' => 'themeva_background_'. $section ,
					'live'	  => 'no',
					'priority' => $i. 41
				);																
			}
		}		
		
		// Add Layout Options if a Skin is selected
		if( !empty( $skin ) )
		{
			$options_array = array_merge( $options_array, $layers_array );
		}
		
		return $options_array;
	
	}
	
	add_action( 'customize_register', 'dynamix_customize_register' );
	
	function dynamix_customize_register( $wp_customize )
	{
		// Custom Controls
		class Themeva_Customize_Range_Control extends WP_Customize_Control {
			public $type = 'range';
			public $min;
			public $max;
			public $default;

			public function enqueue() {
					wp_enqueue_script( 'jquery-ui-slider' );
			}			
		 
			public function render_content() {
				
				$value = ( esc_attr( $this->value() ) != '' ) ? esc_attr( $this->value() ) : esc_attr( $this->default );
				$name  = ( isset( $name ) ) ? esc_attr( $name ) : '';
		
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input type="text" class="range-value"  id="<?php echo esc_attr( $this->id ); ?>" value="<?php echo $value; ?>" <?php $this->link(); ?> />
					<div class="range-slider" id="<?php echo esc_attr( $this->id ); ?>_slider" data-value="<?php echo $value; ?>" data-default="<?php echo esc_attr( $this->default ); ?>" data-min="<?php echo esc_attr( $this->min ); ?>" data-max="<?php echo esc_attr( $this->max ); ?>"><?php echo $name; ?></div>                    
                </label>
				<?php
			}
		}

		// Custom Controls
		class Themeva_Customize_Media_Control extends WP_Customize_Control {
			public $type = 'media';
		 
			public function render_content() {

				wp_enqueue_script( 'media-upload' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_style( 'thickbox' );	
				
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input type="text" class="upload has-file"  id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                    <p><a href="#" id="<?php echo esc_attr( $this->id ); ?>_button" class="button-secondary media-upload"><?php _e( 'Add Media', 'options_framework_themeva' ); ?></a></p>    
                </label>
				<?php
			}
		}

		class Themeva_Customize_Hidden_Control extends WP_Customize_Control {
			public $type = 'hidden';
		 
			public function render_content() {
				?>
                <input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				<?php
			}
		}	

		class Themeva_Customize_Heading_Control extends WP_Customize_Control {
			public $type = 'heading';
		 
			public function render_content() {
				?>
                <h6 class="cmb_metabox_title"><?php echo esc_html( $this->label ); ?></h6>
				<?php
			}
		}			

		/* ------------------------------------
		:: GET SKIN DATA
		------------------------------------ */	
		
		// New Skin
		if( !empty($_POST['new-skin-title']) ) 
		{
			update_option( 'preview_skin', $_POST['new-skin-title'] );
			update_option( 'skins_dynamix_ids', get_option('skins_dynamix_ids') . $_POST['new-skin-title'] . ',' ); 
		}
		// Duplicate Skin
		elseif( !empty($_POST['duplicate-skin-title']) )
		{
			$duplicate_skin = get_option('preview_skin');
			$duplicate_skin_data = get_option( 'skin_data_'. $duplicate_skin );
			
			update_option( 'skin_data_'. $_POST['duplicate-skin-title'] , $duplicate_skin_data );
			update_option( 'skins_dynamix_ids', get_option('skins_dynamix_ids' ) . $_POST['duplicate-skin-title'] . ',' ); 
			update_option( 'preview_skin', $_POST['duplicate-skin-title'] );
		}
		// Delete Skin
		elseif( isset($_POST['delete-skin-title']) )
		{
			$delete_skin = get_option( 'preview_skin' );
			
			if( !empty( $delete_skin ) && !empty( $_POST['delete-skin-title'] ) )
			{
				$skin_ids = str_replace( $delete_skin.',','', get_option( 'skins_dynamix_ids' ) );
				update_option( 'skins_dynamix_ids', $skin_ids );
				delete_option( 'skin_data_'. $delete_skin );
				delete_option( 'preview_skin' );
				delete_option('select_skin');
				delete_option('customize_skin');			
			}
		}
		// Load Skin
		elseif( !empty($_POST['skin_select']) )
		{
			update_option('preview_skin', $_POST['skin_select']);
		}
		
		$skin = '';
		
		if( get_option('preview_skin') )
		{
			$skin = get_option('preview_skin');
			update_option('skin_select', $skin );
		}
		else
		{
			delete_option('skin_select' );
		}		
		
	
	
		// Skin Select
		$wp_customize->add_setting( 'default_skin', array(
			'default'    => get_option('outskin'),
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );

		$wp_customize->add_setting( 'inskin', array(
			'default'    => get_option('inskin'),
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );		

		$wp_customize->add_setting( 'skin_select', array(
			'default'        => $skin,
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );		
		
		$skin_ids = explode(',', rtrim( get_option('skins_dynamix_ids'), ',' ) );
		
		$skin_arr[''] = 'Select Skin';
		
		foreach( $skin_ids as $skin_id )
		{
			$skin_arr[$skin_id] = $skin_id;
		}

		/* ------------------------------------
		:: DEFAULT OPTIONS
		------------------------------------ */		

		$wp_customize->add_setting( 'skins_dynamix_ids', array(
			'default'    => get_option('skins_dynamix_ids'),
			'capability' => 'edit_theme_options',
			'type'    	 => 'hidden',	
		) );	

		$wp_customize->add_control( 'skin_select', array(
			'label'   => 'Select a Skin to Edit:',
			'section' => 'themeva_skin',
			'type'    => 'select',
			'choices'    => $skin_arr
		) );

		$wp_customize->add_control( 'default_skin', array(
			'label'   => 'Set a Default Skin for your Site:',
			'section' => 'themeva_skin',
			'type'    => 'select',
			'choices'    => $skin_arr
		) );

		$wp_customize->add_control( 'inskin', array(
			'label'   => 'Set a Default Body Skin:',
			'section' => 'themeva_skin',
			'type'    => 'select',
			'choices'    => array (
				'light' => 'Light',
				'dark' => 'Dark',
			)
		) );						
				

		$wp_customize->add_control( new Themeva_Customize_Hidden_Control( $wp_customize, 'skins_dynamix_ids', array(
			'section'  => 'themeva_skin',
			'settings' => 'skins_dynamix_ids',
		) ) );

		$wp_customize->add_section( 'themeva_skin', array(
			'title'          => __( 'Edit + Set Default Skin', 'options_framework_themeva' ),
			'priority'       => 200,
		) );			


		/* ------------------------------------
		:: GET SKIN OPTIONS
		------------------------------------ */		
		
		$options_array = customizer_options($skin);	
		

			// Get Options			
			foreach ( $options_array as $key => $option )
			{
				// Settings
				$wp_customize->add_setting( $option['name'] , array(
					'default'        => '',
					'type'           => $option['type'],
					'capability'     => 'edit_theme_options'
				) );

				// Reset
				$option['live'] = ( isset( $option['live'] ) ) ? $option['live'] : '';
				$option['choices'] = ( isset( $option['choices'] ) ) ? $option['choices'] : '';
				$option['default'] = ( isset( $option['default'] ) ) ? $option['default'] : '';
				$option['name'] = ( isset( $option['name'] ) ) ? $option['name'] : '';			
	
				// Controls
				if( $option['control'] == 'color' )
				{
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
						'label'    => $option['label'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'priority' => $option['priority']
					) ) );
				}
				elseif( $option['control'] == 'range' )
				{
					$wp_customize->add_control( new Themeva_Customize_Range_Control( $wp_customize, $key, array(
						'label'    => $option['label'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'min'	   => $option['min'],
						'max'	   => $option['max'],
						'default'  => $option['default'],
						'priority' => $option['priority']
					) ) );
				}
				elseif( $option['control'] == 'image' )
				{
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $key, array(
						'label'    => $option['label'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'priority' => $option['priority']
					) ) );
					
				}
				elseif( $option['control'] == 'media' )
				{
					$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, $key, array(
						'label'    => $option['label'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'priority' => $option['priority']
					) ) );
					
				}
				elseif( $option['control'] == 'heading' )
				{
					$wp_customize->add_control( new Themeva_Customize_Heading_Control( $wp_customize, $key, array(
						'label'    => $option['label'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'priority' => $option['priority']
					) ) );
					
				}											
				else
				{
					$wp_customize->add_control( $key, array(
						'label'    => $option['label'],
						'type'     => $option['control'],
						'choices'  => $option['choices'],
						'section'  => $option['section'],
						'settings' => $option['name'],
						'priority' => $option['priority']
					) );
				}
				
				// Transports
				if( $option['live'] == 'yes' )
				{
					$wp_customize->get_setting( $option['name'] )->transport='postMessage';
				}			

				// Sections
				$wp_customize->add_section( 'themeva_header_options', array(
					'title'          => __( 'Menu / Branding Align', 'options_framework_themeva' ),
					'priority'       => 99,
				) );
				
				$wp_customize->add_section( 'themeva_background_1', array(
					'title'          => __( 'Header', 'options_framework_themeva' ),
					'priority'       => 201,
				) );				

				$wp_customize->add_section( 'themeva_background_5', array(
					'title'          => __( 'Body', 'options_framework_themeva' ),
					'priority'       => 202,
				) );							

				$wp_customize->add_section( 'themeva_background_2', array(
					'title'          => __( 'Footer', 'options_framework_themeva' ),
					'priority'       => 203,
				) );
		
				$wp_customize->add_section( 'themeva_font_colors', array(
					'title'          => __( 'Font Colors', 'options_framework_themeva' ),
					'priority'       => 204,
				) );				

				$wp_customize->add_section( 'themeva_font_settings', array(
					'title'          => __( 'Font Settings', 'options_framework_themeva' ),
					'priority'       => 205,
				) );																									
			
			}
		}
	


	function themeva_customize_preview()
	{
		update_option('customize_skin', 'customizing');
		// Get Options
		$preview_skin = get_option('preview_skin');
		$options_array = customizer_options($preview_skin);	
		
		$custom_option = '';

		foreach ( $options_array as $key => $option )
		{
			$live = ( isset( $option['live'] ) ) ? $option['live'] : '';
				
			if( $live == 'yes' )
			{
				$custom_option .= 'wp.customize("'. $option['name'] .'",function( value ) {' . "\n";
				$custom_option .=  'value.bind(function(to) {' . "\n";
					
				$custom_option .=  '$("'. $option['css'] .'").'. $option['js'] . ';' . "\n";
	
				if( !empty($option['func']) )
				{
					$custom_option .=  $option['func'] . '( "' . $option['css'] . '", to );';
				}
					
				$custom_option .=  '});' . "\n";
				$custom_option .=  '});' . "\n";	
			}
		}
		
		$params = array(
		'controls' => $custom_option,
		);
		
		wp_register_script('acoda-customizer-controls', get_template_directory_uri().'/lib/adm/js/controls-customizer.js',array('jquery','customize-preview'), true );
		wp_localize_script( 'acoda-customizer-controls', 'CUSTOM_CONTROLS', $params );	
		wp_enqueue_script('acoda-customizer-controls');	
		
			
		delete_option('customize_skin');
	}
	
	function themeva_customize_scripts()
	{
		// Javascript
		wp_deregister_script('themeva-customizer');	
		wp_register_script('themeva-customizer', get_template_directory_uri().'/lib/adm/js/themeva-customizer.js',false,array('jquery','customize-preview','media-upload','thickbox'),true);
		wp_enqueue_script('themeva-customizer');
		
		// Styles
		wp_enqueue_style('nv_theme_settings_css', get_template_directory_uri() . '/lib/adm/css/nv-theme-settings.css');
	}
	
	// Init Customizer Script
	add_action( 'customize_preview_init', 'themeva_customize_preview', 21);
	add_action( 'customize_controls_init', 'themeva_customize_scripts', 21);
