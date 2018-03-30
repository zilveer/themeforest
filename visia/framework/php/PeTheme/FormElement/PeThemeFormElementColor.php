<?php

class PeThemeFormElementColor extends PeThemeFormElement {
	
	public function registerAssets() {
		parent::registerAssets();

		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.color.js",array('wp-color-picker','json2'),"pe_theme_field_color");

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script("pe_theme_field_color");
		
	}

	public function jsInit() {
		return "jQuery('#[ID]').peFieldColor();";
		//return "jQuery('#[ID]').wpColorPicker();";
	}

	protected function addTemplateValues(&$data) {
		parent::addTemplateValues($data);
		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}
		$data["[VALUE]"] = empty($this->data["value"]) ? $this->data["default"] : $this->data["value"];

		$palette = empty($this->data["palette"]) ? array() : array_flip($this->data["palette"]);

		$t =& peTheme();
		$colors = $t->color->options();

		if (!empty($colors)) {
			$options = $t->options->all();
			$colors = array_keys($colors);
			foreach ($colors as $key) {
				if (($color = empty($options->$key) ? false : $options->$key)) {
					$palette[$color] = $color;
				}
			}
		}

		$palette["#000000"] = true;
		$palette["#ffffff"] = true;
		$palette["#dd3333"] = true;
		$palette["#eeee22"] = true;
		$palette["#81d742"] = true;
		$palette["#1e73be"] = true;
		


		if (!empty($palette)) {
			$data["[PALETTE]"] = sprintf('data-palette="%s"',esc_attr(json_encode(array_keys($palette))));
		}

	}
	protected function template() {
		$msg = sprintf(__("Click text box for color picker. %sRestore default%s",'Pixelentity Theme/Plugin'),'<a href="#" id="restore_[ID]">','</a>');
		$html = <<< EOT
<div class="option">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			<input type="text" name="[NAME]" id="[ID]" value="[VALUE]" data-default-color="[DEFAULT]" data-name="[DATA_NAME]" [PALETTE] class="color-picker-hex" style="display: inline-block"  />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>[SCRIPT]
EOT;
	

return $html;
	}

}

?>
