<input name="<?php echo $this->name; ?>" id="<?php echo $args['id']; ?>" value="<?php echo get_option($this->name, $args['default']) ?>" class="pickcolor <?php echo $args['class']; ?>" type="text" size="<?php echo $args['size']; ?>" style="background-color:<?php echo get_option($this->name, $args['default']) ?>;">
<div id="colorPickerDiv-<?php echo $args['id']; ?>" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
<?php
	global $_theme_pickers;
	$_theme_pickers[$args['id']] = 'colorPickerDiv-'.$args['id'];
?>
<?php if (!empty($args['desc'])) : ?>
	<span class="description"><?php echo $args['desc']; ?></span>
<?php endif; ?>
