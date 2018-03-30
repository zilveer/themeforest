<?php
class ElementSelect extends ElementBase {

	public function __construct($page, $section, $params = array()) {
		if (!empty($params)) {
			if (!isset($params['id'])) {
				$params['id'] = $params['name'];
			}
			if (!isset($params['options'])) {
				$params['options'] = array();
			}
		}
		parent::__construct($page, $section, $params);
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-select.php');
	}

}

?>
