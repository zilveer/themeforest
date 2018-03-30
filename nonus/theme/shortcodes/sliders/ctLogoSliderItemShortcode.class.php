<?php
/**
 * Logo Slider item shortcode
 */
class ctLogoSliderItemShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Logo slider item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'logo_slider_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$linkPre = $link ? ('<a href="' . $link . '">') : '';
		$linkPost = $link ? '</a>' : '';
		return do_shortcode('<li'.$this->buildContainerAttributes(array(),$atts).'>' . $linkPre . '<img src="' . $imgsrc . '" alt="" >' . $linkPost . '</li>');


	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'logo_slider';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'link' => array('label' => __('link', 'ct_theme'), 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'imgsrc' => array('default' => '', 'type' => 'image', 'label' => __("image source", 'ct_theme')),
		);
	}
}

new ctLogoSliderItemShortcode();