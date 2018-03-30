<?php
/**
 * Plugin Name: Headlines Widget
 */

add_action( 'widgets_init', 'mvp_gallery_load_widgets' );

function mvp_gallery_load_widgets() {
	register_widget( 'mvp_gallery_widget' );
}

class mvp_gallery_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_gallery_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_gallery_widget', 'description' => __('A widget that displays a scrolling gallery of images from posts of your choice.', 'mvp_gallery_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_gallery_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_gallery_widget', __('Osage: Gallery Widget', 'mvp_gallery_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */

		$title = $instance['title'];
		$tags = $instance['tags'];
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		?>


		<div class="widget-gallery-wrapper">
			<div class="gallery-slider flexslider">
				<ul class="slides">
					<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('post-thumb'); ?>
							<?php } ?>
							<div class="gallery-text">
								<p><?php the_title(); ?></p>
							</div><!--gallery-text-->
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!--widget-gallery-->
			<div class="gallery-thumbs flexslider">
				<ul class="slides">
					<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('small-thumb'); ?>
							<?php } ?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div><!--widget-gallery-wrapper-->


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
		$instance['number'] = strip_tags( $new_instance['number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Photo Gallery', 'number' => 99);
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

		<!-- Number of links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Maximum number of gallery items:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>