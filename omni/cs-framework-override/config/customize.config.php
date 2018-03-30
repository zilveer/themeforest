<?php
/**
 * Customizer OPTIONS
 * @package omni
 **/

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================!
$options           = array();
$assets_path       = get_template_directory_uri() . '/images/';
$admin_assets_path = get_template_directory_uri() . '/images/admin/';

$soc_networks_array = array(
	'fa fa-facebook'   => esc_html__( 'Facebook', 'omni' ),
	'fa fa-google'     => esc_html__( 'Google', 'omni' ),
	'fa fa-twitter'    => esc_html__( 'Twitter', 'omni' ),
	'fa fa-instagram'  => esc_html__( 'Instagram', 'omni' ),
	'fa fa-xing'       => esc_html__( 'Xing', 'omni' ),
	'fa fa-lastfm'     => esc_html__( 'LastFM', 'omni' ),
	'fa fa-dribbble'   => esc_html__( 'Dribble', 'omni' ),
	'fa fa-vk'         => esc_html__( 'Vkontakte', 'omni' ),
	'fa fa-youtube'    => esc_html__( 'Youtube', 'omni' ),
	'fa fa-windows'    => esc_html__( 'Microsoft', 'omni' ),
	'fa fa-deviantart' => esc_html__( 'Deviantart', 'omni' ),
	'fa fa-linkedin'   => esc_html__( 'LinkedIN', 'omni' ),
	'fa fa-pinterest'  => esc_html__( 'Pinterest', 'omni' ),
	'fa fa-wordpress'  => esc_html__( 'Wordpress', 'omni' ),
	'fa fa-behance'    => esc_html__( 'Behance', 'omni' ),
	'fa fa-flickr'     => esc_html__( 'Flickr', 'omni' ),
	'fa fa-rss'        => esc_html__( 'RSS', 'omni' ),
);

// -----------------------------------------
// Main theme options           -
// -----------------------------------------
$options[] = array(
	'name'     => 'theme_options',
	'title'    => esc_html__( 'Main options', 'omni' ),
	'settings' => array(
		array(
			'name'    => 'theme_purchase_code',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'  => 'text',
					'title' => esc_html__( 'Purchase code', 'omni' ),
				),
			),
		),
		array(
			'name'    => 'theme_access_token',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'  => 'text',
					'title' => esc_html__( 'Access token', 'omni' ),
				),
			),
		),
		array(
			'name'    => 'disable_preloader',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Disable preloader animation', 'omni' ),
					'default' => false,
				),
			),
		),
		array(
			'name'    => 'disable_mobile_animations',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Disable animation on mobile devices', 'omni' ),
					'default' => false,
				),
			),
		),
		array(
			'name'    => 'enable_search_button',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable search after menu', 'omni' ),
					'default' => false,
				),
			),
		),
	),
);
// -----------------------------------------
// Header Customization              -
// -----------------------------------------
$options[] = array(
	'name'     => 'header_options',
	'title'    => esc_html__( 'Logotypes', 'omni' ),
	'settings' => array(
		// Logotype.
		array(
			'name'    => 'header_logo',
			'default' => $admin_assets_path . 'logo.png',
			'control' => array(
				'label' => esc_html__( 'Header Logotype', 'omni' ),
				'type'  => 'image',
			),
		),
		array(
			'name'      => 'header_logo_retina',
			'transport' => 'postMessage',
			'control'   => array(
				'label'       => esc_html__( 'Enable retina', 'omni' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'This image wil be displayed twice smaller than uploaded image size.', 'crum' ),
			),
		),
		array(
			'name'      => 'sticky_header_logo',
			'transport' => 'postMessage',
			'default'   => $admin_assets_path . 'logo-act.png',
			'control'   => array(
				'label' => esc_html__( 'Sticky Header Logotype', 'omni' ),
				'type'  => 'image',
			),
		),
		array(
			'name'      => 'sticky_header_logo_retina',
			'transport' => 'postMessage',
			'control'   => array(
				'label'       => esc_html__( 'Enable retina', 'omni' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'This image wil be displayed twice smaller than uploaded image size.', 'crum' ),
			),
		),
		array(
			'name'      => 'custom_preloader_logo',
			'transport' => 'postMessage',
			'control'   => array(
				'label'       => esc_html__( 'Custom preloader image', 'omni' ),
				'type'        => 'image',
				'description' => esc_html__( 'If empty, header logotype will be displayed as preloder image', 'crum' ),
			),
		),
		array(
			'name'      => 'custom_preloader_logo_retina',
			'transport' => 'postMessage',
			'control'   => array(
				'label'       => esc_html__( 'Enable retina', 'omni' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'This image wil be displayed twice smaller than uploaded image size.', 'crum' ),
			),
		),
	),
);

