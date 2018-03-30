<?php
/**
 * color input
 */
?>
<div class="wpv-config-row clearfix <?php echo $class ?>">
	<div class="rtitle">
		<h4><?php echo $name ?></h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent">
		<div class="color-input-wrap">
			<input name="<?php echo $id ?>" id="<?php echo $id ?>" type="text" value="<?php echo wpv_get_option($id, $default) ?>" class="wpv-color-input <?php wpv_static($value)?>" required />
		</div>
	</div>
</div>