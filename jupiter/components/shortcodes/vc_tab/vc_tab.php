<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$icon = (strpos($icon, 'mk-') !== false) ? $icon : ( 'mk-'.$icon.'' );

include( $path . '/template.php' );