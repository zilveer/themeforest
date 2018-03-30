<?php header("content-type: application/x-javascript"); ?>
<?php
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