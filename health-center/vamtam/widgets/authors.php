<?php

/**
 * author list
 */

class wpv_authors extends WP_Widget {

	private $max_authors = 10;

	public function __construct() {
		$widget_opts = array(
			'classname' => 'wpv_authors',
			'description' => __('List of authors and their descriptions', 'health-center')
			);
		parent::__construct('wpv_authors', __('Vamtam - Authors', 'health-center'), $widget_opts);
	}

	public function widget($args, $instance) {
		extract(wp_parse_args($args, array(
			'title' => '',
			'count' => '',
			'show_avatar' => '',
			'show_post_count' => '',
		)));

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Authors', 'health-center') : $instance['title'], $instance, $this->id_base);

		$count = (int)$instance['count'];

		include(locate_template('templates/widgets/front/authors.php'));
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		$instance['show_avatar'] = wpv_sanitize_bool($new_instance['show_avatar']);
		$instance['show_post_count'] = wpv_sanitize_bool($new_instance['show_post_count']);

		for($i=1; $i<=$instance['count']; $i++) {
			$instance['author_id'][$i] = strip_tags($new_instance["author_id_$i"]);
			$instance['author_desc'][$i] = strip_tags($new_instance["author_desc_$i"]);
		}
		return $instance;
	}

	public function form($instance) {
		global $wpdb;

		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$show_avatar = isset($instance['show_avatar']) ? $instance['show_avatar'] : false;
		$show_post_count = isset($instance['show_post_count']) ? $instance['show_post_count'] : false;

		for($i=1; $i<=$this->max_authors; $i++) {
			$selected_author[$i] = isset($instance['author_id'][$i]) ? $instance['author_id'][$i] : '';
			$author_descriptions[$i] = isset($instance['author_desc'][$i]) ? $instance['author_desc'][$i] : '';
		}

		$user_ids = $wpdb->get_col("SELECT ID FROM $wpdb->users ORDER BY user_nicename");
		foreach($user_ids as $user_id)
			$authors[$user_id] = get_userdata($user_id)->display_name;

		include(locate_template('templates/widgets/conf/authors.php'));
	}
}

register_widget('wpv_authors');
