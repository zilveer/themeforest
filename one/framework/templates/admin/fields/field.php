<div class="thb-field thb-field-<?php echo $field_template_class; ?> <?php echo $field_class; ?>">
	<?php if( !empty($field_label) || !empty($field_help) ) : ?>
		<div class="thb-label-help-wrapper">
			<?php echo $field_label; ?>
			<?php echo $field_help; ?>
		</div>
	<?php endif; ?>

	<div class="thb-field-content-wrapper">
		<?php echo $field_content; ?>
	</div>

	<?php if ( count( $field->getModals() ) > 0 ) : ?>
		<?php foreach ( $field->getSubkeys() as $key ) : ?>
			<input type="hidden" data-name="<?php echo $key; ?>" name="<?php echo $field_name[$key]; ?>" value="<?php echo $field_value[$key]; ?>">
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if( $is_duplicable ) : ?>
		<input type="hidden" name="<?php echo $_field_name; ?>[<?php echo $field->getIndex(); ?>][subtemplate]" value="<?php echo $subtemplate; ?>">
		<input type="hidden" name="<?php echo $_field_name; ?>[<?php echo $field->getIndex(); ?>][uniqid]" value="<?php echo $uniqid; ?>" data-uniqid="1">

		<a class="thb-remove" href="">
			<?php _e('Remove', 'thb_text_domain'); ?>
		</a>
	<?php endif; ?>
</div>