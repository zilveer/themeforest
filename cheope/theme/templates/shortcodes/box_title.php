<?php
	$content = (isset($content) && $content != '') ? $content : '';
?>
<div class="row box-title">
	<div class="span5">
		<?php echo do_shortcode('[border]') ?>
	</div>
	<h3 class="span2">
		<?php echo $content ?>
	</h3>
	<div class="span5">
		<?php echo do_shortcode('[border]') ?>
	</div>
</div>
