<?php

/**
 * User Lost Password Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="x-bbp-general-form">
	<form method="post" action="<?php bbp_wp_login_action( array( 'action' => 'lostpassword', 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
		<fieldset class="bbp-form">
			<legend><?php _e( 'Lost Password', 'bbpress' ); ?></legend>

			<div class="bbp-template-notice">
				<p><?php _e( 'Enter in your username or email address below then select the &ldquo;Reset&rdquo; button.', '__x__' ) ?></p>
			</div>

			<p class="bbp-username">
				<label for="user_login"><?php _e( 'Username or Email', 'bbpress' ); ?>: </label>
				<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
			</p>

			<?php do_action( 'login_form', 'resetpass' ); ?>

			<div class="bbp-submit-wrapper">

				<button type="submit" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Reset', '__x__' ); ?></button>

				<?php bbp_user_lost_pass_fields(); ?>

			</div>
		</fieldset>
	</form>
</div>