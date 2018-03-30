<?php
/**
 * upload field
 */
?>

<div class="wpv-config-row clearfix <?php echo $class ?>">
	<div class="rtitle">
		<h4><?php echo $name?></h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent">
		<?php include 'upload-basic.php' ?>
	</div>
</div>