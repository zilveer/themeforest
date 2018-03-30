<label for="<?php echo $field_name_type; ?>"><?php _e('Type', 'thb_text_domain'); ?></label>
<select name="<?php echo $field_name_type; ?>" class="thb-clear">
	<?php
		$options = array(
			'telephone' => __('Telephone', 'thb_text_domain'),
			'cellphone' => __('Cell phone', 'thb_text_domain'),
			'fax'       => __('Fax', 'thb_text_domain'),
			'email'		=> __('Email', 'thb_text_domain'),
			'address'	=> __('Address', 'thb_text_domain'),
			'other'		=> __('Other', 'thb_text_domain')
		);
	?>

	<?php foreach( $options as $k => $v ) : ?>
		<?php $selected = $field_value_type == $k ? 'selected' : ''; ?>
		<option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
	<?php endforeach; ?>
</select>

<label for="<?php echo $field_name_key; ?>"><?php _e('Label', 'thb_text_domain'); ?></label>
<input type="text" name="<?php echo $field_name_key; ?>" value="<?php echo $field_value_key; ?>">

<label for="<?php echo $field_name_value; ?>"><?php _e('Text', 'thb_text_domain'); ?></label>
<textarea name="<?php echo $field_name_value; ?>"><?php echo $field_value_value; ?></textarea>