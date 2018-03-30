<?php
require_once CT_THEME_LIB_DIR . '/shortcodes/socials/ctFacebookFeedShortcodeBase.class.php';
/**
 * Twitter shortcode
 */
class ctFacebookFeedShortcode extends ctFacebookFeedShortcodeBase {

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

		$followLink = $this->getFollowLink($pageid);
		$posts = $this->getPosts($attributes);
		foreach ($posts as $post) {
			$imgHtml = $post['image'] ? ($img == 'yes' ? '<img src="' . $post['image'] . '"><br>' : '<a target="_blank" href="' . $post['image'] . '">' . $post['image'] . '</a><br>') : '';

			$html .= '<p>' . $imgHtml . $post['content'] . '<br><span class="time-stamp">' . $this->ago($post['timestamp']) . '</span></p>';
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
				'widgetmode' => array('default' => 'false', 'type' => false),
				'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			), parent::getAttributes());
	}
}

new ctFacebookFeedShortcode();