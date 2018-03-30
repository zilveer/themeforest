<?php
/**
 * Google map for the page builder
 *
 * @package Organique
 */

class Widget_Google_Map extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Google Map', 'backend', 'organique_wp' ), // Name
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
			<div class="simple-map js--where-we-are" style="height: <?php echo absint( $instance['height'] ); ?>px;"></div>
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

		$instance['height'] = absint( $new_instance['height'] );

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
		$height = isset( $instance['height'] ) ? $instance['height'] : 250;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _ex( 'Height (in pixels):', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
		</p>

		<?php
	}

} // class Widget_Google_Map
add_action( 'widgets_init', create_function( '', 'register_widget( "Widget_Google_Map" );' ) );
