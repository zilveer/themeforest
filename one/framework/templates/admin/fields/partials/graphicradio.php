<div class="thb-radio-options">
	<?php $i=0; foreach( $field_options as $value => $image ) : ?>
		<?php
			$checked = ($field_value != '' && $field_value == $value) ? 'checked' : '';

			if ( $field_value == '' && $i == 0 ) {
				$checked = true;
			}
		?>
		<div data="thb-radio-option-<?php echo $field_name; ?>" class="thb-radio-option">
			<input type="radio" name="<?php echo $field_name; ?>" value="<?php echo $value; ?>" <?php echo !empty($checked) ? 'checked' : ''; ?>>
			<img src="<?php echo $image; ?>" alt="" class="<?php echo !empty($checked) ? 'thb-checked' : ''; ?>">
		</div>
	<?php $i++; endforeach; ?>
</div>