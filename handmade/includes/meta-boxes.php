<?php
/*
*
*	Meta Box Functions
*	------------------------------------------------
*	G5Plus Framework
* 	Copyright Swift Ideas 2015 - http://www.g5plus.net
*
*/
global $meta_boxes;

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function g5plus_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'g5plus_';
	/* PAGE MENU */
	$menu_list = array();
	if ( function_exists( 'g5plus_get_menu_list' ) ) {
		$menu_list = g5plus_get_menu_list();
	}

// POST FORMAT: Image
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Image', 'g5plus-handmade'),
		'id' => $prefix .'meta_box_post_format_image',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Image', 'g5plus-handmade'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => esc_html__('Select a image for post','g5plus-handmade')
			),
		),
	);

// POST FORMAT: Gallery
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Gallery', 'g5plus-handmade'),
		'id' => $prefix . 'meta_box_post_format_gallery',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Images', 'g5plus-handmade'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => esc_html__('Select images gallery for post','g5plus-handmade')
			),
		),
	);

// POST FORMAT: Video
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Video', 'g5plus-handmade'),
		'id' => $prefix . 'meta_box_post_format_video',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'g5plus-handmade' ),
				'id'   => $prefix . 'post_format_video',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: Audio
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Audio', 'g5plus-handmade'),
		'id' => $prefix . 'meta_box_post_format_audio',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Audio URL or Embeded Code', 'g5plus-handmade' ),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Quote', 'g5plus-handmade'),
        'id' => $prefix . 'meta_box_post_format_quote',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Quote', 'g5plus-handmade' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Author', 'g5plus-handmade' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Author Url', 'g5plus-handmade' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
	//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Link', 'g5plus-handmade'),
        'id' => $prefix . 'meta_box_post_format_link',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Url', 'g5plus-handmade' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => esc_html__( 'Text', 'g5plus-handmade' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );

	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => esc_html__('Page Layout', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Layout Style', 'g5plus-handmade' ),
				'id'    => $prefix . 'layout_style',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'boxed'	  => esc_html__('Boxed','g5plus-handmade'),
					'wide'	  => esc_html__('Wide','g5plus-handmade'),
					'float'	  => esc_html__('Float','g5plus-handmade')
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Layout', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'full'	  => esc_html__('Full Width','g5plus-handmade'),
					'container'	  => esc_html__('Container','g5plus-handmade'),
					'container-fluid'	  => esc_html__('Container Fluid','g5plus-handmade'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Sidebar', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'none'	  => THEME_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => THEME_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => THEME_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => THEME_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> esc_html__('Left Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','left','both')),
			),

			array (
				'name' 	=> esc_html__('Right Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','right','both')),
			),

			array(
				'name'  => esc_html__( 'Sidebar Width', 'g5plus-handmade' ),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'		=> esc_html__('Default','g5plus-handmade'),
					'small'		=> esc_html__('Small (1/4)','g5plus-handmade'),
					'larger'	=> esc_html__('Large (1/3)','g5plus-handmade')
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'page_sidebar','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Page Class Extra', 'g5plus-handmade'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);
	// PAGE COLOR
	$meta_boxes[] = array(
		'id' => $prefix . 'page_color_meta_box',
		'title' => esc_html__('Page Color', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Customize Page Color?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_page_color',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name' => esc_html__('Primary color', 'g5plus-handmade'),
				'id' => $prefix . 'primary_color',
				'desc' => esc_html__("Optionally set a primary color for the page.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),
			array(
				'name' => esc_html__('Link color', 'g5plus-handmade'),
				'id' => $prefix . 'link_color',
				'desc' => esc_html__("Optionally set a link color for the page.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),
			array(
				'name' => esc_html__('Link color hover', 'g5plus-handmade'),
				'id' => $prefix . 'link_color_hover',
				'desc' => esc_html__("Optionally set a link color hover for the page.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),
			array(
				'name' => esc_html__('Link color active', 'g5plus-handmade'),
				'id' => $prefix . 'link_color_active',
				'desc' => esc_html__("Optionally set a link color active for the page.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),


			array(
				'name' => esc_html__('Top bar background color', 'g5plus-handmade'),
				'id' => $prefix . 'top_bar_bg_color',
				'desc' => esc_html__("Set top bar background color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '#f9f9f9',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),
			array(
				'name'       => esc_html__( 'Top bar background color opacity', 'g5plus-handmade' ),
				'id'         => $prefix .'top_bar_bg_color_opacity',
				'desc'       => esc_html__( 'Set the opacity level of the top bar background color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std'        => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),

			array(
				'name' => esc_html__('Top bar text color', 'g5plus-handmade'),
				'id' => $prefix . 'top_bar_text_color',
				'desc' => esc_html__("Set top bar text color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '#878787',
				'required-field' => array($prefix . 'enable_page_color','=','1'),
			),
		)
	);

	// SITE TOP & TOP DRAWER
	$meta_boxes[] = array(
		'id' => $prefix . 'site_top_meta_box',
		'title' => esc_html__('Site top & Top drawer', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Top Drawer Type', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_type',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'none' => esc_html__('Disable','g5plus-handmade'),
					'show' => esc_html__('Always Show','g5plus-handmade'),
					'toggle' => esc_html__('Toggle','g5plus-handmade')
				),
				'desc' => esc_html__('Top drawer type', 'g5plus-handmade'),
			),
			array (
				'name' 	=> esc_html__('Top Drawer Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer Wrapper Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_wrapper_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'full' => esc_html__('Full Width','g5plus-handmade'),
					'container' => esc_html__('Container','g5plus-handmade'),
					'container-fluid' => esc_html__('Container Fluid','g5plus-handmade')
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer hide on mobile', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_hide_mobile',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Show on mobile','g5plus-handmade'),
					'0' => esc_html__('Hide on mobile','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer padding top', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_padding_top',
				'type' 	=> 'text',
				'desc' => esc_html__("Set padding top for top drawer. Not include units. Blank to default", 'g5plus-handmade'),
				'std'	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer padding bottom', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_drawer_padding_bottom',
				'type' 	=> 'text',
				'desc' => esc_html__("Set padding top for bottom drawer. Not include units. Blank to default", 'g5plus-handmade'),
				'std'	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Show/Hide Top Bar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Show Top Bar','g5plus-handmade'),
					'0' => esc_html__('Hide Top Bar','g5plus-handmade')
				),
				'desc' => esc_html__('Show Hide Top Bar.', 'g5plus-handmade'),
			),

			array (
				'name' 	=> esc_html__('Top Bar Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Left Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Right Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'top_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),
		)
	);


	// PAGE HEADER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_meta_box',
		'title' => esc_html__('Page Header', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Header On/Off?', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_show_hide',
				'type' 	=> 'checkbox',
				'desc' => esc_html__("Switch header ON or OFF?", 'g5plus-handmade'),
				'std'	=> '1',
			),

			array (
				'name' 	=> esc_html__('Header Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-1'	    => THEME_URL.'/assets/images/theme-options/header-1.jpg',
					'header-2'	    => THEME_URL.'/assets/images/theme-options/header-2.jpg',
					'header-3'	    => THEME_URL.'/assets/images/theme-options/header-3.jpg',
					'header-4'	    => THEME_URL.'/assets/images/theme-options/header-4.jpg',
					'header-5'	    => THEME_URL.'/assets/images/theme-options/header-5.jpg',
					'header-6'	    => THEME_URL.'/assets/images/theme-options/header-6.jpg',
					'header-7'	    => THEME_URL.'/assets/images/theme-options/header-7.jpg',
					'header-8'	    => THEME_URL.'/assets/images/theme-options/header-8.jpg',
					'header-9'	    => THEME_URL.'/assets/images/theme-options/header-9.jpg',
				)
			),

			array(
				'id'    => $prefix . 'header_scheme',
				'name'  => esc_html__( 'Header scheme', 'g5plus-handmade' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'light' => esc_html__('Light','g5plus-handmade'),
					'transparent' => esc_html__('Transparent','g5plus-handmade'),
					'customize' => esc_html__('Customize','g5plus-handmade'),
				)
			),

			array(
				'id' => $prefix . 'header_border_color',
				'name' => esc_html__('Header border color', 'g5plus-handmade'),
				'desc' => esc_html__("Set header border color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'         => $prefix .'header_border_color_opacity',
				'name'       => esc_html__( 'Header border color opacity', 'g5plus-handmade' ),
				'desc'       => esc_html__( 'Set the opacity level of the header border color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std'        => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id' => $prefix . 'header_text_color',
				'name' => esc_html__('Header border color', 'g5plus-handmade'),
				'desc' => esc_html__("Set header border color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id' => $prefix . 'header_background_color',
				'name' => esc_html__('Header background color', 'g5plus-handmade'),
				'desc' => esc_html__("Set header background color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'         => $prefix .'header_background_color_opacity',
				'name'       => esc_html__( 'Header background color opacity', 'g5plus-handmade' ),
				'desc'       => esc_html__( 'Set the opacity level of the header background color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std'        => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix.  'header_background_image',
				'name'  => esc_html__('Header Background Image', 'g5plus-handmade'),
				'desc'  => esc_html__('Set header background image', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std' => '',
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix.  'header_background_repeat',
				'name'  => esc_html__('Header Background Repeat', 'g5plus-handmade'),
				'desc'  => esc_html__('Set header background repeat', 'g5plus-handmade'),
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Background Repeat','g5plus-handmade'),
				'std' => '',
				'options' => array(
					'no-repeat' => esc_html__('No Repeat','g5plus-handmade'),
					'repeat'    => esc_html__('Repeat','g5plus-handmade'),
					'repeat-x'  => esc_html__('Repeat-x','g5plus-handmade'),
					'repeat-y'  => esc_html__('Repeat-y','g5plus-handmade'),
					'inherit'   => esc_html__('Inherit','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix.  'header_background_size',
				'name'  => esc_html__('Header Background Size', 'g5plus-handmade'),
				'desc'  => esc_html__('Set header background size', 'g5plus-handmade'),
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Background size','g5plus-handmade'),
				'std' => '',
				'options' => array(
					'inherit'   => esc_html__('Inherit','g5plus-handmade'),
					'cover'    => esc_html__('Cover','g5plus-handmade'),
					'contain' => esc_html__('Contain','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix.  'header_background_attachment',
				'name'  => esc_html__('Header Background Attachment', 'g5plus-handmade'),
				'desc'  => esc_html__('Set header background attachment', 'g5plus-handmade'),
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Background attachment','g5plus-handmade'),
				'std' => '',
				'options' => array(
					'fixed'   => esc_html__('Fixed','g5plus-handmade'),
					'scroll'    => esc_html__('Scroll','g5plus-handmade'),
					'inherit' => esc_html__('Inherit','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix.  'header_background_position',
				'name'  => esc_html__('Header Background Position', 'g5plus-handmade'),
				'desc'  => esc_html__('Set header background position', 'g5plus-handmade'),
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Background position','g5plus-handmade'),
				'std' => '',
				'options' => array(
					'left top'      => esc_html__('Left Top','g5plus-handmade'),
					'left center'   => esc_html__('Left center','g5plus-handmade'),
					'left bottom'   => esc_html__('Left bottom','g5plus-handmade'),
					'center top'    => esc_html__('Center top','g5plus-handmade'),
					'center center' => esc_html__('Center center','g5plus-handmade'),
					'center bottom' => esc_html__('Center bottom','g5plus-handmade'),
					'right top'     => esc_html__('Right top','g5plus-handmade'),
					'right center'  => esc_html__('Right center','g5plus-handmade'),
					'right bottom'  => esc_html__('Right bottom','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'header_scheme','=','customize'),
			),

			array(
				'id'    => $prefix . 'header_nav_layout',
				'name'  => esc_html__( 'Header navigation layout', 'g5plus-handmade' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'container' => esc_html__('Container','g5plus-handmade'),
					'nav-fullwith' => esc_html__('Full width','g5plus-handmade'),
				)
			),

			array(
				'id'         => $prefix .'header_nav_layout_padding',
				'name'       => esc_html__( 'Header navigation padding left/right (px)', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'std'	=> '100',
				'required-field' => array($prefix . 'header_nav_layout','=','nav-fullwith'),
			),

			array(
				'id'        => $prefix . 'header_nav_hover',
				'name'     => esc_html__('Header navigation hover', 'g5plus-handmade'),
				'type'      => 'button_set',
				'std'  => '-1',
				'options'  => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'nav-hover-primary' => 'Primary Color',
					'nav-hover-primary-base' => 'Base Primary Color'
				),
			),

			array(
				'id'        => $prefix . 'header_nav_distance',
				'type'      => 'text',
				'name'     => esc_html__('Header navigation distance', 'g5plus-handmade'),
				'desc'      => esc_html__('You can set distance between navigation items. Empty value to default', 'g5plus-handmade'),
				'std'	=> '',
			),

			array(
				'id'    => $prefix . 'header_nav_scheme',
				'name'  => esc_html__( 'Header navigation scheme', 'g5plus-handmade' ),
				'type'  => 'button_set',
				'desc' => esc_html__("Set header navigation scheme", 'g5plus-handmade'),
				'std'	=> '-1',
				'options' => array(
					'-1'            => esc_html__('Default','g5plus-handmade'),
					'light' => esc_html__('Light','g5plus-handmade'),
					'primary-color' => esc_html__('Primary Color','g5plus-handmade'),
					'transparent' => esc_html__('Transparent','g5plus-handmade'),
					'customize' => esc_html__('Customize','g5plus-handmade')
				)
			),

			array(
				'name' => esc_html__('Header navigation background color', 'g5plus-handmade'),
				'id' => $prefix . 'header_nav_bg_color_color',
				'desc' => esc_html__("Set header navigation background color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'header_nav_scheme','=','customize'),
			),

			array(
				'name'       => esc_html__( 'Overlay Opacity', 'g5plus-handmade' ),
				'id'         => $prefix .'header_nav_bg_color_opacity',
				'desc'       => esc_html__( 'Set the opacity level of the header navigation background color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'header_nav_scheme','=','customize'),
			),

			array(
				'name' => esc_html__('Header navigation text color', 'g5plus-handmade'),
				'id' => $prefix . 'header_nav_text_color',
				'desc' => esc_html__("Set header navigation text color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'header_nav_scheme','=','customize'),
			),

			array (
				'name' 	=> esc_html__('Header Float', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_layout_float',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Enable','g5plus-handmade'),
					'0' => esc_html__('Disable','g5plus-handmade')
				),
				'desc' => esc_html__('Enable/disable header float.', 'g5plus-handmade'),
			),

			array (
				'name' 	=> esc_html__('Header Sticky', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_sticky',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Enable Header Sticky','g5plus-handmade'),
					'0' => esc_html__('Disable Header Sticky','g5plus-handmade'),
				),
			),

			array(
				'name'    => esc_html__( 'Header sticky scheme', 'g5plus-handmade' ),
				'id'       => $prefix . 'header_sticky_scheme',
				'type'     => 'button_set',
				'options'  => array(
					'-1'   => esc_html__('Default','g5plus-handmade'),
					'inherit'   => esc_html__('Inherit','g5plus-handmade'),
					'gray'      => esc_html__('Gray','g5plus-handmade'),
					'light'     => esc_html__('Light','g5plus-handmade'),
					'dark'     => esc_html__('Dark','g5plus-handmade')
				),
				'std'  => '-1'
			),
		)
	);

	// HEADER CUSTOMIZE
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_customize_meta_box',
		'title' => esc_html__('Page Header Customize', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Set header customize navigation?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_header_customize_nav',
				'type'  => 'checkbox',
				'std'	=> 0,
			),

			array (
				'name' 	=> esc_html__('Header Customize Navigation', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_nav',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => esc_html__('Select element for header customize navigation. Drag to change element order', 'g5plus-handmade'),
				'options' => array(
					'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
					'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
					'search-button' => esc_html__('Search Button','g5plus-handmade'),
					'search-box' => esc_html__('Search Box','g5plus-handmade'),
					'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
					'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
					'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),

			array (
				'name' 	=> esc_html__('Search button style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_nav_search_button_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array (
				'name' 	=> esc_html__('Shopping cart Style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_nav_shopping_cart_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array(
				'name' => esc_html__('Custom social profiles', 'g5plus-handmade'),
				'id' => $prefix . 'header_customize_nav_social_profile',
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Select social profiles','g5plus-handmade'),
				'std'	=> '',
				'multiple' => true,
				'options' => array(
					'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array(
				'name'  => esc_html__( 'Custom text content', 'g5plus-handmade' ),
				'id'    => $prefix . 'header_customize_nav_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array (
				'name' 	=> esc_html__('Header customize separate', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_nav_separate',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1'   => esc_html__('Default','g5plus-handmade'),
					'0'         => esc_html__('Off','g5plus-handmade'),
					'1'         => esc_html__('On','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),

			array(
				'name'  => esc_html__( 'Set header customize left?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_header_customize_left',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array (
				'name' 	=> esc_html__('Header Customize Left', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_left',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => esc_html__('Select element for header customize left. Drag to change element order', 'g5plus-handmade'),
				'options' => array(
					'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
					'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
					'search-button' => esc_html__('Search Button','g5plus-handmade'),
					'search-box' => esc_html__('Search Box','g5plus-handmade'),
					'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
					'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
					'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),
			array (
				'name' 	=> esc_html__('Search button style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_left_search_button_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),
			array (
				'name' 	=> esc_html__('Shopping cart Style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_left_shopping_cart_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),
			array(
				'name' => esc_html__('Custom social profiles left', 'g5plus-handmade'),
				'id' => $prefix . 'header_customize_left_social_profile',
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Select social profiles','g5plus-handmade'),
				'std'	=> '',
				'multiple' => true,
				'options' => array(
					'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				),
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),
			array(
				'name'  => esc_html__( 'Custom text content left', 'g5plus-handmade' ),
				'id'    => $prefix . 'header_customize_left_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),
			array (
				'name' 	=> esc_html__('Header customize separate', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_left_separate',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1'   => esc_html__('Default','g5plus-handmade'),
					'0'         => esc_html__('Off','g5plus-handmade'),
					'1'         => esc_html__('On','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_left','=','1'),
			),

			array(
				'name'  => esc_html__( 'Set header customize right?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_header_customize_right',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array (
				'name' 	=> esc_html__('Header Customize Right', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_right',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => esc_html__('Select element for header customize right. Drag to change element order', 'g5plus-handmade'),
				'options' => array(
					'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
					'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
					'search-button' => esc_html__('Search Button','g5plus-handmade'),
					'search-box' => esc_html__('Search Box','g5plus-handmade'),
					'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
					'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
					'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
			array (
				'name' 	=> esc_html__('Search button style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_right_search_button_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
			array (
				'name' 	=> esc_html__('Shopping cart Style', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_right_shopping_cart_style',
				'type' 	=> 'button_set',
				'std' 	=> 'default',
				'options' => array(
					'default'   => esc_html__('Default','g5plus-handmade'),
					'round'     => esc_html__('Round','g5plus-handmade'),
					'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
			array(
				'name' => esc_html__('Custom social profiles right', 'g5plus-handmade'),
				'id' => $prefix . 'header_customize_right_social_profile',
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Select social profiles','g5plus-handmade'),
				'std'	=> '',
				'multiple' => true,
				'options' => array(
					'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				),
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
			array(
				'name'  => esc_html__( 'Custom text content right', 'g5plus-handmade' ),
				'id'    => $prefix . 'header_customize_right_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
			array (
				'name' 	=> esc_html__('Header customize separate', 'g5plus-handmade'),
				'id' 	=> $prefix . 'header_customize_right_separate',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1'   => esc_html__('Default','g5plus-handmade'),
					'0'         => esc_html__('Off','g5plus-handmade'),
					'1'         => esc_html__('On','g5plus-handmade'),
				),
				'required-field' => array($prefix . 'enable_header_customize_right','=','1'),
			),
		)
	);

	// LOGO
	$meta_boxes[] = array(
		'id' => $prefix . 'page_logo_meta_box',
		'title' => esc_html__('Logo', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'id'    => $prefix.  'custom_logo',
				'name'  => esc_html__('Custom Logo', 'g5plus-handmade'),
				'desc'  => esc_html__('Upload custom logo in header.', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
				'id'    => $prefix.  'logo_height',
				'name'  => esc_html__('Logo height', 'g5plus-handmade'),
				'desc'  => esc_html__('Logo height. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_max_height',
				'name'  => esc_html__('Logo max height', 'g5plus-handmade'),
				'desc'  => esc_html__('Logo max height. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_padding_top',
				'name'  => esc_html__('Logo padding top', 'g5plus-handmade'),
				'desc'  => esc_html__('Logo padding top. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix.  'logo_padding_bottom',
				'name'  => esc_html__('Logo padding bottom', 'g5plus-handmade'),
				'desc'  => esc_html__('Logo padding bottom. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix . 'sticky_logo',
				'name'  => esc_html__('Sticky Logo', 'g5plus-handmade'),
				'desc'  => esc_html__('Upload sticky logo in header (empty to default)', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
	);

	// MENU
	$meta_boxes[] = array(
		'id' => $prefix . 'page_menu_meta_box',
		'title' => esc_html__('Menu', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Page menu', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_menu',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => esc_html__('Select Menu','g5plus-handmade'),
				'std'	=> '',
				'multiple' => false,
				'desc' => esc_html__('Optionally you can choose to override the menu that is used on the page', 'g5plus-handmade'),
			),

			array(
				'name'  => esc_html__( 'Page menu mobile', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_menu_mobile',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => esc_html__('Select Menu','g5plus-handmade'),
				'std'	=> '',
				'multiple' => false,
				'desc' => esc_html__('Optionally you can choose to override the menu mobile that is used on the page', 'g5plus-handmade'),
			),

			array(
				'name'  => esc_html__( 'Is One Page', 'g5plus-handmade' ),
				'id'    => $prefix . 'is_one_page',
				'type' 	=> 'checkbox',
				'std' 	=> '0',
				'desc' => esc_html__('Set page style is One Page', 'g5plus-handmade'),
			),
		)
	);


	// PAGE TITLE
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_title_meta_box',
		'title' => esc_html__('Page Title', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Show/Hide Page Title?', 'g5plus-handmade' ),
				'id'    => $prefix . 'show_page_title',
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'	=> esc_html__('Default','g5plus-handmade'),
					'1'	=> esc_html__('Show Page Title','g5plus-handmade'),
					'0'	=> esc_html__('Hide Page Title','g5plus-handmade'),
				)

			),


			array(
				'name'  => esc_html__( 'Page Title Layout', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_title_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'full'	  => esc_html__('Full Width','g5plus-handmade'),
					'container'	  => esc_html__('Container','g5plus-handmade'),
					'container-fluid'	  => esc_html__('Container Fluid','g5plus-handmade'),
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),



			// PAGE TITLE LINE 1
			array(
				'name' => esc_html__('Custom Page Title', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_custom',
				'desc' => esc_html__("Enter a custom page title if you'd like.", 'g5plus-handmade'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE LINE 2
			array(
				'name' => esc_html__('Custom Page Subtitle', 'g5plus-handmade'),
				'id' => $prefix . 'page_subtitle_custom',
				'desc' => esc_html__("Enter a custom page title if you'd like.", 'g5plus-handmade'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE TEXT COLOR
			array(
				'name' => esc_html__('Page Title Text Color', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_text_color',
				'desc' => esc_html__("Optionally set a text color for the page title.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => esc_html__('Page Sub Title Text Color', 'g5plus-handmade'),
				'id' => $prefix . 'page_sub_title_text_color',
				'desc' => esc_html__("Optionally set a text color for the page sub title.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => esc_html__('Page Title Background Color', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_bg_color',
				'desc' => esc_html__("Optionally set a background color for the page title.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => esc_html__( 'Custom Background Image?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_custom_page_title_bg_image',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// BACKGROUND IMAGE
			array(
				'id'    => $prefix.  'page_title_bg_image',
				'name'  => esc_html__('Background Image', 'g5plus-handmade'),
				'desc'  => esc_html__('Background Image for page title.', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'enable_custom_page_title_bg_image','=','1'),
			),

			// PAGE TITLE OVERLAY COLOR
			array(
				'id'   => $prefix. 'page_title_overlay_color',
				'name' => esc_html__( 'Page Title Overlay Color', 'g5plus-handmade' ),
				'desc' => esc_html__( "Set an overlay color for page title image.", 'g5plus-handmade' ),
				'type' => 'color',
				'std'  => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => esc_html__( 'Custom Overlay Opacity?', 'g5plus-handmade' ),
				'id'    => $prefix . 'enable_custom_overlay_opacity',
				'type'  => 'checkbox',
				'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// Overlay Opacity Value
			array(
				'name'       => esc_html__( 'Overlay Opacity', 'g5plus-handmade' ),
				'id'         => $prefix .'page_title_overlay_opacity',
				'desc'       => esc_html__( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_custom_overlay_opacity','=','1'),
			),


			array(
				'name' => esc_html__('Page Title Text Align', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_text_align',
				'desc' => esc_html__("Set Page Title Text Align", 'g5plus-handmade'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'left' => esc_html__('Left','g5plus-handmade'),
					'center' => esc_html__('Center','g5plus-handmade'),
					'right' => esc_html__('Right','g5plus-handmade'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => esc_html__('Page Title Parallax', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_parallax',
				'desc' => esc_html__("Enable Page Title Parallax", 'g5plus-handmade'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Enable','g5plus-handmade'),
					'0' => esc_html__('Disable','g5plus-handmade'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// PAGE TITLE Height
			array(
				'name' => esc_html__('Page Title Height', 'g5plus-handmade'),
				'id' => $prefix . 'page_title_height',
				'desc' => esc_html__("Enter a page title height value (not include unit).", 'g5plus-handmade'),
				'type'  => 'number',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),




			// Breadcrumbs in Page Title
			array(
				'name' => esc_html__('Breadcrumbs', 'g5plus-handmade'),
				'id' => $prefix . 'breadcrumbs_in_page_title',
				'desc' => esc_html__("Show/Hide Breadcrumbs", 'g5plus-handmade'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Show','g5plus-handmade'),
					'0' => esc_html__('Hide','g5plus-handmade'),
				),
				'std' => '-1',
			),
			array(
				'name'  => esc_html__( 'Remove Margin Top', 'g5plus-handmade' ),
				'id'    => $prefix . 'page_title_remove_margin_top',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
            array(
                'name'  => esc_html__( 'Remove Margin Bottom', 'g5plus-handmade' ),
                'id'    => $prefix . 'page_title_remove_margin_bottom',
                'type'  => 'checkbox',
                'std'	=> 0,
            ),
		)
	);

	// PAGE FOOTER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_footer_meta_box',
		'title' => esc_html__('Page Footer', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(

			array (
				'name' 	=> esc_html__('Show/Hide Footer', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => esc_html__('Show Footer','g5plus-handmade'),
					'0' => esc_html__('Hide Footer','g5plus-handmade')
				),
				'desc' => esc_html__('Show/hide footer', 'g5plus-handmade'),
			),


			array (
				'name' 	=> esc_html__('Footer Parallax', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_parallax',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => esc_html__('Enable Footer Parallax', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array (
				'name' 	=> esc_html__('Collapse footer on mobile device', 'g5plus-handmade'),
				'id' 	=> $prefix . 'collapse_footer',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => esc_html__('Enable collapse footer', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array (
				'name' 	=> esc_html__('Wrapper Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_wrap_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'full' => esc_html__('Full Width','g5plus-handmade'),
					'container-fluid' => esc_html__('Container Fluid','g5plus-handmade')
				),
				'desc' => esc_html__('Select Footer Wrapper Layout', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),



			array (
				'name' 	=> esc_html__('Scheme', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_scheme',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'gray'      => esc_html__('Gray','g5plus-handmade'),
					'light'     => esc_html__('Light','g5plus-handmade'),
					'dark'     => esc_html__('Dark','g5plus-handmade'),
					'custom'   => esc_html__('Custom','g5plus-handmade'),
				),
				'desc' => esc_html__('Select Footer Scheme', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),



			array(
				'id' => $prefix . 'footer_bg_color',
				'name' => esc_html__('Background color', 'g5plus-handmade'),
				'desc' => esc_html__("Set footer background color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id'         => $prefix .'footer_bg_color_opacity',
				'name'       => esc_html__( 'Background color opacity', 'g5plus-handmade' ),
				'desc'       => esc_html__( 'Set the opacity level of the footer background color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std' => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'footer_text_color',
				'name' => esc_html__('Text color', 'g5plus-handmade'),
				'desc' => esc_html__("Set footer text color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),




			array(
				'id' => $prefix . 'footer_heading_text_color',
				'name' => esc_html__('Heading text color', 'g5plus-handmade'),
				'desc' => esc_html__("Set footer heading text color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'bottom_bar_bg_color',
				'name' => esc_html__('Bottom Bar Background Color', 'g5plus-handmade'),
				'desc' => esc_html__("Set Bottom Bar Background Color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id'         => $prefix .'bottom_bar_bg_color_opacity',
				'name'       => esc_html__( 'Bottom Bar Background color opacity', 'g5plus-handmade' ),
				'desc'       => esc_html__( 'Set the opacity level of the bottom bar background color', 'g5plus-handmade' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'bottom_bar_text_color',
				'name' => esc_html__('Bottom Bar Text Color', 'g5plus-handmade'),
				'desc' => esc_html__("Set Bottom Bar Text Color.", 'g5plus-handmade'),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array (
				'name' 	=> esc_html__('Show/Hide Main Footer', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_top_bar_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => esc_html__('Show','g5plus-handmade'),
					'0' => esc_html__('Hide','g5plus-handmade')
				),
				'desc' => esc_html__('Show/hide main footer', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_bg_image',
				'name'  => esc_html__('Background Image', 'g5plus-handmade'),
				'desc'  => esc_html__('Set footer background image', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std' => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_padding_top',
				'name'  => esc_html__('Main Footer padding top', 'g5plus-handmade'),
				'desc'  => esc_html__('Main Footer padding top. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array(
				'id'    => $prefix.  'footer_padding_bottom',
				'name'  => esc_html__('Main Footer padding bottom', 'g5plus-handmade'),
				'desc'  => esc_html__('Main Footer padding bottom. Do not include units (empty to set default)', 'g5plus-handmade'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),



			array (
				'name' 	=> esc_html__('Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'footer-1' => THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc' => esc_html__('Select Footer Layout (Not set to default).', 'g5plus-handmade'),
				'required-field' => array($prefix . 'footer_top_bar_show_hide','=','1'),
			),

			array (
				'name' 	=> esc_html__('Sidebar 1', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_sidebar_1',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8','footer-9')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 2', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_sidebar_2',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 3', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_sidebar_3',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-5','footer-8')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 4', 'g5plus-handmade'),
				'id' 	=> $prefix . 'footer_sidebar_4',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1')),
			),




            array (
                'name' 	=> esc_html__('Show/Hide Top Bar', 'g5plus-handmade'),
                'id' 	=> $prefix . 'footer_top_bar_enable',
                'type' 	=> 'button_set',
                'std' 	=> '-1',
                'options' => array(
                    '-1' => 'Default',
                    '1' => 'Show Top Bar',
                    '0' => 'Hide Top Bar'
                ),
                'desc' => esc_html__('Show Hide Top Bar.', 'g5plus-handmade'),
            ),
            array (
                'name' 	=> esc_html__('Top Bar Layout', 'g5plus-handmade'),
                'id' 	=> $prefix . 'footer_top_bar_layout',
                'type' 	=> 'image_set',
                'allowClear' => true,
                'width' => '80px',
                'std' 	=> '',
                'options' => array(
                    'footer-top-bar-1' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
                    'footer-top-bar-2' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
                ),
                'desc' => esc_html__('Top bar layout.', 'g5plus-handmade'),
                'required-field' => array($prefix . 'footer_top_bar_enable','<>','0'),
            ),

            array (
                'name' 	=> esc_html__('Bottom Bar Left Sidebar', 'g5plus-handmade'),
                'id' 	=> $prefix . 'footer_top_bar_left_sidebar',
                'type' 	=> 'sidebars',
                'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
                'std' 	=> '',
                'required-field' => array($prefix . 'footer_top_bar_enable','<>','0'),
            ),

            array (
                'name' 	=> esc_html__('Bottom Bar Right Sidebar', 'g5plus-handmade'),
                'id' 	=> $prefix . 'footer_top_bar_right_sidebar',
                'type' 	=> 'sidebars',
                'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
                'std' 	=> '',
                'required-field' => array($prefix . 'footer_top_bar_enable','<>','0'),
            ),


			array (
				'name' 	=> esc_html__('Show/Hide Bottom Bar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'bottom_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => 'Default',
					'1' => 'Show Bottom Bar',
					'0' => 'Hide Bottom Bar'
				),
				'desc' => esc_html__('Show Hide Bottom Bar.', 'g5plus-handmade'),
			),
			array (
				'name' 	=> esc_html__('Bottom Bar Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'bottom_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'bottom-bar-1' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc' => esc_html__('Bottom bar layout.', 'g5plus-handmade'),
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Left Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'bottom_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Right Sidebar', 'g5plus-handmade'),
				'id' 	=> $prefix . 'bottom_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-handmade'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

		)
	);

	// HEADER MOBILE
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_mobile_meta_box',
		'title' => esc_html__('Header Mobile', 'g5plus-handmade'),
		'post_types' => array('post', 'page',  'portfolio','product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Header Mobile Layout', 'g5plus-handmade'),
				'id' 	=> $prefix . 'mobile_header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-mobile-1'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png',
					'header-mobile-2'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png',
					'header-mobile-3'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png',
					'header-mobile-4'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png',
					'header-mobile-5'	    => THEME_URL.'assets/images/theme-options/header-mobile-layout-5.jpg',
				)
			),
			array(
				'id'    => $prefix . 'mobile_header_menu_drop',
				'name'  => esc_html__( 'Menu Drop Type', 'g5plus-handmade' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'        => esc_html__('Default','g5plus-handmade'),
					'dropdown'  => esc_html__('Dropdown Menu','g5plus-handmade'),
					'fly'       => esc_html__('Fly Menu','g5plus-handmade'),
				)
			),
			array (
				'name' 	=> esc_html__('Header mobile sticky', 'g5plus-handmade'),
				'id' 	=> $prefix . 'mobile_header_stick',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Enable','g5plus-handmade'),
					'0' => esc_html__('Disable','g5plus-handmade'),
				),
			),
			array(
				'id'    => $prefix.  'custom_logo_mobile',
				'name'  => esc_html__('Custom Logo', 'g5plus-handmade'),
				'desc'  => esc_html__('Upload custom logo in header.', 'g5plus-handmade'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std'   => ''
			),
			array (
				'name' 	=> esc_html__('Mobile Header Search Box', 'g5plus-handmade'),
				'id' 	=> $prefix . 'mobile_header_search_box',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Show','g5plus-handmade'),
					'0' => esc_html__('Hide','g5plus-handmade')
				),
			),

			array (
				'name' 	=> esc_html__('Mobile Header Shopping Cart', 'g5plus-handmade'),
				'id' 	=> $prefix . 'mobile_header_shopping_cart',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-handmade'),
					'1' => esc_html__('Show','g5plus-handmade'),
					'0' => esc_html__('Hide','g5plus-handmade')
				),
			),
		)
	);

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'g5plus_register_meta_boxes');
