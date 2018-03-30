<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

if ( !empty( $id ) ) {
	echo do_shortcode( '[layerslider id="'.$id.'"]' );
}
