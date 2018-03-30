<?php

class PeThemeFormElementNumber extends PeThemeFormElement {

	protected function addTemplateValues(&$data) {
		$data["[INPUT_TYPE]"] = "number";
		if (!empty($data["[LABEL]"])) {
			$data["[LABEL]"] = "<h4>".$data["[LABEL]"].$data["[TOOLTIP]"]."</h4>";
		}
	}

}

?>