$options[] = array(
	'name'     => 'blog_options',
	'title'    => esc_html__( 'Blog options', 'omni' ),
	'settings' => array(

		array(
			'name'    => 'blog_style',
			'default' => 'small-list',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'image_select',
					'title'      => esc_html__( 'Blog style', 'omni' ),
					'options'    => array(
						'standard'   => $admin_assets_path . 'blog-list.png',
						'full'       => $admin_assets_path . 'blog-default.png',
						'image-side' => $admin_assets_path . 'blog-columns.png',
					),
					'radio'      => true,
					'attributes' => array(
						'data-depend-id' => 'blog-style',
					),
				),
			),
		),
		array(
			'name'    => 'blog_date_display',
			'default' => false,
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Hide post date', 'omni' ),
					'default' => false,
				),
			),
		),
		array(
			'name'    => 'blog_meta_display',
			'default' => false,
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'switcher',
					'title'      => esc_html__( 'Hide post meta', 'omni' ),
					'default'    => false,
					'dependency' => array( 'blog-style', 'any', 'full,image-side' ),
				),
			),
		),
		array(
			'name'    => 'blog_excerpt_display',
			'default' => false,
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Hide post excerpt', 'omni' ),
					'default' => false,
				),
			),
		),

		array(
			'name'    => 'blog_excerpt_type',
			'default' => 'content',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'select',
					'title'      => esc_html__( 'Excert type', 'omni' ),
					'options'    => array(
						'content' => esc_html__( 'Post content', 'omni' ),
						'excerpt' => esc_html__( 'Generated excerpt', 'omni' ),
					),
					'dependency' => array( 'blog_excerpt_display', '!=', 'true' ),
				),
			),
		),

		array(
			'name'    => 'excerpt_length',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'number',
					'dependency' => array( 'blog_excerpt_type', '==', 'excerpt' ),
					'title'      => esc_html__( 'Excerpt length', 'omni' ),
				),
			),
		),
		array(
			'name'    => 'blog_posts_animation',
			'default' => 'none',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'select',
					'title'   => esc_html__( 'Post animations', 'omni' ),
					'options' => array(
						'none'              => esc_html__( 'None', 'omni' ),
						'bounceIn'          => esc_html__( 'bounceIn', 'omni' ),
						'bounceInDown'      => esc_html__( 'bounceInDown', 'omni' ),
						'bounceInLeft'      => esc_html__( 'bounceInLeft', 'omni' ),
						'bounceInRight'     => esc_html__( 'bounceInRight', 'omni' ),
						'bounceInUp'        => esc_html__( 'bounceInUp', 'omni' ),
						'fadeIn'            => esc_html__( 'fadeIn', 'omni' ),
						'fadeInDown'        => esc_html__( 'fadeInDown', 'omni' ),
						'fadeInDownBig'     => esc_html__( 'fadeInDownBig', 'omni' ),
						'fadeInLeft'        => esc_html__( 'fadeInLeft', 'omni' ),
						'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig', 'omni' ),
						'fadeInRight'       => esc_html__( 'fadeInRight', 'omni' ),
						'fadeInRightBig'    => esc_html__( 'fadeInRightBig', 'omni' ),
						'fadeInUp'          => esc_html__( 'fadeInUp', 'omni' ),
						'fadeInUpBig'       => esc_html__( 'fadeInUpBig', 'omni' ),
						'flipInX'           => esc_html__( 'flipInX', 'omni' ),
						'flipInY'           => esc_html__( 'flipInY', 'omni' ),
						'lightSpeedIn'      => esc_html__( 'lightSpeedIn', 'omni' ),
						'rotateIn'          => esc_html__( 'rotateIn', 'omni' ),
						'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft', 'omni' ),
						'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'omni' ),
						'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft', 'omni' ),
						'rotateInUpRight'   => esc_html__( 'rotateInUpRight', 'omni' ),
						'rollIn'            => esc_html__( 'rollIn', 'omni' ),
						'zoomIn'            => esc_html__( 'zoomIn', 'omni' ),
						'zoomInDown'        => esc_html__( 'zoomInDown', 'omni' ),
						'zoomInLeft'        => esc_html__( 'zoomInLeft', 'omni' ),
						'zoomInRight'       => esc_html__( 'zoomInRight', 'omni' ),
						'zoomInUp'          => esc_html__( 'zoomInUp', 'omni' ),
						'slideInDown'       => esc_html__( 'slideInDown', 'omni' ),
						'slideInLeft'       => esc_html__( 'slideInLeft', 'omni' ),
						'slideInRight'      => esc_html__( 'slideInRight', 'omni' ),
						'slideInUp'         => esc_html__( 'slideInUp', 'omni' ),
					),
				),
			),
		),

		array(
			'name'    => 'heading_1',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'heading',
					'content' => esc_html__( 'Single post', 'omni' ),
				),
			),
		),

		array(
			'name'    => 'advertise_code',
			'default' => '<img src="' . $assets_path . 'banner_01.jpg" alt="banner" class="responsive-img" />',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'  => 'textarea',
					'title' => esc_html__( 'Advertise Code', 'omni' ),
				),
			),
		),
		array(
			'name'    => 'related_posts_hide',
			'default' => false,
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'switcher',
					'title'   => esc_html__( 'Hide related posts', 'omni' ),
					'default' => false,
				),
			),
		),
		array(
			'name'    => 'related_posts_style',
			'default' => 'slider',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'select',
					'title'      => esc_html__( 'Related posts style', 'omni' ),
					'options'    => array(
						'slider' => esc_html__( 'Slider', 'omni' ),
						'list'   => esc_html__( 'List', 'omni' ),
					),
					'dependency' => array( 'related_posts_hide', '!=', 'true' ),
				),
			),
		),
	),
);

