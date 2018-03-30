<?php

class PeThemeFormElementRadio extends PeThemeFormElement {
	
	protected function template() {
		$html = <<<EOT
<div class="option option-radio">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="element" style="overflow: hidden">
[OPTIONS]
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

	protected function addTemplateValues(&$data) {
		$options =& $this->data["options"];
		$buffer =& $data["[OPTIONS]"];
		$buffer = "";
		if (!is_array($options) || count($options) == 0) return;
		if (isset($this->data["single"])) {
			$single = $this->data["single"];
		} else {
			$single = false;
		}
		if (isset($this->data["value"])) {
			$value = $this->data["value"];
		} else {
			$value = $this->data["default"];
		}
		$this->addTemplateMarkup($buffer,$options,$value,$data["[ID]"],$data["[NAME]"],$single);
	}

	protected function addTemplateMarkup(&$buffer,&$options,$value,$id,$name,$single) {
		$count = 0;
		foreach ($options as $label=>$current) {
			$label = $single ? $current : $label;
			$selected = ($current == $value) ? " checked " : "";
			$buffer .=  "<div class=\"input_wrap\"><input name=\"$name\" id=\"{$id}_{$count}\" type=\"radio\" value=\"".esc_attr($current)."\"$selected /><label for=\"{$id}_{$count}\">".esc_attr($label).'</label></div>';
			$count++;
		}
	}

}

?>
