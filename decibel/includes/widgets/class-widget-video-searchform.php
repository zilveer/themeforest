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

if ( ! class_exists( 'Wolf_Videos' ) ) return; // Exit if Wolf Videos plugin isn't installed

function wolf_widget_video_searchform_init() {

	register_widget( 'Wolf_Widget_Video_Searchform' );
}
add_action( 'widgets_init', 'wolf_widget_video_searchform_init' );

class Wolf_Widget_Video_Searchform extends WP_Widget {

	var $wolf_widget_cssclass;
	var $wolf_widget_description;
	var $wolf_widget_idbase;
	var $wolf_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_widget_name 		= __( 'Video Search', 'wolf' );
		$this->wolf_widget_description 	= __( 'A video search form for your site.', 'wolf' );
		$this->wolf_widget_cssclass 	= 'widget_video_search';
		$this->wolf_widget_idbase 		= 'widget_video_search';

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
		$title = $instance['title'];
		echo $before_widget;

		get_template_part( 'searchform', 'video' );

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
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e(  'Title' , 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<?php
	}
}