$options[] = array(
	'name'     => 'page_options',
	'title'    => esc_html__( 'Page options', 'omni' ),
	'settings' => array(
		array(
			'name'    => 'menu_position',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'select',
					'title'   => esc_html__( 'Menu position', 'omni' ),
					'options' => array(
						'menu-horizontal' => esc_html__( 'Horizontal', 'omni' ),
						'menu-vertical'   => esc_html__( 'Vertical', 'omni' ),
					),
					'default' => 'menu-horizontal',
				),
			),
		),
		array(
			'name'    => 'page_title_style',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'select',
					'title'   => esc_html__( 'Title style', 'omni' ),
					'options' => array(
						''             => esc_html__( 'On left', 'omni' ),
						'title-center' => esc_html__( 'On center with marker', 'omni' ),
					),
					'default' => '',
				),
			),
		),
		array(
			'name'    => 'page_title_animation',
			'default' => 'none',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'select',
					'title'   => esc_html__( 'Title animations', 'omni' ),
					'options' => array(
						'none'              => '',
						'bounceIn'          => esc_html__( 'bounceIn', 'omni' ),
						'bounceInDown'      => esc_html__( 'bounceInDown', 'omni' ),
						'bounceInLeft'      => esc_html__( 'bounceInLeft', 'omni' ),
						'bounceInRight'     => esc_html__( 'bounceInRight', 'omni' ),
						'bounceInUp'        => esc_html__( 'bounceInUp', 'omni' ),
						'fadeIn'            => esc_html__( 'fadeIn', 'omni' ),
						'fadeInDown'        => esc_html__( 'fadeInDown', 'omni' ),
						'fadeInDownBig'     => esc_html__( 'fadeInDownBig', 'omni' ),
						'fadeInLeft'        => esc_html__( 'fadeInLeft', 'omni' ),
						'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig', 'omni' ),
						'fadeInRight'       => esc_html__( 'fadeInRight', 'omni' ),
						'fadeInRightBig'    => esc_html__( 'fadeInRightBig', 'omni' ),
						'fadeInUp'          => esc_html__( 'fadeInUp', 'omni' ),
						'fadeInUpBig'       => esc_html__( 'fadeInUpBig', 'omni' ),
						'flipInX'           => esc_html__( 'flipInX', 'omni' ),
						'flipInY'           => esc_html__( 'flipInY', 'omni' ),
						'lightSpeedIn'      => esc_html__( 'lightSpeedIn', 'omni' ),
						'rotateIn'          => esc_html__( 'rotateIn', 'omni' ),
						'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft', 'omni' ),
						'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'omni' ),
						'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft', 'omni' ),
						'rotateInUpRight'   => esc_html__( 'rotateInUpRight', 'omni' ),
						'rollIn'            => esc_html__( 'rollIn', 'omni' ),
						'zoomIn'            => esc_html__( 'zoomIn', 'omni' ),
						'zoomInDown'        => esc_html__( 'zoomInDown', 'omni' ),
						'zoomInLeft'        => esc_html__( 'zoomInLeft', 'omni' ),
						'zoomInRight'       => esc_html__( 'zoomInRight', 'omni' ),
						'zoomInUp'          => esc_html__( 'zoomInUp', 'omni' ),
						'slideInDown'       => esc_html__( 'slideInDown', 'omni' ),
						'slideInLeft'       => esc_html__( 'slideInLeft', 'omni' ),
						'slideInRight'      => esc_html__( 'slideInRight', 'omni' ),
						'slideInUp'         => esc_html__( 'slideInUp', 'omni' ),
					),
				),
			),
		),

	),
);

