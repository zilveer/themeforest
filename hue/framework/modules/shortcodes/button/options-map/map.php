<?php

if(!function_exists('hue_mikado_button_map')) {
	function hue_mikado_button_map() {
		$panel = hue_mikado_add_admin_panel(array(
			'title' => esc_html__('Button', 'hue'),
			'name'  => 'panel_button',
			'page'  => '_elements_page'
		));

		hue_mikado_add_admin_field(array(
			'name'        => 'button_hover_animation',
			'type'        => 'select',
			'label'       => esc_html__('Hover Animation', 'hue'),
			'description' => esc_html__('Choose default hover animation type', 'hue'),
			'parent'      => $panel,
			'options'     => hue_mikado_get_btn_hover_animation_types()
		));

		//Typography options
		hue_mikado_add_admin_section_title(array(
			'name'   => 'typography_section_title',
			'title'  => esc_html__('Typography', 'hue'),
			'parent' => $panel
		));

		$typography_group = hue_mikado_add_admin_group(array(
			'name'        => 'typography_group',
			'title'       => esc_html__('Typography', 'hue'),
			'description' => esc_html__('Setup typography for all button types', 'hue'),
			'parent'      => $panel
		));

		$typography_row = hue_mikado_add_admin_row(array(
			'name'   => 'typography_row',
			'next'   => true,
			'parent' => $typography_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'fontsimple',
			'name'          => 'button_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'hue'),
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_text_transform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'hue'),
			'options'       => hue_mikado_get_text_transform_array()
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_font_style',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'hue'),
			'options'       => hue_mikado_get_font_style_array()
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'textsimple',
			'name'          => 'button_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'hue'),
			'args'          => array(
				'suffix' => 'px'
			)
		));

		$typography_row2 = hue_mikado_add_admin_row(array(
			'name'   => 'typography_row2',
			'next'   => true,
			'parent' => $typography_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row2,
			'type'          => 'selectsimple',
			'name'          => 'button_font_weight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'hue'),
			'options'       => hue_mikado_get_font_weight_array()
		));

		//Outline type options
		hue_mikado_add_admin_section_title(array(
			'name'   => 'type_section_title',
			'title'  => esc_html__('Types', 'hue'),
			'parent' => $panel
		));

		$outline_group = hue_mikado_add_admin_group(array(
			'name'        => 'outline_group',
			'title'       => esc_html__('Outline Type', 'hue'),
			'description' => esc_html__('Setup outline button type', 'hue'),
			'parent'      => $panel
		));

		$outline_row = hue_mikado_add_admin_row(array(
			'name'   => 'outline_row',
			'next'   => true,
			'parent' => $outline_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'hue'),
			'description'   => ''
		));

		$outline_row2 = hue_mikado_add_admin_row(array(
			'name'   => 'outline_row2',
			'next'   => true,
			'parent' => $outline_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $outline_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'hue'),
			'description'   => ''
		));

		//Solid type options
		$solid_group = hue_mikado_add_admin_group(array(
			'name'        => 'solid_group',
			'title'       => esc_html__('Solid Type', 'hue'),
			'description' => esc_html__('Setup solid button type', 'hue'),
			'parent'      => $panel
		));

		$solid_row = hue_mikado_add_admin_row(array(
			'name'   => 'solid_row',
			'next'   => true,
			'parent' => $solid_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'hue'),
			'description'   => ''
		));

		$solid_row2 = hue_mikado_add_admin_row(array(
			'name'   => 'solid_row2',
			'next'   => true,
			'parent' => $solid_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'hue'),
			'description'   => ''
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'hue'),
			'description'   => ''
		));
	}

	add_action('hue_mikado_options_elements_map', 'hue_mikado_button_map');
}