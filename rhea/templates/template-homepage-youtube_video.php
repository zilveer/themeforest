<?php
$pp_homepage_youtube_video_id = get_option('pp_homepage_youtube_video_id');

if(!empty($pp_homepage_youtube_video_id))
{
?>
<div id="youtube_bg">
	<iframe src="//www.youtube.com/embed/<?php echo $pp_homepage_youtube_video_id; ?>?autoplay=1&hd=1&rel=0&showinfo=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
</div>
<?php
}
?>
