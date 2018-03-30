<?php
global $post;

$video_code = (get_post_meta( $post->ID, '_video_code', true )) ? get_post_meta( $post->ID, '_video_code', true ) : '';
?>
<div class="row-container">
	<div class="misc-pub-section" style="padding-left: 0; border-bottom: 0;">
		<strong>Video code: </strong><br />
		<textarea name="_video_code" rows="10" cols="100"><?php echo $video_code; ?></textarea>
		<p>Please add video iframe from youtube, vimeo or any other video sharing website iframe</p>
	</div>
</div>