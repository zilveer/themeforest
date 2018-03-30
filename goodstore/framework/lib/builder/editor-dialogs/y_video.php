<?php

 
 $of_options = array();
        
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Initial Clip URL",
    "desc" => "Enter URL of a YouTube video clip.",
    "id" => "clip_id",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'auto_height',
    'type' => 'toggle',
    'name' => 'Automatic height of video',
    'desc' => 'Video will keep ratio 16:9',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'height',
    'type' => 'range',
    'name' => 'Height',
    'desc' => 'Set height of the video window.',
    'std' => '480',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'autohide',
    'type' => 'select',
    'name' => 'Autohide',
    'desc' => 'This parameter indicates whether/how the video controls will automatically hide after the video starts.',
    'std' => '2',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("2"=>"Fade out timeline", "1" => "Fade out the whole bar", "0" => "Show bar all the time")
);

$of_options[] = array(
    'id' => 'autoplay',
    'type' => 'toggle',
    'name' => 'Autoplay',
    'desc' => 'Decide whether or not to allow the video to automatically start playing.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'loop',
    'type' => 'toggle',
    'name' => 'Loop',
    'desc' => 'In case of a single video player, the On option will cause that the player plays the initial video over and over again.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'rel',
    'type' => 'toggle',
    'name' => 'Related',
    'desc' => 'Decide whether or not to allow the player to show related videos after playback ends.',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Playlist",
    "desc" => "Enter URL of the YouTube video clip you want to add to your playlist and click the [ + ] button to add other videos in the same way.<br><br>Note: First will be played the video declared in Content tab.",
    "id" => "playlist",
    "type" => "list"
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
$jaw_builder_options['y_video'] = $of_options; 