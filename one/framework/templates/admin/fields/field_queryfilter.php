<?php if( !$hide_num ) : ?>
	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php echo $labels['num']; ?>
			</p>
			<div class="thb-field-help">
				<?php _e('Enter -1 to show all the entries.', 'thb_text_domain'); ?>
			</div>
		</div>

		<div class="thb-field-content-wrapper">
			<input class="thb-number" type="number" step="1" min="-1" name="<?php echo $field_name_num; ?>" value="<?php echo $field_value_num; ?>">
		</div>
	</div>
<?php endif; ?>

<?php if( !empty($taxonomies) ) : ?>
	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php echo $labels['filter']; ?>
			</p>
		</div>

		<?php
			$field_value_filters = explode( ',', $field_value_filter );
		?>

		<div class="thb-field-content-wrapper">
			<select multiple="multiple" class="thb-selectize" data-template="taxonomy" data-target="[name='<?php echo $field_name_filter; ?>']">
				<?php foreach( $taxonomies as $taxonomy ) : ?>
					<optgroup value="<?php echo $taxonomy->name; ?>">
						<?php foreach( get_terms($taxonomy->name) as $term ) : ?>
							<?php
								$v = $taxonomy->name . ':' . $term->term_id;
								$selected = in_array( $v, $field_value_filters ) ? 'selected="selected"' : '';
							?>
							<option value="<?php echo $v; ?>" <?php echo $selected; ?>>
								<b><?php echo $term->name; ?></b>
							</option>
						<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>
			</select>
		</div>

		<input type="hidden" name="<?php echo $field_name_filter; ?>" value="<?php echo $field_value_filter; ?>">
	</div>

	<div class="thb-field-row">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php echo $labels['filter_exclude']; ?>
			</p>
		</div>

		<?php
			$field_value_filter_excludes = explode( ',', $field_value_filter_exclude );
		?>

		<div class="thb-field-content-wrapper">
			<select multiple="multiple" class="thb-selectize" data-template="taxonomy" data-target="[name='<?php echo $field_name_filter_exclude; ?>']">
				<?php foreach( $taxonomies as $taxonomy ) : ?>
					<optgroup value="<?php echo $taxonomy->name; ?>">
						<?php foreach( get_terms($taxonomy->name) as $term ) : ?>
							<?php
								$v = $taxonomy->name . ':' . $term->term_id;
								$selected = in_array( $v, $field_value_filter_excludes ) ? 'selected="selected"' : '';
							?>
							<option value="<?php echo $v; ?>" <?php echo $selected; ?>>
								<b><?php echo $term->name; ?></b>
							</option>
						<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>
			</select>
		</div>

		<input type="hidden" name="<?php echo $field_name_filter_exclude; ?>" value="<?php echo $field_value_filter_exclude; ?>">
	</div>

	<div class="thb-field-row thb-field-checkbox">
		<div class="thb-label-help-wrapper">
			<p class="thb-field-label">
				<?php echo $labels['include_subcategories']; ?>
			</p>
			<div class="thb-field-help">
				<?php _e('When filtering by one or more category, include/exclude items belonging to subcategories in the results.', 'thb_text_domain'); ?>
			</div>
		</div>

		<div class="thb-field-content-wrapper">
			<?php thb_input_checkbox( $field_name_include_subcategories, $field_value_include_subcategories ); ?>
		</div>
	</div>
<?php endif; ?>

<div class="thb-field-row">
	<div class="thb-label-help-wrapper">
		<p class="thb-field-label">
			<?php echo $labels['orderby']; ?>
		</p>
	</div>

	<div class="thb-field-content-wrapper">
		<select name="<?php echo $field_name_orderby; ?>" class="thb_query_orderby thb-select small" data-value="<?php echo $field_value_orderby; ?>">
			<?php foreach( $orderby_options as $value => $label ) : ?>
				<?php
					$selected = ($field_value_orderby != '' && $field_value_orderby == $value) ? 'selected' : '';
				?>
				<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>

		<select name="<?php echo $field_name_order; ?>" class="thb_query_order thb-select small" data-value="<?php echo $field_value_order; ?>">
			<?php foreach( $order_options as $value => $label ) : ?>
				<?php
					$selected = ($field_value_order != '' && $field_value_order == $value) ? 'selected' : '';
				?>
				<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>