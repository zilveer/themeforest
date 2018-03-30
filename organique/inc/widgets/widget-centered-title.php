<?php
/**
 * Centered title for the page builder
 *
 * @package Organique
 */

class Widget_Centered_Title extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Centered Title', 'backend', 'organique_wp' ), // Name
			array(
				'description' => _x( 'Used only in the page builder', 'backend', 'organique_wp' )
			)
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
		?>

		<?php echo $before_widget; ?>
			<div class="main__title">
				<h3 class="main__title__text"><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></h3>
			</div>
		<?php echo $after_widget; ?>

		<?php
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

		$instance['title'] = wp_kses_post( $new_instance['title'] );

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
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Why is Quality Food Very Important?';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php
	}

} // class Widget_Centered_Title
add_action( 'widgets_init', create_function( '', 'register_widget( "Widget_Centered_Title" );' ) );
