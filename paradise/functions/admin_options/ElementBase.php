<?php
abstract class ElementBase {
	private $options = array();

	public function __construct($page, $section, $params = array()) {
		$this->page = $page;
		$this->section = $section;
		if (!empty($params)) {
			if (isset($params['name'])) {
				$this->name = $params['name'];
				unset($params['name']);
			}
			if (isset($params['title'])) {
				$this->title = $params['title'];
				unset($params['title']);
			}
			$this->args = $params;
		}
	}

	public function __get($name) {
		if (isset($this->options[$name]))
			return $this->options[$name];
		else
			return null;
	}

	public function __set($name, $val) {
		$this->options[$name] = $val;
	}

	public function __isset($name) {
		return isset($this->options[$name]);
	}

	public function __unset($name) {
		if (isset($this->options[$name]))
			unset($this->options[$name]);
	}

	public function register() {
		add_option($this->name, (isset($this->args['default']) ? $this->args['default'] : ''));
		register_setting($this->page.'_group', $this->name, array(&$this, 'validate'));
		add_settings_field($this->name, $this->title, array(&$this, 'render'), $this->page, $this->section, $this->args);
	}

	public function validate($input) {
		return $input;
	}

	protected function render() {}

}

?>