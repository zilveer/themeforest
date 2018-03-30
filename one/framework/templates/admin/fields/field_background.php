<div class="thb-field-inner-wrapper">
	<?php
		thb_partial_upload(array(
			'field_name'  => $field_name_id,
			'field_value' => $field_value_id,
			'field_label' => $field_label,
			'overlay'	  => true
		));
	?>

	<div class="thb-field-row-inner-wrapper">
		<div class="thb-field-inner">
			<p class="thb-field-label"><?php _e('Overlay enable', 'thb_text_domain') ?></p>
			<?php thb_input_checkbox( $field_name_overlay_display, $field_value_overlay_display ); ?>
		</div>

		<div class="thb-field-inner">
			<p class="thb-field-label"><?php _e('Overlay color', 'thb_text_domain') ?></p>
			<input type="text" class="thb-overlay-color" name="<?php echo $field_name_overlay_color; ?>" value="<?php echo $field_value_overlay_color; ?>">
		</div>

		<div class="thb-field-inner">
			<p class="thb-field-label"><?php _e('Overlay opacity', 'thb_text_domain') ?></p>
			<input class="thb-overlay-opacity thb-number" type="number" step="0.05" min="0" max="1" name="<?php echo $field_name_overlay_opacity; ?>" value="<?php echo $field_value_overlay_opacity; ?>">
		</div>
	</div>

	<div class="thb-field-row-inner-wrapper">
		<div class="thb-field-inner">
			<p class="thb-field-label"><?php _e('Background color', 'thb_text_domain') ?></p>
			<input type="text" class="thb-colorpicker" name="<?php echo $field_name_background_color; ?>" value="<?php echo $field_value_background_color; ?>">
		</div>
	</div>
</div>