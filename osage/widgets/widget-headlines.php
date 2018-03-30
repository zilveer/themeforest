<?php
/**
 * Plugin Name: Headlines Widget
 */

add_action( 'widgets_init', 'mvp_headlines_load_widgets' );

function mvp_headlines_load_widgets() {
	register_widget( 'mvp_headlines_widget' );
}

class mvp_headlines_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_headlines_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_headlines_widget', 'description' => __('A widget that displays recent headlines.', 'mvp_headlines_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_headlines_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_headlines_widget', __('Osage: Headlines Widget', 'mvp_headlines_widget'), $widget_ops, $control_ops );
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
		$number = $instance['number'];
		$featured = $instance['featured'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>


				<div class="widget-headlines">
					<?php if($featured) { ?>
						<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'posts_per_page' => '1', 'ignore_sticky_posts' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
							<div class="headlines-main">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="headlines-main-img">
										<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
									</div><!--headlines-main-img-->
								<?php } ?>
								<div class="headlines-main-text">
									<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
									<p><?php echo excerpt(14); ?></p>
								</div><!--headlines-main-text-->
							</div><!--headlines-main-->
						<?php } endwhile; } else { ?>
						<?php $recent = new WP_Query(array( 'posts_per_page' => '1', 'ignore_sticky_posts' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
							<div class="headlines-main">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="headlines-main-img">
										<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
									</div><!--headlines-main-img-->
								<?php } ?>
								<div class="headlines-main-text">
									<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
									<p><?php echo excerpt(16); ?></p>
								</div><!--headlines-main-text-->
							</div><!--headlines-main-->
						<?php } endwhile; } ?>
						<div class="headlines-list">
							<h3><?php echo $title; ?></h3>
							<ul>
								<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'posts_per_page' => $number  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
									<li>
										<p><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
									</li>
								<?php } endwhile; } ?>
							</ul>
						</div><!--headlines-list-->
					<?php } else { ?>
						<div class="headlines-list headlines-full">
							<h3><?php echo $title; ?></h3>
							<ul>
								<?php $recent = new WP_Query(array( 'tag' => get_option('mvp_slider_tags'), 'posts_per_page' => get_option('mvp_slider_num')  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<?php } endwhile; ?>
								<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'posts_per_page' => $number  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<li>
									<p><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
								</li>
								<?php } endwhile; } ?>
							</ul>
						</div><!--headlines-list-->
					<?php } ?>
				</div><!--widget-headlines-->


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
		$instance['featured'] = strip_tags( $new_instance['featured'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Latest Headlines', 'featured' => 'on', 'number' => 10);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'featured' ); ?>">Show Featured Post:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'featured' ); ?>" name="<?php echo $this->get_field_name( 'featured' ); ?>" <?php checked( (bool) $instance['featured'], true ); ?> />
		</p>

		<!-- Number of links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of links to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>