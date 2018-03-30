<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="slider">
	<p><?php _e("Slider type", 'cardealer') ?>:</p>
	<div class="sel">
		<select name="page_slider_type">
			<?php foreach ($slider_types as $key => $type) : ?>
				<option <?php selected($page_slider_type, $key); ?> value="<?php echo $key ?>"><?php echo $type ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="native_sliders_groups" style="display:<?php echo $page_slider_type === 'flex' ? 'block' : 'none'; ?>">
		<p><?php _e("Slider group", 'cardealer') ?>:</p>
		<?php if (!empty($slides)): ?>
			<div class="sel"><select name="page_slider">
				<option value=""><?php _e("Choose slider group", 'cardealer') ?></option>
				<?php foreach ($slides as $key => $name) : ?>

					<option <?php echo ($page_slider == $key ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $name ?></option>

				<?php endforeach; ?>
			</select></div>
		<?php else: ?>
			<p><?php _e("You still haven't created any slider group.", 'cardealer') ?><br><a href="<?php echo admin_url() ?>/post-new.php?post_type=slidergroup"><?php _e("Click here", 'cardealer') ?></a> <?php _e("to create one.", 'cardealer') ?></p>
		<?php endif; ?>
	</div>

	<?php if (is_plugin_active('LayerSlider/layerslider.php') || class_exists('LayerSlider')): ?>
		<div id="layerslider_slidegroups" <?php if ($page_slider_type != 'layerslider'): ?>style="display: none;"<?php endif; ?>>

			<?php
			global $wpdb;
			$table_name = $wpdb->prefix . "layerslider";
			// Get sliders
			$sliders = $wpdb->get_results("SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY id ASC LIMIT 200");
			?>
			<p><?php _e("Layerslider's groups", 'cardealer') ?>:</p>
			<div class="sel">
			<select name="layerslider_slide_group">
				<option value=""><?php _e("Choose slider group", 'cardealer') ?></option>
				<?php if (!empty($sliders)) : ?>
					<?php foreach ($sliders as $item) : ?>
						<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
						<option <?php echo ($layerslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo $item->id ?>"><?php echo $name ?></option>
					<?php endforeach; ?>
				<?php else: ?>
					<?php _e("You still haven't created any slider group for your Layerslider.", 'cardealer') ?>
				<?php endif; ?>
			</select>
			</div>
		</div>
	<?php endif; ?>


	<?php if (function_exists('cuteslider_init')): ?>
		<div id="cutelider_slidegroups" <?php if ($page_slider_type != 'cuteslider'): ?>style="display: none;"<?php endif; ?>>

			<?php
			global $wpdb;
			$table_name = $wpdb->prefix . "cuteslider";
			// Get sliders
			$sliders = $wpdb->get_results("SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY id ASC LIMIT 200");
			?>
			<p><?php _e("Cuteslider's groups", 'cardealer') ?>:</p>
			<div class="sel">
				<select name="cuteslider_slide_group">
					<option value=""><?php _e("Choose slider group", 'cardealer') ?></option>
					<?php if (!empty($sliders)) : ?>
						<?php foreach ($sliders as $item) : ?>
							<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
							<option <?php echo ($cuteslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo $item->id ?>"><?php echo $name ?></option>
						<?php endforeach; ?>
					<?php else: ?>
						<?php _e("You still haven't created any slider group for your Cuteslider.", 'cardealer') ?>
					<?php endif; ?>
				</select>
			</div>
		</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>

<script type="text/javascript">
	jQuery(function() {
		jQuery("[name='page_slider_type']").change(function() {

			var value = jQuery(this).val();
			if (value == 'layerslider') {
				jQuery(".native_sliders_groups").hide();
				jQuery("#cutelider_slidegroups").hide();
				jQuery("#layerslider_slidegroups").show();
				return;
			} else if (value == 'cuteslider') {
				jQuery(".native_sliders_groups").hide();
				jQuery("#layerslider_slidegroups").hide();
				jQuery("#cutelider_slidegroups").show();
				return;
			} else if (value == 'flex') {
				jQuery(".native_sliders_groups").show();
				jQuery("#layerslider_slidegroups").hide();
				jQuery("#cutelider_slidegroups").hide();
			} else {
				jQuery(".native_sliders_groups").hide().find('select').val('');
				jQuery("#layerslider_slidegroups").hide().find('select').val('');
				jQuery("#cutelider_slidegroups").hide().find('select').val('');
			}

		});
	});
</script>