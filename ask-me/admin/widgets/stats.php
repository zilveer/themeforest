<?php
/* stats */
add_action( 'widgets_init', 'widget_stats_widget' );
function widget_stats_widget() {
	register_widget( 'Widget_Stats' );
}

function get_all_comments_of_post_type($post_type){
	global $wpdb;
	$cc = $wpdb->get_var("SELECT COUNT(comment_ID)
		FROM $wpdb->comments
		WHERE comment_post_ID in (
		SELECT ID 
		FROM $wpdb->posts 
		WHERE post_type = '$post_type' 
		AND post_status = 'publish')
		AND comment_approved = '1'
	");
	return $cc;
}

class Widget_Stats extends WP_Widget {

	function Widget_Stats() {
		$widget_ops = array( 'classname' => 'stats-widget'  );
		$control_ops = array( 'id_base' => 'stats-widget' );
		parent::__construct( 'stats-widget','Ask me - Stats', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE %s=1",1);
		$query = $wpdb->get_results($query);
		$users = $wpdb->num_rows;
			
		echo $before_widget;
		$best_answer_option = get_option("best_answer_option");
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<div class="widget_stats ul_list ul_list-icon-ok">
				<ul>
					<li><i class="icon-question-sign"></i><?php _e("Questions","vbegy")?> ( <span><?php echo wp_count_posts("question")->publish;?></span> )</li>
					<li><i class="fa fa-comments-o"></i><?php _e("Answers","vbegy")?> ( <span><?php echo get_all_comments_of_post_type("question")?></span> )</li>
					<li><i class="fa fa-comments-o"></i><?php _e("Best Answers","vbegy")?> ( <span><?php echo (isset($best_answer_option) && $best_answer_option != "" && $best_answer_option > 0?$best_answer_option:0)?></span> )</li>
					<li><i class="icon-user"></i><?php _e("Users","vbegy")?> ( <span><?php echo ($users)?></span> )</li>
				</ul>
			</div>
			<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance					 = $old_instance;
		$instance['title']			 = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Stats','vbegy') );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories('hide_empty=0');
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>