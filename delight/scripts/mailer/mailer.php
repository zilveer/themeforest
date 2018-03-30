<?php require_once( '../../../../../wp-load.php' ); ?>
<?php 
$captcha = $_GET['captcha'];
if($captcha!='' || $captcha!='undefined'){
	$cryptinstall=TEMPLATEPATH."/scripts/crypt/cryptographp.fct.php";
	include $cryptinstall; 
}
?>
<?php
	$list_keys=array_keys($_GET);
	$list_values=array_values($_GET);
	$num=count(array_keys($_GET));
	 

$form = $_GET['form'];
$i = 0;
$pix_array_your_forms = get_pix_option('pix_array_your_forms_');
while($i<count($pix_array_your_forms)){ 
	$pix_array_your_field = get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_fields_');
	
	if (!$errors && $form==sanitize_title($pix_array_your_forms[$i])) {
		if($captcha=='' || $captcha=='undefined' || chk_crypt($captcha)){
			
			$to = get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_recipient');   
		
			$headers = "MIME-Version: 1.0\n" .
				"From: ". $_GET['email'] . " <". $_GET['email'] . ">\n" .
				"Content-Type: text/html; charset=\"" . 
				get_pix_option('blog_charset') . "\"\n";
			 
		
			$subject = get_pix_option('pix_array_'.sanitize_title($pix_array_your_forms[$i]).'_subject');; 
			$message = '
			<html>
			<body>
			<table>';
				for($i=0;$i<$num;$i++) {
					if (($list_keys[$i]!="form" && $list_keys[$i]!="captcha" && $i!=0 && $list_keys[$i]!='_') ) {
						$message.= '<tr><td>'.$list_keys[$i].":<td>".stripslashes(nl2br($list_values[$i]))."</td></tr>";
					}
				}
		
			$message .='</table>
			</body>
			</html>';
			
		 
		
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			$result = wp_mail( $to, $subject, $message, $headers, $attachments );
			 
		
			echo $result;
		} else {
			echo 'noCaptcha';
		}
	 
	
	}//endif
$i++;
}//endwhile
	 
	 
	function sendmail($to, $subject, $message, $from) {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		 
		add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
		$result = wp_mail($to,$subject,$message,$headers);
		 
		if ($result) return 1;
		else return 0;
	}


?>