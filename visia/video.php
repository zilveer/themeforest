<?php $t =& peTheme(); ?>
<?php list($video) = $t->template->data(); ?>

<?php if (!empty($video)): ?>
<div class="embed-container">
	<?php switch($video->type): case "youtube": ?>
	<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $video->id; ?>?autohide=1&modestbranding=1&showinfo=0" class="fullwidth-video" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php break; case "vimeo": ?>
	<iframe src="http://player.vimeo.com/video/<?php echo $video->id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" class="fullwidth-video" width="560" height="315" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php endswitch; ?>
</div>
<?php endif; ?>