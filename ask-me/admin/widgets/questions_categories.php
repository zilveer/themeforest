<?php
/* Questions Categories */
add_action( 'widgets_init', 'widget_questions_categories_widget' );
function widget_questions_categories_widget() {
	register_widget( 'Widget_Questions_Categories' );
}
class Widget_Questions_Categories extends WP_Widget {

	function Widget_Questions_Categories() {
		$widget_ops = array( 'classname' => 'questions_categories-widget'  );
		$control_ops = array( 'id_base' => 'questions_categories-widget' );
		parent::__construct( 'questions_categories-widget','Ask me - Questions Categories', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title			  = apply_filters('widget_title', $instance['title'] );
		$questions_counts = esc_attr($instance['questions_counts']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<ul>
				<?php $args = array(
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'question-category',
				'pad_counts'               => false );
				$options_categories = get_categories($args);
				foreach ($options_categories as $category) {
					$get_question_category = get_option("questions_category_".$category->term_id);?>
					<li>
						<a href="<?php echo get_term_link($category->slug,'question-category')?>"><?php echo $category->name;
							if ($questions_counts == "on") {?>
								<span> ( <span><?php echo $category->count." ".__("Questions","vbegy")?></span> ) </span>
							<?php }?>
						</a>
					</li>
				<?php }?>
			</ul>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance					  = $old_instance;
		$instance['title']			  = strip_tags( $new_instance['title'] );
		$instance['questions_counts'] = $new_instance['questions_counts'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Questions Categories','vbegy'),'questions_counts' => 'on' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['questions_counts']) && $instance['questions_counts'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'questions_counts' ); ?>" name="<?php echo $this->get_field_name( 'questions_counts' ); ?>">
			<label for="<?php echo $this->get_field_id( 'questions_counts' ); ?>">Show questions counts?</label>
		</p>
	<?php
	}
}
?>