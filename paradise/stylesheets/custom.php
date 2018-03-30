<?php
	header('Content-Type: text/css');
	//*****
	$css_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
	if (!is_file($css_path)) {
		$css_path = '../../../../wp-load.php';
	}
	include_once $css_path;
	//**
	
	$font_family = get_option('font_family', 'Arial,Helvetica,Garuda,sans-serif');
	echo "body {font-family:{$font_family};}";
	echo stripslashes(get_option('custom_css'));
	if (theme_check_custom_background()) {
		echo 'body { background:url(../images/bg.jpg) #F4F5FF !important; }';
	}
?>