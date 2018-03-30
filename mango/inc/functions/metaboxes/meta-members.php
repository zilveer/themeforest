<?php
//global $mango_sidebar;
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'member_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'Member\'s Options', 'mango' ),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'member' ),
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
            'name' => __ ( 'Member\'s', 'mango' ),
            'id' => 'faqs_page_heading',
        ),
		 array (
            'name' => __ ( 'First Name', 'mango' ),
            'id' => "{$prefix}member_fname",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Last Name', 'mango' ),
            'id' => "{$prefix}member_lname",
            'type' => 'text', 
        ),
		
		array (
            'name' => __ ( 'Role', 'mango' ),
            'id' => "{$prefix}member_role",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'More Info', 'mango' ),
            'id' => "{$prefix}member_minfo",
            'type' => 'text', 
        ),
        array (
            'name' => __ ( 'Facebook', 'mango' ),
            'id' => "{$prefix}member_facebook",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Twitter', 'mango' ),
            'id' => "{$prefix}member_twitter",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'LinkedIn', 'mango' ),
            'id' => "{$prefix}member_linkedIn",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Google +', 'mango' ),
            'id' => "{$prefix}member_googleplus",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Pinterest', 'mango' ),
            'id' => "{$prefix}member_pinterest",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Email', 'mango' ),
            'id' => "{$prefix}member_email",
            'type' => 'text', 
        ),
		 array (
            'name' => __ ( 'Tumblr', 'mango' ),
            'id' => "{$prefix}member_tumblr",
            'type' => 'text', 
        ),
      
    )
);
?>