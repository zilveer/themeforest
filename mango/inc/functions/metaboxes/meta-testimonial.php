<?php
//global $mango_sidebar;
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'testimonial_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'Testimonials Options', 'mango' ),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'testimonial' ),
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
            'name' => __ ( 'Testimonials Options', 'mango' ),
            'id' => 'testimonial_page_heading',
        ),
        array (
            'name' => __ ( 'Testimonial Author Name', 'mango' ),
            'id' => "{$prefix}test_author_name",
            'type' => 'text',
        ),
    )
);
?>