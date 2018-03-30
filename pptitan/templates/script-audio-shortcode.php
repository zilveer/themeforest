<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
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