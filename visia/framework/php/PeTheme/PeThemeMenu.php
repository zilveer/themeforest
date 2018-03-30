<?php

class PeThemeMenu {

	public $defaults;
	public $current;


	public function __construct() {
		$this->defaults = array(
								 'theme_location'  => "",
								 'menu'            => "", 
								 'container'       => "", 
								 'container_class' => "", 
								 'container_id'    => "",
								 'menu_class'      => null, 
								 'menu_id'         => null,
								 'echo'            => true,
								 'fallback_cb'     => array(&$this,"fallback"),
								 //'fallback_cb'     => false,
								 'before'          => "",
								 'after'           => "",
								 'link_before'     => "",
								 'link_after'      => "",
								 'items_wrap'      => apply_filters("pe_theme_menu_items_wrap",'<ul class="nav">%3$s</ul>'),
								 'walker' => new Walker_Nav_Menu_PE(),
								 'depth'           => 0,
								 'pe_type' => "default"
								 );

		add_filter("wp_nav_menu_objects",array(&$this,"wp_nav_menu_objects_filter"));
	}

	public function getMenuConf($override,$type) {
		switch ($type) {
		case "sidebar":
			$override["items_wrap"] = '<ul class="nav nav-list">%3$s</ul>';
		case "simple":
			$override["depth"] = 1;
			$override["pe_type"] = $type;
		}
		$override["items_wrap"] = apply_filters("pe_theme_menu_items_wrap_$type",empty($override["items_wrap"]) ? $this->defaults["items_wrap"] : $override["items_wrap"]);
		return array_merge($this->defaults,$override);
	}

	public function show($menu,$type = "default") {
		$this->current = $menu;
		wp_nav_menu($this->getMenuConf(array("theme_location" => $menu),$type));
	}

	public function fallback($args) {
		if ($args["theme_location"] === "main") {
			add_filter("wp_page_menu",array(&$this,"wp_page_menu_filter"));
			wp_page_menu(
						 array(
							   "depth" => 1,
							   "menu_class" => "menu"
							   )
						 );
			remove_filter("wp_page_menu",array(&$this,"wp_page_menu_filter"));
		}
	}

	public function wp_page_menu_filter($menu) {
		$menu = strtr($menu,
					  array(
							'<div class="menu">' => '',
							'</div>' => '',
							'<ul>' => '<ul id="navigation" class="nav">'
							));
		return $menu;
	}


	public function showID($menu,$type = "default") {
		wp_nav_menu($this->getMenuConf(array("menu" => $menu),$type));
	}

	public function wp_nav_menu_objects_filter($items) {
		$hasChild = array();
		$keys = array_keys($items);

		foreach ($keys as $i) {
			$item =& $items[$i];

			if (empty($item->pe_meta)) $item->pe_meta = (object) maybe_unserialize(get_post_meta($item->ID,PE_THEME_META,true));

			if ($item->menu_item_parent > 0) {
				$hasChild[$item->menu_item_parent] = $item->ID;
			}
			switch ($item->url) {
			case "home":
			case "#home":
				$item->url = home_url();
				if (is_front_page()) {
					$item->classes[] = "current-menu-item";
				}
				break;
			}
		}
		
		$nthLevel = apply_filters("pe_theme_menu_nth_level_icon",'<span class="icon-chevron-right icon-white"></span>',$items);
		$topLevel = apply_filters("pe_theme_menu_top_level_icon",' <b class="caret"></b>',$items);

		foreach ($keys as $i) {
			$item =& $items[$i];
			$icon = "";
			$title = $item->title;
			if (isset($hasChild[$item->ID])) {
				$icon = $item->menu_item_parent ? $nthLevel : $topLevel;
				$item->title = $title . $icon;

				//$item->title .= $item->menu_item_parent ? $nthLevel : $topLevel;
				$item->has_child = $hasChild[$item->ID];
			}
			//$item->title = apply_filters("pe_theme_menu_item_title",$item->title,$title,$icon,$this->current);
			$item->title = apply_filters("pe_theme_menu_item_title",$item->title,$item);
		}
		return $items;
	}

	public function admin() {
		add_action("current_screen",array(&$this,"current_screen"));
		add_filter('wp_edit_nav_menu_walker',array(&$this,"wp_edit_nav_menu_walker_filter"));
		add_action("wp_update_nav_menu",array(&$this,"wp_update_nav_menu"),10,1);
	}

	public function current_screen($screen) {
		if (empty($screen->base)) return;
		if ($screen->base === "nav-menus") {
			$options = apply_filters("pe_theme_menu_custom_fields",false);
			if (is_array($options) && !empty($options)) {
				add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));
				foreach ($options as $name=>$data) {
					$optionClass = "PeThemeFormElement{$data['type']}";
					$item = new $optionClass("","",$null);
					$item->registerAssets();
				}	
			}
		}
	}

	public function admin_enqueue_scripts() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.menu.js",array("jquery","pe_theme_tooltip"),"pe_theme_admin_menu");
		wp_enqueue_script("pe_theme_admin_menu");
	}


	public function wp_edit_nav_menu_walker_filter() {
		return "PeThemeMenuEditWalker";
	}

	public function wp_update_nav_menu($menu_id) {
		if (!empty($_POST[PE_THEME_META])) {

			foreach ($_POST[PE_THEME_META] as $id => $value) {
				// this is needed to convert window-style line feeds to unix format, without doing so
				// all serialized values will breaks once exported into xml file
				array_walk_recursive($value,array("PeThemeUtils","dos2unix"));
				update_post_meta($id,PE_THEME_META,apply_filters("pe_theme_update_nav_metadata",$value,$id));
			}
		}
	}

}

class Walker_Nav_Menu_PE extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = Array()) {
		$classes = apply_filters("pe_theme_menu_dropdown_menu_class","dropdown-menu",$depth);
		if ($depth > 0) {
			$classes .= " sub-menu";
		}
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"$classes\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		switch ($item->url) {
		case "#divider":
			$output .= '<li class="divider">';
			return;
		case "#header":
			$output .= '<li class="nav-header">'. $item->title;
			return;
		}

		if (empty($item->pe_meta)) $item->pe_meta = (object) maybe_unserialize(get_post_meta($item->ID,PE_THEME_META,true));

		$args->after = apply_filters("pe_theme_menu_item_after",$args->after,$item,$depth);
		
		if (isset($item->has_child)) {
			$item->classes[] = apply_filters("pe_theme_menu_dropdown_menu_item_class","dropdown",$depth);
		}
		
		if (in_array("current-menu-item",$item->classes)) {
			$item->classes[] = apply_filters("pe_theme_menu_current_menu_item_class","active",$depth);
		}

		if (in_array("current-menu-ancestor",$item->classes) ) {
			$item->classes[] = apply_filters("pe_theme_menu_current_menu_ancestor_class","active",$depth);
		}

		$item->classes = apply_filters("pe_theme_menu_item_classes",$item->classes,$item,$depth);

		parent::start_el($output, $item, $depth, $args);
	}

	function end_el(&$output, $object, $depth = 0, $args = Array()) {
		$output .= "</li>\n";
	}
}

?>