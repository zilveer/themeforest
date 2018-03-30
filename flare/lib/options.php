<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



btp_theme_add_option_group( 'general', array( 'label' => __( 'General', 'btp_theme' ) ), 100 );

	

// ----------------------------------------------------------------------
// General > Main
// ----------------------------------------------------------------------

btp_theme_add_option_subgroup( 'main', array( 'label' => __( 'Main', 'btp_theme' ) ), 'general', 100 );

btp_theme_add_option( 'general_logo_src', array(
	'label' 		=> __('Logo', 'btp_theme'),
	'hint'			=> 
		__(	'E.g. http://www.company.com/images/logo.png', 'btp_theme' ) . '<br />' .
		sprintf( __( 'You can use <a href="%s">the Media Library</a> to upload your image.', 'btp_theme' ),  network_admin_url( 'media-new.php' ) ) . '<br />' .
		sprintf( __( 'Leave it blank to display the site title from <a href="%s">WP General Settings</a> instead.', 'btp_theme'), network_admin_url( 'options-general.php' ) ),
	'default'		=> '',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 10,
));
btp_theme_add_option( 'general_loginlogo_src', array(
	'label' 		=> __('Login Logo', 'btp_theme'),
	'hint'			=> 
		__(	'E.g. http://www.company.com/images/logo.png', 'btp_theme' ) . '<br />' . 
		sprintf( __( 'You can use <a href="%s">the Media Library</a> to upload this image.', 'btp_theme'), network_admin_url( 'media-new.php' ) ),
	'default'		=> '',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 15,
));
btp_theme_add_option( 'general_favicon_src', array(
	'label' 		=> __('Favicon', 'btp_theme'),
	'hint'			=> 
		__( 'E.g. http://www.company.com/images/favicon.ico', 'btp_theme' ) . '<br />' . 
		sprintf( __( 'You can use <a href="%s">the Media Library</a> to upload this image', 'btp_theme'), network_admin_url( 'media-new.php' ) ),
	'default'		=> '',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 20,
));
btp_theme_add_option( 'general_apple_touch_icon_src', array(
	'label'			=> __('Apple touch icon', 'btp_theme'),	
	'hint'			=> 
		__( 'E.g. http://www.company.com/images/apple_touch.png', 'btp_theme' ) . '<br />' . 
		sprintf( __( 'You can use <a href="%s">the Media Library</a> to upload this image.', 'btp_theme'), network_admin_url( 'media-new.php' ) ),
	'default'		=> '',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 30,
));
btp_theme_add_option( 'general_footer_text', array(
	'default'		=> 'Copyright by MyCompany',
	'label'     	=> __('Footer text', 'btp_theme'),
    'hint'      	=> __('E.g. Copyright by MyCompany', 'btp_theme'),
	'i18n'			=> true,
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 200,
));

btp_theme_add_option( 'general_help_mode', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Help Mode', 'btp_theme' ),
	'help'			=> 
		'<p>' . __( 'Enable Help Mode to get some useful tips throughout the site.', 'btp_theme' ) . '</p>' .
		'<p>' . __( 'Help Mode is visible only to users who have been assigned the administrator role, so regular site visitors don\'t see it.', 'btp_theme' ) . '</p>',
	'default'		=> 'standard',
	'choices'		=> array(		
		'standard'		=> __( 'enable', 'btp_theme' ),	
		'none'			=> __( 'disable', 'btp_theme' ),
	),
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 1000,
));
   


btp_theme_add_option_group( 'style', array( 'label' => __( 'Style', 'btp_theme' ) ), 200 );

// ----------------------------------------------------------------------
// Style > Main
// ----------------------------------------------------------------------

btp_theme_add_option_subgroup( 'main', array( 'label' => __( 'Main', 'btp_theme' ) ), 'style', 100 );


