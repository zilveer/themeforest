<?php
class CustomAdminPage extends CustomPageBase {

	public function __construct($title, $menu_title, $capability, $slug, $icon_url, $position) {
		$this->title = $title;
		$this->menu_title = $menu_title;
		$this->capability = $capability;
		$this->slug = $slug;
		$this->icon_url = $icon_url;
		$this->position = $position;
		if (empty($this->title))
			throw new Exception(__('Title not defined.'));
		if (empty($this->menu_title))
			throw new Exception(__('Menu title not defined.'));
		if (empty($this->capability))
			throw new Exception(__('Capability not defined.'));
		if (empty($this->slug))
			throw new Exception(__('Slug not defined.'));

	}

	public function register_menu() {
		add_menu_page($this->title, $this->menu_title, $this->capability, $this->slug, array(&$this, 'render'), $this->icon_url, $this->position);
		parent::register_menu();
	}

}

?>