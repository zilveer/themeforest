<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'icon',
    'type' => 'icon',
    'name' => 'Icon',
    'desc' => 'Open this <a href="' . THEME_URI . '/help/icons/icons.html?amp;TB_iframe=true" class="thickbox" target="_blank">list of classes</a>, choose the icon you prefer and copy/paste or write down its class name to this field.',
    'std' => '',
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Color",
    "desc" => "Pick a color of your icon (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'size',
    'type' => 'range',
    'name' => 'Size',
    'desc' => 'Size size of your icon',
    'std' => '32',
    'min' => '10',
    'max' => '100',
    'step' => '1',
    'unit' => ''
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


/* ==== Animation ==== */
$of_options[] = array(
    "name" => "Animation",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'animate',
    'type' => 'toggle',
    'name' => 'Animate Icon',
    'desc' => 'Decide whether or not to animate your icon. To use global settings, select the appropriate option (you can find these settings in Theme Options -> Advanced).',
    'std' => 'animate-global',
    "builder" => 'true',
    "options" => array("no-animate" => "NO animate", "animate" => "Animate", "animate-global" => "Global Settings")
);

$of_options[] = array(
    'id' => 'animate_style',
    'type' => 'select',
    'name' => 'Animation Style',
    'desc' => 'Choose the animation style you prefer.',
    'std' => jwOpt::get_option('animate_style','slide'),
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("blind" => "Blind", "bounce" => "Bounce", "clip" => "Clip"
        , "drop" => "Drop", "explode" => "Explode", "fold" => "Fold", "highlight" => "Highlight"
        , "puff" => "Puff", "pulsate" => "Pulsate", "shake" => "Shake", "slide" => "Slide")
);

$of_options[] = array(
    'id' => 'animate_direction',
    'type' => 'select',
    'name' => 'Animation Direction',
    'desc' => 'Set the animation direction. Note: This feature is available with some animation styles only.',
    'std' => jwOpt::get_option('animate_direction','left'),
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("left" => "Left", "right" => "Right", "top" => "Top", "down" => "Down")
);

$of_options[] = array(
    'id' => 'animate_duration',
    'type' => 'range',
    'name' => 'Animation Speed',
    'desc' => 'Set speed of an animation.',
    'std' => jwOpt::get_option('animate_duration','800'),
    'min' => '100',
    'max' => '3000',
    'step' => '100',
    'unit' => 'ms'
);

$of_options[] = array(
    'id' => 'animate_easing',
    'type' => 'select',
    'name' => 'Animation Easing',    
    'desc' => "Select the easing effect you prefer. To learn more about the available effects, visit this <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>help</a> link.",
    'std' =>  jwOpt::get_option('animate_easing','swing'),
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array('linear' => 'linear', 'swing' => 'swing',
        'easeInQuad' => 'easeInQuad', 'easeOutQuad' => 'easeOutQuad',
        'easeInOutQuad' => 'easeInOutQuad', 'easeInCubic' => 'easeInCubic',
        'easeOutCubic' => 'easeOutCubic', 'easeInOutCubic' => 'easeInOutCubic',
        'easeInQuart' => 'easeInQuart', 'easeOutQuart' => 'easeOutQuart',
        'easeInOutQuart' => 'easeInOutQuart', 'easeInQuint' => 'easeInQuint',
        'easeOutQuint' => 'easeOutQuint', 'easeInOutQuint' => 'easeInOutQuint',
        'easeInExpo' => 'easeInExpo', 'easeOutExpo' => 'easeOutExpo',
        'easeInOutExpo' => 'easeInOutExpo', 'easeInSine' => 'easeInSine',
        'easeOutSine' => 'easeOutSine', 'easeInOutSine' => 'easeInOutSine',
        'easeInCirc' => 'easeInCirc', 'easeOutCirc' => 'easeOutCirc',
        'easeInOutCirc' => 'easeInOutCirc', 'easeInElastic' => 'easeInElastic',
        'easeOutElastic' => 'easeOutElastic', 'easeInOutElastic' => 'easeInOutElastic',
        'easeInBack' => 'easeInBack', 'easeOutBack' => 'easeOutBack',
        'easeInOutBack' => 'easeInOutBack', 'easeInBounce' => 'easeInBounce',
        'easeOutBounce' => 'easeOutBounce', 'easeInOutBounce' => 'easeInOutBounce')
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
$jaw_builder_options['icon'] = $of_options; 