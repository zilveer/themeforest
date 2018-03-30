<?php

class PeThemeFormElementTextPlain extends PeThemeFormElementText {

	protected function template() {
		$html = <<<EOT
<input id="[ID]" type="text" value="[VALUE]" name="[NAME]" />
EOT;
		return $html;
	}
	
}

?>
