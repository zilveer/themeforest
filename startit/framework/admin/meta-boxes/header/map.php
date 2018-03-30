<?php

$header_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);


$temp_holder_show = '';
$temp_holder_hide = '';
$temp_array_standard = array();
$temp_array_vertical = array();
$temp_array_full_screen = array();
$temp_array_overlapping = array();

switch (qode_startit_options()->getOptionValue('header_type')) {

    case 'header-standard':
        $temp_holder_show = '#qodef_qodef_header_standard_type_meta_container';
        $temp_holder_hide = '#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container';

        $temp_array_standard = array(
            'hidden_value' => 'default',
            'hidden_values' => array('header-vertical','header-full-screen','header-overlapping')
        );
        $temp_array_vertical = array(
            'hidden_values' => array('','header-standard','header-full-screen','header-overlapping')
        );
        $temp_array_full_screen = array(
            'hidden_values' => array('','header-standard','header-vertical','header-overlapping')
        );
        $temp_array_overlapping = array(
            'hidden_values' => array('', 'header-standard', 'header-vertical','header-full-screen')
        );
        break;

    case 'header-vertical':
        $temp_holder_show = '#qodef_qodef_header_vertical_type_meta_container';
        $temp_holder_hide = '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container';

        $temp_array_standard = array(
            'hidden_values' => array('', 'header-vertical', 'header-full-screen','header-overlapping')
        );
        $temp_array_vertical = array(
            'hidden_value' => 'default',
            'hidden_values' => array('header-standard','header-full-screen','header-overlapping')
        );
        $temp_array_full_screen = array(
            'hidden_values' => array('','header-standard', 'header-vertical','header-overlapping')
        );
        $temp_array_overlapping = array(
            'hidden_values' => array('', 'header-standard', 'header-vertical','header-full-screen')
        );
        break;
    case 'header-full-screen':
        $temp_holder_show = '#qodef_qodef_header_full_screen_type_meta_container';
        $temp_holder_hide = '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container';

        $temp_array_standard = array(
            'hidden_values' => array('', 'header-vertical', 'header-full-screen','header-overlapping')
        );

        $temp_array_vertical = array(
            'hidden_values' => array('', 'header-standard','header-full-screen','header-overlapping')
        );

        $temp_array_full_screen = array(
            'hidden_value' => 'default',
            'hidden_values' => array('header-standard', 'header-vertical','header-overlapping')
        );
        $temp_array_overlapping = array(
            'hidden_values' => array('', 'header-standard', 'header-vertical','header-full-screen')
        );
        break;

    case 'header-overlapping':
        $temp_holder_show = '#qodef_qodef_header_overlapping_type_meta_container';
        $temp_holder_hide = '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container';

        $temp_array_standard = array(
            'hidden_values' => array('','header-vertical','header-full-screen','header-overlapping')
        );
        $temp_array_vertical = array(
            'hidden_values' => array('','header-standard','header-full-screen','header-overlapping')
        );
        $temp_array_full_screen = array(
            'hidden_values' => array('','header-standard', 'header-vertical','header-overlapping')
        );
        $temp_array_overlapping = array(
            'hidden_value' => 'default',
            'hidden_values' => array('header-standard', 'header-vertical','header-full-screen')
        );
        break;
}

