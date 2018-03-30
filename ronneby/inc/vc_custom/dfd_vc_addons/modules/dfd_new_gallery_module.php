<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Gallery module
*/
if(!class_exists('Dfd_New_Gallery_Module')) {
	class Dfd_New_Gallery_Module {
		
		var $admin_src = 'inc/vc_custom/dfd_vc_addons/admin/img/gallery/';
		var $front_template = 'inc/vc_custom/dfd_vc_addons/templates/gallery/';
		
		function __construct(){
			add_action('init',array($this,'dfd_gallery_module_init'));
			add_shortcode('dfd_gallery_module_shortcode',array($this,'dfd_gallery_module_shortcode'));
		}
		function dfd_gallery_module_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => esc_attr__('Gallery module','dfd'),
						'base' => 'dfd_gallery_module_shortcode',
						'class' => 'vc_interactive_icon',
						'icon' => 'vc_icon_interactive',
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'description' => esc_attr__('Displays Gallery items','dfd'),
						'params' => array(
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'description' => '',
								'param_name'  => 'style',
								'options'     => dfd_build_shortcode_style_param($this->admin_src, $this->front_template),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Heading position', 'dfd' ),
								'description' => '',
								'param_name'  => 'title_position',
								'options'     => array(
									'bottom'  => get_template_directory_uri() . '/' . $this->admin_src . 'title_position/dfd-title-bottom.png',
									'top'	  => get_template_directory_uri() . '/' . $this->admin_src . 'title_position/dfd-title-top.png',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Gallery items settings', 'dfd' ),
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
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => esc_html__('Gallery item to display','dfd'),
								'param_name' => 'single_custom_post_item',
								'value' => '',
								'post_type' => 'gallery',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => esc_attr__('Select portfolio item to display', 'dfd'),
								'dependency' => array('element' => 'items','value' => array('single')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => esc_html__('Categories','dfd'),
								'param_name' => 'post_categories',
								'value' => dfd_get_select_options_multi('gallery_category'),
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
								'heading' => esc_html__('Items to show', 'dfd'),
								'param_name' => 'posts_to_show',
								'value' => 9,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Items offset', 'dfd'),
								'param_name' => 'items_offset',
								'value' => 20,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								'value' => array(
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
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
								'param_name' => 'columns_masonry',
								'value' => 3,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'true',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel')),
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
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 900,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('fitRows','carousel')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 600,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
								'dependency' => array('element' => 'style','value' => array('fitRows','carousel')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'sort',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','fitRows')),
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'title',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable subtitle','dfd'),
								'param_name' => 'enabled_meta',
								'value' => 'meta',
								'options' => array(
										'meta' => array(
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'meta',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'read_more',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'share',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'comments',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'likes',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
												'on' => 'Yes',
												'off' => 'No',
										),
								),
//								'value' => array(
//									esc_html__('Yes, please','dfd') => 'anim_com_like',
//								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
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
							/* Hover options */
							/*array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Hover options', 'dfd' ),
								'param_name'       => 'hover_main_heading',
								'group'			   => esc_attr__( 'Hover options', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),*/
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Hover style','dfd'),
								'param_name' => 'hover_style',
								'value' => array(
									esc_attr__('Inherit from theme options','dfd') => '',
									esc_attr__('Design your own','dfd') => 'custom',
								),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'param_name' => 'dfd_gallery_hover_link',
								'heading' => esc_html__('Apply link to:', 'dfd'),
								'value' => array(
									esc_attr__('Open gallery in lightbox', 'dfd') => 'lightbox',
									esc_attr__('Go to Gallery single item', 'dfd') => 'link',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'param_name' => 'dfd_gallery_hover_appear_effect',
								'heading' => esc_html__('Mask appear effect', 'dfd'),
								'value' => array(
									esc_attr__('Fade out', 'dfd') => 'dfd-fade-out',
									esc_attr__('Fade out with offset', 'dfd') => 'dfd-fade-offset',
									esc_attr__('From left to right', 'dfd') => 'dfd-left-to-right',
									esc_attr__('From right to left', 'dfd') => 'dfd-right-to-left',
									esc_attr__('From top to bottom', 'dfd') => 'dfd-top-to-bottom',
									esc_attr__('From bottom to top', 'dfd') => 'dfd-bottom-to-top',
									esc_attr__('From left to right shift image', 'dfd') => 'dfd-left-to-right-shift',
									esc_attr__('From right to left shift image', 'dfd') => 'dfd-right-to-left-shift',
									esc_attr__('From top to bottom shift image', 'dfd') => 'dfd-top-to-bottom-shift',
									esc_attr__('From bottom to top shift image', 'dfd') => 'dfd-bottom-to-top-shift',
									esc_attr__('Following the mouse', 'dfd') => 'portfolio-hover-style-1',
									esc_attr__('Rotate content up', 'dfd') => 'dfd-rotate-content-up',
									esc_attr__('Rotate content down', 'dfd') => 'dfd-rotate-content-down',
									esc_attr__('Rotate left', 'dfd') => 'dfd-rotate-left',
									esc_attr__('Rotate right', 'dfd') => 'dfd-rotate-right',
									esc_attr__('Rotate top', 'dfd') => 'dfd-rotate-top',
									esc_attr__('Rotate bottom', 'dfd') => 'dfd-rotate-bottom',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'dfd_gallery_hover_image_effect',
								'type' => 'dropdown',
								'heading' => esc_html__('Image effect', 'dfd'),
								'desc' => '',
								'value' => array(
									esc_attr__('Image parallax', 'dfd') => 'panr',
									esc_attr__('Grow', 'dfd') => 'dfd-image-scale',
									esc_attr__('Grow with rotation', 'dfd') => 'dfd-image-scale-rotate',
									esc_attr__('Shift left', 'dfd') => 'dfd-image-shift-left',
									esc_attr__('Shift right', 'dfd') => 'dfd-image-shift-right',
									esc_attr__('Shift top', 'dfd') => 'dfd-image-shift-top',
									esc_attr__('Shift bottom', 'dfd') => 'dfd-image-shift-bottom',
									esc_attr__('Blur', 'dfd') => 'dfd-image-blur',
								),
								'dependency' => array('element' => 'dfd_gallery_hover_appear_effect','value' => array(
									'dfd-fade-out',
									'dfd-fade-offset',
									'dfd-left-to-right',
									'dfd-right-to-left',
									'dfd-top-to-bottom',
									'dfd-bottom-to-top',
									'portfolio-hover-style-1',
									'dfd-rotate-content-up',
									'dfd-rotate-content-down',
								)),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'dfd_gallery_hover_main_dedcoration',
								'type' => 'dropdown',
								'heading' => esc_html__('Main decoration', 'dfd'),
								'desc' => '',
								'value' => array(
									esc_attr__('None', 'dfd') => 'none',
									esc_attr__('Heading', 'dfd') => 'heading',
									esc_attr__('Plus', 'dfd') => 'plus',
									esc_attr__('Lines', 'dfd') => 'lines',
									esc_attr__('Dots', 'dfd') => 'dots',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'dfd_gallery_hover_title_dedcoration',
								'type' => 'dropdown',
								'heading' => esc_html__('Heading decoration', 'dfd'),
								'desc' => '',
								'value' => array(
									esc_attr__('None', 'dfd') => 'title-deco-none',
									esc_attr__('Diagonal line', 'dfd') => 'diagonal-line',
									esc_attr__('Title underline', 'dfd') => 'title-underline',
									esc_attr__('Square behind heading', 'dfd') => 'square-behind-heading',
								),
								'dependency' => array('element' => 'dfd_gallery_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'ult_switch', //the field type
								'param_name' => 'dfd_gallery_hover_show_title',
								'heading' => esc_html__('Enable titles', 'dfd'),
								'value' => 'on',
								'options' => array(
										'on' => array(
												'on' => 'Yes',
												'off' => 'No',
										),
								),
								//'value' => array(esc_html__('Yes, please', 'dfd') => 'on'),
								'dependency' => array('element' => 'dfd_gallery_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'ult_switch', //the field type
								'param_name' => 'dfd_gallery_hover_show_subtitle',
								'heading' => esc_html__('Enable subtitle', 'dfd'),
								'value' => 'on',
								'options' => array(
										'on' => array(
												'on' => 'Yes',
												'off' => 'No',
										),
								),
								//'value' => array(esc_html__('Yes, please', 'dfd') => 'on'),
								'dependency' => array('element' => 'dfd_gallery_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'dfd_gallery_hover_plus_position',
								'type' => 'dropdown',
								'heading' => esc_html__('Plus position', 'dfd'),
								'value' => array(
									esc_attr__('Middle of the project', 'dfd') => 'dfd-middle',
									esc_attr__('Top right corner', 'dfd') => 'dfd-top-right',
									esc_attr__('Top left corner', 'dfd') => 'dfd-top-left',
									esc_attr__('Bottom right corner', 'dfd') => 'dfd-bottom-right',
									esc_attr__('Bottom left corner', 'dfd') => 'dfd-bottom-left',
								),
								'dependency' => array('element' => 'dfd_gallery_hover_main_dedcoration', 'value' => array('plus')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'dfd_gallery_hover_plus_bg',
								'type' => 'colorpicker',
								'heading' => esc_html__('Plus background', 'dfd'),
								'dependency' => array('element' => 'dfd_gallery_hover_plus_position', 'value' => array('dfd-top-right','dfd-top-left','dfd-bottom-right','dfd-bottom-left')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							/* Temporary hidden */
							/*
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Gallery hover mask style','dfd'),
								'param_name' => 'image_mask_background',
								'value' => array(
									esc_attr__('Theme default','dfd') => '',
									esc_attr__('Custom color','dfd') => 'color',
									esc_attr__('Gradient','dfd') => 'gradient',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group' => esc_attr__('Hover options'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'dfd_gallery_hover_text_color',
								'heading' => esc_html__('Gallery hover text color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('color', 'gradient')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'class' => '',
								'heading' => esc_html__('Gallery hover mask color', 'dfd'),
								'value' => '#000000',
								'dependency' => array('element' => 'image_mask_background','value' => array('color')),
								'group' => esc_attr__('Hover options'),
							),
							array(
								'type' => 'gradient',
								'param_name' => 'image_mask_gradient',
								'class' => '',
								'heading' => esc_html__('Gallery hover mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('gradient')),
								'group' => esc_attr__('Hover options'),
							),
							*/
							/* Hover options */
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
		
		function dfd_gallery_module_shortcode($atts) {
			$output = $title_html = $data_atts = $article_data_atts = $css_rules = $dfd_gallery_hover_style_class = $thumb_data_attr = $js_scripts = $extra_class_name = $anim_class = '';
			$sort_panel = false;
			
			$atts = vc_map_get_attributes( 'dfd_gallery_module_shortcode', $atts );
			extract( $atts );
			
			$el_class .= ' ' . $style;
			
			if(!empty($module_animation)) {
				$anim_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-item=".cover" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if($items == 'single' && isset($single_custom_post_item) && !empty($single_custom_post_item)) {
				$args = array(
					'post_type' => 'gallery',
					'p' => $single_custom_post_item
				);
				$columns_masonry = 1;
			} else {
				$sticky = get_option( 'sticky_posts' );

				if (!empty($post_categories)){
					$post_categories_array = explode(',', $post_categories);
					$args = array(
						'post_type' => 'gallery',
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'gallery_category',
							'field' => 'slug',
							'terms' => $post_categories_array,
						)
					);
					if(isset($exclude_from_loop) && $exclude_from_loop == 'exclude') {
						$args['tax_query'][0]['operator'] = 'NOT IN';
					}
				} else {
					$args = array(
						'post_type' => 'gallery',
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
				}
			}
			
			$uniqid = uniqid('dfd-gallery-module-');
			
			$enable_title = ($enabled_title == 'title') ? true : false;
			
			$enable_meta = ($enabled_meta == 'meta') ? true : false;
			
			$read_more = ($enabled_read_more == 'read_more') ? true : false;
			
			$share = ($enabled_share == 'share') ? true : false;
			
			$comments = ($enabled_comments == 'comments') ? true : false;

			$likes = ($enabled_likes == 'likes')? true : false;

			$media_class = ($enabled_anim_com_like == 'anim_com_like') ? 'comments-like-hover' : '';
			
			$wp_query = new WP_Query($args);
			
			$style_template = locate_template($this->front_template).$style.'.php';
			
			$options = array(
				'dfd_gallery_hover_link' => 'lightbox',
				'dfd_gallery_hover_appear_effect' => 'dfd-fade-out',
				'dfd_gallery_hover_image_effect' => '',
				'dfd_gallery_hover_main_dedcoration' => 'heading',
				'dfd_gallery_hover_title_dedcoration' => 'none',
				'dfd_gallery_hover_show_title' => 'on',
				'dfd_gallery_hover_show_subtitle' => 'on',
				'dfd_gallery_hover_plus_position' => '',
				'dfd_gallery_hover_plus_bg' => '',
				'dfd_gallery_item_appear_effect' => '',
				'dfd_gallery_comments_likes_style' => '',
			);
			
			if($hover_style == 'custom') {
				foreach($options as $k => $v) {
					$options[$k] = (isset($$k) && !empty($$k)) ? $$k : $v;
				}
			} else {
				global $dfd_ronneby;
				foreach($options as $k => $v) {
					$options[$k] = (isset($dfd_ronneby[$k]) && !empty($dfd_ronneby[$k])) ? $dfd_ronneby[$k] : $v;
				}
			}
			
			if($options['dfd_gallery_hover_image_effect'] == 'panr') {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
			}
			
			$non3d_hovers = array(
				'dfd-fade-out',
				'dfd-fade-offset',
				'dfd-left-to-right',
				'dfd-right-to-left',
				'dfd-top-to-bottom',
				'dfd-bottom-to-top',
				'dfd-rotate-content-up'
			);
			
			$dfd_gallery_hover_style_class .= $options['dfd_gallery_hover_appear_effect'];
			
			if(in_array($options['dfd_gallery_hover_appear_effect'], $non3d_hovers)) {
				$dfd_gallery_hover_style_class .= ' '.$options['dfd_gallery_hover_image_effect'];
			}
			
			if($dfd_gallery_hover_plus_bg && !empty($dfd_gallery_hover_plus_bg)) {
				switch($dfd_gallery_hover_plus_position) {
					case 'dfd-top-right' :
					case 'dfd-bottom-right' :
						$css_rules .= '#'.esc_attr($uniqid).' .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link:before {border-right-color: '.esc_attr($options['dfd_gallery_hover_plus_bg']).';}';
						break;
					case 'dfd-top-left' :
					case 'dfd-bottom-left' :
						$css_rules .= '#'.esc_attr($uniqid).' .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link:before {border-left-color: '.esc_attr($options['dfd_gallery_hover_plus_bg']).';}';
						break;
				}
			}
			
			$output .= '<div class="dfd-module-wrapper">';
			
			if(file_exists($style_template)) {
				ob_start();
				
				include($style_template);
				
				$output .= ob_get_clean();
			}
			
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
if(class_exists('Dfd_New_Gallery_Module')) {
	$Dfd_New_Gallery_Module = new Dfd_New_Gallery_Module;
}