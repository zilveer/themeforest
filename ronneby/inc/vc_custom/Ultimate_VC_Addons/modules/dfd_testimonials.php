<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if ( ! class_exists( 'Dfd_Old_Testimonials' ) ) {
	class Dfd_Old_Testimonials {
		function __construct() {
			add_action( 'init', array( $this, 'dfd_testimonials_init' ) );
			add_shortcode( 'dfd_testimonials', array( $this, 'dfd_testimonials_shortcode' ) );
		}

		function dfd_testimonials_init() {
			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => __( 'Testimonials box', 'dfd' ),
						'base'        => 'dfd_testimonials',
						'class'       => 'vc_info_banner_icon',
						'icon'        => 'vc_icon_info_banner',
						'category'    => __( 'Ronneby 1.0', 'dfd' ),
						//'deprecated' => '4.6',
						'description' => __( 'Displays clients&apos; testimonials', 'dfd' ),
						'params'      => array(
							array(
								'type'        => 'textfield',
								'class'       => '',
								'heading'     => __( 'Title', 'dfd' ),
								'param_name'  => 'testimonial_author_title',
								'admin_label' => true,
								'value'       => '',
								'description' => ''
							),
							array(
								'type'        => 'textfield',
								'class'       => '',
								'heading'     => __( 'Subtitle', 'dfd' ),
								'param_name'  => 'testimonial_author_subtitle',
								'admin_label' => true,
								'value'       => '',
								'description' => ''
							),
							array(
								'type'        => 'textarea',
								'class'       => '',
								'heading'     => __( 'Description', 'dfd' ),
								'param_name'  => 'testimonial_author_desc',
								'value'       => '',
								'description' => ''
							),
							array(
								'type'       => 'dropdown',
								'heading'    => __( 'Information Alignment', 'dfd' ),
								'param_name' => 'info_alignment',
								'value'      => array(
									__( 'Center', 'dfd' ) => 'text-center',
									__( 'Left', 'dfd' )   => 'text-left',
									__( 'Right', 'dfd' )  => 'text-right'
								)
							),
							array(
								'type'       => 'dropdown',
								'heading'    => __( 'Image position', 'dfd' ),
								'param_name' => 'image_position',
								'value'      => array(
									__( 'Top', 'dfd' )    => 'top-image',
									__( 'Bottom', 'dfd' ) => 'bottom-image',
								)
							),
							array(
								'type'        => 'attach_image',
								'class'       => '',
								'heading'     => __( 'Testimonial Author Image', 'dfd' ),
								'param_name'  => 'testimonial_author_image',
								'value'       => '',
								'description' => __( 'Upload the testimonial author photo', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => __( 'Fact number Settings', 'dfd' ),
								'param_name'       => 'content_typograpy',
								'group'            => 'Typography',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								//'dependency' => Array('element' => 'testimonial_content_type', 'value' => array('customizable')),
							),
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => __( 'Content type', 'dfd' ),
								'param_name' => 'testimonial_content_typography_type',
								'value'      => array(
									__( 'Default', 'dfd' )      => 'default',
									__( 'Google Fonts', 'dfd' ) => 'google_fonts',
								),
								"group"      => "Typography",
								//"dependency" => Array("element" => "testimonial_content_type", "value" => array('customizable')),
							),
							array(
								"type"        => "ultimate_google_fonts",
								"heading"     => __( "Font Family", 'dfd' ),
								"param_name"  => "content_font_family",
								"description" => __( "Select the font of your choice. You can <a target='_blank' href='" . admin_url( 'admin.php?page=ultimate-font-manager' ) . "'>add new in the collection here</a>.", 'dfd' ),
								"group"       => "Typography",
								"dependency"  => Array(
									"element" => "testimonial_content_typography_type",
									"value"   => array( 'google_fonts' )
								),
							),
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Custom font family', 'dfd' ),
								'param_name' => 'content_custom_family',
								'holder'     => 'div',
								'value'      => '',
								"group"      => "Typography",
								"dependency" => Array(
									"element" => "testimonial_content_typography_type",
									"value"   => array( 'default' )
								),
							),
							array(
								"type"       => "ultimate_google_fonts_style",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "content_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array(
									"element" => "testimonial_content_typography_type",
									"value"   => array( 'google_fonts' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "content_default_style",
								'value'      => array(
									__( 'Theme default', 'dfd' ) => '',
									__( 'Normal', 'dfd' )        => 'normal',
									__( 'Italic', 'dfd' )        => 'italic',
									__( 'Inherit', 'dfd' )       => 'inherit',
									__( 'Initial', 'dfd' )       => 'initial',
								),
								"dependency" => Array(
									"element" => "testimonial_content_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Weight", 'dfd' ),
								"param_name" => "content_default_weight",
								'value'      => array(
									__( 'Default', 'dfd' ) => '',
									'100'                  => '100',
									'200'                  => '200',
									'300'                  => '300',
									'500'                  => '500',
									'600'                  => '600',
									'700'                  => '700',
									'800'                  => '800',
									'900'                  => '900',
								),
								"dependency" => Array(
									"element" => "testimonial_content_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "font-size",
								"heading"    => __( "Font Size", 'dfd' ),
								"param_name" => "content_font_size",
								"min"        => 10,
								"suffix"     => "px",
								//"description" => __("Main heading font size", 'dfd'),
								//"dependency" => Array("element" => "testimonial_content_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "colorpicker",
								"class"      => "",
								"heading"    => __( "Font Color", 'dfd' ),
								"param_name" => "content_color",
								"value"      => "",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "testimonial_content_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Line Height", 'dfd' ),
								"param_name" => "content_line_height",
								"value"      => "",
								"suffix"     => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "testimonial_content_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Letter spacing", 'dfd' ),
								"param_name" => "content_letter_spacing",
								"value"      => "",
								"suffix"     => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "testimonial_content_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"             => "ult_param_heading",
								"text"             => __( "Heading Settings", 'dfd' ),
								"param_name"       => "main_heading_typograpy",
								"group"            => "Typography",
								"class"            => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => __( 'Heading type', 'dfd' ),
								'param_name' => 'heading_typography_type',
								'value'      => array(
									__( 'Default', 'dfd' )      => 'default',
									__( 'Google Fonts', 'dfd' ) => 'google_fonts',
								),
								"group"      => "Typography",
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								"type"        => "ultimate_google_fonts",
								"heading"     => __( "Font Family", 'dfd' ),
								"param_name"  => "main_heading_font_family",
								"description" => __( "Select the font of your choice. You can <a target='_blank' href='" . admin_url( 'admin.php?page=ultimate-font-manager' ) . "'>add new in the collection here</a>.", 'dfd' ),
								"group"       => "Typography",
								"dependency"  => Array(
									"element" => "heading_typography_type",
									"value"   => array( 'google_fonts' )
								),
							),
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder'     => 'div',
								'value'      => '',
								"group"      => "Typography",
								"dependency" => Array(
									"element" => "heading_typography_type",
									"value"   => array( 'default' )
								),
							),
							array(
								"type"       => "ultimate_google_fonts_style",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "main_heading_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array(
									"element" => "heading_typography_type",
									"value"   => array( 'google_fonts' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "main_heading_default_style",
								'value'      => array(
									__( 'Theme default', 'dfd' ) => '',
									__( 'Normal', 'dfd' )        => 'normal',
									__( 'Italic', 'dfd' )        => 'italic',
									__( 'Inherit', 'dfd' )       => 'inherit',
									__( 'Initial', 'dfd' )       => 'initial',
								),
								"dependency" => Array(
									"element" => "heading_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Weight", 'dfd' ),
								"param_name" => "main_heading_default_weight",
								'value'      => array(
									__( 'Default', 'dfd' ) => '',
									'100'                  => '100',
									'200'                  => '200',
									'300'                  => '300',
									'500'                  => '500',
									'600'                  => '600',
									'700'                  => '700',
									'800'                  => '800',
									'900'                  => '900',
								),
								"dependency" => Array(
									"element" => "heading_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "font-size",
								"heading"    => __( "Font Size", 'dfd' ),
								"param_name" => "main_heading_font_size",
								"min"        => 10,
								"suffix"     => "px",
								//"description" => __("Main heading font size", 'dfd'),
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "colorpicker",
								"class"      => "",
								"heading"    => __( "Font Color", 'dfd' ),
								"param_name" => "main_heading_color",
								"value"      => "",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Line Height", 'dfd' ),
								"param_name" => "main_heading_line_height",
								"value"      => "",
								"suffix"     => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Letter spacing", 'dfd' ),
								"param_name" => "main_heading_letter_spacing",
								"value"      => "",
								"suffix"     => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"             => "ult_param_heading",
								"text"             => __( "Sub Heading Settings", 'dfd' ),
								"param_name"       => "sub_heading_typograpy",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group"            => "Typography",
								"class"            => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => __( 'Heading type', 'dfd' ),
								'param_name' => 'subheading_typography_type',
								'value'      => array(
									__( 'Default', 'dfd' )      => 'default',
									__( 'Google Fonts', 'dfd' ) => 'google_fonts',
								),
								"group"      => "Typography",
								//"dependency" => Array("element" => "content", "not_empty" => true),
							),
							array(
								"type"        => "ultimate_google_fonts",
								"heading"     => __( "Font Family", 'dfd' ),
								"param_name"  => "sub_heading_font_family",
								"description" => __( "Select the font of your choice. You can <a target='_blank' href='" . admin_url( 'admin.php?page=ultimate-font-manager' ) . "'>add new in the collection here</a>.", 'dfd' ),
								"group"       => "Typography",
								"dependency"  => Array(
									"element" => "subheading_typography_type",
									"value"   => array( 'google_fonts' )
								),
							),
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder'     => 'div',
								'value'      => '',
								"dependency" => Array(
									"element" => "subheading_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography",
							),
							array(
								"type"       => "ultimate_google_fonts_style",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "sub_heading_style",
								//"description"	=>	__("Sub heading font style", 'dfd'),
								"dependency" => Array(
									"element" => "subheading_typography_type",
									"value"   => array( 'google_fonts' )
								),
								"group"      => "Typography",
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Style", 'dfd' ),
								"param_name" => "sub_heading_default_style",
								'value'      => array(
									__( 'Theme default', 'dfd' ) => '',
									__( 'Normal', 'dfd' )        => 'normal',
									__( 'Italic', 'dfd' )        => 'italic',
									__( 'Inherit', 'dfd' )       => 'inherit',
									__( 'Initial', 'dfd' )       => 'initial',
								),
								"dependency" => Array(
									"element" => "subheading_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "dropdown",
								"heading"    => __( "Font Weight", 'dfd' ),
								"param_name" => "sub_heading_default_weight",
								'value'      => array(
									__( 'Default', 'dfd' ) => '',
									'100'                  => '100',
									'200'                  => '200',
									'300'                  => '300',
									'500'                  => '500',
									'600'                  => '600',
									'700'                  => '700',
									'800'                  => '800',
									'900'                  => '900',
								),
								"dependency" => Array(
									"element" => "subheading_typography_type",
									"value"   => array( 'default' )
								),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Font Size", 'dfd' ),
								"param_name" => "sub_heading_font_size",
								"min"        => 14,
								"suffix"     => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group"      => "Typography",
							),
							array(
								"type"       => "colorpicker",
								"class"      => "",
								"heading"    => __( "Font Color", 'dfd' ),
								"param_name" => "sub_heading_color",
								"value"      => "",
								//"description" => __("Sub heading color", 'dfd'),	
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group"      => "Typography",
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Line Height", 'dfd' ),
								"param_name" => "sub_heading_line_height",
								"value"      => "",
								"suffix"     => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								"type"       => "number",
								"class"      => "",
								"heading"    => __( "Letter spacing", 'dfd' ),
								"param_name" => "sub_heading_letter_spacing",
								"value"      => "",
								"suffix"     => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group"      => "Typography"
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation Settings',
							),
						),
					)
				);
			}
		}

		// Shortcode handler function
		function dfd_testimonials_shortcode( $atts ) {
			$output                              = $el_class = $icon_html = $image_html = $module_animation = '';
			$testimonial_content_typography_type = $content_font_size = $content_font_family = $content_custom_family = $content_style = $content_default_style = $content_default_weight = $content_color = $content_line_height = $content_letter_spacing = $heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = $subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';

			extract( shortcode_atts( array(
				'testimonial_author_title'            => '',
				'testimonial_author_subtitle'         => '',
				'testimonial_author_desc'             => '',
				'image_position'                      => 'top-image',
				'info_alignment'                      => 'text-center',
				'testimonial_author_image'            => '',
				'module_animation'                    => '',
				'el_class'                            => '',
				'testimonial_content_typography_type' => 'default',
				'content_font_size'                   => '',
				'content_font_family'                 => '',
				'content_custom_family'               => '',
				'content_style'                       => '',
				'content_default_style'               => '',
				'content_default_weight'              => '',
				'content_color'                       => '',
				'content_line_height'                 => '',
				'content_letter_spacing'              => '',
				'heading_typography_type'             => 'default',
				'main_heading_font_size'              => '',
				'main_heading_font_family'            => '',
				'main_heading_custom_family'          => '',
				'main_heading_style'                  => '',
				'main_heading_default_style'          => '',
				'main_heading_default_weight'         => '',
				'main_heading_color'                  => '',
				'main_heading_line_height'            => '',
				'main_heading_letter_spacing'         => '',
				'subheading_typography_type'          => 'default',
				'sub_heading_font_size'               => '',
				'sub_heading_font_family'             => '',
				'main_subheading_custom_family'       => '',
				'sub_heading_style'                   => '',
				'sub_heading_default_style'           => '',
				'sub_heading_default_weight'          => '',
				'sub_heading_color'                   => '',
				'sub_heading_line_height'             => '',
				'sub_heading_letter_spacing'          => '',
			), $atts ) );

			$no_image_class         = $main_heading_style_inline = $sub_heading_style_inline = $content_style_inline = '';
			$testimonial_author_src = wp_get_attachment_image_src( $testimonial_author_image, 'full' );

			if ( $content_font_family != '' && strcmp( $testimonial_content_typography_type, 'google_fonts' ) === 0 ) {
				$mhfont_family = get_ultimate_font_family( $content_font_family );
				$content_style_inline .= 'font-family:\'' . $mhfont_family . '\';';
			} elseif ( ! empty( $content_custom_family ) && strcmp( $testimonial_content_typography_type, 'default' ) === 0 ) {
				$content_style_inline .= 'font-family:\'' . $content_custom_family . '\';';
			}
			// main heading font style
			if ( strcmp( $testimonial_content_typography_type, 'google_fonts' ) === 0 ) {
				$content_style_inline .= get_ultimate_font_style( $content_style );
			} elseif ( ! empty( $content_default_style ) && strcmp( $testimonial_content_typography_type, 'default' ) === 0 ) {
				$content_style_inline .= 'font-style:' . esc_attr( $content_default_style ) . ';';
			}
			if ( ! empty( $content_default_weight ) && strcmp( $testimonial_content_typography_type, 'default' ) === 0 ) {
				$content_style_inline .= 'font-weight:' . esc_attr( $content_default_weight ) . ';';
			}
			//attach font size if set
			if ( $content_font_size != '' ) {
				$content_style_inline .= 'font-size:' . esc_attr( $content_font_size ) . 'px;';
			}
			//attach font color if set	
			if ( $content_color != '' ) {
				$content_style_inline .= 'color:' . esc_attr( $content_color ) . ';';
			}
			//line height
			if ( $content_line_height != '' ) {
				$content_style_inline .= 'line-height:' . esc_attr( $content_line_height ) . 'px;';
			}
			//letter spacing
			if ( $content_letter_spacing != '' ) {
				$content_style_inline .= 'letter-spacing:' . esc_attr( $content_letter_spacing ) . 'px;';
			}

			if ( $main_heading_font_family != '' && strcmp( $heading_typography_type, 'google_fonts' ) === 0 ) {
				$mhfont_family = get_ultimate_font_family( $main_heading_font_family );
				$main_heading_style_inline .= 'font-family:\'' . $mhfont_family . '\';';
			} elseif ( ! empty( $main_heading_custom_family ) && strcmp( $heading_typography_type, 'default' ) === 0 ) {
				$main_heading_style_inline .= 'font-family:\'' . $main_heading_custom_family . '\';';
			}
			// main heading font style
			if ( strcmp( $heading_typography_type, 'google_fonts' ) === 0 ) {
				$main_heading_style_inline .= get_ultimate_font_style( $main_heading_style );
			} elseif ( ! empty( $main_heading_default_style ) && strcmp( $heading_typography_type, 'default' ) === 0 ) {
				$main_heading_style_inline .= 'font-style:' . esc_attr( $main_heading_default_style ) . ';';
			}
			if ( ! empty( $main_heading_default_weight ) && strcmp( $heading_typography_type, 'default' ) === 0 ) {
				$main_heading_style_inline .= 'font-weight:' . esc_attr( $main_heading_default_weight ) . ';';
			}
			//attach font size if set
			if ( $main_heading_font_size != '' ) {
				$main_heading_style_inline .= 'font-size:' . esc_attr( $main_heading_font_size ) . 'px;';
			}
			//attach font color if set	
			if ( $main_heading_color != '' ) {
				$main_heading_style_inline .= 'color:' . esc_attr( $main_heading_color ) . ';';
			}
			//line height
			if ( $main_heading_line_height != '' ) {
				$main_heading_style_inline .= 'line-height:' . esc_attr( $main_heading_line_height ) . 'px;';
			}
			//letter spacing
			if ( $main_heading_letter_spacing != '' ) {
				$main_heading_style_inline .= 'letter-spacing:' . esc_attr( $main_heading_letter_spacing ) . 'px;';
			}

			/* ----- sub heading styles ----- */
			if ( $sub_heading_font_family != '' && strcmp( $subheading_typography_type, 'google_fonts' ) === 0 ) {
				$shfont_family = get_ultimate_font_family( $sub_heading_font_family );
				$sub_heading_style_inline .= 'font-family:\'' . $shfont_family . '\';';
			} elseif ( ! empty( $main_subheading_custom_family ) && strcmp( $subheading_typography_type, 'default' ) === 0 ) {
				$sub_heading_style_inline .= 'font-family:\'' . $main_subheading_custom_family . '\';';
			}
			//sub heaing font style
			if ( strcmp( $subheading_typography_type, 'google_fonts' ) === 0 ) {
				$sub_heading_style_inline .= get_ultimate_font_style( $sub_heading_style );
			} elseif ( ! empty( $sub_heading_default_style ) && strcmp( $subheading_typography_type, 'default' ) === 0 ) {
				$sub_heading_style_inline .= 'font-style:' . esc_attr( $sub_heading_default_style ) . ';';
			}
			if ( ! empty( $sub_heading_default_weight ) && strcmp( $heading_typography_type, 'default' ) === 0 ) {
				$sub_heading_style_inline .= 'font-weight:' . esc_attr( $sub_heading_default_weight ) . ';';
			}
			//attach font size if set
			if ( $sub_heading_font_size != '' ) {
				$sub_heading_style_inline .= 'font-size:' . esc_attr( $sub_heading_font_size ) . 'px;';
			}
			//attach font color if set	
			if ( $sub_heading_color != '' ) {
				$sub_heading_style_inline .= 'color:' . esc_attr( $sub_heading_color ) . ';';
			}
			//line height
			if ( $sub_heading_line_height != '' ) {
				$sub_heading_style_inline .= 'line-height:' . esc_attr( $sub_heading_line_height ) . 'px;';
			}
			//letter spacing
			if ( $sub_heading_letter_spacing != '' ) {
				$sub_heading_style_inline .= 'letter-spacing:' . esc_attr( $sub_heading_letter_spacing ) . 'px;';
			}

			$icon_html .= '<div class="icon-wrap">';
			$icon_html .= '<i class="navicon-quote-right"></i>';
			$icon_html .= '</div>';

			if ( isset( $testimonial_author_src[0] ) && $testimonial_author_src[0] != '' ) {
				$test_author_image = dfd_aq_resize( $testimonial_author_src[0], 80, 80, true, true, true );
				if ( ! $test_author_image ) {
					$test_author_image = $testimonial_author_src[0];
				}
				$image_html .= '<div class="image-wrap">';
				$image_html .= '<img src="' . esc_url( $test_author_image ) . '" alt="' . __( 'testimonial author', 'dfd' ) . '"/>';
				$image_html .= '</div>';
			} else {
				$no_image_class .= 'dfd-no-image';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			$output .= '<div class="dfd-testimonials ' . esc_attr( $el_class ) . ' ' . esc_attr( $animate ) . '" ' . $animation_data . '>';

			$output .= '<div class="dfd-testimonial-item ' . esc_attr( $no_image_class ) . ' ' . esc_attr( $info_alignment ) . ' ' . esc_attr( $image_position ) . '-position">';

			if ( strcmp( $image_position, 'bottom-image' ) === 0 ) {
				$output .= $icon_html;
			} else {
				$output .= $image_html;
			}

			if ( $testimonial_author_desc != '' ) {
				$output .= '<div class="dfd-testimonial-content" style="' . $content_style_inline . '">' . $testimonial_author_desc . '</div>';
			}

			if ( strcmp( $image_position, 'bottom-image' ) === 0 ) {
				$output .= $image_html;
			} else {
				$output .= $icon_html;
			}

			if ( $testimonial_author_title != '' ) {
				$output .= '<div class="feature-title" style="' . $main_heading_style_inline . '">' . $testimonial_author_title . '</div>';
			}

			if ( $testimonial_author_subtitle != '' ) {
				$output .= '<div class="subtitle" style="' . $sub_heading_style_inline . '">' . $testimonial_author_subtitle . '</div>';
			}

			$output .= '</div>';
			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Old_Testimonials' ) ) {
	$Dfd_Old_Testimonials = new Dfd_Old_Testimonials;
}
