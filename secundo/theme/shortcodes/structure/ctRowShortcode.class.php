<?php
/**
 * Wide row shortcode
 */
class ctRowShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Row';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'row';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$class = '';
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
		$class .= $nomrg == "yes" ? ' nomrg' : '';

		$headerHtml = $header ? ('[header type="2" line="crossLine" strong="yes"]' . $header . "[/header]") : '';

		$container = $this->isSidebar() ? "" : '<div class="container">';
		$containerClose = $this->isSidebar() ? "" : "</div>";

		return do_shortcode('<div class="' . $class . '">' . $container . $headerHtml . '<div class="row-fluid">' . $content . '</div>' . $containerClose . '</div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'style' => array('label' => __('style', 'ct_theme'), 'default' => '1', 'type' => 'select', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4')),
			'nomrg' => array('label' => __('no margin', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'options' => array('yes' => 'yes', 'no' => 'no'), 'help' => __('Cleans default margin settings', 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
		);
	}

	/**
	 * Zwraca rodzaj shortcode
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * is template with sidebar?
	 * @return bool
	 */
	protected function isSidebar() {
		return is_page_template('page-custom.php') || is_page_template('page-custom-left.php');
	}
}

new ctRowShortcode();