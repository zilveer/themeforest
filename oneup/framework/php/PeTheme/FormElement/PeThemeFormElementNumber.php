<?php

class PeThemeFormElementNumber extends PeThemeFormElement {

	protected function addTemplateValues(&$data) {
		$data["[INPUT_TYPE]"] = "number";
		$data["[STEP]"] = empty($this->data["step"]) ? 1 : $this->data["step"];
		if (!empty($data["[LABEL]"])) {
			$data["[LABEL]"] = "<h4>".$data["[LABEL]"].$data["[TOOLTIP]"]."</h4>";
		}
	}

	protected function template() {
		
		$html = <<<EOT
<div class="option option-input">
    [LABEL]
    <div class="section">
        <div class="element">
            <input id="[ID]" step="[STEP]" type="[INPUT_TYPE]" value="[VALUE]" name="[NAME]" data-name="[DATA_NAME]" data-datatype="[DATATYPE]"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

}

?>
