<?php
/**
 * on/off toggle
 */

$option = $value;
$checked = wpv_get_option($id, $default);

$ff = empty($field_filter) ? '' : "data-field-filter='$field_filter'";
?>

<div class="wpv-config-row toggle <?php echo $class ?> clearfix" <?php echo $ff ?>>
	<div class="rtitle">
		<h4><?php echo $name?></h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent clearfix">
		<?php include 'toggle-basic.php' ?>
	</div>
</div>
