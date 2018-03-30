<?php

class PeThemeFormElementUploadLink extends PeThemeFormElementUpload {

	protected function addTemplateValues(&$data) {
		parent::addTemplateValues($data);
		$data["[UPCLASS]"] = "";
	}

}

?>
