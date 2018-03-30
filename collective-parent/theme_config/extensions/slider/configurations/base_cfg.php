<?php
/**
 * Basic slider configurations
 *
 * @since  Collective 1.0
 */

global $TFUSE;
$cfg['valid_types'] = $TFUSE->ext->slider->valid_types;

$cfg['setup'] = array(
    array(
        'design' => 'carousel',
        'name' => __('Carousel','tfuse')

    ),
    array(
        'design' => 'image_video',
        'name' => __('Image & Video','tfuse')
    )
);

   $cfg['slider_type_names'] = array(
        'custom' => __('Manually, I\'ll upload the images myself','tfuse'),
        'categories' => __('Automatically, fetch images from categories','tfuse'),
        'tags' => __('Automatically, fetch images by tags','tfuse'),
        'posts' => __('Automatically, fetch images from posts','tfuse')
    );
//*********************
$type_select = array('' => 'Choose your slider type');
if (isset($cfg['valid_types']) && count($cfg['valid_types']) > 0) {
    $tmp = array_intersect($TFUSE->ext->slider->valid_types, $cfg['valid_types']);
    if (count($tmp) > 0)
        foreach ($tmp as $type)
            $type_select[$type] = $cfg['slider_type_names'][$type];
}

//*********************

$cfg['add_new_slider'] = array(
    'tabs' => array(
        array(
            'name' => __('Add New Slider','tfuse'),
            'id' => 'add_new_slider', #do not change id
            'headings' => array(
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Slider Type','tfuse'),
                            'desc' => __('Choose the slider type. You can check the sliders in the <a target="_black" href="http://themefuse.com/demo/wp/medica/">demo live preview</a> on our website.','tfuse'),
                            'id' => 'slider_design_type',
                            'value' => '',
                            'type' => 'callback',
                            'callback' => array(&$TFUSE->ext->slider, 'slider_design_callback')
                        ),
                        array(
                            'name' => __('Slider Population Method','tfuse'),
                            'desc' => __('The images from the slider can be uploaded manually or you can choose to automatically take them from posts, tags or categories.','tfuse'),
                            'id' => 'slider_type',
                            'value' => 'none',
                            'options' => $type_select,
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Slider Title','tfuse'),
                            'desc' => __('Choose a title for your slider only for internal use: Ex: "Homepage".','tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'required' => TRUE
                        )
                    )
                )
            )
        )
    )
);

$cfg['slider_design_and_type'] = array(
    array(
        'name' => __('Slider Design','tfuse'),
        'desc' => __('This is the design of your slider. It can\'t be changed. If you need another design please create a new slider.','tfuse'),
        'id' => 'slider_design_chosen',
        'value' => '',
        'type' => 'callback',
        'callback' => array(&$TFUSE->ext->slider, 'slider_design_chosen_callback')
    ),
    array(
        'name' => __('Slider Type','tfuse'),
        'desc' => __('This is the method of populating the slider and can\'t be changed. You\'ll need to create a different slider if you want a different type of population method.','tfuse'),
        'id' => 'slider_type_chosen',
        'value' => '',
        'type' => 'callback',
        'callback' => array(&$TFUSE->ext->slider, 'slider_type_chosen_callback')
    )
);

$cfg['slider_framebox'] = array(
    'name' => __('Drag/Click slides to Rearrange/Edit','tfuse'),
    'options' => array(
        array(
            'name' => __('Framebox','tfuse'),
            'desc' => __('Framebox description','tfuse'),
            'id' => TF_THEME_PREFIX . '_slider_framebox',
            'value' => '',
            'type' => 'callback',
            'callback' => 'framebox'
        )
    )
);

$cfg['settings'] = array(
    'tab_includes' => array(
        'common' => array(
            'slider_settings'
        ),
        'custom' => array(
            'slider_setup'
        ),
        'categories' => array(
            'slider_type_categories'
        ),
        'posts' => array(
            'slider_type_posts'
        ),
        'tags' => array(
            'slider_type_tags'
        )
    ),
    'extra' => array(
        'custom' => array(
            'slide_src' => 'slide_src',
            'slide_prefix' => 'slide_',
            'slide_title' => 'slide_title'
        )
    )
);

$cfg['extra_options'] = array();
