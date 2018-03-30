<?php
class LiberoLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_libero_mikado_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_libero_mikado_like', array( $this, 'ajax'));
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	function enqueue_scripts() {

		wp_enqueue_script( 'mkd-like', MIKADO_ASSETS_ROOT . '/js/like.min.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'mkd-like', 'mkdLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
		if( isset($_POST['likes_id']) ) {

			$post_id = str_replace('mkd-like-', '', $_POST['likes_id']);
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
			$post_id = str_replace('mkd-like-', '', $_POST['likes_id']);
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
				$like_count = get_post_meta($post_id, '_mkd-like', true);
				if(isset($_COOKIE['mkd-like_'. $post_id])){
					$icon = '<i class="icon-heart icon_heart" aria-hidden="true"></i>';
				}else{
					$icon = '<i class="icon-heart icon_heart_alt" aria-hidden="true"></i>';
				}
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_mkd-like', $like_count, true);
					$icon = '<i class="icon-heart icon_heart_alt" aria-hidden="true"></i>';
				}
				$return_value = $icon . "<span>" . $like_count . "</span><span class='likes'>". esc_html__('Likes', 'libero'). "</span>";

				return $return_value;
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_mkd-like', true);

				if($type != 'portfolio_list' && isset($_COOKIE['mkd-like_'. $post_id])) {
					return $like_count;
				}

				$like_count++;

				update_post_meta($post_id, '_mkd-like', $like_count);
				setcookie('mkd-like_'. $post_id, $post_id, time()*20, '/');

				if($type != 'portfolio_list') {
					$return_value = "<i class='icon-heart icon_heart' aria-hidden='true'></i><span>" . $like_count . "</span>";

					$return_value .= "</span><span class='likes'>". esc_html__('Likes', 'libero'). "</span>";
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

		$class = 'mkd-like';
		$title = esc_html__('Like this', 'libero');
		if( isset($_COOKIE['mkd-like_'. $post->ID]) ){
			$class = 'mkd-like liked';
			$title = esc_html__('You already like this!', 'libero');
		}

		return '<a href="#" class="'. $class .'" id="mkd-like-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){

		$class = 'mkd-like';
		$title = esc_html__('Like this', 'libero');
		if( isset($_COOKIE['mkd-like_'. $portfolio_project_id]) ){
			$class = 'mkd-like liked';
			$title = esc_html__('You already like this!', 'libero');
		}

		return '<a class="'. $class .'" data-type="portfolio_list" id="mkd-like-'. $portfolio_project_id .'" title="'. $title .'"></a>';
	}

    function add_like_portfolio_post($portfolio_project_id){
        global $post;

        $output = $this->like_post($post->ID);

        $class = 'mkd-like';
        $title = esc_html__('Like this', 'libero');
        if( isset($_COOKIE['mkd-like_'. $portfolio_project_id]) ){
            $class = 'mkd-like liked';
            $title = esc_html__('You already like this!', 'libero');
        }

        return '<a class="'. $class .'" id="mkd-like-'. $portfolio_project_id .'" title="'. $title .'">'.$output.'</a>';
    }

	public function add_like_blog_list($blog_id){

		$class = 'mkd-like';
		$title = esc_html__('Like this', 'libero');
		if( isset($_COOKIE['mkd-like_'. $blog_id]) ){
			$class = 'mkd-like liked';
			$title = esc_html__('You already like this!', 'libero');
		}

		return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="mkd-like-'. $blog_id .'" title="'. $title .'"></a>';
	}

}

global $libero_mikado_like;
$libero_mikado_like = LiberoLike::get_instance();
