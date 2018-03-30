<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists( 'Mars_LoginRegister_Template' ) ){
	class Mars_LoginRegister_Template {
		function __construct() {
			add_action( 'init' , array( $this, 'Init' ), 100);
			add_action('init', array( $this, 'add_shortcodes'), 200);
			add_filter('login_form_bottom', array( $this,'login_form_bottom' ));
			add_action( 'login_form_middle', array( $this , 'add_lost_password_link' ) );
			### ajax
			add_action('wp_ajax_nopriv_vt_ajax_login', array( $this, 'vt_ajax_login' ));
			add_action('wp_ajax_nopriv_vt_ajax_register', array( $this, 'vt_ajax_register' ));
			add_action('wp_ajax_nopriv_vt_ajax_lostpassword', array( $this, 'vt_ajax_lostpassword' ));	

			add_filter('vt_logged_redirect_to', array( $this , 'vt_logged_redirect_to' ), 10, 2);
			add_filter('vt_registered_redirect_to', array( $this,'vt_registered_redirect_to' ), 10, 2 );			
		}
		function Init(){
			global $videotube;
			$loginpage = isset( $videotube['loginpage'] ) ? $videotube['loginpage'] : null;
			$content = get_post( $loginpage );
			if( $loginpage && strpos( $content->post_content , 'videotube_login') !== false ){
				add_action( 'login_form_login', array( $this, 'login_form_login' ) );
				add_action( 'login_form_register', array( $this, 'login_form_register' ) );
			}			
		}
		function login_form_login(){
			global $videotube;
			$permalink_structure = get_option('permalink_structure') ? '?' : '&amp;';
			$redirect_to = $_REQUEST['redirect_to'] ? $permalink_structure . 'redirect_to=' . $_REQUEST['redirect_to'] : null;
			$loginpage = isset( $videotube['loginpage'] ) ? $videotube['loginpage'] : null;
			if( $loginpage ){
				wp_redirect( get_permalink( $loginpage ) . $redirect_to );	
			}
			else{
				wp_redirect( wp_login_url( home_url() ) );
			}
		}
		function login_form_register(){
			global $videotube;
			$loginpage = isset( $videotube['loginpage'] ) ? $videotube['loginpage'] : null;
			if( $loginpage ){
				$permalink_structure = get_option('permalink_structure') ? '?' : '&amp;';
				$redirect_to = $_REQUEST['redirect_to'] ? $permalink_structure . 'redirect_to=' . $_REQUEST['redirect_to'] : null;
				wp_redirect( get_permalink( $loginpage ) . $redirect_to );
			}
			else{
				wp_redirect( wp_registration_url() );
			}
		}
		function add_lost_password_link() {
			return '<a href="'.wp_lostpassword_url( home_url() ).'">'.__('Lost Password?','mars').'</a>';
		}
		function add_shortcodes(){
			add_shortcode('videotube_login', array( $this,'videotube_login' ));
		}
		function login_form_bottom(){
			$hidden = null;
			if( isset( $_REQUEST['redirect_to'] ) ){
				$hidden = '<input type="hidden" name="redirect_to" value="'.$_REQUEST['redirect_to'].'">';
			}
			$hidden .= '
				<input type="hidden" name="action" value="vt_ajax_login">
				<input type="hidden" name="button_label" value="'.__( 'Log In','mars' ).'">
			';
			return $hidden;
		}
		function videotube_login( $attr, $content ){
			global $videotube;
			extract(shortcode_atts(array(
				'terms_url'		=>	'',
			), $attr));			
			if( get_current_user_id() ){
				$content .= '<div class="alert alert-success alert-dismissable ">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'.sprintf( __('You are already logged in, %s','mars'), '<a href="'.wp_logout_url( home_url() ).'">'.__('Logout?','mars').'</a>' ).'</div>';
			}
			else{
				$args = array(
			        'echo'           => false,
			        'redirect'       => isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : home_url(), 
			        'form_id'        => 'vt_loginform',
			        'label_username' => __( 'Username','mars' ),
			        'label_password' => __( 'Password','mars' ),
			        'label_remember' => __( 'Remember Me','mars' ),
			        'label_log_in'   => __( 'Log In','mars' ),
			        'id_username'    => 'user_login',
			        'id_password'    => 'user_pass',
			        'id_remember'    => 'rememberme',
			        'id_submit'      => 'wp-submit',
			        'remember'       => true,
			        'value_username' => NULL,
			        'value_remember' => false
				);
				$content .= '<div class="alert" style="display:none;"></div>';
				$content .= '<div class="row">';
					$content .= '<div class="col-md-6">';
						$content .= '<h2>'.__('Login','mars').'</h2>';
						$content .= wp_login_form( apply_filters( 'mars_loginform_args' , $args) );
					$content .= '</div>';
					if( get_option('users_can_register') ){
						$content .= '<div class="col-md-6">';
							$content .= '
					        	<h2>'.__('Register your Account','mars').'</h2>
					            <form name="registerform" id="registerform" action="'.esc_url( site_url('wp-login.php?action=register', 'login_post') ).'" method="post">
					            	<p>
					            		<label for="user_login">'.__('Username','mars').'</label>
					            		<input type="text" name="username" id="username" class="input form-control" />
					            	</p>
					            	<p>
					            		<label for="user_email">'.__('Email','mars').'</label>
					            		<input type="text" name="user_email" id="user_email" class="input form-control"/>
					            	</p>';
										ob_start();
						                do_action('register_form');
						                $content .= ob_get_clean();
										$error = null;
										if( isset( $videotube['login_register_captcha'] ) && $videotube['login_register_captcha'] == 1 && $videotube['public_key'] ){
											if( function_exists( 'recaptcha_get_html' ) ){
												$content .= '<p>';
												$content .= recaptcha_get_html($videotube['public_key'], $error);
												$content .= '</p>';	
											}
										}
										if( !empty( $terms_url ) ){
											$content .= '
											<p class="register-terms">
												<input type="checkbox" name="terms_required"><a href="'.esc_url( $terms_url ).'">'.__('I have read the terms & conditions.','mars').'</a>
												<input type="hidden" name="terms" value="required">
											</p>
											';
										}										
						                $content .= '<input type="submit" value="'.__( 'Register','mars' ).'" id="register" />';
						                $content .= '<input type="hidden" name="action" value="vt_ajax_register"><input type="hidden" name="button_label" value="'.__( 'Register','mars' ).'">';
						                if( isset( $_GET['redirect_to'] ) ){
						                	$content .= '<input type="hidden" name="redirect_to" value="'.esc_url( $args['redirect_to'] ).'">';
						                }	                
						              $content .= '
					            </form>						
							';
						$content .= '</div>';						
					}						
				$content .= '</div>';
			}
			return $content;
		}
		function vt_ajax_lostpassword(){
			$user_login = wp_filter_nohtml_kses( $_POST['user_login'] );
			if( !$user_login ){
				echo json_encode( array(
					'resp'	=>	'error',
					'message'	=>	__('Please enter Username.','mars')
				) );exit;
			}
		}
		function vt_ajax_register(){
			global $videotube;
			if( !get_option( 'users_can_register' ) ){
				print json_encode( array(
					'resp'		=>	'error',
					'message'	=>	__('Sorry, Currently our Register system is disabled.','mars')
				) );exit;
			}	

			// Check terms required.
			if( isset( $_POST['terms'] ) && esc_attr( $_POST['terms'] ) == 'required' && ( empty( $_POST['terms_required'] ) ) ){
				print json_encode( array(
					'resp'		=>	'error',
					'message'	=>	__('Haven\'t you read the terms & conditions?','mars')
				) );exit;
			}

			### recaptcha
			if( isset( $videotube['login_register_captcha'] ) && $videotube['login_register_captcha'] == 1 ){
				if( !function_exists( 'recaptcha_check_answer' ) ){
					echo json_encode( array(
						'resp'	=>	'error',
						'message'	=>	__('Can not found Recaptcha library.','mars')
					) );exit;
				}
				# the response from reCAPTCHA
				$resp = null;
				# the error code from reCAPTCHA, if any
				$error = null;				
				if( !$_POST["recaptcha_response_field"] ){
					echo json_encode(array(
						'resp'	=>	'error',
						'message'	=>	__('Recaptcha is required','mars')
					));exit;					
				}
				$resp = recaptcha_check_answer ($videotube['private_key'],
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
                if (!$resp->is_valid){
					echo json_encode(array(
						'resp'	=>	'error',
						'message'	=>	$error = $resp->error
					));exit;
                }				
			}
			$user_id = register_new_user( $_POST['username'] , $_POST['user_email']);
			if( is_wp_error( $user_id ) ){
				print json_encode(array(
					'resp'		=>	'error',
					'message'	=>	$user_id->get_error_message()
				));exit;
			}
			else{
				print json_encode(array(
					'resp'		=>	'success',
					'message'	=>	__('Registration complete. Please check your e-mail.','mars')
				));exit;
			}
	
		}
		function vt_ajax_login(){
			$user_login = isset( $_POST['log'] ) ? $_POST['log'] : null;
			$user_password = isset( $_POST['pwd'] ) ? $_POST['pwd'] : null;
			$rememberme = isset( $_POST['rememberme'] ) ? true : false;
			$redirect_to = isset( $_POST['redirect_to'] ) ? trim( $_POST['redirect_to'] ) : null;
			if( !$user_login ){
				echo json_encode( array(
					'resp'	=>	'error',
					'message'	=>	__('<strong>ERROR</strong>: The username field is empty.','mars')
				) );exit;
			}
			if( !$user_password ){
				echo json_encode( array(
					'resp'	=>	'error',
					'message'	=>	__('<strong>ERROR</strong>: The password field is empty.','mars')
				) );exit;
			}
			$user = wp_signon(array(
				'user_login'	=>	$user_login,
				'user_password'	=>	$user_password,
				'remember'	=>	$rememberme
			), false);
			if ( is_wp_error($user) ){
				echo json_encode( array(
					'resp'	=>	'error',
					'message'	=>	$user->get_error_message()
				) );
				exit;
			}
			else{
				echo json_encode( array(
					'resp'	=>	'success',
					'message'	=>	__('Logged','mars'),
					'redirect_to'	=>	apply_filters('vt_logged_redirect_to', $redirect_to, $user->ID )
				) );
				exit;
			}
		}
		function vt_logged_redirect_to( $redirect_to, $user_id ){
			return home_url();
		}
		function vt_registered_redirect_to( $redirect_to, $user_id ){
			return home_url();
		}
	}
	$logintemplate = new Mars_LoginRegister_Template();
}