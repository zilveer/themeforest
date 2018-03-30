<?php
/**
 * text input
 */
?>

<div class="wpv-config-row text clearfix <?php echo $class ?>">
	
	<div class="rtitle">
		<h4>
			<label for="<?php echo $id?>"><?php echo $name?></label>
		</h4>
		
		<?php wpv_description($id, $desc) ?>
	</div>
	
	<div class="rcontent">
		<input name="<?php echo $id?>" id="<?php echo $id?>" type="text" class="large-text <?php wpv_static($value)?>" size="<?php echo isset($size) ? $size : 10?>" value="<?php echo esc_attr(wpv_get_option($id, $default))?>" />
	</div>
</div>
