<div class="thb-view-gallery" data-media-title="<?php _e('Gallery', 'thb_text_domain'); ?>">
	<input type="text" name="<?php echo $field_name; ?>" value="<?php echo $field_value; ?>">

	<?php
		thb_system_button(__('Upload', 'thb_text_domain'), '#', array(
			'class' => 'thb-btn-upload'
		));
	?>
</div>