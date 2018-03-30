<?php

$pexeto_slider_options= array( array(
"name" => "Slider Settings",
"type" => "title",
"img" => "icon-images"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"nivo", "name"=>"Nivo Slider"), array("id"=>"fullwidth", "name"=>"Full-width slider"), array("id"=>"fullheight", "name"=>"Full-height slider"))
),


/* ------------------------------------------------------------------------*
 * NIVO SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'nivo'
),


array(
"name" => "Automatic image resizing",
"id" => PEXETO_SHORTNAME."_nivo_auto_resize",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, the images will be resized automatically.'
),

array(
"name" => "Show navigation",
"id" => PEXETO_SHORTNAME."_exclude_nivo_navigation",
"type" => "multicheck",
"options" => array(array("id"=>"arrows", "name"=>"Arrows"), array("id"=>"buttons", "name"=>"Navigation Buttons")),
"class"=>"exclude"
),

array(
"name" => "Animation Effect",
"id" => PEXETO_SHORTNAME."_nivo_animation",
"type" => "multicheck",
"options" => array(array('id'=>'fold','name'=>'Fold'),array('id'=>'fade','name'=>'Fade'),
array('id'=>'sliceDownRight','name'=>'Slice Down'),array('id'=>'sliceDownLeft','name'=>'Slice Down Left'),array('id'=>'sliceUpRight','name'=>'Slice Up'),
array('id'=>'sliceUpDown','name'=>'Slice Up Down'),array('id'=>'sliceUpLeft','name'=>'Slice Up Left'),array('id'=>'sliceUpDownLeft','name'=>'Slice Up Down Left'),
array('id'=>'boxRandom','name'=>'Box Random'),array('id'=>'boxRainGrow','name'=>'Box Rain Grow'),array('id'=>'boxRainGrowReverse','name'=>'Box Rain Grow Reverse')
),
"class"=>"include",
"std"=>"fold,fade,sliceDownRight,sliceDownLeft,sliceUpRight,sliceUpDown,sliceUpLeft,sliceUpDownLeft,boxRandom,boxRainGrow,boxRainGrowReverse"
),

array(
"name" => "Number of slices",
"id" => PEXETO_SHORTNAME."_nivo_slices",
"type" => "text",
"std" => "15",
"desc" => "For slice animations only."
),

array(
"name" => "Number of box rows",
"id" => PEXETO_SHORTNAME."_nivo_rows",
"type" => "text",
"std" => "4",
"desc" => "For box animations only."
),

array(
"name" => "Number of box columns",
"id" => PEXETO_SHORTNAME."_nivo_columns",
"type" => "text",
"std" => "8",
"desc" => "For box animations only."
),

array(
"name" => "Animation Speed",
"id" => PEXETO_SHORTNAME."_nivo_speed",
"type" => "text",
"std" => "800",
"desc" => "The animation speed in miliseconds"
),

array(
"name" => "Pause interval",
"id" => PEXETO_SHORTNAME."_nivo_interval",
"type" => "text",
"std" => "3000",
"desc" => "The time interval between image changes in miliseconds"
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_nivo_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, the images will rotate automatically'
),

array(
"name" => "Pause on hover",
"id" => PEXETO_SHORTNAME."_nivo_pause_hover",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * FULL WIDTH SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'fullwidth'
),

array(
"name" => "Automatic thumbnail image resizing",
"id" => PEXETO_SHORTNAME."_full_auto_resize",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the small thumbnail images will be resized automatically.'
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_full_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the images will rotate automatically'
),

array(
"name" => "Hide header and footer",
"id" => PEXETO_SHORTNAME."_full_hide",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the footer and header will be hidden for the slideshow and a "Show" button will
be added to show these sections back.'
),

array(
"name" => "Rotate Interval",
"id" => PEXETO_SHORTNAME."_full_interval",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => PEXETO_SHORTNAME."_full_pause",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),

array(
"type" => "close"),


/* ------------------------------------------------------------------------*
 * FULL HEIGHT SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'fullheight'
),

array(
"name" => "Automatic thumbnail image resizing",
"id" => PEXETO_SHORTNAME."_fullh_auto_resize",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the small thumbnail images will be resized automatically.'
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_fullh_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the images will rotate automatically'
),

array(
"name" => "Hide header and footer",
"id" => PEXETO_SHORTNAME."_fullh_hide",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the footer and header will be hidden for the slideshow and a "Show" button will
be added to show these sections back.'
),

array(
"name" => "Rotate Interval",
"id" => PEXETO_SHORTNAME."_fullh_interval",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => PEXETO_SHORTNAME."_fullh_pause",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),

array(
"type" => "close"),


array(
"type" => "close"));

$new_pexeto_slider_options = pexeto_add_custom_options($pexeto_slider_options);

pexeto_add_options($new_pexeto_slider_options);