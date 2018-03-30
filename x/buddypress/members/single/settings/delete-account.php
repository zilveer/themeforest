<?php do_action( 'bp_before_member_settings_template' ); ?>

<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/delete-account'; ?>" name="account-delete-form" id="account-delete-form" class="standard-form cf" method="post">
	<div id="message" class="error">

		<?php if ( bp_is_my_profile() ) : ?>

			<p><?php _e( 'Deleting your account will delete all of the content you have created. It will be completely irrecoverable.', '__x__' ); ?></p>

		<?php else : ?>

			<p><?php _e( 'Deleting this account will delete all of the content it has created. It will be completely irrecoverable.', '__x__' ); ?></p>

		<?php endif; ?>

	</div>

	<?php do_action( 'bp_members_delete_account_before_submit' ); ?>

	<p>
		<label>
			<input type="checkbox" name="delete-account-understand" id="delete-account-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-account-button').disabled = ''; } else { document.getElementById('delete-account-button').disabled = 'disabled'; }" />
			<?php _e( 'I understand the consequences.', '__x__' ); ?>
		</label>
	</p>

	<div class="submit">
		<input type="submit" disabled="disabled" value="<?php esc_attr_e( 'Delete', '__x__' ); ?>" id="delete-account-button" name="delete-account-button" />
	</div>

	<?php do_action( 'bp_members_delete_account_after_submit' ); ?>

	<?php wp_nonce_field( 'delete-account' ); ?>

</form>

<?php do_action( 'bp_after_member_settings_template' ); ?>
