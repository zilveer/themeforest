<?php

global $woocommerce;

if (is_user_logged_in()) return;
?>
<form method="post" class="row">
	<div class="small-12 columns"><?php if ($message) echo wpautop(wptexturize($message)); ?></div>

	<div class="small-12 columns">
		<label for="username"><?php _e('Username or email', 'north'); ?></label>
		<input type="text" class="input-text full" name="username" id="username" />
	</div>
	
  <div class="small-12 columns">
    <label for="password"><?php _e('Password', 'north'); ?></label>
		<input class="input-text full" type="password" name="password" id="password" />
	</div>
	<div class="small-12 medium-6 columns">
		<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check" /> 
		<label for="rememberme" class="custom_label">
			<?php _e( 'Remember me', 'north' ); ?>
		</label>
	</div>
	<div class="small-12 medium-6 columns">
		<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e('Lost Password?', 'north'); ?></a>
	</div>
	<div class="small-12 columns">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		
		<input type="submit" class="button_checkout_login button small" name="login" value="<?php _e('Login', 'north'); ?>" />
		
    <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
	</div>
</form>