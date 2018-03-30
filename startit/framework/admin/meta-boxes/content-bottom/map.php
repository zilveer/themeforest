<?php

$content_bottom_meta_box = qode_startit_add_meta_box(
	array(
		'scope' => array('page', 'portfolio-item', 'post'),
		'title' => 'Content Bottom',
		'name' => 'content_meta'
	)
);

	qode_startit_add_meta_box_field(
		array(
			'name' => 'qodef_enable_content_bottom_area_meta',
			'type' => 'selectblank',
			'default_value' => '',
			'label' => 'Enable Content Bottom Area',
			'description' => 'This option will enable Content Bottom area on pages',
			'parent' => $content_bottom_meta_box,
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			'args' => array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_qodef_show_content_bottom_meta_container',
					'no' => '#qodef_qodef_show_content_bottom_meta_container'
				),
				'show' => array(
					'yes' => '#qodef_qodef_show_content_bottom_meta_container'
				)
			)
		)
	);

	$show_content_bottom_meta_container = qode_startit_add_admin_container(
		array(
			'parent' => $content_bottom_meta_box,
			'name' => 'qodef_show_content_bottom_meta_container',
			'hidden_property' => 'qodef_enable_content_bottom_area_meta',
			'hidden_value' => '',
			'hidden_values' => array('','no')
		)
	);

		qode_startit_add_meta_box_field(
			array(
				'name' => 'qodef_content_bottom_sidebar_custom_display_meta',
				'type' => 'selectblank',
				'default_value' => '',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a Content Bottom sidebar to display',
				'options' => qode_startit_get_custom_sidebars(),
				'parent' => $show_content_bottom_meta_container
			)
		);

		qode_startit_add_meta_box_field(
			array(
				'type' => 'selectblank',
				'name' => 'qodef_content_bottom_in_grid_meta',
				'default_value' => '',
				'label' => 'Display in Grid',
				'description' => 'Enabling this option will place Content Bottom in grid',
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes'
				),
				'parent' => $show_content_bottom_meta_container
			)
		);

		qode_startit_add_meta_box_field(
			array(
				'type' => 'color',
				'name' => 'qodef_content_bottom_background_color_meta',
				'default_value' => '',
				'label' => 'Background Color',
				'description' => 'Choose a background color for Content Bottom area',
				'parent' => $show_content_bottom_meta_container
			)
		);