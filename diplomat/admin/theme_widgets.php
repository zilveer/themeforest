<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
class TMM_Latest_Tweets_Widget extends WP_Widget {

	public $defaults;

	function __construct() {

		$settings = array('classname' => __CLASS__, 'description' => __('Displays latest tweets', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Latest Tweets', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Latest on Twitter', 'diplomat'),
			'twitter_id' => '345111976353091584',
			'postcount' => 2
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

class TMM_Social_Links_Widget extends WP_Widget {

	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays website social links', 'diplomat'));

		//Creation
		parent::__construct(__CLASS__, __('ThemeMakers Social Links', 'diplomat'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/social_links', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];

		$social_types = unserialize(TMM::get_option('social_types'));

		foreach ($social_types as $key => $type) {
			$instance[$key.'_links'] = isset($new_instance[$key.'_links']) ? $new_instance[$key.'_links'] : '';
			$instance[$key.'_tooltip'] = isset($new_instance[$key.'_tooltip']) ? $new_instance[$key.'_tooltip'] : '';
		}

		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Social Links',
		);

		$social_types = unserialize(TMM::get_option('social_types'));

		foreach ($social_types as $key => $type) {
			$defaults[$key.'_tooltip'] = $type['name'];
			$defaults[$key.'_links'] = $type['link'];
		}

		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/social_links_form', $args);
	}

}

class TMM_Contact_Form_Widget extends WP_Widget {

	public $defaults;

	function __construct() {

		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows custom contact form.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Contact Form', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Contact Form', 'diplomat'),
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

class TMM_Flickr_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Flickr feed widget', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Flickr feed widget', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Flickr Feed', 'diplomat'),
			'username' => '54958895@N06',
			'imagescount' => '12'
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
		$settings = array('classname' => __CLASS__, 'description' => __('Custom Google Map widget', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Google Map', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Our Location', 'diplomat'),
			'width' => '360',
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

class TMM_Facebook_LikeBox_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Facebook Like Box widget', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Facebook LikeBox', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Facebook Like Box', 'diplomat'),
			'pageURL' => 'https://www.facebook.com/wpThemeMakers',
			'width' => '360',
			'faces' => true,
			'posts' => true
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/facebook', $args);
	}

	function form($instance) {
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

class TMM_Contact_Us_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Contact Us widget', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Contact Us', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Contact Us', 'diplomat'),
			'address' => '',
			'phone' => '',
			'email' => ''
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_us', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_us_form', $args);
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

class TMM_Mail_Subscription_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('Mail Subscription widget', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Mail Subscription', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Keep in touch with us', 'diplomat'),
			'description' => __('Information about current events related to our company', 'diplomat'),
			'zipcode' => 'true',
			'submit_button' => __('Enter your email', 'diplomat')
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/mail_subscription', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/mail_subscription_form', $args);
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

class TMM_Recent_Posts_Widget extends WP_Widget {

	public $defaults;

	function __construct() {

		$settings = array('classname' => __CLASS__, 'description' => __('Displays recent blog posts', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Popular/Latest/Comments', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Recent Posts', 'diplomat'),
			'category' => '',
			'number_category_posts' => 3,
			'number_popular_posts' => 3,
			'number_latest_posts' => 3,
			'number_comments_posts' => 3,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'true',
			'title_excerpt' => 20,
			'exerpt_symbols_count' => 60,
			'show_see_all_button' => 'false'
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

class TMM_Video_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows video.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Video', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Video Title', 'diplomat'),
			'url' => '',
			'video_cover_image' => '',
			'video_cover_image_on_mobiles' => 1,
			'height' => '',
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/video', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/video_form', $args);
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

class TMM_Testimonials_Widget extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows testimonials.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Testimonials', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => __('Testimonials', 'diplomat'),
			'show' => 'mode1',
			'content' => '',
			'count' => '-1',
			'order' => 'ASC',
			'orderby' => 'date',
			'show_photo' => 'true'
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/testimonials', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/testimonials_form', $args);
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

class TMM_Featured_Boxes extends WP_Widget {

	public $defaults;

	function __construct() {
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows featured boxes.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Metro Style', 'diplomat'), $settings);
		$this->defaults = array(
			'first_box_title' => 'Events',
			'first_box_title_color' => '#8ad9f2',
			'first_box_color' => '#14b3e4',
			'first_box_icon' => 'icon-megaphone',
			'first_box_link' => '#',

			'second_box_title' => 'Get Involved',
			'second_box_title_color' => '#424246',
			'second_box_color' => '#ffffff',
			'second_box_icon' => 'none',
			'second_box_link' => '#',

			'third_box_title' => 'Issues and Positions',
			'third_box_title_color' => '#ffffff',
			'third_box_color' => '#424246',
			'third_box_icon' => 'none',
			'third_box_link' => '#',

			'fourth_box_title' => 'Volunteer',
			'fourth_box_title_color' => '#ffb0af',
			'fourth_box_color' => '#ff615e',
			'fourth_box_icon' => 'icon-thumbs-up-5',
			'fourth_box_link' => '#'
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/featured_boxes', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/featured_boxes_form', $args);
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

class TMM_Accordion_Widget extends WP_Widget {

	public $defaults;

	function __construct() {

		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows accordion.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Accordion', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => '',
			'acc_titles' => '',
			'acc_bodies' => ''
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/accordion', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/accordion_form', $args);
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

class TMM_Shortcodes_Widget extends WP_Widget {

	public $defaults;

	function __construct() {

		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows the TinyMCE editor with theme shortcodes.', 'diplomat'));
		parent::__construct(__CLASS__, __('ThemeMakers Editor', 'diplomat'), $settings);
		$this->defaults = array(
			'title' => '',
			'content' => ''
		);
	}

	function widget($args, $instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/shortcodes', $args);
	}

	function form($instance) {
		$args['instance'] = wp_parse_args((array) $instance, $this->defaults);
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/shortcodes_form', $args);
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

register_widget('TMM_Latest_Tweets_Widget');
register_widget('TMM_Recent_Posts_Widget');
register_widget('TMM_Social_Links_Widget');
register_widget('TMM_Testimonials_Widget');
register_widget('TMM_Contact_Form_Widget');
register_widget('TMM_Flickr_Widget');
register_widget('TMM_Google_Map_Widget');
register_widget('TMM_Facebook_LikeBox_Widget');
register_widget('TMM_Contact_Us_Widget');
register_widget('TMM_Mail_Subscription_Widget');
register_widget('TMM_Video_Widget');
register_widget('TMM_Featured_Boxes');
register_widget('TMM_Accordion_Widget');
register_widget('TMM_Shortcodes_Widget');