<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitContactOwnerAjax extends AitFrontendAjax
{

	/**
	 * @WpAjax
	 */
	public function send()
	{
		$matches = array();
		preg_match_all('/{([^}]*)}/', $_POST['response-email-content'], $matches);

		foreach($matches[1] as $i => $match){
			$_POST['response-email-content'] = str_replace($matches[0][$i], $_POST[$match], $_POST['response-email-content']);
		}

		$_POST['response-email-content'] = str_ireplace(array("\r\n", "\n"), "<br />", $_POST['response-email-content']);

		$senderName = isset($_POST['response-email-sender-name']) ? $_POST['response-email-sender-name'] : '';

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'Reply-To: '.$_POST['user-name'].' <'.$_POST['user-email'].'>',
			'From: '.$senderName.' <'.$_POST['response-email-sender-address'].'>', 
		);
		
		$result = wp_mail($_POST['response-email-address'], $_POST['response-email-subject'], $_POST['response-email-content'], $headers, null);
		if($result == true){
			$this->sendJson(array('message' => sprintf(__("Mail sent to %s", 'ait'), $_POST['response-email-address'])));
		} else {
			$this->sendErrorJson(array('message' => __("Mail failed to send", 'ait')));
		}
	}
}
