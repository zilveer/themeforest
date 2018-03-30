<?php
/**
 * CP Single Post Stats Widget
 *
 * Display the stats of a post.
 * 
 * @package deTube
 * @subpackage Widgets
 * @since 1.1
 */

class CP_Widget_Single_Post_Stats extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget-single-post-stats', 'description' => __('Display the stats of a post.', 'cp_back_end'));
		
		parent::__construct('cp-single-post-stats', __(THEME_NAME. ' - Single Post Stats', 'cp'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		if(!is_single())
			return;
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo '<div class="video-statu">';
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		echo '<div class="widget video-status">';
		  echo cp_get_post_stats();
		echo '</div>';
		echo $after_widget;
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array('title' => __('Post Stats', 'cp'));
		$instance = wp_parse_args( (array) $instance, $defaults);
		
		$title = strip_tags($instance['title']); ?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title:", 'cp_back_end'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p class='description'><?php _e("This widget will only display on the single post page", 'cp_back_end'); ?></p>
	<?php }
}

// Register Widget
add_action('widgets_init', 'register_cp_widget_single_post_stats');
function register_cp_widget_single_post_stats() {
	register_widget('CP_Widget_Single_Post_Stats');
}