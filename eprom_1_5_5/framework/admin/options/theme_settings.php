<?php

/* Panel Options
------------------------------------------------------------------------*/

/* Options array */
$panel_main_options = array(

	/* General Settings
	 -------------------------------------------------------- */
	array(
		'type' => 'open',
		'tab_name' => _x( 'General Settings', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'general-settings',
		'icon' => 'gears'
	),
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Basics', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-general-basics'
		),
			array(
				'name' => _x( 'Responsive Design', 'Admin Panel', SHORT_NAME ),
				'id' => 'responsive',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Flexible theme layouts that change depending on the screen size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Date Format', 'Admin Panel', SHORT_NAME ),
				'id' => 'custom_date',
				'type' => 'text',
				'std' => 'd/m/Y',
				'desc' => _x( 'Enter your custom date. <a href="http://codex.wordpress.org/Formatting_Date_and_Time">Click Here for more information</a>', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Image Quality', 'Admin Panel', SHORT_NAME ),
				'id' => 'quality',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 100,
				'unit' => '',
				'std' => '80',
				'desc' => _x( 'Choose the quality of the images between 0 and 100 <br/>0 - high compression (bad quality)<br/>100 - low compression (good quality)', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Custom Favicon', 'Admin Panel', SHORT_NAME ),
				'id' => 'favicon',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => false,
				'width' => '16',
				'height' => '16',
				'crop' => 'c',
				'std' => '',
				'button_title' => _x( 'Add Image', 'Admin Panel', SHORT_NAME ),
				'desc' => _x( 'Upload a 16px x 16px <a href="http://favicon-generator.org/">ico image</a> for your theme, or specify the image address.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Theme Skin', 'Admin Panel', SHORT_NAME ),
				'id' => 'skin',
				'type' => 'select',
				'std' => 'dark.css',
				'desc' => _x( 'Select your theme skin. <br/>Please note: you can change theme colors, navigation and other styles in Theme Settings > Customization.', 'Admin Panel', SHORT_NAME ),
				'options' => array(
					array( 'name' => 'Dark skin', 'value' => 'dark.css' ),
					array( 'name' => 'Light skin', 'value' => 'light.css' ),
				)
			),
			array(
				'name' => _x( 'Top Button', 'Admin Panel', SHORT_NAME ),
				'id' => 'top_button',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Display top button.', 'Admin Panel', SHORT_NAME ),
			),
		array(
			'type' => 'sub_close'
		),
	
		/* Header
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Header', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-header'
		),	

			// Sticky Header
			array(
				'name' => _x( 'Sticky Header', 'Admin Panel', SHORT_NAME ),
				'id' => 'sticky_header',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Sticky header.', 'Admin Panel', SHORT_NAME )
			),

			// Top Menu
			array(
				'name' => _x( 'Show Top Menu', 'Admin Panel', SHORT_NAME ),
				'id' => 'top_menu',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Show top menu above header.', 'Admin Panel', SHORT_NAME )
			),

			// Qtranslate
			array(
				'name' => _x( 'Show QTranslate Widget', 'Admin Panel', SHORT_NAME ),
				'id' => 'qtrans_widget',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'qtrans_widget',
				'desc' => _x( 'Show QTranslate language chooser above header.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Language Display Type', 'Admin Panel', SHORT_NAME ),
				'id' => 'qtrans_display_type',
				'type' => 'select',
				'std' => 'date',
				'desc' => _x( 'Select display type for Qtranslate language chooser.', 'Admin Panel', SHORT_NAME ),
				'main_group' => 'qtrans_widget',
				'group_name' => array( 'qtrans_widget' ),
				'options' => array(
					array( 'name' => 'Text', 'value' => 'text' ),
					array( 'name' => 'Image', 'value' => 'image' )
				)
			),

			// Logo
			array(
				'name' => _x( 'Logo Image', 'Admin Panel', SHORT_NAME ),
				'id' => 'logo',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => false,
				'width' => '300',
				'height' => '150',
				'crop' => 'c',
				// 'std' => SKIN_IMG_URI.'/logo.png',
				'button_title' => _x( 'Add Image', 'Admin Panel', SHORT_NAME ),
				'desc' => _x( 'Upload a logo for your theme, or specify the image address (http://yoursite.com/your_image.jpg). Default logo size: 119x28px. <br/>Please note: you can change logo margin in Theme Settings > Customization > Logo.', 'Admin Panel', SHORT_NAME )
			),
		
		array(
			'type' => 'sub_close'
		),
	
		/* Footer
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Footer', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-footer'
		),
		
			// Widgets
			array(
				'name' => _x( 'Show Footer Widgets', 'Admin Panel', SHORT_NAME ),
				'id' => 'footer_widgets',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Show footer widgets.', 'Admin Panel', SHORT_NAME ),
			),

			// Twitter
			array(
				'name' => _x( 'Twitter Username', 'Admin Panel', SHORT_NAME ),
				'id' => 'twitter_username',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter your twitter username eg. twitterapi', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Number of Tweets', 'Admin Panel', SHORT_NAME ),
				'id' => 'twitter_limit',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 1,
				'max' => 20,
				'unit' => _x( 'tweets', 'Admin Panel', SHORT_NAME ),
				'std' => '1',
				'desc' => _x( 'Number of tweets to display.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Show Replies', 'Admin Panel', SHORT_NAME ),
				'id' => 'twitter_replies',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Choose whether you want to show replies in your twitter widget or not.', 'Admin Panel', SHORT_NAME ),
			),
			array(
				'name' => _x( 'Twitter API Key', 'Admin Panel', SHORT_NAME ),
				'id' => 'twitter_consumer_key',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter your twitter "Consumer key".', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Twitter API Secret', 'Admin Panel', SHORT_NAME ),
				'id' => 'twitter_consumer_secret',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter your twitter "Consumer secret".', 'Admin Panel', SHORT_NAME )
			),

			// Copyright
			array(
				'name' => _x( 'Copyright Text', 'Admin Panel', SHORT_NAME ),
				'id' => 'copyright',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '<p><img src="' . SKIN_IMG_URI . '/footer-logo.png" alt="">Copyright &copy; 2009-2012 Eprom. All Rights Reserved.</p>',
				'height' => '200',
				'desc' => _x( 'Enter copyright text.', 'Admin Panel', SHORT_NAME )
			),

			// Footer top bar
			array(
				'name' => _x( 'Footer Top Bar', 'Admin Panel', SHORT_NAME ),
				'id' => 'footer_topbar',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'footer_topbar',
				'desc' => _x( 'Display footer top bar.', 'Admin Panel', SHORT_NAME ),
			),	
				array(
					'name' => _x( 'Address', 'Admin Panel', SHORT_NAME ),
					'id' => 'topbar_address',
					'type' => 'text',
					'std' => '',
					'main_group' => 'footer_topbar',
					'group_name' => array( 'footer_topbar' ),
					'desc' => _x( 'Enter your address.', 'Admin Panel', SHORT_NAME )
				),
				array(
					'name' => _x( 'Telephone', 'Admin Panel', SHORT_NAME ),
					'id' => 'topbar_tel',
					'type' => 'text',
					'std' => '',
					'main_group' => 'footer_topbar',
					'group_name' => array( 'footer_topbar' ),
					'desc' => _x( 'Enter your phone number.', 'Admin Panel', SHORT_NAME )
				),
				array(
					'name' => _x( 'E-mail', 'Admin Panel', SHORT_NAME ),
					'id' => 'topbar_email',
					'type' => 'text',
					'std' => '',
					'main_group' => 'footer_topbar',
					'group_name' => array( 'footer_topbar' ),
					'desc' => _x( 'Enter your e-mail address.', 'Admin Panel', SHORT_NAME )
				),
				array(
					'name' => _x( 'ADVANCED: Address Column Class', 'Admin Panel', SHORT_NAME ),
					'id' => 'address_class',
					'type' => 'text',
					'std' => 'col-1-2',
					'main_group' => 'footer_topbar',
					'group_name' => array( 'footer_topbar' ),
					'desc' => _x( 'Here you can change the CSS class for address column. You can use classes listed below. <br>
<pre><code>col-1-2 // the column takes 1/2 of space
col-1-3 // the column takes 1/3 of space
col-1-4 // the column takes 1/4 of space
col-2-3 // the column takes 2/3 of space
col-3-4 // the column takes 3/4 of space
hidden // Hides the column
</code></pre>
						', 'Admin Panel', SHORT_NAME )
				),
				array(
					'name' => _x( 'ADVANCED: Social Column Class', 'Admin Panel', SHORT_NAME ),
					'id' => 'social_class',
					'type' => 'text',
					'std' => 'col-1-2 last',
					'main_group' => 'footer_topbar',
					'group_name' => array( 'footer_topbar' ),
					'desc' => _x( 'Here you can change the CSS class for social icons column. You can use classes listed below. Remember that this class must always have an extra class \'last\' eg. \'col-1-3 last\'!
<pre><code>col-1-2 // the column takes 1/2 of space
col-1-3 // the column takes 1/3 of space
col-1-4 // the column takes 1/4 of space
col-2-3 // the column takes 2/3 of space
col-3-4 // the column takes 3/4 of space
hidden // Hides the column
last // Required class for the column
</code></pre>
						', 'Admin Panel', SHORT_NAME )
				),

		array(
			'type' => 'sub_close'
		),
	
		/* Google stuff
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Google Codes', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-google'
		),
			array(
				'name' => _x( 'Google Analytics Code', 'Admin Panel', SHORT_NAME ),
				'id' => 'google_analytics',
				'type' => 'textarea',
				'std' => '',
				'height' => '100',
				'desc' => _x( 'Insert your Google Analytics code here.', 'Admin Panel', SHORT_NAME )
			),
			// Google MAPS API Key
			array(
				'name' => _x( 'Google Maps API Key', 'Admin Panel', SHORT_NAME ),
				'id' => 'google_maps_key',
				'type' => 'text',
				'std' => '',
				'desc' => __( 'Insert your Google Maps API key.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
	array(
		'type' => 'close'
	),


	/* Fonts
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Fonts', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'fonts',
		'icon' => 'font'
	),

		/* Cufon
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Cufon Fonts', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-cufon'
		),
			array(
				'name' => _x( 'Cufon Fonts', 'Admin Panel', SHORT_NAME ),
				'id' => 'use_cufon_fonts',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'cufon_fonts',
				'desc' => _x( 'When this option is enabled text elements will be automatically replaced with the Cufon Fonts.', 'Admin Panel', SHORT_NAME ),
			),
			array(
				'name' => _x( 'Select Cufon Fonts', 'Admin Panel', SHORT_NAME ),
				'id' => 'cufon_fonts',
				'type' => 'cufon_fonts',
				'plugins' => array( 'cufon_fonts' ),
				'cufon_path' => get_template_directory() . '/styles/cufon_fonts/',
				'cufon_path_uri' => get_template_directory_uri() . '/styles/cufon_fonts/',
				'std' => 'PT_Sans_Bold_700.font.js',
				'main_group' => 'cufon_fonts',
				'group_name' => array( 'use_cufon_fonts' ),
				'desc' => _x( 'Select cufon fonts.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Cufon Code', 'Admin Panel', SHORT_NAME ),
				'id' => 'cufon_code',
				'type' => 'cufon_code',
				'height' => '100',
				'std' => "Cufon.replace(\"h1,h2,h3,h4,h5,h6\", {fontFamily : \"PT Sans Bold\", hover: \"true\"});",
				'main_group' => 'cufon_fonts',
				'group_name' => array( 'use_cufon_fonts' ),
				'desc' => _x( 'Sample code: <br/>
							<code>
							Cufon.replace("h1,h2,h3,h4,h5,h6", {fontFamily : "PT Sans Bold", hover: "true"});
							</code>
							You can use the buttons above to paste the prepared code, then you need to enter the HTML elements which you want to be replaced. For more code tips go to official <a href="http://wiki.github.com/sorccu/cufon/styling">Cufon\'s site</a>.
							', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
		

		/* Google fonts
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Google Web Fonts', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-google-fonts',
		),
			array(
				'name' => _x( 'Google Fonts', 'Admin Panel', SHORT_NAME ),
				'id' => 'use_google_fonts',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'google_fonts',
				'desc' => _x( 'When this option is enabled, the text elements will be automatically replaced with the Google Web Fonts.', 'Admin Panel', SHORT_NAME ),
			),
			array(
				'name' => _x( 'Google Fonts', 'Admin Panel', SHORT_NAME ),
				'sortable' => false,
				'array_name' => 'google_fonts',
				'id' => array(
							  array( 'type' => 'textarea', 'name' => 'font_link', 'id' => 'font_link', 'label' => 'Font Link:' )
							  ),
				'type' => 'sortable_list',
				'main_group' => 'google_fonts',
				'group_name' => array( 'use_google_fonts' ),
				'button_text' => _x( 'Add Font', 'Admin Panel', SHORT_NAME ),
				'desc' => _x( '1. Go to <a href="http://www.google.com/webfonts" target="_blank">Google Fonts</a><br/>
							 2. Select your font and click on "Quick-use"<br/>
							 3. Choose the styles you want (bold, italic...)<br/>
							 4. Choose the character sets you want <br/>
							 5. Copy code from "blue box" and paste. For example:<br/>
							 <code> &lt;link href=\'http://fonts.googleapis.com/css?family=Open+Sans:400italic,800italic,400,800\' rel=\'stylesheet\' type=\'text/css\'&gt;</code>', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Integrate The Fonts Into Your CSS', 'Admin Panel', SHORT_NAME ),
				'id' => 'google_code',
				'type' => 'textarea',
				'height' => '100',
				'std' => '',
				'main_group' => 'google_fonts',
				'group_name' => array( 'use_google_fonts' ),
				'desc' => _x( '
							The Google Web Fonts API will generate the necessary browser-specific CSS to use the fonts. All you need to do is add the font name to your CSS styles. For example: <br/> <code>
							h1,h2,h3,h4,h5,h6 { font-family : "Open Sans", sans-serif; }
							</code>
							', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
	
	array(
		'type' => 'close'
	),
	

	/* Customize
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Customize', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'customize',
		'icon' => 'eye'
	),
	

		/* Basics
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Basics', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-custom-basics'
		),
			array(
				'name' => _x( 'Advanced Customization', 'Admin Panel', SHORT_NAME ),
				'id' => 'use_custom_css',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'group' => 'custom_css',
				'desc' => _x( 'When this option is enabled system automatically loads custom stylesheet file. You will be able to change template appearance without editing main CSS file.', 'Admin Panel', SHORT_NAME ),
			),
			array(
				'name' => _x( 'Main Color', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_main_color',
				'type' => 'color',
				'plugins' => array( 'colorpicker' ),
				'std' => '',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Main theme color.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Text Color', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_text_color',
				'type' => 'color',
				'plugins' => array( 'colorpicker' ),
				'std' => '',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Text color.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Background Color', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_body_color',
				'type' => 'color',
				'plugins' => array( 'colorpicker' ),
				'std' => '',
			   	'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Theme background color.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Submenu Width', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_menu_width',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 60,
				'max' => 300,
				'unit' => 'px',
				'std' => '200',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Enter submenu width.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Page Header Background', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_page_header_bg',
				'type' => 'bg_generator',
				'plugins' => array( 'bg_generator', 'colorpicker', 'add_image' ),
				'std' => '',
			   	'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Default page header background.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),


		/* Logo
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Logo', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-custom-logo',
			'main_group'   => 'custom_css',
			'group_name'   => array( 'use_custom_css' )
		),
			array(
				'name' => _x( 'Logo Margin Top', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_logo_margin_top',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 300,
				'unit' => 'px',
				'std' => '0',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Choose logo margin.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Logo Margin Bottom', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_logo_margin_bottom',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 300,
				'unit' => 'px',
				'std' => '0',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Choose logo margin.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Logo Margin Left', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_logo_margin_left',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 300,
				'unit' => 'px',
				'std' => '0',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Choose logo margin.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Logo Margin Right', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_logo_margin_right',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 300,
				'unit' => 'px',
				'std' => '0',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Choose logo margin.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),


		/* Font sizes
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Font Sizer', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-custom-size',
			'main_group'   => 'custom_css',
			'group_name'   => array( 'use_custom_css' )
		),
			array(
				'name' => _x( 'H1 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h1_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '36',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'H2 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h2_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '30',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'H3 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h3_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '24',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'H4 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h4_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '18',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'H5 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h5_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '14',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'H6 Size', 'Admin Panel', SHORT_NAME ),
				'id' => 'css_h6_size',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 12,
				'max' => 72,
				'unit' => 'px',
				'std' => '12',
				'main_group' => 'custom_css',
				'group_name' => array( 'use_custom_css' ),
				'desc' => _x( 'Heading size.', 'Admin Panel', SHORT_NAME )
			),
		
		array(
			'type' => 'sub_close'
		),
	
	array(
		'type' => 'close'
	),


	/* Quick Edit
	 ------------------------------------------------------------------------------------------ */
	array(
		'type'     => 'open',
		'tab_name' => _x( 'Quick Edit', 'Admin Panel', SHORT_NAME ),
		'tab_id'   => 'editing',
		'icon' => 'code'
	),
	
		/* Custom CSS */
		array(
			'type'         => 'sub_open',
			'sub_tab_name' => _x( 'CSS', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id'   => 'sub-custom-css'
		),
			array(
				'type'   => 'code_editor',
				'plugins' => array( 'code_editor' ),
				'lang' => 'css',
				'std'    => '',
				'height' => 'auto',
				'desc'   => _x( 'Add your custom CSS rules here. <br/>Every main CSS rule can be adjusted. Whenever you want to change theme style always use this field. When you do that you\'ll have assurance that whenever you upgrade the theme, your code will stay untouched. <br/>Avoid making changes to "style.css" file directly. Whenever you change something, you can always export your data using Advanced > Import/Export.', 'Admin Panel', SHORT_NAME ),
				'id'     => 'custom_css'
			),
		array(
			'type' => 'sub_close'
		),
	
		/* Custom Javascript */
		array(
			'type'         => 'sub_open',
			'sub_tab_name' => _x( 'Javascript', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id'   => 'sub-custom-js'
		),
			array(
				'type'   => 'code_editor',
				'plugins' => array( 'code_editor' ),
				'lang' => 'js',
				'std'    => '',
				'height' => 'auto',
				'desc'   => _x( 'Add your custom Javascript code. <br/> Below you have simple example of jQuery script: <br/><code>jQuery.noConflict(); <br/>jQuery(document).ready(function () { <br/>alert(\'Hello World!\' );<br/>});</code>', 'Admin Panel', SHORT_NAME ),
				'id'     => 'custom_js'
			),
		array(
			'type' => 'sub_close'
		),
	
	array(
		'type' => 'close'
	),
	
	
	/* Pages
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Pages', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'pages',
		'icon' => 'th-large'
	),
	
		/* Basics
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Basics', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-homepage'
		),
			array(
				'name' => _x( 'Comment Date Format', 'Admin Panel', SHORT_NAME ),
				'id' => 'custom_comment_date',
				'type' => 'text',
				'std' => 'F j, Y (H:i)',
				'desc' => _x( 'Enter your custom comment date. <a href="http://codex.wordpress.org/Formatting_Date_and_Time">Click Here for more information</a>', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Display Comments on Pages', 'Admin Panel', SHORT_NAME ),
				'id' => 'display_comments',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'When this option is disabled, the comments disappear from all regular pages.', 'Admin Panel', SHORT_NAME )
			),

		array(
			'type' => 'sub_close'
		),

		/* Blog
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Blog', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-blog'
		),
			array(
				'name' => _x( 'Blog Page', 'Admin Panel', SHORT_NAME ),
				'id' => 'blog_page',
				'type' => 'pages',
				'options' => array(
					array( 'name' => '', 'value' => 'none' )
				),
				'std' => '',
				'desc' => _x( 'Select blog page.', 'Admin Panel', SHORT_NAME )
			),

		array(
			'type' => 'sub_close'
		),


		/* Artists
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Artists', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-artists'
		),
			array(
				'name' => _x( 'Artists Page', 'Admin Panel', SHORT_NAME ),
				'id' => 'artists_page',
				'type' => 'pages',
				'options' => array(
								   array( 'name' => '', 'value' => 'none' )
				),
				'std' => '',
				'desc' => _x( 'Select artists page.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Artist Template', 'Admin Panel', SHORT_NAME ),
				'id' => 'artist_template',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '[1_3]

[icon_heading icon="bio"]Bio.
[color][title][/color][/icon_heading]

[details_list]

[detail name="Orgin"]London, UK[/detail]
[detail name="Links"]<a href="#">Facebook</a> <a href="#">Twitter</a>[/detail]
[detail name="email"]<a href="#">contact@eprom.com</a>[/detail]
[detail name="Genres"][genres][/detail]

[/details_list]

[nav]

[/1_3]

[2_3_last]

<h3>Description.</h3>

Content here...

[/2_3_last]',
				'height' => '200',
				'desc' => _x( 'Here you can create a default template for your artist. Here\'s a list of available shortcodes:.<br> [nav] - Display artists navigation. <br> [cats] - Display artists categories.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Artists Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'artists_slug',
				'type' => 'text',
				'std' => 'artist',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Artists Genres Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'artists_cat_slug',
				'type' => 'text',
				'std' => 'artists-genre',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Artists Categories Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'artists_group_slug',
				'type' => 'text',
				'std' => 'artists-category',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),

		array(
			'type' => 'sub_close'
		),

		/* Releases
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Releases', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-releases'
		),
			array(
				'name' => _x( 'Releases Page', 'Admin Panel', SHORT_NAME ),
				'id' => 'releases_page',
				'type' => 'pages',
				'options' => array(
								   array( 'name' => '', 'value' => 'none' )
				),
				'std' => '',
				'desc' => _x( 'Select releases page.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Releases Order', 'Admin Panel', SHORT_NAME ),
				'id' => 'releases_order',
				'type' => 'select',
				'std' => 'date',
				'desc' => _x( 'Releases order allows you to set the order of pages through a drag and drop interface or by date.', 'Admin Panel', SHORT_NAME ),
				'options' => array(
					array( 'name' => 'Date', 'value' => 'date' ),
					array( 'name' => 'Drag and drop', 'value' => 'custom' )
				)
			),
			array(
				'name' => _x( 'Release Template', 'Admin Panel', SHORT_NAME ),
				'id' => 'release_template',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '[1_3]

[icon_heading icon="bio"]Release.
[color][title][/color][/icon_heading]

[details_list]

[detail name="Date"][date][/detail]
[detail name="Catalog"][catalog][/detail]
[detail name="Genres"][genres][/detail]
[detail name="Artists"][artists_names][/detail]

[/details_list]

[cover]

[nav]

[/1_3]

[2_3_last]

<h3>Description.</h3>

Content here...

[/2_3_last]',
				'height' => '200',
				'desc' => _x( 'Here you can create a default template for your release. Here\'s a list of available shortcodes:.<br> [nav] - Display releases navigation. <br> [genres] - Display release genres. <br> [artists_names] - Display release artists. <br> [catalog] - Display catalog number/name. <br> [date] - Display release date. <br> [cover] - Display release image.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Releases slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'releases_slug',
				'type' => 'text',
				'std' => 'releases',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Releases Genre Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'releases_genre_slug',
				'type' => 'text',
				'std' => 'releases-genre',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Releases Artist Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'releases_artist_slug',
				'type' => 'text',
				'std' => 'releases-artist',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),

		/* Events
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Events', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-events'
		),
			array(
				'name' => _x( 'Events Page', 'Admin Panel', SHORT_NAME ),
				'id' => 'events_page',
				'type' => 'pages',
				'options' => array(
								   array( 'name' => '', 'value' => 'none' )
				),
				'std' => '',
				'desc' => _x( 'Select events page.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Events Manager Order', 'Admin Panel', SHORT_NAME ),
				'id' => 'events_order',
				'type' => 'select',
				'std' => 'start_date',
				'desc' => _x( 'Please select events order.', 'Admin Panel', SHORT_NAME ),
				'options' => array(
								   array( 'name' => 'Start event date', 'value' => 'start_date' ),
								   array( 'name' => 'End event date', 'value' => 'end_date' )
				  ),
			),
			array(
				'name' => _x( 'Event Date Format', 'Admin Panel', SHORT_NAME ),
				'id' => 'event_custom_date',
				'type' => 'select',
				'std' => 'd/m',
				'options' => array(
								   array( 'name' => 'd/m', 'value' => 'd/m' ),
								   array( 'name' => 'm/d', 'value' => 'm/d' )
				  ),
				'desc' => _x( 'Select your events date format.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Single Event Template', 'Admin Panel', SHORT_NAME ),
				'id' => 'event_template',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '[1_3]

[icon_heading icon="contact"]Details.
[color][title][/color][/icon_heading]

[details_list]

[detail name="Date"][event_date][/detail]
[detail name="Time"][event_time end_time="false" military_time="true"][/detail]
[detail name="Address"]Event address here...[/detail]
[detail name="Tickets"]<a href="#">contact@eprom.com</a>[/detail]
[detail name="Tel."](123) 563-9899-234[/detail]
[detail name="Categories"][cats][/detail]

[/details_list]

[add_to_calendar size="small" title="Add to Google Calendar" timezone_offset="+02:00" css_style=""]

[nav]

[/1_3]

[2_3_last]

<h3>Description.</h3>

Content here...

[/2_3_last]',
				'height' => '200',
				'desc' => _x( 'Here you can create a default template for your event. Here\'s a list of available shortcodes:.<br> [nav] - Display events navigation. <br> [start_date] - Display start date. <br> [title] - Display event title. <br> [event_time] - Display event time (start/end). <br> [cats] - Display event categories. <br> [add_to_calendar] - Display button with event data. The event can be added to Google Calendar', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Events Message', 'Admin Panel', SHORT_NAME ),
				'id' => 'no_events_msg',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '<p><h2>Currently we have no events.<br> [color]New events coming soon.[/color]</h2></p>',
				'height' => '200',
				'desc' => _x( 'Here you can create a message or information which will be shown when there are no active events on the page.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Custom post slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'events_slug',
				'type' => 'text',
				'std' => 'event',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Custom category slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'events_cat_slug',
				'type' => 'text',
				'std' => 'event-category',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),

		array(
			'type' => 'sub_close'
		),

		/* Gallery
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Gallery', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-gallery'
		),

			array(
					'name' => _x( 'Gallery Order', 'Admin Panel', SHORT_NAME ),
					'id' => 'gallery_order',
					'type' => 'select',
					'std' => 'date',
					'desc' => _x( 'Gallery order allows you to set the order of pages through a drag and drop interface or by date.', 'Admin Panel', SHORT_NAME ),
					'options' => array(
						array( 'name' => 'Date', 'value' => 'date' ),
						array( 'name' => 'Drag and drop', 'value' => 'custom' )
					)
			),
			array(
				'name' => _x( 'Gallery Page', 'Admin Panel', SHORT_NAME ),
				'id' => 'gallery_page',
				'type' => 'pages',
				'options' => array(
								   array( 'name' => '', 'value' => 'none' )
				),
				'std' => '',
				'desc' => _x( 'Select gallery page.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Gallery Slug', 'Admin Panel', SHORT_NAME ),
				'id' => 'gallery_slug',
				'type' => 'text',
				'std' => 'galleries',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. <br/>IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),


		/* Contact
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Contact', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-contact'
		),
			array(
				'name' => _x( 'E-mail Address', 'Admin Panel', SHORT_NAME ),
				'id' => 'email',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter your email address.', 'Admin Panel', SHORT_NAME )
			),

		array(
			'type' => 'sub_close'
		),


		/* Shop
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Shop', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-pages-shop'
		),
			array(
				'name' => _x( 'Sidebar on Products List', 'Admin Panel', SHORT_NAME ),
				'id' => 'products_sidebar',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Display sidebar on products list.', 'Admin Panel', SHORT_NAME ),
			),	
			array(
				'name' => _x( 'Sidebar on Single Product', 'Admin Panel', SHORT_NAME ),
				'id' => 'product_sidebar',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Display sidebar on single product page.', 'Admin Panel', SHORT_NAME ),
			),
		array(
			'type' => 'sub_close'
		),

	array(
		'type' => 'close'
	),
	

	/* Social integration
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Social Integration', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'social',
		'icon' => 'share'
	),
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Social Bookmarks', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-social-bookmarks'
		),
			array(
				'name' => _x( 'RSS', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_rss',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter "rss". Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Twitter', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_twitter',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Twitter URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Facebook', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_facebook',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Facebook URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Google+', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_gplus',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Google+ URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Lastfm', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_lastfm',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Lastfm URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Soundcloud', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_soundcloud',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'SoundCloud URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'MySpace', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_myspace',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'MySpace URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'YouTube', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_youtube',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'YouTube URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Vimeo', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_vimeo',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Vimeo URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Digg', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_digg',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Digg URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Skype', 'Admin Panel', SHORT_NAME ),
				'id' => 'social_skype',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Skype URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
	array(
		'type' => 'close'
	),
	

	/* Sidebars
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Sidebars', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'sidebars',
		'icon' => 'bars'
	),
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Sidebars', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-sidebars'
		),
			array(
				'name' => _x( 'Sidebars', 'Admin Panel', SHORT_NAME ),
				'sortable' => false,
				'array_name' => 'custom_sidebars',
				'id' => array(
							  array( 'name' => 'name', 'id' => 'sidebar', 'label' => 'Name:' )
							  ),
				'type' => 'sortable_list',
				'button_text' => _x( 'Add Sidebar', 'Admin Panel', SHORT_NAME ),
				'desc' => _x( 'Add your custom sidebars.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
	array(
		'type' => 'close'
	),

	
	/* Advanced
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Advanced', 'Admin Panel', SHORT_NAME ),
		'tab_id' => 'advanced',
		'icon' => 'wrench'
	),
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Advanced', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-advanced'
		),
			array(
				'name' => _x( 'Demo Content', 'Admin Panel', SHORT_NAME ),
				'id' => 'demo_content',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x("Disable this option when your template is ready and you don't need demo content (images, audio, etc...) anymore - this should speed up the template.", 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),
		
		/* Maintenance
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Maintenance', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-admin-maintenance'
		),
			array(
				'name' => _x( 'Maintenance Mode', 'Admin Panel', SHORT_NAME ),
				'id' => 'maintenance_mode',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std'  => 'off',
				'desc' => _x( 'Maintenance mode.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Maintenance Message', 'Admin Panel', SHORT_NAME ),
				'id' => 'maintenance_text',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '<h1>Website Under Maintenance</h1><p>Hi, our Website is currently undergoing scheduled maintenance. Please check back very soon.<br /><strong> Sorry for the inconvenience!</strong></p>',
				'height' => '200',
				'desc' => _x( 'Enter maintenance message.', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),

		/* Admin Panel
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Admin Panel', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-admin-panel'
		),
			array(
				'name' => _x( 'Admin Logo', 'Admin Panel', SHORT_NAME ),
				'id' => 'admin_logo',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => false,
				'width' => '200',
				'height' => '144',
				'crop' => 'c',
				'std' => '',
				'button_title' => _x( 'Add Image', 'Admin Panel', SHORT_NAME ),
				'desc' => _x( 'Upload a logo for your admin panel (200x144 px), or specify the image URL(http://yoursite.com/your_image.jpg).', 'Admin Panel', SHORT_NAME )
			),
		array(
			'type' => 'sub_close'
		),

		/* Theme Scripts
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Scripts', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-scripts',
			'desc' => '<p class="r-message r-info">Exclusion of certain scripts can cause abnormal work of the template. Keep that in mind!</p>'
		),
			array(
				'name' => _x( 'jQuery Easing', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_jquery_easing',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Modernizr', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_modernizr',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Nivo Slider', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_nivo_slider',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Music Player', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_soundmanager',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'music_player',
				'desc' => ''
			),
			array(
				'name' => _x( 'Global Volume Control', 'Admin Panel', SHORT_NAME ),
				'id' => 'volume',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 100,
				'unit' => '',
				'std' => '80',
				'main_group' => 'music_player',
				'group_name' => array( 'js_soundmanager' ),
				'desc' => _x( 'Set global volume control for your music tracks.', 'Admin Panel', SHORT_NAME )
			),
			array(
				'name' => _x( 'Touchswipe', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_touchswipe',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Respond', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_respond',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Fitvideos', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_fitvids',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Countdown', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_countdown',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Isotope', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_isotope',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Social Sharrre', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_sharrre',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Google Maps', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_gmaps',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Lazy Load', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_lazyload',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
			array(
				'name' => _x( 'Fancybox', 'Admin Panel', SHORT_NAME ),
				'id' => 'js_fancybox',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => ''
			),
		array(
			'type' => 'sub_close'
		),
		

		/* Import and export
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Import/Export', 'Admin Panel', SHORT_NAME ),
			'sub_tab_id' => 'sub-import'
		),
			array(
				'type' => 'export'
			),
			array(
				'type' => 'import'
			),
		array(
			'type' => 'sub_close'
		),

	array(
		'type' => 'close'
	),


	/* Hidden fields
	 -------------------------------------------------------- */
	array( 
		'type' => 'hidden_field',
		'id' => 'theme_name',
		'value' => 'Eprom'
	),
	
);


/* Dummy data
 ------------------------------------------------------------------------*/
$dummy_data = 'YTo5NDp7czoxMDoicmVzcG9uc2l2ZSI7czoyOiJvbiI7czoxMToiY3VzdG9tX2RhdGUiO3M6NToiZC9tL1kiO3M6NzoicXVhbGl0eSI7czoyOiI4MCI7czo0OiJza2luIjtzOjg6ImRhcmsuY3NzIjtzOjEwOiJ0b3BfYnV0dG9uIjtzOjI6Im9uIjtzOjEzOiJzdGlja3lfaGVhZGVyIjtzOjM6Im9mZiI7czo4OiJ0b3BfbWVudSI7czoyOiJvbiI7czoxMzoicXRyYW5zX3dpZGdldCI7czoyOiJvbiI7czoxOToicXRyYW5zX2Rpc3BsYXlfdHlwZSI7czo0OiJ0ZXh0IjtzOjE0OiJmb290ZXJfd2lkZ2V0cyI7czozOiJvZmYiO3M6MTM6InR3aXR0ZXJfbGltaXQiO3M6MToiMSI7czoxNToidHdpdHRlcl9yZXBsaWVzIjtzOjI6Im9uIjtzOjk6ImNvcHlyaWdodCI7czoyNDg6IjxwPjxpbWcgYWx0PSIiIHNyYz0iaHR0cDovL2xvY2FsaG9zdC9lcHJvbS93cC1jb250ZW50L3RoZW1lcy9lcHJvbS9zdHlsZXMvaW1nX2RhcmsvZm9vdGVyLWxvZ28ucG5nIiBkYXRhLW1jZS1zcmM9Imh0dHA6Ly9sb2NhbGhvc3QvZXByb20vd3AtY29udGVudC90aGVtZXMvZXByb20vc3R5bGVzL2ltZ19kYXJrL2Zvb3Rlci1sb2dvLnBuZyI+Q29weXJpZ2h0IMKpIDIwMDktMjAxMiBFcHJvbS4gQWxsIFJpZ2h0cyBSZXNlcnZlZC48L3A+IjtzOjEzOiJmb290ZXJfdG9wYmFyIjtzOjI6Im9uIjtzOjE0OiJ0b3BiYXJfYWRkcmVzcyI7czoyNDoiTWVsYm91cm5lLCBBVSwgVklDIDMwMDAuIjtzOjEwOiJ0b3BiYXJfdGVsIjtzOjE4OiIoMTIzKSA1NjMtOTg5OS0yMzQiO3M6MTI6InRvcGJhcl9lbWFpbCI7czoxNzoiY29udGFjdEBlcHJvbS5jb20iO3M6MTM6ImFkZHJlc3NfY2xhc3MiO3M6NzoiY29sLTEtMiI7czoxMjoic29jaWFsX2NsYXNzIjtzOjEyOiJjb2wtMS0yIGxhc3QiO3M6MTU6InVzZV9jdWZvbl9mb250cyI7czozOiJvZmYiO3M6MTE6ImN1Zm9uX2ZvbnRzIjtzOjI0OiJQVF9TYW5zX0JvbGRfNzAwLmZvbnQuanMiO3M6MTA6ImN1Zm9uX2NvZGUiO3M6Njg6IkN1Zm9uLnJlcGxhY2UoImJvZHkiLCB7Zm9udEZhbWlseSA6ICJQVCBTYW5zIEJvbGQiLCBob3ZlcjogInRydWUifSk7IjtzOjE2OiJ1c2VfZ29vZ2xlX2ZvbnRzIjtzOjI6Im9uIjtzOjEyOiJnb29nbGVfZm9udHMiO2E6MTp7aTowO2E6MTp7czo5OiJmb250X2xpbmsiO3M6MTIzOiI8bGluayBocmVmPSdodHRwOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1PcGVuK1NhbnM6NDAwaXRhbGljLDgwMGl0YWxpYyw0MDAsODAwJyByZWw9J3N0eWxlc2hlZXQnIHR5cGU9J3RleHQvY3NzJz4iO319czoxMToiZ29vZ2xlX2NvZGUiO3M6NjA6ImgxLGgyLGgzLGg0LGg1LGg2IHsgZm9udC1mYW1pbHkgOiAiT3BlbiBTYW5zIiwgc2Fucy1zZXJpZjsgfSI7czoxNDoidXNlX2N1c3RvbV9jc3MiO3M6Mzoib2ZmIjtzOjE0OiJjc3NfbWVudV93aWR0aCI7czozOiIyMDAiO3M6MTk6ImNzc19sb2dvX21hcmdpbl90b3AiO3M6MToiMCI7czoyMjoiY3NzX2xvZ29fbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjIwOiJjc3NfbG9nb19tYXJnaW5fbGVmdCI7czoxOiIwIjtzOjIxOiJjc3NfbG9nb19tYXJnaW5fcmlnaHQiO3M6MjoiMjAiO3M6MTE6ImNzc19oMV9zaXplIjtzOjI6IjM2IjtzOjExOiJjc3NfaDJfc2l6ZSI7czoyOiIzMCI7czoxMToiY3NzX2gzX3NpemUiO3M6MjoiMjQiO3M6MTE6ImNzc19oNF9zaXplIjtzOjI6IjE4IjtzOjExOiJjc3NfaDVfc2l6ZSI7czoyOiIxNCI7czoxMToiY3NzX2g2X3NpemUiO3M6MjoiMTIiO3M6MTk6ImN1c3RvbV9jb21tZW50X2RhdGUiO3M6MTI6IkYgaiwgWSAoSDppKSI7czoxNjoiZGlzcGxheV9jb21tZW50cyI7czoyOiJvbiI7czo5OiJibG9nX3BhZ2UiO3M6MzoiMTI2IjtzOjEyOiJhcnRpc3RzX3BhZ2UiO3M6MzoiMzk5IjtzOjE1OiJhcnRpc3RfdGVtcGxhdGUiO3M6NTMwOiI8cD5bMV8zXTwvcD48cD5baWNvbl9oZWFkaW5nIGljb249ImJpbyJdQmlvLjxicj4gW2NvbG9yXVt0aXRsZV1bL2NvbG9yXVsvaWNvbl9oZWFkaW5nXTwvcD48cD5bZGV0YWlsc19saXN0XTwvcD48cD5bZGV0YWlsIG5hbWU9Ik9yZ2luIl1Mb25kb24sIFVLWy9kZXRhaWxdPGJyPiBbZGV0YWlsIG5hbWU9IkxpbmtzIl08YSBocmVmPSIjIiBkYXRhLW1jZS1ocmVmPSIjIj5GYWNlYm9vazwvYT4gPGEgaHJlZj0iIyIgZGF0YS1tY2UtaHJlZj0iIyI+VHdpdHRlcjwvYT5bL2RldGFpbF08YnI+IFtkZXRhaWwgbmFtZT0iZW1haWwiXTxhIGhyZWY9IiMiIGRhdGEtbWNlLWhyZWY9IiMiPmNvbnRhY3RAZXByb20uY29tPC9hPlsvZGV0YWlsXTxicj4gW2RldGFpbCBuYW1lPSJHZW5yZXMiXVtjYXRzXVsvZGV0YWlsXTwvcD48cD5bL2RldGFpbHNfbGlzdF08L3A+PHA+W25hdl08L3A+PHA+Wy8xXzNdPC9wPjxwPlsyXzNfbGFzdF08L3A+PGgzPkRlc2NyaXB0aW9uLjwvaDM+PHA+Q29udGVudCBoZXJlLi4uPC9wPjxwPlsvMl8zX2xhc3RdPC9wPiI7czoxMjoiYXJ0aXN0c19zbHVnIjtzOjc6ImFydGlzdHMiO3M6MTY6ImFydGlzdHNfY2F0X3NsdWciO3M6MTM6ImFydGlzdHMtZ2VucmUiO3M6MTg6ImFydGlzdHNfZ3JvdXBfc2x1ZyI7czoxNjoiYXJ0aXN0cy1jYXRlZ29yeSI7czoxMzoicmVsZWFzZXNfcGFnZSI7czozOiI0MjciO3M6MTQ6InJlbGVhc2VzX29yZGVyIjtzOjY6ImN1c3RvbSI7czoxNjoicmVsZWFzZV90ZW1wbGF0ZSI7czo0Mzg6IjxwPlsxXzNdPC9wPjxwPltpY29uX2hlYWRpbmcgaWNvbj0iYmlvIl1SZWxlYXNlLjxicj4gW2NvbG9yXVt0aXRsZV1bL2NvbG9yXVsvaWNvbl9oZWFkaW5nXTwvcD48cD5bZGV0YWlsc19saXN0XTwvcD48cD5bZGV0YWlsIG5hbWU9IkRhdGUiXVtkYXRlXVsvZGV0YWlsXTxicj4gW2RldGFpbCBuYW1lPSJDYXRhbG9nIl1bY2F0YWxvZ11bL2RldGFpbF08YnI+IFtkZXRhaWwgbmFtZT0iR2VucmVzIl1bZ2VucmVzXVsvZGV0YWlsXTxicj4gW2RldGFpbCBuYW1lPSJBcnRpc3RzIl1bYXJ0aXN0c19uYW1lc11bL2RldGFpbF08L3A+PHA+Wy9kZXRhaWxzX2xpc3RdPC9wPjxwPltjb3Zlcl08L3A+PHA+W25hdl08L3A+PHA+Wy8xXzNdPC9wPjxwPlsyXzNfbGFzdF08L3A+PGgzPkRlc2NyaXB0aW9uLjwvaDM+PHA+Q29udGVudCBoZXJlLi4uPC9wPjxwPlsvMl8zX2xhc3RdPC9wPiI7czoxMzoicmVsZWFzZXNfc2x1ZyI7czo4OiJyZWxlYXNlcyI7czoxOToicmVsZWFzZXNfZ2VucmVfc2x1ZyI7czoxNDoicmVsZWFzZXMtZ2VucmUiO3M6MjA6InJlbGVhc2VzX2FydGlzdF9zbHVnIjtzOjE1OiJyZWxlYXNlcy1hcnRpc3QiO3M6MTE6ImV2ZW50c19wYWdlIjtzOjM6IjM0OSI7czoxMjoiZXZlbnRzX29yZGVyIjtzOjEwOiJzdGFydF9kYXRlIjtzOjE3OiJldmVudF9jdXN0b21fZGF0ZSI7czozOiJkL20iO3M6MTQ6ImV2ZW50X3RlbXBsYXRlIjtzOjU4MjoiPHA+WzFfM108L3A+PHA+W2ljb25faGVhZGluZyBpY29uPSJjb250YWN0Il1EZXRhaWxzLjxicj4gW2NvbG9yXVt0aXRsZV1bL2NvbG9yXVsvaWNvbl9oZWFkaW5nXTwvcD48cD5bZGV0YWlsc19saXN0XTwvcD48cD5bZGV0YWlsIG5hbWU9IkRhdGUiXVtldmVudF9kYXRlXVsvZGV0YWlsXTxicj4gW2RldGFpbCBuYW1lPSJUaW1lIl1bZXZlbnRfdGltZV1bL2RldGFpbF08YnI+IFtkZXRhaWwgbmFtZT0iQWRkcmVzcyJdRXZlbnQgYWRkcmVzcyBoZXJlLi4uWy9kZXRhaWxdPGJyPiBbZGV0YWlsIG5hbWU9IlRpY2tldHMiXTxhIGhyZWY9IiMiIGRhdGEtbWNlLWhyZWY9IiMiPmNvbnRhY3RAZXByb20uY29tPC9hPlsvZGV0YWlsXTxicj4gW2RldGFpbCBuYW1lPSJUZWwuIl0oMTIzKSA1NjMtOTg5OS0yMzRbL2RldGFpbF08YnI+IFtkZXRhaWwgbmFtZT0iQ2F0ZWdvcmllcyJdW2NhdHNdWy9kZXRhaWxdPC9wPjxwPlsvZGV0YWlsc19saXN0XTwvcD48cD5bbmF2XTwvcD48cD5bLzFfM108L3A+PHA+WzJfM19sYXN0XTwvcD48aDM+RGVzY3JpcHRpb24uPC9oMz48cD5Db250ZW50IGhlcmUuLi48L3A+PHA+Wy8yXzNfbGFzdF08L3A+IjtzOjEzOiJub19ldmVudHNfbXNnIjtzOjgwOiI8aDI+Q3VycmVudGx5IHdlIGhhdmUgbm8gZXZlbnRzLjxicj4gW2NvbG9yXU5ldyBldmVudHMgY29taW5nIHNvb24uWy9jb2xvcl08L2gyPiI7czoxMToiZXZlbnRzX3NsdWciO3M6NToiZXZlbnQiO3M6MTU6ImV2ZW50c19jYXRfc2x1ZyI7czoxNDoiZXZlbnQtY2F0ZWdvcnkiO3M6MTM6ImdhbGxlcnlfb3JkZXIiO3M6NDoiZGF0ZSI7czoxMjoiZ2FsbGVyeV9wYWdlIjtzOjM6IjUwNSI7czoxMjoiZ2FsbGVyeV9zbHVnIjtzOjk6ImdhbGxlcmllcyI7czo1OiJlbWFpbCI7czoxNjoiZXhhbXBsZUBtYWlsLmNvbSI7czoxNjoicHJvZHVjdHNfc2lkZWJhciI7czozOiJvZmYiO3M6MTU6InByb2R1Y3Rfc2lkZWJhciI7czozOiJvZmYiO3M6MTA6InNvY2lhbF9yc3MiO3M6MzoicnNzIjtzOjE0OiJzb2NpYWxfdHdpdHRlciI7czoxODoiaHR0cDovL3R3aXR0ZXIuY29tIjtzOjE1OiJzb2NpYWxfZmFjZWJvb2siO3M6MTk6Imh0dHA6Ly9mYWNlYm9vay5jb20iO3M6MTI6InNvY2lhbF9ncGx1cyI7czoyMzoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20iO3M6MTM6InNvY2lhbF9sYXN0Zm0iO3M6MTc6Imh0dHA6Ly9sYXN0Zm0uY29tIjtzOjE3OiJzb2NpYWxfc291bmRjbG91ZCI7czoyMToiaHR0cDovL3NvdW5kY2xvdWQuY29tIjtzOjE0OiJzb2NpYWxfbXlzcGFjZSI7czoxODoiaHR0cDovL215c3BhY2UuY29tIjtzOjE0OiJzb2NpYWxfeW91dHViZSI7czoxODoiaHR0cDovL3lvdXR1YmUuY29tIjtzOjEyOiJzb2NpYWxfdmltZW8iO3M6MTY6Imh0dHA6Ly92aW1lby5jb20iO3M6MTE6InNvY2lhbF9kaWdnIjtzOjE1OiJodHRwOi8vZGlnZy5jb20iO3M6MTI6InNvY2lhbF9za3lwZSI7czoxNjoiaHR0cDovL3NreXBlLmNvbSI7czoxNToiY3VzdG9tX3NpZGViYXJzIjthOjE6e2k6MDthOjE6e3M6NDoibmFtZSI7czoxMToiU2luZ2xlIFBvc3QiO319czoxMjoiZGVtb19jb250ZW50IjtzOjI6Im9uIjtzOjE2OiJtYWludGVuYW5jZV9tb2RlIjtzOjM6Im9mZiI7czoxNjoibWFpbnRlbmFuY2VfdGV4dCI7czoxODI6IjxoMT5XZWJzaXRlIFVuZGVyIE1haW50ZW5hbmNlPC9oMT48cD5IaSwgb3VyIFdlYnNpdGUgaXMgY3VycmVudGx5IHVuZGVyZ29pbmcgc2NoZWR1bGVkIG1haW50ZW5hbmNlLiBQbGVhc2UgY2hlY2sgYmFjayB2ZXJ5IHNvb24uPGJyPjxzdHJvbmc+IFNvcnJ5IGZvciB0aGUgaW5jb252ZW5pZW5jZSE8L3N0cm9uZz48L3A+IjtzOjE2OiJqc19qcXVlcnlfZWFzaW5nIjtzOjI6Im9uIjtzOjEyOiJqc19tb2Rlcm5penIiO3M6Mjoib24iO3M6MTQ6ImpzX25pdm9fc2xpZGVyIjtzOjI6Im9uIjtzOjE1OiJqc19zb3VuZG1hbmFnZXIiO3M6Mjoib24iO3M6Njoidm9sdW1lIjtzOjI6IjgwIjtzOjEzOiJqc190b3VjaHN3aXBlIjtzOjI6Im9uIjtzOjEwOiJqc19yZXNwb25kIjtzOjI6Im9uIjtzOjEwOiJqc19maXR2aWRzIjtzOjI6Im9uIjtzOjEyOiJqc19jb3VudGRvd24iO3M6Mjoib24iO3M6MTA6ImpzX2lzb3RvcGUiO3M6Mjoib24iO3M6MTA6ImpzX3NoYXJycmUiO3M6Mjoib24iO3M6ODoianNfZ21hcHMiO3M6Mjoib24iO3M6MTE6ImpzX2xhenlsb2FkIjtzOjI6Im9uIjtzOjExOiJqc19mYW5jeWJveCI7czoyOiJvbiI7czoxMDoidGhlbWVfbmFtZSI7czo1OiJFcHJvbSI7fQ==';


/* init Panel
 ------------------------------------------------------------------------*/

global $panel_main;

/* Class arguments */
$args = array(
	'admin_path'  => '',
	'admin_uri'	 => '',
	'panel_logo' => '',
	'menu_name' => _x( 'Theme Settings', 'Admin Panel', SHORT_NAME ), 
	'page_name' => 'panel-main.php',
	'option_name' => SHORT_NAME . '_general_settings',
	'admin_dir' => '/framework/admin/panel',
	'menu_icon' => 'dashicons-admin-generic',
	'textdomain' => SHORT_NAME,
	'dummy_data' => $dummy_data
	);

/* Add class instance */
$panel_main = new R_Panel( $args, $panel_main_options );
	
/* Remove variables */
unset( $args, $panel_main_options );

?>