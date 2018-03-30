<div class="featured-video-wrapper">
<div class="featured-video-container">
<?php
$featured_video_block= of_get_option ( 'featured_embed' );
echo stripslashes_deep ( $featured_video_block );
?>
</div>
</div>