<?php
/**
 * Plugin Name: Carousel Widget
 */

add_action( 'widgets_init', 'ht_carousel_load_widgets' );

function ht_carousel_load_widgets() {
	register_widget( 'ht_carousel_widget' );
}

class ht_carousel_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function ht_carousel_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ht_carousel_widget', 'description' => __('A widget designed for the Homepage Widget Area that displays a carousel with posts of your choice.', 'ht_carousel_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ht_carousel_widget' );

		/* Create the widget. */
		$this->__construct( 'ht_carousel_widget', __('Hot Topix: Carousel Widget', 'ht_carousel_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		$tags = $instance['tags'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>


					<div class="carousel-wrapper es-carousel-wrapper">
						<div class="es-carousel">
							<ul class="home-carousel">
								<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number)); while($recent->have_posts()) : $recent->the_post();?>
								<li>
									<a href="<?php the_permalink() ?>">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<?php the_post_thumbnail('medium-thumb'); ?>
									<?php } ?>
									<h2><?php the_title(); ?></h2>
									</a>
								</li>
								<?php endwhile; ?>
							</ul>
						</div><!--es-carousel-->
					</div><!--carousel-wrapper-->


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
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['tags'] = $new_instance['tags'];


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Widget Title', 'number' => 10);
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

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Maximum number of posts in carousel:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>