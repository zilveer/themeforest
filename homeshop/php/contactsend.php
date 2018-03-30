
<?php
header( "Content-Type: application/json" );

$result = array('status' => 'error', 'code' => 'mailError');

try {
	$emailto = '';
	$messages = '';
	
	if(!empty($_POST))
	{
		$headers = "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\r\n";

		$subject = stripslashes(isset($_POST['subject']) ? $_POST['subject'] : "[".get_bloginfo('name')."]");
		$emailto = (isset($_POST['form_mail_to'])) ? trim($_POST['form_mail_to']) : get_option('admin_email');

		
		if(isset($_POST['email'])) {
			$from = trim($_POST['email']);
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" ;
		}
		
		
		foreach ($_POST as $field => $text) {
			if(!in_array($field, array('form_mail_to', 'subject', 'email'))) {
				if($field != 'action' && $text != 'send_contact_form') {
					$field = str_replace('_', ' ', $field);
					$messages .= "<br><strong>{$field}</strong> : {$text}";
				}
			}
		}
		
		if($emailto) {
			$mail = wp_mail($emailto, $subject, $messages, $headers);	

			if($mail) {
				$result = array('status' => 'success', 'code' => 'success');
			} else {
				throw new Exception('sending mail error');
			}
		}
	}
} catch (Exception $e) {
	$result = array('status' => 'error');
}

echo json_encode($result);

?>