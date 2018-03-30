<?php if(! defined('ABSPATH')){ return; }

/*--------------------------------------------------------------------------------------------------

	File: widget-latest_posts.php

	Description: This is the file that contains the Latest Posts widget

--------------------------------------------------------------------------------------------------*/

class Zn_Widget_Recent_Posts extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array ( 'classname'   => 'widget_recent_entries',
							  'description' => __( "The most recent posts on your site", 'zn_framework' )
		);
		parent::__construct( 'recent-posts', __( 'Recent Posts', 'zn_framework' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array ( &$this, 'zn_flush_widget_cache' ) );
		add_action( 'deleted_post', array ( &$this, 'zn_flush_widget_cache' ) );
		add_action( 'switch_theme', array ( &$this, 'zn_flush_widget_cache' ) );
	}

	function widget( $args, $instance )
	{
		$before_widget = $before_title = $after_title =  $after_widget = '';

		$cache = wp_cache_get( 'widget_recent_posts', 'widget' );

		$showExcerpt = isset($instance['show_excerpt']) ? $instance['show_excerpt'] : 'show';
		$showCommentCount = isset($instance['show_comment_count']) ? $instance['show_comment_count'] : 'hide';

		if ( ! is_array( $cache ) ) {
			$cache = array ();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'zn_framework' ) : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}

		// Configure the query
		$defaultQueryArgs = array (
			'posts_per_page' => $number,
		    'no_found_rows'  => true,
		    'post_status'    => 'publish',
		    'ignore_sticky_posts' => true,
		);

		// @since v4.1.6
		// Exclude the current viewed post from the query
		// so it will not show up in the list
		if(is_single() && ('post' == get_post_type())){
			$defaultQueryArgs['post__not_in'] = array( get_the_ID() );
		}

		$r = new WP_Query( apply_filters( 'widget_posts_args', $defaultQueryArgs ) );
		if ( $r->have_posts() ) :
			?>
			<?php echo $before_widget; ?>
			<?php echo '<div class="latest_posts-wgt">'; ?>
			<?php if ( $title ) {
			echo $before_title . $title . $after_title;
		} ?>
			<ul class="posts latest_posts-wgt-posts">
				<?php while ( $r->have_posts() ) : $r->the_post();
					$the_str = '';
					if($showExcerpt == 'show' ) {
						$excerpt = get_the_excerpt();
						$excerpt = strip_shortcodes( $excerpt );
						$excerpt = strip_tags( $excerpt );
						$the_str = mb_substr( $excerpt, 0, 47 );
					}
					$cCount = null;
					if($showCommentCount == 'show' ){
						$cCount = get_comments_number(get_the_ID());
					}


					$image = '';
					// Create the featured image html
					if ( has_post_thumbnail( get_the_ID() ) ) {
						$thumb   = get_the_post_thumbnail( get_the_ID(), array( 54,54 ) );
						if ( ! empty ( $thumb ) ) {
							$image = '<a href="' . get_permalink() . '" class="hoverBorder pull-left latest_posts-wgt-thumb">'.$thumb.'</a>';
						}
					}
					?>
					<li class="lp-post latest_posts-wgt-post">
						<?php echo $image; ?>
						<h4 class="title latest_posts-wgt-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>>
							<a href="<?php the_permalink() ?>" class="latest_posts-wgt-title-link" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
							<?php if ( get_the_title() ) { the_title(); } else { the_ID(); } ?>
							</a></h4>
						<?php if($showExcerpt == 'show' ) : ?>
							<div class="text latest_posts-wgt-text"><?php echo $the_str . '...'; ?></div>
						<?php endif; ?>
						<?php if($showCommentCount == 'show' ) : ?>
							<div class="lp-post-comments-num latest_posts-wgt-coments"><?php echo $cCount.' '.__('comments', 'zn_framework');?></div>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo '</div>'; ?>
			<?php echo $after_widget; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif;

		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance )
	{
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_excerpt']  = $new_instance['show_excerpt'];
		$instance['show_comment_count'] = $new_instance['show_comment_count'];

		$this->zn_flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) {
			delete_option( 'widget_recent_entries' );
		}

		return $instance;
	}

	function zn_flush_widget_cache()
	{
		wp_cache_delete( 'widget_recent_posts', 'widget' );
	}

	function form( $instance )
	{

		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		//@since 4.0
		// Whether or not to display the post excerpt
		$showExcerpt = isset( $instance['show_excerpt'] ) ? esc_attr( $instance['show_excerpt'] ) : 'show';
		$showCommentsCount = isset( $instance['show_comment_count'] ) ? esc_attr( $instance['show_comment_count'] ) : 'hide';


		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				   value="<?php echo $title; ?>"/></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'zn_framework' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>"
				   name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
				   value="<?php echo $number; ?>" size="3"/>
		</p>

		<p><label
				for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Show post excerpt:', 'zn_framework' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>">
				<option value="show" <?php echo selected( 'show', $showExcerpt, false); ?>><?php _e( 'Show', 'zn_framework' ); ?></option>
				<option value="hide" <?php echo selected( 'hide', $showExcerpt, false);?>><?php _e( 'Hide', 'zn_framework' ); ?></option>
			</select>
		</p>

		<p><label
				for="<?php echo $this->get_field_id( 'show_comment_count' ); ?>"><?php _e( 'Show comments count:', 'zn_framework' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'show_comment_count' ); ?>" name="<?php echo $this->get_field_name( 'show_comment_count' ); ?>">
				<option value="hide" <?php echo selected( 'hide', $showCommentsCount, false);?>><?php _e( 'Hide', 'zn_framework' ); ?></option>
				<option value="show" <?php echo selected( 'show', $showCommentsCount, false); ?>><?php _e( 'Show', 'zn_framework' ); ?></option>
			</select>
		</p>


	<?php
	}
}
function register_widget_WP_Widget_Recent_Posts(){
	unregister_widget("WP_Widget_Recent_Posts");
	register_widget( "Zn_Widget_Recent_Posts" );
}


add_action( 'widgets_init', 'register_widget_WP_Widget_Recent_Posts' );
