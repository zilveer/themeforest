<?php

class PeThemeViewLayoutModule extends PeThemeView {

	public $data;

	public function name() {
		return __("Layout",'Pixelentity Theme/Plugin');
	}

	public function option() {
		return str_replace("PeThemeViewLayoutModule","",get_class($this));
	}

	public function type() {
		return __("Content",'Pixelentity Theme/Plugin');
	}

	public function capability($cap) {
		return $cap === "layout";
	}

	public function tooltip() {
		return __("Description",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return array();
	}

	public function fields() {
		return array();
	}

	public function jsClass() {
		return "Standard";
	}

	public function cssClass() {
		return "content";
	}

	public function group() {
		return "default";
	}

	public function allowed() {
		return "";
	}

	public function create() {
		return "";
	}

	public function force() {
		return "";
	}


	public function requireAssets() {
		static $registered = false;

		if (!$registered) {
			PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.standard.js",array("jquery"),"pe_theme_layout_module_standard");
			$registered = true;
		}

		$type = str_replace("PeThemeViewLayoutModule","",get_class($this));

		wp_localize_script('pe_theme_layout_module_standard',"pe_theme_layout_module_$type",$this->config());
	}

	public function enqueueAssets() {
		wp_enqueue_script("pe_theme_layout_module_standard");
	}

	public function getData($conf) {
		if (!isset($conf["data"])) return false;
		
		$data = (object) $conf["data"];
		if (!empty($data->content)) {
			$data->content = do_shortcode(apply_filters("the_content",$data->content));
		}

		return $data;
	}

	public function blockClass() {
		return "";
	}

	public function setTemplateData() {
		peTheme()->template->data($this->data);
	}

	public function render() {
		echo apply_filters("pe_theme_layoutmodule_open",sprintf('<div class="pe-block pe-view-layout-block pe-view-layout-block-%s %s pe-view-layout-class-%s">',$this->conf->bid,$this->blockClass(),str_replace("pethemeviewlayoutmodule","",strtolower(get_class($this)))));
		$this->template();
		echo apply_filters("pe_theme_layoutmodule_close",'</div>');
	}

	public function output($conf) {
		$this->conf = (object) $conf;
		if (!($this->data = $this->getData($conf))) return;

		$this->setTemplateData();
		$this->render();
	}


	public function config() {
		$options["messages"] = $this->messages();
		$options["fields"] = array();
		$options["jsclass"] = $this->jsClass();
		$options["group"] = $this->group();
		$options["allowed"] = $this->allowed();
		$options["create"] = $this->create();
		$options["force"] = $this->force();

		$class = str_replace("PeThemeViewLayoutModule","",get_class($this)); 
		$fields = apply_filters("pe_theme_view_layout_module_{$class}_options",$this->fields());
		$options = apply_filters("pe_theme_view_layout_module_{$class}_parameters",$options);

		foreach ($fields as $name=>$params) {
			$params["noscript"] = true;

			$class = "PeThemeFormElement".$params["type"];
			$item = new $class("",$name,$params);
			$item->registerAssets();
			$options["templates"][$name] = $item->get_render();
			$options["script"][$name] = $item->jsInit();
			$options["fields"][] = $name;
		}


		return $options;
	}
   
}

?>
