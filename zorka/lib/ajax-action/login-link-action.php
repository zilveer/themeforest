<?php
// Login Popup
function zorka_login_callback() {
ob_start();
?>
<div id="zorka-popup-login-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<form id="zorka-popup-login-form" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_html_e('Close','zorka'); ?>"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php esc_html_e('Login','zorka'); ?></h4>
			</div>
			<div class="modal-body">
					<div class="zorka-popup-login-content">
						<div class="form-group">
							<label for="username"><?php esc_html_e('Username:','zorka') ?></label>
							<div class="input-icon">
								<input type="text" id="username" class="form-control"  name="username" required="required" placeholder="<?php esc_html_e('Username','zorka') ?>">
								<i class="fa fa-user"></i>
							</div>
						</div>
						<div class="form-group">
							<label for="password"><?php esc_html_e('Password:','zorka') ?></label>
							<div class="input-icon">
								<input type="password" id="password" name="password" class="form-control" required="required" placeholder="<?php esc_html_e('Password','zorka') ?>">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="login-message"></div>
					</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="action" value="zorka_login_ajax"/>
				<div class="modal-footer-left">
					<input id="remember-me" type="checkbox" name="rememberme" checked="checked"/>
					<label for="remember-me" no-value="<?php esc_html_e('NO','zorka') ?>" yes-value="<?php esc_html_e('YES','zorka') ?>"></label>
					<?php esc_html_e('Remember me','zorka') ?>
				</div>
				<div class="modal-footer-right">
					<button type="submit" class="button" style="width: 100%"><?php esc_html_e('Login','zorka'); ?></button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_zorka_login', 'zorka_login_callback' );
add_action( 'wp_ajax_zorka_login', 'zorka_login_callback' );

function zorka_login_ajax_callback () {
	ob_start();
	global $wpdb;

	//We shall SQL escape all inputs to avoid sql injection.
	$username = esc_sql($_REQUEST['username']);
	$password = esc_sql($_REQUEST['password']);
	$remember = esc_sql($_REQUEST['rememberme']);

	if($remember) $remember = "true";
	else $remember = "false";

	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;
	$user_verify = wp_signon( $login_data, false );


	$code = 1;
	$message = '';

	if ( is_wp_error($user_verify) )
	{
		$message = $user_verify->get_error_message();
		$code = -1;
	}
	else {
		wp_set_current_user( $user_verify->ID, $username );
		do_action('set_current_user');
		$message = '';
	}

	$response_data = array(
		'code' 	=> $code,
		'message' 	=> $message
	);

	ob_end_clean();
	echo json_encode( $response_data );
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_zorka_login_ajax', 'zorka_login_ajax_callback' );
add_action( 'wp_ajax_zorka_login_ajax', 'zorka_login_ajax_callback' );

//---------------------------------------------------
// SIGN UP Popup
//---------------------------------------------------
function zorka_sign_up_callback() {
	ob_start();
	?>
	<div id="zorka-popup-login-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<form id="zorka-popup-login-form" class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_html_e('Close','zorka'); ?>"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><?php esc_html_e('Sign Up','zorka'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="zorka-popup-login-content">
						<div class="form-group">
							<label for="username"><?php esc_html_e('Username:','zorka') ?></label>
							<div class="input-icon">
								<input type="text" id="username" class="form-control"  name="username" required="required" placeholder="<?php esc_html_e('Username','zorka') ?>">
								<i class="fa fa-user"></i>
							</div>
						</div>
						<div class="form-group">
							<label for="email"><?php esc_html_e('Email:','zorka') ?></label>
							<div class="input-icon">
								<input type="email" id="email" name="email" class="form-control" required="required" placeholder="<?php esc_html_e('Email','zorka') ?>">
								<i class="fa fa-envelope"></i>
							</div>
						</div>
						<div><?php esc_html_e('A password will be e-mailed to you','zorka') ?></div>
						<div class="login-message"></div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="action" value="zorka_sign_up_ajax"/>
					<div class="modal-footer-right">
						<button type="submit" class="button" style="width: 100%"><?php esc_html_e('Register','zorka'); ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_zorka_sign_up', 'zorka_sign_up_callback' );
add_action( 'wp_ajax_zorka_sign_up', 'zorka_sign_up_callback' );

function zorka_sign_up_ajax_callback () {
	include_once ABSPATH . WPINC . '/ms-functions.php';
	include_once ABSPATH . WPINC . '/user.php';

	ob_start();
	global $wpdb;

	//We shall SQL escape all inputs to avoid sql injection.
	$user_name = esc_sql($_REQUEST['username']);
	$user_email = esc_sql($_REQUEST['email']);


	$error = wpmu_validate_user_signup($user_name, $user_email);
	$code = 1;
	$message = '';
	if ($error['errors']->get_error_code() != '') {
		$code = -1;
		foreach ($error['errors']->get_error_messages() as $key => $value) {
			$message .= '<div/>' . esc_html__('<strong>ERROR:</strong> ','zorka') . esc_html($value) . '</div>';
		}
	}
	else {
		register_new_user($user_name, $user_email);
	}

	$response_data = array(
		'code' 	=> $code,
		'message' 	=> $message
	);

	ob_end_clean();
	echo json_encode( $response_data );
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_zorka_sign_up_ajax', 'zorka_sign_up_ajax_callback' );
add_action( 'wp_ajax_zorka_sign_up_ajax', 'zorka_sign_up_ajax_callback' );

