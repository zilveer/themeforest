<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if ( ! class_exists( 'Dfd_Testimonials' ) ) {
	/**
	 * Class Dfd_Testimonials
	 */
	class Dfd_Testimonials {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_testimonials_init' ) );
			add_shortcode( 'new_testimonials', array( $this, '_dfd_testimonials_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _dfd_testimonials_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/testimonials/';
				vc_map(
					array(
						'name'        => esc_html__( 'Testimonial', 'dfd' ),
						'base'        => 'new_testimonials',
						'class'       => 'vc_info_banner_icon',
						'icon'        => 'vc_icon_info_banner',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display client testimonial', 'dfd' ),
						'params'      => array(
							array(
								'heading'    => esc_html__( 'Choose Style', 'dfd' ),
								'type'       => 'radio_image_select',
								'param_name' => 'main_style',
								'simple_mode' => false,
								'options'    => array(
									'style-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'style-1.png'
									),
									'style-2'	=> array(
										'tooltip'	=> esc_attr__('Decorated','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
								),
							),
							array(
								'heading'     => esc_html__( 'Select Layout', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'main_layout',
								'simple_mode' => false,
								'options'     => array(
									'layout-1'	=> array(
										'tooltip'	=> esc_attr__('Middle line','dfd'),
										'src'		=> $module_images . 'layout-1.png'
									),
									'layout-2'	=> array(
										'tooltip'	=> esc_attr__('Top line','dfd'),
										'src'		=> $module_images . 'layout-2.png'
									),
									'layout-3'	=> array(
										'tooltip'	=> esc_attr__('Big quotes','dfd'),
										'src'		=> $module_images . 'layout-3.png'
									),
									'layout-4'	=> array(
										'tooltip'	=> esc_attr__('Bottom line','dfd'),
										'src'		=> $module_images . 'layout-4.png'
									),
									'layout-5'	=> array(
										'tooltip'	=> esc_attr__('Top info','dfd'),
										'src'		=> $module_images . 'layout-5.png'
									),
									'layout-6'	=> array(
										'tooltip'	=> esc_attr__('Top image','dfd'),
										'src'		=> $module_images . 'layout-6.png'
									),
									'layout-7'	=> array(
										'tooltip'	=> esc_attr__('Bottom quotes','dfd'),
										'src'		=> $module_images . 'layout-7.png'
									),
									'layout-8'	=> array(
										'tooltip'	=> esc_attr__('Top quotes','dfd'),
										'src'		=> $module_images . 'layout-8.png'
									),
									'layout-9'	=> array(
										'tooltip'	=> esc_attr__('Left image','dfd'),
										'src'		=> $module_images . 'layout-9.png'
									),
									'layout-10'	=> array(
										'tooltip'	=> esc_attr__('Right image','dfd'),
										'src'		=> $module_images . 'layout-10.png'
									),
								),
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Information Alignment', 'dfd' ),
								'param_name' => 'align',
								'value'      => array(
									esc_html__( 'Center', 'dfd' ) => 'align-center',
									esc_html__( 'Left', 'dfd' )   => 'align-left',
									esc_html__( 'Right', 'dfd' )  => 'align-right',
								),
								'dependency' => array(
									'element' => 'main_layout',
									'value_not_equal_to' => array( 'layout-9', 'layout-10' ),
								),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'attach_image',
								'heading'     => esc_attr__( 'Testimonial Author Image', 'dfd' ),
								'param_name'  => 'image',
								'description' => esc_attr__( 'Upload the testimonial author photo', 'dfd' ),
								'group'       => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'dfd' ),
								'param_name'  => 'author',
								'admin_label' => true,
								'group'       => esc_attr__( 'Content', 'dfd' ),
							),

							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Subtitle', 'dfd' ),
								'param_name'  => 'subtitle',
								'group'       => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textarea',
								'heading'     => esc_html__( 'Testimonial', 'dfd' ),
								'param_name'  => 'description',
								'group'       => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Testimonial', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'content_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'content_font_options',
								'settings'   => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),

							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'        => 'crumina_font_container',
								'heading'     => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag'=>'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
									),
								),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
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
								'text'             => esc_html__( 'Subtitle', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'subtitle_t_heading',
								'group'            => esc_html__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'        => 'crumina_font_container',
								'heading'     => '',
								'param_name' => 'subtitle_font_options',
								'settings'   => array(
									'fields' => array(
										'tag'=>'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
									),
								),
								'group'       => esc_html__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Author thumbnail', 'dfd' ),
								'param_name'       => 'thumb_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Border radius', 'dfd' ),
								'param_name' => 'thumb_radius',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Border width', 'dfd' ),
								'param_name' => 'thumb_border_width',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Border color', 'dfd' ),
								'param_name' => 'thumb_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Image size', 'dfd' ),
								'param_name' => 'thumb_size',
								'min'        => 80,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Delimiter style', 'dfd' ),
								'param_name'       => 'del_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Width', 'dfd' ),
								'param_name' => 'line_width',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Height', 'dfd' ),
								'param_name' => 'line_border',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Color', 'dfd' ),
								'param_name' => 'line_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'checkbox',
								'heading'          => esc_html__( 'Hide element', 'dfd' ),
								'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
								'param_name'       => 'line_hide',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content background', 'dfd' ),
								'param_name'       => 'bg_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'main_style',
									'value_not_equal_to' => 'style-1',
								),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Color', 'dfd' ),
								'param_name' => 'bg_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'main_style',
									'value_not_equal_to' => 'style-1',
								),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Border radius', 'dfd' ),
								'param_name' => 'bg_radius',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'main_style',
									'value_not_equal_to' => 'style-1',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Quote symbol', 'dfd' ),
								'param_name'       => 'quote_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Color', 'dfd' ),
								'param_name' => 'quote_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Size', 'dfd' ),
								'param_name' => 'quote_size',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Margin from text block', 'dfd' ),
								'param_name' => 'quote_margin',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'main_layout',
									'value'   => array('layout-1','layout-2','layout-4')
								),
							),
							array(
								'type'             => 'checkbox',
								'heading'          => esc_html__( 'Hide element', 'dfd' ),
								'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
								'param_name'       => 'quote_hide',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
						),
					)
				);
			}
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param $atts
		 *
		 * @return string
		 */
		function _dfd_testimonials_shortcode( $atts ) {
			$main_style = $main_layout = $thumb_color = $quote_hide = $line_width = $line_hide = $line_border = $line_color = $bg_color = $bg_radius = $quote_color = $align = $image = $author = $subtitle = $description = $content_font_options = $use_google_fonts = $custom_fonts = $title_font_options = $subtitle_font_options = $thumb_radius = $thumb_size = $thumb_border_width = '';
			$avatar_html = $avatar_style = $author_style = $subtitle_html = $subtitle_style = $content_style = $delimiter_html = $delimiter_style = $content_bg = $bg_style = $quote_style = $quote_size = $quote_margin =  $icon_html = $content_html = '';
			$output = $el_class = $module_animation = '';

			//new_testimonials
			
			extract( shortcode_atts( array(
				'main_style'            => 'style-1',
				'main_layout'           => 'layout-1',
				'align'                 => 'align-center',
				'image'                 => '',
				'author'                => __( 'Author name', 'dfd' ),
				'subtitle'              => '',
				'description'           => __( 'Please add some review text in admin panel', 'dfd' ),
				'content_font_options'  => '',
				'use_google_fonts'      => '',
				'custom_fonts'          => '',
				'title_font_options'    => '',
				'subtitle_font_options' => '',
				'thumb_radius'          => '',
				'thumb_size'            => '80',
				'thumb_color'           => '',
				'thumb_border_width'    => '',
				'line_hide'             => '',
				'line_width'            => '',
				'line_border'           => '',
				'line_color'            => '',
				'bg_color'              => '',
				'bg_radius'             => '',
				'quote_hide'            => '',
				'quote_size'            => '',
				'quote_margin'          => '',
				'quote_color'           => '',
				'module_animation'      => '',
				'el_class'              => '',
			), $atts ) );

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			// Create parts of module according to parameters.
			// Avatar HTML.
			if ( ! empty( $image ) ) {
				$image = wp_get_attachment_image_src( $image, 'full' );
				$avatar = dfd_aq_resize( $image[0], $thumb_size, $thumb_size, true, true, true );

				if ( ( ! empty( $thumb_radius ) ) || ( ! empty( $thumb_border_width ) ) ) {
					$avatar_style .= 'style="';
					if ( ! empty( $thumb_radius ) ) {
						$avatar_style .= 'border-radius:' . esc_html( $thumb_radius ) . 'px; ';
					}
					if ( ! empty( $thumb_border_width ) ) {
						$avatar_style .= 'border:' . esc_html( $thumb_border_width ) . 'px solid ';
					}
					if ( ! empty( $thumb_color ) ) {
						$avatar_style .= esc_html( $thumb_color ) . '; ';
					}
					$avatar_style .= '"';
				}

				$avatar_html = '<div class="image-wrap">';
				$avatar_html .= '<img ' .  $avatar_style . ' src="' . esc_url( $avatar ) . '" alt="' . esc_html__( 'Testimonial', 'dfd' ) . ' ' . esc_html__( 'by', 'dfd' ) . ' ' . esc_html( $author ) . '"/>';
				$avatar_html .= '</div>';
			}

			// Author name HTML.
			$author_font_options = _crum_parse_text_shortcode_params( $title_font_options,'feature-title', $use_google_fonts, $custom_fonts );
			$author_style .= $author_font_options['style'];

			$author_html = '<'.$author_font_options['tag'].' class="'.$author_font_options['class'].' testimonial-title" ' . $author_style . '>' . esc_html( $author ) . '</'.$author_font_options['tag'].'>';

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_font_options = _crum_parse_text_shortcode_params( $subtitle_font_options );
				$subtitle_style .= $subtitle_font_options['style'];

				$subtitle_html = '<'.$subtitle_font_options['tag'].' class="subtitle testimonial-subtitle" ' . $subtitle_style . '>' . esc_html( $subtitle ) . '</'.$subtitle_font_options['tag'].'>';
			}
			// Content HTML.
			$content_font_options = _crum_parse_text_shortcode_params( $content_font_options, '' );
			$content_style .= $content_font_options['style'];

			if ( ( 'style-1' !== $main_style && ! empty( $bg_radius ) ) || ( 'style-1' !== $main_style && ! empty( $bg_color ) ) || ( '80' !== $thumb_size ) ) {
				$content_bg .= 'style="';
				if ( ! empty( $bg_radius ) ) {
					$content_bg .= 'border-radius:' . $bg_radius . 'px;';
				}
				if ( ! empty( $bg_color ) ) {
					$content_bg .= 'background-color:' . $bg_color;
				}
				if('style-2' === $main_style){
					if ( '80' !== $thumb_size ) {
						if('layout-1' === $main_layout) {
							$margin = 21;
						} else {
							$margin = 0;
						}
						if ( '80' !== $thumb_size ){
							if ( 'layout-1' === $main_layout || 'layout-2' === $main_layout || 'layout-3' === $main_layout || 'layout-4' === $main_layout ) {
								$bottom = ( intval( $thumb_size / 2 ) + intval($margin) );
								if (!empty($thumb_border_width)){
									$bottom = intval( $thumb_border_width ) + intval( $bottom );
								}
								$content_bg .= 'bottom:-' . $bottom . 'px;';
							} elseif ('layout-5' === $main_layout || 'layout-6' === $main_layout || 'layout-7' === $main_layout|| 'layout-8' === $main_layout){
								$top = ( intval( $thumb_size / 2 ) + intval($margin) );
								if (!empty($thumb_border_width)){
									$top = intval( $thumb_border_width ) + intval( $top );
								}
								$content_bg .= 'top:' . $top . 'px;';
							}

						}
					}
				}

				$content_bg .= '"';
			}

			if( 'style-1' !== $main_style){
				$content_html .= '<div class="content-wrap-bg" ' . $content_bg . '></div>';
			}
			$content_html .= '<div class="dfd-testimonial-content testimonial-content" ' . $content_style . '>';
			$content_html .= esc_html( $description );
			$content_html .= '</div>';

			if ( $line_width || $line_border || $line_color ) {
				$delimiter_style .= 'style="';
				if ( $line_width ) {
					$delimiter_style .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$delimiter_style .= 'height:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$delimiter_style .= 'background:' . $line_color;
				}
				$delimiter_style .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="testimonial-delimiter" ' . $delimiter_style . '></div></div>';
			}

			if ( $quote_color || $quote_size || $quote_margin ) {
				$quote_style .= 'style="';
				if ( ! empty( $quote_color ) ) {
					$quote_style .= 'color:' . $quote_color . '; ';
				}
				if ( ! empty( $quote_size ) ) {
					$quote_style .= 'font-size:' . $quote_size . 'px; ';
				}
				if ( ! empty( $quote_margin ) ) {
					$quote_style .= 'margin-bottom:' . $quote_margin . 'px; display: inline-block;';
				}

				$quote_style .= '"';
			}
			if ( 'yes' !== $quote_hide ) {
				$icon_html .= '<div class="icon-wrap">';
				$icon_html .= '<i class="navicon-quote-right" ' . $quote_style . '></i>';
				$icon_html .= '</div>';
			}
			if ( 'layout-9' === $main_layout || 'layout-10' === $main_layout ) {
				$align = '';
			}

			/**************************
			 * Module Generation.
			 *************************/
			$output .= '<div class="dfd-testimonial-item ' . $main_style . ' ' . $main_layout . ' ' . $align . ' ' . $el_class . '" ' . $animation_data . '>';

			switch ( $main_layout ) {
				case 'layout-1':

					$output .= $icon_html;
					$output .= '<div class="pos-rel">';
					$output .= $content_html;
					$output .= '</div>';
					$output .= '<div class="centered-line">';
					$output .= $delimiter_html;
					$output .= $avatar_html;
					$output .= '</div>';
					$output .= $author_html;
					$output .= $subtitle_html;

					break;
				case 'layout-2':
				case 'layout-3':

					$output .= $icon_html;
					$output .= '<div class="pos-rel">';
					$output .= $content_html;
					if ('style-2' === $main_style){
						$output .= $delimiter_html;
						$output .= '</div>';
					} else{
						$output .= '</div>';
						$output .= $delimiter_html;
					}
					$output .= $avatar_html;
					$output .= $author_html;
					$output .= $subtitle_html;

					break;
				case 'layout-4':

					$output .= $icon_html;
					$output .= '<div class="pos-rel">';
					$output .= $content_html;
					$output .= '</div>';
					$output .= $avatar_html;
					$output .= $author_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;

					break;
				case 'layout-5':
					if ('style-2' === $main_style){
						$output .= '<div class="pos-rel">';
						$output .= $avatar_html;
						$output .= $author_html;
						$output .= $subtitle_html;
						$output .= $content_html;
					} else {
						$output .= $avatar_html;
						$output .= $author_html;
						$output .= $subtitle_html;
						$output .= '<div class="pos-rel">';
						$output .= $content_html;
					}

					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= $icon_html;

					break;
				case 'layout-6':
					if ('style-2' === $main_style){
						$output .= '<div class="pos-rel">';
						$output .= $avatar_html;
						$output .= $content_html;
					} else {
						$output .= $avatar_html;
						$output .= '<div class="pos-rel">';
						$output .= $content_html;
					}

					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= $author_html;
					$output .= $subtitle_html;
					$output .= $icon_html;

					break;
				case 'layout-7':
					if ('style-2' === $main_style){
						$output .= '<div class="pos-rel">';
						$output .= $avatar_html;
						$output .= $delimiter_html;
						$output .= $content_html;
					} else {
						$output .= $avatar_html;
						$output .= $delimiter_html;
						$output .= '<div class="pos-rel">';
						$output .= $content_html;
					}

					$output .= '</div>';
					$output .= $author_html;
					$output .= $subtitle_html;
					$output .= $icon_html;

					break;
				case 'layout-8':
					if ('style-2' === $main_style){
						$output .= '<div class="pos-rel">';
						$output .= $avatar_html;
						$output .= $icon_html;
						$output .= $content_html;
					} else {
						$output .= $avatar_html;
						$output .= $icon_html;
						$output .= '<div class="pos-rel">';
						$output .= $content_html;
					}
					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= $author_html;
					$output .= $subtitle_html;

					break;
				case 'layout-9':
				case 'layout-10':

					$output .= $avatar_html;
					$output .= '<div class="content-wrap">';
					$output .= '<div class="pos-rel">';
					$output .= $content_html;
					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= '<div class="title-wrap">';
					$output .= $icon_html;
					$output .= $author_html;
					$output .= '<br/>'.$subtitle_html;
					$output .= '</div>';
					//$output .= '</div>';
					$output .= '</div>';

					break;
			}

			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Testimonials' ) ) {
	$Dfd_Testimonials = new Dfd_Testimonials;
}
