<?php

class PeThemeFormElementPlugins extends PeThemeFormElement {

	protected function template() {
		$html = <<<EOT
<div class="option option-plugins">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			[STATUS]
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

	protected function addTemplateValues(&$data) {
		$data["[STATUS]"] = PixelentityThemeBundledPlugins::$instance->options();
		//print_r($this->data["plugins"]);
	}

}

?>
