
<div class="google-map-frame" style="<?php if ($width != '' && $height != '') : ?>width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;<?php else: echo 'width: auto; height: '.$height; endif; ?> ">
	<iframe <?php if ($width != '' && $height != '') : ?>width="<?php echo $width; ?>" <?php else: ?>style="width: 100%;"<?php endif; ?> height="<?php echo $height; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $src; ?>&amp;output=embed" ></iframe>
	<div class="shadow-thumb-sidebar"></div>
</div>
