<?php
/**
 * Alternative text widget for the page builder
 *
 * @package Organique
 */

class Widget_Alternative_Text extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Alternative Text Widget', 'backend', 'organique_wp' ), // Name
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
			<div class="banners-medium  banners-medium--info  push-down-10">
				<?php echo $instance['title']; ?>
			</div>
			<?php echo $instance['html']; ?>
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
		$instance['html']  = wp_kses_post( $new_instance['html'] );

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
		$title = isset( $instance['title'] ) ? $instance['title'] : 'The Beginnings';
		$html  = isset( $instance['html'] ) ? $instance['html'] : 'Ut consectetur, magna non accumsan laoreet, enim justo varius tortor, non ornare lacus lacus eu quam. Sed id leo sit amet leo facilisis consequat. Donec eget libero sed ante faucibus dignissim in vehicula sem. Mauris gravida neque vel nibh condimentum tincidunt. Cras interdum lacus eu ipsum lobortis viverra. Integer lorem justo, elementum malesuada pretium vel, egestas a eros. Curabitur consectetur nisl augue.';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'backend', 'organique_wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _ex( 'Text:', 'backend', 'organique_wp' ); ?></label>
			<textarea style="width: 100%;" rows="8" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>"><?php echo esc_textarea( $html ); ?></textarea>
		</p>

		<?php
	}

} // class Widget_Alternative_Text
add_action( 'widgets_init', create_function( '', 'register_widget( "Widget_Alternative_Text" );' ) );
