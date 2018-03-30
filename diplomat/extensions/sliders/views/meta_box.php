<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="slider">
	<p><?php _e("Slider type", 'diplomat') ?>:</p>
	<div class="sel">
		<select name="page_slider_type" autocomplete="off">
			<?php foreach ($slider_types as $key => $type) : ?>
				<option <?php echo ($page_slider_type == $key ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($type) ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="sel">
		<?php
		$page_slider_widths = array(
			'wide' => __("wide", 'diplomat'),
			'fixed' => __("fixed", 'diplomat'),
		);
		if (!isset($page_slider_width)) {
			$page_slider_width = 'wide';
		}
		?>
		<select name="page_slider_width">
			<?php foreach ($page_slider_widths as $key => $type) : ?>
				<option <?php echo ($page_slider_width == $key ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($type) ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<hr />

	<div class="native_sliders_groups" <?php if ($page_slider_type == 'layerslider' OR $page_slider_type == 'cuteslider'): ?>style="display: none;"<?php endif; ?>>
		<p><?php esc_html_e("Slider group", 'diplomat') ?>:</p>
		<?php if (!empty($slides)): ?>
			<div class="sel"><select name="page_slider">
					<option value=""><?php esc_html_e("Choose slider group", 'diplomat') ?></option>
					<?php foreach ($slides as $key => $name) : ?>

						<option <?php echo ($page_slider == $key ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($name); ?></option>

					<?php endforeach; ?>
				</select></div>
		<?php else: ?>
			<p><?php esc_html_e("You still haven't created any slider group.", 'diplomat') ?><br><a href="<?php echo esc_url(admin_url('post-new.php?post_type=' . TMM_Slider::$slug)); ?>"><?php esc_attr_e("Click here", 'diplomat') ?></a> <?php esc_attr_e("to create one.", 'diplomat') ?></p>
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
			<p><?php esc_html_e("Layerslider's groups", 'diplomat') ?>:</p>
			<div class="sel">
				<select name="layerslider_slide_group">
					<option value=""><?php esc_html_e("Choose slider group", 'diplomat') ?></option>
					<?php if (!empty($sliders)) : ?>
						<?php foreach ($sliders as $item) : ?>
							<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
							<option <?php echo ($layerslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo esc_attr($item->id); ?>"><?php echo esc_html($name); ?></option>
						<?php endforeach; ?>
					<?php else: ?>
						<?php esc_html_e("You still haven't created any slider group for your Layerslider.", 'diplomat') ?>
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
			<p><?php esc_attr_e("Cuteslider's groups", 'diplomat') ?>:</p>
			<div class="sel">
				<select name="cuteslider_slide_group">
					<option value=""><?php esc_attr_e("Choose slider group", 'diplomat') ?></option>
					<?php if (!empty($sliders)) : ?>
						<?php foreach ($sliders as $item) : ?>
							<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
							<option <?php echo ($cuteslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo esc_attr($item->id); ?>"><?php echo esc_html($name); ?></option>
						<?php endforeach; ?>
					<?php else: ?>
						<?php esc_attr_e("You still haven't created any slider group for your Cuteslider.", 'diplomat') ?>
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
			}

			if (value == 'cuteslider') {
				jQuery(".native_sliders_groups").hide();
				jQuery("#layerslider_slidegroups").hide();
				jQuery("#cutelider_slidegroups").show();
				return;
			}

			jQuery(".native_sliders_groups").show();
			jQuery("#layerslider_slidegroups").hide();
			jQuery("#cutelider_slidegroups").hide();

		});
	});
</script>