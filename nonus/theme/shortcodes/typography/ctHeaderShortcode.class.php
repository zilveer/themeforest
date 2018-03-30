<?php
/**
 * Header shortcode
 */
class ctHeaderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Header';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'header';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$classHtml = $class;
		if($line == 'twoLines'){
			$classHtml .= $classHtml ? ' std' : 'std';
		}
		$classHtml = $classHtml ? ' class="' . $classHtml . '"' : '';


		return do_shortcode('<h' . $type . $this->buildContainerAttributes(array('class'=>array($classHtml)),$atts). '>' . $content . '</h' . $type . '>');
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'line' => array('default' => '', 'type' => false),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'type' => array('label' => __('type', 'ct_theme'), 'default' => '1', 'type' => 'select', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6')),
			'class' => array('label' => __("class", 'ct_theme'), 'default' => '', 'help' => __("Header class", 'ct_theme')),
		);
	}
}

new ctHeaderShortcode();