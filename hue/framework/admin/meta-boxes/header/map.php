<?php

$header_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Header', 'hue'),
        'name'  => 'header_meta'
    )
);

$temp_holder_show             = '';
$temp_holder_hide             = '';
$temp_array_standard          = array();
$temp_array_standard_extended = array();
$temp_array_box               = array();
$temp_array_divided           = array();
$temp_array_minimal           = array();
$temp_array_centered          = array();
$temp_array_vertical          = array();
$temp_array_top_header        = array();
$temp_array_behaviour         = array();
switch(hue_mikado_options()->getOptionValue('header_type')) {

    case 'header-standard':
        $temp_holder_show = '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-standard-extended':
        $temp_holder_show = '#mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-box':
        $temp_holder_show = '#mkd_mkd_header_box_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-box'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;


    case 'header-minimal':
        $temp_holder_show = '#mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-divided':
        $temp_holder_show = '#mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );


        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-centered':
        $temp_holder_show = '#mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-vertical':
        $temp_holder_show = '#mkd_mkd_header_vertical_type_meta_container';
        $temp_holder_hide = '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_behaviour_meta, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-standard',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('', 'header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value'  => 'default',
            'hidden_values' => array('', 'header-vertical')
        );
        break;
}

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_header_type_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Choose Header Type', 'hue'),
        'description'   => esc_html__('Select header type layout', 'hue'),
        'parent'        => $header_meta_box,
        'options'       => array(
            ''                         => 'Default',
            'header-standard'          => esc_html__('Standard Header', 'hue'),
            'header-standard-extended' => esc_html__('Standard Extended Header', 'hue'),
            'header-box'               => esc_html__('"In The Box" Header', 'hue'),
            'header-minimal'           => esc_html__('Minimal Header', 'hue'),
            'header-divided'           => esc_html__('Divided Header', 'hue'),
            'header-centered'          => esc_html__('Centered Header', 'hue'),
            'header-vertical'          => esc_html__('Vertical Header', 'hue')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""                         => $temp_holder_hide,
                'header-standard'          => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-standard-extended' => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-box'               => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_standard_type_meta_container',
                'header-minimal'           => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-divided'           => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-centered'          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-vertical'          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container'
            ),
            "show"       => array(
                ""                         => $temp_holder_show,
                "header-standard"          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-standard-extended" => '#mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-box"               => '#mkd_mkd_header_box_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-minimal"           => '#mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                'header-divided'           => '#mkd_mkd_header_divided_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                'header-centered'          => '#mkd_mkd_header_centered_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-vertical"          => '#mkd_mkd_header_vertical_type_meta_container'
            )
        )
    )
);

hue_mikado_add_meta_box_field(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'type'            => 'select',
            'name'            => 'mkd_header_behaviour_meta',
            'default_value'   => '',
            'label'           => esc_html__('Choose Header behaviour', 'hue'),
            'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'hue'),
            'options'         => array(
                ''                                => '',
                'no-behavior'                     => esc_html__('No Behavior', 'hue'),
                'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'hue'),
                'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'hue'),
                'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'hue')
            ),
            'hidden_property' => 'mkd_header_type_meta',
            'hidden_value'    => '',
            'args'            => array(
                'dependence' => true,
                'show'       => array(
                    ''                                => '',
                    'sticky-header-on-scroll-up'      => '',
                    'sticky-header-on-scroll-down-up' => '#mkd_mkd_sticky_amount_container_meta_container',
                    'no-behavior'                     => ''
                ),
                'hide'       => array(
                    ''                                => '#mkd_mkd_sticky_amount_container_meta_container',
                    'sticky-header-on-scroll-up'      => '#mkd_mkd_sticky_amount_container_meta_container',
                    'sticky-header-on-scroll-down-up' => '',
                    'no-behavior'                     => '#mkd_mkd_sticky_amount_container_meta_container'
                )
            )
        ),
        $temp_array_behaviour
    )
);

$sticky_amount_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $header_meta_box,
        'name'            => 'mkd_sticky_amount_container_meta_container',
        'hidden_property' => 'mkd_header_behaviour_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('', 'no-behavior', 'sticky-header-on-scroll-up'),
    )
);

$sticky_amount_group = hue_mikado_add_admin_group(array(
    'name'        => 'sticky_amount_group',
    'title'       => esc_html__('Scroll Amount for Sticky Header Appearance', 'hue'),
    'parent'      => $sticky_amount_container,
    'description' => esc_html__('Enter the amount of pixels for sticky header appearance, or set browser height to "Yes" for predefined sticky header appearance amount', 'hue')
));

$sticky_amount_row = hue_mikado_add_admin_row(array(
    'name'   => 'sticky_amount_group',
    'parent' => $sticky_amount_group
));

hue_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_scroll_amount_for_sticky_meta',
        'type'   => 'textsimple',
        'label'  => esc_html__('Amount in px', 'hue'),
        'parent' => $sticky_amount_row,
        'args'   => array(
            'suffix' => 'px'
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_scroll_amount_for_sticky_fullscreen_meta',
        'type'          => 'yesnosimple',
        'label'         => esc_html__('Browser Height', 'hue'),
        'default_value' => 'no',
        'parent'        => $sticky_amount_row
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_header_style_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Header Skin', 'hue'),
        'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'hue'),
        'parent'        => $header_meta_box,
        'options'       => array(
            ''             => '',
            'light-header' => esc_html__('Light', 'hue'),
            'dark-header'  => esc_html__('Dark', 'hue')
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'parent'        => $header_meta_box,
        'type'          => 'select',
        'name'          => 'mkd_enable_header_style_on_scroll_meta',
        'default_value' => '',
        'label'         => esc_html__('Enable Header Style on Scroll', 'hue'),
        'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'hue'),
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html__('Yes', 'hue')
        )
    )
);

$header_standard_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_standard_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_standard
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'hue'),
    'description'   => esc_html__('Set header content to be in grid', 'hue'),
    'parent'        => $header_standard_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_standard_container',
            'no'  => '#mkd_menu_area_in_grid_header_standard_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_standard_container'
        )
    )
));

$menu_area_in_grid_header_standard_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_standard_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_standard_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for header area', 'hue'),
        'parent'      => $menu_area_in_grid_header_standard_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_standard_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $menu_area_in_grid_header_standard_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $menu_area_in_grid_header_standard_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_standard_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_standard_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_standard_container'
        )
    )
));

$menu_area_in_grid_border_header_standard_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_standard_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_standard_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $menu_area_in_grid_border_header_standard_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_standard_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for header area', 'hue'),
        'parent'      => $header_standard_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_standard_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_standard_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'hue'),
    'description'   => esc_html__('Set border on header area', 'hue'),
    'parent'        => $header_standard_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_standard_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of header bottom border', 'hue'),
    'parent'      => $border_bottom_color_container
));


$header_minimal_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_minimal_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_minimal
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'hue'),
    'description'   => esc_html__('Set header content to be in grid', 'hue'),
    'parent'        => $header_minimal_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_minimal_container',
            'no'  => '#mkd_menu_area_in_grid_header_minimal_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_minimal_container'
        )
    )
));

$menu_area_in_grid_header_minimal_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_minimal_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_minimal_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for header area', 'hue'),
        'parent'      => $menu_area_in_grid_header_minimal_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_minimal_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $menu_area_in_grid_header_minimal_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $menu_area_in_grid_header_minimal_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_minimal_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_minimal_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_minimal_container'
        )
    )
));

$menu_area_in_grid_border_header_minimal_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_minimal_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_minimal_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $menu_area_in_grid_border_header_minimal_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_minimal_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for header area', 'hue'),
        'parent'      => $header_minimal_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_minimal_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_minimal_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'hue'),
    'description'   => esc_html__('Set border on header area', 'hue'),
    'parent'        => $header_minimal_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_minimal_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_minimal_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of header bottom border', 'hue'),
    'parent'      => $border_bottom_color_minimal_container
));

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_fullscreen_menu_background_image_meta',
        'type'          => 'image',
        'default_value' => '',
        'label'         => esc_html__('Fullscreen Background Image', 'hue'),
        'description'   => esc_html__('Set background image for Fullscreen Menu', 'hue'),
        'parent'        => $header_minimal_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_disable_fullscreen_menu_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Fullscreen Background Image', 'hue'),
        'description'   => esc_html__('Enabling this option will hide background image in Fullscreen Menu', 'hue'),
        'parent'        => $header_minimal_type_meta_container
    )
);

$header_divided_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_divided_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_divided
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'hue'),
    'description'   => esc_html__('Set header content to be in grid', 'hue'),
    'parent'        => $header_divided_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_divided_container',
            'no'  => '#mkd_menu_area_in_grid_header_divided_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_divided_container'
        )
    )
));

$menu_area_in_grid_header_divided_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_divided_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_divided_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for header area', 'hue'),
        'parent'      => $menu_area_in_grid_header_divided_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_divided_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $menu_area_in_grid_header_divided_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $menu_area_in_grid_header_divided_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_divided_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_divided_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_divided_container'
        )
    )
));

$menu_area_in_grid_border_header_divided_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_divided_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_divided_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $menu_area_in_grid_border_header_divided_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_divided_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for header area', 'hue'),
        'parent'      => $header_divided_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_divided_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_divided_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'hue'),
    'description'   => esc_html__('Set border on header area', 'hue'),
    'parent'        => $header_divided_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_divided_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_divided_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of header bottom border', 'hue'),
    'parent'      => $border_bottom_color_divided_container
));


$header_centered_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_centered_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_centered
    )
);

hue_mikado_add_admin_section_title(array(
    'name'   => 'logo_area_centered_title',
    'parent' => $header_centered_type_meta_container,
    'title'  => esc_html__('Logo Area', 'hue')
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area In Grid', 'hue'),
    'description'   => esc_html__('Set logo area content to be in grid', 'hue'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_header_centered_container',
            'no'  => '#mkd_logo_area_in_grid_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_header_centered_container'
        )
    )
));

$logo_area_in_grid_header_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_header_centered_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_logo_area_in_grid_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for logo area', 'hue'),
        'parent'      => $logo_area_in_grid_header_centered_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $logo_area_in_grid_header_centered_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $logo_area_in_grid_header_centered_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_border_header_centered_container',
            'no'  => '#mkd_logo_area_in_grid_border_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_border_header_centered_container'
        )
    )
));

$logo_area_in_grid_border_header_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_border_header_centered_container',
    'parent'          => $logo_area_in_grid_header_centered_container,
    'hidden_property' => 'mkd_logo_area_in_grid_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_logo_area_in_grid_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $logo_area_in_grid_border_header_centered_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for logo area', 'hue'),
        'parent'      => $header_centered_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_centered_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area Border', 'hue'),
    'description'   => esc_html__('Set border on logo area', 'hue'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_border_bottom_color_container',
            'no'  => '#mkd_logo_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_border_bottom_color_container'
        )
    )
));

$border_bottom_color_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_border_bottom_color_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_logo_area_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_logo_area_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of logo area bottom border', 'hue'),
    'parent'      => $border_bottom_color_centered_container
));

hue_mikado_add_admin_section_title(array(
    'name'   => 'menu_area_centered_title',
    'parent' => $header_centered_type_meta_container,
    'title'  => esc_html__('Menu Area', 'hue')
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area In Grid', 'hue'),
    'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_centered_container',
            'no'  => '#mkd_menu_area_in_grid_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_centered_container'
        )
    )
));

$menu_area_in_grid_header_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_centered_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for menu area', 'hue'),
        'parent'      => $menu_area_in_grid_header_centered_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $menu_area_in_grid_header_centered_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $menu_area_in_grid_header_centered_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_centered_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_centered_container'
        )
    )
));

$menu_area_in_grid_border_header_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_centered_container',
    'parent'          => $menu_area_in_grid_header_centered_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $menu_area_in_grid_border_header_centered_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for menu area', 'hue'),
        'parent'      => $header_centered_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_centered_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area Border', 'hue'),
    'description'   => esc_html__('Set border on menu area', 'hue'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_border_bottom_color_container',
            'no'  => '#mkd_menu_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_border_bottom_color_container'
        )
    )
));

$border_bottom_color_centered_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_border_bottom_color_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of menu area bottom border', 'hue'),
    'parent'      => $border_bottom_color_centered_container
));


$header_standard_extended_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_standard_extended_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_standard_extended
    )
);

hue_mikado_add_admin_section_title(array(
    'name'   => 'logo_area_standard_extended_title',
    'parent' => $header_standard_extended_type_meta_container,
    'title'  => esc_html__('Logo Area', 'hue')
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area In Grid', 'hue'),
    'description'   => esc_html__('Set logo area content to be in grid', 'hue'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_header_standard_extended_container',
            'no'  => '#mkd_logo_area_in_grid_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_header_standard_extended_container'
        )
    )
));

$logo_area_in_grid_header_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_header_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_logo_area_in_grid_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for logo area', 'hue'),
        'parent'      => $logo_area_in_grid_header_standard_extended_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $logo_area_in_grid_header_standard_extended_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $logo_area_in_grid_header_standard_extended_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_border_header_standard_extended_container',
            'no'  => '#mkd_logo_area_in_grid_border_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_border_header_standard_extended_container'
        )
    )
));

$logo_area_in_grid_border_header_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_border_header_standard_extended_container',
    'parent'          => $logo_area_in_grid_header_standard_extended_container,
    'hidden_property' => 'mkd_logo_area_in_grid_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_logo_area_in_grid_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $logo_area_in_grid_border_header_standard_extended_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for logo area', 'hue'),
        'parent'      => $header_standard_extended_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_standard_extended_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_logo_area_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area Border', 'hue'),
    'description'   => esc_html__('Set border on logo area', 'hue'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_border_bottom_color_standard_extended_container',
            'no'  => '#mkd_logo_border_bottom_color_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_border_bottom_color_standard_extended_container'
        )
    )
));

$border_bottom_color_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_border_bottom_color_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_logo_area_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_logo_area_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of logo area bottom border', 'hue'),
    'parent'      => $border_bottom_color_standard_extended_container
));

hue_mikado_add_admin_section_title(array(
    'name'   => 'menu_area_standard_extended_title',
    'parent' => $header_standard_extended_type_meta_container,
    'title'  => esc_html__('Menu Area', 'hue')
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area In Grid', 'hue'),
    'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_standard_extended_container',
            'no'  => '#mkd_menu_area_in_grid_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_standard_extended_container'
        )
    )
));

$menu_area_in_grid_header_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for menu area', 'hue'),
        'parent'      => $menu_area_in_grid_header_standard_extended_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'hue'),
        'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $menu_area_in_grid_header_standard_extended_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'hue'),
    'description'   => esc_html__('Set border on grid area', 'hue'),
    'parent'        => $menu_area_in_grid_header_standard_extended_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_standard_extended_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_standard_extended_container'
        )
    )
));

$menu_area_in_grid_border_header_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_standard_extended_container',
    'parent'          => $menu_area_in_grid_header_standard_extended_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Set border color for grid area', 'hue'),
    'parent'      => $menu_area_in_grid_border_header_standard_extended_container
));


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for menu area', 'hue'),
        'parent'      => $header_standard_extended_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'hue'),
        'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'hue'),
        'parent'      => $header_standard_extended_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area Border', 'hue'),
    'description'   => esc_html__('Set border on menu area', 'hue'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_border_bottom_color_standard_extended_container',
            'no'  => '#mkd_menu_border_bottom_color_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_border_bottom_color_standard_extended_container'
        )
    )
));

$border_bottom_color_standard_extended_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_border_bottom_color_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color of menu area bottom border', 'hue'),
    'parent'      => $border_bottom_color_standard_extended_container
));


$header_box_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_box_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_box_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Set grid background color for header area', 'hue'),
        'parent'      => $header_box_type_meta_container
    )
);

$top_bar_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_top_bar_container_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_top_header
    )
);

hue_mikado_add_admin_section_title(array(
    'name'   => 'top_bar_section_title',
    'parent' => $top_bar_container,
    'title'  => esc_html__('Top Bar', 'hue')
));

$top_bar_global_option = hue_mikado_options()->getOptionValue('top_bar');

$top_bar_default_dependency = array(
    '' => '#mkd_top_bar_container_no_style'
);

$top_bar_show_array = array(
    'yes' => '#mkd_top_bar_container_no_style'
);

$top_bar_hide_array = array(
    'no' => '#mkd_top_bar_container_no_style'
);

if($top_bar_global_option === 'yes') {
    $top_bar_show_array           = array_merge($top_bar_show_array, $top_bar_default_dependency);
    $top_bar_container_hide_array = array('no');
} else {
    $top_bar_hide_array           = array_merge($top_bar_hide_array, $top_bar_default_dependency);
    $top_bar_container_hide_array = array('', 'no');
}


hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_top_bar_meta',
    'type'          => 'select',
    'label'         => esc_html__('Enable Top Bar on This Page', 'hue'),
    'description'   => esc_html__('Enabling this option will enable top bar on this page', 'hue'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'hue'),
        'yes' => esc_html__('Yes', 'hue'),
        'no'  => esc_html__('No', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'show'       => $top_bar_show_array,
        'hide'       => $top_bar_hide_array
    )
));

$top_bar_container = hue_mikado_add_admin_container_no_style(array(
    'name'            => 'top_bar_container_no_style',
    'parent'          => $top_bar_container,
    'hidden_property' => 'mkd_top_bar_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => $top_bar_container_hide_array
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_top_bar_in_grid_meta',
    'type'          => 'select',
    'label'         => esc_html__('Top Bar In Grid', 'hue'),
    'description'   => esc_html__('Set top bar content to be in grid', 'hue'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    )
));

hue_mikado_add_meta_box_field(array(
    'name'    => 'mkd_top_bar_skin_meta',
    'type'    => 'select',
    'label'   => esc_html__('Top Bar Skin', 'hue'),
    'options' => array(
        ''      => esc_html__('Default', 'hue'),
        'light' => esc_html__('White', 'hue'),
        'dark'  => esc_html__('Black', 'hue'),
        'gray'  => esc_html__('Gray', 'hue'),
    ),
    'parent'  => $top_bar_container
));

hue_mikado_add_meta_box_field(array(
    'name'   => 'mkd_top_bar_background_color_meta',
    'type'   => 'color',
    'label'  => esc_html__('Top Bar Background Color', 'hue'),
    'parent' => $top_bar_container
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_top_bar_background_transparency_meta',
    'type'        => 'text',
    'label'       => esc_html__('Top Bar Background Color Transparency', 'hue'),
    'description' => esc_html__('Set top bar background color transparenct. Value should be between 0 and 1', 'hue'),
    'parent'      => $top_bar_container,
    'args'        => array(
        'col_width' => 3
    )
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_top_bar_border_meta',
    'type'          => 'select',
    'label'         => esc_html__('Top Bar Border', 'hue'),
    'description'   => esc_html__('Set border on top bar', 'hue'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'hue'),
        'yes' => esc_html__('Yes', 'hue')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_top_bar_border_container',
            'no'  => '#mkd_top_bar_border_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_top_bar_border_container'
        )
    )
));

$top_bar_border_container = hue_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'top_bar_border_container',
    'parent'          => $top_bar_container,
    'hidden_property' => 'mkd_top_bar_border_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_top_bar_border_color_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'hue'),
    'description' => esc_html__('Choose color for top bar border', 'hue'),
    'parent'      => $top_bar_border_container
));

$header_vertical_type_meta_container = hue_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_vertical_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta'
        ),
        $temp_array_vertical
    )
);

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_vertical_header_background_color_meta',
    'type'        => 'color',
    'label'       => esc_html__('Background Color', 'hue'),
    'description' => esc_html__('Set background color for vertical menu', 'hue'),
    'parent'      => $header_vertical_type_meta_container
));

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_vertical_header_background_image_meta',
        'type'          => 'image',
        'default_value' => '',
        'label'         => esc_html__('Background Image', 'hue'),
        'description'   => esc_html__('Set background image for vertical menu', 'hue'),
        'parent'        => $header_vertical_type_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_disable_vertical_header_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Background Image', 'hue'),
        'description'   => esc_html__('Enabling this option will hide background image in Vertical Menu', 'hue'),
        'parent'        => $header_vertical_type_meta_container
    )
);

