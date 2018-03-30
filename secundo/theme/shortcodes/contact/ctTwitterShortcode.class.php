<?php
require_once CT_THEME_LIB_DIR . '/shortcodes/socials/ctTwitterShortcodeBase.class.php';
/**
 * Twitter shortcode
 */
class ctTwitterShortcode extends ctTwitterShortcodeBase {

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$newwindow = $newwindow == 'false' || $newwindow == 'no' ? false : true;
		$html = '';
		if ($header) {
			$html = '[header line="crossLine" strong="yes"]' . $header . '[/header]';
		}


		$followLink = $this->getFollowLink($user);
		$tweets = $this->getTweets($attributes);
		foreach ($tweets as $tweet) {
			$html .= '<p>' . $tweet->content . '<br><span class="time-stamp">' . $this->ago($tweet->updated) . '</span></p>';
		}
		$link = '';

		if ($button) {
			$link = '<br><div class="doCenter"><a class="btn vlarge vorange"' . ($newwindow ? ' target="_blank"' : '') . ' href="' . $followLink . '">' . $button . '</a></div>';
		}

		return do_shortcode($html . $link);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array_merge(
			array(
				'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			), parent::getAttributes());
	}
}

new ctTwitterShortcode();