qode_startit_add_meta_box_field(
    array(
        'name' => 'header_type_meta',
        'type' => 'select',
        'default_value' => '',
        'label' => 'Choose Header Type',
        'description' => 'Select header type layout',
        'parent' => $header_meta_box,
        'options' => array(
            '' => 'Default',
            'header-standard' => 'Standard Header',
            'header-vertical' => 'Vertical Header',
            'header-overlapping' => 'Overlapping Header',
            'header-full-screen' => 'Full Screen Header'
        ),
        'args' => array(
            "dependence" => true,
            "hide" => array(
                "" => $temp_holder_hide,
                'header-standard' 		=> '#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container',
                'header-vertical' 		=> '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container',
                'header-full-screen'	=> '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_overlapping_type_meta_container',
                'header-overlapping' 		=> '#qodef_qodef_header_standard_type_meta_container,#qodef_qodef_header_vertical_type_meta_container,#qodef_qodef_header_full_screen_type_meta_container',
            ),
            "show" => array(
                "" => $temp_holder_show,
                "header-standard" 		=> '#qodef_qodef_header_standard_type_meta_container',
                "header-vertical" 		=> '#qodef_qodef_header_vertical_type_meta_container',
                "header-full-screen" 	=> '#qodef_qodef_header_full_screen_type_meta_container',
                "header-overlapping" 	=> '#qodef_qodef_header_overlapping_type_meta_container',
            )
        )
    )
);


    qode_startit_add_meta_box_field(
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

    qode_startit_add_meta_box_field(
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

$header_standard_type_meta_container = qode_startit_add_admin_container(
    array_merge(
        array(
            'parent' => $header_meta_box,
            'name' => 'qodef_header_standard_type_meta_container',
            'hidden_property' => 'header_type_meta',

        ),
        $temp_array_standard
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_color_header_standard_meta',
        'type' => 'color',
        'label' => 'Background Color',
        'description' => 'Choose a background color for header area',
        'parent' => $header_standard_type_meta_container
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_transparency_header_standard_meta',
        'type' => 'text',
        'label' => 'Background Transparency',
        'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
        'parent' => $header_standard_type_meta_container,
        'args' => array(
            'col_width' => 2
        )
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'menu_area_in_grid_header_standard_meta',
        'type' => 'select',
        'default_value' => '',
        'label' => 'Header in grid',
        'description' => 'Set header content to be in grid',
        'parent' => $header_standard_type_meta_container,
        'options' => array(
            ''		=> 'Default',
            'yes'	=> 'Yes',
            'no'	=> 'No'
        )
    )
);

$header_vertical_type_meta_container = qode_startit_add_admin_container(
    array_merge(
        array(
            'parent' => $header_meta_box,
            'name' => 'qodef_header_vertical_type_meta_container',
            'hidden_property' => 'header_type_meta'
        ),
        $temp_array_vertical
    )
);

qode_startit_add_meta_box_field(array(
    'name'        => 'qodef_vertical_header_background_color_meta',
    'type'        => 'color',
    'label'       => 'Background Color',
    'description' => 'Set background color for vertical menu',
    'parent'      => $header_vertical_type_meta_container
));

qode_startit_add_meta_box_field(array(
    'name'        => 'qodef_vertical_header_transparency_meta',
    'type'        => 'text',
    'label'       => 'Background Transparency',
    'description' => 'Enter transparency for vertical menu (value from 0 to 1)',
    'parent'      => $header_vertical_type_meta_container,
    'args'        => array(
        'col_width' => 1
    )
));

qode_startit_add_meta_box_field(
    array(
        'name'          => 'qodef_vertical_header_background_image_meta',
        'type'          => 'image',
        'default_value' => '',
        'label'         => 'Background Image',
        'description'   => 'Set background image for vertical menu',
        'parent'        => $header_vertical_type_meta_container
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_disable_vertical_header_background_image_meta',
        'type' => 'yesno',
        'default_value' => 'no',
        'label' => 'Disable Background Image',
        'description' => 'Enabling this option will hide background image in Vertical Menu',
        'parent' => $header_vertical_type_meta_container
    )
);

$header_overlapping_type_meta_container = qode_startit_add_admin_container(
    array_merge(
        array(
            'parent' => $header_meta_box,
            'name' => 'qodef_header_overlapping_type_meta_container',
            'hidden_property' => 'header_type_meta',

        ),
        $temp_array_overlapping
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_color_header_overlapping_meta',
        'type' => 'color',
        'label' => 'Wrapper Background Color',
        'description' => 'Choose a background color for Overlapping header area',
        'parent' => $header_overlapping_type_meta_container
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_transparency_header_overlapping_meta',
        'type' => 'text',
        'label' => 'Wrapper Background Transparency',
        'description' => 'Choose a transparency for the Overlapping header background color (0 = fully transparent, 1 = opaque)',
        'parent' => $header_overlapping_type_meta_container,
        'args' => array(
            'col_width' => 2
        )
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'menu_area_in_grid_header_overlapping_meta',
        'type' => 'select',
        'default_value' => '',
        'label' => 'Header in grid',
        'description' => 'Set Overlapping header content to be in grid',
        'parent' => $header_overlapping_type_meta_container,
        'options' => array(
            ''		=> 'Default',
            'yes'	=> 'Yes',
            'no'	=> 'No'
        )
    )
);

$header_full_screen_type_meta_container = qode_startit_add_admin_container(
    array_merge(
        array(
            'parent' => $header_meta_box,
            'name' => 'qodef_header_full_screen_type_meta_container',
            'hidden_property' => 'header_type_meta',
        ),
        $temp_array_full_screen
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_color_header_full_screen_meta',
        'type' => 'color',
        'label' => 'Background Color',
        'description' => 'Choose a background color for Full Screen header area',
        'parent' => $header_full_screen_type_meta_container
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'qodef_menu_area_background_transparency_header_full_screen_meta',
        'type' => 'text',
        'label' => 'Background Transparency',
        'description' => 'Choose a transparency for the Full Screen header background color (0 = fully transparent, 1 = opaque)',
        'parent' => $header_full_screen_type_meta_container,
        'args' => array(
            'col_width' => 2
        )
    )
);

qode_startit_add_meta_box_field(
    array(
        'name' => 'menu_area_in_grid_header_full_screen_meta',
        'type' => 'select',
        'default_value' => '',
        'label' => 'Header in grid',
        'description' => 'Set header content to be in grid',
        'parent' => $header_full_screen_type_meta_container,
        'options' => array(
            ''		=> 'Default',
            'yes'	=> 'Yes',
            'no'	=> 'No'
        )
    )
);


    qode_startit_add_meta_box_field(
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

    qode_startit_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'top_bar_meta',
            'default_value' => '',
            'label' => 'Enable Header top',
            'description' => 'Enabling this option will show top bar area',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );
if(qode_startit_options() -> getOptionValue('header_behaviour') == 'sticky-header-on-scroll-up' || qode_startit_options() -> getOptionValue('header_behaviour') == 'sticky-header-on-scroll-down-up') {
    qode_startit_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'sticky_header_in_grid_meta',
            'default_value' => '',
            'label' => 'Sticky Header in grid',
            'description' => 'Set sticky header to be in grid',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );
}

    qode_startit_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'search_in_grid_meta',
            'default_value' => '',
            'label'			=> 'Search area in grid',
            'description'	=> 'Set search area to be in grid',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );


