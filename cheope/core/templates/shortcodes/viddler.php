<?php $proto = ( is_ssl() ? 'https://' : 'http://' ); ?>

<div class="post_video viddler">
    <iframe wmode="transparent" src="<?php echo "{$proto}www.viddler.com/simple/{$video_id}" ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" frameborder="0" ></iframe>
</div>