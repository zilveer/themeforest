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
		$headerHtml = $header ? ('<h' . $headertype . '>' . $header . '</h' . $headertype . '>') : '';

		$class = $class ? (' ' . $class) : '';

		switch($color){
			case 'primary':
				$class .= ' section-emphasis';
				break;
			case 'distinctive':
				$class .= ' section-emphasis-2';
				break;
			default:
				$class .= '';
		}

		$innerPre = 'div';
		$innerPost = 'div';
		if($space == 'true' || $space == 'yes' || $space == '1'){
			$innerPre = 'section';
			$innerPost = 'section';
		}

		$narrowDivOpen = ($narrowcontent == 'true' || $narrowcontent == 'yes' || $narrowcontent == '1') ? '<div class="container">' : '';
		$narrowDivClose = ($narrowcontent == 'true' || $narrowcontent == 'yes' || $narrowcontent == '1') ? '</div>' : '';
		$narrowDivOpen2 = ($narrowcontent == 'true' || $narrowcontent == 'yes' || $narrowcontent == '1') ? '<div class="row-fluid">' : '';
		$narrowDivClose2 = ($narrowcontent == 'true' || $narrowcontent == 'yes' || $narrowcontent == '1') ? '</div>' : '';

		$params = array(
			'class'=>array('row-fluid',$class),
			'id'=>$id
		);

		return do_shortcode('<' . $innerPre . $this->buildContainerAttributes($params,$atts).'>' . $narrowDivOpen . $headerHtml . $narrowDivOpen2 . $content . $narrowDivClose2 . $narrowDivClose . '</' . $innerPost . '>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$defaultNarrow = $this->isSidebar() ? false : true;

		return array(
			'id' => array('label' => __('header id', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("html id attribute", 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'headertype' => array('label' => __('type', 'ct_theme'), 'default' => '3', 'type' => 'select', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6')),
			'class' => array('label' => __('CSS class', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'space' => array('label' => __('add inner space?', 'ct_theme'), 'type' => "checkbox", 'default' => true),
			'narrowcontent' => array('label' => __('narrow content?', 'ct_theme'), 'type' => "checkbox", 'default' => $defaultNarrow, 'help' => __("Make content narrow even if inside full width container?", 'ct_theme')),
			'color' => array('label' => __('color', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array('default' => __('default', 'ct_theme'), 'primary' => __('primary', 'ct_theme'), 'distinctive' => __('distinctive', 'ct_theme')), 'help' => __("Background color", 'ct_theme')),
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