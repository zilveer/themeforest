<?php
/**
 * Plugin Name: Category List Widget
 */

add_action( 'widgets_init', 'mvp_taglist_load_widgets' );

function mvp_taglist_load_widgets() {
	register_widget( 'mvp_taglist_widget' );
}

class mvp_taglist_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_taglist_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_taglist_widget', 'description' => __('A widget that displays a list of posts from a tag of your choice.', 'mvp-text') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_taglist_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_taglist_widget', __('Flex Mag: Tag List Widget', 'mvp-text'), $widget_ops, $control_ops );
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

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
			<div class="blog-widget-wrap left relative">
				<ul class="blog-widget-list left relative">
					<?php $recent = new WP_Query(array( 'tag' => $tags, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div class="blog-widget-img left relative">
									<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'widget-img-main' )); ?>
									<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'widget-img-side' )); ?>
									<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
									<div class="feat-info-wrap">
										<div class="feat-info-views">
											<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
										</div><!--feat-info-views-->
										<?php $disqus_id = get_option('mvp_disqus_id'); if ( ! $disqus_id ) { if (get_comments_number()==0) { } else { ?>
											<div class="feat-info-comm">
												<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
											</div><!--feat-info-comm-->
										<?php } } ?>
									</div><!--feat-info-wrap-->
									<?php } ?>
									<?php if ( has_post_format( 'video' )) { ?>
										<div class="feat-vid-but">
											<i class="fa fa-play fa-3"></i>
										</div><!--feat-vid-but-->
									<?php } ?>
								</div><!--blog-widget-img-->
							<?php } ?>
							<div class="blog-widget-text left relative">
								<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
								<h2><?php the_title(); ?></h2>
								<p><?php echo wp_trim_words( get_the_excerpt(), 14, '...' ); ?></p>
							</div><!--blog-widget-text-->
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!--blog-widget-wrap-->
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
		$instance['tags'] = strip_tags( $new_instance['tags'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Tag -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>">Tag Name:</label>
			<input id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="<?php echo $instance['tags']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>