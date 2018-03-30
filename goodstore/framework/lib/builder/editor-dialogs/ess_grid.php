<?php

global $jaw_builder_options;

$of_options = array();

$sliders = array();
if (class_exists('Essential_Grid')) {
    $grids = Essential_Grid::get_essential_grids();


    if (!empty($grids) && is_array($grids)) {
        foreach ($grids as $grid) {
            $sliders[$grid->handle] = $grid->name;
        }
    }
}

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'alias',
    'type' => 'select',
    'name' => 'Grid',
    'desc' => 'Select one from the grid you have created in the Essential Grid settings.',
    'std' => '',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => $sliders
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'fullwidth',
    'type' => 'toggle',
    'name' => 'Full Width',
    'desc' => 'Choose ON option to add a color background over the entire width of the element. To expand your slider only, select the Full-Item option.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off", "full-item" => "Full-Item")
);

$of_options[] = array(
    "name" => "Full Width Background Color",
    "desc" => "Pick a background color (by default: #000000).",
    "id" => "full_back_color",
    "std" => "#000000",
    "type" => "color"
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
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

/* Settings */
global $jaw_builder_options;
$jaw_builder_options['ess_grid'] = $of_options;

