<?php
global $post;
$video_link = get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true);
$proj_link = get_post_meta($post->ID,THEME_SLUG.'proj_link',true);
?>
<p>
	<span style="width:220px;display:inline-block;"><?php _e('Enter your project url  ','wpdance')?></span><input size="90" name="proj_link" type="text" value="<?php echo $proj_link; ?>"  />
</p>
<p>
	<span style="width:220px;display:inline-block;"><?php _e('Enter a video link (Vimeo,Youtube) ','wpdance')?></span><input size="90" name="video_portfolio" type="text" value="<?php echo $video_link; ?>"  />
</p>