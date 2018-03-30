<?php
/**
 * combobox + checkbox
 */
?>

<?php
	if (isset($target)) {
		if (isset($options))
			$options = $options + WpvConfigGenerator::get_select_target_config($target);
		else
			$options = WpvConfigGenerator::get_select_target_config($target);
	}
	
	if(!isset($default_select)) {
		$default_select = null;
	}
	
	if(!isset($default_checkbox)) {
		$default_checkbox = null;
	}

	$selected = wpv_get_option($id_select, $default_select);
	
	$checkbox_value = wpv_get_option($id_checkbox, $default_checkbox);
	if($checkbox_value == 'true')
		$checkbox_value = true;
	elseif($checkbox_value == 'false')
		$checkbox_value = false;
?>

<div class="wpv-config-row select_checkbox clearfix">
	<div class="rtitle">
		<h4><?php echo $name?></h4>
		
		<?php wpv_description($id, $desc) ?>
	</div>
	
	<div class="rcontent clearfix">
		<select name="<?php echo $id_select?>" id="<?php echo $id_select?>" class="<?php wpv_static($value)?>">
		
			<?php if(isset($prompt)): ?>
				<option value=""><?php echo $prompt?></option>
			<?php endif ?>
			
			<?php foreach($options as $key => $option): ?>
				<option value="<?php echo $key?>" <?php selected($selected, $key) ?>><?php echo $option?></option>
			<?php endforeach ?>
		
			<?php if (isset($page)): ?>
				<?php 
				$args = array(
					'depth' => $page,
					'child_of' => 0,
					'selected' => $selected,
					'echo' => 1,
					'name' => 'page_id',
					'id' => '',
					'show_option_none' => '',
					'show_option_no_change' => '',
					'option_none_value' => ''
				);
				$pages = get_pages($args);
			
				echo walk_page_dropdown_tree($pages,$depth,$args);
				?>
			<?php endif ?>
		
		</select>
		
		<div class="checkbox">
			<label>
				<input type="checkbox" name="<?php echo $id_checkbox?>" id="<?php echo $id_checkbox?>" value="true" <?php checked($checkbox_value, true) ?> class="<?php wpv_static($value)?>" />
				<?php echo $label ?>
			</label>
		</div>
	
	</div>
</div>
