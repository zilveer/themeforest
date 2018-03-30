<?php
$primary_color = $_REQUEST['primary-color'];
$text_color = $_REQUEST['text-color'];
$text_bold_color = $_REQUEST['text-bold-color'];
$theme_url = $_REQUEST['theme-url'];

echo '@primary_color:#'.$primary_color.';';
echo '@text_color:#'.$text_color.';';
echo '@text_bold_color:#'.$text_bold_color.';';
echo '@theme_url:"'. $theme_url . '";';
echo '@font_family_secondary : "Montserrat";';
echo '@import "assets/css/less/style.less";', PHP_EOL;


