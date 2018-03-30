<?php

$embed = get_post_meta($post->ID, 'icy_video_embed', true);
if( !empty($embed) ) {
	echo "<div class='video-frame'>";
    echo stripslashes(htmlspecialchars_decode($embed));
    echo "</div>";
} else {
    icy_video($post->ID);
} ?>