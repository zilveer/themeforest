<?php

	require("../inc/func.php");

	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
		
		if($_POST['success'])
			$s = $_POST['success'];
		else
			$s = "Message send successfully.";
	
		if(send_email($_POST['sendTo'], $_POST['subject'], $_POST['name'], $_POST['message'], $_POST['email'], 0))
			echo '{"response":{"error": "1", "message":"' . $s . '"}}';
		else{
			$err=$_POST['unsuccess'];
  		echo '{"response":{"error": "0", "message":"'. $err . '"}}';
  	}
	
	}
?>