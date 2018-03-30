<?php
/**
 * Paragraph shortcode
 */
class ctParagraphShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Paragraph';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'paragraph';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$class = $style=='default' ? '' : $style;
		return do_shortcode('<p class="' . $class . ' nomargin">' . $content . '</p>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'style' => array('label' => __('style', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'options' => array('default' => __('default', 'ct_theme'), 'vmedium' => __('medium', 'ct_theme'), 'vlarge' => __('large', 'ct_theme')), 'help' => __("Paragraph style", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctParagraphShortcode();