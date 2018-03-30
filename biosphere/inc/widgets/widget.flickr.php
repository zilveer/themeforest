<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_flickr_widget" );' ) );
class DD_Flickr_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_flickr_widget', // Base ID
			'DD - Flickr Photos', // Name
			array( 'description' => 'Show flickr photos.' ) // Args
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
		$profile = $instance['profile'];
		$profile_url = $instance['profile_url'];

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		/* Start - Widget Content */

		?>

			<div class="flickr-feed" data-id="<?php echo $profile; ?>" data-amount="<?php echo $amount; ?>"></div><!-- .flickr-feed -->

			<?php if ( $profile_url != '' ) : ?>

				<a href="<?php echo $profile_url; ?>" class="dd-button orange-light"><?php _e( 'VIEW FLICKR ACCOUNT', 'dd_string' ); ?></a>

			<?php endif; ?>

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
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['profile'] = strip_tags( $new_instance['profile'] );
		$instance['profile_url'] = strip_tags( $new_instance['profile_url'] );

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
		if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = 'From Flickr'; }
		if ( isset( $instance[ 'amount' ] ) ) { $amount = $instance[ 'amount' ]; } else { $amount = '16'; }
		if ( isset( $instance[ 'profile' ] ) ) { $profile = $instance[ 'profile' ]; } else { $profile = '44802888@N04'; }
		if ( isset( $instance[ 'profile_url' ] ) ) { $profile_url = $instance[ 'profile_url' ]; } else { $profile_url = ''; }

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'profile' ); ?>">Stream ID</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'profile' ); ?>" name="<?php echo $this->get_field_name( 'profile' ); ?>" type="text" value="<?php echo esc_attr( $profile ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>">Amount</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'profile_url' ); ?>">Profile (URL)</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'profile_url' ); ?>" name="<?php echo $this->get_field_name( 'profile_url' ); ?>" type="text" value="<?php echo esc_attr( $profile_url ); ?>" />
		</p>
		<?php 

	}

}