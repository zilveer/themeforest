<?php
/**
 * Monarch Widget Posts
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

class widget_posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'posts', // Base ID
			esc_html__( 'Monarch Posts', 'monarch' ), // Name
			array( 'description' => esc_html__( 'A widget that displays your latest posts', 'monarch' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract($args);
		//Our variables from the widget settings.
		$title      = apply_filters('widget_title', $instance['title']);
		$categories = $instance['categories'];
		$number     = $instance['number'];
		$query = array(
			'showposts'           => $number,
			'nopaging'            => 0,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'cat'                 => $categories
		);
		$loop = new WP_Query($query);
		if ($loop->have_posts()):
			echo $args['before_widget'];
		// Display the widget title 
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
	?>
		<ul>
			<?php while ($loop->have_posts()) : $loop->the_post(); ?>

			<?php if ( get_the_title() ) : ?>
			<li>
				<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<div class="image">
					<a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
				</div>
				<?php endif; ?>

					<div class="text">
						<h4><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<span><?php the_time( get_option('date_format') ); ?></span>
					</div>

				<div class="clearfix"></div>
			</li>
			<?php endif; ?>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<?php endif; ?>
		</ul>
	<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title'      => esc_html__('Last Posts', 'monarch'),
			'number'     => 3,
			'categories' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'monarch'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Category:', 'monarch'); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number of posts to show:', 'monarch'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		$instance['categories'] = ( ! empty( $new_instance['categories'] ) ) ? strip_tags( $new_instance['categories'] ) : '';

		return $instance;
	}

} // class widget_posts
?>