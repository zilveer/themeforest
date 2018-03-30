<?php
include_once 'google_fonts_json.php';
global $berg_google_fontsArr;

$berg_google_fonts_array = json_decode($google_fonts_json, true);
$berg_google_fontsArr = $berg_google_fonts_array['items'];

function berg_createGlobalGoogleFontVar() {
	global $berg_google_fontsArr;
	$google_fonts_data = array();

	foreach ($berg_google_fontsArr as $value) {
		$google_fonts_data[$value['family']] = $value['variants'];
	}

	return $google_fonts_data;
}

global $berg_google_fonts_data;

$berg_google_fonts_data = berg_createGlobalGoogleFontVar();
?>