<?php
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'popup_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Popup Setting','mango'),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'page', 'post', 'portfolio', 'clients', 'product','faq','testimonial' ),
// Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
// Order of meta box: high (default), low. Optional.
    'priority' => 'low',
// Auto save: true, false (default). Optional.
    'autosave' => true,
// List of meta fields
    'fields' => array (
        array (
            'type' => 'heading',
            'name' => __ ( 'Popup Settings', 'mango' ),
            'id' => 'mango_popup_settings',
        ),
        array(
            'name' => __('Popup', 'mango'),
            'desc' => __('Enable Or Disable Popup on the page.', 'mango'),
            'id' => $prefix.'popup_e_d',
            'type' => 'select_advanced',
            'std' => 'off',
            'options' => array(
                'off'=>'Disable',
                'on'=> 'Enable'
            ),
        ),
        array(
            'name' => __('Popup Title', 'mango'),
            'desc' => '',
            'id' => $prefix.'popup_title',
            'type' => 'text',
            'std' => '',
            'placeholder' => 'popup title here'
        ),
        array(
            'name' => __('Description', 'mango'),
            'desc' => '',
            'id' => $prefix.'popup_desc',
            'type' => 'wysiwyg',
            'raw'  => false,
            'std' => '',
            'setting' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            )
        ),
        array(
            'name' => __('Select Background Image', 'mango'),
            'desc' => __('Choose a background image for popup.', 'mango'),
            'id' => $prefix.'popup_image',
            'std' => '',
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
        ),
        array (
            'name' => __ ( 'Background Color', 'mango' ),
            'id' => "{$prefix}popup_bg_color",
            'type' => 'color',
            //   'std' => '#4f94c8'
        ),
        array(
            'id' => "{$prefix}popup_bg_repeat",
            'type'     => 'select_advanced',
            'name'    => __('Background Repeat', 'mango'),
            'options'  => array(
                'no-repeat' => __("No Repeat","mango"),
                'repeat'    => __("Repeat All","mango"),
                'repeat-x'  => __("Repeat Horizontally","mango"),
                'repeat-y'  => __("Repeat Vertically","mango"),
                'inherit'   => __("Inherit","mango"),
            ),
            'placeholder'  => __('Background Repeat','mango'),
        ),
        array(
            'id' => "{$prefix}popup_bg_position",
            'type'     => 'select_advanced',
            'name'    => __('Background Position', 'mango'),
            'options'  => array(
                "left top"      =>  __("Left Top",'mango'),
                "left center"   =>  __("Left center",'mango'),
                "left bottom"   =>  __("Left Bottom",'mango'),
                "center top"    =>  __("Center Top",'mango'),
                "center center" =>  __("Center Center",'mango'),
                "center bottom" =>  __("Center Bottom",'mango'),
                "right top"     =>  __("Right Top",'mango'),
                "right center"  =>  __("Right center",'mango'),
                "right bottom"  =>  __("Right Bottom",'mango'),
            ),
            'placeholder'  => __('Background Position','mango'),
        ),
        array(
            'id'        => "{$prefix}popup_bg_size",
            'type'      => 'select_advanced',
            'name'      => __('Background Size', 'mango'),
            'options'   => array(
                "cover"      =>  __("Cover",'mango'),
                "inherit"   =>  __("Inherit",'mango'),
                "contain"   =>  __("Contain",'mango'),
            ),
            'placeholder'  => __('Background Size','mango'),
        ),
    )
);
?>