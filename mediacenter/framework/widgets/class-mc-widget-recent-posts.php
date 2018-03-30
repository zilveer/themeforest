<?php
/**
 * Home Tabs Widget
 *
 * @author 		Ibrahim Ibn Dawood
 * @category 	Widgets
 * @package 	MediaCenter/Framework/Widgets
 * @version 	1.0.6
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Displays a list of recent posts from a WordPress.com or Jetpack-enabled blog.
*/
class MC_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		
		$widget_ops = array(
			'classname' => 'mc_recent_posts_widget', 
			'description' => __( 'Recent Posts with post thumbnails.', 'mediacenter' ) 
		);
		
		parent::__construct( 'mc-recent-posts', __( 'Media Center Recent Posts', 'mediacenter' ), $widget_ops );
		$this->alt_option_name = 'mc_recent_posts';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) {
		$cache = array();
		
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'mc_recent_posts', 'widget' );
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
		
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'mediacenter' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$show_date = true;

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

		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="recent-post-list">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li class="sidebar-recent-post-item">
				<div class="media">
                	<?php
            		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						echo '<a href="'. get_the_permalink(). '" class="thumb-holder pull-left flip">' . get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) . '</a>';
					} else{
						echo '<a href="'. get_the_permalink(). '" class="thumb-holder pull-left flip mc-default-post-thumbnail">' . media_center_default_post_thumbnail( get_post_format() ) . '</a>';
					}
					?>
                    <div class="media-body">
                        <h5><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h5>
                        <div class="posted-date"><?php echo get_the_date(); ?></div>
                    </div>
                </div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'mc_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['mc_recent_posts']) )
			delete_option('mc_recent_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('mc_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mediacenter' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'mediacenter' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}

}

register_widget( 'MC_Widget_Recent_Posts' );