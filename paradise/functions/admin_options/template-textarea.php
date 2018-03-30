<textarea rows="<?php echo $args['rows']; ?>" cols="<?php echo $args['cols']; ?>" class="<?php echo $args['class']; ?>" id="<?php echo $args['id']; ?>" name="<?php echo $this->name; ?>"><?php echo get_option($this->name, $args['default']); ?></textarea>
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>
