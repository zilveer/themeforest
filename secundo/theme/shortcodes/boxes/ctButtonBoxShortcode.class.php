<?php
/**
 * Button Box shortcode
 */
class ctButtonBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Button box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'button_box';
	}

	/**
	 * Shortcode type
	 * @return string
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

		$topHtml = $topdivider == "yes" ? '<hr>' : '';
		$bottomHtml = $bottomdivider == "yes" ? '<hr>' : '';

		return do_shortcode($topHtml . '<div class="row-fluid">
				                <div class="span6 offset1 doCenter">
				                    <h1 class="big vorange nomrg">' . $header . '</h1>
				                </div>
				                <div class="span4 doCenter">
				                    <a href="' . $link . '" class="btn vorange vbig">' . $buttontext . '</a>
				                </div>
				                <div class="span1"></div>
				            </div>' . $bottomHtml);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'buttontext' => array('label' => __('button text', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button text", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button link", 'ct_theme')),
			'topdivider' => array('label' => __('top divider', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show top divider?", 'ct_theme')),
			'bottomdivider' => array('label' => __('bottom divider', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show bottom divider?", 'ct_theme')),
		);
	}
}

new ctButtonBoxShortcode();