<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_dribbble_widget" );' ) );
class DD_Dribbble_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_dribbble_widget', // Base ID
			'DD - Dribbble Shots', // Name
			array( 'description' => 'Show latest dribbble shots of a player.' ) // Args
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
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$amount = $instance['amount'];
		$player = $instance['player'];

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		/* Start - Widget Content */

		echo dd_dribbble_shots( $player, $amount );

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
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['player'] = strip_tags( $new_instance['player'] );

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
		if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = 'Dribbble Shots'; }
		if ( isset( $instance[ 'amount' ] ) ) { $amount = $instance[ 'amount' ]; } else { $amount = '4'; }
		if ( isset( $instance[ 'player' ] ) ) { $player = $instance[ 'player' ]; } else { $player = 'ddstudios'; }

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'player' ); ?>">Player</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'player' ); ?>" name="<?php echo $this->get_field_name( 'player' ); ?>" type="text" value="<?php echo esc_attr( $player ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>">Amount</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<?php 

	}

}