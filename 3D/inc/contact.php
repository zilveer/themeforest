<?php if(file_exists('../../../../wp-config.php')){include_once('../../../../wp-config.php');} ?>
<?php if(isset($_POST['im_theme_contact_form_mail'])) 
{
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$web = trim($_POST['web']);
	$message = trim($_POST['message']);
	
	if(strlen($name) < 3){echo '<script>alert("Name : at least 3 letters");</script>';	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo '<script>alert("Invalid e-mail");</script>';	}
	else if(strlen($message) < 3){echo '<script>alert("Message : at least 3 letters");</script>';	}
	else
	{
		$msg = " 
		Name : $name <br />
		E-Mail : $email <br />
		Web : $web <br />
		Message : $message <br />
		";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$mail = mail(get_bloginfo('admin_email'),get_bloginfo('name'),$msg,$headers);
		if($mail)
		{
			echo '<script>alert("Your message came to us, Thank you!");</script>';	
		}
	}
}
?>
<script>history.go(-1)</script>