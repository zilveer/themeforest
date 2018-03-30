<?php
/**
 * Plugin Name: Flickr Widget
 * Description: A widget that displays Flickr feeds.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'flickr_widget' );


function flickr_widget() {
	register_widget( 'flickr_feed_widget' );
}

class flickr_feed_widget extends WP_Widget {

	function flickr_feed_widget() {
		$widget_ops = array( 'classname' => 'flickr-feed', 'description' => __('A widget that displays flickr feeds.', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr-feed' );
		
		$this->WP_Widget( 'flickr-feed', __('MORPHIS: Flickr Feed', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#flickr-home-<?php echo $args['widget_id']; ?>').jflickrfeed({
					limit: <?php echo $instance['num_flickr']; ?>,
					qstrings: {
					id: '<?php echo $instance['flickr_id']; ?>'
				  },
					itemTemplate: '<li><a href="{{image_b}}" rel="prettyPhoto[pp_gal]"><img class="flickr" src="{{image_s}}" alt="{{title}}" title="{{title}}"></a></li>'
				  }, function(data) {
					$('#flickr-home-<?php echo $args['widget_id']; ?> a').prettyPhoto();
				  });
			});
		</script>
		<?php
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = isset( $instance['name'] ) ? $instance['name'] : '';
		

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		printf('<ul id="flickr-home-'. $args['widget_id'] .'" class="flickr-widget clearfix"></ul>');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );		
		$instance['num_flickr'] = strip_tags( $new_instance['num_flickr'] );		

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.		
		$defaults = array( 'title' => '', 'flickr_id' => '64903915@N04', 'name' => 'Jan Intia', 'num_flickr' => '12', 'morphis' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e('Flickr ID:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $instance['flickr_id']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_flickr' ); ?>"><?php _e('Limit:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_flickr' ); ?>" name="<?php echo $this->get_field_name( 'num_flickr' ); ?>" value="<?php echo $instance['num_flickr']; ?>" style="width:20%;" />
		</p>

	<?php
	}
}

?>