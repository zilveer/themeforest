<?php
/* big pic */
add_action( 'widgets_init', 'widget_questions_widget' );
function widget_questions_widget() {
	register_widget( 'Widget_Questions' );
}
class Widget_Questions extends WP_Widget {

	function Widget_Questions() {
		$widget_ops = array( 'classname' => 'questions-widget'  );
		$control_ops = array( 'id_base' => 'questions-widget' );
		parent::__construct( 'questions-widget','Ask me - Questions or posts', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title				= apply_filters('widget_title', $instance['title'] );
		$orderby			= esc_attr($instance['orderby']);
		$questions_per_page	= esc_attr($instance['questions_per_page']);
		$display_date		= esc_attr($instance['display_date']);
		$display_image		= esc_attr($instance['display_image']);
		$questions_excerpt	= esc_attr($instance['questions_excerpt']);
		$excerpt_title	    = esc_attr($instance['excerpt_title']);
		$post_or_question	= esc_attr($instance['post_or_question']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;
			Vpanel_Questions($questions_per_page,$orderby,$display_date,$questions_excerpt,$post_or_question,$excerpt_title,$display_image);
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance						= $old_instance;
		$instance['title']				= strip_tags( $new_instance['title'] );
		$instance['orderby']			= $new_instance['orderby'];
		$instance['questions_per_page'] = $new_instance['questions_per_page'];
		$instance['display_date']		= $new_instance['display_date'];
		$instance['display_image']		= $new_instance['display_image'];
		$instance['questions_excerpt']	= $new_instance['questions_excerpt'];
		$instance['excerpt_title']	    = $new_instance['excerpt_title'];
		$instance['post_or_question']	= $new_instance['post_or_question'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Recent','vbegy'),'orderby' => 'recent','display_date' => 'on','display_image' => 'on','questions_per_page' => '5','questions_excerpt' => '12','excerpt_title' => '5' );
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
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by : </label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option value="popular" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
				<option value="recent" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'recent' ) echo "selected=\"selected\""; else echo ""; ?>>Recent</option>
				<option value="random" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'questions_per_page' ); ?>">Number of questions to show : </label>
			<input id="<?php echo $this->get_field_id( 'questions_per_page' ); ?>" name="<?php echo $this->get_field_name( 'questions_per_page' ); ?>" value="<?php echo (isset($instance['questions_per_page'])?(int)$instance['questions_per_page']:""); ?>" size="3" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_image']) && $instance['display_image'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_image' ); ?>" name="<?php echo $this->get_field_name( 'display_image' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_image' ); ?>">Display image?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_date']) && $instance['display_date'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_date' ); ?>" name="<?php echo $this->get_field_name( 'display_date' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_date' ); ?>">Display date?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_title' ); ?>">The number of words excerpt title</label>
			<input id="<?php echo $this->get_field_id( 'excerpt_title' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_title' ); ?>" value="<?php echo (isset($instance['excerpt_title'])?(int)$instance['excerpt_title']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'questions_excerpt' ); ?>">The number of words excerpt (If you want an empty type 0)</label>
			<input id="<?php echo $this->get_field_id( 'questions_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'questions_excerpt' ); ?>" value="<?php echo (isset($instance['questions_excerpt'])?(int)$instance['questions_excerpt']:""); ?>" size="3" type="text">
		</p>
	<?php
	}
}
?>