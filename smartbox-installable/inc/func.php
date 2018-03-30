<?php

	$path = dirname(__FILE__);
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	$abspath = ($os === "win") ? substr($path, 0, strpos($path, "\wp-content"))."\wp-load.php" : substr($path, 0, strpos($path, "/wp-content"))."/wp-load.php";
	require_once($abspath);

	function send_email($to, $subject, $name, $msg, $e, $error){
		
		$headers = "From: " . $name . "\r\n";
		$headers .= "Reply-To: ". $e . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		
		$msg_final = "";
		$m_header = "<html>
	<body>
		<div style='height:100px; margin:2px;'>
			<img src='logo.png' title='Smartbox Theme' style='float:left'/>
			<label style='float:left; padding: 45px 0 0 20px;color:#d6d6d6;font-size:12px;'>| &nbsp;&nbsp;Theme by DesignareTheme</label>
		</div>";
		
		$msg_final .= '<b>Name:</b> '.$name.'<br><b>Email:</b> '.$e.'<br><b>Message:</b><br>'.$msg;
		
		$m_footer = "<div style='border-top: 1px solid #bababa; height:30px;margin-top:80px;'
		<b><label style='line-height:40px;color:#000000;font-size:12px;padding-left:3px;'><b>Smartbox Team<b></label></b>
		</div></body></html>";
				
		if(mail($to, $subject, $msg_final, $headers)){
			return true;
		} else {
			return false;
		}
	}
	
?>