// ----------------------------------------------------------------------
// Style > Images
// ----------------------------------------------------------------------
btp_theme_add_option_subgroup( 
	'postthumbnails', 
	array( 
		'label' => __( 'Images', 'btp_theme' ),		
	), 
	'style', 
	200
);
btp_theme_add_option( 'postthumbnails_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<p>' . __( 'Set up the dimensions of the images on the site.', 'btp_theme' ) . '</p>' .
		'<p>' . 
			__( 'Keep in mind, that only newly uploaded images will take into account these changes.', 'btp_theme' ) . ' ' . 
			sprintf(__( 'Older images can be rescaled with the <a href="%s">Regenerate Thumbnails Plugin</a>', 'btp_theme' ), esc_url( 'http://wordpress.org/extend/plugins/regenerate-thumbnails/ ') ) . 
		'</p>',		
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 90,
));
btp_theme_add_option( 'postthumbnails_slider_wide', array(
	'label'			=> 'slider_wide',
	'default'		=> array(
		'name'		=> 'slider_wide',
		'width'		=> 960,
		'height'	=> 360,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 200,
			'max'			=> 500,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 100,
));
btp_theme_add_option( 'postthumbnails_slider_narrow', array(
	'label'			=> 'slider_narrow',
	'default'		=> array(
		'name'		=> 'slider_narrow',
		'width'		=> 816,
		'height'	=> 320,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 200,
			'max'			=> 500,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 105,
));
btp_theme_add_option( 'postthumbnails_max', array(
	'label'			=> 'max',
	'default'		=> array(
		'name'		=> 'max',
		'width'		=> 960,
		'height'	=> 360,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 200,
			'max'			=> 1000,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 108,
));
btp_theme_add_option( 'postthumbnails_two_third', array(
	'label'			=> 'two_third',
	'default'		=> array(
		'name'		=> 'two_third',
		'width'		=> 628,
		'height'	=> 353,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 100,
			'max'			=> 500,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 110,
));

btp_theme_add_option( 'postthumbnails_one_half', array(
	'label'			=> 'one_half',
	'default'		=> array(
		'name'		=> 'one_half',
		'width'		=> 462,
		'height'	=> 260,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 100,
			'max'			=> 500,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 120,
));
btp_theme_add_option( 'postthumbnails_one_third', array(	
	'label'			=> 'one_third',
	'default'		=> array(
		'name'		=> 'one_third',
		'width'		=> 296,
		'height'	=> 167,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 100,
			'max'			=> 400,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 140,
));
btp_theme_add_option( 'postthumbnails_one_fourth', array(	
	'label'			=> 'one_fourth',
	'default'		=> array(
		'name'		=> 'one_fourth',
		'width'		=> 213,
		'height'	=> 120,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 20,
			'max'			=> 600,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 150,
));
btp_theme_add_option( 'postthumbnails_one_twelfth', array(	
	'label'			=> 'one_twelfth',
	'default'		=> array(
		'name'		=> 'one_twelfth',
		'width'		=> 47,
		'height'	=> 47,
		'crop'		=> true,
	),
	'children'		=> array(
		'height'		=> array(
			'view'			=> 'Range',
			'label'			=> __( 'Height', 'btp_theme' ),
			'min'			=> 20,
			'max'			=> 100,
			'step'			=> 1,
		),
	),
	'group'			=> 'style',
	'subgroup'		=> 'postthumbnails',
	'position'		=> 180,
));



// ----------------------------------------------------------------------
// Style > Fonts
// ----------------------------------------------------------------------	

btp_theme_add_option_subgroup( 
	'fonts', 
	array( 
		'label' => __( 'Fonts', 'btp_theme' ),		
	), 
	'style', 
	300
);

btp_theme_add_option( 'style_font_important', array(
	'view'			=> 'Font',
	'label' 		=> __('Important Text', 'btp_theme'),
	'default'		=> array(
		'selector'		=> 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, .lead, .site-title',
	),
	'children'		=> array(
		'font'			=> array(			
			'view'			=> 'Choice',
			'label'			=> __( 'Font', 'btp_theme' ),
			'null'			=> '',
			'choices_cb'	=> 'btp_font_get_choices',
		),			
	),		
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 22,
));
btp_theme_add_option( 'style_h1_font_size', array(
	'type'			=> 'CSS',		
	'label' 		=> __('h1 font-size', 'btp_theme'),
	'css'			=> 'h1, .h1 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 110,
));	
btp_theme_add_option( 'style_h2_font_size', array(
	'type'			=> 'CSS',			
	'label' 		=> __('h2 font-size', 'btp_theme'),
	'css'			=> 'h2, .h2 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 120,
));	
btp_theme_add_option( 'style_h3_font_size', array(
	'type'			=> 'CSS',		
	'label' 		=> __('h3 font-size', 'btp_theme'),
	'css'			=> 'h3, .h3 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 130,
));	
btp_theme_add_option( 'style_h4_font_size', array(
	'type'			=> 'CSS',		
	'label' 		=> __('h4 font-size', 'btp_theme'),
	'css'			=> 'h4, .h4 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 140,
));
btp_theme_add_option( 'style_h5_font_size', array(
	'type'			=> 'CSS',
	'label' 		=> __('h5 font-size', 'btp_theme'),
	'css'			=> 'h5, .h5 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 150,
));	
btp_theme_add_option( 'style_h6_font_size', array(
	'type'			=> 'CSS',		
	'label' 		=> __('h6 font-size', 'btp_theme'),
	'css'			=> 'h6, .h6 { font-size:%dpx; }',
	'group'			=> 'style',
	'subgroup'		=> 'fonts',
	'position'		=> 160,
));



// ----------------------------------------------------------------------
// Style > Preheader
// ----------------------------------------------------------------------

btp_theme_add_option_subgroup( 
	'preheader', 
	array( 
		'label' => __( 'Preheader', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Preheader Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	500
);


btp_theme_add_option( 'style_preheader_layout', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Preheader layout', 'btp_theme'),
	'help'			=> __( 'soon...', 'btp_theme' ),
	'default'		=> '1/4_1/4_1/4_1/4',
	'choices_cb'	=> 'btp_preheader_get_layout_choices',
	'help'			=>  
		'<p>' . __( 'The preheader is a collapsible, widget-ready theme area above the header.', 'btp_theme'). '</p>' .
		'<p>' . 
			__( 'To enable it, just select a non-empty column layout below.', 'btp_theme' ) . ' ' .
			__( 'The first column will then display <em>preheader-1</em> sidebar, the second column will display <em>preheader-2</em> sidebar and so on.', 'btp_theme' ) . ' ' .
			sprintf( __( 'To assign some widgets to these sidebars go to the <a href="%s">Widgets</a> section.', 'btp_theme' ), network_admin_url( 'widgets.php' ) ) . 
		'</p>', 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 100,
));
btp_theme_add_option( 'preheader_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 200,
));
btp_theme_add_option( 'preheader_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 210,
));
btp_theme_add_option( 'preheader_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 220,
));
btp_theme_add_option( 'preheader_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 230,
));
btp_theme_add_option( 'preheader_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 240,
));
btp_theme_add_option( 'preheader_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 250,
));
btp_theme_add_option( 'preheader_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 260,
));
btp_theme_add_option( 'preheader_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 270,
));
btp_theme_add_option( 'preheader_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 280,
));
btp_theme_add_option( 'preheader_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 400,
));
btp_theme_add_option( 'preheader_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 410,
));
btp_theme_add_option( 'preheader_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 420,
));
btp_theme_add_option( 'preheader_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 430,
));
btp_theme_add_option( 'preheader_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 440,
));
btp_theme_add_option( 'preheader_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'preheader',
	'position'		=> 450,
));


