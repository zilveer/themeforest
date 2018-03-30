<input name="<?php echo $this->name; ?>" id="<?php echo $args['id']; ?>" value="<?php echo get_option($this->name, $args['default']) ?>" class="<?php echo $args['class']; ?>" type="text" size="<?php echo $args['size']; ?>">
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>
