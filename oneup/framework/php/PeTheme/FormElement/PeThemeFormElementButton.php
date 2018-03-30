<?php

class PeThemeFormElementButton extends PeThemeFormElement {

	protected function template() {
		$html = <<<EOT
<div class="option option-button">
    <div class="section">
        <div class="element">
			<input id="[ID]" class="ob_button" type="button" value="[LABEL]" style="float: left" />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>
EOT;

		return $html;
	}

}

?>
