<?php
/**
 * Banner Widget
 *
 * @package BuildPress
 */

if ( ! class_exists( 'PT_Featured_Page' ) ) {
	class PT_Featured_Page extends WP_Widget {

		/**
		 * Length of the line excerpt.
		 */
		const INLINE_EXCERPT = 60;
		const BLOCK_EXCERPT = 240;

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				false, // ID, auto generate when false
				_x( 'ProteusThemes: Featured Page' , 'backend', 'buildpress_wp'), // Name
				array(
					'description' => _x( 'Featured Page for Page Builder.', 'backend', 'buildpress_wp'),
					'classname'   => 'widget-featured-page',
				)
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			// Prepare data for mustache template
			$page_id            = absint( $instance['page_id'] );
			$instance['layout'] = sanitize_key( $instance['layout'] );
			$thumbnail_size     = 'inline' === $instance['layout'] ? 'thumbnail' : 'page-box';

			// After 2.1.0 we do not rely on the thumbnail image size anymore.
			if ( 'thumbnail' === $thumbnail_size && buildpress_installed_after( '2.1.0' ) ) {
				$thumbnail_size = '100x75-crop';
			}


			// Get basic page info
			if ( $page_id ) {
				$page = (array) get_post( $page_id );
			}

			// Prepare the excerpt text
			$excerpt = wp_strip_all_tags( ! empty( $page['post_excerpt'] ) ? $page['post_excerpt'] : $page['post_content'] );

			$excerpt .= ' ';  // bug fix https://proteusthemes.zendesk.com/agent/tickets/6377

			if ( 'inline' === $instance['layout'] && strlen( $excerpt ) > self::INLINE_EXCERPT ) {
				$excerpt = substr( $excerpt, 0, strpos( $excerpt , ' ', self::INLINE_EXCERPT ) ) . ' &hellip;';
			}
			elseif ( strlen( $excerpt ) > self::BLOCK_EXCERPT ) {
				$excerpt = substr( $excerpt, 0, strpos( $excerpt , ' ', self::BLOCK_EXCERPT ) ) . ' &hellip;';
			}

			$page['post_excerpt'] = esc_html( $excerpt );
			$page['link']         = get_permalink( $page_id );
			$page['thumbnail']    = get_the_post_thumbnail( $page_id, $thumbnail_size );

			if ( 'block' === $instance['layout'] ) {
				$attachment_image_id   = get_post_thumbnail_id( $page_id );
				$attachment_image_data = wp_get_attachment_image_src( $attachment_image_id, 'page-box' );
				$page['image_url']     = $attachment_image_data[0];
				$page['image_width']   = $attachment_image_data[1];
				$page['image_height']  = $attachment_image_data[2];
				$page['srcset']        = buildpress_get_attachment_image_srcs( $attachment_image_id, array( 'page-box', 'full' ) );
			}

			echo $args['before_widget'];

			?>
				<div <?php post_class( "page-box  page-box--{$instance['layout']}" ); ?>>
				<?php if ( 'block' === $instance['layout'] ) : ?>
					<?php if ( function_exists( 'has_post_video' ) && has_post_video( $page_id ) ) : ?>
						<a class="page-box__picture" href="<?php echo $page['link']; ?>"><?php echo $page['thumbnail']; ?></a>
					<?php else : ?>
						<a class="page-box__picture" href="<?php echo $page['link']; ?>"><img src="<?php echo esc_url( $page['image_url'] ); ?>" width="<?php echo esc_attr( $page['image_width'] ); ?>" height="<?php echo esc_attr( $page['image_height'] ); ?>" srcset="<?php echo $page['srcset']; ?>" sizes="(min-width: 992px) 360px, calc(100vw - 30px)" class="wp-post-image" alt="<?php echo esc_html( $page['post_title'] ); ?>"></a>
					<?php endif; ?>
				<?php else : ?>
					<a class="page-box__picture" href="<?php echo $page['link']; ?>"><?php echo $page['thumbnail']; ?></a>
				<?php endif; ?>
					<div class="page-box__content">
						<h5 class="page-box__title  text-uppercase"><a href="<?php echo $page['link']; ?>"><?php echo $page['post_title']; ?></a></h5>
						<p><?php echo $page['post_excerpt']; ?></p>
						<?php if ( 'block' === $instance['layout'] ) : ?>
							<p><a href="<?php echo $page['link']; ?>" class="read-more  read-more--page-box"><?php _e( 'Read more', 'buildpress_wp' ); ?></a></p>
						<?php endif; ?>
					</div>
				</div>

			<?php
			echo $args['after_widget'];
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['page_id'] = absint( $new_instance['page_id'] );
			$instance['layout']  = sanitize_key( $new_instance['layout'] );

			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$page_id = empty( $instance['page_id'] ) ? 0 : (int) $instance['page_id'];
			$layout  = empty( $instance['layout'] ) ? '' : $instance['layout'];

			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _ex( 'Page:', 'backend', 'buildpress_wp'); ?></label> <br>
				<?php
					wp_dropdown_pages( array(
						'selected' => $page_id,
						'name'     => $this->get_field_name( 'page_id' ),
						'id'       => $this->get_field_id( 'page_id' ),
					) );
				?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _ex( 'Layout:', 'backend', 'buildpress_wp' ); ?></label> <br>
				<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>">
					<option value="block" <?php selected( $layout, 'block' ); ?>><?php _ex( 'With big picture', 'backend', 'buildpress_wp' ); ?></option>
					<option value="inline" <?php selected( $layout, 'inline' ); ?>><?php _ex( 'With small picture, inline', 'backend', 'buildpress_wp' ); ?></option>
				</select>
			</p>

			<p>
				How to change Image and Text for Featured Page can be found in our <a href="http://www.proteusthemes.com/docs/buildpress/#featured-page" target="_blank">Online Documentation</a>.
			</p>

			<?php
		}
	}
	add_action( 'widgets_init', create_function( '', 'register_widget( "PT_Featured_Page" );' ) );
}