$options[] = array(
	'name'     => 'sidebar_options',
	'title'    => esc_html__( 'Sidebar options', 'omni' ),
	'settings' => array(

		array(
			'name'    => 'page_sidebar',
			'default' => 'none',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Page layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
		array(
			'name'    => 'post_sidebar',
			'default' => 'right',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Post layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
		array(
			'name'    => 'author_sidebar',
			'default' => 'right',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Author page layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
		array(
			'name'    => 'archive_sidebar',
			'default' => 'right',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Archive layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
		array(
			'name'    => 'shop_sidebar',
			'default' => 'none',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Shop layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
		array(
			'name'    => 'single_shop_sidebar',
			'default' => 'none',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Singe product layout', 'omni' ),
					'options' => array(
						'none'  => $admin_assets_path . 'no-sidebar.png',
						'left'  => $admin_assets_path . 'sidebar-left.png',
						'right' => $admin_assets_path . 'sidebar-right.png',
					),
					'radio'   => true,
				),
			),
		),
	),
);

// -----------------------------------------
// Footer Customization              -
// -----------------------------------------
$options[] = array(
	'name'     => 'footer_options',
	'title'    => esc_html__( 'Footer options', 'omni' ),
	'sections' => array(
		array(
			'name'     => 'soc_networks',
			'title'    => esc_html__( 'Social networks', 'omni' ),
			'settings' => array(
				array(
					'name'    => 'footer_show_soc_networks',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'switcher',
							'title' => esc_html__( 'Show Social networks', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_facebook',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Facebook', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_google',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Google', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_twitter',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Twitter', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_instagram',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Instagram', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_xing',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Xing', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_lastfm',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'LastFM', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_dribbble',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Dribble', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_vk',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Vkontakte', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_youtube',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Youtube', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_windows',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Microsoft', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_deviantart',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Deviantart', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_linkedin',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'LinkedIN', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_pinterest',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Pinterest', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_wordpress',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Wordpress', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_behance',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Behance', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_flickr',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'Flickr', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'soc_rss',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'text',
							'dependency' => array( 'footer_show_soc_networks', '==', 'true' ),
							'title'      => esc_html__( 'RSS', 'omni' ),
						),
					),
				),
			),
		),


		// Begin: section.
		array(
			'name'     => 'styling_footer',
			'title'    => esc_html__( 'Footer styling', 'omni' ),
			'settings' => array(

				array(
					'name'    => 'footer_bg_image',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'image',
							'title' => esc_html__( 'Footer background image', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'footer_bg_color',
					'control' => array(
						'type'      => 'cs_field',
						'transport' => 'postMessage',
						'options'   => array(
							'type'  => 'color_picker',
							'title' => esc_html__( 'Background color', 'omni' ),
						),
					),
				),
				array(
					'name'      => 'footer_text_color',
					'transport' => 'postMessage',
					'control'   => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'color_picker',
							'title' => esc_html__( 'Text color', 'omni' ),
						),
					),
				),
			),
		),
		// End: section
		// Begin: section.
		array(
			'name'      => 'footer_text',
			'title'     => esc_html__( 'Copyright text', 'omni' ),
			'transport' => 'postMessage',
			'settings'  => array(
				array(
					'name'    => 'footer_copyright_text',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type' => 'textarea',
						),
					),
				),
			),
		),
		// End: section.
	),
);

