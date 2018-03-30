<?php

/**
 * posts widget
 */

class wpv_posts extends WP_Widget {

	public function __construct() {
		$widget_options = array(
			'classname' => 'wpv_posts',
			'description' => __("Displays a list of posts/comments", 'health-center')
		);
		parent::__construct('wpv_posts', __('Vamtam - Multi widget', 'health-center') , $widget_options);
		$this->alt_option_name = 'wpv_posts';
		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	public function widget($args, $instance) {
		$cache = wp_cache_get('theme_wpv_posts', 'widget');

		if (!is_array($cache))
			$cache = array();

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}

		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		if(!$number = (int) $instance['number'])
			$number = 10;
		elseif ($number < 1)
			$number = 1;
		elseif ($number > 15)
			$number = 15;

		if(!$desc_length = (int)$instance['desc_length'])
			$desc_length = 0;
		elseif($desc_length < 1)
			$desc_length = 1;
		$disable_thumbnail = $instance['disable_thumbnail'];
		$tag_taxonomy = $instance['tag_taxonomy'];

		$orderby = is_string($instance['orderby']) ? array($instance['orderby']) :   // backwards compatible with non-tabbed widget
					(is_array($instance['orderby']) ? $instance['orderby'] : array()); // just in case if orderby is not an array - pass an empty array

		$img_size = apply_filters('wpv_posts_widget_img_size', 300, $args);
		$thumbnail_name = apply_filters('wpv_posts_widget_thumbnail_name', 'thumbnail', $args);

		ob_start();
		include(locate_template('templates/widgets/front/posts.php'));
		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set('theme_wpv_posts', $cache, 'widget');
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']);
		$instance['cat'] = $new_instance['cat'];
		$instance['tag_taxonomy'] = $new_instance['tag_taxonomy'];

		$this->flush_widget_cache();

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('theme_wpv_posts', 'widget');
	}

	private function get_section_title($orderby, $single=false) {
		if($orderby == 'comment_count')
			return apply_filters('wpv_multiwidget_tab_title', __('Popular', 'health-center'), $orderby, $single);
		if($orderby == 'date')
			return apply_filters('wpv_multiwidget_tab_title', __('Newest', 'health-center'), $orderby, $single);
		if($orderby == 'comments')
			return apply_filters('wpv_multiwidget_tab_title', __('Comments', 'health-center'), $orderby, $single);
		if($orderby == 'tags')
			return apply_filters('wpv_multiwidget_tab_title', __('Tags', 'health-center'), $orderby, $single);
	}

	public function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset($instance['disable_thumbnail']) ? (bool)$instance['disable_thumbnail'] : false;
		$orderby = isset($instance['orderby']) ?
					(is_string($instance['orderby']) ? array($instance['orderby']) :   // backwards compatible with non-tabbed widget
						(is_array($instance['orderby']) ? $instance['orderby'] : array()) // just in case if orderby is not an array - pass an empty array
					) : array('comment_count');
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		$tag_taxonomy = isset($instance['tag_taxonomy']) ? $instance['tag_taxonomy'] : '';

		if (!isset($instance['number']) || !$number = (int)$instance['number'])
			$number = 5;

		$desc_length = isset($instance['desc_length']) ? $instance['desc_length'] : 80;
		$categories = get_categories('orderby=name&hide_empty=0');

		include(locate_template('templates/widgets/conf/posts.php'));
	}
}
register_widget('wpv_posts');
