<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://thecodemafia.org
 * @since      1.0.0
 *
 * @package    Tcm_Theme_Lock
 * @subpackage Tcm_Theme_Lock/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	<form action="<?php echo admin_url( '/admin.php?page=register_theme', 'http' ); ?>" method="post">

		<input type="hidden" id="tcm_verify_submit" name="tcm_verify_submit" value="true" />

		<h2><?php _e('Theme Registration', LANGUAGE_ZONE); ?></h2>
		<p>
			Before you can use this theme, you need to provide your <strong>Purchase Code</strong> & <strong>Email Address</strong>.
			If you don't have it, go to <a href="<?php echo admin_url( '/themes.php', 'http' ); ?>">Themes</a> and activate another theme.

		</p>

		<?php
			global $registration_error;
			if($registration_error) {
				?>
				<div class="error">
					<p><?php _e( 'Oups! It seems like the details you entered are not correct. :(', LANGUAGE_ZONE ); ?></p>
				</div>
				<?php
			}
		?>

		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="tcm_purchase_code"><?php _e('Purchase Code', LANGUAGE_ZONE); ?></label>
					</th>
					<td>
						<input class="regular-text ltr" type="text" name="tcm_purchase_code" id="tcm_purchase_code" value="<?php echo (isset($_POST['tcm_purchase_code']) ? esc_attr($_POST['tcm_purchase_code']) : ''); ?>" />
						<br/>
						<span class="description"><?php _e('You can get it from your ThemeForest account on Downloads section. Don\'t know how? Check this <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-can-I-find-my-Purchase-Code-" target="_blank">article</a>.', LANGUAGE_ZONE); ?></span>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="tcm_email_address"><?php _e('Email Address', LANGUAGE_ZONE); ?></label>
					</th>
					<td>
						<input class="regular-text ltr" type="email" name="tcm_email_address" id="tcm_email_address" value="<?php echo (isset($_POST['tcm_email_address']) ? esc_attr($_POST['tcm_email_address']) : ''); ?>" />
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit"><input type="submit" value="<?php _e('Register Theme', LANGUAGE_ZONE) ?>" class="button-primary" name="tcm_submit"></p>

	</form>
</div>