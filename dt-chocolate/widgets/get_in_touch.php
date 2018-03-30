<?php

function widget_sakura_Feedback($args) {
	extract($args);

	$options = get_option('widget_sakura_Feedback');

	$title = isset($options['title']) ? $options['title'] : '';
	$en_captcha = empty($options['en_captcha']) ? false : true;
	$captcha_id = 'widget_' . dt_generate_contact_id();

	// Output
	echo $before_widget ;

	if ( $title ) {
		echo $before_title . $title . $after_title;
	}
?>

	<form class="uniform get_in_touch ajax ajaxing" method="post"> 

		<?php wp_nonce_field('dt_contact_' . $captcha_id,'dt_contact_form_nonce'); ?>

		<input type="hidden" name="send_message" value="" />
		<input type="hidden" name="send_contacts" value="<?php echo $captcha_id; ?>" />

		<div class="i_h"><div class="l"><input id="your_name" name="f_name" type="text" placeholder="<?php _e('Your name', LANGUAGE_ZONE); ?>" value="" class="validate[required]" /></div></div> 
		<div class="i_h"><div class="r"><input id="email" name="f_email" type="text" placeholder="<?php _e('E-mail', LANGUAGE_ZONE); ?>" value="" class="validate[required,custom[email]" /></div></div> 
		<div class="t_h"><textarea id="message" name="f_comment" placeholder="<?php _e('Message', LANGUAGE_ZONE); ?>" class="validate[required]"></textarea></div> 

		<?php do_action('dt_contact_form_captcha_place', array( 'whoami' => $captcha_id, 'enable' => $en_captcha ) ); ?>

		<a href="#" class="go_submit go_button" title="Submit"><span><i></i><?php _e("Submit", LANGUAGE_ZONE); ?></span></a> 
		<a href="#" class="do_clear"><?php _e('Clear', LANGUAGE_ZONE); ?></a> 

	</form> 

<?php

	echo $after_widget;
}

// Settings form
function widget_sakura_Feedback_control() {

	$default_options = array(
		'title' => '',
		'en_captcha' => true
	);

	// Get options
	$options = get_option('widget_sakura_Feedback');

	$options = wp_parse_args( $options, $default_options );

	// form posted?
	if ( isset($_POST['sakura_Twitter70-submit']) && $_POST['sakura_Twitter70-submit'] ) {

		// Remember to sanitize and format use input appropriately.
		$options['title'] = esc_html($_POST['sakura_Twitter40-title']);
		$options['en_captcha'] = isset($_POST['sakura_Twitter40-en_captcha']);

		update_option('widget_sakura_Feedback', $options);
	}

	// Get options for form fields to show
	$title = $options['title'];
	$en_captcha = $options['en_captcha'];

	// The form fields
?>
<p>
	<label for="Twitter-title">
		<?php _e('Title:', LANGUAGE_ZONE); ?><br />
		<input class="widefat" type="text" name="sakura_Twitter40-title" value="<?php echo esc_attr($title); ?>" />
	</label>
</p>

<p>
	<label><?php _e('Enable captcha: ', LANGUAGE_ZONE); ?><input type="checkbox" name="sakura_Twitter40-en_captcha"<?php checked( $en_captcha ); ?> /></label>
</p>

<input type="hidden" id="sakura_Twitter0-submit" name="sakura_Twitter70-submit" value="1" />
<?php

}

wp_register_sidebar_widget(9003, (THEME_TITLE.' Feedback'), 'widget_sakura_Feedback');
wp_register_widget_control(9003, THEME_TITLE.' Feedback', "widget_sakura_Feedback_control");
