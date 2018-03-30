<?php
//global $mango_sidebar;
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'faq_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'FAQ\'s Options', 'mango' ),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'faq' ),
// Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
// Order of meta box: high (default), low. Optional.
    'priority' => 'high',
// Auto save: true, false (default). Optional.
    'autosave' => true,
// List of meta fields
    'fields' => array (
//Blog Template Options
// HEADING
        array (
            'type' => 'heading',
            'name' => __ ( 'FAQs Label Options', 'mango' ),
            'id' => 'faqs_page_heading',
        ),
        array (
            'name' => __ ( 'Label Text', 'mango' ),
            'id' => "{$prefix}label_text",
            'type' => 'text',
            'desc' => 'Label Text.'
        ),
        array (
            'name' => __ ( 'Label Type', 'mango' ),
            'id' => "{$prefix}label_type",
            'type' => 'select_advanced',
            'options' => array (
                ''         =>    __( 'None', 'mango' ),
                'default'  =>    __( 'Default', 'mango' ),
                'primary ' =>    __( 'Primary', 'mango' ),
                'success'  =>    __( 'Success', 'mango' ),
                'info'     =>    __( 'Info', 'mango' ),
                'warning'  =>    __( 'Warning', 'mango' ),
                'danger'   =>    __( 'Danger', 'mango' ),
            ),
        )
    )
);
?>