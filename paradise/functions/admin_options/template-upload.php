<?php $option = stripslashes(get_option($this->name, '')); ?>
<div id="<?php echo $args['id']; ?>_preview" class="options-image-preview">
<?php if (!empty($option)): ?>
<a class="thickbox" href="<?php echo $option; ?>" target="_blank"><img src="<?php echo $option; ?>"/></a>
<?php endif; ?>
</div>
<input name="<?php echo $this->name; ?>" id="<?php echo $args['id']; ?>" class="<?php echo $args['class']; ?>" size="<?php echo $args['size']; ?>" value="<?php echo $option; ?>" />
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>
<div class="theme-upload-buttons">
	<a class="thickbox button theme-upload-button" id="<?php echo $args['id']; ?>" href="media-upload.php?&target=<?php echo $args['id']; ?>&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644"><?php echo $args['button_text']; ?></a>
</div>
<script type="text/javascript">
	jQuery(document).ready( function($) {
	jQuery('.theme-upload-button').click(function(){
		jQuery('.theme-upload-button').removeClass("add");
		jQuery(this).addClass("add");
		
		
	});
	
	
	
	
	
});
</script>