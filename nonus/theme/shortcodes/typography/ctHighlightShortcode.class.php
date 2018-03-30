<?php
/**
 * Highlight shortcode
 */
class ctHighlightShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Highlight';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'highlight';
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

		switch($style){
			case 1:
				$style = 'weak';
				break;
			case 2:
				$style = 'strong';
				break;
			case 3:
				$style = 'stronger';
				break;
			default:
				$style = 'weak';
		}

		return do_shortcode('<em'.$this->buildContainerAttributes(array('class'=>array($style)),$atts).'>' . $content . '</em>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'style' => array('label' => __('style', 'ct_theme'), 'default' => '1', 'type' => 'select', 'choices' => array('1' => '1', '2' => '2', '3' => '3'), 'help' => __('Highlight style', 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctHighlightShortcode();