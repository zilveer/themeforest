<?php

header('Content-type: text/javascript');

if( !isset($_GET['location']) || !(thb_text_startsWith($_GET['location'], 'header') || thb_text_startsWith($_GET['location'], 'footer')) ) {
	die();
}

/**
 * The theme instance.
 */
$thb_theme = thb_theme();

/**
 * The loading location.
 */
$location = $_GET['location'];

/**
 * The scripts.
 */
$scripts = $thb_theme->getFrontend()->getCompressedScripts($location);

/**
 * Building the output.
 */
$output = '';
foreach( $scripts as $script ) {
	$output .= thb_read_url($script) . "\n\n";
}

/**
 * Printing the output.
 */
echo $output;