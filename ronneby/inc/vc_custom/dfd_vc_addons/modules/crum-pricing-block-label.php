<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Pricing Block
*/
if ( ! class_exists( 'Dfd_Pricing_Block_Label' ) ) {
	/**
	 * Class Dfd_Pricing_Block
	 */
	class Dfd_Pricing_Block_Label {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_pricing_label_init' ) );
			add_shortcode( 'pricing_Label', array( &$this, 'dfd_pricing_label_form' ) );
		}

		/**
		 * Block options.
		 */
		function dfd_pricing_label_init() {

			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => esc_html__( 'Pricing labels', 'dfd' ),
						'base'        => 'pricing_Label',
						'class'       => 'pricing_Label',
						'icon'        => 'pricing_Label',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Labels for pricing blocks in current row', 'dfd' ),
						'params'      => array(
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => esc_html__( 'Content', 'dfd' ).' '.esc_html__( 'Align', 'dfd' ),
								'param_name' => 'align',
								'value'      => array(
									esc_html__( 'Right', 'dfd' )  => 'right',
									esc_html__( 'Center', 'dfd' ) => 'center',
									esc_html__( 'Left', 'dfd' )   => 'left',
								)
							),
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => esc_html__( 'Animation', 'dfd' ),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Extra class name', 'dfd' ),
								'param_name'  => 'el_class',
								'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dfd' ),
							),
//							array(
//								'type' => 'tab_id',
//								'param_name' => 'el_id',
//								'settings' => array(
//									'auto_generate' => true,
//								),
//								'hidden' =>true,
//							),
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
										'type'        => 'textfield',
										'heading'     => __( 'Label', 'dfd' ),
										'param_name'  => 'label',
										'admin_label' => true,
									),
								),
							),
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
		function dfd_pricing_label_form( $atts ) {

			//Typography
			$output = $el_class = $module_animation = $align = $values = $el_id ='';
			//Typography
			$font_options = $use_google_fonts = $custom_fonts = '';

			$atts = vc_map_get_attributes( 'pricing_Label', $atts );
			extract( $atts );

			/**************************
			 * Appear Animation
			 *************************/
			
			$el_id = uniqid('dfd-pricing-block-') .'-'.rand(1,9999);

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			/**************************
			 * Module.
			 *************************/
			$output .= '<div class="dfd-pricing-labels ' . $el_class . '" id="' . $el_id . '" ' . $animation_data . '>';

			/**************************
			 * Module-Description.
			 *************************/

			$output .= '<div class="block-desc">';

			/**************************
			 * Module-options-values.
			 *************************/
			if ( function_exists( 'vc_param_group_parse_atts' ) ) {
				$values = (array) vc_param_group_parse_atts( $values );
			}

			if ( is_array( $values ) ) {
				$description_option = _crum_parse_text_shortcode_params( $font_options, 'price-feature', $use_google_fonts, $custom_fonts );

				$output .= '<ul class="options-list text-align-'.$align.'">';

				foreach ( $values as $single_feature ) {

					$output .= '<li class="option">';
						if ( ! empty( $single_feature['label'] ) ) {
							$output .= '<' . $description_option['tag'] . ' class="pricing-feature-description" ' . $description_option['style'] . '>' . $single_feature['label'] . '</' . $description_option['tag'] . '>';
						}
					$output .= '</li>';
				}

				$output .= '</ul>';
			}

			$output .= '</div>';
			//Description end

			$output .= '</div>';
			//module end

			ob_start();
			?>

			<script type="text/javascript">

				jQuery(document).on('ready', function() {

					jQuery(window).on('resize', function() {
						var $current_desc = jQuery('#<?php echo $el_id; ?>').find('.block-desc');
						if (jQuery(window).width() > 799) {
							var $nearest_price_block = jQuery('#<?php echo $el_id; ?>').parents('.row').find('.dfd-pricing-block').first();
							var $sibling_desc = $nearest_price_block.find('.block-desc').position();
							var $padding = $sibling_desc.top + 1 + $nearest_price_block.find('.desc-text').outerHeight();
							$current_desc.css('paddingTop', $padding);
						} else {
							$current_desc.css('paddingTop', 0);
						}
					}).trigger('resize'); // Trigger resize handlers.

				});//ready


			</script>

			<?php
			$output .= ob_get_clean();
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Pricing_Block_Label' ) ) {
	$Dfd_Pricing_Block = new Dfd_Pricing_Block_Label;
}