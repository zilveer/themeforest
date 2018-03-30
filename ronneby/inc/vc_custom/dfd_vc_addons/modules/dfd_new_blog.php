<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
if(!class_exists('Dfd_Blog_Posts')) {
	class Dfd_Blog_Posts {
		
		var $admin_src = 'inc/vc_custom/dfd_vc_addons/admin/img/blog_posts/';
		var $front_template = 'inc/vc_custom/dfd_vc_addons/templates/blog_posts/';
		
		function __construct(){
			add_action('init',array($this,'blog_posts_init'));
			add_shortcode('dfd_blog_posts',array($this,'blog_posts_shortcode'));
		}
		function blog_posts_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Blog posts','dfd'),
						'base' => 'dfd_blog_posts',
						'class' => 'vc_interactive_icon',
						'icon' => 'vc_icon_interactive',
						'category' => __('Ronneby 2.0','dfd'),
						'description' => __('Displays blog posts','dfd'),
						'params' => array(
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'description' => '',
								'param_name'  => 'style',
								'simple_mode' => false,
								'options'     => dfd_build_shortcode_style_param($this->admin_src, $this->front_template, false),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Layout type', 'dfd' ),
								'description' => '',
								'param_name'  => 'layout_type_grid_carousel',
								'simple_mode' => false,
								'options'     => array(
									'fitRows' => array(
										'tooltip' => esc_attr__('Grid','dfd'),
										'src' => get_template_directory_uri() . '/' . $this->admin_src . 'layout_types/fitRows.png'
									),
									'carousel' => array(
										'tooltip' => esc_attr__('Carousel','dfd'),
										'src' => get_template_directory_uri() . '/' . $this->admin_src . 'layout_types/carousel.png'
									),
								),
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Posts settings', 'dfd' ),
								'param_name'       => 'loop_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content','dfd'),
								'param_name' => 'items',
								'value' => array(
									esc_attr__('Loop','dfd') => 'loop',
									esc_attr__('Single item','dfd') => 'single',
								),
								'dependency' => array('element' => 'style','value' => array('masonry','simple','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => __('Post to display','dfd'),
								'param_name' => 'single_custom_post_item',
								'value' => '',
								'post_type' => 'post',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => __('Select post to display', 'dfd'),
								'dependency' => array('element' => 'items','value' => array('single')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => esc_html__('Categories','dfd'),
								'param_name' => 'post_categories',
								'value' => dfd_get_select_options_multi('category'),
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Exclude selected categories from loop','dfd'),
								'param_name' => 'exclude_from_loop',
								'value' => 'exclude',
								'options' => array(
									'exclude' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'exclude',
								),
								*/
								//'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'post_categories','not_empty' => true),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Posts to show', 'dfd'),
								'param_name' => 'posts_to_show',
								'value' => 6,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Items offset', 'dfd'),
								'param_name' => 'items_offset',
								'value' => 20,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								'value' => array(
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content display','dfd'),
								'param_name' => 'content_effect',
								'value' => array(
									esc_attr__('Show content on hover','dfd') => 'desc-hover',
									esc_attr__('Show content by default','dfd') => '',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('simple','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => esc_html__('Categories','dfd'),
								'param_name' => 'add_post_categories',
								'value' => dfd_get_select_options_multi('category'),
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Exclude selected categories from loop','dfd'),
								'param_name' => 'add_exclude_from_loop',
								'value' => 'exclude',
								'options' => array(
									'exclude' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'exclude',
								),
								*/
								//'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'add_post_categories','not_empty' => true),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Posts to show', 'dfd'),
								'param_name' => 'add_posts_to_show',
								'value' => 4,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Layout settings', 'dfd' ),
								'param_name'       => 'layout_settings_heading',
								'group'			   => esc_attr__( 'Content', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Number of columns', 'dfd'),
								'param_name' => 'columns',
								'value' => 3,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'description' => esc_html__('Max 4 for fitRows and masonry layouts. This option works with loop content only.','dfd'),
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable autoslideshow','dfd'),
								'param_name' => 'enabled_autoslideshow',
								'value' => 'true',
								'options' => array(
									'true' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'true',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'layout_type_grid_carousel','value' => array('carousel')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Slideshow speed', 'dfd'),
								'param_name' => 'carousel_slideshow_speed',
								'value' => 5000,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_autoslideshow','value' => array('true')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							/*
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content configuration','dfd'),
								'param_name' => 'content_config',
								'value' => array(
									esc_attr__('1/12 11/12','dfd') => 'one|eleven',
									esc_attr__('1/6 5/6','dfd') => 'two|ten',
									esc_attr__('1/4 3/4','dfd') => 'three|nine',
									esc_attr__('1/3 2/3','dfd') => 'four|eight',
									esc_attr__('5/12 7/12','dfd') => 'five|seven',
									esc_attr__('1/2 1/2','dfd') => 'six|six',
								),
								'dependency' => array('element' => 'style','value' => array('simple')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							*/
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 900,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 600,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Image mask style','dfd'),
								'param_name' => 'image_mask_background',
								'value' => array(
									esc_attr__('Theme default','dfd') => '',
									esc_attr__('Custom color','dfd') => 'color',
									esc_attr__('Gradient','dfd') => 'gradient',
								),
								'dependency' => array('element' => 'style','value' => array('advanced')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image mask opacity', 'dfd'),
								'param_name' => 'image_mask_opacity',
								'value' => .2,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image mask opacity on hover', 'dfd'),
								'param_name' => 'image_mask_opacity_hover',
								'value' => .8,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'class' => '',
								'heading' => esc_html__('Image mask color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('color')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'gradient',
								'param_name' => 'image_mask_gradient',
								'class' => '',
								'heading' => esc_html__('Image mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content elements', 'dfd' ),
								'param_name'       => 'enabled_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable Sort Panel','dfd'),
								'param_name' => 'masonry_sort_panel',
								'value' => 'sort',
								'options' => array(
									'sort' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'sort',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable Sort Panel','dfd'),
								'param_name' => 'grid_sort_panel',
								'value' => 'sort',
								'options' => array(
									'sort' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'sort',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'layout_type_grid_carousel','value' => array('fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable category','dfd'),
								'param_name' => 'enabled_category',
								'value' => 'category',
								'options' => array(
									'category' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'title',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced','recent','featured','simple')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable title','dfd'),
								'param_name' => 'enabled_title',
								'value' => 'title',
								'options' => array(
									'title' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'title',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable meta','dfd'),
								'param_name' => 'enabled_meta',
								'value' => 'meta',
								'options' => array(
									'meta' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'meta',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable excerpt','dfd'),
								'param_name' => 'enabled_excerpt',
								'value' => 'excerpt',
								'options' => array(
									'excerpt' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'excerpt',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable Read more button','dfd'),
								'param_name' => 'enabled_read_more',
								'value' => 'read_more',
								'options' => array(
									'read_more' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'read_more',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable Share buttons','dfd'),
								'param_name' => 'enabled_share',
								'value' => 'share',
								'options' => array(
									'share' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'share',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable Comments','dfd'),
								'param_name' => 'enabled_comments',
								'value' => 'comments',
								'options' => array(
									'comments' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'comments',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable likes','dfd'),
								'param_name' => 'enabled_likes',
								'value' => 'likes',
								'options' => array(
									'likes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'likes',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Animate comments and likes','dfd'),
								'param_name' => 'enabled_anim_com_like',
								'value' => 'anim_com_like',
								'options' => array(
									'anim_com_like' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value' => array(
									esc_html__('Yes, please','dfd') => 'anim_com_like',
								),
								*/
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Sort panel alignment','dfd'),
								'param_name' => 'sort_alignment',
								'value' => array(
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'masonry_sort_panel','value' => array('sort')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Heading position (if enabled)','dfd'),
								'param_name' => 'heading_position',
								'value' => array(
									esc_attr__('Under media','dfd') => 'bottom',
									esc_attr__('Over media','dfd') => 'top',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Read more style','dfd'),
								'param_name' => 'read_more_style',
								'value' => array(
									esc_attr__('Simple','dfd') => 'simple',
									esc_attr__('Shuffle','dfd') => 'chaffle',
									esc_attr__('Slide up','dfd') => 'slide-up',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'enabled_read_more', 'value' => 'read_more'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Share style','dfd'),
								'param_name' => 'share_style',
								'value' => array(
									esc_attr__('Animated','dfd') => 'animated',
									esc_attr__('Simple','dfd') => 'simple',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'enabled_share', 'value' => 'share'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'title_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Additional News', 'dfd' ) . ' ' . esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'add_title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'add_title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'add_title_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'dependency'  => array('element' => 'style','value' => array('featured','recent')),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'add_title_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'add_title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => '',
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
							),
						),
					)
				);
			}
		}
		
		function blog_posts_shortcode($atts) {
			$output = $title_html = $data_atts = $article_data_atts = $css_rules = $js_scripts = $extra_class_name = $anim_class = '';
			$sort_panel = false;
			
			$atts = vc_map_get_attributes( 'dfd_blog_posts', $atts );
			extract( $atts );
			
			$el_class .= ' ' . $style;
			
			if(!empty($module_animation)) {
				$anim_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-item=".cover" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if(isset($style) && !empty($style) && ($style == 'featured' || $style == 'recent')) {
				if(isset($add_post_categories) && !empty($add_post_categories))
					$post_categories = $add_post_categories;
				
				if(isset($add_exclude_from_loop) && !empty($add_exclude_from_loop))
					$exclude_from_loop = $add_exclude_from_loop;
				
				if(isset($add_posts_to_show) && !empty($add_posts_to_show))
					$posts_to_show = $add_posts_to_show;
			}
			
			if($items == 'single' && isset($single_custom_post_item) && !empty($single_custom_post_item)) {
				$args = array(
					'p' => $single_custom_post_item
				);
				$columns = 1;
			} else {
				$sticky = get_option( 'sticky_posts' );

				if (!empty($post_categories)){
					$post_categories_array = explode(',', $post_categories);
					$args = array(
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
					if(isset($exclude_from_loop) && $exclude_from_loop == 'exclude') {
						$exclude_cats = array();
						foreach($post_categories_array as $cat) {
							$exclude_cat = get_term_by('slug', $cat, 'category');
							$exclude_cats[] = $exclude_cat->term_id;
						}
						$args['category__not_in'] = $exclude_cats;
					} else {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $post_categories_array,
							)
						);
					}
				} else {
					$args = array(
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
				}
			}
			
			$enable_cat = ($enabled_category == 'category') ? true : false;
			
			$enable_title = ($enabled_title == 'title') ? true : false;
			
			$enable_meta = ($enabled_meta == 'meta') ? true : false;
			
			$enable_excerpt = ($enabled_excerpt == 'excerpt') ? true : false;
			
			$read_more = ($enabled_read_more == 'read_more') ? true : false;
			
			$share = ($enabled_share == 'share') ? true : false;
			
			$comments = ($enabled_comments == 'comments') ? true : false;

			$likes = ($enabled_likes == 'likes')? true : false;

			$media_class = ($enabled_anim_com_like == 'anim_com_like') ? 'comments-like-hover' : '';
			
			$wp_query = new WP_Query($args);
			
			$style_template = locate_template($this->front_template).$style.'.php';
			
			$output .= '<div class="dfd-module-wrapper">';
			
			ob_start();
			if(file_exists($style_template))
				include($style_template);
			$output .= ob_get_clean();
			
			if(!empty($css_rules) || !empty($js_scripts)) {
				$output .= '<script type="text/javascript">
								(function($) {';
				if(!empty($css_rules))
					$output .= '$("head").append("<style>'.$css_rules.'</style>");';
				
				if(!empty($js_scripts))
					$output .= $js_scripts;
				
				$output .= '})(jQuery);
							</script>';
			}
			
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Blog_Posts')) {
	$Dfd_Blog_Posts = new Dfd_Blog_Posts;
}