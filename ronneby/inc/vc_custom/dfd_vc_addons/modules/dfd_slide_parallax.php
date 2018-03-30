<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Slide_parallax')) {
	class Dfd_Slide_parallax {
		
		function __construct() {
			add_shortcode( 'dfd_slide_parallax', array( &$this, 'dfd_slide_parallax_form' ) );
			add_action( 'init', array( &$this, 'dfd_slide_parallax_init' ) );
		}
		
		function dfd_slide_parallax_init() {
			if ( function_exists( 'vc_map' ) ) {

				vc_map( array(
					'name' => esc_html__('Slide parallax module', 'dfd'),
					'base' => 'dfd_slide_parallax',
					'class' => 'vc_google_map',
					'controls' => 'full',
					'show_settings_on_create' => true,
					'icon' => 'vc_google_map',
					'description' => esc_html__('Displays two images one under another with draggable handle', 'dfd'),
					'category' => esc_html__('Ronneby 2.0', 'dfd'),
					'params'      => array(
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'General settings', 'dfd' ),
							'param_name'       => 'dir_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'radio_image_select',
							'heading'    => esc_html__( 'Direction', 'dfd' ),
							'param_name' => 'direction',
							'admin_label' => true,
							'simple_mode'		=> false,
							'options'      => array(
								'horizontal' => array(
										'tooltip' => esc_attr__('Horizontal','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/slide_parallax/horizontal.png'
									),
								'vertical' => array(
										'tooltip' => esc_attr__('Vertical','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/slide_parallax/vertical.png'
									),
							),
						),
//						array(
//							'type' => 'dropdown',
//							'class' => '',
//							'heading' => esc_html__('Direction','dfd'),
//							'param_name' => 'direction',
//							'value' => array(
//								esc_attr__('Horizontal','dfd') => 'horizontal',
//								esc_attr__('Vertical','dfd') => 'vertical',
//							),
//						),
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
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Images', 'dfd' ),
							'param_name'       => 'images_heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Main image','dfd'),
							'param_name' => 'image_first',
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Backface image','dfd'),
							'param_name' => 'image_second',
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Image resolution', 'dfd' ),
							'param_name'       => 'resolutions_heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => esc_html__('Image width', 'dfd'),
							'param_name' => 'image_width',
							'value' => 1180,
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => esc_html__('Image height', 'dfd'),
							'param_name' => 'image_height',
							'value' => 600,
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							'group'			   => esc_html('Images','dfd')
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Marker', 'dfd' ),
							'param_name'       => 'marker_heading',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							'group'			   => esc_html('Marker','dfd')
						),
						array(
							'type' => 'attach_image',
							'class' => '',
							'heading' => esc_html__('Marker image','dfd'),
							'param_name' => 'marker',
							'value' => '',
							//'edit_field_class' => 'vc_column vc_col-sm-6',
							'group'		=> esc_html('Marker','dfd')
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => esc_html__('Delimiter width', 'dfd'),
							'param_name' => 'delim_width',
							'value' => 1,
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							'group'			   => esc_html('Marker','dfd')
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => esc_html__('Delimiter Color', 'dfd'),
							'param_name' => 'delim_bg',
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							'group'		=> esc_html('Marker','dfd')
						),
					)
				));
			}
		}
		
		function generate_images_html($id = '', $w = '', $h = '') {
			$html = $image_url = $alt = '';
			
			if($id != '') {
				$image_src = wp_get_attachment_image_src($id,'full');
				
				if($w && $h)
					$image_url = dfd_aq_resize($image_src[0], $w, $h, true, true, true);
				
				$image_meta = wp_get_attachment_metadata($id);
				
				if(isset($image_meta['image_meta']['caption']) && $image_meta['image_meta']['caption'] != '') {
					$alt = $image_meta['image_meta']['caption'];
				} elseif(isset($image_meta['image_meta']['title']) && $image_meta['image_meta']['title'] != '') {
					$alt = $image_meta['image_meta']['title'];
				} else {
					$alt = esc_attr__('Slide parallax image','dfd');
				}
				
				if(!$image_url || $image_url == '')
					$image_url = $image_src[0];
			
				$html .= '<img src="'.esc_url($image_url).'" width="'.esc_attr($w).'" height="'.esc_attr($h).'" alt="'.esc_attr($alt).'" />';
			}
			
			return $html;
		}

		function dfd_slide_parallax_form( $atts, $content = null ) {
			$html = $left_image_html = $right_image_html = $data_atts = $pointer_html = $css_rules = '';
			
			$uniqid = uniqid('dfd-slide-parallax-');
			
			$atts = vc_map_get_attributes( 'dfd_slide_parallax', $atts );
			extract( $atts );

			wp_enqueue_script( 'dfd_slide_parallax' );
			
			$direction = (isset($direction) && $direction != '') ? $direction : 'horizontal';
			
			$el_class .= ' dfd-slide-parallax-'.$direction;
			$data_atts .= ' data-direction="'.esc_attr($direction).'" ';
			
			if(isset($delim_width) && $delim_width != '') {
				$prop = ($direction == 'horizontal') ? array('width','margin-left') : array('height','margin-top');
				$css_rules .= esc_js($prop[0]).': '.esc_js($delim_width).'px;';
				$css_rules .= esc_js($prop[1]).': -'.esc_js($delim_width/2).'px;';
			}
			
			if(isset($delim_bg) && $delim_bg != '')
				$css_rules .= 'background: '.esc_js($delim_bg).';';
			
			if(isset($module_animation) && !empty($module_animation)) {
				$el_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-item=".images-wrap" data-animate-type="'.esc_attr($module_animation).'" ';
			}

			if(isset($image_first) && !empty($image_first)) {
				$left_image_html .= '<div class="image-wrap image-left">';
					$left_image_html .= $this->generate_images_html($image_first, $image_width, $image_height);
				$left_image_html .= '</div>';
			}

			if(isset($image_second) && !empty($image_second)) {
				$right_image_html .= '<div class="image-wrap image-right">';
					$right_image_html .= $this->generate_images_html($image_second, $image_width, $image_height);
				$right_image_html .= '</div>';
			}
			
			if(isset($marker) && !empty($marker)) {}
				$pointer_html .= $this->generate_images_html($marker, false, false);
			
			$html .= '<div class="dfd-slide-parallax-wrap '.esc_attr($el_class).'" '.$data_atts.'>';
			
				$html .= '<div id="'.esc_attr($uniqid).'" class="images-wrap">';
				
					if($left_image_html == '' || $left_image_html == '') {
						$html .= '<h2 class="widget-title">'.esc_html__('The images are required for this shortcode. Please upload or select images from media library in shortcode settings','dfd').'</h2>';
					} else {
						$html .= '<div>';
							$html .= $left_image_html . $right_image_html;

							$html .= '<div class="handler">';
								$html .= '<span class="pointer">';
									$html .= $pointer_html;
								$html .= '</span>';
							$html .= '</div>';
						$html .= '</div>';
					}
				
				$html .= '</div>';
				
				$html .= '<script>';
				
					$html	.= '(function($) {
									$(document).ready(function() {
										$("#'.esc_js($uniqid).'").slideParallax();';
					if($css_rules != '')
						$html .=		'$("head").append("<style>#'.esc_js($uniqid).' .handler {'.$css_rules.'}</style>");';
					$html .=		'});
								})(jQuery);';
				
				$html .= '</script>';
			
			$html .= '</div>';

			return $html;

		}
	}

	new Dfd_Slide_parallax;
}