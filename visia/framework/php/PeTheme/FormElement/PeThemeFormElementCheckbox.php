<?php

class PeThemeFormElementCheckbox extends PeThemeFormElement {
	
	protected function template() {
		$html = <<<EOT
<div class="option option-checbox option-checkbox-simple">
    <h4>[LABEL]</h4>
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
		$value = isset($this->data["value"]) ? $this->data["value"] : (isset($this->data["default"]) ? $this->data["default"] : array() );
		if (!is_array($value)) {
			$value = array($value);
		}
		$this->addTemplateMarkup($buffer,$options,$value,$data["[ID]"],$data["[NAME]"],$single);
	}

	protected function addTemplateMarkup(&$buffer,&$options,$value,$id,$name,$single) {
		$count = 0;
		foreach ($options as $label=>$current) {
			$label = $single ? $current : $label;
			$selected = in_array($current,$value) ? " checked " : "";
			$buffer .=  '<div class="input_wrap"><input name="'.$name.'['.$count.']" id="'.$id.'_'.$count.'" type="checkbox" value="'.esc_attr($current).'"'.$selected.' /><label for="'.$id.'_'.$count.'">'.esc_attr($label).'</label></div>';
			$count++;
		}
	}

}

?>
