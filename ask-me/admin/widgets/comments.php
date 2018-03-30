<?php
/* comments */
add_action( 'widgets_init', 'widget_comments_widget' );
function widget_comments_widget() {
	register_widget( 'Widget_Comments' );
}
class Widget_Comments extends WP_Widget {

	function Widget_Comments() {
		$widget_ops = array( 'classname' => 'comments-post-widget'  );
		$control_ops = array( 'id_base' => 'comments-post-widget' );
		parent::__construct( 'comments-post-widget','Ask me - Comments', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title			  = apply_filters('widget_title', $instance['title'] );
		$comments_number  = $instance['comments_number'];
		$comment_excerpt  = $instance['comment_excerpt'];
		$post_or_question = $instance['post_or_question'];
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;
			Vpanel_comments($post_or_question,$comments_number,$comment_excerpt);
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance					  = $old_instance;
		$instance['title']			  = strip_tags( $new_instance['title'] );
		$instance['comments_number']  = esc_attr($new_instance['comments_number']);
		$instance['comment_excerpt']  = esc_attr($new_instance['comment_excerpt']);
		$instance['post_or_question'] = esc_attr($new_instance['post_or_question']);
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Comments','comments_number' => '5','comment_excerpt' => '30','post_or_question' => 'question' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_or_question' ); ?>">Post or question : </label>
			<select id="<?php echo $this->get_field_id( 'post_or_question' ); ?>" name="<?php echo $this->get_field_name( 'post_or_question' ); ?>">
				<option value="post" <?php if( isset($instance['post_or_question']) && $instance['post_or_question'] == 'post' ) echo "selected=\"selected\""; else echo ""; ?>>Post</option>
				<option value="question" <?php if( isset($instance['post_or_question']) && $instance['post_or_question'] == 'question' ) echo "selected=\"selected\""; else echo ""; ?>>Question</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comments_number' ); ?>">Number of comments to show : </label>
			<input id="<?php echo $this->get_field_id( 'comments_number' ); ?>" name="<?php echo $this->get_field_name( 'comments_number' ); ?>" value="<?php echo (isset($instance['comments_number'])?esc_attr($instance['comments_number']):""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_excerpt' ); ?>">The number of words excerpt</label>
			<input id="<?php echo $this->get_field_id( 'comment_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'comment_excerpt' ); ?>" value="<?php echo (isset($instance['comment_excerpt'])?esc_attr($instance['comment_excerpt']):""); ?>" size="3" type="text">
		</p>
	<?php
	}
}
?>