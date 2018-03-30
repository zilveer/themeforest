<?php

class crazyblog_body_font_setting_menu {

	public $title = 'Body Font Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'toggle',
				'name' => 'body_custom_fonts',
				'label' => esc_html__( 'Use Custom Font', 'crazyblog' ),
				'description' => esc_html__( 'Use custom font or not', 'crazyblog' ),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'Body Custom Style', 'crazyblog' ),
				'name' => 'body_custom_style',
				'dependency' => array(
					'field' => 'body_custom_fonts',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'html',
						'name' => 'body_font_preview',
						'binding' => array(
							'field' => 'body_font_face,body_font_style,body_font_weight,body_font_color,body_font_size,body_line_height',
							'function' => 'vp_font_preview',
						),
					),
					array(
						'type' => 'select',
						'name' => 'body_font_face',
						'label' => esc_html__( 'Body Font Face', 'crazyblog' ),
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
						'name' => 'body_font_style',
						'label' => esc_html__( 'Body Font Style', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Style', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'body_font_face',
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
						'name' => 'body_font_weight',
						'label' => esc_html__( 'Body Font Weight', 'crazyblog' ),
						'description' => esc_html__( 'Select Font Weight', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'binding',
									'field' => 'body_font_face',
									'value' => 'vp_get_gwf_weight',
								),
							),
						),
					),
					array(
						'type' => 'color',
						'name' => 'body_font_color',
						'label' => esc_html__( 'Font Color', 'crazyblog' ),
						'description' => esc_html__( 'Color Picker, you can set the default color.', 'crazyblog' ),
						'default' => '#cf3a35',
					),
					array(
						'type' => 'slider',
						'name' => 'body_font_size',
						'label' => esc_html__( 'Body Font Size', 'crazyblog' ),
						'min' => '5',
						'max' => '100',
						'default' => '16',
					),
					array(
						'type' => 'slider',
						'name' => 'body_line_height',
						'label' => esc_html__( 'Body Line Height', 'crazyblog' ),
						'min' => '0',
						'max' => '100',
						'default' => '22',
					),
				),
			),
		);
		return apply_filters( 'crazyblog_vp_opt_body_font_', $return );
	}

}
