<?php

class PeThemeFormElementTags extends PeThemeFormElementCheckbox {
	
	public function __construct($group,$name,&$data) {
		parent::__construct($group,$name,$data);
		$this->data["options"] =& peTheme()->data->getTaxOptions($data["taxonomy"]);
	}

	protected function template() {
		$html = <<<EOT
<div class="option option-checbox option-checkbox-simple">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
[OPTIONS]
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

}

?>
