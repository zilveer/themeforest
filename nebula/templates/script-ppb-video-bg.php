<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

$j(document).ready(function() {
	$j('#<?php echo $_GET['video_id']; ?>').mediaelementplayer({
	    <?php if(!isset($_GET['width'])) { ?>
	    videoWidth: $j(window).width(),
	    <?php } else { ?>
	    videoWidth: <?php echo $_GET['width']; ?>,
	    <?php } ?>
	    videoHeight: <?php echo $_GET['height']; ?>,
	    enableAutosize: true,
	    startVolume: 0,
	    pauseOtherPlayers: false,
	    success: function (mediaElement, domObject) {
	    	 
	    	<?php
	    		if(!isset($_GET['autoplay']))
	    		{
	    	?>
	    	if (mediaElement.pluginType === 'flash')    {
			    mediaElement.addEventListener('canplay', function() {
			        mediaElement.loop = true;
			        mediaElement.play();
			        $j("div.mejs-container .mejs-button").trigger('click');
			   }, false);
			}
			else {
			    mediaElement.loop = true;
			    mediaElement.play();
			}
	    	<?php
	    		}
	    	?>
	    	$j('#<?php echo $_GET['video_id']; ?>').css('width', $j(window).width()+'px');
	    	
	    	/*var currentVideoHeight = $j('#<?php echo $_GET['video_id']; ?>').height();
	    	
	    	$j('#<?php echo $_GET['video_id']; ?>').parents('.ppb_transparent_video_bg').css('height', currentVideoHeight+'px');
	    	
	    	$j(window).resize(function(){
	    		$j('#<?php echo $_GET['video_id']; ?>').css('width', $j(window).width()+'px');
	    		
	    		var currentVideoHeight = $j('#<?php echo $_GET['video_id']; ?>').height();
	    	
	    	$j('#<?php echo $_GET['video_id']; ?>').parents('.ppb_transparent_video_bg').css('height', currentVideoHeight+'px');
	    	});*/
	    	 
	    }
	});
});