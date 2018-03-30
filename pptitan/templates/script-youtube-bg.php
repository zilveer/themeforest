<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
?>

<?php
	if(isset($_GET['youtube_id']) && !empty($_GET['youtube_id']))
	{
		$pp_homepage_youtube_id = $_GET['youtube_id'];
	}
	else
	{
		$pp_homepage_youtube_id = get_option('pp_homepage_youtube_id');
	}
	
	$pp_youtube_video_ratio = get_option('pp_youtube_video_ratio');
	if(empty($pp_youtube_video_ratio))
	{
		$pp_youtube_video_ratio = '16/9';
	}
?>

$j('document').ready(function() {
	var options = { videoId: '<?php echo $pp_homepage_youtube_id; ?>', start: 0, mute: false, repeat: false, ratio: <?php echo $pp_youtube_video_ratio; ?> };
	$j('#wrapper').tubular(options);
});