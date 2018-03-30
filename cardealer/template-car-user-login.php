<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/*
  Template Name: Login Page
 */

$mycars_page_link = get_permalink(TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX));
$redirect_url = !empty($mycars_page_link) ? $mycars_page_link : home_url();
if (is_user_logged_in()) {
	wp_redirect($redirect_url, 302);
	return;
}

get_header();
global $post;
global $wp;
$lost_pass = false;

if ( isset($wp->query_vars['lost-password']) ) {
	$lost_pass = 'lost_password';
}

?>

<section class="viewport-50 padding-top-40 padding-bottom-80 clearfix">

<?php
if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if (!is_front_page() && !TMM_Helper::is_front_lang_page()): ?>

			<?php if (!($hide_single_page_title = get_post_meta($post->ID, 'hide_single_page_title', true))): ?>
				<h2 class="section-title"><?php $lost_pass ? _e('Lost Password', 'cardealer') : the_title() ?></h2>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		the_content();
		tmm_link_pages();
		tmm_layout_content(get_the_ID());
	endwhile;
endif;

if ($lost_pass) {
	$key = '';
	$login = '';
	$login_page_id = TMM::get_option('user_login_page', TMM_APP_CARDEALER_PREFIX);

	if ( !empty($_GET['key']) && !empty($_GET['login']) ) {

		$user = TMM_Ext_Authentication::check_password_reset_key( $_GET['key'], $_GET['login'] );
		$lost_pass = 'reset_password';

		if( is_object( $user ) ) {
			$key = esc_attr($_GET['key']);
			$login = esc_attr($_GET['login']);
		}

	} elseif ( isset( $_GET['reset'] ) ) {
		?>

		<div class="info"><?php echo __( 'Your password has been reset.', 'cardealer' ) . ' <a href="' . TMM_Helper::get_permalink_by_lang( $login_page_id, array(), true ) . '">' . __( 'Log in', 'cardealer' ) . '</a>'; ?></div>

		<?php
	}
	?>

<!-- Lost Password Form -->
<div class="row">

	<div class="col-md-6<?php if ($lost_pass === 'lost_password'): ?> col-md-push-3<?php endif; ?>">

		<div class="form-account">

			<form method="post" name="lostpasswordform" id="lostpasswordform">

			<?php if ($lost_pass === 'lost_password') { ?>

				<div class="form-heading">
					<h3><?php _e('Restore Password', 'cardealer'); ?></h3>
				</div><!--/ .form-heading-->

				<div class="form-entry clearfix">

					<p><?php _e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'cardealer' ); ?></p>

					<p>
						<label for="user_login"><?php _e( 'Username or email', 'cardealer' ); ?></label>
						<input class="input" type="text" size="20" value="" name="user_login" id="user_login" />
					</p>

					<p>
						<input type="submit" class="button orange" value="<?php _e( 'Reset Password', 'cardealer' ); ?>" />
					</p>

					<?php wp_nonce_field( $lost_pass ); ?>

				</div><!--/ .form-entry-->

			<?php } else if ($lost_pass === 'reset_password') { ?>

				<div class="form-entry clearfix">

				<?php if( is_object( $user ) ) { ?>

					<p><?php _e( 'Enter a new password below.', 'cardealer'); ?></p>

					<p>
						<label for="password_1"><?php _e( 'New password', 'cardealer' ); ?> <span class="required">*</span></label>
						<input type="password" size="20" value="" name="password_1" id="password_1" />
					</p>
					<p>
						<label for="password_2"><?php _e( 'Re-enter new password', 'cardealer' ); ?> <span class="required">*</span></label>
						<input type="password" size="20" value="" name="password_2" id="password_2" />
					</p>

					<input type="hidden" name="reset_key" value="<?php echo $key; ?>" />
					<input type="hidden" name="reset_login" value="<?php echo $login; ?>" />

					<p>
						<input type="submit" class="button orange" value="<?php _e( 'Save', 'cardealer' ); ?>" />
					</p>

					<?php wp_nonce_field( $lost_pass ); ?>

					<?php do_action('tmm_notice'); ?>

				<?php } else { ?>

					<div class="error"><?php echo (string) $user; ?></div>

				<?php } ?>

				</div><!--/ .form-entry-->

			<?php } ?>

		</form>

		</div>

	</div>

</div><!--/ .row-->

	<?php
} else {

$users_can_register = get_option('users_can_register');

if (isset($_GET['redirect']) AND ! empty($_GET['redirect'])) {
	$redirect_to = $_GET['redirect'];
} else {
	$redirect_to = $redirect_url;
}
?>

<!-- User Registration Form -->
<div class="row">

	<?php if ($users_can_register): ?>

		<div class="col-md-6">

	        <div class="form-account">

	            <div class="form-heading">
	                <h3><?php _e('Register now for', 'cardealer'); ?> <?php echo bloginfo() ?></h3>
	            </div><!--/ .form-heading-->

	            <div class="form-entry clearfix">

	                <p>
	                    <label><?php _e('Username', 'cardealer'); ?>:</label>
	                    <input type="text" size="20" value="" class="input" id="user_name2" name="user_login">
	                </p>
	                <p>
	                    <label><?php _e('Your Email', 'cardealer'); ?>:</label>
	                    <input type="text" size="25" value="" class="input" id="user_email2" name="user_email">
	                </p>

	                <p class="line_height_plus">
		                <?php _e('A password will be e-mailed you.', 'cardealer'); ?>
	                </p>

	                <input id="user_register_button2" type="submit" class="button dark enter-btn" value="<?php _e('Register', 'cardealer'); ?>"/>

	                <div id="register-info2" class="info"></div>

	            </div><!--/ .form-entry-->

	        </div><!--/ .form-account-->

	    </div>

	<?php endif; ?>

	<div class="col-md-6<?php if (!$users_can_register): ?> col-md-push-3<?php endif; ?>">

		<div class="form-account">

			<form method="post" action="<?php echo wp_login_url($redirect_to); ?>" id="loginform" name="loginform">

				<div class="form-heading">
					<h3><?php _e('Log In', 'cardealer'); ?></h3>
				</div><!--/ .form-heading-->

				<div class="form-entry clearfix">

					<p>
						<label for="user_login"><?php _e('Username', 'cardealer'); ?>:</label>
						<input type="text" size="20" value="" class="input" id="user_login" name="log">
					</p>
					<p>
						<label for="user_pass"><?php _e('Password', 'cardealer'); ?>:</label>
						<input type="password" size="20" value="" class="input" id="user_pass" name="pwd">
					</p>
					<p class="line_height_plus">
						<input type="checkbox" value="forever" id="rememberme" name="rememberme">
						<label for="rememberme"><?php _e('Remember Me', 'cardealer'); ?></label>
					</p>
					<input type="submit" class="button orange" value="<?php _e('Login', 'cardealer'); ?>" id="wp-submit" name="wp-submit">

					<a class="reset-pass" href="<?php echo wp_lostpassword_url(); ?>"><?php _e("Forgot your password?", 'cardealer') ?></a>

					<input type="hidden" value="<?php echo $redirect_to ?>" name="redirect_to">

				</div><!--/ .form-entry-->

			</form>
			
		</div><!--/ .form-account-->

	</div>
	
</div><!--/ .row-->

<?php
} ?>

</section>

<?php get_footer(); ?>