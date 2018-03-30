<?php
 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Sidebar",
    "desc" => 'Choose a sidebar from the list of your custom ones.',
    "id" => "build_sidebar",
    "type" => "sidebar_select",
    'mod' => 'medium',
    'builder' => 'true'
);

$of_options[] = array(
    'id' => 'sidebars',
    'type' => 'sidebars',
    'name' => 'Sidebar Manager',
    'desc' => 'Here you can add or remove your optional sidebars. To add new sidebar, fill in the field with a name you want and click the Add New Sidebar button.' ,
    'std' => jwOpt::get_option('sidebars')
);

$of_options[] = array(
    "type" => "sectionend");  
 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['page_sidebar'] = $of_options; 