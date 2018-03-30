<?php
/**
 * 12/12 full column shortcode
 */
class ctFullColumnShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Full column';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'full_column';
	}

	/**
	 * Action
	 * @return string
	 */

	public function getGeneratorAction() {
		return self::GENERATOR_ACTION_INSERT;
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$innerPre = '';
		$innerPost = '';
		$inner = false;
		if ($inner == 'true' || $inner == 'yes' || $inner == '1' || $space == 'true' || $space == 'yes' || $space == '1') {
			$innerPre = '<div class="inner">';
			$innerPost = '</div>';
		}

		return '<div'.$this->buildContainerAttributes(array('class' => array('span12', $class)), $atts).'>' . $innerPre . do_shortcode($content) . $innerPost . '</div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'space' => array('label' => __('add inner space?', 'ct_theme'), 'type' => "checkbox", 'default' => false),
			'class' => array('type' => false)
		);
	}
}

new ctFullColumnShortcode();