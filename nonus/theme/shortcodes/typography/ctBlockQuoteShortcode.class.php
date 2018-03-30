<?php
/**
 * BlockQuote shortcode
 */
class ctBlockQuoteShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Block quote';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'blockquote';
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

		$authorHtml = $author ? '<span class="author">' . $author . '</span>' : '';
		return do_shortcode('<blockquote'.$this->buildContainerAttributes(array(),$atts).'>' . $content . $authorHtml . '</blockquote>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'author' => array('label' => __('author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Author", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctBlockQuoteShortcode();