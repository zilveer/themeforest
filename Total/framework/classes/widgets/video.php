<?php
/**
 * Custom Video Widget
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
if ( ! class_exists( 'WPEX_Video_Widget' ) ) {
	class WPEX_Video_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$branding = wpex_get_theme_branding();
			$branding = $branding ? $branding . ' - ' : '';
			parent::__construct(
				'wpex_video',
				$branding . esc_attr__( 'Video', 'total' )
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 * @since 1.0.0
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		function widget( $args, $instance ) {

			$title       = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$video_url   = isset( $instance['video_url'] ) ? $instance['video_url'] : '';
			$description = isset( $instance['video_description'] ) ? $instance['video_description'] : '';
			
			// Before widget WP hook
			echo $args['before_widget'];

				// Show widget title
				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
				
				// Show video
				if ( $video_url )  {
					echo '<div class="responsive-video-wrap clr">';
					echo wp_oembed_get( $video_url, array(
						'width' => 270
					) );
					echo '</div>';
				} else { 
					esc_html_e( 'You forgot to enter a video URL.', 'total' );
				}
				
				// Show video description if field isn't empty
				if ( $description ) {
					echo '<div class="wpex-video-widget-description">'. wpex_sanitize_data( $description, 'html' ) .'</div>';
				}

			// After widget WP hook
			echo $args['after_widget'];
		}
		
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 * @since 1.0.0
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		function update( $new_instance, $old_instance ) {
			$instance                      = $old_instance;
			$instance['title']             = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['video_url']         = ! empty( $new_instance['video_url'] ) ? esc_url( $new_instance['video_url'] ) : '';
			$instance['video_description'] = ! empty( $new_instance['video_description'] ) ? wpex_sanitize_data( $new_instance['video_description'], 'html' ) : '';
			return $instance;
		}
		
		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 * @since 1.0.0
		 *
		 * @param array $instance Previously saved values from database.
		 */
		function form( $instance ) {

			// Parse arguments
			extract( wp_parse_args( (array) $instance, array(
				'title'             => esc_attr__( 'Video', 'total' ),
				'id'                => '',
				'video_url'         => '',
				'video_description' => '',
			) ) ); ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?>:</label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>">
				<?php esc_html_e( 'Video URL ', 'total' ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'video_url' ) ); ?>" type="text" value="<?php echo esc_attr( esc_url( $video_url ) ); ?>" />
				<span style="display:block;padding:5px 0" class="description"><?php esc_html_e( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'total' ); ?> <a href="http://codex.wordpress.org/Embeds" target="_blank"><?php esc_html_e( 'Learn More', 'total' ); ?></a></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'video_description' ) ); ?>">
				<?php esc_html_e( 'Description', 'total' ); ?></label>
				<textarea rows="5" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'video_description' ) ); ?>" type="text"><?php echo wpex_sanitize_data( $video_description, 'html' ); ?></textarea>
			</p>
			
		<?php }

	}
}
register_widget( 'WPEX_Video_Widget' );