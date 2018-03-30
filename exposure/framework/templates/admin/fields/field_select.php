<select name="<?php echo $field_name; ?>">

	<?php if( $field->isStructured() ) : ?>
	
		<?php foreach( $field_options as $optgroup => $options ) : ?>
			<optgroup label="<?php echo $optgroup; ?>">
				<?php foreach( $options as $value => $label ) : ?>
					<?php
						$selected = ($field_value != '' && $field_value == $value) ? 'selected' : '';
					?>
					<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
			</optgroup>
		<?php endforeach; ?>
	
	<?php else : ?>
	
		<?php foreach( $field_options as $value => $label ) : ?>
			<?php
				$selected = ($field_value != '' && $field_value == $value) ? 'selected' : '';
			?>
			<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
		<?php endforeach; ?>
		
	<?php endif; ?>

</select>