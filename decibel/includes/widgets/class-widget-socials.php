<?php
/**
 * Social icons widget
 *
 * Displays ticket categories widget
 *
 * @author WolfThemes
 * @category Widgets
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Register the widget */
function wolf_widget_theme_socials_init() {

	register_widget( 'Wolf_Widget_Theme_Socials' );
}
add_action( 'widgets_init', 'wolf_widget_theme_socials_init' );

class Wolf_Widget_Theme_Socials extends WP_Widget {

	var $wolf_widget_cssclass;
	var $wolf_widget_description;
	var $wolf_widget_idbase;
	var $wolf_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_widget_name 		= __( 'Social Icons', 'wolf' );
		$this->wolf_widget_description 	= __( 'Display social icons', 'wolf' );
		$this->wolf_widget_cssclass 	= 'widget_theme_socials';
		$this->wolf_widget_idbase 		= 'widget_theme_socials';

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->wolf_widget_cssclass, 'description' => $this->wolf_widget_description );

		/* Create the widget. */
		parent::__construct( $this->wolf_widget_idbase, $this->wolf_widget_name, $widget_ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$services = $instance['services'];
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		if ( $services )
			echo do_shortcode( '[wolf_theme_socials services=' . $services . ']' );
		else
			echo do_shortcode( '[wolf_theme_socials]' );
		echo $after_widget;
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['services'] = strtolower( preg_replace( '/\s+/', '', $new_instance['services'] ) );
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => '',
			'services' => '',
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e(  'Title' , 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'services' ) ); ?>"><?php _e( 'Services', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'services' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'services' ) ); ?>" value="<?php echo esc_attr( $instance['services'] ); ?>">
			<br>
			<small><?php _e( 'If you want to limit the number of social services to display, enter the services separated by a comma ( e.g: twitter,facebook )', 'wolf' ); ?></small>
		</p>
		<?php
	}
}