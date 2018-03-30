<?php
class ElementColor extends ElementBase {

	public function __construct($page, $section, $params = array()) {
		if (!empty($params)) {
			if (!isset($params['id'])) {
				$params['id'] = $params['name'];
			}
			if (!isset($params['class'])) {
				$params['class'] = 'regular-text';
			}
			if (!isset($params['size'])) {
				$params['size'] = 40;
			}
			if (!isset($params['default'])) {
				$params['default'] = '#';
			}
		}
		parent::__construct($page, $section, $params);
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-color.php');
	}

}

?>