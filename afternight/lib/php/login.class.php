<?php 
	class login{
		public static function login_me(){
			$response = array();
			if( is_user_logged_in() ){

				$response['url'] = home_url();
				$response['status'] = 'success';
				$response['msg'] = __('Login successful','cosmotheme');

				echo json_encode($response);
				exit;
			}

			if( isset( $_POST[ 'login' ] ) && strlen( $_POST[ 'login' ] ) ){
				$login = $_POST[ 'login' ];
			}else{
				
				$response['status'] = 'error';
				$response['msg'] = __( 'Please enter a username' , 'cosmotheme' );

				echo json_encode($response);
				exit;
			}

			if( isset( $_POST[ 'password' ] ) && strlen( $_POST[ 'password' ] ) ){
				$password = $_POST[ 'password' ];
			}else{
				$response['status'] = 'error';
				$response['msg'] = __( 'Please enter a password' , 'cosmotheme' );

				echo json_encode($response);
				exit;
			}

			$remember = isset( $_POST[ 'remember' ] );

			$credentials = array( 'user_login' => $login , 'user_password' => $password , 'remember' => $remember);
			$result = @wp_signon( $credentials );
			if( is_wp_error( $result ) ){

				if(strpos($result -> get_error_message(), __('Lost your password','cosmotheme')) >= 0 ){
					$response['msg'] = __( 'Wrong password','cosmotheme' );
				}else{
					$response['msg'] = $result -> get_error_message();
				}		
				$response['status'] = 'error';
				

				echo json_encode($response);
			}else{
				
				$response['url'] = home_url();
				$response['status'] = 'success';
				$response['msg'] = __('Login successful','cosmotheme');

				echo json_encode($response);
			}
			exit;
		}
		public static function register(){
			$response = array();

			if( is_user_logged_in() ){
				
				$response['status'] = 'error';
				$response['msg'] =  __( 'You are logged in','cosmotheme' );
				echo json_encode($response);	
				exit;
			}
			if( isset( $_POST[ 'login' ] ) && strlen( $_POST[ 'login' ] ) ){
				$login = $_POST[ 'login' ];
			}else{
				
				$response['status'] = 'error';
				$response['msg'] =  __( 'Please enter a username','cosmotheme' );
				echo json_encode($response);
				exit;
			}

			if( isset( $_POST[ 'email' ] ) && is_email( $_POST[ 'email' ] ) ){
				$email = $_POST[ 'email' ];
			}else{
				$response['status'] = 'error';
				$response['msg'] =  __( 'Please enter a valid e-mail','cosmotheme' );
				echo json_encode($response);
				
				exit;
			}

			$random_password = wp_generate_password( 12, false );


			$subject = sprintf(__('%s - Your user name and password','cosmotheme'),get_bloginfo( 'name' ) );
			
			$message = sprintf(__('User name: %s 
Password: %s 
%s','cosmotheme'),$login, $random_password, home_url().'?action=login' );
			
			$result = wp_create_user( $login , $random_password , $email );
			if( is_wp_error( $result ) ){
				
				$response['status'] = 'error';
				$response['msg'] =  $result -> get_error_message();
				echo json_encode($response);
				
			}else{
				wp_mail( $email , $subject , $message );
				
				$response['url'] = home_url().'?action=login';
				$response['status'] = 'success';
				$response['msg'] =  __( 'Registration successful. Your password will be emailed to you','cosmotheme' );
				

				echo json_encode($response);
			}
			exit;
		}
	}
?>
