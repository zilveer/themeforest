<?php
	$preview = '';

	if( !empty($field_value_id) ) {
		$preview = thb_image_get_size($field_value_id, 'thumbnail');
		$removeStyle = 'display: inline;';
	}
	else {
		$preview = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
		$removeStyle = 'display: none;';
	}
?>

<div class="thb-view-upload">
	<input type="hidden" name="<?php echo $field_name_url; ?>" value="" class="thb-url">
	<input type="hidden" name="<?php echo $field_name_id; ?>" value="<?php echo $field_value_id; ?>" class="thb-id">

	<img src="<?php echo $preview; ?>" class="thb-preview image" alt="">

	<?php
		thb_system_button(__('Upload', 'thb_text_domain'), '#', array(
			'class' => 'thb-btn-upload',
			'data' => array(
				'target-url' => '.thb-url',
				'target-preview' => '.thb-preview'
			),
			'icon' => 'media-button.png'
		));
	?>

	<span class="thb-upload-remove" style="<?php echo $removeStyle; ?>">
		<em><?php _e('or', 'thb_text_domain'); ?></em> <a href="#"><?php _e('remove image', 'thb_text_domain'); ?></a>
	</span>
</div>