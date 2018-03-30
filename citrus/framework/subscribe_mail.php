<?php

	if(!$_POST) exit;
	
	$to 	  = $_POST['hid_adminemail']; #Replace your email id...
	$dtfullname	  = $_POST['dtfullname'];
	$dtemail    = $_POST['dtemail'];
	$dtcourse    = $_POST['dtcourse'];
	$subject  = $_POST['hid_subject'];
	$dtdatetimepicker  = isset($_POST['dtdatetimepicker']) ? $_POST['dtdatetimepicker'] : '';
	
	if($dtfullname == '' || $dtemail == '') : 	
		echo "<span class='error-msg'>Please fill the required fields</span>";
		exit;
	endif;
	
	$e_subject = $subject;
	
	$msg  = $dtfullname. ' has been subscribed for '.$dtcourse.'\r\n\n';
	if($dtdatetimepicker != '')
		$msg  .= 'He/She planned to visit in person on '.$dtdatetimepicker.'\r\n\n';
	$msg .= "You can contact $dtfullname via email, $dtemail.\r\n\n";
	$msg .= "-------------------------------------------------------------------------------------------\r\n";
							
	if(@mail($to, $e_subject, $msg, "From: $dtemail\r\nReturn-Path: $dtemail\r\n"))
	{
		echo "<span class='success-msg'>".$_POST['hid_successmsg']."</span>";
	}
	else
	{
		echo "<span class='error-msg'>".$_POST['hid_errormsg']."</span>";
	}

?>