<?php

class PeThemeWPML {

	public $master;
	public $sidebars = array();
	private $_langs;

	public function __construct($master) {
		$this->master =& $master;
		add_filter('walker_nav_menu_start_el',array(&$this,"walker_nav_menu_start_el_filter"),10,4);
		add_filter('pe_theme_menu_item_classes',array(&$this,"pe_theme_menu_item_classes_filter"),10,3);

	}

	public function langs() {
		if ($this->_langs) {
			return $this->_langs;
		}

		global $sitepress;
		$this->_langs = $sitepress->get_active_languages();
		return $this->_langs;
	}


	public function instantiate() {
		if (function_exists("icl_get_languages")) {
			PeGlobal::$config["widgets"][] = "Wpml";
		}
		PeGlobal::$config["shortcodes"][] = "Wpml";

		add_filter('widget_display_callback', array(&$this,'dynamic_sidebar_params_filter'),10,3);
	}

	public function options() {
		$options[__("Any",'Pixelentity Theme/Plugin')] = "" ;
		
		$langs = $this->langs();
		if (is_array($langs)) {
			foreach($langs as $value) {
				//$options[strtoupper($value["language_code"])] = $value["language_code"];
				$options[strtoupper($value["code"])] = $value["code"];
			}
		}
		return $options;
		
	}


	public function dynamic_sidebar_params_filter($instance,$widget,$args) {
		$sb = $args["id"];
		if (!empty($widget->is_wpml_conditional)) {
			$this->sidebars[$sb] = empty($instance["lang"]) ? false : $instance["lang"];
			return false;
		}
		if (!empty($this->sidebars[$sb]) && ICL_LANGUAGE_CODE != $this->sidebars[$sb]) return false;
		return $instance;
	}

	public function widget_callback($args,$instance) {
		return "";
	}

	public function deflang() {
		global $sitepress;
		return $sitepress->get_default_language();
	}

	public function notDefaultLanguage() {
		return (ICL_LANGUAGE_CODE != "all" && ICL_LANGUAGE_CODE != $this->deflang());
	}


	public function register_strings() {
		// disabled since no longer needed
		return;
		if (!function_exists("icl_register_string")) return;
		get_template_part("languages/wpml_strings");
		if (!empty(PeGlobal::$config["wpml_strings"]) && is_array(PeGlobal::$config["wpml_strings"])) {
			$count = 0;
			foreach (PeGlobal::$config["wpml_strings"] as $s) {
				//icl_register_string('theme '.PE_THEME_NAME,md5($s),$s);
				icl_register_string('Pixelentity Theme/Plugin',"PE".crc32($s),$s);
			}
		}
	}

	public function walker_nav_menu_start_el_filter($item_output, $item, $depth, $args ) {
		if ($depth === 0 && $item->url === "#wpml") {
			$langs = icl_get_languages('skip_missing=0&orderby=custom&order=ASC&link_empty_to=#');
			if (!empty($langs) && is_array($langs)) {
				$output = "";
				foreach ($langs as $lang) {
					$output .= sprintf('<a class="pe-wpml-flag" href="%s"><img src="%s" alt="%s" /></a>',
									   $lang['url'],
									   $lang['country_flag_url'],
									   $lang['native_name']
									   );
				}
				$item_output = $output;
			}
		}
		return $item_output;
	}

	public function pe_theme_menu_item_classes_filter($classes,$item,$depth) {
		if ($depth === 0 && $item->url === "#wpml") {
			$classes[] = "menu-item-pe-wpml";
		}
		return $classes;
	}



}

?>