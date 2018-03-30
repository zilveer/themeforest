<?php $proto = ( is_ssl() ? 'https://' : 'http://' ); ?>

<div class="post_video veoh">
    <iframe wmode="transparent" src="<?php echo "{$proto}www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId={$video_id}" ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" frameborder="0" ></iframe>
</div>