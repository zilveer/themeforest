<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Icons List for Visual Composer
*/
if(!class_exists('DFD_Icon_List')) {
	class DFD_Icon_List {
		
		var $icon_font;
		var $icon_margin;
		var $icon_bottom_spase;
		var $main_style;
		var $del_height;
		var $del_style;
		var $del_color;
		var $icon_dec_size;
		var $icon_border_radius;
		var $icon_color;
		var $icon_background;
		var $icon_border_style;
		var $icon_border_width;
		var $icon_border_color;
		var $font_options;
		var $use_google_fonts;
		var $custom_fonts;
		
		function __construct() {
			
			$this->icon_font = '';
			$this->icon_margin = '';
			$this->icon_bottom_spase = '';
			$this->main_style = '';
			$this->del_height = '';
			$this->del_style = '';
			$this->del_color = '';
			$this->icon_dec_size = '';
			$this->icon_border_radius = '';
			$this->icon_color = '';
			$this->icon_background = '';
			$this->icon_border_style = '';
			$this->icon_border_width = '';
			$this->icon_border_color = '';
			$this->font_options = '';
			$this->use_google_fonts = '';
			$this->custom_fonts = '';
			
			add_action('init', array($this, 'dfd_icon_list_init'));
			add_shortcode('dfd_icon_list', array($this, 'dfd_icon_list_shortcode'));
			add_shortcode('dfd_icon_list_item', array($this, 'dfd_icon_list_item_shortcode'));
		}
		function dfd_icon_list_init() {
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/icon_list/';
				vc_map(
					array(
						'name'						=> esc_html__('List Icon', 'dfd'),
						'base'						=> 'dfd_icon_list',
						'class'						=> 'vc_info_banner_icon',
						'icon'						=> 'vc_icon_info_banner',
						'category'					=> esc_html__('Ronneby 2.0','dfd'),
						'description'				=> esc_html__('Add a set of multiple icons and give some custom style.','dfd'),
						'as_parent'					=> array('only' => 'dfd_icon_list_item'), 
						'content_element'			=> true,
						'show_settings_on_create'	=> true,
						'js_view'					=> 'VcColumnView',
						'params'					=> array(
							array(
								'heading'			=> esc_html__( 'Select Layout', 'dfd' ),
								'description'		=> '',
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'style-1.png'
									),
									'style-2'	=> array(
										'tooltip'	=> esc_attr__('Separated','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Half-divided','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
									'style-4'	=> array(
										'tooltip'	=> esc_attr__('Underlined','dfd'),
										'src'		=> $module_images . 'style-4.png'
									),
								),
							),
							array(
								'type'				=> 'textfield',
								'class'				=> '',
								'heading'			=> esc_html__('Extra Class','dfd'),
								'param_name'		=> 'el_class',
								'value'				=> '',
								'description'		=> esc_html__('Write your own CSS and mention the class name here.', 'flip-box'),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Size of Icon', 'dfd'),
								'param_name'		=> 'icon_size',
								'value'				=> '',
								'min'				=> 12,
								'max'				=> 72,
								'description'		=> esc_html__('How big would you like it?', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Icon style', 'dfd')
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Space after Icon', 'dfd'),
								'param_name'		=> 'icon_margin',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 100,
								'description'		=> esc_html__('How much distance would you like in two icons?', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
								'group'				=> esc_html__('Icon style', 'dfd')
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Space under list item', 'dfd'),
								'param_name'		=> 'icon_bottom_spase',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 100,
								'description'		=> esc_html__('Space under list item', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
								'group'				=> esc_html__('Icon style', 'dfd')
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Color', 'dfd'),
								'param_name'		=> 'icon_color',
								'value'				=> '',
								'description'		=> esc_html__('Select icons color.', 'dfd'),
								'group'				=> esc_html__('Icon style', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Thumb', 'dfd' ) . ' ' . esc_html__( 'Decoration', 'dfd' ),
								'param_name'       => 'content_t_decoration',
								'group'            => esc_html__( 'Thumb style', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Thumb Size', 'dfd'),
								'param_name'		=> 'icon_dec_size',
								'value'				=> '',
								'min'				=> 30,
								'max'				=> 500,
								'description'		=> esc_html__('Spacing from center of the icon till the boundary of border / background', 'dfd'),
								'group'				=> esc_html__('Thumb style', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Border Radius', 'dfd'),
								'param_name'		=> 'icon_border_radius',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 500,
								'description'		=> esc_html__('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Thumb style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Background Color', 'dfd'),
								'param_name'		=> 'icon_background',
								'value'				=> '',
								'description'		=> esc_html__('Select background color for icon.', 'dfd'),	
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Thumb style', 'dfd'),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Thumb Border Style', 'dfd'),
								'param_name'		=> 'icon_border_style',
								'value'				=> array(
									esc_html__('None','dfd')	=> 'none',
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Double','dfd')	=> 'double',
									esc_html__('Inset','dfd')	=> 'inset',
									esc_html__('Outset','dfd')	=> 'outset',
								),
								'description'		=> esc_html__('Select the border style for icon.', 'dfd'),
								'group'				=> esc_html__('Thumb style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Border Width', 'dfd'),
								'param_name'		=> 'icon_border_width',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'description'		=> esc_html__('Thickness of the border.', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Thumb style', 'dfd'),
								'dependency'		=> array('element' => 'icon_border_style', 'value'   => array( 'solid', 'dashed', 'dotted', 'double', 'inset', 'outset' )),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Border Color', 'dfd'),
								'param_name'		=> 'icon_border_color',
								'value'				=> '',
								'description'		=> esc_html__('Select border color for icon.', 'dfd'),	
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__('Thumb style', 'dfd'),
								'dependency'		=> array('element' => 'icon_border_style', 'value'   => array( 'solid', 'dashed', 'dotted', 'double', 'inset', 'outset' )),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter height', 'dfd'),
								'param_name'		=> 'del_height',
								'value'				=> 1,
								'min'				=> 1,
								'max'				=> 20,
								'description'		=> esc_html__('Delimiter height between items', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Delimiter style', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter Style', 'dfd'),
								'param_name'		=> 'del_style',
								'value'				=> array(
									esc_html__('Dotted','dfd') => 'dotted',
									esc_html__('Solid','dfd') => 'solid',
									esc_html__('Dashed','dfd') => 'dashed',
									esc_html__('Double','dfd') => 'double',
								),
								'description'		=> esc_html__('Select the Delimiter style.','dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 no-top-padding crum_vc',
								'group'				=> esc_html__('Delimiter style', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter Color', 'dfd'),
								'param_name'		=> 'del_color',
								'value'				=> '',
								'description'		=> __('Select delimiter color for items.', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 no-top-padding crum_vc',
								'group'				=> esc_html__('Delimiter style', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'		=> 'content_t_heading',
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'crumina_font_container',
								'heading'			=> '',
								'param_name'		=> 'font_options',
								'settings'			=> array(
									'fields'		=> array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'checkbox',
								'heading'			=> esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'		=> 'use_google_fonts',
								'value'				=> array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description'		=> esc_html__( 'Use font family from google.', 'dfd' ),
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'google_fonts',
								'param_name'		=> 'custom_fonts',
								'value'				=> '',
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
								'settings'			=> array(
									'fields'		=> array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__( 'Animation', 'dfd' ),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
								'description'		=> esc_html__( '', 'dfd' ),
								'group'				=> esc_html__('Animation Settings', 'dfd')
							),
						)
					)
				);
				vc_map(
					array(
					   'name'						=> esc_html__('List Icon Item', 'dfd'),
					   'base'						=> 'dfd_icon_list_item',
					   'class'						=> 'vc_info_banner_icon',
					   'icon'						=> 'vc_icon_info_banner',
					   'category'					=> esc_html__('Ronneby 2.0','dfd'),
					   'description'				=> esc_html__('Add a list of icons with some content and give some custom style.','dfd'),
					   'as_child'					=> array('only' => 'dfd_icon_list'), 
					   'show_settings_on_create'	=> true,
					   'params'						=> array(
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Icon to display:', 'dfd'),
								'param_name'		=> 'icon_type',
								'value'				=> array(
									esc_html__('Font Icon Manager','dfd') => 'selector',
									esc_html__('Custom Image Icon','dfd') => 'custom',
								),
								'description'		=> esc_html__('Use an existing font icon</a> or upload a custom image.', 'dfd')
							),
							array(
								'type'				=> 'icon_manager',
								'class'				=> '',
								'heading'			=> esc_html__('Select Icon ','dfd'),
								'param_name'		=> 'icon',
								'value'				=> '',
								'description'		=> __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "flip-box"),
								'dependency'		=> array('element' => 'icon_type','value' => array('selector')),
							),
							array(
								'type'				=> 'attach_image',
								'class'				=> '',
								'heading'			=> esc_html__('Upload Image Icon:', 'dfd'),
								'param_name'		=> 'icon_img',
								'value'				=> '',
								'description'		=> esc_html__('Upload the custom image icon.', 'dfd'),
								'dependency'		=> array('element' => 'icon_type','value' => array('custom')),
							),
							array(
								'type'				=> 'textarea_html',
								'class'				=> '',
								'heading'			=> esc_html__('List icon content', 'dfd'),
								'param_name'		=> 'content',
								'admin_label'		=> true,
								'value'				=> '',
								'description'		=> esc_html__('Enter the list content here.', 'dfd'),
								'group'				=> 'Content'
							),
						),
					)
				);
			}
		}
		
		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 * @param string $content Text Field.
		 *
		 * @return string
		 */
		
		// Shortcode handler function for list Icon
		function dfd_icon_list_shortcode($atts,$content = null) {
			$main_style = $el_class = $icon_size = $icon_margin = $icon_bottom_spase = $module_animation = $animate = $animation_data = $del_height = $del_style = $del_color = '';
			$del_html = $del_item_style = $main_style_class = $animate = $animation_data = $icon_dec_size = $icon_border_radius = $icon_color = '';
			$icon_background = $icon_border_style = $icon_border_width = $icon_border_color = $font_options = $use_google_fonts = $custom_fonts = $output = '';
			
			$atts = vc_map_get_attributes( 'dfd_icon_list', $atts );
			extract( $atts );
			
			$this->icon_font = $icon_size;
			$this->icon_margin = $icon_margin;
			$this->icon_bottom_spase = $icon_bottom_spase;
			$this->main_style = $main_style;
			$this->del_height = $del_height;
			$this->del_style = $del_style;
			$this->del_color = $del_color;
			$this->icon_dec_size = $icon_dec_size;
			$this->icon_border_radius = $icon_border_radius;
			$this->icon_color = $icon_color;
			$this->icon_background = $icon_background;
			$this->icon_border_style = $icon_border_style;
			$this->icon_border_width = $icon_border_width;
			$this->icon_border_color = $icon_border_color;
			$this->font_options = $font_options;
			$this->use_google_fonts = $use_google_fonts;
			$this->custom_fonts = $custom_fonts;
			
			if ( ! ($module_animation == '')) {
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-item=".dfd-list-content" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			if(!empty($main_style) && strcmp($main_style, 'style-1') !== 0) {
				if(strcmp($main_style, 'style-2') === 0) {
					$main_style_class = ' del-full-width';
				} elseif(strcmp($main_style, 'style-3') === 0) {
					$main_style_class = ' del-half-width';
				} elseif(strcmp($main_style, 'style-4') === 0) {
					$main_style_class = ' del-width-net-icon';
				}
			}
			
			$output .= '<div class="dfd-icon-list-wrap '.$main_style_class.' '.esc_attr($main_style).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
			$output .= '<ul class="dfd-icon-list">';
			$output .= wpb_js_remove_wpautop($content, false);
			$output .= '</ul>';
			$output .= '</div>';
			
			return $output;
		}
		
		function dfd_icon_list_item_shortcode($atts, $content = null) {
			
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_background = $icon_border_style = $icon_size = $icon_border_radius = '';
			$icon_border_color = $icon_border_width = $icon_dec_size = $icon_animation = $icon_margin = $icon_style = $icon_content = $avatar_style = '';
			$icon_bottom_spase = $output = $list_item_style = $del_html = $del_item_style = $content_typo = $use_google_fonts = $font_options = $thumb_size =	'';
			$custom_fonts =	$main_style = $del_height = $del_style = $del_color = '';
			
			$atts = vc_map_get_attributes( 'dfd_icon_list_item', $atts );
			extract( $atts );

			$icon_style .= 'style="';
			$del_item_style .= 'style="';
			
			if(empty($icon_margin)) {
				$icon_margin = $this->icon_margin;
			}
			if(empty($icon_bottom_spase)) {
				$icon_bottom_spase = $this->icon_bottom_spase;
			}
			if(empty($main_style)) {
				$main_style = $this->main_style;
			}
			if(empty($del_height)) {
				$del_height = $this->del_height;
				$del_item_style .= 'border-bottom-width:'.esc_attr($del_height).'px; ';
			}
			if(empty($del_style)) {
				$del_style = $this->del_style;
				$del_item_style .= 'border-style:'.esc_attr($del_style).'; ';
			}
			if(empty($del_color)) {
				$del_color = $this->del_color;
				$del_item_style .= 'border-color:'.esc_attr($del_color).'; ';
			}
			if(empty($icon_dec_size)) {
				$icon_dec_size = $this->icon_dec_size;
			}
			if(empty($icon_border_radius)) {
				$icon_border_radius = $this->icon_border_radius;
			}
			if(empty($icon_color)) {
				$icon_color = $this->icon_color;
			}
			if(empty($icon_background)) {
				$icon_background = $this->icon_background;
			}
			if(empty($icon_border_style)) {
				$icon_border_style = $this->icon_border_style;
			}
			if(empty($icon_border_width)) {
				$icon_border_width = $this->icon_border_width;
			}
			if(empty($icon_border_color)) {
				$icon_border_color = $this->icon_border_color;
			}
			if(empty($font_options)) {
				$font_options = $this->font_options;
			}
			if(empty($use_google_fonts)) {
				$use_google_fonts = $this->use_google_fonts;
			}
			if(empty($custom_fonts)) {
				$custom_fonts = $this->custom_fonts;
			}
			
			if($icon_margin !== '' && is_rtl()) {  //changes for RTL
				$icon_style .= 'margin-left:'.esc_attr($icon_margin).'px;';
			}else if($icon_margin !== '') {
				$icon_style .= 'margin-right:'.esc_attr($icon_margin).'px;';
			}else{
				$icon_margin = 10;
			}
			
			if($icon_bottom_spase !== '') {
				if(isset($main_style) && strcmp($main_style, 'style-1') === 0) {
					$list_item_style .= 'padding-bottom:'.esc_attr($icon_bottom_spase).'px;';
				}else{
					$list_item_style .= 'padding:'.esc_attr($icon_bottom_spase).'px 0;';
				}
			}
			
			if(isset($icon) && !empty($icon)) {
				if ( $icon_color || $icon_background ) {
					if ( $icon_color ) {
						$icon_style .= 'color:' . esc_attr($icon_color) . '; ';
					}
					if ( $icon_background ) {
						$icon_style .= 'background:' . esc_attr($icon_background) . '; ';
					}
				}
				$icon_content = '<i class = "' . esc_attr($icon) . '"></i>';
			}else{
				$icon_content = '<i class = "none"></i>';
			}
			if(empty($icon_size)) {
				$icon_size = $this->icon_font;
			}
			if(!empty($icon_size)) {
				$icon_style .= 'font-size:' . esc_attr($icon_size) . 'px; ';
			}
			if (isset($icon_dec_size) && !empty($icon_dec_size)) {
				$icon_style .= 'width:' . esc_attr($icon_dec_size) . 'px; height:' . esc_attr($icon_dec_size) . 'px; ';
			}else{
				$icon_dec_size = 36;
			}
			if ( $icon_border_radius ) {
				$icon_style .= 'border-radius:' . esc_attr($icon_border_radius) . 'px; ';
			}
			if(isset($icon_border_style) && strcmp($icon_border_style, 'none') !== 0) {
				if ( $icon_border_style || $icon_border_width || $icon_border_color ) {
					if ($icon_border_style) {
						$icon_style .= 'border-style:' . esc_attr($icon_border_style) . '; ';
					}
					if ($icon_border_width) {
						$icon_style .= 'border-width:' . esc_attr($icon_border_width) . 'px; ';
					}
					if ($icon_border_color) {
						$icon_style .= 'border-color:' . esc_attr($icon_border_color) . '; ';
					}
				}
			}
			$icon_style .= '"';
			
			if (isset($icon_img) && !empty($icon_img)) {
				if(isset($icon_border_width) && !empty($icon_border_width)) {
					$thumb_size = $icon_dec_size - $icon_border_width * 2;
				}else{
					$thumb_size = $icon_dec_size;
				}
				$icon_img = wp_get_attachment_image_src( $icon_img, 'full' );
				$avatar = dfd_aq_resize( $icon_img[0], $thumb_size, $thumb_size, true, true, true );

				$icon_content = '<img src="' . esc_url( $avatar ) . '" alt="' . esc_html__( 'Icon List', 'dfd' ) . '"/>';
			}
			if(!empty($main_style) && strcmp($main_style, 'style-4') === 0) {
				$del_offset = $icon_margin + $icon_dec_size;
				$del_item_style .= 'left: '.esc_attr($del_offset).'px; ';
			}
			if(!empty($main_style) && strcmp($main_style, 'style-1') !== 0) {
				$del_html .= '<span class="dfd-icon-item-delimiter" '.$del_item_style.'"></span>';
			}
				
			$output .= '<div class="dfd-list-content clearfix" style="'.$list_item_style.'">';
				$output .= '<div class="dfd-list-icon-block text-center" ' . $icon_style . '>';
					$output .= $icon_content;
				$output .= '</div>';
			
				// Text Typography.
				$font_options = _crum_parse_text_shortcode_params( $font_options, 'content', $use_google_fonts, $custom_fonts );

				$output .= '<'.$font_options['tag'].' class="dfd-list-content-block '.esc_attr($font_options['class']).'" ' . $font_options['style'] . '>';
					$output .= wpb_js_remove_wpautop($content, false);
				$output .= '</'.$font_options['tag'].'>';
			$output .= '</div>';
			$output .= $del_html;
			
			$output = '<li>'.$output.'</li>';
			return $output;
		}
	}
}
if(class_exists('DFD_Icon_List')){
	$DFD_Icon_List = new DFD_Icon_List;
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_icon_list extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_dfd_icon_list_item extends WPBakeryShortCode {
	}
}