<?php
/**
 * icons selector
 */

	$checked = wpv_get_option($id, $default);
?>

<div class="wpv-config-row icons clearfix <?php echo $class?>">

	<div class="rtitle">
		<h4><label><?php echo $name?></label></h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent">
		<div class="wpv-config-icons-selector">
			<input type="search" placeholder="<?php esc_attr_e('Filter icons', 'health-center') ?>" class="icons-filter"/>
			<div class="icons-wrapper spinner">
				<input type="radio" name="<?php echo $id?>" id="<?php echo $id ?>-initial" value="" checked="checked"/>
			</div>
		</div>
	</div>
</div>
