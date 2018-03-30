<?php
/**
 * Google Map
 *
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 * @package Total WordPress Theme
 * @subpackage Widgets
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
class WPEX_Google_Map extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$branding = wpex_get_theme_branding();
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpex_gmap_widget',
			$branding . esc_html__( 'Google Map', 'total' )
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

		// Set vars for widget usage
		$title       = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$description = isset( $instance['description'] ) ? $instance['description'] : '';
		$embed_code  = isset( $instance['embed_code'] ) ? $instance['embed_code'] : '';
		$height      = isset( $instance['height'] ) ? intval( $instance['height'] ) : '';

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; 
		} ?>

		<div class="wpex-gmap-widget wpex-clr">

			<?php if ( $description ) : ?>

				<div class="wpex-gmap-widget-description wpex-clr">
					<?php echo wpautop( wpex_sanitize_data( $description, 'html' ) ); ?>
				</div><!-- .wpex-gmap-widget-description -->

			<?php endif; ?>

			<?php if ( $embed_code ) :

				// Parse size
				if ( is_numeric( $height ) ) {
					$embed_code = preg_replace( '/height="[0-9]*"/', 'height="' . $height . '"', $embed_code );
				} ?>

				<div class="wpex-gmap-widget-embed wpex-clr">
					<?php echo wpex_sanitize_data( $embed_code, 'embed' ); ?>
				</div><!-- .wpex-gmap-widget-embed -->

			<?php endif; ?>

		</div><!-- .wpex-info-widget -->

		<?php
		// After widget WP hook
		echo $args['after_widget']; ?>
		
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
		$instance                = $old_instance;
		$instance['title']       = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = isset( $new_instance['description'] ) ? wpex_sanitize_data( $new_instance['description'], 'html' ) : '';
		$instance['embed_code']  = isset( $new_instance['embed_code'] ) ? $new_instance['embed_code'] : '';
		$instance['height']      = ! empty( $new_instance['height'] ) ? intval( $new_instance['height'] ) : '';
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

		extract( wp_parse_args( ( array ) $instance, array(
			'title'       => esc_html__( 'Google Map', 'total' ),
			'description' => '',
			'embed_code'  => '',
			'height'      => '',
		) ) ); ?>

		<?php /* Title */ ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php /* Description */ ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
			<?php esc_html_e( 'Description', 'total' ); ?></label>
			<textarea rows="5" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text"><?php echo stripslashes( $description ); ?></textarea>
		</p>

		<?php /* Embed code */ ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'embed_code' ) ); ?>">
			<?php esc_html_e( 'Embed Code', 'total' ); ?></label>
			<textarea rows="5" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'embed_code' ) ); ?>" type="text"><?php echo stripslashes( $embed_code ); ?></textarea>
		</p>

		<?php /* Height */ ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Height', 'total' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
		</p>

		
	<?php
	}
}
register_widget( 'WPEX_Google_Map' );