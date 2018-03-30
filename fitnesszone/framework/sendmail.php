<?php
if(!$_POST) exit;

    $to 	  = $_POST['hidadminemail'];
	$name	  = $_POST['txtname'];
	$email    = $_POST['txtemail'];
	$subject  = $_POST['cmbsubject'];
    $comment  = $_POST['txtmessage'];
        
	if(get_magic_quotes_gpc()) { $comment = stripslashes($comment); }

	 $e_subject = 'You\'ve been contacted by ' . $name . '.';

	 $msg  = "You have been contacted by $name with regards to, $subject.\r\n\n";
	 $msg .= "$comment\r\n\n";
	 $msg .= "You can contact $name via email, $email.\r\n\n";
	 $msg .= "-------------------------------------------------------------------------------------------\r\n";
								
	 if(@mail($to, $e_subject, $msg, "From: $email\r\nReturn-Path: $email\r\n"))
	 {
		 echo "<span class='dt-sc-success-box'>".$_POST['hidsuccess']."</span>";
	 }
	 else
	 {
		 echo "<span class='dt-sc-error-box'>".$_POST['hiderror']."</span";
	 }
?>