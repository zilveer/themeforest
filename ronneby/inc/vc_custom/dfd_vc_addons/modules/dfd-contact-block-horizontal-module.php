<?php //
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if(!class_exists('Dfd_Contact_Block_Horizontal')) {
	
	class Dfd_Contact_Block_Horizontal {
		function __construct(){
			add_action('init',array($this,'dfd_contact_block_horizontal_init'));
			add_shortcode('dfd_contact_block_horizontal', array($this,'dfd_contact_block_horizontal_shortcode'));
		}
		function dfd_contact_block_horizontal_init() {
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/contact_block_horizontal/';
				vc_map(
					array(
					   'name'				=> esc_html__('Contact Block Horizontal','dfd'),
					   'base'				=> 'dfd_contact_block_horizontal',
					   'class'				=> 'vc_info_banner_icon',
					   'icon'				=> 'vc_icon_info_banner',
					   'category'			=> esc_html__('Ronneby 2.0','dfd'),
					   'description'		=> esc_html__('Displays Module Contact Block Horizontal','dfd'),
					   'params'				=> array(
							array(
								'heading'			=> esc_html__( 'Select Style', 'dfd' ),
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
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Underlined','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
									'style-4'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'style-4.png'
									),
								),
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> esc_html__('Extra class name', 'js_composer'),
								'param_name'		=> 'el_class',
								'description'		=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> esc_html__( 'Images or icons before content?', 'dfd' ),
								'param_name'		=> 'icon_image',
								'value'				=> array(
									esc_html__('Icons','dfd')	=> 'icons',
									esc_html__('Images','dfd')	=> 'images',
								),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'textfield',
								'class'				=> '',
								'heading'			=> esc_html__('Our Address','dfd'),
								'param_name'		=> 'fild_address',
								'value'				=> '',
								'admin_label'		=> true,
								'description'		=> esc_html__('Enter your address', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'attach_image',
								'class'				=> '',
								'heading'			=> esc_html__('Upload Image Icon:', 'dfd'),
								'param_name'		=> 'address_img',
								'value'				=> '',
								'description'		=> esc_html__('Upload the custom image icon.', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd'),
								'dependency'		=> array( 'element' => 'icon_image', 'value'   => array( 'images' ) ),
							),
							array(
								'type'				=> 'textfield',
								'class'				=> '',
								'heading'			=> esc_html__('Our Phones','dfd'),
								'param_name'		=> 'fild_phone',
								'value'				=> '',
								'description'		=> esc_html__('Enter your phone', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'attach_image',
								'class'				=> '',
								'heading'			=> esc_html__('Upload Image Icon:', 'dfd'),
								'param_name'		=> 'phones_img',
								'value'				=> '',
								'description'		=> esc_html__('Upload the custom image icon.', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd'),
								'dependency'		=> array( 'element' => 'icon_image', 'value'   => array( 'images' ) ),
							),
							array(
								'type'				=> 'textfield',
								'class'				=> '',
								'heading'			=> esc_html__('Our Email','dfd'),
								'param_name'		=> 'fild_email',
								'value'				=> '',
								'description'		=> esc_html__('Enter your email', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'attach_image',
								'class'				=> '',
								'heading'			=> esc_html__('Upload Image Icon:', 'dfd'),
								'param_name'		=> 'email_img',
								'value'				=> '',
								'description'		=> esc_html__('Upload the custom image icon.', 'dfd'),
								'group'				=> esc_html__('Content', 'dfd'),
								'dependency'		=> array( 'element' => 'icon_image', 'value'   => array( 'images' ) ),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Icon decoration', 'dfd'),
								'param_name'		=> 'icon_decoration',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper vc_column vc_col-sm-12 no-top-margin',
								'group'				=> esc_html__('Style decoration', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Icon size', 'dfd'),
								'param_name'		=> 'icon_size',
								'value'				=> '',
								'min'				=> 5,
								'max'				=> 100,
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'dependency'		=> array( 'element' => 'icon_image', 'value'   => array( 'icons' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Icon Color', 'dfd'),
								'param_name'		=> 'icon_color',
								'value'				=> '',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'icon_image', 'value'   => array( 'icons' ) ),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Thumb size', 'dfd'),
								'param_name'		=> 'thumb_size',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 500,
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Thumb Background Color', 'dfd'),
								'param_name'		=> 'icon_background_color',
								'value'				=> '',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-4' ) ),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Border radius', 'dfd'),
								'param_name'		=> 'icon_border_radius',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 500,
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Border Style', 'dfd'),
								'param_name'		=> 'icon_border_style',
								'value'				=> array(
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Double','dfd')	=> 'double',
									esc_html__('Inset','dfd')	=> 'inset',
									esc_html__('Outset','dfd')	=> 'outset',
								),
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2' ) ),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Border Width', 'dfd'),
								'param_name'		=> 'icon_border_width',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Border Color', 'dfd'),
								'param_name'		=> 'icon_border_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Border Style', 'dfd'),
								'param_name'		=> 'icon_border_style4',
								'value'				=> array(
									esc_html__('None','dfd')	=> 'none',
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Dotted','dfd')	=> 'dotted',
								),
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-4' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Border Color', 'dfd'),
								'param_name'		=> 'icon_border_color4',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'icon_border_style4', 'value'   => array( 'solid', 'dashed', 'dotted'/*, 'double', 'inset', 'outset'*/ ) ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Triple border bottom', 'dfd' ),
								'param_name'  => 'triple_border_bottom4',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'group'       => esc_attr__( 'Style decoration', 'dfd' ),
								'dependency'		=> array( 'element' => 'icon_border_style4', 'value'   => array( 'solid', 'dashed', 'dotted'/*, 'double', 'inset', 'outset'*/ ) ),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Delimiter decoration', 'dfd'),
								'param_name'		=> 'delimiter_decoration',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style decoration', 'dfd'),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter Style', 'dfd'),
								'param_name'		=> 'delimiter_border_style',
								'value'				=> array(
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Double','dfd')	=> 'double',
									esc_html__('Inset','dfd')	=> 'inset',
									esc_html__('Outset','dfd')	=> 'outset',
									esc_html__('None','dfd')	=> 'none',
								),
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter Height', 'dfd'),
								'param_name'		=> 'delimiter_height',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array('element' => 'delimiter_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Delimiter Color', 'dfd'),
								'param_name'		=> 'delimiter_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array('element' => 'delimiter_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'checkbox',
								'heading'			=> esc_html__( 'Align to icon', 'dfd' ),
								'param_name'		=> 'delimiter_align',
								'value'				=> array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'group'				=> esc_html__('Style decoration', 'dfd'),
								'dependency'		=> array('element' => 'delimiter_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
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
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__( 'Animation', 'dfd' ),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
								'description'		=> esc_html__( '', 'dfd' ),
								'group'				=> esc_html__('Animation Settings', 'dfd'),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_contact_block_horizontal_shortcode($atts) {
			$main_style = $el_class = $fild_address = $fild_phone = $fild_email = $module_animation = $animate = $animation_data = $output = $fild_name_css = '';
			$filds = $icon = $fild_email_html = $prefix = $field_html = $icon_class = $icon_border_style = $icon_border_width = $icon_border_color = $icon_border_radius = '';
			$icon_background_color = $icon_size = $thumb_size = $delimiter_border_style = $delimiter_height = $delimiter_color = $delim_html = $thumb_style = '';
			$block_content_style = $margin_left_style1 = $delimiter_align = $icon_color = $delimiter_style = $address_img = $phones_img = $avatar = '';
			$title_font_options = $title_google_fonts = $title_custom_fonts = $title_options = $icon_content = $img_size = $icon_image = $email_img = $link_css = '';
			$icon_content_phones = $icon_content_email = $img_padding = $icon_border_style4 = $icon_border_color4 = $triple_border_bottom4 = $general_class = '';
			$address_var = $phones_var = $email_var = '';
			
			extract(shortcode_atts( array(
				'main_style' => 'style-1',
				'el_class' => '',
				'icon_image' => 'icons',
				'fild_address' => '',
				'address_img' => '',
				'fild_phone' => '',
				'phones_img' => '',
				'fild_email' => '',
				'email_img' => '',
				'icon_border_style' => 'solid',
				'icon_border_width' => '',
				'icon_border_color' => '',
				'icon_border_radius' => '',
				'icon_background_color' => '',
				'icon_size' => '',
				'icon_color' => '',
				'thumb_size' => '',
				'icon_border_style4' => 'none',
				'icon_border_color4' => '',
				'triple_border_bottom4' => '',
				'delimiter_border_style' => 'dotted',
				'delimiter_height' => '',
				'delimiter_color' => '',
				'delimiter_align' => '',
				'title_font_options' => '',
				'title_google_fonts' => '',
				'title_custom_fonts' => '',
				'module_animation' => ''
			),$atts));
			
			$thumb_style .= 'style="';
			$block_content_style .= 'style="';
			$delimiter_style .= 'style="';
			
			$uniqid = uniqid('dfd-contacts-') .'-'.rand(1,9999);
			
			$fild_email_html = '<a href="mailto:'.esc_attr($fild_email).'">'.esc_attr($fild_email).'</a>';
			
			$prefix = __('Our', 'dfd');
			$address_var	= __('address', 'dfd');
			$phones_var		= __('phones', 'dfd');
			$email_var		= __('email', 'dfd');
			$filds = array (
				$address_var	=> $fild_address,
				$phones_var		=> $fild_phone,
				$email_var		=> $fild_email_html
			);

			if (isset($thumb_size) && !empty($thumb_size)) {
				$thumb_style .= 'width: '.esc_attr($thumb_size).'px; ';
				$thumb_style .= 'height: '.esc_attr($thumb_size).'px; ';
				$block_content_style .= 'margin-left: '.esc_attr($thumb_size).'px; ';
				$img_size = $thumb_size;
				$img_padding = $thumb_size * 15 / 100;
				$thumb_style .= 'padding: '.esc_attr($img_padding).'px; ';
			}else{
				$img_size = 80;
			}
			
			if (isset($address_img) && !empty($address_img)) {
				$address_img = wp_get_attachment_image_src( $address_img, 'full' );
				$avatar = dfd_aq_resize( $address_img[0], $img_size, $img_size, true, true, false );
				
				if(!$avatar)
					$avatar = $address_img[0];
				
				$icon_content_address = '<img src="' . esc_url( $avatar ) . '" alt=""/>';
			}else{
				$icon_content_address = '<i class="dfd-icon-navigation"></i>';
			}
			
			if (isset($phones_img) && !empty($phones_img)) {
				$phones_img = wp_get_attachment_image_src( $phones_img, 'full' );
				$avatar = dfd_aq_resize( $phones_img[0], $img_size, $img_size, true, true, false );
				
				if(!$avatar)
					$avatar = $phones_img[0];
				
				$icon_content_phones = '<img src="' . esc_url( $avatar ) . '" alt=""/>';
			}else{
				$icon_content_phones = '<i class="dfd-icon-call_incoming"></i>';
			}
			
			if (isset($email_img) && !empty($email_img)) {
				$email_img = wp_get_attachment_image_src( $email_img, 'full' );
				$avatar = dfd_aq_resize( $email_img[0], $img_size, $img_size, true, true, false );
				
				if(!$avatar)
					$avatar = $email_img[0];
				
				$icon_content_email = '<img src="' . esc_url( $avatar ) . '" alt=""/>';
			}else{
				$icon_content_email = '<i class="dfd-icon-network"></i>';
			}
			
			$icon = array (
				$address_var	=> $icon_content_address,
				$phones_var		=> $icon_content_phones,
				$email_var		=> $icon_content_email
			);
			
			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if (isset($icon_size) && !empty($icon_size)) {
				$thumb_style .= 'font-size: '.esc_attr($icon_size).'px; ';
				if(isset($main_style) && strcmp($main_style, 'style-1') === 0) {
					$margin_left_style1 = esc_attr($icon_size) * 2;
					$block_content_style .= 'margin-left: '.esc_attr($margin_left_style1).'px; ';
					$link_css .= '#'.esc_attr($uniqid).' .block-icon {width: '.esc_attr($margin_left_style1).'px; height: '.esc_attr($margin_left_style1).'px;}';
				}
			}
			if (isset($icon_background_color) && !empty($icon_background_color)) {
				$thumb_style .= 'background: '.esc_attr($icon_background_color).'; ';
			}
			if (isset($icon_color) && !empty($icon_color)) {
				$thumb_style .= 'color: '.esc_attr($icon_color).'; ';
			}
			if ((isset($icon_border_radius) && !empty($icon_border_radius)) || strcmp($icon_border_radius, '0') === 0) {
				$thumb_style .= 'border-radius: '.esc_attr($icon_border_radius).'px; ';
			}
			if(isset($main_style) && strcmp($main_style, 'style-2') === 0 || strcmp($main_style, 'style-3') === 0) {
				if ( $icon_border_style || $icon_border_width ) {
					if ($icon_border_style) {
						$thumb_style .= 'border-style: '.esc_attr($icon_border_style).'; ';
					}
					if ($icon_border_width) {
						$thumb_style .= 'border-width: '.esc_attr($icon_border_width).'px; ';
						$link_css .= '#'.esc_attr($uniqid).' .block-icon i {margin-left: -'.esc_attr($icon_border_width).'px;}';
					}
				}
			}
			if ( $icon_border_color ) {
				$thumb_style .= 'border-color: '.esc_attr($icon_border_color).'; ';
			}
			if($delimiter_align !== 'yes') {
				$delimiter_style .= 'margin-left: 20px;';
			}
			if(isset($delimiter_border_style) && strcmp($delimiter_border_style, 'none') !== 0) {
				if ( $delimiter_border_style || $delimiter_height || $delimiter_color ) {
					if ($delimiter_border_style) {
						$delimiter_style .= 'border-bottom-style: '.esc_attr($delimiter_border_style).'; ';
					}
					if ($delimiter_height) {
						$delimiter_style .= 'border-bottom-width: '.esc_attr($delimiter_height).'px; ';
					}
					if ( $delimiter_color ) {
						$delimiter_style .= 'border-bottom-color: '.esc_attr($delimiter_color).'; ';
					}
				}
			}
			if(isset($icon_border_style4) && strcmp($icon_border_style4, 'none') !== 0) {
				$thumb_style .= 'border-style: '.esc_attr($icon_border_style4).'; ';
				if ($icon_border_color4) {
					$thumb_style .= 'border-color: '.esc_attr($icon_border_color4).'; ';
				}
			}
			
			$delimiter_style .= '"';
			$block_content_style .= '"';
			$thumb_style .= '"';
			
			if(isset($delimiter_border_style) && strcmp($delimiter_border_style, 'none') !== 0) {
				$delim_html = '<span class="delimiter" '.$delimiter_style.'></span>';
			}
			if($triple_border_bottom4 === 'yes') {
				$general_class .= ' triple-border';
			}
			$general_class .= ' '.esc_attr($main_style).'';
			//Title Typography
			$title_options = _crum_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
			
			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-contact-block-horizontal clearfix '.$general_class.' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				
				foreach($filds as $key => $value){
					if(isset($value) && !empty($value)){
						if(key_exists($key, $icon)){
							$icon_html = $icon[$key];
						};
						$field_html .= '
						<div class="fild-content columns">
							<div class="block-icon" '.$thumb_style.'>'.$icon_html.'</div>
							<div class="block-content" '.$block_content_style.'>
								<'.$title_options['tag'].' class="widget-title fild-name ' . $title_options['class'] . '" ' . $title_options['style'] . '>' .$prefix.' '.$key. ':</'.$title_options['tag'].'>'
								.$delim_html.
								'<p class="'.$key.'">'.$value.'</p>
							</div>
						</div>';
					}
				}
				$output .= $field_html;

			$output .= '</div>';
			
			$output .= '<script type="text/javascript">
							(function($) {
								var $column = $("#'.esc_js($uniqid).' .fild-content"),
									columnClass = ["twelve","six","four"],
									columnsCount = $column.length;
								
								$column.addClass(columnClass[columnsCount - 1]);
						
								$("head").append("<style>'. esc_js($link_css) .'</style>");
									
							})(jQuery);
						</script>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Contact_Block_Horizontal')) {
	$Dfd_Contact_Block_Horizontal = new Dfd_Contact_Block_Horizontal;
}
