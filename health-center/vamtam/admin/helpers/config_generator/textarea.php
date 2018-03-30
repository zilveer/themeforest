<?php
/**
 * textarea
 */

 $rows = isset($rows) ? $rows : 5;
?>

<div class="wpv-config-row textarea <?php echo $class ?> <?php echo empty($desc) ? 'no-desc':''?>">
	<div class="rtitle">
		<h4>
			<label for="<?php echo $id?>"><?php echo $name?></label>
		</h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent">
		<textarea id="<?php echo $id?>" rows="<?php echo $rows ?>" name="<?php echo $id?>" class="large-text code <?php wpv_static($value)?>"><?php echo wpv_get_option($id, $default);?></textarea>
	</div>
</div>
