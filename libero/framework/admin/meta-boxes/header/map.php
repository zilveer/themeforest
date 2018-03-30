<?php

$header_meta_box = libero_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);
    libero_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_header_style_meta',
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

    libero_mikado_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'mkd_enable_header_style_on_scroll_meta',
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

    libero_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_top_menu_area_background_color_header_standard_meta',
            'type' => 'color',
            'label' => 'Top Menu Area Background Color',
            'description' => 'Choose a background color for header top menu area',
            'parent' => $header_meta_box
        )
    );

	libero_mikado_add_meta_box_field(
		array(
			'parent' => $header_meta_box,
			'type' => 'color',
			'name' => 'mkd_menu_area_background_color_header_standard_meta',
			'default_value' => '',
			'label' => 'Bottom Menu Area Background color',
			'description' => 'Set background color for header bottom menu area'
		)
	);


	libero_mikado_add_meta_box_field(array(
		'name' => 'mkd_sticky_header_background_color_meta',
		'type' => 'color',
		'label' => 'Sticky Background Color',
		'description' => 'Set background color for sticky header',
		'parent' => $header_meta_box
	));

    libero_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_sticky_header_transparency_meta',
            'type' => 'text',
            'label' => 'Sticky Header Transparency',
            'description' => 'Choose a transparency for sticky header background color (0 = fully transparent, 1 = opaque)',
            'parent' => $header_meta_box,
            'args' => array(
                'col_width' => 2
            )
        )
    );

    libero_mikado_add_meta_box_field(
        array(
            'name'            => 'mkd_scroll_amount_for_sticky_meta',
            'type'            => 'text',
            'label'           => 'Scroll amount for sticky header appearance',
            'description'     => 'Define scroll amount for sticky header appearance',
            'parent'          => $header_meta_box,
            'args'            => array(
                'col_width' => 2,
                'suffix'    => 'px'
            ),
            'hidden_property' => 'mkd_header_behaviour',
            'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
        )
    );
