<script type="text/javascript" src="<?php echo THB_FRONTEND_JS_URL; ?>/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo THB_FRONTEND_JS_URL; ?>/jquery.form.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.thb-contact-form').thb_validate();
	});
</script>

<form class="thb-contact-form" method="post" action="<?php echo get_permalink( thb_get_page_ID() ); ?>">
	<?php wp_nonce_field( 'thb_system_send_mail', 'thb_system_send_mail_nonce' ); ?>

	<span id="thb-contact-form-name">
		<label for="contact_name"><?php _e('Your name', 'thb_text_domain'); ?></label>
		<?php
			$pl_a = '';
			if( $placeholder ) {
				$pl_a = 'placeholder="' . __('Your name', 'thb_text_domain') . '"';
			}
		?>
		<input <?php echo $pl_a; ?> type="text" name="contact_name" id="contact_name" value="" />
	</span>

	<span id="thb-contact-form-email">
		<label for="contact_email"><?php _e('Your email', 'thb_text_domain'); ?></label>
		<?php
			$pl_a = '';
			if( $placeholder ) {
				$pl_a = 'placeholder="' . __('Your email', 'thb_text_domain') . '"';
			}
		?>
		<input <?php echo $pl_a; ?> type="text" id="contact_email" name="contact_email" value="" />
	</span>

	<span id="thb-contact-form-message">
	<label for="contact_message"><?php _e('Message', 'thb_text_domain'); ?></label>
		<?php
			$pl_a = '';
			if( $placeholder ) {
				$pl_a = 'placeholder="' . __('Message', 'thb_text_domain') . '"';
			}
		?>
		<textarea <?php echo $pl_a; ?> name="contact_message" id="contact_message" rows="7" cols=""></textarea>
	</span>

	<input type="submit" value="<?php _e('Send', 'thb_text_domain'); ?>" id="submit">

</form>

<div id="thb-contact-form-result"></div>