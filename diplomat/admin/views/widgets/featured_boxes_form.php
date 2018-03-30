<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<link rel="stylesheet" href="<?php echo TMM_THEME_URI; ?>/css/fontello.css" type="text/css" media="all" />
<?php $fontello_icons = TMM_Helper::get_fontello_icons();
array_unshift($fontello_icons, "None");
?>

<h3><?php esc_html_e('First Box', 'diplomat') ?></h3>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('first_box_title')); ?>"><?php esc_html_e('Button Title', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('first_box_title')); ?>" name="<?php echo esc_attr($widget->get_field_name('first_box_title')); ?>" value="<?php echo esc_attr($instance['first_box_title']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('first_box_title_color')); ?>"><?php esc_html_e('Button Title Color', 'diplomat') ?>:</label>
	<div>
		<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('first_box_title_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('first_box_title_color')); ?>" value="<?php echo esc_attr($instance['first_box_title_color']); ?>" />
		<div style="background-color: <?php echo $instance['first_box_title_color']; ?>" class="bgpicker"></div>
	</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('first_box_color')); ?>"><?php esc_html_e('Button Background Color', 'diplomat') ?>:</label>
	<div>
		<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('first_box_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('first_box_color')); ?>" value="<?php echo esc_attr($instance['first_box_color']); ?>" />
		<div style="background-color: <?php echo $instance['first_box_color']; ?>" class="bgpicker"></div>
	</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('first_box_icon')); ?>"><?php esc_html_e('Button Icon', 'diplomat') ?>:</label>
	<div>
		<select id="<?php echo esc_attr($widget->get_field_id('first_box_icon')); ?>" name="<?php echo esc_attr($widget->get_field_name('first_box_icon')); ?>" class="widefat box-icon">
			<?php
			 foreach ($fontello_icons as $key => $icon){ ?>
					<option <?php echo($key == $instance['first_box_icon'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($icon) ?></option>
			<?php } ?>
		</select>
		<div class="fontello-icon <?php echo esc_attr($instance['first_box_icon']); ?>"></div>
	</div>
	<div class="clear"></div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('first_box_link')); ?>"><?php esc_html_e('Box Link', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('first_box_link')); ?>" name="<?php echo esc_attr($widget->get_field_name('first_box_link')); ?>" value="<?php echo esc_attr($instance['first_box_link']); ?>" />
</p>

<hr>

<h3><?php esc_html_e('Second Box', 'diplomat') ?></h3>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('second_box_title')); ?>"><?php esc_html_e('Button Title', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('second_box_title')); ?>" name="<?php echo esc_attr($widget->get_field_name('second_box_title')); ?>" value="<?php echo esc_attr($instance['second_box_title']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('second_box_title_color')); ?>"><?php esc_html_e('Button Title Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('second_box_title_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('second_box_title_color')); ?>" value="<?php echo esc_attr($instance['second_box_title_color']); ?>" />
	<div style="background-color: <?php echo $instance['second_box_title_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('second_box_color')); ?>"><?php esc_html_e('Button Background Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('second_box_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('second_box_color')); ?>" value="<?php echo esc_attr($instance['second_box_color']); ?>" />
	<div style="background-color: <?php echo $instance['second_box_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('second_box_icon')); ?>"><?php esc_html_e('Button Icon', 'diplomat') ?>:</label>
