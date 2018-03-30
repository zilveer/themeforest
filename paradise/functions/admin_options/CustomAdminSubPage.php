<?php
class CustomAdminSubPage extends CustomPageBase {

	private $sys_parents = array(
		'Dashboard' => 'add_dashboard_page',
		'Posts' => 'add_posts_page',
		'Media' => 'add_media_page',
		'Links' => 'add_links_page',
		'Pages' => 'add_pages_page',
		'Comments' => 'add_comments_page',
		'Appearance' => 'add_theme_page',
		'Plugins' => 'add_plugins_page',
		'Users' => 'add_users_page',
		'Tools' => 'add_management_page',
		'Settings' => 'add_options_page',
	);

	public function __construct($parent_slug, $title, $menu_title, $capability, $slug) {
		$this->parent_slug = $parent_slug;
		$this->title = $title;
		$this->menu_title = $menu_title;
		$this->capability = $capability;
		$this->slug = $slug;
	}

	public function register_menu() {
		if (array_key_exists($this->parent_slug, $this->sys_parents)) {
			call_user_func($this->sys_parents[$this->parent_slug], $this->title, $this->menu_title, $this->capability, $this->slug, array(&$this, 'render'));
		} else
			add_submenu_page($this->parent_slug, $this->title, $this->menu_title, $this->capability, $this->slug, array(&$this, 'render'));
		parent::register_menu();
	}
}

?>