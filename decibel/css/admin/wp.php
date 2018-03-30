<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );

if( count($path_to_file) > 1){
	/*got wp-content dir*/
	$path_to_wp = $path_to_file[0];

}else{
	/* dev environement */
	$path_to_file = explode( 'content', $absolute_path );
	$path_to_wp = $path_to_file[0] .'/wp';
}
// Access WordPress
require_once( $path_to_wp . '/wp-load.php' );
?>