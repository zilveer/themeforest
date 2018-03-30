<?php
/**
 * Login Form
 */

global $woocommerce;

if (is_user_logged_in()) return;
?>
<form method="post" class="login">
	<?php if ($message) echo wpautop(wptexturize($message)); ?>
	
	<div class="field-row">
		<label for="username"><?php _e('Username or email','qns' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" />
	</div>
	
	<div class="field-row">
		<label for="password"><?php _e('Password','qns' ); ?> <span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</div>

	<div class="form-row">
		<?php $woocommerce->nonce_field('login', 'login') ?>
		<input type="submit" class="button2" name="login" value="<?php _e('Login','qns' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo $redirect ?>" />
		<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password?','qns' ); ?></a>
	</div>

</form>