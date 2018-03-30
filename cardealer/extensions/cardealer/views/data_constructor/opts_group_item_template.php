<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<a class="delete_option_from_data_item_select remove-button close-drag-holder" title="<?php _e("Remove Item", 'cardealer') ?>" href="#"></a>
<div class="option">

	<?php
	if ($index === 'currency') {
		$value = htmlspecialchars($value);
		if(empty($value)){
			$cur_name = '';
		}else{
			$cur_name = strtoupper($key);
		}
		?>

		<div class="controls">
			<input type="text" placeholder="<?php _e('Type item code here', 'cardealer'); ?>" value="<?php echo $cur_name; ?>" name="default_options[<?php echo $index ?>][<?php echo $key ?>][name]" />
		</div>
		<div class="explain"><?php _e('ISO code. Example: USD', 'cardealer') ?></div>
		<br><br>
		<div class="controls">
			<input type="text" placeholder="<?php _e('Type item symbol here', 'cardealer'); ?>" value="<?php echo $value ?>" name="default_options[<?php echo $index ?>][<?php echo $key ?>][symbol]" />
		</div>
		<div class="explain"><?php echo __('HTML symbol. Example: ', 'cardealer') . htmlspecialchars('&#36;'); ?></div>


		<?php
	} else {
		?>

		<div class="controls">
			<input type="text" placeholder="<?php _e('Type item name here', 'cardealer'); ?>" value="<?php echo $value ?>" name="default_options[<?php echo $index ?>][<?php echo $key ?>]" />
		</div>
		<div class="explain"><?php _e('Enter Item Name', 'cardealer') ?></div>

		<?php
	}
	?>

</div>

