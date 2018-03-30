<?php

$of_options = array();
global $wp_query;
$bck_query = $wp_query;
$forms = query_posts(array('post_type' => 'wpcf7_contact_form'));
$contact_forms = array();
$wp_query = $bck_query;

foreach ($forms as $form) {
    $contact_forms[$form->ID] = $form->post_title;
}

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'id',
    'type' => 'select',
    'name' => 'Contact Form 7',
    'desc' => 'Choose a contact form you had created in the Contact Form 7 plugin.',
    'std' => 'ajax',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => $contact_forms,
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
$jaw_builder_options['contact_form'] = $of_options;
