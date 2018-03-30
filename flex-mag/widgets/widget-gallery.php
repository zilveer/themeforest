<?php
/**
 * Plugin Name: Gallery Widget
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
		$widget_ops = array( 'classname' => 'mvp_gallery_widget', 'description' => __('A widget that displays a scrolling gallery of images from posts of your choice.', 'mvp-text') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_gallery_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_gallery_widget', __('Flex Mag: Gallery Widget', 'mvp-text'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$tags = $instance['tags'];
		$number = $instance['number'];

		?>
			<section class="gallery-widget-wrap left relative">
				<?php if ( $title ) { ?>
					<div class="home-title-wrap left relative">
						<h3 class="side-list-title"><?php echo esc_html( $title ); ?></h3>
					</div><!--home-title-wrap-->
				<?php } ?>
				<div class="post-gallery-top left relative flexslider">
					<ul class="post-gallery-top-list slides">
						<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<?php the_post_thumbnail('mvp-post-thumb'); ?>
								<?php } ?>
								<div class="gallery-widget-text">
									<p><?php the_title(); ?></p>
								</div><!--gallery-text-->
								</a>
							</li>
						<?php endwhile; wp_reset_query(); ?>
					</ul>
				</div><!--post-gallery-top-->
				<div class="post-gallery-bot left relative flexslider">
					<ul class="post-gallery-bot-list slides">
						<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<?php the_post_thumbnail('mvp-small-thumb'); ?>
								<?php } ?>
							</li>
						<?php endwhile; wp_reset_query(); ?>
					</ul>
				</div><!--post-gallery-bot-->
			</section><!--gallery-widget-wrap-->
		<?php

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tags'] = strip_tags( $new_instance['tags'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'showcat' => 'on', 'number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Tag -->
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>">Select tag:</label>
			<select id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['tags']) echo 'selected="selected"'; ?>>Select a Tag</option>
				<?php $tags = get_tags('hide_empty=0'); ?>
				<?php foreach($tags as $tag) { ?>
				<option value='<?php echo $tag->slug; ?>' <?php if ($tag->slug == $instance['tags']) echo 'selected="selected"'; ?>><?php echo $tag->name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Maximum number of gallery items:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>