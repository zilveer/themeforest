<?php

class PeThemePlainForm extends PeThemeAdminForm {

	
	protected function template() {
		$html = "[TABS_BODY]";
		return $html;	
	}

	protected function openBodyTag($section,$count) {
		return sprintf('<div id="%s" >',$this->prefix."_".$section);
		return "";
	}

	protected function closeBodyTag($section,$count) {
		return "</div>";
	}
	
	// nonce not needed here
	protected function getNonce() {
		return "";
	}

}

?>
