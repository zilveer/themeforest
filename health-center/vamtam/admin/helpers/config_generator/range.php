<?php
	/*
		range input
	*/

	$min = isset($min) ? "min='$min' " : '';
	$max = isset($max) ? "max='$max' " : '';
	$step = isset($step) ? "step='$step' " : '';
	$unit = isset($unit) ? $unit : '';
	$class = isset($class) ? $class : '';
?>

<div class="wpv-config-row <?php echo $class?> clearfix">
	<div class="rtitle">
		<h4><?php echo $name?></h4>
	
		<?php wpv_description($id, $desc) ?>
	</div>
	
	<div class="rcontent">
		<div class="range-input-wrap clearfix">
			<span>
				<input name="<?php echo $id?>" id="<?php echo $id?>" type="text" value="<?php echo wpv_get_option($id, $default)?>" <?php echo $min.$max.$step ?> class="wpv-range-input <?php wpv_static($value)?>" />
				<span><?php echo $unit?></span>
			</span>	
		</div>
	
	</div>
</div>