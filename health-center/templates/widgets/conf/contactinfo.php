<p>
	<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Icons Color:', 'health-center'); ?></label>
	<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
		<option value="accent1"<?php selected($color, 'accent1'); ?>>Accent 1</option>
		<option value="accent2"<?php selected($color, 'accent2'); ?>>Accent 2</option>
		<option value="accent3"<?php selected($color, 'accent3'); ?>>Accent 3</option>
		<option value="accent4"<?php selected($color, 'accent4'); ?>>Accent 4</option>
		<option value="accent5"<?php selected($color, 'accent5'); ?>>Accent 5</option>
		<option value="accent6"<?php selected($color, 'accent6'); ?>>Accent 6</option>
		<option value="accent7"<?php selected($color, 'accent7'); ?>>Accent 7</option>
		<option value="accent8"<?php selected($color, 'accent8'); ?>>Accent 8</option>
	</select>
</p>
<?php foreach($this->fields as $name=>$field): ?>
	<p>
		<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['description']; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" type="text" value="<?php echo $field['value']; ?>" />
	</p>
<?php endforeach ?>