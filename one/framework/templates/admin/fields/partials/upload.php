<?php
	$preview = '';

	if( ! empty( $field_value ) ) {
		$preview = thb_image_get_size( $field_value, $thumb );
		$class = '';
		$removeStyle = 'display: inline;';
	}

	if ( empty( $field_value ) || empty( $preview ) ) {
		$preview = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
		$class = 'thb-upload-empty';
		$removeStyle = 'display: none;';

		if ( is_numeric( $field_value ) ) {
			$field_value = '';
		}
	}
?>

<div class="thb-view-upload <?php echo $class ?>" data-target="<?php echo $field_target; ?>" data-image-size="<?php echo $thumb; ?>" data-title="<?php echo $field_label; ?>">
	<?php if( empty( $field_target ) ) : ?>
		<input type="hidden" name="<?php echo $field_name; ?>" value="<?php echo $field_value; ?>" class="thb-id">
	<?php endif; ?>

	<a href="#" class="thb-upload">
		<img src="<?php echo $preview; ?>" class="thb-preview image" alt="">

		<?php if( isset( $overlay ) && $overlay ) : ?>
			<span class="thb-overlay"></span>
		<?php endif; ?>

		<span class="thb-remove thb-upload-remove" style="<?php echo $removeStyle; ?>">
			<?php _e('remove image', 'thb_text_domain'); ?>
		</span>
	</a>
</div>