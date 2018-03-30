<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="login-header">
	<?php if (!is_user_logged_in()): ?>
		<div id="loginModal" class="reveal-modal">
			<?php crum_login_form(''); ?>
			<a class="close-reveal-modal">&#215;</a>
		</div>

		<div class="links">
			<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="drop-login" data-reveal-id="loginModal">
				<i class="dfd-icon-lock"></i>
				<span><?php echo esc_html__('Login on site','dfd'); ?></span>
			</a>
		</div>
	<?php else: ?>

		<div class="links">
			<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">
				<i class="dfd-icon-lock_open"></i>
				<span><?php echo esc_html__('Logout','dfd'); ?></span>
			</a>
		</div>

	<?php endif; ?>
</div>