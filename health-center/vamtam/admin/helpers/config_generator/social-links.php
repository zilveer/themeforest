<?php
/**
 * social links
 */

$data = wpv_get_option($id, $default);
if(empty($data))
	$data = '[]';
?>

<div class="wpv-config-row social-links <?php echo $class ?> <?php echo empty($desc) ? 'no-desc':''?>">
	<div class="rtitle">
		<h4>
			<label for="<?php echo $id?>"><?php echo $name?></label>
		</h4>

		<?php wpv_description($id, $desc) ?>
	</div>

	<div class="rcontent">
		<div class="wpv-config-icons-selector hidden">
			<input type="search" placeholder="<?php esc_attr_e('Filter icons', 'health-center') ?>" class="icons-filter"/>
			<div class="icons-wrapper spinner">
				<input type="radio" value="" checked="checked"/>
			</div>
		</div>
		<div class="social-links-builder"></div>
		<textarea id="<?php echo $id?>" name="<?php echo $id?>" class="data hidden <?php wpv_static($value)?>"><?php echo $data;?></textarea>
	</div>
</div>
