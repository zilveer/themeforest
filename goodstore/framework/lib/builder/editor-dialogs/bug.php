<?php

 
 $of_options = array();



$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Comment",
    "desc" => "",
    "id" => "comment",
    "std" => "",
    "type" => "textarea"
);
$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['bug'] = $of_options;