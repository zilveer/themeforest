<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Videoplayer
*/
if ( ! class_exists( 'Dfd_Videoplayer' ) ) {
	/**
	 * Class Dfd_Videoplayer
	 */
	class Dfd_Videoplayer {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'dfd_videoplayer_init' ) );
			add_shortcode( 'videoplayer', array( $this, 'dfd_videoplayer_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function dfd_videoplayer_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/videoplayer/';
				$dependency_on_style2 = array( "dependency" => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									));
				vc_map(
					array(
						'name'        => esc_html__( 'Video Player', 'dfd' ),
						'base'        => 'videoplayer',
						'class'       => 'vc_info_banner_icon',
						'icon'        => 'vc_icon_info_banner',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display Button with video popup', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'    => esc_html__( 'Choose Style', 'dfd' ),
									'type'       => 'radio_image_select',
									'param_name' => 'main_style',
									'simple_mode' => false,
									'options'    => array(
										'style-1'	=> array(
											'tooltip'	=> esc_attr__('Background','dfd'),
											'src'		=> $module_images . 'style-2.png'
										),
										'style-2'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-1.png'
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
											'tooltip'	=> esc_attr__('Underlined','dfd'),
											'src'		=> $module_images . 'layout-1.png'
										),
										'layout-2'	=> array(
											'tooltip'	=> esc_attr__('Bordered','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-3'	=> array(
											'tooltip'	=> esc_attr__('Icon underline','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-4'	=> array(
											'tooltip'	=> esc_attr__('Icon border','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
									),
									'dependency'  => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Button', 'dfd' ) . ' ' . esc_html__( 'Alignment', 'dfd' ),
									'param_name' => 'button_align',
									'value'      => array(
										esc_html__( 'Center', 'dfd' ) => 'text-center',
										esc_html__( 'Left', 'dfd' )   => 'text-left',
										esc_html__( 'Right', 'dfd' )  => 'text-right'
									),
									'dependency' => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									),
								),
//								array(
//									'type'       => 'dropdown',
//									'class'      => '',
//									'heading'    => esc_html__( 'Appear', 'dfd' ).' '.esc_html__( 'Animation', 'dfd' ),
//									'param_name' => 'video_animation',
//									'value'      => dfd_module_animation_styles(),
//									'dependency' => array(
//										'element' => 'main_style',
//										'value'   => array( 'style-2' )
//									),
//								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Full screen video', 'dfd' ).' '.esc_html__( 'animation', 'dfd' ),
									'param_name' => 'videoanimation',
									'value'      => dfd_module_animation_styles(),
									'dependency' => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Module appear animation', 'dfd' ),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
									'param_name'  => 'el_class_name',
									'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
									'group'       => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
									'group'      => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'attach_image',
									'class'       => '',
									'heading'     => esc_html__( 'Thumbnail Image', 'dfd' ),
									'param_name'  => 'video_thumb',
									'value'       => '',
									'description' => esc_html__( 'Upload or select video thumbnail image from media gallery.', 'dfd' ),
									'dependency'  => array(
										'element' => 'main_style',
										'value'   => array( 'style-1' )
									),
									'group'       => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Video link', 'dfd' ),
									'param_name' => 'video_link',
									'group'      => esc_attr__( 'Content', 'dfd' ),

								),
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
									'text'             => esc_html__( 'Module', 'dfd' ) . ' ' . esc_html__( 'Style', 'dfd' ),
									'param_name'       => 'etc_h',
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),

								),
//								array(
//									'type'             => 'number',
//									'heading'          => esc_html__( 'Thumbnail radius', 'dfd' ),
//									'param_name'       => 'thumb_radius',
//									'min'              => 0,
//									'suffix'           => '',
//									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
//									'dependency'  => array(
//										'element' => 'main_style',
//										'value'   => array( 'style-1' )
//									),
//									'group'            => esc_html__( 'Style', 'dfd' )
//								),
								array(
									'type'             => 'checkbox',
									'heading'          => esc_html__( 'Equal sides?', 'dfd' ),
//									'heading'          => esc_html__( 'Round button?', 'dfd' ),
									'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
									'param_name'       => 'round_button',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'dependency'  => array(
										'element' => 'main_layout',
										'value'   => array( 'layout-4' )
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Icon', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'icon_color',
									'edit_field_class' => 'vc_column crum_vc vc_col-sm-6',
									'group'            => esc_html__( 'Style', 'dfd' ),

								),
																	array_merge(

								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Button', 'dfd' ) . ' ' . esc_html__( 'Style', 'dfd' ),
									'param_name'       => 'bg_t_h',
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',									
									'group'            => esc_html__( 'Style', 'dfd' ),
										),
									$dependency_on_style2
																			  ),

								
								array_merge(
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Start', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
									$dependency_on_style2	
										  ),
								array_merge(
									array(
										'type'             => 'colorpicker',
										'heading'          => esc_html__( 'End', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
										'param_name'       => 'fill_color_end',
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
										'group'            => esc_html__( 'Style', 'dfd' ),
									),
									$dependency_on_style2
								),
																array_merge(
	
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Border radius', 'dfd' ),
									'param_name'       => 'bg_radius',
									'min'              => 0,
									'suffix'           => '',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
								array_merge(	
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Border color', 'dfd' ),
									'param_name'       => 'button_b_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
								array_merge(		
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Border width', 'dfd' ),
									'param_name'       => 'button_b_width',
									'min'              => 0,
									'suffix'           => '',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
																	array_merge(		

								array(
									'type'             => 'checkbox',
									'heading'          => esc_html__( 'Show shadow?', 'dfd' ),
									'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => true ),
									'param_name'       => 'shadow',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
								array_merge(	
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter style', 'dfd' ),
									'param_name'       => 'del_t_heading',
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
								array_merge(		
								array(
									'type'             => 'dropdown',
									'heading'          => esc_html__( 'Line type:', 'dfd' ),
									'param_name'       => 'line_style',
									'value'            => array(
										esc_html__( 'Default', 'dfd' ) => '',
										esc_html__( 'Dotted', 'dfd' )  => 'dotted',
										esc_html__( 'Solid', 'dfd' )   => 'solid',
										esc_html__( 'Dashed', 'dfd' )  => 'dashed',
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
																array_merge(		
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'line_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
								array_merge(		
								array(
									'type'             => 'checkbox',
									'heading'          => esc_html__( 'Hide element', 'dfd' ),
									'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
									'param_name'       => 'line_hide',
									'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),$dependency_on_style2),
									///lightbox Background 

								array_merge(
									array(
										'type'             => 'ult_param_heading',
										'text'             => esc_html__( 'lightbox Background ', 'dfd' ) . ' ' . esc_html__( 'settings', 'dfd' ),
										'param_name'       => 'bg_t_h',
										'class'            => 'ult-param-heading',
										'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',									
										'group'            => esc_html__( 'Style', 'dfd' ),
									),
									$dependency_on_style2
								),

								
								array_merge(
									array(
										'type'             => 'colorpicker',
										'heading'          => esc_html__( 'Start', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
										'param_name'       => 'lightbox_fill_color_start',
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
										'group'            => esc_html__( 'Style', 'dfd' ),
									),
									$dependency_on_style2	
								),
								
								array_merge(
									array(
										'type'             => 'colorpicker',
										'heading'          => esc_html__( 'End', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
										'param_name'       => 'lightbox_fill_color_end',
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
										'group'            => esc_html__( 'Style', 'dfd' ),
									),
									$dependency_on_style2
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
		 * @param $atts
		 *
		 * @return string
		 */
		function dfd_videoplayer_shortcode( $atts ) {
			$main_style = $main_layout = $button_align = $title = $subtitle = $video_thumb = $video_animation = $videoanimation = $video_link = $title_font_options = $shadow =
			$subtitle_font_options = $icon_color = $fill_color_start = $fill_color_end = $bg_radius = $button_b_color = $button_b_width = $line_hide = $line_style = '';
			$title_html = $thumb_html = $title_style = $icon_style = $subtitle_html = $subtitle_style = $button_style = $button_html = $delimiter_html = $delimiter_style = $content_html = '';
			$output = $el_class = $module_animation = $thumb_radius = $line_color = $round_button = $general_style =$lightbox_fill_color_start= $lightbox_fill_color_end= $link_css = $unique_id_shortcode = $el_class_name = '';

			$atts = vc_map_get_attributes( 'videoplayer', $atts );
			extract( $atts );

			$size = ( isset( $content_width ) ) ? $content_width : '500';
			wp_enqueue_script( 'video-module-js', get_template_directory_uri() . '/assets/js/crum-video-module.js', array( 'jquery' ), false, true );

			// Create parts of module according to parameters.

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = $an_class  = $an_appear_class = '';

			if ( ! ( $module_animation == '' ) ) {
				$an_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if ( ! ( $video_animation == '' ) ) {
				$an_appear_class       .= ' cr-animate-gen ';
			}
			
			if('yes' === $round_button){
				$el_class .= ' rounded-play-button ';
			}
			
			$unique_id_shortcode = uniqid('video-player-') .'-'.rand(1,9999);
			
			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title');
				$title_html = '<'.$title_options['tag'].' class="' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
			}

			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options,'subtitle');
				$subtitle_html = '<'.$subtitle_options['tag'].' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_style || (!empty($line_color)) ) {
				if(!empty($line_color)){
					$line_color='border-color:'.$line_color.';';
				}
				if ( ( 'layout-1' === $main_layout ) || ( 'layout-2' === $main_layout ) ) {
					$delimiter_style .= 'style="border-right-style:' . $line_style . ';' . $line_color . '"';
				} else {
					$delimiter_style .= 'style="border-bottom-style:' . $line_style . ';' . $line_color . '"';
				}
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="delimiter" ' . $delimiter_style . '></div>';
			}

			/**************************
			 * Icon style.
			 *************************/

			if ( $icon_color ) {
				$icon_style .= 'style="border-left-color:' . $icon_color . '"';
			}


			/**************************
			 * Button Style + HTML.
			 *************************/
			$unique_id = uniqid('module_video_');

			if($fill_color_start || $fill_color_end || $bg_radius || $button_b_color ){
				//$button_style .= 'style="';
				//$general_style .= 'style="';
				if ( $button_b_width ) {
					$button_style .= 'border-style:solid; border-width:' . esc_attr($button_b_width) . 'px; ';
				}
				if ( '0' === $button_b_width ) {
					$button_style .= 'border:none; ';
				}
				if ( ( empty( $button_b_width ) && $fill_color_end ) || ( $fill_color_start && empty( $button_b_width ) ) ) {
					$button_style .= 'border: none; ';
				}
				if ( $button_b_color ) {
					$button_style .= 'border-color:' . esc_attr($button_b_color).'; ';
				}
				if ( $bg_radius ) {
					$button_style .= 'border-radius:' . esc_attr($bg_radius).'px; ';
					$general_style .= 'border-radius:' . esc_attr($bg_radius).'px; ';
				}
				if ( $fill_color_end && $fill_color_start ) {
					$button_style .= 'background: linear-gradient(to right, ' . esc_attr($fill_color_start) . ' 0%,' . esc_attr($fill_color_end) . ' 100%); ';
				} elseif ( $fill_color_start ) {
					$button_style .= 'background:' . esc_attr($fill_color_start) . '; ';
				} elseif ( $fill_color_end ) {
					$button_style .= 'background:' . esc_attr($fill_color_end) . ';';
				}

				$link_css .= '#'.$unique_id_shortcode.' .dfd-video-button {'.$general_style.'}';
				$link_css .= ' #'.$unique_id_shortcode.'.style-2 .dfd-video-button .mask-for-hover {'.$button_style.'}';
				
				//$general_style .= '"';
				//$button_style .= '"';
			}
			if($lightbox_fill_color_start || $lightbox_fill_color_end){
				$lightbox_style = "";
				if ( $lightbox_fill_color_start && $lightbox_fill_color_end ) {
					$lightbox_style .= 'background: linear-gradient(to right, ' . esc_attr($lightbox_fill_color_start) . ' 0%,' . esc_attr($lightbox_fill_color_end) . ' 100%); ';
				} elseif ( $lightbox_fill_color_start ) {
					$lightbox_style.= 'background:' . esc_attr($lightbox_fill_color_start) . '; ';
				} elseif ( $lightbox_fill_color_end ) {
					$lightbox_style .= 'background:' . esc_attr($lightbox_fill_color_end) . ';';
				}
				$link_css .= ' #'.$unique_id.'.dfd-fullscreen-video-container.video_module {'.$lightbox_style.'}';

			}
			if ( $shadow ) {
				$shadow = 'shadow';
			}

			if (('layout-1' === $main_layout) || ('layout-2' === $main_layout)) {
				$button_html .= '<span class="dfd-video-button ' . $shadow . ' ' . $el_class . '" >';
				$button_html .= '<span class="mask-for-hover">';
					if('layout-1' === $main_layout){
						$button_html .= '<u></u><b></b>';
					}
				$button_html .= $delimiter_html;
				$button_html .= '</span>';
				$button_html .= '<span class="play" ' . $icon_style . '></span>';
				if($title || $subtitle) {
					$button_html .= '<div class="title-wrap">';
					$button_html .= $title_html;
					$button_html .= $subtitle_html;
					$button_html .= '</div>';
				}
				$button_html .= '<a href="#'.$unique_id.'" class="dfd-video-link '.$an_appear_class.'" data-animation="'.$videoanimation.'"></a>';
				$button_html .= '</span>';
			} else {
				$button_html .= '<div class="button-wrap">';
				$button_html .= '<div class="dfd-video-button ' . $shadow . ' ' . $el_class . '" >';
				$button_html .= '<span class="mask-for-hover">';
					if('layout-3' === $main_layout){
						$button_html .= '<u></u><b></b>';
					}
				$button_html .= '</span>';
				$button_html .= '<span class="play" ' . $icon_style . '></span>';
				$button_html .= '</div>';
				if($title || $subtitle) {
					$button_html .= '<div class="title-wrap">';
					$button_html .= $title_html;
					$button_html .= $delimiter_html;
					$button_html .= $subtitle_html;
					$button_html .= '</div>';
				}
				$button_html .= '<a href="#'.$unique_id.'" class="dfd-video-link '.$an_appear_class.'" data-animation="'.$videoanimation.'"></a>';
				$button_html .= '</div>';
			}

			/**************************
			 * Block style 1 HTML.
			 *************************/

			$video_w = $size;
			$video_h = $size / 1.61; //1.61 golden ratio


			if ( ! empty( $thumb_radius ) ){
				$thumb_radius = 'style="border-radius:' . $thumb_radius . 'px;"';
			}

			/** @var WP_Embed $wp_embed  */
			global $wp_embed;
			$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $video_link . '[/embed]' );

			if ( 'style-1' === $main_style ) {
				$content_html .= '<div class="dfd-video-content video-content" id="' . esc_html( $unique_id ) . '">';
				if(isset($video_thumb) && !empty($video_thumb)) {
					$thumb_image_url = wp_get_attachment_image_src($video_thumb, 'full');
					$image_src = dfd_aq_resize($thumb_image_url[0], $video_w, $video_h, true, true, true);
					if(!$image_src) {
						$image_src = $thumb_image_url[0];
					}
					$thumb_html = '<a href="#'. esc_html( $unique_id ).'" class="dfd-video-image-thumb" title="'.esc_html__('Play video','dfd').'"><span class="container-play"><span class="play" '.$icon_style.'></span><span class="play-shadow"></span></span><img src="'.esc_url($image_src).'" alt="" /></a>';
					$opacity_class = '';
				} else {
					$opacity_class = 'no-thumb';
				}

				$content_html .= '<div class="dfd-video-box '.$opacity_class.'"  '.$thumb_radius.'>';
				$content_html .= $thumb_html;
				$content_html .= '<div class="wpb_video_wrapper">' . $embed . '</div>';
				$content_html .= '</div>';
				$content_html .= '</div>';
			}

			if ( 'style-2' === $main_style ) {
//				$content_html .= '<div class="dfd-fullscreen-video-container" id="' . esc_html( $unique_id ) . '" data-animation="' . $video_animation . '">' . $embed . '<a href="#close-video" class="fullscreen-video-close"></a></div>';
//				$content_html .= '<div  style="display:none;" class="dfd-vimeo-bg" id="' . esc_html( $unique_id ) . '" data-animation="' . $video_animation . '">' . $embed . '</div>';
				$content_html .=  '<div  style="display:none;" class="'.$an_appear_class.'" id="' . esc_html( $unique_id ) . '" data-animation="' . $videoanimation. '">' . $embed . '</div>';
			}

			// Module output according to layout selection.
			$output .= '<div class="animation-container '.$an_class.'" '.$animation_data.'>';
				$output .= '<div id="'.$unique_id_shortcode.'" class="dfd-videoplayer ' . $main_style . ' ' . $main_layout . ' ' . $button_align . ' '.$el_class_name.'">';

					if ( 'style-2' === $main_style ) {
						$output .= $button_html;
						$output .= $content_html;
					} else {
						$output .= $content_html;
					}

				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<script type="text/javascript">
				(function($) {
					$("head").append("<style>'. esc_js($link_css) .'</style>");
					$(document).ready(function(){
						DFD_VideoModule.init("'.$unique_id.'","'.$unique_id_shortcode.'");
					});
	
				})(jQuery);
			</script>';
			/*?><script>
//				jQuery(document).ready(function(){
//							DFD_VideoModule.init("<?php echo $unique_id;?>");
//						});
			</script>
				<?php*/
			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Videoplayer' ) ) {
	$Dfd_Videoplayer = new Dfd_Videoplayer;
}