// ----------------------------------------------------------------------
// Style > Header
// ----------------------------------------------------------------------



btp_theme_add_option_subgroup( 
	'header', 
	array( 
		'label' => __( 'Header', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Header Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	600
);
btp_theme_add_option( 'style_header_logo_margin_top', array(
	'label' 		=> __( 'Logo margin top', 'btp_theme' ),
	'default'		=> 20,
	'min'			=> 0,
	'max'			=> 100,
	'step'			=> 1,	
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 10
));

btp_theme_add_option( 'style_header_logo_margin_bottom', array(
	'label' 		=> __( 'Logo margin bottom', 'btp_theme' ),
	'default'		=> 20,
	'min'			=> 0,
	'max'			=> 100,
	'step'			=> 1,	
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 12
));

btp_theme_add_option( 'style_header_primary_nav_margin_top', array(
	'label' 		=> __( 'Primary Nav margin top', 'btp_theme' ),
	'default'		=> 20,
	'min'			=> 0,
	'max'			=> 100,
	'step'			=> 1,	
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 12
));
btp_theme_add_option( 'style_header_tagline', array(
	'view'			=>	'Choice',
	'label' 		=> __('Tagline', 'btp_theme'),
	'default'		=> 'none',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'hint'			=> sprintf( __( 'Whether or not to display the site tagline below the logo.<br /> Go to <a href="%s">WP General Settings</a> to set your tagline.', 'btp_theme' ), network_admin_url( 'options-general.php' ) ),
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 13,
));
btp_theme_add_option( 'style_header_feeds', array(
	'view'			=>	'Choice',
	'label' 		=> __('Feeds', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 14,
));
btp_theme_add_option( 'style_header_searchform', array(
	'view'			=> 'Choice',
	'label' 		=> __('Search form', 'btp_theme'),
	'default'		=> 'standard',
	'choices'		=> array(
		'none'			=> __( 'hide','btp_theme' ),
		'standard'		=> __( 'show', 'btp_theme' ),	
	),
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 14,
));

btp_theme_add_option( 'header_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 200,
));
btp_theme_add_option( 'header_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 210,
));
btp_theme_add_option( 'header_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 220,
));
btp_theme_add_option( 'header_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 230,
));
btp_theme_add_option( 'header_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 240,
));
btp_theme_add_option( 'header_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 250,
));
btp_theme_add_option( 'header_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 260,
));
btp_theme_add_option( 'header_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 270,
));
btp_theme_add_option( 'header_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 280,
));
btp_theme_add_option( 'header_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 400,
));
btp_theme_add_option( 'header_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 410,
));
btp_theme_add_option( 'header_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 420,
));
btp_theme_add_option( 'header_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 430,
));
btp_theme_add_option( 'header_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 440,
));
btp_theme_add_option( 'header_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'header',
	'position'		=> 450,
));


