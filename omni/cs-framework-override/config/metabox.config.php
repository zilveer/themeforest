<?php

/**
 * METABOX OPTIONS
 * @package omni
 **/

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

$options      = array();

$admin_assets_path = get_template_directory_uri() . '/images/admin/';

$theme_menus = get_terms('nav_menu');
$menus_list = array(
	'default' => esc_html__('Default','omni'),
);
if(isset($theme_menus) && !($theme_menus == '')){
	foreach ($theme_menus as $single_menu){
		$menus_list[$single_menu->term_id] = $single_menu->name;
	}
}

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_page_options',
	'title'     => esc_html__( 'Blog Page Options', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// Begin: a section.
		array(
			'name'   => 'news_page_blog_settings',
			'icon'   => 'fa fa-cog',
			// Begin: fields.
			'fields' => array(
				array(
					'id'         => 'news_page_blog_style',
					'type'       => 'image_select',
					'title'      => esc_html__( 'Blog style', 'omni' ),
					'desc'       => esc_html__( 'Select style of posts blog', 'omni' ),
					'options'    => array(
						'default'     => $admin_assets_path . 'default.png',
						'standard'  => $admin_assets_path . 'blog-list.png',
						'full'  => $admin_assets_path . 'blog-default.png',
						'image-side' => $admin_assets_path . 'blog-columns.png',
					),
					'attributes' => array(
						'data-depend-id' => 'blog-style',
					),
					'default'    => 'default',
					'radio'      => true,
				),
				array(
					'id'      => 'meta_show_date',
					'type'    => 'select',
					'title'   => esc_html__( 'Hide post date', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'enable'  => esc_html__( 'Enable', 'omni' ),
						'disable' => esc_html__( 'Disable', 'omni' ),
					),
				),
				array(
					'id'      => 'meta_show_meta',
					'type'    => 'select',
					'title' => esc_html__( 'Hide post meta', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'enable'  => esc_html__( 'Enable', 'omni' ),
						'disable' => esc_html__( 'Disable', 'omni' ),
					),
					'dependency' => array( 'blog-style', '==', 'full' ),
				),
				array(
					'id'      => 'meta_show_excerpt',
					'type'    => 'select',
					'title'   => esc_html__( 'Hide post excerpt', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'enable'  => esc_html__( 'Enable', 'omni' ),
						'disable' => esc_html__( 'Disable', 'omni' ),
					),
				),
				array(
					'id'      => 'meta_excerpt_type',
					'type'    => 'select',
					'title'   => esc_html__( 'Excert type', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'content'              => esc_html__( 'Post content', 'omni' ),
						'excerpt'          => esc_html__( 'Generated excerpt', 'omni' ),
					),
					'dependency' => array( 'meta_show_excerpt', '==', 'disable' ),
				),
				array(
					'id'         => 'meta_excerpt_length',
					'type'       => 'number',
					'title'      => esc_html__( 'Excerpt length', 'omni' ),
					'dependency' => array( 'meta_excerpt_type', '==', 'excerpt' ),
				),
				array(
					'id'      => 'post-category-include-exclude',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Exclude categories', 'omni' ),
					'default' => false,
				),
				array(
					'id'              => 'news_page_categories',
					'type'            => 'group',
					'title'           => esc_html__( 'Select categories', 'omni' ),
					'button_title'    => esc_html__( 'Add New', 'omni' ),
					'accordion_title' => esc_html__( 'Posts category', 'omni' ),
					'fields'          => array(
						array(
							'id'         => 'news_page_category',
							'type'       => 'select',
							'options'    => 'categories',
							'query_args' => array(
								'orderby' => 'name',
								'order'   => 'ASC',
							),
							'title'      => esc_html__( 'Select category to display', 'omni' ),
						),
					),
				),
				array(
					'id'    => 'news_page_posts_number',
					'type'  => 'number',
					'title' => esc_html__( 'Number of posts', 'omni' ),
				),
				array(
					'id'      => 'meta_blog_posts_animation',
					'type'    => 'select',
					'title'   => esc_html__( 'Post animations', 'omni' ),
					'options' => array(
						'default'           => esc_html__( 'Default', 'omni' ),
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
			), // End: fields.
		), // End: a section.

	),
);
$options[] = array(
	'id'        => '_gallery_template_options',
	'title'     => esc_html__( 'Gallery Page Options', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// Begin: a section.
		array(
			'name'   => 'gallery_page_blog_settings',
			'icon'   => 'fa fa-cog',
			// Begin: fields.
			'fields' => array(
				array(
					'id'         => 'gallery_style',
					'type'       => 'image_select',
					'title'      => esc_html__( 'Gallery style', 'omni' ),
					'desc'       => esc_html__( 'Select style of gallery', 'omni' ),
					'options'    => array(
						'style_1'     => $admin_assets_path . 'gallery-style-1.png',
						'style_2'  => $admin_assets_path . 'gallery-style-2.png',
					),
					'default'    => 'style_1',
					'radio'      => true,
				),
				array(
					'id'              => 'news_page_categories',
					'type'            => 'group',
					'title'           => esc_html__( 'Select categories', 'omni' ),
					'button_title'    => esc_html__( 'Add New', 'omni' ),
					'accordion_title' => esc_html__( 'Posts category', 'omni' ),
					'fields'          => array(
						array(
							'id'             => 'gallery_categories',
							'type'           => 'select',
							'title'          => esc_html__( 'Select category to display', 'omni' ),
							'options'        => 'categories',
							'query_args'     => array(
								'type'         => 'attachment',
								'taxonomy'     => 'attachments_categories',
								'orderby'      => 'post_date',
								'order'        => 'DESC',
							),
							'default_option' => 'Select a category',
						),
					),
				),
				array(
					'id'    => 'gallery_page_posts_number',
					'type'  => 'number',
					'title' => esc_html__( 'Number of images', 'omni' ),
				),
				array(
					'id'      => 'gallery_page_posts_order',
					'type'    => 'select',
					'title'   => esc_html__( 'Posts order', 'omni' ),
					'options' => array(
						'ASC'  => 'ASC',
						'DESC' => 'DESC',
					),
				),

			), // End: fields.
		), // End: a section.

	),
);
$options[] = array(
	'id'        => '_gallery_modify_options',
	'title'     => esc_html__( 'Gallery Page Options', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// Begin: a section.
		array(
			'name'   => 'gallery_page_blog_settings',
			'icon'   => 'fa fa-cog',
			// Begin: fields.
			'fields' => array(
				
				array(
					'id'              => 'news_page_categories',
					'type'            => 'group',
					'title'           => esc_html__( 'Select categories', 'omni' ),
					'button_title'    => esc_html__( 'Add New', 'omni' ),
					'accordion_title' => esc_html__( 'Posts category', 'omni' ),
					'fields'          => array(
						array(
							'id'             => 'gallery_categories',
							'type'           => 'select',
							'title'          => esc_html__( 'Select category to display', 'omni' ),
							'options'        => 'categories',
							'query_args'     => array(
								'type'         => 'attachment',
								'taxonomy'     => 'attachments_categories',
								'orderby'      => 'post_date',
								'order'        => 'DESC',
							),
							'default_option' => 'Select a category',
						),
						array(
							'id'            => 'category_image',
							'type'          => 'upload',
							'title'         => esc_html__( 'Select image for category', 'omni' ),
							'settings'      => array(
								'upload_type'  => 'image',
								'button_title' => esc_html__( 'Upload', 'omni' ),
								'frame_title'  => esc_html__( 'Select an image', 'omni' ),
								'insert_title' => esc_html__( 'Use this image', 'omni' ),
							),
						),
					),
				),
				array(
					'id'    => 'gallery_page_posts_number',
					'type'  => 'number',
					'title' => esc_html__( 'Number of images', 'omni' ),
				),
				array(
					'id'      => 'gallery_page_posts_order',
					'type'    => 'select',
					'title'   => esc_html__( 'Posts order', 'omni' ),
					'options' => array(
						'ASC'  => 'ASC',
						'DESC' => 'DESC',
					),
				),

			), // End: fields.
		), // End: a section.

	),
);
$options[] = array(
	'id'        => 'coming_soon_template_options',
	'title'     => esc_html__( 'Coming soon Page Options', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// Begin: a section.
		array(
			'name'   => 'coming_soon_template_settings',
			'icon'   => 'fa fa-cog',
			// Begin: fields.
			'fields' => array(
				array(
					'id'    => 'coming_soon_bg_image',
					'type'  => 'image',
					'title' => esc_html__('Page background image','omni'),
				),
				array(
					'id'    => 'coming_soon_date',
					'type'  => 'datepicker',
					'title' => esc_html__('Set date','omni'),
				),
				array(
					'id'      => 'coming_soon_subscribe_hide',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Hide subscribe form', 'omni' ),
					'default' => false,
				),
			), // End: fields.
		), // End: a section.

	),
);
$options[] = array(
	'id'        => 'blank_template_options',
	'title'     => esc_html__( 'Blank Page Options', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// Begin: a section.
		array(
			'name'   => 'coming_soon_template_settings',
			'icon'   => 'fa fa-cog',
			// Begin: fields.
			'fields' => array(
				array(
					'id'      => 'blank_page_header_enable',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable page header', 'omni' ),
					'default' => false,
				),
				array(
					'id'      => 'blank_page_footer_enable',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable page footer', 'omni' ),
					'default' => false,
				),
			), // End: fields.
		), // End: a section.

	),
);
// -----------------------------------------
// Page Side Metabox Options               -
// -----------------------------------------
$options[] = array(
	'id'        => 'custom_sidebar_options',
	'title'     => esc_html__( 'Page settings', 'omni' ),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'core',
	'sections'  => array(

		array(
			'name'   => 'page_menu_settings',
			'title'  => esc_html__( 'Menu settings', 'omni' ),
			'fields' => array(
				array(
					'id'      => 'menu_stick_to_bottom',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Stick menu to bottom of screen', 'omni' ),
					'default' => false,
				),
				array(
					'id'      => 'meta-page-menu',
					'type'    => 'select',
					'title'   => esc_html__( 'Custom menu', 'omni' ),
					'options' => $menus_list,
					'default' => 'default',
				),
				array(
					'id'      => 'meta-menu-position',
					'type'    => 'select',
					'title'   => esc_html__( 'Menu position', 'omni' ),
					'options' => array(
						'default'         => esc_html__( 'Default', 'omni' ),
						'menu-horizontal' => esc_html__( 'Horizontal', 'omni' ),
						'menu-vertical'   => esc_html__( 'Vertical', 'omni' ),
					),
				),
			),
		),
		array(
			'name'   => 'page_title_settings',
			'title'  => esc_html__( 'Title settings', 'omni' ),
			'fields' => array(
				array(
					'id'      => 'page_title_hide',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Disable page title', 'omni' ),
					'default' => false,
				),
				array(
					'id'         => 'meta_page_title_style',
					'type'       => 'select',
					'title'      => esc_html__( 'Title style', 'omni' ),
					'options'    => array(
						'default'      => esc_html__( 'Default', 'omni' ),
						'none'         => esc_html__( 'On left', 'omni' ),
						'title-center' => esc_html__( 'On center with marker', 'omni' ),
					),
					'dependency' => array( 'page_title_hide', '!=', 'true' ),
				),
				array(
					'id'         => 'meta_page_title_animation',
					'type'       => 'select',
					'title'      => esc_html__( 'Title animations', 'omni' ),
					'dependency' => array( 'page_title_hide', '!=', 'true' ),
					'options'    => array(
						'default'           => esc_html__( 'Default', 'omni' ),
						''                  => esc_html__( 'None', 'omni' ),
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
				array(
					'id'      => 'page_padding_disable',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Disable page padding', 'omni' ),
					'default' => false,
				),
			),
		),
		array(
			'name'   => 'page_inner_settings',
			'title'  => esc_html__( 'Page inner settings', 'omni' ),
			'fields' => array(
				array(
					'id'      => 'header_transparent',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable transparent header', 'omni' ),
					'default' => false,
				),
				array(
					'id'      => 'custom_page_sidebar',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Sidebar align', 'omni' ),
					'options' => array(
						'default' => $admin_assets_path . 'default.png',
						'none'    => $admin_assets_path . 'no-sidebar.png',
						'left'    => $admin_assets_path . 'sidebar-left.png',
						'right'   => $admin_assets_path . 'sidebar-right.png',
					),
					'default' => 'default',
				),
			),
		),
	),
);

$options[] = array(
	'id'        => 'post-format-video-feature',
	'title'     => esc_html__( 'Post featured media', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(

		array(
			'name'   => 'post_formats_video',
			'fields' => array(

				array(
					'id'    => 'post_video_feature',
					'type'  => 'text',
					'title' => esc_html__( 'Set link for post featured embed video', 'omni' ),
				),
			),
		),
		array(
			'name'   => 'post_formats_video_mp4',
			'fields' => array(

				array(
					'id'    => 'post_video_feature_mp4',
					'type'  => 'upload',
					'settings' => array( 'upload_type' => 'video' ),
					'title' => esc_html__( 'Set link for post featured mp4 video', 'omni' ),
				),
			),
		),
		array(
			'name'   => 'post_formats_video_webm',
			'fields' => array(

				array(
					'id'    => 'post_video_feature_mp4_webm',
					'type'  => 'upload',
					'settings' => array( 'upload_type' => 'video' ),
					'title' => esc_html__( 'Set link for post featured webm video', 'omni' ),
				),
			),
		),
	),
);

$options[] = array(
	'id'        => 'post-format-quote-feature',
	'title'     => esc_html__( 'Post featured media', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(

		array(
			'name'   => 'post_formats_quote_text',
			'fields' => array(

				array(
					'id'    => 'post_quote_text',
					'type'  => 'textarea',
					'title' => esc_html__( 'Quote text','omni' ),
				),
			),
		),
		array(
			'name'   => 'post_formats_quote_author',
			'fields' => array(

				array(
					'id'    => 'post_quote_author',
					'type'  => 'text',
					'title' => esc_html__( 'Quote author', 'omni' ),
				),
			),
		),
		array(
			'name'   => 'post_formats_quote_author_desc',
			'fields' => array(

				array(
					'id'    => 'post_quote_author_desc',
					'type'  => 'text',
					'title' => esc_html__( 'Quote author description', 'omni' ),
				),
			),
		),

	),
);

$options[] = array(
	'id'        => 'post-format-audio-feature',
	'title'     => esc_html__( 'Post featured media', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(

		array(
			'name'   => 'post_formats_audio',
			'fields' => array(

				array(
					'id'    => 'post_audio_feature',
					'type'  => 'text',
					'title' => esc_html__( 'Set link for post featured embed audio', 'omni' ),
				),
			),
		),
		array(
			'name'   => 'post_formats_audio_self_hosted',
			'fields' => array(

				array(
					'id'    => 'post_audio_feature_self_hosted',
					'type'  => 'upload',
					'settings' => array( 'upload_type' => 'audio' ),
					'title' => esc_html__( 'Set link for post featured self hosted audio', 'omni' ),
				),
			),
		),

	),
);

$options[] = array(
	'id'        => 'post-format-gallery-feature',
	'title'     => esc_html__( 'Post featured media', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(

		array(
			'name'   => 'post_formats_gallery',
			'fields' => array(
				array(
					'id'    => 'post_gallery_feature',
					'type'  => 'gallery',
					'title' => esc_html__( 'Set for post featured gallery', 'omni' ),
				),
			),
		),

	),
);
$options[] = array(
	'id'        => 'meta-post-show-related',
	'title'     => esc_html__( 'Related posts', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(

		array(
			'name'   => 'relaetd_posts_show',
			'fields' => array(

				array(
					'id'      => 'meta_show_related',
					'type'    => 'select',
					'title'   => esc_html__( 'Hide related posts', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'enable'  => esc_html__( 'Hide', 'omni' ),
						'disable' => esc_html__( 'Show', 'omni' ),
					),
				),
			),
		),

		array(
			'name'   => 'related_posts_style',
			'fields' => array(

				array(
					'id'      => 'meta_related_posts_style',
					'type'    => 'select',
					'title'   => esc_html__( 'Related posts style', 'omni' ),
					'options' => array(
						'default' => esc_html__( 'Default', 'omni' ),
						'slider'              => esc_html__( 'Slider', 'omni' ),
						'list'          => esc_html__( 'List', 'omni' ),
					),
					'dependency' => array( 'meta_show_related', '==', 'disable' ),
				),
			),
		),
	),
);

$options[] = array(
	'id'        => 'testimonial-post-format-meta',
	'title'     => esc_html__( 'Testimonial meta', 'omni' ),
	'post_type' => 'crumina_testimonial',
	'context'   => 'side',
	'priority'  => 'core',
	'sections'  => array(

		array(
			'name'   => 'testimonial_author',
			'fields' => array(
				array(
					'id'    => 'testimonial_author',
					'type'  => 'text',
					'title' => esc_html__( 'Client\'s name', 'omni' ),
				),
			),
		),
		array(
			'name'   => 'testimonial_boxes',
			'fields' => array(
				array(
					'id'    => 'testimonial_profession',
					'type'  => 'text',
					'title' => esc_html__( 'Client\'s profession', 'omni' ),
				),
			),
		),

	),
);


$options[] = array(
	'id'        => 'custom_sidebar_options',
	'title'     => esc_html__( 'Sidebar options', 'omni' ),
	'post_type' => 'post',
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(

		array(
			'name'   => 'post_sidebar',
			'fields' => array(

				array(
					'id'      => 'custom_post_sidebar',
					'type'    => 'image_select',
					'title' => esc_html__( 'Sidebar align','omni' ),
					'options' => array(
						'default' => $admin_assets_path . 'default.png',
						'none'    => $admin_assets_path . 'no-sidebar.png',
						'left'    => $admin_assets_path . 'sidebar-left.png',
						'right'   => $admin_assets_path . 'sidebar-right.png',
					),
					'default' => 'default',
				),
			),
		),

	),
);

CSFramework_Metabox::instance( $options );
