<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
	<div class="lwa lwa-template-modal"><?php //class must be here, and if this is a template, class name should be that of template directory ?>

		<?php 
		//FOOTER - once the page loads, this will be moved automatically to the bottom of the document.
		?>
		<div class="lwa-modal" style="display:none;">
			<form name="lwa-form" class="lwa-form  lwa-login  js-lwa-login  form-visible" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
				<p>
					<label for="username"><?php esc_html_e( 'Username or Email Address','listable' ) ?> *</label>
					<input type="text" name="log" id="lwa_user_login" class="input" />
				</p>
				<p>
					<label for="password"><?php esc_html_e( 'Password','listable' ) ?> *</label>
					<input type="password" name="pwd" id="lwa_user_pass" class="input" value="" />
				</p>
				<?php do_action('login_form'); ?>
				<p class="lwa-meta  grid">
					<span class="grid__item w50  remember-me">
						<input name="rememberme" type="checkbox" id="lwa_rememberme" class="remember-me-checkbox" value="1" /><label for="lwa_rememberme"><?php esc_html_e( 'Remember me','listable' ) ?></label>
					</span>
					<?php if( !empty($lwa_data['remember']) ): ?>
					<span class="grid__item  w50  lost-password">
						<a class="lwa-show-remember-pass  lwa-action-link  js-lwa-open-remember-form" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found','listable') ?>"><?php esc_attr_e('Lost your password?','listable') ?></a>
					</span>
					<?php endif; ?>
				</p>
				<p class="lwa-submit-wrapper">
					<button type="submit" name="wp-submit" class="lwa-wp-submit" tabindex="100"><span class="button-arrow"><?php esc_attr_e('Log In','listable'); ?></span></button>
					<input type="hidden" name="lwa_profile_link" value="<?php echo !empty($lwa_data['profile_link']) ? 1:0 ?>" />
					<input type="hidden" name="login-with-ajax" value="login" />
					<?php if( !empty($lwa_data['redirect']) ): ?>
						<input type="hidden" name="redirect_to" value="<?php echo esc_url($lwa_data['redirect']); ?>" />
					<?php endif; ?>
				</p>
				<?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>
				<p class="lwa-bottom-text">
					<?php echo __('Don\'t have an account?', 'listable'); ?> <a href="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" class="lwa-action-link  js-lwa-open-register-form"><?php esc_html_e('Sign up','listable'); ?></a>
				</p>
				<?php endif; ?>
			</form>

        	<?php if( !empty($lwa_data['remember']) ): ?>
	        <form name="lwa-remember" class="lwa-remember  lwa-form  js-lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" method="post" style="display:none;">
				<p>
					<label><?php esc_html_e("Forgotten Password", 'listable'); ?></label>
				    <input type="text" name="user_login" id="lwa_user_remember" />
					<?php do_action('lostpassword_form'); ?>
				</p>
				<p class="lwa-submit-wrapper">
	                <button type="submit"><span class="button-arrow"><?php esc_attr_e("Get New Password", 'listable'); ?></span></button>
	                <input type="hidden" name="login-with-ajax" value="remember" />
				</p>
		        <p class="cancel-button-wrapper">
			        <a href="#" class="lwa-action-link  js-lwa-close-remember-form"><?php esc_html_e("Cancel",'listable'); ?></a>
		        </p>

	        </form>
	        <?php endif; ?>
		    <?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : //Taken from wp-login.php ?>
			<form name="lwa-register" class="lwa-register  lwa-form  js-lwa-register" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
				<p>
					<label for="username"><?php esc_html_e( 'Username','listable' ) ?></label>
					<input type="text" name="user_login" id="user_login" />
				</p>

				<p>
					<label for="user_email"><?php esc_html_e( 'Email address','listable' ) ?></label>
					<input type="text" name="user_email" id="user_email" />
				</p>
				<?php
				//If you want other plugins to play nice, you need this:
				do_action('register_form');
				?>

				<p class="lwa-meta">
					<?php esc_html_e('A password will be e-mailed to you.','listable') ?><br />
				</p>

				<p class="lwa-submit-wrapper">
					<button type="submit" tabindex="100"><span class="button-arrow"><?php esc_attr_e('Register','listable'); ?></span></button>
					<input type="hidden" name="login-with-ajax" value="register" />
				</p>

				<p class="lwa-bottom-text">
					<?php echo __('Already have an account?', 'listable'); ?> <a href="#" class="lwa-action-link  js-lwa-close-register-form"><?php esc_html_e('Log in', 'listable'); ?></a>
				</p>
			</form>
			<?php endif; ?>
		</div>
	</div>