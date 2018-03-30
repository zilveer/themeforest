<?php
class QodeLike {
	
	 function __construct(){	
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_action('wp_ajax_qode_like', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_qode_like', array(&$this, 'ajax'));
	}
	
	function enqueue_scripts(){
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'qode-like', get_template_directory_uri() . '/js/qode-like.js', 'jquery', '1.0', TRUE );
		
		wp_localize_script( 'qode-like', 'qodeLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	
	function ajax($post_id){
		//update
		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('qode-like-', '', $_POST['likes_id']);
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
			$post_id = str_replace('qode-like-', '', $_POST['likes_id']);
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
				$like_count = get_post_meta($post_id, '_qode-like', true);
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_qode-like', $like_count, true);
				}
				$return_value = "<i class='icon_heart' aria-hidden='true'></i><span>" . $like_count . "</span>";
				
				$return_value .= '</span>';
				return $return_value;
				break;
				
			case 'update':
				$like_count = get_post_meta($post_id, '_qode-like', true);

				if($type != 'portfolio_list' && isset($_COOKIE['qode-like_'. $post_id])) {
					return $like_count;
				}
				
				$like_count++;

				update_post_meta($post_id, '_qode-like', $like_count);
				setcookie('qode-like_'. $post_id, $post_id, time()*20, '/');

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

	function add_qode_like(){
		global $post;

		$output = $this->like_post($post->ID);
  
  		$class = 'qode-like';
  		$title = __('Like this', 'qode');
		if( isset($_COOKIE['qode-like_'. $post->ID]) ){
			$class = 'qode-like liked';
			$title = __('You already liked this!', 'qode');
		}
		
		return '<a href="#" class="'. $class .'" id="qode-like-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}

	function add_qode_like_portfolio_list($portfolio_project_id){

  		$class = 'qode-like';
  		$title = __('Like this', 'qode');
		if( isset($_COOKIE['qode-like_'. $portfolio_project_id]) ){
			$class = 'qode-like liked';
			$title = __('You already like this!', 'qode');
		}
		
		return '<a class="'. $class .'" data-type="portfolio_list" id="qode-like-'. $portfolio_project_id .'" title="'. $title .'"></a>';
	}

    function add_qode_like_blog_list($blog_id){

        $class = 'qode-like';
        $title = __('Like this', 'qode');
        if( isset($_COOKIE['qode-like_'. $blog_id]) ){
            $class = 'qode-like liked';
            $title = __('You already like this!', 'qode');
        }

        return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="qode-like-'. $blog_id .'" title="'. $title .'"></a>';
    }
}

global $qode_like;
$qode_like = new QodeLike();

function qode_like() {
	global $qode_like;
    echo wp_kses($qode_like->add_qode_like(), array(
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

function qode_like_latest_posts() {
	global $qode_like;
	return $qode_like->add_qode_like(); 
}

function qode_like_portfolio_list($portfolio_project_id) {
	global $qode_like;
	return $qode_like->add_qode_like_portfolio_list($portfolio_project_id);
}