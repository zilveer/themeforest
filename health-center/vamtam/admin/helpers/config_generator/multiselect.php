<?php
/**
 * select multiple
 */
?>

<?php
	$size = isset($size) ? $size : '5';
	if (isset($target)) {
		if (isset($options))
			$options = $options + WpvConfigGenerator::get_select_target_config($target);
		else
			$options = WpvConfigGenerator::get_select_target_config($target);
	}
	if(!is_array($default)) {
		$default = unserialize($default);
	}
	$selected = wpv_default(wpv_get_option($id, $default, false), array());
?>

<div class="wpv-config-row <?php echo $class ?> clearfix">
	<div class="rtitle">
		<h4><?php echo $name?></h4>
		
		<?php wpv_description($id, $desc) ?>
	</div>
	
	<div class="rcontent">

		<?php if(!isset($layout) || $layout === 'select' ): ?>
			<select name="<?php echo $id?>[]" id="<?php echo $id?>" multiple="multiple" size="<?php echo $size?>" class="<?php wpv_static($value)?>">
			
				<?php if(!empty($options) && is_array($options)): ?>
					<?php foreach($options as $key => $option): ?>
						<option value="<?php echo $key?>" <?php echo (in_array($key, $selected)) ? 'selected="selected"' : '' ?>>
							<?php echo $option ?>
						</option>
					<?php endforeach ?>
				<?php endif ?>
			
			</select>
		<?php else: ?>
			<?php if(!empty($options) && is_array($options)): ?>
				<?php foreach($options as $key => $option): ?>
					<label class="checkbox-row">
						<input type="checkbox" name="<?php echo $id?>[]"  class="<?php wpv_static($value)?>" value="<?php echo $key ?>" <?php checked(in_array($key, $selected), true) ?> />
						<?php echo $option ?>
					</label>
					<br />
				<?php endforeach ?>
			<?php endif ?>
		<?php endif ?>

	</div>
</div>
