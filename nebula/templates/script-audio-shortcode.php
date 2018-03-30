<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
?>

$j(document).ready(function(){
	var player = new MediaElementPlayer('#<?php echo $_GET['id']; ?>', {
		alwaysShowControls: false,
	    features: ['playpause']
	});
	player.play();
});

<?php
}
?>