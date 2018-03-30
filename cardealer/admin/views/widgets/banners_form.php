<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('size'); ?>"><?php _e('Size', 'cardealer') ?>:</label>
	<?php
	$sizes_array = array(
		250 => '100%',
		125 => '2x50%',
	);
	if(!isset($instance['size']) || !$instance['size']){
		$instance['size'] = 250;
	}
	?>
    <select id="<?php echo $widget->get_field_id('size'); ?>" name="<?php echo $widget->get_field_name('size'); ?>" class="widefat tmm_baners_widget_size">       
		<?php foreach ($sizes_array as $size => $size_name) : ?>
			<option <?php echo($size == $instance['size'] ? "selected" : "") ?> value="<?php echo $size ?>"><?php echo $size_name ?></option>
		<?php endforeach; ?>
    </select>

</p>

<p>
    <label for="<?php echo $widget->get_field_id('text1'); ?>"><?php _e('Content 1', 'cardealer') ?>:</label>
    <textarea name="<?php echo $widget->get_field_name('text1'); ?>" id="<?php echo $widget->get_field_id('text1'); ?>" class="widefat"><?php echo $instance['text1']; ?></textarea>
</p>

<p style="display: <?php if ($instance['size'] != 250): ?>block<?php else: ?>none<?php endif; ?>" class="js_banner2_content">
    <label for="<?php echo $widget->get_field_id('text2'); ?>"><?php _e('Content 2', 'cardealer') ?>:</label>
    <textarea name="<?php echo $widget->get_field_name('text2'); ?>" id="<?php echo $widget->get_field_id('text2'); ?>" class="widefat"><?php echo $instance['text2']; ?></textarea>
</p>

<script type="text/javascript">
	jQuery(function() {
		jQuery('#thememakers_default_sidebar').life('change','.tmm_baners_widget_size', function() {
			var val = parseInt(jQuery('#thememakers_default_sidebar .tmm_baners_widget_size').val(), 10);
			switch (val) {
				case 250:
					jQuery('.js_banner2_content').hide(200);
					break;
				case 125:
					jQuery('.js_banner2_content').show(200);
					break;
			}
		});
	});
</script>