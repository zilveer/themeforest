<input name="<?php echo $this->name; ?>"  id="<?php echo $args['id']; ?>" class="<?php echo $args['class']; ?>" type="checkbox" value="1" <?php if (get_option($this->name, $args['default'])): ?>checked="checked"<?php endif; ?>>
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>
