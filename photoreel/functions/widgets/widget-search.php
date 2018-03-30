<?php
add_action('widgets_init', 'tmnf_search_widget');

function tmnf_search_widget()
{
	register_widget('tmnf_search_widget');
}

class tmnf_search_widget extends WP_Widget {
	
	function tmnf_search_widget()
	{
		$widget_ops = array('classname' => 'tmnf_search_widget', 'description' => 'Sidebar posts widget.');

		$control_ops = array('id_base' => 'tmnf_search_widget');

		$this->WP_Widget('tmnf_search_widget', 'Themnific - Search', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		
		echo $before_widget;
		?>

			<div class="serchwidget"><?php get_template_part('/includes/uni-searchform'); ?></div>
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'show_excerpt' => null);
		$instance = wp_parse_args((array) $instance, $defaults); ?>


		

		

	<?php }
}
?>