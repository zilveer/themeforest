<?php
class ElementPassword extends ElementBase {

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
		}
		parent::__construct($page, $section, $params);
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-password.php');
	}

}

?>