<?php
	$select_attrs['name'] = $field_name;
	$select_attrs['class'] = $select_class;

	$data_attrs = array(
		'target' => "[name='$field_name']",
		'value' => $field_value
	);

	if ( $field->isMultiple() ) {
		unset( $data_attrs['value'] );
		unset( $select_attrs['name'] );
		$field_value = explode( ',', $field_value );
	}

	if ( $field->getCallback() !== false ) {
		$data_attrs['callback'] = $field->getCallback();
	}
?>

<?php if( $field->isMultiple() ) : ?>
	<input type="hidden" name="<?php echo $field_name; ?>" value="<?php echo implode( ',', $field_value ); ?>">
<?php endif; ?>

<select <?php thb_attributes($select_attrs); ?> <?php thb_data_attributes($data_attrs); ?>>

	<?php if( $field->isStructured() ) : ?>

		<?php foreach( $field_options as $optgroup => $options ) : ?>
			<optgroup label="<?php echo $optgroup; ?>">
				<?php foreach( $options as $value => $label ) : ?>
					<?php
						if ( $field->isMultiple() ) {
							$selected = ( !empty($field_value) && in_array($value, $field_value) ) ? 'selected' : '';
						}
						else {
							$selected = ( $field_value != '' && $field_value == $value ) ? 'selected' : '';
						}
					?>
					<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
			</optgroup>
		<?php endforeach; ?>

	<?php else : ?>

		<?php foreach( $field_options as $value => $label ) : ?>
			<?php
				if ( $field->isMultiple() ) {
					$selected = ( !empty($field_value) && in_array($value, $field_value) ) ? 'selected' : '';
				}
				else {
					$selected = ( $field_value != '' && $field_value == $value ) ? 'selected' : '';
				}
			?>
			<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
		<?php endforeach; ?>

	<?php endif; ?>

</select>