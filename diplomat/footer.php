<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$page_id = 0;
if (is_single() OR is_page() OR is_front_page()) {
	global $post;
	if($post) {
		$page_id = $post->ID;
	}
}

if (is_home()) {
	$page_id = get_option('page_for_posts');
}
?>

	</section>

	<?php
	if ($_REQUEST['sidebar_position'] != 'no_sidebar'){
		get_sidebar();
	}

	if (is_single($page_id) || is_page() || is_page_template()) {
		tmm_layout_content($page_id, 'full_width');
	}
	?>

	<?php if (TMM::get_option('show_login_buttons') !== '0') { ?>

	<div id="accountDialog" class="dialog">
		<div class="dialog-overlay"></div>
		<div class="dialog-content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 560 280" preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="556" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<form action="/">
					<fieldset class="login">
						<p><input type="text" name="user_name" id="user_name" placeholder="<?php esc_attr_e('Username', 'diplomat'); ?>*" required="" autocomplete="off" /></p>
						<p><input type="email" name="user_email" id="user_email" placeholder="<?php esc_attr_e('E-mail', 'diplomat'); ?>*" required="" autocomplete="off" /></p>
						<p>
							<button class="button middle" type="submit"><?php esc_html_e('Register', 'diplomat'); ?></button> &nbsp;
							<a href="#" class="button middle dialog-login-button"><?php esc_html_e('Log In', 'diplomat'); ?></a>
						</p>
					</fieldset>
				</form>
				<i class="action-close" data-dialog-close><?php esc_html_e('Close', 'diplomat'); ?></i>
			</div>
			<div class="dialog-error" style="display: none;"></div>
		</div>
	</div>

	<div id="loginDialog" class="dialog">
		<div class="dialog-overlay"></div>
		<div class="dialog-content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 560 280" preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="556" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<form action="/" method="post" class="account">
					<fieldset>
						<p><input type="text" name="log" id="user_login" placeholder="<?php esc_attr_e('Username', 'diplomat'); ?>*" required="" autocomplete="off" /></p>
						<p><input type="password" name="pwd" id="user_pass" placeholder="<?php esc_attr_e('Password', 'diplomat'); ?>*" required="" autocomplete="off" /></p>
						<p>
							<input type="checkbox" id="rememberme" class="tmm-checkbox" name="rememberme" value="forever">
							<label for="rememberme"><?php esc_html_e('Remember Me', 'diplomat'); ?></label>

							<button class="button middle right" type="submit"><?php esc_html_e('Log In', 'diplomat'); ?></button>

							<a href="#" class="reset-pass"><?php esc_html_e('Reset password', 'diplomat'); ?></a>
						</p>
					</fieldset>
				</form>

				<i class="action-close" data-dialog-close><?php esc_html_e('Close', 'diplomat'); ?></i>
			</div>
			<div class="dialog-error" style="display: none;"></div>
		</div>
	</div>

	<div id="resetDialog" class="dialog">
		<div class="dialog-overlay"></div>
		<div class="dialog-content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 560 280" preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="556" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<p class="message">
					<?php esc_html_e('Please enter your username or email address. You will receive a link to create a new password via email.', 'diplomat'); ?>
				</p>
				<form action="/" method="post" class="resetPass">
					<fieldset>
						<p><label for="user_mail"><?php esc_html_e('Username or E-mail:', 'diplomat'); ?></label></p>
						<p>
							<input type="text" name="log" id="user_mail" required="" autocomplete="off" />
						</p>
						<p>
							<button type="submit" name="submit" class="button middle right"><?php esc_html_e('Reset Password', 'diplomat'); ?></button>
							<a href="#" class="button middle dialog-login-button"><?php esc_html_e('Log In', 'diplomat'); ?></a>
						</p>
					</fieldset>
				</form>

				<i class="action-close" data-dialog-close><?php esc_html_e('Close', 'diplomat'); ?></i>
			</div>
			<div class="dialog-error" style="display: none;"></div>
		</div>
	</div>

	<?php } ?>

	<div id="subscribeDialog" class="dialog">
		<div class="dialog-overlay"></div>
		<div class="dialog-content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 560 280" preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="556" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<p class="message"></p>
				<i class="action-close" data-dialog-close><?php esc_html_e('Close', 'diplomat'); ?></i>
			</div>
			<div class="dialog-error" style="display: none;"></div>
		</div>
	</div>

</main><!--/ #content -->

<!-- - - - - - - - - - - - - end Main - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<footer id="footer">

	<?php
	if (!$page_id) {
		$footer_page_sidebar = 1;
	} else {
		$footer_page_sidebar = get_post_meta($page_id, 'footer_sidebar', true);

		if ($footer_page_sidebar === '') {
			$footer_page_sidebar = 1;
		}
	}

	if (!TMM::get_option("hide_footer") && $footer_page_sidebar) { ?>

	<div class="footer-top">

		<div class="row">

			<div class="large-4 columns">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('footer_sidebar_1'))  ?>

			</div>

			<div class="large-4 columns">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('footer_sidebar_2'))  ?>

			</div>

			<div class="large-4 columns">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('footer_sidebar_3'))  ?>

			</div>

		</div><!--/ .row-->

	</div><!--/ .footer-top-->

	<?php } ?>

	<div class="footer-bottom">

		<div class="row">

			<div class="large-6 columns">
				<div class="copyright">
					<?php echo wp_kses( TMM::get_option("copyright_text"), 'default'); ?>
				</div><!--/ .copyright-->
			</div>

			<div class="large-3 large-offset-3 columns">
				<div class="developed">
					<?php esc_html_e('Developed by', 'diplomat'); ?> <a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a>
				</div><!--/ .developed-->
			</div>

		</div><!--/ .row-->

	</div><!--/ .footer-bottom-->

</footer><!--/ #footer-->

<!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - -->

</div><!--/ #wrapper-->

<!-- - - - - - - - - - - - end Wrapper - - - - - - - - - - - - - - -->

<?php wp_footer(); ?>

</body>
</html>
