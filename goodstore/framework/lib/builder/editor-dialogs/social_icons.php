<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'use_author',
    'type' => 'toggle',
    'name' => 'Social URLs Sources',
    'desc' => 'Decide whether to use social URLs from authors/users personal options or from the settings in the Custom URLs tab.',
    'std' => '1',
    "builder" => 'true',
    "options" => array("1" => "Author", "0" => "Custom")
);


$of_options[] = array(
    "name" => "Author",
    "desc" => 'Choose author.',
    "id" => "build_authors",
    "type" => "authors",
    "builder" => 'true'
);


$of_options[] = array(
    "type" => "sectionend");



/* ==== Custom URLs ==== */
$of_options[] = array(
    "name" => "Custom URLs",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "<i class='icon-facebook4'></i> Facebook URL",
    "desc" => "",
    "id" => "facebook",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-twitter3'></i> Twitter URL",
    "desc" => "",
    "id" => "twitter",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-google-plus4'></i> Google URL",
    "desc" => "",
    "id" => "google",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-youtube '></i> YouTube URL",
    "desc" => "",
    "id" => "youtube",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-linkedin '></i> LinkedIn URL",
    "desc" => "",
    "id" => "linkedin",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-vimeo3 '></i> Vimeo URL",
    "desc" => "",
    "id" => "vimeo",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-flickr4 '></i> Flickr URL",
    "desc" => "",
    "id" => "flickr",
    "std" => "",
    "type" => "text"
);
 
$of_options[] = array(
    "name" => "<i class='icon-pinterest'></i> Pinterest URL",
    "desc" => "",
    "id" => "pinterest",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-instagram'></i> Instagram URL",
    "desc" => "",
    "id" => "instagram",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "<i class='icon-feed4'></i> RSS feed URL",
    "desc" => "",
    "id" => "rss",
    "std" => "",
    "type" => "text"
);
 

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Links Target',
    'desc' => 'Specify where to open a target link.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);


$of_options[] = array(
    'id' => 'size',
    'type' => 'range',
    'name' => 'Size',
    'desc' => 'Set size of icons.',
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
    'desc' => 'Decide whether or not to animate icons or use the global settings.',
    'std' => 'no-animate',
    "builder" => 'true',
    "options" => array("animate" => "Animate", "no-animate" => "NO animate", "animate-global" => "Global settings")
);

$of_options[] = array(
    'id' => 'animate_style',
    'type' => 'select',
    'name' => 'Animation Style',
    'desc' => 'Select the animation style you prefer.',
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
    'desc' => 'Select a direction. This option takes effect just on some animation styles.',
    'std' => jwOpt::get_option('animate_direction','left'),
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("left" => "Left", "right" => "Right", "top" => "Top", "down" => "Down")
);

$of_options[] = array(
    'id' => 'animate_duration',
    'type' => 'range',
    'name' => 'Animation Speed',
    'desc' => 'Set animation speed in miliseconds.',
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
$jaw_builder_options['social_icons'] = $of_options;