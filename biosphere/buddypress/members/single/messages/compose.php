<form action="<?php bp_messages_form_action('compose'); ?>" method="post" id="send_message_form" class="standard-form dd-bp-wrapper-primary dd-bp-wrapper-equal-padding" role="main" enctype="multipart/form-data">

	<?php do_action( 'bp_before_messages_compose_content' ); ?>

	<ul class="first acfb-holder">
		<li>
			<?php bp_message_get_recipient_tabs(); ?>
			<input type="text" name="send-to-input" class="send-to-input" id="send-to-input" placeholder="<?php _e("Send To (Username or Friend's Name)", 'buddypress'); ?>" />
		</li>
	</ul>

	<br>

	<?php if ( bp_current_user_can( 'bp_moderate' ) ) : ?>
		<p><input type="checkbox" id="send-notice" name="send-notice" value="1" /> <?php _e( "This is a notice to all users.", "buddypress" ); ?></p>
	<?php endif; ?>

	<p><input type="text" name="subject" id="subject" value="<?php bp_messages_subject_value(); ?>" placeholder="<?php _e( 'Subject', 'buddypress'); ?>" /></p>

	<textarea name="content" id="message_content" rows="15" cols="40" placeholder="<?php _e( 'Message', 'buddypress'); ?>"><?php bp_messages_content_value(); ?></textarea>

	<input type="hidden" name="send_to_usernames" id="send-to-usernames" value="<?php bp_message_get_recipient_usernames(); ?>" class="<?php bp_message_get_recipient_usernames(); ?>" />

	<?php do_action( 'bp_after_messages_compose_content' ); ?>

	<div class="submit">
		<input type="submit" value="<?php _e( "Send Message", 'buddypress' ); ?>" name="send" id="send" />
	</div>

	<?php wp_nonce_field( 'messages_send_message' ); ?>

</form>

<script type="text/javascript">
	document.getElementById("send-to-input").focus();
</script>

