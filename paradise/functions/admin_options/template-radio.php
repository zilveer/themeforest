<?php $_current_value = get_option($this->name, $args['default']); ?>
<?php
	$options = $args['options'];
	if (isset($args['options_func']) && !empty($args['options_func'])) {
		$add_options = call_user_func($args['options_func']);
		$options = array_merge($options, $add_options);
	}
?>
<?php foreach($options as $value => $label): ?>
<label class="radio">
	<input type="radio" <?php checked($_current_value, $value); ?> value="<?php echo $value; ?>" name="<?php echo $this->name; ?>" />
	<?php echo $label; ?>
</label>
<?php endforeach; ?>
<?php if (!empty($args['desc'])): ?>
<p><?php echo $args['desc']; ?></p>
<?php endif; ?>