<?php
class AdminPageFactory {
	private $pages = array();
	private $last_page;

	function add_page($title, $menu_title, $capability, $slug, $icon_url = '', $position = null) {
		add_action('admin_menu', array($this->last_page = $this->pages[$slug] = new CustomAdminPage($title, $menu_title, $capability, $slug, $icon_url, $position), 'register_menu'));
	}

	function add_sub_page($parent_slug, $title, $menu_title, $capability, $slug) {
		add_action('admin_menu', array($this->last_page = $this->pages[$slug] = new CustomAdminSubPage($parent_slug, $title, $menu_title, $capability, $slug), 'register_menu'));
	}

	function set_icon($icon) {
		$this->last_page->page_icon = $icon;
	}

	function set_title($title) {
		$this->last_page->page_title = $title;
	}

	function set_help($text) {
		$this->last_page->help = $text;
	}

	function add_section($id, $title, $desc) {
		$this->last_page->add_section($id, $title, $desc);
	}

	function js_includes() {
		wp_enqueue_script('farbtastic');
	}

	function css_includes() {
		wp_enqueue_style('farbtastic');
	}

	function add_element($element_type, $params) {
		$this->last_page->add_element($element_type, $params);
		if ($element_type == 'Upload') {
			$this->last_page->use_upload = true;
		}
		if ($element_type == 'Color') {
			add_action('admin_print_scripts', array(&$this, 'js_includes'));
			add_action('admin_print_styles', array(&$this, 'css_includes'));
			$this->last_page->use_picker = true;
		}
	}

}

global $apf;

$apf = new AdminPageFactory();

function __autoload($class) {
	if (strpos($class, 'Element') === 0 || in_array($class, array('CustomAdminPage', 'CustomAdminSubPage', 'AdminPageSection', 'CustomPageBase'))) {
		require_once($class.'.php');

		if (!class_exists($class, false)) {
			throw new Exception(sprintf(__("Unable to load class: %s"), $class));
		}
	}
}

function ap_add_page($title, $menu_title, $capability, $slug, $icon_url = '', $position = null) {
	global $apf;
	$apf->add_page($title, $menu_title, $capability, $slug, $icon_url, $position);
}

function ap_add_sub_page($parent_slug, $title, $menu_title, $capability, $slug) {
	global $apf;
	$apf->add_sub_page($parent_slug, $title, $menu_title, $capability, $slug);
}

function ap_page_title($title) {
	global $apf;
	$apf->set_title($title);
}

function ap_page_icon($icon) {
	global $apf;
	$apf->set_icon($icon);
}

function ap_page_help($text) {
	global $apf;
	$apf->set_help($text);
}

function ap_add_section($id, $title, $desc = '') {
	global $apf;
	$apf->add_section($id, $title, $desc);
}

function ap_add_input($params = array()) {
	global $apf;
	return $apf->add_element('Input', $params);
}

function ap_add_password($params = array()) {
	global $apf;
	return $apf->add_element('Password', $params);
}

function ap_add_radio($params = array()) {
	global $apf;
	return $apf->add_element('Radio', $params);
}

function ap_add_checkbox($params = array()) {
	global $apf;
	return $apf->add_element('CheckBox', $params);
}

function ap_add_select($params = array()) {
	global $apf;
	return $apf->add_element('Select', $params);
}

function ap_add_textarea($params = array()) {
	global $apf;
	return $apf->add_element('Textarea', $params);
}

function ap_add_upload($params = array()) {
	global $apf;
	return $apf->add_element('Upload', $params);
}

function ap_add_color($params = array()) {
	global $apf;
	return $apf->add_element('Color', $params);
}

?>
