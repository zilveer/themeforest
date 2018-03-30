<?php

class PeThemeFormElementSelectPlain extends PeThemeFormElementSelect {
	
	protected function template() {
		$html = <<<EOT
<select id="[ID]" name="[NAME]" data-datatype="[DATATYPE]">
[OPTIONS]
</select>
EOT;
		return $html;
	}

}

?>
