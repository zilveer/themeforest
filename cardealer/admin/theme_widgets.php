<?php

class ThemeMakers_Latest_Tweets_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Displays latest tweets', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Latest Tweets', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Latest on Twitter',
			'twitter_id' => '351293746240958465',
			'postcount' => 2,
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/latest_tweets', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/latest_tweets_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Social_Links_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Displays website social links', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Social Links', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Social Links',
			'twitter_links' => 'https://twitter.com/ThemeMakers',
			'twitter_tooltip' => 'Twitter',
			'facebook_links' => 'http://www.facebook.com/wpThemeMakers',
			'facebook_tooltip' => 'Facebook',
			'dribble_links' => '',
			'dribble_tooltip' => 'Dribble',
			'vimeo_links' => '',
			'vimeo_tooltip' => 'Vimeo',
			'rss_tooltip' => 'RSS',
			'show_rss_tooltip' => 'false',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/social_links', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/social_links_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Recent_Posts_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Displays recent blog posts', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Recent Posts', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Recent Posts',
			'category' => '',
			'post_number' => 3,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'true',
			'exerpt_symbols_count' => 60,
			'show_see_all_button' => 'false',
			'truncate_title' => 'false',
			'truncate_title_symbols_count' => 25,
			'show_comments_number' => 'false',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_posts', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_posts_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class TMM_Contact_Form_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows custom contact form.', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Contact Form', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Contact Form',
			'form' => '',
			'labels' => 'placeholder'
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_form', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_form_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Flickr_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Flickr feed widget', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Flickr feed widget', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Flickr Feed',
			'username' => '54958895@N06',
			'imagescount' => '6',
			'order' => 'latest',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/flickr', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/flickr_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class TMM_Google_Map_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Custom Google Map widget', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Google Map', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Our Location',
			'width' => '200',
			'height' => '200',
			'mode' => 'image',
			'latitude' => "40.714623",
			'longitude' => "-74.006605",
			'address' => 'New York',
			'location_mode' => 'address',
			'zoom' => 12,
			'maptype' => 'ROADMAP',
			'marker' => 'false',
			'scrollwheel' => 'false',
			'popup' => 'false',
			'popup_text' => ""
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/google_map', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/google_map_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Contacts_Bar_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('CarDealer\'s contact widget', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Contacts Bar', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Contact Us',
			'address' => '',
			'phone' => '',
			'fax' => '',
			'email' => '',
			'twitter' => 'ThemeMakers',
			'facebook' => 'wpThemeMakers',
			'show_rss' => 'false',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contacts_bar', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contacts_bar_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class TMM_Facebook_LikeBox_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Facebook Like Box widget', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Facebook LikeBox', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => __('Facebook Like Box', 'cardealer'),
			'pageURL' => 'https://www.facebook.com/wpThemeMakers',
			'width' => '360',
			'faces' => false,
			'posts' => false
		);
	}

	function widget($args, $instance) {
		if (!isset($instance['pageURL']) && isset($instance['pageID'])) {
			$instance['pageURL'] = 'https://www.facebook.com/' . $instance['pageID'];
		}
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/facebook', $args);
	}

	function form($instance) {
		if (!isset($instance['pageURL']) && isset($instance['pageID'])) {
			$instance['pageURL'] = 'https://www.facebook.com/' . $instance['pageID'];
		}
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/facebook_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Timetable_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Timetable', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Timetable Widget', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Our Hours',
			'mon_start' => "08:00",
			'mon_end' => "19:00",
			'mon_is_closed' => 'false',
			'tue_start' => "08:00",
			'tue_end' => "19:00",
			'tue_is_closed' => 'false',
			'wed_start' => "08:00",
			'wed_end' => "19:00",
			'wed_is_closed' => 'false',
			'thu_start' => "08:00",
			'thu_end' => "19:00",
			'thu_is_closed' => 'false',
			'fri_start' => "08:00",
			'fri_end' => "19:00",
			'fri_is_closed' => 'false',
			'sat_start' => "08:00",
			'sat_end' => "19:00",
			'sat_is_closed' => 'false',
			'sun_start' => "08:00",
			'sun_end' => "19:00",
			'sun_is_closed' => 'true',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/timetable', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/timetable_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

class ThemeMakers_Banners_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('ThemeMakers Banner widget', 'cardealer'));
		parent::__construct(__CLASS__, __('TMM Banners', 'cardealer'), $settings);
		$this->defaults = array(
			'title' => 'Banner',
			'size' => '',
			'text1' => '',
			'text2' => '',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/banners', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/banners_form', $args);
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach ($this->defaults as $k => $v) {
			$instance[$k] = $new_instance[$k];
		}
		if (isset($instance['title'])) {
			$instance['title'] = strip_tags($instance['title']);
		}
		return $instance;
	}

}

register_widget('ThemeMakers_Latest_Tweets_Widget');
register_widget('ThemeMakers_Social_Links_Widget');
register_widget('ThemeMakers_Recent_Posts_Widget');
register_widget('TMM_Contact_Form_Widget');
register_widget('ThemeMakers_Flickr_Widget');
register_widget('TMM_Google_Map_Widget');
register_widget('ThemeMakers_Contacts_Bar_Widget');
register_widget('TMM_Facebook_LikeBox_Widget');
register_widget('ThemeMakers_Timetable_Widget');
register_widget('ThemeMakers_Banners_Widget');
