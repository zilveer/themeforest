<?php
/* Register the widget */
function dt_textphoto_load_widgets() {
	register_widget( 'dt_Text_Photo' );
}
add_action( 'widgets_init', 'dt_textphoto_load_widgets' );

/* Begin Widget Class */
class dt_Text_Photo extends WP_Widget {

	/* Widget setup  */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'dt_Text_Photo', 'description' => __('A widget with some text and photo', LANGUAGE_ZONE) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 250, 'id_base' => 'techno-text-photo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'techno-text-photo-widget', __(THEME_TITLE.' Text & Photo', LANGUAGE_ZONE), $widget_ops, $control_ops );
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );

		echo $before_widget ;

		// start
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $instance['img'] ) {
			echo '<span class="alignleft"><img src="' . esc_url($instance['img']) . '" width="60" height="60" /></span>';
		}

		echo $text;

		echo $after_widget;

	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		foreach (explode(" ", "text title photo img") as $k) {

			$instance[$k] = $new_instance[$k];
		}

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Text & Photo', LANGUAGE_ZONE),
			'text' => '',
			'img' => get_template_directory_uri() . '/images/ava.jpg'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', LANGUAGE_ZONE); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>

		<p>
			<span><?php _e('Text:', LANGUAGE_ZONE); ?></span><br />
			<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" class="widefat" rows="10"><?php echo $instance['text']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e('Image:', LANGUAGE_ZONE); ?></label>
			<input id="<?php echo $this->get_field_id( 'img' ); ?>" type="text" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo esc_attr($instance['img']); ?>" class="widefat" />
		</p>

		<div style="clear: both;"></div>

	<?php
	}
}