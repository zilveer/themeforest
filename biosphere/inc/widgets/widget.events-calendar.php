<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_events_calendar_widget" );' ) );
class DD_Events_Calendar_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_events_calendar_widget', // Base ID
			'DD - Events Calendar', // Name
			array( 'description' => 'Show a calendar with events.' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $dd_sn;

		extract( $args ); 
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		/* Start - Widget Content */

			?>
				<div class="events-calendar-wrapper">
					<div class="events-calendar-wrapper-inner">
						<?php dd_get_calendar( array( 'dd_events'), false, true ); ?>
					</div>
				</div>
			<?php

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = '';	}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 

	}

}