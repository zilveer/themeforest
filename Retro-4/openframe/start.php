<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

require_once( get_template_directory() . '/openframe/config.php' );

$openframe = array_merge( $theme_config, $openframe );

require_once( $openframe['includes'] . '/helper.php' );

if ( is_admin() )
	require_once( $openframe['panel'] . '/start.php' );