<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_gmap">
    <h3 class="widget-title"><?php echo esc_html($instance['title']) ?></h3>
	<?php if ($instance['mode'] == 'map'): ?>
		<?php echo do_shortcode('[google_map location_mode="' . $instance['location_mode'] . '" address="' . $instance['address'] . '" width="' . $instance['width'] . '" height="' . $instance['height'] . '" mode="' . $instance['mode'] . '" latitude="' . $instance['latitude'] . '" longitude="' . $instance['longitude'] . '" zoom="' . $instance['zoom'] . '" controls="" enable_scrollwheel="' . ($instance['scrollwheel'] == "true" ? 1 : 0) . '" maptype="' . $instance['maptype'] . '" enable_marker="' . ($instance['marker'] == "true" ? 1 : 0) . '" enable_popup="' . ($instance['popup'] == "true" ? 1 : 0) . '"]' . $instance['popup_text'] . '[/google_map]'); ?>
	<?php else: ?>
		<?php echo do_shortcode('[google_map location_mode="' . $instance['location_mode'] . '" address="' . $instance['address'] . '" width="' . $instance['width'] . '" height="' . $instance['height'] . '" mode="' . $instance['mode'] . '" latitude="' . $instance['latitude'] . '" longitude="' . $instance['longitude'] . '" zoom="' . $instance['zoom'] . '" maptype="' . $instance['maptype'] . '" enable_marker="' . ($instance['marker'] == "true" ? 1 : 0) . '"][/google_map]'); ?>
	<?php endif; ?>
</div>