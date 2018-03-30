<?php
	$preview = '';

	if( !empty($field_value_url) ) {
		$preview = thb_get_video_thumbnail($field_value_url, 'thumbnail_small');
		$previewClass = '';
	}

	if( $preview == '' ) {
		$preview = THB_ADMIN_CSS_URL . '/i/video.png';
		$previewClass = 'video';
	}
?>

<img src="<?php echo $preview; ?>" class="thb-preview <?php echo $previewClass; ?>" alt="video preview">

<div class="thb-field-row">
	<span class="thb-additional-label"><?php _e('Video URL', 'thb_text_domain'); ?></span><input type="text" name="<?php echo $field_name_url; ?>" value="<?php echo $field_value_url; ?>" class="thb-url">
	<br>
	<span class="thb-additional-label thb-additional-label-poster"><?php _e('Poster image URL', 'thb_text_domain'); ?></span><input type="text" name="<?php echo $field_name_poster; ?>" value="<?php echo $field_value_poster; ?>">
	<br>
	<?php if( $field->supportCaptions() ) : ?>
		<textarea name="<?php echo $field_name_caption; ?>"><?php echo $field_value_caption; ?></textarea>
	<?php else : ?>
		<input type="hidden" name="<?php echo $field_name_caption; ?>" value="<?php echo $field_value_caption; ?>">
	<?php endif; ?>

	<label for="<?php echo $field_name_autoplay; ?>">
		<input type="checkbox" value="1" name="<?php echo $field_name_autoplay; ?>" <?php echo $field_value_autoplay ? 'checked' : ''; ?>>
		<?php echo __('Autoplay', 'thb_text_domain') ?>
	</label>

	<label for="<?php echo $field_name_loop; ?>">
		<input type="checkbox" value="1" name="<?php echo $field_name_loop; ?>" <?php echo $field_value_loop ? 'checked' : ''; ?>>
		<?php echo __('Loop', 'thb_text_domain') ?>
	</label>
</div>

<input type="hidden" name="<?php echo $field_name_id; ?>" id="">