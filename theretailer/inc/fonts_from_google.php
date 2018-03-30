<?php

global $theretailer_theme_options;

$theretailer_customfont = '';

$default = array(
					'arial',
					'verdana',
					'trebuchet',
					'georgia',
					'times',
					'tahoma',
					'helvetica'
				);
				
if (!isset($theretailer_theme_options['gb_main_font'])) $theretailer_theme_options['gb_main_font'] = "Arvo";
if (!isset($theretailer_theme_options['gb_secondary_font'])) $theretailer_theme_options['gb_secondary_font'] = "Lato";

$googlefonts = array(
					$theretailer_theme_options['gb_main_font'],
					$theretailer_theme_options['gb_secondary_font']
				);
			
foreach($googlefonts as $googlefont) {
	
	if(!in_array($googlefont, $default)) {
			$theretailer_customfont = str_replace(' ', '+', $googlefont). ':300,300italic,400,400italic,700,700italic,900,900italic|' . $theretailer_customfont;
	}
}	



if ($theretailer_customfont != "") {	
	
	function google_fonts() {		
		global $theretailer_customfont;		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'theretailer-googlefonts', "$protocol://fonts.googleapis.com/css?family=". substr_replace($theretailer_customfont ,"",-1) . "' rel='stylesheet' type='text/css" );
	}
	add_action( 'wp_enqueue_scripts', 'google_fonts' );
	
}
	
?>