// ----------------------------------------------------------------------
// Style > Precontent
// ----------------------------------------------------------------------


btp_theme_add_option_subgroup( 
	'precontent', 
	array( 
		'label' => __( 'Precontent', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Precontent Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	700
);
btp_theme_add_option( 'precontent_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 200,
));
btp_theme_add_option( 'precontent_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 210,
));
btp_theme_add_option( 'precontent_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 220,
));
btp_theme_add_option( 'precontent_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 230,
));
btp_theme_add_option( 'precontent_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 240,
));
btp_theme_add_option( 'precontent_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 250,
));
btp_theme_add_option( 'precontent_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 260,
));
btp_theme_add_option( 'precontent_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 270,
));
btp_theme_add_option( 'precontent_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 280,
));
btp_theme_add_option( 'precontent_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 400,
));
btp_theme_add_option( 'precontent_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 410,
));
btp_theme_add_option( 'precontent_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 420,
));
btp_theme_add_option( 'precontent_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 430,
));
btp_theme_add_option( 'precontent_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 440,
));
btp_theme_add_option( 'precontent_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'precontent',
	'position'		=> 450,
));



// ----------------------------------------------------------------------
// Style > Content
// ----------------------------------------------------------------------

btp_theme_add_option_subgroup( 
	'content', 
	array( 
		'label' => __( 'Content', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Content Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	800
);
btp_theme_add_option( 'content_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 200,
));
btp_theme_add_option( 'content_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 210,
));
btp_theme_add_option( 'content_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 220,
));
btp_theme_add_option( 'content_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 230,
));
btp_theme_add_option( 'content_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 240,
));
btp_theme_add_option( 'content_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 250,
));
btp_theme_add_option( 'content_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 260,
));
btp_theme_add_option( 'content_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 270,
));
btp_theme_add_option( 'content_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 280,
));
btp_theme_add_option( 'content_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 400,
));
btp_theme_add_option( 'content_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 410,
));
btp_theme_add_option( 'content_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 420,
));
btp_theme_add_option( 'content_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 430,
));
btp_theme_add_option( 'content_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 440,
));
btp_theme_add_option( 'content_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'content',
	'position'		=> 450,
));



// ----------------------------------------------------------------------
// Style > Prefooter
// ----------------------------------------------------------------------

