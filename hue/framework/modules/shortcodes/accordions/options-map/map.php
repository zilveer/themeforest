<?php
if(!function_exists('hue_mikado_accordions_map')) {
	/**
	 * Add Accordion options to elements panel
	 */
	function hue_mikado_accordions_map() {

		$panel = hue_mikado_add_admin_panel(array(
			'title' => esc_html__('Accordions', 'hue'),
			'name'  => 'panel_accordions',
			'page'  => '_elements_page'
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
			'description' => esc_html__('Setup typography for accordions navigation', 'hue'),
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
			'name'          => 'accordions_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'hue'),
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'accordions_text_transform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'hue'),
			'options'       => hue_mikado_get_text_transform_array()
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'accordions_font_style',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'hue'),
			'options'       => hue_mikado_get_font_style_array()
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'textsimple',
			'name'          => 'accordions_letter_spacing',
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
			'name'          => 'accordions_font_weight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'hue'),
			'options'       => hue_mikado_get_font_weight_array()
		));

		//Initial Accordion Color Styles

		hue_mikado_add_admin_section_title(array(
			'name'   => 'accordion_color_section_title',
			'title'  => esc_html__('Basic Accordions Color Styles', 'hue'),
			'parent' => $panel
		));

		$accordions_color_group = hue_mikado_add_admin_group(array(
			'name'        => 'accordions_color_group',
			'title'       => esc_html__('Accordion Color Styles', 'hue'),
			'description' => esc_html__('Set color styles for accordion title', 'hue'),
			'parent'      => $panel
		));
		$accordions_color_row   = hue_mikado_add_admin_row(array(
			'name'   => 'accordions_color_row',
			'next'   => true,
			'parent' => $accordions_color_group
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_title_color',
			'default_value' => '',
			'label'         => esc_html__('Title Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_icon_color',
			'default_value' => '',
			'label'         => esc_html__('Icon Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_icon_back_color',
			'default_value' => '',
			'label'         => esc_html__('Icon Background Color', 'hue')
		));

		$active_accordions_color_group = hue_mikado_add_admin_group(array(
			'name'        => 'active_accordions_color_group',
			'title'       => esc_html__('Active and Hover Accordion Color Styles', 'hue'),
			'description' => esc_html__('Set color styles for active and hover accordions', 'hue'),
			'parent'      => $panel
		));
		$active_accordions_color_row   = hue_mikado_add_admin_row(array(
			'name'   => 'active_accordions_color_row',
			'next'   => true,
			'parent' => $active_accordions_color_group
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $active_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_title_color_active',
			'default_value' => '',
			'label'         => esc_html__('Title Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $active_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_icon_color_active',
			'default_value' => '',
			'label'         => esc_html__('Icon Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $active_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'accordions_icon_back_color_active',
			'default_value' => '',
			'label'         => esc_html__('Icon Background Color', 'hue')
		));

		//Boxed Accordion Color Styles

		hue_mikado_add_admin_section_title(array(
			'name'   => 'boxed_accordion_color_section_title',
			'title'  => esc_html__('Boxed Accordion Title Color Styles', 'hue'),
			'parent' => $panel
		));
		$boxed_accordions_color_group = hue_mikado_add_admin_group(array(
			'name'        => 'boxed_accordions_color_group',
			'title'       => esc_html__('Boxed Accordion Title Color Styles', 'hue'),
			'description' => esc_html__('Set color styles for boxed accordion title', 'hue'),
			'parent'      => $panel
		));
		$boxed_accordions_color_row   = hue_mikado_add_admin_row(array(
			'name'   => 'boxed_accordions_color_row',
			'next'   => true,
			'parent' => $boxed_accordions_color_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_back_color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'hue')
		));

		//Active Boxed Accordion Color Styles

		$active_boxed_accordions_color_group = hue_mikado_add_admin_group(array(
			'name'        => 'active_boxed_accordions_color_group',
			'title'       => esc_html__('Active and Hover Title Color Styles', 'hue'),
			'description' => esc_html__('Set color styles for active and hover accordions', 'hue'),
			'parent'      => $panel
		));
		$active_boxed_accordions_color_row   = hue_mikado_add_admin_row(array(
			'name'   => 'active_boxed_accordions_color_row',
			'next'   => true,
			'parent' => $active_boxed_accordions_color_group
		));

		hue_mikado_add_admin_field(array(
			'parent'        => $active_boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_color_active',
			'default_value' => '',
			'label'         => esc_html__('Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $active_boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_back_color_active',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'hue')
		));
		hue_mikado_add_admin_field(array(
			'parent'        => $active_boxed_accordions_color_row,
			'type'          => 'colorsimple',
			'name'          => 'boxed_accordions_border_color_active',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'hue')
		));

	}

	add_action('hue_mikado_options_elements_map', 'hue_mikado_accordions_map', 11);
}