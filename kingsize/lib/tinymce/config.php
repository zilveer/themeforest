<?php
/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes
 **/
 // Bootstrap file for getting the ABSPATH constant to wp-load.php
$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

require_once($wp_include);
?>