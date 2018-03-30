<?php

$general_meta_box = flow_elated_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'General',
        'name' => 'general_meta'
    )
);


    flow_elated_add_meta_box_field(
        array(
            'name' => 'eltd_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => 'Page Background Color',
            'description' => 'Choose background color for page content',
            'parent' => $general_meta_box
        )
    );
	
	flow_elated_add_meta_box_field(
		array(
			'name' => 'eltd_page_padding_meta',
			'type' => 'text',
			'default_value' => '',
			'label' => 'Page Padding',
			'description' => 'Insert padding in format 10px 10px 10px 10px',
			'parent' => $general_meta_box
		)
	);

    flow_elated_add_meta_box_field(
        array(
            'name' => 'eltd_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => 'Slider Shortcode',
            'description' => 'Paste your slider shortcode here',
            'parent' => $general_meta_box
        )
    );

    flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_page_transition_type',
            'type'        => 'selectblank',
            'label'       => 'Page Transition',
            'description' => 'Choose the type of transition to this page',
            'parent'      => $general_meta_box,
            'default_value' => '',
            'options'     => array(
                'no-animation' => 'No animation',
                'fade' => 'Fade'
            )
        )
    );

    flow_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_page_comments_meta',
            'type'        => 'selectblank',
            'label'       => 'Show Comments',
            'description' => 'Enabling this option will show comments on your page',
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );