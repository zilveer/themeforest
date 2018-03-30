<?php

$header_meta_box = suprema_qodef_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);
    suprema_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_header_style_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Header Skin',
            'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'light-header' => 'Light',
                'dark-header' => 'Dark'
            )
        )
    );

    suprema_qodef_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'qodef_enable_header_style_on_scroll_meta',
            'default_value' => '',
            'label' => 'Enable Header Style on Scroll',
            'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );
	

    switch (suprema_qodef_options()->getOptionValue('header_type')) {
        case 'header-standard':

            suprema_qodef_add_meta_box_field(
                array(
                    'name' => 'qodef_menu_area_background_color_header_standard_meta',
                    'type' => 'color',
                    'label' => 'Background Color',
                    'description' => 'Choose a background color for header area',
                    'parent' => $header_meta_box
                )
            );

            suprema_qodef_add_meta_box_field(
                array(
                    'name' => 'qodef_menu_area_background_transparency_header_standard_meta',
                    'type' => 'text',
                    'label' => 'Transparency',
                    'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                    'parent' => $header_meta_box,
                    'args' => array(
                        'col_width' => 2
                    )
                )
            );

            break;

    }


        suprema_qodef_add_meta_box_field(
            array(
                'name'            => 'qodef_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => 'Scroll amount for sticky header appearance',
                'description'     => 'Define scroll amount for sticky header appearance',
                'parent'          => $header_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                ),
                'hidden_property' => 'qodef_header_behaviour',
                'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
            )
        );

	
	suprema_qodef_add_meta_box_field(
		array(
			'name' => 'qodef_top_bar_meta',
			'type' => 'select',
			'default_value' => '',
			'label' => 'Enable Top Bar',
			'description' => 'Enabling this option will show top bar area',
			'parent' => $header_meta_box,
			'options' => array(
                '' => '',
				'yes' => 'Yes',
                'no' => 'No'
                
            )
		)
	);
