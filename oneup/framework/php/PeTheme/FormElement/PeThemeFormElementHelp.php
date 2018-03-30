<?php

class PeThemeFormElementHelp extends PeThemeFormElement {

	protected function template() {
		$html = <<<EOT
<div class="option option-input option-help">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>
EOT;
		return $html;
	}


}

?>
