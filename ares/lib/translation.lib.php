<?php
/**
*	Themes translation file
**/
load_theme_textdomain( THEMEDOMAIN, TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
?>