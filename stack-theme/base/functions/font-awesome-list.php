<?php

$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$subject = file_get_contents( THEME_FRAMEWORK_ASSETS_DIR . '/css/font-awesome.css');

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
    $icons[$match[1]] = $match[1];
}

$GLOBALS['font_awesome_list'] = $icons;