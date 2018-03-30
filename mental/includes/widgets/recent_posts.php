<?php
/**
 * Mental Recent_Posts widget
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Mental Recent_Posts widget class
 */
class Mental_Widget_Recent_Posts extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array( 'classname'   => 'mental_widget_recent_entries',
		                     'description' => __( "Your site's most recent Posts.", 'mental' )
		);
		parent::__construct( 'mental-recent-posts', __( 'Mentas Recent Posts', 'mental' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance )
	{
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'mental_widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'mental' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		} ?>
			<ul class="wg-popular-posts">
				<?php while( $r->have_posts() ) : $r->the_post(); ?>
					<li class="<?php echo has_post_thumbnail() ? 'has-thumbnail' : '' ?>">
						<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists {?>
							<figure>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail( array( 70, 70 ) ); ?>
								</a>
							</figure>
						<?php endif; ?>
						<div class="body">
							<p class="wg-pp-title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></p>
							<?php if ( $show_info ):?>
								<p class="wg-info">
								<time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('F j, Y'); ?></time> / <a
									href="<?php esc_url(get_comments_link(get_the_ID())); ?>"><?php $comments_count = wp_count_comments(get_the_ID()); echo (int) $comments_count->approved; ?> <?php _e( 'Comments', 'mental' ); ?></a>
								</p>
							<?php endif ?>
						</div>
					</li>
				<?php endwhile; ?>
            </ul>
         <?php echo $args['after_widget']; ?>
         <?php
         // Reset the global $the_post as this query will have stomped on it
         wp_reset_postdata();

      endif;

      if ( ! $this->is_preview() ) {
         $cache[ $args['widget_id'] ] = ob_get_flush();
         wp_cache_set( 'mental_widget_recent_posts', $cache, 'widget' );
      } else {
			ob_end_flush();
		}
	}

	function update( $new_instance, $old_instance )
	{
		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_info'] = isset( $new_instance['show_info'] ) ? (bool) $new_instance['show_info'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['mental_widget_recent_entries'] ) ) {
			delete_option( 'mental_widget_recent_entries' );
		}

		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete( 'mental_widget_recent_posts', 'widget' );
	}

	function form( $instance )
	{
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_info = isset( $instance['show_info'] ) ? (bool) $instance['show_info'] : false;
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'mental' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of posts to show:', 'mental' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>"
			       size="3"/>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_info ); ?>
		          id="<?php echo esc_attr($this->get_field_id( 'show_info' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'show_info' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_info' )); ?>"><?php _e( 'Display post info?', 'mental' ); ?></label>
		</p>
	<?php
	}
}

// Init Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Mental_Widget_Recent_Posts" );' ) );
