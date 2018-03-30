<?php
/**
 * Plugin Name: Middle Buzz Widget
 */

add_action( 'widgets_init', 'ht_buzz_load_widgets' );

function ht_buzz_load_widgets() {
	register_widget( 'ht_buzz_widget' );
}

class ht_buzz_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function ht_buzz_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ht_buzz_widget', 'description' => __('A widget designed for the Homepage Middle Widget Area that displays a list of posts from a category of your choice.', 'ht_buzz_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ht_buzz_widget' );

		/* Create the widget. */
		$this->__construct( 'ht_buzz_widget', __('Hot Topix: Middle Buzz Widget', 'ht_buzz_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		$categories = $instance['categories'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

		<h3 class="widget-buzz-header"><?php echo $title; ?></h3>
		<ul class="widget-buzz">
			<?php $recent = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post();?>
			<li>
				<span class="buzz-byline"><?php the_time(get_option('date_format')); ?></span>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			</li>
			<?php endwhile; ?>
		</ul>


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
		$instance['categories'] = $new_instance['categories'];


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'The Latest', 'number' => 4);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select category (select All Categories to display latest posts):</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>


	<?php
	}
}

?>