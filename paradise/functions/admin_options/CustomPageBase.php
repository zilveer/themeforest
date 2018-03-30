<?php
class CustomPageBase {
	private $options = array();
	protected $sections = array();
	private $last_section;

	public function register_menu() {
		add_action('admin_init', array(&$this, 'register_options'));
		if (isset($this->help)) {
			add_contextual_help(get_plugin_page_hookname($this->slug, ''), $this->help);
		}
	}

	public function register_options() {
		if (!empty($this->sections)) {
			foreach ($this->sections as $section) {
				$section->register();
			}
		}
	}

	public function add_section($id, $title, $desc) {
		$this->last_section = $this->sections[$id] = new AdminPageSection($id, $title, $desc, $this->slug);
	}

	public function add_element($element_type, $params) {
		$section = $this->last_section;
		$section->add_element($element_type, $params);
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

	public function render() {
		require(dirname(__FILE__) . '/template-page.php');
	}

}
?>