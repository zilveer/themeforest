<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Facts Line
*/
if ( ! class_exists( 'Dfd_Facts' ) ) {
	/**
	 * Class Dfd_Facts
	 */
	class Dfd_Facts {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_facts_init' ) );
			add_shortcode( 'facts', array( $this, '_dfd_facts_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _dfd_facts_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/facts/';
				$icon_style = _crum_vc_icon_settings();
					foreach ($icon_style as  $key => $icon_param) {
						if($icon_param["param_name"] == "opacity"){
							$icon_style[$key]["dependency"]=array(
									'element' => 'icon_type',
									'value_not_equal_to' => array( 'custom' ),
							);
						}
					}
				vc_map(
					array(
						'name'        => esc_html__( 'New Facts', 'dfd' ),
						'base'        => 'facts',
						'class'       => 'vc_info_banner_icon',
						'icon'        => 'vc_icon_info_banner',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display number facts with icon', 'dfd' ),
						'params' => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Select Layout', 'dfd' ),
									'description' => '',
									'type'        => 'radio_image_select',
									'param_name'  => 'main_layout',
									'simple_mode' => false,
									'options'     => array(
										'layout-1'	=> array(
											'tooltip'	=> esc_attr__('Standard','dfd'),
											'src'		=> $module_images . 'layout-1.png'
										),
										'layout-2'	=> array(
											'tooltip'	=> esc_attr__('Top icon','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-3'	=> array(
											'tooltip'	=> esc_attr__('Bottom icon','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-4'	=> array(
											'tooltip'	=> esc_attr__('Left counter','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
										'layout-5'	=> array(
											'tooltip'	=> esc_attr__('Right counter','dfd'),
											'src'		=> $module_images . 'layout-5.png'
										),
										'layout-6'	=> array(
											'tooltip'	=> esc_attr__('Left icon','dfd'),
											'src'		=> $module_images . 'layout-6.png'
										),
										'layout-7'	=> array(
											'tooltip'	=> esc_attr__('Right icon','dfd'),
											'src'		=> $module_images . 'layout-7.png'
										),
									),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Number', 'dfd' ),
									'param_name'       => 'number',
									'edit_field_class' => 'vc_column vc_col-sm-3',
									'admin_label'      => true,
								),
								array(
									'type'             => 'textfield',
									'heading'          => esc_html__( 'Title', 'dfd' ),
									'param_name'       => 'title',
									'edit_field_class' => 'vc_column vc_col-sm-9',
									'admin_label'      => true,
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__( 'Select numbers transition animation', 'dfd' ),
									'param_name' => 'transition',
									'value'      => array(
										esc_html__( 'Count numbers', 'dfd' )     => 'counter',
										esc_html__( 'Odometr animation', 'dfd' ) => 'odometer',
										esc_html__( 'Without animation', 'dfd' ) => 'disable-animation',
									),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
									'param_name'  => 'el_class',
									'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Animation', 'dfd' ),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								
							),
							$icon_style,
							array(
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'content_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'font_size',
											'line_height',
											'color',
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'				=> 'number',
									'class'				=> '',
									'heading'			=> esc_html__('Letter spacing', 'dfd'),
									'param_name'		=> 'number_letter_spacing',
									'value'				=> '',
									'group'				=> esc_html__('Typography', 'dfd'),
									'edit_field_class'	=> 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'title_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
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
									'text'             => esc_html__( 'Delimiter style', 'dfd' ),
									'param_name'       => 'del_t_heading',
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column no-top-margin vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
							),

							_crum_vc_delim_settings()

						),
					)
				);
			}
		}



		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 *
		 * @return string
		 */
		function _dfd_facts_shortcode( $atts ) {
			$main_layout = $line_position = $number = $title = $subtitle = $transition = $font_options = $use_google_fonts = $custom_fonts = $title_font_options = '';
			$subtitle_font_options = $line_width = $line_hide = $line_border = $line_color = $letter_spacing = '';
			$title_block = $delimiter_html = $delimiter_style = $title_html = $subtitle_html = $content_style = $content_typo = $icon_style = $icon_html = $content_html = '';
			$animation = $icon = $icon_image_id = $icon_size = '';
			$output = $el_class = $module_animation = $data_max = $facts_number_html = $disable_animation_class = $number_letter_spacing = $link_css = $uniqid = '';

			$atts = vc_map_get_attributes( 'facts', $atts );
			extract( $atts );


			wp_enqueue_script( 'odometer-js', get_template_directory_uri() . '/assets/js/odometer.min.js', array( 'jquery' ), false, true );

			$uniqid = uniqid('dfd-facts-') .'-'.rand(1,9999);

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			// Create parts of module according to parameters.
			/*********************
			 *   ICON HTML.
			 ********************/
			if ( ! empty( $icon ) || ! empty( $icon_image_id ) ) {
				$icon_html = '<div class="module-icon">' . crumina_icon_render( $atts ) . '</div>';
			}


			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				// Title name HTML.
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts);
				$title_html = '<'.$title_options['tag'].' class="facts-title ' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'subtitle');
				$subtitle_html = '<'.$subtitle_options['tag'].' class="facts-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color ) {
				$delimiter_style .= 'style="';
				if ( $line_width ) {
					$delimiter_style .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$delimiter_style .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$delimiter_style .= 'border-color:' . $line_color;
				}
				$delimiter_style .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter" ' . $delimiter_style . '></div></div>';
			}

			/**************************
			 * Title Block + Delimiter.
			 *************************/

			switch ( $line_position ) {
				case 'top':
					$title_block .= $delimiter_html;
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					break;

				case 'medium':
					$title_block .= $title_html;
					$title_block .= $delimiter_html;
					$title_block .= $subtitle_html;
					break;

				case 'bottom':
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					$title_block .= $delimiter_html;
					break;

				default:
					$title_block .= $delimiter_html;
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					break;
			}

			/**************************
			 * Other Block options.
			 *************************/

			if('counter' === $transition){
				$animation = 'count';
			}

			$font_options = _crum_parse_text_shortcode_params($font_options,'');
			
			if(isset($number_letter_spacing) && !empty($number_letter_spacing)) {
				$letter_spacing = esc_attr($number_letter_spacing) / 2;
				$link_css .= '#'.esc_js($uniqid).'.dfd-facts-counter .odometer.odometer-auto-theme .odometer-digit {margin: 0 '.esc_js($letter_spacing).'px;}';
			}
			
			if (isset($transition) && strcmp($transition, 'disable-animation') === 0) {
				$disable_animation_class = 'disable-animation';
			}
			$data_max = 'data-max="' . esc_attr( $number ) . '"';
			$facts_number_html .= '<div class="facts-number call-on-waypoint '.$disable_animation_class.'" data-animation="' . esc_attr( $animation ) . '" '.$data_max.' ' . $font_options['style'] . '>';
			if (isset($transition) && strcmp($transition, 'disable-animation') === 0) {
				$facts_number_html .= esc_attr( $number );
			}else{
				$facts_number_html .= '0';
			}
			$facts_number_html .= '</div>';
			
			if('layout-1' === $main_layout) {
				if ( intval( $icon_size ) !== '80' && ! empty( $icon_size ) ){
					$wrap_style = 'style="padding-top:' . ( intval( $icon_size ) - 60 ) . 'px;"';
				} else {
					$wrap_style = '';
				}
				$content_html .= '<div class="wrap" ' . $wrap_style . '><div class="stat-count">' . $icon_html . ' '.$facts_number_html.' </div></div>';
			} else {
				$content_html .= '<div class="stat-count"> '.$facts_number_html.' </div>';
			}

			// Module output according to layout selection.
			$output .= '<div id="'.$uniqid.'" class="dfd-facts-counter ' . $content_style . ' ' . $main_layout . ' ' . $el_class . '" ' . $animation_data . '>';

			switch ( $main_layout ) {
				case 'layout-1':
					$output .= $content_html;
					$output .= $title_block;
					break;

				case 'layout-2':
					$output .= $icon_html;
					$output .= $content_html;
					$output .= $title_block;
					break;

				case 'layout-3':
					$output .= $content_html;
					if ( ! empty( $line_position ) ) {
						$output .= $title_block;
					} else {
						$output .= $title_html;
						$output .= $subtitle_html;
						$output .= $delimiter_html;
					}

					$output .= $icon_html;
					break;

				case 'layout-4':

					$output .= $content_html;
					$output .= $icon_html;
					$output .= $title_block;

					break;

				case 'layout-5':

					$output .= $icon_html;
					$output .= $content_html;
					$output .= $title_block;

					break;

				case 'layout-6':
				case 'layout-7':

					$output .= $icon_html;
					$output .= '<div class="content-wrap">';
					$output .= $content_html;
					$output .= $title_block;
					$output .= '</div>';

					break;


				default:
					$output .= $content_html;
					$output .= $title_block;
					break;
			}

			$output .= '</div>';
			
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
if ( class_exists( 'Dfd_Facts' ) ) {
	$Dfd_Facts = new Dfd_Facts;
}
