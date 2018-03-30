<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

if ( !empty( $id ) ) {
	echo do_shortcode( '[rev_slider '.$id.']' );
}