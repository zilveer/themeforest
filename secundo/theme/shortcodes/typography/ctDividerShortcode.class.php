<?php
/**
 * Divider shortcode
 */
class ctDividerShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Divider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'divider';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$class = $width == 'default' ? '' : $width;
		return do_shortcode('<hr class="' . $class . '">');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'width' => array('label' => __('width', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array('default' => __('default', 'ct_theme'), 'simple' => __('simple', 'ct_theme'), 'mini' => __('mini', 'ct_theme'))),
		);
	}
}

new ctDividerShortcode();