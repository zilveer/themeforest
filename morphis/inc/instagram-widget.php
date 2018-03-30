<?php
/**
 * Plugin Name: Instagram Widget
 * Description: A widget that displays Instagram images.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'instagram_widget' );


function instagram_widget() {
	register_widget( 'instagram_feed_widget' );
}

class instagram_feed_widget extends WP_Widget {

	function instagram_feed_widget() {
		$widget_ops = array( 'classname' => 'instagram-feed', 'description' => __('A widget that displays Instagram images.', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'instagram-feed' );
		
		$this->WP_Widget( 'instagram-feed', __('MORPHIS: Instagram Feed', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	
		extract( $args );
		?>
		
		<script type="text/javascript">
		
			jQuery(document).ready(function($) {
			
				jQuery.fn.spectragram.accessData = {
					accessToken: '214544068.e39810d.fdad39ac5b9b4e0781b4ee7dccc99c48',
					clientID: 'e39810d1f796422d863880419ba51104'
				};

				$('ul#instagram-home-<?php echo $args['widget_id']; ?>').spectragram('getUserFeed',{
					query: '<?php echo $instance['instagram_id']; ?>',
					max: <?php echo $instance['num_instagram']; ?>,
					size: 'small',
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

		printf('<ul id="instagram-home-'. $args['widget_id'] .'" class="instagram-widget clearfix"></ul>');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['instagram_id'] = strip_tags( $new_instance['instagram_id'] );		
		$instance['num_instagram'] = strip_tags( $new_instance['num_instagram'] );		

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.		
		$defaults = array( 'title' => '', 'instagram_id' => '', 'name' => 'Jan Intia', 'num_instagram' => '12' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram_id' ); ?>"><?php _e('Instagram ID:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'instagram_id' ); ?>" name="<?php echo $this->get_field_name( 'instagram_id' ); ?>" value="<?php echo $instance['instagram_id']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_instagram' ); ?>"><?php _e('Limit:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_instagram' ); ?>" name="<?php echo $this->get_field_name( 'num_instagram' ); ?>" value="<?php echo $instance['num_instagram']; ?>" style="width:20%;" />
		</p>

	<?php
	}
}

?>