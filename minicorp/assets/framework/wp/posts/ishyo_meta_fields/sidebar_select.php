<select name="<?php echo $id?>" id="<?php echo $id?>">
	<?php foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar): ?>
		<option <?php selected($value, $sidebar['id'] )?> value="<?php echo $sidebar['id']; ?>"><?php echo $sidebar['name']?></option>
	<?php endforeach ?>
</select>
