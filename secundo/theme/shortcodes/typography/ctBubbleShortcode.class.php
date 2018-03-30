<?php
/**
 * Bubble shortcode
 */
class ctBubbleShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Bubble';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'bubble';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		return do_shortcode('<span class="bubble '.$tip.'">' . $content . '</span>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'tip' => array('label' => __('tip position', 'ct_theme'), 'default' => 'left', 'type' => "select", 'choices' => array('left' => __('left', 'ct_theme'), 'right' => __('right', 'ct_theme'))),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctBubbleShortcode();