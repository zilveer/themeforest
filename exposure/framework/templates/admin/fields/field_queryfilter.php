<?php if( !$hide_num ) : ?>
	<div class="thb-field-row">
		<label for="<?php echo $field_name_num; ?>"><?php echo $labels['num']; ?></label>
		<input type="number" step="1" min="-1" name="<?php echo $field_name_num; ?>" value="<?php echo $field_value_num; ?>">
		<div class="thb-field-help">
			<?php echo __('Enter -1 to show all the entries.', 'thb_text_domain'); ?>
		</div>
	</div>
<?php endif; ?>

<?php if( !empty($taxonomies) ) : ?>
	<div class="thb-field-row">
		<label for="<?php echo $field_name_filter; ?>"><?php echo $labels['filter']; ?></label>
		<input type="text" name="<?php echo $field_name_filter; ?>" value="<?php echo $field_value_filter; ?>">
		<div class="thb-field-help">
			<?php echo __('Syntax: <code>{category_name}:{term_id}</code>, comma separated. Available taxonomies: ', 'thb_text_domain') . '<code>' . implode(', ', $taxonomies) . '</code>. ' . __('Eg.', 'thb_text_domain') . '<code>' . $taxonomies[0] . ':3</code>'; ?>
		</div>
	</div>
	<div class="thb-field-row">
		<label for="<?php echo $field_name_include_subcategories; ?>"><?php echo $labels['include_subcategories']; ?></label>
		<?php thb_input_checkbox($field_name_include_subcategories, $field_value_include_subcategories == 1); ?>
		<div class="thb-field-help">
			<?php echo __('When filtering by one or more category, include items belonging to subcategories in the results.', 'thb_text_domain'); ?>
		</div>
	</div>
<?php endif; ?>

<div class="thb-field-row">
	<label for="<?php echo $field_name_orderby; ?>"><?php echo $labels['orderby']; ?></label>
	<select name="<?php echo $field_name_orderby; ?>" class="thb_query_orderby">
		<?php foreach( $orderby_options as $value => $label ) : ?>
			<?php
				$selected = ($field_value_orderby != '' && $field_value_orderby == $value) ? 'selected' : '';
			?>
			<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
		<?php endforeach; ?>
	</select>

	<select name="<?php echo $field_name_order; ?>" class="thb_query_order">
		<?php foreach( $order_options as $value => $label ) : ?>
			<?php
				$selected = ($field_value_order != '' && $field_value_order == $value) ? 'selected' : '';
			?>
			<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
		<?php endforeach; ?>
	</select>
</div>