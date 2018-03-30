<?php         
global $post;
$defaults = array(
  'en_captcha' => false
);
$opts = get_post_meta( $post->ID, '_dt_contact_layout_options', true );
$opts = wp_parse_args( $opts, $defaults );

$en_captcha = $opts['en_captcha'];
$captcha_id = 'widget_' . dt_generate_contact_id();

$name_title = esc_attr_x('Your name', 'contact form', LANGUAGE_ZONE);
$email_title = esc_attr_x('E-mail', 'contact form', LANGUAGE_ZONE);
$message_title = esc_attr_x('Message', 'contact form', LANGUAGE_ZONE);
?>
<div class="share_com">
	<div class="article_footer_t"></div>
	<div class="article_footer">
		<div id="form_prev_holder">
			<div id="form_holder">
				<div class="header"><?php _ex('Feedback', 'contact form', LANGUAGE_ZONE); ?></div>

				<form method="post" action="" name="order_form" id="order_form" class="uniform ajax ajaxing">

					<?php wp_nonce_field('dt_contact_' . $captcha_id,'dt_contact_form_nonce'); ?>

					<input type="hidden" name="send_message" value="" />
					<input type="hidden" name="send_contacts" value="<?php echo $captcha_id; ?>" />

					<div class="i_h">
						<div class="l">
							<input type="text" name="f_name" placeholder="<?php echo $name_title; ?>" id="name" class="validate[required]" title="<?php echo $name_title; ?>">
						</div>
					</div>

					<div class="i_h">
						<div class="r">
							<input type="text" name="f_email" placeholder="<?php echo $email_title; ?>" id="f_email2" class="validate[required,custom[email]]" title="<?php echo $email_title; ?>">
						</div>
					</div>

					<div class="t_h">
						<textarea placeholder="<?php echo $message_title; ?>" cols="40" rows="8" name="f_comment" id="comment" class="validate[required]"></textarea>
					</div>

					<?php do_action('dt_contact_form_captcha_place', array( 'whoami' => $captcha_id, 'enable' => $en_captcha ) ); ?>

					<a href="#" class="cont_butt go_submit go_button"><span><i></i><?php _ex('Submit', 'contact form', LANGUAGE_ZONE); ?></span></a>
					<a href="#" class="do_clear"><?php _ex('Clear', 'contact  form', LANGUAGE_ZONE); ?></a>
				</form>
		
			</div>
		</div>
	</div>
	<div class="article_footer_b"></div>
</div>
