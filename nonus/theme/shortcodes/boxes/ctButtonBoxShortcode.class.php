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


		return '<div'.$this->buildContainerAttributes(array('class'=>array('button-box')),$atts).'>
		            <p class="span9">
		                ' . do_shortcode($content) . '
		            </p>
		            <a href="' . $link . '" class="btn btn-default pull-right span3">' . $buttontext . '</a>
		        </div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'buttontext' => array('label' => __('button text', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button text", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button link", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctButtonBoxShortcode();