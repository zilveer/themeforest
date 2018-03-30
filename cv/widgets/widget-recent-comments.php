<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'wpspace_recent_comments_load_widgets' );

/**
 * Register our widget.
 */
function wpspace_recent_comments_load_widgets() {
	register_widget('wpspace_recent_comments_widget');
}

/**
 * Recent_blogposts Widget class.
 */
class wpspace_recent_comments_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wpspace_recent_comments_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_wpspace_recent_comments', 'description' => 'The recent blog comments');

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'wpspace-recent-comments-widget');

		/* Create the widget. */
		parent::__construct('wpspace-recent-comments-widget', 'WP Space - Recent Blog Comments', $widget_ops, $control_ops);
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
			'status' => 'approve',
			'number' => $number,
    	);

    	$recent_comments = get_comments($args);
		$post_number = 0;
		foreach ($recent_comments as $post) {
			$post_text = getShortString($post->comment_content, 50);
			$post_author = $post->user_id > 0 ? get_the_author_meta('display_name', $post->user_id) : $post->comment_author;
			$post_author_url = $post->user_id > 0 ? get_author_posts_url($post->user_id) : $post->comment_author_url;
			$output .= '
                        	<li class="article' . ($post_number%2==0 ? 'even' : 'odd') . ($post_number==0 ? ' first' : '') . ($post_number==$number-1 ? ' last' : '') .'">
								<span class="author">' . ($post_author_url ? '<a href="' . $post_author_url . '">' : '') . $post_author . ($post_author_url ? '</a>' : '') . '</span>: <span class="comment">' . $post_text . '</span>
                                <ol class="icons">
                                	<li class="post_date"><span class="icon-time"></span>' . dateDifference($post->comment_date) . ' ago</li>
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