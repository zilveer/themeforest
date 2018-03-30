<?php
class QodeStartitLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_qode_startit_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_qode_startit_like', array( $this, 'ajax'));
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	function enqueue_scripts() {

		wp_enqueue_script( 'qode_startit_like', QODE_ASSETS_ROOT . '/js/like.min.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'qodef-like', 'qodefLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
		if( isset($_POST['likes_id']) ) {

			$post_id = str_replace('qodef-like-', '', $_POST['likes_id']);
			$type    = isset($_POST['type']) ? $_POST['type'] : '';

			echo wp_kses($this->like_post($post_id, 'update', $type), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}

		//get
		else {
			$post_id = str_replace('qodef-like-', '', $_POST['likes_id']);
			echo wp_kses($this->like_post($post_id, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $action = 'get', $type = ''){
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_qode-like', true);
				if(isset($_COOKIE['qodef-like_'. $post_id])){
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
				}else{
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_qode-like', $like_count, true);
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				$return_value = $icon . "<span>" . $like_count . "</span>";

				return $return_value;
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_qode-like', true);

				if($type != 'portfolio_list' && isset($_COOKIE['qodef-like_'. $post_id])) {
					return $like_count;
				}

				$like_count++;

				update_post_meta($post_id, '_qode-like', $like_count);
				setcookie('qodef-like_'. $post_id, $post_id, time()*20, '/');

				if($type != 'portfolio_list') {
					$return_value = "<i class='icon_heart' aria-hidden='true'></i><span>" . $like_count . "</span>";

					$return_value .= '</span>';
					return $return_value;
				}

				return '';
				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'qodef-like';
		$title = esc_html__('Like this', 'startit');
		if( isset($_COOKIE['qodef-like_'. $post->ID]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'startit');
		}

		return '<a href="#" class="'. $class .'" id="qodef-like-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){

		$class = 'qodef-like';
		$title = esc_html__('Like this', 'startit');
		if( isset($_COOKIE['qodef-like_'. $portfolio_project_id]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'startit');
		}

		return '<a class="'. $class .'" data-type="portfolio_list" id="qodef-like-'. $portfolio_project_id .'" title="'. $title .'"></a>';
	}

	public function add_like_blog_list($blog_id){

		$class = 'qodef-like';
		$title = esc_html__('Like this', 'startit');
		if( isset($_COOKIE['qodef-like_'. $blog_id]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'startit');
		}

		return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="qodef-like-'. $blog_id .'" title="'. $title .'"></a>';
	}

}

global $qode_startit_like;
$qode_startit_like = QodeStartitLike::get_instance();
