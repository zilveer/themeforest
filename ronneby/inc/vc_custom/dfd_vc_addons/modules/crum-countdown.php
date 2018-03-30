<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Countdown Line
*/
if ( ! class_exists( 'Dfd_Countdown' ) ) {
	/**
	 * Class Dfd_Countdown
	 */
	class Dfd_Countdown {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_countdown_init' ) );
			add_shortcode( 'countdown', array( $this, '_dfd_countdown_shortcode' ) );
		}
		/**
		 * Block options.
		 */
		function _dfd_countdown_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/countdown/';
				vc_map(
					array(
						'name'             => esc_html__( 'Countdown', 'dfd' ),
						'base'             => 'countdown',
						'class'            => 'vc_info_banner_icon',
						'icon'             => 'vc_icon_info_banner',
						'category'         => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description'      => esc_html__( 'Display animated count down block', 'dfd' ),
						'params'           => array(
							array(
								'heading'     => esc_html__( 'Select Layout', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'main_layout',
								'simple_mode' => false,
								'options'     => array(
									'layout-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'layout-1.png'
									),
									'layout-2'	=> array(
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'layout-2.png'
									),
									'layout-3'	=> array(
										'tooltip'	=> esc_attr__('Underline','dfd'),
										'src'		=> $module_images . 'layout-3.png'
									),
									'layout-4'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'layout-4.png'
									),
								),
							),
							array(
								'type' => 'datetimepicker',
								'heading' => esc_html__('Target Time For Countdown', 'dfd'),
								'param_name' => 'datetime',
								'value' => '',
								'admin_label' => true,
								'description' => esc_html__('Date and time format (yyyy/mm/dd hh:mm:ss).', 'dfd'),
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__('Select Time Units To Display In Countdown Timer', 'dfd'),
								'param_name' => 'countdown_opts',
								'value' => array(
									esc_html__('Years','dfd') => 'syear',
									esc_html__('Months','dfd') => 'smonth',
									esc_html__('Weeks','dfd') => 'sweek',
									esc_html__('Days','dfd') => 'sday',
									esc_html__('Hours','dfd') => 'shr',
									esc_html__('Minutes','dfd') => 'smin',
									esc_html__('Seconds','dfd') => 'ssec',
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
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Element style', 'dfd' ),
								'param_name'       => 'b_s_h',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column  no-top-margin vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Border radius', 'dfd' ),
								'param_name' => 'radius',
								'min'        => 0,
								'suffix'     => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Border Color', 'dfd' ),
								'param_name' => 'line_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array(
									'element' => 'main_layout',
									'value'   => array('layout-2','layout-3','layout-4')
								),
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Background', 'dfd' ),
								'param_name' => 'bg_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-4')),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Delimiter Color', 'dfd' ),
								'param_name' => 'delim_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'ult_switch',
								'heading'          => esc_html__( 'Shadow', 'dfd' ),
								'param_name'       => 'shadow',
								'value'      => 'off',
								'options'    => array(
									'show' => array(
										'label' => __( 'Show shadow on elements?', 'dfd' ),
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Delimiter', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
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
										'font_size',
										'color'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Number', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'nfh',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'number_font_options',
								'settings'   => array(
									'fields' => array(
										'font_size',
										'color'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Time Units', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'tut',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Font size', 'dfd'),
								'param_name'		=> 'time_units_font_size',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'class'				=> '',
								'heading'			=> esc_html__('Text color', 'dfd'),
								'param_name'		=> 'time_units_font_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Typography', 'dfd'),
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
		 *
		 * @return string
		 */
		function _dfd_countdown_shortcode( $atts ) {
			$main_layout = $datetime = $countdown_opts = $ult_tz = $font_options = $number_font_options = $radius = $bg_color = $line_color = $shadow =  '';
			$dots_style = $number_style = $line_style = $wrap_style = $count_frmt = $delim_color = $delim_style = $period_style = '';
			$output = $el_class = $module_animation = $time_units_font_size = $time_units_font_color = '';

			extract( shortcode_atts( array(
				'main_layout'         => 'layout-1',
				'datetime'             => '',
				'countdown_opts'    => '',
				'font_options'        => '',
				'number_font_options' => '',
				'time_units_font_size' => '',
				'time_units_font_color' => '',
				'bg_color'            => '',
				'delim_color'            => '',
				'radius'              => '',
				'line_color'          => '',
				'shadow'              => 'off',
				'module_animation'    => '',
				'el_class'            => '',
			), $atts ) );

			// Create parts of module according to parameters.

			wp_enqueue_script('countdown-js',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-js/jquery.countdown.min.js',array('jquery'));

			$font_options = _crum_parse_text_shortcode_params($font_options);
			$dots_style .= $font_options['style'];

			$number_font_options = _crum_parse_text_shortcode_params($number_font_options);
			$number_style .= $number_font_options['style'];
			
			if ( $bg_color || $line_color || $radius ) {
				$wrap_style .= 'style="';
				if ( $bg_color ) {
					$wrap_style .= 'background:' . $bg_color . '; ';
				}if ( $line_color ) {
					$wrap_style .= 'border-color:' . $line_color . '; ';
				}if ( $radius ) {
					$wrap_style .= 'border-radius:' . $radius . 'px; ';
				}

				$wrap_style .= '"';
			}

			if ('show'  ===  $shadow ) {
				$shadow = 'shadow';
			}
			
			if ( ! empty( $delim_color ) || !empty($time_units_font_size) || !empty($time_units_font_color)) {
				$period_style .= 'style="';
				if(isset($delim_color) && !empty($delim_color)){
					$period_style .= 'border-color:' . $delim_color . ';';
				}
				if(isset($time_units_font_size) && !empty($time_units_font_size)){
					$period_style .= 'font-size: '. esc_attr($time_units_font_size) .'px; ';
				}
				if(isset($time_units_font_color) && !empty($time_units_font_color)){
					$period_style .= 'color: '. esc_attr($time_units_font_color) .'; ';
				}
				$period_style .= '"';
			}


			$countdown_opt = explode( ',', $countdown_opts );
			$dot_html = '<span class="dot" ' . $dots_style . '><table class="table_vert_align_dot"><tr><td class="table_cell_align_dot" ' . $dots_style . '>:</td></tr></table></span>';
			if ( is_array( $countdown_opt ) ) {
				foreach ( $countdown_opt as $opt ) {
					if ( 'syear' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-Y</span><span class="period" '.$period_style.'>' . esc_html__( 'Years', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'smonth' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-m</span><span class="period" '.$period_style.'>' . esc_html__( 'Months', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'sweek' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-w</span><span class="period" '.$period_style.'>' . esc_html__( 'Weeks', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'sday' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-D</span><span class="period" '.$period_style.'>' . esc_html__( 'Days', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'shr' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-H</span><span class="period" '.$period_style.'>' . esc_html__( 'Hours', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'smin' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-M</span><span class="period" '.$period_style.'>' . esc_html__( 'Minutes', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
					if ( 'ssec' === $opt ) {
						$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number" ' . $number_style . '>%-S</span><span class="period" '.$period_style.'>' . esc_html__( 'Seconds', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
					}
				}
			}

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$uniq_id = uniqid('countdown') .'-'.rand(1,9999);

			// Module output according to layout selection.
			$output .= '<div class="dfd-countdown ' . $main_layout . ' '.esc_attr($el_class).'" ' . $animation_data . '>';

			if($datetime!=''){
				$output .= '<div id="' . $uniq_id . '"></div>';
			}
			$output .='</div>';

			ob_start(); ?>
			<script>
				jQuery(document).ready(function () {
					jQuery('#<?php echo esc_js($uniq_id); ?>').countdown('<?php echo esc_js($datetime);?>').on('update.countdown', function (event) {
						jQuery(this).html(event.strftime('<?php echo $count_frmt; ?>'));
					}).on('finish.countdown', function () {
						jQuery(this).html('<h3><?php echo esc_html__('Event already pass','dfd'); ?></h3>');
					});
//					setTimeout(function(){
//					jQuery('#<?php echo esc_js($uniq_id); ?>').countdown('pause');
//						
//					},200);
				});
			</script>
			<?php
			$output .=ob_get_clean();

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Countdown' ) ) {
	$Dfd_Countdown = new Dfd_Countdown;
}
