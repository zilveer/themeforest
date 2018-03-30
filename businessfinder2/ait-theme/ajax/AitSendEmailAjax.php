<?php


class AitSendEmailAjax extends AitFrontendAjax
{

	/**
	 * @WpAjax
	 */
	public function send()
	{
		$captcha = new ReallySimpleCaptcha();
		$captcha->tmp_dir = aitPaths()->dir->cache . '/captcha';

		if(!empty($_POST['response-email-content'])){
			$matches = array();
			preg_match_all('/{([^}]*)}/', $_POST['response-email-content'], $matches);

			foreach($matches[1] as $i => $match){
				if(!empty($_POST[$match])){
					$_POST['response-email-content'] = str_replace($matches[0][$i], $_POST[$match], $_POST['response-email-content']);
				}
			}
			
			$_POST['response-email-content'] = str_ireplace(array("\r\n", "\n"), "<br />", $_POST['response-email-content']);
		}

		// unescape all escaped quotes .. not safe .. probably remove
		//$_POST['response-email-content'] = str_ireplace(array("\'", '\"'), array("'", '"'), $_POST['response-email-content']);

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
		);
		if(!empty($_POST['email'])){
			array_push($headers, 'Reply-To: '.$_POST['email'].' <'.$_POST['email'].'>');
		}

		if(!empty($_POST['response-email-sender'])){
			array_push($headers, 'From: '.'<'.$_POST['response-email-sender'].'>');
		}

		if(!empty($_POST['captcha-check'])){
			if($captcha->check('ait-captcha-'.$_POST['response-email-check'], $_POST['captcha-check'])){
				
				$requiredFieldsCounter = 0;
				$requiredFieldsMessage = __("Required fields: (%s) are not set-up in contact form element", 'ait');
				$requiredFieldsStrings = array();
				
				if(!empty($_POST['response-email-address'])){
					$requiredFieldsCounter += 1;
				} else {
					array_push($requiredFieldsStrings, "Email Address");
				}

				if(!empty($_POST['response-email-subject'])){
					$requiredFieldsCounter += 1;
				} else {
					array_push($requiredFieldsStrings, "Email Subject");
				}

				if(!empty($_POST['response-email-content'])){
					$requiredFieldsCounter += 1;
				} else {
					array_push($requiredFieldsStrings, "Email Content");
				}

				if($requiredFieldsCounter == 3){
					
					$result = wp_mail($_POST['response-email-address'], $_POST['response-email-subject'], $_POST['response-email-content'], $headers);
					if($result == true){
						$this->sendJson(array('message' => sprintf(__("Mail sent to %s", 'ait'), $_POST['response-email-address'])));
					} else {
						$this->sendErrorJson(array('message' => __("Message sending failed", 'ait')));
					}

				} else {
					$this->sendErrorJson(array('message' => sprintf($requiredFieldsMessage, implode(" ,", $requiredFieldsStrings))));
				}

			}else{
				$this->sendErrorJson(array('message' => __("Captcha check failed", 'ait')));
			}
		} else {
			
			$requiredFieldsCounter = 0;
			$requiredFieldsMessage = __("Required fields: (%s) are not set-up in contact form element", 'ait');
			$requiredFieldsStrings = array();
			
			if(!empty($_POST['response-email-address'])){
				$requiredFieldsCounter += 1;
			} else {
				array_push($requiredFieldsStrings, "Email Address");
			}

			if(!empty($_POST['response-email-subject'])){
				$requiredFieldsCounter += 1;
			} else {
				array_push($requiredFieldsStrings, "Email Subject");
			}

			if(!empty($_POST['response-email-content'])){
				$requiredFieldsCounter += 1;
			} else {
				array_push($requiredFieldsStrings, "Email Content");
			}

			if($requiredFieldsCounter == 3){

				$result = wp_mail($_POST['response-email-address'], $_POST['response-email-subject'], $_POST['response-email-content'], $headers);
				if($result == true){
					$this->sendJson(array('message' => sprintf(__("Mail sent to %s", 'ait'), $_POST['response-email-address'])));
				} else {
					$this->sendErrorJson(array('message' => __("Message sending failed", 'ait')));
				}
				
			} else {
				$this->sendErrorJson(array('message' => sprintf($requiredFieldsMessage, implode(" ,", $requiredFieldsStrings))));
			}
		}
	}

	/**
	 * @WpAjax
	 */
	public function getCaptcha(){
		$rand = rand();
		$captcha = new AitReallySimpleCaptcha();

		$imgUrl = "";
		
		$captcha->tmp_dir = aitPaths()->dir->cache . '/captcha';
		$cacheUrl = aitPaths()->url->cache . '/captcha';
		
		$img = $captcha->generate_image('ait-captcha-'.$rand, $captcha->generate_random_word());
		$imgUrl = $cacheUrl."/".$img;

		$this->sendJson(array('rand' => $rand, 'url' => $imgUrl, 'html' => '<img src="'.$imgUrl.'" alt="captcha">'));
	}
}
