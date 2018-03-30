<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_Subscribe_Ajax') ){
	class Mars_Subscribe_Ajax {
		function __construct() {
			add_action('wp_ajax_mars_subscrib_act', array( $this, 'subscribe' ));
			add_action('wp_ajax_nopriv_mars_subscrib_act', array( $this, 'subscribe' ));
		}
		function subscribe(){
			global $videotube;
			$name = wp_filter_nohtml_kses( $_POST['name'] );
			$email = wp_filter_nohtml_kses( $_POST['email'] );
			$agree = wp_filter_nohtml_kses( $_POST['agree'] );
			$referer = wp_filter_nohtml_kses( $_POST['referer'] );
			$role = isset( $videotube['subscribe_roles'] ) ? $videotube['subscribe_roles'] : 'subscriber';
			if( !$name ){
				echo json_encode( array( 
					'resp'	=>	'error',
					'message'	=>	__('Please enter your name.','mars'),
					'id'	=>	'name'
				) );
				exit;
			}
			if( !$email || !is_email( $email ) ){
				echo json_encode( array( 
					'resp'	=>	'error',
					'message'	=>	__('Please enter a valid email address.','mars'),
					'id'	=>	'email'
				) );
				exit;
			}
			if( $agree != true || $agree != 'true'){
				echo json_encode( array( 
					'resp'	=>	'error',
					'message'	=>	__('Please agree with our Private Policy.','mars'),
					'id'	=>	'agree'
				) );
				exit;
			}			
			
			$user_id = wp_insert_user(array(
				'user_login'	=>	$email,
				'user_email'	=>	$email,
				'display_name'	=>	$name,
				'user_pass'	=>	wp_generate_password(6, true),
				'role'	=>	$role
			));
			if( is_wp_error( $user_id ) ){
				echo json_encode( array( 
					'resp'	=>	'error',
					'message'	=>	$user_id->get_error_message(),
				) );
				exit;
			}
			update_user_meta($user_id, 'referer', $referer);
			echo json_encode( array(
				'resp'	=>	'success',
				'message'	=>	__('Congratulation.','mars'),
				'redirect_to'	=>	get_permalink( $referer )
			) );exit;
		}
	}
	new Mars_Subscribe_Ajax();
}