<?php
/**
 * Flex Slider Item shortcode
 */
class ctFlexSliderItemShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Flex Slider Item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'flex_slider_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$preLink = $link ? ('<a href="' . $link . '">') : '';
		$postLink = $link ? '</a>' : '';

		return do_shortcode('<li'.$this->buildContainerAttributes(array(),$atts).'>
							' . $preLink . '
				              <img src="' . $imgsrc . '" alt="">
				            ' . $postLink . '
				            </li>');
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'flex_slider';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link from image", 'ct_theme')),
		);
	}

}

new ctFlexSliderItemShortcode();