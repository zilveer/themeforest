<?php
add_action('widgets_init', 'recent_comments_widget_register');

function recent_comments_widget_register() {
	register_widget('RecentComments_Widget');
}

class RecentComments_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'recent_comments_widget',
			__('MultiPurpose Recent Comments', 'multipurpose'),
			array('description' => esc_attr__('Shows recent comments with user avatars', 'multipurpose'))
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', $instance['title']); 
	    $limit = is_numeric($instance['limit']) ? $instance['limit'] : 0;

	    echo $args['before_widget'];  
	    if (!empty($title)) {
	    	echo $args['before_title'] . $title . $args['after_title'];  
	    }  
	    if($limit > 0) {
		    $c_opts = array(
		    	'status' => 'approve',
		    	'number' => $limit
		    	);
		    $comments = get_comments($c_opts);
		    if(count($comments)) : ?>
		    <ul class="recent-comments">
		    	<?php foreach($comments as $com) : 
		    	$pid = $com->comment_post_ID;
		    	$post = get_post($pid);
		    	$words = explode(" ", $com->comment_content);
		    	$comm_short = implode(" ", array_slice($words, 0, 10)) . "...";
		    	?>
		    	<li>
					<?php echo get_avatar($com->comment_author_email, 40); ?>
					<p class="comment-head"><span class="who"><?php echo $com->comment_author ?></span> on <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></p>
					<p><?php echo $comm_short; ?></p>
				</li>
		    	<?php endforeach; ?>
		    </ul><?php 
		    endif;
		}
	    echo $args['after_widget'];  
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php 
		if (isset($instance['limit'])) {
			$limit = $instance['limit'];
		} else {
			$limit = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_attr_e('Number of comments to show:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" />
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 0;
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : 0;
		return $instance;
	}	
}
?>