btp_theme_add_option_subgroup( 
	'prefooter', 
	array( 
		'label' => __( 'Prefooter', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Prefooter Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	900
);


btp_theme_add_option( 'style_prefooter_layout', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Prefooter layout', 'btp_theme'),
	'help'			=> __( 'soon...', 'btp_theme' ),
	'default'		=> '1/4_1/4_1/4_1/4',
	'choices_cb'	=> 'btp_prefooter_get_layout_choices',
	'help'			=>  
		'<p>' . __( 'The prefooter is a widget-ready theme area below the content and above the footer.', 'btp_theme'). '</p>' .
		'<p>' . 
			__( 'To enable it, just select a non-empty column layout below.', 'btp_theme' ) . ' ' .
			__( 'The first column will then display <em>prefooter-1</em> sidebar, the second column will display <em>prefooter-2</em> sidebar and so on.', 'btp_theme' ) . ' ' . 
			sprintf( __( 'To assign some widgets to these sidebars go to <a href="%s">the Widgets</a> section.', 'btp_theme' ), network_admin_url( 'widgets.php' ) ) . 
		'</p>',
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 100,
));
btp_theme_add_option( 'prefooter_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 200,
));
btp_theme_add_option( 'prefooter_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 210,
));
btp_theme_add_option( 'prefooter_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 220,
));
btp_theme_add_option( 'prefooter_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 230,
));
btp_theme_add_option( 'prefooter_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 240,
));
btp_theme_add_option( 'prefooter_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 250,
));
btp_theme_add_option( 'prefooter_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 260,
));
btp_theme_add_option( 'prefooter_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 270,
));
btp_theme_add_option( 'prefooter_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 280,
));
btp_theme_add_option( 'prefooter_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 400,
));
btp_theme_add_option( 'prefooter_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 410,
));
btp_theme_add_option( 'prefooter_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 420,
));
btp_theme_add_option( 'prefooter_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 430,
));
btp_theme_add_option( 'prefooter_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 440,
));
btp_theme_add_option( 'prefooter_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'prefooter',
	'position'		=> 450,
));


// ----------------------------------------------------------------------
// Style > Footer
// ----------------------------------------------------------------------


btp_theme_add_option_subgroup( 
	'footer', 
	array( 
		'label' => __( 'Footer', 'btp_theme' ),
		'help'	=> '<p>' . __( 'Customize the look and feel of the Footer Theme Area.', 'btp_theme' ) . '</p>',
	), 
	'style', 
	1000
);


btp_theme_add_option( 'style_footer_layout', array(
	'view'			=> 'Image_Choice',
	'label' 		=> __('Footer layout', 'btp_theme'),
	'help'			=> 
		'<p>' . __( 'Color legend:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Light grey - footer text', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'Green - footer navigation', 'btp_theme' ). '</li>' .
		'</ul>',
	'default'		=> 'text-nav',
	'choices_cb'	=> 'btp_footer_get_layout_choices',
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 100
));
btp_theme_add_option( 'style_footer_back_to_top', array(
	'view'			=>	'Choice',
	'label' 		=> __('"Top" link', 'btp_theme'),
	'default'		=> 'none',
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 110,
));