<div>
	<select id="<?php echo esc_attr($widget->get_field_id('second_box_icon')); ?>" name="<?php echo esc_attr($widget->get_field_name('second_box_icon')); ?>" class="widefat box-icon">
		<?php
		foreach ($fontello_icons as $key => $icon){ ?>
			<option <?php echo($key == $instance['second_box_icon'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($icon) ?></option>
		<?php } ?>
	</select>
	<div class="fontello-icon <?php echo esc_attr($instance['second_box_icon']); ?>"></div>
</div>
<div class="clear"></div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('second_box_link')); ?>"><?php esc_html_e('Box Link', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('second_box_link')); ?>" name="<?php echo esc_attr($widget->get_field_name('second_box_link')); ?>" value="<?php echo esc_attr($instance['second_box_link']); ?>" />
</p>

<hr>

<h3><?php esc_html_e('Third Box', 'diplomat') ?></h3>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('third_box_title')); ?>"><?php esc_html_e('Button Title', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('third_box_title')); ?>" name="<?php echo esc_attr($widget->get_field_name('third_box_title')); ?>" value="<?php echo esc_attr($instance['third_box_title']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('third_box_title_color')); ?>"><?php esc_html_e('Button Title Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('third_box_title_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('third_box_title_color')); ?>" value="<?php echo esc_attr($instance['third_box_title_color']); ?>" />
	<div style="background-color: <?php echo $instance['third_box_title_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('third_box_color')); ?>"><?php esc_html_e('Button Background Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('third_box_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('third_box_color')); ?>" value="<?php echo esc_attr($instance['third_box_color']); ?>" />
	<div style="background-color: <?php echo $instance['third_box_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('third_box_icon')); ?>"><?php esc_html_e('Button Icon', 'diplomat') ?>:</label>
<div>
	<select id="<?php echo esc_attr($widget->get_field_id('third_box_icon')); ?>" name="<?php echo esc_attr($widget->get_field_name('third_box_icon')); ?>" class="widefat box-icon">
		<?php
		foreach ($fontello_icons as $key => $icon){ ?>
			<option <?php echo($key == $instance['third_box_icon'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($icon) ?></option>
		<?php } ?>
	</select>
	<div class="fontello-icon <?php echo esc_attr($instance['third_box_icon']); ?>"></div>
</div>
<div class="clear"></div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('third_box_link')); ?>"><?php esc_html_e('Box Link', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('third_box_link')); ?>" name="<?php echo esc_attr($widget->get_field_name('third_box_link')); ?>" value="<?php echo esc_attr($instance['third_box_link']); ?>" />
</p>

<hr>

<h3><?php esc_html_e('Fourth Box', 'diplomat') ?></h3>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('fourth_box_title')); ?>"><?php esc_html_e('Button Title', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('fourth_box_title')); ?>" name="<?php echo esc_attr($widget->get_field_name('fourth_box_title')); ?>" value="<?php echo esc_attr($instance['fourth_box_title']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('fourth_box_title_color')); ?>"><?php esc_html_e('Button Title Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('fourth_box_title_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('fourth_box_title_color')); ?>" value="<?php echo esc_attr($instance['fourth_box_title_color']); ?>" />
	<div style="background-color: <?php echo $instance['fourth_box_title_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('fourth_box_color')); ?>"><?php esc_html_e('Button Background Color', 'diplomat') ?>:</label>
<div>
	<input class="widefat bg_hex_color" type="text" id="<?php echo esc_attr($widget->get_field_id('fourth_box_color')); ?>" name="<?php echo esc_attr($widget->get_field_name('fourth_box_color')); ?>" value="<?php echo esc_attr($instance['fourth_box_color']); ?>" />
	<div style="background-color: <?php echo $instance['fourth_box_color']; ?>" class="bgpicker"></div>
</div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('fourth_box_icon')); ?>"><?php esc_html_e('Button Icon', 'diplomat') ?>:</label>
<div>
	<select id="<?php echo esc_attr($widget->get_field_id('fourth_box_icon')); ?>" name="<?php echo esc_attr($widget->get_field_name('fourth_box_icon')); ?>" class="widefat box-icon">
		<?php
		foreach ($fontello_icons as $key => $icon){ ?>
			<option <?php echo($key == $instance['fourth_box_icon'] ? "selected" : "") ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($icon) ?></option>
		<?php } ?>
	</select>
	<div class="fontello-icon <?php echo esc_attr($instance['fourth_box_icon']); ?>"></div>
</div>
<div class="clear"></div>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('fourth_box_link')); ?>"><?php esc_html_e('Box Link', 'diplomat') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('fourth_box_link')); ?>" name="<?php echo esc_attr($widget->get_field_name('fourth_box_link')); ?>" value="<?php echo esc_attr($instance['fourth_box_link']); ?>" />
</p>

<script type="text/javascript">

	jQuery(function() {

		jQuery("select.box-icon").on('change', function() {
			var $this = jQuery(this),
				val = $this.val();
			$this.next('div').removeClass().addClass(val + ' fontello-icon');
		});

	});
</script>