<div class="dd-bp-wrapper-primary dd-bp-wrapper-equal-padding">

	<?php do_action( 'bp_before_group_request_membership_content' ); ?>

	<?php if ( !bp_group_has_requested_membership() ) : ?>
	
		<p><?php printf( __( "You are requesting to become a member of the group '%s'.", "buddypress" ), bp_get_group_name( false ) ); ?></p>

		<form action="<?php bp_group_form_action('request-membership'); ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">

			<p><textarea name="group-request-membership-comments" id="group-request-membership-comments" placeholder="<?php _e( 'Comments (optional)', 'buddypress' ); ?>"></textarea></p>

			<?php do_action( 'bp_group_request_membership_content' ); ?>

			<p><input type="submit" name="group-request-send" id="group-request-send" value="<?php _e( 'Send Request', 'buddypress' ); ?>" />

			<?php wp_nonce_field( 'groups_request_membership' ); ?>

		</form><!-- #request-membership-form -->

	<?php endif; ?>

	<?php do_action( 'bp_after_group_request_membership_content' ); ?>

</div>
