<?php
/**
 * Plugin Name: Headlines Widget
 */

add_action( 'widgets_init', 'mvp_featured_load_widgets' );

function mvp_featured_load_widgets() {
	register_widget( 'mvp_featured_widget' );
}

class mvp_featured_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_featured_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_featured_widget', 'description' => __('A widget that displays one featured story from a Tag of your choice.', 'mvp_featured_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_featured_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_featured_widget', __('Osage: Featured Widget', 'mvp_featured_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */

		global $post;
		global $do_not_duplicate;
		$title = $instance['title'];
		$tags = $instance['tags'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>


		<div class="widget-featured-wrapper">
			<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
				<div class="widget-featured-image">
					<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<?php the_post_thumbnail('post-thumb'); ?>
					<?php } ?>
					</a>
				</div><!--widget-featured-image-->
				<div class="widget-featured-text">
					<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
						<h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
						<h2 class="widget-feat-headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></a></h2>
					<?php else: ?>
						<h2 class="widget-stand-headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					<p><?php echo excerpt(24); ?></p>
				</div><!--widget-featured-text-->
			<?php } endwhile; ?>
		</div><!--widget-featured-wrapper-->


		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tags'] = $new_instance['tags'];


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Tag -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>">Tag Slug:</label>
			<input id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="<?php echo $instance['tags']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>