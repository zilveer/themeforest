<?php

$formy = array();
if (class_exists('WYSIJA')) {
    $model_forms = WYSIJA::get('forms', 'model');
    $model_forms->reset();
    $forms = $model_forms->getRows(array('form_id', 'name'));

    foreach ($forms as $f) {
        $formy[$f['form_id']] = $f['name'];
    }
}


$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'id',
    'type' => 'select',
    'name' => 'Form',
    'desc' => 'Select one of the forms you have created in the Wysija settings.',
    'std' => '',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => $formy
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


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'class',
    'type' => 'toggle',
    'name' => 'Show Labels',
    'desc' => '',
    'std' => 'without_labels',
    'options' => array('with_labels' => 'On', 'without_labels' => 'Off')
);

$of_options[] = array(
    "type" => "sectionend");



/* Settings */
global $jaw_builder_options;
$jaw_builder_options['wysija_form'] = $of_options;
