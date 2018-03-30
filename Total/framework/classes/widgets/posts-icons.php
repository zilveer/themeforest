<?php
/**
 * Recent posts with icons widget
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
if ( ! class_exists( 'WPEX_Recent_Posts_Icons_Widget' ) ) {
	class WPEX_Recent_Posts_Icons_Widget extends WP_Widget {
		
		/**
		 * Register widget with WordPress.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$branding = wpex_get_theme_branding();
			$branding = $branding ? $branding . ' - ' : '';
			parent::__construct(
				'wpex_recent_posts_icons',
				$branding . esc_html__( 'Posts With Icons', 'total' )
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
		public function widget( $args, $instance ) {

			// Sanitize args
			$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$number   = isset( $instance['number'] ) ? $instance['number'] : '5';
			$order    = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
			$orderby  = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
			$category =  isset( $instance['category'] ) ? $instance['category'] : 'all';
			$exclude  = ( is_singular() ) ? array( get_the_ID() ) : NULL;

			// Before Widget Hook
			echo $args['before_widget'];

			// Title
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
				// Category
				if ( ! empty( $category ) && 'all' != $category ) {
					$taxonomy = array ( array (
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $category,
					) );
				} else {
					$taxonomy = NUll;
				}

				// Query Posts
				global $post;
				$wpex_query = new WP_Query( array(
					'post_type'           => 'post',
					'posts_per_page'      => $number,
					'orderby'             => $orderby,
					'order'               => $order,
					'no_found_rows'       => true,
					'post__not_in'        => $exclude,
					'tax_query'           => $taxonomy,
					'ignore_sticky_posts' => 1
				) );

				// Loop through posts
				if ( $wpex_query->have_posts() ) : ?>

					<ul class="widget-recent-posts-icons clr">

						<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

							<li class="clr">
								<a href="<?php esc_url( wpex_permalink() ); ?>" title="<?php wpex_esc_title(); ?>"><span class="<?php esc_attr( wpex_post_format_icon() ); ?>"></span><?php the_title(); ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				<?php endif; ?>

			<?php 
			// Reset post data
			wp_reset_postdata(); ?>

			<?php 
			// After widget hook
			echo $args['after_widget']; ?>

		<?php 
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
		public function update( $new_instance, $old_instance ) {
			$instance             = $old_instance;
			$instance['title']    = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number']   = ! empty( $new_instance['number'] ) ? intval( $new_instance['number'] ) : '';
			$instance['order']    = ! empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : '';
			$instance['orderby']  = ! empty( $new_instance['orderby'] ) ? strip_tags( $new_instance['orderby'] ) : '';
			$instance['category'] = ! empty( $new_instance['category'] ) ? strip_tags( $new_instance['category'] ) : '';
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
		public function form( $instance ) {
			extract( wp_parse_args( ( array ) $instance, array(
				'title'     => esc_html__( 'Recent Posts', 'total' ),
				'number'    => '5',
				'order'     => 'DESC',
				'orderby'   => 'date',
				'category'  => 'all',
			) ) ); ?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number to Show', 'total' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'total' ); ?>:</label>
				<br />
				<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr(  $this->get_field_id( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'total' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'total' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'total' ); ?>:</label>
				<br />
				<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
				<?php
				// Orderby options
				$orderby_array = array (
					'date'          => esc_html__( 'Date', 'total' ),
					'title'         => esc_html__( 'Title', 'total' ),
					'modified'      => esc_html__( 'Modified', 'total' ),
					'author'        => esc_html__( 'Author', 'total' ),
					'rand'          => esc_html__( 'Random', 'total' ),
					'comment_count' => esc_html__( 'Comment Count', 'total' ),
				);
				foreach ( $orderby_array as $key => $value ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $orderby, $key ); ?>>
						<?php echo strip_tags( $value ); ?>
					</option>
				<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'total' ); ?>:</label>
				<br />
				<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" id="<?php echo esc_attr(  $this->get_field_id( 'category' ) ); ?>">
				<option value="all" <?php selected( $category, 'all' ); ?>><?php esc_html_e( 'All', 'total' ); ?></option>
				<?php
				$terms = get_terms( 'category' );
				if ( ! empty ( $terms ) ) {
					foreach ( $terms as $term ) { ?>
						<option value="<?php echo esc_attr( $term->term_id ); ?>" <?php selected( $category, $term->term_id ); ?>><?php echo strip_tags( $term->name ); ?></option>
					<?php }
				} ?>
				</select>
			</p>
			<?php
		}
	}
}
register_widget( 'WPEX_Recent_Posts_Icons_Widget' );