<?php if( $field_value_css != '' ) : ?>
	<span>
		<?php echo $field_value_family; ?>
	</span>

	<input type="hidden" name="<?php echo $field_name_css; ?>" value="<?php echo $field_value_css; ?>">
	<input type="hidden" name="<?php echo $field_name_family; ?>" value="<?php echo $field_value_family; ?>">
	<input type="hidden" name="<?php echo $field_name_folder; ?>" value="<?php echo $field_value_folder; ?>">
	<input type="hidden" name="<?php echo $field_name_variants; ?>" value="<?php echo $field_value_variants; ?>">
<?php else : ?>
	<input type="file" name="<?php echo $field_basename; ?>">
<?php endif; ?>