// -----------------------------------------
// Typography Customization              -
// -----------------------------------------
$options[] = array(
	'name'     => 'typography',
	'title'    => esc_html__( 'Typography options', 'omni' ),
	'sections' => array(

		// Begin: section.
		array(
			'name'     => 'heading_typography',
			'title'    => esc_html__( 'Heading typography', 'omni' ),
			'settings' => array(

				array(
					'name'    => 'heading_typography_use_custom',
					'default' => false,
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'switcher',
							'title' => esc_html__( 'Use custom font', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font',
					'default' => true,
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'typography',
							'dependency' => array( 'heading_typography_use_custom', '==', 'true' ),
							'variant'    => false,
						),
					),
				),
				array(
					'name'      => 'heading_typography_custom_color',
					'transport' => 'postMessage',
					'control'   => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'color_picker',
							'title' => esc_html__( 'Custom text color', 'omni' ),
						),
					),
				),
				array(
					'name'      => 'heading_typography_custom_font_size_h1',
					'transport' => 'postMessage',
					'control'   => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h1 ' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font_size_h2',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h2 ' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font_size_h3',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h3 ' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font_size_h4',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h4' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font_size_h5',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h5 ' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'heading_typography_custom_font_size_h6',
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => 'h6 ' . esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),

			),
		),

		// Begin: section.
		array(
			'name'     => 'body_typography',
			'title'    => esc_html__( 'Body typography', 'omni' ),
			'settings' => array(

				array(
					'name'    => 'body_typography_use_custom',
					'default' => false,
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'switcher',
							'title' => esc_html__( 'Use custom font', 'omni' ),
						),
					),
				),
				array(
					'name'    => 'body_typography_custom_font',
					'default' => true,
					'control' => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'       => 'typography',
							'dependency' => array( 'body_typography_use_custom', '==', 'true' ),
							'variant'    => false,
						),
					),
				),
				array(
					'name'      => 'body_typography_custom_color',
					'transport' => 'postMessage',
					'control'   => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'color_picker',
							'title' => esc_html__( 'Custom text color', 'omni' ),
						),
					),
				),
				array(
					'name'      => 'body_typography_custom_font_size',
					'transport' => 'postMessage',
					'control'   => array(
						'type'    => 'cs_field',
						'options' => array(
							'type'  => 'number',
							'title' => esc_html__( 'Custom font size', 'omni' ),
						),
					),
				),

			),
		),

	),

);

