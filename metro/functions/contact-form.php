<?php

add_action('wp_ajax_om_ajax_contact_form', 'om_ajax_contact_form');
add_action('wp_ajax_nopriv_om_ajax_contact_form', 'om_ajax_contact_form');

function om_ajax_contact_form() {

	if ( get_magic_quotes_gpc() ) {
		$_POST = stripslashes_deep( $_POST );
	}
	
	if(@$_POST['site'] != '1') //simple antispam
		die();

	$email = get_option(OM_THEME_PREFIX.'form_email');
	if(!$email)
	{
		echo '1';
		die();
	}
	
	if(get_option(OM_THEME_PREFIX."form_captcha") == 'true') {
	  require_once(TEMPLATEPATH.'/libraries/recaptchalib.php');
	  $resp = recaptcha_check_answer ("6LeEs9sSAAAAALbzfjbcCFPQL_jHhAeOAGgHb4Zz",
	                                $_SERVER["REMOTE_ADDR"],
	                                $_POST["recaptcha_challenge_field"],
	                                $_POST["recaptcha_response_field"]);
	
	  if (!$resp->is_valid) {
	    echo '2';
	    die();
	  }
	}
			
	$html='<h3>'.__('Contact Form', 'om_theme').'</h3>';
	$html.='<table border="1" cellpadding="5"><tr><td>'.__('Date', 'om_theme').'</td><td>'.date('F j, Y H:i').'</td></tr>';

	if(is_array(@$_POST['fields'])) {
		foreach($_POST['fields'] as $k=>$v) {
			$html.='<tr><td>'.base64_decode($k).'</td><td>'.str_replace("\n",'<br/>',htmlspecialchars($v)).'</td></tr>';
		}
	}
	$html.='</table>';
	
	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	if( wp_mail( $email, __('Contact form filled','om_theme'), $html ) )
		echo '0';
	else
		echo '1';
	
  die();
}

