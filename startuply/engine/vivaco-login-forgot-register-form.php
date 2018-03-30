<?php

$errors_login = array();
$errors_register = array();

function viavco_custom_login() {
	if (!empty($_POST['log_submit'])) {
		global $errors_login;
		$errors_login = array();

		wp_clear_auth_cookie();

		$creds = array();
		$creds['user_login'] = $_POST['log_login'];
		$creds['user_password'] = $_POST['log_password'];
		$creds['remember'] = (!empty($_POST['log_remember']) && $_POST['log_remember'] == 'yes') ? true : false;

		$user = wp_signon($creds, false);

		if ( !is_wp_error($user) ) {

			wp_set_current_user($user->ID);

		} else {

			$errors_login['error_login'] = $user->get_error_message();

		}
	}
	if (!empty($_POST['reg_submit'])) {
		global $errors_register;
		$errors_register = array();

		$fullname = !empty($_POST['reg_fullname']) ? $_POST['reg_fullname'] : '';
		$email = !empty($_POST['reg_email']) ? $_POST['reg_email'] : '';
		$password = !empty($_POST['reg_password']) ? $_POST['reg_password'] : '';
		$password_repeat = !empty($_POST['reg_password_repeat']) ? $_POST['reg_password_repeat'] : '';

		if (email_exists($email)) {

			$errors_register['reg_email'] = 'Email Already in use';

		}

		if (strlen($password) < 6) {

			$errors_register['reg_password'] = 'Password is too short (minimum is 6 characters)';

		}

		if ($password != $password_repeat) {

			$errors_register['reg_password_repeat'] = 'Passwords dont match';

		}

		if (count($errors_register) == 0) {

			$tmp = explode (" ", $fullname, 2); // for name as Alex Victor Maria

			$userdata = array(
				'first_name' => esc_attr($tmp[0]),
				'last_name' => empty($tmp[1]) ? '' : esc_attr($tmp[1]),
				'user_login' => $email,
				'user_email' => $email,
				'user_pass' => $password,
			);

			$register_user = wp_insert_user($userdata);

			if (!is_wp_error($register_user)) {

				wp_new_user_notification($register_user, $password);

				$errors_register['success_register'] = 'Yay! You can now log in wih your new account';

			} else {

				$errors_register['error_register'] = $register_user->get_error_message();

			}
		}
	}
}
add_action( 'after_setup_theme', 'viavco_custom_login' );

function vivaco_register_form() {
	$output = '';

	if ( is_user_logged_in() ) {
		$output = '<div class="row"><div class="col col-xs-12"><h4 class="text-center">You are already registered</h4></div></div>';

		return $output;
	}

	global $errors_register;
	$register = '';

	if (empty($_POST['reg_submit']) || count($errors_register) > 0 ) {

		ob_start();
		vivaco_register_form_output($errors_register);
		$register = ob_get_clean();

		$output = '<div class="row"><div class="col col-xs-12">'.$register.'</div></div>';
	}

	return $output;
}


function vivaco_login_forgot_form() {
	$output = '';

	if ( is_user_logged_in() ) {
		ob_start();

		//vivaco_registered_user_info();

		$output = ob_get_clean();

		return $output;
	}

	global $errors_login;

	$login_forgot = '';

	if (empty($_POST['log_submit']) || count($errors_login) > 0 ) {

		ob_start();
		vivaco_login_forgot_form_output($errors_login);
		$login_forgot = ob_get_clean();

		$output = '<div class="row"><div class="col col-xs-12">'.$login_forgot.'</div></div>';
	}

	return $output;
}


function vivaco_login_forgot_form_output($errors) {
	?>
		<div class="vivaco-form show" id="login-form">
			<h4 class="text-center">Existing user</h4>
			<form name="registration" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="wpcf7-form">

				<div class="form form-overlay">

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap log_login">
							<input type="text" name="log_login" value="<?php echo(isset($_POST['log_login']) ? $_POST['log_login'] : null); ?>" placeholder="Login" class="wpcf7-form-control form-control"  aria-required="true" aria-invalid="false" required  tabindex="1">
						</span>
						<?php echo(!empty($errors['log_login']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['log_login'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap log_password">
							<input type="password" name="log_password" value="<?php echo(isset($_POST['log_password']) ? $_POST['log_password'] : null); ?>" placeholder="Password" class="wpcf7-form-control form-control" aria-required="true" aria-invalid="false" required  tabindex="2">
						</span>
						<?php echo(!empty($errors['log_password']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['log_password'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<input type="checkbox" name="log_remember" id="log_remember" value="yes" <?php echo(!empty($_POST['log_remember']) && $_POST['log_remember'] == '' ? 'checked' : ''); ?>   tabindex="3">
						<label for="log_remember">Remember Me</label>
					</div>

					<div class="form-group col-xs-12">
						<input type="submit" value="Login" name="log_submit" class="wpcf7-form-control wpcf7-submit btn base_clr_bg btn-solid"  tabindex="4">
					</div>

					<?php

						$error_msg = (isset($errors['error_login']) ? str_replace('<a href="http://dev.startuplywp.com/wp-login.php?action=lostpassword">Lost your password</a>?', '', $errors['error_login']) : '');

						echo(isset($errors['error_login']) ? '<div class="form-group col-xs-12 wpcf7-response-output wpcf7-mail-sent-ng">'.$error_msg.'</div>' : '');

					?>

					<div class="forgot-link text-center"><a href="#">Forgot Password</a></div>
				</div>
			</form>
		</div>

		<div class="vivaco-form hide" id="forgot-form">
			<h4 class="text-center">Forgot password?</h4>

			<form name="forgot" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post" class="wpcf7-form">

				<div class="form form-overlay">
					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap user_login">
							<input type="text" name="user_login" value="<?php echo(isset($_POST['user_login']) ? $_POST['user_login'] : null); ?>" placeholder="Enter your email to reset your password." class="wpcf7-form-control form-control"  aria-required="true" aria-invalid="false" required  tabindex="1001">
						</span>
					</div>

					<div class="form-group col-xs-12">
						<input type="submit" value="Reset Password" name="for_submit" class="wpcf7-form-control wpcf7-submit btn base_clr_bg btn-solid"  tabindex="1002">
					</div>

					<input type="hidden" name="redirect_to" value="<?php echo esc_url(vivaco_extend_uri($_SERVER['REQUEST_URI'], array('reset' => 'true') ) ); ?>" />
					<input type="hidden" name="user-cookie" value="1" />

					<?php $reset = empty($_GET['reset']) ? false : $_GET['reset']; if($reset == true) { echo '<div class="form-group col-xs-12 wpcf7-response-output wpcf7-mail-sent-ok">A message will be sent to your email address.</div>'; } ?>

					<div class="forgot-link text-center"><a href="#">&larr; Back to login</a></div>

				</div>
			</form>
		</div>
	<?php
}

function vivaco_register_form_output($errors) {
	?>
		<div class="vivaco-form" id="registration-form">
			<h4 class="text-center">New user</h4>
			<form name="registration" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="wpcf7-form">

				<div class="form form-overlay">

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap reg_fullname">
							<input type="text" name="reg_fullname" value="<?php echo(isset($_POST['reg_fullname']) ? $_POST['reg_fullname'] : null); ?>" placeholder="Fullname" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-invalid="false"  tabindex="2001">
						</span>
						<?php echo(!empty($errors['reg_fullname']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['reg_fullname'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap reg_email">
							<input type="text" name="reg_email" value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>" placeholder="Email" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control email" aria-required="true" aria-invalid="false" required  tabindex="2002">
						</span>
						<?php echo(!empty($errors['reg_email']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['reg_email'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap reg_password">
							<input type="password" name="reg_password" value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>" placeholder="Password" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control password" aria-required="true" aria-invalid="false" required  tabindex="2003">
						</span>
						<?php echo(!empty($errors['reg_password']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['reg_password'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<span class="wpcf7-form-control-wrap reg_password_repeat">
							<input type="password" name="reg_password_repeat" value="<?php echo(isset($_POST['reg_password_repeat']) ? $_POST['reg_password_repeat'] : null); ?>" placeholder="Repeat password" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control password" aria-required="true" aria-invalid="false" required  tabindex="2004">
						</span>
						<?php echo(!empty($errors['reg_password_repeat']) ? '<span role="alert" class="wpcf7-not-valid-tip">'.$errors['reg_password_repeat'].'</span>' : ''); ?>
					</div>

					<div class="form-group col-xs-12">
						<input type="submit" value="Register" name="reg_submit" class="wpcf7-form-control wpcf7-submit btn base_clr_bg btn-solid"  tabindex="2005">
					</div>

					<?php echo(isset($errors['error_register']) ? '<div class="form-group col-xs-12 wpcf7-response-output wpcf7-mail-sent-ng">'.$errors['error_register'].'</div>' : ''); ?>
					<?php echo(isset($errors['success_register']) ? '<div class="form-group col-xs-12 wpcf7-response-output wpcf7-mail-sent-ok">'.$errors['success_register'].'</div>' : ''); ?>
				</div>
			</form>
		</div>
	<?php
}


function vivaco_registered_user_info() {
	global $user_ID, $user_identity; get_currentuserinfo();
	?>
		<div class="row">
			<div class="col col-sm-6 col-xs-12">
				<h3>Welcome, <?php echo $user_identity; ?></h3>

				<div class="col col-xs-4">
					<div class="usericon">
						<?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60); ?>
					</div>
				</div>

				<div class="col col-xs-8">
					<div class="userinfo">
						<p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
						<p>
							<a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> |
							<?php if (current_user_can('manage_options')) {
								echo '<a href="' . admin_url() . '">' . __('Admin', 'vivaco' ) . '</a>'; } else {
								echo '<a href="' . admin_url() . 'profile.php">' . __('Profile', 'vivaco' ) . '</a>'; } ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	<?php
}

function vivaco_extend_uri($uri, $vars) {
	$query = parse_url($uri, PHP_URL_QUERY);

	// Returns a string if the URL has parameters or NULL if not
	if ($query) {
	    $uri .= '&'.http_build_query($vars);
	} else {
	    $uri .= '?'.http_build_query($vars);
	}

	return $uri;
}
?>
