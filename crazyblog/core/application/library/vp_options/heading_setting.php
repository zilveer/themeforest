<?php

class crazyblog_heading_setting_menu {

	public $title = 'Heading Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style',
				'label' => esc_html__( 'Use Headings Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h1',
				'label' => esc_html__( 'Use H1 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			// start heading one style
			array(
				'type' => 'section',
				'title' => esc_html__( 'H1 Custom Style', 'crazyblog' ),
				'name' => 'h1_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h1',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h1_font_preview',
						'binding' => array(
							'field' => 'h1_font_face,h1_font_style,h1_font_weight,h1_font_color,h1_font_size,h1_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h1_font_face',
						'label' => esc_html__( 'H1 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h1_font_style',
						'label' => esc_html__( 'H1 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h1_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h1_font_weight',
						'label' => esc_html__( 'H1 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h1_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h1_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h1_font_size',
						'label' => esc_html__( 'H1 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h1_line_height',
						'label' => esc_html__( 'H1 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
			// start heading two style
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h2',
				'label' => esc_html__( 'Use H2 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'H2 Custom Style', 'crazyblog' ),
				'name' => 'h2_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h2',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h2_font_preview',
						'binding' => array(
							'field' => 'h2_font_face,h2_font_style,h2_font_weight,h2_font_color,h2_font_size,h2_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h2_font_face',
						'label' => esc_html__( 'H2 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h2_font_style',
						'label' => esc_html__( 'H2 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h2_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h2_font_weight',
						'label' => esc_html__( 'H2 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h2_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h2_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h2_font_size',
						'label' => esc_html__( 'H2 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h2_line_height',
						'label' => esc_html__( 'H2 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
			// start heading three style
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h3',
				'label' => esc_html__( 'Use H3 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'H3 Custom Style', 'crazyblog' ),
				'name' => 'h3_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h3',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h3_font_preview',
						'binding' => array(
							'field' => 'h3_font_face,h3_font_style,h3_font_weight,h3_font_color,h3_font_size,h3_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h3_font_face',
						'label' => esc_html__( 'H3 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h3_font_style',
						'label' => esc_html__( 'H3 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h3_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h3_font_weight',
						'label' => esc_html__( 'H3 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h3_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h3_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h3_font_size',
						'label' => esc_html__( 'H3 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h3_line_height',
						'label' => esc_html__( 'H3 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
			// start heading four style
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h4',
				'label' => esc_html__( 'Use H4 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'H4 Custom Style', 'crazyblog' ),
				'name' => 'h4_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h4',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h4_font_preview',
						'binding' => array(
							'field' => 'h4_font_face,h4_font_style,h4_font_weight,h4_font_color,h4_font_size,h4_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h4_font_face',
						'label' => esc_html__( 'H4 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h4_font_style',
						'label' => esc_html__( 'H4 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h4_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h4_font_weight',
						'label' => esc_html__( 'H4 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h4_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h4_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h4_font_size',
						'label' => esc_html__( 'H4 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h4_line_height',
						'label' => esc_html__( 'H4 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
			// start heading five style
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h5',
				'label' => esc_html__( 'Use H5 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'H5 Custom Style', 'crazyblog' ),
				'name' => 'h5_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h5',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h5_font_preview',
						'binding' => array(
							'field' => 'h5_font_face,h5_font_style,h5_font_weight,h5_font_color,h5_font_size,h5_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h5_font_face',
						'label' => esc_html__( 'H5 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h5_font_style',
						'label' => esc_html__( 'H5 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h5_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h5_font_weight',
						'label' => esc_html__( 'H5 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h5_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h5_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h5_font_size',
						'label' => esc_html__( 'H5 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h5_line_height',
						'label' => esc_html__( 'H5 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
			// start heading six style
			array(
				'type' => 'toggle',
				'name' => 'use_custom_heading_style_h6',
				'label' => esc_html__( 'Use H6 Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
				'dependency' => array(
					'field' => 'use_custom_heading_style',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'H6 Custom Style', 'crazyblog' ),
				'name' => 'h6_custom_style',
				'dependency' => array(
					'field' => 'use_custom_heading_style_h6',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'h6_font_preview',
						'binding' => array(
							'field' => 'h6_font_face,h6_font_style,h6_font_weight,h6_font_color,h6_font_size,h6_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h6_font_face',
						'label' => esc_html__( 'H6 Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
						'default' => '{{first}}'
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h6_font_style',
						'label' => esc_html__( 'H6 Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h6_font_face',
									'value' => 'vp_get_gwf_style',
								),
							),
						),
						'default' => array(
							'{{first}}',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'h6_font_weight',
						'label' => esc_html__( 'H6 Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'h6_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'h6_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'h6_font_size',
						'label' => esc_html__( 'H6 Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'h6_line_height',
						'label' => esc_html__( 'H6 Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
		);
		return apply_filters( 'crazyblog_vp_opt_heading_', $return );
	}

}
