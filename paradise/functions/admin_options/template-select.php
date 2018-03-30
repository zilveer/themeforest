<?php $_current_value = get_option($this->name, $args['default']); ?>
<?php $_onchange = (isset($args['onchange'])) ? ' onchange="'.$args['onchange'].'"' : ''; ?>
<select id="<?php echo $args['id']; ?>" class="<?php echo $args['class']; ?>" name="<?php echo $this->name; ?>"<?php echo $_onchange; ?>>
	<?php if (!empty($args['empty'])): ?>
	<option <?php selected($_current_value, ''); ?> value=""><?php echo $args['empty']; ?></option>
	<?php endif; ?>
	<?php
		$options = $args['options'];
		if (isset($args['options_func']) && !empty($args['options_func'])) {
			$add_options = call_user_func($args['options_func']);
			$options = array_merge($options, $add_options);
		}
	?>
	<?php foreach($options as $value => $label): ?>
	<option <?php selected($_current_value, $value); ?> value="<?php echo $value; ?>"><?php echo $label; ?></option>
	<?php endforeach; ?>
</select>
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>

