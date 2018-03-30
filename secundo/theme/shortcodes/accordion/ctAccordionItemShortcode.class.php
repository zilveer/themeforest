<?php
/**
 * Accordion item shortcode
 */
class ctAccordionItemShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Accordion item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'accordion_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = rand(100, 1000);
		return '<div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" href="#collapse' . $id . '" data-toggle="collapse">' . $title . '</a>
                                </div>
                                <div id="collapse' . $id . '" class="accordion-body collapse" style="height: 0px;">
                                    <div class="accordion-inner">' . do_shortcode($content) . '</div>
                                </div>
                            </div>';
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => 'textarea'),
		);
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'accordion';
	}


}

new ctAccordionItemShortcode();