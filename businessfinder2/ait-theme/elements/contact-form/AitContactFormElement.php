<?php


class AitContactFormElement extends AitElement
{
	private $simpleCaptcha;



	public function init()
	{
		$this->simpleCaptcha = new ReallySimpleCaptcha();
		$this->simpleCaptcha->tmp_dir = aitPaths()->dir->cache . '/captcha';
	}



	public function captchaImageUrl($validNum)
	{
		$cacheUrl = aitPaths()->url->cache . '/captcha';
		$img = $this->simpleCaptcha->generate_image('ait-captcha-'.$validNum, $this->simpleCaptcha->generate_random_word());

		return "{$cacheUrl}/{$img}";
	}

}
