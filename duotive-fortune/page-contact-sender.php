<?php 
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	if ( !function_exists('_recaptcha_qsencode') ) require_once('includes/recaptchalib.php'); 	

	$publickey = get_option('dt_recaptchapublickey');
	$privatekey = get_option('dt_recaptchaprivatekey');
	
	$recaptcha_usage = $_POST['recaptcha_usage'];
	$destination_email = $_POST['destination_email'];
	$full_name = $_POST["full_name"]; if ( $full_name == '' ) $full_name = get_option('blogname');
	$company = $_POST["company"];
	$email = $_POST["email"]; if ( $email == '' ) $email = $destination_email;
	$phone = $_POST["phone"];
	$message = $_POST["message"];


	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "From: ".$full_name." < ".$email." > \r\n";
	$headers .= "Reply-to:".$email."\r\n";
	$headers .= "X-Priority: 3\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "X-Mailer: PHP mailer\r\n";
	
	$subject = 'A new contact message from your website.';

	$email_content = '';
	if ( $full_name != '' ) $email_content .= dt_ContactFormName.$full_name.'<br />';
	if ( $company != '' ) $email_content .= dt_ContactFormCompany.$company.'<br />';	
	if ( $email != '' ) $email_content .= dt_ContactFormEmail.$email.'<br />';
	if ( $phone != '' ) $email_content .= dt_ContactFormPhone.$phone.'<br />';
	if ( $message != '' ) $email_content .= dt_ContactFormMessage.$message.'<br />';	
	
	$resp = null;
	$error = null;

	if ( $recaptcha_usage == 'yes' ) 
	{
		if ( $_POST["recaptcha_response_field"] == '' ) 
		{
			echo '<div class="dt-message dt-message-info">'.dt_ContactCaptchaEmpty.'</div>';
		}
		else
		{	
			$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				echo '<div class="dt-message dt-message-error">'.dt_ContactCaptchaError.'</div>';
			} 
			else 
			{
				
				$mail_tester = wp_mail($destination_email, $subject, $email_content, $headers);
				if ( $mail_tester == 1 )
				{
					echo '<div class="dt-message dt-message-success">'.dt_ContactMailSuccess.'</div>';				
				}
				else
				{
					echo '<div class="dt-message dt-message-error">'.dt_ContactMailError.'</div>';							
				}
			}		
		}
	}
	else
	{
		$mail_tester = wp_mail($destination_email, $subject, $email_content, $headers);
		if ( $mail_tester == 1 )
		{
			echo '<div class="dt-message dt-message-success">'.dt_ContactMailSuccess.'</div>';						
		}
		else
		{
			echo '<div class="dt-message dt-message-error">'.dt_ContactMailError.'</div>';							
		}		
	}

?>