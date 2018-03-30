<?php $proto = ( is_ssl() ? 'https://' : 'http://' ); ?>

<div class="post_video youtube">
    <iframe wmode="transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="<?php echo "{$proto}www.youtube.com/embed/{$video_id}?wmode=transparent" ?>" frameborder="0" allowfullscreen></iframe>
</div>