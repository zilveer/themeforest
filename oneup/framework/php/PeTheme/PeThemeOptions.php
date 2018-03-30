<?php

class PeThemeOptions {

	protected $master;
	public $options;
	public $slug;
	public $slugLang = false;
	public $wpml = array();
	public $orig;


	public function __construct(&$master) {
		$this->master =& $master;
		$this->slug = "pe_theme_".PE_THEME_NAME."_options";

		$db = (array) get_option($this->slug,null);
		$this->options = (object) array_merge((array) $this->defaults(), $db);

		if (defined('ICL_LANGUAGE_CODE')) {
			$this->orig = clone $this->options;
		}

		if (defined('ICL_LANGUAGE_CODE') && $this->master->wpml->notDefaultLanguage()) {
			$this->slugLang = $this->slug."_".ICL_LANGUAGE_CODE;
			$lang = get_option($this->slugLang,null);
			if (is_array($lang)) {
				$this->options = (object) array_merge((array) $this->options,$lang);
			}
		}
	}

	public function &defaults() {
		$optionDef =& PeGlobal::$config["options"];
		$def = new stdClass();
		foreach ($optionDef as $option=>$data) {
			if ($data["type"] == "Help") {
				continue;
			}
			$def->$option = empty($data["default"]) ? null : $data["default"];
			if (defined('ICL_LANGUAGE_CODE')) {
				if (!empty($data["wpml"])) {
					$this->wpml[] = $option;
				}
			}
		}
		$this->wpml = apply_filters("pe_theme_wpml_options",$this->wpml);
		return $def;
	}

	public function save(&$options) {
		if (!empty($this->wpml) && is_array($this->wpml) && count($this->wpml) > 0 && $this->master->wpml->notDefaultLanguage()) {
			foreach ($this->wpml as $key) {
				// save option only in lang specific options
				$lang[$key] = $options[$key];
				// restore value for default lang options
				//$options[$key] = $this->options->{$key};
				$options[$key] = $this->orig->{$key};
			}
			update_option($this->slugLang,$lang);
		}

		$this->options = update_option($this->slug, apply_filters("pe_theme_options_save",(object) $options));
	}

	public function saveSingle($name,$value) {
		$this->options->{$name} = $value;
		$this->save($this->options);
		
	}

	public function __get($what) {
		if (isset($this->options) && isset($this->options->$what)) {
			return $this->options->$what;
		}
		return "";
	}

	public function &all() {
		return $this->options;
	}

	public function get($key) {
		return isset($this->options->$key) ? $this->options->$key : null;
	}

	public function set($key,$value) {
		$this->options->$key = $value;
	}

}

?>