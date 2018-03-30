<?php

class PeThemeFormElementLayersBuilder extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
	}
	
	protected function template() {
		$home = home_url();
		$img = peTheme()->content->get_origImage();
		$size = __("Size",'Pixelentity Theme/Plugin');
		$run = __("RUN",'Pixelentity Theme/Plugin');
		$save = __("SAVE",'Pixelentity Theme/Plugin');
		$change = __("Change Image",'Pixelentity Theme/Plugin');

		$html = <<<EOT
<div class="option option-input option-layersbuilder" id="[ID]">
	<div class="pe_layer_builder_preview">
		<iframe id="pe_layer_builder_iframe" width="[W]" height="[H]" data-home="$home" data-img="$img" data-w="[W]" data-h="[H]"></iframe>
		<div class="pe_layer_builder_preview_size">
			<input type="button" class="ob_button pe-run-preview" value="$run" style="width: 120px;margin-right:10px">
			<input type="button" class="ob_button pe-save" value="$save" style="width: 120px;margin-right:185px">
			<label for="[ID]">$size</label><input id="[ID]" type="text" value="[VALUE]" name="[NAME]" data-name="[DATA_NAME]"/>
			<input type="button" class="ob_button pe-change-image" value="$change">
		</div>
	</div>
</div>
EOT;

		return $html;
	}

	protected function addTemplateValues(&$data) {
		list($w,$h) = explode("x",$data["[VALUE]"]);

		$data["[W]"] = $w;
		$data["[H]"] = $h;

	}

}

?>
