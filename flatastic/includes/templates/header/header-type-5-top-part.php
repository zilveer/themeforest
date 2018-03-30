<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->

<?php if (mad_custom_get_option('header_top_part') == 'show'): ?>

<div class="h_top_part">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-5 t_xs_align_c">

				<?php if (mad_is_shop_installed()): ?>

					<?php $accountPage = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>

					<?php if (is_user_logged_in()): ?>

						<p class="invert_string">
							<?php
							$current_user = wp_get_current_user();
							$user_name = mad_get_user_name($current_user);
							?>

							<span class="welcome_username"><?php echo _e('Welcome visitor', 'flatastic') . ', ' . $user_name ?></span>
							<strong><a href="<?php echo esc_url($accountPage); ?>"><?php _e('My Account', 'flatastic') ?></a></strong>
							<span>|</span>
							<strong><a href="<?php echo wp_logout_url(esc_url(home_url())) ?>"><?php _e('Logout', 'flatastic') ?></a></strong>
						</p>

					<?php else: ?>

						<div class="bar-login">
							<a class="to-login" data-href="<?php echo esc_url($accountPage) ?>" href="<?php echo esc_url($accountPage); ?>"><?php _e('Login', 'flatastic'); ?></a>
							<span> | </span>
							<a href="<?php echo esc_url($accountPage) . '#register'; ?>"><?php _e('Register', 'flatastic'); ?></a>
						</div>

					<?php endif; ?>

				<?php else: ?>

					<?php if (is_user_logged_in()): ?>

						<p class="invert_string">
							<?php
							$current_user = wp_get_current_user();
							$user_name = mad_get_user_name($current_user);
							?>

							<span class="welcome_username"><?php echo _e('Welcome visitor', 'flatastic') . ', ' . $user_name ?></span>
							<a href="<?php echo wp_logout_url( esc_url(home_url()) ); ?>"><?php _e('Logout', 'flatastic') ?></a>
						</p>

					<?php else: ?>

						<p>
							<a href="<?php echo wp_login_url(); ?>"><?php _e('Login', 'flatastic') ?></a>
							<?php echo wp_register('', '', false); ?>
						</p>

					<?php endif; ?>

				<?php endif; ?>

			</div>
			<div class="col-md-8 col-sm-7 t_align_r t_xs_align_c">
				<?php if (mad_custom_get_option('show_call_us')): ?>
					<p><?php echo mad_custom_get_option('call_us', __('Call us toll free: <b>(123) 456-7890</b>', 'flatastic'), true); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div><!--/ .h_top_part-->

<!-- - - - - - - - - - - - Header Bottom Part- - - - - - - - - - - - - - -->

<?php endif; ?>