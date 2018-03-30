<?php
class EdgeLike {
	
	 function __construct(){	
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_action('wp_ajax_edgt_like', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_edgt_like', array(&$this, 'ajax'));
	}
	
	function enqueue_scripts(){
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'edgt-like', get_template_directory_uri() . '/js/edgt-like.js', 'jquery', '1.0', TRUE );
		
		wp_localize_script( 'edgt-like', 'edgtLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	
	function ajax($post_id){		
		//update
		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('edgt-like-', '', $_POST['likes_id']);
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
			$post_id = str_replace('edgt-like-', '', $_POST['likes_id']);
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
	
	function like_post($post_id, $action = 'get', $type = ''){
		if(!is_numeric($post_id)) return;
	
		switch($action) {
		
			case 'get':
				$like_count = get_post_meta($post_id, '_edgt-like', true);
				if(isset($_COOKIE['edgt-like_'. $post_id])){
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
				}else{
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_edgt-like', $like_count, true);
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				$return_value = $icon . "<span>" . $like_count . "</span>";
				
				return $return_value;
				break;
				
			case 'update':
				$like_count = get_post_meta($post_id, '_edgt-like', true);

				if($type != 'portfolio_list' && isset($_COOKIE['edgt-like_'. $post_id])) {
					return $like_count;
				}
				
				$like_count++;

				update_post_meta($post_id, '_edgt-like', $like_count);
				setcookie('edgt-like_'. $post_id, $post_id, time()*20, '/');

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

	function add_edgt_like(){
		global $post;

		$output = $this->like_post($post->ID);
  
  		$class = 'edgt-like';
  		$title = __('Like this', 'edgt');
		if( isset($_COOKIE['edgt-like_'. $post->ID]) ){
			$class = 'edgt-like liked';
			$title = __('You already liked this!', 'edgt');
		}
		
		return '<a href="#" class="'. $class .'" id="edgt-like-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}

	function add_edgt_like_portfolio_list($portfolio_project_id){

  		$class = 'edgt-like';
  		$title = __('Like this', 'edgt');
		if( isset($_COOKIE['edgt-like_'. $portfolio_project_id]) ){
			$class = 'edgt-like liked';
			$title = __('You already like this!', 'edgt');
		}
		
		return '<a class="'. $class .'" data-type="portfolio_list" id="edgt-like-'. $portfolio_project_id .'" title="'. $title .'"></a>';
	}

    function add_edgt_like_blog_list($blog_id){

        $class = 'edgt-like';
        $title = __('Like this', 'edgt');
        if( isset($_COOKIE['edgt-like_'. $blog_id]) ){
            $class = 'edgt-like liked';
            $title = __('You already like this!', 'edgt');
        }

        return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="edgt-like-'. $blog_id .'" title="'. $title .'"></a>';
    }
}

global $edgt_like;
$edgt_like = new EdgeLike();

function edgt_like() {
	global $edgt_like;
	echo wp_kses($edgt_like->add_edgt_like(), array(
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
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

function edgt_like_latest_posts() {
	global $edgt_like;
	return $edgt_like->add_edgt_like(); 
}

function edgt_like_portfolio_list($portfolio_project_id) {
	global $edgt_like;
	return $edgt_like->add_edgt_like_portfolio_list($portfolio_project_id);
}