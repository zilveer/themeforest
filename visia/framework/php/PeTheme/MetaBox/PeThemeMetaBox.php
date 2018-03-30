<?php

class PeThemeMetaBox {

	protected $controller;
	protected $name;
	protected $data;
	protected $form;

	public function __construct(&$controller,$name,$data) {
		$this->controller =& $controller;
		$this->name = $name;
		$this->data =& $data;

		$this->registerAssets();
		$this->requireAssets();

		$this->buildForm();
	}

	protected function buildForm() {		
		$data =& $this->data;
		$this->form = new PeThemeMetaBoxForm($this,"pe_theme_meta[{$this->name}]",$data["content"],$data["value"]);
		$this->form->build();
	}
	
	protected function registerAssets() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.js",array("pe_theme_utils","jquery-ui-button","pe_theme_tooltip"),"pe_theme_metabox");
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox");
	}

	public function getClasses($type) {
		$classes = isset($this->data["where"][$type]) ? $this->data["where"][$type] : "all";
		if ($type != "page") {
			$classes = strtr($classes,array("standard"=>"0"));
		}
		$classes = preg_replace("/([\w|\-]+)/","pe_mbox_active_\\1",strtr($classes,","," "));
		return $classes;
	}

	public function getOptions() {		
		return empty($this->data["options"]) ? "" : esc_attr(json_encode($this->data["options"]));
	}


	public function render($post) {
		echo strtr($this->form->getHTML(),
				   array(
						 "[CLASSES]"=>$this->getClasses($post->post_type),
						 "[OPTIONS]"=>$this->getOptions()
						 ));
	}

}

?>
