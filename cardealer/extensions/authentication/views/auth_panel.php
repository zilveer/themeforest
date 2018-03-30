<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php $users_can_register = get_option('users_can_register'); ?>

<div class="account-wrapper">
	
	<?php if (!is_user_logged_in()): ?>
		<span class="log"><?php _e("Login", 'cardealer') ?> <i class="icon-login"></i></span>
	<?php else : ?>
		<span class="log"><?php _e("Profile", 'cardealer') ?> <i class="icon-logout"></i></span>
	<?php endif; ?>

    <form class="form-reg" method="post" action="/" onsubmit="return thememakers_app_authentication.login()">
		
		<div class="form-reg-hidden">
			
			<?php if (!is_user_logged_in()): ?>

				<div id="login_user_panel">

					<p>
						<label><?php _e("Username", 'cardealer') ?>*</label>
						<input class="input-medium" type="text" id="tmm_user_login" autocomplete="off" />
					</p>

					<p>
						<label><?php _e("Password", 'cardealer') ?>*</label>
						<input class="input-medium" type="password" id="tmm_user_pass" autocomplete="off" />
					</p>

					<p class="forgot-pass">
						<a href="<?php echo wp_lostpassword_url(get_permalink()); ?>"><?php _e("Forgot your password?", 'cardealer') ?></a>
					</p>

					<div class="error-login"><?php _e("Wrong Login / Password", 'cardealer') ?></div>
					<input type="submit" style="display: none;" />
					<p>
						<a href="#" class="button dark enter-btn" id="user_login_button"><?php _e("Login", 'cardealer') ?></a>
						<?php if ($users_can_register): ?>
							<a href="#" class="button dark enter-btn" id="show_register_user_panel"><?php _e("Create an account", 'cardealer') ?></a>
						<?php endif; ?>
					</p>

				</div>

				<?php if ($users_can_register): ?>

					<div id="register_user_panel">

						<div class="register-user-entry">

							<div class="register-hidden-panel">
								<p>
									<label><?php _e("Email", 'cardealer') ?>*</label>
									<input class="input-medium" type="text" id="user_email" />
								</p>

								<p>
									<label><?php _e("Name", 'cardealer') ?>*</label>
									<input class="input-medium" type="text" id="user_name" />
								</p>						
							</div>

							<div id="register-info"></div>

						</div><!--/ .register-user-entry-->

						<p>
							<a href="#" class="button dark enter-btn" id="user_register_button"><?php _e("Register", 'cardealer') ?></a>
							<a href="#" class="button dark enter-btn" id="show_login_user_panel"><?php _e("Login", 'cardealer') ?></a>
						</p>

					</div>

				<?php endif; ?>

			<?php else: ?>

				<h3><?php _e("Drive Your Cars", 'cardealer') ?></h3>

				<?php
				$user_profile_page = TMM::get_option('user_profile_page', TMM_APP_CARDEALER_PREFIX) ? TMM_Helper::get_permalink_by_lang( TMM::get_option('user_profile_page', TMM_APP_CARDEALER_PREFIX) ) : '';
				$user_cars_page = TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX) ? TMM_Helper::get_permalink_by_lang( TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX) ) : '';
				$user_add_new_car = TMM::get_option('user_add_new_car', TMM_APP_CARDEALER_PREFIX) ? TMM_Helper::get_permalink_by_lang( TMM::get_option('user_add_new_car', TMM_APP_CARDEALER_PREFIX) ) : '';
				?>

				<ul id="users_links">

					<?php if (!empty($user_profile_page)): ?>
						<li><a href="<?php echo $user_profile_page ?>"><?php _e("My profile", 'cardealer') ?></a></li>
					<?php endif; ?>

					<?php if (!empty($user_cars_page)): ?>
						<li><a href="<?php echo $user_cars_page ?>"><?php _e("My Cars", 'cardealer') ?></a></li>
					<?php endif; ?>

					<?php if (!empty($user_add_new_car)): ?>
						<?php
						$options = TMM_Cardealer_User::get_default_user_role_options(get_current_user_id());
						$user_post_count = TMM_Cardealer_User::count_users_cars(get_current_user_id());
						
						if(!isset($options['max_cars'])){
							$options['max_cars'] = 0;
						}

						if ($user_post_count < $options['max_cars'] || user_can(get_current_user_id(), 'manage_options')):
							?>
							<li><a href="<?php echo $user_add_new_car ?>"><?php _e("Add new car", 'cardealer') ?></a></li>
						<?php endif; ?>
					<?php endif; ?>

				</ul>

				<br />

				<a class="button dark enter-btn" href="#" id="user_logout_button"><?php _e("Logout", 'cardealer') ?></a>

			<?php endif; ?>			
			
		</div>

    </form><!--/ .form-reg-->

</div><!--/ .account-wrapper-->

