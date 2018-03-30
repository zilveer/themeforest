<?php
/* flickr */
add_action( 'widgets_init', 'widget_flickr_widget' );
function widget_flickr_widget() {
	register_widget( 'Widget_Flickr' );
}
class Widget_Flickr extends WP_Widget {

	function Widget_Flickr() {
		$widget_ops = array( 'classname' => 'flickr-widget'  );
		$control_ops = array( 'id_base' => 'flickr-widget' );
		parent::__construct( 'flickr-widget','Ask me - flickr', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		  = apply_filters('widget_title', $instance['title'] );
		$no_of_flickr = (int)$instance['no_of_flickr'];
		$accounts	  = esc_attr($instance['accounts']);

		echo $before_widget;
			if ( $title )
				echo $before_title.$title.$after_title;
			$rand_w = rand(1,1000);?>
	
			<div class="widget_flickr">
				<div class="flickr_<?php echo $rand_w;?>"></div>
				<div class="clearfix"></div>
			</div>
			<script type='text/javascript'>
				jQuery(document).ready(function(){
					jQuery(".flickr_<?php echo esc_js($rand_w);?>").jflickrfeed({
						limit: <?php echo (int)$no_of_flickr;?>,
						qstrings: {
							id: "<?php echo esc_js($accounts);?>"
						},
						itemTemplate: '<a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_m}}" alt="{{title}}"></a>'
					});
				});
			</script>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				  = $old_instance;
		$instance['title']		  = strip_tags( $new_instance['title'] );
		$instance['no_of_flickr'] = (int)strip_tags( $new_instance['no_of_flickr'] );
		$instance['accounts']	  = strip_tags( $new_instance['accounts'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Flickr' , 'no_of_flickr' => '9' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_flickr' ); ?>">No of flickr to show : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_flickr' ); ?>" name="<?php echo $this->get_field_name( 'no_of_flickr' ); ?>" value="<?php echo (int)$instance['no_of_flickr']; ?>" type="text" size="3">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accounts' ); ?>">flickr username id (Go to http://idgettr.com/ to find ID.) : </label>
			<input id="<?php echo $this->get_field_id( 'accounts' ); ?>" name="<?php echo $this->get_field_name( 'accounts' ); ?>" value="<?php if (isset($instance['accounts']) && !empty($instance['accounts'])) {echo esc_attr($instance['accounts']);} ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>