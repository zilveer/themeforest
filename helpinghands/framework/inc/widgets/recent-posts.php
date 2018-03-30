<?php
/**
 * Recent Posts Widget
 *
 * @description: A simple widget to display the recent posts.
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// The widget class
class sd_recent_posts_widget extends WP_Widget {
	
	// Widget Settings
	function sd_recent_posts_widget() {
	
		$widget_ops = array( 'classname' => 'sd_recent_posts_widget', 'description' => __( 'A widget to display the recent posts.', 'sd-framework' ) );
		$control_ops = "";
		parent::__construct( 'sd_recent_posts_widget', __( 'Recent Posts', 'sd-framework' ), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		
		// Display Recent Posts
		?>

<div class="sd-recent-posts-widget">
	<ul>
		<?php 
			$sd_recent_posts = new WP_Query();
			$sd_recent_posts->query( 'showposts='.$instance['postcount'].'' );
			while ( $sd_recent_posts->have_posts() ) : $sd_recent_posts->the_post(); ?>
		<li class="clearfix"> 
			<!-- post thumbnail --> 
			<?php if (  ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() )  ) : ?>
			<div class="sd-recent-widget-thumb">
				<figure>
					<?php the_post_thumbnail( 'sd-recent-blog-widget' ); ?>
				</figure>
			</div>
			<?php endif; ?>
			<!-- post thumbnail end-->
			<div class="sd-recent-posts-content">
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
					</a> </h4>
				<span class="sd-recent-date"> <i class="fa fa-calendar"></i> <?php echo get_the_date( get_option( 'date_format' ) ); ?> </span></div>
			<!--details--> 
		</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
		'title' => 'Recent Posts',
		'postcount' => '3'
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

<!-- Widget Title: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<!-- Post Count: Text Input -->
<p>
	<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">
		<?php _e('Post Count', 'sd-framework') ?>
	</label>
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
</p>
<?php
	}
}
// Register and load the widget
function sd_recent_posts_widget() {
	register_widget( 'sd_recent_posts_widget' );
}
add_action( 'widgets_init', 'sd_recent_posts_widget' );
?>
