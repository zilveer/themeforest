<?php


/**
 * Load the patterns into arrays.
 */


$pexeto_styles_options=array( array(
		'name' => 'Typography & Styles',
		'type' => 'title',
		'img' => 'icon-write'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'fonts', 'name'=>'Fonts' ),
			array( 'id'=>'colors', 'name'=>'Colors' ),
			array( 'id'=>'add_styles', 'name'=>'Additional Styles' )
		)
	),



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
		'type' => 'select',
		'id' => 'headings_font_family',
		'name' => 'Headings font family',
		'options' => pexeto_get_font_options(),
		'desc' => 'You can add additional fonts in the Google API fonts section
		below',
		'std' => 'default'
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
			array(
				'name' => 'Style',
				'id' => 'style',
				'type' => 'multicheck',
				'options' => array(
					array( 'id'=>'uppercase', 'name'=>'Uppercase' ),
					array( 'id'=>'bold', 'name'=>'Bold' ),
					array( 'id'=>'italic', 'name'=>'Italic' )),
				'class'=>'include',
				'std' => array('uppercase')
			)
		)
	),

	array(
		'type' => 'multioption',
		'id' => 'header_title_font',
		'name' => 'Page header title font',
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
				'std' => '58',
				'suffix' => 'px'
			),
			array(
				'name' => 'Style',
				'id' => 'style',
				'type' => 'multicheck',
				'options' => array(
					array( 'id'=>'uppercase', 'name'=>'Uppercase' ),
					array( 'id'=>'bold', 'name'=>'Bold' ),
					array( 'id'=>'italic', 'name'=>'Italic' )),
				'class'=>'include',
				'std' => array('uppercase', 'bold')
			)
		)
	),

	array(
		'type' => 'multioption',
		'id' => 'widget_title_font',
		'name' => 'Widgets headings font',
		'desc' => 'Sidebar and Footer widgets headings font settings.<br/>
		You can add additional fonts in the Google API fonts section below',
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
				'std' => '16',
				'suffix' => 'px'
			),
			array(
				'name' => 'Style',
				'id' => 'style',
				'type' => 'multicheck',
				'options' => array(
					array( 'id'=>'uppercase', 'name'=>'Uppercase' ),
					array( 'id'=>'bold', 'name'=>'Bold' ),
					array( 'id'=>'italic', 'name'=>'Italic' )),
				'class'=>'include',
				'std' => array('uppercase', 'bold')
			)
		)
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
			'ids'=>array( 'headings_font_family', 'body_font_family', 'menu_font_family', 'header_title_font_family' ),
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
		'std'=>array(array('name'=>"'Open Sans'", 'link'=>'http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700'),
			array('name'=>"Montserrat", 'link'=>'http://fonts.googleapis.com/css?family=Montserrat:400,700'))

	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * COLORS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id' => 'colors'
	),

	array(
		'type' => 'documentation',
		'text' => '<p>You can customize all the main theme colors in the Appearance &raquo;
		Customize section.</p>
		<p>
		<a class="button button-primary" href="'.admin_url('customize.php').'" target="_blank">Customize Theme Colors</a></p>
		'
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
