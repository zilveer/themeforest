<?php

class PeThemeFormElementHidden extends PeThemeFormElement {

	protected function template() {
		$html = <<<EOT
            <input id="[ID]" type="hidden" value="[VALUE]" name="[NAME]" />
EOT;
		return $html;
	}

}

?>
