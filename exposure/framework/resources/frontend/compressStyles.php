<?php

header('Content-type: text/css');

/**
 * The theme instance.
 */
$thb_theme = thb_theme();

/**
 * The styles.
 */
$styles = $thb_theme->getFrontend()->getCompressedStyles();

/**
 * Building the output.
 */
$output = '';
foreach( $styles as $style ) {
	$output .= "/* ======================================================= */" . "\n";
	$output .= "/* " . basename($style['path']) . " - " . $style['media'] . "*/ \n";
	$output .= "/* ======================================================= */" . "\n";
	$output .= "\n\n";

	if( !empty($style['media']) && $style['media'] != 'all' && $style['media'] != 'screen' ) {
		$output .= '@media ' . $style['media'] . "{\n";
			$file_output = thb_read_url($style['path']) . "\n}";
			$output .= str_replace('url("', 'url("' . str_replace(basename($style['path']), '', $style['path']), $file_output);
		$output .= "\n\n\n";
	}
	else {
		$file_output = thb_read_url($style['path']) . "\n";
		$output .= str_replace('url("', 'url("' . str_replace(basename($style['path']), '', $style['path']), $file_output);
		$output .= "\n\n\n";
	}
}

/**
 * Printing the output.
 */
echo $output;