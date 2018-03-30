<?php

 
 $of_options = array();
$of_options[] = array(
    "name" => "Name",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Name",
    "desc" => "Name your preset.",
    "id" => "preset_name",
    "std" => "Preset",
    "type" => "text"
);
$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['add_preset'] = $of_options; 