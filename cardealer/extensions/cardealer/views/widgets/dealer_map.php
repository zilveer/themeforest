<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
if (is_single()) {
	global $post;
	$map_data = TMM_Cardealer_User::get_user_map_data($post->post_author);
	if (get_post_type($post->ID) == TMM_Ext_PostType_Car::$slug AND $map_data['show_map_to_visitors'] == 1) {
		?>
		<div class="widget widget_dealers_map">

			<?php if (!empty($instance['title'])): ?>
				<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
			<?php endif; ?>

			<?php echo do_shortcode('[google_map width="300" height="300" latitude="' . $map_data['map_latitude'] . '" longitude="' . $map_data['map_longitude'] . '" zoom="' . $map_data['map_zoom'] . '" enable_scrollwheel="0" map_type="ROADMAP" enable_marker="1" enable_popup="0" marker_is_draggable="0"][/google_map]'); ?>

			<div class="clear"></div>

		</div>

		<?php
	}
}

