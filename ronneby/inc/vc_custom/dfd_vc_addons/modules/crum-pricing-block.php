<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Pricing Block
*/
if ( ! class_exists( 'Dfd_Pricing_Block' ) ) {
	/**
	 * Class Dfd_Pricing_Block
	 */
	class Dfd_Pricing_Block {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_pricing_block_init' ) );
			add_shortcode( 'pricing_block', array( &$this, 'dfd_pricing_block_form' ) );
		}

		/**
		 * Block options.
		 */
		function dfd_pricing_block_init() {

			$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/pricing/';

			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => esc_html__( 'Pricing block', 'dfd' ),
						'base'        => 'pricing_block',
						'class'       => 'pricing_block',
						'icon'        => 'pricing_block',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Your pricing information', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'description' => '',
									'type'        => 'radio_image_select',
									'param_name'  => 'style',
									'simple_mode' => false,
									'options'     => array(
										'style-01'	=> array(
											'tooltip'	=> esc_attr__('Classic','dfd'),
											'src'		=> $module_images . 'style-01.png'
										),
										'style-02'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-02.png'
										),
										'style-03'	=> array(
											'tooltip'	=> esc_attr__('Main','dfd'),
											'src'		=> $module_images . 'style-03.png'
										),
										'style-04'	=> array(
											'tooltip'	=> esc_attr__('Colored','dfd'),
											'src'		=> $module_images . 'style-04.png'
										),
									),
								),
								array(
									'type'        => 'checkbox',
									'heading'     => esc_html__( 'Slim style', 'dfd' ),
									'value'       => array( esc_html__( 'Enable', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Paddings and spaces will be decreaset to perfect fit into 4-column row', 'dfd' ),
									'param_name'  => 'slim',
								),
								//heading tab
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Subtitle', 'dfd' ),
									'param_name'  => 'subtitle',
								),
								array(
									'type'             => 'textfield',
									'heading'          => esc_html__( 'Currency symbol', 'dfd' ),
									'param_name'       => 'currency_symbol',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Payment amount', 'dfd' ),
									'param_name'       => 'payment_amount',
									'min'              => 0,
									'std'              => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'             => 'textfield',
									'heading'          => esc_html__( 'Time interval', 'dfd' ),
									'param_name'       => 'time_interval',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__( 'Add icon to header', 'dfd' ),
									'value'      => array( esc_html__( 'Enable', 'dfd' ) => 'yes' ),
									'param_name' => 'show_icon',
								),
								array(
									'type'        => 'textfield',
									'heading'     => __( 'Extra class name', 'dfd' ),
									'param_name'  => 'el_class',
									'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dfd' ),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Animation', 'dfd' ),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Icon to display:', 'dfd' ),
									'param_name' => 'icon_type',
									'value'      => array(
										esc_html__( 'Font Icon Manager', 'dfd' ) => 'selector',
										esc_html__( 'Custom Image Icon', 'dfd' ) => 'custom',
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Opacity', 'dfd' ) .' (0-100) %',
									'param_name'       => 'opacity',
									'min'              => '0',
									'max'              => '100',
									'value'            => '100',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
									'group'            => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'    => esc_html__( 'Size of Icon', 'dfd' ),
									'param_name' => 'icon_size',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'min'        => 12,
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'    => esc_html__( 'Color', 'dfd' ),
									'param_name' => 'icon_color',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'       => 'icon_manager',
									'class'      => '',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon',
									'value'      => '',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'        => 'attach_image',
									'class'       => '',
									'heading'     => esc_html__( 'Upload Image:', 'dfd' ),
									'param_name'  => 'icon_image_id',
									'value'       => '',
									'group'       => esc_html__( 'Icon', 'dfd' ),
									'description' => esc_html__( 'Upload the custom image icon.', 'dfd' ),
									'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Content', 'dfd' ),
									'param_name' => 'description',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'param_group',
									'heading'     => __( 'Features', 'dfd' ),
									'param_name'  => 'values',
									'group'       => esc_html__( 'Content', 'dfd' ),
									'description' => __( 'Features list', 'dfd' ),
									'value'       => urlencode( json_encode( array(
										array(
											'feature_style' => 'text_icon',
											'label'         => __( 'Development', 'dfd' ),
										),
									) ) ),
									'params'      => array(
										array(
											'type'       => 'dropdown',
											'heading'    => esc_html__( 'Type', 'dfd' ),
											'param_name' => 'feature_style',
											'admin_label' => true,
											'value'      => array(
												esc_html__( 'Text with icon', 'dfd' ) => 'text_icon',
												esc_html__( 'Only text', 'dfd' ) => 'text_only',
												esc_html__( 'Only Icon', 'dfd' ) => 'icon_only',
												esc_html__( 'Dot Enabled', 'dfd' )    => 'dot-enabled',
												esc_html__( 'Dot Disabled', 'dfd' )   => 'dot-disabled',
												esc_html__( 'Dot Custom', 'dfd' )     => 'dot',
											),
										),
										array(
											'type'        => 'textfield',
											'heading'     => __( 'Label', 'dfd' ),
											'param_name'  => 'label',
											'admin_label' => true,
											'dependency'  => array(
												'element' => 'feature_style',
												'value'   => array( 'text_icon', 'text_only' ),
											),
										),
										array(
											'type' => 'dropdown',
											'heading' => __( 'Icon library', 'js_composer' ),
											'value' => array(
												__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
												__( 'Open Iconic', 'js_composer' ) => 'openiconic',
												__( 'Typicons', 'js_composer' ) => 'typicons',
												__( 'Entypo', 'js_composer' ) => 'entypo',
												__( 'Linecons', 'js_composer' ) => 'linecons',
											),
											'param_name' => 'type',
											'dependency'  => array(
												'element' => 'feature_style',
												'value'   => array( 'text_icon','icon_only' ),
											),
											'description' => __( 'Select icon library.', 'js_composer' ),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'js_composer' ),
											'param_name' => 'icon_fontawesome',
											'value' => 'fa fa-adjust', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false,
												// default true, display an "EMPTY" icon?
												'iconsPerPage' => 4000,
												// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'fontawesome',
											),
											'description' => __( 'Select icon from library.', 'js_composer' ),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'js_composer' ),
											'param_name' => 'icon_openiconic',
											'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'openiconic',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'openiconic',
											),
											'description' => __( 'Select icon from library.', 'js_composer' ),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'js_composer' ),
											'param_name' => 'icon_typicons',
											'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'typicons',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'typicons',
											),
											'description' => __( 'Select icon from library.', 'js_composer' ),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'js_composer' ),
											'param_name' => 'icon_entypo',
											'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'entypo',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'entypo',
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'js_composer' ),
											'param_name' => 'icon_linecons',
											'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'linecons',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'linecons',
											),
											'description' => __( 'Select icon from library.', 'js_composer' ),
										),
										array(
											'type'       => 'colorpicker',
											'heading'    => esc_html__( 'Color', 'dfd' ),
											'param_name' => 'dot_color',
											'dependency' => array(
												'element' => 'feature_style',
												'value'   => array( 'dot' ),
											),
										),
									),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Button text', 'dfd' ),
									'param_name'  => 'button_text',
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'vc_link',
									'heading'     => __( 'Button link', 'dfd' ),
									'param_name'  => 'button_link',
									'description' => __( 'Add link to button.', 'dfd' ),
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
							),
							//Style tab
							array(
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__( 'Block border style', 'dfd' ),
									'param_name' => 'border_style',
									'value'      => array(
										esc_html__( 'None', 'dfd' )   => '',
										esc_html__( 'Solid', 'dfd' )  => 'solid',
										esc_html__( 'Dotted', 'dfd' ) => 'dotted',
										esc_html__( 'Dashed', 'dfd' ) => 'dashed',

									),
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Border color', 'dfd' ),
									'param_name'       => 'border_color',
									'dependency'       => array(
										'element' => 'border_style',
										'value' => array( 'solid', 'dotted', 'dashed' ),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Border width', 'dfd' ),
									'param_name'       => 'border_width',
									'min'              => 0,
									'std'              => '1',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array(
										'element' => 'border_style',
										'value' => array( 'solid', 'dotted', 'dashed' ),
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Heading background color', 'dfd' ),
									'param_name'       => 'head_bg_color',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Description background color', 'dfd' ),
									'param_name'       => 'desc_bg_color',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'        => 'checkbox',
									'heading'     => esc_html__( 'Feature mark', 'dfd' ),
									'value'       => array( esc_html__( 'Enable', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Display feature mark on pricing block', 'dfd' ),
									'param_name'  => 'feat_mark',
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Mark text', 'dfd' ),
									'param_name'  => 'feat_mark_text',
									'group'       => esc_html__( 'Style', 'dfd' ),
									'dependency'  => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
								),
								array(
									'type'             => 'dropdown',
									'heading'          => esc_html__( 'Mark style', 'dfd' ),
									'param_name'       => 'feat_mark_style',
									'value'            => array(
										esc_html__( 'Style', 'dfd' ) . ' 01' => 'style-01',
										esc_html__( 'Style', 'dfd' ) . ' 02' => 'style-02',

									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Mark text color', 'dfd' ),
									'param_name'       => 'feat_mark_text_color',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Mark bg color', 'dfd' ),
									'param_name'       => 'feat_mark_bg_color',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'        => 'checkbox',
									'heading'     => esc_html__( 'Price Separator', 'dfd' ),
									'value'       => array( esc_html__( 'Enable', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Separator between title and price', 'dfd' ),
									'param_name'  => 'price_sep',
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'line_color',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array(
										'element' => 'price_sep',
										'value'   => 'yes',
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Width', 'dfd' ),
									'param_name'       => 'line_width',
									'min'              => 0,
									'suffix'           => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
									'dependency'       => array(
										'element' => 'price_sep',
										'value'   => 'yes',
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Height', 'dfd' ),
									'param_name'       => 'line_border',
									'min'              => 0,
									'suffix'           => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
									'dependency'       => array(
										'element' => 'price_sep',
										'value'   => 'yes',
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								/*TODO: ������ �� �����������*/
								/*array(
									'type'        => 'checkbox',
									'heading'     => esc_html__( 'Description Separator', 'dfd' ),
									'value'       => array( esc_html__( 'Enable', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Separator between heading and description', 'dfd' ),
									'param_name'  => 'desc_sep',
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'dropdown',
									'heading'          => esc_html__( 'Separator style', 'dfd' ),
									'param_name'       => 'desc_sep_style',
									'value'            => array(
										esc_html__( 'Style', 'dfd' ) . ' 01' => 'style-01',
										esc_html__( 'Style', 'dfd' ) . ' 02' => 'style-02',
										esc_html__( 'Style', 'dfd' ) . ' 03' => 'style-03',

									),
									'dependency'       => array(
										'element' => 'desc_sep',
										'value'   => array( 'yes' ),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'desc_sep_color',
									'dependency'       => array(
										'element' => 'desc_sep',
										'value'   => array( 'yes' ),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),*/
							),
							//typography tab
							array(
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'title_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
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
									'param_name'  => 'use_google_fonts',
									'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Use font family from google.', 'dfd' ),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'custom_fonts',
									'value'      => '',
									'group'      => esc_attr__( 'Typography', 'dfd' ),
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array(
										'element' => 'use_google_fonts',
										'value'   => 'yes',
									),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Subtitle', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'subtitle_t_heading',
									'group'            => esc_html__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'subtitle_font_options',
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
									'group'      => esc_html__( 'Typography', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'content_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),

							)
						)
					)
				);
			}
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array $atts Shortcode atributes.
		 *
		 * @return string
		 */
		function dfd_pricing_block_form( $atts ) {

			$style = $slim= $output = $el_class = $module_animation = $link_css = $uniqid = $border_style_css = $border_width_css = $border_color_css = '';
			//Heading
			$title = $subtitle = $currency_symbol = $payment_amount = $time_interval = $hide_heading = '';
			//Description
			$description = $values = $button_text = $button_link = '';
			//Style
			$border_style    = $border_color = $border_width = $head_bg_color = $desc_bg_color = $feat_mark = $feat_mark_text = '';
			$feat_mark_style = $feat_mark_text_color = $feat_mark_bg_color = $price_sep =  $line_width = $line_border = $line_color = $price_sep_style = $price_sep_color = '';
			$desc_sep        = $desc_sep_style = $desc_sep_color = $el_class = $no_margin_class ='';
			//Icons
			$type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = $show_icon = $icon_html = '';
			//Typography
			$title_font_options = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = '';

			$atts = vc_map_get_attributes( 'pricing_block', $atts );
			extract( $atts );

			/**************************
			 * Appear Animation
			 *************************/

			$uniqid = uniqid('dfd-pricing-block-') .'-'.rand(1,9999);
			
			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if ( ! empty ( $show_icon ) ) {
				$icon_html = '<div class="icon-wrap">' . crumina_icon_render( $atts ) . '</div>';
			}

			$title_html    = $subtitle_html = $price_sep_html = $sep_style_price = $desc_sep_class = $sep_style_desc = $hide_heading_class = '';
			$heading_style = $description_style = $pricing_style = $interval_style = '';
			$attributes    = array();


			/**************************
			 * Header block options.
			 *************************/

			if ( ! empty( $head_bg_color ) ) {
				$heading_style = 'style="background-color:' . $head_bg_color . '"';
			}
			if ( ! empty( $desc_bg_color ) ) {
				$description_style = 'style="background-color:' . $desc_bg_color . '"';
			}

			if ( ! empty( $title_options['color'] ) ) {
				$pricing_style = 'style="color:' . $title_options['color'] . '"';
			}

			if ( ! empty( $subtitle_options['color'] ) ) {
				$interval_style = 'style="color:' . $subtitle_options['color'] . '"';
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/

			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
				$title_html .= '<' . $title_options['tag'] . ' class="' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</' . $title_options['tag'] . '>';
			}

			$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );

			if ( ! empty( $subtitle ) ) {
				$subtitle_html .= '<' . $subtitle_options['tag'] . ' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . $subtitle . '</' . $subtitle_options['tag'] . '>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color ) {
				$sep_style_price .= 'style="';
				if ( $line_width ) {
					$sep_style_price .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$sep_style_price .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$sep_style_price .= 'border-color:' . $line_color;
				}
				$sep_style_price .= '"';
			}
			if ( 'yes' === $price_sep ) {
				$price_sep_html .= '<span class="price-sep" ' . $sep_style_price . '></span>';
			}



			/***************************
			 * Button style.
			 **************************/
			if ( function_exists( 'vc_build_link' ) ) {
				$button_link = ( '||' === $button_link ) ? '' : $button_link;
				$button_link = vc_build_link( $button_link );

				$a_href   = $button_link['url'];
				$a_title  = $button_link['title'];
				$a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

				$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
				$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
				$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
			}

			/***************************
			 * "Featured" label style
			 **************************/
			if ( ! empty( $feat_mark_text_color ) || ! empty( $feat_mark_bg_color ) ) {
				$mark_style = 'style="';
				if ( ! empty( $feat_mark_text_color ) ) {
					$mark_style .= 'color:' . $feat_mark_text_color . '; ';
				}
				if ( isset( $feat_mark_bg_color ) && ! empty( $feat_mark_bg_color ) ) {
					$mark_style .= 'background-color:' . $feat_mark_bg_color . ';';
				}
				$mark_style .= '"';
			} else {
				$mark_style = '';
			}
			/**************************
			 * Block Border
			 *************************/
			if (isset($border_style) && !empty($border_style)) {
				$border_style_css = 'border-style: '.esc_attr($border_style).';';
			}
			if (isset($border_width) && !empty($border_width)) {
				$border_width_css = 'border-width: '.esc_attr($border_width).'px;';
			}
			if (isset($border_color) && !empty($border_color)) {
				$border_color_css = 'border-color: '.esc_attr($border_color).';';
			}
			$link_css .= '#'.$uniqid.'.dfd-pricing-block {'.$border_style_css.' '.$border_width_css.' '.$border_color_css.'}';

			if ( 'yes' === $slim ) {
				$el_class .= ' slim-block';
			}

			/**************************
			 * Module.
			 *************************/

			if ( empty( $description ) ) {
				$el_class .= ' no-description ';
			}


			$output .= '<div id="'.$uniqid.'" class="dfd-pricing-block ' . $style . ' ' . $el_class . '" ' . $border_style . ' ' . $animation_data . '>';
			$output .= '<div class="block-head ' . $desc_sep_class . ' " ' . $heading_style . '>';

			/**************************
			 * Module-Header.
			 *************************/
			if ( isset( $feat_mark ) && ( 'yes' === $feat_mark ) ) {
				$output .= '<span class="feat-mark ' . $feat_mark_style . '" ' . $mark_style . '>' . $feat_mark_text . '</span>';
			}

			$output .= $icon_html;

			$output .= $title_html;

			$output .= $subtitle_html;

			if($price_sep_html != '')
				$output .= '<div class="delimiter-wrap">' . $price_sep_html . '</div>';
			
			$output .= '<div class="price-wrap">';

			if ( ! empty( $currency_symbol ) ) {
				$output .= '<span class="currency-symbol" ' . $pricing_style . '>' . $currency_symbol . '</span>';
			}

			if ( ! empty( $payment_amount ) ) {
				$output .= '<span class="payment-amount" ' . $pricing_style . '>' . $payment_amount . '</span>';
			}

			if ( ! empty( $time_interval ) ) {
				$output .= '<span class="time-interval" ' . $interval_style . '> / ' . $time_interval . '</span>';
			}
			$output .= '</div>';

			$output .= '</div>';/*crum-pricing-block-head*/

			/**************************
			 * Module-Description.
			 *************************/

			$output .= '<div class="block-desc" ' . $description_style . '>';

			if ( ! empty( $description ) ) {
				$output .= '<' . $subtitle_options['tag'] . ' class="desc-text ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . $description . '</' . $subtitle_options['tag'] . '>';
			}

			/**************************
			 * Module-options-values.
			 *************************/
			if ( function_exists( 'vc_param_group_parse_atts' ) ) {
				$values = (array) vc_param_group_parse_atts( $values );
			}

			if ( is_array( $values ) ) {
				$description_option = _crum_parse_text_shortcode_params( $font_options, 'price-feature');

				$output .= '<ul class="options-list">';

				foreach ( $values as $single_feature ) {

					// Enqueue needed icon font.
					vc_icon_element_fonts_enqueue( $single_feature['type'] );

					$iconClass = isset( $single_feature{'icon_' . $single_feature['type']} ) ? esc_attr( $single_feature{'icon_' . $single_feature['type']} ) : '';

					$output .= '<li class="option">';
					if ( ( 'text_icon' !== $single_feature['feature_style'] ) && ( 'text_only' !== $single_feature['feature_style'] ) && ( 'icon_only' !== $single_feature['feature_style'] ) ) {
						if ( ! empty( $single_feature['dot_color'] ) ) {
							$dot_style = 'style="background-color:' . $single_feature['dot_color'] . '"';
						} else {
							$dot_style = '';
						}
						$output .= '<span class="price-block-dot ' . $single_feature['feature_style'] . '" ' . $dot_style . '></span>';
					} else {
						if ( ! empty( $iconClass ) && ( 'text_only' !== $single_feature['feature_style'] ) ) {

							if(( 'icon_only' === $single_feature['feature_style'] )){
								$no_margin_class = 'no-margin';
							}

							$output .= '<span class="option-icon ' . $no_margin_class . '"><i class="' . $iconClass . '"></i></span>';
						}
						if ( ! empty( $single_feature['label'] ) && ( 'icon_only' !== $single_feature['feature_style'] ) ) {
							$output .= '<' . $description_option['tag'] . ' class="pricing-feature-description" ' . $description_option['style'] . '>' . $single_feature['label'] . '</' . $description_option['tag'] . '>';
						}
					}
					$output .= '</li>';
				}
				$output .= '</ul>';
			}
			/**************************
			 * Module-Button.
			 *************************/
			if ( ! empty( $button_link ) ) {
				$output .= '<a class="pricing-button button" ' . implode( ' ', $attributes ) . '>' . $button_text . '</a>';
			}

			$output .= '</div>';
			//Description end

			$output .= '</div>';
			//module end
			
			if(!empty($link_css)) {
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style>'. esc_js($link_css) .'</style>");
					})(jQuery);
				</script>';
			}

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Pricing_Block' ) ) {
	$Dfd_Pricing_Block = new Dfd_Pricing_Block;
}