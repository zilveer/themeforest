<?php
	thb_partial_upload(array(
		'field_name_url' => $field_name_url,
		'field_value_url' => $field_value_url,
		'field_name_id' => $field_name_id,
		'field_value_id' => $field_value_id
	));
?>

<?php if( $field->supportCaptions() ) : ?>
	<textarea name="<?php echo $field_name_caption; ?>"><?php echo $field_value_caption; ?></textarea>
<?php else : ?>
	<input type="hidden" name="<?php echo $field_name_caption; ?>" value="<?php echo $field_value_caption; ?>">
<?php endif; ?>

<input type="hidden" value="" name="<?php echo $field_name_autoplay; ?>">
<input type="hidden" value="" name="<?php echo $field_name_loop; ?>">
<input type="hidden" value="" name="<?php echo $field_name_poster; ?>">