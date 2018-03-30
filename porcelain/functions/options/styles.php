<?php


/**
 * Load the patterns into arrays.
 */

for($i=1; $i>=0.1; $i-=0.1){
	$pexeto_opacity_options[] = array('name'=>(string)$i, 'id'=>(string)$i);
}

$pexeto_styles_options=array( array(
		'name' => 'Style settings',
		'type' => 'title',
		'img' => 'icon-write'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'general', 'name'=>'General' ),
			array( 'id'=>'content', 'name'=>'Content' ),
			array( 'id'=>'footer', 'name'=>'Footer' ),
			array( 'id'=>'fonts', 'name'=>'Fonts' ),
			array( 'id'=>'add_styles', 'name'=>'Additional Styles' )
		)
	),

	/* ------------------------------------------------------------------------*
	 * GENERAL
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'general'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>General Styles</h3>'
	),
	

	array(
		'name' => 'Predefined Accent Color',
		'id' => 'accent_color',
		'type' => 'stylecolor',
		'options' => array( '359bb4','47a5c5','257fb1','77c8a7', '26ae90','258177','dd6053','d14836', 'f49257', 'efc860','bf6b8a','876096','cdc8b2','8c8c8c','535961','323a45', '002d43','0c1f1d' ),
		'std' => '359bb4',
		'desc' => 'This is the accent color of the small detailed elements such as 
			page title section, buttons, image hover, some link colors, etc.'
	),

	array(
		'name' => 'Custom Accent Color',
		'id' => 'custom_accent_color',
		'type' => 'color',
		'desc' => 'You can pick a custom accent color for your theme. 
			This field has priority over the "Predefined Accent Color" field above. '
	),

	array(
		'name' => 'Body Background Color',
		'id' => 'custom_body_bg',
		'type' => 'color',
		'std' => 'f4f4f4',
		'desc' => 'You can select a custom background color for your theme. '
	),

	array(
		'name' => 'Links color',
		'id' => 'link_color',
		'type' => 'color'
	),


	array(
		'type' => 'documentation',
		'text' => '<h3>Header Styles</h3>'
	),

	array(
		'type' => 'multioption',
		'id' => 'header_bg_img',
		'name' => 'Header background image',
		'desc' => 'The image you select in this field will be applied as a
		background image to the header on all the pages of the theme. If you
		would like to select a custom image for each page, you can set it in 
		the "Header Background" field of the page (located in the page settings
		section below the main content editor).',
		'fields' => array(
			array(
				'id' => 'img',
				'name' => 'Background Image',
				'type' => 'upload'
			),
			array(
				'id' => 'opacity',
				'name' => 'Image Opacity',
				'type' => 'select',
				'options' => $pexeto_opacity_options,
				'std' => '1'
			)
		)
	),

	array(
		'name' => 'Header text color',
		'id' => 'header_color',
		'type' => 'color',
		'std' => 'ffffff'
	),

	array(
		'name' => 'Set a dark transparent background to the top header',
		'id' => 'header_overlay_bg',
		'type' => 'checkbox',
		'std' =>false
	),

	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * CONTENT STYLES
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'content'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Main Content Styles</h3>'
	),

	array(
		'name' => 'Content Background Color',
		'id' => 'content_bg',
		'type' => 'color',
		'std' => 'ffffff',
		'desc' => 'You can select a custom background color for all the main
		content areas. '
	),


	array(
		'name' => 'Content Text Color',
		'id' => 'body_color',
		'type' => 'color',
		'std' => '777777'
	),

	array(
		'name' => 'Headings color',
		'id' => 'heading_color',
		'std' => '333332',
		'type' => 'color'
	),

	array(
		'name' => 'Secondary elements background',
		'id' => 'secondary_color',
		'type' => 'color',
		'std' => 'f4f4f4',
		'desc' => 'This is the secondary content color, used in some elements,
		such as tabs and accordion'
		),

	array(
		'name' => 'Secondary elements text color',
		'id' => 'secondary_text_color',
		'type' => 'color',
		'std' => '777777',
		'desc' => 'This is the secondary content text color, used in widgets 
			(tabs, accordion), etc.'
	),

	array(
		'name' => 'Lines and borders color',
		'id' => 'border_color',
		'type' => 'color'
	),


	// array(
	// 	'name' => 'Content icons style',
	// 	'id' => 'icon_style',
	// 	'type' => 'select',
	// 	'options' => array( 
	// 		array( 'id'=>'dark', 'name'=>'Dark' ), 
	// 		array( 'id'=>'light', 'name'=>'Light' ) ),
	// 	'std' => 'dark',
	// 	'desc' => 'You can set the default style of all the icons used in the
	// 	content of the pages, such as blog icons, share icons, etc. If you have
	// 	set a dark skin to the theme, you can select the light icon style so
	// 	they can be more visible.'
	// ),

	array(
		'type' => 'documentation',
		'text' => '<h3>Side content styles</h3>',
		'desc' => 'The styles selected in this section will be applied to the
		side content elements, such as the sidebar elements and the post comments
		section'
	),

	array(
		'name' => 'Text Color',
		'id' => 'side_color',
		'type' => 'color',
		'std' => '777777'
	),

		array(
		'name' => 'Headings color',
		'id' => 'side_heading_color',
		'std' => '333332',
		'type' => 'color'
	),

	array(
		'name' => 'Lines and borders color',
		'id' => 'side_border_color',
		'type' => 'color'
	),

	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * FOOTER STYLES
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'footer'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Main Footer Styles</h3>'
	),

	array(
		'name' => 'Background color',
		'id' => 'footer_bg',
		'std' => '223442',
		'type' => 'color'
	),

	array(
		'name' => 'Text color',
		'id' => 'footer_text_color',
		'std' => 'ffffff',
		'type' => 'color'
	),

	array(
		'name' => 'Heading color',
		'id' => 'footer_title_color',
		'std' => 'ffffff',
		'type' => 'color'
	),

	array(
		'name' => 'Links color',
		'id' => 'footer_link_color',
		'std' => 'ffffff',
		'type' => 'color'
	),

	array(
		'name' => 'Lines and borders color',
		'id' => 'footer_border_color',
		'type' => 'color'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Call-to-action section</h3>'
	),

	array(
		'name' => 'Background color',
		'id' => 'cta_bg_color',
		'std' => 'e7f7fc',
		'type' => 'color'
	),

	array(
		'name' => 'Text color',
		'id' => 'cta_color',
		'std' => '333332',
		'type' => 'color'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Copyright section</h3>'
	),

	array(
		'name' => 'Footer copyright section background color',
		'id' => 'footer_copyright_bg',
		'std' => '142837',
		'type' => 'color'
	),

	array(
		'name' => 'Footer copyright section text color',
		'id' => 'footer_copyright_text',
		'type' => 'color'
	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * FONTS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'fonts'
	),


	array(
		'type' => 'multioption',
		'id' => 'body_font',
		'name' => 'Body font',
		'desc' => 'You can add additional fonts in the Google API fonts section
		below',
		'fields' => array(
			array(
				'id' => 'family',
				'name' => 'Font Family',
				'type' => 'select',
				'options' => pexeto_get_font_options(),
				'std' => 'default' ),
			array(
				'id' => 'size',
				'name' => 'Font Size',
				'type' => 'text',
				'std' => '14',
				'suffix' => 'px'
			),
		)
	),

	array(
		'type' => 'multioption',
		'id' => 'menu_font',
		'name' => 'Menu font',
		'desc' => 'You can add additional fonts in the Google API fonts section
		below',
		'fields' => array(
			array(
				'id' => 'family',
				'name' => 'Font Family',
				'type' => 'select',
				'options' => pexeto_get_font_options(),
				'std' => 'default' ),
			array(
				'id' => 'size',
				'name' => 'Font Size',
				'type' => 'text',
				'std' => '13',
				'suffix' => 'px'
			),
		)
	),

	array(
		'type' => 'select',
		'id' => 'headings_font_family',
		'name' => 'Headings font family',
		'options' => pexeto_get_font_options(),
		'desc' => 'You can add additional fonts in the Google API fonts section
		below',
		'std' => 'default'
	),



	array(
		'type' => 'documentation',
		'text' => '<h3>Google API Fonts</h3>'
	),

	array(
		'name' => 'Enable Google Fonts',
		'id' => 'enable_google_fonts',
		'type' => 'checkbox',
		'std' =>true
	),

	array(
		'name'=>'Add Google Font',
		'id'=>'google_fonts',
		'type'=>'custom',
		'button_text'=>'Add Font',
		'fields'=>array(
			array( 'id'=>'name',
				'type'=>'text',
				'name'=>'Font Name / Font Family',
				'required'=>true ),
			array( 'id'=>'link',
				'type'=>'textarea',
				'name'=>'Font URL',
				'required'=>true ) ),
		'bind_to'=>array(
			'ids'=>array( 'headings_font_family', 'body_font_family', 'menu_font_family' ),
			'links'=>array( 'id'=>'link', 'name'=>'name' )
		),
		'desc'=>'In this field you can add or remove Google Fonts to the theme. 
			In the "Font Name / Font Family" field add the name of the font or a
			font family where the fonts are separated with commeas. In the 
			"Font URL" insert the URL of the font file. Please note that only 
			the font URL should be inserted here (the value that is set within 
			the "href" attribute of the embed link tag Google provides), 
			not the whole embed link tag.<br/><br/> <b>Example values:</b><br /> 
			<b>Font Name / Font Family: </b><br/>\'Archivo Narrow\', sans-serif<br/> 
			<b>Font URL: </b><br/>
			http://fonts.googleapis.com/css?family=Archivo+Narrow<br /><br/> 
			Once you add the font, it will be added to the default font list 
			available to select for each of the elements. For more information, 
			please refer to the "Fonts" section of the documentation included.',
		'std'=>array(array('name'=>"'Open Sans'", 'link'=>'http://fonts.googleapis.com/css?family=Open+Sans:400,700'),
			array('name'=>"'Oswald'", 'link'=>'http://fonts.googleapis.com/css?family=Oswald:400,300,700'))

	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * ADDITIONAL STYLES
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'add_styles'
	),

	array(
		'name' => 'Additional CSS styles',
		'id' => 'additional_styles',
		'type' => 'textarea',
		'large' => true,
		'desc' => 'You can insert some more additional CSS code here. If you would 
			like to do some modifications to the theme\'s CSS, it is recommended to 
			insert the modifications in this field rather than modifying the 
			original style.css file, as the modifications in this field will 
			remain saved trough the theme updates.'
	),

	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );


$pexeto->options->add_option_set( $pexeto_styles_options );
