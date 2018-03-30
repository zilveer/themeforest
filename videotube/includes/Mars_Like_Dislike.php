<?php
/**
 * VideoTube Like Button.
 * Handle Like Ajax button.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_Like_Dislike') ){
	class Mars_Like_Dislike {
		var $like_key = 'like_key';
		var $dislike_key = 'dislike_key';
		function __construct() {
			add_action('wp_ajax_actionlikedislikes', array($this,'action'));
			add_action('wp_ajax_nopriv_actionlikedislikes', array($this,'action'));
		}
		public function action(){
			if(!isset($_SESSION)){ session_start();}
			global $videotube;
			$error = array();
			$act = isset( $_REQUEST['act'] ) ? $_REQUEST['act'] : null;
			$post_id = isset( $_REQUEST['id'] ) ? (int)$_REQUEST['id'] : null;
			$user_id = get_current_user_id() ? get_current_user_id() : null;
			$guestlike = isset( $videotube['guestlike'] ) ? $videotube['guestlike'] : 1;
			### Check if action is OK.
			if( $act == null ){
				$error = array(
					'resp'	=>	'error',
					'message'	=>	__('The action is not defined.','mars')
				);
				echo json_encode( $error );exit;
			}
			### Only allow Members do this action.
			if( $guestlike == 0 && !$user_id ){
				$error = array(
					'resp'	=>	'error',
					'message'	=>	sprintf(__('Please %s to continue.','mars'), '<a href="'.wp_login_url( get_permalink($post_id) ).'">'.__('login','mars').'</a>')
				);
				echo json_encode( $error );exit;				
			}
			### Check if the member has already rated this post.
			
			if( isset( $_SESSION['is_like_dislike'] ) ){
				
				if( $_SESSION['is_like_dislike']['post_id'] == $post_id && $_SESSION['is_like_dislike']['user_id'] == $user_id ){
					$error = array(
						'resp'	=>	'error',
						'message'	=>	__('You have already rated this video','mars')
					);
					echo json_encode( $error );exit;
				}
				
			}
			
			switch ($act) {
				case 'like':
					$this->like( $post_id );
					$error = array(
						'resp'	=>	'success',
						'message'	=>	__('Thanks for your rating :)','mars'),
						'like'	=>	$this->get($post_id, 'like')
					);
				break;
				default:
					$this->dislike( $post_id );
					$error = array(
						'resp'	=>	'success',
						'message'	=>	__('Thanks for your rating :(','mars'),
						'dislike'	=>	$this->get($post_id, 'dislike')
					);			
				break;
			}
			$_SESSION['is_like_dislike'] = array(
				'action'	=>	$act,
				'post_id'	=>	$post_id,
				'user_id'	=>	$user_id
			);
			echo json_encode( $error );exit;
		}
		public function like( $post_id ){
			$current_like_count = (int)get_post_meta($post_id, $this->like_key,true );
			return update_post_meta($post_id, $this->like_key, $current_like_count+1);
		}
		public function dislike( $post_id ){
			$current_dislike_count = (int)get_post_meta($post_id, $this->dislike_key,true );
			return update_post_meta($post_id, $this->dislike_key, $current_dislike_count+1);
		}		
		public function get( $post_id, $key = 'like' ){
			switch ($key) {
				case 'like':
					return get_post_meta($post_id, $this->like_key,true);
				break;
				case 'dislike':
					return get_post_meta($post_id, $this->dislike_key,true);
				break;
			}
		}
	}
	new Mars_Like_Dislike();
}