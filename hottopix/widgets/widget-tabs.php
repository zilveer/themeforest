<?php
/**
 * Plugin Name: Sidebar Tabs Widget
 */

add_action( 'widgets_init', 'ht_tabs_load_widgets' );

function ht_tabs_load_widgets() {
	register_widget( 'ht_tabs_widget' );
}

class ht_tabs_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function ht_tabs_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ht_tabs_widget', 'description' => __('A tabber widget that displays recent headlines, popular posts and recent comments.', 'ht_tabs_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ht_tabs_widget' );

		/* Create the widget. */
		$this->__construct( 'ht_tabs_widget', __('Hot Topix: Tabs Widget', 'ht_tabs_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$latest_title = $instance['latest_title'];
		$latest_number = $instance['latest_number'];
		$categories = $instance['categories'];
		$popular_number = $instance['popular_number'];
		$comment_number = $instance['comment_number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>


	<div class="tabber-container">
		<ul class="tabs tabber-widget">
			<li><h4><a href="#tab1"><?php _e( 'Popular', 'mvp-text' ); ?></a></h4></li>
			<li><h4><a href="#tab2"><?php echo $latest_title; ?></a></h4></li>
			<li><h4><a href="#tab3"><?php _e( 'Comments', 'mvp-text' ); ?></a></h4></li>
		</ul>
		<div id="tab1" class="tabber-content">
			<div class="cat-light-bottom cat-light-links">
				<?php $popular_posts = new WP_Query('showposts=' . $popular_number . '&orderby=comment_count&order=DESC'); if($popular_posts->have_posts()): ?>
				<ul>
					<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('small-thumb'); ?></a>
							<?php } ?>
							<span class="list-byline"><?php the_author_posts_link(); ?> | <?php the_time(get_option('date_format')); ?></span>
							<p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
			</div><!--cat-light-bottom-->
		</div><!--tab1-->
		<div id="tab2" class="tabber-content">
			<div class="cat-light-bottom cat-light-links">
				<ul>
					<?php $recent = new WP_Query('cat=' . $categories . '&showposts=' . $latest_number . ' '); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('small-thumb'); ?></a>
							<?php } ?>
							<span class="list-byline"><?php the_author_posts_link(); ?> | <?php the_time(get_option('date_format')); ?></span>
							<p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!--cat-light-bottom-->
		</div><!--tab2-->
		<div id="tab3" class="tabber-content">


				<ul class="latest-comments">
				<?php
				global $wpdb;
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type,comment_author_url,
				SUBSTRING(comment_content,1,45) AS com_excerpt
				FROM $wpdb->comments
				LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
				$wpdb->posts.ID)
				WHERE comment_approved = '1' AND comment_type = '' AND
				post_password = ''
				ORDER BY comment_date_gmt DESC
				LIMIT $comment_number";
				$comments = $wpdb->get_results($sql);
				foreach ($comments as $comment) {

				?>

					<li>
						<div class="comment-image">
							<?php echo get_avatar( $comment, '50' ); ?>
						</div>
						<div class="comment-text">
						<span><?php echo strip_tags($comment->comment_author); ?> <?php _e( 'says', 'mvp-text' ); ?>:</span><br />
						<p><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->com_excerpt); ?>...</a></p>
						</div>
					</li>

				<?php } ?>
				</ul>

		</div><!--tab3-->
	</div><!--tabber-container-->


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
		$instance['latest_title'] = strip_tags( $new_instance['latest_title'] );
		$instance['latest_number'] = strip_tags( $new_instance['latest_number'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['popular_number'] = strip_tags( $new_instance['popular_number'] );
		$instance['comment_number'] = strip_tags( $new_instance['comment_number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'latest_title' => 'Latest', 'latest_number' => 3, 'popular_number' => 3, 'comment_number' => 3);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Latest Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'latest_title' ); ?>">Latest Title:</label>
			<input id="<?php echo $this->get_field_id( 'latest_title' ); ?>" name="<?php echo $this->get_field_name( 'latest_title' ); ?>" value="<?php echo $instance['latest_title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of "Latest" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'latest_number' ); ?>">Number of "Latest" posts to show:</label>
			<input id="<?php echo $this->get_field_id( 'latest_number' ); ?>" name="<?php echo $this->get_field_name( 'latest_number' ); ?>" value="<?php echo $instance['latest_number']; ?>" size="3" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select Category:</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of "Popular" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_number' ); ?>">Number of "Popular" posts to show:</label>
			<input id="<?php echo $this->get_field_id( 'popular_number' ); ?>" name="<?php echo $this->get_field_name( 'popular_number' ); ?>" value="<?php echo $instance['popular_number']; ?>" size="3" />
		</p>

		<!-- Number of "Comments" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_number' ); ?>">Number of "Comments" to show:</label>
			<input id="<?php echo $this->get_field_id( 'comment_number' ); ?>" name="<?php echo $this->get_field_name( 'comment_number' ); ?>" value="<?php echo $instance['comment_number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>