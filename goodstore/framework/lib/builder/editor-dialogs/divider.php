<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Divider Text",
    "desc" => "Insert a text to be placed in the middle of the divider.",
    "id" => "divider_text",
    "std" => "",
    "type" => "text"
);


$of_options[] = array(
    'id' => 'icon',
    'type' => 'icon',
    'name' => 'Divider Icon',
    'desc' => 'Choose an icon to be placed before your text clicking this <a href="' . THEME_URI . '/help/icons/icons.html?amp;TB_iframe=true" class="thickbox" target="_blank">list of classes</a>, choosing the icon you prefer and copying/pasting or writing down its class name to this field.',
    'std' => '',
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== To top ==== */
$of_options[] = array(
    "name" => "To Top",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Back To Top Link",
    "desc" => "Decide whether or not to show the Back To Top Link above the divider.",
    "id" => "divider_totop",
    "std" => "0",
    "type" => "toggle",
    "builder" => "true",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Back To Top Text",
    "desc" => "Text of the &acute;Back To Top&acute; link (by default: Back To Top).",
    "id" => "divider_title",
    "std" => "Back To Top",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Back To Top Text Align",
    "desc" => "Choose an alignment of the link.",
    "id" => "totop_align",
    "std" => "right",
    "type" => "toggle",
    "builder" => "true",
    "options" => array("left" => "Left", "right" => "Right")
);
     
$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Clear",
    "desc" => "Decide whether or not to show divider without space.",
    "id" => "clear",
    "std" => "clear-off",
    "type" => "toggle",
    "builder" => "true",
    "options" => array("clear-on" => "On", "clear-off" => "Off")
);


$of_options[] = array(
    'id' => 'divider_style',
    'type' => 'select',
    'name' => 'Line Style',
    'desc' => 'Choose the line style.',
    'std' => 'solid',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("solid" => "Solid", "dotted" => "Dotted", "dashed" => "Dashed", "none" => "none"),
);

$of_options[] = array(
    "name" => "Divider Text Color",
    "desc" => "Pick a color of your divider text (by default: #000000).",
    "id" => "text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Divider Line Color",
    "desc" => "Pick a color of the divider line (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'width',
    'type' => 'range',
    'name' => 'Divider Thickness',
    'desc' => 'Set thickness of the divider.',
    'std' => '1',
    'min' => '1',
    'max' => '5',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Space Before",
    "desc" => "Set size of the space before your divider.",
    "id" => "space",
    'std' => '0',
    'min' => '0',
    'max' => '100',
    'step' => '1',
    'unit' => 'px',
    'type' => 'range',
);

$of_options[] = array(
    "name" => "Space After",
    "desc" => "Set size of the space after your divider.",
    "id" => "space_after",
    'std' => '0',
    'min' => '0',
    'max' => '100',
    'step' => '1',
    'unit' => 'px',
    'type' => 'range',
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

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['divider'] = $of_options; 