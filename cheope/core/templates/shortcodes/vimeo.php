<?php $proto = ( is_ssl() ? 'https://' : 'http://' ); ?>

<div class="post_video vimeo">
    <iframe wmode="transparent" src="<?php echo "{$proto}player.vimeo.com/video/{$video_id}?title=0&amp;byline=0&amp;portrait=0" ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>