btp_theme_add_option( 'footer_cs_1_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Basic Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for regular text and links.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 200,
));
btp_theme_add_option( 'footer_cs_1_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 210,
));
btp_theme_add_option( 'footer_cs_1_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 220,
));
btp_theme_add_option( 'footer_cs_1_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 230,
));
btp_theme_add_option( 'footer_cs_1_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 240,
));
btp_theme_add_option( 'footer_cs_1_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 250,
));
btp_theme_add_option( 'footer_cs_1_meta_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 260,
));
btp_theme_add_option( 'footer_cs_1_meta_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 270,
));
btp_theme_add_option( 'footer_cs_1_meta_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Meta link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 280,
));
btp_theme_add_option( 'footer_cs_2_info', array(
	'view'			=> 'Info',
	'model'			=> null,
	'help'			=>
		'<h3>' . __( 'Distinctive Color Scheme',  'btp_theme' ) . '</h3>' .
		'<p>' . __( 'Below you can override the color scheme for buttons, dropcaps, etc.', 'btp_theme' ) . '</p>',
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 400,
));
btp_theme_add_option( 'footer_cs_2_background', array(
	'view'			=> 'Color',
	'label' 		=> __( 'Background', 'btp_theme' ),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 410,
));
btp_theme_add_option( 'footer_cs_2_heading', array(
	'view'			=> 'Color',
	'label' 		=> __('Heading', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 420,
));
btp_theme_add_option( 'footer_cs_2_text', array(
	'view'			=> 'Color',
	'label' 		=> __('Text', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 430,
));
btp_theme_add_option( 'footer_cs_2_link', array(
	'view'			=> 'Color',
	'label' 		=> __('Link', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 440,
));
btp_theme_add_option( 'footer_cs_2_link_hover', array(
	'view'			=> 'Color',
	'label' 		=> __('Link hover', 'btp_theme'),
	'default'		=> '',	 
	'group'			=> 'style',
	'subgroup'		=> 'footer',
	'position'		=> 450,
));

/*TWITTER */

btp_theme_add_option_group( 'twitter', array( 'label' => __( 'Twitter', 'btp_theme' ) ), 8500 );

btp_theme_add_option_subgroup( 'twitter_oauth_auth', array( 'label' => __( 'oAuth Authentication', 'btp_theme' ) ), 'twitter', 100 );

btp_theme_add_option( 'twitter_oauth_info', array(
    'view'			=> 'Info',
    'model'     	=> null,
    'help'			=>
        __( 'Most of this configuration can found on the application overview page: <a target="_blank" href="http://dev.twitter.com/apps">http://dev.twitter.com/apps</a><br />', 'btp_theme' ).
        __( 'You\'ll need to create a new Application first.', 'btp_theme' ).
        '<br /><br />'.
        '<u>'.__( 'Why do I need to use oAuth?', 'btp_theme' ).'</u><br />'.
        __( 'From the version 1.1 of the API, to use the REST and Streaming API calls Twitter requires authentication.', 'btp_theme' ).
        '<br /><br />'.
        __( 'Read more about <a target="_blank" href="https://dev.twitter.com/docs/rate-limiting/1.1">REST API Rate Limiting in v1.1</a>.', 'btp_theme' ),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_oauth_auth',
    'position'		=> 10,
));

btp_theme_add_option( 'twitter_customer_key', array(
    'label'     	=> __('Consumer key', 'btp_theme' ),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_oauth_auth',
    'position'		=> 20,
));

btp_theme_add_option( 'twitter_customer_secret', array(
    'label'     	=> __('Consumer secret', 'btp_theme' ),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_oauth_auth',
    'position'		=> 30,
));

btp_theme_add_option( 'twitter_access_token', array(
    'label'     	=> __('Access token', 'btp_theme' ),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_oauth_auth',
    'position'		=> 40,
));

btp_theme_add_option( 'twitter_access_token_secret', array(
    'label'     	=> __('Access token secret', 'btp_theme' ),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_oauth_auth',
    'position'		=> 50,
));

btp_theme_add_option_subgroup( 'twitter_cache', array( 'label' => __( 'Cache', 'btp_theme' ) ), 'twitter', 200 );

btp_theme_add_option( 'twitter_cache_duration', array(
    'label'     	=> __('Cache duration', 'btp_theme' ),
    'hint'          => __('in seconds, empty value for default. 0 value means no cache at all (use it only if you use cache for a whole site)', 'btp_theme'),
    'group'			=> 'twitter',
    'subgroup'		=> 'twitter_cache',
    'position'		=> 10,
));

/* MISC */

btp_theme_add_option_group( 'misc', array( 'label' => __( 'Misc', 'btp_theme' ) ), 9000 );

// ----------------------------------------------------------------------
// Misc > Sidebars
// ----------------------------------------------------------------------
btp_theme_add_option_subgroup( 'sidebar', array( 'label' => __( 'Sidebars', 'btp_theme' ) ), 'misc', 100 );
btp_theme_add_option( 'sidebar_generator', array(
	'view'			=> 'Text',
	'label'     	=> __('Manage sidebars', 'btp_theme' ),
	'hint'			=> __( 'Each sidebar name in a new line', 'btp_theme' ),
	'default'		=> 
		'preheader-1' . "\n" .
		'preheader-2' . "\n" .
		'preheader-3' . "\n" .
		'preheader-4' . "\n" .
		'prefooter-1' . "\n" .
		'prefooter-2' . "\n" .
		'prefooter-3' . "\n" .
		'prefooter-4',
	'group'			=> 'misc',
	'subgroup'		=> 'sidebar',
	'position'		=> 10,	
));



// ----------------------------------------------------------------------
// Misc > Tracking code
// ----------------------------------------------------------------------
btp_theme_add_option_subgroup( 'trackingcode', array( 'label' => __( 'Tracking code', 'btp_theme' ) ), 'misc', 200 );
btp_theme_add_option( 'tracking_code', array(
	'view'			=> 'Text',
	'label'     	=> __('Tracking code', 'btp_theme' ),
	'default'		=> '',
	'group'			=> 'misc',
	'subgroup'		=> 'trackingcode',
	'position'		=> 10,	
));
?>