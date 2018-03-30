<?php
/**
 * Title row shortcode
 */
class ctTitleRowShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Title row';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'title_row';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		switch ($style) {
			case '2':
				$class = 'patBright';
				break;
			case '3':
				$class = 'patBlue';
				break;
			case '4':
				$class = 'patDark';
				break;
			default:
				$class = 'patStd';
		}

		$container = $this->isSidebar() ? "" : '<div class="container">';
		$containerClose = $this->isSidebar() ? "" : "</div>";

		return '<div class="' . $class . '">' . $container . '<h1 class="twoLines"><span>' . $header . '</span></h1>' . $containerClose . '</div>';
	}

	/**
	 * is template with sidebar?
	 * @return bool
	 */
	protected function isSidebar() {
		return is_page_template('page-custom.php') || is_page_template('page-custom-left.php');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'style' => array('label' => __('style', 'ct_theme'), 'default' => '1', 'type' => 'select', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
		);
	}
}

new ctTitleRowShortcode();