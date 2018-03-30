<div class="thb-field thb-field-<?php echo $field_template_class; ?> <?php echo $field_class; ?>">
	<?php echo $field_label; ?>
	<?php echo $field_content; ?>
	<?php echo $field_help; ?>

	<?php if( $is_duplicable ) : ?>
		<input type="hidden" name="subtemplate[<?php echo $field_name; ?>][]" value="<?php echo $subtemplate; ?>">
		<input type="hidden" name="uniqid[<?php echo $field_name; ?>][]" value="<?php echo $uniqid; ?>" data-uniqid="1">

		<a class="thb-remove" href="">
			<?php _e('Remove', 'thb_text_domain'); ?>
		</a>
	<?php endif; ?>
</div>