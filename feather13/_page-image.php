<?php if(has_post_thumbnail()): ?>
<div id="page-image">
	<?php $image_id = get_post_thumbnail_id(); ?>
	<?php $image = wpb_dynamic_resize($image_id,'','960','340',TRUE); ?>	
	<img src="<?php echo $image['url']; ?>" />	
	<div id="page-image-text">
		<?php echo wpb_post_thumbnail_caption(); ?>
	</div>
</div><!--/page-image-->
<?php endif; ?>	