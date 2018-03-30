<?php
/**
 * Mailchimp signup widget
 *
 * Displays ticket categories widget
 *
 * @author WolfThemes
 * @category Widgets
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Register the widget */
function wolf_widget_mailchimp_init() {

	register_widget( 'Wolf_Widget_Mailchimp' );
}
add_action( 'widgets_init', 'wolf_widget_mailchimp_init' );

class Wolf_Widget_Mailchimp extends WP_Widget {

	var $wolf_widget_cssclass;
	var $wolf_widget_description;
	var $wolf_widget_idbase;
	var $wolf_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_widget_name 		= 'Mailchimp';
		$this->wolf_widget_description 	= __( 'Newsletter signup form', 'wolf' );
		$this->wolf_widget_cssclass 	= 'widget_mailchimp';
		$this->wolf_widget_idbase 		= 'widget_mailchimp';

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
		$list = $instance['list'];
		$submit = $instance['submit'];
		$title = $instance['title'];
		echo $before_widget;
		echo wolf_mailchimp( $list, 'normal', $title, $submit );
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
		$instance['list'] = $new_instance['list'];
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['submit'] = sanitize_text_field( $new_instance['submit'] );
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
			'list' => '',
			'submit' => __( 'Subscribe', 'wolf' ),
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e(  'Title' , 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>"><?php _e( 'List ID', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('list') ); ?>" value="<?php echo esc_attr( $instance['list'] ); ?>">
			<br>
			<small><?php _e( 'Can be found in your mailchimp account -> Lists -> Your List Name -> Settings -> List Name & default', 'wolf' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'submit' ) ); ?>"><?php _e(  'Submit Text' , 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'submit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'submit' ) ); ?>" value="<?php echo esc_attr( $instance['submit'] ); ?>">
		</p>
		<?php
	}
}