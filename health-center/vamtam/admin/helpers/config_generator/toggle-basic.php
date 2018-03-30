<?php if(isset($image)): ?>
	<img src="<?php echo $image?>" alt="<?php echo $name ?>" class="alignleft" />
<?php endif ?>
<label class="toggle-radio">
	<input type="radio" name="<?php echo $id?>" value="true" <?php checked($checked, true) ?>/>
	<span><?php _e('On', 'health-center') ?></span>
</label>
<label class="toggle-radio">
	<input type="radio" name="<?php echo $id?>" value="false" <?php checked($checked, false) ?>/>
	<span><?php _e('Off', 'health-center') ?></span>
</label>
<?php if(isset($has_default) && $has_default): ?>
	<label class="toggle-radio">
		<input type="radio" name="<?php echo $id?>" value="default" <?php checked($checked, 'default') ?>/>
		<span><?php _e('Default', 'health-center') ?></span>
	</label>
<?php endif ?>