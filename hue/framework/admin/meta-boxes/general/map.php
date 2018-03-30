<?php

$general_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('General', 'hue'),
        'name'  => 'general_meta'
    )
);


hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_background_color_meta',
        'type'          => 'color',
        'default_value' => '',
        'label'         => esc_html__('Page Background Color', 'hue'),
        'description'   => esc_html__('Choose background color for page content', 'hue'),
        'parent'        => $general_meta_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_padding_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Page Padding', 'hue'),
        'description'   => esc_html__('Insert padding in format 10px 10px 10px 10px', 'hue'),
        'parent'        => $general_meta_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_content_behind_header_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Always put content behind header', 'hue'),
        'description'   => esc_html__('Enabling this option will put page content behind page header', 'hue'),
        'parent'        => $general_meta_box,
        'args'          => array(
            'suffix' => 'px'
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_slider_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Slider Shortcode', 'hue'),
        'description'   => esc_html__('Paste your slider shortcode here', 'hue'),
        'parent'        => $general_meta_box
    )
);

if(hue_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'yes') {
    hue_mikado_add_meta_box_field(
        array(
            'name'          => 'mkd_page_transition_type',
            'type'          => 'selectblank',
            'label'         => esc_html__('Page Transition', 'hue'),
            'description'   => esc_html__('Choose the type of transition to this page', 'hue'),
            'parent'        => $general_meta_box,
            'default_value' => '',
            'options'       => array(
                'no-animation' => esc_html__('No animation', 'hue'),
                'fade'         => esc_html__('Fade', 'hue')
            )
        )
    );
}

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_page_likes_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Likes', 'hue'),
        'description' => esc_html__('Enabling this option will show likes on your page', 'hue'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'hue'),
            'no'  => esc_html__('No', 'hue'),
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_page_comments_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Comments', 'hue'),
        'description' => esc_html__('Enabling this option will show comments on your page', 'hue'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'hue'),
            'no'  => esc_html__('No', 'hue'),
        )
    )
);