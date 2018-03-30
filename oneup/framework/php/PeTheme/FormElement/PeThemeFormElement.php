<?php

class PeThemeFormElement {

	protected $group;
	protected $name;
	protected $data;

	public function __construct($group,$name,&$data) {
		$this->group = $group;
		$this->name = $name;
		$this->data = $data;
	}

	public function registerAssets() {
		wp_enqueue_style("pe_theme_admin");
	}

	protected function template() {
		
		$html = <<<EOT
<div class="option option-input">
    [LABEL]
    <div class="section">
        <div class="element">
            <input id="[ID]" type="[INPUT_TYPE]" value="[VALUE]" name="[NAME]" data-name="[DATA_NAME]" data-datatype="[DATATYPE]"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>
EOT;
		return $html;
	}

	protected function setData(&$target,$name) {
		$target["[".strtoupper($name)."]"] = isset($this->data[$name]) ? $this->data[$name] : "";
	}

	protected function addTemplateValues(&$data) {
	}

	public function jsInit() {
		return '';
	}

	public function get_render() {
		if (!isset($this->data["default"])) {
			$this->data["default"] = "";
		}
		$data["[INPUT_TYPE]"] = "text";
		$data["[DATA_NAME]"] = $this->name;
		$data["[DEFAULT]"] = is_array($this->data["default"]) ? $this->data["default"] : esc_attr($this->data["default"]);
		$data["[VALUE]"] = isset($this->data["value"]) ? $this->data["value"] : $this->data["default"];
		$data["[VALUE]"] = is_string($data["[VALUE]"]) ? esc_attr($data["[VALUE]"]) : $data["[VALUE]"]; 
		$data["[NAME]"] = $this->group ? "{$this->group}[{$this->name}]" : $this->name;
		$data["[ID]"] = strtr($data["[NAME]"],"[]","__");
		$data["[DATATYPE]"] = isset($this->data["datatype"]) ? $this->data["datatype"] : "";

		$tooltip = "";
		
		/*
		if (!empty($this->data["label"])) {
			$tooltip .= sprintf('<h4>%s</h4>',$this->data["label"]);
		}
		*/

		if (!empty($this->data["description"])) {
			$tooltip .= sprintf('<p>%s</p>',$this->data["description"]);
		}

		$data["[TOOLTIP]"] = $tooltip ? sprintf('<span class="help" title="%s">?</span>',esc_attr($tooltip)) : "";
		$this->setData($data,"label");
		$this->setData($data,"description");
		$this->addTemplateValues($data);

		foreach ($data as $key => $val) {
			if (!(is_string($val) || is_numeric($val))) {
				unset($data[$key]);
			}
		}

		return strtr($this->template(),$data);
	}

	public function render() {
		echo $this->get_render();
	}
}

?>
