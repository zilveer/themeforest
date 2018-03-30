<?php

class PeThemeFormElementText extends PeThemeFormElement {

	protected function addTemplateValues(&$data) {
		if (!empty($data["[LABEL]"])) {
			$lang = defined("ICL_LANGUAGE_CODE") && !empty($this->data["wpml"]) ? "(".ICL_LANGUAGE_CODE.")" : "";
			$data["[LABEL]"] = "<h4>".$data["[LABEL]"]." $lang".$data["[TOOLTIP]"]."</h4>";
		} else {
		}
	}

}

?>