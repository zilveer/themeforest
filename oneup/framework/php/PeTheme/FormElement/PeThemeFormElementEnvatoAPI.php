<?php

class PeThemeFormElementEnvatoAPI extends PeThemeFormElement {

	protected function addTemplateValues(&$data) {
		$data["[DESCRIPTION]"] = sprintf($data["[DESCRIPTION]"],'<a id="envatoAPI" href="#">','</a>');
	}

	protected function template() {
		$html = <<<EOT
<div class="option option-input" style="display: none;">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="element">
            <input id="[ID]" type="text" value="[VALUE]" name="[NAME]" />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>
EOT;

		return $html;
	}

}

?>
