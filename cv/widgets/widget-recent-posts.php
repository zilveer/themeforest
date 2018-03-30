<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'wpspace_recent_posts_load_widgets' );

/**
 * Register our widget.
 */
function wpspace_recent_posts_load_widgets() {
	register_widget('wpspace_recent_posts_widget');
}

/**
 * Recent_blogposts Widget class.
 */
class wpspace_recent_posts_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wpspace_recent_posts_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_wpspace_recent_posts', 'description' => 'The recent blog posts');

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'wpspace-recent-posts-widget');

		/* Create the widget. */
		parent::__construct('wpspace-recent-posts-widget', 'WP Space - Recent Blog Posts', $widget_ops, $control_ops);
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		$number = isset($instance['number']) ? ($instance['number'] < 1 ? 4 : $instance['number']) : 4;

		/* Before widget (defined by themes). */			
		echo $before_widget;		

		
		$output = '';		
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ($title) $output .= $before_title . $title . $after_title;		
		
		$output .= '
					<ul>
		';
		
		$args = array(
			'numberposts' => $number*2,
			'offset' => 0,
			'category' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'suppress_filters' => true 
    	);

    	$recent_posts = wp_get_recent_posts($args);

		$post_number = 0;
		foreach ($recent_posts as $post) {
			if ($post['post_date'] > date('Y-m-d 23:59:59') && $post['post_date_gmt'] > date('Y-m-d 23:59:59')) continue;
			$post_title = getShortString($post['post_title'], 50);
			$post_author = get_the_author_meta('display_name', $post['post_author']);
			$output .= '
                        	<li class="article">
								<h4 class="title"><a href="' . get_permalink($post['ID']) . '">' . $post_title . '</a></h4>
                                <ol class="icons">
                                	<li class="post_date"><span class="icon-time"></span>' . date_i18n('M.d', strtotime($post['post_date'])) . '</li>
                                	<li class="post_author"><span class="icon-user"></span>' . $post_author . '</li>
								</ol>
							</li>
			';
			$post_number++;
			if ($post_number >= $number) break;
		}

		$output .= '
			</ul>
		';

		echo $output;
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {

		/* Set up some default widget settings. */
		$defaults = array('title' => '', 'number' => '4', 'description' => 'The recent blog posts');
		$instance = wp_parse_args((array) $instance, $defaults); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? $instance['number'] : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php echo 'Count all:'; ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" style="width:100%;" />
		</p>
	<?php
	}
}

?>