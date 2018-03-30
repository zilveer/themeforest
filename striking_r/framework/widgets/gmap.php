<?php
/**
 * Twitter Widget Class
 */
if (!class_exists('Theme_Widget_Gmap')) {
class Theme_Widget_Gmap extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_gmap', 'description' => __( 'Displays a google map.', 'theme_admin' ) );
		parent::__construct('gmap', THEME_SLUG.' - '.__('Gmap', 'theme_admin'), $widget_ops);

		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_script') );
		}
	}

	function add_script(){
		wp_enqueue_script( 'jquery-gmap');
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$address = $instance['address'];
		$latitude = !empty($instance['latitude'])?$instance['latitude']:0;
		$longitude = !empty($instance['longitude'])?$instance['longitude']:0;
		$zoom = (int)$instance['zoom'];
		$html = $instance['html'];
		$popup = $instance['popup'];
		$height = (int)$instance['height'];
		
		if($zoom < 1){
			$zoom = 1;
		}

		$html = str_replace('{linebreak}', '<br/>', $html);
		$html = str_replace('{', '<', $html);
		$html = str_replace('}', '>', $html);

		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
				
		$id = rand(100,3000);
		?>
		
		<div id="gmap_widget_<?php echo $id;?>" class="google_map" style="height:<?php echo $height;?>px"></div>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery("#gmap_widget_<?php echo $id;?>").gMap({
			    zoom: <?php echo $zoom;?>,
			    markers:[{
					address: "<?php echo $address;?>",
					latitude: <?php echo $latitude;?>,
			    	longitude: <?php echo $longitude;?>,
			    	html: "<?php echo $html;?>",
			    	popup: <?php echo $popup;?>
				}],
				controls: false,
				maptype: 'ROADMAP'
			});
		});
		</script>

		<div class="clearboth"></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);		
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['latitude'] = strip_tags($new_instance['latitude']);
		$instance['longitude'] = strip_tags($new_instance['longitude']);
		$instance['zoom'] = (int) $new_instance['zoom'];
		$instance['html'] = strip_tags($new_instance['html']);
		$instance['popup'] = !empty($new_instance['popup']) ? 1 : 0;
		$instance['height'] = (int) $new_instance['height'];
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$latitude = isset($instance['latitude']) ? esc_attr($instance['latitude']) : '';
		$longitude = isset($instance['longitude']) ? esc_attr($instance['longitude']) : '';
		$zoom = isset($instance['zoom']) ? absint($instance['zoom']) : 14;
		$html = isset($instance['html']) ? esc_attr($instance['html']) : '';
		$popup = isset( $instance['popup'] ) ? (bool) $instance['popup'] : false;
		$height = isset($instance['height']) ? absint($instance['height']) : 250;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address (Optional)&#x200E;:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('latitude'); ?>"><?php _e('Latitude:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" type="text" value="<?php echo $latitude; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('longitude'); ?>"><?php _e('Longitude:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" type="text" value="<?php echo $longitude; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom value from 1 to 19:', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo $zoom; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('Content for the marker:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" type="text" value="<?php echo $html; ?>" /></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('popup'); ?>" name="<?php echo $this->get_field_name('popup'); ?>"<?php checked( $popup ); ?> />
		<label for="<?php echo $this->get_field_id('popup'); ?>"><?php _e( 'Auto popup the info?', 'theme_admin' ); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" /></p>
		
<?php
	}
}
}