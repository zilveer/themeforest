<div id="popup_login" class="popup_wrap popup_login bg_tint_light">
	<a href="#" class="popup_close"></a>
	<div class="form_wrap">
		<div class="form_left">
			<form action="<?php echo wp_login_url(); ?>" method="post" name="login_form" class="popup_form login_form">
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr(home_url()); ?>">
				<div class="popup_form_field login_field iconed_field icon-user-2"><input type="text" id="log" name="log" value="" placeholder="<?php _e('Login or Email', 'ancora'); ?>"></div>
				<div class="popup_form_field password_field iconed_field icon-lock-1"><input type="password" id="password" name="pwd" value="" placeholder="<?php _e('Password', 'ancora'); ?>"></div>
				<div class="popup_form_field remember_field">
					<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" class="forgot_password"><?php _e('Forgot password?', 'ancora'); ?></a>
					<input type="checkbox" value="forever" id="rememberme" name="rememberme">
					<label for="rememberme"><?php _e('Remember me', 'ancora'); ?></label>
				</div>
				<div class="popup_form_field submit_field"><input type="submit" class="submit_button" value="<?php _e('Login', 'ancora'); ?>"></div>
			</form>
		</div>
		<div class="form_right">
			<div class="login_socials_title"><?php _e('You can login using your social profile', 'ancora'); ?></div>
			<div class="login_socials_list sc_socials sc_socials_size_tiny">
				<?php
				$list = array(
					array('icon' => ancora_get_socials_url('facebook'), 'url'	=> '#'),
					array('icon' => ancora_get_socials_url('twitter'), 'url'	=> '#'),
					array('icon' => ancora_get_socials_url('gplus'), 'url'	=> '#')
				);
				echo trim(ancora_prepare_socials($list));
				?>
			</div>
			<div class="login_socials_problem"><a href="#"><?php _e('Problem with login?', 'ancora'); ?></a></div>
			<div class="result message_block"></div>
		</div>
	</div>	<!-- /.login_wrap -->
</div>		<!-- /.popup_login -->
