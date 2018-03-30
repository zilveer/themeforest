<?php

class TMM_Staff {

	public static $slug = 'team-page';

	public static function init() {

	}

	public static function admin_init() {
		self::init_meta_boxes();
		add_filter("manage_team-page_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_team-page_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
	}

	public static function get_meta_data($post_id) {
		$data = array();
		$custom = get_post_custom($post_id);
		$data['email'] = @$custom["email"][0];
		$data['twitter'] = @$custom["twitter"][0];
		$data['facebook'] = @$custom["facebook"][0];
		$data['linkedin'] = @$custom["linkedin"][0];
		$data['instagram'] = @$custom["instagram"][0];
		$data['dribble'] = @$custom["dribble"][0];
		$data['skype'] = @$custom["skype"][0];
		$data['cv'] = @$custom["cv"][0];
		return $data;
	}

	public static function credits_meta() {
		global $post;
		$data = self::get_meta_data($post->ID);
		@extract($data);
		include_once TMM_EXT_PATH . '/staff/views/credits_meta.php';
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "email", @$_POST["email"]);
				update_post_meta($post->ID, "twitter", @$_POST["twitter"]);
				update_post_meta($post->ID, "facebook", @$_POST["facebook"]);
				update_post_meta($post->ID, "linkedin", @$_POST["linkedin"]);
				update_post_meta($post->ID, "instagram", @$_POST["instagram"]);
				update_post_meta($post->ID, "dribble", @$_POST["dribble"]);
				update_post_meta($post->ID, "skype", @$_POST["skype"]);
				update_post_meta($post->ID, "cv", @$_POST["cv"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Team member attributes", 'diplomat'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<img alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '160*160') . '" style="max-width:100%" />';
				break;
			case "email":
				echo get_post_meta($post->ID, 'email', true);
				break;
			case "twitter":
				echo get_post_meta($post->ID, 'twitter', true);
				break;
			case "facebook":
				echo get_post_meta($post->ID, 'facebook', true);
				break;
			case "linkedin":
				echo get_post_meta($post->ID, 'linkedin', true);
				break;
			case "instagram":
				echo get_post_meta($post->ID, 'instagram', true);
				break;
			case "dribble":
				echo get_post_meta($post->ID, 'dribble', true);
				break;
			case "skype":
				echo get_post_meta($post->ID, 'skype', true);
				break;
			case "cv":
				echo get_post_meta($post->ID, 'cv', true);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns2 = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Name", 'diplomat'),
			"image" => __("Photo", 'diplomat'),
			"email" => __("Email", 'diplomat'),
			"twitter" => __("Twitter", 'diplomat'),
			"facebook" => __("Facebook", 'diplomat'),
			"linkedin" => __("Linkedin", 'diplomat'),
			"instagram" => __("Instagram", 'diplomat'),
			"dribble" => __("Dribble", 'diplomat'),
			"skype" => __("Skype", 'diplomat'),
			"cv" => __("CV", 'diplomat'),
		);

		$columns = array_merge($columns2, $columns);

		return $columns;
	}

}
