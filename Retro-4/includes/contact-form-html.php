<?php
/* the form */
function retro_mail_form_html() {
	wp_localize_script( 'retro-mail', 'retro_mail', array( 'url' => admin_url( 'admin-ajax.php' ), 'ref' => wp_create_nonce( 'retro-mail-send' ) ) );		
	wp_enqueue_script( 'retro-mail' );
?>

	<form action="#" id="retro-mail-form">
		<fieldset>
			<input type="text" name="name" id="name" placeholder="<?php _e( 'Name', 'openframe' ); ?>">
			<input type="email" name="email" id="email" placeholder="<?php _e( 'Email address', 'openframe' ); ?>">
			<input type="text" name="subject" id="subject" placeholder="<?php _e( 'Subject', 'openframe' ); ?>">
			<textarea name="message" id="message" cols="60" rows="7" placeholder="<?php _e( 'Your message', 'openframe' ); ?>"></textarea>
			<?php if ( ! op_theme_opt( 'human-off' ) ) : ?>
				<div class="human-math right">2 + 3 = <input type="text" name="human" id="human" class="<?php if ( op_theme_opt( 'human-off' ) ) { echo 'human-off'; } ?>"></div>
			<?php endif; ?>
			<input id="send" type="submit" value="<?php _e( 'Send Message', 'openframe' ); ?>" class="button">
		</fieldset>

		<span id="contact-form-name-error"><?php _e( 'Please, write your name.', 'openframe' ); ?></span>
		<span id="contact-form-email-error"><?php _e( 'Please, insert your email address.', 'openframe' ); ?></span>
		<span id="contact-form-message-error"><?php _e( 'Please, leave a message.', 'openframe' ); ?></span>
		<span id="contact-form-human-error"><?php _e( 'Umh, are you good with math?', 'openframe' ); ?></span>
		<div id="contact-form-success" style="display: none;">
			<?php _e( 'Message received! Thanks.', 'openframe' ); ?>
		</div>

	</form>

<?php
}
?>
