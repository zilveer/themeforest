<?php

class PeThemeFormElementRadioPlain extends PeThemeFormElementRadio {
	
	protected function template() {
		$html = <<<EOT
[OPTIONS]
EOT;
		return $html;
	}

	protected function addTemplateMarkup(&$buffer,&$options,$value,$id,$name,$single) {
		$count = 0;
		foreach ($options as $label=>$current) {
			$label = $single ? $current : $label;
			$selected = ($current == $value) ? " checked " : "";
			$buffer .=  "<input name=\"$name\" id=\"{$id}_{$count}\" type=\"radio\" value=\"".esc_attr($current)."\"$selected /><label for=\"{$id}_{$count}\">".esc_attr($label).'</label><br/>';
			$count++;
		}
	}

}

?>
