<?php
$pp_homepage_youtube_video_id = get_option('pp_homepage_youtube_video_id');

if(!empty($pp_homepage_youtube_video_id))
{
?>
<script>
$j(document).ready(function() {
	$j('body').tubular('<?php echo $pp_homepage_youtube_video_id; ?>','wrapper');
	
	setTimeout(function() {
    	$j('#top_bar').fadeOut("slow");
    }, 3000);
});
</script>
<?php
}
?>
