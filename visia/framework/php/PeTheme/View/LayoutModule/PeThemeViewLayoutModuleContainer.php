<?php

class PeThemeViewLayoutModuleContainer extends PeThemeViewLayoutModule {

	private static $_instances = 0;

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.container.js",array("jquery","pe_theme_layout_module_standard"),"pe_theme_layout_module_container");
	}

	public function requireAssets() {
		parent::requireAssets();
		wp_enqueue_script("pe_theme_layout_module_container");
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Container",'Pixelentity Theme/Plugin')
				  );
	}

	public function name() {
		return __("Container",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Layout",'Pixelentity Theme/Plugin');
	}

	public function jsClass() {
		return "Container";
	}

	public function cssClass() {
		return "layout";
	}

	public function __get($what) {
		if ($what === "instances") return self::$_instances;
	}

	public function blockClass() {
		return "pe-container";
	}
	
	public function output($conf) {
		$this->conf = (object) $conf;
		$this->data = $this->getData($conf);
		self::$_instances++;
		$this->setTemplateData();
		$this->render();
	}

	public function outputModule($item) {
		peTheme()->view->outputModule($item);
	}


	public function template() {
		
		foreach ($this->conf->items as $item) {
			$this->outputModule($item);
		}

	}

	public function tooltip() {
		return __("Use this block to add a container into which further blocks may then be added.",'Pixelentity Theme/Plugin');
	}


}

?>
