<?php

	add_action( 'customize_register', 'epix_customize_register' );
	
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

			$cufon_fonts['-'] = '----- Cufon Fonts -----';
			
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
		
		// Patterns 
		
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
			"pattern-u" => "pattern-u",
		);
				
		$priority = 0;
		
		$options_array = array(	
	
			/* ------------------------------------
			:: GENERAL SECTION
			------------------------------------ */	
/*
			// Header Heading
			'global_header_heading'  => array(
				'name' 	  => 'global_header_heading',
				'label'   => __( 'Global Header Settings', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_general',
				'priority' => 2
			),	

			// Header Height
			'header_height' => array(
				'name'	  => 'header_height',
				'label'   => __( 'Minimum Header Height', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '0',
				'section' => 'themeva_general',
				'css' 	  => '#header',
				'js'	  => 'css("min-height", to +"px")',
				'live'	  => 'yes',
				'priority' => 3
			),			

			// Branding Display
			'branding_disable'  => array(
				'name' 	  => 'branding_disable',
				'label'   => __( 'Branding Display', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'enable' => 'Enabled',
					'disable' => 'Disable',
				),
				'section' => 'themeva_general',
				'priority' => 4
			),

			// Branding Alignment
			'branding_alignment'  => array(
				'name' 	  => 'branding_alignment',
				'label'   => __( 'Branding Alignment', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'section' => 'themeva_general',
				'css' 	  => '#header-logo',
				'js'	  => 'removeClass("left right center").addClass( to )',
				'live'	  => 'yes',
				'priority' => 4
			),

			// Branding Margin
			'branding_margin' => array(
				'name'	  => 'branding_margin',
				'label'   => __( 'Branding Top Margin', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '-200',
				'default' => '',
				'section' => 'themeva_general',
				'css' 	  => '#primary-wrapper #header-logo',
				'js'	  => 'css("margin-top", to +"px")',
				'live'	  => 'yes',
				'priority' => 5
			),	

			// Menu Alignment
			'menu_alignment'  => array(
				'name' 	  => 'menu_alignment',
				'label'   => __( 'Menu Alignment', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'section' => 'themeva_general',
				'css' 	  => '#nv-tabs',
				'js'	  => 'removeClass("left right center").addClass( to )',
				'live'	  => 'yes',
				'priority' => 6
			),

			// Menu Margin
			'menu_margin' => array(
				'name'	  => 'menu_margin',
				'label'   => __( 'Menu Top Margin', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '500',
				'min'	  => '-200',
				'default' => '',
				'section' => 'themeva_general',
				'css' 	  => '#nv-tabs',
				'js'	  => 'css("margin-top", to +"px")',
				'live'	  => 'yes',
				'priority' => 7
			),	

			/* ------------------------------------
			:: HEADER SECTION
			------------------------------------ */		

			// Branding Version
			'branding_ver'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_branding_ver]',
				'label'   => __( 'Branding Version', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'primary' => 'Primary',
					'secondary' => 'Secondary',
				),
				'section' => 'themeva_header',
				'priority' => $priority ++
			),

			// Branding Version
			'navalign'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_navalign]',
				'label'   => __( 'Side Header Navigation Align', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Center',
					'nav-left' => 'Left',
					'nav-right' => 'Right'
				),
				'section' => 'themeva_header',
				'priority' => $priority ++
			),							

			// Header Heading
			'header_heading'  => array(
				'name' 	  => 'header_heading',
				'label'   => __( 'Background', 'options_framework_themeva' ),
				'desc' => __('Menu Sidebar Background Color / Opacity + Border', 'options_framework_themeva'), 
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header',
				'priority' => $priority ++
			),	

			// Header Background Primary Color
			'header_pri_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '#header-bg.skinset-header',
				'js'	  => 'attr("data-pri-color", to ).attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// main Background Primary Opacity
			'layer_header_opac' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_opac]',
				'label'   => __( 'Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_header',
				'css' 	  => '#header-bg.skinset-header',
				'js'	  => 'attr("data-pri-opac", to ).attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Header Image
			'layer_header_image' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_image]',
				'label'   => __( 'Background Image', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'image',
				'section' => 'themeva_header',
				'live'	  => 'no',
				'priority' => $priority ++
			),			

			// Vertial Align
			'layer_header_image_position' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_image_position]',
				'label'   => __( 'Image Position', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'center center' => 'Center Center',
					'center top' => 'Center Top',
					'center bottom' => 'Center Bottom',					
					'left top' => 'Left Top',
					'left center' => 'Left Center',
					'left bottom' => 'Left Bottom',
					'right top' => 'Right Top',
					'right center' => 'Right Center',
					'right bottom' => 'Right Bottom',					
				),
				'section' => 'themeva_header',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Repeat
			'layer_header_image_repeat' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_image_repeat]',
				'label'   => __( 'Image Repeat', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'repeat' => 'Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'no-repeat' => 'No Repeat',
				),
				'section' => 'themeva_header',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Background Size
			'layer_header_image_size' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_header_image_size]',
				'label'   => __( 'Image Size', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'cover' => 'Cover',
					'contain' => 'Contain',
				),
				'section' => 'themeva_header',
				'live'	  => 'no',
				'priority' => $priority ++
			),

			// Shaded Border Color
			'header_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_border_color]',
				'label'   => __( 'Outer Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '#header-bg.skinset-header',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Header Heading
			'floatingheader_font_colors_heading'  => array(
				'name' 	  => 'floatingheader_font_colors_heading',
				'label'   => __( 'Transparent Header', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header',
				'priority' => $priority ++
			),			

			// Font Color
			'floatingheader_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_floatingheader_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '.header_transparent .skinset-header.nv-skin,.header_transparent .skinset-header a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
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
				'section' => 'themeva_header',
				'priority' => $priority ++
			),								

			// Header Heading
			'header_shaded_heading'  => array(
				'name' 	  => 'header_shaded_heading',
				'label'   => __( 'Element Areas', 'options_framework_themeva' ),
				'desc' => __('Menu Icons, Search, Accordion, Tabs', 'options_framework_themeva'), 
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header',
				'priority' => $priority ++
			),				

			// Element Color
			'header_element_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_element_color]',
				'label'   => __( 'Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '#header.skinset-header input[type=\"text\"],#header.skinset-header input[type=\"password\"],#header.skinset-header input[type=\"file\"],#header.skinset-header textarea,#header.skinset-header .dock-tab,#header.skinset-header .dock-tab a',
				'js'	  => 'css("color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Element Background Color
			'header_shaded_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_shaded_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '#header.skinset-header input[type=\"text\"],#header.skinset-header input[type=\"password\"],#header.skinset-header input[type=\"file\"],#header.skinset-header textarea,#header.skinset-header .dock-tab',
				'js'	  => 'css("background-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Shaded Border Color
			'header_shaded_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_shaded_border_color]',
				'label'   => __( 'Inner Border / Divider Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '.skinset-header .sub-header,.skinset-header #nv_selectmenu select,.skinset-header #content article.hentry,.skinset-header .frame .gridimg-wrap,.skinset-header .styledbox.general .boxcontent,.skinset-header .shop-cart .shopping-cart-wrapper,.skinset-header .nv-pricing-container,.skinset-header img.avatar,.skinset-header .tagcloud a,.skinset-header .widget ul,.skinset-header #respond,.skinset-header .hozbreak, .skinset-header hr,.skinset-header ul.dock-tab-wrapper,.skinset-header #lang_sel_list li,.skinset-header .commentlist .children li.comment,.skinset-header #comments-title,.skinset-header .commentlist > li.comment,.skinset-header #payment ul.payment_methods,.skinset-header table.shop_table td,.skinset-header table.shop_table tfoot td,.skinset-header table.shop_table,.skinset-header table.shop_table tfoot th,.skinset-header .cart-collaterals .cart_totals table,.skinset-header .cart-collaterals .cart_totals tr td,.skinset-header .cart-collaterals .cart_totals tr th,.skinset-header .woocommerce form.login,.skinset-header .woocommerce-page form.login,.skinset-header form.checkout_coupon,.skinset-header .woocommerce form.register,.skinset-header .woocommerce-page form.register,.skinset-header ul.product_list_widget li,.skinset-header .post-titles ul.post-metadata-wrap,.skinset-header #nv-tabs ul ul,.skinset-header li.dock-tab',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),		

			// Header Heading
			'menu_hover_heading'  => array(
				'name' 	  => 'menu_hover_heading',
				'label'   => __( 'Sub Menu', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header',
				'priority' => $priority ++
			),			

			// Header Background Primary Color
			'menu_pri_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_menu_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => 'ul.skinset-menu',
				'js'	  => 'attr("data-pri-color", to ).attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// main Background Primary Opacity
			'layer_menu_opac' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_menu_opac]',
				'label'   => __( 'Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_header',
				'css' 	  => 'ul.skinset-menu',
				'js'	  => 'attr("data-pri-opac", to ).attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Shaded Border Color
			'menu_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_border_color]',
				'label'   => __( 'Outer Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => 'ul.skinset-menu',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Link Color
			'menu_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_link_color]',
				'label'   => __( 'Link Color', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'css' 	  => '.skinset-menu.acoda-skin a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),				

			// Menu Hover Color
			'header_menulink_hovercolor' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_menu_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
				'live'	  => 'no',
				'priority' => $priority ++
			),			
							
			

			/* ------------------------------------
			:: HEADER FONT COLORS
			------------------------------------ */				
			
			// Header Heading
			'header_font_colors_heading'  => array(
				'name' 	  => 'header_font_colors_heading',
				'label'   => __( 'Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_header',
				'priority' => $priority ++
			),			

			// Font Color
			'header_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_header_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
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
				'section' => 'themeva_header',
				'css' 	  => '.skinset-header h4, .skinset-header h4 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			
			
			/* ------------------------------------
			:: BODY SETTINGS
			------------------------------------ */

			// Main Heading
			'main_heading'  => array(
				'name' 	  => 'main_heading',
				'label'   => __( 'Background', 'options_framework_themeva' ),
				'desc' => __('Body Background Color / Opacity + Border', 'options_framework_themeva'), 
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_frame',
				'priority' => $priority ++
			),	

			// main Background Color
			'layer_main_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_main_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main',
				'js'	  => 'attr("data-pri-color", to ).attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// main Background Primary Opacity
			'layer_main_opac' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_main_opac]',
				'label'   => __( 'Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main',
				'js'	  => 'attr("data-pri-opac", to ).attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Border Color
			'main_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_border_color]',
				'label'   => __( 'Outer Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main.main-wrap,.skinset-main.slider-wrap,.skinset-main #footer',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),				

			// Main Heading
			'main_element_heading'  => array(
				'name' 	  => 'main_element_heading',
				'label'   => __( 'Element Areas', 'options_framework_themeva' ),
				'desc' => __('Accordion, Tabs, Search, Dividers', 'options_framework_themeva'), 
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_frame',
				'priority' => $priority ++
			),				

			// Element Color
			'main_element_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_element_color]',
				'label'   => __( 'Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main .ui-tabs .ui-tabs-nav li a,.skinset-main .ui-accordion-header a,.skinset-main .ui-tabs .ui-tabs-nav li,.skinset-main .ui-accordion-header,.skinset-main pre,.skinset-main xmp,.skinset-main input[type=text],.skinset-main input[type=password],.skinset-main input[type=file],.skinset-main input[type=tel],.skinset-main input[type=url],.skinset-main input[type=email],.skinset-main textarea,.skinset-main select,.skinset-main #searchsubmit,.skinset-main #panelsearchsubmit,.skinset-main .author-info,.skinset-main .frame .gridimg-wrap,.skinset-main .splitter ul li.active,.skinset-main li.pagebutton,.skinset-main .page-numbers li,.skinset-main .styledbox.general.shaded .boxcontent,.skinset-main .nv-pricing-signup,.skinset-main .nv-pricing-content .even,.skinset-main .socialicons .dock-tab,.skinset-main .panelcontent.heading,.skinset-main div.item-list-tabs,.skinset-main .tab-wrap .trigger,.skinset-main .wrapper .intro-text,.skinset-main .vc_progress_bar .vc_single_bar,.skinset-main .zoomflow .controlsCon > .arrow-left,.skinset-main .zoomflow .controlsCon > .arrow-right,.skinset-main li.dock-tab a,.skinset-main #lang_sel_list li,.skinset-main .autototop a,.skinset-main .ui-state-active a,.skinset-main .gallery-wrap .slidernav a,.skinset-main #reviews #comments ol.commentlist li .comment-text,.skinset-main table.shop_table,.skinset-main .commentlist .comment-content',
				'js'	  => 'css("color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Shaded Background Color
			'main_shaded_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_shaded_color]',
				'label'   => __( 'Background / Border Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main .ui-tabs .ui-tabs-nav li,.skinset-main .ui-accordion-header,.skinset-main pre,.skinset-main xmp,.skinset-main input[type=text],.skinset-main input[type=password],.skinset-main input[type=file],.skinset-main input[type=tel],.skinset-main input[type=url],.skinset-main input[type=email],.skinset-main input.input-text,.skinset-main textarea,.skinset-main select,.skinset-main .author-info,.skinset-main .frame .gridimg-wrap,.skinset-main .splitter ul li.active,.skinset-main li.pagebutton,.skinset-main .page-numbers li,.skinset-main .styledbox.general.shaded .boxcontent,.skinset-main .nv-pricing-signup,.skinset-main div.item-list-tabs,.skinset-main .wrapper .intro-text,.skinset-main .vc_progress_bar .vc_single_bar,.skinset-main .zoomflow .controlsCon > .arrow-left,.skinset-main .zoomflow .controlsCon > .arrow-right,.skinset-main #lang_sel_list li,.skinset-main .autototop a,.skinset-main .woocommerce-message,.skinset-main .woocommerce-error,.skinset-main .woocommerce-info,.skinset-main .woocommerce .payment_box,.skinset-main .woocommerce-tabs li,.skinset-main #reviews #comments ol.commentlist li .comment-text,.skinset-main .product-remove a,.skinset-main table.shop_table thead th,.skinset-main .cart_totals .cart-subtotal td,.skinset-main .cart_totals .cart-subtotal th,.skinset-main .cart_totals .total td,.skinset-main .cart_totals .total th,.skinset-main .commentlist .comment-content,.skinset-main .single_variation_wrap .single_variation,.skinset-main .row.custom-row-inherit',
				'js'	  => 'css("background-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Shaded Border Color
			'main_shaded_border_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_main_shaded_border_color]',
				'label'   => __( 'Inner Border / Divider Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-main .sub-header,.skinset-main #nv_selectmenu select,.skinset-main #content article.hentry,.skinset-main .frame .gridimg-wrap,.skinset-main .styledbox.general .boxcontent,.skinset-main .shop-cart .shopping-cart-wrapper,.skinset-main .nv-pricing-container,.skinset-main img.avatar,.skinset-main .tagcloud a,.skinset-main .widget ul,.skinset-main #respond,.skinset-main .hozbreak, .skinset-main hr,.skinset-main ul.dock-tab-wrapper,.skinset-main #lang_sel_list li,.skinset-main .commentlist .children li.comment,.skinset-main #comments-title,.skinset-main .commentlist > li.comment,.skinset-main #payment ul.payment_methods,.skinset-main table.shop_table td,.skinset-main table.shop_table tfoot td,.skinset-main table.shop_table,.skinset-main table.shop_table tfoot th,.skinset-main .cart-collaterals .cart_totals table,.skinset-main .cart-collaterals .cart_totals tr td,.skinset-main .cart-collaterals .cart_totals tr th,.skinset-main .woocommerce form.login,.skinset-main .woocommerce-page form.login,.skinset-main form.checkout_coupon,.skinset-main .woocommerce form.register,.skinset-main .woocommerce-page form.register,.skinset-main ul.product_list_widget li,.skinset-main .post-titles ul.post-metadata-wrap,.skinset-main .splitter ul li.active,.skinset-main .vc_progress_bar .vc_single_bar,.skinset-main  .ui-tabs .ui-tabs-nav li,.skinset-main .ui-accordion-header, .skinset-main .splitter ul li.active, .skinset-main .row.custom-row-inherit,.skinset-main .styledbox.general.shaded',
				'js'	  => 'css("border-color", to)',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	
		

			/* ------------------------------------
			:: GENERAL FONT COLORS
			------------------------------------ */	

			// Header Heading
			'font_colors_heading'  => array(
				'name' 	  => 'font_colors_heading',
				'label'   => __( 'Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_frame',
				'priority' => $priority ++
			),

			// Font Color
			'background_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
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
				'section' => 'themeva_frame',
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
				'section' => 'themeva_frame',
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
				'section' => 'themeva_frame',
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
				'section' => 'themeva_frame',
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
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-background h3, .skinset-background h3 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Default h4,h5,h6 Color
			'background_h4_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_background_h4_color]',
				'label'   => __( 'h4, h5, h6 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_frame',
				'css' 	  => '.skinset-background h4, .skinset-background h4 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),				

			/* ------------------------------------
			:: SIDEBAR SECTION
			------------------------------------ */	

			// main Background Color
			/*'layer_sidebar_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_sidebar_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-main .sidebar',
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => 8
			),

			/* ------------------------------------
			:: GENERAL FONT COLORS
			------------------------------------ */	

			// Header Heading
			'sidebar_font_colors_heading'  => array(
				'name' 	  => 'sidebar_font_colors_heading',
				'label'   => __( 'Sidebar Font Colors', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_sidebar',
				'priority' => $priority ++
			),

			// Font Color
			'sidebar_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background.nv-skin .sidebar',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Link Color
			'sidebar_link_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_link_color]',
				'label'   => __( 'Link Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background.nv-skin .sidebar a',
				'js'	  => 'css("color", to ).parents(".skinset-background.nv-skin .sidebar").find(".nv-skin.highlight,.header-infobar").css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),			

			// Link Hover Color
			'sidebar_linkhover_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_linkhover_color]',
				'label'   => __( 'Link Hover Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background.nv-skin .sidebar a:hover',
				'js'	  => 'css("color", to )',
				'live'	  => 'no',
				'priority' => $priority ++
			),				

			// Default H1 Color
			'sidebar_h1_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_h1_color]',
				'label'   => __( 'H1 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background .sidebar h1, .skinset-background .sidebar h1 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default H2 Color
			'sidebar_h2_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_h2_color]',
				'label'   => __( 'H2 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background .sidebar h2, .skinset-background .sidebar h2 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),

			// Default h3 Color
			'sidebar_h3_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_h3_color]',
				'label'   => __( 'h3 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background .sidebar h3, .skinset-background .sidebar h3 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// Default h4,h5,h6 Color
			'sidebar_h4_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_sidebar_h4_color]',
				'label'   => __( 'h4, h5, h6 Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_sidebar',
				'css' 	  => '.skinset-background .sidebar h4, .skinset-background .sidebar h4 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),				
								
			/* ------------------------------------
			:: FOOTER SECTION
			------------------------------------ */

			// footer Background Primary Color
			'footer_pri_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_footer_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_footer',
				'css' 	  => '#footer',
				'js'	  => 'attr("data-pri-color", to ).attr("data-sec-color", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	

			// main Background Primary Opacity
			'layer_footer_opac' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer_footer_opac]',
				'label'   => __( 'Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_footer',
				'css' 	  => '#footer.skinset-footer',
				'js'	  => 'attr("data-pri-opac", to ).attr("data-sec-opac", to )',
				'func'	  => 'gradient',
				'live'	  => 'yes',
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
				'section' => 'themeva_footer',
				'priority' => $priority ++
			),							
		
			// Font Color
			'footer_font_color' => array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_footer_font_color]',
				'label'   => __( 'Font Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
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
				'section' => 'themeva_footer',
				'css' 	  => '.skinset-footer h4, .skinset-footer h4 a, .skinset-footer h5, .skinset-footer h5 a,.skinset-footer h6, .skinset-footer h6 a',
				'js'	  => 'css("color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			),	


			/* ------------------------------------
			:: FONT SETTINGS
			------------------------------------ */	

			'background_font_heading'  => array(
				'name' 	  => 'background_font_heading',
				'label'   => __( 'General', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_settings',
				'priority' => $priority ++
			),	

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

			'background_font_spacing'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_font_spacing]',
				'label'   => __( 'Letter Spacing ( em )', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => 3
			),

			'background_font_headings_heading'  => array(
				'name' 	  => 'background_font_headings_heading',
				'label'   => __( 'Headings', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_settings',
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
				'priority' => 5
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

			'background_heading_font_spacing'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_background_heading_font_spacing]',
				'label'   => __( 'Letter Spacing ( em )', 'options_framework_acoda' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_font_settings',
				'live'	  => 'no',
				'priority' => $priority ++
			),
			
			'menu_font_heading'  => array(
				'name' 	  => 'menu_font_heading',
				'label'   => __( 'Menu', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'heading',
				'section' => 'themeva_font_settings',
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

			'header_font_spacing'  => array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_header_font_spacing]',
				'label'   => __( 'Letter Spacing ( em )', 'options_framework_acoda' ),
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

	
		);


		/* ------------------------------------
		
		:: BACKGROUND LAYERS SECTION
		
		------------------------------------ */		

		for ( $i=1; $i <= 1; $i++ )
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
			

			// Selection
			$layers_array['layer'. $i .'_type'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_type]',
				'label'   => __( 'Select Background Type', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select Type',
					'layer'. $i .'_color' => 'Color',
					'layer'. $i .'_imagefull' => 'Image ( Deprecated )',
					'layer'. $i .'_image' => 'Image ( Full + Positioned )',
					'layer'. $i .'_video' => 'Video',
				),
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);			
			
			// COLOR: Primary Color
			$layers_array['layer'. $i .'_color_opt_pri'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_pri_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			);			

			// IMAGEFULL: Image
			$layers_array['layer'. $i .'_imagefull_opt'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefull]',
				'label'   => __( 'Image', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'media',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);				

			// IMAGEFULL: Color
			$layers_array['layer'. $i .'_imagefull_opt_color'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefull_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i .' img',
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			);					

			// IMAGEFULL: Featured
			$layers_array['layer'. $i .'_imagefull_opt_imagefeatured'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_imagefeatured]',
				'label'   => __( 'Use Page / Post Featured Image', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'checkbox',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// IMAGEPOSITIONED: Image
			$layers_array['layer'. $i .'_image_opt'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image]',
				'label'   => __( 'Image', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'media',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);			

			// IMAGEFULL: Featured
			$layers_array['layer'. $i .'_image_opt_imagefeatured'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_featured]',
				'label'   => __( 'Use Page / Post Featured Image', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'checkbox',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);				

			// IMAGEPOSITIONED: Color
			$layers_array['layer'. $i .'_image_opt_color'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i,
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// IMAGEPOSITIONED: Image Size
			$layers_array['layer'. $i .'_image_opt_size'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_image_size]',
				'label'   => __( 'Image Size ( Modern Browsers )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => array(
					'' => 'Select',
					'cover' => 'cover',
					'contain' => 'contain',
					'100% auto' => '100% auto ( Landscape )',
					'auto 100%' => 'auto 100% ( Portrait )',
				),
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);			

			// VIDEO: File
			$layers_array['layer'. $i .'_video_opt'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_video]',
				'label'   => __( 'Media File', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'media',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i,
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
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
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Opacity
			$layers_array['layer'. $i .'_cycle_opt_opac'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_opac]',
				'label'   => __( 'Opacity', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'range',
				'max'	  => '100',
				'min'	  => '0',
				'default' => '100',
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i,
				'func'	  => 'background_opacity',
				'js'	  => 'attr("data-pri-opac", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			);

			// CYCLE: Color
			$layers_array['layer'. $i .'_cycle_opt_color'] = array(
				'name'	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_color]',
				'label'   => __( 'Background Color', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'color',
				'section' => 'themeva_background_'. $i ,
				'css' 	  => '#custom-layer'. $i ,
				'js'	  => 'css("background-color", to )',
				'live'	  => 'yes',
				'priority' => $priority ++
			);

			// CYCLE: Timeout
			$layers_array['layer'. $i .'_cycle_opt_timeout'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_timeout]',
				'label'   => __( 'Slide Timeout ( Seconds )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Datasource
			$layers_array['layer'. $i .'_cycle_opt_datasource'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_datasource]',
				'label'   => __( 'Data Source', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'select',
				'choices' => $data_sources,
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Attached Media
			$layers_array['layer'. $i .'-data-1'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_attached]',
				'label'   => __( 'Attached ID ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);			
			
			// CYCLE: Post Categories
			$layers_array['layer'. $i .'-data-2'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_cat]',
				'label'   => __( 'Post Categories ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Gallery Media
			$layers_array['layer'. $i .'-data-6'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_mediacat]',
				'label'   => __( 'Gallery Media ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Flickr
			$layers_array['layer'. $i .'-data-3'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_flickr]',
				'label'   => __( 'Flickr Set ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: SlideSet
			$layers_array['layer'. $i .'-data-4'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_slideset]',
				'label'   => __( 'SlideSet Set ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Product Category
			$layers_array['layer'. $i .'-data-5'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_prodcat]',
				'label'   => __( 'Product Categories ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);

			// CYCLE: Product Tags
			$layers_array['layer'. $i .'-data-5'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_prodtag]',
				'label'   => __( 'Product Tags ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);			

			// CYCLE: Page / Post ID
			$layers_array['layer'. $i .'-data-8'] = array(
				'name' 	  => 'skin_data_'. $skin .'[skin_id_layer'. $i .'_cycle_pagepost_id]',
				'label'   => __( 'Page / Post ID ( Comma Separate )', 'options_framework_themeva' ),
				'type'	  => 'option',
				'control' => 'text',
				'section' => 'themeva_background_'. $i ,
				'live'	  => 'no',
				'priority' => $priority ++
			);												
									
		}		
		
		$options_array = array_merge( $options_array, $layers_array );
		
		return $options_array;
	
	}
	
	function epix_customize_register($wp_customize)
	{
		// Custom Controls
		class Themeva_Customize_Range_Control extends WP_Customize_Control {
			public $type = 'range';
			public $min;
			public $max;
			public $default;
		 
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
			public $desc;
		 
			public function render_content() {
				?>
                <h6 class="cmb_metabox_title"><?php echo esc_html( $this->label ); ?></h6>
                <?php if( isset( $this->desc ) ) echo '<p class="cmb_metabox_description left">'. esc_attr( $this->desc ) .'</p>';
			}
		}			

		/* ------------------------------------
		:: GET SKIN DATA
		------------------------------------ */	
		
		delete_option('select_skin');
		
		// New Skin
		if( !empty($_POST['new-skin-title']) ) 
		{
			update_option( 'preview_skin', $_POST['new-skin-title'] );
			update_option( 'skins_epix_ids', get_option('skins_epix_ids') . $_POST['new-skin-title'] . ',' ); 
		}
		// Duplicate Skin
		elseif( !empty($_POST['duplicate-skin-title']) )
		{
			$duplicate_skin = get_option('preview_skin');
			$duplicate_skin_data = get_option( 'skin_data_'. $duplicate_skin );
			
			update_option( 'skin_data_'. $_POST['duplicate-skin-title'] , $duplicate_skin_data );
			update_option( 'skins_epix_ids', get_option('skins_epix_ids' ) . $_POST['duplicate-skin-title'] . ',' ); 
			update_option( 'preview_skin', $_POST['duplicate-skin-title'] );
		}
		// Delete Skin
		elseif( isset($_POST['delete-skin-title']) )
		{
			$delete_skin = get_option( 'preview_skin' );
			
			if( !empty( $delete_skin ) && !empty( $_POST['delete-skin-title'] ) )
			{
				$skin_ids = str_replace( $delete_skin.',','', get_option( 'skins_epix_ids' ) );
				update_option( 'skins_epix_ids', $skin_ids );
				delete_option( 'skin_data_'. $delete_skin );
				delete_option( 'preview_skin' );
				delete_option('select_skin');
				delete_option('customize_skin');
			}
		}
		// Load Skin
		elseif( !empty($_POST['skin_select']) )
		{
			update_option('preview_skin', $_POST['skin_select'] );
		}
		
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
			'default'    => get_option('default_skin'),
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );

		$wp_customize->add_setting( 'skin_select', array(
			'default'        => $skin,
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );		
		
		$skin_ids = explode(',', rtrim( get_option('skins_epix_ids'), ',' ) );
		
		$skin_arr[''] = 'Select Skin';
		
		foreach( $skin_ids as $skin_id )
		{
			$skin_arr[$skin_id] = $skin_id;
		}
		
		/* ------------------------------------
		:: DEFAULT OPTIONS
		------------------------------------ */		

		$wp_customize->add_setting( 'skins_epix_ids', array(
			'default'    => get_option('skins_epix_ids'),
			'capability' => 'edit_theme_options',
			'type'    	 => 'hidden',	
		) );					

		$wp_customize->add_control( 'skin_select', array(
			'label'   => 'Select Skin to Edit:',
			'section' => 'themeva_skin',
			'type'    => 'select',
			'choices'    => $skin_arr
		) );

		$wp_customize->add_control( 'default_skin', array(
			'label'   => 'Set Default Skin:',
			'section' => 'themeva_skin',
			'type'    => 'select',
			'choices'    => $skin_arr
		) );		

		$wp_customize->add_control( new Themeva_Customize_Hidden_Control( $wp_customize, 'skins_epix_ids', array(
			'section'  => 'themeva_skin',
			'settings' => 'skins_epix_ids',
		) ) );

		$wp_customize->add_section( 'themeva_skin', array(
			'title'          => __( 'Select Skin', 'options_framework_themeva' ),
			'priority'       => 1,
		) );			


		/* ------------------------------------
		:: GET SKIN OPTIONS
		------------------------------------ */		
	
		
		if( !empty($skin) )
		{
			// Get Options				
			$options_array = customizer_options($skin);	
			
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
				$option['desc'] = ( isset( $option['desc'] ) ) ? $option['desc'] : '';
				
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
						'desc'	   => $option['desc'],
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

				$wp_customize->add_section( 'themeva_general', array(
					'title'          => __( 'General', 'options_framework_themeva' ),
					'priority'       => 100,
				) );					

				// Sections
				$wp_customize->add_section( 'themeva_header', array(
					'title'          => __( 'Header / Menu', 'options_framework_themeva' ),
					'priority'       => 101,
				) );				

				// Sections
				$wp_customize->add_section( 'themeva_frame', array(
					'title'          => __( 'Body', 'options_framework_themeva' ),
					'priority'       => 102,
				) );	

				// Sections
				$wp_customize->add_section( 'themeva_sidebar', array(
					'title'          => __( 'Sidebars', 'options_framework_themeva' ),
					'priority'       => 102,
				) );					

				$wp_customize->add_section( 'themeva_footer', array(
					'title'          => __( 'Footer', 'options_framework_themeva' ),
					'priority'       => 103,
				) );								

				$wp_customize->add_section( 'themeva_font_settings', array(
					'title'          => __( 'Font Settings', 'options_framework_themeva' ),
					'priority'       => 104,
				) );				

				$wp_customize->add_section( 'themeva_background_1', array(
					'title'          => __( 'Background', 'options_framework_themeva' ),
					'priority'       => 105,
				) );													
			
			}
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