<?php
/**
 * Recent Recent Comments With Avatars Widget
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
if ( ! class_exists( 'WPEX_Recent_Comments_Widget' ) ) {
	class WPEX_Recent_Comments_Widget extends WP_Widget {
		
		/**
		 * Register widget with WordPress.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$branding = wpex_get_theme_branding();
			$branding = $branding ? $branding . ' - ' : '';
			parent::__construct(
				'wpex_recent_comments_avatars_widget',
				$branding . esc_html__( 'Comments With Avatars', 'total' )
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 * @since 1.0.0
		 *
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		function widget( $args, $instance ) {

			// Define variables for widget usage
			$title  = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$number = isset( $instance['number'] ) ? $instance['number'] : '3';

			// Before widget WP Hook
			echo $args['before_widget'];

			// Display the title
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>

			<ul class="wpex-recent-comments-widget clr">

				<?php
				// Query Comments
				$comments = get_comments( array (
					'number'      => $number,
					'status'      => 'approve',
					'post_status' => 'publish',
					'type'        => 'comment',
				) );
				if ( $comments ) : ?>

					<?php
					// Loop through comments
					foreach ( $comments as $comment ) :

						// Get comment ID
						$comment_id   = $comment->comment_ID;
						$comment_link = get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment_id; ?>

						<li class="wpex-clr">
							<a href="<?php echo esc_url( $comment_link ); ?>" title="<?php esc_attr_e( 'Read Comment', 'total' ); ?>" class="avatar"><?php echo get_avatar( $comment->comment_author_email, 50 ); ?></a>
							<strong><?php echo get_comment_author( $comment_id ); ?>:</strong> <?php echo wp_trim_words( $comment->comment_content, '10', '&hellip;' ); ?>
							<br />
							<a href="<?php echo esc_url( $comment_link ); ?>" title="<?php esc_attr_e( 'Read Comment', 'total' ); ?>" class="view-comment"><?php esc_html_e( 'view comment', 'total' ); ?> &rarr;</a>
						</li>

					<?php endforeach; ?>

				<?php
				// Display no comments notice
				else : ?>

					<li><?php esc_html_e( 'No comments yet.', 'total' ); ?></li>

				<?php endif; ?>

			</ul>

			<?php
			// After widget hook
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
			$instance           = $old_instance;
			$instance['title']  = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number'] = ! empty( $new_instance['number'] ) ? intval( $new_instance['number'] ) : '';
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

			extract( wp_parse_args( ( array ) $instance, array(
				'title'  => esc_html__( 'Recent Comments', 'total' ),
				'number' => '3',

			) ) ); ?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number to Show', 'total' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_html( $number ); ?>" />
			</p>

			<?php
		}
	}
}
register_widget( 'WPEX_Recent_Comments_Widget' );