<?php


class AitLoginWidgetCheckCaptchaAjax extends AitFrontendAjax
{

	/**
	 * @WpAjax
	 */
	public function check()
	{
		$captcha = new AitReallySimpleCaptcha();
		$captcha->tmp_dir = aitPaths()->dir->cache . '/captcha';

		$result = false;

		if(!empty($_POST['captcha-check'])){
			if($captcha->check('ait-login-widget-captcha-'.$_POST['captcha-hash'], $_POST['captcha-check'])){
				$result = true;
			}
		}

		$this->sendJson($result);
	}
}
