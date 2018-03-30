<?php

$boxSections_locations = array();



//START NICDARK SETTINGS
$boxSections_locations[] = array(
    'title' => __('Location Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-briefcase',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_location_coordinates',
            'type'     => 'text',
            'title'    => __( 'Coordinates', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the coordinates', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => ''
        ),
        //end array
        
    )
); 


$boxSections_locations[] = array(
    'title' => __('Preview Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-adjust-alt',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_location_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert custom title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => ''
        ),
        array(
            'id'       => 'metabox_location_subtitle',
            'type'     => 'text',
            'title'    => __( 'Sub Title', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert custom sub title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => ''
        ),
        array(
            'id'       => 'metabox_location_description',
            'type'     => 'text',
            'title'    => __( 'Text Description', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert custom description', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => ''
        ),
        //end array


        
    )
); 
//END NICDARK SETTINGS


$metaboxes[] = array(
    'id' => 'locations-layout',
    'title' => __('Location Options', 'redux-framework-demo'),
    'post_types' => array('locations'),
    //'page_template' => array('page-test.php'),
    //'post_format' => array('image'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
    'sections' => $boxSections_locations
);

