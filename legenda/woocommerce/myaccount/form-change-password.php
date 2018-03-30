<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
extract(etheme_account_sidebar());
?>

<div class="row-fluid">
	<?php if ($sidebar): ?>
		<div class="span3">
			<?php 

				do_action('etheme_before_account_sidebar');

				if ( has_nav_menu( 'account-menu' ) ) : ?>
					<?php wp_nav_menu(array(
						'theme_location' => 'account-menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'container_class' => 'widget_nav_menu',
						'link_after' => '',
						'depth' => 4,
						'fallback_cb' => false
					)); ?>
				<?php else: ?>
					<br>
                    <h4 class="a-center install-menu-info">Set your account menu in <em>Apperance &gt; Menus</em></h4>
				<?php endif;

			?>
		</div>
	<?php endif ?>
	<div class="span<?php echo $span; ?>">
		<?php wc_print_notices(); ?>

		<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" method="post">

			<p class="form-row form-row-first">
				<label for="password_1"><?php _e( 'New password', ETHEME_DOMAIN ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</p>
			<p class="form-row form-row-last">
				<label for="password_2"><?php _e( 'Re-enter new password', ETHEME_DOMAIN ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</p>
			<div class="clear"></div>

			<p><input type="submit" class="button" name="change_password" value="<?php _e( 'Save', ETHEME_DOMAIN ); ?>" /></p>

			<?php $woocommerce->nonce_field('change_password')?>
			<input type="hidden" name="action" value="change_password" />

		</form>
	</div>
</div>