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
	 * Returns shortcode type
	 * @return mixed|string
	 */

	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		return do_shortcode('<p'.$this->buildContainerAttributes(array('class'=>array($class)),$atts).'>' . $content . '</p>');
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'class' => array('label' => __('CSS class', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctParagraphShortcode();