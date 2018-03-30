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
		'title' => esc_html__('Post Format: Image', 'g5plus-academia'),
		'id' => $prefix .'meta_box_post_format_image',
		'post_types' => array('post'),
		/*'context' => 'side',
		'priority' => 'low',*/
		'fields' => array(
			array(
				'name' => esc_html__('Image', 'g5plus-academia'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => esc_html__('Select a image for post','g5plus-academia')
			),
		),
	);

// POST FORMAT: Gallery
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Gallery', 'g5plus-academia'),
		'id' => $prefix . 'meta_box_post_format_gallery',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Gallery', 'g5plus-academia'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => esc_html__('Select images gallery for post','g5plus-academia')
			),
		),
	);

// POST FORMAT: Video
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Video', 'g5plus-academia'),
		'id' => $prefix . 'meta_box_post_format_video',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'g5plus-academia' ),
				'id'   => $prefix . 'post_format_video',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: Audio
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Audio', 'g5plus-academia'),
		'id' => $prefix . 'meta_box_post_format_audio',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Audio URL or Embeded Code', 'g5plus-academia' ),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Quote', 'g5plus-academia'),
        'id' => $prefix . 'meta_box_post_format_quote',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Quote', 'g5plus-academia' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Author', 'g5plus-academia' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Author Url', 'g5plus-academia' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
	//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Link', 'g5plus-academia'),
        'id' => $prefix . 'meta_box_post_format_link',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Url', 'g5plus-academia' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => esc_html__( 'Text', 'g5plus-academia' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );

	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => esc_html__('Page Layout', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Layout Style', 'g5plus-academia' ),
				'id'    => $prefix . 'layout_style',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'boxed'	  => esc_html__('Boxed','g5plus-academia'),
					'wide'	  => esc_html__('Wide','g5plus-academia'),
					'float'	  => esc_html__('Float','g5plus-academia')
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Layout', 'g5plus-academia' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'full'	  => esc_html__('Full Width','g5plus-academia'),
					'container'	  => esc_html__('Container','g5plus-academia'),
					'container-fluid'	  => esc_html__('Container Fluid','g5plus-academia'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Sidebar', 'g5plus-academia' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'none'	  => G5PLUS_THEME_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => G5PLUS_THEME_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => G5PLUS_THEME_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => G5PLUS_THEME_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> esc_html__('Left Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','left','both')),
			),

			array (
				'name' 	=> esc_html__('Right Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'page_sidebar','=',array('','right','both')),
			),

			array(
				'name'  => esc_html__( 'Sidebar Width', 'g5plus-academia' ),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'		=> esc_html__('Default','g5plus-academia'),
					'small'		=> esc_html__('Small (1/4)','g5plus-academia'),
					'large'	=> esc_html__('Large (1/3)','g5plus-academia')
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'page_sidebar','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Page Class Extra', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);

	// TOP DRAWER
	$meta_boxes[] = array(
		'id' => $prefix . 'top_drawer_meta_box',
		'title' => esc_html__('Top drawer', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Top Drawer Type', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_drawer_type',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'none' => esc_html__('Disable','g5plus-academia'),
					'show' => esc_html__('Always Show','g5plus-academia'),
					'toggle' => esc_html__('Toggle','g5plus-academia')
				),
				'desc' => esc_html__('Top drawer type', 'g5plus-academia'),
			),
			array (
				'name' 	=> esc_html__('Top Drawer Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_drawer_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer Wrapper Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_drawer_wrapper_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'full' => esc_html__('Full Width','g5plus-academia'),
					'container' => esc_html__('Container','g5plus-academia'),
					'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Top Drawer hide on mobile', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_drawer_hide_mobile',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show on mobile','g5plus-academia'),
					'0' => esc_html__('Hide on mobile','g5plus-academia'),
				),
				'required-field' => array($prefix . 'top_drawer_type','<>','none'),
			),

		)
	);

	// TOP BAR
	$meta_boxes[] = array(
		'id' => $prefix . 'top_bar_meta_box',
		'title' => esc_html__('Top Bar', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Top Bar Desktop', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_section_1',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Show/Hide Top Bar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show Top Bar','g5plus-academia'),
					'0' => esc_html__('Hide Top Bar','g5plus-academia')
				),
				'desc' => esc_html__('Show Hide Top Bar.', 'g5plus-academia'),
			),

			array (
				'name' 	=> esc_html__('Top Bar Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Left Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Right Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Bar Mobile', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_section_2',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Show/Hide Top Bar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_mobile',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show Top Bar','g5plus-academia'),
					'0' => esc_html__('Hide Top Bar','g5plus-academia')
				),
				'desc' => esc_html__('Show Hide Top Bar.', 'g5plus-academia'),
			),
			array (
				'name' 	=> esc_html__('Top Bar Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_mobile_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array($prefix . 'top_bar_mobile','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Left Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_mobile_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'required-field' => array($prefix . 'top_bar_mobile','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Right Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'top_bar_mobile_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'required-field' => array($prefix . 'top_bar_mobile','<>','0'),
			),
		)
	);

	// PAGE HEADER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_meta_box',
		'title' => esc_html__('Page Header', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Header On/Off?', 'g5plus-academia'),
				'id' 	=> $prefix . 'header_show_hide',
				'type' 	=> 'checkbox',
				'desc' => esc_html__("Switch header ON or OFF?", "g5plus-academia"),
				'std'	=> '1',
			),
			array (
				'name' 	=> esc_html__('Page Header Desktop', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_header_section_1',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Header Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-1'	    => G5PLUS_THEME_URL.'/assets/images/theme-options/header-1.jpg',
					'header-2'	    => G5PLUS_THEME_URL.'/assets/images/theme-options/header-2.jpg',
					'header-3'	    => G5PLUS_THEME_URL.'/assets/images/theme-options/header-3.jpg',
				),
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),
			array(
				'id'    => $prefix . 'header_boxed',
				'name'  => esc_html__( 'Header Boxed', 'g5plus-academia' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'    => esc_html__('Default','g5plus-academia'),
					'1'     => esc_html__('On','g5plus-academia'),
					'0'     => esc_html__('Off','g5plus-academia'),
				),
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),
			array(
				'id'    => $prefix . 'header_container_layout',
				'name'  => esc_html__( 'Header Container Layout', 'g5plus-academia' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'                => esc_html__('Default','g5plus-academia'),
					'container'         => esc_html__('Container','g5plus-academia'),
					'container-full'    => esc_html__('Container Full','g5plus-academia'),
				),
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),

			array(
				'id'    => $prefix . 'header_sticky',
				'name'  => esc_html__( 'Show/Hide Header Sticky', 'g5plus-academia' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'    => esc_html__('Default','g5plus-academia'),
					'1'     => esc_html__('On','g5plus-academia'),
					'0'     => esc_html__('Off','g5plus-academia')
				),
				'required-field' => array($prefix . 'header_show_hide','=','1'),
			),

			array (
				'name' 	=> esc_html__('Page Header Mobile', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_header_section_2',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Header Mobile Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'mobile_header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-mobile-1'	    => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png',
					'header-mobile-2'	    => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png',
					'header-mobile-3'	    => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png',
					'header-mobile-4'	    => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png',
				)
			),
			array(
				'id'    => $prefix . 'mobile_header_menu_drop',
				'name'  => esc_html__( 'Menu Drop Type', 'g5plus-academia' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'        => esc_html__('Default','g5plus-academia'),
					'dropdown'  => esc_html__('Dropdown Menu','g5plus-academia'),
					'fly'       => esc_html__('Fly Menu','g5plus-academia'),
				)
			),
			array(
				'id'    => $prefix . 'mobile_header_border_bottom',
				'name'  => esc_html__( 'Mobile header border bottom', 'g5plus-academia' ),
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'                    => esc_html__('Default','g5plus-academia'),
					'none'                  => esc_html__('None','g5plus-academia'),
					'bordered'              => esc_html__('Bordered','g5plus-academia'),
					'container-bordered'    => esc_html__('Container Bordered','g5plus-academia'),
				)
			),
			array (
				'id' 	=> $prefix . 'mobile_header_stick',
				'name' 	=> esc_html__('Header mobile sticky', 'g5plus-academia'),
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Enable','g5plus-academia'),
					'0' => esc_html__('Disable','g5plus-academia'),
				),
			),
			array (
				'name' 	=> esc_html__('Mobile Header Search Box', 'g5plus-academia'),
				'id' 	=> $prefix . 'mobile_header_search_box',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show','g5plus-academia'),
					'0' => esc_html__('Hide','g5plus-academia')
				),
			),

			array (
				'name' 	=> esc_html__('Mobile Header Shopping Cart', 'g5plus-academia'),
				'id' 	=> $prefix . 'mobile_header_shopping_cart',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show','g5plus-academia'),
					'0' => esc_html__('Hide','g5plus-academia')
				),
			),
		)
	);

	// HEADER CUSTOMIZE
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_customize_meta_box',
		'title' => esc_html__('Page Header Customize', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Set header customize navigation?', 'g5plus-academia' ),
				'id'    => $prefix . 'enable_header_customize_nav',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array (
				'name' 	=> esc_html__('Header Customize Navigation', 'g5plus-academia'),
				'id' 	=> $prefix . 'header_customize_nav',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => esc_html__('Select element for header customize navigation. Drag to change element order', 'g5plus-academia'),
				'options' => array(
					'shopping-cart'     => esc_html__('Shopping Cart','g5plus-academia'),
					'search-button'     => esc_html__('Search Button','g5plus-academia'),
					'social-profile'    => esc_html__('Social Profile','g5plus-academia'),
					'custom-text'       => esc_html__('Custom Text','g5plus-academia'),
					'my-account'       => esc_html__('My Account Button','g5plus-academia'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array(
				'name' => esc_html__('Custom social profiles', 'g5plus-academia'),
				'id' => $prefix . 'header_customize_nav_social_profile',
				'type'  => 'select_advanced',
				'placeholder' => esc_html__('Select social profiles','g5plus-academia'),
				'std'	=> '',
				'multiple' => true,
				'options' => array(
					'twitter'  => esc_html__( 'Twitter', 'g5plus-academia' ),
					'facebook'  => esc_html__( 'Facebook', 'g5plus-academia' ),
					'dribbble'  => esc_html__( 'Dribbble', 'g5plus-academia' ),
					'vimeo'  => esc_html__( 'Vimeo', 'g5plus-academia' ),
					'tumblr'  => esc_html__( 'Tumblr', 'g5plus-academia' ),
					'skype'  => esc_html__( 'Skype', 'g5plus-academia' ),
					'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-academia' ),
					'googleplus'  => esc_html__( 'Google+', 'g5plus-academia' ),
					'flickr'  => esc_html__( 'Flickr', 'g5plus-academia' ),
					'youtube'  => esc_html__( 'YouTube', 'g5plus-academia' ),
					'pinterest' => esc_html__( 'Pinterest', 'g5plus-academia' ),
					'foursquare'  => esc_html__( 'Foursquare', 'g5plus-academia' ),
					'instagram' => esc_html__( 'Instagram', 'g5plus-academia' ),
					'github'  => esc_html__( 'GitHub', 'g5plus-academia' ),
					'xing' => esc_html__( 'Xing', 'g5plus-academia' ),
					'behance'  => esc_html__( 'Behance', 'g5plus-academia' ),
					'deviantart'  => esc_html__( 'Deviantart', 'g5plus-academia' ),
					'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-academia' ),
					'yelp'  => esc_html__( 'Yelp', 'g5plus-academia' ),
					'rss'  => esc_html__( 'RSS Feed', 'g5plus-academia' ),
					'email'  => esc_html__( 'Email address', 'g5plus-academia' ),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
			array(
				'name'  => esc_html__( 'Custom text content', 'g5plus-academia' ),
				'id'    => $prefix . 'header_customize_nav_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize_nav','=','1'),
			),
		)
	);

	// LOGO
	$meta_boxes[] = array(
		'id' => $prefix . 'page_logo_meta_box',
		'title' => esc_html__('Logo', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('LOGO Desktop', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_logo_section_1',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array(
				'id'    => $prefix.  'logo',
				'name'  => esc_html__('Custom Logo', 'g5plus-academia'),
				'desc'  => esc_html__('Upload custom logo in header.', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'    => $prefix.  'logo_retina',
				'name'  => esc_html__('Custom Logo Retina', 'g5plus-academia'),
				'desc'  => esc_html__('Upload custom logo retina in header.', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'    => $prefix.  'logo_height',
				'name'  => esc_html__('Logo height', 'g5plus-academia'),
				'desc'  => esc_html__('Logo height (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
			array(
				'id'    => $prefix.  'logo_max_height',
				'name'  => esc_html__('Logo max height', 'g5plus-academia'),
				'desc'  => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
			array(
				'id'    => $prefix.  'logo_padding_top',
				'name'  => esc_html__('Logo padding top', 'g5plus-academia'),
				'desc'  => esc_html__('Logo padding top (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
			array(
				'id'    => $prefix.  'logo_padding_bottom',
				'name'  => esc_html__('Logo padding bottom', 'g5plus-academia'),
				'desc'  => esc_html__('Logo padding bottom (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),

			array(
				'id'    => $prefix . 'sticky_logo',
				'name'  => esc_html__('Sticky Logo', 'g5plus-academia'),
				'desc'  => esc_html__('Upload sticky logo in header (empty to default)', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'    => $prefix . 'sticky_logo_retina',
				'name'  => esc_html__('Sticky Logo Retina', 'g5plus-academia'),
				'desc'  => esc_html__('Upload sticky logo retina in header (empty to default)', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array (
				'name' 	=> esc_html__('LOGO Mobile', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_logo_section_2',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array(
				'id'    => $prefix.  'mobile_logo',
				'name'  => esc_html__('Mobile Logo', 'g5plus-academia'),
				'desc'  => esc_html__('Upload mobile logo in header.', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'    => $prefix.  'mobile_logo_retina',
				'name'  => esc_html__('Mobile Logo Retina', 'g5plus-academia'),
				'desc'  => esc_html__('Upload mobile logo retina in header.', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'    => $prefix.  'mobile_logo_height',
				'name'  => esc_html__('Mobile Logo Height', 'g5plus-academia'),
				'desc'  => esc_html__('Logo height (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
			array(
				'id'    => $prefix.  'mobile_logo_max_height',
				'name'  => esc_html__('Mobile Logo Max Height', 'g5plus-academia'),
				'desc'  => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
			array(
				'id'    => $prefix.  'mobile_logo_padding',
				'name'  => esc_html__('Mobile Logo Padding', 'g5plus-academia'),
				'desc'  => esc_html__('Logo padding top/bottom (px). Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
			),
		)
	);

	// MENU
	$meta_boxes[] = array(
		'id' => $prefix . 'page_menu_meta_box',
		'title' => esc_html__('Menu', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Page menu', 'g5plus-academia' ),
				'id'    => $prefix . 'page_menu',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => esc_html__('Select Menu','g5plus-academia'),
				'std'	=> '',
				'multiple' => false,
				'desc' => esc_html__('Optionally you can choose to override the menu that is used on the page', 'g5plus-academia'),
			),

			array(
				'name'  => esc_html__( 'Page menu mobile', 'g5plus-academia' ),
				'id'    => $prefix . 'page_menu_mobile',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => esc_html__('Select Menu','g5plus-academia'),
				'std'	=> '',
				'multiple' => false,
				'desc' => esc_html__('Optionally you can choose to override the menu mobile that is used on the page', 'g5plus-academia'),
			),

			array(
				'name'  => esc_html__( 'Is One Page', 'g5plus-academia' ),
				'id'    => $prefix . 'is_one_page',
				'type' 	=> 'checkbox',
				'std' 	=> '0',
				'desc' => esc_html__('Set page style is One Page', 'g5plus-academia'),
			),
		)
	);


	// PAGE TITLE
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_title_meta_box',
		'title' => esc_html__('Page Title', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Show/Hide Page Title?', 'g5plus-academia' ),
				'id'    => $prefix . 'show_page_title',
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'	=> esc_html__('Default','g5plus-academia'),
					'1'	=> esc_html__('On','g5plus-academia'),
					'0'	=> esc_html__('Off','g5plus-academia'),
				)

			),
			array(
				'name'  => esc_html__('Select Page Title Style', 'g5plus-academia' ),
				'id' => $prefix . 'style_page_title',
				'type' => 'button_set',
				'options' => array(
					'' => esc_html__('Default','g5plus-academia'),
					'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
					'pt-center' => esc_html__('Center','g5plus-academia'),
				),
				'std' => '',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => esc_html__('Select Page Title Text Align', 'g5plus-academia' ),
				'id' => $prefix .  'page_title_text_align',
				'type' => 'button_set',
				'desc' => '',
				'options' => array(
					'' => esc_html__('Default','g5plus-academia'),
					'left' => esc_html__('Left','g5plus-academia'),
					'center' => esc_html__('Center','g5plus-academia'),
					'right' => esc_html__('Right','g5plus-academia'),
				),
				'std' => '',
				'required-field' => array($prefix . 'style_page_title','=','pt-center'),
			),
			// PAGE TITLE LINE 1
			array(
				'name' => esc_html__('Custom Page Title', 'g5plus-academia'),
				'id' => $prefix . 'page_title_custom',
				'desc' => esc_html__("Enter a custom page title if you'd like.", "g5plus-academia"),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => esc_html__( 'Custom Page Subtitle?', 'g5plus-academia' ),
				'id'    => $prefix . 'enable_custom_page_subtitle',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE LINE 2
			array(
				'name' => esc_html__('Custom Page Subtitle', 'g5plus-academia'),
				'id' => $prefix . 'page_subtitle_custom',
				'desc' => esc_html__("Enter a custom page title if you'd like.", "g5plus-academia"),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE Height
			array(
				'name' => esc_html__('Padding Top', 'g5plus-academia'),
				'id' => $prefix . 'page_title_padding_top',
				'desc' => esc_html__("Enter a page title padding top value (not include unit).", "g5plus-academia"),
				'type'  => 'number',
				'std' => '',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => esc_html__('Padding Bottom', 'g5plus-academia'),
				'id' => $prefix . 'page_title_padding_bottom',
				'desc' => esc_html__("Enter a page title padding bottom value (not include unit).", "g5plus-academia"),
				'type'  => 'number',
				'std' => '',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			//PAGE TITLE OVERLAY COLOR
			array(
				'name'  => esc_html__( 'Custom Background Color?', 'g5plus-academia' ),
				'id'    => $prefix . 'enable_custom_background_color',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => esc_html__('Text Color', 'g5plus-academia'),
				'id' => $prefix . 'page_title_color',
				'type'     => 'color',
				'desc' => esc_html__("Select text color for page title", "g5plus-academia"),
				'std'  => '',
				'validate' => 'color',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => esc_html__('Background Color', 'g5plus-academia'),
				'id' => $prefix . 'page_title_bg_color',
				'type'     => 'color',
				'desc' => esc_html__("Select background color for page title", "g5plus-academia"),
				'std'  => '',
				'validate' => 'color',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'id'         => $prefix .'page_title_bg_color_opacity',
				'name'       => esc_html__( 'Background color opacity', 'g5plus-academia' ),
				'desc'       => esc_html__( 'Set the opacity level of the page title background color', 'g5plus-academia' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std' => '100',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE BACKGROUND IMAGE
			array(
				'name'  => esc_html__( 'Custom Background Image?', 'g5plus-academia' ),
				'id'    => $prefix . 'enable_custom_page_title_bg_image',
				'type'  => 'checkbox',
				'std'	=> 0,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// BACKGROUND IMAGE
			array(
				'id'    => $prefix.  'page_title_bg_image',
				'name'  => esc_html__('Background Image', 'g5plus-academia'),
				'desc'  => esc_html__('Background Image for page title.', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE PARALLAX
			array(
				'name' => esc_html__('Page Title Parallax', 'g5plus-academia'),
				'id' => $prefix . 'page_title_parallax',
				'desc' => esc_html__("Enable Page Title Parallax", "g5plus-academia"),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Enable','g5plus-academia'),
					'0' => esc_html__('Disable','g5plus-academia'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name' => esc_html__('Parallax Position', 'g5plus-academia'),
				'id' => $prefix . 'page_title_parallax_position',
				'desc' => '',
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'top' => esc_html__('Top','g5plus-academia'),
					'center' => esc_html__('Center','g5plus-academia'),
					'bottom' => esc_html__('Bottom','g5plus-academia'),
				),
				'std' => '-1',
				'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

            array(
                'name'  => esc_html__( 'Remove Margin Bottom', 'g5plus-academia' ),
                'id'    => $prefix . 'page_title_remove_margin_bottom',
                'type'  => 'checkbox',
                'std'	=> 0,
	            'required-field' => array($prefix . 'show_page_title','<>','0'),
            ),
		)
	);

	// PAGE FOOTER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_footer_meta_box',
		'title' => esc_html__('Page Footer', 'g5plus-academia'),
		'post_types' => array('post', 'page',  'product'),
		'tab' => true,
		'fields' => array(
			array (
				'name' 	=> esc_html__('Footer Settings', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_footer_section_1',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Show/Hide Footer', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show Footer','g5plus-academia'),
					'0' => esc_html__('Hide Footer','g5plus-academia')
				),
				'desc' => esc_html__('Show/hide footer', 'g5plus-academia'),
			),
			array (
				'name' 	=> esc_html__('Wrapper Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_wrapper_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1'                => esc_html__('Default','g5plus-academia'),
					'full'              => esc_html__('Full Width','g5plus-academia'),
					'container-fluid'   => esc_html__('Container Fluid','g5plus-academia'),
				),
				'desc' => esc_html__('Select Footer Wrapper Layout', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),
			array (
				'name' 	=> esc_html__('Footer Container Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_container_layout',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1'                => esc_html__('Default','g5plus-academia'),
					'full'              => esc_html__('Full Width','g5plus-academia'),
					'container-fluid'   => esc_html__('Container Fluid','g5plus-academia'),
					'container'         => esc_html__('Container','g5plus-academia'),
				),
				'desc' => esc_html__('Select Footer Wrapper Layout', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),
			array (
				'name' 	=> esc_html__('Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'footer-1' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => G5PLUS_THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc' => esc_html__('Select Footer Layout (Not set to default).', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),
			array (
				'name' 	=> esc_html__('Sidebar 1', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_sidebar_1',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8','footer-9')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 2', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_sidebar_2',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 3', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_sidebar_3',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1','footer-2','footer-3','footer-5','footer-8')),
			),

			array (
				'name' 	=> esc_html__('Sidebar 4', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_sidebar_4',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
				'required-field' => array($prefix . 'footer_layout','=',array('footer-1')),
			),
			array(
				'id'    => $prefix.  'footer_padding_top',
				'name'  => esc_html__('Main Footer padding top', 'g5plus-academia'),
				'desc'  => esc_html__('Main Footer padding top. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),

			array(
				'id'    => $prefix.  'footer_padding_bottom',
				'name'  => esc_html__('Main Footer padding bottom', 'g5plus-academia'),
				'desc'  => esc_html__('Main Footer padding bottom. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),
			array(
				'id'    => $prefix.  'footer_bg_image',
				'name'  => esc_html__('Background Image', 'g5plus-academia'),
				'desc'  => esc_html__('Set footer background image', 'g5plus-academia'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'std' => '',
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Footer Scheme', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_scheme',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'light'         => esc_html__('Light','g5plus-academia'),
					'dark'          => esc_html__('Dark','g5plus-academia'),
					'custom'        => esc_html__('Custom','g5plus-academia'),
				),
				'desc' => esc_html__('Select Footer Scheme', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),
			array(
				'id' => $prefix . 'footer_bg_color',
				'name' => esc_html__('Background color', 'g5plus-academia'),
				'desc' => esc_html__("Set footer background color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),
			array(
				'id'         => $prefix .'footer_bg_color_opacity',
				'name'       => esc_html__( 'Background color opacity', 'g5plus-academia' ),
				'desc'       => esc_html__( 'Set the opacity level of the footer background color', 'g5plus-academia' ),
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
				'id' => $prefix . 'footer_main_overlay_color',
				'name' => esc_html__('Main footer overlay color', 'g5plus-academia'),
				'desc' => esc_html__("Set main footer overlay color", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),
			array(
				'id'         => $prefix .'footer_main_overlay_opacity',
				'name'       => esc_html__( 'Main footer overlay opacity', 'g5plus-academia' ),
				'desc'       => esc_html__( 'Set the opacity level of the main footer overlay', 'g5plus-academia' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'std' => '0',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'footer_text_color',
				'name' => esc_html__('Text color', 'g5plus-academia'),
				'desc' => esc_html__("Set footer text color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'footer_heading_text_color',
				'name' => esc_html__('Heading text color', 'g5plus-academia'),
				'desc' => esc_html__("Set footer heading text color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array(
				'id' => $prefix . 'footer_above_bg_color',
				'name' => esc_html__('Footer Above Background Color', 'g5plus-academia'),
				'desc' => esc_html__("Set Footer Above Background Color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),
			array(
				'id'         => $prefix .'footer_above_bg_color_opacity',
				'name'       => esc_html__( 'Footer Above Background color opacity', 'g5plus-academia' ),
				'desc'       => esc_html__( 'Set the opacity level of the footer above background color', 'g5plus-academia' ),
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
				'id' => $prefix . 'footer_above_text_color',
				'name' => esc_html__('Footer Above Text Color', 'g5plus-academia'),
				'desc' => esc_html__("Set Footer Above Text Color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),
			array(
				'id' => $prefix . 'bottom_bar_bg_color',
				'name' => esc_html__('Bottom Bar Background Color', 'g5plus-academia'),
				'desc' => esc_html__("Set Bottom Bar Background Color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),
			array(
				'id'         => $prefix .'bottom_bar_bg_color_opacity',
				'name'       => esc_html__( 'Bottom Bar Background color opacity', 'g5plus-academia' ),
				'desc'       => esc_html__( 'Set the opacity level of the bottom bar background color', 'g5plus-academia' ),
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
				'name' => esc_html__('Bottom Bar Text Color', 'g5plus-academia'),
				'desc' => esc_html__("Set Bottom Bar Text Color.", "g5plus-academia"),
				'type'  => 'color',
				'std' => '',
				'required-field' => array($prefix . 'footer_scheme','=',array('custom')),
			),

			array (
				'name' 	=> esc_html__('Footer Parallax', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_parallax',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => esc_html__('Enable Footer Parallax', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Collapse footer on mobile device', 'g5plus-academia'),
				'id' 	=> $prefix . 'collapse_footer',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => 'On',
					'0' => 'Off'
				),
				'desc' => esc_html__('Enable collapse footer', 'g5plus-academia'),
				'required-field' => array($prefix . 'footer_show_hide','<>','0'),
			),

			//--------------------------------------------------------------------
			array (
				'name' 	=> esc_html__('Footer Above Settings', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_footer_section_2',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Show/Hide Footer Above', 'g5plus-academia'),
				'id' 	=> $prefix . 'footer_above_enable',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-academia'),
					'1' => esc_html__('Show Footer Above','g5plus-academia'),
					'0' => esc_html__('Hide Footer Above','g5plus-academia')
				),
				'desc' => esc_html__('Show/hide footer above', 'g5plus-academia'),
			),
            array (
                'name' 	=> esc_html__('Footer Above Layout', 'g5plus-academia'),
                'id' 	=> $prefix . 'footer_above_layout',
                'type' 	=> 'image_set',
                'allowClear' => true,
                'width' => '80px',
                'std' 	=> '',
                'options' => array(
                    'footer-above-1' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
                    'footer-above-2' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
                ),
                'desc' => esc_html__('Footer above layout.', 'g5plus-academia'),
                'required-field' => array($prefix . 'footer_above_enable','<>','0'),
            ),

            array (
                'name' 	=> esc_html__('Footer Above Left Sidebar', 'g5plus-academia'),
                'id' 	=> $prefix . 'footer_above_left_sidebar',
                'type' 	=> 'sidebars',
                'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
                'std' 	=> '',
                'required-field' => array($prefix . 'footer_above_enable','<>','0'),
            ),

            array (
                'name' 	=> esc_html__('Footer Above Right Sidebar', 'g5plus-academia'),
                'id' 	=> $prefix . 'footer_above_right_sidebar',
                'type' 	=> 'sidebars',
                'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
                'std' 	=> '',
                'required-field' => array($prefix . 'footer_above_enable','<>','0'),
            ),
			array(
				'id'    => $prefix.  'footer_above_padding_top',
				'name'  => esc_html__('Footer above padding top', 'g5plus-academia'),
				'desc'  => esc_html__('Footer above padding top. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_above_enable','<>','0'),
			),

			array(
				'id'    => $prefix.  'footer_above_padding_bottom',
				'name'  => esc_html__('Footer above padding bottom', 'g5plus-academia'),
				'desc'  => esc_html__('Footer above padding bottom. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'footer_above_enable','<>','0'),
			),

			//--------------------------------------------------------------------
			array (
				'name' 	=> esc_html__('Bottom Bar Settings', 'g5plus-academia'),
				'id' 	=> $prefix . 'page_footer_section_3',
				'type' 	=> 'section',
				'std' 	=> '',
			),
			array (
				'name' 	=> esc_html__('Show/Hide Bottom Bar', 'g5plus-academia'),
				'id' 	=> $prefix . 'bottom_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => 'Default',
					'1' => 'Show Bottom Bar',
					'0' => 'Hide Bottom Bar'
				),
				'desc' => esc_html__('Show Hide Bottom Bar.', 'g5plus-academia'),
			),
			array (
				'name' 	=> esc_html__('Bottom Bar Layout', 'g5plus-academia'),
				'id' 	=> $prefix . 'bottom_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'bottom-bar-1' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => G5PLUS_THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc' => esc_html__('Bottom bar layout.', 'g5plus-academia'),
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Left Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'bottom_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Right Sidebar', 'g5plus-academia'),
				'id' 	=> $prefix . 'bottom_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-academia'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),
			array(
				'id'    => $prefix.  'bottom_bar_padding_top',
				'name'  => esc_html__('Bottom bar padding top', 'g5plus-academia'),
				'desc'  => esc_html__('Bottom bar padding top. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array(
				'id'    => $prefix.  'bottom_bar_padding_bottom',
				'name'  => esc_html__('Bottom bar padding bottom', 'g5plus-academia'),
				'desc'  => esc_html__('Bottom bar padding bottom. Do not include units (empty to set default)', 'g5plus-academia'),
				'type'  => 'text',
				'sdt'   => '',
				'required-field' => array($prefix . 'bottom_bar','<>','0'),
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