$options[] = array(
	'name'     => 'advanced_options',
	'title'    => esc_html__( 'Advanced options', 'omni' ),
	'settings' => array(
		array(
			'name'    => 'map-api',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'id'    => 'gmap_api_key',
					'type'  => 'text',
					'title' => esc_html__( 'Map api key', 'crum' ),
					'desc'  => esc_html__( 'Enter Google Map API key', 'crum' ),
				),
			),
		),
		array(
			'name'    => 'map-api-notice',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'class'   => 'info',
					'type'    => 'notice',
					'content' => wp_kses( __( 'If you don\'t know, how to get api keys, please check <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Tutorial</a>', 'crum' ), array('br' => array(),'a' => array('href' => array(), 'target' => ''),'p' => array()) ),
				),
			),
		),
		array(
			'type'    => 'heading',
			'content' => esc_html__( 'Counter Code', 'crum' )

		),
		array(
			'name'    => 'counter-code',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'textarea',
					'title'      => esc_html__( 'Counter field', 'omni' ),
					'desc'       => esc_html__( 'Analitycs / Metrika, etc.', 'omni' ),
					'sanitize'   => false,
					'attributes' => array(
						'rows' => 10,
					),
				),
			),
		),
		array(
			'name'    => 'js-code',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'textarea',
					'title'      => esc_html__( 'JS code field', 'omni' ),
					'desc'       => wp_kses( __( 'without &lt; script &gt; tags', 'omni' ), array(
						'br'   => array(),
						'a'    => array(),
						'p'    => array(),
						'&lt;' => array(),
						'&gt;' => array(),
					) ),
					'sanitize'   => false,
					'attributes' => array(
						'placeholder' => 'jQuery( document ).ready(function() {  SOME CODE  });',
						'rows'        => 10,
					),
				),
			),
		),
		array(
			'name'    => 'css-code',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'textarea',
					'title'      => esc_html__( 'CSS code field', 'omni' ),
					'sanitize'   => false,
					'attributes' => array(
						'rows' => 10,
					),
				),
			),
		),
	),
);
// -----------------------------------------
// 404 Page Customization              -
// -----------------------------------------
$options[] = array(
	'name'     => '404_options',
	'title'    => esc_html__( '404 Page Options', 'omni' ),
	'settings' => array(
		// Logotype.
		array(
			'name'    => 'header_logo_404',
			'default' => $admin_assets_path . 'logo.png',
			'control' => array(
				'label' => esc_html__( 'Page Logotype', 'omni' ),
				'type'  => 'image',
			),
		),
		array(
			'name'      => 'bg_image_404',
			'transport' => 'postMessage',
			'default'   => $admin_assets_path . 'clouds.jpg',
			'control'   => array(
				'label' => esc_html__( 'Page background image', 'omni' ),
				'type'  => 'image',
			),
		),
	),
);
$options[] = array(
	'name'     => 'color_scheme_options',
	'title'    => esc_html__( 'Color scheme options', 'omni' ),
	'settings' => array(
		array(
			'name'      => 'predefined_color_schemes',
			'default'   => 'right',
			'transport' => 'postMessage',
			'control'   => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'    => 'image_select',
					'title'   => esc_html__( 'Color scheme', 'omni' ),
					'options' => array(
						'theme-1' => 'http://dummyimage.com/80x80/fbc011/fff&text=Yellow',
						'theme-2' => 'http://dummyimage.com/80x80/00bbd2/fff&text=Cyan',
						'theme-3' => 'http://dummyimage.com/80x80/4caf50/fff&text=Green',
						'theme-4' => 'http://dummyimage.com/80x80/ba68c8/fff&text=Purple',
						'theme-5' => 'http://dummyimage.com/80x80/d80d0d/fff&text=Red',
						'theme-6' => 'http://dummyimage.com/80x80/0045ad/fff&text=Blue',
						'theme-7' => 'http://dummyimage.com/80x80/dd137b/fff&text=Pink',
						'theme-8' => 'http://dummyimage.com/80x80/482d1d/fff&text=Brown',
						'custom'  => 'http://dummyimage.com/80x80/34495e/fff&text=Custom',
					),
					'radio'   => true,
					'default' => 'theme-1',
				),
			),
		),
		array(
			'name'      => 'custom_scheme_color',
			'transport' => 'postMessage',
			'control'   => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'       => 'color_picker',
					'title'      => esc_html__( 'Custom main color', 'omni' ),
					'dependency' => array( 'predefined_color_schemes_custom', '==', 'true' ),
				),
			),
		),
	),
);

CSFramework_Customize::instance( $options );
