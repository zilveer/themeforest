<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Widget_Eventon extends WP_Widget {

	/**
	 * @internal
	 */
	function __construct() {
		$widget_ops = array( 'description' => 'Woffice widget to display the latest events from EventON.' );
		parent::__construct( false, __( '(Woffice) Events', 'woffice' ), $widget_ops );
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$title     = esc_attr( $instance['title'] );
		$show     = esc_attr( $instance['show'] );
		$categories_included     = (array_key_exists('categories_included', $instance)) ? esc_attr( $instance['categories_included'] ) : '';
		$categories_excluded     = (array_key_exists('categories_excluded', $instance)) ? esc_attr( $instance['categories_excluded'] ) : '';
		$before_widget = str_replace( 'class="', 'class="widget_events ', $before_widget );
		$title         = str_replace( 'class="', 'class="widget_events ',
				$before_title ) . $title . $after_title;

		$filepath = dirname( __FILE__ ) . '/views/widget.php';

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		}
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '',  'show' => '4', 'categories_included' => '', 'categories_excluded' => '') );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'woffice' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"
			       id="<?php esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e( 'Number', 'woffice' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'show' ) ); ?>"
			       value="<?php echo esc_attr( $instance['show'] ); ?>" class="widefat"
			       id="<?php esc_attr( $this->get_field_id( 'show' ) ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'categories_included' ); ?>"><?php _e( 'Include Categories', 'woffice' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'categories_included' ) ); ?>"
			       value="<?php echo esc_attr( $instance['categories_included'] ); ?>" class="widefat"
			       id="<?php esc_attr( $this->get_field_id( 'categories_included' ) ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'categories_excluded' ); ?>"><?php _e( 'Exclude Categories', 'woffice' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'categories_excluded' ) ); ?>"
			       value="<?php echo esc_attr( $instance['categories_excluded'] ); ?>" class="widefat"
			       id="<?php esc_attr( $this->get_field_id( 'categories_excluded' ) ); ?>"/>
		</p>
	<?php
	}
}
