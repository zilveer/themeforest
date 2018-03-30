<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<div class="row-fluid post-pager clearfix">
	<div class="span12">
		
		<ul class="pager clearfix">
			<li class="previous<?php echo (($prev = $content->prevPostLink())  ? "" : " disabled") ?>">
				<a href="<?php echo ($prev ? $prev : "#"); ?>">&larr; <span><?php _e("Previous",'Pixelentity Theme/Plugin'); ?></span></a>
			</li>
			<li class="next<?php echo (($next = $content->nextPostLink())  ? "" : " disabled") ?>">
				<a href="<?php echo ($next ? $next : "#"); ?>"><span><?php _e("Next",'Pixelentity Theme/Plugin'); ?></span> &rarr;</a>
			</li>
		</ul> 
	</div>
</div>
