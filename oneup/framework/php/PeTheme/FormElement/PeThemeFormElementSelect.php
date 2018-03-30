<?php

class PeThemeFormElementSelect extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();

		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.select.js",array(),"pe_theme_field_select");
		wp_enqueue_script("pe_theme_field_select");
	}
	
	protected function template() {
		$html = <<<EOT
<div class="option option-select">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			<select id="[ID]" name="[NAME]" class="select" data-name="[DATA_NAME]" data-datatype="[DATATYPE]" data-edit="[EDIT]">
				[OPTIONS]
			</select>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>[SCRIPT]
EOT;
		return $html;
	}
	
	protected function getOptionList($options) {
		$buffer = "";
		if (isset($this->data["single"])) {
			$single = $this->data["single"];
		} else {
			$single = false;
		}
		if (isset($this->data["value"])) {
			$value = $this->data["value"];
		} else {
			$value = $this->data["default"];
		}

		if (!is_array($options)) {
			$options = array();
		}
		foreach ($options as $label=>$current) {
			$label = $single ? $current : $label;
			$selected = ($current == $value) ? " selected " : "";
			$buffer .= "<option $selected value=\"".esc_attr($current).'">'.esc_attr($label).'</option>';
		}
		return $buffer;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldSelect();';
		//return '';
	}

	protected function addTemplateValues(&$data) {
		$script = $this->jsInit();
		
		if (!empty($this->data["editable"])) {
			$data['[EDIT]'] = esc_attr($this->data["editable"]);
		} else {
			$data['[EDIT]'] = "";
		}

		if ($data['[EDIT]'] && !isset($this->data["noscript"]) && $script) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$script));
		} else {
			$data['[SCRIPT]'] = "";
		}

		
		
		$options =& $this->data["options"];
		$buffer =& $data["[OPTIONS]"];
		$buffer = "";
		if (!is_array($options) || count($options) == 0) return;
		if (!empty($this->data["groups"])) {
			foreach ($options as $group => $optgroup) {
				$buffer .= '<optgroup label="'.esc_attr($group).'">'.$this->getOptionList($optgroup).'</optgroup>';
			}
		} else {
			$buffer .= $this->getOptionList($options);
		}
	}

}

?>
