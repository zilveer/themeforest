<?php

class PeThemeFormElementTextArea extends PeThemeFormElement {

	protected function template() {
		$lang = defined("ICL_LANGUAGE_CODE") && !empty($this->data["wpml"]) ? "(".ICL_LANGUAGE_CODE.")" : "";
		$html = <<<EOT
<div class="option option-textarea">
    <h4>[LABEL] {$lang}[TOOLTIP]</h4>
    <div class="section">
        <div class="element">
            <textarea id="[ID]" name="[NAME]" rows="5" data-name="[DATA_NAME]">[VALUE]</textarea>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

}

?>
