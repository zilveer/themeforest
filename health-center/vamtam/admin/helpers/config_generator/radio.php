<?php
/**
 * radio
 */

	if (isset($target)) {
		if (isset($options))
			$options = $options + WpvConfigGenerator::get_select_target_config($target);
		else
			$options = WpvConfigGenerator::get_select_target_config($target);
	}

	$checked = wpv_get_option($id, $default);
	$ff = empty($field_filter) ? '' : "data-field-filter='$field_filter'";
?>

<div class="wpv-config-row radio clearfix <?php echo $class?>" <?php echo $ff ?>>
	
	<div class="rtitle">
		<h4><label for="<?php echo $id?>"><?php echo $name?></label></h4>
		
		<?php wpv_description($id, $desc) ?>
	</div>
	
	<div class="rcontent">
		<?php foreach($options as $key => $option): ?>
			<label class="toggle-radio">
				<input type="radio" name="<?php echo $id?>" value="<?php echo $key ?>" <?php checked($checked, $key) ?>/>
				<span><?php echo $option ?></span>
			</label>
		<?php endforeach ?>
	</div>
</div>
