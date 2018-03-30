<?php
//global $mango_sidebar;
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'client_options',

// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'Product Options', 'mango' ),

// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'product' ),

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
            'name' => __ ( 'Product Options', 'mango' ),
            'id' => 'product_page_heading',
        ),
        array (
            'name' => __ ( 'Product Page Style', 'mango' ),
            'id' => "{$prefix}product_page_style",
            'type' => 'select_advanced',
            'options' => array (
                'v_1'   =>  __('Style 1','mango'),
                'v_2'   =>  __('Style 2','mango'),
				'v_3'   =>  __('Style 3','mango'),
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
		array (
            'type' => 'text',
            'name' => __ ( 'Custom Tabs Heading 1', 'mango' ),
            'id' => "{$prefix}tabs_custom_heading_one",
        ),
		 array(
            'name' => __( 'Custom Tabs Content 1', 'mango' ),
            'id'   => "{$prefix}contact_tabs_content_one",
            'type' => 'wysiwyg',
            'raw'  => false,
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),
		array (
            'type' => 'text',
            'name' => __ ( 'Custom Tabs Heading 2', 'mango' ),
            'id' => "{$prefix}tabs_custom_heading_two",
        ),
		 array(
            'name' => __( 'Custom Tabs Content 2', 'mango' ),
            'id'   => "{$prefix}contact_tabs_content_two",
            'type' => 'wysiwyg',
            'raw'  => false,
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),
    )
);
?>