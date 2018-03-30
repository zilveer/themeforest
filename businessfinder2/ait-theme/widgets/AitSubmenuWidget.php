<?php


class AitSubmenuWidget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_submenu', 'description' => __( 'Display submenu for current page', 'ait-admin') );
		parent::__construct('ait-submenu', __('Theme &rarr; Submenu', 'ait-admin'), $widget_ops);
	}



	function widget( $args, $instance )
	{
		extract( $args );
		$result = '';

		global $post;
		if(isset($post)){
			$children = wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
			if ($children) { $parent = $post->ID;
			} else {
				$parent = $post->post_parent;
				if(!$parent){ $parent = $post->ID; }
			}
			$parent_title = get_the_title($parent);
		} else {
			$parent = 0;
			$parent_title = '';
		}

		$output = wp_list_pages( array('title_li' => '', 'echo' => 0, 'child_of' =>$parent, 'sort_column' => 'menu_order', 'depth' => 1) );
		if(empty( $output )){
			$output = wp_list_pages( array('title_li' => '', 'echo' => 0, 'sort_column' => 'menu_order', 'depth' => 1) );
		}

		/* WIDGET CONTENT :: START */
		$result .= $before_widget;
		$title = '';
		if(isset($instance['title'])){
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		}
		$result .= $before_title.$title.$after_title;
		$result .= '<ul>'.$output.'</ul>';
		$result .= $after_widget;
		/* WIDGET CONTENT :: END */

		echo($result);
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
            'title' => '',
        ) );
    ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'ait-admin'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
<?php
	}

}
