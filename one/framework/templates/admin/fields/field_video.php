<div class="thb-field-row">
	<div class="thb-label-help-wrapper">
		<p class="thb-field-label">
			<?php _e( 'MP4', 'thb_text_domain' ); ?>
		</p>
	</div>
	<div class="thb-field-content-wrapper">
		<input type="text" placeholder="<?php _e('Insert the URL to an MP4 video file.', 'thb_text_domain'); ?>" name="<?php echo $field_name_mp4; ?>" value="<?php echo $field_value_mp4; ?>">
	</div>
</div>

<div class="thb-field-row">
	<div class="thb-label-help-wrapper">
		<p class="thb-field-label">
			<?php _e( 'OGV', 'thb_text_domain' ); ?>
		</p>
	</div>
	<div class="thb-field-content-wrapper">
		<input type="text" placeholder="<?php _e('Insert the URL to an OGV video file.', 'thb_text_domain'); ?>" name="<?php echo $field_name_ogv; ?>" value="<?php echo $field_value_ogv; ?>">
	</div>
</div>

<div class="thb-field-row">
	<div class="thb-label-help-wrapper">
		<p class="thb-field-label">
			<?php _e( 'MOV', 'thb_text_domain' ); ?>
		</p>
	</div>
	<div class="thb-field-content-wrapper">
		<input type="text" placeholder="<?php _e('Insert the URL to an MOV video file.', 'thb_text_domain'); ?>" name="<?php echo $field_name_mov; ?>" value="<?php echo $field_value_mov; ?>">
	</div>
</div>

<div class="thb-field-row">
	<div class="thb-label-help-wrapper">
		<p class="thb-field-label">
			<?php _e( 'Embed', 'thb_text_domain' ); ?>
		</p>
	</div>
	<div class="thb-field-content-wrapper">
		<input type="text" placeholder="<?php _e('Alternatively, insert the URL to an external video to be embedded.', 'thb_text_domain'); ?>" name="<?php echo $field_name_embed; ?>" value="<?php echo $field_value_embed; ?>">
	</div>
</div>

<?php if ( $controls === true ) : ?>
	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php _e( 'Autoplay', 'thb_text_domain' ); ?>
			</p>
		</div>

		<div class="thb-field-content-wrapper">
			<?php thb_input_checkbox( $field_name_autoplay, $field_value_autoplay ); ?>
		</div>
	</div>

	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php _e( 'Loop', 'thb_text_domain' ); ?>
			</p>
		</div>

		<div class="thb-field-content-wrapper">
			<?php thb_input_checkbox( $field_name_loop, $field_value_loop ); ?>
		</div>
	</div>

	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php _e( 'Fit', 'thb_text_domain' ); ?>
			</p>
			<p class="thb-field-help">
				<?php _e( 'Enable the auto fit mode: leaving this unchecked will result in a stretched video.', 'thb_text_domain' ); ?>
			</p>
		</div>

		<?php thb_input_checkbox( $field_name_fit, $field_value_fit ); ?>
	</div>
<?php else : ?>
	<input type="hidden" name="<?php echo $field_name_autoplay; ?>" value="0">
	<input type="hidden" name="<?php echo $field_name_loop; ?>" value="0">
	<input type="hidden" name="<?php echo $field_name_fit; ?>" value="0">
<?php endif; ?>