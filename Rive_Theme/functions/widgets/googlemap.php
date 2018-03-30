<?php

/**
* google map widget
*/

class ch_googlemap extends WP_Widget {
	public function ch_googlemap() {
		$widget_options = array(
			'classname'   => 'ch_googlemap',
			'description' => __('Displays a google map.', 'ch')
		);
		parent::__construct('gmap', __('Believe - Google map', 'ch') , $widget_options);
	}

	public function widget($args, $instance) {
		extract($args);
		$title     = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$address   = $instance['address'];
		$latitude  = !empty($instance['latitude']) ? $instance['latitude'] : 0;
		$longitude = !empty($instance['longitude']) ? $instance['longitude'] : 0;
		$zoom      = (int) $instance['zoom'];
		$html      = $instance['html'];
		$popup     = $instance['popup'];
		$height    = (int) $instance['height'];

		echo $before_widget;

		if ($title)
			echo $before_title . $title . $after_title;

		$id = rand(0, 10000);

		// Get Google Maps API Key
		$gmap_key = get_option(SHORTNAME . '_google_maps_api_key');

		// Load google map JS
		if (!empty($gmap_key)) {
			wp_enqueue_script('gmap-api', 'http://maps.google.com/maps?file=api&amp;key=' . $gmap_key . '&sensor=false', array(), false);
			wp_enqueue_script('jquery-gmap', get_template_directory_uri() . '/js/jquery.gmap-1.1.0-min.js', array('jquery'), false);
		?>

			<div id="google_map_widget_<?php echo $id; ?>" class="google_map" style="height: <?php echo $height; ?>px"></div>
			<script type="text/javascript">
				jQuery(function($) {
					$("#google_map_widget_<?php echo $id; ?>").gMap({
						zoom: <?php echo $zoom; ?>,
						markers:[{
							address: "<?php echo $address; ?>",
							latitude: <?php echo $latitude; ?>,
							longitude: <?php echo $longitude; ?>,
							html: "<?php echo $html; ?>",
							popup: <?php echo $popup; ?>
						}],
						controls: false
					});
				});
			</script>
		<?php
		}
		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance              = $old_instance;
		$instance['title']     = strip_tags($new_instance['title']);
		$instance['address']   = strip_tags($new_instance['address']);
		$instance['latitude']  = strip_tags($new_instance['latitude']);
		$instance['longitude'] = strip_tags($new_instance['longitude']);

		$zoom = (int)$new_instance['zoom'];
		if ($zoom < 1)
			$zoom = 1;
		if ($zoom > 19)
			$zoom = 19;

		$instance['zoom']   = $zoom;
		$instance['html']   = strip_tags($new_instance['html']);
		$instance['popup']  = !empty($new_instance['popup']) ? 1 : 0;
		$instance['height'] = (int) $new_instance['height'];
		return $instance;
	}

	public function form($instance) {
		$title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address   = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$latitude  = isset($instance['latitude']) ? esc_attr($instance['latitude']) : '';
		$longitude = isset($instance['longitude']) ? esc_attr($instance['longitude']) : '';
		$zoom      = isset($instance['zoom']) ? absint($instance['zoom']) : 14;
		$html      = isset($instance['html']) ? esc_attr($instance['html']) : '';
		$popup     = isset($instance['popup']) ? (bool) $instance['popup'] : false;
		$height    = isset($instance['height']) ? absint($instance['height']) : 250;
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
			<small><?php _e('Choose an address or latitute and logtitude', 'ch')?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('latitude'); ?>"><?php _e('Latitude:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" type="text" value="<?php echo $latitude; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('longitude'); ?>"><?php _e('Longitude:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" type="text" value="<?php echo $longitude; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom level:', 'ch'); ?></label>
			<select id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>">
				<?php for($i=1; $i<20; $i++): ?>
					<option <?php selected($zoom, $i) ?>><?php echo $i ?></option>
				<?php endfor ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('Content for the marker:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" type="text" value="<?php echo $html; ?>" />
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('popup'); ?>" name="<?php echo $this->get_field_name('popup'); ?>"<?php checked($popup); ?> />
			<label for="<?php echo $this->get_field_id('popup'); ?>"><?php _e('Auto popup the info?', 'ch'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
	<?php
	}
}

register_widget('ch_googlemap');