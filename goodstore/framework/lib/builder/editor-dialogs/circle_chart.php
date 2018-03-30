<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Data",
    "desc" => "Add a new item to your circle chart.",
    "id" => "chart",
    "std" => "",
    "type" => "circle_chart"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Chart Type",
    "desc" => "Select the chart type you prefer.",
    "id" => "chart_type",
    "std" => "Doughnut",
    "type" => "toggle",
    "builder" => "true",
    "options" => array("Doughnut" => "Doughnut", "Pie" => "Pie", 'PolarArea' => 'PolarArea')
);

$of_options[] = array(
    'id' => 'size',
    'type' => 'range',
    'name' => 'Size',
    "desc" => "Set size of the chart in pixels.",
    'std' => '150',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'class',
    'type' => 'text',
    'name' => 'Custom Class',
    'desc' => 'Insert your custom class for this element.',
    'std' => ''
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");

 
$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'toggle',
    'name' => 'Bar Type',
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");


 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['circle_chart'] = $of_options; 