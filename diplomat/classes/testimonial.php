<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Testimonial {

	public static $slug = 'tmonials';

	public static function init() {
		
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "position", @$_POST["position"]);
			}
		}
	}

	public static function admin_init() {
		//self::init_meta_boxes();
		add_filter( 'enter_title_here',  array(__CLASS__, 'change_default_title') );
	}

	public static function init_meta_boxes() {
		add_meta_box("testimonials_credits_meta", __("Position", 'diplomat'), array(__CLASS__, 'testimonials_credits_meta'), self::$slug, "normal", "low");
	}

	public static function testimonials_credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['position'] = @$custom["position"][0];
		echo TMM::draw_html('testimonials/credits_meta', $data);
	}

	public static function change_default_title( $title ){
		$screen = get_current_screen();
		if ( self::$slug == $screen->post_type ){
			$title = __('Enter author name', 'diplomat');
		}
		return $title;
	}

}