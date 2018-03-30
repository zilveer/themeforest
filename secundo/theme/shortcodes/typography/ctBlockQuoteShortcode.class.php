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

		$class = $style == 'normal' ? '' : $style;
		$authorHtml = $author ? ('— ' . $author) : '';
		$style = $dividers == 'no' ? ' style="border-color:transparent;"' : '';
		return '<blockquote' . $style . ' class="' . $class . '"><p>' . $content . '</p><span class="author">' . $authorHtml . '</span></blockquote>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'author' => array('label' => __('author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __('Optional author', 'ct_theme')),
			'style' => array('label' => __('style', 'ct_theme'), 'default' => 'normal', 'type' => 'select', 'choices' => array('normal' => __('normal', 'ct_theme'), 'simple' => __('simple', 'ct_theme')), 'help' => __('Style', 'ct_theme')),
			'dividers' => array('label' => __('dividers', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show dividers?", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctBlockQuoteShortcode();